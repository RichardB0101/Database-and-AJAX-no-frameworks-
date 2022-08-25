<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<?php
//print_r($xml);
?>
<?php

require 'vendor/autoload.php';

$foaf = new \EasyRdf\Graph("http://njh.me/foaf.rdf");
$eurovoc = new \EasyRdf\Graph("http://eurovoc.europa.eu/xl_da_6c3c77d6");
$eurovoc->load();
$ne = $eurovoc->primaryTopic();
$de = $eurovoc->dump();

$foaf->load();
$me = $foaf->primaryTopic();
echo "My name is: ".$me->get('foaf:name')."\n";


//echo "Eurovoc is: ".$ne->get('rdf:RDF')."\n";
$debug = $me->all('foaf:name');
?>

<pre>
    <?php
    print_r($de);
    //var_dump($de);

    ?>
</pre>

</body>

</html>