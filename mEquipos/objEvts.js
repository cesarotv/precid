

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
	prms=prms+"pre_devprog="+document.getElementById("pre_fechadev").dataset.fecha;
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
	prms=prms+"pre_fechaProgDev="+document.getElementById("pre_fechaProgDev").dataset.fecha;
	
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
		if(tlAtr[i].dataset.tatr.length>0){
			arrAtr.push (idEqu+"|"+vlAtr[i].dataset.iatr+"|"+tlAtr[i].dataset.tatr+":"+vlAtr[i].value);
		}
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
	
	if(document.getElementById("pre_fechadev")){iObjdate=new uiDate();
		iObjdate.ini(document.getElementById('pre_fechadev'),'uiCalendPrest');}

	if(document.getElementById("pre_fechaProgDev")){iObjdate=new uiDate();
		t=document.getElementById("pre_fechaProgDev").value;
		iObjdate.iniDate=new Date(document.getElementById("pre_fechaProgDev").value);
		iObjdate.ini(document.getElementById('pre_fechaProgDev'),'uiCalendPrest');}

	iS1=new uiSelect();
	iS1.urlList="../mEquipos/uilist.php";
	iS1.iPOST="txtUsr";
	iS1.ini(document.getElementById('pre_usr_id'),'ulSelUsr');


	iSTEqu=new uiSelect();
	iSTEqu.urlList="../mEquipos/uilist.php";
	iSTEqu.iPOST="tEqu";
	iSTEqu.imsj=document.getElementById('tipNuevo');
	iSTEqu.ini(document.getElementById('equ_tipo'),'ulSelEqu');

	lAtr=document.getElementById('contListAtrb').getElementsByClassName("iAtr");
	for (var i=0;i<lAtr.length;i++){evAtr(lAtr[i]);}


}

//-------------==================== UI SELECT =========================----------------------------------

var uiSelect= function(){
	
	//==== Parametros de Usuario  ------
	var urlList;  // * URL página que retorna el listado <texto>
	var iInput;   // * Objeto Input <ElementHTML>
	var iAtrDest; // * Atributo data del Input <texto>
	var iList;    // * Objeto del Listado <ElementHTML>
	var iPOST;    // * Nombre variable de POST para consulta <texto>
	var imsj;       // Objeto del mensaje con el Input <ElementHTML>

	//==== variables internos  ------
	var is;         // Indice del Objeto Seleccionado <número>

	var iLeft;      // Ubicación horizontal del listado <número>
	var iTop;       // Ubicación Vertical del listado <número>

	//var params;		// texto con la compilaciòn de parámetros de consulta para generar el listado

	function ObjAjax(){var xmlhttp=false;try{ xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
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
		imsj=(typeof this.imsj != "undefined")?this.imsj:null;

		//this.iInput=iInput;
		iList=document.getElementById(nameList);
		iList.className="UIselectUL";
		
		iInput.onkeyup = function(e){
			iList.style.maxWidth = (iInput.offsetWidth*1.5)+"px";
			
			iTop=iInput.parentNode.offsetTop+iInput.offsetHeight;
			iList.style.top=iTop+"px";
			iList.style.left=iInput.parentNode.offsetLeft+iLeft+"px";
		
			if (e.keyCode=="38"){ despKey(-1);//sube
			}else if(e.keyCode=="40"){ despKey(1);//baja
			}else if(e.keyCode=="13"){ selectOp();iList.innerHTML="";//Enter
			}else if (e.keyCode=="27"){
				iList.innerHTML="";iList.style.display="none";iInput.setAttribute(iAtrDest,"");vMsj(); //Esc
			}else{genList();}

		}
	}

	function genList(){
		iList.style.display="initial";
		procAjax=ObjAjax();procAjax.open("POST",urlList,true);
		procAjax.onreadystatechange=function(){if (procAjax.readyState==4){if (procAjax.status==200){
	 		iList.innerHTML=procAjax.responseText;is=-1;
	 		if(iList.innerHTML.length==0){iList.style.display="none";iInput.setAttribute(iAtrDest,"");
	 		} else{selClick();}vMsj();
		}}}
		procAjax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		procAjax.send(iPOST+"="+iInput.value);
	}

	function vMsj(){if(imsj){if(iList.style.display=="none" && iInput.getAttribute(iAtrDest).length==0){
			imsj.style="";}else{imsj.style.display="none";}}
		ajustDlle();
	}

	function despKey(iAcc){
		iop=iList.getElementsByTagName("li");
		if((is+iAcc)>=0 && (is+iAcc)<=(iop.length-1)){if(is>-1){iop[is].className="";}is=is+iAcc;iop[is].className="is";
		}
	}

	function selClick(){
		iop=iList.getElementsByTagName("li");
		for (var i=0;i<iop.length;i++){iop[i].onclick=function(){is=this.dataset.idop;selectOp();iList.innerHTML="";}
		}
	}

	function selectOp(){
		iInput.setAttribute(iAtrDest,iop[is].id);iList.style.display="none";
		iInput.value=iop[is].getElementsByTagName("span")[0].innerHTML;vMsj();
	}

}


//-------------========================== DATE PICK ===================----------------------------------

var uiDate= function(){

	var InputDate;    // * Objeto Input <ElementHTML>
	var InputFormat;		//Formato visible de la fecha
	var iCalend;	  // Objeto contenedor del Calendario <ElementHTML>
	var iMes;		  // Objeto donde se muestra el mes correspondiente al día resaltado <ElementHTML>
	var icontDias;		  // Onjeto contenedor de los días del calendario <ElementHTML>
	var listdays;           //Arreglo con los días del calendario <ElementHTML> <td>
	var isD;				//Indice del día del calendario seleccionado
	var iAtrDest			//Atributo donde almacena el valor de la Fecha

	var iDate; 				// Variable Fecha de inicio <Date>
	var isDate;				// Fecha con resaltada en el calendario
	var iFormat="Y-m-d";	// Formato fecha seleccionada
	var lim;				// limite de días
	var iLeft=0;      		// Ubicación horizontal del listado <número>
	var iTop;       		// Ubicación Vertical del listado <número>

	function ObjAjax(){var xmlhttp=false;try{ xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){try{ xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}catch(E) {xmlhttp=false;}}
		if (!xmlhttp && typeof XMLHttpRequest!="undefined") {xmlhttp=new XMLHttpRequest();}return xmlhttp;
	}

	this.ini=function(idCont,inCalend){

		iDate=(this.iniDate)?this.iniDate:new Date();
		InputFormat=(this.iFormat)?this.iFormat:"D, j \\d\\e M \\d\\e Y";

		iCalend=document.getElementById(inCalend);
		iCalend.className="UIdateDIVoc";
		lim=15;
		iAtrDest=(this.iAtrDest)?this.iAtrDest:"data-fecha";
		InputDate=idCont;isDate=iDate;selectDate();
	
		iMes = document.createElement("div");iMes.className="iMes";iMes.id=iDate.getMonth();iMes.innerHTML=iDate.format("F");iCalend.appendChild(iMes);
		icontDias = document.createElement("div");icontDias.className="cDias";iCalend.appendChild(icontDias);

		InputDate.onfocus=function(){create(iDate);}

		InputDate.onkeyup = function(e){
			if(iCalend.className!="UIdateDIVoc"){
				if(e.keyCode=="13"){selectDate();iCalend.className="UIdateDIVoc";//Enter
				}else if(e.keyCode=="27"){iCalend.className="UIdateDIVoc"; // Esc
				}else if(e.keyCode=="38"){//Arriba
					if((isD-7)>=0 && listdays[isD-7].className.indexOf("blq")<0){
						listdays[isD].className=listdays[isD].className.replace(" sel","");isD=isD-7;
						listdays[isD].className=listdays[isD].className+" sel";
						isDate=new Date(listdays[isD].id);actMes();}
				}else if(e.keyCode=="40"){//Abajo
					if((isD+7)<listdays.length && listdays[isD+7].className.indexOf("blq")<0){
						listdays[isD].className=listdays[isD].className.replace(" sel","");
						isD=isD+7;listdays[isD].className=listdays[isD].className+" sel";
						isDate=new Date(listdays[isD].id);actMes();}
				}else if(e.keyCode=="37"){//Izquierda
					if((isD-1)>=0 && listdays[isD-1].className.indexOf("blq")<0){
						listdays[isD].className=listdays[isD].className.replace(" sel","");
						isD=isD-1;listdays[isD].className=listdays[isD].className+" sel";
						isDate=new Date(listdays[isD].id);actMes();}
				}else if(e.keyCode=="39"){//Derecha
					if((isD+1)<listdays.length && listdays[isD+1].className.indexOf("blq")<0){
						listdays[isD].className=listdays[isD].className.replace(" sel","");
						isD=isD+1;listdays[isD].className=listdays[isD].className+" sel";
						isDate=new Date(listdays[isD].id);actMes();}
				}

			}else {iCalend.className="UIdateDIV";}	
		};
	}

	function actMes(){
		if(iDate.getMonth()!=(iMes.id+1)){iMes.innerHTML=new Date(listdays[isD].id).format("F");}
	}

	function create(iDate){
		iCalend.className="UIdateDIV";
		iTop=InputDate.offsetTop+InputDate.offsetHeight;
		iCalend.style.top=iTop+"px";
		iCalend.style.left=InputDate.parentNode.offsetLeft+iLeft+"px";

		ttbld="<table style='width: 100%;'>"+
		"<tbody class='nomdias'><tr class='tDiasSem'><td class='dDom'>D</td><td>L</td><td>M</td><td>M</td><td>J</td><td>V</td>"+
		"<td>S</td></tr></tbody><tbody class='ndias'>";
		td=new Date(iDate);
		limtd=new Date(iDate);
		limtd.setDate(limtd.getDate()+lim);
		td.setDate(td.getDate()-td.getDay());
		
		for(s=0;s<3;s++){ttbld=ttbld+"<tr class='ndia'>";for(d=0;d<=6;d++){d=td.getDay();
			classDay=(td.getMonth()==iDate.getMonth())?"Ma":"Ms"; // define class para los días de mes diferente
			if(td.getDate()==iDate.getDate() && td.getMonth()==iDate.getMonth()){classDay = classDay + " sel"; // resalta la fecha inicial
			}else{if(td<iDate || td>limtd || td.getDay()==0 || td.getDay()==6) classDay = classDay + " blq";}

			ttbld=ttbld+"<td id='"+td.format("m/d/Y")+"' class='"+classDay+"' ><div class='iday'>"+td.getDate()+"</div></td>";
			td.setDate(td.getDate()+1);
		}ttbld=ttbld+"</tr>";}

		ttbld=ttbld+"</tbody></table>";

		icontDias.innerHTML=ttbld;
		evClickDate();
	}

	function evClickDate(){
		listdays=iCalend.getElementsByClassName('ndias')[0].getElementsByTagName('td');
		for (t=0;t<listdays.length;t++) {
			if(listdays[t].className.indexOf("blq")<0){
				listdays[t].onclick=function(){isDate=new Date(this.id);iCalend.className="UIdateDIVoc";selectDate();}
			}
			if(listdays[t].className.indexOf("sel")>=0){isD=t;}
		}
	}

	function selectDate(){InputDate.value=isDate.format(InputFormat);InputDate.setAttribute(iAtrDest,isDate.format(iFormat));
							}

	Date.prototype.format = function(format) {
	    var returnStr = '';
	    var replace = Date.replaceChars;
	    for (var i = 0; i < format.length; i++) {
	    	var curChar = format.charAt(i);
	    	if (i - 1 >= 0 && format.charAt(i - 1) == "\\") {
	            returnStr += curChar;
	        }
	        else if (replace[curChar]) {
	            returnStr += replace[curChar].call(this);
	        } else if (curChar != "\\"){
	            returnStr += curChar;
	        }
	    }
	    return returnStr;
	};

	Date.replaceChars = {
		    shortMonths: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
		    longMonths: ['Enero', 'February', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		    shortDays: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
		    longDays: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],

		    // Day
		    d: function() { return (this.getDate() < 10 ? '0' : '') + this.getDate(); },
		    D: function() { return Date.replaceChars.shortDays[this.getDay()]; },
		    j: function() { return this.getDate(); },
		    l: function() { return Date.replaceChars.longDays[this.getDay()]; },
		    N: function() { return this.getDay() + 1; },
		    S: function() { return (this.getDate() % 10 == 1 && this.getDate() != 11 ? 'st' : (this.getDate() % 10 == 2 && this.getDate() != 12 ? 'nd' : (this.getDate() % 10 == 3 && this.getDate() != 13 ? 'rd' : 'th'))); },
		    w: function() { return this.getDay(); },
		    z: function() { var d = new Date(this.getFullYear(),0,1); return Math.ceil((this - d) / 86400000); }, // Fixed now
		    // Week
		    W: function() { var d = new Date(this.getFullYear(), 0, 1); return Math.ceil((((this - d) / 86400000) + d.getDay() + 1) / 7); }, // Fixed now
		    // Month
		    F: function() { return Date.replaceChars.longMonths[this.getMonth()]; },
		    m: function() { return (this.getMonth() < 9 ? '0' : '') + (this.getMonth() + 1); },
		    M: function() { return Date.replaceChars.shortMonths[this.getMonth()]; },
		    n: function() { return this.getMonth() + 1; },
		    t: function() { var d = new Date(); return new Date(d.getFullYear(), d.getMonth(), 0).getDate() }, // Fixed now, gets #days of date
		    // Year
		    L: function() { var year = this.getFullYear(); return (year % 400 == 0 || (year % 100 != 0 && year % 4 == 0)); },   // Fixed now
		    o: function() { var d  = new Date(this.valueOf());  d.setDate(d.getDate() - ((this.getDay() + 6) % 7) + 3); return d.getFullYear();}, //Fixed now
		    Y: function() { return this.getFullYear(); },
		    y: function() { return ('' + this.getFullYear()).substr(2); },
		    // Time
		    a: function() { return this.getHours() < 12 ? 'am' : 'pm'; },
		    A: function() { return this.getHours() < 12 ? 'AM' : 'PM'; },
		    B: function() { return Math.floor((((this.getUTCHours() + 1) % 24) + this.getUTCMinutes() / 60 + this.getUTCSeconds() / 3600) * 1000 / 24); }, // Fixed now
		    g: function() { return this.getHours() % 12 || 12; },
		    G: function() { return this.getHours(); },
		    h: function() { return ((this.getHours() % 12 || 12) < 10 ? '0' : '') + (this.getHours() % 12 || 12); },
		    H: function() { return (this.getHours() < 10 ? '0' : '') + this.getHours(); },
		    i: function() { return (this.getMinutes() < 10 ? '0' : '') + this.getMinutes(); },
		    s: function() { return (this.getSeconds() < 10 ? '0' : '') + this.getSeconds(); },
		    u: function() { var m = this.getMilliseconds(); return (m < 10 ? '00' : (m < 100 ?
		'0' : '')) + m; },
		    // Timezone
		    e: function() { return "Not Yet Supported"; },
		    I: function() {
		        var DST = null;
		            for (var i = 0; i < 12; ++i) {
		                    var d = new Date(this.getFullYear(), i, 1);
		                    var offset = d.getTimezoneOffset();

		                    if (DST === null) DST = offset;
		                    else if (offset < DST) { DST = offset; break; }                     else if (offset > DST) break;
		            }
		            return (this.getTimezoneOffset() == DST) | 0;
		        },
		    O: function() { return (-this.getTimezoneOffset() < 0 ? '-' : '+') + (Math.abs(this.getTimezoneOffset() / 60) < 10 ? '0' : '') + (Math.abs(this.getTimezoneOffset() / 60)) + '00'; },
		    P: function() { return (-this.getTimezoneOffset() < 0 ? '-' : '+') + (Math.abs(this.getTimezoneOffset() / 60) < 10 ? '0' : '') + (Math.abs(this.getTimezoneOffset() / 60)) + ':00'; }, // Fixed now
		    T: function() { var m = this.getMonth(); this.setMonth(0); var result = this.toTimeString().replace(/^.+ \(?([^\)]+)\)?$/, '$1'); this.setMonth(m); return result;},
		    Z: function() { return -this.getTimezoneOffset() * 60; },
		    // Full Date/Time
		    c: function() { return this.format("Y-m-d\\TH:i:sP"); }, // Fixed now
		    r: function() { return this.toString(); },
		    U: function() { return this.getTime() / 1000; }
		};

}

