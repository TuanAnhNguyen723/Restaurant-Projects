<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./quanly.scss">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
      .inputSearch {
          width: 300px;
          padding: 10px 20px;
          font-size: 16px;
          border: 2px solid #ddd;
          border-radius: 25px;
          transition: all 0.3s ease;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .inputSearch:focus {
          border-color: #007bff;
          box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
          outline: none;
        }

        .inputSearch::placeholder {
          color: #999;
        }
    </style>
</head>
<body>
    <nav class="dashboard">
        <!-- Your nav content -->
    </nav>

    <main class="main-dashboard">
        <div class="dashboard-title">Quản lý sản phẩm</div>
        <main class="page">
            <div class="box-dashboard">
                <div class="container-row">
                    <div class="title">Sản Phẩm</div>
                    <input type='text' class="inputSearch" id="live_search" placeholder="Tìm kiếm"></input>
                    <button onclick="addbtnFn()" id="addbtn" class="addProduct-btn" autocomplate="off">Thêm sản phẩm</button>
                </div>
                <table class="table caption-top">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Tên Sản Phẩm</th>
                            <th scope="col">Giá tiền</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody id="product-table-body">
                        <?php
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
                        ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <?php
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo "<a href='?page=$i' class='" . ($i == $page ? "active" : "") . "'>$i</a>";
                    }
                    ?>
                </div>
            </div>
        </main>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const userRole = "<?php echo $role; ?>";
        document.addEventListener("DOMContentLoaded", () => {
            if (userRole !== "admin") {
                document.querySelectorAll(".admin-only").forEach((el) => (el.style.display = "none"));
            }

            if (userRole !== "user") {
                document.querySelectorAll(".user-only").forEach((el) => (el.style.display = "none"));
            }
        });
    </script>
    <script>
            document.getElementById('live_search').addEventListener('keyup', function() {
            let query = this.value;

            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'ConnectDb.php', true); // Đường dẫn đến file PHP của bạn
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.status == 200) {
                    document.getElementById('product-table-body').innerHTML = this.responseText;
                }
            };

            xhr.send('query=' + query);
        });
    </script>
</body>
</html>
