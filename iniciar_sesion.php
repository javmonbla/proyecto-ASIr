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
                            <label style="color:white" for="user"><strong>Usuario</strong></label>
                            <input type="text" name="user">
                        </div>
                        <div class="col-2">
                            <label style="color:white" for="pass"><strong>Contraseña</strong></label>
                            <input type="password" name="pass"/>
                        </div>
                            <button class="col-1 btn btn-outline-light mx-3" name="inicio" type="submit"><strong>Iniciar sesión</strong></button>
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
            <div>
                <div class="row align-items-center">
			<div class="col-1 d-flex align-items-start">
				<img class="img-fluid" width=70 src="JMB2.jpg">
			</div>
			<div class="col-2 d-flex align-items-start">
				<h4 style="color:white;">Grupo JMB</h4>
			</div>
			<div class="col d-flex flex-grow-1 justify-content-between align-items-start m-3" style="margin-left: 20px;">
				<h4 style="color:white; margin: 0;">Proyecto ASIR - IES Aguadulce 24/25</h4>
				<h4 style="color:white; margin: 0;">Javier Montoro Blasco</h4>
			</div>
		</div>
            </div>
        </footer>
</html>
