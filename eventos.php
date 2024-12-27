
<?php
   $host = getenv('DB_HOST');                                                                                        
   $user = getenv('DB_USER');
   $pwd = getenv('DB_PASSWORD');
   $bdd_eventos = getenv('DB_NAME2');
   $enlace_eventos = mysqli_connect($host, $user, $pwd, $bdd_eventos);
       if (!$enlace_eventos){
           die("No se pudo realizar la conexión: " . mysqli_connect_error());
	echo "algo ha fallado";      
 }         
           
?>
