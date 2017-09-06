
<?php 
if (!empty($_POST)){include_once("../lib/objequipo.php");
	}else{include_once("lib/objequipo.php");$_POST["equ_id"]=-1;}

		$iEquipo=new classEquipo();
		$iEquipo->diEquipo($_POST["equ_id"]);

?>
		<div>
			<div id="vMenu">
				<span id="edEqu" onclick="javascript:editDlle('conRegistro','e');"> [Editar] </span>
				<span id="nEqu" onclick="javascript:nDlle();"> [Nuevo] </span>
				<span id="gEqu" onclick="javascript:saveDlle();" style="display:none;"> [Guardar] </span>
				<span id="cEqu" onclick="javascript:editDlle('conRegistro','c'); " style="display:none;"> [Cancelar] </span>
			</div>
			<input class="idElem" id="equ_id" name="equ_id" value="<?php echo $iEquipo->id;?>" style="display:none;" />
			<div class="iniDats">
				<div class="tipoElem">
					<div class="iDat v">
						<span id="tequ_nombre"><?php echo utf8_encode($iEquipo->tipo);?></span>
						<select id="equ_tipo" class="tipoElem"><option></option><?php echo utf8_encode($iEquipo->selTEqu($iEquipo->idTipo)); ?></select>
					</div>
				</div>
				<div class="nDatos">
					<div class="iDat v">
						<div class="vpDats">
							<b>Marca:</b><span><?php echo $iEquipo->marca;?></span>
							<b>Modelo:</b><span><?php echo $iEquipo->modelo;?></span>
							<b>Serial:</b><span><?php echo $iEquipo->serial;?></span>
						</div>
						<div class='epDats'>
							<div class='irDat'>
								<span class='tDat'><b>Marca:</b></span>
								<span class='vDat'><input id="equ_marca" class="ieDat" name="equ_marca"  value="<?php echo $iEquipo->marca;?>"/></span>
							</div>
							<div class='irDat'>
								<span class='tDat'><b>Modelo:</b></span>
								<span class='vDat'><input id="equ_modelo" class="ieDat" name="equ_modelo"  value="<?php echo $iEquipo->modelo;?>"/></span>
							</div>
							<div class='irDat'>
								<span class='tDat'><b>Serial:</b></span>
								<span class='vDat'><input id="equ_serial" class="ieDat" name="equ_serial"  value="<?php echo $iEquipo->serial;?>"/></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="contListAtrb" class="iDat v">
			<div class="tit">Especificaciones:</div>
			<div id="lAtrV" class="ListAtrib">
	<?php
					for($i=0; $i<count($iEquipo->atributos); $i++){
						echo "<div class='iAtr'>".
							 "<span class='tAtr'>".$iEquipo->atributos[$i]["tae_nombre"].":</span>".
							 "<span class='vAtr'>".$iEquipo->atributos[$i]["atr_atributo"]."</span>".
							 "</div>";
					}
	?>		
				</div>
				<div id="lAtrE" class="ListAtrib">
					<div class="lAtr">
	<?php
					for($i=0; $i<count($iEquipo->atributos); $i++){
						echo "<div class='iAtr'>".
							 	"<span class='tAtr'>".$iEquipo->selTAtr($iEquipo->atributos[$i]["tae_id"])."</span>".
							 	"<span class='vAtr'>
							 		<input id=\"".
							 			$_POST["equ_id"]."|".$iEquipo->atributos[$i]["atr_id"]."|".$iEquipo->atributos[$i]["tae_id"].
							 			"\" class=\"iAtrEq\" name=\"atr_atributo\"  value=\"".$iEquipo->atributos[$i]["atr_atributo"]."\"/></span>".
							 "</div>";
					}

	?>				</div>	
					<div style="text-align: center;"><span style="cursor:pointer;" onclick="javascript:nAtrib(this.parentNode.parentNode);">[+]</span></div>
				</div>

			</div>

			<div id="listObs" class="iDat v">
<?php
				for($i=0; $i<count($iEquipo->obs); $i++){
					echo "<div class='iObs'>".
						 "<div class='iFechObs'>".date_create($iEquipo->obs[$i]["obsequ_fecha"])->format('d/m/y  h:i a')."</div>".
						 "<div class='iContObs'><div>".utf8_encode($iEquipo->obs[$i]["obsequ_observacion"])."</div></div>".
						 "</div>";
				}
?>	
			</div>
<?php //} ?>
		</div>