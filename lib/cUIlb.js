
/*  -  EN PROCESO DE DESARROLLO - */
var uiBsq= function(){

	if (!Element.prototype.getElementsByClassName) {
		Element.prototype.getElementsByClassName = function(nameClass) {
		var hijos=new Array();var nodos=this.getElementsByTagName('*');var pattern = new RegExp("(^|\\s)"+nameClass+"(\\s|$)");
		for (n = 0; n < nodos.length; n++) {if (pattern.test(nodos[n].className)){hijos.push(nodos[n]);}}
		return (hijos);
		}
	}

	if (!Element.prototype.addEventListener) {
		Element.prototype.addEventListener = function(ev,nameFunction,b) {this.attachEvent('on'+ev,nameFunction);}
	}

	function ObjAjax(){
		var xmlhttp=false;try{ xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){try{ xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}catch(E) {xmlhttp=false;}}
		if (!xmlhttp && typeof XMLHttpRequest!="undefined") {xmlhttp=new XMLHttpRequest();}return xmlhttp;
	}


	var tList;

	this.ini=function(idInput,itdat){ //idat: tipo de dato a mostrar en el listado
		
		//iniHead('cUIlb');

		urlList="lib/uiList.php";
		eInput=document.getElementById(idInput);
		eParent=eInput.parentNode;
		iCreate(eParent);
	}

	/*function iniHead(nfile) {
		ihs=document.getElementsByTagName("head")[0].getElementsByTagName('script');bpf=false;
		for (n = 0; n < ihs.length; n++) {if(ihs[n].src.indexOf(nfile+".js")>0){pf=ihs[n].src.substring(0,ihs[n].src.lastIndexOf('/')+1);break;}}
		if(!bpf){(document.getElementsByTagName("head")[0] || document.documentElement).appendChild(ih);}
*/
	function iCreate(contP){
		tList=document.createElement("ul");
		tList.className="iListUI"
		tList.innerHTML="<li>1</li><li>2</li>"
		contP.appendChild(tList);
	}

}