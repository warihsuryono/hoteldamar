<?php include_once "ajax.init.php"; ?>
<script language="javascript">
	function unformat_number(pnumber){
		var xmlHttp;
		xmlHttp=initializexmlHttp();
		xmlHttp.onreadystatechange=function() {
			if(xmlHttp.readyState==4) {
				returnvalue=xmlHttp.responseText;
				return returnvalue;
			}
		}
		xmlHttp.open("GET","ajax.format_number.php?pnumber="+pnumber+"&mode=unformat",true);
		xmlHttp.send(null);	
	}
	function format_number(pnumber,elemen){
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
	function xxxunformat_number(pnumber){
		var temp =  pnumber;
		for(xx=0;xx<10;xx++){temp =  temp.replace(",", "");}
		return temp
	}
	function xxxformat_number(pnumber,elemen){
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
</script>
<?php
	function un_formated($number){
		$tempnum="";
		for ($xx=0;$xx<=strlen($number);$xx++){
			if(is_numeric(substr($number,$xx,1)) || substr($number,$xx,1)=="." || substr($number,$xx,1)=="-"){//hanya angka dan titik
				$tempnum.=substr($number,$xx,1);
			}
		}
		return $tempnum;
	}
	function isfractionalnumber($number){
		$arrtemp=explode(".",$number);
		$temp="";
		for ($x=strlen($arrtemp[1])-1;$x>=0;$x--){
			if(substr($arrtemp[1],$x,1)>0){$numdigit=$x+1;break;}
		}
		$number=number_format($number,$numdigit);
		return $number;
	}
	function vip_number_format($number){
		$temp=number_format($number,2);
		$arrtemp=explode(".",$temp);
		$return=$arrtemp[0];
		if($arrtemp[1]*1>0){
			$return.=".".$arrtemp[1];
		}else{
			$return.="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		}
		return $return;
	}
?>