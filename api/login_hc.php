<?php
// Include database connection
include "../admin/includes/db.php";

// Start or resume a session
session_start();

header('Content-Type: application/json');

// Function to sanitize input data
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]); // Plain text password from input

    // Prepare SQL statement to prevent SQL injection
    $stmt = $connection->prepare("SELECT user_id, username, firstname, lastname, img, user_role, email, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    // Execute statement
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Password is correct, set session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["user_id"] = $user['user_id'];
                $_SESSION["username"] = $user['username'];

                // Prepare data for response
                $response = [
                    'username' => $user['username'],
                    'firstname' => $user['firstname'],
                    'lastname' => $user['lastname'],
                    'img' => $user['img'],
                    'user_role' => $user['user_role'],
                    'email' => $user['email']
                ];

                echo json_encode($response);
            } else {
                // Invalid password
                http_response_code(401); // Unauthorized
                echo json_encode(['error' => 'Invalid password.']);
            }
        } else {
            // Username not found
            http_response_code(404); // Not Found
            echo json_encode(['error' => 'User not found.']);
        }
    } else {
        // DB execution error
        http_response_code(500); // Internal Server Error
        echo json_encode(['error' => 'Database error.']);
    }

    $stmt->close();
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Invalid request method. Only POST is allowed.']);
}

$connection->close();
?>
