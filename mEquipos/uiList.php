<?php

	include_once("../lib/objUsuario.php");
	$iUsuario=new classUsuario();

	include_once("../lib/objequipo.php");
	$iEuipo=new classEquipo();

if (!empty($_POST["txtUsr"])){echo utf8_encode($iUsuario->uiSelUsr($_POST["txtUsr"]));} // Usuarios

if (!empty($_POST["tEqu"])){echo utf8_encode($iUsuario->uiselTEqu($_POST["tEqu"]));} //Tipo de Equipo

?>