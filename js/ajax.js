


function objetoAjax(){
	var xmlhttp=false;
	try {
	// Creacion del objeto AJAX para navegadores no IE
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			// Creacion del objet AJAX para IE
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}




function ListadoPoblaciones(url, id){


divResultado = document.getElementById('resultadoPoblaciones');
var mi_aleatorio=parseInt(Math.random()*99999999);//para que no guarde la página en el caché... 

        var vinculo=url+"?id="+id+"&rand="+mi_aleatorio; 

 
ajax=objetoAjax();
       
	
	ajax.open("GET",vinculo,true);//ponemos true para que la petición sea asincrónica 
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.send(null)
	



}





function ListadoPoblaciones_ant(datos){

	divResultado = document.getElementById('resultadoPoblaciones');
	ajax=objetoAjax();
	ajax.open("GET", datos);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			divResultado.innerHTML = ajax.responseText
		}
	}
	ajax.send(null)
}











