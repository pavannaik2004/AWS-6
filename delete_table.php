<?php
$servername = "database-1.c5yimwcqgy8n.eu-north-1.rds.amazonaws.com";
$username = "admin";
$password = "adminadmin";
$dbname = "mydbb";

$tableName = $_GET['name'] ?? '';

if (!preg_match('/^[A-Za-z_][A-Za-z0-9_]*$/', $tableName)) {
    http_response_code(400);
    echo "Invalid table name. Use letters, numbers, and underscores only.";
    exit;
}

$safeTableName = str_replace('`', '``', $tableName);

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DROP TABLE IF EXISTS `$safeTableName`";
    $conn->exec($sql);

    echo "Table $tableName deleted successfully";
} catch (PDOException $e) {
    http_response_code(500);
    echo "Error deleting table: " . $e->getMessage();
}

$conn = null;
?>
