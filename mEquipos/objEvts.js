
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

function SavenPrest(){
	idEqu=document.getElementById("equ_id").value;
	prms="savenPrest=true&";
	prms=prms+"equ_id="+idEqu+"&";
	prms=prms+"pre_usr="+document.getElementById("pre_usr_id").dataset.id+"&";
	prms=prms+"pre_tipo="+document.getElementById("pre_tipo").value+"&";
	prms=prms+"pre_devprog="+document.getElementById("pre_fechadev").value+"&";
	//alert(prms);

	procAjax=ObjAjax();procAjax.open("POST","../mEquipos/iSqlEqu.php",false);
	procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
		//alert(procAjax.responseText);
		vDetalle(procAjax.responseText,'conRegistro');
		til=document.getElementById("il."+idEqu);
		refreshList();
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send(prms);

}

function DevPrest(cmp){
	//nObs(cmp);
	prms="DevPrest=true&";
	prms=prms+"equ_id="+document.getElementById("equ_id").value;
	
	procAjax=ObjAjax();procAjax.open("POST","../mEquipos/iSqlEqu.php",false);
	procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
		//alert(procAjax.responseText);
		vDetalle(procAjax.responseText,'conRegistro');
		refreshList();
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send(prms);
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
	prms=prms+"equ_tipo="+document.getElementById("equ_tipo").dataset.id+"&";
	prms=prms+"equ_marca="+document.getElementById("equ_marca").value+"&";
	prms=prms+"equ_modelo="+document.getElementById("equ_modelo").value+"&";
	prms=prms+"equ_serial="+document.getElementById("equ_serial").value;

	arrAtr= new Array();tlAtr=document.getElementById("lAtrE").getElementsByClassName("iAtrEq");
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

	document.getElementById("pre_fechadev").value =new Date().getDate()+"/"+(new Date().getMonth()+1)+"/"+new Date().getFullYear();

	iS1=new uiSelect;
	iS1.urlList="../mEquipos/uilist.php";
	iS1.iPOST="txtUsr";
	iS1.ini(document.getElementById('pre_usr_id'));

	iSTEqu=new uiSelect;
	iSTEqu.idContent="contentReg";
	iSTEqu.urlList="../mEquipos/uilist.php";
	iSTEqu.iPOST="tEqu";
	iSTEqu.ini(document.getElementById('equ_tipo'));

}

//-------------=============================================----------------------------------


var uiSelect= function(){
	

	var content;

	var iInput;
	var iAtrDest;
	var iList;
	var is;
	var iPOST;
	
	var urlList;
	var params;


function ObjAjax(){
		var xmlhttp=false;try{ xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){try{ xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}catch(E) {xmlhttp=false;}}
		if (!xmlhttp && typeof XMLHttpRequest!="undefined") {xmlhttp=new XMLHttpRequest();}return xmlhttp;
	}

	this.ini=function(iInputElem){
		is=-1;
		
		iInput=iInputElem;
		iPOST=this.iPOST;
		urlList=this.urlList;
		ichange=this.ichange;

		iAtrDest=(this.iAtrDest)?this.iAtrDest:"data-id";

		content=(this.idContent)?document.getElementById(this.idContent):iInput.parentNode;

		iList=document.createElement("ul");
		iList.className="UIselectUL";
		content.appendChild(iList);

		iInput.onkeyup = function(e){
			iList.style.minWidth = iInput.offsetWidth+"px";
	 		iList.style.top=(iInput.parentNode.offsetTop+iInput.offsetHeight+2)+"px";
	 		iList.style.left=iInput.offsetLeft+"px";
			if (e.keyCode=="38"){ despKey(-1);//sube
			}else if(e.keyCode=="40"){ despKey(1);//baja
			}else if(e.keyCode=="13"){ selectOp();iList.innerHTML="";//Enter
			}else if (e.keyCode=="27"){ iList.innerHTML="";iList.style.display="none";//esc
			}else{genList();}
		}
	}

	function genList(){
		iList.style.display="initial";
		procAjax=ObjAjax();procAjax.open("POST",urlList,true);
		procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
	 		iList.innerHTML=procAjax.responseText;
	 		is=-1;
	 		selClick();
		}}}
		procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		procAjax.send(iPOST+"="+iInput.value);
	}

	function despKey(iAcc){
		iop=iList.getElementsByTagName("li");
		if((is+iAcc)>=0 && (is+iAcc)<=(iop.length-1)){
			if(is>-1){iop[is].className="";}is=is+iAcc;iop[is].className="is";
		}
	}

	function selClick(){
		iop=iList.getElementsByTagName("li");
		for (var i=0;i<iop.length;i++){
			iop[i].onclick=function(){is=this.dataset.idop;selectOp();iList.innerHTML="";}
		}
	}

	function selectOp(){
		iInput.setAttribute(iAtrDest,iop[is].id);iList.style.display="none";
		iInput.value=iop[is].innerHTML;
		this.iInput=iInput;
		
		ichange();
	}

	this.ichange=function(){}

}