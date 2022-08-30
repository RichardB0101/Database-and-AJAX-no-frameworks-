<?php
session_start();
$conn = new mysqli("localhost", "root", "123456", "ajax");

if ($conn->connect_errno) {
    die("DB ERROR : " . $conn->connect_error);
}
$conn->query("TRUNCATE `eurovoc`");

header("Location: ../parsing.php");
$_SESSION['truncateStatus'] = true;
exit();
