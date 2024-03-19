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

if (isset($_GET['report_id'])) {
    $reportId = $_GET['report_id'];

    $stmt = $conn->prepare("UPDATE reports SET status = 1 WHERE id = ?");
    $stmt->bind_param("i", $reportId);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Report marked as completed.";
    } else {
        $_SESSION['message'] = "Error updating report status.";
    }
    $stmt->close();
} else {
    $_SESSION['message'] = "Invalid request.";
}

header('Location: manage_reports.php');
exit;
?>
