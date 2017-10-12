
<?php 
if (!empty($_POST)){
		include_once("../lib/objequipo.php");
		include_once("../lib/objPrestamo.php");
	}else{
		include_once("lib/objequipo.php");
		include_once("lib/objPrestamo.php");
		$_POST["equ_id"]=-1;
	}

		$iEquipo=new classEquipo();
		$iEquipo->diEquipo($_POST["equ_id"]);


?>
		<div id="contentReg">

			<div id="Sec" class="iDat v">
				<?php include("secPrestamo.php");?>
			</div>

			<div id="SecInfEqu">
				<div id="vMenu">
					<span id="edEqu" onclick="javascript:editDlle('conRegistro','e');"> <img src="../imgs/lEditar.png"/></span>
					<span id="nEqu" onclick="javascript:nEqu();"> <img src="../imgs/lNuevo.png"/> </span>
					<span id="gEqu" onclick="javascript:saveDlle();" style="display:none;"> <img src="../imgs/lGuardar.png"/> </span>
					<span id="cEqu" onclick="javascript:editDlle('conRegistro','c'); " style="display:none;"> <img src="../imgs/lCancel.png"/> </span>
				</div>
				<input class="idElem" id="equ_id" name="equ_id" value="<?php echo $iEquipo->id;?>" style="display:none;" />
				<div class="iniDats">
					<div class="tipoElem">
						<div class="iDat v">
							<span id="tequ_nombre"><?php echo utf8_encode($iEquipo->tipo);?></span>
							<span class="UIselect">
								<input class="tipoElem" id="equ_tipo"  data-id="<?php echo $iEquipo->idTipo; ?>" value="<?php echo utf8_encode($iEquipo->tipo);?>" />
							</span>
						</div>
					</div>
					<div class="nDatos">
						<div class="iDat v">
							<div class="vpDats">
								<b>Marca:</b><span><?php echo $iEquipo->marca;?></span>
								<b>Modelo:</b><span><?php echo $iEquipo->modelo;?></span>
								<b>Serial:</b><span><?php echo $iEquipo->serial;?></span>
								<b>Código:</b><span><?php echo $iEquipo->cod;?></span>
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
								<div class='irDat'>
									<span class='tDat'><b>C&oacute;digo:</b></span>
									<span class='vDat'><input id="equ_cod" class="ieDat" name="equ_serial"  value="<?php echo $iEquipo->cod;?>"/></span>
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
								 	"<span class='vAtr' style=\"cursor:pointer;\" onclick=\"javascript:delAtrib(this.parentNode);\">[-]</span>".
								 "</div>";
						}

		?>				</div>	
						<div style="text-align: center;"><span style="cursor:pointer;" onclick="javascript:nAtrib(this.parentNode.parentNode);">[+]</span></div>
						<div><span style="cursor:pointer;" onclick="javascript:descEqu();">[descartar]</span></div>
					</div>

				</div>
			</div>

			<div id="listObs" class="iDat v">
				<span>Observaciones</span>
				<div id="addObs" style="text-align:center;">  
					<textarea></textarea>
					<span style="cursor:pointer;" onclick="javascript:nObs(this.parentNode);">[+]</span>
				</div>

<?php
				echo "";
				for($i=0; $i<count($iEquipo->obs); $i++){
					echo "<div class='iObs'>".
						 "<div class='iFechObs'>".
						 	"<span>".utf8_encode($iEquipo->obs[$i]["usr_nombres"]." ".$iEquipo->obs[$i]["usr_apellidos"])."</span>".
						 	"<span style=\"position: absolute; right:0;\">".date_create($iEquipo->obs[$i]["obsequ_fecha"])->format('d/m/y  h:i a')."</span></div>".
						 "<div class='iContObs'><div>".utf8_encode($iEquipo->obs[$i]["obsequ_observacion"])."</div></div>".
						 "</div>";
				}
?>	
			</div>
			<script type="text/javascript"> 
				loadEvents();
			</script>
		</div>