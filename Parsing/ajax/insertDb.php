<?php
session_start();

$conn = new mysqli("localhost", "root", "123456", "ajax");

if ($conn->connect_errno) {
    die("DB ERROR : " . $conn->connect_error);
}



$xml = simplexml_load_file("../desc.xml");
$jsonXml = json_encode($xml);
$arrayXml = json_decode($jsonXml, TRUE);

//$sqlInsert = "INSERT INTO `eurovoc`(`label`, `description`) VALUES ('savoka$i','lorem ipsum lorem ipsum')";
foreach($arrayXml['RECORD'] as $lvlOne){
    $counter = 0;
    foreach($lvlOne as $xml){
        $counter +=1;
        switch ($counter){
            case 1:
                $conn->query("INSERT INTO `eurovoc`(`id`) VALUES ('$xml')");
                break;
            case 2:
                $conn->query("INSERT INTO `eurovoc`(`label`) VALUES ('$xml')");
                break;
            case 3:
                $conn->query("INSERT INTO `eurovoc`(`description`) VALUES ('$xml')");
                break;
        }
    }
}

header("Location: ../parsing.php");
exit();

//$sql = "USE `ajax` SELECT * FROM `eurovoc` WHERE 'id' = .$search . OR 'name' = .$search .OR 'description' = .$search";

