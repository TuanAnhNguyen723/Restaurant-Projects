<?php
// Kết nối đến cơ sở dữ liệu
include '../Config.php';

// Lấy dữ liệu từ form đăng ký
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$name = $_POST['name'];

// Mã hóa mật khẩu
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Kiểm tra xem tên người dùng có chứa chữ "admin" không
if (strpos($username, 'admin') !== false) {
    $role = 'admin';
} else {
    $role = 'user';
}

// Thêm dữ liệu vào cơ sở dữ liệu
$alter_sql = "ALTER TABLE account MODIFY COLUMN ID INT AUTO_INCREMENT";
if ($conn->query($alter_sql) === TRUE) {
    // Nếu không có lỗi khi thay đổi cấu trúc bảng, tiếp tục thêm dữ liệu
    $sql = "INSERT INTO account (Username, Pass, Email, Phone, HoTen, Role) VALUES ('$username', '$hashed_password', '$email', '$phone', '$name', '$role')";
    if ($conn->query($sql) === TRUE) {
        // Đăng ký thành công, chuyển hướng về trang đăng nhập và hiển thị thông báo
        echo "<script>alert('Registered successfully'); window.location='../index.html';</script>";
    } else {
        // Nếu có lỗi khi thêm dữ liệu, hiển thị thông báo lỗi
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // Nếu có lỗi khi thay đổi cấu trúc bảng, hiển thị thông báo lỗi
    echo "Error: " . $alter_sql . "<br>" . $conn->error;
}

$conn->close();
?>