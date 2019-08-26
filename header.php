<?php
require_once 'connect.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>COLEGIO POLITECNICO</title>
<link type="text/css" rel="stylesheet" href="assets/components/bootstrap/dist/css/bootstrap.min.css"/>
<link type="text/css" rel="stylesheet" href="assets/components/bootstrap/dist/css/bootstrap-theme.min.css"/>
<script type="text/javascript" src="assets/components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/components/jquery/jquery.min.js"></script>
</head>

<body>
    <div class="container">
     <h1>COLEGIO POLITECNICO</h1>
     <hr/>
     <?php if(isset($_SESSION["logged"])){ ?>
		<div class="col-lg-7">
			<a href="index.php" class="btn btn-success">Inicio</a>
			<a href="crear.php" class="btn btn-primary">nuevo usuario</a>
		</div>
		<div class="col-lg-5">
			<?php echo "Bienvenido ".$_SESSION["logged"]["Nombres"]." ". $_SESSION["logged"]["Apellidos"]; ?>
			<a href="logout.php">Cerrar sesión</a>
		</div>
		<div class="clearfix"></div>
		<hr/>
		<?php } ?>
