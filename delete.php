<?php
require_once __DIR__ . '/database/connection.php';


$id = $_GET['id'];

$connection = getConnection();

$sql = <<<SQL
    DELETE FROM product WHERE id = ?;
SQL;
$statement = $connection->prepare($sql);
$statement->execute([$id]);

header('Location: ./index.php');

$connection = null;