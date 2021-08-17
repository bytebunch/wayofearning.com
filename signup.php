<?php 
include_once("inc/functions.php");
redirect_user_loggedin();
global $conn;
if(isset($_POST['full_name'])){
  $full_name = $_POST['full_name'];
  $user_mobile = $_POST['user_mobile'];
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];

  $query = "SELECT email FROM users WHERE email = '{$user_email}'";
  $result = $conn->query($query);
  
  if($result->num_rows){
    $user_message = 'This email already exist.';
  }else{
    $query = "INSERT INTO users (full_name, email, password, phone, type)
    VALUES ('{$full_name}', '{$user_email}', '{$user_password}', '{$user_mobile}', 2) ";
    
    $created = $conn->query($query);
    
    if($created){
      $_SESSION['user'] = array(
        'ID' => $conn->insert_id, 
        'type' => 2, 
        'name' => $full_name, 
        'email' => $user_email,
        'mobile' => $user_mobile,
        'plan' => null,
        'verify' => 0,
      );
      header("Location: dashboard.php");exit();
    }
  }

}

include_once("header.php");
?>
<div class="container">
  <?php if(isset($user_message)){ echo '<h3>This email already exist.</h3>'; } ?>
  <form method="post" action="">
    <div class="mb-3">
      <label for="full_name" class="form-label">Full Name</label>
      <input type="text" class="form-control" id="full_name" name="full_name" required="required">
    </div>
    <div class="mb-3">
      <label for="user_mobile" class="form-label">Mobile</label>
      <input type="number" class="form-control" id="user_mobile" name="user_mobile" required="required">
    </div>
    <div class="mb-3">
      <label for="user_email" class="form-label">Email address</label>
      <input type="email" class="form-control" id="user_email" name="user_email" required="required">
      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
      <label for="user_password" class="form-label">Password</label>
      <input type="password" class="form-control" id="user_password" name="user_password" required="required">
    </div>
    <div class="mb-3">
      <label for="user_pic" class="form-label">Profile Picture</label>
      <input type="file" class="form-control" id="user_pic">
    </div>
    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="terms" required>
      <label class="form-check-label" for="terms">Terms and conditions</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
<?php 
include_once("footer.php");
?>