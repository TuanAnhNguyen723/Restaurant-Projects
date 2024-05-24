function deleteProduct(productId) {
  var modal = document.getElementById("confirmModal");
  var btnYes = document.getElementById("confirmYes");
  var btnNo = document.getElementById("confirmNo");

  // Mở modal
  modal.style.display = "block";

  // Xử lý khi nhấn Có
  btnYes.onclick = function () {
    // Gửi yêu cầu xóa bằng AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../quanlysanpham/ConnectDb.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (xhr.status === 200) {
        // Tải lại trang
        window.location.reload();
      } else {
        alert("Có lỗi xảy ra khi xóa sản phẩm.");
      }
    };
    xhr.send("deleteProduct=true&productId=" + productId);

    // Đóng modal
    modal.style.display = "none";
  };

  // Xử lý khi nhấn Không
  btnNo.onclick = function () {
    // Đóng modal
    modal.style.display = "none";
  };
}

var modalUpdate = document.getElementById("updateModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
  modalUpdate.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modalUpdate) {
    modalUpdate.style.display = "none";
  }
};

function updateProduct(id) {
  // Fetch product data using AJAX
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "ConnectDb.php?id=" + id, true);
  xhr.onload = function () {
    if (xhr.status == 200) {
      console.log("Response received: ", xhr.responseText);
      var product = JSON.parse(xhr.responseText);
      if (product.error) {
        alert(product.error);
      } else {
        document.getElementById("productId").value = product.ID; // Cập nhật productId
        document.getElementById("productName").value = product.TenSP;
        document.getElementById("productPrice").value = product.Price;
        document.getElementById("updateModal").style.display = "block";
      }
    }
  };
  xhr.send();
}

function submitUpdate() {
  document.getElementById("updateForm").submit();
}

// var modalAdd = document.getElementById("addModal");

// // Get the <span> element that closes the modal
// var spanClose = document.getElementsByClassName("closeAddModal")[0];
// console.log(span);

// // When the user clicks on <span> (x), close the modal
// spanClose.onclick = function () {
//   modalAdd.style.display = "none";
// };

// // When the user clicks anywhere outside of the modal, close it
// window.onclick = function (event) {
//   if (event.target == modalAdd) {
//     modalAdd.style.display = "none";
//   }
// };

// function addbtnFn() {
//   modalAdd.style.display = "block";
// }

// function submitAdd() {
//   var productName = document.getElementById("productName").value;
//   var productPrice = document.getElementById("productPrice").value;

//   var xhr = new XMLHttpRequest();
//   xhr.open("POST", "ConnectDb.php", true);
//   xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

//   xhr.onreadystatechange = function () {
//     if (xhr.readyState === 4 && xhr.status === 200) {
//       alert(xhr.responseText);
//       // Có thể thêm logic để cập nhật giao diện sau khi thêm sản phẩm thành công
//     }
//   };

//   var data =
//     "productName=" +
//     encodeURIComponent(productName) +
//     "&productPrice=" +
//     encodeURIComponent(productPrice);
//   xhr.send(data);
// }
