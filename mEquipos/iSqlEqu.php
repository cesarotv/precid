
<?php


	include_once("../lib/objequipo.php");
	$iEqu=new classEquipo();


	if (!empty($_POST["inAtr"])){
		echo "<span class='tAtr'>".$iEqu->selTAtr()."</span>".
		 	"<span class='vAtr'>
		 		<input id=\"".$_POST["inAtr"]."|0|0\" class=\"iAtrEq\" value=\"\"/></span>";
	}

	if (!empty($_POST["savetEqu"])){
		$datsEqu= array();
		$datsEqu ["nombre"]=$_POST["equ_tipo"];
		echo $iEqu->savetEqu($datsEqu);
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

	
	if (!empty($_POST["savenPrest"])){

		include_once("../lib/objPrestamo.php");
		$iPres=new classPrestamo();

		$datsPres= array();
		$datsPres ["equ_id"]=$_POST["equ_id"];
		$datsPres ["usr_id"]=$_POST["pre_usr"];
		$datsPres ["pre_tipo"]=$_POST["pre_tipo"];
		$datsPres ["pre_progdev"]=$_POST["pre_devprog"];

		//echo $datsPres["equ_id"]."/".$datsPres["usr_id"]."/".$datsPres["pre_tipo"]."/".$datsPres["pre_progdev"];
		echo $iPres->presEquipo($datsPres);
	}

	if (!empty($_POST["reprogDevPrest"])){

		include_once("../lib/objPrestamo.php");
		$iPres=new classPrestamo();

		$fprogDev=explode("/",$_POST["pre_fechaProgDev"]);

		$datsPres= array();
		$datsPres ["equ_id"]=$_POST["equ_id"];
		$datsPres ["pre_fechaProgDev"]=$fprogDev[1]."/".$fprogDev[0]."/".$fprogDev[2];

		echo $iPres->reprogDevEquipo($datsPres);
	}

	if (!empty($_POST["DevPrest"])){

		include_once("../lib/objPrestamo.php");
		$iPres=new classPrestamo();

		$datsPres= array();
		$datsPres ["equ_id"]=$_POST["equ_id"];
		
		echo $iPres->DevEquipo($datsPres);

	}

?>