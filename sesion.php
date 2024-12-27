<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include 'usuarios.php';

//Comprobaciones cuando se pulsa el boton iniciar sesion en el archivo iniciar_sesion.php

if (isset($_POST['inicio'])) {
//siempre se trae como variables los datos introducidos en usuario y contrase'a
//ademas se hace una consulta a la base de datos para saber si el usuario existe previamente en la base de datos
    $usuario = $_POST['user'];
    $contraseña = $_POST['pass'];

    $stmt = $enlace_usuarios->prepare("SELECT * FROM `user` WHERE `user` = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $res_u = $stmt->get_result();
    $c = $res_u->fetch_assoc();

    if ($res_u->num_rows > 0) {
// si el usuario existe se trae la contrase'a de la base de datos en otra variable
        $b = $c['pass'];

            if (password_verify($contraseña, $b )) {
		//si la variable contrase;a de la base de datos y de la pagina iniciar_sesion.php coinciden inicia, guarda la sesion en una variable y te manda la pagina calendario2.php
                session_start();
                $_SESSION["user"] = $usuario;
                header("Location: calendario2.php");
                exit();

            } else {
		//si no coinciden las contrase;as te escribe un mensaje
            echo "El usuario o la contraseña son incorrectos";
            }

    } elseif (strpos($usuario, '@trabajo.grupojmb') !== false) {
//si el usuario no existia previamente en nuestra base de datos, comprueba si el usuario introducido contiene nuestro dominio de correo
//si lo contiene almacena en una variable el contenido del archivo de los usuarios del servidor, crea otra variable y una funcion para generar una contrase;a de 4 digitos
		$archivo ='/etc/passwd';
		$primeros_argumentos = [];
		function generarpassword() {
			return strval(rand(1000,9999));
	        }
		if($file = fopen($archivo, 'r')) {
//entonces abre el archivo y cada la linea la divide por el simbolo ":" y almacena en una variable el tercer argumento de cada linea que es el ID de usuario
			while (($linea = fgets($file)) !== false) {
				$partes = explode(":", $linea);
				$tercer_argumento = (int)$partes[2];
				if($tercer_argumento >= 1000) {
		//para cada uno de estos terceros argumentos comprueba si es mayor que mil quiere decir que es un usuario creado por el administrador,
		//los usuarios menores que mil suelen ser usuarios del sistema y/o de los servicios
		//los mayores que mill los modifica y les a;ade al primer artgumente, el usuario del sistema nuestro dominio de correo
					$primero_modificado = $partes[0] . "@trabajo.grupojmb";
					$primeros_argumentos[] = $primero_modificado;

					if(in_array($usuario, $primeros_argumentos)) {
			//entonces comprueba si el usuario que intento iniciar sesion coincide con algun usuario del sistema.dominio
			//si es que si le genera una contrase;a con la funcion que vimos antes, se la envia al correo y lo agrega usuario y contrase;a la base de datos de usuario
						$password = generarpassword();
						$password_hash = password_hash($password, PASSWORD_DEFAULT);
						$mail = new PHPMailer(true);
						try {
						$mail->isSMTP();
						$mail->Host = "172.16.1.130";
						$mail->Username = "servidor@trabajo.grupojmb";
						$mail->Password = "1234";
						$mail->SMTPSecure = 'tls';
						$mail->SMTPOptions = [
							'ssl' => [
								'verify_peer' => false,
								'verify_peer_name' => false,
								'allow_self_signed' => true
								]
							];
						$mail->setFrom('servidor@trabajo.grupojmb', 'grupojmb');
						$mail->addAddress($usuario, 'jmb');
						$mail->isHTML(true);
						$mail->Subject = 'Nuevo Usuario grupo JMB';
						$mail->Body = '<h1>Bienvenido a la web de reservas de grupo JMB</h1></br><p>Gracias por darte de alta de en nuestra web de reserva de mesas, su password es:' . $password; 
						$mail->send();
							  echo 'Hemos registrado su usuario su password debe haberle llegado al correo';

						$stmt = $enlace_usuarios->prepare("INSERT INTO user (user, pass) VALUES (?, ?)");
						$stmt->bind_param("ss", $usuario, $password_hash);
						if($stmt->execute()) {
							echo " ";
						}else{
							echo "error al agregar";
						}
						break;
						} catch (Exception $e) {
							echo 'Este usuario no esta registrado en el sistema';
						}
					}
				}
			}
		}
        } else {
        // El usuario no existe
        echo "El usuario o la contraseña son incorrectos";
        }

    // Cerrar la declaración
    $stmt->close();
}

// Cerrar la conexión
mysqli_close($enlace_usuarios)
   ?>
