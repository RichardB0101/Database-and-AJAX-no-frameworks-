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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
            integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
          integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        .loaders-wrapper{
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loader-spinner {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: conic-gradient(#0000 10%, #000000);
            -webkit-mask: radial-gradient(farthest-side, #0000 calc(100% - 10px), #000 0);
            animation: load-spin 0.8s infinite linear;

        }

        @keyframes load-spin {
            to {
                transform: rotate(1turn);
            }
        }
    </style>

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
if (!empty($_SESSION["searchSesh"])) {
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
    <br>
    <button type="submit">Insert data to Eurovoc</button>
</form>
<form action="ajax/truncateDb.php" method="post">
    <br>
    <button type="submit">Truncate table</button>
</form>

<table class="table table-dark table-hover table-striped">
    <tr>
        <th>ID</th>
        <th>Savokos Pavadinimas</th>
        <th>Savokos alternatyva</th>
    </tr>
    <?php
    if (isset($_SESSION['truncateStatus'])) {
        print '
<script>
    $(document).ready(function(){
        $("#truncateModal").modal("show");
    });
</script>
';
        unset($_SESSION['truncateStatus']);
    }
    if (isset($_SESSION['insertStatus'])) {
        print '
<script>
    $(document).ready(function(){
        $("#insertModal").modal("show");
    });
</script>
';
        unset($_SESSION['insertStatus']);
    }

    $source = $_SESSION["searchSesh"];
    $sql = "SELECT * FROM `Eurovoc` WHERE (id = '$source') OR (label = '$source') OR (description = '$source')";
    $result = $conn->query($sql);


    $query = "SELECT * FROM eurovoc";
    if (!$_SESSION["searchSesh"]) {
        if ($result = $conn->query($query)) {

            /* fetch associative array */
            while ($row = $result->fetch_assoc()) {
                echo '<tr> 
                  <td>' . $row["id"] . '</td> 
                  <td>' . $row["label"] . '</td> 
                  <td>' . $row["description"] . '</td> 
              </tr>';
            }
            /* free result set */
            $result->free();
        }

    } else {
        if ($result = $conn->query($sql)) {

            /* fetch associative array */
            while ($row = $result->fetch_assoc()) {
                echo '<tr> 
                  <td>' . $row["id"] . '</td> 
                  <td>' . $row["label"] . '</td> 
                  <td>' . $row["description"] . '</td> 
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


<!-- Modal Truncate -->
<div class="modal fade" id="truncateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div style="border-radius: 15px;" class="modal-content text-center text-white bg-success ">
            <i style="font-size: 80px;" class="fa-solid fa-trash-can my-5"></i>
            <h1 class="mb-5">Database Cleared!</h1>
        </div>
    </div>
</div>

<!-- Modal Insert-->
<div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div style="border-radius: 15px;" class="modal-content text-center text-white bg-success">
            <i style="font-size: 80px;" class="fa-solid fa-circle-check my-5"></i>
            <h1 class="mb-5">Database Completed!</h1>
        </div>
    </div>
</div>

    <div class="loaders-wrapper">
        <div class="loaders">
            <div class="item">

                <div class="loader-spinner"></div>

            </div>
        </div>
    </div>

<script>

    // $(window).on("load", function(){
    //     $(".loaders-wrapper").fadeOut("fast");
    // });
    window.onload = function () {$(".loaders-wrapper").fadeOut("fast"); }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>