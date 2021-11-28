<?php
include('config/dbcon.php');
include('authentication.php');

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

<script type="text/javascript" src="assets/dist/js/jquery.js"></script>
<script type="text/javascript" src="assets/dist/js/qrcode.js"></script>
<!--Add User Modal -->
<div class="modal fade" id="AddMember" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Member</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="code.php" method="POST">
          <div class="modal-body">
            <div class="form-group">
                <lable for="text" >Member Name</lable>
                <input type="text" name="member_name" class="form-control" placeholder="Membership Name" required>
            </div>
            <div class="form-group">
                <lable for="">Membership Period</lable>
                <input type="text" name="membership_period" class="form-control" placeholder="Membership Period" required>
            </div>
            <div class="form-group">
                <lable for="">Social ID</lable>
                <input type="text" name="Social_id" class="form-control" placeholder="Scoial ID" required>
            </div>
            <div class="form-group">
                <lable for="">Membership Start Date</lable>
                <input type="Date" name="membership_sdate" class="form-control" placeholder="Membership Start Date" required>
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
                <lable for="">Donated Amount</lable>
                <input type="text" name="donated_amount" class="form-control" placeholder="Donated Amount" required>
            </div>
            <div class="form-group">
                <lable for="">Phone Number</lable>
                <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" required>
            </div>
            <div class="form-group">
                <lable for="">Email</lable>
                <input type="text" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <lable for="">Password</lable>
                  <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <lable for="">Confirm Password</lable>
                  <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="addMember" class="btn btn-primary">Save</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Delete Member</h5>
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
          <button type="submit" name="DeleteMember" class="btn btn-primary">Yes, Delete.!</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Delete User Model-->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <section class="content mt-4">
    
      <div class="row">
        <div class="col-md-14">
          <?php include('message.php'); ?>
          <div class="card">
            <div class="card-header">
              <h4>
                Member
                <a href="" data-toggle="modal" data-target="#AddMember" class="btn btn-primary float-right">Add Member</a>
              </h4>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Member ID</th>
                    <th>Member Name</th>
                    <th>Membership Period</th>
                    <th>Social ID</th>
                    <th>Membership Start Date</th>
                    <th>Plant ID</th>
                    <th>Donated Discount</th>
                    <th>Phone Number</th>
                    <th>Email
                    <th>User Type</th>
                    <th>QR</th>
                    <th>Edit</th>
                    <th>Delete</th></th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  $query = "SELECT * FROM member";
                  $query_run = mysqli_query($con, $query);

                  if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $row) {
                  ?>
                      <tr>
                        <td>
                          <?php echo $row['member_id'] ?>
                        </td>
                        <td>
                          <?php echo $row['member_name'] ?>
                        </td>
                        <td>
                          <?php echo $row['membership_period'] ?>
                        </td>
                        <td>
                          <?php echo $row['Social_id'] ?>
                        </td>
                        <td>
                          <?php echo $row['membership_sdate'] ?>
                        </td>
                        <td>
                          <?php echo $row['plant_id'] ?>
                        </td>
                        <td>
                          <?php echo $row['donated_amount'] ?>
                        </td>
                        <td>
                          <?php echo $row['phone_number'] ?>
                        </td>
                        <td>
                          <?php echo $row['email'] ?>
                        </td>
                        <td>
                          <?php
                          if ($row['uType_ID'] == "0") {
                            echo "User";
                          } elseif ($row['uType_ID'] == "1") {
                            echo "Admin";
                          } else {
                            echo "Invalid User";
                          }
                          ?>
                        </td>

                        <td>
                         <button onclick="generate();return false;">Click me</button>
                        </td>

                        <td>
                          <a href="member-edit.php?member_id=<?php echo $row['member_id']; ?>" class="btn btn-info btn-sm">Edit</a>
                        </td>
                        <td>
                           <button type="button" value="<?php echo $row['member_id']; ?>" class="btn btn-danger deletebtn">Delete</a>
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
<script type="text/javascript" src="assets/dist/js/qrReader.js"></script>

<?php include('includes/footer.php'); ?>