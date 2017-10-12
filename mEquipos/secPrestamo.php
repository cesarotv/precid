
<?php 

$iPres=new classPrestamo();

if ($iEquipo->pres_usr_id){
?>
				<div id="SecPrest" >
					<span id="bdispon" onclick="javascript:vnPrest(this);">Prestado a 
					<div><?php echo utf8_encode($iEquipo->pres_usr_nombre);?>
						<span class="b_despl">&#9660;</span></div>
					</span>
					</span>
					<div id="contPrest" style="display:none;">
						<div>
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
					<span id="bdispon" onclick="javascript:vnPrest(this);">Disponible <span class="b_despl">&#9660;</span></span>
					<div id="contPrest" style="display:none;">
						<div class="DatnPres" >
							<div class="rDatnPres">
								<span class="cText">Tipo de Prestamo </span>
								<span class="UIselect">
									<select id="pre_tipo" >
										<option value="1" selected>Interno</option>
										<option value="0">Externo</option>
									</select>
								</span>
							</div>
							<div class="rDatnPres">
								<span class="cText">Prestamo para </span>
								<span class="UIselect">
									<input  class="idElem" id="pre_usr_id"  value="" />
								</span>
							</div>
							<div class="rDatnPres"><span class="cText"> para Devolver de día </span>
								<input  class="idElem" id="pre_fechadev"  value="" />
							</div>
						</div>
						<div style="text-align: center;padding:5px; cursor: pointer;">
							<span onclick="javascript:SavenPrest();">[Crear Prestamo]</span></div>
					</div>
				</div>
<?php 

}


?>