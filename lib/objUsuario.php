<?php
if (!empty($_POST)){include_once("../lib/conector.php");
}else{include_once("/lib/conector.php");}

 class classUsuario{

 	var $access;
 	var $id="";
 	var $nombres="";
 	var $apellidos="";
 	var $estado="";
 	var $nomEstado="";
 	var $id_proceso="";
 	var $sigla_proceso="";
 	var $nom_proceso="";
 	var $username="";
 	var $pass="";
 	
 	var $nestados=array(1=>"Activo",0=>"Inactivo");

 	function classUsuario(){$this->access=new ConectorDB;}

 	function diUsuario($tID){

 		$this->id=$tID;
 		if(!($tID<=0)){

			$this->access->conectar("SELECT usuario.* , proceso.pro_sigla, proceso.pro_nombre FROM db_cid_inv.usuario,db_cid_inv.proceso where usuario.usr_pro_id=proceso.pro_id AND usuario.usr_id=".$tID.";");

			$tdEqu= mysql_fetch_array($this->access->getResult(), MYSQL_ASSOC);

			$this->nombres=$tdEqu["usr_nombres"];
			$this->apellidos=$tdEqu["usr_apellidos"];
			$this->estado=$tdEqu["usr_estado"];
			$this->nomEstado=$this->nestados[$this->estado];
			$this->id_proceso=$tdEqu["usr_pro_id"];
			$this->sigla_proceso=$tdEqu["pro_sigla"];
			$this->nom_proceso=$tdEqu["pro_nombre"];
			$this->username=$tdEqu["usr_username"];
			$this->pass=$tdEqu["usr_password"];
		}
 	}

 	 function iUsr(){
 		$this->access=new ConectorDB;
		$this->access->conectar("SELECT usuario.usr_id, usuario.usr_nombres, usuario.usr_apellidos FROM db_cid_inv.usuario");
		$tmp="";
		while ($row=mysql_fetch_array($this->access->getResult())){
			$tmp=$tmp."<option value=\"".$row["usr_id"]."\" >".$row["usr_nombres"]." ".$row["usr_apellidos"]."</option>";}
		return $tmp;
	}

	function uiSelUsr($tBqu){
 		$this->access=new ConectorDB;
		$this->access->conectar("SELECT usuario.usr_id, usuario.usr_nombres, usuario.usr_apellidos FROM db_cid_inv.usuario where concat(usuario.usr_nombres,' ', usuario.usr_apellidos) like '%".$tBqu."%'");
		$tmp="";$op=0;
		while ($row=mysql_fetch_array($this->access->getResult())){
			$tmp=$tmp."<li id=\"".$row["usr_id"]."\" data-id=\"".$op."\" >".$row["usr_nombres"]." ".$row["usr_apellidos"]."</li>";$op++;}
		return $tmp;
	}

 	function selProc($iProc){
 		$this->access=new ConectorDB;
		$this->access->conectar("SELECT * FROM `db_cid_inv`.`proceso`;");
		$tmp="";
		while ($row=mysql_fetch_array($this->access->getResult())){
			if ($row["pro_id"]==$iProc){$tsel=" selected ";}else{$tsel="";}
			$tmp=$tmp."<option value=\"".$row["pro_id"]."\" ".$tsel.">(".$row["pro_sigla"].") ".$row["pro_nombre"]."</option>";}
		return $tmp;
	}

	 function selEstado($iEst){
	 	$tmp="";
	 	foreach ($this->nestados as $i => $estado) {
	 		if ($i==$iEst){$tsel=" selected ";}else{$tsel="";}
			$tmp=$tmp."<option value=\"".$i."\" ".$tsel.">".$estado."</option>";
		}	
		return $tmp;
	}


	function saveUsr($iUsr){$this->access=new ConectorDB;
		if($iUsr["idUsr"]==0){
			$iUsr["idUsr"] = $this->maxIdUsr()+1;
			$stSql="INSERT INTO `db_cid_inv`.`usuario` (`usr_id`,`usr_nombres`,`usr_apellidos`,`usr_estado`,`usr_pro_id`,`usr_username`)".
					"VALUES (:idUsr,':nombres',':apellidos',:estado,:idProceso,':username')";
			$stSql=$this->sqlReplace($stSql,$iUsr);
			$this->access->conectar($stSql);

		}else{
			$stSql="UPDATE `db_cid_inv`.`usuario` SET `usr_id` = :idUsr, `usr_nombres` = ':nombres', `usr_apellidos` = ':apellidos',`usr_estado` = :estado,`usr_pro_id` = :idProceso, `usr_username` = ':username' WHERE `usr_id` = :idUsr";
			$stSql=$this->sqlReplace($stSql,$iUsr);
			$this->access->conectar($stSql);
		}
		return $iUsr["idUsr"];
	}
/*
	function saveObsEqu($idEq,$obs){
		if(strlen($obs)>5){
			$this->access->conectar("INSERT INTO `db_cid_inv`.`obsequipo` (`obsequ_equ_id`,`obsequ_observacion`) VALUES (".$idEq.",'".utf8_decode($obs)."')");
		}
	}

	function descEqu($idEq){
		$stSql="UPDATE `db_cid_inv`.`equipo` SET `equipo`.`equ_estado`=0 WHERE `equipo`.`equ_id`=".$idEq;
		$this->access->conectar($stSql);
	}

*/
	//---------- Funciones complementarias ----------------

	function sqlReplace($txtSql,$iCampos){
		foreach ($iCampos as $iCmp=>$vCmp) {
			if(!is_array($vCmp))$txtSql=str_replace(":".$iCmp,utf8_decode($vCmp),$txtSql);}
		return $txtSql;
	}

	function maxIdUsr(){
		$this->access->conectar("SELECT MAX(usr_id) FROM db_cid_inv.usuario");
		return mysql_fetch_array($this->access->getResult())[0];
	}


 }



?>