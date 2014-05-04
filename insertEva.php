<?php
session_start();
	if(!isset($_SESSION['idM']))
  	{
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
  
  date_default_timezone_set('America/Anguilla');
  $year = date('Y', time());
  $month = intval(date('m', time()));
  if ($month < 7) {$semestreActual = $year[2].$year[3]."B";}
  else{$semestreActual = $year[2].$year[3]."A";}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/cetec.css" rel="stylesheet">

    <title>SecretariaFront</title>
  </head>
  <body>
    <div class="row">
      <form class="form-signin" method="post" action="insertNota.php">
        <div class="col-md-8">
          <table style="width:700px">
            <tr>
              <th>Nombre del estudiante</th>
              <th>Nota</th>
            </tr>
            <?php
             	$sqlIDgrupo1 = 	"Select idE From estudiante Where Grupo = 1 and idE In 
		                            (Select idE From matriculado Where idO In 
								  	               (Select idO From ofrece Where idM = '".$idM."' and semestre = '".$semestreActual."'))";
				      $sqlIDgrupo1Result = mysql_query($sqlIDgrupo1);
				      $count = mysql_num_rows($sqlIDgrupo1Result);
				
              for ($i=0; $i < $count; $i++) { 
                $row = mysql_fetch_row($sqlIDgrupo1Result);
                $sqlNombreGrupo1 = "Select nombre From estudiante Where idE=".$row[0];
                $sqlNombreGrupo1Result = mysql_query($sqlNombreGrupo1);
                $rowNombre = mysql_fetch_row($sqlNombreGrupo1Result);
					      echo "<tr>";
					      echo "<td>".$rowNombre[0]."</td>";
					      echo "<td>";
            ?>
				    <!-- Nota box -->
					  <input type="hidden" name = <?php echo "idE$i"; ?> value = <?php echo "$row[0]"; ?>>
	          <input type="text" class="form-control" name= <?php echo "nota$i"; ?> placeholder="Nota">
            <?php
	          	echo "</td>";
              echo "</tr>";
              }
            ?>
          </table>
        </div>
                 <!-- <div class="col-md-2 col-md-offset-2">
            <div class="btn-group" id="botonE">
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalE">
                Añadir Estudiante
              </button>
            </div>
          </div> -->
      </div>
      <div class="row">
        <input type="hidden" name="idM" value=<?php echo $idM; ?> >
        <input type = "hidden" name = "nombreEva" value = "<?php echo $_POST['nombreEva']; ?>" >
        <button type="submit" class="btn btn-primary">Guardar</button>
      </form>
    </div>
  </body>
</html>