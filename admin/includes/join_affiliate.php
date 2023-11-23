<?php

if (isset($_POST['become_affiliate'])) {
  // Get the user ID from the session or your authentication system
  $user_id = $_SESSION['user_id']; // Adjust this according to your actual user session

  // Retrieve the user's kid count from the database
  $query = "SELECT kids_count FROM users WHERE user_id = $user_id";
  $result = mysqli_query($connection, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $kids_count = $row['kids_count'];

    if ($kids_count > 0) {
      $updateQuery = "UPDATE users SET is_affiliate = 1 WHERE user_id = $user_id";
      $updateResult = mysqli_query($connection, $updateQuery);

      if ($updateResult) {
        $base_url = (isset($_SERVER['HTTPS'])
          && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
          . "://" . $_SERVER['HTTP_HOST'];


        $register_url = $base_url . ($_SERVER['HTTP_HOST'] == 'localhost' ? '/xogos' : '') . '/includes/register.php';

        $user_id = $_SESSION['user_id'];
        $register_url_with_id = $register_url . '?by_user=' . $user_id;

        $insertQuery = "INSERT INTO affiliates (user_id, affiliate_link, total_registration, total_clicks)
                              VALUES ($user_id, '$register_url_with_id', 0, 0)";
        $insertResult = mysqli_query($connection, $insertQuery);

        if ($insertResult) {
          header('Location: affiliate.php');
        }
      } else {
        // Error updating the user's status
        // Handle this case as needed
      }
    } else {
      // User does not have kids, cannot become an affiliate
      echo "You need to have kids to become an affiliate.";
    }
  } else {
    // Error fetching user's data
    // Handle this case as needed
  }
}

?>


<style>
  .content {
    padding: 50px;
  }

  .input-modal {
    color: black !important;
  }

  .modal-backdrop.fade.show {
    display: none !important;
    visibility: hidden !important;
  }
</style>

<!-- Modal -->
<div class="modal fade" id="newAffiliate" tabindex="-1" role="dialog" aria-labelledby="newAffiliate" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="POST">
        <div class="modal-header">
          <h2 class="modal-title text-center" id="newAffiliate">Join Affiliate</h2>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="tim-icons icon-simple-remove"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" name="become_affiliate" value="Become Affiliate">
          </div>
        </div>
      </form>
    </div>
  </div>

</div>