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
                $messageToShow = $decryptedMessage;
            } else {
                $messageToShow = "Incorrect password.";
            }
        } else {
            $decryptedMessage = decryptMessage($row["message"], $secret_key, $secret_iv, $encrypt_method);
            $messageToShow = $decryptedMessage;
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Paste</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="assets/css/dash.css" rel="stylesheet">
</head>
<body class="bg-black flex justify-center items-center h-screen">
    <div class="flex items-start space-x-4">
    <?php if (!$askForPassword): ?>
        <div class="flex flex-col items-center space-y-4 text-white mt-20 mr-10">
    <div class="text-lg font-bold mb-1">Like</div>
    <button><i class="fas fa-thumbs-up text-2xl iconss"></i></button>
    <div class="text-lg font-bold mb-1">Dislike</div>
    <button><i class="fas fa-thumbs-down text-2xl iconss"></i></button>
    <div class="text-lg font-bold mb-1">Report</div>
    <button><i class="fas fa-flag text-2xl iconss"></i></button>
    <div class="text-lg font-bold mb-1">Download</div>
    <button><i class="fas fa-download text-2xl iconss"></i></button>
    <div class="text-lg font-bold mb-1">Raw</div>
    <button><i class="fas fa-code text-2xl iconss"></i></button>
</div>


        <?php endif; ?>
        
        <div class="flex-1 max-w-4xl" style="width: calc(100% + 300px); margin-top: 80px !important;">
            <?php if ($askForPassword): ?>
                <form action="" method="post" class="text-center">
                    <div class="mb-4">
                        <label for="password" class="block text-gray-300 text-sm font-bold mb-2">Password Required:</label>
                        <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <button type="submit" class="bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit</button>
                </form>
            <?php elseif (!$expired): ?>
                <!-- Adjusted textarea size with inline style for precise control -->
                <textarea readonly class="glow_border p-4 bg-gray-800 text-white rounded-lg border-2 overflow-auto" style="height: 500px; width: 800px;"><?php echo htmlspecialchars($messageToShow); ?></textarea>
            <?php else: ?>
                <p class="text-center text-red-500"><?php echo $messageToShow; ?></p>
            <?php endif; ?>
        </div>
       
    </div>
    <?php require('includes/footer.php'); ?>
    
</body>
</html>
