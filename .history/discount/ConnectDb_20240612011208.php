<?php
session_start();
// Kết nối đến cơ sở dữ liệu
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == 'addProduct') {
        // Debugging statements to check if data is received correctly
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        
        $tenSP = $_POST['AddproductName'];
        $price = $_POST['AddproductPrice'];

        if (!empty($tenSP) && !empty($price)) {
            // Truy vấn để lấy ID lớn nhất hiện tại
            $maxIdResult = $conn->query("SELECT MAX(ID) as maxId FROM products");
            $maxIdRow = $maxIdResult->fetch_assoc();
            $newId = $maxIdRow['maxId'] + 1;

            // Chèn sản phẩm mới với ID mới
            $sql = "INSERT INTO products (ID, TenSP, Price) VALUES ('$newId', '$tenSP', '$price')";

            if ($conn->query($sql) === TRUE) {
                echo "Product added successfully";
            } else {
                echo "Error adding product: " . $conn->error;
            }
        } else {
            echo "Product name and price cannot be empty.";
        }
    }
}
?>