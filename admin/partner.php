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
        <h5 class="modal-title" id="exampleModalLabel">Add Partner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <lable for="">Partner Name</lable>
            <input type="text" name="partner_name" class="form-control" placeholder="Partner Name">
          </div>
          <div class="form-group">
            <lable for="">Discount</lable>
            <input type="text" name="discount" class="form-control" placeholder="Discount">
          </div>
          <div class="form-group">
            <lable for="">City</lable>
            <input type="text" name="city" class="form-control" placeholder="City">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="addPartner" class="btn btn-primary">Save</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Delete Partner</h5>
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
          <button type="submit" name="DeletePartner" class="btn btn-primary">Yes, Delete.!</button>
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
                Partner
                <a href="" data-toggle="modal" data-target="#AddArea" class="btn btn-primary float-right">Add Partner</a>
              </h4>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Partner ID</th>
                    <th>Partner Name</th>
                    <th>Discount</th>
                    <th>City</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>

                  <?php

                  $query = "SELECT * FROM partner";
                  $query_run = mysqli_query($con, $query);

                  if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $cate) {
                  ?>
                      <tr>
                        <td><?= $cate['partner_id'] ?></td>
                        <td><?= $cate['partner_name'] ?></td>
                        <td><?= $cate['discount'] ?></td>
                        <td><?= $cate['city'] ?></td>
                        <td>
                          <a href="partner-edit.php?partner_id=<?php echo $cate['partner_id']; ?>" class="btn btn-success">Edit</a>
                        </td>
                        <td>
                           <button type="button" value="<?php echo $cate['partner_id']; ?>" class="btn btn-danger deletebtn">Delete</a>
                        </td>
                      </tr>
                    <?php
                    }
                  } else {
                    ?>
                    <tr>
                      <td colspan="6">No Record Found</td>
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