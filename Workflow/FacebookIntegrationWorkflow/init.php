<?php
$host = "localhost";
$port = "27017";

$connection = new MongoClient( "mongodb://".$host.":".$port ); // connect to a remote host at a given port
$db=$connection->hackathon;

?>