
<?php
   include 'usuarios.php';
      
        if (isset($_POST['eliminar_usuario'])) {
            $usuario_eliminado = $_POST['eliminar_usuario'];
            $stmt = $enlace_usuarios->prepare("DELETE FROM `user` WHERE `user` = ?");
            $stmt->bind_param("s", $usuario_eliminado);
    
            if ($stmt->execute()) {
                echo "<div class='alert alert-success mx-2'>Usuario eliminado.</div>";
            } else {
                echo "<div class='alert alert-danger mx-2'>Error al eliminar el usuario " . mysqli_error($enlace_usuarios) . "</div>";
            }
            $stmt->close(); 
               header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
?>
