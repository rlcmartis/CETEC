<?php
session_start();
$host = "localhost";
$usuario = "jdelacruz";
$password = "jjdl_cn@hotmail.com";
$database = "CETEC";
$conexion = mysql_connect($host, $usuario, $password);
if ($conexion){
    echo "Conexión realizada \n\n\n";
}
else{
    echo "Falló conexión \n";
}
$usarDB = mysql_select_db($database);
$table_Name = "estudiante"; 

// Connect to server and select databse.
// mysql_connect("$host", "$idE", "$password")or die("cannot connect"); 
// mysql_select_db("$db_name")or die("cannot select DB");

// idE and password sent from form 
$idE=$_POST['idE']; 
$password=$_POST['password']; 
if ($idE == "admin" and $password == "admin"){
	$_SESSION['idE'] = $idE;
	$_SESSION['password'] = $password;
	header("location:secretariaFront.php");
}
else{
	// To protect MySQL injection (more detail about MySQL injection)
	$idE = stripslashes($idE);
	$password = stripslashes($password);
	$idE = mysql_real_escape_string($idE);
	$password = mysql_real_escape_string($password);
	$sql="SELECT * FROM $table_Name WHERE idE='$idE' and password='$password'";
	$result=mysql_query($sql);

	// Mysql_num_row is counting table row
	$count=mysql_num_rows($result);

	// If result matched $idE and $password, table row must be 1 row
	if($count==1){
		$row = mysql_fetch_row($result);
		if($row[1] == 0){
			echo "baba";
		}
		else{
			// Register $idE, $password and redirect to file "estudiante.php"
			// session_register("idE");
			// session_register("password"); 
			$_SESSION['idE'] = $idE;
			$_SESSION['password'] = $password;
			header("location:estudiante.php?idE=".$idE);
		}
	}
	else {
		echo "Wrong idE or Password";
	}

}
?>