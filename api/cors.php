<?php
// cors.php

// Allow requests from any origin
header("Access-Control-Allow-Origin: *");

// OR specify a specific domain instead of '*' for security
// header("Access-Control-Allow-Origin: https://example.com");

// Allow HTTP methods
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// Allow headers
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Optional: Handle pre-flight requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    // Exit with 200 OK and the headers above
    exit(0);
}
