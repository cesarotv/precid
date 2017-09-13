
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




function vnPrest(cmp){
	ecmp=document.getElementById('contPrest');
	if (ecmp.style.display=="none"){
		ecmp.style.display="initial";
		cmp.getElementsByClassName("b_despl")[0].innerHTML="&#9650;";
	}else{ecmp.style.display="none";
	    cmp.getElementsByClassName("b_despl")[0].innerHTML="&#9660;";}
	
}

function vDetalle(iEqu, cmpv){
	tcmpv=document.getElementById(cmpv);

	procAjax=ObjAjax();procAjax.open("POST","../mEquipos/vDetalle.php",false);
	procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
		tcmpv.innerHTML=procAjax.responseText;
		loadEvents();
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

function loadEvents(){

	document.getElementById("pre_fecha").value =new Date().getDate()+"/"+new Date().getMonth()+"/"+new Date().getFullYear();

	iS1=new uiSelect;
	iS1.urlList="../mEquipos/uilist.php";
	iS1.iPOST="txtUsr";
	//iS1.selectOp=function(){tthis.iInput.value=iop[tthis.is].innerHTML;alert(iop[tthis.is].id);}
	iS1.ini('pre_usr_id');
	
}

//-------------=============================================----------------------------------


var uiSelect= function(){

	var params;
	var iInput;
	var iList;
	var urlList;

	this.ini=function(idInput){
		tthis=this;
		this.is=-1;
		this.iInput=document.getElementById(idInput);
		this.iList=this.iInput.parentNode.getElementsByTagName("ul")[0];
		this.iInput.onkeyup = function(e){
			if (e.keyCode=="38"){ new despKey(-1);//sube
			}else if(e.keyCode=="40"){ new despKey(1);//baja
			}else if(e.keyCode=="13"){ tthis.selectOp();tthis.iList.innerHTML="";//Enter
			}else if (e.keyCode=="27"){ tthis.iList.innerHTML="";//esc
			}else{new genList();}
		}
	}

	function genList(){
		procAjax=ObjAjax();procAjax.open("POST",tthis.urlList,true);
		procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
	 		tthis.iList.innerHTML=procAjax.responseText;tthis.is=-1;
		}}}
		procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		procAjax.send(tthis.iPOST+"="+tthis.iInput.value);
	}

	function despKey(iAcc){
		iop=tthis.iList.getElementsByTagName("li");
		if((tthis.is+iAcc)>=0 && (tthis.is+iAcc)<=(iop.length-1)){
			if(tthis.is>-1){iop[tthis.is].className="";}tthis.is=tthis.is+iAcc;iop[tthis.is].className="is";
		}
	}

	this.selectOp=function(){
		tthis.iInput.value=iop[tthis.is].innerHTML;
		tthis.iInput.name=iop[tthis.is].id;
	}

}