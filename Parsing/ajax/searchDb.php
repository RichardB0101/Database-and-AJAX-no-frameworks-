<?php
session_start();

$conn = new mysqli("localhost", "root", "123456", "ajax");

if ($conn->connect_errno) {
    die("DB ERROR : " . $conn->connect_error);
}

$search = $_POST['formSearch'];
$_SESSION['searchSesh'] = $search;



//$sql = "USE `ajax` SELECT * FROM `eurovoc` WHERE 'id' = .$search . OR 'name' = .$search .OR 'description' = .$search";




header("Location: ../parsing.php");
exit();



