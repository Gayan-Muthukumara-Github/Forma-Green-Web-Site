<?php
include('config/dbcon.php');
session_start();
include('includes/header.php');
if (isset($_SESSION['auth'])) {
    $_SESSION['status'] = "You are already logged in";
    header('Location: index.php');
    exit(0);
}
?>

<div class="section bg-black">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 my-5">
                <?php
                if (isset($_SESSION['auth_status'])) {
                ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey!</strong> <?php echo $_SESSION['auth_status']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                    unset($_SESSION['auth_status']);
                }

                ?>

                <?php
                include('message.php');
                ?>

                <div class="card my-5">
                    <div class="card-header bg-warning">
                        <h5>Sign Up Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" class="text-dark">
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
                                <input type="text" name="social_id" class="form-control" placeholder="Scoial ID" required>
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
                                <lable for="">Phone Number</lable>
                                <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" required>
                            </div>
                            
                            <div class="form-group">
                                <lable for="">Email</lable>
                                <input type="text" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            
                            
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <lable for="">Password</lable>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <lable for="">Confirm Password</lable>
                                    <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" name="addUser_website" class="btn btn-dark btn-block">Sign Up</button>
                            </div>
                            <div class="form-group">
                                <lable for=""><span class="text-dark">Already have an account?</span><a href="login.php"> Login</a></lable>
                            </div>
                            <div id="message">
                                <h3>Password must contain the following:</h3>
                                <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                <p id="number" class="invalid">A <b>number</b></p>
                                <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                            </div>      
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>

<?php include('includes/script.php'); ?>