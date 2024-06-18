<?php
session_start();
// Kết nối đến cơ sở dữ liệu
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Debugging statements to check if data is received correctly
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
        
        $Addcode = $_POST['Addcode'];
        $Addiscount = $_POST['Adddiscount'];

        if (!empty($code) && !empty($discount)) {
            // Truy vấn để lấy ID lớn nhất hiện tại
            $maxIdResult = $conn->query("SELECT MAX(ID) as maxId FROM discount");
            $maxIdRow = $maxIdResult->fetch_assoc();
            $newId = $maxIdRow['maxId'] + 1;

            // Chèn sản phẩm mới với ID mới
            $sql = "INSERT INTO discount (ID, MaGiam, TiLe) VALUES ('$newId', '$Addcode', '$Addiscount')";

            if ($conn->query($sql) === TRUE) {
                echo "Them ma giam gia thanh cong";
            } else {
                echo "Error adding discount: " . $conn->error;
            }
        } else {
            echo "Product name and price cannot be empty.";
        }

}
?>