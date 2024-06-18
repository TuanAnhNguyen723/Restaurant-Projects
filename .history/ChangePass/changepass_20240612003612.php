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
    <link rel="stylesheet" href="./changepass.css" />
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

        <a href="../Thongke/thongke.php" class="active admin-only">
          <i class="fa-regular fa-user"></i>
          <span>Thống kê</span>
        </a>

        <a href="../discount/discount.php" class="active admin-only">
          <i class="fa-regular fa-user"></i>
          <span>Quản lý mã giảm giá</span>
        </a>

        <a href="../Cart/cart.php" class="active user-only">
        <i class="fa-regular fa-user"></i>
        <span>Giỏ hàng</span>
      </a>


        <a  href="../quanlysanpham/quanly.php" class="active admin-only">
          <i class="fa-regular fa-user"></i>
          <span>Quản lý sản phẩm</span>
        </a>

        <a  href="../quanlytaikhoan/qltk.php" class="active admin-only">
        <i class="fa-regular fa-user"></i>
        <span>Quản lý tài khoản</span>
      </a>

        <a  style="background-color: #3b82f6"  href="./changepass.php" class="active ">
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
      <div class="dashboard-title">Đổi mật khẩu</div>
      <main class="page">
        <div class="box-dashboard">
          <form method="post">

            <div class="mb-3">
              <label for="exampleInputPass1" class="form-label"
                >Mật khẩu cũ
                <i class="text-red">*</i>
              </label>
              <input
                type="text"
                name="oldPass"
                class="form-control"
                id="exampleInputPass1"
                required
              />
            </div>

            <div class="mb-3">
              <label for="exampleInputNewPass1" class="form-label"
                >Mật khẩu mới
                <i class="text-red">*</i>
              </label>
              <input
                type="text"
                name="newPass"
                class="form-control"
                id="exampleInputNewPass1"
                required
              />
            </div>

            <div class="mb-3">
              <label for="exampleInputConfirm" class="form-label">
                Xác nhận mật khẩu
                <i class="text-red">*</i>
              </label>
              <input
                type="text"
                name="confirm"
                class="form-control"
                id="exampleInputConfirm"
                required
              />
            </div>

            <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
          </form>
        </div>
      </main>
    </main>
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
  </script>
</html>
