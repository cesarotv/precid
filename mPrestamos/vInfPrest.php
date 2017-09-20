
<?php 
if (!empty($_POST)){include_once("../lib/objPrestamo.php");
	}else{include_once("lib/objPrestamo.php");$_POST["usr_id"]=-1;}

		$iPrestamo=new classPrestamo();
		echo $iPrestamo->infPrest($_POST["equ_id"],$_POST["pre_fecha"]);
?>

<div>

	<div id="listObs" class="iDat v">
<?php
/*
	for($i=0; $i<count($iPrestamo->obs); $i++){

	}*/

?>
	</div>
</div>