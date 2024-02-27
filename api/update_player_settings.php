<?php
// Start the session
session_start();

// Include your database connection
include "../admin/includes/db.php";

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User is not authenticated. Please login."]);
    exit; // Stop the script execution if the user is not authenticated
}

// The user is authenticated, proceed with the script
$userId = $_SESSION['user_id']; // Retrieve the user's ID from the session

// Assuming the data is sent as application/json
$content = trim(file_get_contents("php://input"));
$decoded = json_decode($content, true);

// Retrieve data from the request
$playerBanner = isset($decoded['playerBanner']) ? (int)$decoded['playerBanner'] : 0;
$audioVol = isset($decoded['audioVol']) ? (int)$decoded['audioVol'] : 0;
$wins = isset($decoded['wins']) ? (int)$decoded['wins'] : 0;
$losses = isset($decoded['losses']) ? (int)$decoded['losses'] : 0;
$ownedSet = isset($decoded['ownedSet']) ? $decoded['ownedSet'] : json_encode([false, false, false, false, false, false]); // Default to all false

// Check if the user already has a row in the historical_conquest table
$checkQuery = "SELECT user_id FROM historical_conquest WHERE user_id = ?";
if ($checkStmt = $connection->prepare($checkQuery)) {
    $checkStmt->bind_param("i", $userId);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows == 0) {
        // Insert a new row if the user does not exist
        $insertQuery = "INSERT INTO historical_conquest (user_id, playerBanner, audioVol, wins, losses, ownedSet) VALUES (?, ?, ?, ?, ?, ?)";
        if ($insertStmt = $connection->prepare($insertQuery)) {
            $insertStmt->bind_param("iiiiis", $userId, $playerBanner, $audioVol, $wins, $losses, $ownedSet);
            $insertStmt->execute();
            echo json_encode(["success" => "User settings added successfully.", "params" => $decoded]);
            $insertStmt->close();
        } else {
            echo json_encode(["error" => "Error preparing insert query: " . $connection->error]);
        }
    } else {
        // Update the existing user's settings
        $updateQuery = "UPDATE historical_conquest SET playerBanner = ?, audioVol = ?, wins = ?, losses = ?, ownedSet = ? WHERE user_id = ?";
        if ($updateStmt = $connection->prepare($updateQuery)) {
            $updateStmt->bind_param("iiiiis", $playerBanner, $audioVol, $wins, $losses, $ownedSet, $userId);
            $updateStmt->execute();
            echo json_encode(["success" => "User settings updated successfully.", "params" => $decoded]);
            $updateStmt->close();
        } else {
            echo json_encode(["error" => "Error preparing update query: " . $connection->error]);
        }
    }
    $checkStmt->close();
} else {
    echo json_encode(["error" => "Error checking user existence: " . $connection->error]);
}

// Close the database connection
$connection->close();
?>
