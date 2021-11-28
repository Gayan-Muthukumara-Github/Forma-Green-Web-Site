<?php
session_start();
include('config/dbcon.php');
include('config/dbcon.php');


if(isset($_POST['logout_btn']))
{
    //session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);
    
    $_SESSION['status'] = "Logged out successfully";
    header('Location: login.php');
    exit(0);
}


//email check function for signup
if(isset($_POST['check_Emailbtn']))
{
    $email = $_POST['email'];

    $checkemail = "SELECT email FROM users WHERE email='$email'";
    $checkemail_run = mysqli_query($con, $checkemail);

    if(mysqli_num_rows($checkemail_run)>0)
    {
        echo "Email id already taken.!";
    }
    else
    {
        echo "It's Available";
    }
}

//user table add data from website

if(isset($_POST['addUser_website']))
{
    $member_name= $_POST['member_name'];
    $membership_period_1 = $_POST['membership_period'];
    $membership_period_2 = $membership_period . " months";
    $social_id = $_POST['social_id'];
    $membership_sdate = $_POST['membership_sdate'];
    $plant_id = $_POST['plant_id'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $qr = $member_name . "|" . $social_id . "|" . $phone_number . "|" . $email; 

    function validate_phone_number($phone_num)
{
     // Allow +, - and . in phone number
     $filtered_phone_number = filter_var($phone_num, FILTER_SANITIZE_NUMBER_INT);

     // Check the lenght of number
     // This can be customized if you want phone number from a specific country
     if (strlen($filtered_phone_number) == 10 ) {
        return true;
     } else {
       return false;
     }
}

    if($password == $confirmpassword)
    {
        if (validate_phone_number($phone_number) == true) {
            if(filter_var($email, FILTER_VALIDATE_EMAIL) == true)
            {
                $checkemail = "SELECT email FROM member WHERE email='$email'";
                $checkemail_run = mysqli_query($con, $checkemail);

                if(mysqli_num_rows($checkemail_run)>0)
                {
                    //Taken Already exists
                    $_SESSION['status'] = "Email id is already taken.!";
                    header("Location: signup.php");
                }
                else
                {
                    //Available = Record not found
                    $user_query = "INSERT INTO member(member_name, membership_period, Social_id, membership_sdate, plant_id, phone_number, email, password, qr)  VALUES ('$member_name','$membership_period_2','$social_id','$membership_sdate','$plant_id','$phone_number','$email','$password','$qr')";
                    $user_query_run = mysqli_query($con, $user_query);

                    if($user_query_run)
                    {
                        $_SESSION['status'] = "Member Added Successfully";
                        header("Location: login.php");
                    }
                    else
                    {
                        $_SESSION['status'] = "Member Registration Failed";
                        header("Location: signup.php");
                    }
                }  

            }
            else
            {
                $_SESSION['status'] = "Not a valid email address";
                header("Location: signup.php");
            }
        } 
        else 
        {
            $_SESSION['status'] = "Not a valid phone number";
            header("Location: signup.php");
        }
          
    }
    else
    {
        $_SESSION['status'] = "Password and confirm password does not match.!";
        header("Location: signup.php");
    }

    

}

//user table add data from admin panel
if(isset($_POST['addMember']))
{
    $member_name= $_POST['member_name'];
    $membership_period_1 = $_POST['membership_period'];
    $membership_period_2 = $$membership_period_1 . " months";
    $Social_id = $_POST['Social_id'];
    $membership_sdate = $_POST['membership_sdate'];
    $plant_id = $_POST['plant_id'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $donated_amount = $_POST['donated_amount'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $qr = $member_name . "|" . $Social_id . "|" . $phone_number . "|" . $email; 

    if($password == $confirmpassword)
    {

        $checkemail = "SELECT email FROM member WHERE email='$email'";
        $checkemail_run = mysqli_query($con, $checkemail);

        if(mysqli_num_rows($checkemail_run)>0)
        {
            //Taken Already exists
            $_SESSION['status'] = "Email id is already taken.!";
            header("Location: member.php");
        }
        else
        {
            //Available = Record not found
            $user_query = "INSERT INTO member(member_name, membership_period, Social_id, membership_sdate, plant_id, donated_amount, phone_number, email, password, qr) VALUES ('$member_name','$membership_period_2','$Social_id','$membership_sdate','$plant_id','$donated_amount','$phone_number','$email','$password','$qr')";
            $user_query_run = mysqli_query($con, $user_query);

            if($user_query_run)
            {
                $_SESSION['status'] = "Member Added Successfully";
                header("Location: member.php");
            }
            else
            {
                $_SESSION['status'] = "Member Adding Failed";
                header("Location: member.php");
            }
        }

        
    }
    else
    {
        $_SESSION['status'] = "Password and confirm password does not match.!";
        header("Location: member.php");
    }

    

}

//user table edit data from admin panel
if(isset($_POST['updateMember']))
{
    $member_id= $_POST['member_id'];
    $member_name= $_POST['member_name'];
    $membership_period = $_POST['membership_period'];
    $social_id = $_POST['social_id'];
    $membership_sdate = $_POST['membership_sdate'];
    $plant_id = $_POST['plant_id'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $donated_amount = $_POST['donated_amount'];
    $password = $_POST['password'];
    $uType_ID= $_POST['uType_ID'];

    $query = "UPDATE member SET member_id='$member_id', 
    member_name='$member_name', 
    membership_period='$membership_period', 
    Social_id='$social_id',membership_sdate='$membership_sdate' ,
    plant_id='$plant_id',donated_amount='$donated_amount' ,
    phone_number='$phone_number' ,email='$email' , 
    uType_ID='$uType_ID' WHERE member_id='$member_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Member Updated Successfully";
        header("Location: member.php");
    }
    else
    {
        $_SESSION['status'] = "Member Updating Failed";
        header("Location: member.php");
    }

}

//user table delete data from admin panel
if(isset($_POST['DeleteMember']))
{
    $member_id = $_POST['delete_id'];
   
    $query = "DELETE FROM member WHERE member_id ='$member_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Green Area Deleted Successfully";
        header("Location: member.php");
    }
    else
    {
        $_SESSION['status'] = "Green Area Deleting Failed";
        header("Location: member.php");
    }

}

//categoryprice table add data from admin panel
if(isset($_POST['addArea']))
{
    $location_name = $_POST['location_name'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    
    
    
    $cate_query = "INSERT INTO green_area (location_name,longitude,latitude) VALUES ('$location_name','$longitude','$latitude')";
    $cate_query_run = mysqli_query($con, $cate_query);

    if($cate_query_run)
    {
        $_SESSION['status'] = "Green Area Added Successfully";
        header("Location: greenarea.php");
    }
    else
    {
        $_SESSION['status'] = "Green Area Add Failed";
        header("Location: greenarea.php");
    }
      

}

//categoryprice table edit data from admin panel
if(isset($_POST['editArea']))
{
    $location_id =  $_POST['location_id'];
    $location_name = $_POST['location_name'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];

    $query = "UPDATE green_area SET location_id='$location_id', location_name='$location_name', longitude='$longitude', latitude='$latitude' WHERE location_id='$location_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Green Area Updated Successfully";
        header("Location: greenarea.php");
    }
    else
    {
        $_SESSION['status'] = "Green Area Updating Failed";
        header("Location: greenarea.php");
    }

}

//categoryprice table delete data from admin panel
if(isset($_POST['DeleteArea']))
{
    $loaction_id = $_POST['delete_id'];
   
    $query = "DELETE FROM green_area WHERE location_id ='$loaction_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Green Area Deleted Successfully";
        header("Location: greenarea.php");
    }
    else
    {
        $_SESSION['status'] = "Green Area Deleting Failed";
        header("Location: greenarea.php");
    }

}


if(isset($_POST['addPartner']))
{
    $partner_name = $_POST['partner_name'];
    $discount = $_POST['discount'];
    $city = $_POST['city'];
    
    
    
    $cate_query = "INSERT INTO partner (partner_name,discount,city) VALUES ('$partner_name','$discount','$city')";
    $cate_query_run = mysqli_query($con, $cate_query);

    if($cate_query_run)
    {
        $_SESSION['status'] = "Partner Added Successfully";
        header("Location: partner.php");
    }
    else
    {
        $_SESSION['status'] = "Partner Add Failed";
        header("Location: partner.php");
    }
      

}

if(isset($_POST['editPartner']))
{
    $partner_id =  $_POST['partner_id'];
    $partner_name = $_POST['partner_name'];
    $discount = $_POST['discount'];
    $city = $_POST['city'];

    $query = "UPDATE partner SET partner_id='$partner_id', partner_name='$partner_name', discount='$discount', city='$city' WHERE partner_id='$partner_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Partner Updated Successfully";
        header("Location: partner.php");
    }
    else
    {
        $_SESSION['status'] = "Partner Updating Failed";
        header("Location: partner.php");
    }

}

if(isset($_POST['DeletePartner']))
{
    $partner_id = $_POST['delete_id'];
   
    $query = "DELETE FROM partner WHERE partner_id ='$partner_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Partner Deleted Successfully";
        header("Location: partner.php");
    }
    else
    {
        $_SESSION['status'] = "Partner Deleting Failed";
        header("Location: partner.php");
    }

}


if(isset($_POST['addPlant']))
{
    $plant_name = $_POST['plant_name'];
    $address = $_POST['plant_address'];
    $phone_number = $_POST['plant_phone_number'];
    
    
    
    $cate_query = "INSERT INTO plant (plant_name,plant_address,plant_phone_number) VALUES ('$plant_name','$address','$phone_number')";
    $cate_query_run = mysqli_query($con, $cate_query);

    if($cate_query_run)
    {
        $_SESSION['status'] = "Plant Added Successfully";
        header("Location: plant.php");
    }
    else
    {
        $_SESSION['status'] = "Plant Add Failed";
        header("Location: plant.php");
    }
      

}

if(isset($_POST['editPlant']))
{
    $plant_id =  $_POST['plant_id'];
    $plant_name = $_POST['plant_name'];
    $address = $_POST['plant_address'];
    $phone_number = $_POST['plant_phone_number'];

    $query = "UPDATE plant SET plant_id='$plant_id', plant_name='$plant_name', plant_address='$address', plant_phone_number='$phone_number' WHERE plant_id='$plant_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Plant Updated Successfully";
        header("Location: plant.php");
    }
    else
    {
        $_SESSION['status'] = "Plant Updating Failed";
        header("Location: plant.php");
    }

}

if(isset($_POST['DeletePlant']))
{
    $plant_id = $_POST['delete_id'];
   
    $query = "DELETE FROM plant WHERE plant_id ='$plant_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Plant Deleted Successfully";
        header("Location: plant.php");
    }
    else
    {
        $_SESSION['status'] = "Plant Deleting Failed";
        header("Location: plant.php");
    }

}

?>