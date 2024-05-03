<?php include "includes/header.php" ?>
<?php include "includes/sidebar.php" ?>
<?php include "includes/navbar.php"; ?>

<?php

if (isset($_GET['confirm']) && isset($_GET['friend'])) {
  $friend_id = $_GET['friend'];
  $confirm = $_GET['confirm'];
  $query = "UPDATE friends_list SET status = $confirm WHERE id = '$friend_id'";
  $delete_query = mysqli_query($connection, $query);
  header("Location: friends.php");
}

$sql = "SELECT a.*,a.friend_id,CONCAT(b.firstname, ' ', b.lastname) AS fullname,b.img FROM friends_list a left join users b ON a.friend_id = b.user_id where a.user_id = '" . $_SESSION['user_id'] . "' AND a.status = 0";
$friends =  mysqli_query($connection, $sql);

?>

<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header d-flex justify-content-between align-items-center">
          <div> <!-- Flex container for vertical grouping of the title and search input -->
            <h4 class="card-title">Friend Requests</h4>
          </div>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table tablesorter">
              <thead class="text-primary">

              </thead>
              <tbody>
                <?php if (mysqli_num_rows($friends) > 0) { ?>
                  <?php while ($fr = mysqli_fetch_array($friends)) { ?>
                    <tr>
                      <td><img src="assets/img/avatars/avatar_4.png" alt="" style="width:50px; height:auto;"></td>
                      <td><?= ucwords($fr['fullname']) ?></td>
                      <td class='text-right'><a href="friend_requests.php?confirm=1&friend=<?= $fr['id'] ?>">Approve</a></td>
                      <td class='text-right'><a href="friend_requests.php?confirm=2&friend=<?= $fr['id'] ?>">Deny</a></td>

                    </tr>
                  <?php }; ?>
                <?php } else {; ?>
                  <tr>
                    <td>
                      <center>Data Not Found</center>
                    </td>
                  </tr>
                <?php }; ?>
              </tbody>
            </table>

            <?php

            if (isset($_GET['delete'])) {

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