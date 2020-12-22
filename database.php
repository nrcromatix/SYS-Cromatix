<?php
$server = 'admincromatixdb.db.9154411.6db.hostedresource.net';
$username = 'admincromatixdb';
$password = 'Al267428!';
$database = 'admincromatixdb';
try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}
?>
