function submitAdd() {
  var Addcode = document.getElementById("Addcode").value;
  var Adddiscount = document.getElementById("Adddiscount").value;

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "ConnectDb.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      alert(xhr.responseText);

      location.reload();
      // Có thể thêm logic để cập nhật giao diện sau khi thêm mã giảm giá thành công
    }
  };

  var data =
    "Addcode=" +
    encodeURIComponent(Addcode) +
    "&Adddiscount=" +
    encodeURIComponent(Adddiscount);
  xhr.send(data);
}

var totalPriceElement = document.getElementById("totalPrice");
var originalPrice = parseFloat(totalPriceElement.innerText.replace("$", ""));

var discountInput = document.getElementById("discountInput");
var applyButton = document.getElementById("applyButton");

applyButton.addEventListener("click", function () {
  var discountCode = discountInput.value;

  // Gửi yêu cầu AJAX để lấy tỉ lệ giảm giá từ database
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "getDiscount.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      var discount = parseInt(xhr.responseText);

      if (discount > 0) {
        var discountedPrice = originalPrice * (1 - discount / 100);
        totalPriceElement.innerText = "$" + discountedPrice.toFixed(2);
      } else {
        totalPriceElement.innerText = "$" + originalPrice.toFixed(2);
      }
    }
  };
  xhr.send("code=" + encodeURIComponent(discountCode));
});
