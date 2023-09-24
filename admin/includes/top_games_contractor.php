<div class="col-lg-6">
  <div class="card card-chart">
    <div class="card-header">
      <h5 class="card-category">Trending Games</h5>
      <h3 class="card-title"><i class="tim-icons icon-triangle-right-17 text-warning"></i> Most Played</h3>
    </div>
    <div class="card-body">
      <div class="chart-area">
        <table class="table">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th>Game</th>
              <th class="text-right">Hours Played</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-center">1</td>
              <td><a href='https://lightninground.rocks/?token=<?php echo $_SESSION['token_LR']; ?>'>Lightning Round</a></td>
              <?php

              $query = "SELECT
                        CASE
                          WHEN
                            SUM( gd.game_time ) IS NULL THEN
                              0 ELSE SUM( gd.game_time ) 
                              END AS total_time_lr 
                          FROM
                            gamedata gd
                            JOIN (
                            SELECT
                              username,
                              MAX( update_at ) AS last_update 
                            FROM
                              gamedata 
                            WHERE
                              YEAR ( update_at ) = 2023
                            GROUP BY
                              username 
                            ) last_updates ON gd.username = last_updates.username 
                          AND gd.update_at = last_updates.last_update;";
              $select_time = mysqli_query($connection, $query);

              $row = mysqli_fetch_assoc($select_time);
              $total_time_lr = ($row['total_time_lr'] - ($row['total_time_lr'] % 60)) / 60;

              echo "<td class='text-right'>$total_time_lr</td>";


              ?>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>