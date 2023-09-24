<?php include "includes/header.php" ?>
<?php
    // Historial API REGISTER STUDENT
  // $dataLogin = array(
  //   "email" => "ali@gmail.com",
  //   "password" => "1234"
  // );
  // $tokenHistorical = loginHistorical($dataLogin);
?>
<?php include "includes/sidebar.php" ?>
<?php include "includes/navbar.php" ?>
  
      <!-- End Navbar -->
      <div class="content">
      <div class="row">
      <?php include "includes/coins.php" ?>

      <?php if(is_student() OR is_parent() OR is_teacher() ): ?>
      <?php include "includes/performance.php" ?>
      <?php endif ?>
      <?php if(is_admin()): ?>
      <?php include "includes/performance_admin.php" ?>
      <?php endif ?>
      <?php if(is_contractor()): ?>
      <?php include "includes/performance_contractor.php" ?>
      <?php endif ?>
      <div class="row">
      
      <?php if(is_student() OR is_parent() OR is_teacher() OR is_admin() ): ?>
      <?php include "includes/friends_online.php" ?>
      <?php include "includes/top_players.php" ?>
      <?php endif ?>

      <?php if(is_contractor()): ?>
      <?php include "includes/top_players_contractor.php" ?>
      <?php endif ?>

      <?php if(is_student() OR is_parent() OR is_teacher() ): ?>
      <?php include "includes/top_games.php" ?>
      <?php endif ?>
      <?php if(is_admin()): ?>
      <?php include "includes/top_games_admin.php" ?>
      <?php endif ?>  
      <?php if(is_contractor()): ?>
      <?php include "includes/top_games_contractor.php" ?>
      <?php endif ?>         
        </div>
      </div>
      <?php include "includes/footer.php" ?>