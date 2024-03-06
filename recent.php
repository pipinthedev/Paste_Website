<?php
require 'server/connect.php';
require 'includes/functions.php';

$pastes = [];
$stmt = $conn->prepare("
    SELECT p.unique_id, p.paste_title, p.created_at, p.likes, p.dislikes, p.views, 
           CASE WHEN p.paste_by = 0 THEN 'Anonymous' ELSE u.username END AS username
    FROM paste p
    LEFT JOIN users u ON p.paste_by = u.id
    WHERE p.visibility = 1
    ORDER BY p.created_at DESC 
    LIMIT 10
");

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
    <title>Recent Pastes</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<?php require('includes/navbar.php') ?>

<body class="bg-black text-white" style="background-color: #121213 !important;">
    <div class="flex flex-col items-center justify-center min-h-screen">
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg" style="width: 90%; max-width: 1200px; margin: auto; background-color: #212123 !important;">
            <h2 class="text-2xl font-bold mb-6 text-center">Recent Pastes</h2>
            <div class="overflow-auto">
                <table class="w-full">
                    <thead class="text-pink-600">
                        <tr>
                            <th class="text-left py-2 px-3">Title</th>
                            <th class="text-left py-2 px-3">Pasted By</th>
                            <th class="text-left py-2 px-3">Likes</th>
                            <th class="text-left py-2 px-3">Dislikes</th>
                            <th class="text-left py-2 px-3">Views</th>
                            <th class="text-left py-2 px-3">Created Time</th>
                        </tr>
                    </thead>
                    <tbody class="border-t border-pink-600">
                        <?php foreach ($pastes as $paste): ?>
                            <tr class="hover:bg-gray-700 cursor-pointer" onclick="window.location='view.php?unique_id=<?php echo htmlspecialchars($paste['unique_id']); ?>'">
                                <td class="py-2 px-3"><?php echo htmlspecialchars($paste['paste_title']); ?></td>
                                <td class="py-2 px-3"><?php echo htmlspecialchars($paste['username']); ?></td>
                                <td class="py-2 px-3"><?php echo htmlspecialchars($paste['likes']); ?></td>
                                <td class="py-2 px-3"><?php echo htmlspecialchars($paste['dislikes']); ?></td>
                                <td class="py-2 px-3"><?php echo htmlspecialchars($paste['views']); ?></td>
                                <td class="py-2 px-3 text-gray-400 text-sm"><?php echo time_elapsed_string($paste['created_at']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require('includes/footer.php') ?>

</body>
</html>
