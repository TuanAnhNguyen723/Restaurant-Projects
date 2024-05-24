<?php

session_start();

// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webfooddb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Kiểm tra xem form có được submit hay không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldPass = $_POST['oldPass'];
    $newPass = $_POST['newPass'];
    $confirm = $_POST['confirm'];
    // Lấy username từ session
    $username = $_SESSION['username'];

    // Truy vấn lấy mật khẩu hiện tại từ database
    $sql = "SELECT Pass FROM account WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    // Kiểm tra mật khẩu cũ
    if (password_verify($oldPass, $hashed_password)) {
        // Kiểm tra mật khẩu mới và xác nhận mật khẩu
        if ($newPass === $confirm) {
            // Mã hóa mật khẩu mới
            $new_hashed_password = password_hash($newPass, PASSWORD_DEFAULT);

            // Cập nhật mật khẩu mới vào database
            $update_sql = "UPDATE account SET Pass = ? WHERE Username = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ss", $new_hashed_password, $username);

            if ($update_stmt->execute()) {
                echo "<script>alert('Password changed successfully');</script>";
            } else {
                echo "<script>alert('Password change failed');</script>";
            }
        } else {
            echo "<script>alert('New password and confirm password do not match');</script>";
        }
    } else {
        echo "<script>alert('Old password is incorrect');</script>";
    }

    $stmt->close();
    $update_stmt->close();
}

$conn->close();
?>