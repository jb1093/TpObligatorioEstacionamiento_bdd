<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.80.0">
    <?php 
    include_once("titulo.php");

    ?>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
<!--<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">-->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
    <link href="css/login-css.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<form class="form-signin" action="hacerregistro.php" method="post">
  <img class="mb-4" src="./img/logo-png.png" alt="" width="132" height="132">
  <h1 class="h3 mb-3 font-weight-normal">Registrate</h1>
  <label for="nombre" class="sr-only">Nombre</label>
  <input name="nombre" type="input" id="inputNombre" class="form-control" placeholder="Ingrese Nombre" required autofocus>
  <label for="inputEmail" class="sr-only">Email address</label>
  <input name="correo" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
  
  <label for="inputPassword" class="sr-only">CopiaPassword</label>
  <input name="copiapassword" type="password" id="inputPassword" class="form-control" placeholder="CopiaPassword" required>
  
  <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2021</p>
</form>


    
  </body>
</html>
