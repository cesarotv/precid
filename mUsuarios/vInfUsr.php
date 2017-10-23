
<?php 
if (!empty($_POST)){include_once("../lib/objUsuario.php");
		$iUsuario=new classUsuario();
		$iUsuario->diUsuario($_POST["usr_id"]);
?>

<div>
	<div id="vMenu">
		<span id="edUsr" title="Editar" onclick="javascript:editDlle('conRegistro','e');">
			<img src="../imgs/lEditar.png"/></span>
		<span id="nUsr" title="Nuevo" onclick="javascript:nUsr();">
			<img src="../imgs/lNuevo.png"/></span>
		<span id="gUsr" title="Guardar" onclick="javascript:saveDlle();" style="display:none;">
			<img src="../imgs/lGuardar.png"/></span>
		<span id="cUsr" title="Cancelar" onclick="javascript:editDlle('conRegistro','c'); " style="display:none;">
			<img src="../imgs/lCancel.png"/></span>
	</div>
	<input class="idElem" id="usr_id" value="<?php echo $iUsuario->id;?>" style="display:none;" />
	<div class="nombreUsr">
		<div class="iDat v">
			<span><?php echo utf8_encode($iUsuario->nombres)." ".utf8_encode($iUsuario->apellidos);?></span>
			<div>
				<input id="usr_nombres" class="ieDat" value="<?php echo utf8_encode($iUsuario->nombres);?>"/>
				<input id="usr_apellidos" class="ieDat" value="<?php echo utf8_encode($iUsuario->apellidos);?>"/>
			</div>
		</div>
	</div>
	<div class="nDatos">
		<div class="iDat v">
			<div class="vpDats">
				<span class="vProceso"><?php echo utf8_encode("(".$iUsuario->sigla_proceso.") ".$iUsuario->nom_proceso);?></span><br>
				<span class="vEstado">Usuario <?php echo utf8_encode($iUsuario->nomEstado);?></span>
			</div>
		
			<div class='epDats'>
				<div class='irDat'>
					<span class='tDat'><b>Proceso:</b></span>
					<span class='vDat'><select id="usr_pro_id" class="tipoElem"><option></option><?php echo utf8_encode($iUsuario->selProc($iUsuario->id_proceso)); ?></select></span>
				</div>
				<div class='irDat'>
					<span class='tDat'><b>Estado:</b></span>
					<span class='vDat'><select id="usr_estado" class="tipoElem"><?php echo utf8_encode($iUsuario->selEstado($iUsuario->estado)); ?></select></span>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 

}else{
?>
	<div align="center" style="center;padding: 0px;"><img src="../imgs/logoIni.png"/></div>
<?php
}
?>