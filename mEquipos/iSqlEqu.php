
<?php

	include_once("../lib/objequipo.php");
	$iEqu=new classEquipo();


	if (!empty($_POST["inAtr"])){

		echo "<span class='tAtr'>".$iEqu->selTAtr()."</span>".
		 	"<span class='vAtr'>
		 		<input id=\"".$_POST["inAtr"]."|0|0\" class=\"iAtrEq\" name=\"atr_atributo\"  value=\"\"/></span>";
	}


	if (!empty($_POST["saveEqu"])){
		$datsEqu= array();
		if($_POST["equ_id"]>0){
			$datsEqu ["id"]=$_POST["equ_id"];
			$datsEqu ["tipo"]=$_POST["equ_tipo"];
			$datsEqu ["marca"]=$_POST["equ_marca"];
			$datsEqu ["modelo"]=$_POST["equ_modelo"];
			$datsEqu ["serial"]=$_POST["equ_serial"];
			$datsEqu ["atributos"]=explode(",",$_POST["equ_atr"]);

			$iEqu->updateEqu($datsEqu);


			/*if(!empty($_POST["equ_atr"])){
				$iatr=explode(',', $_POST["equ_atr"]);
				foreach ($iatr as $iAtrEq) {
					$iA=explode(':', $iAtrEq);
					$stSql="INSERT INTO `db_cid_inv`.`atributoequipo` (`atr_equ_id`,`atr_id`,`atr_tae_id`,`atr_atributo`) ".
							"VALUES (".$iA[0].",".$iA[1].",".$iA[2].",'".$iA[3]."') ON DUPLICATE KEY UPDATE ".
							"`atr_tae_id`=".$iA[2].", `atr_atributo`=\"".$iA[3]."\";";
					$dbEqu->conectar($stSql);

				}*/

			//}

			//echo $stSql;

			
		}

	}

?>