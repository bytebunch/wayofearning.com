<?php 
include_once("header.php");
?>
<div class="container">
  <form method="post" action="">
    <div class="mb-3">
      <label for="full_name" class="form-label">Full Name</label>
      <input type="text" class="form-control" id="full_name" name="full_name" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="user_mobile" class="form-label">Mobile</label>
      <input type="text" class="form-control" id="user_mobile" name="user_mobile" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="user_email" class="form-label">Email address</label>
      <input type="email" class="form-control" id="user_email" aria-describedby="emailHelp">
      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
      <label for="user_password" class="form-label">Password</label>
      <input type="password" class="form-control" id="user_password">
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