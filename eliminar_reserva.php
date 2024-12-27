
<?php
        if (isset($_POST['eliminar_reserva'])) {
        $elimina = $_POST['eliminar_reserva'];
        $elimina_mesa = $_POST['eliminar_reserva_mesa'];
        var_dump($elimina_mesa);
	if($elimina_mesa ==1){
        $stmt = $enlace_eventos->prepare("DELETE FROM `evento` WHERE `fecha` = ?");
        } else {
            $stmt = $enlace_eventos->prepare("DELETE FROM `evento2` WHERE `fecha` = ?");
        }

        $stmt->bind_param("s", $elimina);
        if ($stmt->execute()) {
            echo "<div class='alert alert-success mx-2'>Verificado correctamente</div>";
        } else {
            echo "<div class='alert alert-danger mx-2'>Error al verificar: " . mysqli_error($enlace_eventos) . "</div>";
        }
    
        $stmt->close();
    
       header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }; 

        if (isset($_POST['verificar_reserva'])) {
            $verifica = $_POST['verificar_reserva'];
            $verifica_mesa = $_POST['verificar_reserva_mesa'];
            if($verifica_mesa ==1){
            $stmt = $enlace_eventos->prepare("UPDATE `evento` SET `confirmada` = '1' WHERE `fecha` = ?");
            } else {
                $stmt = $enlace_eventos->prepare("UPDATE `evento2` SET `confirmada` = '1' WHERE `fecha` = ?");
            }
            $stmt->bind_param("s", $verifica);
        
            if ($stmt->execute()) {
                echo "<div class='alert alert-success mx-2'>Verificado correctamente</div>";
            } else {
                echo "<div class='alert alert-danger mx-2'>Error al verificar: " . mysqli_error($enlace_eventos) . "</div>";
            }
        
            $stmt->close();
        
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }; 
            
?>
