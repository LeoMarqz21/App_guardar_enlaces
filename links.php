<?php 

session_start();
include('./server/connectionDB.php');

$connection = new ConnectionDB();

if($_GET){
  if(isset($_GET['close'])){
    session_destroy();
    header("Location: ./index.php");
  }
}

if($_POST){

  if(isset($_POST['save'])){
    $title = $_POST['title'];
    $link = $_POST['link'];
    $mode = isset($_POST['mode']);

    echo "Titulo: " . $title . "   Enlace: " . $link . "   modo: " . $mode;
  }

  if(isset($_POST[''])){}
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
    <title>Mis Enlaces</title>
    <style>
      body{
        min-height: 100vh;
      }
      hr{
        padding:2px;
      }

      .box{
        min-height: 50.6vh;
      }

      .a{
        color:#fff;
      }

      .a:nth-child(1):hover{
        color:blue;
      }

      .a:nth-child(2):hover{
        color:orange;
      }

      .a:nth-child(3):hover{
        color:red;
      }


      .social{
        width: 50px;
        height: 50px;
        background: #fff;
        border-radius: 50%;
        border:2px solid rgb(255, 255, 255);
      }

      .social:hover{
        border-color:rgb(0, 235, 39);
      }

      .facebook{
        fill:blue;
      }

      .correo{
        fill:rgb(255, 123, 0);
      }

      .instagram{
        fill:rgb(255, 0, 106);
      }

      .up{
        position:fixed;
        bottom: 5%;
        right:5%;
      }

    </style>
</head>
<body class="bg-light">
    <nav class="navbar  bg-white shadow p-3">
        <div class="container">
            <h1 class="d-flex gap-1 fw-bold"><img src="./icons/link.svg" alt="icono">SLink</h1>
            <form>
              <button class="btn btn-danger shadow-sm" name="close"><img src="./icons/close.svg" alt=""></button>
            </form>
        </div>
    </nav>

    <div class="container mt-4 pt-1">

      <div class="text-secondary"> <?php
        if(isset($_SESSION['user_id'])){
          echo $connection->GetName($_SESSION['user_id']);
        }else{
          header("Location: ./index.php");
        }
      ?> </div>

        <hr>
        <form class="d-flex gap-4" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input class="form-control bg-white" type="text" name="title"  placeholder="Titulo" autofocus autocomplete="off" required/>
            <input class="form-control bg-white" type="text" name="link" placeholder="Enlace" autocomplete="off" required/>
            <div class="d-flex align-items-center gap-2">
               <div>Modo incognito:</div> 
               <input type="checkbox" name="mode" />
            </div>
            <button class="btn btn-primary" name="save" type="submit"><img src="./icons/save.svg" alt="guardar"></button>
        </form>
        <hr>

        <div class="box">
          <table class="table table-hover bg-white shadow rounded-3">
              <thead class="bg-dark text-white fw-bold fs-5 rounded-3">
                <tr>
                  <th class="ps-3">Nº</th>
                  <th>Titulo</th>
                  <th>Funciones</th>
                </tr>
              </thead>
              <tbody class="scrollspy-example">

                <tr>
                  <th class="ps-3">1</th>
                  <td>Google</td>
                  <td class="d-flex gap-3">
                      <a class="btn btn-success"><img src="./icons/open.svg" alt="abrir"></a>
                      <a class="btn btn-info"><img src="./icons/copy.svg" alt="copiar"></a>
                      <a class="btn btn-danger"><img src="./icons/delete.svg" alt="eliminar"></a>
                  </td>
                </tr>
                <tr>
                  <th class="ps-3">2</th>
                  <td>GitHub</td>
                  <td class="d-flex gap-3">
                      <a class="btn btn-success"><img src="./icons/open.svg" alt="abrir"></a>
                      <a class="btn btn-info"><img src="./icons/copy.svg" alt="copiar"></a>
                      <a class="btn btn-danger"><img src="./icons/delete.svg" alt="eliminar"></a>
                  </td>
                </tr>
                
              </tbody>
          </table>
        </div>
      </div>
      <button id="subir" class="up btn btn-warning">
        <img src="./icons/arrow-up.svg" alt="">
      </button>
    <footer class="bg-dark p-4 mt-4">
      <div class="container">
        <h3 class="text-white text-center">Sigueme ... </h3>
        <div class="d-flex justify-content-center gap-1 p-2">
          <a href="https://www.facebook.com/leonel.marquez.54540" target="_blank" class="a d-block p-2 text-center m-2 text-decoration-none">
            <svg class="social facebook" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm3 8h-1.35c-.538 0-.65.221-.65.778v1.222h2l-.209 2h-1.791v7h-3v-7h-2v-2h2v-2.308c0-1.769.931-2.692 3.029-2.692h1.971v3z"/></svg>
            Facebook
          </a>
          <a href="mailto: leonelmarquez053@gmail.com" class="a d-block p-2 text-center m-2 text-decoration-none">
            <svg class="social correo" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 .02c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6.99 6.98l-6.99 5.666-6.991-5.666h13.981zm.01 10h-14v-8.505l7 5.673 7-5.672v8.504z"/></svg>
            Correo
          </a>
          <a href="https://www.instagram.com/p/CHZUgNBlxlN/?utm_medium=copy_link" target="_blank" class="a d-block p-2 text-center m-2 text-decoration-none">
            <svg class="social instagram" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M14.829 6.302c-.738-.034-.96-.04-2.829-.04s-2.09.007-2.828.04c-1.899.087-2.783.986-2.87 2.87-.033.738-.041.959-.041 2.828s.008 2.09.041 2.829c.087 1.879.967 2.783 2.87 2.87.737.033.959.041 2.828.041 1.87 0 2.091-.007 2.829-.041 1.899-.086 2.782-.988 2.87-2.87.033-.738.04-.96.04-2.829s-.007-2.09-.04-2.828c-.088-1.883-.973-2.783-2.87-2.87zm-2.829 9.293c-1.985 0-3.595-1.609-3.595-3.595 0-1.985 1.61-3.594 3.595-3.594s3.595 1.609 3.595 3.594c0 1.985-1.61 3.595-3.595 3.595zm3.737-6.491c-.464 0-.84-.376-.84-.84 0-.464.376-.84.84-.84.464 0 .84.376.84.84 0 .463-.376.84-.84.84zm-1.404 2.896c0 1.289-1.045 2.333-2.333 2.333s-2.333-1.044-2.333-2.333c0-1.289 1.045-2.333 2.333-2.333s2.333 1.044 2.333 2.333zm-2.333-12c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6.958 14.886c-.115 2.545-1.532 3.955-4.071 4.072-.747.034-.986.042-2.887.042s-2.139-.008-2.886-.042c-2.544-.117-3.955-1.529-4.072-4.072-.034-.746-.042-.985-.042-2.886 0-1.901.008-2.139.042-2.886.117-2.544 1.529-3.955 4.072-4.071.747-.035.985-.043 2.886-.043s2.14.008 2.887.043c2.545.117 3.957 1.532 4.071 4.071.034.747.042.985.042 2.886 0 1.901-.008 2.14-.042 2.886z"/></svg>
            Instagram
          </a>
        </div>
        <h5 class="text-secondary text-center">@LeoMarqz - 2021 </h5>
      </div>
    </footer>
    <script src="./js/btn_up.js"></script>
</body>
</html>