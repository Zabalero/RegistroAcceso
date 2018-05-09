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
				
	/*			
SELECT tbAccesos.idAcceso, tbAccesos.DNI, tbAccesos.Nombre, tbAccesos.Apellidos,
 tbAccesos.Telefono_Tecnico, tbAccesos.Contrata, tbAccesos.Subcontrata, tbAccesos.Camara,
 tbAccesos.Autorizado, tbAccesos.Manual, 
 (convert(varchar(8), Fx_Registro, 3) + ' ' + convert(varchar(8), Fx_Registro, 14)) as Fx_Registro,
 tbPoblaciones.Descripcion as Poblacion, tbProvincias.Descripcion as Provincia

 FROM tbAccesos LEFT JOIN (tbPoblaciones LEFT JOIN tbProvincias ON tbPoblaciones.idProvincia=tbProvincias.idProvincia) on tbAccesos.idPoblacion=tbPoblaciones.idPoblacion WHERE idAcceso != ''				
	*/			
				
				
					
					print ("<TH WIDTH='7%'>DNI</TH>\n");
					print ("<TH WIDTH='9%'>Nombre</TH>\n");
					print ("<TH WIDTH='9%'>Apellidos</TH>\n");
					print ("<TH WIDTH='5%'>Tel. T&eacute;cnico</TH>\n");
					print ("<TH WIDTH='9%'>Contrata</TH>\n");
					print ("<TH WIDTH='10%'>Subcontrata</TH>\n");
					print ("<TH WIDTH='10%'>C&aacute;mara</TH>\n");	
					print ("<TH WIDTH='7%'>Provincia</TH>\n");
					print ("<TH WIDTH='13%'>Poblaci&oacute;n</TH>\n");					
					print ("<TH WIDTH='5%'>Tipo</TH>\n");
					print ("<TH WIDTH='7%'>Cod_TP_Remedy</TH>\n");
					print ("<TH WIDTH='5%'>F. registro</TH>\n");					
					print ("<TH WIDTH='2%'>Autorizado</TH>\n"); 
					print ("<TH WIDTH='2%'>Manual</TH>\n"); 
		
			
				print ("</TR>\n");
				
				
				while($row = sqlsrv_fetch_array($stmt)){
					print ("<TR>\n");
						print ("<TD WIDTH='7%'>" . $row['DNI'] . "</TD>\n");			
						print ("<TD WIDTH='9%'>" . $row['Nombre'] . "</TD>\n");
						print ("<TD WIDTH='9%'>" . $row['Apellidos'] . "</TD>\n");
						print ("<TD WIDTH='5%'>" . $row['Telefono_Tecnico'] . "</TD>\n");					
						print ("<TD WIDTH='9%'>" . $row['Contrata'] . "</TD>\n");				
						print ("<TD WIDTH='10%'>" . $row['Subcontrata'] . "</TD>\n");
						print ("<TD WIDTH='10%'>" . $row['Camara'] . "</TD>\n");				
						print ("<TD WIDTH='7%'>" . $row['Provincia'] . "</TD>\n");
						print ("<TD WIDTH='13%'>" . $row['Poblacion'] . "</TD>\n");
						print ("<TD WIDTH='5%'>" . $row['Tipo'] . "</TD>\n");
						print ("<TD WIDTH='7%'>" . $row['Codigo_TP_Remedy'] . "</TD>\n");
						print ("<TD WIDTH='5%'>" . $row['Fx_Registro'] . "</TD>\n");
						

						//AUTORIZADO / NO AUTORIZADO
						if ($row['Autorizado']==0)
						print ("<TD WIDTH='2%'>No autorizado</TD>");
						
						else if ($row['Autorizado']==1)	
						print ("<TD WIDTH='2%'>Autorizado</TD>");
						
						else
						print ("<TD WIDTH='2%'></TD>");
						
						
						
						//MANUAL / NO MANUAL
						if ($row['Manual']==0)
						print ("<TD WIDTH='2%'>No manual</TD>");
						
						else if ($row['Manual']==1)	
						print ("<TD WIDTH='2%'>Manual</TD>");
						
						else
						print ("<TD WIDTH='2%'></TD>");
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