<?php
session_start();
// Kết nối đến cơ sở dữ liệu
include '../Config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'addProduct') {
            $tenSP = $_POST['AddproductName'];
            $price = $_POST['AddproductPrice'];

            if (!empty($tenSP) && !empty($price)) {
                $maxIdResult = $conn->query("SELECT MAX(ID) as maxId FROM products");
                $maxIdRow = $maxIdResult->fetch_assoc();
                $newId = $maxIdRow['maxId'] + 1;

                $sql = "INSERT INTO products (ID, TenSP, Price) VALUES ('$newId', '$tenSP', '$price')";

                if ($conn->query($sql) === TRUE) {
                    echo "Product added successfully";
                } else {
                    echo "Error adding product: " . $conn->error;
                }
            } else {
                echo "Product name and price cannot be empty.";
            }
        } elseif ($_POST['action'] == 'updateProduct') {
            $id = $_POST['productId'];
            $tenSP = $_POST['productName'];
            $price = $_POST['productPrice'];

            $sql = "UPDATE products SET TenSP='$tenSP', Price='$price' WHERE ID='$id'";

            if ($conn->query($sql) === TRUE) {
                echo "Product updated successfully";
            } else {
                echo "Error updating product: " . $conn->error;
            }
        } elseif ($_POST['action'] == 'deleteProduct') {
            $id = $_POST['productId'];
            $sql = "DELETE FROM products WHERE ID = '$id'";
            if ($conn->query($sql) === TRUE) {
                echo "Xóa thành công";
                http_response_code(200);
            } else {
                http_response_code(500);
            }
        }
    } elseif (isset($_POST['query'])) {
        // Tìm kiếm trực tiếp (live search)
        $query = $_POST['query'];
        $sql = "SELECT * FROM products WHERE TenSP LIKE '%$query%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imagePath = "../assets/products/Food" . $row["ID"] . ".jpg";
                echo "<tr>";
                echo "<th scope='row'>" . $row["ID"] . "</th>";
                echo "<td><img src='" . $imagePath . "' alt='product image' width='50' height='50'></td>";
                echo "<td>" . $row["TenSP"] . "</td>";
                echo "<td>" . $row["Price"] . "$</td>";
                echo "<td>
                        <button class='btn update-btn' onclick='updateProduct(" . $row["ID"] . ")'>Cập nhật</button>
                        <button class='btn delete-btn' onclick='deleteProduct(" . $row["ID"] . ")'>Xóa</button>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Không có dữ liệu</td></tr>";
        }
        exit;
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
