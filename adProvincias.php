<?php session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<HTML LANG="es">
<head>
<meta http-equiv=content-type content=text/html; charset=utf-8> 
<title>Nueva provincia</title>
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

 
 function confirmarGuardar() {
	
		if(confirm("¿Confirma la modificación?"))
		{
			return true;
		}
		return false;	

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
	



include ('funciones.php');

$rolUsuario=get_rol($_SESSION['usuario']);

if (es_usuario($_SESSION['usuario'],$_SESSION['password'])){
	if($rolUsuario=='Avanzado'){   
	
	
	
	?>





		<div id="datosTodos">	<!--datosTodos-->
			<div id='titulo'>
			<h1>Registro acceso a c&aacute;mara &nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;Administraci&oacute;n provincias</h1>			
			</div>
			<div id='logo'>
			<img src="images/logo1.jpg"></img>
			</div>
			

			
			
			
			
		
	
<?PHP



	
						
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
		
		

	
		

		
/*FIN MENU*/
			
			
	

		
		

				// Obtener valores introducidos en el formulario

				// Conectar con el servidor de base de datos
				$conexion=conectar_bd();
				$insertar = $_REQUEST['insertar'];
   
				// Provincia
				$provincia = $_REQUEST['provincia'];
	
	
				

				
				
				
				
				

 
			// procesar formulario
			   if (isset($insertar) ){
				
				if ($provincia!=''){
							
					// Conectar con el servidor de base de datos
					$conn=conectar_bd();		


					$tsql = "select * from tbProvincias where Descripcion = '$provincia'";

					$stmt = sqlsrv_query( $conn, $tsql)	
					or die ("Fallo en la consulta");
					
					$rows = sqlsrv_has_rows( $stmt );
					sqlsrv_free_stmt( $stmt);
					if ($rows === true){				
						echo "<script>alert('La provincia ya existe')</script>";
						
					}
				
					else {
		
		
					$tsql = "insert into tbProvincias (Descripcion) values ".
                     "('$provincia')";
					
					$stmt = sqlsrv_query( $conn, $tsql)	
								 or die ("Fallo en la actualización");
					
					sqlsrv_free_stmt( $stmt);
					
					
					echo "<script>alert('Datos insertados correctamente')</script>";

					//print ("<p><a href='index.php'>Inicio</a></p>");
					}
				}
				}
				
				

				
				
			
				
				
				

?>


	
	
	<div class="index"><!--clase index-->
				
		<h3>Nueva provincia</h3>
				
		<div class="bloque">	<!--bloque1-->	

			
				<form action='adProvincias.php' name='' autocomplete="off" method='post'>



				<label class="" id="" for="provincia">
								Provincia
				</label>
				<div>
				<input id='provincia' type='text' name='provincia'
									<?PHP
											  // if (isset($insertar))
												 // print (" VALUE='$provincia'>\n");
											  // else
												  print (">\n");
									?>
				</div>





				<p><input type='submit' id="botonguardar" name='insertar' value='Guardar' onclick='return confirmarGuardar()'/></p>
				</form>
		
	
			
		</div><!--bloque1-->		
	</div><!--clase index-->
			
		<?php
	
	



			

			
				   
				   
				   
				   } //  fin es usuario 'usuario'
	else{
	//Si no, deniega el acceso.
	echo '<p>Acceso denegado</p>';
	echo '<p><a href="./index.php">Login</a></p>';
	}

} // 'fin es usuario registrado en base de datos
else{
//Si no, deniega el acceso.
echo '<p>Acceso denegado</p>';
echo '<p><a href="./index.php">Login</a></p>';
}      
									
					?>
				
		


	</div>	<!--datosTodos->
	
	<?PHP
	/*
} //fin si el navegador es Chrome
 
 
 else{
 
 echo '<p>La aplicaci&oacute;n est&aacute; optimizada para el navegador Chrome</p>';
  } 
*/
?>
	
</BODY>
</HTML>