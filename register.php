<?php 

include('./server/connectionDB.php');

$connection = new ConnectionDB();

if($_POST){
  if(isset($_POST['register'])){
    $full_name = $_POST['r_nombre'];
    $user = $_POST['r_usuario'];
    $pass = $_POST['r_contrasena'];


    if(strlen($full_name) >= 10){
      if(strlen($user) >= 3){
        if(strlen($pass) >= 4){
          if($connection->Register($full_name, $user, $pass)){
            echo "<script> alert('As sido registrado exitosamente'); </script>";
            header("Location: ./index.php");
          }
        }else{
          echo "La contraseña no debe tener menos de 4 caracteres";
        }
      }else{
        echo "<script> alert('el nombre de usuario no puede tener menos de 3 caracteres'); </script>";
      }
    }else{ 
      echo "<script> alert('El campo de nombre completo no debe tener menos de 10 caracteres'); </script>";
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
    <title>Registro</title>
</head>
<body class="mt-4 bg-light">
    <div class="container pt-4">
        <div class="row align-items-center">
            <div class="col-md-5 mx-auto">
                <form class="border rounded-3 p-4 shadow-sm bg-white" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" >
                    <h2 class="p-2 text-center fw-bold">Registrate</h2>
                    <div class="mb-3">
                        <label for="" class="fw-light">Nombre Completo</label>
                        <input type="text" class="form-control p-2" name="r_nombre" autofocus autocomplete="off" required />
                      </div>
                    <div class="mb-3">
                      <label for="" class="fw-light">Usuario</label>
                      <input type="text" class="form-control p-2" name="r_usuario" autocomplete="off" required />
                    </div>
                    <div class="mb-4">
                      <label for="" class="fw-light">Contraseña</label>
                      <input type="password" class="form-control p-2" name="r_contrasena" required />
                    </div>
                    <div class="mb-3 d-grid">
                        <button type="submit" name="register" class="btn btn-primary fw-normal p-2 mt-4">Registrarme</button>
                      </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <span>Ya te as registrado? </span> <a href="./index.php" class="text-decoration-none"> Iniciar Sesión</a>
                    </div>
                  </form>
            </div>
        </div>
    </div>
</body>
</html>