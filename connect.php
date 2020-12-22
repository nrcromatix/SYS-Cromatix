<?php
$db = new mysqli('cromatixcompany.com', 'practicas2020', 'v6m!T9alK0X8!BIB.k','admincromatixdb_practica');
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}
?>
