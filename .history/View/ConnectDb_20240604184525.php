<?php
session_start();
  // Kết nối đến cơ sở dữ liệu
  include '../Config.php';


//
    if(isset($_SESSION['roleAccount'])) {
        // Lấy ID người dùng từ session
        $roleAccount = $_SESSION['roleAccount'];

    $sql = "SELECT Username, Email, Phone, HoTen FROM account WHERE Role='$roleAccount'"; 
    $result = $conn->query($sql);

    }

        // Truy vấn dữ liệu từ bảng products với phân trang
        $sql = "SELECT TenSP, Price, ID  FROM products";
        $result2 = $conn->query($sql);



    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

// Kiểm tra nếu có dữ liệu POST gửi đến
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['productId'];

    // Lấy thông tin sản phẩm từ bảng products
    $sql = "SELECT TenSP, Price FROM products WHERE ID = '$productId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $productName = $row['TenSP'];
        $productPrice = $row['Price'];
        $quantity = 1; // Số lượng mặc định khi thêm vào giỏ hàng

        // Kiểm tra sản phẩm đã có trong giỏ hàng hay chưa
        $sql = "SELECT * FROM cart WHERE ID = '$productId'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng
            $sql = "UPDATE cart SET Quantity = Quantity + 1 WHERE ID = '$productId'";
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới
            $sql = "INSERT INTO cart (nameProducts, ID, Price, Quantity) VALUES ('$productName', '$productId', '$productPrice', '$quantity')";
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