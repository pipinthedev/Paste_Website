<?php
require 'server/connect.php'; 
require 'includes/functions.php';

$pastes = [];
$stmt = $conn->prepare("SELECT unique_id, paste_title, created_at FROM paste WHERE visibility = 1 ORDER BY created_at DESC LIMIT 10");
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
<body class="bg-black text-white">
    <div class="flex flex-col items-center justify-center min-h-screen">
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-300"> <!-- Adjusted width here -->
            <h2 class="text-2xl font-bold mb-6 text-center">Recent Pastes</h2>
            <div class="overflow-auto">
                <table class="w-full">
                    <thead class="text-pink-600">
                        <tr>
                            <th class="text-left py-2 px-3">Title</th>
                            <th class="text-left py-2 px-3">Title</th>
                            <th class="text-left py-2 px-3">Title</th>
                            <th class="text-left py-2 px-3">Title</th>
                            <th class="text-left py-2 px-3">Title</th>
                            <th class="text-left py-2 px-3">Created Time</th>
                        </tr>
                    </thead>
                    <tbody class="border-t border-pink-600">
                        <?php foreach ($pastes as $index => $paste): ?>
                            <a href="view.php?unique_id=<?php echo htmlspecialchars($paste['unique_id']); ?>">
                            <tr class="hover:bg-gray-700">
                                <td class="py-2 px-3">
                                    <a href="view.php?unique_id=<?php echo htmlspecialchars($paste['unique_id']); ?>" class="text-blue-400 hover:text-blue-300">
                                        <?php echo htmlspecialchars($paste['paste_title']); ?>
                                    </a>
                                </td>
                                <td class="py-2 px-3">
                                   testing
                                </td>
                                <td class="py-2 px-3">
                                   testing
                                </td>
                                <td class="py-2 px-3">
                                   testing
                                </td>
                                <td class="py-2 px-3">
                                   testing
                                </td>
                                <td class="py-2 px-3 text-gray-400 text-sm">
                                    <?php echo time_elapsed_string($paste['created_at']); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </a>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>









