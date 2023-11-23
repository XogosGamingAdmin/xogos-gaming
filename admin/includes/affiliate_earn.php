<style>
  .card {
    position: relative;
    background-size: cover;
    background-position: center;
  }

  .card .overlay {
    /* position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);  
  z-index: -1; */
  }

  .card-body {
    position: relative;
  }
</style>

<div class="col-lg-3">
  <div class="card card-chart">
    <div class="card-header">
      <h5 class="card-category">Total Clicks</h5>
      <h3 class="card-title text-bold"><i class="tim-icons icon-coins text-info"></i><?= getAffiliate()['total_clicks'] ?></h3>
    </div>
  </div>
</div>
<div class="col-lg-3">
  <div class="card card-chart">
    <div class="card-header">
      <h5 class="card-category">Amount Earned</h5>
      <h3 class="card-title text-bold"><i class="tim-icons icon-coins text-info"></i><?= getAffiliate()['earn_per_recruit'] * allRecruits()  ?></h3>
    </div>
  </div>
</div>
<div class="col-lg-3">
  <div class="card card-chart">
    <div class="card-header">
      <h5 class="card-category">Total Recruits</h5>
      <h3 class="card-title text-bold"><i class="tim-icons icon-coins text-info"></i><?= allRecruits() ?></h3>
    </div>
  </div>
</div>
<div class="col-lg-3">
  <div class="card card-chart">
    <div class="card-header">
      <h5 class="card-category">New Recruits</h5>
      <h3 class="card-title text-bold"><i class="tim-icons icon-coins text-info"></i><?= newRecruits() ?></h3>
    </div>
  </div>
</div>