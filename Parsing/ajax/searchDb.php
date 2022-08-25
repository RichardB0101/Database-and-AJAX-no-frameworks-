<?php
session_start();

$conn = new mysqli("localhost", "root", "123456", "ajax");

if ($conn->connect_errno) {
    die("DB ERROR : " . $conn->connect_error);
}

$search = $_POST['formSearch'];
$_SESSION['searchSesh'] = $search;

$i = 1;


//$sqlInsert = "INSERT INTO `eurovoc`(`label`, `description`) VALUES ('savoka$i','lorem ipsum lorem ipsum')";

//SEEDER
//for($i = 1; $i < 10; $i++){
//    if($conn->query("INSERT INTO `eurovoc`(`label`, `description`) VALUES ('savoka$i','lorem ipsum lorem ipsum')") === TRUE){
//        echo "New record created";
//    }else{
//        echo "Erorr creating record";
//    }
//}



header("Location: ../parsing.php");
//unset($_SESSION['identificator']);
exit();

//$sql = "USE `ajax` SELECT * FROM `eurovoc` WHERE 'id' = .$search . OR 'name' = .$search .OR 'description' = .$search";

