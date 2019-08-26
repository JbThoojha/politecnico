<?php require_once 'includes/redirect.php';?>
<?php require_once 'includes/header.php';?>
<?php
if(!isset($_GET["id"]) || empty($_GET["id"]) || !is_numeric($_GET["id"])){
  header("location:index.php");
}
$id= $_GET["id"];
$user_query = mysqli_query($db, "SELECT * FROM estudiantes WHERE Documento = {$id}");
$user=mysqli_fetch_assoc($user_query);
if(!isset($user["Documento"]) || empty($user["Documento"])){
  header("location:index.php");
}
?>
<!--Nuevo codigo-->
<?php if($user["Foto"] != null){?>
<div class="col-lg-5">
      <img src="uploads/<?php echo $user["Foto"] ?>" width="300"/>
    <?php } ?>
  </div>
<div class="col-lg-7">
<h3>Usuario: <strong><?php echo $user["Nombres"]." ".$user["Apellidos"];?></strong></h3>
<p><h4>Datos:</h4></p>
<p>Nombres: <?php echo $user["Nombres"];?></p>
<p>Apellidos: <?php echo $user["Apellidos"];?></p>
</div>
<div class="clearfix"></div>
<?php require_once 'includes/footer.php';?>
