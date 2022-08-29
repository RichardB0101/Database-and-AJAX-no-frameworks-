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

   $conn->query("INSERT INTO `eurovoc`(`id`, `label`) VALUES ('".$lvlOne['DESCRIPTEUR_ID']."', '".$lvlOne['LIBELLE']."')");

    if(array_key_exists('DEF', $lvlOne)){
        //$conn->query("INSERT INTO `eurovoc`(`description`) VALUES ('15') WHERE id = '".$lvlOne['DESCRIPTEUR_ID']."'");
        //UPDATE `eurovoc` SET `description`='15' WHERE `id` = 1000
        $conn->query("UPDATE `eurovoc` SET `description`='".$lvlOne['DEF']."' WHERE `id` =   ".$lvlOne['DESCRIPTEUR_ID']."  ");
    }
}

header("Location: ../parsing.php");
exit();

//$sql = "USE `ajax` SELECT * FROM `eurovoc` WHERE 'id' = .$search . OR 'name' = .$search .OR 'description' = .$search";

