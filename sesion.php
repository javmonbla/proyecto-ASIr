
<?php
     include 'usuarios.php';

   if (isset($_POST['inicio'])) {            
    $usuario = $_POST['user'];
    $contraseña = $_POST['pass']; 
    
    // Preparar la consulta SQL usando consultas preparadas
    $stmt = $enlace_usuarios->prepare("SELECT * FROM `user` WHERE `user` = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $res_u = $stmt->get_result();
    $c = $res_u->fetch_assoc();

    if (mysqli_num_rows($res_u) > 0) {
        $a = $c['user'];
        $b = $c['pass'];

        // Verificar la contraseña usando password_verify
            if ($contraseña == $b ) {
                // La contraseña es correcta, se puede iniciar la sesión del usuario
                session_start();
                $_SESSION["user"] = $usuario;
                header("Location: calendario2.php");
                exit();
            } else {
            // La contraseña es incorrecta
            echo "El usuario o la contraseña son incorrectos";
            }
        } else {
        // El usuario no existe
        echo "El usuario o la contraseña son incorrectos";
        } 

    // Cerrar la declaración
    $stmt->close();
}

if (isset($_POST['agregar'])) {
    $usuario = $_POST['new_user'];
    $contraseña = $_POST['new_pass'];

    // Preparar la consulta SQL para verificar si el usuario ya existe
    $stmt = $enlace_usuarios->prepare("SELECT COUNT(*) FROM `user` WHERE `user` = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();

    $stmt->close();
    
    // Si el usuario ya existe
    if ($count > 0) {
        echo "El usuario ya existe.";
    } else {
        // Preparar la consulta SQL para insertar el nuevo usuario
        $stmt = $enlace_usuarios->prepare("INSERT INTO `user` (`user`, `pass`) VALUES (?, ?)");
        $stmt->bind_param("ss", $usuario, $contraseña);

        // Ejecutar la consulta y verificar si se insertó correctamente
        if ($stmt->execute()) {
            echo "Usuario agregado exitosamente.";
        } else {
            echo "Error al agregar el usuario: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    }
}



// Cerrar la conexión
mysqli_close($enlace_usuarios)
   ?>