<?php

 class ConectorDB{
 	var $DBconect;
 	var $Result;
	var $ResultEject;
	var $ResultCamps;
	var $ResultlistContacts;
	var $ResultContacts;
 	var $Numreg;

 	function ConectorDB(){

		if(!($conn =  mysql_connect("localhost", "root", ""))){
			echo "Error al conectar a la base de datos";
			return false;
	    	exit();
		}

		mysql_select_db("db_cid_inv",$conn);
		$this->DBconect=$conn;
	}

	function conectar($query){
		//echo $query;
		$this->Result=mysql_query($query) or die("Error en: " . mysql_error().">>> ".$query);
	}

	
	function ejectSql($query){
		$this->ResultEject=odbc_exec($this->DBconect,$query);
	}

	function getConectar(){return $this->DBconect;}
	function getResult(){return $this->Result;}
	//function getnumReg(){return odbc_num_rows($this->Result);}
	
	function access($USR,$PASS){

		$stSql ="SELECT usuario.usr_id, usuario.usr_username, usuario.usr_password,usuario.usr_perf_id, perfiles.perf_nombre,
		 usuario.usr_nombres, usuario.usr_apellidos FROM usuario inner join perfiles ON (usuario.usr_perf_id=perfiles.perf_id)
		  WHERE usr_username='".$USR."' AND usr_password=md5('".$PASS."')";

		$this->conectar($stSql);
		//echo $tUsr;
		//if($tUsr["usr_password"]==$PASS){
		if(mysql_num_rows($this->getResult())==1){
			$tUsr= mysql_fetch_array($this->getResult(), MYSQL_ASSOC);
			$usr['login']=true;
			$usr['id']=$tUsr["usr_id"];
			//$usr['']=$tUsr["usr_password"];
			$usr["nombres"]=$tUsr["usr_nombres"];
			$usr["apellidos"]=$tUsr["usr_apellidos"];
			$usr['id_perf']=$tUsr["usr_perf_id"];
			$usr['perfil']=$tUsr["perf_nombre"];
		}else{$usr['login']=false;}
		return $usr;
	}
 }
?>
