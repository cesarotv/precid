
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
					<div id="contPrest" style="/*display:none;*/">
						<div  style="display: table-row;">
							<div style="display:table-cell;text-align: center;width: 40%;padding-right: 5%;border-right: 1px solid #0e7c3e;">
								<span class="cText">Pospone la devolución para el día </span>
								<input  class="idElem" style="width: 100%;" id="pre_fechaProgDev" readonly="readonly"  value="<?php echo utf8_encode($iEquipo->pres_usr_fechadev);?>" />
								<div style="padding-top: 5px;"><span class="btn" onclick="javascript:reprogDevDevPrest(); ">Reprogramar</span></div>
							</div>
							<div style="display: table-cell;text-align: center;width: 40%;padding-right: 5%; vertical-align: middle">
								<span class="btn" onclick="javascript:DevPrest(this);">Registrar <br> Devolución</span>
							</div>
						</div>
					</div>
				</div>
<?php

}else{

?>
				<div id="SecDispon" >
					<span id="bdispon" onclick="javascript:vnPrest(this);"><span class="b_despl">&#9660;</span>Disponible</span>
					<div id="contPrest" style="/*display:none;*/">
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
								<span class="UIDate"><input  class="idElem" id="pre_fechadev"  value="" readonly="readonly"/></span>
							</p>
						</div>
						<div style="text-align: center;padding:5px;">
							<span class="btn" onclick="javascript:SavenPrest();">Crear Prestamo</span></div>
					</div>
				</div>

<?php 

}
				

?>