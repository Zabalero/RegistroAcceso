<?php session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<HTML LANG="es">
<head>
<meta http-equiv=content-type content=text/html; charset=utf-8> 
<title>Usuarios</title>
<LINK REL="stylesheet" TYPE="text/css" HREF="css/estiloDef.css?ver=1.0">
 <LINK REL="stylesheet" TYPE="text/css" HREF="css/tablas.css?ver=1.0">  

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
 
 
 function confirmarEliminar() {
	
		if(confirm("¿Confirma la eliminación?"))
		{
			return true;
		}
		return false;	

}


function confirmarResetPass() {
	
		if(confirm("¿Confirma el reseteo de las password seleccionadas?"))
		{
			return true;
		}
		return false;	

}


function confirmarExcel() {
	
		if(confirm("¿Confirma la exportación de los datos a excel?"))
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
			<h1>Registro acceso a c&aacute;mara &nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;Usuarios</h1>			
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

		
	
		
		
		
/*FIN MENU*/
			

			
		
		//ELIMINAR USUARIO
			if (isset($_REQUEST['eliminar'])) {		
							$conn=conectar_bd();
									
									   // Obtener número de registros a procesar
									  $marcarProc = $_REQUEST['marcarProc'];
									
									  $nfilas = count ($marcarProc);

												
								$noElim=0;
								$usuNoElim="";		
									  
							   // Mostrar registros a eliminar			
							   
								  for ($i=0; $i<$nfilas; $i++)
								  {
								  
													//Busca usuario en la tabla tbAccesos. Si existe un acceso de con ese usuario no se puede eliminar.
													
											$tsql3 = "SELECT tbAccesos.idAcceso, tbUsuarios.Login FROM tbAccesos LEFT JOIN tbUsuarios ON tbAccesos.idUsuario=tbUsuarios.idUsuario where tbAccesos.idUsuario = $marcarProc[$i]";
											$stmt3 = sqlsrv_query( $conn, $tsql3)
											or die ("Fallo en la consulta");
					
											$rows = sqlsrv_has_rows( $stmt3 );
											
											if ($rows === true){
												while($row3 = sqlsrv_fetch_array($stmt3)){	
													$usuEncontrado= $row3["Login"];														
												}
												$noElim=$noElim+1;
												$usuNoElim=$usuNoElim.$usuEncontrado.",";
											}
					
										    else{
										  
										
												// procesar datos
											
												$tsql = "DELETE FROM tbUsuarios WHERE idUsuario = $marcarProc[$i]";
												
														 $stmt = sqlsrv_query( $conn, $tsql)
																or die ("Fallo en la eliminación");
											
											}
									}
							
								sqlsrv_free_stmt( $stmt);
								
						if ($noElim>0){		
							$Elim=$nfilas-$noElim;
							$usuNoElim = trim($usuNoElim, ',');   //quita última coma	
							
							echo "<script languaje='javascript'>alert('Se han eliminado ".$Elim." usuarios. ".$noElim." usuarios no se han eliminado por existir en la tabla Accesos: ".$usuNoElim."')</script>";		
						}
						else{
							echo "<script languaje='javascript'>alert('Se han eliminado ".$nfilas." usuarios.')</script>";		
						}
						
		}
	
	//FIN ELIMINAR TAREA
			
			
			
			
		//RESET PASSWORD	
					if (isset($_REQUEST['resetPass'])) {
							$conn=conectar_bd();
			
									   // Obtener número de registros a procesar
									  $marcarProc = $_REQUEST['marcarProc'];
									
									  $nfilas = count ($marcarProc);

							   // Mostrar registros a eliminar			
							   
								  for ($i=0; $i<$nfilas; $i++)
								  {
								  
										//Obtiene Login del usuario
										$tsql2 = "SELECT Login from tbUsuarios WHERE idUsuario = $marcarProc[$i]";	
								
										//Obtiene el resultado
												$stmt2 = sqlsrv_query( $conn, $tsql2)	
														 or die ("Fallo en la consulta");

												//(una fila)
												while($row2 = sqlsrv_fetch_array($stmt2)){	
													$usu= $row2["Login"];														
												}
												
												sqlsrv_free_stmt( $stmt2);
									

	
								
								  // procesar datos
						
							$tsql ="UPDATE tbUsuarios SET Password='".$usu."'";
							$tsql = $tsql . " WHERE idUsuario = $marcarProc[$i]";	  
							
									 $stmt = sqlsrv_query( $conn, $tsql)
											or die ("Fallo en la actualizaci&oacute;n");									
								
									}
							
								sqlsrv_free_stmt( $stmt);
									
						echo "<script languaje='javascript'>alert('Se han reseteado ".$nfilas." contraseñas')</script>";		
		
		}
	
	//FIN RESET PASSWORD
		

		
			
			
			
			
			
			
			
			
print ("<div class='clear'></div>"); 	
			
//print("<FORM id='usuarios' ACTION='usuarios.php' METHOD='POST'>"); 
print("<FORM id='usuarios' METHOD='POST'>"); 
				
print("<div class='botones'>");

?>

	<INPUT id="resetPass" TYPE="submit" NAME="resetPass" VALUE="Resetear password" onclick="this.form.action = 'usuarios.php';return confirmarResetPass()">
	<INPUT id="eliminar" TYPE="submit" NAME="eliminar" VALUE="Eliminar" onclick="this.form.action = 'usuarios.php';return confirmarEliminar()">
	<a class="nuevoUsu" href="./adUsuarios.php">Nuevo usuario</a>


<?PHP
/*
	print('<INPUT id="resetPass" TYPE="submit" NAME="resetPass" VALUE="Resetear password" onclick="return confirmarResetPass()">');
	print('<INPUT id="eliminar" TYPE="submit" NAME="eliminar" VALUE="Eliminar" onclick="return confirmarEliminar()">');
	print('<a class="nuevoUsu" href="./adUsuarios.php">Nuevo usuario</a>');
*/
	?>	
	
	<button id="buttonExcel" type="submit" name="exportExcel" value="Exportar a excel" onclick = "this.form.action = 'excelExportUsu.php';return confirmarExcel();">
	   <input id="inputExcel" type="image" src='images/icnExcel.jpg' alt="boton exportar" />
	</button> 
	
<?PHP	
print("</div>");   //fin botones

	


		




			
			
			
		?>		
	

		
		
								
					
					<div id='tablaConsulta' class ='usuarios'>
						
							<TABLE WIDTH='780'>
								<TR>					
									<TH WIDTH='12%'>Login</TH>
									<TH WIDTH='32%'>Nombre</TH>
									<TH WIDTH='38%'>Mail</TH>
									<TH WIDTH='10%'>Perfil</TH>
									<TH WIDTH='4%'></TH> <!-- columna modificar	-->										
									<TH WIDTH='4%'></TH>						
								</TR>
							</TABLE>
							<div class='tablaDatos'>	
								<TABLE WIDTH='780'>
								
								
						
					
					
					
							

			

<?PHP




					$conn=conectar_bd();
							
								
									
									
									$tsql = "select tbUsuarios.idUsuario, tbUsuarios.Login, tbUsuarios.Nombre, tbUsuarios.Mail, tbPerfiles.Descripcion as Perfil";
									$tsql=$tsql. " from tbUsuarios LEFT JOIN tbPerfiles ON tbUsuarios.idPerfil=tbPerfiles.idPerfil order by tbUsuarios.Login";
									$stmt = sqlsrv_query( $conn, $tsql, array(), array('Scrollable' => 'buffered'))
									or die ("Fallo en la consulta");
			
			
			
									$_SESSION['sqlConsulta']=$tsql; //para exportación a excel
									
			
			
									$rows = sqlsrv_has_rows( $stmt );
									
									if ($rows === true){									
			
										$row_count = sqlsrv_num_rows( $stmt );			
			
										for ($i=0; $i<$row_count; $i++){
											$row = sqlsrv_fetch_array($stmt);
				
											if($i % 2){
												print ("<TR>\n");
											}
											else{
												print ("<TR class='even'>\n");
											}
											
											//print ("<TR>\n");						
												
												print ("<TD WIDTH='12%'>" . $row['Login'] . "</TD>\n");
												print ("<TD WIDTH='32%'>" . $row['Nombre'] . "</TD>\n");
												print ("<TD WIDTH='38%'>" . $row['Mail'] . "</TD>\n");
												print ("<TD WIDTH='10%'>" . $row['Perfil'] . "</TD>\n");
												print ("<TD WIDTH='4%'><a href=modifUsuarios.php?id=".$row["idUsuario"]."><img src='images/icnModif.jpeg' height='18' border='0' title='modificar'></a></TD>");							
												print ("<TD WIDTH='4%'><INPUT TYPE='CHECKBOX' NAME='marcarProc[]' VALUE='".$row['idUsuario']."'></TD>\n");												
											print ("</TR>\n");
										}  //end for
			
									}
		
									
				
								 // Cerrar conexión
								
								sqlsrv_free_stmt( $stmt);
								sqlsrv_close( $conn);	
								
								
								
								
							print ("</TABLE>\n");
		
						print ("</div>");  //fin tablaDatos
						
						

					print ("</div>");	//fin tablaConsulta




			print("</FORM>"); 
			
			

			
				   
				   
				   
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