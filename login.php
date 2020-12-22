<?php
include 'connect.php'; // Database connection
session_start();
if(isset($_POST["submit"])){
 $_SESSION["user"] = $_POST["user"];
 $_SESSION["password"] = $_POST["password"];
 
 $_SESSION['last_time'] = time();
 {
 if(!empty($_POST['user']) && !empty($_POST['password'])){
 $user = $_POST['user'];
 $password = $_POST['password'];
 //selecting database
 $query = mysqli_query($db, "SELECT * FROM directorio WHERE login='".$user."' AND pass='".$password."'");
 $numrows= mysqli_num_rows($query);
 if($numrows !=0)
 {
 while($row = mysqli_fetch_assoc($query))
 {
 $login=$row['login'];
 $pass=$row['pass'];
  $_SESSION['nivel'] = $row['nivel'];
  $_SESSION['user_id'] = $row['cod_directorio'];
 }
 if($login == $user && $pass == $password)
 {
 //Redirect Browser
 header('Location:index.php');
 }
 }
 else
 {
 echo "Invalid Username or Password!";
 }
 }
 else
 {
 echo "Required All fields!";
 }
 }
}
?>
<!doctype html>
<html>
	<header>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="stylesheet.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	</header>
	
	
<body>
	<br>
	<center>
		<img src="logo_simple.png" alt="Logo Cromatix">
<h1>sys.cromatixcompany.com - login</h1>
<form  method="post">
<input class="login" type="text" name="user" placeholder="Ingrese Usuario"><br/>
<input class="login" type="password" name="password" placeholder="Ingrese Password"><br/>
<input class="login" type="submit" name="submit" value="Entrar">
</form>
</center>
</body>
</html>
