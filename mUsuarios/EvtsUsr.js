
//------------------------------------------------------------------------------

function ObjAjax(){
	var xmlhttp=false;
	try{ xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");}// No IE
	catch(e){
		try{ xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}// IE
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!="undefined") { xmlhttp=new XMLHttpRequest(); }
	return xmlhttp;
}

//------------------------------------------------------------------------------

window.onload=function() {
	document.getElementById('BusqUsr').onkeyup = evKeys;
}


function vDetalle(iUsr, cmpv, iRow){
	tcmpv=document.getElementById(cmpv);

	procAjax=ObjAjax();procAjax.open("POST","../mUsuarios/vInfUsr.php",false);
	procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
		if (typeof iSel != "undefined"){iSel.className="iList";} iSel=iRow;
		iRow.className="iList iSel";

		tcmpv.innerHTML=procAjax.responseText;
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send("usr_id="+iUsr);
}

function editDlle(cmpv,ev){

	switch(ev) {
		case 'e':	tcmpv=document.getElementById(cmpv);
					lsec=tcmpv.getElementsByClassName('iDat');
					
					for (var iSec of lsec) {
					  iSec.className ="iDat e";
					}
					document.getElementById("edUsr").style.display="none";
					document.getElementById("nUsr").style.display="none";
	
					document.getElementById("gUsr").style.display="initial";
					document.getElementById("cUsr").style.display="initial";

				break;
		case 'c':	vDetalle(document.getElementById("usr_id").value,'conRegistro');
				break;
	}
}

function nUsr(){

 	document.getElementById("edUsr").style.display="none";
	document.getElementById("nUsr").style.display="none";
 	vDetalle(0,'conRegistro');
 	editDlle('conRegistro','e');

}

function saveDlle(){

	idUsr=document.getElementById("usr_id").value
	prms="saveUsr=true&";
	prms=prms+"usr_id="+idUsr+"&";
	prms=prms+"usr_nombres="+document.getElementById("usr_nombres").value+"&";
	prms=prms+"usr_apellidos="+document.getElementById("usr_apellidos").value+"&";
	prms=prms+"usr_estado="+document.getElementById("usr_estado").value+"&";
	prms=prms+"usr_pro_id="+document.getElementById("usr_pro_id").value+"&";

	procAjax=ObjAjax();procAjax.open("POST","../mUsuarios/iSqlUsr.php",false);
	procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
		vDetalle(procAjax.responseText,'conRegistro');
		refreshList();
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send(prms);
}

function evKeys(e){refreshList();}

function refreshList(){
	procAjax=ObjAjax();procAjax.open("POST","../mUsuarios/iListUsr.php",true);
	procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
		document.getElementById("iListado").innerHTML=procAjax.responseText;
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send("txtUsr="+document.getElementById('BusqUsr').value);
}