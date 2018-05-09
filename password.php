<?php session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<HTML LANG="es">
<head>
<meta http-equiv=content-type content=text/html; charset=utf-8> 
<title>Modificar password</title>
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
	



include ('funciones.php');

$rolUsuario=get_rol($_SESSION['usuario']);

if (es_usuario($_SESSION['usuario'],$_SESSION['password'])){
		if($rolUsuario=='Avanzado' || $rolUsuario=='Insercion' || $rolUsuario=='Lectura'){     
	
	
	
	?>





		<div id="datosTodos">	<!--datosTodos-->
			<div id='titulo'>
			<h1>Registro acceso a c&aacute;mara &nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;Cambio password</h1>			
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
			
			
	

		
		

				// Obtener valores introducidos en el formulario

				// Conectar con el servidor de base de datos
				
				$aceptar = $_REQUEST['aceptar'];
				$usu=$_SESSION['usuario'];
				// Password antigua
				/*if ($_REQUEST['pass1'] == ''){	
					$pass1 ='';
				}
				else{*/
				
				$pass1 = $_REQUEST['pass1'];
				
				/*
				}*/
	
	
				//Password nueva
				$pass21 = $_REQUEST['pass21'];
				$pass22 = $_REQUEST['pass22'];

				
				
				
				if (isset($aceptar)){
				
				
					if ($pass1!='' && $pass21!='' && $pass22!=''){

				// Conectar con el servidor de base de datos
					$conn=conectar_bd();		


					$tsql= "select idUsuario, Login, Password from tbUsuarios where Login ='".$usu."'";

					$stmt = sqlsrv_query( $conn, $tsql)	
					or die ("Fallo en la consulta");


						while($row = sqlsrv_fetch_array($stmt)){	
							$password1= $row["Password"]; 
						}
						
						sqlsrv_free_stmt( $stmt);
						
				
					if($pass1==$password1 && $pass21==$pass22){						
						//cambia password
						
							$tsql ="UPDATE tbUsuarios SET Password='".$pass21."'";
							$tsql = $tsql . " WHERE Login ='".$usu."'";
							$stmt = sqlsrv_query( $conn, $tsql)	
								 or die ("Fallo en la actualización");
					
							sqlsrv_free_stmt( $stmt);
							
							header("Location: index.php");
					}
					
					else{
					
						echo "<script>alert('Las password no coinciden. No se realiza el cambio')</script>";
					
					}
			
			}
			
			else{
				echo "<script>alert('Debe rellenar todos los campos')</script>";
			}

			
		}			
				
				

				
				
			
				
				
				

?>


	
	
	<div class="index"><!--clase index-->
				
		<h3>Cambio de password</h3>
				
		<div class="bloque">	<!--bloque1-->	

			<form action='password.php' name='login' autocomplete="off" method='post'>



				<label class="" id="" for="pass1">
								Password actual
				</label>
				<div>
					<input id='pass1' type='password' name='pass1' />
				</div>


				<label class="" id="" for="pass21">
								Nueva Password
				</label>
				<div>
					<input id='pass21' type='password' name='pass21' />
				</div>
				
				<label class="" id="" for="pass22">
								Repetir nueva Password
				</label>
				<div>
					<input id='pass22' type='password' name='pass22' />
				</div>

				<p><input type='submit' id='botonguardar' name='aceptar' value='Aceptar' /></p>
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