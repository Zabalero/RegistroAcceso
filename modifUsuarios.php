<?php session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<HTML LANG="es">
<head>
<meta http-equiv=content-type content=text/html; charset=utf-8> 
<title>Nuevo usuario</title>
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
				$conn=conectar_bd();
				$modificar = $_REQUEST['modificar'];
				$id=$_REQUEST['id'];
				
				// Provincia
				$login = $_REQUEST['login'];	
				$nombre = $_REQUEST['nombre'];
				$mail = $_REQUEST['mail'];
				$perfil = $_REQUEST['perfil'];
				
			
	
				

				
				
				
				
				

 
			// procesar formulario
			   if (isset($modificar) ){
				
				if ($login!='' && $nombre!='' && $perfil!=''){
							
					// Conectar con el servidor de base de datos
					$conn=conectar_bd();		

					/*
					$tsql = "insert into tbUsuarios (Login, Password, Nombre, idPerfil" ;
                   
					
					if (!empty($_POST['mail']))
					$tsql = $tsql . ", Mail";
				
					
					
					$tsql = $tsql . ") values ('$login', '$password', '$nombre', '$perfil'";
					
					if (!empty($_POST['mail']))
					$tsql = $tsql . ", '$mail'";
					
					$tsql = $tsql . ")";	
					*/
					
					$tsql ="UPDATE tbUsuarios SET Login='".$login."', Nombre='".$nombre."', idPerfil='".$perfil."',";
							
														
							if (empty($_POST['mail']))
								$tsql = $tsql . " mail=NULL,";
							else	
								$tsql = $tsql . " mail='".$mail."',";
								
							
														
							
							$tsql = trim($tsql, ',');   //quita última coma		
							
							$tsql = $tsql . " WHERE idUsuario='".$id."'";
					
					
					
					$stmt = sqlsrv_query( $conn, $tsql)	
								 or die ("Fallo en la actualización");
					
					sqlsrv_free_stmt( $stmt);
					
					
					echo "<script>alert('Datos modificados correctamente')</script>";

				}
				
				else{
					echo "<script>alert('Falta rellenar todos los campos')</script>";
				}
				}
				
				

			


			
						
		$tsql = "select * from tbUsuarios WHERE idUsuario = '".$id."'";

				                                           
				$stmt = sqlsrv_query( $conn, $tsql, array(), array('Scrollable' => 'buffered'))
									or die ("Fallo en la consulta");
			
		
					// Mostrar resultados de la consulta
							$rows = sqlsrv_has_rows( $stmt );
							
		if ($rows === true){						
				while($row = sqlsrv_fetch_array($stmt)){		
			
				
				
				

?>


	
	
	<div class="index"><!--clase index-->
				
		<h3>Nuevo usuario</h3>
				
		<div class="bloque">	<!--bloque1-->	

			
				<form action='modifUsuarios.php' name='' autocomplete="off" method='post'>



				<label class="" id="" for="login">
								Login
				</label>
				<div>
				<input id='login' type='text' name='login'
									<?PHP											  							  
												 print (" VALUE='".$row["Login"]."' readonly>\n");										
									?>
				</div>
				
				
				
				
				
				<label class="" id="" for="nombre">
								Nombre
				</label>
				<div>
				<input id='nombre' type='text' name='nombre'
									<?PHP
												  print (" VALUE='".$row["Nombre"]."'>\n");
									?>
				</div>
				
				
				
				
				<label class="" id="" for="mail">
								Mail
				</label>
				<div>
				<input id='mail' type='text' name='mail'
									<?PHP											  
												  print (" VALUE='".$row["Mail"]."'>\n");
									?>
				</div>
				
				

				
				
				
				<label class="" id="" for="perfil">
								Perfil
				</label>
				<div>
					<select id="perfil" class="" tabindex="3" name= "perfil">
							<?PHP
							
								
								// Conectar con el servidor de base de datos
								//$conn=conectar_bd();
							// Enviar consulta
								$tsql2 = "select idPerfil, Descripcion from tbPerfiles";
								$stmt2 = sqlsrv_query( $conn, $tsql2)
								 or die ("Fallo en la consulta");
								
					
								$rows = sqlsrv_has_rows( $stmt2 );
								if ($rows === true){					
									while($row2 = sqlsrv_fetch_array($stmt2)){
							
										if($row2["idPerfil"]==$row["idPerfil"]){
											echo '<option value= "'.$row2["idPerfil"].'" selected>'.$row2["Descripcion"].'</option>';
													
										}
										else{
											echo '<option value= "'.$row2["idPerfil"].'">'.$row2["Descripcion"].'</option>';
										} 
										
										} 
								}		
								sqlsrv_free_stmt( $stmt2);
								
								
							?>
					</select>
				</div>


				<?php
				
				

					/*textbox invisible*/
								print('<input id="" name="id" type="hidden" class="" maxlength="50" tabindex="" onkeyup="" ');	  
									  print (" VALUE=".$id.">\n");
				
				?>


				<p><input type='submit' id="botonguardar" name='modificar' value='Guardar' onclick='return confirmarGuardar()'/></p>
				</form>
		
	
			
		</div><!--bloque1-->		
	</div><!--clase index-->
			
		<?php
	
	} //end while
							}	
							else
								print ("No hay datos detalle disponibles");	


			 // Cerrar conexión
									sqlsrv_close( $conn);



			

			
				   
				   
				   
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