<?php

    function conectarse(){

        $dbhost = "localhost"; // nombre del host;
        $dbuser = "eric"; // nombre de usuario de base de datos;
        $dbpass = "eric" ;// contraseña de database ;
        $dbname = "Academia" ;// nombre de la base de datos.
       if (!( $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))){ 
		echo "Error conectando a la base de datos."; 
		exit(); 
		} 
	if (!mysqli_select_db($link, 'Academia')){ 
      echo "Error seleccionando la base de datos."; 
      exit(); 
	}    
    return $link;
        
    }

?>