<?php
require 'server/connect.php';
require 'includes/functions.php';
session_start();

$messageToShow = "";
$askForPassword = false;
$expired = false;
$title = "";
$viewUpdated = false;


if (isset($_POST['action']) && isset($_POST['unique_id']) && ($_POST['action'] == 'like' || $_POST['action'] == 'dislike')) {
    $uniqueId = $_POST['unique_id'];
    if ($_POST['action'] == 'like') {
        $stmt = $conn->prepare("UPDATE paste SET likes = likes + 1 WHERE unique_id = ?");
    } else {
        $stmt = $conn->prepare("UPDATE paste SET dislikes = dislikes + 1 WHERE unique_id = ?");
    }
    $stmt->bind_param("s", $uniqueId);
    $stmt->execute();
    $stmt->close();
    header("Location: view.php?unique_id=" . $uniqueId);
    exit;
}

if (isset($_GET['unique_id'])) {
    $uniqueId = $_GET['unique_id'];

    // Increase views count
    if (!$viewUpdated) {
        $updateViewsStmt = $conn->prepare("UPDATE paste SET views = views + 1 WHERE unique_id = ?");
        $updateViewsStmt->bind_param("s", $uniqueId);
        $updateViewsStmt->execute();
        $updateViewsStmt->close();
        $viewUpdated = true;
    }

    $stmt = $conn->prepare("SELECT message, paste_password, paste_expiry, paste_title FROM paste WHERE unique_id = ?");
    $stmt->bind_param("s", $uniqueId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['paste_title'];

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
<?php require('includes/navbar.php') ?>

<body class="bg-black" style="background-color: #121213 !important;">

    <div class="flex justify-center items-center h-screen">
    <div class="flex items-start space-x-4">
        <?php if (!$askForPassword): ?>
        <div class="flex flex-col items-center space-y-4 text-white mt-20 mr-10">
            <div class="text-lg font-bold mb-1">Like</div>
            <form action="" method="post">
    <input type="hidden" name="action" value="like">
    <input type="hidden" name="unique_id" value="<?php echo $uniqueId; ?>">
    <button type="submit"><i class="fas fa-thumbs-up text-2xl iconss"></i></button>
</form>

            <div class="text-lg font-bold mb-1">Dislike</div>
            <form action="" method="post">
    <input type="hidden" name="action" value="dislike">
    <input type="hidden" name="unique_id" value="<?php echo $uniqueId; ?>">
    <button type="submit"><i class="fas fa-thumbs-down text-2xl iconss"></i></button>
</form>
            <div class="text-lg font-bold mb-1">Report</div>
            <button><i class="fas fa-flag text-2xl iconss"></i></button>


            <div class="text-lg font-bold mb-1">Download</div>
            <form action="download.php" method="POST">
                <input type="hidden" name="title" value="<?php echo htmlspecialchars($title); ?>">
                <input type="hidden" name="message" value="<?php echo htmlspecialchars($messageToShow); ?>">
                <button type="submit" style="background:none; border:none; padding:0; margin:0;">
                    <i class="fas fa-download text-2xl iconss"></i>
                </button>
            </form>

            <div class="text-lg font-bold mb-1">Raw</div>
            <form action="raw.php" method="POST" target="_blank">
                <input type="hidden" name="message" value="<?php echo htmlspecialchars($messageToShow); ?>">
                <button type="submit" style="background:none; border:none; padding:0; margin:0;">
                    <i class="fas fa-code text-2xl iconss"></i>
                </button>
            </form>
        </div>
        <?php endif; ?>
    </div>
      
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
                <textarea readonly class="glow_border p-4 bg-gray-800 text-white rounded-lg border-2 overflow-auto" style="height: 500px; width: 800px;"><?php echo htmlspecialchars($messageToShow); ?></textarea>
            <?php else: ?>
                <p class="text-center text-red-500"><?php echo $messageToShow; ?></p>
            <?php endif; ?>
        </div>
       
    </div>
    </div>
    
</body>
<div style="color: #FFF !important">
<?php require('includes/footer.php') ?>

</div>
</html>