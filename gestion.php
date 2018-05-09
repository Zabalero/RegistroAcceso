<?php session_start();?>


<HTML LANG="es">
<head>
<meta http-equiv=content-type content=text/html; charset=UTF-8> 
<title>Menu</title>
<LINK REL="stylesheet" TYPE="text/css" HREF="css/estiloDef.css?ver=1.0">


<script type="text/javascript">

var visibilityState = "hidden"; 

function menuAdmin() {
 var divBlock = document.getElementById("ocultoAdm"); 
 if (visibilityState == "visible") visibilityState = "hidden"; 
 else visibilityState = "visible"; 
 divBlock.style.visibility = visibilityState;
 } 

 function muestraMenuAdmin() {
 var divBlock = document.getElementById("ocultoAdm"); 
 divBlock.style.visibility = "visible";
 } 

</script>


</head>






<body>


<?PHP


//detecta si navegador es IExplorer

$user_agent = $_SERVER['HTTP_USER_AGENT'];

	/*$msie = strpos($user_agent, 'MSIE') ? true : false;
	$firefox = strpos($user_agent, 'Firefox') ? true : false;
	$safari = strpos($user_agent, 'Safari') ? true : false;*/
	$chrome = strpos($user_agent, 'Chrome') ? true : false;



//if ($chrome) {  //si navegador es chrome
	
?>
	


<div id="datosTodos">	<!--datosTodos-->
	<div id='titulo'>
		<h1>Registro acceso a c&aacute;mara</h1>
	</div>
	<div id='logo'>
	<img src="images/logo1.jpg"></img>
	</div>
			
			
			
<?php


//Se incluyen las funciones necesarias
include ('funciones.php');

$rolUsuario=get_rol($_SESSION['usuario']);

if (es_usuario($_SESSION['usuario'],$_SESSION['password'])){
//Si el usuario es un usuario registrado


			
/*MENU*/
		
		//Si el usuario tiene acceso avanzado
	   if($rolUsuario=='Avanzado'){	
			echo '<ul class="menu">	';
				echo '<li><a href="./insertar.php">Insertar datos</a></li>'; 
				echo '<li class="line">|</li>';
				echo '<li><a href="./consultar.php">Consultar datos</a></li>';				
				echo '<li class="line">|</li>';
				echo '<li onmouseenter="return menuAdmin()" onmouseleave="return menuAdmin()"><a>Administraci&oacute;n</a>';
					echo '<div id="ocultoAdm" onmouseenter="return muestraMenuAdmin()">';
					echo '<ul>';
						echo '<li><a  href="./password.php">Cambiar password</a></li>';
						echo '<li><a  href="./usuarios.php">Opciones usuarios</a></li>';
						echo '<li><a href="./adProvincias.php">Añadir provincias</a></li>';
						echo '<li><a href="./adPoblaciones.php">Añadir poblaciones</a></li>'; 			
					echo '</ul>';
					echo '</div>';
				echo '<li class="line">|</li>';		
				echo '<li><a href="./logout.php">Salir</a></li>';	
				echo '</li>';
				echo '<li class="line">|</li>';		
				echo '<li id="usuarioreg"><p>Usuario: '.get_nombre($_SESSION['usuario']).'</p></li>';		
					
			echo '</ul>';
		}
		
		
		if($rolUsuario=='Insercion'){	
			echo '<ul class="menu">	';
				echo '<li><a href="./insertar.php">Insertar datos</a></li>'; 
				echo '<li class="line">|</li>';
				echo '<li><a href="./consultar.php">Consultar datos</a></li>';				
				echo '<li class="line">|</li>';
				echo '<li onmouseenter="return menuAdmin()" onmouseleave="return menuAdmin()"><a>Administraci&oacute;n</a>';
					echo '<div id="ocultoAdm" onmouseenter="return muestraMenuAdmin()">';
					echo '<ul>';
						echo '<li><a  href="./password.php">Cambiar password</a></li>'; 
					echo '</ul>';
					echo '</div>';	
				echo '</li>';
				echo '<li class="line">|</li>';	
				echo '<li><a href="./logout.php">Salir</a></li>';	
				echo '<li class="line">|</li>';		
				echo '<li id="usuarioreg"><p>Usuario: '.get_nombre($_SESSION['usuario']).'</p></li>';		
					
			echo '</ul>';

		}
		
		
			
		if($rolUsuario=='Lectura'){	
			echo '<ul class="menu">	';				
				echo '<li><a href="./consultar.php">Consultar datos</a></li>';				
				echo '<li class="line">|</li>';
				echo '<li onmouseenter="return menuAdmin()" onmouseleave="return menuAdmin()"><a>Administraci&oacute;n</a>';
					echo '<div id="ocultoAdm" onmouseenter="return muestraMenuAdmin()">';
					echo '<ul>';
						echo '<li><a  href="./password.php">Cambiar password</a></li>'; 
					echo '</ul>';
					echo '</div>';	
				echo '</li>';
				echo '<li class="line">|</li>';	
				echo '<li><a href="./logout.php">Salir</a></li>';	
				echo '<li class="line">|</li>';		
				echo '<li id="usuarioreg"><p>Usuario: '.get_nombre($_SESSION['usuario']).'</p></li>';		
					
			echo '</ul>';

		}
	

		
/*FIN MENU*/

}

else //Si no es usuario registrado, se le deniega el acceso.
echo '<p>Acceso denegado</p>';




?>

</div>

<?PHP
/*
} //fin si el navegador es Chrome
 
 
 else{
 
 echo '<p>La aplicaci&oacute;n est&aacute; optimizada para el navegador Chrome</p>';
  } 
*/
?>

</body>
</html>