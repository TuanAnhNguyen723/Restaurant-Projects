<?php
session_start();
include '../Config.php';

// Kiểm tra nếu có dữ liệu POST gửi đến
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['productId'];

    // Lấy thông tin người dùng từ session
    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        // Xử lý khi người dùng chưa đăng nhập
        // Ví dụ: header("Location: login.php");
        exit(); // Dừng việc thực thi mã tiếp theo
    }

    // Lấy thông tin sản phẩm từ bảng products
    $sql = "SELECT TenSP, Price FROM products WHERE ID = '$productId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $productName = $row['TenSP'];
        $productPrice = $row['Price'];
        $quantity = 1; // Số lượng mặc định khi thêm vào giỏ hàng

        // Kiểm tra sản phẩm đã có trong giỏ hàng của người dùng hay chưa
        $sql = "SELECT * FROM cart WHERE Product_ID = '$productId' AND User_ID = '$user_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng
            $sql = "UPDATE cart SET Quantity = Quantity + 1 WHERE Product_ID = '$productId' AND User_ID = '$user_id'";
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới
            $sql = "INSERT INTO cart (Product_Name, Product_ID, Price, Quantity, User_ID) VALUES ('$productName', '$productId', '$productPrice', '$quantity', '$user_id')";
        }

        if ($conn->query($sql) === TRUE) {
            echo "Add to cart success!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Product not found!";
    }
}

$conn->close();
?>
