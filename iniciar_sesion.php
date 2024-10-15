<?php
include 'sesion.php';
?>
<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">     
<title>JMB Login</title>    
    
        <header style="background-color: rgb(27, 77, 124)">
            <div class="p-3">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="formulario">
                    <div class="row justify-content-end">
                        <div class="col-2">
                            <label style="color: rgb(133, 31, 26)" for="user"><strong>Usuario</strong></label>
                            <input type="text" name="user">
                        </div>
                        <div class="col-2">
                            <label style="color: rgb(133, 31, 26)" for="pass"><strong>Contraseña</strong></label>
                            <input type="password" name="pass"/>                    
                        </div>
                            <button style="color: rgb(133, 31, 26)" class="col-1 btn btn-outline-dark mx-3" name="inicio" type="submit"><strong>Iniciar sesión</strong></button>
                        </div>
                        
                </form>
            </div>
            </header>
            <body style="background-color: rgb( 172, 195, 217 );padding-bottom: 100px;">
            <div class="row ">
            <div class="col-3">
            <img class="img-fluid mx-4 pt-4" width=400 src="JMB2.jpg"> 
            </div>
            <div class="col-7">
            <p class="text-center pt-4 fs-4">
            Grupo JMB es una empresa nacida en 2021 de la mano de tres emprendedores, expertos en el sector tanto financiero como jurídico, para convertirse rápidamente en la empresa más eficiente de España a la hora de ayudar a las personas a salir de situaciones de sobreendeudamiento. 
            Nuestro compromiso es ajustarnos a las necesidades de nuestros clientes, trabajando tanto con nuestro revolucionario programa, como con la Ley de la Segunda Oportunidad, realizando un estudio previo personalizado y 100% gratuito. 
            <br><b>¡Seguimos trabajando en nuestra misión de proporcionar soluciones efectivas a aquellos que enfrentan desafíos económicos y brindar un servicio al cliente excepcional!</b> 
            </p>
            </div>
            </div>
            </body>
            <footer style="background-color: rgb(27, 77, 124);  width: 100%; position: fixed; bottom:0; left:0">            
            <div class="p-2">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="formulario2">
                    <div class="row justify-content-center">
                        <div class="col-2">
                            <label style="color: rgb(133, 31, 26)" for="new_user"><strong>Nuevo usuario</strong></label>
                            <input type="text" name="new_user">
                        </div>
                        <div class="col-2">
                            <label style="color: rgb(133, 31, 26)" for="new_pass"><strong>Nueva contraseña</strong></label>
                            <input type="password" name="new_pass"/>                    
                        </div>                        
                        <button style="color: rgb(133, 31, 26)" class="col-1 btn btn-outline-dark mx-2" name="agregar" type="submit"><strong>Agregar usuario</strong></button>
                    </div>
                </form>
            </div>
            </footer>
    
</html>
