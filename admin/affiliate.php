<?php include "includes/header.php" ?>
<?php

if (!is_affiliate()) {
  header('Location: index.php');
}

?>
<?php include "includes/sidebar.php" ?>
<?php include "includes/navbar.php" ?>

<!-- End Navbar -->
<div class="content">
  <div class="card card-chart">
    <div class="card-header">
      <h5 class="card-category">Your Affiliate Link</h5>
    </div>
    <div class="card-body p-3">
      <p>Your affiliate link is: <span id="affiliateLink"><?= getAffiliate()['affiliate_link'] ?></span></p>
      <button id="copyButton" class="btn btn-primary">Copy Link</button>
      <input type="text" value="<?= getAffiliate()['affiliate_link'] ?>" id="copyInput" style="position: absolute; left: -9999px;" />
    </div>
  </div>

  <div class="row">
    <?php include "includes/affiliate_earn.php" ?>

    <?php include "includes/performance_affiliate.php" ?>

  </div>
</div>
<script>
  function copyToClipboard() {
    const copyInput = document.getElementById("copyInput");
    copyInput.select();
    document.execCommand("copy");
    copyInput.setSelectionRange(0, 0);

    alert('Link copied to clipboard');
  }

  const copyButton = document.getElementById("copyButton");
  copyButton.addEventListener("click", copyToClipboard);
</script>
<?php include "includes/footer.php" ?>