<?php
require '../server/connect.php';
session_start();

// Redirect to login page if user is not logged in
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$userId = $_SESSION['id'];

$stmt = $conn->prepare("SELECT unique_id, paste_title, created_at FROM paste WHERE paste_by = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$pastes = [];
while($row = $result->fetch_assoc()) {
    $pastes[] = $row;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Pastes</title>
    
    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" rel="stylesheet">
    <style>
        .dark-bg {
            background-color: #121212; /* Dark background */
        }
</style>
</head>
<?php require('../includes/navbar.php') ?>
<body class="dark-bg">
    <div class="container mx-auto mt-8">
        <div class="mb-4 text-right">
            <a href="dashboard.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Go Back
            </a>
        </div>
        <div class="text-white shadow-md rounded px-8 pt-6 pb-8 mb-4 overflow-hidden" style="background-color: #1e1e1f !important; color: #FFF !important;">
        <center>
            <h2 class="block text-gray-700 text-lg font-bold mb-2" style="color: #FFF !important;">My Pastes</h2>
    </center>
            <div class="overflow-x-auto mt-6" >
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr >
                        <th  style="background-color: #1e1e1f !important;" class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100">Title</th>
                            <th  style="background-color: #1e1e1f !important;" class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100">Date Created</th>
                            <th  style="background-color: #1e1e1f !important;" class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100">Action</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #1e1e1f !important;" >
                        <?php foreach($pastes as $paste): ?>
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"  style="background-color: #1e1e1f !important;" >
                                <?php echo htmlspecialchars($paste['paste_title']); ?>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"  style="background-color: #1e1e1f !important;">
                                <?php echo htmlspecialchars($paste['created_at']); ?>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right"  style="background-color: #1e1e1f !important;">
                              <i class="fa fa-pencil" aria-hidden="true">
  <a href="view.php?unique_id=<?php echo htmlspecialchars($paste['unique_id']); ?>" class="text-blue-600 hover:text-blue-900 mr-4"></a></i>
                                <a href="delete_paste.php?unique_id=<?php echo htmlspecialchars($paste['unique_id']); ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this paste?');">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<script>
</script>
</body>
</html>
