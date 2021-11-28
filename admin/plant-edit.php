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
            <li class="breadcrumb-item active">Edit - Plant</li>
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
                Edit - Plant
              </h3>
              <a href="plant.php" class="btn btn-danger btn-sm float-right">BACK</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <form action="code.php" method="POST">
                    <div class="modal-body">
                      <?php
                      if (isset($_GET['plant_id'])) {
                        $plant_id = $_GET['plant_id'];
                        $query = "SELECT * FROM plant WHERE plant_id ='$plant_id' LIMIT 1";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                          foreach ($query_run as $row) {
                      ?>
                            <input type="hidden" name="plant_id" value="<?php echo $row['plant_id'] ?>">
                            <div class="form-group">
                              <lable for="">Plant ID</lable>
                              <input type="text" name="plant_id" value="<?php echo $row['plant_id'] ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                              <lable for="">SizPlant Name</lable>
                              <input type="text" name="plant_name" value="<?php echo $row['plant_name'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                              <lable for="">Plant Address</lable>
                              <input type="text" name="plant_address" value="<?php echo $row['plant_address'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                              <lable for="">Plant Phone Number</lable>
                              <input type="text" name="plant_phone_number" value="<?php echo $row['plant_phone_number'] ?>" class="form-control">
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
                      <button type="submit" name="editPlant" class="btn btn-info">Update</button>
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