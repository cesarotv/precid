<div class="iListTable">
<?php
if (!empty($_POST)){
include_once("../lib/conector.php");
}else{include_once("lib/conector.php");}

	$access=new ConectorDB;

	$stSql="SELECT equipo.equ_id, tipoequipo.tequ_nombre, equipo.equ_marca, equipo.equ_modelo, prestamos.pre_usr_id,usuario.usr_nombres,usuario.usr_apellidos FROM ((db_cid_inv.equipo join db_cid_inv.tipoequipo on equipo.equ_teq_id=tipoequipo.tequ_id and equipo.equ_estado =1) left join db_cid_inv.prestamos on equipo.equ_id=prestamos.pre_equ_id and prestamos.pre_fechadev is null)left join db_cid_inv.usuario on usuario.usr_id=prestamos.pre_usr_id ";

	if (!empty($_POST["txtEqu"])){
		$stSql=$stSql."where equipo.equ_id in ( SELECT equipo.equ_id FROM db_cid_inv.equipo,db_cid_inv.tipoequipo where equipo.equ_teq_id=tipoequipo.tequ_id and concat(tipoequipo.tequ_nombre, ' ', equipo.equ_cod, ' ', equipo.equ_marca, ' ', equipo.equ_modelo, ' ', equipo.equ_serial, ' ', usuario.usr_nombres, ' ', usuario.usr_apellidos) like '%".utf8_decode($_POST["txtEqu"])."%')";
	}

	$access->conectar($stSql);

	while($row=mysql_fetch_array($access->getResult())){
		if($row["pre_usr_id"]){
			$Colp="<span class=\"iprest\">Prestado a ".utf8_encode($row["usr_nombres"]." ". $row["usr_apellidos"])."</span>";
		}else{$Colp="<span class=\"iDisp\">disponible</span>";}

		echo "<div id=il.".$row["equ_id"]." class='iList' onclick=\"javascript:vDetalle(this.id.split('.')[1],'conRegistro');\">".
				"<span class='colList'>".
				 	"<span class='iequ_tipo'>".utf8_encode($row["tequ_nombre"])."</span>".
				 	"<span style=\"display:inline-block;\">".
				 		"<span class='iequ_id'>ID: ".$row["equ_id"]."</span>".
				 		"<div class='iequ_marca'>".utf8_encode($row["equ_marca"]." ".$row["equ_modelo"])."</div> ".
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