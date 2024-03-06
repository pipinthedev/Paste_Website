<?php
require '../server/connect.php';
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$userId = $_SESSION['id'];

$stmt = $conn->prepare("SELECT * FROM paste WHERE paste_by = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$pastes = [];
while ($row = $result->fetch_assoc()) {
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <style>
        .dark-bg {
            background-color: #121212;
            /* Dark background */
        }

        @media (max-width: 640px) {
            .hidden-xs {
                display: none !important;
            }
        }

    </style>
</head>
<?php require('../includes/navbar.php') ?>

<body class="dark-bg">
    <div class="container mx-auto mt-8">
        <div class="mb-4 text-right">
        <a style="margin-right: 10px !important;" href="settings.php"
                class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Settings
            </a>
            <a style="margin-right: 10px !important;" href="settings.php"
                class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Manage Account
            </a>
            <a href="dashboard.php"
                class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Go Back
            </a>
            
            
        </div>
        
        <div class="text-white shadow-md rounded px-8 pt-6 pb-8 mb-4 overflow-hidden"
            style="background-color: #1e1e1f !important; color: #FFF !important;">
            <center>
                <h2 class="block text-gray-700 text-lg font-bold mb-2" style="color: #FFF !important;">My Pastes</h2>
            </center>
            <div class="overflow-x-auto mt-6">
                <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2  border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Title
                        </th>
                        <th class="px-5 py-3 border-b-2  border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Visibility
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden-xs">
                            Paste expiry
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Views
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden-xs">
                            Likes
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden-xs">
                            Dislikes
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden-xs">
                            Date Created
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                    <tbody style="background-color: #1e1e1f !important;">
                        <?php foreach ($pastes as $paste): ?>
                            <tr>
                                <td class="px-5 py-5 border-gray-200 bg-white text-sm"
                                    style="background-color: #1e1e1f !important;">
                                    <?php echo htmlspecialchars($paste['paste_title']); ?>
                                </td>
                                <td class="px-5 py-5 border-gray-200 bg-white text-sm"
                                    style="background-color: #1e1e1f !important;">
                                    <?php
                                    $visi = $paste['visibility'];
                                    switch ($visi) {
                                        case 0:
                                            echo "Public";
                                            break;

                                        case 1:
                                            echo "Private";
                                            break;

                                        default:
                                            echo "Not found!";
                                            break;
                                    }
                                    ?>
                                </td>

                                <td class="px-5 py-5 border-gray-200 bg-white text-sm"
                                    style="background-color: #1e1e1f !important;">
                                    <?php echo htmlspecialchars($paste['paste_expiry']); ?>
                                </td>
                                <td class="px-5 py-5 border-gray-200 bg-white text-sm"
                                    style="background-color: #1e1e1f !important;">
                                    <?php echo htmlspecialchars($paste['views']); ?>
                                </td>
                                <td class="px-5 py-5 border-gray-200 bg-white text-sm"
                                    style="background-color: #1e1e1f !important;">
                                    <?php echo htmlspecialchars($paste['likes']); ?>
                                </td>
                                <td class="px-5 py-5 border-gray-200 bg-white text-sm"
                                    style="background-color: #1e1e1f !important;">
                                    <?php echo htmlspecialchars($paste['dislikes']); ?>
                                </td>

                                <td class="px-5 py-5 border-gray-200 bg-white text-sm"
                                    style="background-color: #1e1e1f !important;">
                                    <?php echo htmlspecialchars($paste['created_at']); ?>
                                </td>
                                <td class="px-5 py-5 border-gray-200 bg-white text-sm text-right"
                                    style="background-color: #1e1e1f !important;">
                                    <!-- View Icon -->
                                    <a href="../view.php?unique_id=<?php echo htmlspecialchars($paste['unique_id']); ?>"
                                        class="mr-4">
                                        <i class="fas fa-eye text-blue-600 hover:text-blue-900"></i>
                                    </a>

                                    <!-- Delete Icon -->
                                    <a href="delete_paste.php?unique_id=<?php echo htmlspecialchars($paste['unique_id']); ?>"
                                        onclick="return confirm('Are you sure you want to delete this paste?');">
                                        <i class="fas fa-trash-alt text-red-600 hover:text-red-900"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require('../includes/footer.php') ?>

</body>

</html>