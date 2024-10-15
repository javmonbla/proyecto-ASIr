
<?php
   $host = "localhost";                                                                                        
   $user = "admin";
   $pwd = "iier]9*7P>;Ye?+";
   $bdd_eventos = "eventos";
   $enlace_eventos = mysqli_connect($host, $user, $pwd, $bdd_eventos);
       if (!$enlace_eventos){
           die("No se pudo realizar la conexión: " . mysqli_connect_error());
       }
         
           
?>