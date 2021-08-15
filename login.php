<?php 
include_once("header.php");
?>
<div class="container">
  <form method="post" action="">
    
    
    <div class="mb-3">
      <label for="user_email" class="form-label">Email address</label>
      <input type="email" class="form-control" id="user_email" aria-describedby="emailHelp">
      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
      <label for="user_password" class="form-label">Password</label>
      <input type="password" class="form-control" id="user_password">
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
<?php 
include_once("footer.php");
?>