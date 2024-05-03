<?php include "includes/header.php" ?>
<?php include "includes/sidebar.php" ?>
<?php include "includes/navbar.php" ?>

<?php
$message = '';
$notValid = true;
if (isset($_GET['profile'])) {
    $profile = $_GET['profile'];
    $query = "SELECT
        a.*,
        CONCAT( b.firstname, ' ', b.lastname ) AS full_name
        FROM
            users_url a
            LEFT JOIN users b ON a.user_id = b.user_id 
        WHERE
            a.expire > NOW() 
            AND a.url = '$profile'";
    $result =  mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 0) {
        $message = 'Invalid Link Profile';
        $notValid = true;
    } else {
        $user = mysqli_fetch_object($result);
        if ($_SESSION['user_id'] == $user->user_id) {
            $message = 'This is you Public Profile URL';
            $notValid = true;
        } else {
            $friendlist = "SELECT * FROM friends_list WHERE user_id = '$user->user_id' AND friend_id = " . $_SESSION['user_id'] . " ORDER BY id DESC LIMIT 1";
            $resultfriend = mysqli_query($connection, $friendlist);
            $friends = mysqli_fetch_object($resultfriend);
            if (mysqli_num_rows($resultfriend) > 0) {
                if ($friends->status == 1) {
                    $message = 'you and ' . ucwords($user->full_name) . ' are already friends.';
                    $notValid = true;
                } else if ($friends->status == 0) {
                    $message = 'The friend request has been sent.';
                    $notValid = true;
                } else {
                    $message = 'You got an invitation to add ' . ucwords($user->full_name) . 'as friend!';
                    $notValid = false;
                }
            } else {
                $message = 'You got an invitation to add ' . ucwords($user->full_name) . 'as friend!';
                $notValid = false;
            }
        }
    }
} else {
    $message = 'Invalid Link Profile';
    $notValid = true;
}

if (isset($_GET['profile']) && isset($_GET['confirm'])) {
    $profile = $_GET['profile'];
    $confirm = $_GET['confirm'];
    $query = "SELECT
        a.*,
        CONCAT( b.firstname, ' ', b.lastname ) AS full_name
        FROM
            users_url a
            LEFT JOIN users b ON a.user_id = b.user_id 
        WHERE
            a.expire > NOW() 
            AND a.url = '$profile'";
    $result =  mysqli_query($connection, $query);
    $user = mysqli_fetch_object($result);
    if ($confirm == '1') {
        $user_id    = $user->user_id;
        $friend_id  = $_SESSION['user_id'];
        $sqq = "INSERT INTO friends_list (id,user_id,friend_id,status) VALUES (null,'$user_id','$friend_id',0)";
        $addFriends = mysqli_query($connection, $sqq);
        $_SESSION['flash']['status'] = 'success';
        $_SESSION['flash']['message'] = 'you have successfully sent a request to ' . $user->full_name;
        header("Location: friends.php");
    } else {
        $_SESSION['flash']['status'] = 'danger';
        $_SESSION['flash']['message'] = "you have'nt  sent a request to " . $user->full_name;
        header("Location: friends.php");
    }
}



?>
<!-- End Navbar -->
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Add Friend</h5>
                </div>
                <div class="card-body" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100vh; text-align: center;">
                    <!-- ----------------- -->
                    <!-- <h3 class="title">You got an invitation to add Lukas Thern Loven as friend!</h3> -->
                    <h3 class="title"><?php echo $message ?></h3>
                    <?php if (!$notValid) : ?>
                        <a href=<?= "public_profile.php?profile=$profile&confirm=0" ?> class="btn btn-danger btn-m">Cancel</a>
                        <a href=<?= "public_profile.php?profile=$profile&confirm=1" ?> class="btn btn-primary btn-m text-white" style="background: rgb(223,78,204);
            background: linear-gradient(90deg, rgba(223,78,204,1) 0%, rgba(223,78,204,1) 35%, rgba(192,83,237,1) 62%); border:none;">Send Request</a>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>

    <?php include "includes/footer.php" ?>