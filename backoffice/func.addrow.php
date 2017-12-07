<script language="javascript">
	var numrow=1;
	function unformat_number(pnumber){
		var temp =  pnumber+",";
		for(zzz=0;zzz<10;zzz++){temp =  temp.replace(",", "");}
		retval=temp*1;
		return retval;
	}
	function number_format(pnumber,elemen){
		pnumber=unformat_number(pnumber);
		var sign="";
		if(pnumber<0){sign="-";}
		pnumber=pnumber+'';
		var lengthnum=pnumber.length;
		// alert("pnumber="+pnumber);
		// alert("lengthnum="+lengthnum);
		var number='';
		var isdecimal=false;
		yy=0;
		for (xx=0;xx<=lengthnum;xx++){//pengkoreksian angka
			// alert("pnumberxx="+pnumber.substr(xx,1));
			if(!isNaN(pnumber.substr(xx,1)) || pnumber.substr(xx,1)=="." || (pnumber.substr(xx,1)=="-" && xx==0)){//hanya angka dan titik
				if(pnumber.substr(xx,1)=="."){//sudah menggunakan desimal
					if(!isdecimal){number=number+''+pnumber.substr(xx,1);}
					isdecimal=true;
				}else{	
					if(isdecimal){yy++;}//mulai hitung desimal
					if(yy<3){number=number+''+pnumber.substr(xx,1);}//2 digit desimal 
				}
			}
		}
		if(isdecimal){startformat=false;}else{startformat=true;}
		// alert("number="+number);
		var retval='';
		yy=0;
		if(number.substr(0,1)=="-"){
			number=number.substr(1,number.length-1);
			sign="-";
		}else{
			sign="";
		}
		lengthnum=number.length;
		for (xx=lengthnum;xx>=0;xx--){
			tempnum=number.substr(xx,1);
			if(tempnum!=''){
				//alert(tempnum);
				if(startformat){
					yy++;
					if(yy==4){
						yy=1;
						retval=tempnum+','+retval;
					}else{
						retval=tempnum+''+retval;
					}
				}else{
					retval=tempnum+''+retval;
				}
				if(tempnum=="."){startformat=true;}
			}
			//alert(retval);
		}
		if(elemen!=""){
			elemen.value=sign+retval;
		}else{
			return sign+retval;
		}
	}
	function sumnumber(elmid,elmtotaltype,totalid,notax){
		var total=0;
		for(xx=0;xx<numrow;xx++){
			if(elmtotaltype=="input"){elmvalue=document.getElementById(elmid+"["+xx+"]").value;}
			if(elmtotaltype=="td"){elmvalue=document.getElementById(elmid+"["+xx+"]").innerHTML;}
			elmvalue=unformat_number(elmvalue);
			total=total+elmvalue;
		}
		total=number_format(total,"");
		if(elmtotaltype=="input"){document.getElementById(totalid).value=total;}
		if(elmtotaltype=="td"){document.getElementById(totalid).innerHTML=total;}
		total=unformat_number(total);
		ppnnom=total*0.1;
		if(notax){ppnnom=0;}
		grandtotal=total+ppnnom;
		ppnnom=number_format(ppnnom,"");
		grandtotal=number_format(grandtotal,"");
		
		if(elmtotaltype=="input"){
			try{document.getElementById("ppn").value=ppnnom;} catch (ex) {}
			try{document.getElementById("total").value=grandtotal;} catch (ex) {}
		}
		if(elmtotaltype=="td"){
			try{document.getElementById("ppn").innerHTML=ppnnom;} catch (ex) {}
			try{document.getElementById("total").innerHTML=grandtotal;} catch (ex) {}
		}
	}
	function sumnumber_inner(elmid,elmtotaltype,totalid,notax){
		var total=0;
		for(xx=0;xx<numrow;xx++){
			elmvalue=document.getElementById(elmid+"["+xx+"]").innerHTML;
			elmvalue=unformat_number(elmvalue);
			total=total+elmvalue;
		}
		total=number_format(total,"");
		if(elmtotaltype=="input"){document.getElementById(totalid).innerHTML=total;}
		if(elmtotaltype=="td"){document.getElementById(totalid).innerHTML=total;}
		total=unformat_number(total);
		ppnnom=total*0.1;
		if(notax){ppnnom=0;}
		grandtotal=total+ppnnom;
		ppnnom=number_format(ppnnom,"");
		grandtotal=number_format(grandtotal,"");
		try{document.getElementById("ppn").innerHTML=ppnnom;} catch (ex) {}
		try{document.getElementById("total").innerHTML=grandtotal;} catch (ex) {}
	}
	function addtabulasi(idtab,mode,elmnumtab){
		//cari jumlah tabulasi
		innernumtab=document.getElementById(idtab).innerHTML;
		numtab=document.getElementById(elmnumtab).innerHTML;
		document.getElementById(elmnumtab).innerHTML=numtab;
		tabulasi="&nbsp;&nbsp;&nbsp;&nbsp;&gt;&gt;";
		if(mode=="+"){document.getElementById(idtab).innerHTML=innernumtab+tabulasi;}
		if(mode=="-"){document.getElementById(idtab).innerHTML=document.getElementById(idtab).innerHTML.replace(tabulasi,"");}
	}
	function addrow(formno,idtable,idrow,mode){
		var numberelements = document.forms[formno].elements.length;
		var arrelement=new Array();
		var arrelementtype=new Array();
		//buffering value form
		delrow="";
		if(mode=="+"){numrow++;}
		if(mode=="-" && numrow-1>0){numrow--;}
		if(mode!="-" && mode!="+"){
			delrow=mode;
			delrowindex=delrow.replace("[","");
			delrowindex=delrowindex.replace("]","");
		}
		for (elmIndex = 0; elmIndex < numberelements; elmIndex++){
			if(document.forms[formno].elements[elmIndex].id.indexOf(delrow)>0){//baris yang di delete
				document.forms[formno].elements[elmIndex].value="";
			}
			arrelementtype[elmIndex]=document.forms[formno].elements[elmIndex].type;
			if(arrelementtype[elmIndex]=="text" || arrelementtype[elmIndex]=="textarea" || arrelementtype[elmIndex]=="select-one"){
				arrelement[elmIndex]=document.forms[formno].elements[elmIndex].value;
			}
			if(arrelementtype[elmIndex]=="radio" || arrelementtype[elmIndex]=="checkbox"){
				arrelement[elmIndex]=document.forms[formno].elements[elmIndex].checked;
			}
			
		}
		try{innertagrow_header="<tr class='content_header' id='"+idrow+"_header'>"+document.getElementById(idrow+"_header").innerHTML+"</tr>";}catch(err){innertagrow_header="";}
		try{innertagrow_footer="<tr id='"+idrow+"_footer'>"+document.getElementById(idrow+"_footer").innerHTML+"</tr>";}catch(err){innertagrow_footer="";}
		tempinnertagrow="<tr id='"+idrow+"' class='content_ganjil'>"+document.getElementById(idrow).innerHTML+"</tr>";
		
		innertagrow="";
		for(xx=0;xx<numrow;xx++){
			mod=xx % 2;
			xx_1=xx+1;
			tempinnertagrow2=tempinnertagrow;
			for(yy=0;yy<20;yy++){
				tempinnertagrow2=tempinnertagrow2.replace("[0]","["+xx+"]");
				tempinnertagrow2=tempinnertagrow2.replace("  1 ","  "+xx_1+" ");
				if(mod==0){tempinnertagrow2=tempinnertagrow2.replace("content_ganjil","content_ganjil");}
				if(mod!=0){tempinnertagrow2=tempinnertagrow2.replace("content_ganjil","content_genap");}
			}
			innertagrow=innertagrow+tempinnertagrow2;
		}
		
		document.getElementById(idtable).innerHTML=innertagrow_header+innertagrow+innertagrow_footer;
		
		//pengisian value form
		for (elmIndex = 0; elmIndex < numberelements; elmIndex++){
			if(arrelementtype[elmIndex]=="text" || arrelementtype[elmIndex]=="textarea" || arrelementtype[elmIndex]=="select-one"){
				document.forms[formno].elements[elmIndex].value=arrelement[elmIndex];
			}
			if(arrelementtype[elmIndex]=="radio" || arrelementtype[elmIndex]=="checkbox"){
				document.forms[formno].elements[elmIndex].checked=arrelement[elmIndex];
			}
		}
		windowparentheight=window.parent.document.getElementById('main_frame_id').height;
		//alert(windowparentheight);
		windowparentheight=windowparentheight*1;
		windowparentheight=windowparentheight+30;
		//alert(windowparentheight);
		window.parent.document.getElementById('main_frame_id').height=windowparentheight;
	}
	function hitungjumlah (qty,harga,jumlah){
		qty=document.getElementById(qty).value;qty=unformat_number(qty);
		harga=document.getElementById(harga).value;harga=unformat_number(harga);
		total=qty*harga;
		total=number_format(total,"");
		document.getElementById(jumlah).value=total;
	}
	function hitungjumlah_inner (qty,harga,jumlah){
		qty=document.getElementById(qty).innerHTML;qty=unformat_number(qty);
		harga=document.getElementById(harga).innerHTML;harga=unformat_number(harga);
		total=qty*harga;
		total=number_format(total,"");
		document.getElementById(jumlah).innerHTML=total;
	}
</script>