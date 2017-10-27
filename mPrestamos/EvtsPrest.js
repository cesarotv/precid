
var iPrest;
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
	document.getElementById('BusqPrest').onkeyup = evKeys; 
	document.getElementById('iListado').addEventListener("scroll", function(){PagList(this);}, false);
}

function PagList(iList){
	if ((iList.offsetHeight + iList.scrollTop) >= iList.scrollHeight-(iList.scrollHeight/10)) {

	iTbl=iList.getElementsByClassName('iListTable')[0];
	n=iTbl.getElementsByClassName('iList').length;
	procAjax=ObjAjax();procAjax.open("POST","../mPrestamos/iListPrest.php",true);
	procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
		iTbl.innerHTML=iTbl.innerHTML+procAjax.responseText;
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send("txtPrest="+document.getElementById('BusqPrest').value+"&rPag="+n);

	}
}

//var iSel;

function vDetalle(idPrest, cmpv, iRow){
	//alert(iSel);


	rcmpv=document.getElementById("obs."+idPrest);
	rcmpv.style.height="0px";
	tcmpv=rcmpv.getElementsByClassName('icontnObs')[0];

	obsAnt=rcmpv.parentNode.parentNode.parentNode.getElementsByClassName('icontnObsV')[0];
	if (typeof obsAnt != "undefined"){
		obsAnt.className="icontnObs";
		obsAnt.innerHTML="";
		obsAnt.parentNode.parentNode.style="";
		obsAnt.parentNode.style="";
	}

	vequ_id=idPrest.split('.')[1];
	vpre_f=idPrest.split('.')[2];

	procAjax=ObjAjax();procAjax.open("POST","../mPrestamos/vInfPrest.php",false);
	procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){

		if (typeof iSel != "undefined"){iSel.className="iList";} iSel=iRow;
		iRow.className="iList iSel";

		rcmpv.style.height="0px";
		rcmpv.parentNode.style.height="0px";
		tcmpv.innerHTML=procAjax.responseText;
		th=tcmpv.offsetHeight+10+"px";

		rcmpv.style.height=th;
		rcmpv.parentNode.style.height=th;

		tcmpv.className='icontnObsV';
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send("equ_id="+vequ_id+"&pre_fecha="+vpre_f);
}

function evKeys(e){refreshList();}

function refreshList(){
	iTbl=document.getElementById('iListado').getElementsByClassName('iListTable')[0];
	procAjax=ObjAjax();procAjax.open("POST","../mPrestamos/iListPrest.php",true);
	procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
		iTbl.innerHTML=procAjax.responseText;
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send("txtPrest="+document.getElementById('BusqPrest').value);
}


/*
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
	prms=prms+"usr_username="+document.getElementById("usr_username").value;

	procAjax=ObjAjax();procAjax.open("POST","../mUsuarios/iSqlUsr.php",false);
	procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
		vDetalle(procAjax.responseText,'conRegistro');
		refreshList();
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send(prms);
}
*/

