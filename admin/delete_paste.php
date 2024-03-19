<?php
require '../server/connect.php';
session_start();


if (!isset ($_SESSION['id'])) {
    $_SESSION['message'] = 'You must be logged in to perform this action.';
    header('Location: manage_paste.php');
    exit;
}

$userId = $_SESSION['id'];
$stmt = $conn->prepare("SELECT is_admin FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

if ($result['is_admin'] != 1) {
    $_SESSION['message'] = 'You do not have permission to perform this action.';
    header('Location: manage_paste.php');
    exit;
}


if (isset ($_GET['unique_id'])) {
    $uniqueId = $_GET['unique_id'];


    $stmt = $conn->prepare("DELETE FROM paste WHERE unique_id = ?");
    $stmt->bind_param("s", $uniqueId);


    if ($stmt->execute()) {
        $_SESSION['message'] = "Paste successfully deleted.";
    } else {
        $_SESSION['message'] = "An error occurred while deleting the paste.";
    }

    $stmt->close();
} else {
    $_SESSION['message'] = "No paste ID provided.";
}

$conn->close();


header('Location: manage_paste.php');
exit;
?>