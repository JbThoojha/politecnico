<?php include 'includes/redirect.php';?>
<?php require_once("includes/header.php")?>
<?php
function mostrarError($error, $field){
  if(isset($error[$field]) && !empty($field)){
    $alerta='<div class="alert alert-danger">'.$error[$field].'</div>';
  }else{
    $alerta='';
  }
  return $alerta;
}
function setValueField($datos,$field, $textarea=false){
  if(isset($datos) && count($datos)>=1){
    if($textarea != false){
      echo $datos[$field];
    }else{
      echo "value='{$datos[$field]}'";
    }
  }
}
//Buscar Usuario
if(!isset($_GET["id"]) || empty($_GET["id"]) || !is_numeric($_GET["id"])){
  header("location:index.php");
  }
$id=$_GET["id"];
$user_query=mysqli_query($db, "SELECT * FROM estudiantes WHERE Documento={$id}");
$user=mysqli_fetch_assoc($user_query);
if(!isset($user["Documento"]) || empty($user["Documento"])){
  header("location:index.php");
}
//Validar usuario
$error=array();
  if(isset($_POST["submit"])){
    if(!empty($_POST["Documento"])){
        $apellidos_validador=true;
       }else{
       $apellidos_validador=false;
         $error["Documento"]="El documento no es válido";
          }
   if(!empty($_POST["Nombres"]) && strlen($_POST["Nombres"]<=20) && !is_numeric($_POST["Nombres"]) && !preg_match("/[0-9]/", $_POST["Nombres"])){
  $nombre_validador=true;
  }else{
  $nombre_validador=false;
  $error["Nombres"]="El nombre no es válido";
  }
    if(!empty($_POST["Apellidos"])&& !is_numeric($_POST["Apellidos"]) && !preg_match("/[0-9]/", $_POST["Apellidos"])){
        $apellidos_validador=true;
       }else{
       $apellidos_validador=false;
         $error["Apellidos"]="Los apellidos no son válidos";
          }
          if(!empty($_POST["password"]) && strlen($_POST["password"]>=6)){
            $email_validador=true;
           }else{
           $email_validador=false;
            $error["password"]="Introduzca una contraseña de más de seis caracteres";
             }
       if(!empty($_POST["Direccion"])){
         $direccion_validador=true;
        }else{
        $direccion_validador=false;
         $error["Direccion"]="La direccion no puede estar vacía";
          }
       if(!empty($_POST["Acudiente"])){
         $email_validador=true;
        }else{
         $email_validador=false;
         $error["Acudiente"]="El acudiente no puede estar vacia";
          }
          if(!empty($_POST["Telefono"])){
            $email_validador=true;
           }else{
            $email_validador=false;
            $error["Telefono"]="El Telefono no puede estar vacia";
             }

        //Crear una carpeta
        $image=null;
        if(isset($_FILES["Foto"]) && !empty($_FILES["Foto"]["tmp_name"])){
          if(!is_dir("uploads")){
            $dir = mkdir("uploads", 0777, true);
          }else{
            $dir=true;
          }
          if($dir){
            $filename= time()."-".$_FILES["Foto"]["name"]; //concatenar función tiempo con el nombre de imagen
            $muf=move_uploaded_file($_FILES["Foto"]["tmp_name"], "uploads/".$filename); //mover el fichero utilizando esta función
            $image=$filename;
            if($muf){
              $image_upload=true;
            }else{
              $image_upload=false;
              $error["Foto"]= "La imagen no se ha subido";
            }
          }
          //var_dump($_FILES["image"]);
          //die();
  	 	}
    //Actualizar Usuarios en la base de Datos
    if(count($error)==0){
      $sql= "UPDATE estudiantes SET Documento='{$_POST["Documento"]}',"
      . "Nombres= '{$_POST["Nombres"]}',"
      . "Apellidos= '{$_POST["Apellidos"]}',";
      if(isset($_POST["password"]) && !empty($_POST["password"])){
        $sql.= "password='".sha1($_POST["password"])."', ";
     }
       "Direccion= '{$_POST["Direccion"]}',"
      . "Acudiente= '{$_POST["Acudiente"]}',"
    . "Telefono= '{$_POST["Telefono"]}',";
          if(isset($_FILES["Foto"]) && !empty($_FILES["Foto"]["tmp_name"])){
       $sql.= "Foto='{$image}', ";
    }

      $update_user=mysqli_query($db, $sql);
      if($update_user){
        $user_query=mysqli_query($db, "SELECT * FROM estudiantes WHERE Documento={$id}");
        $user=mysqli_fetch_assoc($user_query);
      }
    }else{
      $update_user=false;
    }
}
?>
<h2>Editar Usuario: </br><?php echo $user["Nombres"]." ".$user["Apellidos"];?></h2>
<?php if(isset($_POST["submit"]) && count($error)==0 && $update_user !=false){?>
  <div class="alert alert-success">
    El usuario se ha actualizado correctamente !!
  </div>
<?php }elseif(isset($_POST["submit"])){?>
  <div class="alert alert-danger">
    El usuario NO se ha actualizado correctamente !!
  </div>
<?php } ?>
<form action="" method="POST" enctype="multipart/form-data">
  <label for="Documento">Documento:
  <input type="text" name="Documento" class="form-control" <?php setValueField($error, "Documento");?>/>
  <?php echo mostrarError($error, "Documento");?>
  </label>
  </br></br>
    <label for="Nombres">Nombres:
    <input type="text" name="Nombres" class="form-control" <?php setValueField($error, "Nombres");?>/>
    <?php echo mostrarError($error, "Nombres");?>
    </label>
    </br></br>
    <label for="Apellidos">Apellidos:
        <input type="text" name="Apellidos" class="form-control" <?php setValueField($error, "Apellidos");?>/>
        <?php echo mostrarError($error, "Apellidos");?>
    </label>
  </br></br>
  <label for="password">Contraseña:
      <input type="password" name="password" class="form-control"/>
      <?php echo mostrarError($error, "password");?>
  </label>
    </br></br>
    <label for="Direccion">Direccion:
        <input type="text" name="Direccion" class="form-control" <?php setValueField($error, "Direccion");?>/>
        <?php echo mostrarError($error, "Direccion");?>
    </label>
    </br></br>
    <label for="Acudiente">Acudiente:
        <input type="text" name="Acudiente" class="form-control" <?php setValueField($error, "Acudiente");?>/>
        <?php echo mostrarError($error, "Acudiente");?>
    </label>
    </br></br>
    <label for="Telefono">Telefono:
        <input type="text" name="Telefono" class="form-control" <?php setValueField($error, "Telefono");?>/>
        <?php echo mostrarError($error, "Telefono");?>
    </label>
    </br></br>
    <label for="Foto">
      <?php if($user["Foto"] != null){?>
        Imagen de Perfil: <img src="uploads/<?php echo $user["Foto"] ?>" width="100"/><br/>
      <?php } ?>
        Actualizar Imagen de Perfil:
        <input type="file" name="Foto" class="form-control"/>
    </label>
    </br></br>
    </br></br>
    <input type="submit" value="Enviar" name="submit" class="btn btn-success"/>
</form>


<?php require_once("includes/footer.php")?>
