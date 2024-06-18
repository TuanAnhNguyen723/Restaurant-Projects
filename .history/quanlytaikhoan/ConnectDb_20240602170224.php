<?php
session_start();
include '../Config.php';


//
    if(isset($_SESSION['user_id'])) {
        // Lấy ID người dùng từ session
        $user_id = $_SESSION['user_id'];

    $sql = "SELECT Username, Email, Phone, HoTen FROM account WHERE ID='$user_id'"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['Username'];
        $email = $row['Email'];
        $phone = $row['Phone'];
        $hoten = $row['HoTen'];
        $Active = $row['Active'];
    } else {
        $username = $email = $phone = $hoten = '';
        echo "No results found.";
    }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
        $id = $_GET['id'];
    
        // Thực hiện cập nhật trạng thái của tài khoản có ID tương ứng
        $sql = "UPDATE account SET Active = CASE WHEN Active = 'block' THEN NULL ELSE 'block' END WHERE ID = $id";
    
        if ($conn->query($sql) === TRUE) {
            $response = array('success' => true);
            echo json_encode($response);
        } else {
            $response = array('success' => false);
            echo json_encode($response);
        }
    }
    // Xác định số sản phẩm mỗi trang và trang hiện tại
$items_per_page = 7;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;

// Truy vấn tổng số sản phẩm
$total_sql = "SELECT COUNT(*) as total FROM account";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_items = $total_row['total'];
$total_pages = ceil($total_items / $items_per_page);

// Truy vấn dữ liệu từ bảng products với phân trang
$sql = "SELECT ID, Username, Email, Phone, HoTen, Role FROM account LIMIT $offset, $items_per_page";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM account WHERE ID='$id'";
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