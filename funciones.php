<?php
// Establece una conexión con la base de datos
function conectar_bd(){
	/* Nombre del servidor. */
	$serverName = "172.29.0.80";

	/* Usuario y clave.  */
	$uid = "DST_ADM";
	$pwd = "reparil2014";

	/* Array asociativo con la información de la conexion */
	$connectionInfo = array( "UID"=>$uid,
	"PWD"=>$pwd,
	"Database"=>"CAMARA", "CharacterSet" => "UTF-8");
	 
	 
	 
	/* Nos conectamos mediante la autenticación de SQL Server . */
	$conn = sqlsrv_connect( $serverName, $connectionInfo);
	if( $conn === false ){
		die ("No se puede conectar con el servidor");
	}

	//Devolvemos el enlace a la conexión
	return $conn;
}




//Comprueba si la combinación usuario-contraseña es correcta
function es_usuario($usuario,$password){
	//Se conecta a la base de datos
	$conn=conectar_bd();
	//Busca al usuario y su contraseña en la tabla tbUsuarios
	$tsql="SELECT * FROM tbUsuarios WHERE Login='".$usuario."'AND
	Password='".$password."'";

	//Obtiene el resultado
	$stmt = sqlsrv_query( $conn, $tsql);

	if( $stmt === false ){
		die ("Error al ejecutar consulta");
	}

	$rows = sqlsrv_has_rows( $stmt );

	/* Cerramos la conexión */
	sqlsrv_free_stmt( $stmt);
	sqlsrv_close( $conn);


	   if ($rows === true)
		  return true;
	   else 
		  return false;
}




//Devuelve el rol de usuario pasado como parámetro
function get_rol($usuario){

	//Se conecta a la base de datos
	$conn=conectar_bd();
	//Busca al usuario y su contraseña en la tabla usuarios
	$tsql="SELECT tbPerfiles.Descripcion FROM tbUsuarios INNER JOIN tbPerfiles on tbUsuarios.idPerfil=tbPerfiles.idPerfil WHERE tbUsuarios.Login='".$usuario."'";

	//Obtiene el resultado
	$stmt = sqlsrv_query( $conn, $tsql)	
			 or die ("Fallo en la consulta");


	//(una fila)
	while($row = sqlsrv_fetch_array($stmt)){	
		$rol= $row["Descripcion"]; 
	}

	/* Cerramos la conexión */
	sqlsrv_free_stmt( $stmt);
	sqlsrv_close( $conn);

	return $rol;

}





//Devuelve el nombre de usuario pasado como parámetro a partir del usuario
function get_nombre($usuario){


//Se conecta a la base de datos
	$conn=conectar_bd();
	//Busca al usuario y su contraseña en la tabla usuarios
	$tsql="SELECT Nombre FROM tbUsuarios WHERE Login='".$usuario."'";

	//Obtiene el resultado
	$stmt = sqlsrv_query( $conn, $tsql);

	if( $stmt === false ){
		die ("Error al ejecutar consulta");
	}

	/* Mostramos el resultado. */
	//(una fila)
	while($row = sqlsrv_fetch_array($stmt)){	
		$nombre= $row["Nombre"]; 
	}

	/* Cerramos la conexión */
	sqlsrv_free_stmt( $stmt);
	sqlsrv_close( $conn);

	return $nombre;
}







//Devuelve el nombre de usuario pasado como parámetro a partir del usuario
function get_id($usuario){


//Se conecta a la base de datos
	$conn=conectar_bd();
	//Busca al usuario y su contraseña en la tabla usuarios
	$tsql="SELECT idUsuario FROM tbUsuarios WHERE Login='".$usuario."'";

	//Obtiene el resultado
	$stmt = sqlsrv_query( $conn, $tsql);

	if( $stmt === false ){
		die ("Error al ejecutar consulta");
	}

	/* Mostramos el resultado. */
	//(una fila)
	while($row = sqlsrv_fetch_array($stmt)){	
		$idUsu= $row["idUsuario"]; 
	}

	/* Cerramos la conexión */
	sqlsrv_free_stmt( $stmt);
	sqlsrv_close( $conn);

	return $idUsu;
}





function sumaDias($fecha,$dias){
$nuevafecha = strtotime ( $dias." day" , strtotime ( $fecha ) ); 
$nuevafecha = date ( 'Y-m-d' , $nuevafecha ); //formatea nueva fecha 
return $nuevafecha; //retorna valor de la fecha 
}


