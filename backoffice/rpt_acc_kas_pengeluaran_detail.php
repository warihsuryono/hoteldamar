<?php 
	if($_POST["export"]){
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=report.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		$_POST["load"]="LOAD";
	}
	include_once "header.php";
	$arrpost=sanitasi($_GET["arrpost"]);
	if($arrpost){$_POST=unserialize(base64_decode($arrpost));}
	$reset=sanitasi($_POST["reset"]);
	$periode=$_POST["periode"];
	if(!$periode){$periode=date("Y-m-")."01";}
	if($_POST["load"] || $_POST["detail"] || $_POST["export"]){$load=1;}
?>
<?php if($load){ ?>
<?php
	$totalcolom=6;
	$_periode=explode("-",$_POST["periode"]);
	$_tanggal=date("Y-m-",mktime(0,0,0,$_periode[1],1,$_periode[0]));
	$_periode=date("F Y",mktime(0,0,0,$_periode[1],1,$_periode[0]));
	$debittotal=0;
	$arrkodejurnal="";
?>
<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>HOTEL DAMAR</h3></td></tr></table>
<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>KAS PENGELUARAN</h3></td></tr></table>
<table width="100%"><tr><td align="center" <?php if($_POST["export"]) {echo "colspan=$totalcolom";} ?>><h3>No. 01 Bln. <?php echo $_periode; ?></h3></td></tr></table>
<table width="100%" class="content_table" <?php if($_POST["export"]) {echo "border=1";} ?>>
	<tr class="content_header">
		<td><b>TGL</b></td>
		<td><b>NO</b></td>
		<td><b>NO. ACC</b></td>
		<td><b>KETERANGAN</b></td>
		<td><b>KAS KREDIT</b></td>
		<td><b>NAMA ACCOUNT</b></td>
	</tr>
	<?php
		$arrkodejurnal=array();
		$sql="SELECT coa FROM acc_setting_coa WHERE id='1'";
		$hsltemp=mysql_query($sql,$db);
		list($coakas)=mysql_fetch_array($hsltemp);
		$sql="SELECT kodejurnal FROM acc_jurnal_detail WHERE kodejurnal IN (SELECT kodejurnal FROM acc_jurnal WHERE tanggal LIKE '$_tanggal%') AND coa='$coakas' AND debit=0 AND kredit <> 0";
		$hsltemp=mysql_query($sql,$db);
		while(list($kodejurnal)=mysql_fetch_array($hsltemp)){
			$arrkodejurnal[$kodejurnal]=1;
		}
		$sql="SELECT coa FROM acc_mst_coa WHERE description LIKE 'bank%'";
		$hslbank=mysql_query($sql,$db);
		while(list($coabank)=mysql_fetch_array($hslbank)){
			$sql="SELECT kodejurnal FROM acc_jurnal_detail WHERE kodejurnal IN (SELECT kodejurnal FROM acc_jurnal WHERE tanggal LIKE '$_tanggal%') AND coa='$coabank' AND debit=0 AND kredit <> 0";
			$hsltemp=mysql_query($sql,$db);
			$debitbank=0;
			while(list($kodejurnal)=mysql_fetch_array($hsltemp)){
				$arrkodejurnal[$kodejurnal]=1;
			}
		}
		$_kodejurnal="";
		foreach($arrkodejurnal as $kodejurnal => $val){
			$_kodejurnal.="'$kodejurnal',";
		}
		$_kodejurnal=substr($_kodejurnal,0,strlen($_kodejurnal)-1);
		$sql="SELECT kodejurnal,coa,keterangan,debit FROM acc_jurnal_detail WHERE kodejurnal IN ($_kodejurnal) AND kredit='0' ORDER BY kodejurnal";
		$hslkredit=mysql_query($sql,$db);
		$total=0;
		while(list($kodejurnal,$coa,$keterangan,$kredit)=mysql_fetch_array($hslkredit)){
			if($kredit!=0){
				$sql="SELECT description FROM acc_mst_coa WHERE coa='$coa'";
				$hsltemp=mysql_query($sql,$db);
				list($description)=mysql_fetch_array($hsltemp);
				$sql="SELECT tanggal FROM acc_jurnal WHERE kodejurnal='$kodejurnal'";
				$hsltemp=mysql_query($sql,$db);
				list($tanggal)=mysql_fetch_array($hsltemp);
				$total+=$kredit;
		?>
		<tr>
			<td><?php echo $tanggal; ?></td>
			<td><?php echo $kodejurnal; ?></td>
			<td><?php echo $coa; ?></td>
			<td><?php echo $keterangan; ?></td>
			<td align="right"><?php echo number_format($kredit,2); ?></td>
			<td><?php echo $description; ?></td>
		</tr>
	<?php
			}
		}
	?>
	<tr>
		<td colspan="3">&nbsp;</td>
		<td><b>TOTAL</b></td>
		<td align="right"><b><?php echo number_format($total,2);?></b></td>
	</tr>
</table>
<?php } ?>
<?php include_once "footer.php"; ?>