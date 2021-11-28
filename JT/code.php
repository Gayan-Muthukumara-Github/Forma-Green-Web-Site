<?php
session_start();
include('config/dbcon.php');

if (isset($_POST['addUser'])) {
    $name = $_POST['username'];
    $phone = $_POST['phonenumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    if ($password == $confirmpassword) {

        $checkemail = "SELECT email FROM users WHERE email='$email'";
        $checkemail_run = mysqli_query($con, $checkemail);

        if (mysqli_num_rows($checkemail_run) > 0) {
            //Taken Already exists
            $_SESSION['status'] = "Email id is already taken.!";
            header("Location: index.php");
        } else {
            //Available = Record not found
            $user_query = "INSERT INTO users (username,phonenumber,email,password) VALUES ('$name','$phone','$email','$password')";
            $user_query_run = mysqli_query($con, $user_query);

            if ($user_query_run) {
                $_SESSION['status'] = "User Added Successfully";
                header("Location: index.php");
            } else {
                $_SESSION['status'] = "User Registration Failed";
                header("Location: index.php");
            }
        }
    } else {
        $_SESSION['status'] = "Password and confirm password does not match.!";
        header("Location: registered.php");
    }
}


?>

<?php
include('config/dbcon.php');

if (isset($_POST['addfeedback'])) {
    if (isset($_SESSION['auth_user'])) {
    
    $date = date("Y-m-d");
    $q_01 = $_POST['q_01'];
    $q_02 = $_POST['q_02'];
    $q_03 = $_POST['q_03'];
    $message = $_POST['message'];
    $user_id = $_SESSION['auth_user']['user_id'];

    $user_query = "INSERT INTO feedback (user_ID,f_date,f_q_1,f_q_2,f_q_3,f_description) VALUES ('$user_id','$date','$q_01','$q_02','$q_03','$message')";
    $user_query_run = mysqli_query($con, $user_query);

    if ($user_query_run) {
        $_SESSION['status'] = "Sent your feedback";
        header("Location: feedback.php");
    } else {
        $_SESSION['status'] = "Failed to sending your feedback";
        header("Location: feedback.php");
    }
    }
    else{
        $_SESSION['status'] = "Logging first!";
        header("Location: feedback.php");
    }
}
else{

}

?>
<?php
if (isset($_POST['login_btn'])) {
    //session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);

    header('Location: ../admin/login.php');
    exit(0);
}
if (isset($_POST['signup_btn'])) {
    //session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);

    header('Location: ../admin/signup.php');
    exit(0);
}
if (isset($_POST['logout_btn'])) {
    //session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);

    $_SESSION['status'] = "Logged out successfully";
    header('Location: index.php');
    exit(0);
}

if (isset($_POST['user_btn'])) {
    header('Location: userprofile.php');
}

if (isset($_POST['adminlogin_btn'])) {
    //session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);

    header('Location: ../admin/adminlogin.php');
    exit(0);
}

if (isset($_POST['check_Emailbtn'])) {
    $email = $_POST['email'];

    $checkemail = "SELECT email FROM users WHERE email='$email'";
    $checkemail_run = mysqli_query($con, $checkemail);

    if (mysqli_num_rows($checkemail_run) > 0) {
        echo "Email id already taken.!";
    } else {
        echo "It's Available";
    }
}

?>
<?php
// Add products into the cart table
if (isset($_POST['u_id'])) {
    if (isset($_SESSION['auth_user'])) {
        $user_id = $_SESSION['auth_user']['user_id'];
        $u_id = $_POST['u_id'];
        $u_qty = $_POST['u_qty'];
        $u_size = $_POST['u_size'];

        $query = "SELECT * FROM uniform WHERE uniform_ID = '$u_id'";
        $result = $con->query($query);
        $row = mysqli_fetch_assoc($result);
        $c_name = $row['c_name'];

        if ($u_size == 'size2') {
            $query1 = "SELECT * FROM categoryprice WHERE c_name = '$c_name'";
            $result1 = $con->query($query1);
            $row1 = mysqli_fetch_assoc($result1);
            $price = $row1['size2_price'];
        } elseif ($u_size == 'size4') {
            $query1 = "SELECT * FROM categoryprice WHERE c_name = '$c_name'";
            $result1 = $con->query($query1);
            $row1 = mysqli_fetch_assoc($result1);
            $price = $row1['size4_price'];
        } elseif ($u_size == 'size6') {
            $query1 = "SELECT * FROM categoryprice WHERE c_name = '$c_name'";
            $result1 = $con->query($query1);
            $row1 = mysqli_fetch_assoc($result1);
            $price = $row1['size6_price'];
        } elseif ($u_size == 'size8') {
            $query1 = "SELECT * FROM categoryprice WHERE c_name = '$c_name'";
            $result1 = $con->query($query1);
            $row1 = mysqli_fetch_assoc($result1);
            $price = $row1['size8_price'];
        } elseif ($u_size == 'size10') {
            $query1 = "SELECT * FROM categoryprice WHERE c_name = '$c_name'";
            $result1 = $con->query($query1);
            $row1 = mysqli_fetch_assoc($result1);
            $price = $row1['size10_price'];
        } elseif ($u_size == 'size12') {
            $query1 = "SELECT * FROM categoryprice WHERE c_name = '$c_name'";
            $result1 = $con->query($query1);
            $row1 = mysqli_fetch_assoc($result1);
            $price = $row1['size12_price'];
        }

        $total_price = $price * $u_qty;
        $user_query = "INSERT INTO orderdetails (uniform_ID,user_ID,selected_size,price,quantity,total_price) VALUES('$u_id','$user_id','$u_size','$price','$u_qty','$total_price')";
        $user_query_run = mysqli_query($con, $user_query);

        if ($user_query_run) {

            $_SESSION['status'] = "Uniform added to the cart";
            header("Location: uniform-single.php");

        } else {

            $_SESSION['status'] = "Uniform added Failed";
            header("Location: uniform-single.php");
        }
    }
    else {
        echo '<script>alert("Logging first!")</script>';
    }
} 
else
{
    
}
?>
<?php
// Get no.of items available in the cart table
if (isset($_SESSION['auth_user'])) {
    if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
        $user_id = $_SESSION['auth_user']['user_id'];
        $stmt = $con->prepare("SELECT * FROM orderdetails WHERE user_ID ='$user_id'");
        $stmt->execute();
        $stmt->store_result();
        $rows = $stmt->num_rows;

        echo $rows;
    } else {
        $rows = 0;
        echo $rows;
    }
}
?>
  <?php
    // Remove single items from cart
    if (isset($_GET['remove'])) {
        $id = $_GET['remove'];

        $stmt = $con->prepare('DELETE FROM orderdetails WHERE order_ID=?');
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $_SESSION['status'] = "Item removed from the cart!";

        header('location:cart.php');
    }

    // Set total price of the product in the cart table
    if (isset($_POST['qty'])) {
        $qty = $_POST['qty'];
        $o_id = $_POST['o_id'];
        $price = $_POST['price'];

        $tprice = $qty * $price;



        $user_query = "UPDATE orderdetails SET quantity= $qty,total_price=$tprice WHERE order_ID= $o_id";
        $user_query_run = mysqli_query($con, $user_query);
        if ($user_query_run) {
            $_SESSION['status'] = "Item quatity added successfully!";
            header("Location: cart.php");
        }
    }
    // Checkout and save customer info in the orders table
    if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
        $user_id = $_POST['user_id'];
        
        $grand_total = $_POST['grand_total'];
        $address = $_POST['address'];
        $district = $_POST['district'];
        $due_date = $_POST['due_date'];
        $order_date = date("Y-m-d");

        $data = '';

        $sql = "SELECT uniform_ID,quantity,total_price,selected_size FROM orderdetails WHERE user_ID = '$user_id'";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $products = $row['uniform_ID'];
            $qty = $row['quantity'];
            $total_price = $row['total_price'];
            $size = $row['selected_size'];

            $stmt = $con->prepare('INSERT INTO orders (user_ID,orders,u_size,quantity,total_price,order_date,due_date,delivery_address,district)VALUES(?,?,?,?,?,?,?,?,?)');
            $stmt->bind_param('sssssssss', $user_id, $products,$size, $qty,$total_price, $order_date, $due_date, $address, $district);
            $stmt->execute();
            
        }

        $stmt2 = $con->prepare("DELETE FROM orderdetails WHERE user_ID = '$user_id'");
        $stmt2->execute();
        $data .= '<div class="site-section">
                    <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                        <span class="icon-check_circle display-3 text-warning"></span>
                        <h2 class="display-3 text-black">Thank you!</h2>
                        <p class="lead mb-5">You order was successfuly completed.</p>
                        <p><a href="index.php" class="btn btn-sm btn-dark">Back to shop</a></p>
                        </div>
                    </div>
                    </div>
                </div>';
        echo $data;
    }
?>


<?php
include('config/dbcon.php');
if (isset($_POST['AddCuniform'])) {


    $uni_institition = $_POST['institution'];
    $uni_color = $_POST['color'];
    $uni_fabric_type = $_POST['fabric_type'];
    $uni_extra_note = $_POST['extra_note'];
    $img = $_POST['img'];

    $qty = $_POST['c_qty'];
    $category = $_POST['messagetype'];
    $time = date("G:i:s A");
    $date = date("M/d/Y");

    $date_time = $time. ''.$date;

    $user_id = $_SESSION['auth_user']['user_id'];

    $selected_size = 'Can be change';

    if($_POST['messagetype'] == 'Skirt'){

        $chest = $_POST['ski_chest'];
        $waist = $_POST['ski_waist'];
        $full_length = $_POST['ski_full_length'];
        $hip = $_POST['ski_hip'];


        $user_query = "INSERT INTO customizeduniform (institution,color,fabric_Type,extra_note,design_image,chest,waist,full_length,hip,date_time) VALUES ('$uni_institition','$uni_color','$uni_fabric_type','$uni_extra_note','$img','$chest','$waist','$full_length','$hip','$date_time')";
        $user_query_run = mysqli_query($con, $user_query);

        if ($user_query_run) {
            
            $query = "SELECT * FROM categoryprice WHERE c_name  = '$category'";
            $result = $con->query($query);
            $row = mysqli_fetch_assoc($result);
            $avg_price = $row['avg_price'];

            $query1 = "SELECT * FROM fabric WHERE fabric_Type  = '$uni_fabric_type'";
            $result1 = $con->query($query1);
            $row1 = mysqli_fetch_assoc($result1);
            $extra_cost	 = $row1['extra_cost'];

            $query2 = "SELECT * FROM customizeduniform WHERE date_time  = '$date_time'";
            $result2 = $con->query($query2);
            $row2 = mysqli_fetch_assoc($result2);
            $c_uni_ID = $row2['cu_ID'];

            $c_uniform_ID = 'ski_' .$c_uni_ID;

            $price = $avg_price + ($extra_cost * $full_length);

            $total_price = $price * $qty;

            $selected_size = 'Can be change';
            
            $user_query = "INSERT INTO orderdetails (uniform_ID,user_ID,selected_size,price,quantity,total_price) VALUES ('$c_uniform_ID','$user_id','$selected_size','$price','$qty','$total_price')";
            $user_query_run = mysqli_query($con, $user_query);

            $_SESSION['status'] = "Uniform added to the cart!";
            header("Location: customizeduniform.php");
        } 
        else 
        {
            $_SESSION['status'] = "Uniform adding failed";
            header("Location: customizeduniform.php");
        } 

    }
    else if($_POST['messagetype'] == 'Pre school frock'){
        
        $ps_chest = $_POST['ps_chest'];
        $ps_waist = $_POST['ps_waist'];
        $ps_full_length = $_POST['ps_full_length'];
        $ps_hip = $_POST['ps_hip'];
        $ps_shoulder_to_waist = $_POST['ps_shoulder_to_waist'];
        $ps_arm_hole = $_POST['ps_arm_hole'];
        $ps_sleeve_circumference = $_POST['ps_sleeve_circumference'];
        $ps_sleeve_length = $_POST['ps_sleeve_length'];
        $ps_shoulder_length = $_POST['ps_shoulder_length'];


        $user_query = "INSERT INTO customizeduniform (institution,color,fabric_type,extra_note,design_image,chest,waist,full_length,hip,shoulder_length,sleeve_length,sleeve_circumference,arm_hole,shoulder_to_waist,date_time) VALUES ('$uni_institition','$uni_color','$uni_fabric_type','$uni_extra_note','$img','$ps_chest','$ps_waist','$ps_full_length','$ps_hip','$ps_shoulder_length','$ps_sleeve_length','$ps_sleeve_circumference','$ps_arm_hole','$ps_shoulder_to_waist','$date_time')";
        $user_query_run = mysqli_query($con, $user_query);

        if ($user_query_run) {

            $query = "SELECT * FROM categoryprice WHERE c_name  = '$category'";
            $result = $con->query($query);
            $row = mysqli_fetch_assoc($result);
            $avg_price = $row['avg_price'];

            $query1 = "SELECT * FROM fabric WHERE fabric_Type  = '$uni_fabric_type'";
            $result1 = $con->query($query1);
            $row1 = mysqli_fetch_assoc($result1);
            $extra_cost	 = $row1['extra_cost'];

            $query2 = "SELECT * FROM customizeduniform WHERE date_time  = '$date_time'";
            $result2 = $con->query($query2);
            $row2 = mysqli_fetch_assoc($result2);
            $c_uni_ID = $row2['cu_ID'];

            $c_uniform_ID = 'ps_' .$c_uni_ID;

            $price = $avg_price + ($extra_cost * $ps_full_length);

            $total_price = $price * $qty;
            
            $user_query = "INSERT INTO orderdetails (uniform_ID,user_ID,selected_size,price,quantity,total_price) VALUES ('$c_uniform_ID','$user_id','$selected_size','$price','$qty','$total_price')";
            $user_query_run = mysqli_query($con, $user_query);

            $_SESSION['status'] = "Uniform added to the cart!";
            header("Location: customizeduniform.php");
        } 
        else 
        {
            $_SESSION['status'] = "Uniform adding failed";
            header("Location: customizeduniform.php");
        }

    }
    else if($_POST['messagetype'] == 'Shirt'){

        $shi_chest = $_POST['shi_chest'];
        $shi_waist = $_POST['shi_waist'];
        $shi_full_length = $_POST['shi_full_length'];
        $shi_shoulder_length = $_POST['shi_shoulder_length'];
        $shi_sleeve_length = $_POST['shi_sleeve_length'];
        $shi_sleeve_circumference = $_POST['shi_sleeve_circumference'];
        $shi_arm_hole = $_POST['shi_arm_hole'];
        $shi_shoulder_to_waist = $_POST['shi_shoulder_to_waist'];
        
        $user_query = "INSERT INTO customizeduniform (institution,color,fabric_type,extra_note,design_image,chest,waist,full_length,shoulder_length,sleeve_length,sleeve_circumference,arm_hole,shoulder_to_waist,date_time) VALUES 
        ('$uni_institition','$uni_color','$uni_fabric_type','$uni_extra_note','$img','$shi_chest','$shi_waist','$shi_full_length','$shi_shoulder_length','$shi_sleeve_length','$shi_sleeve_circumference','$shi_arm_hole','$shi_shoulder_to_waist','$date_time')";
        $user_query_run = mysqli_query($con, $user_query);

        if ($user_query_run) {

            $query = "SELECT * FROM categoryprice WHERE c_name  = '$category'";
            $result = $con->query($query);
            $row = mysqli_fetch_assoc($result);
            $avg_price = $row['avg_price'];

            $query1 = "SELECT * FROM fabric WHERE fabric_Type  = '$uni_fabric_type'";
            $result1 = $con->query($query1);
            $row1 = mysqli_fetch_assoc($result1);
            $extra_cost	 = $row1['extra_cost'];

            $query2 = "SELECT * FROM customizeduniform WHERE date_time  = '$date_time'";
            $result2 = $con->query($query2);
            $row2 = mysqli_fetch_assoc($result2);
            $c_uni_ID = $row2['cu_ID'];

            $c_uniform_ID = 'shi_' .$c_uni_ID;

            $price = $avg_price + ($extra_cost * $shi_full_length);

            $total_price = $price * $qty;
            
            $user_query = "INSERT INTO orderdetails (uniform_ID,user_ID,selected_size,price,quantity,total_price) VALUES ('$c_uniform_ID','$user_id','$selected_size','$price','$qty','$total_price')";
            $user_query_run = mysqli_query($con, $user_query);

            $_SESSION['status'] = "Uniform added to the cart!";
            header("Location: customizeduniform.php");
        } 
        else 
        {
            $_SESSION['status'] = "Uniform adding failed";
            header("Location: customizeduniform.php");
        }

    }
    else if($_POST['messagetype'] == 'School frock'){
        
        $sch_chest = $_POST['sch_chest'];
        $sch_waist = $_POST['sch_waist'];
        $sch_full_length = $_POST['sch_full_length'];
        $sch_hip = $_POST['sch_hip'];
        $sch_shoulder_to_waist = $_POST['sch_shoulder_to_waist'];
        $sch_arm_hole = $_POST['sch_arm_hole'];
        $sch_sleeve_circumference = $_POST['sch_sleeve_circumference'];
        $sch_sleeve_length = $_POST['sch_sleeve_length'];
        $sch_shoulder_length = $_POST['sch_shoulder_length'];


        $user_query = "INSERT INTO customizeduniform (institution,color,fabric_type,extra_note,design_image,chest,waist,full_length,hip,shoulder_length,sleeve_length,sleeve_circumference,arm_hole,shoulder_to_waist,date_time) VALUES ('$uni_institition','$uni_color','$uni_fabric_type','$uni_extra_note','$img','$sch_chest','$sch_waist','$sch_full_length','$sch_hip','$sch_shoulder_length','$sch_sleeve_length','$sch_sleeve_circumference','$sch_arm_hole','$sch_shoulder_to_waist','$date_time')";
        $user_query_run = mysqli_query($con, $user_query);

        if ($user_query_run) {

            $query = "SELECT * FROM categoryprice WHERE c_name  = '$category'";
            $result = $con->query($query);
            $row = mysqli_fetch_assoc($result);
            $avg_price = $row['avg_price'];

            $query1 = "SELECT * FROM fabric WHERE fabric_Type  = '$uni_fabric_type'";
            $result1 = $con->query($query1);
            $row1 = mysqli_fetch_assoc($result1);
            $extra_cost	 = $row1['extra_cost'];

            $query2 = "SELECT * FROM customizeduniform WHERE date_time  = '$date_time'";
            $result2 = $con->query($query2);
            $row2 = mysqli_fetch_assoc($result2);
            $c_uni_ID = $row2['cu_ID'];

            $c_uniform_ID = 'sch_' .$c_uni_ID;

            $price = $avg_price + ($extra_cost * $sch_full_length);

            $total_price = $price * $qty;
            
            $user_query = "INSERT INTO orderdetails (uniform_ID,user_ID,selected_size,price,quantity,total_price) VALUES ('$c_uniform_ID','$user_id','$selected_size','$price','$qty','$total_price')";
            $user_query_run = mysqli_query($con, $user_query);

            $_SESSION['status'] = "Uniform added to the cart!";
            header("Location: customizeduniform.php");
        } 
        else 
        {
            $_SESSION['status'] = "Uniform adding failed";
            header("Location: customizeduniform.php");
        }

    }
    else if($_POST['messagetype'] == 'Short'){
        
        
        $sho_waist = $_POST['sho_waist'];
        $sho_full_length = $_POST['sho_full_length'];
        $sho_hip = $_POST['sho_hip'];
        $sho_front_crotch = $_POST['sho_front_crotch'];
        $sho_bottom = $_POST['sho_bottom'];


        $user_query = "INSERT INTO customizeduniform (institution,color,fabric_type,extra_note,design_image,waist,full_length,hip,front_crotch,bottom,date_time) VALUES 
        ('$uni_institition','$uni_color','$uni_fabric_type','$uni_extra_note','$img','$sho_waist','$sho_full_length','$sho_hip','$sho_front_crotch','$sho_bottom','$date_time')";
        $user_query_run = mysqli_query($con, $user_query);

        if ($user_query_run) {

            $query = "SELECT * FROM categoryprice WHERE c_name  = '$category'";
            $result = $con->query($query);
            $row = mysqli_fetch_assoc($result);
            $avg_price = $row['avg_price'];

            $query1 = "SELECT * FROM fabric WHERE fabric_Type  = '$uni_fabric_type'";
            $result1 = $con->query($query1);
            $row1 = mysqli_fetch_assoc($result1);
            $extra_cost	 = $row1['extra_cost'];

            $query2 = "SELECT * FROM customizeduniform WHERE date_time  = '$date_time'";
            $result2 = $con->query($query2);
            $row2 = mysqli_fetch_assoc($result2);
            $c_uni_ID = $row2['cu_ID'];

            $c_uniform_ID = 'sho_' .$c_uni_ID;

            $price = $avg_price + ($extra_cost * $sho_full_length);

            $total_price = $price * $qty;
            
            $user_query = "INSERT INTO orderdetails (uniform_ID,user_ID,selected_size,price,quantity,total_price) VALUES ('$c_uniform_ID','$user_id','$selected_size','$price','$qty','$total_price')";
            $user_query_run = mysqli_query($con, $user_query);

            $_SESSION['status'] = "Uniform added to the cart!";
            header("Location: customizeduniform.php");
        } 
        else 
        {
            $_SESSION['status'] = "Uniform adding failed";
            header("Location: customizeduniform.php");
        }

    }
    else if($_POST['messagetype'] == 'Trouser'){
        
        
        $tro_waist = $_POST['tro_waist'];
        $tro_full_length = $_POST['tro_full_length'];
        $tro_hip = $_POST['tro_hip'];
        $tro_front_crotch = $_POST['tro_front_crotch'];
        $tro_bottom = $_POST['tro_bottom'];


        $user_query = "INSERT INTO customizeduniform (institution,color,fabric_type,extra_note,design_image,waist,full_length,hip,front_crotch,bottom,date_time) VALUES 
        ('$uni_institition','$uni_color','$uni_fabric_type','$uni_extra_note','$img','$tro_waist','$tro_full_length','$tro_hip','$tro_front_crotch','$tro_bottom','$date_time')";
        $user_query_run = mysqli_query($con, $user_query);

        if ($user_query_run) {

            $query = "SELECT * FROM categoryprice WHERE c_name  = '$category'";
            $result = $con->query($query);
            $row = mysqli_fetch_assoc($result);
            $avg_price = $row['avg_price'];

            $query1 = "SELECT * FROM fabric WHERE fabric_Type  = '$uni_fabric_type'";
            $result1 = $con->query($query1);
            $row1 = mysqli_fetch_assoc($result1);
            $extra_cost	 = $row1['extra_cost'];

            $query2 = "SELECT * FROM customizeduniform WHERE date_time  = '$date_time'";
            $result2 = $con->query($query2);
            $row2 = mysqli_fetch_assoc($result2);
            $c_uni_ID = $row2['cu_ID'];

            $c_uniform_ID = 'tro_' .$c_uni_ID;

            $price = $avg_price + ($extra_cost * $tro_full_length);

            $total_price = $price * $qty;
            
            $user_query = "INSERT INTO orderdetails (uniform_ID,user_ID,selected_size,price,quantity,total_price) VALUES ('$c_uniform_ID','$user_id','$selected_size','$price','$qty','$total_price')";
            $user_query_run = mysqli_query($con, $user_query);

            $_SESSION['status'] = "Uniform added to the cart!";
            header("Location: customizeduniform.php");
        } 
        else 
        {
            $_SESSION['status'] = "Uniform adding failed";
            header("Location: customizeduniform.php");
        }

    }

    

}
?>





