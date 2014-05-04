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
	<body>
		<div class="container">
			<form class="form-signin" method="post" action="insertStu.php">
				<!-- Nombre box -->
				<div class="row" id="input-pass">
					<input type="text" class="form-control" name="nombreE" value="<?php echo $row[0]; ?>">
				</div>

				<!-- Fecha de Admision box -->
				<div class="row" id="input-pass"> 
					<input type="text" class="form-control" name="fechaA" value="<?php echo $row[2]; ?>">
				</div>

				<!-- Fecha de Graduación box -->
				<div class="row" id="input-pass"> 
					<input type="text" class="form-control" name="fechaG" value="<?php echo $row[3]; ?>">
				</div>

				<!-- Fecha de Graduación box -->
				<div class="row" id="input-pass"> 
					<input type="text" class="form-control" name="idE" value="<?php echo $row[4]; ?>">
				</div>

				<!-- checkbox row -->
				<div class="row" id="input-pass">
					<label id="Pago">
						<input type="checkbox" name="pago"<?php if($row[1] == 1){echo 'checked="checked"';} ?>> Pagó
					</label>
					&nbsp;
					<select class="selectpicker" name="grupo">
						<option <?php if($row[6] == "1"){echo " selected";} ?>> Grupo 1 </option>
						<option <?php if($row[6] == "2"){echo " selected";}	?>> Grupo 2 </option>
						<option <?php if($row[6] == "3"){echo " selected";}	?>> Grupo 3 </option>
					</select>
				</div>
				<div class="modal-footer">
					<a href=<?php echo "secretariaFront.php" ?>><button type="button" class="btn btn-danger">Cancelar</button></a>
					<button type="submit" class="btn btn-primary">Guardar cambios</button>
				</div>
			</form>
		</div>
	</body>
</html>