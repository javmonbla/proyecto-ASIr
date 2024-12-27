<?php
include 'usuarios.php';
//verifica si no hay una sesion activa y en tal caso la inicia
  if(session_status() === PHP_SESSION_NONE){
	 session_start();
	}
//si no hay un usuario definido en la variable de sesion redirige a inicar_sesion.php
   if (empty($_SESSION['user'])) {
        header("Location: iniciar_sesion.php");
        exit;
    }
    $usuario = $_SESSION["user"];

        $stmt = $enlace_usuarios->prepare("SELECT confirmada FROM user WHERE user = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $res = $fila['confirmada'];
//si el usuario no ha cambiado la contrase;a al menos una vez le redirige a contrase;a.php a que la cambie obligatoriamente

        	if($res == 0){
            		header("Location: contraseña.php");
            		exit;
        	} else {
		}
        } else {
       		echo "Usuario no encontrado.";
    	}

//despues tiene dos funciones aparte si pulsan el boton cerrar sesion o volver al calendario
    	if (isset($_POST['borrar'])) {
        	session_destroy();
        	header("Location: iniciar_sesion.php");
        	exit;
   	}
        if (isset($_POST['volver'])){
        	header("Location: calendario2.php");}
        ?>
