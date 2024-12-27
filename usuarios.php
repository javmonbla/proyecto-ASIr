<?php

   $host = getenv('DB_HOST');
   $user = getenv('DB_USER');
   $pwd = getenv('DB_PASSWORD');
   $bdd_usuarios = getenv('DB_NAME');
   $enlace_usuarios = mysqli_connect($host, $user, $pwd, $bdd_usuarios);
       if (!$enlace_usuarios){
           error_log("No se pudo realizar la conexión: " . mysqli_connect_error(), 3, '/var/log/app_errors.log');
	   die("Error al conectar con la base de datos. Por favor, intentelo mas tarde.");
       }
?>
