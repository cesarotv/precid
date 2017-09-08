
<?php
if (!empty($_POST)){
include_once("../lib/conector.php");
}else{include_once("lib/conector.php");}

	$access=new ConectorDB;

	$stSql="SELECT equipo.equ_id, tipoequipo.tequ_nombre, equipo.equ_marca, equipo.equ_modelo FROM equipo, tipoequipo WHERE equipo.equ_teq_id=tipoequipo.tequ_id and equipo.equ_estado =1 ";

	if (!empty($_POST["txtEqu"])){
		$stSql=$stSql."and equipo.equ_id in ( SELECT equipo.equ_id FROM db_cid_inv.equipo,db_cid_inv.tipoequipo where equipo.equ_teq_id=tipoequipo.tequ_id and concat(tipoequipo.tequ_nombre, ' ', equipo.equ_cod, ' ', equipo.equ_marca, ' ', equipo.equ_modelo, ' ', equipo.equ_serial) like '%".utf8_decode($_POST["txtEqu"])."%')";
	}



	$access->conectar($stSql);

	while($row=mysql_fetch_array($access->getResult())){
		echo "<div id=il.".$row["equ_id"]." class='iElemList' onclick=\"javascript:vDetalle(this.id.split('.')[1],'conRegistro');\">".
			 "<span class='tipoElem'>".utf8_encode($row["tequ_nombre"])."</span>".
			 "<span class='marcaElem'>".utf8_encode($row["equ_marca"])."</span>".
			 "<span class='modeloElem'>".$row["equ_modelo"]."</span>".
			 "<span class='serialElem'>ID: ".$row["equ_id"]."</span>".
			 "</div>";
	}
?>
			<div class="iElemList">asdfasdfasdf</div>
			<div class="iElemList">adsfasdfasdf</div>
			<div class="iElemList">asdfasdfasdf</div>
			<div class="iElemList">adsfasdfasdf</div>
			<div class="iElemList">asdfasdfasdf</div>
			<div class="iElemList">adsfasdfasdf</div>
			<div class="iElemList">asdfasdfasdf</div>
			<div class="iElemList">adsfasdfasdf</div>
			<div class="iElemList">asdfasdfasdf</div>
			<div class="iElemList">adsfasdfasdf</div>
			<div class="iElemList">asdfasdfasdf</div>
			<div class="iElemList">adsfasdfasdf</div>
			<div class="iElemList">asdfasdfasdf</div>
			<div class="iElemList">asdfasdfasdf</div>
			<div class="iElemList">adsfasdfasdf</div>
			<div class="iElemList">asdfasdfasdf</div>
			<div class="iElemList">adsfasdfasdf</div>
			<div class="iElemList">asdfasdfasdf</div>
			<div class="iElemList">adsfasdfasdf</div>
			<div class="iElemList">asdfasdfasdf</div>
			<div class="iElemList">adsfasdfasdf</div>
			<div class="iElemList">asdfasdfasdf</div>
			<div class="iElemList">adsfasdfasdf</div>
			<div class="iElemList">asdfasdfasdf</div>
			<div class="iElemList">asdfasdfasdf</div>
			<div class="iElemList">asdfasdfasdf</div>
			<div class="iElemList">adsfasdfasdf</div>
			<div class="iElemList">asdfasdfasdf</div>
			<div class="iElemList">adsfasdfasdf</div>
			<div class="iElemList">asdfasdfasdf</div>
			<div class="iElemList">adsfasdfasdf</div>
			<div class="iElemList">asdfasdfasdf</div>
			<div class="iElemList">adsfasdfasdf</div>
			<div class="iElemList">asdfasdfasdf</div>
			<div class="iElemList">adsfasdfasdf</div>
			<div class="iElemList">asdfasdfasdfadfasdfasdfasdfasdfasd</div>