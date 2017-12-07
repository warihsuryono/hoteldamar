<?php
	include_once "header.php";
	include_once "ajax.init.php";
?>
<script type="text/javascript">  
	function routine_read_order() {
		var xmlHttp;
		var total;
		var tr;
		xmlHttp=initializexmlHttp();
		xmlHttp.onreadystatechange=function() {
			if(xmlHttp.readyState==4) {
				txtmessage=xmlHttp.responseText;
				if(txtmessage!=""){
					//alert(txtmessage);
					document.getElementById('popupmessageid').innerHTML=txtmessage;
					document.getElementById('popupmessageid').style.visibility="visible";
				}else{
					document.getElementById('popupmessageid').innerHTML="";
					document.getElementById('popupmessageid').style.visibility="hidden";
				}
			}
		}
		xmlHttp.open("GET","routine_read_order.php",true);
		xmlHttp.send(null);			
	}	
		
	window.setTimeout("refresh()",1000);    
	function refresh() {     
		var tanggal = new Date();    
		setTimeout("refresh()",1000);   
		routine_read_order();
	}  
</script>
<div id="popupmessageid" style="border:1px;left:1px;top:1px; solid; color:#FF0000; height:20px; margin-top:0px; padding-left:7px; position:absolute;visibility:hidden;">
</div>
<h2><b>RESTAURANT ORDER</b></h2>
<?php include_once "footer.php"; ?>