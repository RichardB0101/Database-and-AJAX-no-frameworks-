<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
<?php
require_once "ajax/config.php";
$xml = simplexml_load_file("desc.xml");
$jsonXml = json_encode($xml);
$arrayXml = json_decode($jsonXml, TRUE);
//Converting in 2 lines only because of simplicity, but not recommended, converts only one layer
//$xml2 = simplexml_load_file("small.xml");
//$arrayXml2 = (array)$xml2;
?>


<!--**************************debugging***************************-->
<pre>
    <?php

    //print_r($search);
    //var_dump($search);
    ?>
</pre>
<?php
if(!empty($_SESSION["searchSesh"])){
    echo $_SESSION["searchSesh"];
}
?>

<!--***************************************************************-->

<form action="ajax/searchDb.php" method="post">
    <label for="formSearch">Search for records
        <br><input type="text" placeholder="search" name="formSearch">
    </label>
    <button type="submit">Submit</button>
</form action="ajax/insertDb.php" method="post">
    <br><button type="submit">Insert data to Eurovoc</button>
<form >
    button
</form>

<table class="table table-dark table-hover table-striped">
    <tr>
        <th>ID</th>
        <th>Savokos Pavadinimas</th>
        <th>Savokos alternatyva</th>
    </tr>


    <?php
    //display EUROVOC xml without database
    //    foreach ($arrayXml['RECORD'] as $lvlOne) {
    //        echo "<tr>";
    //        foreach ($lvlOne as $arrayz) {
    //            echo "<td>" . $arrayz . "</td>";
    //        }
    //        echo "</tr>";
    //    }

    $source = $_SESSION["searchSesh"];
    $sql = "SELECT * FROM `Eurovoc` WHERE (id = '$source') OR (label = '$source') OR (description = '$source')";
    $result = $conn -> query($sql);

    if(!empty($_SESSION["searchSesh"])) {
        while ($rows = $result ->fetch_assoc()) {
            echo "
            <tr>
                <td>" . $rows['id'] . "</td>
                <td>" . $rows['label'] . "</td>
                <td>" . $rows['description'] . "</td>
            </tr>      
            ";
        }
    }
    ?>



</table>
</body>

</html>