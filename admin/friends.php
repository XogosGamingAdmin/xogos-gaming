<?php include "includes/header.php" ?>
<?php include "includes/sidebar.php" ?>
<?php include "includes/navbar.php"; ?>

<div class="content">
<div class="row">
          <div class="col-md-12">
            <div class="card ">
            <div class="card-header d-flex justify-content-between align-items-center">
    <div> <!-- Flex container for vertical grouping of the title and search input -->
        <h4 class="card-title">My Friends</h4>
        <form class="form-inline"> <!-- Form for searching friends -->
            <input class="form-control mr-sm-2" type="search" placeholder="Find Friends" aria-label="Search">
        </form>
    </div>
    <div class="button-group" style="display: flex; flex-direction: column; align-items: center;"> <!-- Adjusted for center alignment -->
        <a href="friend_requests.php" style="margin-top: 8px;">Friend Requests</a> <!-- Link for friend requests underneath the button -->
    </div>
</div>

              <div class="card-body">
                <div class="table-responsive">
                <table class="table tablesorter">
                        <thead class="text-primary">
   
                        </thead>
                        <tbody>
                        <tr>
                            <td><img src="assets/img/avatars/avatar_4.png" alt="" style="width:50px; height:auto;"></td>
                            <td>Lukas Thern Loven</td>
                            <td class='text-right'><a href='LINK_TO_ADD_FRIEND'>Remove</a></td>
                        </tr>
                        <tr>
                            <td><img src="assets/img/avatars/avatar_4.png" alt="" style="width:50px; height:auto;"></td>
                            <td>Lukas Thern Loven</td>
                            <td class='text-right'><a href='LINK_TO_ADD_FRIEND'>Remove</a></td>
                        </tr>
                        <tr>
                            <td><img src="assets/img/avatars/avatar_4.png" alt="" style="width:50px; height:auto;"></td>
                            <td>Lukas Thern Loven</td>
                            <td class='text-right'><a href='LINK_TO_ADD_FRIEND'>Remove</a></td>
                        </tr>
                   </tbody>
                   </table>

                   <?php 
                   
                   if(isset($_GET['delete'])) {

                    $client_id = $_GET['delete'];
                    $query = "DELETE FROM users WHERE user_id = {$user_id}";
                    $delete_query = mysqli_query($connection, $query);
                     
        update_kids_count();
        update_kids_count_byteacher();
                    header("Location: my_kids.php");


                   }
                   ?>

                </div>
              </div>
            </div>
          </div>
</div>