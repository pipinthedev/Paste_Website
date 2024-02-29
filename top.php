<?php
require 'server/connect.php'; 
require 'includes/functions.php';

$pastes = [];
$stmt = $conn->prepare("SELECT unique_id, paste_title, created_at, views FROM paste WHERE visibility = 1 ORDER BY views DESC LIMIT 10");
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $pastes[] = $row;
    }
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Pastes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<?php require('./includes/navbar.php') ?>
<body class="bg-black text-white"  style="background-color: #121213 !important;">
    <div class="flex flex-col items-center justify-center min-h-screen">
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg" style="width: 90%; max-width: 1200px; margin: auto; background-color: #212123  !important;"> <!-- Custom width -->
            <h2 class="text-2xl font-bold mb-6 text-center">Top Paste</h2>
            <div class="overflow-auto">
                <table class="w-full text-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-3 text-pink-600">Title</th>
                            <th class="py-2 px-3 text-pink-600">Views</th>
                            <th class="py-2 px-3 text-pink-600">Created Time</th>
                        </tr>
                    </thead>
                    <tbody class="border-t border-pink-600">
                        <?php foreach ($pastes as $paste): ?>
                            <tr class="hover:bg-gray-700 clickable-row" data-href="view.php?unique_id=<?php echo htmlspecialchars($paste['unique_id']); ?>">
                                <td class="py-2 px-3"><?php echo htmlspecialchars($paste['paste_title']); ?></td>
                                <td class="py-2 px-3"><?php echo $paste['views']; ?></td>
                                <td class="py-2 px-3 text-gray-400"><?php echo time_elapsed_string($paste['created_at']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.clickable-row').forEach(row => {
            row.addEventListener('click', () => {
                window.location.href = row.dataset.href;
            });
        });
    </script>
</body>
<?php require('includes/footer.php') ?>
</html>
