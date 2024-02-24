<?php

if (!empty($_POST['title']) && !empty($_POST['message'])) {
    $title = preg_replace('/[^A-Za-z0-9\-]/', '', $_POST['title']);
    $message = $_POST['message'];
    $filename = $title . ".txt";

    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    echo $message;
    exit;
} else {

    echo "Required data is missing.";
    exit;
}
?>