<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "asset_detailinfo.php" ?>
<?php include "asset_categoryinfo.php" ?>
<?php include "userfn6.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Define page object
$asset_detail_list = new casset_detail_list();
$Page =& $asset_detail_list;

// Page init processing
$asset_detail_list->Page_Init();

// Page main processing
$asset_detail_list->Page_Main();
?>
<?php include "header.php" ?>
<?php include "func.openwin.php" ?>
<?php include_once "ajax.init.php"; ?>
	<script language="javascript">
		function loaddetailinfo(wintablename,textid,textvalue){
			var xmlHttp;
			xmlHttp=initializexmlHttp();
			xmlHttp.onreadystatechange=function() {
				if(xmlHttp.readyState==4) {
					returnvalue=xmlHttp.responseText;
					//alert(returnvalue);
					idnamabarang=textid.replace("kodebarang","namabarang");
					idsatuan=textid.replace("kodebarang","satuan");
					arrreturnvalue=returnvalue.split("|||");
					arrtextid=textid.split("_");
					namabarangid=arrtextid[0]+"_nama_barang";
					//document.getElementById(idnamabarang).value=arrreturnvalue[0];
					document.getElementById(namabarangid).value=arrreturnvalue[0];
				}
			}
			//xmlHttp.open("GET","ajax.loaddetailinfo.php?wintablename="+wintablename+"&tablename=<?php echo $tablename; ?>&value="+textvalue+"&kode_pekerjaan="+document.getElementById("kode_pekerjaan").value,true);
			xmlHttp.open("GET","ajax.loaddetailinfo.php?wintablename="+wintablename+"&tablename=<?php echo $tablename; ?>&value="+textvalue,true);
			xmlHttp.send(null);	
		}
	</script>
<?php if ($asset_detail->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var asset_detail_list = new ew_Page("asset_detail_list");

// page properties
asset_detail_list.PageID = "list"; // page ID
var EW_PAGE_ID = asset_detail_list.PageID; // for backward compatibility

// extend page with ValidateForm function
asset_detail_list.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_category"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Category");
		elm = fobj.elements["x" + infix + "_kode_barang"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Kode Barang");
		elm = fobj.elements["x" + infix + "_nama_barang"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Nama Barang");
		elm = fobj.elements["x" + infix + "_jml"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Jml");
		elm = fobj.elements["x" + infix + "_jml"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Incorrect floating point number - Jml");
		elm = fobj.elements["x" + infix + "_tgl_pembelian"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Tgl Pembelian");
		elm = fobj.elements["x" + infix + "_tgl_pembelian"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Tgl Pembelian");
		elm = fobj.elements["x" + infix + "_nilai_pembelian"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Nilai Pembelian");
		elm = fobj.elements["x" + infix + "_nilai_pembelian"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Incorrect floating point number - Nilai Pembelian");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
asset_detail_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
asset_detail_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
asset_detail_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($asset_detail->Export == "") { ?>
<?php
$gsMasterReturnUrl = "asset_categorylist.php";
if ($asset_detail_list->sDbMasterFilter <> "" && $asset_detail->getCurrentMasterTable() == "asset_category") {
	if ($asset_detail_list->bMasterRecordExists) {
		if ($asset_detail->getCurrentMasterTable() == $asset_detail->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include "asset_categorymaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = ($asset_detail->Export == "" && $asset_detail->SelectLimit);
	if (!$bSelectLimit)
		$rs = $asset_detail_list->LoadRecordset();
	$asset_detail_list->lTotalRecs = ($bSelectLimit) ? $asset_detail->SelectRecordCount() : $rs->RecordCount();
	$asset_detail_list->lStartRec = 1;
	if ($asset_detail_list->lDisplayRecs <= 0) // Display all records
		$asset_detail_list->lDisplayRecs = $asset_detail_list->lTotalRecs;
	if (!($asset_detail->ExportAll && $asset_detail->Export <> ""))
		$asset_detail_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $asset_detail_list->LoadRecordset($asset_detail_list->lStartRec-1, $asset_detail_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Asset Detail</b></h3>
<?php if ($asset_detail->Export == "" && $asset_detail->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $asset_detail_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php $asset_detail_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($asset_detail->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($asset_detail->CurrentAction <> "gridadd" && $asset_detail->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($asset_detail_list->Pager)) $asset_detail_list->Pager = new cPrevNextPager($asset_detail_list->lStartRec, $asset_detail_list->lDisplayRecs, $asset_detail_list->lTotalRecs) ?>
<?php if ($asset_detail_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($asset_detail_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $asset_detail_list->PageUrl() ?>start=<?php echo $asset_detail_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($asset_detail_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $asset_detail_list->PageUrl() ?>start=<?php echo $asset_detail_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $asset_detail_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($asset_detail_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $asset_detail_list->PageUrl() ?>start=<?php echo $asset_detail_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($asset_detail_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $asset_detail_list->PageUrl() ?>start=<?php echo $asset_detail_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $asset_detail_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $asset_detail_list->Pager->FromIndex ?> to <?php echo $asset_detail_list->Pager->ToIndex ?> of <?php echo $asset_detail_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($asset_detail_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($asset_detail_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="asset_detail">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($asset_detail_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($asset_detail_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($asset_detail_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($asset_detail_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($asset_detail_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($asset_detail_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $asset_detail_list->PageUrl() ?>a=add"><img src="images/expand.gif" title="Add" width="16" height="16" border="0"></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fasset_detaillist" id="fasset_detaillist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="asset_detail">
<?php if ($asset_detail_list->lTotalRecs > 0 || $asset_detail->CurrentAction == "add" || $asset_detail->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$asset_detail_list->lOptionCnt = 0;
	$asset_detail_list->lOptionCnt++; // edit
	$asset_detail_list->lOptionCnt++; // Delete
	$asset_detail_list->lOptionCnt += count($asset_detail_list->ListOptions->Items); // Custom list options
?>
<?php echo $asset_detail->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($asset_detail->kode->Visible) { // kode ?>
	<?php if ($asset_detail->SortUrl($asset_detail->kode) == "") { ?>
		<td style="white-space: nowrap;">Kode</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $asset_detail->SortUrl($asset_detail->kode) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode</td><td style="width: 10px;"><?php if ($asset_detail->kode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($asset_detail->kode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($asset_detail->category->Visible) { // category ?>
	<?php if ($asset_detail->SortUrl($asset_detail->category) == "") { ?>
		<td style="white-space: nowrap;">Category</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $asset_detail->SortUrl($asset_detail->category) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Category</td><td style="width: 10px;"><?php if ($asset_detail->category->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($asset_detail->category->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($asset_detail->kode_barang->Visible) { // kode_barang ?>
	<?php if ($asset_detail->SortUrl($asset_detail->kode_barang) == "") { ?>
		<td style="white-space: nowrap;">Kode Barang</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $asset_detail->SortUrl($asset_detail->kode_barang) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode Barang</td><td style="width: 10px;"><?php if ($asset_detail->kode_barang->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($asset_detail->kode_barang->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($asset_detail->nama_barang->Visible) { // nama_barang ?>
	<?php if ($asset_detail->SortUrl($asset_detail->nama_barang) == "") { ?>
		<td style="white-space: nowrap;">Nama Barang</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $asset_detail->SortUrl($asset_detail->nama_barang) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Nama Barang</td><td style="width: 10px;"><?php if ($asset_detail->nama_barang->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($asset_detail->nama_barang->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($asset_detail->jml->Visible) { // jml ?>
	<?php if ($asset_detail->SortUrl($asset_detail->jml) == "") { ?>
		<td style="white-space: nowrap;">Jml</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $asset_detail->SortUrl($asset_detail->jml) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Jml</td><td style="width: 10px;"><?php if ($asset_detail->jml->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($asset_detail->jml->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($asset_detail->tgl_pembelian->Visible) { // tgl_pembelian ?>
	<?php if ($asset_detail->SortUrl($asset_detail->tgl_pembelian) == "") { ?>
		<td style="white-space: nowrap;">Tgl Pembelian</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $asset_detail->SortUrl($asset_detail->tgl_pembelian) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tgl Pembelian</td><td style="width: 10px;"><?php if ($asset_detail->tgl_pembelian->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($asset_detail->tgl_pembelian->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($asset_detail->nilai_pembelian->Visible) { // nilai_pembelian ?>
	<?php if ($asset_detail->SortUrl($asset_detail->nilai_pembelian) == "") { ?>
		<td style="white-space: nowrap;">Nilai Pembelian</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $asset_detail->SortUrl($asset_detail->nilai_pembelian) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Nilai Pembelian</td><td style="width: 10px;"><?php if ($asset_detail->nilai_pembelian->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($asset_detail->nilai_pembelian->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($asset_detail->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php if ($asset_detail_list->lOptionCnt == 0 && $asset_detail->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($asset_detail_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
	if ($asset_detail->CurrentAction == "add" || $asset_detail->CurrentAction == "copy") {
		$asset_detail_list->lRowIndex = 1;
		if ($asset_detail->CurrentAction == "add")
			$asset_detail_list->LoadDefaultValues();
		if ($asset_detail->EventCancelled) // Insert failed
			$asset_detail_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$asset_detail->CssClass = "ewTableEditRow";
		$asset_detail->CssStyle = "";
		$asset_detail->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
		$asset_detail->RowType = EW_ROWTYPE_ADD;

		// Render row
		$asset_detail_list->RenderRow();
?>
	<tr<?php echo $asset_detail->RowAttributes() ?>>
	<?php if ($asset_detail->kode->Visible) { // kode ?>
		<td style="white-space: nowrap;">&nbsp;</td>
	<?php } ?>
	<?php if ($asset_detail->category->Visible) { // category ?>
		<td style="white-space: nowrap;">
<?php if ($asset_detail->category->getSessionValue() <> "") { ?>
<div<?php echo $asset_detail->category->ViewAttributes() ?>><?php echo $asset_detail->category->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $asset_detail_list->lRowIndex ?>_category" name="x<?php echo $asset_detail_list->lRowIndex ?>_category" value="<?php echo ew_HtmlEncode($asset_detail->category->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $asset_detail_list->lRowIndex ?>_category" name="x<?php echo $asset_detail_list->lRowIndex ?>_category"<?php echo $asset_detail->category->EditAttributes() ?>>
<?php
if (is_array($asset_detail->category->EditValue)) {
	$arwrk = $asset_detail->category->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($asset_detail->category->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_detail->kode_barang->Visible) { // kode_barang ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $asset_detail_list->lRowIndex ?>_kode_barang" id="x<?php echo $asset_detail_list->lRowIndex ?>_kode_barang" size="15" maxlength="20" value="<?php echo $asset_detail->kode_barang->EditValue ?>"<?php echo $asset_detail->kode_barang->EditAttributes() ?>>
<img src="images/b_search.png" title="Daftar Kode Barang" border="0" width="13" height="13"  onclick="showMaterial('x<?php echo $asset_detail_list->lRowIndex ?>_kode_barang')">
</td>
	<?php } ?>
	<?php if ($asset_detail->nama_barang->Visible) { // nama_barang ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $asset_detail_list->lRowIndex ?>_nama_barang" id="x<?php echo $asset_detail_list->lRowIndex ?>_nama_barang" size="30" maxlength="200" value="<?php echo $asset_detail->nama_barang->EditValue ?>"<?php echo $asset_detail->nama_barang->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($asset_detail->jml->Visible) { // jml ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $asset_detail_list->lRowIndex ?>_jml" id="x<?php echo $asset_detail_list->lRowIndex ?>_jml" size="3" value="<?php echo $asset_detail->jml->EditValue ?>"<?php echo $asset_detail->jml->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($asset_detail->tgl_pembelian->Visible) { // tgl_pembelian ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $asset_detail_list->lRowIndex ?>_tgl_pembelian" id="x<?php echo $asset_detail_list->lRowIndex ?>_tgl_pembelian" value="<?php echo $asset_detail->tgl_pembelian->EditValue ?>"<?php echo $asset_detail->tgl_pembelian->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x<?php echo $asset_detail_list->lRowIndex ?>_tgl_pembelian" name="cal_x<?php echo $asset_detail_list->lRowIndex ?>_tgl_pembelian" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x<?php echo $asset_detail_list->lRowIndex ?>_tgl_pembelian", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x<?php echo $asset_detail_list->lRowIndex ?>_tgl_pembelian" // ID of the button
});
</script>
</td>
	<?php } ?>
	<?php if ($asset_detail->nilai_pembelian->Visible) { // nilai_pembelian ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $asset_detail_list->lRowIndex ?>_nilai_pembelian" id="x<?php echo $asset_detail_list->lRowIndex ?>_nilai_pembelian" size="20" value="<?php echo $asset_detail->nilai_pembelian->EditValue ?>"<?php echo $asset_detail->nilai_pembelian->EditAttributes() ?>>
</td>
	<?php } ?>
<td colspan="<?php echo $asset_detail_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (asset_detail_list.ValidateForm(document.fasset_detaillist)) document.fasset_detaillist.submit();return false;"><img src="images/save.gif" title="Insert" width="16" height="16" border="0"></a>&nbsp;<a href="<?php echo $asset_detail_list->PageUrl() ?>a=cancel"><img src="images/b_drop.png" title="Cancel" width="16" height="16" border="0"></a>
<input type="hidden" name="a_list" id="a_list" value="insert">
</span></td>
	</tr>
<?php
}
?>
<?php
if ($asset_detail->ExportAll && $asset_detail->Export <> "") {
	$asset_detail_list->lStopRec = $asset_detail_list->lTotalRecs;
} else {
	$asset_detail_list->lStopRec = $asset_detail_list->lStartRec + $asset_detail_list->lDisplayRecs - 1; // Set the last record to display
}
$asset_detail_list->lRecCount = $asset_detail_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$asset_detail->SelectLimit && $asset_detail_list->lStartRec > 1)
		$rs->Move($asset_detail_list->lStartRec - 1);
}
$asset_detail_list->lRowCnt = 0;
$asset_detail_list->lEditRowCnt = 0;
if ($asset_detail->CurrentAction == "edit")
	$asset_detail_list->lRowIndex = 1;
while (($asset_detail->CurrentAction == "gridadd" || !$rs->EOF) &&
	$asset_detail_list->lRecCount < $asset_detail_list->lStopRec) {
	$asset_detail_list->lRecCount++;
	if (intval($asset_detail_list->lRecCount) >= intval($asset_detail_list->lStartRec)) {
		$asset_detail_list->lRowCnt++;

	// Init row class and style
	$asset_detail->CssClass = "";
	$asset_detail->CssStyle = "";
	$asset_detail->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($asset_detail->CurrentAction == "gridadd") {
		$asset_detail_list->LoadDefaultValues(); // Load default values
	} else {
		$asset_detail_list->LoadRowValues($rs); // Load row values
	}
	$asset_detail->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($asset_detail->CurrentAction == "edit") {
		if ($asset_detail_list->CheckInlineEditKey() && $asset_detail_list->lEditRowCnt == 0) // Inline edit
			$asset_detail->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($asset_detail->RowType == EW_ROWTYPE_EDIT && $asset_detail->EventCancelled) { // Update failed
		if ($asset_detail->CurrentAction == "edit")
			$asset_detail_list->RestoreFormValues(); // Restore form values
	}
	if ($asset_detail->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$asset_detail_list->lEditRowCnt++;
		$asset_detail->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($asset_detail->RowType == EW_ROWTYPE_ADD || $asset_detail->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$asset_detail->CssClass = "ewTableEditRow";

	// Render row
	$asset_detail_list->RenderRow();
?>
	<tr<?php echo $asset_detail->RowAttributes() ?>>
	<?php if ($asset_detail->kode->Visible) { // kode ?>
		<td<?php echo $asset_detail->kode->CellAttributes() ?>>
<?php if ($asset_detail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $asset_detail->kode->ViewAttributes() ?>><?php echo $asset_detail->kode->EditValue ?></div><input type="hidden" name="x<?php echo $asset_detail_list->lRowIndex ?>_kode" id="x<?php echo $asset_detail_list->lRowIndex ?>_kode" value="<?php echo ew_HtmlEncode($asset_detail->kode->CurrentValue) ?>">
<?php } ?>
<?php if ($asset_detail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $asset_detail->kode->ViewAttributes() ?>><?php echo $asset_detail->kode->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_detail->category->Visible) { // category ?>
		<td<?php echo $asset_detail->category->CellAttributes() ?>>
<?php if ($asset_detail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($asset_detail->category->getSessionValue() <> "") { ?>
<div<?php echo $asset_detail->category->ViewAttributes() ?>><?php echo $asset_detail->category->ListViewValue() ?></div>
<input type="hidden" id="x<?php echo $asset_detail_list->lRowIndex ?>_category" name="x<?php echo $asset_detail_list->lRowIndex ?>_category" value="<?php echo ew_HtmlEncode($asset_detail->category->CurrentValue) ?>">
<?php } else { ?>
<select id="x<?php echo $asset_detail_list->lRowIndex ?>_category" name="x<?php echo $asset_detail_list->lRowIndex ?>_category"<?php echo $asset_detail->category->EditAttributes() ?>>
<?php
if (is_array($asset_detail->category->EditValue)) {
	$arwrk = $asset_detail->category->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($asset_detail->category->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php } ?>
<?php } ?>
<?php if ($asset_detail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $asset_detail->category->ViewAttributes() ?>><?php echo $asset_detail->category->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_detail->kode_barang->Visible) { // kode_barang ?>
		<td<?php echo $asset_detail->kode_barang->CellAttributes() ?>>
<?php if ($asset_detail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $asset_detail_list->lRowIndex ?>_kode_barang" id="x<?php echo $asset_detail_list->lRowIndex ?>_kode_barang" size="10" maxlength="20" value="<?php echo $asset_detail->kode_barang->EditValue ?>"<?php echo $asset_detail->kode_barang->EditAttributes() ?>>
<?php } ?>
<?php if ($asset_detail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $asset_detail->kode_barang->ViewAttributes() ?>><?php echo $asset_detail->kode_barang->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_detail->nama_barang->Visible) { // nama_barang ?>
		<td<?php echo $asset_detail->nama_barang->CellAttributes() ?>>
<?php if ($asset_detail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $asset_detail_list->lRowIndex ?>_nama_barang" id="x<?php echo $asset_detail_list->lRowIndex ?>_nama_barang" size="30" maxlength="200" value="<?php echo $asset_detail->nama_barang->EditValue ?>"<?php echo $asset_detail->nama_barang->EditAttributes() ?>>
<?php } ?>
<?php if ($asset_detail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $asset_detail->nama_barang->ViewAttributes() ?>><?php echo $asset_detail->nama_barang->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_detail->jml->Visible) { // jml ?>
		<td<?php echo $asset_detail->jml->CellAttributes() ?>>
<?php if ($asset_detail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $asset_detail_list->lRowIndex ?>_jml" id="x<?php echo $asset_detail_list->lRowIndex ?>_jml" size="3" value="<?php echo $asset_detail->jml->EditValue ?>"<?php echo $asset_detail->jml->EditAttributes() ?>>
<?php } ?>
<?php if ($asset_detail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $asset_detail->jml->ViewAttributes() ?>><?php echo $asset_detail->jml->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_detail->tgl_pembelian->Visible) { // tgl_pembelian ?>
		<td<?php echo $asset_detail->tgl_pembelian->CellAttributes() ?>>
<?php if ($asset_detail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $asset_detail_list->lRowIndex ?>_tgl_pembelian" id="x<?php echo $asset_detail_list->lRowIndex ?>_tgl_pembelian" value="<?php echo $asset_detail->tgl_pembelian->EditValue ?>"<?php echo $asset_detail->tgl_pembelian->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x<?php echo $asset_detail_list->lRowIndex ?>_tgl_pembelian" name="cal_x<?php echo $asset_detail_list->lRowIndex ?>_tgl_pembelian" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x<?php echo $asset_detail_list->lRowIndex ?>_tgl_pembelian", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x<?php echo $asset_detail_list->lRowIndex ?>_tgl_pembelian" // ID of the button
});
</script>
<?php } ?>
<?php if ($asset_detail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $asset_detail->tgl_pembelian->ViewAttributes() ?>><?php echo $asset_detail->tgl_pembelian->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_detail->nilai_pembelian->Visible) { // nilai_pembelian ?>
		<td<?php echo $asset_detail->nilai_pembelian->CellAttributes() ?>>
<?php if ($asset_detail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $asset_detail_list->lRowIndex ?>_nilai_pembelian" id="x<?php echo $asset_detail_list->lRowIndex ?>_nilai_pembelian" size="20" value="<?php echo $asset_detail->nilai_pembelian->EditValue ?>"<?php echo $asset_detail->nilai_pembelian->EditAttributes() ?>>
<?php } ?>
<?php if ($asset_detail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $asset_detail->nilai_pembelian->ViewAttributes() ?>><?php echo $asset_detail->nilai_pembelian->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php if ($asset_detail->RowType == EW_ROWTYPE_ADD || $asset_detail->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($asset_detail->CurrentAction == "edit") { ?>
<td colspan="<?php echo $asset_detail_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (asset_detail_list.ValidateForm(document.fasset_detaillist)) document.fasset_detaillist.submit();return false;"><img src="images/save.gif" title="Update" width="16" height="16" border="0"></a>&nbsp;<a href="<?php echo $asset_detail_list->PageUrl() ?>a=cancel"><img src="images/b_drop.png" title="Cancel" width="16" height="16" border="0"></a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php } else { ?>
<?php if ($asset_detail->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $asset_detail->InlineEditUrl() ?>"><img src="images/inlineedit.gif" title="Inline Edit" width="16" height="16" border="0"></a>
</span></td>
<?php if ($asset_detail_list->lOptionCnt == 0 && $asset_detail->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $asset_detail->DeleteUrl() ?>"><img src="images/b_drop.png" title="Delete" width="16" height="16" border="0"></a>
</span></td>
<?php

// Custom list options
foreach ($asset_detail_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
<?php if ($asset_detail->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($asset_detail->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($asset_detail->CurrentAction == "add" || $asset_detail->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $asset_detail_list->lRowIndex ?>">
<?php } ?>
<?php if ($asset_detail->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $asset_detail_list->lRowIndex ?>">
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
</td></tr></table>
<?php if ($asset_detail->Export == "" && $asset_detail->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(asset_detail_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($asset_detail->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$asset_detail_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class casset_detail_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'asset_detail';

	// Page Object Name
	var $PageObjName = 'asset_detail_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $asset_detail;
		if ($asset_detail->UseTokenInUrl) $PageUrl .= "t=" . $asset_detail->TableVar . "&"; // add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show Message
	function ShowMessage() {
		if ($this->getMessage() <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $this->getMessage() . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate Page request
	function IsPageRequest() {
		global $objForm, $asset_detail;
		if ($asset_detail->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($asset_detail->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($asset_detail->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function casset_detail_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["asset_detail"] = new casset_detail();

		// Initialize other table object
		$GLOBALS['asset_category'] = new casset_category();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'asset_detail', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $asset_detail;
	$asset_detail->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $asset_detail->Export; // Get export parameter, used in header
	$gsExportFile = $asset_detail->TableVar; // Get export file, used in header
	if ($asset_detail->Export == "print" || $asset_detail->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}

		// Global page loading event (in userfn6.php)
		Page_Loading();

		// Page load event, used in current page
		$this->Page_Load();
	}

	//
	//  Page_Terminate
	//  - called when exit page
	//  - if URL specified, redirect to the URL
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page unload event, used in current page
		$this->Page_Unload();

		// Global page unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close Connection
		$conn->Close();

		// Go to URL if specified
		if ($url <> "") {
			ob_end_clean();
			header("Location: $url");
		}
		exit();
	}
	var $lDisplayRecs; // Number of display records
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs;
	var $lRecRange;
	var $sSrchWhere;
	var $lRecCnt;
	var $lEditRowCnt;
	var $lRowCnt;
	var $lRowIndex;
	var $lOptionCnt;
	var $lRecPerRow;
	var $lColCnt;
	var $sDeleteConfirmMsg; // Delete confirm message
	var $sDbMasterFilter;
	var $sDbDetailFilter;
	var $bMasterRecordExists;	
	var $ListOptions;
	var $sMultiSelectKey;

	//
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsSearchError, $Security, $asset_detail;
		$this->lDisplayRecs = 20;
		$this->lRecRange = 10;
		$this->lRecCnt = 0; // Record count

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		$this->sSrchWhere = ""; // Search WHERE clause

		// Master/Detail
		$this->sDbMasterFilter = ""; // Master filter
		$this->sDbDetailFilter = ""; // Detail filter

		// Create form object
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Set up records per page dynamically
			$this->SetUpDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Set up master detail parameters
			$this->SetUpMasterDetail();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$asset_detail->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($asset_detail->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline edit mode
				if ($asset_detail->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($asset_detail->CurrentAction == "add" || $asset_detail->CurrentAction == "copy")
					$this->InlineAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$asset_detail->CurrentAction = $_POST["a_list"]; // Get action

					// Inline Update
					if ($asset_detail->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($asset_detail->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();
				}
			}

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($asset_detail->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $asset_detail->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sTblDefaultFilter = "";
		$sFilter = $sTblDefaultFilter;

		// Restore master/detail filter
		$this->sDbMasterFilter = $asset_detail->getMasterFilter(); // Restore master filter
		$this->sDbDetailFilter = $asset_detail->getDetailFilter(); // Restore detail filter
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Load master record
		if ($asset_detail->getMasterFilter() <> "" && $asset_detail->getCurrentMasterTable() == "asset_category") {
			global $asset_category;
			$rsmaster = $asset_category->LoadRs($this->sDbMasterFilter);
			$this->bMasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->bMasterRecordExists) {
				$asset_detail->setMasterFilter(""); // Clear master filter
				$asset_detail->setDetailFilter(""); // Clear detail filter
				$this->setMessage("No records found"); // Set no record found
				$this->Page_Terminate($asset_detail->getReturnUrl()); // Return to caller
			} else {
				$asset_category->LoadListRowValues($rsmaster);
				$asset_category->RowType = EW_ROWTYPE_MASTER; // Master row
				$asset_category->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in Session
		$asset_detail->setSessionWhere($sFilter);
		$asset_detail->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $asset_detail;
		$sWrk = @$_GET[EW_TABLE_REC_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->lDisplayRecs = intval($sWrk);
			} else {
				if (strtolower($sWrk) == "all") { // Display all records
					$this->lDisplayRecs = -1;
				} else {
					$this->lDisplayRecs = 20; // Non-numeric, load default
				}
			}
			$asset_detail->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$asset_detail->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $asset_detail;
		$asset_detail->setKey("kode", ""); // Clear inline edit key
		$asset_detail->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Edit Mode
	function InlineEditMode() {
		global $Security, $asset_detail;
		$bInlineEdit = TRUE;
		if (@$_GET["kode"] <> "") {
			$asset_detail->kode->setQueryStringValue($_GET["kode"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$asset_detail->setKey("kode", $asset_detail->kode->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $asset_detail;
		$objForm->Index = 1; 
		$this->LoadFormValues(); // Get form values

		// Validate Form
		$bInlineUpdate = TRUE;
		if (!$this->ValidateForm()) {	
			$bInlineUpdate = FALSE; // Form error, reset action
			$this->setMessage($gsFormError);
		} else {
			$bInlineUpdate = FALSE;	
			if ($this->CheckInlineEditKey()) { // Check key
				$asset_detail->SendEmail = TRUE; // Send email on update success
				$bInlineUpdate = $this->EditRow(); // Update record
			} else {
				$bInlineUpdate = FALSE;
			}
		}
		if ($bInlineUpdate) { // Update success
			$this->setMessage("Update succeeded"); // Set success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getMessage() == "")
				$this->setMessage("Update failed"); // Set update failed message
			$asset_detail->EventCancelled = TRUE; // Cancel event
			$asset_detail->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $asset_detail;

		//CheckInlineEditKey = True
		if (strval($asset_detail->getKey("kode")) <> strval($asset_detail->kode->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add Mode
	function InlineAddMode() {
		global $Security, $asset_detail;
		$asset_detail->CurrentAction = "add";
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to inline add/copy record
	function InlineInsert() {
		global $objForm, $gsFormError, $asset_detail;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate Form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$asset_detail->EventCancelled = TRUE; // Set event cancelled
			$asset_detail->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$asset_detail->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage("Add succeeded"); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$asset_detail->EventCancelled = TRUE; // Set event cancelled
			$asset_detail->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $asset_detail;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$asset_detail->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$asset_detail->CurrentOrderType = @$_GET["ordertype"];
			$asset_detail->UpdateSort($asset_detail->kode); // Field 
			$asset_detail->UpdateSort($asset_detail->category); // Field 
			$asset_detail->UpdateSort($asset_detail->kode_barang); // Field 
			$asset_detail->UpdateSort($asset_detail->nama_barang); // Field 
			$asset_detail->UpdateSort($asset_detail->jml); // Field 
			$asset_detail->UpdateSort($asset_detail->tgl_pembelian); // Field 
			$asset_detail->UpdateSort($asset_detail->nilai_pembelian); // Field 
			$asset_detail->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $asset_detail;
		$sOrderBy = $asset_detail->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($asset_detail->SqlOrderBy() <> "") {
				$sOrderBy = $asset_detail->SqlOrderBy();
				$asset_detail->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $asset_detail;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset master/detail keys
			if (strtolower($sCmd) == "resetall") {
				$asset_detail->getCurrentMasterTable = ""; // Clear master table
				$asset_detail->setMasterFilter(""); // Clear master filter
				$this->sDbMasterFilter = "";
				$asset_detail->setDetailFilter(""); // Clear detail filter
				$this->sDbDetailFilter = "";
				$asset_detail->category->setSessionValue("");
			}

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$asset_detail->setSessionOrderBy($sOrderBy);
				$asset_detail->kode->setSort("");
				$asset_detail->category->setSort("");
				$asset_detail->kode_barang->setSort("");
				$asset_detail->nama_barang->setSort("");
				$asset_detail->jml->setSort("");
				$asset_detail->tgl_pembelian->setSort("");
				$asset_detail->nilai_pembelian->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$asset_detail->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $asset_detail;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$asset_detail->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$asset_detail->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $asset_detail->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$asset_detail->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$asset_detail->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$asset_detail->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $asset_detail;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $asset_detail;
		$asset_detail->kode->setFormValue($objForm->GetValue("x_kode"));
		$asset_detail->category->setFormValue($objForm->GetValue("x_category"));
		$asset_detail->kode_barang->setFormValue($objForm->GetValue("x_kode_barang"));
		$asset_detail->nama_barang->setFormValue($objForm->GetValue("x_nama_barang"));
		$asset_detail->jml->setFormValue($objForm->GetValue("x_jml"));
		$asset_detail->tgl_pembelian->setFormValue($objForm->GetValue("x_tgl_pembelian"));
		$asset_detail->tgl_pembelian->CurrentValue = ew_UnFormatDateTime($asset_detail->tgl_pembelian->CurrentValue, 7);
		$asset_detail->nilai_pembelian->setFormValue($objForm->GetValue("x_nilai_pembelian"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $asset_detail;
		$asset_detail->kode->CurrentValue = $asset_detail->kode->FormValue;
		$asset_detail->category->CurrentValue = $asset_detail->category->FormValue;
		$asset_detail->kode_barang->CurrentValue = $asset_detail->kode_barang->FormValue;
		$asset_detail->nama_barang->CurrentValue = $asset_detail->nama_barang->FormValue;
		$asset_detail->jml->CurrentValue = $asset_detail->jml->FormValue;
		$asset_detail->tgl_pembelian->CurrentValue = $asset_detail->tgl_pembelian->FormValue;
		$asset_detail->tgl_pembelian->CurrentValue = ew_UnFormatDateTime($asset_detail->tgl_pembelian->CurrentValue, 7);
		$asset_detail->nilai_pembelian->CurrentValue = $asset_detail->nilai_pembelian->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $asset_detail;

		// Call Recordset Selecting event
		$asset_detail->Recordset_Selecting($asset_detail->CurrentFilter);

		// Load list page SQL
		$sSql = $asset_detail->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$asset_detail->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $asset_detail;
		$sFilter = $asset_detail->KeyFilter();

		// Call Row Selecting event
		$asset_detail->Row_Selecting($sFilter);

		// Load sql based on filter
		$asset_detail->CurrentFilter = $sFilter;
		$sSql = $asset_detail->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$asset_detail->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $asset_detail;
		$asset_detail->kode->setDbValue($rs->fields('kode'));
		$asset_detail->category->setDbValue($rs->fields('category'));
		$asset_detail->kode_barang->setDbValue($rs->fields('kode_barang'));
		$asset_detail->nama_barang->setDbValue($rs->fields('nama_barang'));
		$asset_detail->jml->setDbValue($rs->fields('jml'));
		$asset_detail->tgl_pembelian->setDbValue($rs->fields('tgl_pembelian'));
		$asset_detail->nilai_pembelian->setDbValue($rs->fields('nilai_pembelian'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $asset_detail;

		// Call Row_Rendering event
		$asset_detail->Row_Rendering();

		// Common render codes for all row types
		// kode

		$asset_detail->kode->CellCssStyle = "white-space: nowrap;";
		$asset_detail->kode->CellCssClass = "";

		// category
		$asset_detail->category->CellCssStyle = "white-space: nowrap;";
		$asset_detail->category->CellCssClass = "";

		// kode_barang
		$asset_detail->kode_barang->CellCssStyle = "white-space: nowrap;";
		$asset_detail->kode_barang->CellCssClass = "";

		// nama_barang
		$asset_detail->nama_barang->CellCssStyle = "white-space: nowrap;";
		$asset_detail->nama_barang->CellCssClass = "";

		// jml
		$asset_detail->jml->CellCssStyle = "white-space: nowrap;";
		$asset_detail->jml->CellCssClass = "";

		// tgl_pembelian
		$asset_detail->tgl_pembelian->CellCssStyle = "white-space: nowrap;";
		$asset_detail->tgl_pembelian->CellCssClass = "";

		// nilai_pembelian
		$asset_detail->nilai_pembelian->CellCssStyle = "white-space: nowrap;";
		$asset_detail->nilai_pembelian->CellCssClass = "";
		if ($asset_detail->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$asset_detail->kode->ViewValue = $asset_detail->kode->CurrentValue;
			$asset_detail->kode->CssStyle = "";
			$asset_detail->kode->CssClass = "";
			$asset_detail->kode->ViewCustomAttributes = "";

			// category
			if (strval($asset_detail->category->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `category` FROM `asset_category` WHERE `kode` = " . ew_AdjustSql($asset_detail->category->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$asset_detail->category->ViewValue = $rswrk->fields('category');
					$rswrk->Close();
				} else {
					$asset_detail->category->ViewValue = $asset_detail->category->CurrentValue;
				}
			} else {
				$asset_detail->category->ViewValue = NULL;
			}
			$asset_detail->category->CssStyle = "";
			$asset_detail->category->CssClass = "";
			$asset_detail->category->ViewCustomAttributes = "nowrap";

			// kode_barang
			$asset_detail->kode_barang->ViewValue = $asset_detail->kode_barang->CurrentValue;
			$asset_detail->kode_barang->CssStyle = "";
			$asset_detail->kode_barang->CssClass = "";
			$asset_detail->kode_barang->ViewCustomAttributes = "";

			// nama_barang
			$asset_detail->nama_barang->ViewValue = $asset_detail->nama_barang->CurrentValue;
			$asset_detail->nama_barang->CssStyle = "";
			$asset_detail->nama_barang->CssClass = "";
			$asset_detail->nama_barang->ViewCustomAttributes = "";

			// jml
			$asset_detail->jml->ViewValue = $asset_detail->jml->CurrentValue;
			$asset_detail->jml->CssStyle = "text-align:right;";
			$asset_detail->jml->CssClass = "";
			$asset_detail->jml->ViewCustomAttributes = "";

			// tgl_pembelian
			$asset_detail->tgl_pembelian->ViewValue = $asset_detail->tgl_pembelian->CurrentValue;
			$asset_detail->tgl_pembelian->ViewValue = ew_FormatDateTime($asset_detail->tgl_pembelian->ViewValue, 7);
			$asset_detail->tgl_pembelian->CssStyle = "";
			$asset_detail->tgl_pembelian->CssClass = "";
			$asset_detail->tgl_pembelian->ViewCustomAttributes = "";

			// nilai_pembelian
			$asset_detail->nilai_pembelian->ViewValue = $asset_detail->nilai_pembelian->CurrentValue;
			$asset_detail->nilai_pembelian->ViewValue = ew_FormatNumber($asset_detail->nilai_pembelian->ViewValue, 0, -2, -2, -2);
			$asset_detail->nilai_pembelian->CssStyle = "text-align:right;";
			$asset_detail->nilai_pembelian->CssClass = "";
			$asset_detail->nilai_pembelian->ViewCustomAttributes = "";

			// kode
			$asset_detail->kode->HrefValue = "";

			// category
			$asset_detail->category->HrefValue = "";

			// kode_barang
			$asset_detail->kode_barang->HrefValue = "";

			// nama_barang
			$asset_detail->nama_barang->HrefValue = "";

			// jml
			$asset_detail->jml->HrefValue = "";

			// tgl_pembelian
			$asset_detail->tgl_pembelian->HrefValue = "";

			// nilai_pembelian
			$asset_detail->nilai_pembelian->HrefValue = "";
		} elseif ($asset_detail->RowType == EW_ROWTYPE_ADD) { // Add row

			// kode
			// category

			$asset_detail->category->EditCustomAttributes = "nowrap";
			if ($asset_detail->category->getSessionValue() <> "") {
				$asset_detail->category->CurrentValue = $asset_detail->category->getSessionValue();
			if (strval($asset_detail->category->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `category` FROM `asset_category` WHERE `kode` = " . ew_AdjustSql($asset_detail->category->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$asset_detail->category->ViewValue = $rswrk->fields('category');
					$rswrk->Close();
				} else {
					$asset_detail->category->ViewValue = $asset_detail->category->CurrentValue;
				}
			} else {
				$asset_detail->category->ViewValue = NULL;
			}
			$asset_detail->category->CssStyle = "";
			$asset_detail->category->CssClass = "";
			$asset_detail->category->ViewCustomAttributes = "nowrap";
			} else {
			$sSqlWrk = "SELECT `kode`, `category`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `asset_category`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$asset_detail->category->EditValue = $arwrk;
			}

			// kode_barang
			$asset_detail->kode_barang->EditCustomAttributes = "";
			$asset_detail->kode_barang->EditValue = ew_HtmlEncode($asset_detail->kode_barang->CurrentValue);

			// nama_barang
			$asset_detail->nama_barang->EditCustomAttributes = "";
			$asset_detail->nama_barang->EditValue = ew_HtmlEncode($asset_detail->nama_barang->CurrentValue);

			// jml
			$asset_detail->jml->EditCustomAttributes = "";
			$asset_detail->jml->EditValue = ew_HtmlEncode($asset_detail->jml->CurrentValue);

			// tgl_pembelian
			$asset_detail->tgl_pembelian->EditCustomAttributes = "";
			$asset_detail->tgl_pembelian->EditValue = ew_HtmlEncode(ew_FormatDateTime($asset_detail->tgl_pembelian->CurrentValue, 7));

			// nilai_pembelian
			$asset_detail->nilai_pembelian->EditCustomAttributes = "";
			$asset_detail->nilai_pembelian->EditValue = ew_HtmlEncode($asset_detail->nilai_pembelian->CurrentValue);
		} elseif ($asset_detail->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// kode
			$asset_detail->kode->EditCustomAttributes = "";
			$asset_detail->kode->EditValue = $asset_detail->kode->CurrentValue;
			$asset_detail->kode->CssStyle = "";
			$asset_detail->kode->CssClass = "";
			$asset_detail->kode->ViewCustomAttributes = "";

			// category
			$asset_detail->category->EditCustomAttributes = "nowrap";
			if ($asset_detail->category->getSessionValue() <> "") {
				$asset_detail->category->CurrentValue = $asset_detail->category->getSessionValue();
			if (strval($asset_detail->category->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `category` FROM `asset_category` WHERE `kode` = " . ew_AdjustSql($asset_detail->category->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$asset_detail->category->ViewValue = $rswrk->fields('category');
					$rswrk->Close();
				} else {
					$asset_detail->category->ViewValue = $asset_detail->category->CurrentValue;
				}
			} else {
				$asset_detail->category->ViewValue = NULL;
			}
			$asset_detail->category->CssStyle = "";
			$asset_detail->category->CssClass = "";
			$asset_detail->category->ViewCustomAttributes = "nowrap";
			} else {
			$sSqlWrk = "SELECT `kode`, `category`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `asset_category`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$asset_detail->category->EditValue = $arwrk;
			}

			// kode_barang
			$asset_detail->kode_barang->EditCustomAttributes = "";
			$asset_detail->kode_barang->EditValue = ew_HtmlEncode($asset_detail->kode_barang->CurrentValue);

			// nama_barang
			$asset_detail->nama_barang->EditCustomAttributes = "";
			$asset_detail->nama_barang->EditValue = ew_HtmlEncode($asset_detail->nama_barang->CurrentValue);

			// jml
			$asset_detail->jml->EditCustomAttributes = "";
			$asset_detail->jml->EditValue = ew_HtmlEncode($asset_detail->jml->CurrentValue);

			// tgl_pembelian
			$asset_detail->tgl_pembelian->EditCustomAttributes = "";
			$asset_detail->tgl_pembelian->EditValue = ew_HtmlEncode(ew_FormatDateTime($asset_detail->tgl_pembelian->CurrentValue, 7));

			// nilai_pembelian
			$asset_detail->nilai_pembelian->EditCustomAttributes = "";
			$asset_detail->nilai_pembelian->EditValue = ew_HtmlEncode($asset_detail->nilai_pembelian->CurrentValue);

			// Edit refer script
			// kode

			$asset_detail->kode->HrefValue = "";

			// category
			$asset_detail->category->HrefValue = "";

			// kode_barang
			$asset_detail->kode_barang->HrefValue = "";

			// nama_barang
			$asset_detail->nama_barang->HrefValue = "";

			// jml
			$asset_detail->jml->HrefValue = "";

			// tgl_pembelian
			$asset_detail->tgl_pembelian->HrefValue = "";

			// nilai_pembelian
			$asset_detail->nilai_pembelian->HrefValue = "";
		}

		// Call Row Rendered event
		$asset_detail->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $asset_detail;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($asset_detail->category->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Category";
		}
		if ($asset_detail->kode_barang->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Kode Barang";
		}
		if ($asset_detail->nama_barang->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Nama Barang";
		}
		if ($asset_detail->jml->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Jml";
		}
		if (!ew_CheckNumber($asset_detail->jml->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect floating point number - Jml";
		}
		if ($asset_detail->tgl_pembelian->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Tgl Pembelian";
		}
		if (!ew_CheckEuroDate($asset_detail->tgl_pembelian->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect date, format = dd/mm/yyyy - Tgl Pembelian";
		}
		if ($asset_detail->nilai_pembelian->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Nilai Pembelian";
		}
		if (!ew_CheckNumber($asset_detail->nilai_pembelian->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect floating point number - Nilai Pembelian";
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $asset_detail;
		$sFilter = $asset_detail->KeyFilter();
		$asset_detail->CurrentFilter = $sFilter;
		$sSql = $asset_detail->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// Field kode
			// Field category

			$asset_detail->category->SetDbValueDef($asset_detail->category->CurrentValue, 0);
			$rsnew['category'] =& $asset_detail->category->DbValue;

			// Field kode_barang
			$asset_detail->kode_barang->SetDbValueDef($asset_detail->kode_barang->CurrentValue, "");
			$rsnew['kode_barang'] =& $asset_detail->kode_barang->DbValue;

			// Field nama_barang
			$asset_detail->nama_barang->SetDbValueDef($asset_detail->nama_barang->CurrentValue, "");
			$rsnew['nama_barang'] =& $asset_detail->nama_barang->DbValue;

			// Field jml
			$asset_detail->jml->SetDbValueDef($asset_detail->jml->CurrentValue, 0);
			$rsnew['jml'] =& $asset_detail->jml->DbValue;

			// Field tgl_pembelian
			$asset_detail->tgl_pembelian->SetDbValueDef(ew_UnFormatDateTime($asset_detail->tgl_pembelian->CurrentValue, 7), ew_CurrentDate());
			$rsnew['tgl_pembelian'] =& $asset_detail->tgl_pembelian->DbValue;

			// Field nilai_pembelian
			$asset_detail->nilai_pembelian->SetDbValueDef($asset_detail->nilai_pembelian->CurrentValue, 0);
			$rsnew['nilai_pembelian'] =& $asset_detail->nilai_pembelian->DbValue;

			// Call Row Updating event
			$bUpdateRow = $asset_detail->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($asset_detail->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($asset_detail->CancelMessage <> "") {
					$this->setMessage($asset_detail->CancelMessage);
					$asset_detail->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$asset_detail->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $asset_detail;
		$rsnew = array();

		// Field kode
		// Field category

		$asset_detail->category->SetDbValueDef($asset_detail->category->CurrentValue, 0);
		$rsnew['category'] =& $asset_detail->category->DbValue;

		// Field kode_barang
		$asset_detail->kode_barang->SetDbValueDef($asset_detail->kode_barang->CurrentValue, "");
		$rsnew['kode_barang'] =& $asset_detail->kode_barang->DbValue;

		// Field nama_barang
		$asset_detail->nama_barang->SetDbValueDef($asset_detail->nama_barang->CurrentValue, "");
		$rsnew['nama_barang'] =& $asset_detail->nama_barang->DbValue;

		// Field jml
		$asset_detail->jml->SetDbValueDef($asset_detail->jml->CurrentValue, 0);
		$rsnew['jml'] =& $asset_detail->jml->DbValue;

		// Field tgl_pembelian
		$asset_detail->tgl_pembelian->SetDbValueDef(ew_UnFormatDateTime($asset_detail->tgl_pembelian->CurrentValue, 7), ew_CurrentDate());
		$rsnew['tgl_pembelian'] =& $asset_detail->tgl_pembelian->DbValue;

		// Field nilai_pembelian
		$asset_detail->nilai_pembelian->SetDbValueDef($asset_detail->nilai_pembelian->CurrentValue, 0);
		$rsnew['nilai_pembelian'] =& $asset_detail->nilai_pembelian->DbValue;

		// Call Row Inserting event
		$bInsertRow = $asset_detail->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($asset_detail->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($asset_detail->CancelMessage <> "") {
				$this->setMessage($asset_detail->CancelMessage);
				$asset_detail->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$asset_detail->kode->setDbValue($conn->Insert_ID());
			$rsnew['kode'] =& $asset_detail->kode->DbValue;

			// Call Row Inserted event
			$asset_detail->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Set up Master Detail based on querystring parameter
	function SetUpMasterDetail() {
		global $asset_detail;
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (@$_GET[EW_TABLE_SHOW_MASTER] <> "") {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = "";
				$this->sDbDetailFilter = "";
			}
			if ($sMasterTblVar == "asset_category") {
				$bValidMaster = TRUE;
				$this->sDbMasterFilter = $asset_detail->SqlMasterFilter_asset_category();
				$this->sDbDetailFilter = $asset_detail->SqlDetailFilter_asset_category();
				if (@$_GET["kode"] <> "") {
					$GLOBALS["asset_category"]->kode->setQueryStringValue($_GET["kode"]);
					$asset_detail->category->setQueryStringValue($GLOBALS["asset_category"]->kode->QueryStringValue);
					$asset_detail->category->setSessionValue($asset_detail->category->QueryStringValue);
					if (!is_numeric($GLOBALS["asset_category"]->kode->QueryStringValue)) $bValidMaster = FALSE;
					$this->sDbMasterFilter = str_replace("@kode@", ew_AdjustSql($GLOBALS["asset_category"]->kode->QueryStringValue), $this->sDbMasterFilter);
					$this->sDbDetailFilter = str_replace("@category@", ew_AdjustSql($GLOBALS["asset_category"]->kode->QueryStringValue), $this->sDbDetailFilter);
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$asset_detail->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->lStartRec = 1;
			$asset_detail->setStartRecordNumber($this->lStartRec);
			$asset_detail->setMasterFilter($this->sDbMasterFilter); // Set up master filter
			$asset_detail->setDetailFilter($this->sDbDetailFilter); // Set up detail filter

			// Clear previous master session values
			if ($sMasterTblVar <> "asset_category") {
				if ($asset_detail->category->QueryStringValue == "") $asset_detail->category->setSessionValue("");
			}
		} else {
			$this->sDbMasterFilter = $asset_detail->getMasterFilter(); //  Restore master filter
			$this->sDbDetailFilter = $asset_detail->getDetailFilter(); // Restore detail filter
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
