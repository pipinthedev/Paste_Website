<?php
require 'server/connect.php';
require 'includes/functions.php';

$messageToShow = "";
$askForPassword = false;
$expired = false;

if (isset($_GET['unique_id'])) {
    $uniqueId = $_GET['unique_id'];

    $stmt = $conn->prepare("SELECT message, paste_password, paste_expiry FROM paste WHERE unique_id = ?");
    $stmt->bind_param("s", $uniqueId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        
        if (!is_null($row['paste_expiry']) && new DateTime() > new DateTime($row['paste_expiry'])) {
            $expired = true;
            $messageToShow = "This paste has expired.";
        } elseif (!empty($row['paste_password']) && !isset($_POST['password'])) {
            
            $askForPassword = true;
        } elseif (!empty($row['paste_password']) && isset($_POST['password'])) {
            
            if (password_verify($_POST['password'], $row['paste_password'])) {
                $decryptedMessage = decryptMessage($row["message"], $secret_key, $secret_iv, $encrypt_method);
                $messageToShow = "Message: " . $decryptedMessage;
            } else {
                $messageToShow = "Incorrect password.";
            }
        } else {
            
            $decryptedMessage = decryptMessage($row["message"], $secret_key, $secret_iv, $encrypt_method);
            $messageToShow = "Message: " . $decryptedMessage;
        }
    } else {
        $messageToShow = "No results found.";
    }
    $stmt->close();
} else {
    $messageToShow = "Unique ID not provided.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Paste</title>
    <link href="https:
</head>

<body class="flex justify-center items-center h-screen bg-gray-100">
    <div class="w-full max-w-md">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 text-center">
            <?php if ($askForPassword): ?>
                <form action="" method="post">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                        <input type="password" id="password" name="password"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                    <div class="flex items-center justify-center">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit</button>
                    </div>
                </form>
            <?php elseif (!$expired): ?>
                <p>
                    <?php echo $messageToShow; ?>
                </p>
            <?php else: ?>
                <p class="text-red-500">
                    <?php echo $messageToShow; ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>