<div class="iListTable">
<?php
if (!empty($_POST)){
include_once("../lib/conector.php");
}else{include_once("lib/conector.php");}

	$access=new ConectorDB;

	$stSql="SELECT usuario.usr_nombres, usuario.usr_apellidos, prestamos.pre_usr_id, prestamos.pre_equ_id,DATE_FORMAT(prestamos.pre_fecha,'%d/%m/%Y %h:%i %p ') as pre_fecha, prestamos.pre_tipo, DATE_FORMAT(prestamos.pre_fechaprogdev,'%d/%m/%Y') as fechaprogdev,DATE_FORMAT(prestamos.pre_fechadev,'%d/%m/%Y %h:%i %p') as pre_fechadev, equipo.*, tipoequipo.tequ_nombre, prestamos.pre_fecha as vpre_fecha FROM db_cid_inv.prestamos, db_cid_inv.usuario,db_cid_inv.equipo,db_cid_inv.tipoequipo
WHERE (prestamos.pre_usr_id=usuario.usr_id AND equipo.equ_id=prestamos.pre_equ_id AND tipoequipo.tequ_id=equipo.equ_teq_id) ";

	if (!empty($_POST["txtPrest"])){
		$stSql=$stSql."AND concat(usuario.usr_nombres,' ', usuario.usr_apellidos,' ',equipo.equ_cod,' ',equipo.equ_marca,' ',equipo.equ_modelo,' ', equipo.equ_serial,' ',tipoequipo.tequ_nombre) like '%".utf8_decode($_POST["txtPrest"])."%' ";
	}

	$stSql=$stSql." order by pre_fechadev IS NULL desc,pre_fechadev desc";

	$access->conectar($stSql);

	while($row=mysql_fetch_array($access->getResult())){

		$iDev="";
		if($row["pre_fechadev"]){
			$iDev="<a class='dev'>&#9664 </a><span>".$row["pre_fechadev"]."</span>";
		}else{
			$iDev="<a class='pen'>&#9665 </a><span style='color:#ff0000;font-weight: bold;'>".$row["fechaprogdev"]."</span>";}


		//----------------------------------

		echo "<div id='li.".$row["pre_equ_id"].".".$row["vpre_fecha"]."' class='iList' onclick=\"javascript:vDetalle(this.id,'conRegistro');\">".
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
				 "<span class='colList'>0".
				 "</span>".
				 "<span class='colList'>".
				 	"<div class=\"iprest\"><a class='pre'>&#9654; </a>".utf8_encode($row["usr_nombres"]." ". $row["usr_apellidos"])."</div>".
				 "</span>".
				 "<span class='colList'>".
				 	
				 	"<div class='ifecha'>".$iDev."</div>".
				 "</span>".	 
			 "</div>";
	}
?>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>

</div>