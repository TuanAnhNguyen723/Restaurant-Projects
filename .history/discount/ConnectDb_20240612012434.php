<?php
session_start();
// Kết nối đến cơ sở dữ liệu
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Addcode = $_POST['Addcode'];
    $Adddiscount = $_POST['Adddiscount'];

    if (!empty($Addcode) && !empty($Adddiscount)) {
        // Truy vấn để lấy ID lớn nhất hiện tại
        $maxIdResult = $conn->query("SELECT MAX(ID) as maxId FROM discount");
        $maxIdRow = $maxIdResult->fetch_assoc();
        $newId = $maxIdRow['maxId'] + 1;

        // Chèn mã giảm giá mới với ID mới
        $sql = "INSERT INTO discount (ID, MaGiam, TiLe) VALUES ('$newId', '$Addcode', '$Adddiscount')";

        if ($conn->query($sql) === TRUE) {
            echo "Thêm mã giảm giá thành công";
        } else {
            echo "Lỗi khi thêm mã giảm giá: " . $conn->error;
        }
    } else {
        echo "Mã giảm giá và tỉ lệ giảm giá không được để trống.";
    }
}
?>