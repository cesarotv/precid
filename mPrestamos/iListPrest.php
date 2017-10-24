
<?php
if (!empty($_POST)){
include_once("../lib/conector.php");
}else{include_once("lib/conector.php");}

if (empty($_POST["rPag"])){$_POST["rPag"]=0;}

	$access=new ConectorDB;
	$stSql="";

	if (!empty($_POST["txtPrest"])){
		$stSql="AND concat(usuario.usr_nombres,' ', usuario.usr_apellidos,' ',equipo.equ_cod,' ',equipo.equ_marca,' ',equipo.equ_modelo,' ', equipo.equ_serial,' ',tipoequipo.tequ_nombre) like '%".utf8_decode($_POST["txtPrest"])."%' ";
	}

	$stSql="SELECT usuario.usr_nombres, usuario.usr_apellidos, prestamos.pre_usr_id, prestamos.pre_equ_id,
			DATE_FORMAT(prestamos.pre_fecha,'%d/%m/%Y %h:%i %p ') as pre_fecha, prestamos.pre_tipo, 
			DATE_FORMAT(prestamos.pre_fechaprogdev,'%d/%m/%Y') as fechaprogdev,
			DATE_FORMAT(prestamos.pre_fechadev,'%d/%m/%Y %h:%i %p') as pre_fechadev,
			equipo.*, tipoequipo.tequ_nombre, prestamos.pre_fecha as vpre_fecha,
 			(Select count(*) FROM db_cid_inv.obsequipo WHERE obsequipo.obsequ_equ_id=prestamos.pre_equ_id AND
    			IF(prestamos.pre_fechadev IS NULL, obsequipo.obsequ_fecha>prestamos.pre_fecha, obsequipo.obsequ_fecha BETWEEN prestamos.pre_fecha AND prestamos.pre_fechadev)) AS nObs
			FROM db_cid_inv.prestamos, db_cid_inv.usuario,db_cid_inv.equipo,db_cid_inv.tipoequipo
WHERE (prestamos.pre_usr_id=usuario.usr_id AND equipo.equ_id=prestamos.pre_equ_id 
	AND tipoequipo.tequ_id=equipo.equ_teq_id) ".$stSql." order by FIELD (prestamos.pre_fechadev, NULL) desc, prestamos.pre_fecha DESC limit 25 offset ".$_POST["rPag"];
	

	$access->conectar($stSql);

	while($row=mysql_fetch_array($access->getResult())){

		$iDev="";
		if($row["pre_fechadev"]){
			$iDev="<a class='dev'>&#9664 </a><span>".$row["pre_fechadev"]."</span>";
		}else{
			$iDev="<a class='pen'>&#9665 </a><span style='color:#ff0000;font-weight: bold;'>".$row["fechaprogdev"]."</span>";}


		//----------------------------------

		echo "<div id='li.".$row["pre_equ_id"].".".str_replace(" ","_",$row["vpre_fecha"])."' class='iList' onclick=\"javascript:vDetalle(this.id,'conRegistro');\">".
				"<span class='colList'>".
					"<span class='ifecha'>".$row["pre_fecha"]."</span>".
				"</span>".
				"<span class='colList'>".
				 	"<span>".
				 		"<span class='iequ_id'>".$row["equ_cod"]." </span>".				 	
				 			"<span class='iequ_tipo'>&#187; ".utf8_encode($row["tequ_nombre"])."</span>".
				 			"<span class='iequ_marca'>".utf8_encode($row["equ_marca"]." ".$row["equ_modelo"])."</span>".

				 	"</span>".
				 "</span>".
				 "<span class='colList'><img src=\"../imgs/numObs.png\"/><b class=\"nObs\">".utf8_encode($row["nObs"])."</span>".
				 "</b>".
				 "<span class='colList'>".
				 	"<div class=\"iprest\"><a class='pre'>&#9654; </a>".utf8_encode($row["usr_nombres"]." ". $row["usr_apellidos"])."</div>".
				 "</span>".
				 "<span class='colList'>".
				 	
				 	"<div class='ifecha'>".$iDev."</div>".
				 "</span>". 
			 "</div>".
			 "<div class='iListcontObs'>".
			 	"<div id='obs.li.".$row["pre_equ_id"].".".str_replace(" ","_",$row["vpre_fecha"])."' class='iListObs' style='height: 0px;' >".
				"<div class=\"icontnObs\"></div></div>".	
			 "</div>"; 
	}
?>			