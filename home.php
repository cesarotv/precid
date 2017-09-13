<?php
	session_start();

	if(!isset($_SESSION['USR'])) header("location:../index.php");


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Inventario CID</title>
<link media="screen" href="../home.css" type="text/css" rel="stylesheet"></link>
<link media="screen" href="../lib/ui.css" type="text/css" rel="stylesheet"></link>

<?php
		switch ($_GET["mod"]) {
			case 'usuarios':
?>					<!-- Archivos ModUsuarios-->
					<link media="screen" href="../mUsuarios/modUsr.css" type="text/css" rel="stylesheet"></link>
					<script type="text/javascript" src="../mUsuarios/EvtsUsr.js"></script>
<?php 			break;
			case 'equipos':
?>					<!-- Archivos ModEquipos-->
					<link media="screen" href="../mEquipos/modEqu.css" type="text/css" rel="stylesheet"></link>
					<script type="text/javascript" src="../mEquipos/objEvts.js"></script>
<?php  		break;
			case 'out':
					$_SESSION=array();header("location:../index.php");
				break;
		}
?>


<!--
-->
</head>
<body>
	<div id="content">
		<div id="barSup">
			
			<ul id="contBarSup" >
				<li>Solicitudes</li>
				<li><a href="equipos">Equipos</a></li>
				<li><a href="usuarios">Usuarios</a></li>
				<li><span style="cursor:pointer;" onclick="document.getElementById('out').submit();">[Salir]</span></li>
			</ul>
		</div>
		<form id="out" method="POST" action="/CID/inventario/home/out"></form>
		<div id="contentBarSup">
			<?php 
							
				switch ($_GET["mod"]) {
					case 'usuarios':
						include_once("mUsuarios/modUsr.php");   //contenido ModUsuarios
						break;
					default:
						include_once("mEquipos/modEqu.php");    //contenido ModEquipos
						break;
				}
				
				//

				
				
			?>
		</div>
	</div>
</body>
</html>