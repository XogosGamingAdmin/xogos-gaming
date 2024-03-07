<?php
// Start the session
session_start();

// Include your database connection
include "../admin/includes/db.php";

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User is not authenticated. Please login."], JSON_PRETTY_PRINT);
    exit; // Stop the script execution if the user is not authenticated
}

// The user is authenticated, proceed with the script
$userId = $_SESSION['user_id']; // Retrieve the user's ID from the session

// Prepare the select query to retrieve user data
$selectQuery = "SELECT playerBanner, audioVol, wins, losses, ownedSet FROM historical_conquest WHERE user_id = ?";

if ($selectStmt = $connection->prepare($selectQuery)) {
    $selectStmt->bind_param("i", $userId);
    $selectStmt->execute();
    $result = $selectStmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        // Decode the ownedSet before including it in the response
        $row['ownedSet'] = json_decode($row['ownedSet']);
        // Wrap the success message in its own object
        $response = [
            "success" => ["message" => "User data retrieved successfully."], // Changed this line
            "data" => $row
        ];
        echo json_encode($response, JSON_PRETTY_PRINT);
    } else {
        // User data not found
        echo json_encode(["error" => "User data not found."], JSON_PRETTY_PRINT);
    }

    $selectStmt->close();
} else {
    echo json_encode(["error" => "Error preparing select query: " . $connection->error], JSON_PRETTY_PRINT);
}

// Close the database connection
$connection->close();
?>
