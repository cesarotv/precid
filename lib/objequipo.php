<?php
if (!empty($_POST)){
include_once("../lib/conector.php");
}else{include_once("lib/conector.php");}

 class classEquipo{

 	var $access;
 	var $id="";
 	var $cod="";
 	var $IDbarras="";
 	var $idTipo="";
 	var $tipo="";
 	var $marca="";
 	var $modelo="";
 	var $serial="";

 	var $atributos = array();
 	var $obs = array();

 	var $iselTAtrl;

 
 	function classEquipo(){$this->access=new ConectorDB;}

 	function diEquipo($tID){

 		$this->id=$tID;
 		if(!($tID<0)){

			$this->access->conectar("SELECT equipo.*,tipoequipo.tequ_nombre FROM equipo, tipoequipo WHERE equipo.equ_teq_id=tipoequipo.tequ_id AND equipo.equ_id=".$tID.";");

			$tdEqu= mysql_fetch_array($this->access->getResult(), MYSQL_ASSOC);

			
			$this->cod=$tdEqu["equ_cod"];
			$this->IDbarras=$tdEqu["equ_IDBarras"];
			$this->idTipo=$tdEqu["equ_teq_id"];
			$this->tipo=$tdEqu["tequ_nombre"];
			$this->marca=$tdEqu["equ_marca"];
			$this->modelo=$tdEqu["equ_modelo"];
			$this->serial=$tdEqu["equ_serial"];

			$this->access->conectar("SELECT `atributoequipo`.`atr_id`,`tipoatributoequipo`.`tae_id`,`tipoatributoequipo`.`tae_nombre`, `atributoequipo`.`atr_atributo` FROM `atributoequipo`, `tipoatributoequipo`"." WHERE `atributoequipo`.`atr_tae_id`=`tipoatributoequipo`.`tae_id` AND `atributoequipo`.`atr_equ_id`=".$tID.";");
			while ($row=mysql_fetch_array($this->access->getResult())){$this->atributos[] = $row;}
			
			$this->access->conectar("SELECT * FROM `obsequipo` WHERE `obsequipo`.`obsequ_equ_id`=".$tID." order by `obsequ_fecha` desc;");
			while ($row=mysql_fetch_array($this->access->getResult())){$this->obs[] = $row;}
		}

 	}

	function selTEqu($itequ){
 		$this->access=new ConectorDB;
		$this->access->conectar("SELECT * FROM `db_cid_inv`.`tipoequipo`;");
		$tmp="";
		while ($row=mysql_fetch_array($this->access->getResult())){
			if ($row["tequ_id"]==$itequ){$tsel=" selected ";}else{$tsel="";}
			$tmp=$tmp."<option value=\"".$row["tequ_id"]."\" ".$tsel.">".$row["tequ_nombre"]."</option>";}
		return $tmp;
	}

 	function selTAtr($itAtr=0){$this->access=new ConectorDB;
		$this->access->conectar("SELECT * FROM `db_cid_inv`.`tipoatributoequipo`;");
		$tmp="";
		while ($row=mysql_fetch_array($this->access->getResult())){
			if ($row["tae_id"]==$itAtr){$tsel=" selected ";}else{$tsel="";}
			$tmp=$tmp."<option value=\"".$row["tae_id"]."\" ".$tsel.">".$row["tae_nombre"]."</option>";}
		$tmp="<select onchange='changeAtrib(this)'><option></option>".$tmp."</select>";
		return $tmp;
	}

	function updateEqu($idEqu){$this->access=new ConectorDB;
		$this->access->conectar("SELECT * FROM `db_cid_inv`.`tipoatributoequipo`;");
		$stSql="UPDATE `db_cid_inv`.`equipo` SET `equ_teq_id` = :id, `equ_marca` = ':marca',`equ_modelo` = ':modelo',".
					"`equ_serial` = ':serial' WHERE `equ_id` = :id";
		$stSql=$this->sqlReplace($stSql,$idEqu);
		$this->access->conectar($stSql);

		$iAtr="";$maxAtr = $this->maxIdAtrEqu($idEqu["id"]);
		
		foreach ($idEqu["atributos"] as $iAtr) {
			list($idEq,$idatrEq,$idAtr) =explode("|",explode(":", $iAtr)[0]);
			
			if($idatrEq==0){$maxAtr++;$idatrEq=$maxAtr;} // incrementa IDAtrib para atributos nuevos

			$vAtr=explode(":",$iAtr)[1];

			$stSql="INSERT INTO `db_cid_inv`.`atributoequipo` (`atr_equ_id`,`atr_id`,`atr_tae_id`,`atr_atributo`) ".
					"VALUES (".$idEq.",".$idatrEq.",".$idAtr.",'".$vAtr."') ON DUPLICATE KEY UPDATE ".
					"`atr_tae_id`=".$idAtr.", `atr_atributo`=\"".$vAtr."\";";

			$this->access->conectar($stSql);
		}
	}


	//---------- Funciones complementarias ----------------

	function sqlReplace($txtSql,$iCampos){
		foreach ($iCampos as $iCmp=>$vCmp) {
			if(!is_array($vCmp))$txtSql=str_replace(":".$iCmp,$vCmp,$txtSql);}
		return $txtSql;
	}

 	function maxIdAtrEqu($idequ){
 		$this->access->conectar("SELECT MAX(`atributoequipo`.`atr_id`) AS MaxAtr FROM `db_cid_inv`.`atributoequipo` WHERE `atributoequipo`.`atr_equ_id`=".$idequ);
 		return mysql_fetch_array($this->access->getResult())[0];
 	}




 			//for($i=0; $i<count($atributos); $i++){
			//echo $atributos[$i]["tae_nombre"].": ".$atributos[$i]["atr_atributo"]."<br>";
		//}

 			//for($i=0; $i<count($obs); $i++){
			//echo $obs[$i]["obsequ_fecha"].": ".utf8_encode($obs[$i]["obsequ_observacion"]."<br>");
		//}
		

		//echo $this->tipo . " - ". $this->marca. " - ". $this->modelo . " - ". $this->serial. " - ". $this->id."<br>";
	/*$access->conectar("SELECT `tipoatributoequipo`.`tae_nombre`, `atributoequipo`.`atr_atributo` FROM `atributoequipo`, `tipoatributoequipo`"." WHERE `atributoequipo`.`atr_tae_id`=`tipoatributoequipo`.`tae_id` AND `atributoequipo`.`atr_equ_id`=".$tID.";");
echo "<br>"."<br>"."<br>";
		$access->conectar("SELECT equipo.equ_id, equipo.equ_cod,equipo.equ_teq_id,tipoequipo.tequ_nombre, equipo.equ_marca, equipo.equ_modelo, equipo.equ_serial FROM equipo, tipoequipo WHERE equipo.equ_teq_id=tipoequipo.tequ_id AND atributoequipo.atr_equ_id=".$tID.";");
		*/








 }

 if (!empty($_POST["iAtr"])){
		
		$iEquipo=new classEquipo($_POST["iAtr"]);
			echo "<span class='tAtr'>".$iEquipo->selTAtr("")."</span>".
					"<span class='vAtr'><input id=\"".$_POST["iAtr"].":".$_POST["nAtrib"]."\" class=\"iAtrEq\" name=\"atr_atributo\"  value=\"\"/></span>";
		}



?>