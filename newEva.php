<?php
  session_start();
  if(!isset($_SESSION['idM'])){
    header("location:index.php");
  }

  //DATABASE CONECTION
  $host = "localhost";
  $usuario = "jdelacruz";
  $password = "jjdl_cn@hotmail.com";
  $database = "CETEC";
  $conexion = mysql_connect($host, $usuario, $password);
  if (/*$conexion*/!$conexion){
  //   echo "Conexi&oacute;n realizada \n\n\n";
  // }
  // else{
    echo "Fall&oacute; conexi&oacute;n \n\n\n";
  }
  $usarDB = mysql_select_db($database);
  $idM = $_POST["idM"];
?>

<html>
	<body>
		<div class="container">
			<form class="form-signin" method="post" action="editarEva.php">
	                  <!-- Nombre box -->
	                  <div class="row" id="input-pass">
	                    <input type="text" class="form-control" name="eval" placeholder="Nombre">
	                  </div>

	                  <!-- Fecha de Admision box -->
	                  <div class="row" id="input-pass"> 
	                    <input type="text" class="form-control" name="fechaEva" placeholder="Fecha de Evaluacion">
	                  </div>

	                  <input type="hidden" name = "idM" value = <?php echo "$idM"; ?> >
	                  <button formaction = "maestro.php" type="submit" class="btn btn-danger" >Cancelar</button>

	                  <input type="hidden" name = "idM" value = <?php echo "$idM"; ?> >
	              	  <button type="submit" class="btn btn-primary">Guardar cambios</button>
	            </form>
	    </div>
	</body>
</html>