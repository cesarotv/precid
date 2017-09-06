<?php
	include_once("lib/conector.php");
	$access=new ConectorDB;

	$access->conectar("SELECT equipo.equ_id, tipoequipo.tequ_nombre, equipo.equ_marca, equipo.equ_modelo FROM equipo, tipoequipo WHERE equipo.equ_teq_id=tipoequipo.tequ_id;");

?>

<div class="contMod">
	<div id="conListado">
		<div>
<?php
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
		</div>
	</div>
	<div id="conRegistro">
		<?php	include_once("mEquipos/vDetalle.php"); ?>
	</div>
</div>