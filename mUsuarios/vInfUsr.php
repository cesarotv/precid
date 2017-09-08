
<?php 
if (!empty($_POST)){include_once("../lib/objUsuario.php");
	}else{include_once("lib/objUsuario.php");$_POST["usr_id"]=-1;}

		$iUsuario=new classUsuario();
		$iUsuario->diUsuario($_POST["usr_id"]);
?>

<div>
	<div id="vMenu">
		<span id="edUsr" onclick="javascript:editDlle('conRegistro','e');"> [Editar] </span>
		<span id="nUsr" onclick="javascript:nUsr();"> [Nuevo] </span>
		<span id="gUsr" onclick="javascript:saveDlle();" style="display:none;"> [Guardar] </span>
		<span id="cUsr" onclick="javascript:editDlle('conRegistro','c'); " style="display:none;"> [Cancelar] </span>
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
				<b>Proceso:</b><span><?php echo utf8_encode("(".$iUsuario->sigla_proceso.") ".$iUsuario->nom_proceso);?></span><br>
				<b>Usuario:</b><span><?php echo utf8_encode($iUsuario->username);?></span><br>
				<b>Estado:</b><span><?php echo utf8_encode($iUsuario->nomEstado);?></span>
			</div>
		
			<div class='epDats'>
				<div class='irDat'>
					<span class='tDat'><b>Proceso:</b></span>
					<span class='vDat'><select id="usr_pro_id" class="tipoElem"><option></option><?php echo utf8_encode($iUsuario->selProc($iUsuario->id_proceso)); ?></select></span>
				</div>
				<div class='irDat'>
					<span class='tDat'><b>Usuario:</b></span>
					<span class='vDat'><input id="usr_username" class="ieDat" value="<?php echo utf8_encode($iUsuario->username);?>"/></span>
				</div>
				<div class='irDat'>
					<span class='tDat'><b>Estado:</b></span>
					<span class='vDat'><select id="usr_estado" class="tipoElem"><?php echo utf8_encode($iUsuario->selEstado($iUsuario->estado)); ?></select></span>
				</div>
			</div>
		</div>
	</div>


</div>