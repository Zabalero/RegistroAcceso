<?php
session_start ();
?>
<HTML LANG="es">

<HEAD>

	<meta http-equiv=content-type content=text/html; charset=utf-8> 
   <TITLE>Detalle acceso</TITLE>
   
  
   <LINK REL="stylesheet" TYPE="text/css" HREF="css/tablas.css?ver=1.0">
   <LINK REL="stylesheet" TYPE="text/css" HREF="css/estiloDef.css?ver=1.0">
   

	
	   <script type="text/javascript">
<!--

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
 


function confirmation() {
    if(confirm("�Confirma la modificaci�n?"))
    {
        return true;
    }
    return false;
	
}



function soloLectura() {    
	
	var boxesInput = document.getElementsByTagName("INPUT");

	for(var i = 0; i < boxesInput.length; i++){
		// if(boxesInput[i].type == 'text')
		boxesInput[i].readOnly=true;
	};	
	
	var boxesSelect = document.getElementsByTagName("SELECT");

	for(var i = 0; i < boxesSelect.length; i++){
		// if(boxesSelect[i].type == 'text')
		boxesSelect[i].disabled=true;
		boxesSelect[i].style.color = "black";  //para evitar color gris de 'Disabled'
	};
		
	var boxesTextArea = document.getElementsByTagName("textarea");

	for(var i = 0; i < boxesTextArea.length; i++){
		boxesTextArea[i].readOnly=true;
	};
		
}



//-->
</script>
   
</HEAD>
<?PHP
include ('funciones.php');

$rolUsuario = get_rol ( $_SESSION ['usuario'] );
if ($rolUsuario == 'Insercion' || $rolUsuario == 'Lectura')
	print ('<body onload="soloLectura()">') ;
else
	print ('<body') ;

?>
<div id="datosTodos">  <!--datosTodos-->
	<div id='titulo'><H1>Detalle acceso</H1></div>
	<div id='logo'><img src="images/logo1.jpg"></img></div>
	
<?PHP
// include ('funciones.php');
// $rolUsuario=get_rol($_SESSION['usuario']);
if (es_usuario ( $_SESSION ['usuario'], $_SESSION ['password'] )) {
	if ($rolUsuario == 'Avanzado' || $rolUsuario == 'Insercion' || $rolUsuario == 'Lectura') {
		/* MENU */
		// Si el usuario tiene acceso avanzado
		if ($rolUsuario == 'Avanzado') {
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
			echo '<li><a  href="./tecnicos.php">Opciones t&eacute;cnicos</a></li>';
			echo '<li><a href="./adProvincias.php">A�adir provincias</a></li>';
			echo '<li><a href="./adPoblaciones.php">A�adir poblaciones</a></li>';
			echo '</ul>';
			echo '</div>';
			echo '<li class="line">|</li>';
			echo '<li><a href="./logout.php">Salir</a></li>';
			echo '</li>';
			echo '<li class="line">|</li>';
			echo '<li id="usuarioreg"><p>Usuario: ' . get_nombre ( $_SESSION ['usuario'] ) . '</p></li>';
			echo '</ul>';
		}
		if ($rolUsuario == 'Insercion') {
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
			echo '<li id="usuarioreg"><p>Usuario: ' . get_nombre ( $_SESSION ['usuario'] ) . '</p></li>';
			echo '</ul>';
		}
		if ($rolUsuario == 'Lectura') {
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
			echo '<li id="usuarioreg"><p>Usuario: ' . get_nombre ( $_SESSION ['usuario'] ) . '</p></li>';
			echo '</ul>';
		}
		/* FIN MENU */
		echo '<div class="clear"></div>';
		echo '<p><a class="boton" href=javascript:history.back()>Volver a filtrado anterior</a></p>';
		echo '</br>';
		$conn = conectar_bd ();
		
		$modificar = $_REQUEST ['modificar'];
		$id = $_REQUEST ['id'];
		
		$dni = $_POST ['dni'];
		$nombre = $_POST ['nombre'];
		$apellidos = $_POST ['apellidos'];
		$telTecnico = $_POST ['telTecnico'];
		$autorizado = $_POST ['autorizado'];
		$contrata = $_POST ['contrata'];
		$subcontrata = $_POST ['subcontrata'];
		$camara = $_POST ['camara'];
		$poblacion = $_POST ['poblacion'];
		$tipo = $_POST ['tipo'];
		$codigo = $_POST ['codigo'];
		$comentario = $_POST ['comentario'];
		
		if (isset ( $modificar )) {
			$tsql = "UPDATE tbAccesos SET";
			if (empty ( $_POST ['dni'] ))
				$tsql = $tsql . " DNI=NULL,";
			else
				$tsql = $tsql . " DNI='" . $dni . "',";
			if (empty ( $_POST ['nombre'] ))
				$tsql = $tsql . " Nombre=NULL,";
			else
				$tsql = $tsql . " Nombre='" . $nombre . "',";
			if (empty ( $_POST ['apellidos'] ))
				$tsql = $tsql . " Apellidos=NULL,";
			else
				$tsql = $tsql . " Apellidos='" . $apellidos . "',";
			if (empty ( $_POST ['telTecnico'] ))
				$tsql = $tsql . " Telefono_Tecnico=NULL,";
			else
				$tsql = $tsql . " Telefono_Tecnico='" . $telTecnico . "',";
			if ($_POST ['autorizado'] == '')
				$tsql = $tsql . " Autorizado=NULL,";
			else
				$tsql = $tsql . " Autorizado='" . $autorizado . "',";
			if (empty ( $_POST ['contrata'] ))
				$tsql = $tsql . " Contrata=NULL,";
			else
				$tsql = $tsql . " Contrata='" . $contrata . "',";
			if (empty ( $_POST ['subcontrata'] ))
				$tsql = $tsql . " Subcontrata=NULL,";
			else
				$tsql = $tsql . " Subcontrata='" . $subcontrata . "',";
			if (empty ( $_POST ['camara'] ))
				$tsql = $tsql . " Camara=NULL,";
			else
				$tsql = $tsql . " Camara='" . $camara . "',";
			if (empty ( $_POST ['poblacion'] ))
				$tsql = $tsql . " idPoblacion=NULL,";
			else
				$tsql = $tsql . " idPoblacion='" . $poblacion . "',";
			if (empty ( $_POST ['tipo'] ))
				$tsql = $tsql . " Tipo=2,";
			else
				$tsql = $tsql . " Tipo='" . $tipo . "',";
			if (empty ( $_POST ['codigo'] ))
				$tsql = $tsql . " Codigo_TP_Remedy=NULL,";
			else
				$tsql = $tsql . " Codigo_TP_Remedy='" . $codigo . "',";
			if (empty ( $_POST ['comentario'] ))
				$tsql = $tsql . " Comentario=NULL,";
			else
				$tsql = $tsql . " Comentario='" . $comentario . "',";
			
			$tsql = trim ( $tsql, ',' ); // quita �ltima coma
			$tsql = $tsql . " WHERE idAcceso='" . $id . "'";
			$stmt = sqlsrv_query ( $conn, $tsql ) or die ( "Fallo en la actualizaci�n" );
			sqlsrv_free_stmt ( $stmt );
		}
		$tsql = "SELECT tbAccesos.idAcceso, tbAccesos.DNI, tbAccesos.Nombre, tbAccesos.Apellidos, tbAccesos.Telefono_Tecnico, tbAccesos.Contrata, ";
		$tsql = $tsql . " tbAccesos.Subcontrata, tbAccesos.Camara, tbAccesos.Autorizado, (convert(varchar(8), Fx_Registro, 3) + ' ' + convert(varchar(8), Fx_Registro, 14)) as Fx_Registro, ";
		$tsql = $tsql . " tbAccesos.Comentario, tbPoblaciones.idPoblacion as idPoblacion, tbPoblaciones.Descripcion as Poblacion, ";
		$tsql = $tsql . " tbProvincias.idProvincia as idProvincia, tbProvincias.Descripcion as Provincia, tbUsuarios.Nombre as Usuario, tbAccesos.Tipo, tbAccesos.Codigo_TP_Remedy FROM tbUsuarios RIGHT JOIN (tbAccesos ";
		$tsql = $tsql . " LEFT JOIN (tbPoblaciones LEFT JOIN tbProvincias ON tbPoblaciones.idProvincia=tbProvincias.idProvincia) ";
		$tsql = $tsql . " on tbAccesos.idPoblacion=tbPoblaciones.idPoblacion) on tbUsuarios.idUsuario=tbAccesos.idUsuario WHERE idAcceso ='" . $id . "'";
		$stmt = sqlsrv_query ( $conn, $tsql ) or die ( "Fallo en la consulta" );
		// Mostrar resultados de la consulta
		$rows = sqlsrv_has_rows ( $stmt );
		if ($rows === true) {
			while ( $row = sqlsrv_fetch_array ( $stmt ) ) {
				?>								
<div class="modifica">
	<FORM name ="form1" method ="post" action ="" autocomplete="off" onsubmit='return confirmation()'>
		<div class="izq">
			<h3>Datos registro</h3>
			<div id="bloque1" class="bloque">   <!--class formuDatos-->
				<div class="formuDatos">   <!--class formuDatos-->
			<!--FECHA REGISTRO-->
					<div class="izq">	
						<label class="" id="" for="freg"> Fecha registro</label>
						<div>
							<input id="freg" name="freg" size="15" type="text" class="" maxlength="255" tabindex="1" onkeyup=""
			<?PHP
				print (" VALUE='" . $row ["Fx_Registro"] . "' readonly>\n") ;
				?>
						</div>
					</div>
			<!--USUARIO-->
					<div class="der">	
						<label class="" id="" for="usu"> Usuario</label>
						<div>
							<input id="usu" name="usu" size="40" type="text" class="" maxlength="255" tabindex="1" onkeyup=""
			<?PHP
				print (" VALUE='" . $row ["Usuario"] . "' readonly>\n") ;
				?>
						</div>
					</div>
				</div>
			</div>

			<h3>Datos t&eacute;cnico</h3>
			<div id="bloque2" class="bloque">   <!--class formuDatos-->
				<div class="formuDatos">   <!--class formuDatos-->
			<!--DNI-->
					<div class="izq">	
						<label class="" id="" for="dni"> DNI</label>
						<div>
								<input id="dni" name="dni" size="25" type="text" class="" maxlength="255" tabindex="1" onkeyup=""
			<?PHP
				print (" VALUE='" . $row ["DNI"] . "'>\n") ;
				?>
						</div>
					</div>

			<!--AUTORIZADO-->			
					<div class="izq">
						<label class="" id="" for="autorizado"> Autorizado</label>
						<div>
							<select id="autorizado" class="" style="width: 50px;" tabindex="3" name= "autorizado">
			<?PHP
				if ($row ["Autorizado"] == 0) {
					print ("<option value=0 selected>No</option>") ;
					print ("<option value=1>S�</option>") ;
				} else {
					print ("<option value=1 selected>Sí</option>") ;
					print ("<option value=0>No</option>") ;
				}
				?>
							</select>
						</div>
					</div>	

					<!--TELEFONO TECNICO-->	
					<div class="der">
						<label class="" id="" for="telTecnico"> Tel&eacute;fono del t&eacute;cnico</label>
						<div>
							<input id="telTecnico" name="telTecnico" size="20" type="text" class="" maxlength="255" tabindex="3" onkeyup=""
			<?PHP
				print (" VALUE='" . $row ["Telefono_Tecnico"] . "'>\n") ;
				?>
						</div>
					</div>
						
					<div class="clear"></div>
										
				<!--NOMBRE-->
					<div class="izq">
						<label class="" id="" for="nombre"> Nombre</label>

							<div>
								<input id="nombre" name="nombre" size="20" type="text" class="" maxlength="255" tabindex="3" onkeyup=""
					<?PHP
				
				print (" VALUE='" . $row ["Nombre"] . "'>\n") ;
				
				?>
							</div>
						</div>		
								
				<!--APELLIDOS-->
						<div class="der">
							<label class="" id="" for="apellidos"> Apellidos</label>
							<div>
								<input id="apellidos" name="apellidos" size="35" type="text" class="" maxlength="255" tabindex="3" onkeyup=""
					<?PHP
				print (" VALUE='" . $row ["Apellidos"] . "'>\n") ;
				?>
							</div>
						</div>	

					<div class="clear"></div>
					<!--CONTRATA-->
						<div class="izq">
							<label class="" id="" for="contrata"> Contrata</label>
							<div>
								<input id="contrata" name="contrata" size="28" type="text" class="" maxlength="255" tabindex="3" onkeyup=""
					<?PHP
				print (" VALUE='" . $row ["Contrata"] . "'>\n") ;
				?>
					
							</div>
						</div>

					<!--SUBCONTRATA-->
						<div class="der">
							<label class="" id="" for="subcontrata"> Subcontrata</label>
							<div>
								<input id="subcontrata" name="subcontrata" size="28" type="text" class="" maxlength="255" tabindex="3" onkeyup=""
					<?PHP
				print (" VALUE='" . $row ["Subcontrata"] . "'>\n") ;
				?>
							</div>
						</div>
					
					</div>
				</div>				

		</div>	<!--fin clase izquierda-->


<div class="der">
			
					<h3>C&aacute;mara registro</h3>
		<div id="bloque3" class="bloque">   <!--class formuDatos-->
			<div class="formuDatos">   <!--class formuDatos-->


					
				
					<!--CAMARA-->	
						<div class="izq">
							<label class="" id="" for="camara">
								C&aacute;mara
							</label>

							<div>
								<input id="camara" name="camara" size="63" type="text" class="" maxlength="255" tabindex="3" onkeyup=""
					<?PHP
				
				print (" VALUE='" . $row ["Camara"] . "'>\n") ;
				
				?>
					
							</div>
						</div>
								
							





					<!--PROVINCIA-->
							<div class="izq">
							<label class="" id="" for="provincia">
								Provincia
							</label>

														<div>
								<input id="provincia" name="provincia" size="18" type="text" class="" maxlength="255" tabindex="3" onkeyup=""
					<?PHP
				
				print (" VALUE='" . $row ["Provincia"] . "' readonly>\n") ;
				
				?>
					
							</div>
						</div>
				
					

					
					
					
					
					
				
					<!--POBLACION-->
							<div class="der">
							<label class="" id="" for="poblacion">
								Poblacion
							</label>

							<div>
								
								 <select id="poblacion" class="" tabindex="3" style="width: 300px;" name= "poblacion">
																																
					
					<?PHP
				
				// Conectar con el servidor de base de datos
				$conn = conectar_bd ();
				// Enviar consulta
				$tsql2 = "select idPoblacion, idProvincia, Descripcion from tbPoblaciones WHERE idProvincia ='" . $row ["idProvincia"] . "'";
				$stmt2 = sqlsrv_query ( $conn, $tsql2 ) or die ( "Fallo en la consulta" );
				
				echo '<option value= "' . $row ["idPoblacion"] . '">' . $row ["Poblacion"] . '</option>';
				
				while ( $row2 = sqlsrv_fetch_array ( $stmt2 ) ) {
					echo '<option value= "' . $row2 ["idPoblacion"] . '">' . $row2 ["Descripcion"] . '</option>';
				}
				
				?>
					
								</select>
							</div>
						</div>
					<!--tipo trabajo programado o remedy-->	
						<div class="izq">
							<label class="" id="" for="tipo">
								Tipo
							</label>
							<div style="bottom: auto; padding-bottom: auto;">
								<input type="radio" name="tipo" value="1"
					<?PHP
				if ($row ["Tipo"] == 1)
					print "checked>Trabajo Programado<br>";
				else
					print ">Trabajo Programado<br>";
				?>
								<input type="radio" name="tipo" value="2"
					<?PHP
				if ($row ["Tipo"] == 2)
					print "checked>Incidencia Remedy<br>";
				else
					print ">Incidencia Remedy<br>";
				?>
				
							<input type="radio" name="tipo" value="3"
					<?PHP
				if ($row ["Tipo"] == 3)
					print "checked>ICX<br>";
				else
					print ">ICX<br>";
				?>
					
														
							<input type="radio" name="tipo" value="4"
					<?PHP
				if ($row ["Tipo"] == 4)
					print "checked>FTTN<br>";
				else
					print ">FTTN<br>";
				?>
					
														
							<input type="radio" name="tipo" value="5"
					<?PHP
				if ($row ["Tipo"] == 5)
					print "checked>Despligue<br>";
				else
					print ">Despligue<br>";
				?>
					
														</div>
						</div>
						
						<!--codigo tp o remedy-->	
						<div class="der">
							<label class="" id="" for="camara">
								Cod Trab.Pro/Remedy
							</label>

							<div>
								<input id="codigo" name="codigo" size="20" type="text" class="" maxlength="20" tabindex="3" onkeyup=""
					<?PHP
				
				print (" VALUE='" . $row ["Codigo_TP_Remedy"] . "'>\n") ;
				
				?>
					
							</div>
						</div>					
				

					
		
					<div class="clear"></div>
						
				

							
												
				
				
				
				
				<!--COMENTARIO-->
				<div class="izq">
					<label class="" id="" for="comentario">
						Comentario
					</label>

					<div>

						<textarea id="comentario" 
							name="comentario" 
							class="" 
							spellcheck="true" 
							rows="10" cols="60" 
							tabindex="11" 
							onkeyup=""><?PHP
				
				print ($row ["Comentario"]) ;
				?></textarea> 
					</div>
				</div>
				
				
				
				
				
				
				</div> <!--class formuDatos-->
		
				<div class="clear"></div>								
			<?php
				
				if ($rolUsuario == 'Avanzado') {
					print ("<div>") ;
					/* textbox invisible */
					print ('<input id="" name="id" type="hidden" class="" maxlength="50" tabindex="" onkeyup="" ') ;
					
					print (" VALUE=" . $id . ">\n") ;
					
					print ('<input id="botonmodificar"  name="modificar" class="" type="submit" value="Modificar datos"/>') ;
					print ("</div>") ;
					
					print ("</FORM>\n") ;
				}
				?>
	</div> <!--bloque-->	
	
	</div> <!--fin clase derecha-->
	</div>  <!--class modifica->	
	
	</div>	<!--datosTodos-->	
							
								<?php
			} // end while
		} else
			print ("No hay datos detalle disponibles") ;
		print ("<div>\n") ;
		
		// Cerrar conexi�n
		mysql_close ( $conexion );
	} // fin es usuario 'usuario'
	else {
		// Si no, deniega el acceso.
		echo '<p>Acceso denegado</p>';
		echo '<p><a href="./index.php">Login</a></p>';
	}
} // 'fin es usuario registrado en base de datos
else {
	// Si no, deniega el acceso.
	echo '<p>Acceso denegado</p>';
	echo '<p><a href="./index.php">Login</a></p>';
}

?>
</div>  <!--datosTodos->
</BODY>
</HTML>