<?php
require('../server/connect.php');


$sql = "SELECT * FROM site_settings WHERE id = 1";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $shopName = $row['site_name'];
} else {
    $shopName = "site Name Not Found"; 
}

echo $shopName;


mysqli_close($conn);
?>