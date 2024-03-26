<?php
require 'server/connect.php';
require 'includes/functions.php';
session_start();

$messageToShow = "";
$askForPassword = false;
$expired = false;
$title = "";
$viewUpdated = false;

if (isset($_POST['action']) && isset($_POST['unique_id'])) {
    $uniqueId = $_POST['unique_id'];
    if ($_POST['action'] == 'like') {
        $stmt = $conn->prepare("UPDATE paste SET likes = likes + 1 WHERE unique_id = ?");
        $_SESSION['message'] = "Like has been added to this paste.";
    } else {
        $stmt = $conn->prepare("UPDATE paste SET dislikes = dislikes + 1 WHERE unique_id = ?");
        $_SESSION['message'] = "Dislike has been added to this paste.";
    }
    $stmt->bind_param("s", $uniqueId);
    $stmt->execute();
    $stmt->close();
    header("Location: view.php?unique_id=" . $uniqueId);
    exit;
}

if (isset($_GET['unique_id'])) {
    $uniqueId = $_GET['unique_id'];

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
    <style>
        .icon-action {
            display: inline-block;
            width: 50px;
            height: 50px;
            background-color: #4A5568;
            color: white;
            line-height: 50px;
            text-align: center;
            border-radius: 5px;
            margin: 5px;
            cursor: pointer;
        }

        .icon-action:hover {
            background-color: #2D3748;
        }
    </style>
</head>

<body class="bg-black text-white" style="background-color: #121213 !important;">
    <div class="container mx-auto p-4 flex justify-center items-start">
        <div class="flex flex-col items-center mr-4">
           <?php if(isset($_SESSION['message'])): ?>
                    <div id="message-alert" class="bg-green-500 text-center p-3 rounded mb-3">
                        <?= $_SESSION['message']; ?>
                    </div>
                    <script>
                        setTimeout(function() {
                            document.getElementById('message-alert').style.display = 'none';
                        }, 5000);
                    </script>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>

            <div class="flex flex-wrap justify-center items-center p-4 bg-gray-800 rounded">
                <form action="" method="post">
                    <input type="hidden" name="action" value="like">
                    <input type="hidden" name="unique_id" value="<?= $uniqueId; ?>">
                    <button type="submit" class="icon-action"><i class="fas fa-thumbs-up"></i></button>
                </form>

                <form action="" method="post">
                    <input type="hidden" name="action" value="dislike">
                    <input type="hidden" name="unique_id" value="<?= $uniqueId; ?>">
                    <button type="submit" class="icon-action"><i class="fas fa-thumbs-down"></i></button>
                </form>

                <div id="reportBtn" class="icon-action"><i class="fas fa-flag"></i></div>

                <form action="download.php" method="POST">
                    <input type="hidden" name="title" value="<?= htmlspecialchars($title); ?>">
                    <input type="hidden" name="message" value="<?= htmlspecialchars($messageToShow); ?>">
                    <button type="submit" class="icon-action"><i class="fas fa-download"></i></button>
                </form>

                <form action="raw.php" method="POST" target="_blank">
                    <input type="hidden" name="message" value="<?= htmlspecialchars($messageToShow); ?>">
                    <button type="submit" class="icon-action"><i class="fas fa-code"></i></button>
                </form>
            </div>
        </div>

            <div class="w-full lg:w-4/5 px-4">
                <?php if ($askForPassword): ?>
                    <form action="" method="post" class="text-center">
                        <input type="password" id="password" name="password" placeholder="Enter password"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                    </form>
                <?php elseif (!$expired): ?>
                    <textarea readonly class="glow_border p-4 bg-gray-800 text-white rounded-lg w-full"
                        style="height: 500px;"><?= htmlspecialchars($messageToShow); ?></textarea>
                <?php else: ?>
                    <div class="text-center text-red-500">
                        <?= $messageToShow; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('reportBtn').addEventListener('click', function () {
            if (<?= json_encode(isset($_SESSION['loggedin']) && $_SESSION['loggedin']); ?>) {
                document.getElementById('reportForm').uniqueId.value = "<?= $uniqueId; ?>";
                document.getElementById('reportModal').classList.remove('hidden');
            } else {
                alert("You must be logged in to report.");
            }
        });
    </script>
    <?php require ('includes/footer.php'); ?>
</body>

</html>