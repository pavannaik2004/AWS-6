<?php
require_once __DIR__ . '/db_config.php';

$tableName = $_GET['name'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS $tableName (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL
    )";

    $conn->exec($sql);
    echo "Table $tableName created successfully";
} catch (PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}

$conn = null;
?>
