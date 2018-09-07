<?php
session_start ();
?>

<HTML LANG="es">


<HEAD>
<meta http-equiv=content-type content=text/html; charset=UTF-8> 
   <TITLE>Inserci&oacute;n de datos</TITLE>

 <LINK REL="stylesheet" TYPE="text/css" HREF="css/tablas.css?ver=1.0">  
<link href="css/estiloDef.css?ver=1.0" rel="stylesheet">


       <!-- referenciamos al archivo ajax.js donde se encuentra nuestra funcion objetoAjax-->
<script language="JavaScript" type="text/javascript" src="js/ajax.js?ver=1.0"></script>

 
 
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

 
</HEAD>

<body id="">



<?PHP

// detecta si navegador es IExplorer

$user_agent = $_SERVER ['HTTP_USER_AGENT'];

/*
 * $msie = strpos($user_agent, 'MSIE') ? true : false;
 * $firefox = strpos($user_agent, 'Firefox') ? true : false;
 * $safari = strpos($user_agent, 'Safari') ? true : false;
 */
$chrome = strpos ( $user_agent, 'Chrome' ) ? true : false;

// if ($chrome) { //si navegador es chrome

include ('funciones.php');

$rolUsuario = get_rol ( $_SESSION ['usuario'] );

if (es_usuario ( $_SESSION ['usuario'], $_SESSION ['password'] )) {
	if ($rolUsuario == 'Avanzado' || $rolUsuario == 'Insercion') {
		
		?>		
		
		
		<div id="datosTodos">	<!--datosTodos-->
			<div id='titulo'>
			<h1>Registro acceso a c&aacute;mara &nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;Nuevo acceso</h1>
			</div>
			<div id='logo'>
			<img src="images/logo1.jpg"></img>
			</div>
			
	<?PHP
		
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
			echo '<li><a href="./adProvincias.php">AÃ±adir provincias</a></li>';
			echo '<li><a href="./adPoblaciones.php">AÃ±adir poblaciones</a></li>';
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
		
		/* FIN MENU */
		
		if (isset ( $_POST ['insertarAcceso'] )) {
			// Obtiene id de usuario a partir del nombre de usuario
			$idusuario = get_id ( $_SESSION ['usuario'] );
			
			// if (empty($_POST['opcTecnico']))
			// $tecnicoSelecc='NULL';
			// else
			$tecnicoSelecc = $_POST ['opcTecnico'];
			
			/*
			 * if (empty($_POST['dni2']))
			 * $dni='NULL';
			 * else
			 */
			$dni = $_POST ['dni2'];
			
			/*
			 * if (empty($_POST['nombre']))
			 * $nombre='NULL';
			 * else
			 */
			// $nombre=utf8_decode($_POST['nombre']);
			$nombre = $_POST ['nombre'];
			
			/*
			 * if (empty($_POST['apellidos']))
			 * $apellidos='NULL';
			 * else
			 */
			$apellidos = $_POST ['apellidos'];
			
			/*
			 * if (empty($_POST['telTecnico']))
			 * $telTecnico='NULL';
			 * else
			 */
			$telTecnico = $_POST ['telTecnico'];
			
			$autorizado = $_POST ['autorizado'];
			
			/*
			 * if (empty($_POST['contrata']))
			 * $contrata='NULL';
			 * else
			 */
			$contrata = $_POST ['contrata'];
			
			/*
			 * if (empty($_POST['subcontrata']))
			 * $subcontrata='NULL';
			 * else
			 */
			$subcontrata = $_POST ['subcontrata'];
			
			/*
			 * if (empty($_POST['camara']))
			 * $camara = 'NULL';
			 * else
			 */
			$camara = $_POST ['camara'];
			
			/*
			 * if (empty($_POST['provincia']))
			 * $provincia='NULL';
			 * else
			 * $provincia = $_POST['provincia'];
			 */
			
			/*
			 * if (empty($_POST['poblacion']))
			 * $poblacion='NULL';
			 * else
			 */
			$poblacion = $_POST ['poblacion'];
			
			$tipo = $_POST ['tipo'];
			$codigo = $_POST ['codigo'];
			
			/*
			 * if (empty($_POST['comentario']))
			 * $comentario='NULL';
			 * else
			 */
			$comentario = $_POST ['comentario'];
			
			if ($dni != '' && $poblacion != '' && $camara != '') {
				if (strlen ( $camara ) == 8 && (eregi ( cr, $camara ) || eregi ( ad, $camara ))) {
					
					// Conectar con el servidor de base de datos
					$conn = conectar_bd ();
					
					// if (isset($tecnicoSelecc)){ //entrada datos con idTÃ©cnico, no manual
					
					/*
					 * $tsql3 = "insert into tbAccesos (idTecnico, idUsuario, DNI, idPoblacion, Camara, Telefono_Tecnico, Nombre, Apellidos, Contrata, Subcontrata, Comentario, Fx_Registro, Manual) values " .
					 * "('$tecnicoSelecc', '$idusuario','$dni', $poblacion,'$camara','$telTecnico','$nombre', '$apellidos', '$contrata', '$subcontrata', '$comentario', getdate(), '0')";
					 */
					
					$tsql3 = "insert into tbAccesos (idUsuario, Fx_Registro, Autorizado, Manual";
					
					if (isset ( $tecnicoSelecc )) // si se selecciona un tÃ©cnico de la lista (entrada no manual)
						$tsql3 = $tsql3 . " , idTecnico ";
					
					if (! empty ( $_POST ['dni2'] ))
						$tsql3 = $tsql3 . ", DNI";
					
					if (! empty ( $_POST ['nombre'] ))
						$tsql3 = $tsql3 . ", Nombre";
					
					if (! empty ( $_POST ['apellidos'] ))
						$tsql3 = $tsql3 . ", Apellidos";
					
					if (! empty ( $_POST ['telTecnico'] ))
						$tsql3 = $tsql3 . ", Telefono_Tecnico";
					
					if (! empty ( $_POST ['contrata'] ))
						$tsql3 = $tsql3 . ", Contrata";
					
					if (! empty ( $_POST ['subcontrata'] ))
						$tsql3 = $tsql3 . ", Subcontrata";
					
					if (! empty ( $_POST ['camara'] ))
						$tsql3 = $tsql3 . ", Camara";
					
					if (! empty ( $_POST ['poblacion'] ))
						$tsql3 = $tsql3 . ", idPoblacion";
					
					if (! empty ( $_POST ['comentario'] ))
						$tsql3 = $tsql3 . ", Comentario";
					
					if (! empty ( $_POST ['tipo'] ))
						$tsql3 = $tsql3 . ", Tipo";
					
					if (! empty ( $_POST ['codigo'] ))
						$tsql3 = $tsql3 . ", Codigo_TP_Remedy";
					
					$tsql3 = $tsql3 . ") values ('$idusuario', getdate(), '$autorizado'";
					
					if (isset ( $tecnicoSelecc ))
						$tsql3 = $tsql3 . " , '0' ,'$tecnicoSelecc'";
					else
						$tsql3 = $tsql3 . " , '1'";
					
					if (! empty ( $_POST ['dni2'] ))
						$tsql3 = $tsql3 . ", '$dni'";
					
					if (! empty ( $_POST ['nombre'] ))
						$tsql3 = $tsql3 . ", '$nombre'";
					
					if (! empty ( $_POST ['apellidos'] ))
						$tsql3 = $tsql3 . ", '$apellidos'";
					
					if (! empty ( $_POST ['telTecnico'] ))
						$tsql3 = $tsql3 . ", '$telTecnico'";
					
					if (! empty ( $_POST ['contrata'] ))
						$tsql3 = $tsql3 . ", '$contrata'";
					
					if (! empty ( $_POST ['subcontrata'] ))
						$tsql3 = $tsql3 . ", '$subcontrata'";
					
					if (! empty ( $_POST ['camara'] ))
						$tsql3 = $tsql3 . ", '$camara'";
					
					if (! empty ( $_POST ['poblacion'] ))
						$tsql3 = $tsql3 . ", '$poblacion'";
					
					if (! empty ( $_POST ['comentario'] ))
						$tsql3 = $tsql3 . ", '$comentario'";
					
					if (! empty ( $_POST ['tipo'] ))
						$tsql3 = $tsql3 . ", " . $tipo;
					
					if (! empty ( $_POST ['codigo'] ))
						$tsql3 = $tsql3 . ", '$codigo'";
					$tsql3 = $tsql3 . ")";
					
					$stmt3 = sqlsrv_query ( $conn, $tsql3 ) or die ( "Fallo en la consulta" );
					
					sqlsrv_free_stmt ( $stmt3 );
					sqlsrv_close ( $conn );
					// print ("<p>Datos insertados correctamente</p>");
					echo "<script>alert('Datos insertados correctamente')</script>";
					
					/*
					 * } //fin actuaciÃ³n vÃ¡lida
					 *
					 * else{
					 * echo "<script>alert('No se actualizan datos, inserte un tÃ©cnico vÃ¡lido')</script>";
					 * }
					 *
					 */
					
					$datosInsertados = true;
				} else {
					echo "<script>alert('error: el campo camara debe de llevar el formato CRXXXXXX o ADXXXXXX')</script>";
					$datosInsertados = false;
				}
			} else {
				echo "<script>alert('Falta rellenar los campos obligatorios')</script>";
				$datosInsertados = false;
			}
		}
		
		// fin isset($_POST['insertarAcceso'])
		
		if (isset ( $_POST ['Submit1'] ) || isset ( $_POST ['Submit2'] )) {
			$dni = $_POST ['dni'];
		}
		
		// despuÃ©s de seleccionar el tÃ©cnico de la tabla
		if (isset ( $_POST ['Submit2'] )) {
			$conn = conectar_bd ();
			$tecnicoSelecc = $_POST ['opcTecnico'];
			$tsql2 = "select * from tbTecnicos where idTecnico='" . $tecnicoSelecc . "'";
			$stmt2 = sqlsrv_query ( $conn, $tsql2 ) or die ( "Fallo en la consulta" );
			$rows = sqlsrv_has_rows ( $stmt2 );
			if ($rows === true) {
				$_SESSION ['entrada_ok'] = true;
				while ( $row2 = sqlsrv_fetch_array ( $stmt2 ) ) {
					if ($row2 ["DNI"] != '')
						$dni = $row2 ["DNI"];
					if ($row2 ["Nombre"] != '')
						$nombre = $row2 ["Nombre"];
					if ($row2 ["Apellidos"] != '')
						$apellidos = $row2 ["Apellidos"];
					if ($row2 ["Contrata"] != '')
						$contrata = $row2 ["Contrata"];
					if ($row2 ["Subcontrata"] != '')
						$subcontrata = $row2 ["Subcontrata"];
					if ($row2 ["Espacios_Confinados_Autorizado_Desde"] == NULL)
						$autorizado = 0;
					else
						$autorizado = 1;
				}
			}
			sqlsrv_free_stmt ( $stmt2 );
		}
		?>	
		<FORM name ="form1" method ="post" autocomplete="off" action ="insertar.php" accept-charset="UTF-8">
			<div class="inserta">
				<!--<h3>Nuevo acceso</h3>-->
				<div id="bloque1">	<!--bloque1-->			
				<hr>
					<div>
						<div class="identificacion"><!--identificacion22-->
							<label class="" id="" for="dni">DNI</label>
							<input id="" name="dni" type="text" class="" maxlength="255" tabindex="1" onkeyup=""
							<?PHP
		if (isset ( $_POST ['Submit1'] ) || isset ( $_POST ['Submit2'] ) || isset ( $_POST ['insertarAcceso'] ))
			print (" VALUE='$dni'>") ;
		else
			print (" VALUE=''>") ;
		?>
							<Input type = "Submit" id="submit1" Name = "Submit1" VALUE = "Aceptar">
						</div> <!--fin identificacion22-->
					</div> 
					<div class="clear"></div>
					<hr>
					<div id='tablaConsulta' class ='buscaTecnico'>
						<h3>T&eacute;cnico</h3>
							<TABLE>
								<TR>					
									<TH class='colnombre'>Nombre</TH>
									<TH class='colapellidos'>Apellidos</TH>
									<TH class='colcontrata'>Contrata</TH>
									<TH class='colsubcontrata'>Subcontrata</TH>
									<TH class='colAutoriz'>Autorizado desde</TH>
									<TH class='colcheck'> </TH>								
								</TR>
							</TABLE>
							<div class='tablaDatos'>	
								<TABLE>
					<?php
		// if (isset($_POST['Submit1'])) {
		if (isset ( $_POST ['Submit2'] ) || isset ( $_POST ['Submit1'] )) {
			// $dni=$_POST['dni'];
			$conn = conectar_bd ();
			
			$tsql = "select idTecnico, DNI, Nombre, Apellidos, Contrata, Subcontrata, convert(varchar, Espacios_Confinados_Autorizado_Desde, 103) as Fecha_Autorizado from tbTecnicos where DNI='" . $dni . "'";
			$stmt = sqlsrv_query ( $conn, $tsql, array (), array (
					'Scrollable' => 'buffered' 
			) ) or die ( "Fallo en la consulta" );
			
			$rows = sqlsrv_has_rows ( $stmt );
			
			if ($rows === true) {
				$_SESSION ['existeTecnico'] = true;
				
				$row_count = sqlsrv_num_rows ( $stmt );
				
				for($i = 0; $i < $row_count; $i ++) {
					$row = sqlsrv_fetch_array ( $stmt );
					
					if ($i % 2) {
						print ("<TR>\n") ;
					} else {
						print ("<TR class='even'>\n") ;
					}
					
					// print ("<TR>\n");
					
					print ("<TD class='colnombre'>" . $row ['Nombre'] . "</TD>\n") ;
					print ("<TD class='colapellidos'>" . $row ['Apellidos'] . "</TD>\n") ;
					print ("<TD class='colcontrata'>" . $row ['Contrata'] . "</TD>\n") ;
					print ("<TD class='colsubcontrata'>" . $row ['Subcontrata'] . "</TD>\n") ;
					print ("<TD class='colAutoriz'>" . $row ['Fecha_Autorizado'] . "</TD>\n") ;
					
					if (isset ( $_POST ['Submit2'] )) {
						if ($row ['idTecnico'] == $tecnicoSelecc) {
							print ("<TD class='colcheck'><INPUT TYPE='radio' NAME='opcTecnico' VALUE='" . $row ['idTecnico'] . "' checked></TD>\n") ;
						} else {
							print ("<TD class='colcheck'><INPUT TYPE='radio' NAME='opcTecnico' VALUE='" . $row ['idTecnico'] . "'></TD>\n") ;
						}
					} else {
						if ($i == 0) {
							print ("<TD class='colcheck'><INPUT TYPE='radio' NAME='opcTecnico' VALUE='" . $row ['idTecnico'] . "' checked></TD>\n") ;
						} else {
							print ("<TD class='colcheck'><INPUT TYPE='radio' NAME='opcTecnico' VALUE='" . $row ['idTecnico'] . "'></TD>\n") ;
						}
					}
					print ("</TR>\n") ;
				} // end for
			} else {
				$_SESSION ['existeTecnico'] = false;
				echo "<script>alert('No existe el tÃ©cnico en la base de datos. Debe introducir sus datos manualmente')</script>";
			}
			
			// Cerrar conexiÃ³n
			
			sqlsrv_free_stmt ( $stmt );
			sqlsrv_close ( $conn );
		}
		print ("</TABLE>\n") ;
		
		print ("</div>") ; // fin tablaDatos
		
		if ((isset ( $_POST ['Submit1'] ) || isset ( $_POST ['Submit2'] )) && ($_SESSION ['existeTecnico'] == true)) {
			print ('<Input type = "Submit" id="submit2" Name = "Submit2" VALUE = "Aceptar">') ;
		}
		print ("</div>") ; // fin tablaConsulta
		?>		
				</div>	<!--fin bloque1-->	
				<div id="bloque2">	<!--bloque2-->				
					<div class="datos formuDatos"><!--datos1-->
						<div class="izq">
							<label class="" id="" for="dni2">DNI</label>
							<div>
								<input id="dni2" name="dni2" type="text" class="" size="28" maxlength="255" tabindex="1" onkeyup=""
						<?PHP
		if (isset ( $_POST ['Submit2'] ) || $datosInsertados == false)
			print (" VALUE='$dni'>\n") ;
		else
			print (" VALUE=''>\n") ;
		?>
							</div>
						</div>
							
								<!--AUTORIZADO-->			
						<div class="izq">
							<label class="" id="" for="autorizado">Autorizado</label>
							<div>
								<select id="autorizado" class="" style="width: 50px;" tabindex="3" name= "autorizado">
							<?PHP
		
		if (isset ( $_POST ['Submit2'] ) || $datosInsertados == false) {
			if ($autorizado == 0) {
				print ("<option value='0' selected>No</option>") ;
				print ("<option value='1'>S&iacute;</option>") ;
			} else {
				print ("<option value='1' selected>S&iacute</option>") ;
				print ("<option value='0'>No</option>") ;
			}
		} else {
			print ("<option value='' selected></option>") ;
			print ("<option value='1'>S&iacute</option>") ;
			print ("<option value='0'>No</option>") ;
		}
		
		?>
								</select>
							</div>
						</div>
					<!--TELEFONO TECNICO-->			
						<div class="der">
							<label class="" id="" for="telTecnico">Tel&eacute;fono del t&eacute;cnico</label>
							<div>
								<input id="telTecnico" name="telTecnico" type="text" class="" size="20" maxlength="255" tabindex="3" onkeyup=""
					<?PHP
		// if (isset($_POST['insertarAcceso']))
		if ($datosInsertados == false)
			print (" VALUE='$telTecnico'>\n") ;
		else
			print (">\n") ;
		?>
							</div>
						</div>

						<div class="clear"></div>

						<div class="izq">	
							<label class="" id="" for="nombre">Nombre</label>
							<div>	
								<input id="nombre" name="nombre" type="text" class="" size="28" maxlength="255" tabindex="3" onkeyup=""
					<?PHP
		if (isset ( $_POST ['Submit2'] ) || $datosInsertados == false)
			print (" VALUE='$nombre'>\n") ;
		else
			print (" VALUE=''>\n") ;
		?>
							</div>	
						</div>	
						<div class="der">	
							<label class="" id="" for="apellidos">Apellidos</label>
							<div>
								<input id="apellidos" name="apellidos" type="text" class="" size="28" maxlength="255" tabindex="3" onkeyup=""
					<?PHP
		if (isset ( $_POST ['Submit2'] ) || $datosInsertados == false)
			print (" VALUE='$apellidos'>\n") ;
		else
			print (" VALUE=''>\n") ;
		?>
							</div>
						</div>

						<div class="clear"></div>

						<div class="izq">
							<label class="" id="" for="contrata">Contrata</label>
							<div>
								<input id="contrata" name="contrata" type="text" class="" size="28" maxlength="255" tabindex="3" onkeyup=""
					<?PHP
		if (isset ( $_POST ['Submit2'] ) || $datosInsertados == false)
			print (" VALUE='$contrata'>\n") ;
		else
			print (" VALUE=''>\n") ;
		?>
					
							</div>
						</div>
						<!--SUBCONTRATA-->	
						<div class="der">	
							<label class="" id="" for="subcontrata">Subcontrata</label>
							<div>
								<input id="subcontrata" name="subcontrata" type="text" class="" size="28" maxlength="255" tabindex="3" onkeyup=""
					<?PHP
		if (isset ( $_POST ['Submit2'] ) || $datosInsertados == false)
			print (" VALUE='$subcontrata'>\n") ;
		else
			print (">\n") ;
		?>
							</div>
						</div>

						<div class="clear"></div>

					<!--CÃ�MARA-->
							<div class="izq">
							<label class="" id="" for="camara">C&aacute;mara</label>
							<div>
								<input id="camara" name="camara" type="text" class="" size="65" maxlength="255" tabindex="3" onkeyup=""
					<?PHP
		// if (isset($_POST['insertarAcceso']))
		if ($datosInsertados == false)
			print (" VALUE='$camara'>\n") ;
		else
			print (">\n") ;
		?>
							</div>
						</div>

						<div class="clear"></div>

					<!--PROVINCIA-->
						<div class="izq">
							<label class="" id="" for="provincia">Provincia</label>
							<div>
								 <select id="provincia" class="" tabindex="3" style="width: 230px;" name= "provincia" onChange="ListadoPoblaciones('consultaPoblaciones.php', this.value); return false">
					<?PHP
		// Conectar con el servidor de base de datos
		$conn = conectar_bd ();
		// Enviar consulta
		$tsql = "select idProvincia, Descripcion from tbProvincias order by Descripcion";
		$stmt = sqlsrv_query ( $conn, $tsql ) or die ( "Fallo en la consulta" );
		if ($provincia == "") {
		}
		/*
		 * if (isset($_POST['insertarAcceso'])){
		 * echo '<option value= "" selected></option>';
		 * while($row = sqlsrv_fetch_array($stmt)){
		 * if($row["idProvincia"]==$provincia){
		 * echo '<option value= "'.$row["idProvincia"].'" selected>'.$row["Descripcion"].'</option>';
		 * }
		 * else{
		 *
		 * echo '<option value= "'.$row["idProvincia"].'">'.$row["Descripcion"].'</option>';
		 * }
		 *
		 * }
		 * }
		 */
		// else{
		echo '<option value="" selected></option>';
		while ( $row = sqlsrv_fetch_array ( $stmt ) ) {
			echo '<option value= "' . $row ["idProvincia"] . '">' . $row ["Descripcion"] . '</option>';
		}
		// }
		?>
								</select>
							</div>
						</div>
				
					<div id="resultadoPoblaciones" class="der">
						<!--POBLACION-->
							
					<?PHP
		// print("<div id='resultadoPoblaciones'></div>");
		?>
					</div>

					<div class="clear"></div>

					<div class=izq>
						<input type="radio" name="tipo" value="1">Trabajo Programado<br>
						<input type="radio" name="tipo" value="2" checked>Incidencia Remedy<br>
						<input type="radio" name="tipo" value="3" >ICX<br>
						<input type="radio" name="tipo" value="4" >FTTN<br>
						<input type="radio" name="tipo" value="5" >Despliegue
					</div>
					<div class="der">	
						<label class="" id="" for="codigo">C&oacute;digo Trab. Progr./Remedy:</label>
						<div>
							<input id="codigo" name="codigo" type="text" class="" size="28" maxlength="20" tabindex="3" onkeyup=""
					<?PHP
		if ($datosInsertados == false)
			print (" VALUE='$codigo'>\n") ;
		else
			print (">\n") ;
		?>
						</div>
					</div>
					<div class="clear"></div>
				<!--COMENTARIOS-->
					<div class="izq">
						<label class="" id="" for="comentario">Comentarios</label>
						<div>
							<textarea id="comentario" name="comentario" class="" spellcheck="true" rows="13" cols="58" tabindex="11" onkeyup="">
					<?PHP
		if (isset ( $_POST ['Submit1'] ) || $datosInsertados == false)
			print ($comentario) ;
		?>
							</textarea> 
						</div>
					</div>
				</div>	<!--fin formuDatos-->
				<div class="clear"></div>
				<?PHP
		// if (isset($_POST['Submit2']) || $_SESSION['existeTecnico']==false){
		print ('<Input type = "Submit" id="botonguardar" Name = "insertarAcceso" VALUE = "Guardar">') ;
		// }
		?>
			</div>	<!--fin bloque2-->	
		</div>  <!--class inserta-->	
			
	</form>		
			<?PHP
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
</div>	<!--datosTodos->
	
	<?PHP
	/*
	 * } //fin si el navegador es Chrome
	 *
	 *
	 * else{
	 *
	 * echo '<p>La aplicaci&oacute;n est&aacute; optimizada para el navegador Chrome</p>';
	 * }
	 */
	?>
	
</BODY>
</HTML>