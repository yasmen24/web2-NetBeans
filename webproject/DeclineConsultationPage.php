<?php
error_reporting(E_ALL);
ini_set('log_errors', '1');
ini_set('display_errors', '1');

$connection = mysqli_connect("localhost","root","root","webproject", "3306");
if (mysqli_connect_error()) {
    echo json_encode(false);
    exit();
}

if (isset($_POST['requestID'])) {
    $requestID = $_POST['requestID'];

    $sql = "UPDATE DesignConsultationRequest SET statusID = 3 WHERE id = ?";
    
    $stmt = mysqli_prepare($connection, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $requestID);
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(false);
    }
} else {
    echo json_encode(false);
}

mysqli_close($connection);
?>
