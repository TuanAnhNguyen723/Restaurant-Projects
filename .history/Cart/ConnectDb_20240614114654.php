<?php
session_start();
// Kết nối đến CSDL
include '../config.php';

// Bật báo cáo lỗi để dễ dàng gỡ lỗi
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Đặt tiêu đề cho phản hồi là JSON
header('Content-Type: application/json');

// Kiểm tra kết nối
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['user_id'])) {
    // Nếu người dùng chưa đăng nhập, trả về thông báo lỗi
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit(); // Dừng việc thực thi mã tiếp theo
}

$user_id = $_SESSION['user_id'];

// Kiểm tra xem form có được submit hay không
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $hoten = $_POST['hoten'];
  
    // Cập nhật dữ liệu vào cơ sở dữ liệu
    $sql = "UPDATE account SET Email='$email', Phone='$phone', HoTen='$hoten' WHERE Username='$username'";
  
    if ($conn->query($sql) === TRUE) {
      echo json_encode(['success' => true, 'message' => 'Registered successfully']);
    } else {
      echo json_encode(['success' => false, 'message' => 'Registered Failed: ' . $conn->error]);
    }
    exit();
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

// Xóa một sản phẩm
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cartId'])) {
    $id = $_POST['cartId'];
    $sql = "DELETE FROM cart WHERE ID = '$id'";
    if ($conn->query($sql) === TRUE) {
        // Nếu xóa thành công, trả về mã 200 (OK)
        http_response_code(200);
        echo json_encode(['success' => true]);
    } else {
        // Nếu có lỗi, trả về mã lỗi 500 (Internal Server Error)
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Delete failed: ' . $conn->error]);
    }
    exit();
}

// Tính tổng giá trị đơn hàng
$totalPriceQuery = "SELECT SUM(Price * Quantity) AS total FROM cart";
$totalPriceResult = $conn->query($totalPriceQuery);
$totalPriceRow = $totalPriceResult->fetch_assoc();
$totalPrice = $totalPriceRow['total'];

// Xử lý yêu cầu POST để xóa toàn bộ dữ liệu
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteAll'])) {
    $sql = "DELETE FROM cart";
    if ($conn->query($sql) === TRUE) {
        // Nếu xóa thành công, trả về mã 200 (OK)
        http_response_code(200);
        echo json_encode(['success' => true]);
    } else {
        // Nếu có lỗi, trả về mã lỗi 500 (Internal Server Error)
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Delete all failed: ' . $conn->error]);
    }
    exit();
}

// Kiểm tra mã giảm giá
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['discountCode'])) {
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
        echo json_encode(['success' => false, 'message' => 'Invalid discount code.']);
    }
    exit();
}

// Nếu không có yêu cầu nào phù hợp, trả về thông báo lỗi
echo json_encode(['success' => false, 'message' => 'Invalid request.']);

$conn->close();
?>
