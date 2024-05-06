<?php include "includes/header.php" ?>
<?php include "includes/sidebar.php" ?>
<?php include "includes/navbar.php"; ?>
<?php
if (isset($_GET['delete'])) {
    $friend_id = $_GET['delete'];
    $query = "UPDATE friends_list SET status = 2 WHERE user_id = '" . $_SESSION['user_id'] . "' AND friend_id = '$friend_id'";
    // var_dump($query);die;
    $delete_query = mysqli_query($connection, $query);
    header("Location: friends.php");
}
$sql = "SELECT a.*,CONCAT(b.firstname, ' ', b.lastname) AS fullname,b.img FROM friends_list a left join users b ON CASE WHEN a.user_id = '" . $_SESSION['user_id'] . "' THEN a.friend_id = b.user_id WHEN a.friend_id = '". $_SESSION['user_id'] ."' THEN a.user_id = b.user_id  END where (a.user_id = '" . $_SESSION['user_id'] . "' or a.friend_id = '". $_SESSION['user_id'] ."')  AND a.status = 1";
$friends =  mysqli_query($connection, $sql);
?>

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div> <!-- Flex container for vertical grouping of the title and search input -->
                        <?php
                        if (isset($_SESSION['flash'])) {
                        ?>
                            <div class="alert alert-<?= $_SESSION['flash']['status'] ?>">
                                <span><?= $_SESSION['flash']['message'] ?></span>
                            </div>
                        <?php
                            unset($_SESSION['flash']);
                        }
                        ?>
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
                                <?php if (mysqli_num_rows($friends) > 0) { ?>
                                    <?php while ($fr = mysqli_fetch_array($friends)) { ?>
                                        <tr>
                                            <td><img src="assets/img/avatars/avatar_4.png" alt="" style="width:50px; height:auto;"></td>
                                            <td><?= ucwords($fr['fullname']) ?></td>
                                            <td class='text-right'>
                                                <?php if($_SESSION['user_id'] == $fr['user_id']): ?>
                                                <a href="friends.php?delete=<?= $fr['friend_id'] ?>" onclick="return confirm('Are you sure you want to remove this friend?')">Remove</a>
                                                <?php endif; ?>
                                            </td>
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

                    </div>
                </div>
            </div>
        </div>
    </div>