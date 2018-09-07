<?php session_start();
//header(‘P3P: CP=”CAO PSA OUR”‘);
header("Cache-control: private"); // IE 6 Fix.
?>
<HTML LANG="es">

<HEAD>
	<meta http-equiv=content-type content=text/html; charset= UTF-8> 
   <TITLE>Consulta de datos</TITLE>
   
     <LINK REL="stylesheet" TYPE="text/css" HREF="css/tablas.css?ver=1.0">
	 <LINK REL="stylesheet" TYPE="text/css" HREF="css/estiloDef.css?ver=1.0">


<script>


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


function confirmarExcel() {
	
		if(confirm("¿Confirma la exportación de los datos a excel?"))
		{
			return true;
		}
		return false;	

}

</script>	 
	
</HEAD>

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
		<h1>Registro acceso a c&aacute;mara &nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;Consulta</h1>
	</div>
	<div id='logo'><img src="images/logo1.jpg"></img></div>
<?PHP
include ('funciones.php');
$_SESSION['detalle']="TRUE"; 
$rolUsuario=get_rol($_SESSION['usuario']);
if (es_usuario($_SESSION['usuario'],$_SESSION['password'])){
	if($rolUsuario=='Avanzado' || $rolUsuario=='Insercion' || $rolUsuario=='Lectura'){   
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
		echo '<li><a  href="./tecnicos.php">Opciones t&eacute;cnicos</a></li>';
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
	echo '<div class="clear"></div>';
// Conectar con el servidor de base de datos
	$conn=conectar_bd();
//ELIMINAR TAREA
	if (isset($_REQUEST['eliminar'])) {		
	   	// Obtener número de registros a procesar
		$marcarProc = $_REQUEST['marcarProc'];
		// $tecnico = $_REQUEST['tecnico'];
		$nfilas = count ($marcarProc);
		// Mostrar registros a eliminar			
		for ($i=0; $i<$nfilas; $i++)
		{
		// procesar datos
			$tsql = "DELETE FROM tbAccesos WHERE idAcceso = $marcarProc[$i]";
			$stmt = sqlsrv_query( $conn, $tsql)
				or die ("Fallo en la eliminación");
		}
		echo "<script languaje='javascript'>alert('Se han eliminado ".$nfilas." accesos')</script>";		
	}
	//FIN ELIMINAR TAREA
	$seleccionadoDNI = "";
	$seleccionadoNombre = "";
	$seleccionadoApellidos = "";
	$seleccionadoTelTecnico = "";
	$seleccionadoContrata = "";
	$seleccionadoSubcontrata = "";
	$seleccionadoCamara = "";
	$seleccionadoProv = "";
	$seleccionadoPobl = "";
	$seleccionadoCodigoRemedy = "";
	$seleccionadofxRegistro1 = "";
	$seleccionadofxRegistro2 = "";
	$seleccionadoAutorizado = "";	
	$seleccionadoManual = "";
	if ($_SERVER['REQUEST_METHOD']=='POST')	{  		
		$seleccionadoDNI = $_REQUEST['dni'];
		$seleccionadoNombre = $_REQUEST['nombre'];
		$seleccionadoApellidos = $_REQUEST['apellidos'];
		$seleccionadoTelTecnico = $_REQUEST['telTecnico'];
		$seleccionadoContrata = $_REQUEST['contrata'];
		$seleccionadoSubcontrata = $_REQUEST['subcontrata'];
		$seleccionadoCamara = $_REQUEST['camara'];
		$seleccionadoProvincia = $_REQUEST['provincia']; 
		$seleccionadoPoblacion = $_REQUEST['poblacion'];
		$seleccionadoCodigoRemedy = $_REQUEST['codigoremedy'];
		$seleccionadofxRegistro1 = $_REQUEST['fxRegistro1'];
		$seleccionadofxRegistro2 = $_REQUEST['fxRegistro2'];
		$seleccionadoAutorizado = $_REQUEST['autorizado'];
	    $seleccionadoManual = $_REQUEST['manual'];
		$seleccionadoOrden=$_REQUEST['orden']; 
	}
	// Obtener valores introducidos en el formulario
	$dni = $_REQUEST['dni'];
	$nombre = $_REQUEST['nombre'];
	$apellidos = $_REQUEST['apellidos'];
	$telTecnico = $_REQUEST['telTecnico'];
	$contrata = $_REQUEST['contrata'];
	$subcontrata = $_REQUEST['subcontrata'];
	$camara = $_REQUEST['camara'];
	$provincia = $_REQUEST['provincia']; 
	$poblacion = $_REQUEST['poblacion']; 
	$codigoremedy = $_REQUEST['codigoremedy']; 	
	$fxRegistro1 = $_REQUEST['fxRegistro1'];
	$fxRegistro2 = $_REQUEST['fxRegistro2'];
	$autorizado = $_REQUEST['autorizado'];
	$manual = $_REQUEST['manual'];
	$orden=$_REQUEST['orden']; 
?>
	<!--<FORM id="busqueda" ACTION="consultar.php" autocomplete="off" METHOD="POST" NAME="opciones">-->
	<FORM id="busqueda" autocomplete="off" METHOD="POST" NAME="opciones">
		<div>
			<LABEL>DNI:</LABEL>
			</br>
<?PHP
	$tsql="select distinct DNI from tbAccesos where DNI !='' order by DNI";
	$stmt = sqlsrv_query( $conn, $tsql);
	if( $stmt === false ) {
		die ("Error al ejecutar consulta");
	}
	$rows = sqlsrv_has_rows( $stmt );
	if ($rows === true) {
		if($seleccionadoDNI=="") {				
			echo '<input id="dni" name="dni" size="12" list="listaDNI" value="">';				
		}
		else
		{				
			echo '<input id="dni" name="dni" size="12" list="listaDNI" value="'.$seleccionadoDNI.'">';	
		}  
		echo '<datalist id=listaDNI >';				
		while($row = sqlsrv_fetch_array($stmt)){
			echo '<option value= "'.trim($row["DNI"]).'">'.trim($row["DNI"]).'</option>'; 
		}
		echo '</datalist>';		
	}
	else{		
		echo '<input id="dni" name="dni" type="text" class="" size="12" maxlength="255" tabindex="1" onkeyup=""';
		if ($seleccionadoDNI==NULL){
			print (" VALUE=''>\n");
		}
		else{
			print (" VALUE='".$seleccionadoDNI."'>\n");
		}
	}
//fin DNI
?>
		</div>
		<div>
			<P><LABEL>Nombre:</LABEL>
			</br>
<?PHP
	$tsql="select distinct Nombre from tbAccesos where Nombre is not null order by Nombre";
	$stmt = sqlsrv_query( $conn, $tsql);
	if( $stmt === false ){
		die ("Error al ejecutar consulta");
	}
	$rows = sqlsrv_has_rows( $stmt );
	if ($rows === true){
		if($seleccionadoNombre=="")
		{				
			echo '<input id="nombre" name="nombre" size="25" list="listaNombre" value="">';				
		} 
		else
		{				
			echo '<input id="nombre" name="nombre" size="25" list="listaNombre" value="'.$seleccionadoNombre.'">';
		}  
		echo '<datalist id=listaNombre >';				
		while($row = sqlsrv_fetch_array($stmt)){
			echo '<option value= "'.trim($row["Nombre"]).'">'.trim($row["Nombre"]).'</option>'; 
		}
		echo '</datalist>';		
	}
	else{
		echo '<input id="nombre" name="nombre" type="text" size="25" class="" maxlength="255" tabindex="1" onkeyup=""';
		if ($seleccionadoNombre==NULL){
			print (" VALUE=''>\n");
		}
		else{
			print (" VALUE='".$seleccionadoNombre."'>\n");
		}	
	}
		//fin nombre
?>
		</div>
		<div>
			<P><LABEL>Apellidos:</LABEL>
			</br>
<?PHP
	$tsql="select distinct Apellidos from tbAccesos where Apellidos is not null order by Apellidos";
	$stmt = sqlsrv_query( $conn, $tsql);
	if( $stmt === false ){
		die ("Error al ejecutar consulta");
	}
	$rows = sqlsrv_has_rows( $stmt );
	if ($rows === true){
		if($seleccionadoApellidos=="")
		{
			echo '<input id="apellidos" name="apellidos" size="25" list="listaApellidos" value="">';				
		} 
		else
		{
			echo '<input id="apellidos" name="apellidos" size="25" list="listaApellidos" value="'.$seleccionadoApellidos.'">';	
		}	
		echo '<datalist id=listaApellidos >';				
		while($row = sqlsrv_fetch_array($stmt)){
			echo '<option value= "'.trim($row["Apellidos"]).'">'.trim($row["Apellidos"]).'</option>'; 
		}
		echo '</datalist>';		
	}
	else{
		echo '<input id="apellidos" name="apellidos" size="25" type="text" class="" maxlength="255" tabindex="1" onkeyup=""';
		if ($seleccionadoApellidos==NULL){
		print (" VALUE=''>\n");
		}
		else{
			print (" VALUE='".$seleccionadoApellidos."'>\n");
		}
	}
		//fin apellidos
?>
		</div>	
		<div>
			<P><LABEL>Contrata:</LABEL>
			</br>
<?PHP
	$tsql="select distinct Contrata from tbAccesos where Contrata is not null order by Contrata";
	$stmt = sqlsrv_query( $conn, $tsql);
	if( $stmt === false ){
		die ("Error al ejecutar consulta");
	}
	$rows = sqlsrv_has_rows( $stmt );
	if ($rows === true){
		if($seleccionadoContrata=="")
		{				
			echo '<input id="contrata" name="contrata" size="15" list="listaContrata" value="">';				
		} 
		else
		{				
			echo '<input id="contrata" name="contrata" size="15" list="listaContrata" value="'.$seleccionadoContrata.'">';
		}  
		echo '<datalist id=listaContrata >';				
		while($row = sqlsrv_fetch_array($stmt)){
			echo '<option value= "'.trim($row["Contrata"]).'">'.trim($row["Contrata"]).'</option>'; 
		}
		echo '</datalist>';		
	}
	else{
		echo '<input id="contrata" name="contrata" size="15" type="text" class="" maxlength="255" tabindex="1" onkeyup=""';
		if ($seleccionadoContrata==NULL){
			print (" VALUE=''>\n");
		}
		else{
			print (" VALUE='".$seleccionadoContrata."'>\n");
		}	
	}
		//fin contrata
?>
		</div>
		<div>
			<P><LABEL>Subcontrata:</LABEL>
			</br>
<?PHP
	$tsql="select distinct Subcontrata from tbAccesos where Subcontrata is not null order by Subcontrata";
	$stmt = sqlsrv_query( $conn, $tsql);
	if( $stmt === false ){
		die ("Error al ejecutar consulta");
	}
	$rows = sqlsrv_has_rows( $stmt );
	if ($rows === true){
		if($seleccionadoSubcontrata=="")
		{				
			echo '<input id="subcontrata" name="subcontrata" size="15" list="listaSubcontrata" value="">';				
		} 
		else
		{				
			echo '<input id="subcontrata" name="subcontrata" size="15" list="listaSubcontrata" value="'.$seleccionadoSubcontrata.'">';
		}  
		echo '<datalist id=listaSubcontrata >';				
		while($row = sqlsrv_fetch_array($stmt)){
			echo '<option value= "'.trim($row["Subcontrata"]).'">'.trim($row["Subcontrata"]).'</option>'; 
		}
		echo '</datalist>';		
	}
	else{
		echo '<input id="subcontrata" name="subcontrata" size="15" type="text" class="" maxlength="255" tabindex="1" onkeyup=""';
		if ($seleccionadoSubcontrata==NULL){
			print (" VALUE=''>\n");
		}
		else{
			print (" VALUE='".$seleccionadoSubcontrata."'>\n");
		}	
	}
		//fin subcontrata
?>
		</div>
		<div>
			<P><LABEL>C&aacute;mara:</LABEL>
			</br>
<?PHP
	$tsql="select distinct Camara from tbAccesos where Camara is not null order by Camara";
	$stmt = sqlsrv_query( $conn, $tsql);
	if( $stmt === false ){
		die ("Error al ejecutar consulta");
	}
	$rows = sqlsrv_has_rows( $stmt );
	if ($rows === true){
		if($seleccionadoCamara=="")
		{				
			echo '<input id="camara" name="camara" size = "25" list="listaCamara" value="">';				
		} 
		else
		{				
			echo '<input id="camara" name="camara" list="listaCamara" size = "25" value="'.$seleccionadoCamara.'">';
		}  
		echo '<datalist id=listaCamara >';				
		while($row = sqlsrv_fetch_array($stmt)){
			echo '<option value= "'.trim($row["Camara"]).'">'.trim($row["Camara"]).'</option>'; 
		}
		echo '</datalist>';		
	}
	else{
		echo '<input id="camara" name="camara" type="text" class="" size = "25" maxlength="255" tabindex="1" onkeyup=""';
		if ($seleccionadoCamara==NULL){
			print (" VALUE=''>\n");
		}
		else{
			print (" VALUE='".$seleccionadoCamara."'>\n");
		}	
	}
	//fin camara
?>
		</div>
		<div>	
			<LABEL>Provincia:</LABEL>
			</br>
<?PHP
	$tsql="select distinct Descripcion from tbProvincias where Descripcion !='' order by Descripcion";
	$stmt = sqlsrv_query( $conn, $tsql);
	if( $stmt === false ){
		die ("Error al ejecutar consulta");
	}
	$rows = sqlsrv_has_rows( $stmt );
	if ($rows === true){
		echo '<select id="provincia" name= "provincia">';
		if($_SERVER['REQUEST_METHOD']=='POST'){
			if($seleccionadoProvincia=="Todos"){
				echo '<option value="Todos" selected>Todos</option>';
				echo '<option value="En blanco">En blanco</option>';	
			}
			if($seleccionadoProvincia=="En blanco"){
				echo '<option value="Todos">Todos</option>';
				echo '<option value="En blanco" selected>En blanco</option>';					 
			}	
			if($seleccionadoProvincia!="Todos" && $seleccionadoProvincia!="En blanco"){
				echo '<option value="Todos">Todos</option>';
				echo '<option value="En blanco">En blanco</option>';
			}
			while($row = sqlsrv_fetch_array($stmt)){	
				if($row["Descripcion"]==$seleccionadoProvincia){					
					echo '<option value= "'.$row["Descripcion"].'" selected>'.$row["Descripcion"].'</option>';
				}
				else{					
					echo '<option value= "'.$row["Descripcion"].'">'.$row["Descripcion"].'</option>';
				}         
			}
		}
		else{
			echo '<option value="Todos" selected>Todos</option>';
			echo '<option value="En blanco">En blanco</option>';	
			while($row = sqlsrv_fetch_array($stmt)){	
				echo '<option value= "'.$row["Descripcion"].'">'.$row["Descripcion"].'</option>';
			}
		}
		echo '</select>';
	}
	else{		
		echo '<input id="provincia" name="provincia" type="text" class="" maxlength="255" tabindex="1" onkeyup=""';
		if ($seleccionadoProvincia==NULL){
			print (" VALUE=''>\n");
		}
		else{
			print (" VALUE='".$seleccionadoProvincia."'>\n");
		}
	}
			//fin PROVINCIA			
?>
		</div>
		<div>
			<P><LABEL>C&oacute;digo Trabajo Programado/Remedy:</LABEL>
			</br>
			<input type="text" id="codigoremedy" name="codigoremedy" size="20" value="" maxlentgh=20>
		</div>
		<div>		
			<P><LABEL>Fecha registro inicio&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha registro fin</LABEL>
			</br>		
<?PHP	
	//FECHA REGISTRO INI
	if($seleccionadofxRegistro1==""){
		echo '<input type="date" name="fxRegistro1">';	
	}
	else{
		echo '<input type="date" name="fxRegistro1" value="'.$seleccionadofxRegistro1.'">';
	}
	if($seleccionadofxRegistro2==""){
		echo '<input type="date" name="fxRegistro2">';	
	}
	else{
		echo '<input type="date" name="fxRegistro2" value="'.$seleccionadofxRegistro2.'">';		
	}	
?>	
		</div>
		<div class="clear"></div>
		<div class="opciones">
			<LABEL>T&eacute;cnico autorizado:</LABEL></br>
<?PHP
	if($seleccionadoAutorizado==""){			
		print('<input type="radio" name="autorizado" value="1">S&iacute');
		print('<input type="radio" name="autorizado" value="0">No');
		print('<input type="radio" name="autorizado" value="" checked>Todos');
	}
	else{
		if($seleccionadoAutorizado=='1'){
			print('<input type="radio" name="autorizado" value="1" checked>S&iacute');
			print('<input type="radio" name="autorizado" value="0">No');
			print('<input type="radio" name="autorizado" value="">Todos');
		}
		if($seleccionadoAutorizado=='0'){
			print('<input type="radio" name="autorizado" value="1">S&iacute');
			print('<input type="radio" name="autorizado" value="0" checked>No');
			print('<input type="radio" name="autorizado" value="">Todos');
		}
	}
?>
		</div>
		<div class="opciones">
			<LABEL>Inserci&oacute;n manual:</LABEL></br>
<?PHP
	if($seleccionadoManual==""){			
		print('<input type="radio" name="manual" value="1">S&iacute');
		print('<input type="radio" name="manual" value="0">No');
		print('<input type="radio" name="manual" value="" checked>Todos');
	}
	else{
		if($seleccionadoManual=='1'){
			print('<input type="radio" name="manual" value="1" checked>S&iacute');
			print('<input type="radio" name="manual" value="0">No');
			print('<input type="radio" name="manual" value="">Todos');
		}
		if($seleccionadoManual=='0'){
			print('<input type="radio" name="manual" value="1">S&iacute');
			print('<input type="radio" name="manual" value="0" checked>No');
			print('<input type="radio" name="manual" value="">Todos');
		}
	}
?>
		</div>
		<div class ="txtOrden">
			<LABEL>ORDENAR POR:</LABEL>
			</br>
			<div>
<?PHP
	echo '<select id="orden" name= "orden">';
	if($seleccionadoOrden==""){
		echo '<option value="Fecha registro" selected>Fecha registro</option>';
	}
	else{
		echo '<option value= "'.$seleccionadoOrden.'" selected>'.$seleccionadoOrden.'</option>';
	}
	echo '<option value="DNI">DNI</option>';	
	echo '<option value="Nombre">Nombre</option>';	
	echo '<option value="Apellidos">Apellidos</option>';
	echo '<option value="Contrata">Contrata</option>';
	echo '<option value="Subcontrata">Subcontrata</option>';
	echo '<option value="Camara">C&aacute;mara</option>';
	echo '<option value="Provincia">Provincia</option>';
	echo '<option value="Poblacion">Poblaci&oacute;n</option>';
	echo '<option value="Fecha registro">Fecha registro</option>';
	echo '</select>';			
?>
			</div>
<?PHP
		//fin ordenar por
?>
		</div>
		<div class="botones">
	<!--<INPUT TYPE="submit" NAME="buscar" VALUE="Buscar">-->
			<INPUT TYPE="submit" NAME="buscar" VALUE="Buscar" onclick = "this.form.action = 'consultar.php'">
<?PHP
	if($rolUsuario=='Avanzado'){
	//print('<INPUT id="eliminar" TYPE="submit" NAME="eliminar" VALUE="Eliminar" onclick="return confirmarEliminar()">');
?>
			<INPUT id="eliminar" TYPE="submit" NAME="eliminar" VALUE="Eliminar" onclick="this.form.action = 'consultar.php';return confirmarEliminar();">
<?PHP
	}
?>
			<button id="buttonExcel" type="submit" name="exportExcel" value="Exportar a excel" onclick = "this.form.action = 'excelExportCons.php';return confirmarExcel();">
	   			<input id="inputExcel" type="image" src='images/icnExcel.jpg' alt="boton exportar" />
			</button> 


		</div> <!-- fin botones-->
<?PHP
		 // Enviar consulta
	$tsql = "SELECT tbAccesos.idAcceso, tbAccesos.DNI, tbAccesos.Nombre, tbAccesos.Apellidos, tbAccesos.Telefono_Tecnico, tbAccesos.Contrata, ";
	$tsql = $tsql . " tbAccesos.Subcontrata, tbAccesos.Camara, tbAccesos.Autorizado, tbAccesos.Manual, (convert(varchar(8), Fx_Registro, 3) + ' ' + convert(varchar(8), Fx_Registro, 14)) as Fx_Registro, tbPoblaciones.Descripcion as Poblacion, ";
	$tsql = $tsql . " tbProvincias.Descripcion as Provincia, iif(tbAccesos.Tipo = 1, 'Trabajos Programados', 'Remedy') as Tipo, tbAccesos.Codigo_TP_Remedy FROM tbAccesos ";
	$tsql = $tsql . " LEFT JOIN (tbPoblaciones LEFT JOIN tbProvincias ON tbPoblaciones.idProvincia=tbProvincias.idProvincia) ";
	$tsql = $tsql . " on tbAccesos.idPoblacion=tbPoblaciones.idPoblacion WHERE idAcceso != ''";
/*	
SELECT tbAccesos.idAcceso, tbAccesos.Camara, tbAccesos.Nombre, tbAccesos.Apellidos, tbPoblaciones.Descripcion as Poblacion, tbProvincias.Descripcion as Provincia
FROM tbAccesos LEFT JOIN (tbPoblaciones LEFT JOIN tbProvincias ON tbPoblaciones.idProvincia=tbProvincias.idProvincia) on tbAccesos.idPoblacion=tbPoblaciones.idPoblacion
*/
	if (isset($dni) && $dni != "")
		 $tsql = $tsql . " and tbAccesos.DNI like '%$dni%'";
	if (isset($nombre) && $nombre != "")
		 $tsql = $tsql . " and tbAccesos.Nombre like '%$nombre%'";
	if (isset($apellidos) && $apellidos != "")
		 $tsql = $tsql . " and tbAccesos.Apellidos like '%$apellidos%'";
	if (isset($contrata) && $contrata != "")
		 $tsql = $tsql . " and tbAccesos.Contrata like '%$contrata%'";
	if (isset($subcontrata) && $subcontrata != "")
		 $tsql = $tsql . " and tbAccesos.Subcontrata like '%$subcontrata%'";	 
	if (isset($camara) && $camara != "")
		 $tsql = $tsql . " and tbAccesos.Camara like '%$camara%'";	 
	if (isset($provincia) && $provincia != "Todos"){
		if ($provincia == "En blanco") {
			$tsql = $tsql . " and tbProvincias.Descripcion IS NULL";
		}
		else {	
			$tsql = $tsql . " and tbProvincias.Descripcion like '$provincia'";
		}
	}
	if (isset($poblacion) && $poblacion != "Todos"){
		if ($poblacion == "En blanco")
			$tsql = $tsql . " and tbPoblaciones.Descripcion IS NULL";
		else	
			$tsql = $tsql . " and tbPoblaciones.Descripcion like '$poblacion'";
	}
	if (isset($codigoremedy) && $codigoremedy != "")
		 $tsql = $tsql . " and tbAccesos.Codigo_TP_Remedy like '%$codigoremedy%'";
	if (isset($fxRegistro1) && $fxRegistro1 != "")
		$tsql = $tsql . " and Fx_Registro>='".$fxRegistro1."'";		 	 
	if (isset($fxRegistro2) && $fxRegistro2 != "")
		$tsql = $tsql . " and Fx_Registro<'".sumaDias($fxRegistro2,1)."'";		
	if (isset($autorizado) && $autorizado != "")
		$tsql = $tsql . " and tbAccesos.Autorizado like '$autorizado'";	 
	if (isset($manual) && $manual != "")
		$tsql = $tsql . " and tbAccesos.Manual like '$manual'";			
			//ORDEN
	if($orden=='Fecha registro'){
		$tsql = $tsql . " order by tbAccesos.Fx_Registro asc";
	} 
	if($orden=='DNI'){
		$tsql = $tsql . " order by tbAccesos.DNI asc";
	}  
	if($orden=='Nombre'){
		$tsql = $tsql . " order by tbAccesos.Nombre asc";
	}
	if($orden=='Apellidos'){
		$tsql = $tsql . " order by tbAccesos.Apellidos asc";
	}
	if($orden=='Contrata'){
		$tsql = $tsql . " order by tbAccesos.Contrata asc";
	} 			
	if($orden=='Subcontrata'){
		$tsql = $tsql . " order by tbAccesos.Subcontrata asc";
	} 			
	if($orden=='Camara'){
		$tsql = $tsql . " order by tbAccesos.Camara asc";
	} 			
	if($orden=='Provincia'){
		$tsql = $tsql . " order by tbProvincias.Descripcion asc";
	} 			
	if($orden=='Poblacion'){
		$tsql = $tsql . " order by tbPoblaciones.Descripcion asc";
	} 			
		//FIN ORDEN
	$_SESSION['sqlConsulta']=$tsql; //para exportación a excel
	//$stmt = sqlsrv_query( $conn, $tsql);
	$stmt = sqlsrv_query( $conn, $tsql, array(), array('Scrollable' => 'buffered'));
	if( $stmt === false ){
		die ("Error al ejecutar consulta");
	}
	print ("<div id='tablaConsulta'  class ='consultar'>");	
		//print ("<h3>Resultado b&uacute;squeda</h3>");
	print ("<TABLE WIDTH='1400'>\n");
	print ("<TR>\n");
	print ("<TH WIDTH='7%'>DNI</TH>\n");
	print ("<TH WIDTH='7%'>Nombre</TH>\n");
	print ("<TH WIDTH='10%'>Apellidos</TH>\n");
	print ("<TH WIDTH='5%'>Tel. T&eacute;cnico</TH>\n");
	print ("<TH WIDTH='7%'>Contrata</TH>\n");
	print ("<TH WIDTH='10%'>Subcontrata</TH>\n");
	print ("<TH WIDTH='11%'>C&aacute;mara</TH>\n");	
	print ("<TH WIDTH='7%'>Provincia</TH>\n");
	print ("<TH WIDTH='11%'>Poblaci&oacute;n</TH>\n");					
	print ("<TH WIDTH='5%'>Tipo</TH>\n");
	print ("<TH WIDTH='7%'>Cod_TP_Remedy</TH>\n");
	print ("<TH WIDTH='5%'>F. registro</TH>\n");					
	print ("<TH WIDTH='2%'>Aut.</TH>\n"); // columna autorizado/no autorizado
	print ("<TH WIDTH='2%'>Man.</TH>\n"); // columna manual/no manual
	print ("<TH WIDTH='2%'></TH>\n"); // columna detalles
	//if($rolUsuario=='Avanzado'){  
	print ("<TH WIDTH='2%'></TH>\n"); // 	(sólo usuarios autorizados)	
	//}
	print ("</TR>\n");
	print ("</TABLE>\n");
	$rows = sqlsrv_has_rows( $stmt );
	/*
	  if ($rows === true){
	 
	  $row_count = sqlsrv_num_rows( $stmt );
	*/
	print ("<div class='tablaDatos'>");
	print ("<TABLE width='1400px'>\n");
	if ($rows === true){
		$row_count = sqlsrv_num_rows( $stmt );
	//while($row = sqlsrv_fetch_array($stmt)){		
		for ($i=0; $i<$row_count; $i++)
		{
			$row = sqlsrv_fetch_array($stmt);
			if($i % 2){
				print ("<TR>\n");
			}
			else{
				print ("<TR class='even'>\n");
			}						
			print ("<TD WIDTH='7%'>" . $row['DNI'] . "</TD>\n");			
			print ("<TD WIDTH='8%'>" . $row['Nombre'] . "</TD>\n");
			print ("<TD WIDTH='11%'>" . $row['Apellidos'] . "</TD>\n");
			print ("<TD WIDTH='5%'>" . $row['Telefono_Tecnico'] . "</TD>\n");					
			print ("<TD WIDTH='7%'>" . $row['Contrata'] . "</TD>\n");				
			print ("<TD WIDTH='11%'>" . $row['Subcontrata'] . "</TD>\n");
			print ("<TD WIDTH='12%'>" . $row['Camara'] . "</TD>\n");				
			print ("<TD WIDTH='7%'>" . $row['Provincia'] . "</TD>\n");
			print ("<TD WIDTH='12%'>" . $row['Poblacion'] . "</TD>\n");
			print ("<TD WIDTH='5%'>" . $row['Tipo'] . "</TD>\n");				
			print ("<TD WIDTH='7%'>" . $row['Codigo_TP_Remedy'] . "</TD>\n");				
			print ("<TD WIDTH='5%'>" . $row['Fx_Registro'] . "</TD>\n");
			/*
						if ($row['FECHA_REGISTRO']==NULL){
							print ("<TD WIDTH='150'></TD>\n");
							}
						else{
							
							print ("<TD WIDTH='150'>".$row['FECHA_REGISTRO']."</TD>\n");
							
							}
						*/
						//AUTORIZADO / NO AUTORIZADO
			if ($row['Autorizado']==0)
				print ("<TD WIDTH='2%'><img src='images/tickno.jpg' height='12' border='0' title='No autorizado'></TD>");
			else if ($row['Autorizado']==1)	
				print ("<TD WIDTH='2%'><img src='images/ticksi.jpg' height='12' border='0' title='Autorizado'></TD>");
			else
				print ("<TD WIDTH='2%'></TD>");
			//MANUAL / NO MANUAL
			if ($row['Manual']==0)
				print ("<TD WIDTH='2%'><img src='images/tickno.jpg' height='12' border='0' title='No manual'></TD>");
			else if ($row['Manual']==1)	
				print ("<TD WIDTH='2%'><img src='images/ticksi.jpg' height='12' border='0' title='Manual'></TD>");
			else
				print ("<TD WIDTH='2%'></TD>");
			if($rolUsuario=='Avanzado'){   
				print ("<TD WIDTH='2%'><a href=modificar.php?id=".$row["idAcceso"]."><img src='images/icnModif.jpeg' height='18' border='0' title='modificar'></a></TD>");
			}
			else{   
				print ("<TD WIDTH='2%'><a href=modificar.php?id=".$row["idAcceso"]."><img src='images/icnDetall.jpeg' height='26' border='0' title='detalle'></a></TD>");			
			}
			//para marcar registros (sólo usuarios autorizados)
			if($rolUsuario=='Avanzado'){
				print ("<TD WIDTH='2%'><INPUT TYPE='CHECKBOX' NAME='marcarProc[]' VALUE='" .
				$row['idAcceso'] . "'></TD>\n");	
			}
			else{
				print ("<TD WIDTH='2%'></TD>\n");	
			}
			print ("</TR>\n");
		}  //end for
	}
	print ("</TABLE>\n");
	print ("</div>");  //fin tabla datos
	print ("<BR>\n");	 
	print ("</div>");
	print ("<div class='clear'></div>"); 
	print ("<div class='total'>");
	if ($row_count==0)
		print ("<p>No se encontraron resultados</p>");
	elseif ($row_count==1)
		print ("<p>Se encontr&oacute; ".$row_count." resultado</p>");
	else
		print ("<p>Se encontraron ".$row_count." resultados</p>");			
	print ("</div>");
			/*
			  }
			  else{
				 print ("");
				}
*/
?>		
	</form>
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
</div>  <!--datosTodos-->
<?php
   /*
} //fin si el navegador es Chrome
 else{
 echo '<p>La aplicaci&oacute;n est&aacute; optimizada para el navegador Chrome</p>';
  } 
  */
?>
</BODY>
</HTML>