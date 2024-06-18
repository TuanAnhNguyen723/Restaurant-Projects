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
    <link rel="stylesheet" href="./qltk.css" />
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+YVjk2lnQ+tI4gd4C+OMa9Fi/08xg" crossorigin="anonymous"></script>
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

        <a href="../Cart/cart.php" class="active user-only">
      <i class="fa-regular fa-user"></i>
      <span>Giỏ hàng</span>
    </a>


        <a href="../Thongke/thongke.php" class="active admin-only">
        <i class="fa-regular fa-user"></i>
        <span>Thống kê</span>
      </a>

      <a href="../discount/discount.php" class="active admin-only">
          <i class="fa-regular fa-user"></i>
          <span>Quản lý mã giảm giá</span>
        </a>

      <a  href="../quanlysanpham/quanly.php" class="active admin-only">
        <i class="fa-regular fa-user"></i>
        <span>Quản lý sản phẩm</span>
      </a>
      
      <a style="background-color: #3b82f6"  href="../quanlytaikhoan/qltk.php" class="active admin-only">
        <i class="fa-regular fa-user"></i>
        <span>Quản lý tài khoản</span>
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
      <div class="dashboard-title">Quản lý tài khoản</div>
      <main class="page">

        <div class="box-dashboard ">
        <div class="container-row">
            <div class="title">Khách hàng</div>
      </div>
            <table class="table caption-top">
      <thead>
        <tr>
                <th scope="col" onclick="sortTable(0, true, true)">ID &#x2191;</th>
                <th scope="col" onclick="sortTable(1, false, true)">Username&#x2191;</th>
                <th scope="col" onclick="sortTable(2, false, true)">Email&#x2191;</th>
                <th scope="col" onclick="sortTable(3, false, true)">Họ Và Tên&#x2191;</th>
                <th scope="col" onclick="sortTable(4, true, true)">Số điện thoại&#x2191;</th>
                <th scope="col">Role</th>
                <th scope="col">Thao tác</th>
        </tr>
      </thead>
      <tbody>
      <?php
    if ($result->num_rows > 0) {
      // Hiển thị dữ liệu từ mỗi hàng
      while ($row = $result->fetch_assoc()) {
          $imagePath = "../assets/products/Food" . $row["ID"] . ".jpg";
          echo "<tr>";
          echo "<th scope='row'>" . $row["ID"] . "</th>";
          echo "<td>" . $row["Username"] . "</td>";
          echo "<td>" . $row["Email"] . "</td>";
          echo "<td>" . $row["HoTen"] . "</td>";
          echo "<td>" . $row["Phone"] . "</td>";
          echo "<td>" . $row["Role"] . "</td>";
          echo "<td>
                  <button class='active-btn' onclick='ActiveFn(" . $row["ID"] . ")'>" . ($row["Active"] == "block" ? "Không kích hoạt" : "Đang kích hoạt") . "</button>
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

<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="statusModalLabel">Thông báo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="statusModalBody">
        <!-- Nội dung thông báo sẽ được chèn ở đây -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
      </div>
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
  console.log(111)
  document.querySelectorAll('.admin-only').forEach(el => el.style.display = 'none');
}

if (userRole !== 'user') {
  console.log(111)
  document.querySelectorAll('.user-only').forEach(el => el.style.display = 'none');
}
});

function sortTable(columnIndex, isNumeric) {
  var table = document.querySelector("table tbody");
  var rows = Array.from(table.rows);

  var isAscending = table.dataset.sortOrder !== "asc";
  table.dataset.sortOrder = isAscending ? "asc" : "desc";

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

  rows.forEach((row) => table.appendChild(row));
}


// Function to handle activation
function ActiveFn(id) {
    fetch(`ConnectDb.php?id=${id}`, {
        method: 'POST',
        body: JSON.stringify({ id: id }), // Chuyển tham số id qua yêu cầu POST
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            const button = document.querySelector(`button[onclick='ActiveFn(${id})']`);
            let message = '';
            if (button.innerText === 'Không kích hoạt') {
                button.classList.remove('not-active');
                button.classList.add('active');
                message = 'Đã mở khóa tài khoản này';
            } else {
                button.classList.remove('active');
                button.classList.add('not-active');
                message = 'Đã khóa tài khoản này';
            }
            // Đảo ngược văn bản của nút
            button.innerText = button.innerText === 'Không kích hoạt' ? 'Đang kích hoạt' : 'Không kích hoạt';

            // Lưu trạng thái của nút vào localStorage
            localStorage.setItem(`button-${id}-state`, button.innerText);

            // Hiển thị modal với thông báo
            document.getElementById('statusModalBody').innerText = message;
            var myModal = new bootstrap.Modal(document.getElementById('statusModal'));
            myModal.show();
        } else {
            alert('Lỗi khi cập nhật trạng thái');
        }
    })
    .catch(error => {
        console.error('Lỗi:', error);
    });
}

// Khôi phục trạng thái của nút sau khi trang được làm mới
document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('button[onclick^="ActiveFn"]');
    buttons.forEach(button => {
        const id = button.getAttribute('onclick').match(/\d+/)[0];
        const buttonState = localStorage.getItem(`button-${id}-state`);
        if (buttonState === 'Không kích hoạt') {
            button.classList.add('not-active');
        } else {
            button.classList.add('active');
        }
    });
});

</script>

</html>
