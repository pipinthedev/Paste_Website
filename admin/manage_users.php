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
$usersPerPage = 25;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$search = isset($_GET['search']) ? $_GET['search'] : '';

$start = ($page - 1) * $usersPerPage;
$query = "SELECT username, usergroup, total_views, is_banned, is_admin FROM users WHERE username LIKE ? ORDER BY username LIMIT ?, ?";
$stmt = $conn->prepare($query);
$searchTerm = '%' . $search . '%';
$stmt->bind_param("sii", $searchTerm, $start, $usersPerPage);
$stmt->execute();
$result = $stmt->get_result();

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

$countQuery = "SELECT COUNT(id) AS totalUsers FROM users WHERE username LIKE ?";
$countStmt = $conn->prepare($countQuery);
$countStmt->bind_param("s", $searchTerm);
$countStmt->execute();
$countResult = $countStmt->get_result()->fetch_assoc();
$totalUsers = $countResult['totalUsers'];
$totalPages = ceil($totalUsers / $usersPerPage);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .input-field, .table-bg {
            background-color: #2D2D2D;
            color: white;
        }
    </style>
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
    <a href="manage_paste.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-2 mb-2 sm:mb-0 sm:mx-0">
        Manage Paste
    </a>


</div>
    <div class="flex justify-center mb-4 mt-4">
        <form action="" method="get" class="w-full max-w-sm">
            <div class="flex items-center border-b border-teal-500 py-2">
                <input class="appearance-none bg-transparent border-none w-full text-white mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" name="search" placeholder="Search users..." aria-label="Search users" value="<?= htmlspecialchars($search); ?>">
                <button class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
                    Search
                </button>
            </div>
        </form>
    </div>
    <div class="overflow-x-auto bg-gray-700 rounded-lg">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-800 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Username</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-800 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Usergroup</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-800 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Views</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-800 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Is Banned</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-800 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Is Admin</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr class="bg-gray-800 border-b border-gray-700">
                    <td class="px-5 py-5 text-sm"><?= htmlspecialchars($user['username']); ?></td>
                    <td class="px-5 py-5 text-sm"><?= htmlspecialchars($user['usergroup']); ?></td>
                    <td class="px-5 py-5 text-sm"><?= htmlspecialchars($user['total_views']); ?></td>
                    <td class="px-5 py-5 text-sm"><?= $user['is_banned'] ? 'Yes' : 'No'; ?></td>
                    <td class="px-5 py-5 text-sm"><?= $user['is_admin'] ? 'Yes' : 'No'; ?></td>
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