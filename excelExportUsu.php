<?php session_start();

//Exportar datos de php a Excel
  
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename=consulta.xls");
 
 
?>


<HTML LANG="es">
<head>
<meta http-equiv=content-type content=text/html; charset= UTF-8> 
<TITLE> Exportacion de Datos </TITLE>
</head>
<body>

<?php
include ('funciones.php');
//ECHO '<P>'.$_SESSION['sqlConsulta'].'</P>';
$tsql=$_SESSION['sqlConsulta'];
$conn=conectar_bd();

$stmt = sqlsrv_query( $conn, $tsql );
			if( $stmt === false ){
				die ("Error al ejecutar consulta");
			}

$rows = sqlsrv_has_rows( $stmt );
	if ($rows === true){						
					
		print ("<TABLE border='1' bordercolor='silver'>\n");
				print ("<TR>\n");
				
						
					print ("<TH WIDTH='12%'>Login</TH>\n");
					print ("<TH WIDTH='32%'>Nombre</TH>\n");
					print ("<TH WIDTH='46%'>Mail</TH>\n");
					print ("<TH WIDTH='10%'>Perfil</TH>\n");
					
		
			
				print ("</TR>\n");
				
				
				while($row = sqlsrv_fetch_array($stmt)){
					print ("<TR>\n");
						print ("<TD WIDTH='12%'>" . $row['Login'] . "</TD>\n");
						print ("<TD WIDTH='32%'>" . $row['Nombre'] . "</TD>\n");
						print ("<TD WIDTH='38%'>" . $row['Mail'] . "</TD>\n");
						print ("<TD WIDTH='10%'>" . $row['Perfil'] . "</TD>\n");
					print ("</TR>\n");
				}
				
				
		print ("</TABLE>\n");			
	}

			 // Cerrar conexión
			sqlsrv_free_stmt( $stmt);
			sqlsrv_close( $conn);		
			
?>

</body>
</HTML>