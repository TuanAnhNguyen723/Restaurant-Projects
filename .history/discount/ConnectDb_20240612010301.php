<?php
session_start();
include '../config.php';


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


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $code = $_POST['code'];
        $discount = $_POST['discount'];
    
        // Validate input
        if (!empty($code) && !empty($discount) && is_numeric($discount)) {
            // Prepare and execute the SQL statement
            $stmt = $conn->prepare("INSERT INTO discount (MaGiam, TiLe) VALUES (?, ?)");
            $stmt->bind_param("ss", $code, $discount);
    
            if ($stmt->execute()) {
                echo "Success";
            } else {
                echo "Error: " . $stmt->error;
            }
    
            $stmt->close();
        } else {
            echo "Invalid input";
        }
    }
  $conn->close();
?>