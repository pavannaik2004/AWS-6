<?php
require_once __DIR__ . '/db_config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Method not allowed. Use POST.";
    exit;
}

$tableName = $_POST['name'] ?? '';

if (!preg_match('/^[A-Za-z_][A-Za-z0-9_]*$/', $tableName)) {
    http_response_code(400);
    echo "Invalid table name. Use letters, numbers, and underscores only.";
    exit;
}

$safeTableName = str_replace('`', '``', $tableName);

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Table identifiers cannot be bound with PDO parameters in DDL, so we validate and escape first.
    $sql = "DROP TABLE IF EXISTS `$safeTableName`";
    $conn->exec($sql);

    $safeOutput = htmlspecialchars($tableName, ENT_QUOTES, 'UTF-8');
    echo "Table $safeOutput deleted successfully";
} catch (PDOException $e) {
    http_response_code(500);
    error_log("Error deleting table: " . $e->getMessage());
    echo "Error deleting table.";
}

$conn = null;
?>
