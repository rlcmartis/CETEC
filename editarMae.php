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
  

  date_default_timezone_set('America/Anguilla');
  $year = date('Y', time());
  $month = intval(date('m', time()));
  if ($month < 7) {$semestreActual = $year[2].$year[3]."B";}
  else{$semestreActual = $year[2].$year[3]."A";}

  $idM = $_POST['idM'];
  $sql_info = 'Select * From maestro Where idM="'.$idM.'"';
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
		<div class="container" id="editCont">
			<form class="form-signin" method="post" action="insertMae.php">
				<!-- Nombre box -->
				<div class="row" id="input-pass">
					<input type="text" class="form-control" name="nombreM" value="<?php echo $row[1]; ?>">
				</div>

				<!-- Fecha de Graduación box -->
				<div class="row" id="input-pass"> 
					<input type="text" class="form-control" name="idM" value="<?php echo $row[0]; ?>">
				</div>

        <div class="row" id="input-pass"> 
          <input type="text" class="form-control" name="password" value="<?php echo $row[2]; ?>">
        </div>

        <div class="row" id="input-pass">
        <select class="selectpicker" name="curso">
                        <?php 
                          $sqlCurso_Actual = 'Select idC from ofrece where idM = "'.$idM.'"';
                          $sqlCurso_Actual_result = mysql_query($sqlCurso_Actual);
                          $rowCurso_Actual = mysql_fetch_row($sqlCurso_Actual_result);
                          $sqlBuscaNombre_Actual = 'SELECT nombre FROM curso WHERE idC="'.$rowCurso_Actual[0].'"';
                          $sqlBuscaNombre_Actual_result = mysql_query($sqlBuscaNombre_Actual);
                          $rowNombre_Actual = mysql_fetch_row($sqlBuscaNombre_Actual_result);

                          echo '<option value = "'.$rowCurso_Actual[0].'">'.$rowNombre_Actual[0].'</option>';
                          

                          $sql_Cursos_sinM = 'SELECT idC From curso Where idC NOT IN
                                              (Select idC From ofrece Where semestre="'.$semestreActual.'")';
                          $sql_Cursos_sinM_result = mysql_query($sql_Cursos_sinM);
                          while ($rowCursos = mysql_fetch_row($sql_Cursos_sinM_result)) {
                            $sqlBuscaNombre = 'SELECT nombre FROM curso WHERE idC="'.$rowCursos[0].'"';
                            $sqlBuscaNombre_result = mysql_query($sqlBuscaNombre);
                            $sqlBuscaNombre_result_row = mysql_fetch_row($sqlBuscaNombre_result);
                            echo '<option value="'.$rowCursos[0].'">'.$sqlBuscaNombre_result_row[0].'</option>';
                          }
                        ?>
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