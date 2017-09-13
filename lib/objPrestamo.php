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

	function classPrestamo(){$this->access=new ConectorDB;}

	function presEquipo($tID){
		
	}


 }

?>