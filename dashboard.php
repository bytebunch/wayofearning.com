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

if(isset($_POST['watched']) && $_POST['watched'] == 'all'){
  $query = "SELECT ID FROM ads_earning WHERE user_id = ".$_SESSION['user']['ID'].' AND date = "'.date("Y-m-d").'"';
  $results = $conn->query($query);
  if(!$results->num_rows){
    $query = "INSERT INTO ads_earning (user_id, plan_id, date)
          VALUES (".$_SESSION['user']['ID'].", ".$_SESSION['user']['plan'].", '".date("Y-m-d")."') ";
    $created = $conn->query($query);
    if($created){
      echo 'Yes';
    }
    else
      echo 'Error';
  }else{
    echo 'Earned';
  }
  exit();
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
      }else{ 
        
        $referal_amount = 0;
        $referrals_output = '';
        
        $query = 'SELECT * from referrals WHERE parent_user_id='.$_SESSION['user']['ID'];
        $results = $conn->query($query);
        if($results->num_rows){
          $i = 1;
          $referrals_output .= '<table class="table">';
          $referrals_output .=  '<tr><td>Sr#</td><td>Name</td><td>Email</td><td>Mobile</td><td>Status</td></tr>';
          while($record = $results->fetch_assoc()){
            $query = 'SELECT * FROM users where ID='.$record['user_id'];
            $single_user_results = $conn->query($query)->fetch_assoc();
            $referrals_output .=  '<tr>'; 
            $referrals_output .=  '<td>'.$i.'</td>';
            $referrals_output .=  '<td>'.$single_user_results['full_name'].'</td>';
            $referrals_output .=  '<td>'.$single_user_results['email'].'</td>';
            $referrals_output .=  '<td>'.$single_user_results['phone'].'</td>';
            if($single_user_results['verify']){
              global $plans;
              if(isset($plans[$single_user_results['plan']])){
                $plan_details = $plans[$single_user_results['plan']];
                $referal_amount += ($plan_details['price']*$plan_details['plan_percent'])/100;
              }
              $referrals_output .=  '<td>Verified</td>';
            }else{
              $referrals_output .=  '<td>Not Verified</td>';
            }
            $referrals_output .=  '</tr>';
            $i++;
          }
          $referrals_output .=  '</table>';
        }
      ?>

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
          
          $ads_amount = 0;

          $query = 'SELECT * from ads_earning WHERE user_id='.$_SESSION['user']['ID'];
          $results = $conn->query($query);
          if($results->num_rows){
            while($record = $results->fetch_assoc()){
              $ads_amount += $plans[$_SESSION['user']['plan']]['video_award'];
            }
          }

          
            $total_amount = $deposit_amount+$referal_amount+ $ads_amount;
          ?>
          <p>Your Deposit Amount = <?php echo $deposit_amount; ?></p>
          <p>Your Referral Amount = <?php echo $referal_amount; ?></p>
          <p>Your ads Amount = <?php echo $ads_amount; ?></p>
          <p><b>Total Amount = <?php echo $total_amount; ?></b></p>
          </div>
          <div class="tab-pane fade" id="referrals_tab_html" role="tabpanel" aria-labelledby="nav-profile-tab">
            <?php 
            $url = str_replace('dashboard.php', 'signup.php', get_site_url())."?referral_code=".$_SESSION['user']['referral_code'];
            ?>
            <p><?php echo $url; ?></p>
            <a href="<?php echo $url; ?>" target="_blank">Click here to open the link</a>
            <?php echo $referrals_output; ?>
          </div>
          <div class="tab-pane fade" id="video_tab_html" role="tabpanel" aria-labelledby="nav-contact-tab">
          <?php 
            $videos = [
              'jSFzbISXLLs',
              'pBSIUuwpijA',

              'jSFzbISXLLs',
              'pBSIUuwpijA',
              'Aftvrj_ZDsg',
              'r-b7_VndfRs',
              'qLFvJG6djRM',
              'ghnDp4kKUCc',
              'jv2wgO8vNGk',
              'CBdBtome84c',
              'PbHu2T_uVGA',
              'fRXFwWokPRI',
              'FdSVMRSUX2s',
              'rj94xANsg5g',
              'HJKP-5gGIhE',
              'OfSBuzp8Xv0',
              'giimEZWaNec',
              'hK2By28gpTs',
              'wDCxXcse1xU',
              '3Oq0po5J9mc',
              'po7qArSwiOE',
              'tr2Uxi60p6U',
              '6AMogMTtXt0',
              'vBNEkl8vMco',
              'znkcn90k4ko',
              'WNji5YK7BJs',
              'ERIL1S370NI',
              'XxTa6ySFBIc',
              'vCCpImwNtMQ',
              'iOD_eVu4EJ0',
              'vkX5a6RvLYk',
              'XYddA3mDcxc',
              'b1fJ_T95PuU',
              'vkX5a6RvLYk',
              '_nKcAk1G_S4',
              'KXD2QDTjQiY',
              'xIEhH3gtFW0',
              '6nc9tkf5n-Q',
              '1B3xaDkL30I',
              'TKhfkacuqEQ',
              'Uwn_XlodUjg',
              'vD4npbFjfek',
              'ukA-Q3BUAco',
              'wmQVt-DQ_Jw',
              'Vu6_L0Yd4VE',
              'kYUPTBE8wnM',
              'wNhoX5vFsOo',
              '2Vw82yIY2Tw',
              'HSabqxIR6cI',
              'hoP03Rn7WAE',
              '0q20fYwA83Q',
              'hfdpyxIqK4g',
              '0q20fYwA83Q',
              'dEYXxdOPqSE',
              'IFNZvYEi1Y4',
              'CE8qxVFhAOk',
              'TYwGvGF7ZJQ',
              'ZTrOWLP2-1M',
              '7rKAdkRKlxI',
              '7sbGQ0r0XLI',
              'CLsOYcx5lRI',
              '4KTskjLgetM',
              'LyPF03DaUlA',
              'HrNGj3nTV2U',
              'D7jYii03jg8',
              'ovmcCxxKyRc',
              'K5-rfAYbaOs',
              'YQIo-BSAPyA',
              'Im9_gdrPlJI',
              'kvQKqJ7L4MI',
              '3j1EsRzeYGA',
              'CbCBMz6RS00',
              '-Z6hMj_qED8',
              'GNoU-gffrCI',
              'SeKYTPN40-0',
              '7Eiiq0-ygBs',
              'SeKYTPN40-0',
              'MrZRB-7xWjo',
              'Im9_gdrPlJI',
              'oGKzkqSaPdc',
              'cUBBV1hBPgg',
              'MJqEIlPRWhw',
              'PRLCFdvAins',
              'f357KZVaQb4',
              'aCcaK8V0ipw',
              'eVr587NQc8A',
            ];
            //$videos = array('UT5F9AXjwhg', 'UT5F9AXjwhg');
            $plan_videos = array();
            for($i = 1; $i <= $plans[$_SESSION['user']['plan']]['videos']; $i++){
              $plan_videos[] = $videos[rand(0, count($videos)-1)];
            }
            
            
            /*foreach($videos as $video){
              
              //echo '<div class="mt-3"><iframe width="560" height="315" src="https://www.youtube.com/embed/'.$video.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" enablejsapi="1" allowfullscreen></iframe></div>';
            }*/
          ?>
            <div id="player"></div>
            <script>
             var plan_videos = <?php echo json_encode($plan_videos); ?>;
             var videos_price = <?php echo $plans[$_SESSION['user']['plan']]['video_award']; ?>;
             var ajax_url = '<?php echo get_site_url(); ?>';
            </script>           
          </div>
        </div>
      <?php }
      ?>
      </div>
      
  </div>
</div>
<?php 
include_once("footer.php");
?>