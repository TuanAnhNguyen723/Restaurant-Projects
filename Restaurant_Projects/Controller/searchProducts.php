<?php
include '../config.php';

if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $keyword = "%" . $keyword . "%"; // Chuẩn bị từ khóa cho câu truy vấn SQL
    
    // Truy vấn cơ sở dữ liệu để tìm sản phẩm theo tên
    $sql = "SELECT * FROM products WHERE TenSP LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $keyword);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $imagePath = "../assets/products/Food" . $row["ID"] . ".jpg";
            echo '<li>
                    <div class="thumbnail covering">
                      <a href="#">
                          <img class="hover_img" src="'. $imagePath .'" alt=""/>
                      </a>
                    </div>
                    <div class="meta">
                      <div class="catrate">
                        <span class="rating">
                          <i class="fa-solid fa-star"></i>
                          <span>4.9</span>
                        </span>
                      </div>
                      <h2><a href="#">'. $row["TenSP"] .'</a></h2>
                      <div class="price">
                        <strong class="current">'. $row["Price"] .'$</strong>
                      </div>
                      <div class="buttons">
                        <button class="add-to-cart-btn" onclick="addToCartClicked(' . $row["ID"] . ')">Thêm vào giỏ hàng</button>
                      </div>
                    </div>
                  </li>';
        }
    } else {
        echo '<li>Không tìm thấy sản phẩm nào</li>';
    }
}
?>
