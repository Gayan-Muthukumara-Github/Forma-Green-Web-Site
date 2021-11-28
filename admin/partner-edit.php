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
            <li class="breadcrumb-item active">Edit - Partner</li>
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
                Edit - Partner
              </h3>
              <a href="partner.php" class="btn btn-danger btn-sm float-right">BACK</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <form action="code.php" method="POST">
                    <div class="modal-body">
                      <?php
                      if (isset($_GET['partner_id'])) {
                        $partner_id = $_GET['partner_id'];
                        $query = "SELECT * FROM partner WHERE partner_id ='$partner_id' LIMIT 1";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                          foreach ($query_run as $row) {
                      ?>
                            <input type="hidden" name="partner_id" value="<?php echo $row['partner_id'] ?>">
                            <div class="form-group">
                              <lable for="">Partner ID</lable>
                              <input type="text" name="partner_id" value="<?php echo $row['partner_id'] ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                              <lable for="">Partner Name</lable>
                              <input type="text" name="partner_name" value="<?php echo $row['partner_name'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                              <lable for="">Discount</lable>
                              <input type="text" name="discount" value="<?php echo $row['discount'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                              <lable for="">City</lable>
                              <input type="text" name="city" value="<?php echo $row['city'] ?>" class="form-control">
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
                      <button type="submit" name="editPartner" class="btn btn-info">Update</button>
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