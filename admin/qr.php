<?php
include('config/dbcon.php');
include('authentication.php');

include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
?>

<script type="text/javascript" src="assets/dist/js/jquery.js"></script>
<script type="text/javascript" src="assets/dist/js/qrcode.js"></script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content mt-4">
    <div class="container">
      <div class="row">
        <form onsubmit ="generate();return false;">
          <div class="form-group">
            <label for="exampleInputEmail1">Enter Member ID</label>
            <input type="text" id="qr" class="form-control">
          </div>
          <button type="submit" class="btn btn-primary">Generate QR</button>
        </form>
      </div>
      <div class="row mt-5 ml-20">
        <div id="qrResult" style="height: 500px;width: 500px">
      </div>
    </div>
  </section>
</div>

<script type="text/javascript">
  var qrcode=new QRCode(document.getElementById('qrResult'),{
    width:500,
    height:500
  });

function generate(){
  
  var message=document.getElementById('qr');
  if(!message.value){
    alert("Input a text");
    message.focus();
    return;
  }

  qrcode.makeCode(message.value);
}

</script>


<?php include('includes/script.php'); ?>


<script type="text/javascript" src="assets/dist/js/qrReader.js"></script>

<?php include('includes/footer.php'); ?>