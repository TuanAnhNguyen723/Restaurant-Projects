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

// Kiểm tra xem form có được submit hay không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $hoten = $_POST['hoten'];
  
    // Cập nhật dữ liệu vào cơ sở dữ liệu
    $sql = "UPDATE account SET Email='$email', Phone='$phone', HoTen='$hoten' WHERE Username='$username'";
  
    if ($conn->query($sql) === TRUE) {
      echo "<script>alert('Registered successfully'); </script>";
    } else {
      echo "<script>alert('Registered Failed');  </script>" . $conn->error;
    }
  }


    // Check if a discount code is applied
    $discountApplied = false;
    $discountValue = 0;
    if (isset($_POST['discountCode'])) {
      $discountCode = $_POST['discountCode'];  // Assuming discountCode is submitted via POST
  
      // Query the discount table for the entered code
      $sql = "SELECT * FROM discount WHERE MaGiam = '$discountCode'";
      $resultDiscount = $conn->query($sql);
  
      if ($resultDiscount->num_rows > 0) {
        $rowDiscount = $resultDiscount->fetch_assoc();
        $discountValue = $rowDiscount['TiLe'];  // Get the discount percentage
        $discountApplied = true;
      } else {
        echo "<script>alert('Mã giảm giá không hợp lệ!');</script>";
      }
    }
  
    // Calculate discounted total price (if applicable)
    if ($discountApplied) {
      $discountedTotalPrice = $totalPrice * (1 - $discountValue / 100);
    } else {
      $discountedTotalPrice = $totalPrice;
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


$conn->close();


?>