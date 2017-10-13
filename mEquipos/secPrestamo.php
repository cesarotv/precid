
<?php 

$iPres=new classPrestamo();

if ($iEquipo->pres_usr_id){
?>
				<div id="SecPrest" >
					<span id="bdispon" onclick="javascript:vnPrest(this);">
						<span class="b_despl">&#9660;</span>
						Prestado a <span class="usrPrest"><?php echo utf8_encode($iEquipo->pres_usr_nombre);?></span>

					</span>
					</span>
					<div id="contPrest" style="display:none;">
						<div style="white-space: normal;">
							<span class="cText">Reprogramar la devolución para el día </span>
							<input  class="idElem" id="pre_fechadev"  value="" />
						</div>
						<div>
							<div style="text-align: center;padding-top: 10px;">
								<span style="cursor:pointer;" onclick="javascript:DevPrest(this); ">[Registrar Devolución]</span></div>
						</div>

					</div>
				</div>
<?php

}else{

?>
				<div id="SecDispon" >
					<span id="bdispon" onclick="javascript:vnPrest(this);"><span class="b_despl">&#9660;</span>Disponible</span>
					<div id="contPrest" style="display:none;">
						<div class="DatnPres" ><p style="line-height: 1.8;">
							<span class="cText">Prestamo </span>
							<span class="UIselect">
								<select id="pre_tipo" >
									<option value="1" selected>Interno</option>
									<option value="0">Externo</option>
								</select>
							</span>
							<span class="cText"> para </span>
								<span class="UIselect">
									<input  class="idElem" id="pre_usr_id"  value="" />
								</span>
							<span class="cText"> quien lo devolverá el día </span>
								<input  class="idElem" id="pre_fechadev"  value="" />
							</p>
						</div>
						<div style="text-align: center;padding:5px;">
							<span style="cursor: pointer;" onclick="javascript:SavenPrest();">[Crear Prestamo]</span></div>
					</div>
				</div>
<?php 

}


?>