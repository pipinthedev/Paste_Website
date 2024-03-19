<?php
require '../server/connect.php';
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
    exit;
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);



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

$search = $_GET['search'] ?? '';
$pastesPerPage = 25;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $pastesPerPage;

$query = "SELECT unique_id, paste_title, paste_by, visibility, likes, dislikes, views, created_at FROM paste WHERE paste_title LIKE ? ORDER BY created_at DESC LIMIT ?, ?";
$stmt = $conn->prepare($query);
$searchTerm = '%' . $search . '%';
$stmt->bind_param('sii', $searchTerm, $start, $pastesPerPage);
$stmt->execute();
$result = $stmt->get_result();

$pastes = [];
while ($row = $result->fetch_assoc()) {
    $pastes[] = $row;
}

$countQuery = "SELECT COUNT(unique_id) AS totalPastes FROM paste WHERE paste_title LIKE ?";
$countStmt = $conn->prepare($countQuery);
$countStmt->bind_param('s', $searchTerm);
$countStmt->execute();
$countResult = $countStmt->get_result()->fetch_assoc();
$totalPastes = $countResult['totalPastes'];
$totalPages = ceil($totalPastes / $pastesPerPage);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Pastes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head><?php require('navbar.php') ?>
<body class="bg-gray-800 text-white" style="background-color: #121212;">

    <div class="container mx-auto p-4">
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
        <div class="text-center sm:text-right mt-4 sm:mt-0">
       <a href="manage_reports.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-2 mb-2 sm:mb-0 sm:mx-0">
        Manage Reports
    </a>
    <a href="manage_settings.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-2 mb-2 sm:mb-0 sm:mx-0">
        Manage settings
    </a>
    <a href="manage_ads.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-2 mb-2 sm:mb-0 sm:mx-0">
        Manage ads
    </a>
    <a href="manage_users.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-2 mb-2 sm:mb-0 sm:mx-0">
        Manage users
    </a>


</div>
        <div class="flex justify-center mb-4">
            <form action="" method="get" class="w-full max-w-xl">
                <div class="flex items-center py-2">
                    <input class="appearance-none bg-transparent border-b border-teal-500 w-full text-white py-1 px-2 leading-tight focus:outline-none" type="text" name="search" placeholder="Search pastes..." value="<?= htmlspecialchars($search); ?>">
                    <button class="ml-3 bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded" type="submit">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto bg-gray-700 rounded-lg">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-800 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-800 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Paste By</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-800 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Visibility</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-800 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Likes</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-800 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Dislikes</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-800 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Views</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-800 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Created At</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-800 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pastes as $paste): ?>
                    <tr class="bg-gray-800 border-b border-gray-700">
                        <td class="px-5 py-5 text-sm"><?= htmlspecialchars($paste['paste_title']); ?></td>
                        <td class="px-5 py-5 text-sm"><?= htmlspecialchars($paste['paste_by']); ?></td>
                        <td class="px-5 py-5 text-sm"><?= htmlspecialchars($paste['visibility']); ?></td>
                        <td class="px-5 py-5 text-sm"><?= htmlspecialchars($paste['likes']); ?></td>
                        <td class="px-5 py-5 text-sm"><?= htmlspecialchars($paste['dislikes']); ?></td>
                        <td class="px-5 py-5 text-sm"><?= htmlspecialchars($paste['views']); ?></td>
                        <td class="px-5 py-5 text-sm"><?= $paste['created_at']; ?></td>
                        <td class="px-5 py-5 text-sm">
                            <a href="../view.php?unique_id=<?= $paste['unique_id']; ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">View Paste</a>
                            <a href="delete_paste.php?unique_id=<?= $paste['unique_id']; ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('Are you sure you want to delete this paste?');">Delete Paste</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="flex justify-center mt-4">
        <div class="inline-flex">
            <a href="?page=1&search=<?= urlencode($search); ?>" class="bg-gray-500 text-white py-2 px-4 rounded-l">Start</a>
            <a href="?page=<?= max(1, $page - 1); ?>&search=<?= urlencode($search); ?>" class="bg-gray-500 text-white py-2 px-4">Previous</a>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i; ?>&search=<?= urlencode($search); ?>" class="bg-gray-500 text-white py-2 px-4 <?= $page == $i ? 'bg-gray-700' : ''; ?>"><?= $i; ?></a>
            <?php endfor; ?>
            <a href="?page=<?= min($totalPages, $page + 1); ?>&search=<?= urlencode($search); ?>" class="bg-gray-500 text-white py-2 px-4">Next</a>
            <a href="?page=<?= $totalPages; ?>&search=<?= urlencode($search); ?>" class="bg-gray-500 text-white py-2 px-4 rounded-r">End</a>
        </div>
    </div>
</div>
</body>
</html>
