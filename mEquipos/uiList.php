<?php

	include_once("../lib/objUsuario.php");
	$iUsuario=new classUsuario();

	include_once("../lib/objequipo.php");
	$iEquipo=new classEquipo();

if (!empty($_POST["txtUsr"])){echo utf8_encode($iUsuario->uiSelUsr($_POST["txtUsr"]));} // Usuarios

if (!empty($_POST["tEqu"])){echo utf8_encode($iEquipo->uiselTEqu($_POST["tEqu"]));} //Tipo de Equipo

if (!empty($_POST["tAtrib"])){echo utf8_encode($iEquipo->uiselTAtr($_POST["tAtrib"]));} //Tipo de Equipo
?>