<?php session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<!--<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">-->
<meta http-equiv=content-type content=text/html; charset=utf-8> 

<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" >
<title>Login</title>
<LINK REL="stylesheet" TYPE="text/css" HREF="css/estiloDef.css?ver=1.0">
</head>
<body>




<?PHP


//detecta si navegador es IExplorer

$user_agent = $_SERVER['HTTP_USER_AGENT'];

	/*$msie = strpos($user_agent, 'MSIE') ? true : false;
	$firefox = strpos($user_agent, 'Firefox') ? true : false;
	$safari = strpos($user_agent, 'Safari') ? true : false;*/
	$chrome = strpos($user_agent, 'Chrome') ? true : false;



if ($chrome) {  //si navegador es chrome
	
?>







<div id="datosTodos">	<!--datosTodos-->
			<div id='titulo'>
			<h1>Registro acceso a c&aacute;mara</h1>			
			</div>
			<div id='logo'>
			<img src="images/logo1.jpg"></img>
			</div>

	<div class="index"><!--clase index-->
				
		<h3>Login</h3>
				
		<div class="bloque">	<!--bloque1-->	

			<form action='login.php' autocomplete="off" name='login' method='post'>



				<label class="" id="" for="usu">
								Usuario
				</label>
				<div>
					<input id='usu' type='text' name='usuario' />
				</div>


				<label class="" id="" for="pass">
								Password
				</label>
				<div>
					<input id='pass' type='password' name='password' />
				</div>

				<p><input type='submit' name='enviar' value='Enviar' /></p>
			</form>
			
		</div><!--bloque1-->		
	</div><!--clase index-->
	

	
</div><!--datosTodos-->


<?php

} //fin si el navegador es Chrome
 
 
 else{
 echo "<script>alert('La aplicación está optimizada para el navegador Chrome')</script>";

  }

  
?>	
</body>
</html>