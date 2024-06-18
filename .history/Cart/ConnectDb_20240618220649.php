<?php
session_start();
// Kết nối đến CSDL
include '../config.php';

  // Kiểm tra kết nối
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Kiểm tra xem người dùng đã đăng nhập hay chưa
if(isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  // Nếu người dùng chưa đăng nhập, chuyển hướng hoặc hiển thị thông báo lỗi
  // Ví dụ: header("Location: login.php");
  exit(); // Dừng việc thực thi mã tiếp theo
}



// Xác định số sản phẩm mỗi trang và trang hiện tại
$items_per_page = 7;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;

// Truy vấn tổng số sản phẩm
$total_sql = "SELECT COUNT(*) as total FROM cart";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_items = $total_row['total'];
$total_pages = ceil($total_items / $items_per_page);

// Truy vấn dữ liệu từ bảng products với phân trang
$sql = "SELECT ID, nameProducts, Price, Quantity FROM cart LIMIT $offset, $items_per_page";
$result = $conn->query($sql);


// xóa 1 sản phẩm
// Kiểm tra nếu có dữ liệu POST gửi đến
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cartId'])) {
  $id = $_POST['cartId'];
  $sql = "DELETE FROM cart WHERE ID = '$id'";
  if ($conn->query($sql) === TRUE) {
      // Nếu xóa thành công, trả về mã 200 (OK)
      http_response_code(200);
  } else {
      // Nếu có lỗi, trả về mã lỗi 500 (Internal Server Error)
      http_response_code(500);
  }
}

$totalPriceQuery = "SELECT SUM(Price * Quantity) AS total FROM cart";
$totalPriceResult = $conn->query($totalPriceQuery);
$totalPriceRow = $totalPriceResult->fetch_assoc();
$totalPrice = $totalPriceRow['total'];

// thanh toán 
// Xử lý yêu cầu POST để xóa toàn bộ dữ liệu
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteAll'])) {
  $sql = "DELETE FROM cart";
  if ($conn->query($sql) === TRUE) {
      // Nếu xóa thành công, trả về mã 200 (OK)
      http_response_code(200);
  } else {
      // Nếu có lỗi, trả về mã lỗi 500 (Internal Server Error)
      http_response_code(500);
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $discountCode = $_POST['discountCode'];

  $sql = "SELECT * FROM discount WHERE MaGiam = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $discountCode);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      echo json_encode(['success' => true, 'discountRate' => $row['TiLe']]);
  } else {
      echo json_encode(['success' => false]);
  }
}


// Truy vấn lấy danh sách mã giảm giá từ bảng discount
$sql = "SELECT MaGiam FROM discount";
$result = $conn->query($sql);

// Hiển thị các lựa chọn trong dropdown
while ($row = $result->fetch_assoc()) {
    echo "<option value='" . $row['MaGiam'] . "'>" . $row['MaGiam'] . "</option>";
}




$conn->close();


?>