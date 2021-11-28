<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/dbcon.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!--User Modal -->
    <div class="modal fade" id="AddUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="code.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <lable for=""> User Name</lable>
                            <input type="text" name="username" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <lable for="">Phone Number</lable>
                            <input type="text" name="phonenumber" class="form-control" placeholder="Phone Number">
                        </div>
                        <div class="form-group">
                            <lable for="">Email Id</lable>
                            <span class="email_error"></span>
                            <input type="email" name="email" class="form-control email_id" placeholder="Email">
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
                                    <input type="password" name="confirmpassword" class="form-control"
                                        placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="addUser" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End User Modal -->

    <!--User Modal -->
    <div class="modal fade" id="DeletModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="code.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="delete_id" class="delete_user_id">
                        <p>
                            Are you sure. you want to delete this data?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="DeleteUserbtn" class="btn btn-primary">Yes, Delete.!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete User -->



    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Admin Profile</h1>
                </div><!-- /.col -->
                
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
          if (isset($_SESSION['status'])) {
            echo "<h1>" . $_SESSION['status'] . "</h1>";
            unset($_SESSION['status']);
          }
          ?>
                    <div class="well span6 text-center mt-5">
                        <div class="row-fluid">
                            <div class="span2">
                                <img src="data:image/jpeg;base64,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" class="img-circle center">
                            </div>

                            <div class="span8 mt-5">
                                <?php
                                if (isset($_SESSION['auth'])) {
                                    $member_ID = $_SESSION['auth_user']['member_id'];
                                    $query = "SELECT * FROM member WHERE member_id='$member_ID'";
                                    $query_run = mysqli_query($con, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $use) {
                                    ?>
                                        <h3><?= $use['member_id'] ?></h3>
                                        <h3><?= $use['member_name'] ?></h3>
                                        <h6><?= $use['email'] ?></h6>
                                        <h6>0<?= $use['phone_number'] ?></h6>
                                        <h6><?= $use['Social_id'] ?></h6>
                                    <?php
                                    }
                                  }
                                }
                                    ?>
                            </div>
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

    $('.email_id').keyup(function(e) {
        var email = $('.email_id').val();

        $.ajax({
            type: "POST",
            url: "code.php",
            data: {
                'check_Emailbtn': 1,
                'email': email,
            },
            success: function(response) {
                $('.email_error').text(response);
            }
        });
    });
});
</script>





<script>
$(document).ready(function() {
    $('.deletebtn').click(function(e) {
        e.preventDefault();

        var user_id = $(this).val();
        $('.delete_user_id').val(user_id);
        $('#DeletModal').modal('show');

    });
});
</script>

<?php include('includes/footer.php'); ?>