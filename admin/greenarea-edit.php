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
            <li class="breadcrumb-item active">Edit - Green Area</li>
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
                Edit - Green Area
              </h3>
              <a href="greenarea.php" class="btn btn-danger btn-sm float-right">BACK</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <form action="code.php" method="POST">
                    <div class="modal-body">
                      <?php
                      if (isset($_GET['location_id'])) {
                        $location_id = $_GET['location_id'];
                        $query = "SELECT * FROM green_area WHERE location_id ='$location_id' LIMIT 1";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                          foreach ($query_run as $row) {
                      ?>
                            <input type="hidden" name="location_id" value="<?php echo $row['location_id'] ?>">
                            <div class="form-group">
                              <lable for="">Location ID</lable>
                              <input type="text" name="location_id" value="<?php echo $row['location_id'] ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                              <lable for="">Location Name</lable>
                              <input type="text" name="location_name" value="<?php echo $row['location_name'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                              <lable for="">Longitude</lable>
                              <input type="text" name="longitude" value="<?php echo $row['longitude'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                              <lable for="">Latitude</lable>
                              <input type="text" name="latitude" value="<?php echo $row['latitude'] ?>" class="form-control">
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
                      <button type="submit" name="editArea" class="btn btn-info">Update</button>
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