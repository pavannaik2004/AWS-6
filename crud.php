<?php

$host = "database-1.c5yimwcqgy8n.eu-north-1.rds.amazonaws.com";
$user = "admin";
$pass = "adminadmin";
$db   = "mydbb";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection Failed : " . $conn->connect_error);
}

echo "<h2>Database Operations Result</h2>";

/* =========================================
   CREATE TABLE
========================================= */

if(isset($_POST['create_table'])){

    $table = $_POST['table_name'];

    $sql = "CREATE TABLE $table (

        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100),
        email VARCHAR(100)

    )";

    if($conn->query($sql)){
        echo "<p style='color:green;'>
              Table '$table' Created Successfully
              </p>";
    } else {
        echo "<p style='color:red;'>
              ".$conn->error."
              </p>";
    }
}

/* =========================================
   RENAME TABLE
========================================= */

if(isset($_POST['rename_table'])){

    $old = $_POST['old_table'];
    $new = $_POST['new_table'];

    $sql = "RENAME TABLE $old TO $new";

    if($conn->query($sql)){
        echo "<p style='color:blue;'>
              Table Renamed Successfully
              </p>";
    } else {
        echo "<p style='color:red;'>
              ".$conn->error."
              </p>";
    }
}

/* =========================================
   DELETE TABLE
========================================= */

if(isset($_POST['delete_table'])){

    $table = $_POST['delete_table_name'];

    $sql = "DROP TABLE $table";

    if($conn->query($sql)){
        echo "<p style='color:red;'>
              Table Deleted Successfully
              </p>";
    } else {
        echo "<p style='color:red;'>
              ".$conn->error."
              </p>";
    }
}

/* =========================================
   INSERT DATA
========================================= */

if(isset($_POST['insert_data'])){

    $table = $_POST['insert_table'];
    $name  = $_POST['name'];
    $email = $_POST['email'];

    $sql = "INSERT INTO $table(name,email)
            VALUES('$name','$email')";

    if($conn->query($sql)){
        echo "<p style='color:green;'>
              Data Inserted Successfully
              </p>";
    } else {
        echo "<p style='color:red;'>
              ".$conn->error."
              </p>";
    }
}

/* =========================================
   FETCH TABLE DATA
========================================= */

if(isset($_GET['fetch_table'])){

    $table = $_GET['fetch_table'];

    $sql = "SELECT * FROM $table";

    $result = $conn->query($sql);

    if($result){

        echo "<h3>Table : $table</h3>";

        echo "
        <table border='1'
               cellpadding='10'
               cellspacing='0'>

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        ";

        while($row = $result->fetch_assoc()){

            echo "
            <tr>
                <td>".$row['id']."</td>
                <td>".$row['name']."</td>
                <td>".$row['email']."</td>
            </tr>
            ";
        }

        echo "</table>";

    } else {

        echo "<p style='color:red;'>
              ".$conn->error."
              </p>";
    }
}

/* =========================================
   SHOW ALL TABLES
========================================= */

echo "<hr>";
echo "<h3>Available Tables</h3>";

$result = $conn->query("SHOW TABLES");

echo "<ul>";

while($row = $result->fetch_array()){

    echo "<li>".$row[0]."</li>";
}

echo "</ul>";

$conn->close();

?>