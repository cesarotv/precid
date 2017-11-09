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
	
	//function getResultCamps(){return $this->ResultCamps;}

	
	/*function genlCont($ID){
			$stSql ="SELECT CodList, NomLista FROM TablaCampListas WHERE (ID='".$ID."');";
			$this->ResultlistContacts= odbc_exec($this->DBconect,$stSql);
	}
	function getResultlCont(){return $this->ResultlistContacts;}*/
	
	/*function genContacts($ID){
			
			$this->ResultContacts= odbc_exec($this->DBconect,$stSql);
	}
	function getResultContacts(){return $this->ResultContacts;}

	function getContacto($ID){
			$stSql ="SELECT * FROM TablaContactos WHERE ID='".$ID."'";
			$this->conectar($stSql);
			$contacto = odbc_fetch_array($this->getResult());
			return $contacto;
	}

	function genCamps($ID){
			$stSql ="SELECT TablaCamp.IDCamp, TablaCamp.ASUNTO, TablaCamp.ID FROM TablaCamp WHERE (ID='".$ID."');";
			$this->ResultCamps= odbc_exec($this->DBconect,$stSql);
	}
	*/


	function access($USR,$PASS){

		$stSql ="SELECT usuario.usr_id, usuario.usr_username, usuario.usr_password, usuario.usr_nombres, usuario.usr_apellidos FROM usuario WHERE usr_username='".$USR."' AND usr_password=md5('".$PASS."')";

		$this->conectar($stSql);
		//echo $tUsr;
		//if($tUsr["usr_password"]==$PASS){
		if(mysql_num_rows($this->getResult())==1){
			$tUsr= mysql_fetch_array($this->getResult(), MYSQL_ASSOC);
			$usr[0]=true;
			$usr[1]=$tUsr["usr_id"];
			$usr[2]=$tUsr["usr_password"];
			$usr[3]=$tUsr["usr_nombres"]." ".$tUsr["usr_apellidos"];			
		}else{$usr[0]=false;}
		return $usr;
	}
 }
?>
