<div class="iListTable">
<?php
if (!empty($_POST)){
include_once("../lib/conector.php");
}else{include_once("lib/conector.php");}

	$access=new ConectorDB;
	$stSql="";

	if (!empty($_POST["txtEqu"])){
		$stSql="where equipo.equ_id in ( SELECT equipo.equ_id FROM db_cid_inv.equipo,db_cid_inv.tipoequipo where equipo.equ_teq_id=tipoequipo.tequ_id and concat(tipoequipo.tequ_nombre, ' ', equipo.equ_cod, ' ', equipo.equ_marca, ' ', equipo.equ_modelo, ' ', equipo.equ_serial) like '%".utf8_decode($_POST["txtEqu"])."%')";
	}

	$stSql="SELECT equipo.equ_id, tipoequipo.tequ_nombre, equipo.equ_marca, equipo.equ_modelo,equipo.equ_cod, prestamos.pre_usr_id,usuario.usr_nombres,usuario.usr_apellidos, DATE_FORMAT(prestamos.pre_fechaprogdev,'%d/%m/%Y') AS pre_fechaprogdev FROM ((db_cid_inv.equipo join db_cid_inv.tipoequipo on equipo.equ_teq_id=tipoequipo.tequ_id and equipo.equ_estado =1) left join db_cid_inv.prestamos on equipo.equ_id=prestamos.pre_equ_id and prestamos.pre_fechadev is null)left join db_cid_inv.usuario on usuario.usr_id=prestamos.pre_usr_id ".$stSql." order by prestamos.pre_fechaprogdev desc ";

	$access->conectar($stSql);

	while($row=mysql_fetch_array($access->getResult())){
		if($row["pre_usr_id"]){
			$Colp="<div class=\"iprest\" style=\"text-overflow: ellipsis;overflow:hidden;white-space: nowrap; max-width:250px;\"><span class='fechadev'>".utf8_encode($row["pre_fechaprogdev"])." &#187;</span>  ".utf8_encode($row["usr_nombres"]." ". $row["usr_apellidos"])."</div>";


		}else{$Colp="";}

		echo "<div id=il.".$row["equ_id"]." class='iList' onclick=\"javascript:vDetalle(this.id.split('.')[1],'conRegistro',this);\">".
				"<span class='colList'>".
				 	"<span>".
				 		"<span class='iequ_id'>".$row["equ_cod"]."</span>".
				 	"</span>".
				 "</span>".
				 "<span class='colList'>".
					"<div style=\"text-overflow: ellipsis;overflow:hidden;white-space: nowrap; max-width:140px;\" >".
				 		"<span class='iequ_tipo'>".utf8_encode($row["tequ_nombre"])."</span>".
				 		"<span class='iequ_marca'>".utf8_encode($row["equ_marca"]." ".$row["equ_modelo"])."</span> ".
				 	"</div>".	
				 "</span>".
				 "<span class='colList' >".$Colp.
				 "</span>".		 
			 "</div>";
	}
?>

</div>