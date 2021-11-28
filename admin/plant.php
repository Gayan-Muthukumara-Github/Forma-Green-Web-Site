<?php
include('config/dbcon.php');
include('authentication.php');

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>
<!--Add User Modal -->
<div class="modal fade" id="AddArea" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Plant</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <lable for="">Plant Name</lable>
            <input type="text" name="plant_name" class="form-control" placeholder="Plant Name">
          </div>
          <div class="form-group">
            <lable for="">Plant Address</lable>
            <input type="text" name="plant_address" class="form-control" placeholder="Plant Address">
          </div>
          <div class="form-group">
            <lable for="">Phone Number</lable>
            <input type="text" name="plant_phone_number" class="form-control" placeholder="Phone Number">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="addPlant" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Add User Modal -->
<!--Delete User Modal -->
<div class="modal fade" id="DeletModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Plant</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">
        <div class="modal-body">
          <input type="hidden" name="delete_id" class="delete_location_id">
          <p>
            Are you sure. you want to delete this data?
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="DeletePlant" class="btn btn-primary">Yes, Delete.!</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Delete User Model-->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <section class="content mt-4">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <?php include('message.php'); ?>
          <div class="card">
            <div class="card-header">
              <h4>
                Plant
                <a href="" data-toggle="modal" data-target="#AddArea" class="btn btn-primary float-right">Add Plant</a>
              </h4>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Plant ID</th>
                    <th>Plant Name</th>
                    <th>Plant Address</th>
                    <th>Plant Phone Number</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>

                  <?php

                  $query = "SELECT * FROM plant";
                  $query_run = mysqli_query($con, $query);

                  if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $cate) {
                  ?>
                      <tr>
                        <td><?= $cate['plant_id'] ?></td>
                        <td><?= $cate['plant_name'] ?></td>
                        <td><?= $cate['plant_address'] ?></td>
                        <td><?= $cate['plant_phone_number'] ?></td>
                        <td>
                          <a href="plant-edit.php?plant_id=<?php echo $cate['plant_id']; ?>" class="btn btn-success">Edit</a>
                        </td>
                        <td>
                           <button type="button" value="<?php echo $cate['plant_id']; ?>" class="btn btn-danger deletebtn">Delete</a>
                        </td>
                      </tr>
                    <?php
                    }
                  } else {
                    ?>
                    <tr>
                      <td colspan="9">No Record Found</td>
                    </tr>
                  <?php
                  }
                  ?>

                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include('includes/script.php'); ?>

<script>
  $(document).ready(function() {
    $('.deletebtn').click(function(e) {
      e.preventDefault();

      var location_id = $(this).val();
      $('.delete_location_id').val(location_id);
      $('#DeletModal').modal('show');

    });
  });
</script>


<?php include('includes/footer.php'); ?>