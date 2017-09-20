<div class="iListTable">
<?php
if (!empty($_POST)){
include_once("../lib/conector.php");
}else{include_once("lib/conector.php");}

	$access=new ConectorDB;

	$stSql="SELECT usuario.usr_nombres, usuario.usr_apellidos, prestamos.*, equipo.*, tipoequipo.tequ_nombre FROM db_cid_inv.prestamos, db_cid_inv.usuario,db_cid_inv.equipo,db_cid_inv.tipoequipo
WHERE (prestamos.pre_usr_id=usuario.usr_id AND equipo.equ_id=prestamos.pre_equ_id AND tipoequipo.tequ_id=equipo.equ_id) ";

	if (!empty($_POST["txtPrest"])){
		$stSql=$stSql."AND concat(usuario.usr_nombres,' ', usuario.usr_apellidos,' ',equipo.equ_cod,' ',equipo.equ_marca,' ',equipo.equ_modelo,' ', equipo.equ_serial,' ',tipoequipo.tequ_nombre) like '%".utf8_decode($_POST["txtPrest"])."%'";
	}

	$access->conectar($stSql);

	while($row=mysql_fetch_array($access->getResult())){
		if($row["pre_usr_id"]){
			$Colp="<span class=\"iprest\">Prestado a ".utf8_encode($row["usr_nombres"]." ". $row["usr_apellidos"])."</span>";
		}else{$Colp="<span class=\"iDisp\">disponible</span>";}

		//----------------------------------

		echo "<div id=il class='iList' onclick=\"javascript:;\">".
				"<span class='colList'>".
				 	"<span class='iequ_tipo'>".utf8_encode($row["tequ_nombre"])."</span>".
				 	"<span style=\"display:inline-block;\">".
				 		"<div class='iequ_marca'>".utf8_encode($row["equ_marca"]." ".$row["equ_modelo"])."</div> ".
				 		"<span class='iequ_id'>ID: ".$row["equ_id"]."</span>".
				 	"</span>".
				 "</span>".
				 "<span class='colList'>".$Colp.
				 "</span>".		 
			 "</div>";
	}
?>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
			<div class="iList"><span class='colList'>asdfasdfasdf</span><span class='colList'>asdfasdfasdf</span></div>
</div>