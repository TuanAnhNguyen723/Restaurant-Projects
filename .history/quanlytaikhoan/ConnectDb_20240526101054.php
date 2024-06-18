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
    } else {
        $username = $email = $phone = $hoten = '';
        echo "No results found.";
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