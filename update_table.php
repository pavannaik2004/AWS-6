<?php
$servername = "database-1.c5yimwcqgy8n.eu-north-1.rds.amazonaws.com";
$username = "admin";
$password = "adminadmin";
$dbname = "mydbb";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Method not allowed. Use POST.";
    exit;
}

$oldName = $_POST['old_name'] ?? '';
$newName = $_POST['new_name'] ?? '';

if (!preg_match('/^[A-Za-z_][A-Za-z0-9_]*$/', $oldName) || !preg_match('/^[A-Za-z_][A-Za-z0-9_]*$/', $newName)) {
    http_response_code(400);
    echo "Invalid table name(s). Use letters, numbers, and underscores only.";
    exit;
}

$safeOldName = str_replace('`', '``', $oldName);
$safeNewName = str_replace('`', '``', $newName);

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "RENAME TABLE `$safeOldName` TO `$safeNewName`";
    $conn->exec($sql);

    echo "Table $oldName renamed to $newName successfully";
} catch (PDOException $e) {
    http_response_code(500);
    echo "Error updating table: " . $e->getMessage();
}

$conn = null;
?>
