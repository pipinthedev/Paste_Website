<?php
require 'server/connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    $pasteId = $_POST['uniqueId'];
    $reason = $_POST['reason'];
    $userId = $_SESSION['id'];

    $stmt = $conn->prepare("INSERT INTO reports (paste_id, report_reason, user_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $pasteId, $reason, $userId);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Paste has been reported to the site admin.";
    } else {
        $_SESSION['message'] = "Error reporting the paste.";
    }
    $stmt->close();
    $conn->close();

    header("Location: view.php?unique_id=" . $pasteId);
    exit;
}
?>
