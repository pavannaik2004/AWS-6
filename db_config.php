<?php
$servername = getenv('DB_HOST') ?: '';
$username = getenv('DB_USER') ?: '';
$password = getenv('DB_PASS') ?: '';
$dbname = getenv('DB_NAME') ?: '';

if ($servername === '' || $username === '' || $password === '' || $dbname === '') {
    http_response_code(500);
    echo "Database configuration is missing. Set DB_HOST, DB_USER, DB_PASS, and DB_NAME.";
    exit;
}
?>
