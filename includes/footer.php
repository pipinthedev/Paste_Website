<?php


include __DIR__ . "/../server/connect.php";


$sql = "SELECT * FROM site_settings WHERE id = 1";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $shopName = $row['site_name'];
} else {
    $shopName = "site Name Not Found"; 
}



mysqli_close($conn);

$currentYear = date('Y');
?>

<footer style="text-align: center; padding: 20px; position: relative; width: 100%; background-color: transparent; color: #FFF !important; font-weight: 900 !important;">
@ <?php echo $currentYear; ?> 
<?php echo htmlspecialchars($shopName); ?>
   
</footer>

<style>
    footer {
        font-size: 16px;
    }


    @media (max-width: 600px) {
        footer {
            padding: 10px;
            font-size: 14px;
        }
    }
</style>