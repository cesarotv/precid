<?php
if (!empty($_POST)){
include_once("../lib/conector.php");
}//else{include_once("../lib/conector.php");}


class classPrestamo{

	var $usr_id;
	var $equ_id;
	var $fecha;
	var $tipo;
	var $fechaprog;
	var $fechadev;

	var $ntipo=array(1=>"Interno",0=>"Externo");

	function classPrestamo(){$this->access=new ConectorDB;}

	function presEquipo($datsPres){
		$stSql="INSERT INTO `db_cid_inv`.`prestamos` (`pre_usr_id`, `pre_equ_id`, `pre_tipo`, `pre_fechaprogdev`) VALUES (:usr_id, :equ_id, :pre_tipo, STR_TO_DATE(':pre_progdev', '%d/%m/%Y'))";
			$stSql=$this->sqlReplace($stSql,$datsPres);
			$this->access->conectar($stSql);
		return $datsPres["equ_id"];
		
	}
	function DevEquipo($datsPres){
		$stSql="UPDATE `db_cid_inv`.`prestamos` SET `pre_fechadev` = CURRENT_TIMESTAMP WHERE `pre_equ_id` = :equ_id AND `pre_fechadev` is null";
			$stSql=$this->sqlReplace($stSql,$datsPres);
			$this->access->conectar($stSql);
		//return $stSql;
		return $datsPres["equ_id"];

	}

	//---------- Funciones complementarias ----------------

	function sqlReplace($txtSql,$iCampos){
		foreach ($iCampos as $iCmp=>$vCmp) {
			if(!is_array($vCmp))$txtSql=str_replace(":".$iCmp,$vCmp,$txtSql);}
		return $txtSql;
	}


 }

?>