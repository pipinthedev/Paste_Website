<?php
require 'server/connect.php';
require 'includes/functions.php';



if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['message'])) {
    $original_message = trim($_POST['message']);
    $visibility = ($_POST['visibility'] == 'public') ? 1 : 0;
    $password = !empty($_POST['password']) ? hashPassword($_POST['password']) : NULL;
    $expiry = calculateExpiry($_POST['expiry']);
    $title = trim($_POST['title']);

    $encrypted_message = encryptMessage($original_message, $secret_key, $secret_iv, $encrypt_method);
    $uniqueId = generateUniqueId(5);

    $stmt = $conn->prepare("INSERT INTO paste (unique_id, message, visibility, paste_password, paste_expiry, paste_title) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $uniqueId, $encrypted_message, $visibility, $password, $expiry, $title);
    $stmt->execute();

    $stmt->close();
    
    header('Location: ' . $_SERVER['PHP_SELF'] . '?success=1&unique_id=' . $uniqueId);
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Encrypted Message Form with Unique ID</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex justify-center items-center h-screen bg-gray-100">
<?php require_once('./includes/navbar.php'); ?>
    <div class="w-full max-w-md">
        <?php if(isset($_GET['success'])): ?>
            <p class="text-green-500">Message saved successfully with Unique ID: <?php echo htmlspecialchars($_GET['unique_id']); ?></p>
        <?php endif; ?>
        <form method="post" action="" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                    Title
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" name="title" placeholder="Paste Title">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="message">
                    Message
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="message" name="message" rows="4" placeholder="Enter your message here"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="visibility">
                    Visibility
                </label>
                <select class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="visibility" name="visibility">
                    <option value="public">Public</option>
                    <option value="private">Private</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password (Optional)
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" name="password" placeholder="Password">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="expiry">
                    Expiry Time
                </label>
                <select class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="expiry" name="expiry">
                    <option value="">No Expiry</option>
                    <option value="1_hour">1 Hour</option>
                    <option value="1_day">1 Day</option>
                    <option value="1_week">1 Week</option>
                    <option value="1_month">1 Month</option>
                    <option value="1_year">1 Year</option>
                    <option value="10_years">10 Years</option>
                </select>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Submit
                </button>
            </div>
        </form>
    </div>
</body>
</html>