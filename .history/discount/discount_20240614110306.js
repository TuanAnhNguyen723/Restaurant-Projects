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
