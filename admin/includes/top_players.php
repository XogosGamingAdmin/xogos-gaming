<div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Highest Progess</h5>
                <h3 class="card-title"><i class="tim-icons icon-bullet-list-67 text-success"></i> Top Players</h3>
              </div>
              <div class="card-body">
                <div class="chart-area">
                <table class="table">
                <thead class="text-primary">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th class="text-right">Score</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php 
                        
                        $query = "SELECT * FROM students ORDER BY student_score DESC ";
                        $select_student = mysqli_query($connection, $query);
                
                        while ($row = mysqli_fetch_assoc($select_student)) {
                        $student_id        = $row['student_id'];
                        $student_firstname = $row['student_firstname'];
                        $student_lastname  = $row['student_lastname'];
                        $student_score     = $row['student_score'];

                        echo "<tr>";
                            echo "<td>$student_id</td>";
                            echo "<td>$student_firstname $student_lastname</td>";
                            echo "<td class='text-right'>$student_score</td>";    
                            echo "</tr>";
                        }
                        
                        ?>
                   </tbody>
</table>
                </div>
              </div>
            </div>
          </div>