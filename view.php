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
        $_SESSION['message'] = "Like has been added to this paste.";
    } else {
        $stmt = $conn->prepare("UPDATE paste SET dislikes = dislikes + 1 WHERE unique_id = ?");
        $_SESSION['message'] = "dis-Like has been added to this paste.";
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
</head>
<?php require('includes/navbar.php') ?>

<body class="bg-black" style="background-color: #121213 !important;">
<?php require('includes/ads.php') ?>

<div id="reportModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-middle bg-white rounded-lg text-center overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4" style="background-color: #121213 !important; color: #FFF !important">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4" style="background-color: #121213 !important; color: #FFF !important">                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg leading-6 font-medium text-white" id="modal-headline">
                            Report Paste
                        </h3>
                        <div class="mt-2">
                        <p class="text-sm text-white">
                                Please select the reason for reporting this paste:
                            </p>
                           
                            <form id="reportForm" method="POST" action="report.php">
                                <input type="hidden" name="uniqueId" value="">
                                <select name="reason" id="reason" required class="mt-2" style="background-color: #121213 !important; color: #FFF !important">
                                    <option value="spam">Spam</option>
                                    <option value="abuse">Abuse</option>
                                    <option value="Cashlink">Cashlink</option>
                                    <option value="Contains my info">Contains my info</option>
                                    <option value="not working">not working</option>
                                    <option value="malware">malware</option>
                                    <option value="Child Porn">Child Porn</option>
                                </select>
                                <div class="mt-4">
                                    <button type="submit" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:text-sm">
                                        Report
                                    </button>
                                </div>
                            </form>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <div class="flex justify-center items-center h-screen">
    <div class="flex items-start space-x-4">

    
    <?php if(isset($_SESSION['message'])): ?>
<div id="message-alert" class="bg-green-500 text-white px-4 py-3 rounded relative mt-2 mb-3 mx-auto max-w-md" role="alert" style="position: fixed; left: 50%; top: 20%; transform: translateX(-50%); z-index: 1000;">
    <span class="block sm:inline"><?= $_SESSION['message']; ?></span>
</div>
<script>
    setTimeout(function() {
        var messageAlert = document.getElementById('message-alert');
        if (messageAlert) {
            messageAlert.style.display = 'none';
        }
    }, 5000);
</script>
<?php unset($_SESSION['message']); endif; ?>


        <?php if (!$askForPassword): ?>
        <div class="flex flex-col items-center space-y-4 text-white mt-20 mr-10">
            
            <form action="" method="post">
    <input type="hidden" name="action" value="like">
    <input type="hidden" name="unique_id" value="<?php echo $uniqueId; ?>">
    <button type="submit"><i class="fas fa-thumbs-up text-2xl iconss"></i></button>
    <div class="text-lg font-bold mr-1">Like</div>
</form>

            <form action="" method="post">
    <input type="hidden" name="action" value="dislike">
    <input type="hidden" name="unique_id" value="<?php echo $uniqueId; ?>">
    <button type="submit"><i class="fas fa-thumbs-down text-2xl iconss ml-2"></i></button>
    <div class="text-lg font-bold">Dislike</div>

</form>

<button id="reportBtn"><i class="fas fa-flag text-2xl iconss ml-2"></i></button>
<div class="text-lg font-bold">Report</div>


            <form action="download.php" method="POST">
                <input type="hidden" name="title" value="<?php echo htmlspecialchars($title); ?>">
                <input type="hidden" name="message" value="<?php echo htmlspecialchars($messageToShow); ?>">
                <button type="submit" style="background:none; border:none; padding:0; margin:0;">
                    <i class="fas fa-download text-2xl iconss"></i>
                </button>
                <div class="text-lg font-bold">Download</div>

            </form>

            
            <form action="raw.php" method="POST" target="_blank">
                <input type="hidden" name="message" value="<?php echo htmlspecialchars($messageToShow); ?>">
                <button type="submit" style="background:none; border:none; padding:0; margin:0;">
                    <i class="fas fa-code text-2xl iconss"></i>
                </button>
                <div class="text-lg font-bold">Raw</div>
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
<script>
document.getElementById('reportBtn').addEventListener('click', function() {
    if (<?php echo json_encode(isset($_SESSION['loggedin']) && $_SESSION['loggedin']); ?>) {
        document.getElementById('reportForm').uniqueId.value = "<?php echo $uniqueId; ?>";
        document.getElementById('reportModal').classList.remove('hidden');
    } else {
        alert("You must be logged in to report.");
    }
});
</script>



<div style="color: #FFF !important">
<?php require('includes/footer.php') ?>

</div>
</html>