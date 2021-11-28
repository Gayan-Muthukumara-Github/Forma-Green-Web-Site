<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    
    <!-- Navbar Search -->
    <form class="form-inline ml-auto">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
  </ul>



  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
          <?php
          if (isset($_SESSION['auth'])) {
            echo $_SESSION['auth_user']['member_name'];
          } else {
            echo "Not Logged in";
          }
          ?>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="adminprofile.php">Admin Profile</a>
          <form action="code.php" method="POST">
            <button type="submit" name="logout_btn" class="dropdown-item">Logout</button>
          </form>
        </div>
      </div>
    </li>
    
  </ul>
</nav>
<!-- /.navbar -->