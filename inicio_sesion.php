
<?php
include 'usuarios.php';
   session_start();
   if (empty($_SESSION['user'])) {
        header("Location: iniciar_sesion.php");
        exit;
    }
    $usuario = $_SESSION["user"];
        
        $stmt = $enlace_usuarios->prepare("SELECT pass FROM user WHERE user = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $res = $fila['pass'];

        if( strlen($res) === 4){
            header("Location: contraseña.php");
            exit;
        } else {
            
        }
    } else {
        echo "Usuario no encontrado.";
    }
    
       
    if (isset($_POST['borrar'])) {
        session_destroy();
        header("Location: iniciar_sesion.php");

        exit;
    }
    
        if (isset($_POST['volver'])){
        header("Location: calendario2.php");}
        ?>