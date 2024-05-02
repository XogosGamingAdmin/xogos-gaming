<?php include "includes/header.php" ?>
<?php include "includes/sidebar.php" ?>
<?php include "includes/navbar.php" ?>

<?php

$address = "";
$phone = "";
$zip = "";

if (isset($_SESSION['user_id'])) {

    $the_user_id = $_SESSION['user_id'];

    $query = "SELECT a.*,b.url,b.expire FROM users a LEFT JOIN users_url b ON a.user_id = b.user_id WHERE a.user_id = '{$the_user_id}'";

    $select_user_profile_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($select_user_profile_query)) {
        $user_id = $row['user_id'];
        $parent_id = $row['parent_id'];
        $teacher_id = $row['teacher_id'];
        $student_id = $row['student_id'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $img = $row['img'];
        $email = $row['email'];
        $phone = $row['phone'];
        $username = $row['username'];
        $password = $row['password'];
        $address = $row['address'];
        $city = $row['city'];
        $zip = $row['zip'];
        $state = $row['state'];
        $url = $row['url'] ? getServerName().'/admin/public_profile.php?profile='.$row['url'] : '';
        $expire = $row['expire'];


    }


}

if (isset($_POST['edit_user'])) {

    $firstname = escape($_POST['firstname']);
    $lastname = escape($_POST['lastname']);
    $email = escape($_POST['email']);
    $phone = escape($_POST['phone']);
    $username = escape($_POST['username']);
    $password = escape($_POST['password']);
    $address = escape($_POST['address']);
    $city = escape($_POST['city']);
    $zip = escape($_POST['zip']);
    $state = escape($_POST['state']);
    $img = '';
    if (isset($_FILES['img']['name'])) {
        $img = $_FILES['img']['name'];
        $img_temp = $_FILES['img']['tmp_name'];
        move_uploaded_file($img_temp, "../admin/assets/img/avatars/$img");
    }
    if (empty($img)) {

        $query = "SELECT * FROM users WHERE user_id = '{$the_user_id}' ";
        $select_image = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($select_image)) {

            $img = $row['img'];

        }
    }
    if($_POST['url'] != ''){
        $sql = "SELECT * FROM users_url where user_id =".$_SESSION['user_id'];
        $queryUser = mysqli_query($connection, $sql);
        $user_url = mysqli_fetch_object($queryUser);
        $url = $_POST['url'];
        $parseUrl = parse_url($url, PHP_URL_QUERY); // Mendapatkan bagian query string dari URL
        parse_str($parseUrl, $params); // Mengurai query string menjadi array

        $id = $params['profile'];
        if(mysqli_num_rows($queryUser) > 0){
            $sql2 = "UPDATE users_url SET url = '$id',expire='".$_POST['expire']."' where id=".$user_url->id;
            // var_dump($sql2);die;
            mysqli_query($connection, $sql2);
        }else{
            $sql3 = "INSERT INTO users_url (id,user_id,url,expire) VALUES (null,'".$_SESSION['user_id']."','$id','".$_POST['expire']."')";
            mysqli_query($connection, $sql3);
        }
        
    }
    $_SESSION['img'] = $img;
    if (!empty($password)) {
        $query_password = "SELECT password FROM users WHERE user_id = '{$the_user_id}' ";
        $get_user_query = mysqli_query($connection, $query_password);
        confirmQuery($get_user_query);

        $row = mysqli_fetch_array($get_user_query);
        $db_password = $row['password'];

        if ($db_password != $password) {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
            $password = $hashed_password; // Assign the hashed password to $password variable
        }

        // Rest of the code...
        $query = "UPDATE users SET ";
        $query .= "firstname      = '{$firstname}', ";
        $query .= "lastname       = '{$lastname}', ";
        $query .= "lastname       = '{$lastname}', ";
        $query .= "img            = '{$img}', ";
        $query .= "email          = '{$email}', ";
        $query .= "phone          = '{$phone}', ";
        $query .= "username       = '{$username}', ";
        $query .= "password       = '{$password}', "; // Use $password instead of $hashed_password
        $query .= "address        = '{$address}', ";
        $query .= "city           = '{$city}', ";
        $query .= "zip            = '{$zip}' ";
        $query .= "WHERE user_id  = '{$the_user_id}' ";

        $edit_user_query = mysqli_query($connection, $query);

        confirm($edit_user_query);
        updateProfile($firstname, $lastname, $img);

        $message = "Profile Updated!";
        update_kids_count();
        update_kids_count_byteacher();

        header("refresh:2;url=user.php");

    }

} else {

    $message = "";

}


?>

<!-- End Navbar -->
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Edit Profile</h5>
                    <h3 class="text-center" style="color:green" ;> <?php echo $message ?> </h3>
                </div>
                <div class="card-body">
                    <!-- ----------------- -->
                    <form method="post" enctype='multipart/form-data' class="needs-validation" novalidate>
                        <div class="form-row">
                            <div class="col-md-4 pr-md-1">
                                <div class="form-group">
                                    <img id="previewImage" style="height:100px; width:100px" class="avatar border-gray"
                                         src="assets/img/avatars/<?php echo $img; ?>" alt='..'>
                                    <input type="file" name="img" value="<?php echo $img ?>" id="imageInput" onchange="previewFile(event)">
                                    <br>
                                    <label for="">Select the photo to add or update</label>
                                </div>
                            </div>
                        </div>
                        <?php if (is_admin()): ?>
                            <div class="form-row">
                                <div class="col-md-2 pr-md-1">
                                    <div class="form-group">
                                        <label>User ID</label>
                                        <input type="text" class="form-control" name="user_id" value="<?php echo $user_id; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                        <?php if (is_teacher()): ?>
                            <div class="form-row">
                                <div class="col-md-2 pr-md-1">
                                    <div class="form-group">
                                        <label>Teacher ID</label>
                                        <input type="text" class="form-control" name="teacher_id" value="<?php echo $teacher_id; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                        <?php if (is_parent()): ?>
                            <div class="form-row">
                                <div class="col-md-2 pr-md-1">
                                    <div class="form-group">
                                        <label>Parent ID</label>
                                        <input type="text" class="form-control" name="parent_id" value="<?php echo $parent_id; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                        <?php if (is_student()): ?>
                            <div class="form-row">
                                <div class="col-md-2 pr-md-1">
                                    <div class="form-group">
                                        <label>Student ID</label>
                                        <input type="text" class="form-control" name="student_id" value="<?php echo $student_id; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">First name</label>
                                <input type="text" name="firstname" class="form-control" id="validationCustom01" value="<?php echo $firstname; ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom02">Last name</label>
                                <input type="text" name="lastname" class="form-control" id="validationCustom02" value="<?php echo $lastname; ?>" required>
                            </div>
                        </div>
                        <?php if (is_admin() or is_parent() or is_teacher()): ?>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom01">Email</label>
                                    <input type="email" name="email" class="form-control" id="validationCustom01" value="<?php echo $email; ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom01">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" id="validationCustom01" value="<?php echo $phone; ?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom01">Address</label>
                                    <input type="text" name="address" class="form-control" id="validationCustom01" value="<?php echo $address; ?>" required>
                                </div>
                            </div>
                        <?php endif ?>
                        <?php if (is_student()): ?>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom01">Email</label>
                                    <input type="email" name="email" class="form-control" id="validationCustom01" value="<?php echo $email; ?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-8 mb-3">
                                    <label for="validationCustom03">City</label>
                                    <input type="text" name="city" class="form-control" id="validationCustom03" value="<?php echo $city; ?>" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom04">State</label>
                                    <select name="state" class="custom-select form-control" id="exampleFormControlSelect1" value="<?php echo $state; ?>"
                                            required>
                                        <option selected value=""><?php echo $state; ?></option>
                                        <?php
                                        $query = "SELECT * FROM state ";
                                        $select_state = mysqli_query($connection, $query);

                                        while ($row = mysqli_fetch_assoc($select_state)) {
                                            $id = $row['id'];
                                            $name = $row['name'];

                                            if ($id === $state) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }

                                            echo "<option $selected value='{$id}'>{$name}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        <?php endif ?>
                        <?php if (is_admin() or is_parent() or is_teacher()): ?>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom03">City</label>
                                    <input type="text" name="city" class="form-control" id="validationCustom03" value="<?php echo $city; ?>" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom03">ZIP</label>
                                    <input type="text" name="zip" class="form-control" id="validationCustom03" value="<?php echo $zip; ?>" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom04">State</label>
                                    <select name="state" class="custom-select form-control" id="exampleFormControlSelect1" value="<?php echo $state; ?>"
                                            required>
                                        <option selected value=""><?php echo $state; ?></option>
                                        <?php
                                        $query = "SELECT * FROM state ";
                                        $select_state = mysqli_query($connection, $query);

                                        while ($row = mysqli_fetch_assoc($select_state)) {
                                            $id = $row['id'];
                                            $name = $row['name'];

                                            if ($id === $state) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }

                                            echo "<option $selected value='{$id}'>{$name}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        <?php endif ?>
                        <h5 class="mb-4 pb-2 pb-md-0 mb-md-5">Login Information</h5>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Username</label>
                                <input type="text" name="username" class="form-control" id="validationCustom01" value="<?php echo $username; ?>" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Password</label>
                                <input type="password" name="password" class="form-control" id="validationCustom02" value="<?php echo $password; ?>" required>
                            </div>
                        </div>
                        <?php if (is_student()): ?>
                        <h5 class="mt-4 pb-2 pb-md-0 mb-md-5">Public Profile URL</h5>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">URL</label>
                                <input type="text" name="url" class="form-control" id="url" value="<?=$url?>" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Valid until</label>
                                <input type="text" name="expire" class="form-control" id="expire" value="<?=$expire?>" readonly>
                            </div>
                            <div class="col-md-4 mb-3 ">
                                <input type="button" class="btn btn-primary btn-m text-white mt-4" style="background: rgb(223,78,204);
                background: linear-gradient(90deg, rgba(223,78,204,1) 0%, rgba(223,78,204,1) 35%, rgba(192,83,237,1) 62%); border:none;" value='Generate' id="generateButton">
                            </div>
                            <div class="col-md-4 mb-3 ">
                                <input type="button" class="btn btn-warning btn-m text-white" value='Copy' id="copyButton">
                            </div>
                        </div>
                        <?php endif;?>
                        <input style="background: rgb(223,78,204);
                background: linear-gradient(90deg, rgba(223,78,204,1) 0%, rgba(223,78,204,1) 35%, rgba(192,83,237,1) 62%); border:none;"
                               class="btn btn-primary btn" type="submit" name="edit_user" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include "includes/footer.php" ?>
      