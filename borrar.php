<?php
session_start();
if(isset($_SESSION["logged"]) && $_SESSION["logged"]){
	require_once 'includes/connect.php';

	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$delete = mysqli_query($db, "DELETE FROM estudiantes WHERE Documento = {$id}");
	}
}
header("Location: index.php");
?>
