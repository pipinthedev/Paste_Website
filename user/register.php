<?php
session_start();

require '../server/connect.php';
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = $captcha_err = "";


$hcaptcha_secret_key = '';
$hcaptcha_site_key = '';
$sql = "SELECT hcaptcha_secret_key, hcaptcha_site_key FROM site_settings WHERE id = 1";
$result = $conn->query($sql);



if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hcaptcha_secret_key = $row['hcaptcha_secret_key'];
    $hcaptcha_site_key = $row['hcaptcha_site_key'];
} else {
    die("Error fetching hCaptcha settings.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $csrf_err = "CSRF token mismatch.";
    } else {

    if (!empty($_POST['h-captcha-response'])) {
        $response = file_get_contents("https://hcaptcha.com/siteverify?secret=" . $hcaptcha_secret_key . "&response=" . $_POST['h-captcha-response']);
        $responseData = json_decode($response);
        if ($responseData->success) {
            
            if (empty(trim($_POST["username"]))) {
                $username_err = "Please enter a username.";
            } elseif (!preg_match("/^[a-zA-Z0-9]*$/", trim($_POST["username"]))) {
                $username_err = "Username can only contain letters and numbers.";
            } else {
                $sql = "SELECT id FROM users WHERE username = ?";
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("s", $param_username);
                    $param_username = trim($_POST["username"]);
                    if ($stmt->execute()) {
                        $stmt->store_result();
                        if ($stmt->num_rows == 1) {
                            $username_err = "This username is already taken.";
                        } else {
                            $username = trim($_POST["username"]);
                        }
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    $stmt->close();
                }
            }

            
            if (empty(trim($_POST["password"]))) {
                $password_err = "Please enter a password.";     
            } elseif (strlen(trim($_POST["password"])) < 6) {
                $password_err = "Password must have at least 6 characters.";
            } else {
                $password = trim($_POST["password"]);
            }
            
            
            if (empty(trim($_POST["confirm_password"]))) {
                $confirm_password_err = "Please confirm password.";     
            } else {
                $confirm_password = trim($_POST["confirm_password"]);
                if (empty($password_err) && ($password != $confirm_password)) {
                    $confirm_password_err = "Password did not match.";
                }
            }

            
            if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
                
                
                $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
                 
                if ($stmt = $conn->prepare($sql)) {
                    
                    $stmt->bind_param("ss", $param_username, $param_password);
                    
                    
                    $param_username = $username;
                    $param_password = password_hash($password, PASSWORD_DEFAULT); 
                    
                    
                    if ($stmt->execute()) {
                        
                        header("location: login.php");
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    
                    $stmt->close();
                }
            }
        } else {
            $captcha_err = "Captcha verification failed, please try again.";
        }
    } else {
        $captcha_err = "Please complete the captcha.";
    }
}
    
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://hcaptcha.com/1/api.js" async defer></script>
</head>
<?php require('../includes/navbar.php') ?>
<body class="bg-black text-white"  style="background-color: #121213 !important;">
<?php require('../includes/ads.php') ?>
    <div class="flex flex-col items-center justify-center min-h-screen px-4">
    <div class="w-full max-w-md p-6 rounded-lg shadow-lg bg-gray-800 bg-opacity-0">
                    <h2 class="text-3xl font-bold mb-6 text-center">Register</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-gray-200">Username</label>
                    <input type="text" name="username" class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300 sm:text-sm" value="<?php echo $username; ?>">
                    <span class="text-red-500"><?php echo $username_err; ?></span>
                </div>    
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-200">Password</label>
                    <input type="password" name="password" class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300 sm:text-sm" value="<?php echo $password; ?>">
                    <span class="text-red-500"><?php echo $password_err; ?></span>
                </div>
                <div class="mb-4">
                    <label for="confirm_password" class="block text-sm font-medium text-gray-200">Confirm Password</label>
                    <input type="password" name="confirm_password" class="mt-1 block w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300 sm:text-sm" value="<?php echo $confirm_password; ?>">
                    <span class="text-red-500"><?php echo $confirm_password_err; ?></span>
                </div>
                <center>
                <div class="mb-4">
                    <div class="h-captcha" data-sitekey="<?php echo $hcaptcha_site_key; ?>" data-theme="dark"></div>
                    <span class="text-red-500"><?php echo $captcha_err; ?></span>
                </div>
                 </center>
                <div class="mb-4">
                    <input type="submit" class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline" value="Register">
                </div>
                <p class="text-center text-gray-400 text-xs">
                    Already have an account? <a href="login.php" class="text-blue-500 hover:text-blue-700">Login</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
