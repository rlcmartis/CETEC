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
  $table_Name2 = "maestro"; 

  // Connect to server and select databse.
  // mysql_connect("$host", "$idE", "$password")or die("cannot connect"); 
  // mysql_select_db("$db_name")or die("cannot select DB");
  
  // idE and password sent from form 
  $idE=$_POST['idE']; 
  $password=$_POST['password']; 
  if ($idE == "admin" and $password == "admin"){
    $_SESSION['idE'] = $idE;
    $_SESSION['idM'] = $idE;
    $_SESSION['password'] = $password;
    header("location:secretariaFront.php");
  }
  else{
	// To protect MySQL injection (more detail about MySQL injection)
    $idE = stripslashes($idE);
    $password = stripslashes($password);
    $idE = mysql_real_escape_string($idE);
    $password = mysql_real_escape_string($password);
    $sql="Select * From estudiante Where idE='$idE' and password='$password'";
    $sql2="Select * From maestro Where idM='$idE' and password='$password'";
    
    $result=mysql_query($sql);
    $result2=mysql_query($sql2);
    
    // Mysql_num_row is counting table row
    $count  = mysql_num_rows($result);
    $count2 = mysql_num_rows($result2);
    // If result matched $idE and $password, table row must be 1 row
    if($count==1){
      $row = mysql_fetch_row($result);
      if($row[1] == 0){ //verifica si el estudiante pagó
        echo "Para poder ver tus notas primero debes pagar la matr&iacute;cula.";
      }
      else{
        // Register $idE, $password and redirect to file "estudiante.php"
	    // session_register("idE");
	    // session_register("password"); 
        $_SESSION['idE'] = $idE;
        $_SESSION['password'] = $password;
        header("location:estudiante.php");
      }
    }
  elseif ($count2 == 1) {
    $_SESSION['idM'] = $idE;
    $_SESSION['password'] = $password;
    header("location:maestro.php");
  }
  else {	
    echo "Wrong idE or Password";
  }
}
?>