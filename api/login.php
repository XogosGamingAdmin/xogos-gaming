<?php

header('Content-Type: application/json');
require('./admin/includes/db.php');

$host = constant('DB_HOST');
$username = 'your_database_username';
$password = 'your_database_password';
$database = 'your_database_name';

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
  die(json_encode(['error' => 'Database connection error']));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user_query = mysqli_query($connection, $query);

    if (!$select_user_query) {
      die(json_encode(['error' => 'Query failed']));
    }

    if ($row = mysqli_fetch_assoc($select_user_query)) {
      if (password_verify($password, $row['password'])) {
        $response = [
          'success' => true,
          'message' => 'Login successful',
          'user_id' => $row['user_id'],
        ];
      } else {
        $response = ['error' => 'Invalid credentials'];
      }
    } else {
      $response = ['error' => 'User not found'];
    }

    echo json_encode($response);
  } else {
    echo json_encode(['error' => 'Invalid request']);
  }
} else {
  echo json_encode(['error' => 'Invalid request method']);
}

mysqli_close($connection);
