<?php 
include_once("inc/functions.php");
global $conn;
redirect_user_not_loggedin();
include_once("header.php");
?>
<div class="container">
  <div class="row">
    <div class="col-md-4">Dashboard Menu</div>
    <div class="col-md-8">
      <h1>Hi, <?php echo $_SESSION['user']['name'];  ?></h1>  
      Dashboad content</div>
  </div>
</div>
<?php 
include_once("footer.php");
?>