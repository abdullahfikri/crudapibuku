<?php
include "db_connection.php";

$query = "SELECT * FROM table_buku";


$statement = $con->query($query);
$statement->setFetchMode(PDO::FETCH_ASSOC);

$results =$statement->fetchAll();

header('Content-Type: application/json');
echo json_encode($results);