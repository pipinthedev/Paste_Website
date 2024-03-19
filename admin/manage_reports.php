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

$search = $_GET['search'] ?? '';
$reportsPerPage = 25;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $reportsPerPage;

$query = "SELECT reports.id, reports.paste_id, reports.user_id, reports.report_reason, reports.reported_at, users.username 
          FROM reports 
          JOIN users ON reports.user_id = users.id
          WHERE (reports.user_id LIKE ? OR reports.report_reason LIKE ? OR reports.paste_id LIKE ?) 
          AND reports.status = 0 
          ORDER BY reports.reported_at DESC 
          LIMIT ?, ?";

$stmt = $conn->prepare($query);
$searchTerm = '%' . $search . '%';
$stmt->bind_param('sssii', $searchTerm, $searchTerm, $searchTerm, $start, $reportsPerPage);
$stmt->execute();
$result = $stmt->get_result();

$reports = [];
while ($row = $result->fetch_assoc()) {
    $reports[] = $row;
}

$countQuery = "SELECT COUNT(reports.id) AS totalReports FROM reports 
               LEFT JOIN users ON reports.user_id = users.id
               WHERE (reports.user_id LIKE ? OR reports.report_reason LIKE ? OR reports.paste_id LIKE ?) AND reports.status = 0";
$countStmt = $conn->prepare($countQuery);
$countStmt->bind_param('sss', $searchTerm, $searchTerm, $searchTerm);
$countStmt->execute();
$countResult = $countStmt->get_result()->fetch_assoc();
$totalReports = $countResult['totalReports'];
$totalPages = ceil($totalReports / $reportsPerPage);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head><?php require('navbar.php') ?>
<body class="bg-gray-800 text-white"  style="background-color: #121212;">
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
<div class="container mx-auto p-4">
<div class="text-center sm:text-right mt-4 sm:mt-0">
       <a href="manage_ads.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-2 mb-2 sm:mb-0 sm:mx-0">
        Manage ads
    </a>
    <a href="manage_settings.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-2 mb-2 sm:mb-0 sm:mx-0">
        Manage settings
    </a>
    <a href="manage_paste.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-2 mb-2 sm:mb-0 sm:mx-0">
        Manage Paste
    </a>
    <a href="manage_users.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-2 mb-2 sm:mb-0 sm:mx-0">
        Manage users
    </a>


</div>
<div class="flex justify-center mb-4 mt-4">
        <form action="" method="get" class="w-full max-w-sm">
            <div class="flex items-center border-b border-teal-500 py-2">
                <input class="appearance-none bg-transparent border-none w-full text-white mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" name="search" placeholder="Search report..." aria-label="Search report" value="<?= htmlspecialchars($search); ?>">
                <button class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
                    Search
                </button>
            </div>
        </form>
    </div>
    <div class="overflow-x-auto">
        <table class="table-auto w-full bg-gray-700 rounded-lg">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Paste ID</th>
                    <th class="px-4 py-2">User ID</th>
                    <th class="px-4 py-2">UserName</th>
                    <th class="px-4 py-2">Report Reason</th>
                    <th class="px-4 py-2">Reported At</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reports as $report): ?>
                <tr>
                    <td class="border px-4 py-2"><?= $report['id']; ?></td>
                    <td class="border px-4 py-2"><?= $report['paste_id']; ?></td>
                    <td class="border px-4 py-2"><?= $report['user_id']; ?></td>
                    <td class="border px-4 py-2"><?= htmlspecialchars($report['username']); ?></td>
                    <td class="border px-4 py-2"><?= $report['report_reason']; ?></td>
                    <td class="border px-4 py-2"><?= $report['reported_at']; ?></td>
                    <td class="border px-4 py-2">
                        <a href="../view.php?unique_id=<?= $report['paste_id']; ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">View Paste</a>
                        <a href="delete_report.php?report_id=<?= $report['id']; ?>&paste_id=<?= $report['paste_id']; ?>" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete Paste</a>
                        <a href="complete_report.php?report_id=<?= $report['id']; ?>" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Mark Complete</a>
                        <a href="reject_report.php?report_id=<?= $report['id']; ?>" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Ignore report</a>
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
