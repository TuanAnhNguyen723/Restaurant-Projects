<?php
session_start();
include '../config.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $code = $_POST['code'];
    $discount = $_POST['discount'];

    // Validate input
    if (!empty($code) && !empty($discount) && is_numeric($discount)) {
        // Prepare and execute the SQL statement
        $stmt = $conn->prepare("INSERT INTO discount (MaGiam, TiLe) VALUES (?, ?)");
        $stmt->bind_param("ss", $code, $discount);

        if ($stmt->execute()) {
            echo "Success";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid input";
    }
}



  $conn->close();
?>