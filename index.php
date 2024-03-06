<?php
require 'server/connect.php';
require 'includes/functions.php';
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

$userLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === 1;
$pasteBy = !$userLoggedIn ? $_SESSION['id'] : $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['message'])) {
    $original_message = trim($_POST['message']);
    $visibility = ($_POST['visibility'] == 'public') ? 1 : 0;
    $password = !empty($_POST['password']) ? hashPassword($_POST['password']) : NULL;
    $expiry = calculateExpiry($_POST['expiry']);
    $title = trim($_POST['title']);

    $encrypted_message = encryptMessage($original_message, $secret_key, $secret_iv, $encrypt_method);
    $uniqueId = generateUniqueId(5);

    $stmt = $conn->prepare("INSERT INTO paste (unique_id, message, visibility, paste_password, paste_expiry, paste_title, paste_by) VALUES (?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    } else {
        $stmt->bind_param("ssisssi", $uniqueId, $encrypted_message, $visibility, $password, $expiry, $title, $pasteBy);

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        } else {
            header('Location: ' . 'view.php?unique_id=' . $uniqueId);
            exit;
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
    <title>Create New Paste</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .dark-bg {
            background-color: #121212; /* Dark background */
        }

        .text-area-bg {
            background-color: #333333; /* Darker textarea background */
            color: #ffffff; /* White text for better contrast */
        }

        .full-width {
            width: 100%; /* Ensure button is full-width */
        }

        @media (max-width: 768px) {
            .responsive-grid {
                grid-template-columns: repeat(1, minmax(0, 1fr)); /* Stack elements in a single column on smaller screens */
            }
        }
    </style>
</head>
<?php require('includes/navbar.php') ?>

<body class="dark-bg text-white">
    <div class="flex justify-center items-center min-h-screen px-4">
    <div class="w-full max-w-4xl">
        <h2 class="text-center text-xl font-bold mb-6">Create New Paste</h2>
        <form method="post" action="" class="space-y-6">
            <div>
                <label for="title" class="block text-sm font-bold mb-2">Title</label>
                <input type="text" name="title" id="title" placeholder="Paste Title"
                    class="text-area-bg shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="grid md:grid-cols-3 gap-4 responsive-grid">
                <div>
                    <label for="visibility" class="block text-sm font-bold mb-2">Visibility</label>
                    <select name="visibility" id="visibility"
                        class="text-area-bg shadow border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="public">Public</option>
                        <option value="private">Private</option>
                    </select>
                </div>
                <div>
                    <label for="password" class="block text-sm font-bold mb-2">Password (Optional)</label>
                    <input type="password" name="password" id="password" placeholder="Password"
                        class="text-area-bg shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label for="expiry" class="block text-sm font-bold mb-2">Expiry Time</label>
                    <select name="expiry" id="expiry"
                        class="text-area-bg shadow border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">No Expiry</option>
                        <option value="1_hour">1 Hour</option>
                        <option value="1_day">1 Day</option>
                        <option value="1_week">1 Week</option>
                        <option value="1_month">1 Month</option>
                        <option value="1_year">1 Year</option>
                        <option value="10_years">10 Years</option>
                    </select>
                </div>
            </div>
            <div>
                <label for="message" class="block text-sm font-bold mb-2">Message</label>
                <textarea name="message" id="message" rows="10" placeholder="Enter your message here"
                    class="text-area-bg shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline"></textarea>
            </div>
            <button type="submit"
                class="full-width bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4">Paste</button>
        </form>
    </div>
    </div>
</body>
<?php require('includes/footer.php') ?>

</html>
