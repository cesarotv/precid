<?php
if (!empty($_POST)){
include_once("../lib/conector.php");
}else{include_once("lib/conector.php");}


class classPrestamo{

	var $usr_id;
	var $equ_id;
	var $fecha;
	var $tipo;
	var $fechaprog;
	var $fechadev;

	var $ntipo=array(1=>"Interno",0=>"Externo");

	var $obs = array();

	function classPrestamo(){$this->access=new ConectorDB;}

	function getPermisos($idUsr,$tDato){
		$stSql ="SELECT tipoinformacion.tInf_nombre,perm_A,perm_E,perm_D FROM db_cid_inv.permisos inner join db_cid_inv.tipoinformacion on (permisos.perm_tInf_id=tipoinformacion.tInf_id) WHERE perm_perf_id=".$idUsr." AND perm_tInf_id=".$tDato;
		$this->access->conectar($stSql);
		
		return mysql_fetch_array($this->access->getResult(), MYSQL_ASSOC);
	}


	function presEquipo($datsPres){

		$stSql="INSERT INTO `db_cid_inv`.`prestamos` (`pre_usr_id`, `pre_equ_id`, `pre_tipo`, `pre_fechaprogdev`,`pre_pre_usr_id`) VALUES (:usr_id, :equ_id, :pre_tipo,':pre_progdev',:usr_login)";
			$stSql=$this->sqlReplace($stSql,$datsPres);
			$this->access->conectar($stSql);
		//return $datsPres["equ_id"];
	}
	
	function reprogDevEquipo($datsPres){
		$stSql="UPDATE `db_cid_inv`.`prestamos` SET `pre_fechaProgDev` = ':pre_fechaProgDev' WHERE `pre_equ_id` = :equ_id AND `pre_fechadev` is null";
			$stSql=$this->sqlReplace($stSql,$datsPres);
			$this->access->conectar($stSql);
		//return $stSql;
		return $datsPres["equ_id"];
	}

	function DevEquipo($datsPres){
		$stSql="UPDATE `db_cid_inv`.`prestamos` SET `pre_fechadev` = CURRENT_TIMESTAMP, `pre_dev_usr_id` = :usr_login WHERE `pre_equ_id` = :equ_id AND `pre_fechadev` is null";
			$stSql=$this->sqlReplace($stSql,$datsPres);
			$this->access->conectar($stSql);
		//return $stSql;
		return $datsPres["equ_id"];

	}

	function infPrest($idEqu,$fPrest){
		$stSql="SELECT * FROM db_cid_inv.prestamos where pre_equ_id=".$idEqu." and pre_fecha='".$fPrest."'";
		$this->access->conectar($stSql);
		$fDev=mysql_fetch_array($this->access->getResult())["pre_fechadev"];

		$stSql="SELECT obsequipo.*, `usuario`.usr_nombres, `usuario`.usr_apellidos FROM db_cid_inv.obsequipo 
			left join db_cid_inv.`usuario` on `obsequipo`.obsequ_usr_id= `usuario`.usr_id  where obsequ_equ_id=".$idEqu.
				" AND obsequipo.obsequ_fecha between '".$fPrest."' and ";
		$stSql=(empty($fDev))? $stSql."now()" : $stSql."'".$fDev."'";
		$this->access->conectar($stSql);

		while ($row=mysql_fetch_array($this->access->getResult())){$this->obs[] = $row;}
		
		//return $stSql.">>".count($this->obs);
	}


	//---------- Funciones complementarias ----------------

	function sqlReplace($txtSql,$iCampos){
		foreach ($iCampos as $iCmp=>$vCmp) {
			if(!is_array($vCmp))$txtSql=str_replace(":".$iCmp,$vCmp,$txtSql);}
		return $txtSql;
	}


 }

?>