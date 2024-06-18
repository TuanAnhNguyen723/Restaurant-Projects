function submitAdd() {
    var AddCode = document.getElementById("AddproductName").value;
    var Addiscount = document.getElementById("AddproductPrice").value;
  
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "ConnectDb.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        alert(xhr.responseText);
        modalAdd.style.display = "none";
        location.reload();
        // Có thể thêm logic để cập nhật giao diện sau khi thêm sản phẩm thành công
      }
    };
  
    var data =
      "action=addProduct&AddproductName=" +
      encodeURIComponent(AddproductName) +
      "&AddproductPrice=" +
      encodeURIComponent(AddproductPrice);
    xhr.send(data);
  }