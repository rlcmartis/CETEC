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
  
  $idE = $_POST['idE'];
  $sql_info = 'Select * From estudiante Where idE="'.$idE.'"';
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

    <title>Editar Estudiante</title>
  </head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <p class="navbar-brand">
              CETEC
            </p>
            <p class="navbar-text pull-right" id="textRightNav">
              <?php
                echo $row[0];
              ?>
            </p>
        </nav>
		<div class="container" id="container-EditarEva">
		  <table id="tablaEditEva" style="width: 500px">
			<form class="form-signin" method="post" action="insertStu.php">
			
				<!-- Nombre box -->
				<tr>
					<td style="text-align: right;">  
						Nombre
					</td>
					<td>
						<div class="row" id="input-pass">
							<input type="text" class="form-control" name="nombreE" value="<?php echo $row[0]; ?>">
						</div>
					</td>
				</tr>
				<!-- Fecha de Admision box -->
				<tr>
					<td style="text-align: right;">  
						Fecha de Admisión
					</td>
					<td>
						<div class="row" id="input-pass"> 
							<input type="text" class="form-control" name="fechaA" value="<?php echo $row[2]; ?>">
						</div>
					</td>
				</tr>

				<!-- Fecha de Graduación box -->
				<tr>
					<td style="text-align: right;">  
						Fecha de Graduación
					</td>
					<td>
						<div class="row" id="input-pass"> 
							<input type="text" class="form-control" name="fechaG" value="<?php echo $row[3]; ?>">
						</div>
					</td>
				</tr>

				<!-- Identificacion box -->
				<tr>
					<td style="text-align: right;">  
						ID de estudiante
					</td>
					<td>
						<div class="row" id="input-pass"> 
							<input type="text" class="form-control" name="idE" value="<?php echo $row[4]; ?>">
						</div>
					</td>
				</tr>

				<tr>
					<td style="text-align: right;">  
						Contraseña
					</td>
					<td>
						<div class="row" id="input-pass">
							<input type="text" class="form-control" name="password" value="<?php echo $row[5]; ?>">
						</div>
					</td>
				</tr>

				<!-- checkbox row -->
				<tr>
					<td colspan="2">
				<div class="row" id="input-pass">
					<label id="Pago" style="padding-left: 100;">
						<input type="checkbox" name="pago"<?php if($row[1] == 1){echo 'checked="checked"';} ?>> Pagó
					</label>
					&nbsp;
					<select class="selectpicker" name="grupo" style="margin-left: 25;">
						<option <?php if($row[6] == "1"){echo " selected";} ?>> Grupo 1 </option>
						<option <?php if($row[6] == "2"){echo " selected";}	?>> Grupo 2 </option>
						<option <?php if($row[6] == "3"){echo " selected";}	?>> Grupo 3 </option>
					</select>
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