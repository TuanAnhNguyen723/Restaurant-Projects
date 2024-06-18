<?php
include '../Config.php';

if (isset($_POST['query'])) {
    $searchQuery = $_POST['query'];
    $sql = "SELECT ID, TenSP, Price FROM products WHERE TenSP LIKE '%$searchQuery%'";
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
}

$conn->close();
?>