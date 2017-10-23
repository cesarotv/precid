<div class="iListTable">
<?php
if (!empty($_POST)){
include_once("../lib/conector.php");
}else{include_once("lib/conector.php");}

	$access=new ConectorDB;

	$stSql="SELECT usuario.* , proceso.pro_nombre FROM db_cid_inv.usuario,db_cid_inv.proceso where usuario.usr_pro_id=proceso.pro_id ";
	if (!empty($_POST["txtUsr"])){
		$stSql=$stSql."and usuario.usr_id in ( SELECT usuario.usr_id FROM db_cid_inv.usuario, db_cid_inv.proceso where usuario.usr_pro_id=proceso.pro_id and concat(usuario.usr_nombres,' ', usuario.usr_apellidos,' ', proceso.pro_nombre)
		    like '%".utf8_decode($_POST["txtUsr"])."%')";
	}


	$access->conectar($stSql);

	while($row=mysql_fetch_array($access->getResult())){
		echo "<div id=il.".$row["usr_id"]." class='iList' onclick=\"javascript:vDetalle(this.id.split('.')[1],'conRegistro');\">".
				"<span class='colList'>".
			 		"<span class='nomUsr'><span>".utf8_encode($row["usr_nombres"])." ".utf8_encode($row["usr_apellidos"])."</span></span>".
			 	"</span>".
			 	"<span class='colList'>".
			 		"<span class='nproceso'><span>".utf8_encode($row["pro_nombre"])."</span></span>".
			 	"</span>".
			 "</div>";
	}
?>
</div>