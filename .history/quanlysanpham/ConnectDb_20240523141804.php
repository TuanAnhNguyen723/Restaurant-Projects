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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] == 'addProduct') {

                // Debugging statements to check if data is received correctly
                echo '<pre>';
                print_r($_POST);
                 echo '</pre>';
        // Thêm sản phẩm mới
        $tenSP = $_POST['productName'];
        $price = $_POST['productPrice'];

        $sql = "INSERT INTO products (TenSP, Price) VALUES ('$tenSP', '$price')";

        if ($conn->query($sql) === TRUE) {
            echo "Product added successfully";
        } else {
            echo "Error adding product: " . $conn->error;
        }
    } elseif (isset($_POST['updateProduct'])) {
        // Cập nhật sản phẩm
        $id = $_POST['productId'];
        $tenSP = $_POST['productName'];
        $price = $_POST['productPrice'];

        $sql = "UPDATE products SET TenSP='$tenSP', Price='$price' WHERE ID='$id'";

        if ($conn->query($sql) === TRUE) {
            echo "Product updated successfully";
        } else {
            echo "Error updating product: " . $conn->error;
        }
    } elseif (isset($_POST['deleteProduct'])) {
        // Xóa sản phẩm
        $id = $_POST['productId'];
        $sql = "DELETE FROM products WHERE ID = '$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Xóa thành công";
            http_response_code(200);
        } else {
            http_response_code(500);
        }
    }
}

// Xác định số sản phẩm mỗi trang và trang hiện tại
$items_per_page = 7;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;

// Truy vấn tổng số sản phẩm
$total_sql = "SELECT COUNT(*) as total FROM products";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_items = $total_row['total'];
$total_pages = ceil($total_items / $items_per_page);

// Truy vấn dữ liệu từ bảng products với phân trang
$sql = "SELECT ID, TenSP, Price FROM products LIMIT $offset, $items_per_page";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE ID='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        echo json_encode($product);
    } else {
        echo json_encode(['error' => 'Product not found']);
    }
    exit;
}

$conn->close();
?>
