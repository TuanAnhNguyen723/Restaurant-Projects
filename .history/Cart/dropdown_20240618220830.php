<?php
// Kết nối đến CSDL
include './/config.php';

// Truy vấn lấy danh sách mã giảm giá từ bảng discount
$sql = "SELECT MaGiam FROM discount";
$result = $conn->query($sql);

// Hiển thị các lựa chọn trong dropdown
while ($row = $result->fetch_assoc()) {
    echo "<option value='" . $row['MaGiam'] . "'>" . $row['MaGiam'] . "</option>";
}

// Đóng kết nối
$conn->close();
?>