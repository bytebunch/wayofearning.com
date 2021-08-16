<?php 
include_once("inc/functions.php");
redirect_user_loggedin();
global $conn;
if(isset($_POST['user_email']) && isset($_POST['user_password'])){
  $query = 'SELECT * FROM users WHERE email = "'.$_POST['user_email'].'" AND password = "'.$_POST['user_password'].'"';
  $results = $conn->query($query);
  
  if($results->num_rows){
    $result = $results->fetch_assoc();
    $_SESSION['user'] = array(
      'ID' => $result['ID'], 
      'type' => 2, 
      'name' => $result['full_name'], 
      'email' => $result['email'],
      'mobile' => $result['phone'],
    );
    header("Location: dashboard.php");exit();
  }else{
    $user_message = 'Please type your correct user name and password.';
  }
}
include_once("header.php");
?>
<div class="container">
<?php if(isset($user_message)){ echo '<h3>'.$user_message.'</h3>'; } ?>
  <form method="post" action="">    
    
    <div class="mb-3">
      <label for="user_email" class="form-label">Email address</label>
      <input type="email" class="form-control" id="user_email" name="user_email" aria-describedby="emailHelp">
      
    </div>
    <div class="mb-3">
      <label for="user_password" class="form-label">Password</label>
      <input type="password" class="form-control" id="user_password" name="user_password">
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
<?php 
include_once("footer.php");
?>