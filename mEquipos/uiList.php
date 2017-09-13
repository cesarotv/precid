<?php

	include_once("../lib/objUsuario.php");
	$iUsuario=new classUsuario();

if (!empty($_POST["txtUsr"])){
	echo utf8_encode($iUsuario->uiSelUsr($_POST["txtUsr"]));
}

?>