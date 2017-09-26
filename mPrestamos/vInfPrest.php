
<?php 
if (!empty($_POST)){include_once("../lib/objPrestamo.php");
	}else{include_once("lib/objPrestamo.php");$_POST["usr_id"]=-1;}

		$iPrestamo=new classPrestamo();
		$iPrestamo->infPrest($_POST["equ_id"],$_POST["pre_fecha"]);
?>

<div>

	<div id="listObs" class="iDat v">
<?php

	for($i=0; $i<count($iPrestamo->obs); $i++){
		echo "<div class='iObs'>".
			 "<div class='iFechObs'>".
			 	"<span>".utf8_encode($iPrestamo->obs[$i]["usr_nombres"]." ".$iPrestamo->obs[$i]["usr_apellidos"])."</span>".
			 	"<span style=\"position: absolute; right:0;\">".date_create($iPrestamo->obs[$i]["obsequ_fecha"])->format('d/m/y  h:i a')."</span></div>".
			 "<div class='iContObs'><div>".utf8_encode($iPrestamo->obs[$i]["obsequ_observacion"])."</div></div>".
			 "</div>";
	}

?>
	</div>
</div>