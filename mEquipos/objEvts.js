

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
	if (ecmp.style.display=="none"){ecmp.style.display="initial";
		cmp.getElementsByClassName("b_despl")[0].innerHTML="&#9650;";
	}else{ecmp.style.display="none";
	    cmp.getElementsByClassName("b_despl")[0].innerHTML="&#9660;";}

	ajustDlle();
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
		vDetalle(null,'conRegistro',null);
		til=document.getElementById("il."+idEqu);
		refreshList();
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send(prms);

}

function reprogDevDevPrest(){
	prms="reprogDevPrest=true&";
	prms=prms+"equ_id="+document.getElementById("equ_id").value+"&";
	prms=prms+"pre_fechaProgDev="+document.getElementById("pre_fechaProgDev").value;
	
	procAjax=ObjAjax();procAjax.open("POST","../mEquipos/iSqlEqu.php",false);
	procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
		//alert(procAjax.responseText);
		//vDetalle(procAjax.responseText,'conRegistro',null);
		vDetalle(null,'conRegistro',null);
		refreshList();
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send(prms);

}

function DevPrest(cmp){
	prms="DevPrest=true&";
	prms=prms+"equ_id="+document.getElementById("equ_id").value;
	
	procAjax=ObjAjax();procAjax.open("POST","../mEquipos/iSqlEqu.php",false);
	procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
		//alert(procAjax.responseText);
		//vDetalle(procAjax.responseText,'conRegistro',null);
		vDetalle(null,'conRegistro',null);
		refreshList();
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send(prms);
}

//var iSel;

function vDetalle(iEqu, cmpv, iRow){

	tcmpv=document.getElementById(cmpv);
	prms=(iEqu!=null)?"equ_id="+iEqu:"";

	procAjax=ObjAjax();procAjax.open("POST","../mEquipos/vDetalle.php",false);
	procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
		if(iRow!=null){if (typeof iSel != "undefined"){iSel.className="iList";} iSel=iRow;
		iRow.className="iList iSel";}
		
		tcmpv.innerHTML=procAjax.responseText;
		if(iEqu!=null)loadEvents();
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send(prms);
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
	
					document.getElementById("gEqu").style="";
					document.getElementById("cEqu").style="";
					ajustDlle();
				break;
		case 'c':	n=(document.getElementById("equ_id").value!=0)?document.getElementById("equ_id").value:null;
					vDetalle(n,'conRegistro', null);
				break;
	}
}

function nEqu(){
 	vDetalle(0,'conRegistro',null);
 	editDlle('conRegistro','e');
 	ajustDlle();
}


function ntEqu(){
	prms="savetEqu=true&";
	prms=prms+"equ_tipo="+document.getElementById("equ_tipo").value;

	procAjax=ObjAjax();procAjax.open("POST","../mEquipos/iSqlEqu.php",false);
	procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
		document.getElementById("equ_tipo").dataset.id=procAjax.responseText;
		document.getElementById("tipNuevo").style.display="none";
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send(prms);
}

function saveDlle(){

	if(document.getElementById("equ_tipo").dataset.id=="")return;
			
	idEqu=document.getElementById("equ_id").value
	prms="saveEqu=true&";
	prms=prms+"equ_id="+idEqu+"&";
	prms=prms+"equ_cod="+document.getElementById("equ_cod").value+"&";
	prms=prms+"equ_tipo="+document.getElementById("equ_tipo").dataset.id+"&";
	prms=prms+"equ_marca="+document.getElementById("equ_marca").value+"&";
	prms=prms+"equ_modelo="+document.getElementById("equ_modelo").value+"&";
	prms=prms+"equ_serial="+document.getElementById("equ_serial").value;

	arrAtr= new Array();
	tlAtr=document.getElementById("lAtrE").getElementsByClassName("inAtrEq");
	vlAtr=document.getElementById("lAtrE").getElementsByClassName("iAtrEq");
	if(tlAtr.length>0){for (i=0;i<tlAtr.length;i++){

		//arrAtr.push (tlAtr[i].id+":"+tlAtr[i].value);    AQUI VOY----- AVERIGUAR REFLEJAR CONSECUTIVO ATRIBUTO
		

		arrAtr.push (idEqu+"|"+vlAtr[i].dataset.iatr+"|"+tlAtr[i].dataset.tatr+":"+vlAtr[i].value);
	}prms=prms+"&equ_atr="+arrAtr;}

	procAjax=ObjAjax();procAjax.open("POST","../mEquipos/iSqlEqu.php",false);
	procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
		vDetalle(procAjax.responseText,'conRegistro',null);
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
		evAtr(iAtrib);
		iAtrib.getElementsByClassName("inAtrEq")[0].focus();
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send("inAtr="+iEqu);
}

function evAtr(iAtr){
	var ievAtr;
	InpiAtr=iAtr.getElementsByClassName("inAtrEq")[0];
	ievAtr=new uiSelect();
	ievAtr.urlList="../mEquipos/uilist.php";
	ievAtr.iPOST="tAtrib";
	ievAtr.iLeft=2;
	ievAtr.iTop=1;
	ievAtr.iAtrDest="data-tAtr";
	ievAtr.ini(InpiAtr,'ulSelAtr');

}

function delAtrib(cmpParent){
	cmpParent.style.display="none";
	cmpParent.getElementsByClassName("iAtrEq")[0].value="";
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
		vDetalle(iEqu,'conRegistro',null);
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
 		
 		vDetalle(0,'conRegistro',null);
		refreshList();
	}}}
	procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	procAjax.send("idDescEqu="+document.getElementById('equ_id').value);
}

function ajustDlle(){
	t=document.getElementById("Sec").offsetHeight+document.getElementById("SecInfEqu").offsetHeight;
	document.getElementById("SecInfEqu2").style.top=t+"px";
}


function loadEvents(){

	ajustDlle();
	
	if(document.getElementById("pre_fechadev")){
		document.getElementById("pre_fechadev").value =new Date().getDate()+"/"+(new Date().getMonth()+1)+"/"+new Date().getFullYear();
	}


	iS1=new uiSelect();
	iS1.urlList="../mEquipos/uilist.php";
	iS1.iPOST="txtUsr";
	iS1.ini(document.getElementById('pre_usr_id'),'ulSelUsr');


	iSTEqu=new uiSelect();
	iSTEqu.urlList="../mEquipos/uilist.php";
	iSTEqu.iPOST="tEqu";
	iSTEqu.msj=document.getElementById('tipNuevo');
	iSTEqu.ini(document.getElementById('equ_tipo'),'ulSelEqu');

	lAtr=document.getElementById('contListAtrb').getElementsByClassName("iAtr");
	for (var i=0;i<lAtr.length;i++){evAtr(lAtr[i]);}

}

//-------------=============================================----------------------------------



var uiSelect= function(){
	

	var content;

	var iInput;
	var iAtrDest;
	var iList;
	var is;
	var iTop;
	var iPOST;
	var imsj;
	
	var iLeft;
	var iTop; 

	var urlList;
	var params;

function ObjAjax(){
		var xmlhttp=false;try{ xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){try{ xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}catch(E) {xmlhttp=false;}}
		if (!xmlhttp && typeof XMLHttpRequest!="undefined") {xmlhttp=new XMLHttpRequest();}return xmlhttp;
	}

	this.ini=function(iInputElem,nameList){
		
		is=-1;
		if (!iInputElem) return;
		iInput=iInputElem;
		iPOST=this.iPOST;
		urlList=this.urlList;
		//ichange=this.ichange;
		

		iAtrDest=(this.iAtrDest)?this.iAtrDest:"data-id";
		
		iLeft=(typeof this.iLeft != "undefined")?this.iLeft:16;
		iTop=(typeof this.iTop != "undefined")?this.iTop:0;
		msj=(typeof this.msj != "undefined")?this.msj:null;

		//this.iInput=iInput;
		iList=document.getElementById(nameList);
		iList.className="UIselectUL";
		
		iInput.onkeyup = function(e){
			iList.style.maxWidth = (iInput.offsetWidth*1.5)+"px";
			
			//iElem=iInput; 
			iTop=iInput.parentNode.offsetTop+iInput.offsetHeight;
			iList.style.top=iTop+"px";
			iList.style.left=iInput.parentNode.offsetLeft+iLeft+"px";
		
			if (e.keyCode=="38"){ despKey(-1);//sube
			}else if(e.keyCode=="40"){ despKey(1);//baja
			}else if(e.keyCode=="13"){ selectOp();iList.innerHTML="";//Enter
			}else if (e.keyCode=="27"){ iList.innerHTML="";iList.style.display="none";//Esc
			}else{genList();}
		}
	}

	function genList(){
		iList.style.display="initial";
		procAjax=ObjAjax();procAjax.open("POST",urlList,true);
		procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
	 		iList.innerHTML=procAjax.responseText;
	 		is=-1;
	 		if(iList.innerHTML.length==0){iList.style.display="none";iInput.setAttribute(iAtrDest,"");
	 		} else{selClick();}
	 		vMsj();
		}}}
		procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		procAjax.send(iPOST+"="+iInput.value);
	}

	function vMsj(){
		if(msj){if(iList.style.display=="none" && iInput.value.length>0){
			msj.style="";}else{
				msj.style.display="none";}
		}
		ajustDlle();
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
		iInput.setAttribute(iAtrDest,iop[is].id);
		iList.style.display="none";
		iInput.value=iop[is].getElementsByTagName("span")[0].innerHTML;
	}

	

}