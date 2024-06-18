
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


function confirmPayment() {
    if (confirm('Bạn có chắc chắn muốn thanh toán không?')) {
        // Gửi yêu cầu xóa tất cả dữ liệu bằng AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?php echo $_SERVER["PHP_SELF"]; ?>', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Hiển thị thông báo thanh toán thành công
                alert('Thanh toán thành công!');
                // Tải lại trang để cập nhật giao diện
                window.location.reload();
            } else {
                // Hiển thị thông báo lỗi
                alert('Có lỗi xảy ra khi thanh toán.');
            }
        };
        xhr.send('deleteAll=true');
    }
}

// Lấy phần tử input mã giảm giá và nút áp dụng
const discountInput = document.querySelector('.discount');
const applyBtn = document.querySelector('.btn-apdung');

// Xử lý sự kiện nhấn nút áp dụng
applyBtn.addEventListener('click', function() {
  const discountCode = discountInput.value;

  // Gửi yêu cầu AJAX để kiểm tra mã giảm giá
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'ConnectDb.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    if (xhr.status === 200) {
      const discountRate = parseFloat(xhr.responseText);

      // Tính toán tổng tiền sau khi áp dụng mã giảm giá
      const totalPrice = <?php echo $totalPrice; ?>;
      const discountedPrice = totalPrice * (1 - discountRate / 100);

      // Cập nhật giá trị tổng tiền trên giao diện
      const totalPriceElement = document.querySelector('.box-dashboard-row:nth-child(2) p:last-child');
      totalPriceElement.textContent = `$${discountedPrice.toFixed(2)}`;
    } else {
      alert('Có lỗi xảy ra khi kiểm tra mã giảm giá.');
    }
  };
  xhr.send('discountCode=' + encodeURIComponent(discountCode));
});

// sorting 

