<?php
	if(!$_GET["nfl"]){
?>
	<script language="JavaScript">
		window.location="calendar.php?mode=<?php echo $_GET["mode"]; ?>&datevalue="+window.opener.document.getElementById("<?php echo $_GET["textid"]; ?>").value+"&textid=<?php echo $_GET["textid"]; ?>&nfl=1";
	</script>
<?php
	}
?>
<script language="JavaScript">
	window.resizeTo(280,380);
	function showparent(tgl,bln,thn,textid){
		<?php if($_GET["mode"]=="periode"){ ?>
		window.opener.document.getElementById(textid).value=thn+"-"+bln+"-01";
		<?php }else{ ?>
		window.opener.document.getElementById(textid).value=thn+"-"+bln+"-"+tgl;
		<?php } ?>
		window.close();
	}
</script>
<?php
	include_once "header_window_content.php";
	$datevalue=$_GET["datevalue"];
	$selected_date=date("d");
	if($datevalue){
		$_GET['year']=substr($datevalue,0,4);
		$_GET['month']=substr($datevalue,5,2);
		$_GET['tanggal']=substr($datevalue,8,2);
		$selected_date=$_GET['tanggal'];
	}
	$thismonth=date("m");
	$thisyear=date("Y");
	$currentmonth=$thismonth;
	$currentyear=$thisyear;
	if(isset($_GET['month'])) 
		if($_GET['month']!="")
			$currentmonth=$_GET['month'];
	
	if (isset($_GET['year']))
		if($_GET['year']!="")
			$currentyear=$_GET['year'];
	
	$firstday=date("w",mktime(0, 0, 0, $currentmonth , 1, $currentyear));
	$maxday=date("d",mktime(0, 0, 0, $currentmonth+1 , 0, $currentyear));
	$textmonth=date("M",mktime(0, 0, 0, $currentmonth, 1, $currentyear));
	$textyear=date("Y",mktime(0, 0, 0, $currentmonth, 1, $currentyear));
	$date=1;
	$lastmonth=date("m",mktime(0, 0, 0, $currentmonth-1, 1, $currentyear));
	$nextmonth=date("m",mktime(0, 0, 0, $currentmonth+1, 1, $currentyear));
	$lastyear_m=date("Y",mktime(0, 0, 0, $currentmonth-1, 1, $currentyear));
	$nextyear_m=date("Y",mktime(0, 0, 0, $currentmonth+1, 1, $currentyear));
	$lastyear=$currentyear-1;
	$nextyear=$currentyear+1;
?>
<table border=0 cellpadding=2 cellspacing=2>
	<tr>
		<td colspan="7" align="center">
			<b><!--Bulan-->
				<a href="calendar.php?mode=<?php echo $_GET["mode"]; ?>&year=<?php echo $currentyear; ?>&month=<?php echo $lastmonth; ?>&year=<?php echo $lastyear_m; ?>&textid=<?php echo $_GET['textid']; ?>&nfl=1"><<</a> 
					<?php echo $textmonth;?> 
				<a href="calendar.php?mode=<?php echo $_GET["mode"]; ?>&year=<?php echo $currentyear; ?>&month=<?php echo $nextmonth; ?>&year=<?php echo $nextyear_m; ?>&textid=<?php echo $_GET['textid']; ?>&nfl=1">>></a>
			</b>
			&nbsp;&nbsp;<!--tahun-->
			<b>
				<a href="calendar.php?mode=<?php echo $_GET["mode"]; ?>&month=<?php echo $currentmonth; ?>&year=<?php echo $lastyear; ?>&textid=<?php echo $_GET['textid']; ?>&nfl=1"><<</a> 
				<?php echo $textyear;?> 
				<a href="calendar.php?mode=<?php echo $_GET["mode"]; ?>&month=<?php echo $currentmonth; ?>&year=<?php echo $nextyear; ?>&textid=<?php echo $_GET['textid']; ?>&nfl=1">>></a>
			</b>
		</td>
	</tr>
	<br>
	<tr>
		<td align="right"><b>Sun</b></td>
		<td align="right"><b>Mon</b></td>
		<td align="right"><b>Tue</b></td>
		<td align="right"><b>Wed</b></td>
		<td align="right"><b>Thu</b></td>
		<td align="right"><b>Fri</b></td>
		<td align="right"><b>Sat</b></td>
	</tr>
	<?php
		while ($date<$maxday+1){
	?>
		<tr>
		<?php
			for ($xx=0;$xx<$firstday;$xx++){
		?>			
			<td align="right">&nbsp;</td>
		<?php
			}
		?>
	<?php
			for ($day=$firstday;$day<7;$day++){
				$textdate=$date;
				if(strlen($textdate)==1){$textdate="0".$textdate;}
				$textbln=$currentmonth;
				if(strlen($textbln)==1){$textbln="0".$textbln;}
				if($date<$maxday+1){
	?>
				<td align="right">
					<a href="" onclick="return showparent('<?php echo $textdate; ?>','<?php echo $textbln; ?>','<?php echo $currentyear; ?>','<?php echo $_GET['textid']; ?>')">
						<?php 
							if ($textdate==$selected_date){echo "<b><font color=#000000>";}
							echo $date; 
							if ($textdate==$selected_date){echo "</font></b>";}
						?>
					</a>
				</td>
	<?php
				}else{				
	?>
				<td align="right">&nbsp;</td>
	<?php
				}
				$date++;
			}
	?>
		</tr>
	<?php
			$firstday=0;
		}
	?>
</table>
<?php
	include_once "footer_window_content.php";
?>