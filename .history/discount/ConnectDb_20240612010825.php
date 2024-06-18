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
            echo "Đã thêm mã giảm giá thành công";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Dữ liệu không hợp lệ";
    }
}

$result = $conn->query("SELECT MaGiam, TiLe FROM discount");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['MaGiam']}</td><td>{$row['TiLe']}</td></tr>";
    }
} else {
    echo "<tr><td colspan='2'>Không có mã giảm giá nào</td></tr>";
}

$conn->close();
?>