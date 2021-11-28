<?php
include('includes/header.php');
include('config/dbcon.php');
session_start();
$id = $_GET['MnoQtyPXZORTE'];
$message = $Home = '';
$_SESSION['user'] = $id;
if ($_SESSION['user'] == '') {
    header("location:forget_pass.php");
} else {
    if (isset($_POST['submit'])) {
        $password = $_POST['newpassword'];
        $confirmpassword = $_POST['confirmpassword'];

        if ($password !== $confirmpassword) {
            $_SESSION['status'] = "Password Not Match..!!";
        } else {
            $id_decode = base64_decode($id);
            $query = "UPDATE users SET password = '$password' WHERE user_ID = '$id_decode' ";
            $result = $con->query($query);
            if ($result) {
                $_SESSION['status'] = "Reset Your Password Successfully..";
                $Home = "<a href='login.php' class='btn btn-dark btn-block'>Login</a>";
            } else {
                $_SESSION['status'] = "Failed to Reset Password..!!";
            }
        }
    }
}
?>

<div class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 my-5">
                <?php include('message.php'); ?>
                <div class="card my-5">
                    <div class="card-header bg-warning">
                        <h5>Reset Password</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group">
                                <lable for="">New Password</lable>
                                <input type="text" name="newpassword" class="form-control" placeholder="New Password">
                            </div>
                            <div class="form-group">
                                <lable for="">Confirm Password</lable>
                                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
                            </div>
                            <hr>
                            <div class="modal-footer">
                                <button type="submit" name="submit" class="btn btn-dark btn-block">Reset Password</button>
                                <?php echo $Home; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/script.php'); ?>