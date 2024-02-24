<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['message'])) {
    header('Content-Type: text/plain; charset=utf-8');
    echo htmlspecialchars($_POST['message']);
    exit;
} else {
    echo "No message provided.";
}
?>
