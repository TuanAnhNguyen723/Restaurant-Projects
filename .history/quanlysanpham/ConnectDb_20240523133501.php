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
    // In ra dữ liệu POST để kiểm tra
    print_r($_POST); // Debugging statement

    $id = $_POST['productId'];
    $tenSP = $_POST['productName'];
    $price = $_POST['productPrice'];

    $sql = "UPDATE products SET TenSP='$tenSP', Price='$price' WHERE ID='$id'";
    print_r($sql); // Debugging statement

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully";
    } else {
        echo "Error updating product: " . $conn->error;
    }
}


// // thêm sản phẩm vào products 
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $tenSP = $_POST['productName'];
//     $price = $_POST['productPrice'];

//     // Sử dụng prepare statement để tránh SQL injection
//     $stmt = $conn->prepare("INSERT INTO products (TenSP, Price) VALUES (?, ?)");
//     $stmt->bind_param("ss", $tenSP, $price);

//     if ($stmt->execute() === TRUE) {
//         echo "Product added successfully";
//     } else {
//         echo "Error adding product: " . $conn->error;
//     }

//     $stmt->close();
// }

// xóa 1 sản phẩm
// Kiểm tra nếu có dữ liệu POST gửi đến
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['productId'])) {
    $id = $_POST['productId'];
    $sql = "DELETE FROM products WHERE ID = '$id'";
    if ($conn->query($sql) === TRUE) {
        // Nếu xóa thành công, trả về mã 200 (OK)
        http_response_code(200);
    } else {
        // Nếu có lỗi, trả về mã lỗi 500 (Internal Server Error)
        http_response_code(500);
    }
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
$total_sql = "SELECT COUNT(*) as total FROM products";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_items = $total_row['total'];
$total_pages = ceil($total_items / $items_per_page);

// Truy vấn dữ liệu từ bảng products với phân trang
$sql = "SELECT ID, TenSP, Price FROM products LIMIT $offset, $items_per_page";
$result = $conn->query($sql);



if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT ID, TenSP, Price FROM products WHERE ID = $id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      $product = $result->fetch_assoc();
      echo json_encode($product);
  } else {
      echo json_encode([]);
  }
}



$conn->close();


?>