
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
	document.getElementById('BusqEqu').onkeyup = evKeys;
}


function vDetalle(iEqu, cmpv){
	tcmpv=document.getElementById(cmpv);

	procAjax=ObjAjax();procAjax.open("POST","../mEquipos/vDetalle.php",false);
	procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){

		tcmpv.innerHTML=procAjax.responseText;
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send("equ_id="+iEqu);
}

function editDlle(cmpv,ev){

	switch(ev) {
		case 'e':	tcmpv=document.getElementById(cmpv);
					lsec=tcmpv.getElementsByClassName('iDat');
					
					for (var iSec of lsec) {
					  iSec.className ="iDat e";
					}
					document.getElementById("edEqu").style.display="none";
					document.getElementById("nEqu").style.display="none";
	
					document.getElementById("gEqu").style.display="initial";
					document.getElementById("cEqu").style.display="initial";

				break;
		case 'c':	vDetalle(document.getElementById("equ_id").value,'conRegistro');
				break;
	}
}

function nEqu(){

 	document.getElementById("edEqu").style.display="none";
	document.getElementById("nEqu").style.display="none";
 	vDetalle(0,'conRegistro');
 	editDlle('conRegistro','e');

}

function saveDlle(){

	idEqu=document.getElementById("equ_id").value
	prms="saveEqu=true&";
	prms=prms+"equ_id="+idEqu+"&";
	prms=prms+"equ_cod="+document.getElementById("equ_cod").value+"&";
	prms=prms+"equ_tipo="+document.getElementById("equ_tipo").value+"&";
	prms=prms+"equ_marca="+document.getElementById("equ_marca").value+"&";
	prms=prms+"equ_modelo="+document.getElementById("equ_modelo").value+"&";
	prms=prms+"equ_serial="+document.getElementById("equ_serial").value;

	arrAtr= new Array();
	tlAtr=document.getElementById("lAtrE").getElementsByClassName("iAtrEq");
	if(tlAtr.length>0){for (i=0;i<tlAtr.length;i++){arrAtr.push (tlAtr[i].id+":"+tlAtr[i].value);}prms=prms+"&equ_atr="+arrAtr;}

	procAjax=ObjAjax();procAjax.open("POST","../mEquipos/iSqlEqu.php",false);
	procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
		vDetalle(procAjax.responseText,'conRegistro');
		til=document.getElementById("il."+idEqu);
		refreshList();
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send(prms);
}

function nAtrib(cmpParent){
	iEqu= document.getElementById("equ_id").value;
	tList=cmpParent.getElementsByClassName("lAtr")[0];
	iAtrib=document.createElement("div");
	iAtrib.className="iAtr";
	iEqu=(iEqu==0)?-1:iEqu;
	procAjax=ObjAjax();procAjax.open("POST","../mEquipos/iSqlEqu.php",true);
	procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
		iAtrib.innerHTML=procAjax.responseText;
		tList.appendChild(iAtrib);
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send("inAtr="+iEqu);
}

function delAtrib(cmpParent){
	cmpParent.style.display="none";
	cmpParent.getElementsByTagName('input')[0].value="";
}

function changeAtrib(cmp){
	cvAtr=cmp.parentNode.parentNode.getElementsByTagName("Input")[0];
	tid=cvAtr.id.split("|");
	cvAtr.id=tid[0]+"|"+tid[1]+"|"+cmp.value
}

function nObs(cmpParent){
	iEqu= document.getElementById("equ_id").value;
	iObs= cmpParent.getElementsByTagName('textarea')[0].value;
	
	procAjax=ObjAjax();procAjax.open("POST","../mEquipos/iSqlEqu.php",true);
	procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
		vDetalle(iEqu,'conRegistro');
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send("iEquObs="+iEqu+"&iObs="+iObs);

}

function evKeys(e){refreshList();}

function refreshList(){
	procAjax=ObjAjax();procAjax.open("POST","../mEquipos/iList.php",true);
	procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
		document.getElementById("iListado").innerHTML=procAjax.responseText;
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send("txtEqu="+document.getElementById('BusqEqu').value);
}

function descEqu(){
	procAjax=ObjAjax();procAjax.open("POST","../mEquipos/iSqlEqu.php",true);
	procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
 		
 		vDetalle(0,'conRegistro');
		refreshList();
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send("idDescEqu="+document.getElementById('equ_id').value);
}