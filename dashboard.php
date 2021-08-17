<?php 
include_once("inc/functions.php");
global $conn;
redirect_user_not_loggedin();

if(isset($_POST['plan_id']) && $_POST['plan_id']){
  $plan_id = $_POST['plan_id'];
  $plan_tid = $_POST['plan_tid'];
  $query = "UPDATE users SET plan = {$plan_id}, plan_tid = '{$plan_tid}' WHERE ID = ".$_SESSION['user']['ID'];
  $result = $conn->query($query);
  if($result){
    $_SESSION['user']['plan'] = $plan_id;
  }
}


include_once("header.php");
?>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="row">
      <?php if(!is_plan_selected()){
        foreach($plans as $key=>$plan){ ?>
          <div class="col-md-4">
            <form action="" method="post">
              <h3><?php echo $plan['name']; ?></h3>
              <input type="hidden" name="plan_id" value="<?php echo $key; ?>">
              <p><?php echo $plan['desc']; ?></p>
              <label for="plan_tid">Transaction ID (Jazz Cash)</label>
              <input type="text" name="plan_tid" id="plan_tid" class="form-control" required><br />
              
              <p>My mobile# of jazz cash <b>0300-1234567 (ABC)</b> </p>
              <input type="submit" value="Choose" class="btn btn-success submit_plan">
            </form>
          </div>
      <?php  } 
      }
      elseif(!is_account_verified()){
        echo 'Your account is under transaction verification. once your account will get verified will we notify you via email.';
      }else{ ?>
        
        

        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#profile_tab_html" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Profile</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#referrals_tab_html" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Refferals</button>
            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#video_tab_html" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Video</button>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="profile_tab_html" role="tabpanel" aria-labelledby="nav-home-tab">

          <?php 
          $deposit_amount = $plans[$_SESSION['user']['plan']]['price'];
          $referal_amount = 0;
          $ads_amount = 0;
          $total_amount = $deposit_amount+$referal_amount+ $ads_amount;
          ?>
          <p>Your Deposit Amount = <?php echo $deposit_amount; ?></p>
          <p>Your Referral Amount = <?php echo $referal_amount; ?></p>
          <p>Your ads Amount = <?php echo $ads_amount; ?></p>
          <p><b>Total Amount = <?php echo $total_amount; ?></b></p>
            

          </div>
          <div class="tab-pane fade" id="referrals_tab_html" role="tabpanel" aria-labelledby="nav-profile-tab">ss</div>
          <div class="tab-pane fade" id="video_tab_html" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
        </div>
      <?php }
      ?>
      </div>
      
  </div>
</div>
<?php 
include_once("footer.php");
?>