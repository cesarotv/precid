
<?php


	include_once("../lib/objequipo.php");
	$iEqu=new classEquipo();


	if (!empty($_POST["inAtr"])){
		echo "<span class='tAtr'>".$iEqu->selTAtr()."</span>".
		 	"<span class='vAtr'>
		 		<input id=\"".$_POST["inAtr"]."|0|0\" class=\"iAtrEq\" value=\"\"/></span>";
	}


	if (!empty($_POST["saveEqu"])){
		$datsEqu= array();
		$datsEqu ["id"]=$_POST["equ_id"];
		$datsEqu ["codigo"]=$_POST["equ_cod"];
		$datsEqu ["tipo"]=$_POST["equ_tipo"];
		$datsEqu ["marca"]=$_POST["equ_marca"];
		$datsEqu ["modelo"]=$_POST["equ_modelo"];
		$datsEqu ["serial"]=$_POST["equ_serial"];
		if(!empty($_POST["equ_atr"])){
			$datsEqu ["atributos"]=explode(",",$_POST["equ_atr"]);
		}
		echo $iEqu->saveEqu($datsEqu);
	}

	if (!empty($_POST["iEquObs"])){	$iEqu->saveObsEqu($_POST["iEquObs"],$_POST["iObs"]); }

	if (!empty($_POST["idDescEqu"])){$iEqu->descEqu($_POST["idDescEqu"]); }

	
?>