  <!DOCTYPE html>

  <?php
  include 'ConnectDb.php';
  $role = isset($_SESSION['roleAccount']) ? $_SESSION['roleAccount'] : 'guest';
  ?>

  <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Document</title>
      <link rel="stylesheet" href="./cart.css" />
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
      />
      <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      />
    </head>
    <body>
      <nav class="dashboard">
        <div class="header">
          <a href="../View/main.php">Food Shop</a>
        </div>

        <div class="menu">
          <a href="../Dashboard/info.php" class="active">
            <i class="fa-regular fa-user"></i>
            <span>Thông tin cá nhân</span>
          </a>

          <a style="background-color: #3b82f6"  href="../Cart/cart.php" class="active user-only">
          <i class="fa-regular fa-user"></i>
          <span>Giỏ hàng</span>
        </a>

          <a href="../ChangePass/changepass.php" class="active">
            <i class="fa-solid fa-key"></i>
            <span>Đổi mật khẩu</span>
          </a>
          <a href="../index.html" class="active">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Đăng xuất</span>
          </a>
        </div>
      </nav>

      <main class="main-dashboard">
        <div class="dashboard-title">Quản lý sản phẩm</div>
        <main class="page">
          <div class="box-dashboard ">
            <table class="table caption-top">
              <caption>Danh sách sản phẩm</caption>
              <thead>
                <tr>
                  <th scope="col" onclick="sortTable(0, true, true)">ID &#x2191;</th>
                  <th scope="col">Hình ảnh</th>
                  <th scope="col" onclick="sortTable(2, false, true)">Tên Sản Phẩm &#x2191;</th>
                  <th scope="col" onclick="sortTable(3, true, true)">Giá tiền &#x2191;</th>
                  <th scope="col" onclick="sortTable(4, true, true)">Số lượng &#x2191;</th>
                  <th scope="col">Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Hiển thị dữ liệu từ mỗi hàng
                    while ($row = $result->fetch_assoc()) {
                        $imagePath = "../assets/products/Food" . $row["ID"] . ".jpg";
                        echo "<tr class = 'tr-hover'>";
                        echo "<th scope='row'>" . $row["ID"] . "</th>";
                        echo "<td><img style='object-fit: cover;' src='" . $imagePath . "' alt='product image' width='70' height='70'></td>";
                        echo "<td>" . $row["nameProducts"] . "</td>";
                        echo "<td>" . $row["Price"] . "$</td>";
                        echo "<td>" . $row["Quantity"] ."</td>";
                        echo "<td>
                                <button class = 'btnDelete' onclick='deleteProduct(" . $row["ID"] . ")'>Xóa</button>
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
          <div class="box-dashboard">
            <h1 class="caption-pay">Thanh toán</h1>
            <div class="box-dashboard-row"> 
              <p class="title-row">Tổng tiền:</p>   
              <p class="caption-pay2">
                <span class="original-price">$<?php echo number_format($totalPrice, 2); ?></span>
                <span class="discounted-price" style="display: none;"></span>
              </p>
            </div>
            <div class="box-dashboard-row"> 
              <p class="title-row">Chọn mã giảm giá</p>
              <div style="display: flex">
                <select class="discount" id="discountCode" name="discountCode">
                    <option value="">Chọn mã giảm giá 
                      
                    </option>
                    <?php
                  
                    // Hiển thị các lựa chọn trong dropdown
                    while ($row = $result2->fetch_assoc()) {
                        echo "<option value='" . $row['MaGiam'] . "'>" . $row['MaGiam'] . "</option>";
                    }
                    
                    ?>
                </select>
                <button class="btn-apdung">Áp dụng</button>
              </div>   
            </div>
            <button id="openModalBtn" class="payBtn">Thanh toán</button>
          </div>
        </main>
      </main>
      <!-- modal xóa 1 sản phẩm -->
      <div id="confirmModal" class="modal">
        <div class="modal-content">
          <p>Bạn có chắc chắn muốn xóa sản phẩm này không?</p>
          <div class="modal-buttons">
            <button id="confirmYes">Có</button>
            <button id="confirmNo">Không</button>
          </div>
        </div>
      </div>
      
      <!-- modal thanh toán -->
      <div id="payConfirmModal" class="modal">
        <div class="modal-content">
          <p>Bạn có chắc chắn muốn thanh toán không?</p>
          <div class="modal-buttons">
            <button id="confirmBtn">Đồng ý</button>
            <button id="cancelBtn">Hủy</button>
          </div>
        </div>
      </div>
    </body>
    <script>
      // PHP injects the role of the current user
      const userRole = '<?php echo $role; ?>';

      // JavaScript to show/hide elements based on role
      document.addEventListener('DOMContentLoaded', () => {
          if (userRole !== 'admin') {
              document.querySelectorAll('.admin-only').forEach(el => el.style.display = 'none');
          }

          if (userRole !== 'user') {
              document.querySelectorAll('.user-only').forEach(el => el.style.display = 'none');
          }
      });

      function deleteProduct(cartId) {
          var modal = document.getElementById('confirmModal');
          var btnYes = document.getElementById('confirmYes');
          var btnNo = document.getElementById('confirmNo');

          // Mở modal
          modal.style.display = 'block';

          // Xử lý khi nhấn Có
          btnYes.onclick = function() {
              // Gửi yêu cầu xóa bằng AJAX
              var xhr = new XMLHttpRequest();
              xhr.open('POST', '../Cart/ConnectDb.php', true);
              xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
              xhr.onload = function() {
                  if (xhr.status === 200) {
                      // Tải lại trang
                      window.location.reload();
                  } else {
                      alert('Có lỗi xảy ra khi xóa sản phẩm.');
                  }
              };
              xhr.send('cartId=' + cartId);

              // Đóng modal
              modal.style.display = 'none';
          };

          // Xử lý khi nhấn Không
          btnNo.onclick = function() {
              // Đóng modal
              modal.style.display = 'none';
          };
      }


      function showSuccessMessage() {
    alert('Thanh toán thành công!');
}
      // Confirm payment
      function confirmPayment() {
          var modal = document.getElementById('payConfirmModal');
          var btnYes = document.getElementById('confirmBtn');
          var btnNo = document.getElementById('cancelBtn');

          modal.style.display = 'block';

          btnYes.onclick = function() {
              // Gửi yêu cầu thanh toán bằng AJAX
              var xhr = new XMLHttpRequest();
              xhr.open('POST', '<?php echo $_SERVER["PHP_SELF"]; ?>', true);
              xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
              xhr.onload = function() {
                  if (xhr.status === 200) {
        
                      // Tải lại trang để cập nhật giao diện
                      window.location.reload();
                  } else {
                      // Hiển thị thông báo lỗi
                      alert('Có lỗi xảy ra khi thanh toán.');
                  }
              };
              xhr.send('deleteAll=true');
              // Đóng modal
              modal.style.display = 'none';
          };

          // Xử lý khi nhấn Không
          btnNo.onclick = function() {
              // Đóng modal
              modal.style.display = 'none';
          };
      }

      // Thêm sự kiện click cho nút thanh toán
      document.getElementById('openModalBtn').addEventListener('click', function() {
          confirmPayment();
      });

      // sorting 
      function sortTable(columnIndex, isNumeric) {
          var table = document.querySelector("table tbody");
          var rows = Array.from(table.rows);

          var isAscending = table.dataset.sortOrder !== 'asc';
          table.dataset.sortOrder = isAscending ? 'asc' : 'desc';

          rows.sort((a, b) => {
              var cellA = a.cells[columnIndex].innerText;
              var cellB = b.cells[columnIndex].innerText;

              if (isNumeric) {
                  cellA = parseFloat(cellA);
                  cellB = parseFloat(cellB);
              }

              if (cellA < cellB) {
                  return isAscending ? -1 : 1;
              } else if (cellA > cellB) {
                  return isAscending ? 1 : -1;
              } else {
                  return 0;
              }
          });

          rows.forEach(row => table.appendChild(row));
      }

    document.querySelector('.btn-apdung').addEventListener('click', function() {
    var discountCode = document.querySelector('.discount').value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'ConnectDb.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log(xhr.responseText); // Ghi lại phản hồi để kiểm tra
            try {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    var discountRate = response.discountRate;
                    var originalPrice = <?php echo $totalPrice; ?>;
                    var discountedPrice = originalPrice * (1 - discountRate / 100);
                    var originalPriceElement = document.querySelector('.original-price');
                    var discountedPriceElement = document.querySelector('.discounted-price');
                    
                    // Cập nhật style và hiển thị giá sau khi giảm
                    originalPriceElement.style.textDecoration = 'line-through';
                    originalPriceElement.style.opacity = '0.5';
                    discountedPriceElement.innerHTML = "$" + discountedPrice.toFixed(2);
                    discountedPriceElement.style.display = 'inline';
                } else {
                    alert(response.message || 'Mã giảm giá không hợp lệ.');
                }
            } catch (e) {
                console.error('Invalid JSON:', e);
                alert('Đã xảy ra lỗi khi xử lý phản hồi từ server.');
            }
        } else {
            alert('Có lỗi xảy ra khi kiểm tra mã giảm giá.');
        }
    };
    xhr.send('discountCode=' + encodeURIComponent(discountCode));
});

    </script>
  </html>
