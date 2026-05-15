<?php
$servername = getenv('DB_HOST') ?: '';
$username = getenv('DB_USER') ?: '';
$password = getenv('DB_PASS') ?: '';
$dbname = getenv('DB_NAME') ?: '';

if ($servername === '' || $username === '' || $password === '' || $dbname === '') {
    http_response_code(500);
    error_log("Database configuration is missing. Required: DB_HOST, DB_USER, DB_PASS, DB_NAME.");
    echo "Server configuration error.";
    exit;
}
?>
