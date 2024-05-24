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
    <link rel="stylesheet" href="./thongke.scss" />
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
        <a href="../Dashboard/info.php" class="active ">
          <i class="fa-regular fa-user"></i>
          <span>Thông tin cá nhân</span>
        </a>

        <a style="background-color: #3b82f6" href="../Thongke/thongke.php" class="active admin-only">
        <i class="fa-regular fa-user"></i>
        <span>Thống kê</span>
      </a>

      <a  href="../quanlysanpham/quanly.php" class="active admin-only">
        <i class="fa-regular fa-user"></i>
        <span>Quản lý sản phẩm</span>
      </a>

      <a href="../quanlytaikhoan/qltk.php" class="active admin-only">
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
      <div class="dashboard-title">Thông tin cá nhân</div>
      <main class="page">
        <div class="box-dashboard">
          <form method="post">
            <div class="mb-3">
              <label for="exampleInputTaiKhoan" class="form-label">
                Tài khoản
                <i class="text-red">*</i>
              </label>
              <input
                type="text"
                name ="username"
                class="form-control no-pointer-events"
                id="exampleInputTaiKhoan"
                value="<?php echo ($username); ?>"
              />
            </div>
            <div class="mb-3">
              <label for="exampleInputHoTen1" class="form-label"
                >Họ Tên
                <i class="text-red">*</i>
              </label>
              <input
                type="text"
                name="hoten"
                class="form-control"
                id="exampleInputHoTen1"
                value="<?php echo ($hoten); ?>"
              />
            </div>

            <div class="mb-3">
              <label for="exampleInputHoTen1" class="form-label"
                >Số điện thoại
                <i class="text-red">*</i>
              </label>
              <input
                type="text"
                name="phone"
                class="form-control"
                id="exampleInputHoTen1"
                value="0<?php echo ($phone); ?>"
              />
            </div>

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">
                Email
                <i class="text-red">*</i>
              </label>
              <input
                type="email"
                name="email"
                class="form-control"
                id="exampleInputEmail1"
                aria-describedby="emailHelp"
                value="<?php echo ($email); ?>"
              />
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
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
