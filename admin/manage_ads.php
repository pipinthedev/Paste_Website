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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $img = $_POST['image'];
    $url = $_POST['url'];
    $owner = $_POST['owner'];
    $expiry_at = $_POST['expiry_at'];

    $query = "INSERT INTO images (img, url, owner, expiry_at) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $img, $url, $owner, $expiry_at);
    
    if ($stmt->execute()) {
        echo "<p>Image information saved successfully.</p>";
    } else {
        echo "<p>Error: Could not save the data.</p>";
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Image Information</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<?php require('../includes/navbar.php') ?>
<body class="bg-gray-100" style="background-color: #121212;">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden md:max-w-lg">
            <div class="md:flex">
                <div class="w-full p-3">
                    <h1 class="text-lg font-bold">Submit Image Information</h1>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="mb-4">
                            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image URL:</label>
                            <input type="text" id="image" name="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="url" class="block text-gray-700 text-sm font-bold mb-2">External URL:</label>
                            <input type="text" id="url" name="url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="owner" class="block text-gray-700 text-sm font-bold mb-2">Owner:</label>
                            <input type="text" id="owner" name="owner" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label for="expiry_at" class="block text-gray-700 text-sm font-bold mb-2">Expiry Date:</label>
                            <input type="datetime-local" id="expiry_at" name="expiry_at" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
