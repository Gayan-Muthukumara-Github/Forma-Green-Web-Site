<?php
session_start();
include('config/dbcon.php');
?>
<?php
  /* Database connection settings */
  $host = 'localhost';
  $user = 'root';
  $pass = '';
  $db = 'member_db';
  $mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

  $coordinates = array();
  $latitudes = array();
  $longitudes = array();

  // Select all the rows in the markers table
  $query = "SELECT  `latitude`, `longitude` FROM `green_area` ";
  $result = $mysqli->query($query) or die('data selection for google map failed: ' . $mysqli->error);

  while ($row = mysqli_fetch_array($result)) {

    $latitudes[] = $row['latitude'];
    $longitudes[] = $row['longitude'];
    $coordinates[] = 'new google.maps.LatLng(' . $row['latitude'] .','. $row['longitude'] .'),';
  }

  //remove the comaa ',' from last coordinate
  $lastcount = count($coordinates)-1;
  $coordinates[$lastcount] = trim($coordinates[$lastcount], ","); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Forma Green</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="shortcut icon" href="images/logo.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/style-starter.css">

  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/style.css">

</head>

<body>

  <div class="site-wrap">
    <header class="site-navbar" role="banner">
      <div class="site-navbar-top">
        <div class="container">
          <div class="row align-items-center">

            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
              <form action="" class="site-block-top-search">
                <span class="icon icon-search2"></span>
                <input class="form-control border-0" type="search" placeholder="Search" aria-label="Search">
              </form>
            </div>

            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
              <div class="site-logo">
                <a href="index.php" class="js-logo-clone">MEMBER MANEGEMENT</a>
              </div>
            </div>

            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
              <div class="site-top-icons">
                <ul>
                  <li>
                    <h5>
                      <?php
                      if (isset($_SESSION['auth'])) {
                        echo "Hello " . $_SESSION['auth_user']['member_name'];
                      } else {
                        echo "Not Logged in";
                      }
                      ?>
                    </h5>
                  </li>
                  <li>

                    <div class="dropdown">
                      <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon icon-person"></span>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <form action="code.php" method="POST">
                          <button type="submit" name="login_btn" class="dropdown-item">Login</button>
                          <button type="submit" name="signup_btn" class="dropdown-item">Sign Up</button>
                          <button type="submit" name="logout_btn" class="dropdown-item">Logout</button>
                          <button type="submit" name="user_btn" class="dropdown-item">User Profile</button>
                          <button type="submit" name="adminlogin_btn" class="dropdown-item">Admin Panel</button>
                        </form>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h5 class="modal-title text-dark" id="exampleModalLabel">Login</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="logincode.php" method="POST">
              <div class="modal-body">
                <div class="form-group">
                  <input type="text" name="username" class="form-control" placeholder="User Name">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addUser" class="btn btn-dark">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="signup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h5 class="modal-title text-dark" id="exampleModalLabel">Sign Up</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="code.php" method="POST">
              <div class="modal-body">
                <div class="form-group">
                  <input type="text" name="username" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                  <input type="text" name="phonenumber" class="form-control" placeholder="Phone Number">
                </div>
                <div class="form-group">
                  <span class="email_error"></span>
                  <input type="email" name="email" class="form-control email_id" placeholder="Email">
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addUser" class="btn btn-dark">Sign Up</button>
              </div>
            </form>
          </div>
        </div>
      </div>







      <nav class="site-navigation text-right text-md-center bg-success" role="navigation">
        <div class="container">
          <ul class="site-menu js-clone-nav d-none d-md-block">
            <li><a href="index.php">Home</a></li>
            <li><a href="vegicenter.php">Vegetalized enters</a></li>
            <li><a href="discount.php">View Discount</a></li>
            <li><a href="aboutus.php">About Us</a></li>
          </ul>
        </div>
      </nav>
    </header>


          

      <div class="container">
        <div class="row align-items-start align-items-md-center justify-content-end">
          <div class="col-lg-12 text-center">
            <div class="intro-text text-center">
              <form class="form-horizontal" action="" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                  <div class="form-area">    
                    <div class="col-12 m-2">   
                        <button type="submit" id="submit" name="import" class="btn btn-lg btn-warning btn-submit">RELOAD DATA</button><br />
                    </div>
                </div>
                </form>
              </p>
            </div>
          </div>
        </div>
      </div>
    

     
    <div class="container">
      <div id="map" style="width: 100%; height: 80vh;" class="mb-5"></div>
    </div>

    <script>
      function initMap() {
        var mapOptions = {
          zoom: 18,
          center: {<?php echo'lat:'. $latitudes[0] .', lng:'. $longitudes[0] ;?>}, //{lat: --- , lng: ....}
          mapTypeId: google.maps.MapTypeId.SATELITE
        };

        var map = new google.maps.Map(document.getElementById('map'),mapOptions);

        var RouteCoordinates = [
          <?php
            $i = 0;
          while ($i < count($coordinates)) {
            echo $coordinates[$i];
            $i++;
          }
          ?>
        ];

        var RoutePath = new google.maps.Polyline({
          path: RouteCoordinates,
          geodesic: true,
          strokeColor: '#1100FF',
          strokeOpacity: 1.0,
          strokeWeight: 10
        });

        mark = 'images/mark.png';
        flag = 'images/mark.png';

        startPoint = {<?php echo'lat:'. $latitudes[0] .', lng:'. $longitudes[0] ;?>};
        endPoint = {<?php echo'lat:'.$latitudes[$lastcount] .', lng:'. $longitudes[$lastcount] ;?>};

        var marker = new google.maps.Marker({
          position: startPoint,
          map: map,
          icon: mark,
          title:"Start point!",
          animation: google.maps.Animation.BOUNCE
        });

        var marker = new google.maps.Marker({
        position: endPoint,
         map: map,
         icon: flag,
         title:"End point!",
         animation: google.maps.Animation.DROP
      });

        RoutePath.setMap(map);
      }

      google.maps.event.addDomListener(window, 'load', initialize);
      </script>

      <!--remenber to put your google map key-->
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-dFHYjTqEVLndbN2gdvXsx09jfJHmNc8&callback=initMap"></script>









       
    <footer class="site-footer border-top bg-warning">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="row">
              <div class="col-md-12">
                <h3 class="footer-heading mb-4">Navigations</h3>
              </div>
              <div class="col-md-6 col-lg-6 ">
                <ul class="list-unstyled">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="vegicenter.php">Vegetalized Centers</a></li>
                  <li><a href="discount.php">View Discount</a></li>
                  <li><a href="aboutus.php">About Us</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6">
            <div class="block-5 mb-5">
              <h3 class="footer-heading mb-4">Contact Info</h3>
              <ul class="list-unstyled">
                <li class="address dark">No:80, Donel Road, Colombo 2</li>
                <li class="phone"><a href="tel://23923929210">+94 77 946 9179</a></li>
                <li class="email"><a href="mailto:formagreen@gmail.com">formagreen@gmail.com</a></li>
              </ul>
            </div>

            
          </div>
        </div>
        <div class="text-center">
          © 2020 Copyright:
          <a class="text-dark" href="index.php">www.formagreen.com</a>
        </div>
      </div>
    </footer>
  </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/main.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            // Send product details in the server
            $(".addItemBtn").click(function(e) {
                e.preventDefault();
                var $form = $(this).closest(".form-submit");
                var u_id = $form.find(".u_id").val();
                var u_size = $form.find(".u_size").val()
                var u_qty = $form.find(".u_qty").val();

                $.ajax({
                    url: 'code.php',
                    method: 'post',
                    data: {
                        u_id: u_id,
                        u_size: u_size,
                        u_qty: u_qty
                    },
                    success: function(response) {
                        $("#message").html(response);
                        window.scrollTo(0, 0);
                        load_cart_item_number();
                    }
                });
            });

            // Load total no.of items added in the cart and display in the navbar
            load_cart_item_number();

            function load_cart_item_number() {
                $.ajax({
                    url: 'code.php',
                    method: 'get',
                    data: {
                        cartItem: "cart_item"
                    },
                    success: function(response) {
                        $("#cart-item").html(response);
                    }
                });
            }
        });
    </script>

</body>

</html>