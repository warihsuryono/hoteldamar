<script language="JavaScript">
	function showparent(textid,textvalue,noloaddetail){
		window.opener.document.getElementById(textid).value=textvalue;
		try{window.opener.document.getElementById(textid+"hide").value=textvalue;}catch(err){}
		if(noloaddetail==""){try{window.opener.loaddetailinfo("<?php echo $_tablename; ?>",textid,textvalue);}catch(err){}}
		window.close();
	}
	function showcoaparent(coaid,coavalue,koderid,kodervalue,descid,descvalue,mode){
		if(mode=="add"){
			try{window.opener.document.getElementById(coaid).value+=coavalue+";";}catch(err){}
		}else{
			try{window.opener.document.getElementById(coaid).value=coavalue;}catch(err){}
			try{window.opener.document.getElementById(koderid).value=kodervalue;}catch(err){}
			try{window.opener.document.getElementById(descid).value=descvalue;}catch(err){}
		}
		window.close();
	}
	function showparent_loadqr(textid,textvalue,vendorid){
		window.opener.document.getElementById(textid).value=textvalue;
		try{window.opener.loaddetailqr(textvalue,vendorid);}catch(err){}
		window.close();
	}
	function showparent_loadmr(textid,textvalue){
		window.opener.document.getElementById(textid).value=textvalue;
		try{window.opener.loaddetailmr(textvalue);}catch(err){}
		window.close();
	}
	function showparent_loadpermdana(textid,textvalue){
		window.opener.document.getElementById(textid).value=textvalue;
		try{window.opener.loaddetailpermdana(textvalue);}catch(err){}
		window.close();
	}
	function showparent_loadpo(textid,textvalue){
		window.opener.document.getElementById(textid).value=textvalue;
		try{window.opener.loaddetailpo(textvalue);}catch(err){}
		window.close();
	}
	function showparent_loadpr(textid,textvalue){
		window.opener.document.getElementById(textid).value=textvalue;
		try{window.opener.loaddetailpr(textvalue);}catch(err){}
		window.close();
	}
</script>