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
  $conn->close();
?>