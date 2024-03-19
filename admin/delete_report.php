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

if (isset($_GET['report_id']) && isset($_GET['paste_id'])) {
    $reportId = $_GET['report_id'];
    $pasteId = $_GET['paste_id'];

    $stmt = $conn->prepare("DELETE FROM paste WHERE unique_id = ?");
    $stmt->bind_param("s", $pasteId);
    if ($stmt->execute()) {
        $stmt = $conn->prepare("DELETE FROM reports WHERE id = ?");
        $stmt->bind_param("i", $reportId);
        $stmt->execute();
        $_SESSION['message'] = "Paste and report deleted successfully.";
    } else {
        $_SESSION['message'] = "Error deleting paste.";
    }
    $stmt->close();
} else {
    $_SESSION['message'] = "Invalid request.";
}

header('Location: manage_reports.php');
exit;
?>
