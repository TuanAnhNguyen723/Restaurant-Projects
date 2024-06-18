<?php
   include 'ConnectDb.php';
   $role = isset($_SESSION['roleAccount']) ? $_SESSION['roleAccount'] : 'guest';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food</title>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Food WebSite</title>
    <link rel="stylesheet" href="./main.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
    />
</head>
<body>
    <div id="page" class="site">
      <header>
        <div class="container">
          <nav>
            <div class="left">
              <div class="logo"><a href="#">Nhà Hàng Trời Âu</a></div>
              <div class="menu">
                <ul>
                  <li><a href="#home">Trang Chủ</a></li>
                  <li><a href="#categori">Thực Đơn</a></li>
                  <li><a href="#contact">Liên Lạc</a></li>
                </ul>
              </div>
            </div>
            <div class="right">
              <div class="icons">
                <a href="#" class="m-trigger mobile-only">
                  <i class="fa-solid fa-bars"></i>
                </a>
                <a id="userLink" href="#" class="m-trigger">
                  <i class="fa-regular fa-user"></i>
                </a>
              </div>
            </div>
          </nav>
        </div>
      </header>

      <main class = "main_login">
        <div id="home" class="hero">
          <div class="container">
            <h1 class = "text">Đừng để cái bụng của bạn đói</h1>
            <span class="text">Được nấu bởi đầu bếp số 1 Việt Nam</span>
            <div class="slider">
              <div class="thumb-big swiper">
                <div class="wrapper swiper-wrapper">
                  <div class="item swiper-slide">
                    <div class="main">
                      <div class="tags link-slide">
                        <span>Bữa sáng</span>
                        <div class="price">$12.99</div>
                        <a href="#">Đặt hàng </a>
                      </div>
                      <div class="image">
                        <img src="../assets/slider/food1.png" alt="" />
                      </div>
                    </div>
                  </div>

                  <div class="item swiper-slide">
                    <div class="main">
                      <div class="tags link-slide">
                        <span>Bữa trưa</span>
                        <div class="price">$10.99</div>
                        <a href="#">Đặt hàng</a>
                      </div>
                      <div class="image">
                        <img src="../assets/slider/food2.png" alt="" />
                      </div>
                    </div>
                  </div>

                  <div class="item swiper-slide">
                    <div class="main">
                      <div class="tags link-slide">
                        <span>Bữa tối</span>
                        <div class="price">$99.99</div>
                        <a href="#">Đặt hàng </a>
                      </div>
                      <div class="image">
                        <img src="../assets/slider/food3.png" alt="" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-pagination"></div>
              </div>
              <div thumbSlider="" class="thumb-nav swiper">
                <ul class="swiper-wrapper">
                  <li class="swiper-slide">
                    <div class="item">
                      <h4>Bữa sáng<br /><span>Trứng chiên lòng đào</span></h4>
                      <div class="thumbnail">
                        <img src="../assets/slider/food1.png" alt="" />
                      </div>
                    </div>
                  </li>

                  <li class="swiper-slide">
                    <div class="item">
                      <h4>Bữa trưa<br /><span>Cá hồi</span></h4>
                      <div class="thumbnail">
                        <img src="../assets/slider/food2.png" alt="" />
                      </div>
                    </div>
                  </li>

                  <li class="swiper-slide">
                    <div class="item">
                      <h4>Bữa tối<br /><span>Trứng chiên đặc biệt</span></h4>
                      <div class="thumbnail">
                        <img src="../assets/slider/food3.png" alt="" />
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="bg-primary"></div>
        </div>

        <!-- category-->

        <div class="tabbed has-bg">
          <div id="categori" class="container">
            <div class="head-brief">
              <h3>Our Best Selling Products</h3>
              <p>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                Aliquam tenetur inventore expedita minus cumque laboriosam illo
                earum, deleniti saepe reprehenderit qui possimus culpa harum
                placeat voluptate eum amet minima consectetur!
              </p>
            </div>

            <nav class="tnav lifnk-slide swiper">
              <ul class="swiper-wrapper">
                <li class="swiper-slide">
                  <a href="#0">Baked goods</a>
                </li>
                <li class="swiper-slide">
                  <a href="#0">Garnishes</a>
                </li>
                <li class="swiper-slide">
                  <a href="#0">Herbs & Spices</a>
                </li>
                <li class="swiper-slide">
                  <a href="#0">Nuts</a>
                </li>
                <li class="swiper-slide">
                  <a href="#0">Seafood</a>
                </li>
                <li class="swiper-slide">
                  <a href="#0">Vegetables</a>
                </li>
              </ul>
            </nav>
        </form>
            <div class="tabbed-item swiper">
              <div class="products swiper-wrapper">
                
        <?php
          if ($result2->num_rows > 0) {
              // Mở thẻ div item swiper-slide và ul bên ngoài vòng lặp
              echo '<div class="item swiper-slide"><ul>';
              
              $count = 0; // Khởi tạo biến đếm
              
              while ($row = $result2->fetch_assoc()) {
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

                              <button class="add-to-cart-btn" onclick="addToCartClicked('  .  $row["ID"] . ')">Add to Cart</button>
                            </div>
                          </div>
                        </li>';
                  $count++; // Tăng biến đếm lên 1
                  
                  // Kiểm tra nếu biến đếm đạt đến 8 thì thoát vòng lặp
                  if ($count >= 8) {
                      break;
                  }
              }
              
              // Đóng thẻ ul và div item swiper-slide sau vòng lặp
              echo '</ul></div>';
          }
          if ($result2->num_rows > 0) {
            // Mở thẻ div item swiper-slide và ul bên ngoài vòng lặp
            echo '<div class="item swiper-slide"><ul>';
            
            $count = 0; // Khởi tạo biến đếm
            
            while ($row = $result2->fetch_assoc()) {
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

                            <button class="add-to-cart-btn" onclick="addToCartClicked('  .  $row["ID"] . ')">Add to Cart</button>
                          </div>
                        </div>
                      </li>';
                
                $count++; // Tăng biến đếm lên 1
                
                // Kiểm tra nếu biến đếm đạt đến 8 thì thoát vòng lặp
                if ($count >= 8) {
                    break;
                }
            }
            
            // Đóng thẻ ul và div item swiper-slide sau vòng lặp
            echo '</ul></div>';
        }

        if ($result2->num_rows > 0) {
          // Mở thẻ div item swiper-slide và ul bên ngoài vòng lặp
          echo '<div class="item swiper-slide"><ul>';
          
          $count = 0; // Khởi tạo biến đếm
          
          while ($row = $result2->fetch_assoc()) {
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

                          <button class="add-to-cart-btn" onclick="addToCartClicked('  .  $row["ID"] . ')">Add to Cart</button>
                        </div>
                      </div>
                    </li>';
              
              $count++; // Tăng biến đếm lên 1
              
              // Kiểm tra nếu biến đếm đạt đến 8 thì thoát vòng lặp
              if ($count >= 8) {
                  break;
              }
          }
          
          // Đóng thẻ ul và div item swiper-slide sau vòng lặp
          echo '</ul></div>';
      }

      if ($result2->num_rows > 0) {
        // Mở thẻ div item swiper-slide và ul bên ngoài vòng lặp
        echo '<div class="item swiper-slide"><ul>';
        
        $count = 0; // Khởi tạo biến đếm
        
        while ($row = $result2->fetch_assoc()) {
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

                        <button class="add-to-cart-btn" onclick="addToCartClicked('  .  $row["ID"] . ')">Add to Cart</button>
                      </div>
                    </div>
                  </li>';
            
            $count++; // Tăng biến đếm lên 1
            
            // Kiểm tra nếu biến đếm đạt đến 8 thì thoát vòng lặp
            if ($count >= 8) {
                break;
            }
        }
        
        // Đóng thẻ ul và div item swiper-slide sau vòng lặp
        echo '</ul></div>';
    }

    if ($result2->num_rows > 0) {
      // Mở thẻ div item swiper-slide và ul bên ngoài vòng lặp
      echo '<div class="item swiper-slide"><ul>';
      
      $count = 0; // Khởi tạo biến đếm
      
      while ($row = $result2->fetch_assoc()) {
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

                      <button class="add-to-cart-btn" onclick="addToCartClicked('  .  $row["ID"] . ')">Add to Cart</button>
                    </div>
                  </div>
                </li>';
          
          $count++; // Tăng biến đếm lên 1
          
          // Kiểm tra nếu biến đếm đạt đến 8 thì thoát vòng lặp
          if ($count >= 8) {
              break;
          }
      }
      
      // Đóng thẻ ul và div item swiper-slide sau vòng lặp
      echo '</ul></div>';
  }

  if ($result2->num_rows > 0) {
    // Mở thẻ div item swiper-slide và ul bên ngoài vòng lặp
    echo '<div class="item swiper-slide"><ul>';
    
    $count = 0; // Khởi tạo biến đếm
    
    while ($row = $result2->fetch_assoc()) {
        $imagePath = "../assets/products/Food" . $row["ID"] . ".jpg";
        
        echo '<li>
                <div class="thumbnail covering">
                  <a href="#">
                      <img class="hover_img" src="'. $imagePath .'" alt=""/>
                  </a>
                </div>
                <div class="meta">
                  <div class="catrate"
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

                    <button class="add-to-cart-btn" onclick="addToCartClicked('  .  $row["ID"] . ')">Add to Cart</button>
                  </div>
                </div>
              </li>';
        
        $count++; // Tăng biến đếm lên 1
        
        // Kiểm tra nếu biến đếm đạt đến 8 thì thoát vòng lặp
        if ($count >= 8) {
            break;
        }
    }
    
    // Đóng thẻ ul và div item swiper-slide sau vòng lặp
    echo '</ul></div>';
}
?>
            
      
              </div>
            </div>
          </div>
        </div>
        
      </main>
      <footer>
        <div id="contact" class="container">
          <div class="wrapper">
            <div class="widget-footer">
              <h4>Resto</h4>
              <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Feature</a></li>
                <li><a href="#">Our Menu</a></li>
                <li><a href="#">Blog</a></li>
              </ul>
            </div>

            <div class="widget-footer">
              <h4>Support</h4>
              <ul>
                <li><a href="#">Support Center</a></li>
                <li><a href="#">Feedback</a></li>
                <li><a href="#">Q n A</a></li>
                <li><a href="#">Contact Us</a></li>
              </ul>
            </div>

            <div class="widget-footer">
              <div class="logo"><a href="#">.webfood</a></div>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad,
                quia.
              </p>
              <p>Jl. Pahlawan No 1 Semarang, <br />Central Java - ID</p>
              <ul class="socials">
                <li>
                  <a
                    href="https://www.facebook.com/profile.php?id=100069545576794"
                    target="_blank"
                    ><i class="fa-brands fa-facebook"></i
                  ></a>
                </li>
                <li>
                  <a href="https://www.instagram.com/imbee.3/" target="_blank"
                    ><i class="fa-brands fa-instagram"></i
                  ></a>
                </li>
                <li>
                  <a href="#"><i class="fa-brands fa-youtube"></i></a>
                </li>
              </ul>
            </div>

            <div class="Address">
              <div class="logo"><a href="#">Address</a></div>
              <p>Nha hang do au tai Phap</p>

              <img src="../assets/address/address1.png" alt="" />
            </div>
          </div>
          <p class="copyright">© 2023 webdesign All rights resvered.</p>
        </div>
      </footer>
      <!-- footer -->

      <!-- modal cart -->

      <div id="cart-notification" class="hidden">
        <p><i class="fa-regular fa-face-smile"></i>You have added to cart</p>
      </div>
      <!-- notification added -->

      <div id="payed-notification" class="hidden">
        <p><i>You have paid</i></p>
      </div>
      <!-- notification payed -->

      <div id="cancel-notification" class="hidden">
        <p><i>You must add items to the cart</i></p>
      </div>
      <!-- notification cancel -->


      <div class="modal_pay js-modal-pay">
        <div class="confirmation-box">
          <h4>Are you sure you want to pay?</h4>
          <div class="btn-container">
            <button class="confirm-button">Yes</button>
            <button class="cancel-button">No</button>
          </div>
        </div>
      </div>
      <!-- modal pay -->
    </div>
    <div class="overlay"></div>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="./script.js"></script>

    <script>

        var userRole = '<?php echo $role; ?>';
        // Thiết lập sự kiện click cho biểu tượng người dùng
        document.getElementById('userLink').addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định
            if (userRole === 'admin') {
                window.location.href = '../DashboardAdmin/dashboardAdmin.php';
                
            } else if (userRole === 'user') {

                window.location.href = '../Dashboard/info.php';
                
            } else {

                alert('Bạn chưa đăng nhập!');
                // Hoặc chuyển hướng đến trang đăng nhập
                window.location.href = '../index.html';
            }
        });


   
    </script>
  </body>
</html>