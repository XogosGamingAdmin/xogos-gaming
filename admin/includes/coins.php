<style>
  .card {
    position: relative;
    background-size: cover;
    background-position: center;
  }

  .card .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    /* Black with 50% opacity */
  }

  .card-body {
    position: relative;
  }
</style>

<div class="col-lg-4">
  <?php if (is_student()) : ?>
    <div class="card card-chart">
      <div class="card-header">
        <h5 class="card-category">Coins Available</h5>
        <?php
        $username = $_SESSION['username'];
        $query = "SELECT game_coins FROM gamedata WHERE username='$username' ORDER BY update_at DESC LIMIT 1";
        $data = mysqli_query($connection, $query);
        $array = mysqli_fetch_assoc($data);
        $coins = mysqli_fetch_assoc($data) == null ? 0 : $array[0]['"game_coins'];
        ?>
        <h3 class="card-title text-bold"><i class="tim-icons icon-coins text-info"></i><?php echo $coins ?></h3>
      </div>
    </div>
  <?php endif ?>
  <div class="card card-chart" style="background-image: url('./assets/img/avatars/<?php echo $_SESSION['img']; ?>');">
    <div class="overlay"></div> <!-- Added overlay div -->
    <div class="card-header" style="position: relative; z-index: 2;">
      <h5 class="card-category">Welcome</h5>
      <?php if (is_student() or is_parent() or is_teacher() or is_admin()) : ?>
        <h3 class="card-title"><?php echo $_SESSION['firstname']; ?></h3>
      <?php endif ?>
      <?php if (is_contractor()) : ?>
        <h3 class="card-title"><?php echo $_SESSION['company']; ?></h3>
      <?php endif ?>
    </div>
    <div class="card-body" style="height: 150px; position: relative;">
      <div class="chart-area">
        <!-- Content inside the chart-area -->
      </div>
    </div>
  </div>

</div>