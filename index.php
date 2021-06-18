<?php 
session_start();
include('./server/connectionDB.php');

$connection = new ConnectionDB();

if(isset($_SESSION['user_id'])){
  header("location: ./links.php");
}

if($_POST){
  if(isset($_POST['login'])){
    $user = $_POST['l_usuario'];
    $pass = $_POST['l_contrasena'];

    if(strlen($user) >= 3){
      if(strlen($pass) >= 4){
        $connection->my_name = $user;
        $connection->my_password = $pass;
        if($connection->Login()){
          $_SESSION['user_id'] = $connection->my_user_id;
          header("Location: ./links.php");
        }else{
          echo "<script> alert('Usuario o contraseña erroneos </script>";
        }
      }else{
        echo "<script> alert('la contraseña debe tener mas de 4 caracteres </script>";
      }
    }else{
      echo "<script> alert('el nombre usuario no debe tener menos de 3 caracteres </script>";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./icons/link.svg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Inicio Sesión</title>
</head>
<body class="mt-4 bg-light">
    <div class="container pt-4">
        <div class="row align-items-center">
            <div class="col-md-5 mx-auto">
                <form class="border rounded-3 p-4 shadow-sm bg-white" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <h2 class="p-2 text-center fw-bold">Inicio Sesión</h2>
                    <div class="mb-3">
                      <label for="" class="fw-light">Usuario</label>
                      <input type="text" class="form-control p-2" name="l_usuario"  autofocus autocomplete="off" required />
                    </div>
                    <div class="mb-4">
                      <label for="" class="fw-light">Contraseña</label>
                      <input type="password" class="form-control p-2" name="l_contrasena" required />
                    </div>
                    <div class="mb-3 d-grid">
                        <button id="login" name="login" class="btn btn-primary fw-normal p-2 mt-4">Iniciar Sesión</button>
                      </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <span>Aun no te as registrado? </span> <a href="./register.php" class="text-decoration-none"> Registrate</a>
                    </div>
                  </form>
            </div>
        </div>
    </div>
</body>
</html>