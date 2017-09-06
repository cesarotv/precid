
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

function vDetalle(iEqu, cmpv){
	iEqu=iEqu;
	tcmpv=document.getElementById(cmpv);

	procAjax=ObjAjax();procAjax.open("POST","mEquipos/vDetalle.php",false);
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
		case 'c':	tcmpv=document.getElementById(cmpv);
					lsec=tcmpv.getElementsByClassName('iDat');
					
					for (var iSec of lsec) {
					  iSec.className ="iDat v";
					}
					document.getElementById("edEqu").style.display="initial";
					document.getElementById("nEqu").style.display="initial";

					document.getElementById("gEqu").style.display="none";
					document.getElementById("cEqu").style.display="none";
				break;
	}
}

function nDlle(){
	document.getElementById("edEqu").style.display="none";
	document.getElementById("nEqu").style.display="none";
 	vDetalle(0,'conRegistro');
 	editDlle('conRegistro','e');
}

function saveDlle(){

	idEqu=document.getElementById("equ_id").value
	prms="saveEqu=true&";
	prms=prms+"equ_id="+idEqu+"&";
	prms=prms+"equ_tipo="+document.getElementById("equ_tipo").value+"&";
	prms=prms+"equ_marca="+document.getElementById("equ_marca").value+"&";
	prms=prms+"equ_modelo="+document.getElementById("equ_modelo").value+"&";
	prms=prms+"equ_serial="+document.getElementById("equ_serial").value;

	arrAtr= new Array();
	tlAtr=document.getElementById("lAtrE").getElementsByClassName("iAtrEq");
	if(tlAtr.length>0){for (i=0;i<tlAtr.length;i++){arrAtr.push (tlAtr[i].id+":"+tlAtr[i].value);}prms=prms+"&equ_atr="+arrAtr;}

	procAjax=ObjAjax();procAjax.open("POST","mEquipos/iSqlEqu.php",false);
	procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){

		//alert(procAjax.responseText);
		vDetalle(idEqu,'conRegistro');
		til=document.getElementById("il."+idEqu);//
		til.getElementsByClassName('tipoElem')[0].innerHTML=document.getElementById("tequ_nombre").innerHTML;
		til.getElementsByClassName('marcaElem')[0].innerHTML=document.getElementById("equ_marca").value;
		til.getElementsByClassName('modeloElem')[0].innerHTML=document.getElementById("equ_modelo").value;
		
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send(prms);
}

function nAtrib(cmpParent){
	iEqu= document.getElementById("equ_id").value;
	tList=cmpParent.getElementsByClassName("lAtr")[0];
	nAtribs=tList.getElementsByClassName("iAtr").length+1;//alert(nAtribs);
	iAtrib=document.createElement("div");
	iAtrib.className="iAtr";

	procAjax=ObjAjax();procAjax.open("POST","mEquipos/iSqlEqu.php",true);
	procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
		iAtrib.innerHTML=procAjax.responseText;
		tList.appendChild(iAtrib);
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send("inAtr="+iEqu+"&nAtrib="+nAtribs);
}

function changeAtrib(cmp){
	cvAtr=cmp.parentNode.parentNode.getElementsByTagName("Input")[0];
	tid=cvAtr.id.split("|");
	cvAtr.id=tid[0]+"|"+tid[1]+"|"+cmp.value
}