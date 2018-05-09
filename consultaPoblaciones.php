<?php
include ('funciones.php');
	
		$id=$_GET['id'];
		
				//print ("<h3>CTOS con incidencia de la actuaci&oacute;n ".$id."</h3>");
						$conn=conectar_bd();

												
						//$instruccion2 = "select * from incCTO where idGinc ='".$id."'";
						$tsql = "select idPoblacion, idProvincia, Descripcion from tbPoblaciones where idProvincia ='".$id."'";
						

						$stmt = sqlsrv_query( $conn, $tsql)	
								 or die ("Fallo en la consulta");
								 
							// Mostrar resultados de la consulta
							$rows = sqlsrv_has_rows( $stmt );
							
							if ($rows === true){				 
								 
								
								
								print ('<label class="" id="" for="poblacion">');
								print ('Poblaci&oacute;n');
								print ('</label>');
								
								print ('<div>');
								
									print ('<select id="poblacion" style="width: 300px;" class="" tabindex="3" name= "poblacion">\n');
									//print ('<option value="0" selected>Selecciona opci&oacute;n...</option>');
									print ('<option value="" selected></option>');
										while($row= sqlsrv_fetch_array($stmt)){
											
											echo '<option value= "'.$row["idPoblacion"].'">'.$row["Descripcion"].'</option>';
										}  //end while

									print ("</select>\n");
									
								print ('<div>');
									 
							
							}
							
							
								
						   // Cerrar conexión
							sqlsrv_free_stmt( $stmt);						
							sqlsrv_close( $conn);
					
							
	
		 
		 
							
						
?>