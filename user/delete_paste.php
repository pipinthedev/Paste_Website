<?php

session_start();


if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}


require_once '../server/connect.php';


$uniqueId = "";


if (isset($_GET["unique_id"]) && !empty(trim($_GET["unique_id"]))) {
    $uniqueId = trim($_GET["unique_id"]);


    $sql = "SELECT paste_by FROM paste WHERE unique_id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {

        mysqli_stmt_bind_param($stmt, "s", $param_uniqueId);


        $param_uniqueId = $uniqueId;


        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {

                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);


                if ($row["paste_by"] == $_SESSION["id"]) {



                    $sql = "DELETE FROM paste WHERE unique_id = ?";

                    if ($delete_stmt = mysqli_prepare($conn, $sql)) {

                        mysqli_stmt_bind_param($delete_stmt, "s", $param_uniqueId);


                        $param_uniqueId = $uniqueId;


                        if (mysqli_stmt_execute($delete_stmt)) {

                            header("location: my_pastes.php");
                            exit();
                        } else {
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                    }


                    mysqli_stmt_close($delete_stmt);
                } else {

                    echo "You do not have permission to delete this paste.";
                }
            } else {

                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }


    mysqli_stmt_close($stmt);
} else {

    header("location: error.php");
    exit();
}


mysqli_close($conn);
?>