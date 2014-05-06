<?php
  session_start();
  if(!isset($_SESSION['idE'])){
    header("location:index.php");
  }

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

  date_default_timezone_set('America/Anguilla');
  $year = date('Y', time());
  $month = intval(date('m', time()));
  if ($month < 7) {$semestreActual = $year[2].$year[3]."B";}
  else{$semestreActual = $year[2].$year[3]."A";} 

  $idO = $_POST['idO'];

  $sql_estudiante = 'Select e.idE, e.nombre From estudiante As e';
  $estudianteResult = mysql_query($sql_estudiante);
?>

<html>
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="css/bootstrap.css" rel="stylesheet">
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/cetec.css" rel="stylesheet">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <script src="../../dist/js/bootstrap.min.js"></script>
      <script src="js/bootstrap.js"></script>
      <script> $(function () {$('#myTab a:first').tab('show')}) </script>

    <title>Matricular estudiantes</title>
  </head>
  <body>
    <form class="form-signin" method="post" action= <?php echo '"insertMatricula.php?idO='.$idO.'"'; ?>>
      <table>
        <?php
          $checknum = 0;
          while ($estudiante = mysql_fetch_array($estudianteResult)) {
            echo "<tr><td>".$estudiante[1]."</td><td>";
            $sql_estmatri = 'Select * From matriculado Where idO='.$idO.' and idE="'.$estudiante['idE'].'"';
            $estmatriResult = mysql_query($sql_estmatri);
            echo '<input type="checkbox" name="'.$estudiante[0].'" ';
            if( mysql_num_rows($estmatriResult) > 0){echo 'checked="checked"';}
            echo "></td></tr>";
            $checknum++;
          }
        ?>
      </table>
      <a href=<?php echo "secretariaFront.php" ?>> <button type="button" class="btn btn-danger">Cancelar</button></a>
      <button type="submit" class="btn btn-primary">Aceptar</button>
    </form>
  </body>
</html>