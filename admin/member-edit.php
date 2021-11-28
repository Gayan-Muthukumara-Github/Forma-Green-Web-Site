<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit - Registered Member</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <section class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                Edit - Registered User
              </h3>
              <a href="registered.php" class="btn btn-danger btn-sm float-right">BACK</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <form action="code.php" method="POST">
                    <div class="modal-body">
                      <?php
                      if (isset($_GET['member_id'])) {
                        $member_id = $_GET['member_id'];
                        $query = "SELECT * FROM member WHERE member_id='$member_id' LIMIT 1";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                          foreach ($query_run as $row) {
                      ?>
                            <input type="hidden" name="member_id" value="<?php echo $row['member_id'] ?>">
                            <div class="form-group">
                              <lable for="">Member ID</lable>
                              <input type="text" name="member_id" value="<?php echo $row['member_id'] ?>" class="form-control" placeholder="Name" readonly>
                            </div>
                            <div class="form-group">
                              <lable for="">Member Name</lable>
                              <input type="text" name="member_name" value="<?php echo $row['member_name'] ?>" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                              <lable for="">Membership Period</lable>
                              <input type="text" name="membership_period" value="<?php echo $row['membership_period'] ?>" class="form-control" placeholder="First Name">
                            </div>
                            <div class="form-group">
                              <lable for="">Social ID</lable>
                              <input type="text" name="social_id" value="<?php echo $row['Social_id'] ?>" class="form-control" placeholder="Last Name">
                            </div>
                            <div class="form-group">
                              <lable for="">Membership Start Date</lable>
                              <input type="date" name="membership_sdate" value="<?php echo $row['membership_sdate'] ?>" class="form-control" placeholder="Address">
                            </div>
                                                        <div class="form-group">

                              <lable for="">Plant ID</lable>
                              <select class="form-control" name="plant_id" class="form-control">
                                <?php

                                $query = "SELECT plant_id FROM plant";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                  foreach ($query_run as $cnm) {
                                ?>

                                    <option><?= $cnm['plant_id'] ?></option>

                                  <?php
                                  }
                                } else {
                                  ?>

                                  <p>No Record Found</p>

                                <?php
                                }
                                ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <lable for="">Donated Discount</lable>
                              <input type="text" name="donated_amount" value="<?php echo $row['donated_amount'] ?>" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group">
                              <lable for="">Phone Number</lable>
                              <input type="text" name="phone_number" value="<?php echo $row['phone_number'] ?>" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group">
                              <lable for="">Email</lable>
                              <input type="text" name="email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group">
                              <lable for="">Give Role</lable>
                              <select name="uType_ID" class="form-control" required>
                                <option value="">Select</option>
                                <option value="1">Admin</option>
                                <option value="0">User</option>
                              </select>
                            </div>
                      <?php
                          }
                        } else {
                          echo "<h4>No Record Found.!</h4>";
                        }
                      }
                      ?>

                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="updateMember" class="btn btn-info">Update</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>