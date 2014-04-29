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

$nombre = $_POST['nombreE'];
$fechaA = $_POST['fechaA'];
$fechaG = $_POST['fechaG'];
$idE = $_POST['idE'];
if (isset($_POST['pago'])) {
	$pago = 1;
} else {
	$pago = 0;
}
$sqlVerifica = 'SELECT * FROM estudiante WHERE idE ="'.$idE.'"';
$resultado = mysql_query($sqlVerifica);

if(mysql_num_rows($resultado) > 0){
	$sql_update = 'UPDATE estudiante SET nombre="'.$nombre.'", pago='.$pago.', entro="'.$fechaA.'", sale="'.$fechaG.'", idE="'.$idE.'"WHERE idE='.$idE;
	$result = mysql_query($sql_update);
	header("location:secretariaFront.php");
}
else{
$sql_insertE = 'INSERT INTO estudiante (nombre, pago, entro, sale, idE, password) 
				VALUES ("'.$nombre.'",'.$pago.',"'.$fechaA.'","'.$fechaG.'","'.$idE.'","'.$idE.'")';
$result = mysql_query($sql_insertE);
header("location:secretariaFront.php");
}
?>