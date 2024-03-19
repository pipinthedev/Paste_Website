<?php
require_once __DIR__ . "/../server/connect.php";

// Check the connection first
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, img, url FROM ads WHERE expiry_at > NOW() ORDER BY RAND() LIMIT 2";
$result = $conn->query($sql);

// Add a style tag for CSS
echo '<style>
        .ads-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            padding: 10px;
        }
        .ad {
            margin: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Optional: adds a subtle shadow around ads for better definition */
            border-radius: 5px; /* Optional: rounds the corners of the ad containers */
        }
        .ad img {
            max-width: 480px;
            max-height: 150px;
            width: auto;
            height: auto;
        }
        @media (max-width: 600px) {
            .ad img {
                max-width: 100%;
                max-height: auto;
            }
        }
      </style>';

echo '<div class="ads-container">'; 

if ($result === false) {
    error_log("Error: " . $conn->error);
    echo "An error occurred." . $conn->error;
} else {
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div class="ad"><a href="' . htmlspecialchars($row['url']) . '" target="_blank"><img src="' . htmlspecialchars($row['img']) . '" alt="Ad Image"></a></div>';
        }
    } else {
        echo "";
    }
}

echo '</div>';

$conn->close();
?>
