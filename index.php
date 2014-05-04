<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CETEC LogIn</title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/cetec.css" rel="stylesheet">
  </head>
  <body background="https://github.com/rlcmartis/CETEC/blob/master/CETEC_back_login.jpg?raw=true"> 
    <div class="container" id="login">
      <div id="logo">
        <img src="https://github.com/rlcmartis/CETEC/blob/master/CETEC_logo.png?raw=true" width="350px" height="350px"/>
      </div>
      <form name="form1" method="post" action="checklogin.php">
        <div class="input-group" id="loginBox">
          <input type="text" class="form-control" placeholder="Username" name="idE" id="idBox">
          <input type="password" class="form-control" placeholder="Password" name="password" id="passBox">
          <div class="btn-group">
            <button type="submit" class="btn btn-info" >Log in</button>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>