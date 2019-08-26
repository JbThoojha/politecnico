<?php include 'includes/redirect.php';?>
<?php require_once 'includes/header.php';?>
<?php
function mostrarError($error, $field){
  if(isset($error[$field]) && !empty($field)){
    $alerta='<div class="alert alert-danger">'.$error[$field].'</div>';
  }else{
    $alerta='';
  }
  return $alerta;
}
function setValueField($error,$field, $textarea=false){
  if(isset($error) && count($error)>=1 && isset($_POST[$field])){
    if($textarea != false){
      echo $_POST[$field];
    }else{
      echo "value='{$_POST[$field]}'";
    }
  }
}
$error=array();
if(isset($_POST["submit"])){
  if(!empty($_POST["Documento"])){
      $documento_validador=true;
     }else{
     $documento_validador=false;
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
       $acudiente_validador=true;
      }else{
       $acudiente_validador=false;
       $error["Acudiente"]="El acudiente no puede estar vacia";
        }
        if(!empty($_POST["Telefono"])){
          $telefono_validador=true;
         }else{
          $telefono_validador=false;
          $error["Telefono"]="El Telefono no puede estar vacia";
           }

      //Crear una carpeta nuevo código
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
	 	}
    //Insertar Usuarios en la base de Datos
    if(count($error)==0){
      $sql= "INSERT INTO estudiantes VALUES('{$_POST["Documento"]}', '{$_POST["Nombres"]}', '{$_POST["Apellidos"]}', '".sha1($_POST["password"])."' ,'{$_POST["Direccion"]}', '{$_POST["Acudiente"]}', '{$_POST["Telefono"]}','{$image}');";
      $insert_user=mysqli_query($db, $sql);
    }else{
      $insert_user=false;
    }
}
?>
<h1>Crear Usuarios</h1>
<?php if(isset($_POST["submit"]) && count($error)==0 && $insert_user !=false){?>
  <div class="alert alert-success">
    El usuario se ha creado correctamente !!
  </div>
<?php } ?>
<form action="crear.php" method="POST" enctype="multipart/form-data">
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
    <label for="Foto">Imagen:
        <input type="file" name="Foto" class="form-control"/>
    </label>

    </br></br>

    </br></br>
    <input type="submit" value="Enviar" name="submit" class="btn btn-success"/>
</form>

<?php require_once 'includes/footer.php'; ?>
