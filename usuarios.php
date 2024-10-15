
<?php
   $host = "localhost";                                                                                        
   $user = "admin";
   $pwd = "iier]9*7P>;Ye?+";
   $bdd_usuarios = "usuarios";
   $enlace_usuarios = mysqli_connect($host, $user, $pwd, $bdd_usuarios);
       if (!$enlace_usuarios){
           die("No se pudo realizar la conexión: " . mysqli_connect_error());
       }

?>