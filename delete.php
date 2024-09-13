<?php
    include 'conn.php';

if (!$conn) {
    die("MySQLi connection is not established.");
}    

$id = $_POST['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

$statement = $conn->prepare('DELETE  FROM tbl_students WHERE student_id = ?');
$statement->bind_param('i', $id);
$statement->execute();
if($statement){
    header('Location: index.php');
}
$statement->close();

    ?>   