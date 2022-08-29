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

?>


<?php
//var_dump($arrayXml);
?>

<!--**************************debugging***************************-->
<pre>
    <?php

    //print_r($arrayXml);
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
</form>

<form action="ajax/insertDb.php" method="post">
    <br><button type="submit">Insert data to Eurovoc</button>
</form>
<form action="ajax/truncateDb.php" method="post">
    <br><button type="submit">Truncate table</button>
</form>

<table class="table table-dark table-hover table-striped">
    <tr>
        <th>ID</th>
        <th>Savokos Pavadinimas</th>
        <th>Savokos alternatyva</th>
    </tr>
    <?php

    $source = $_SESSION["searchSesh"];
    $sql = "SELECT * FROM `Eurovoc` WHERE (id = '$source') OR (label = '$source') OR (description = '$source')";
    $result = $conn -> query($sql);




    $query = "SELECT * FROM eurovoc";
if(!$_SESSION["searchSesh"]){

}
else{
    if ($result = $conn->query($query)) {

        /* fetch associative array */
        while ($row = $result->fetch_assoc()) {
            echo '<tr> 
                  <td>'.$row["id"].'</td> 
                  <td>'.$row["label"].'</td> 
                  <td>'.$row["description"].'</td> 
              </tr>';
        }
        /* free result set */
        $result->free();
    }
}





//    foreach($arrayXml['RECORD'] as $lvlOne){
//        echo "<tr>";
//        foreach($lvlOne as $xml){
//            echo "<td>" . $xml . "</td>";
//        }
//        echo "</tr>";
//    }
//    ?>
</table>
</body>

</html>