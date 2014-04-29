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

$idE = $_POST['idE'];

$sql_deleteE = 'DELETE FROM estudiante WHERE idE="'.$idE.'"';
$result = mysql_query($sql_deleteE);
header("location:secretariaFront.php")
?>