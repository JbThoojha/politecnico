<?php
if(!empty($_POST["Documento"])&& !is_numeric($_POST["Documento"]) && !preg_match("/[0-9]/", $_POST["Documento"])){
   echo $_POST["Documento"]."<br/>";
}
if(isset($_POST["submit"]) && strlen($_POST["Nombres"]<=20) && !is_numeric($_POST["Nombres"]) && !preg_match("/[0-9]/", $_POST["Nombres"])){
    if(!empty($_POST["Nombres"])){
        echo $_POST["Nombres"]."<br/>";
    }
     if(!empty($_POST["Apellidos"])&& !is_numeric($_POST["Apellidos"]) && !preg_match("/[0-9]/", $_POST["Apellidos"])){
        echo $_POST["Apellidos"]."<br/>";
    }
    if(!empty($_POST["password"]) && strlen($_POST["password"]>=6)){
       echo sha1($_POST["password"])."<br/>";
   }
     if(!empty($_POST["Direccion"])){
        echo $_POST["Direccion"]."<br/>";
    }
    if(!empty($_POST["Acudiente"]) && strlen($_POST["Acudiente"])){
       echo sha1($_POST["Acudiente"])."<br/>";
   }
     if(!empty($_POST["Telefono"])){
        echo $_POST["Telefono"]."<br/>";
    }
    if(isset($_FILES["Foto"]) && !empty($_FILES["Foto"]["tmp_name"])){
		echo "La imagen esta cargada";
	    }
}
