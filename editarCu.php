<?php
  session_start(); 
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
  $table_Name = "estudiante"; 
  
  $idC = $_POST['idC'];
  $sql_info = 'Select * From curso Where idC="'.$idC.'"';
  $resultado = mysql_query($sql_info);
  $row = mysql_fetch_row($resultado);
?>

<html>
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="css/bootstrap.css" rel="stylesheet">
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/cetec.css" rel="stylesheet">

    <title>Editar Curso</title>
  </head>
	<body>
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <p class="navbar-brand">
              CETEC
            </p>
            <p class="navbar-text pull-right" id="textRightNav">
              <?php
                echo $row[1];
              ?>
            </p>
        </nav>

		<div class="container" id="container-EditarEva">
      <table id="tablaEditEva" style="width: 500px">
  			<form class="form-signin" method="post" action="insertCu.php">
  				<!-- Nombre box -->
          <tr>
            <td style="text-align: right;">  
              Nombre
            </td>
            <td>
      				<div class="row" id="input-pass">
      					<input type="text" class="form-control" name="nombreC" value="<?php echo $row[1]; ?>">
      				</div>
            </td>
          <tr>

  				<!-- Fecha de Graduación box -->
          <tr>
            <td style="text-align: right;">  
              Codigo
            </td>
          <td>
  				<div class="row" id="input-pass"> 
  					<input type="text" class="form-control" name="idC" value="<?php echo $row[0]; ?>">
  				</div>
        </td>
      </tr>
      </table>
  				<div class="modal-footer">
  					<a href=<?php echo "secretariaFront.php" ?>><button type="button" class="btn btn-danger">Cancelar</button></a>
  					<button type="submit" class="btn btn-primary">Guardar cambios</button>
  				</div>
  			</form>
		</div>
	</body>
</html>