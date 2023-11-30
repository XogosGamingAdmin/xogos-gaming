<?php
include "../admin/includes/db.php";
include "../admin/functions.php"
?>
<?php session_start(); ?>


<?php


if (isset($_POST['login'])) {

  $username = $_POST['username'];
  $password = $_POST['password'];
  $un_hashed = $password;

  $username = mysqli_real_escape_string($connection, $username);
  $password = mysqli_real_escape_string($connection, $password);

  $query = "SELECT * FROM users WHERE username = '{$username}' ";
  $select_user_query = mysqli_query($connection, $query);

  if (!$select_user_query) {
    die("QUERY FAILED" . mysqli_error($connection));
  }

  while ($row = mysqli_fetch_array($select_user_query)) {
    $_SESSION['token_lr'] = $row['token_lr'];
    $_SESSION['token_tq'] = $row['token_tq'];

    $db_user_id      = $row['user_id'];
    $db_parent_id    = $row['parent_id'];
    $db_teacher_id   = $row['teacher_id'];
    $db_student_id   = $row['student_id'];
    $db_t_student_id = $row['t_student_id'];
    $db_username     = $row['username'];
    $db_password     = $row['password'];
    $db_company      = $row['company'];
    $db_firstname    = $row['firstname'];
    $db_lastname     = $row['lastname'];
    $db_img          = $row['img'];
    $db_user_role    = $row['user_role'];
    $db_kids_count   = $row['kids_count'];
    $db_email        = $row['email'];
    $db_total_coins_lr  = $row['total_coins_lr'];
  }


  //   $password = crypt($password, $db_user_password);

  $stdLoginResp = null;

  if (password_verify($password, $db_password)) {

    $_SESSION['user_id']      = $db_user_id;
    $_SESSION['company']      = $db_company;
    $_SESSION['username']     = $db_username;
    $_SESSION['firstname']    = $db_firstname;
    $_SESSION['lastname']     = $db_lastname;
    $_SESSION['img']          = $db_img;
    $_SESSION['user_role']    = $db_user_role;
    $_SESSION['parent_id']    = $db_parent_id;
    $_SESSION['teacher_id']   = $db_teacher_id;
    $_SESSION['student_id']   = $db_student_id;
    $_SESSION['t_student_id'] = $db_t_student_id;
    $_SESSION['kids_count']   = $db_kids_count;
    $_SESSION['total_coins_lr']  = $db_total_coins_lr;
    $_SESSION['email']        = $db_email;
    // print_r($row);
    // die;


    $data_array_login = [
      'email' => $db_email,
      'password' => $_POST['password'],
    ];

    $token = loginLightingRound($data_array_login);
    $query = "UPDATE users SET token_lr='{$token}' WHERE username='{$db_username}'";
    $update = mysqli_query($connection, $query);

    // $stdLoginResp = loginStudentTimeQuest($data_array_login);
    // // Convert the PHP array to JSON format
    // $stdLoginRespJSON = json_encode($stdLoginResp);

    $student_login_data = [
      'std_email' => $db_email,
      'std_pass' => $_POST['password']
    ];


    $stdLoginResp = loginStudentTimeQuest($student_login_data);

    if ($stdLoginResp == 'no_data') {
      $dataForTimeQst = [
        'std_name' => $db_firstname . " " . $db_lastname,
        'img_url' => $img ?? '',
        'std_email' => $db_email,
        'std_pass' => $un_hashed,
      ];

      $loginData = [
        'email' => 'superadmin@gmail.com',
        'password' => '1234'
      ];
      $loginResp = loginTimeQuestApi($loginData);
      $timeQstLoginToken = $loginResp['token']['token'];

      registerTimeQuest($dataForTimeQst, $timeQstLoginToken);
    }

    $stdLoginResp = loginStudentTimeQuest($student_login_data);
    
    $_SESSION['stdLoginResp'] = $stdLoginResp;

    confirm($update);
    header("Location: ../admin/index.php");
  } else {
    header("Location: login.php");

    $login_message = "Passwords don't match";
  }
}

?>
