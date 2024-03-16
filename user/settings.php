<?php
require '../server/connect.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../index.php');
    exit;
}

$userId = $_SESSION['id']; 

$cracked = $patched = $nulled = $telegram = $discord = $website = '';

if ($stmt = $conn->prepare("SELECT cracked, patched, nulled, telegram, discord, website FROM users WHERE id = ?")) {
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $cracked = $row['cracked'];
        $patched = $row['patched'];
        $nulled = $row['nulled'];
        $telegram = $row['telegram'];
        $discord = $row['discord'];
        $website = $row['website'];
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cracked = htmlspecialchars($_POST['cracked']);
    $patched = htmlspecialchars($_POST['patched']);
    $nulled = htmlspecialchars($_POST['nulled']);
    $telegram = htmlspecialchars($_POST['telegram']);
    $discord = htmlspecialchars($_POST['discord']);
    $website = htmlspecialchars($_POST['website']);

    if ($stmt = $conn->prepare("UPDATE users SET cracked=?, patched=?, nulled=?, telegram=?, discord=?, website=? WHERE id=?")) {
        $stmt->bind_param("ssssssi", $cracked, $patched, $nulled, $telegram, $discord, $website, $userId);
        if ($stmt->execute()) {
            $_SESSION['message'] = "Settings updated successfully.";
        } else {
            $_SESSION['message'] = "Error updating settings.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<?php require('../includes/navbar.php') ?>
<body class="bg-gray-800 text-white" style=" background-color: #121212;">
    <div class="container mx-auto p-4 mt-12">
    <div class="mb-4 text-right">
            <a href="dashboard.php"
                class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Go Back
            </a>
            
        </div>
        <?php if(isset($_SESSION['message'])): ?>
    <div id="message-alert" class="bg-green-500 text-white px-4 py-3 rounded relative mt-2 mb-3 custom-width" role="alert">
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

        <div class="max-w-2xl mx-auto bg-gray-700 shadow-md rounded px-8 pt-6 pb-8 mb-4" style="background-color: #1e1e1f;">
            <h1 class="text-xl font-bold mb-4 text-center">User Settings</h1>
            <form action="" method="post" class="space-y-6">
                <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label for="cracked" class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2">Cracked</label>
                    <input type="text" name="cracked" id="cracked" value="<?= htmlspecialchars($cracked) ?>" class="appearance-none block w-full bg-gray-800 text-white border border-gray-800 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-600 focus:border-gray-500">
                </div>

                    <div class="w-full md:w-1/2 px-3">
                        <label for="patched" class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2">Patched</label>
                        <input type="text" name="patched" id="patched" value="<?= htmlspecialchars($patched) ?>" class="appearance-none block w-full bg-gray-800 text-white border border-gray-800 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-600 focus:border-gray-500">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="nulled" class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2">Nulled</label>
                        <input type="text" name="nulled" id="nulled" value="<?= htmlspecialchars($nulled) ?>" class="appearance-none block w-full bg-gray-800 text-white border border-gray-800 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-600 focus:border-gray-500">
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label for="telegram" class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2">Telegram</label>
                        <input type="text" name="telegram" id="telegram" value="<?= htmlspecialchars($telegram) ?>" class="appearance-none block w-full bg-gray-800 text-white border border-gray-800 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-600 focus:border-gray-500">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="discord" class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2">Discord</label>
                        <input type="text" name="discord" id="discord" value="<?= htmlspecialchars($discord) ?>" class="appearance-none block w-full bg-gray-800 text-white border border-gray-800 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-600 focus:border-gray-500">
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label for="website" class="block uppercase tracking-wide text-gray-400 text-xs font-bold mb-2">Website</label>
                        <input type="url" name="website" id="website" value="<?= htmlspecialchars($website) ?>" class="appearance-none block w-full bg-gray-800 text-white border border-gray-800 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-gray-600 focus:border-gray-500">
                    </div>
                </div>
                <div class="flex justify-center mt-6">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Save Settings</button>
                </div>
            </form>
        </div>
    </div>
    <?php require('../includes/footer.php') ?>
</body>
</html>
