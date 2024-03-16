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
        $_SESSION['message'] = "Image information saved successfully.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error: Could not save the data.";
        $_SESSION['message_type'] = "error";
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'updateAd') {
    $id = $_POST['id'];
    $img = $_POST['image'];
    $url = $_POST['url'];
    $owner = $_POST['owner'];
    $expiry_at = $_POST['expiry_at'];

    $stmt = $conn->prepare("UPDATE images SET img = ?, url = ?, owner = ?, expiry_at = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $img, $url, $owner, $expiry_at, $id);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Image information saved successfully.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error: Could not save the data.";
        $_SESSION['message_type'] = "error";
    }
    $stmt->close();
    $conn->close();
    exit;
}

$ads = [];
$query = "SELECT * FROM ads ORDER BY expiry_at DESC";
$result = $conn->query($query);
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
<?php require('../includes/navbar.php') ?>
<body class="bg-gray-100" style="background-color: #121212;">
    <div class="container mx-auto px-4 py-8">
        <?php if (isset($_SESSION['message'])): ?>
            <div id="alert" class="bg-<?php echo $_SESSION['message_type'] == 'success' ? 'green' : 'red'; ?>-500 text-white px-6 py-4 border-0 rounded relative mb-4">
                <?php echo $_SESSION['message']; ?>
            </div>
            <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
        <?php endif; ?>
        <div class="flex justify-center">
            <div class="w-full max-w-lg">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" style="background-color: #1e1e1f;">
                <h1 class="text-xl font-bold mb-4 text-white text-center">Manage ads</h1>    
                <div class="mb-4">
                        <label for="image" class="block text-white text-sm font-bold mb-2">Image URL:</label>
                        <input type="text" id="image" name="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label for="url" class="block text-white text-sm font-bold mb-2">External URL:</label>
                        <input type="text" id="url" name="url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label for="owner" class="block text-white text-sm font-bold mb-2">Owner:</label>
                        <input type="text" id="owner" name="owner" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label for="expiry_at" class="block text-white text-sm font-bold mb-2">Expiry Date:</label>
                        <input type="datetime-local" id="expiry_at" name="expiry_at" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="flex justify-center mt-6">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Create ad
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-8">
            <h2 class="text-lg font-bold mb-4 text-white">Ads Management</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Image</th>
                            <th class="py-3 px-6 text-left">URL</th>
                            <th class="py-3 px-6 text-center">Owner</th>
                            <th class="py-3 px-6 text-center">Expiry Date</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <?php foreach ($ads as $ad): ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="font-medium"><?php echo $ad['img']; ?></span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span><?php echo $ad['url']; ?></span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <span><?php echo $ad['owner']; ?></span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <span><?php echo $ad['expiry_at']; ?></span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <a href="edit_ad.php?id=<?php echo $ad['id']; ?>">Edit</a>
                                    </div>
                                    <div class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                        <a href="delete_ad.php?id=<?php echo $ad['id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
// Function to open the modal and populate it with the ad's current data
function openEditModal(id, img, url, owner, expiry_at) {
  document.getElementById('editId').value = id;
  document.getElementById('editImg').value = img;
  document.getElementById('editUrl').value = url;
  document.getElementById('editOwner').value = owner;
  document.getElementById('editExpiryAt').value = expiry_at;
  document.getElementById('editModal').classList.remove('hidden');
}

// Function to close the modal
function closeModal() {
  document.getElementById('editModal').classList.add('hidden');
}

// Save changes
document.getElementById('saveEdit').addEventListener('click', function() {
  const id = document.getElementById('editId').value;
  const img = document.getElementById('editImg').value;
  const url = document.getElementById('editUrl').value;
  const owner = document.getElementById('editOwner').value;
  const expiry_at = document.getElementById('editExpiryAt').value;

  const formData = new FormData();
  formData.append('action', 'updateAd');
  formData.append('id', id);
  formData.append('image', img);
  formData.append('url', url);
  formData.append('owner', owner);
  formData.append('expiry_at', expiry_at);

  fetch('path_to_your_php_file_handling_the_post_request', { // Adjust the fetch path as needed
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    alert(data); // Alert the response from the server
    closeModal(); // Close the modal
    // Optionally, refresh the page or part of it to show the updated data
  })
  .catch((error) => {
    console.error('Error:', error);
  });
});

document.querySelector('.closeModal').addEventListener('click', closeModal);
</script>
</body>
</html>
