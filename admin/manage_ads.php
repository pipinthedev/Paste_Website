<?php
require '../server/connect.php';
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
    exit;
}

$userId = $_SESSION['id'];
$stmt = $conn->prepare("SELECT is_admin FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

if ($result['is_admin'] != 1) {
    header('Location: ../index.php');
    exit;
}

$message = $_SESSION['message'] ?? null;
unset($_SESSION['message']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    $id = $_POST['id'] ?? '';
    $img = $_POST['img'] ?? '';
    $url = $_POST['url'] ?? '';
    $owner = $_POST['owner'] ?? '';
    $expiry_at = $_POST['expiry_at'] ?? '';

    if ($action == 'add') {
        $stmt = $conn->prepare("INSERT INTO ads (img, url, owner, expiry_at) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $img, $url, $owner, $expiry_at);
        if ($stmt->execute()) {
            $message = "Ad added successfully.";
        } else {
            $message = "Error adding ad.";
        }
    } elseif ($action == 'update') {
        $stmt = $conn->prepare("UPDATE ads SET img = ?, url = ?, owner = ?, expiry_at = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $img, $url, $owner, $expiry_at, $id);
        if ($stmt->execute()) {
            $message = "Ad updated successfully.";
        } else {
            $message = "Error updating ad.";
        }
    } elseif ($action == 'delete') {
        $stmt = $conn->prepare("DELETE FROM ads WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $message = "Ad deleted successfully.";
        } else {
            $message = "Error deleting ad.";
        }
    }
    $stmt->close();
}

$ads = [];
$result = $conn->query("SELECT * FROM ads ORDER BY expiry_at DESC");
while ($row = $result->fetch_assoc()) {
    $ads[] = $row;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Image Submission</title>
    <style>
     .input-field {
            background-color: #2D2D2D;
            color: white;
        }
        .table-bg {
            background-color: #3D3D3D;
            color: white;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            setTimeout(function() {
                const alertBox = document.getElementById("alert");
                if (alertBox) {
                    alertBox.style.display = "none";
                }
            }, 5000);
        });
    </script>
</head>
<?php require('navbar.php') ?>
<body class="bg-gray-100" style="background-color: #121212;">
<div class="container mx-auto p-4">
<div class="text-center sm:text-right mt-4 sm:mt-0">
       <a href="manage_reports.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-2 mb-2 sm:mb-0 sm:mx-0">
        Manage Reports
    </a>
    <a href="manage_users.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-2 mb-2 sm:mb-0 sm:mx-0">
        Manage users
    </a>
    <a href="manage_settings.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-2 mb-2 sm:mb-0 sm:mx-0">
        Manage settings
    </a>
    <a href="manage_paste.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-2 mb-2 sm:mb-0 sm:mx-0">
        Manage Paste
    </a>

    <a href="settings.php" class="mt-2 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-2 mb-2 sm:mb-0 sm:mx-0">
        Back
    </a>


</div>
<?php if ($message): ?>
        <div id="message-alert" class="bg-green-500 text-center p-2 rounded mb-4 text-white">
            <?= htmlspecialchars($message); ?>
        </div>
        <script>
            setTimeout(() => {
                const alertBox = document.getElementById('message-alert');
                if (alertBox) {
                    alertBox.style.display = 'none';
                }
            }, 3000);
        </script>
        <?php endif; ?>
        <div class="flex flex-wrap -mx-2 mt-2">
            <div class="w-full md:w-1/2 px-2 mb-4">
                <form action="" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" style="background-color: #1e1e1f  !important; color: #FFF !important;">
                    <input type="hidden" name="action" value="add">
                    <div class="mb-4">
                        <label class="block text-white text-sm font-bold mb-2" for="img">
                            Image URL
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="img" name="img" type="text" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-white text-sm font-bold mb-2" for="url">
                            External URL
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="url" name="url" type="text" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-white text-sm font-bold mb-2" for="owner">
                            Owner
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="owner" name="owner" type="text" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-white text-sm font-bold mb-2" for="expiry_at">
                            Expiry Date
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="expiry_at" name="expiry_at" type="datetime-local" required>
                    </div>
                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Add Ad
                        </button>
                    </div>
                </form>
            </div>
            <div class="w-full md:w-1/2 px-2 mt-2">
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" style="background-color: #1e1e1f !important; color: #fff !important;">
                    <h2 class="text-xl mb-4">Ads</h2>
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full" style="background-color: #1e1e1f !important; color: #fff !important;">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Image</th>
                                    <th class="px-4 py-2">URL</th>
                                    <th class="px-4 py-2">Owner</th>
                                    <th class="px-4 py-2">Expiry</th>
                                    <th class="px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ads as $ad): ?>
                                    <tr>
                                        <td class="border px-4 py-2"><?= $ad['img']; ?></td>
                                        <td class="border px-4 py-2"><?= $ad['url']; ?></td>
                                        <td class="border px-4 py-2"><?= $ad['owner']; ?></td>
                                        <td class="border px-4 py-2"><?= $ad['expiry_at']; ?></td>
                                        <td class="border px-4 py-2">
                                            <form action="" method="post" onsubmit="return confirm('Are you sure?');">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="id" value="<?= $ad['id']; ?>">
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
