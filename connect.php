<?php
$db = new mysqli('localhost', 'admincromatixdb', 'Cromatix123!','admincromatixdb');
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}
?>
