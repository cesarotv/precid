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

 	var $pres_usr_id=""; // Datos de prestamos vigentes a quien le ha sido prestado el equipo
 	var $pres_usr_nombre="";
 	var $pres_usr_fechadev="";


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


			$this->access->conectar("SELECT `prestamos`.`pre_usr_id`, concat(`usuario`.`usr_nombres`, ' ', `usuario`.`usr_apellidos`) as usr_nombre,DATE_FORMAT(`prestamos`.`pre_fechaprogdev`, '%d/%m/%Y') as pre_fechaprogdev FROM db_cid_inv.prestamos,db_cid_inv.usuario where `prestamos`.`pre_usr_id`=`usuario`.`usr_id` and `prestamos`.`pre_equ_id`= ".$tID." and `prestamos`.`pre_fechadev`is null;");
			$row= mysql_fetch_array($this->access->getResult(), MYSQL_ASSOC);
			$this->pres_usr_id=$row["pre_usr_id"];
			$this->pres_usr_nombre=$row["usr_nombre"];
			$this->pres_usr_fechadev=$row["pre_fechaprogdev"];

			$this->access->conectar("SELECT `atributoequipo`.`atr_id`,`tipoatributoequipo`.`tae_id`,`tipoatributoequipo`.`tae_nombre`, `atributoequipo`.`atr_atributo` FROM `atributoequipo`, `tipoatributoequipo`"." WHERE `atributoequipo`.`atr_tae_id`=`tipoatributoequipo`.`tae_id` AND `atributoequipo`.`atr_equ_id`=".$tID.";");
			while ($row=mysql_fetch_array($this->access->getResult())){$this->atributos[] = $row;}
			
			$this->access->conectar("SELECT obsequipo.*, `usuario`.usr_nombres, `usuario`.usr_apellidos  FROM db_cid_inv.`obsequipo` left join db_cid_inv.`usuario` on `obsequipo`.obsequ_usr_id= `usuario`.usr_id WHERE `obsequipo`.`obsequ_equ_id`=".$tID." order by `obsequ_fecha` desc;");
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

	function uiselTEqu($itequ){
 		$this->access=new ConectorDB;
		$this->access->conectar("SELECT * FROM `db_cid_inv`.`tipoequipo`;");
		$tmp="";$op=0;
		while ($row=mysql_fetch_array($this->access->getResult())){
			if ($row["tequ_id"]==$itequ){$tsel=" selected ";}else{$tsel="";}
			$tmp=$tmp."<li id=\"".$row["tequ_id"]."\" data-id=\"".$op."\" ".$tsel.">".$row["tequ_nombre"]."</li>";$op++;}
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

	function saveEqu($idEqu){$this->access=new ConectorDB;
		if($idEqu["id"]==0){
			$idEqu["id"] = $this->maxIdEqu()+1;
			$stSql="INSERT INTO `db_cid_inv`.`equipo` (`equ_id`,`equ_cod`,`equ_IDBarras`,`equ_teq_id`,`equ_marca`,`equ_modelo`,`equ_serial`,`equ_estado`)".
			"VALUES (:id,':codigo',null,:tipo,':marca',':modelo',':serial',1)";
			$stSql=$this->sqlReplace($stSql,$idEqu);
			$this->access->conectar($stSql);

		}else{
			$stSql="UPDATE `db_cid_inv`.`equipo` SET `equ_teq_id` = :tipo, `equ_cod` = ':codigo', `equ_marca` = ':marca',`equ_modelo` = ':modelo',`equ_serial` = ':serial' WHERE `equ_id` = :id";
			$stSql=$this->sqlReplace($stSql,$idEqu);
			$this->access->conectar($stSql);
		}
		
		// ---- Atributos
		if (!empty($idEqu["atributos"])){
			$iAtr="";$maxAtr = $this->maxIdAtrEqu($idEqu["id"]);

			foreach ($idEqu["atributos"] as $iAtr) {
				list($idEq,$idatrEq,$idAtr) = explode("|",explode(":", $iAtr)[0]);
				if($idEq==-1){$idEq=$idEqu["id"];}
				if($idatrEq==0){$maxAtr++;$idatrEq=$maxAtr;} // --- incrementa IDAtrib para atributos nuevos
				$vAtr=explode(":",$iAtr)[1];
				
				if(strlen($vAtr)>0){
					$stSql="INSERT INTO `db_cid_inv`.`atributoequipo` (`atr_equ_id`,`atr_id`,`atr_tae_id`,`atr_atributo`) ".
							"VALUES (".$idEq.",".$idatrEq.",".$idAtr.",'".$vAtr."') ON DUPLICATE KEY UPDATE ".
							"`atr_tae_id`=".$idAtr.", `atr_atributo`=\"".$vAtr."\";";
					$this->access->conectar($stSql);
				}elseif($idatrEq>0){
					$stSql="DELETE FROM `db_cid_inv`.`atributoequipo` WHERE `atributoequipo`.`atr_equ_id`=".$idEq." AND `atributoequipo`.`atr_id`=".$idatrEq;
					$this->access->conectar($stSql);
				}
			}
		}
		return $idEqu["id"];
	}

	function saveObsEqu($idEq,$obs){
		if(strlen($obs)>5){
			
			$this->access->conectar("INSERT INTO `db_cid_inv`.`obsequipo` (`obsequ_equ_id`,`obsequ_usr_id`,`obsequ_observacion`) VALUES (".$idEq.",".$this->getUsr($idEq).",'".utf8_decode($obs)."')");
		}
	}

	function descEqu($idEq){
		$stSql="UPDATE `db_cid_inv`.`equipo` SET `equipo`.`equ_estado`=0 WHERE `equipo`.`equ_id`=".$idEq;
		$this->access->conectar($stSql);
	}


	//---------- Funciones complementarias ----------------

	function sqlReplace($txtSql,$iCampos){
		foreach ($iCampos as $iCmp=>$vCmp) {
			if(!is_array($vCmp))$txtSql=str_replace(":".$iCmp,$vCmp,$txtSql);}
		return $txtSql;
	}

	function maxIdEqu(){
		$this->access->conectar("SELECT MAX(equ_id) FROM db_cid_inv.equipo");
		return mysql_fetch_array($this->access->getResult())[0];
	}

 	function maxIdAtrEqu($idequ){
 		$this->access->conectar("SELECT MAX(`atributoequipo`.`atr_id`) AS MaxAtr FROM `db_cid_inv`.`atributoequipo` WHERE `atributoequipo`.`atr_equ_id`=".$idequ);
 		return mysql_fetch_array($this->access->getResult())[0];
 	}
 	function getUsr($idequ){
 		$this->access->conectar("SELECT prestamos.pre_usr_id FROM db_cid_inv.prestamos where prestamos.pre_equ_id=".$idequ." and prestamos.pre_fechadev is null");
 		$tusr=mysql_fetch_array($this->access->getResult())[0];
 		return isset($tusr) ? $tusr : "null";
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



?>