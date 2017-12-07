<style>
	.boxBtn{
		height:25px; 
		width:153px; 
		background:url(images/button.gif) left no-repeat; 		
	}
	.boxBtn td{
		white-space:nowrap; 
		padding:0 0 0 10px;
		font-size:12px; 
		font-weight:bold;
		color:#fff;
	}
	.boxBtn span{
		color:#fff;
	}
	.boxBtnHover{
		height:25px; 
		width:153px; 
		background:url(images/button_hover.gif) left no-repeat; 		
	}
	.boxBtnHover span{
		color:#f00;
	}	
	.boxBtnHover td{
		white-space:nowrap; 
		padding:0 0 0 10px;
		font-size:12px; 
		font-weight:bold;
		color:#fff;
	}
</style>
	<?php
		$sql="SELECT id_menu,caption,url FROM menu WHERE status='1' AND menubox='1' ORDER BY id_parent,seqno";
		$hslmenubox=mysql_query($sql,$db);
		while(list($_id_menu,$_caption,$_url)=mysql_fetch_array($hslmenubox)){
	?>
	<a href="#"><table class="boxBtn" cellpadding="0" cellspacing="0" onmouseover="this.className='boxBtnHover';" onmouseout="this.className='boxBtn';" onclick="main_frame.window.location='<?php echo $_url."?x_idmenu=".$_id_menu;?>';">
	<tr><td><span><?php echo strtoupper($_caption); ?></span></td></tr>
	</table></a>
	<table cellpadding="0" cellspacing="0" height="5"><tr><td></td></tr></table>
	<!--td><button value="submit" class="submitBtn" onclick="main_frame.window.location='<?php echo $_url."?x_idmenu=".$_id_menu;?>';"><span><?php //echo $_caption; ?></span></button></td></tr-->
	<!--tr><td class="button_td"><a href="#" class="submitBtn" onclick="main_frame.window.location='<?php echo $_url."?x_idmenu=".$_id_menu;?>';"><?php echo $_caption; ?></a></td></tr-->
	<?php
		}
	?>