<?php
session_start();
require 'server/connect.php';
require 'includes/functions.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];
$pastes = [];

$stmt = $conn->prepare("SELECT unique_id, paste_title, created_at FROM paste WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pastes[] = $row;
    }
}

$stmt->close();

if (isset($_POST['delete']) && isset($_POST['unique_id'])) {
    $uniqueId = $_POST['unique_id'];
    $stmt = $conn->prepare("DELETE FROM paste WHERE unique_id = ? AND user_id = ?");
    $stmt->bind_param("si", $uniqueId, $userId);
    $stmt->execute();
    $stmt->close();
    header("Location: mypastes.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Pastes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-black text-white">
    <div class="container mx-auto px-4">
        <h1 class="text-xl font-bold my-4">My Pastes</h1>
        <div class="overflow-auto">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Created At</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pastes as $paste): ?>
                    <tr>
                        <td class="border px-4 py-2"><?php echo htmlspecialchars($paste['paste_title']); ?></td>
                        <td class="border px-4 py-2"><?php echo $paste['created_at']; ?></td>
                        <td class="border px-4 py-2">
                            <form method="POST">
                                <input type="hidden" name="unique_id" value="<?php echo $paste['unique_id']; ?>">
                                <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this paste?');">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
