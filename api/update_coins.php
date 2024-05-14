<?php
// Include database connection
include "../admin/includes/db.php";
include "cors.php";

// Get the raw POST data
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Retrieve parameters from JSON data
$user_id = $data['user_id'];
$table = $data['table'];
$coins = $data['coins'];

// Validate input
if (!isset($user_id) || !isset($table) || !isset($coins)) {
    echo json_encode(["status" => "error", "message" => "Missing required parameters."]);
    exit();
}

// Check if user_id exists in the users table
$user_check_sql = "SELECT COUNT(*) FROM users WHERE user_id = ?";
$user_check_stmt = $connection->prepare($user_check_sql);
$user_check_stmt->bind_param("i", $user_id);
$user_check_stmt->execute();
$user_check_stmt->bind_result($user_count);
$user_check_stmt->fetch();
$user_check_stmt->close();

if ($user_count == 0) {
    echo json_encode(["status" => "error", "message" => "User ID does not exist."]);
    exit();
}

// Check if user_id exists in the specified table
$table_check_sql = "SELECT COUNT(*) FROM " . $connection->real_escape_string($table) . " WHERE user_id = ?";
$table_check_stmt = $connection->prepare($table_check_sql);
$table_check_stmt->bind_param("i", $user_id);
$table_check_stmt->execute();
$table_check_stmt->bind_result($table_user_count);
$table_check_stmt->fetch();
$table_check_stmt->close();

if ($table_user_count > 0) {
    // If the user_id exists in the specified table, update the coins
    $update_sql = "UPDATE " . $connection->real_escape_string($table) . " SET coins = ? WHERE user_id = ?";
    $update_stmt = $connection->prepare($update_sql);
    $update_stmt->bind_param("ii", $coins, $user_id);

    if ($update_stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Record updated successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error updating record: " . $update_stmt->error]);
    }

    $update_stmt->close();
} else {
    // If the user_id does not exist in the specified table, insert a new row
    $insert_sql = "INSERT INTO " . $connection->real_escape_string($table) . " (user_id, coins) VALUES (?, ?)";
    $insert_stmt = $connection->prepare($insert_sql);
    $insert_stmt->bind_param("ii", $user_id, $coins);

    if ($insert_stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Record inserted successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error inserting record: " . $insert_stmt->error]);
    }

    $insert_stmt->close();
}

// Log the change in the all_records_{table} table
$all_records_table = "all_records_" . $connection->real_escape_string($table);
$log_sql = "INSERT INTO " . $all_records_table . " (user_id, coins) VALUES (?, ?)";
$log_stmt = $connection->prepare($log_sql);
$log_stmt->bind_param("ii", $user_id, $coins);

if (!$log_stmt->execute()) {
    echo json_encode(["status" => "error", "message" => "Error logging record: " . $log_stmt->error]);
}

$log_stmt->close();

// Close the database connection
$connection->close();
?>
