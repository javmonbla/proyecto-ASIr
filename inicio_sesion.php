
<?php
   session_start();
   if (empty($_SESSION['user'])) {
        header("Location: iniciar_sesion.php");
        exit;
    }
    $usuario = $_SESSION["user"];
       
    if (isset($_POST['borrar'])) {
        session_destroy();
        header("Location: iniciar_sesion.php");
        exit;
    }
    
        if (isset($_POST['volver'])){
        header("Location: calendario2.php");}
        ?>