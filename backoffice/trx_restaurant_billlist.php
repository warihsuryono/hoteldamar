<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "trx_restaurant_billinfo.php" ?>
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
$trx_restaurant_bill_list = new ctrx_restaurant_bill_list();
$Page =& $trx_restaurant_bill_list;

// Page init processing
$trx_restaurant_bill_list->Page_Init();

// Page main processing
$trx_restaurant_bill_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($trx_restaurant_bill->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var trx_restaurant_bill_list = new ew_Page("trx_restaurant_bill_list");

// page properties
trx_restaurant_bill_list.PageID = "list"; // page ID
var EW_PAGE_ID = trx_restaurant_bill_list.PageID; // for backward compatibility

// extend page with validate function for search
trx_restaurant_bill_list.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_tanggal"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Tanggal");

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	for (var i=0;i<fobj.elements.length;i++) {
		var elem = fobj.elements[i];
		if (elem.name.substring(0,2) == "s_" || elem.name.substring(0,3) == "sv_")
			elem.value = "";
	}
	return true;
}

// extend page with Form_CustomValidate function
trx_restaurant_bill_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
trx_restaurant_bill_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
trx_restaurant_bill_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($trx_restaurant_bill->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($trx_restaurant_bill->Export == "" && $trx_restaurant_bill->SelectLimit);
	if (!$bSelectLimit)
		$rs = $trx_restaurant_bill_list->LoadRecordset();
	$trx_restaurant_bill_list->lTotalRecs = ($bSelectLimit) ? $trx_restaurant_bill->SelectRecordCount() : $rs->RecordCount();
	$trx_restaurant_bill_list->lStartRec = 1;
	if ($trx_restaurant_bill_list->lDisplayRecs <= 0) // Display all records
		$trx_restaurant_bill_list->lDisplayRecs = $trx_restaurant_bill_list->lTotalRecs;
	if (!($trx_restaurant_bill->ExportAll && $trx_restaurant_bill->Export <> ""))
		$trx_restaurant_bill_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $trx_restaurant_bill_list->LoadRecordset($trx_restaurant_bill_list->lStartRec-1, $trx_restaurant_bill_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Restaurant Bill</b></h3>
<?php if ($trx_restaurant_bill->Export == "" && $trx_restaurant_bill->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $trx_restaurant_bill_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php if ($trx_restaurant_bill->Export == "" && $trx_restaurant_bill->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(trx_restaurant_bill_list);" style="text-decoration: none;"><img id="trx_restaurant_bill_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="trx_restaurant_bill_list_SearchPanel">
<form name="ftrx_restaurant_billlistsrch" id="ftrx_restaurant_billlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return trx_restaurant_bill_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="trx_restaurant_bill">
<?php
if ($gsSearchError == "")
	$trx_restaurant_bill_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$trx_restaurant_bill->RowType = EW_ROWTYPE_SEARCH;

// Render row
$trx_restaurant_bill_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Kode</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kode" id="z_kode" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kode" id="x_kode" size="20" maxlength="20" value="<?php echo $trx_restaurant_bill->kode->EditValue ?>"<?php echo $trx_restaurant_bill->kode->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Nama</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_nama" id="z_nama" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_nama" id="x_nama" size="30" maxlength="50" value="<?php echo $trx_restaurant_bill->nama->EditValue ?>"<?php echo $trx_restaurant_bill->nama->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Tanggal</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_tanggal" id="z_tanggal" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_tanggal" id="x_tanggal" value="<?php echo $trx_restaurant_bill->tanggal->EditValue ?>"<?php echo $trx_restaurant_bill->tanggal->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_tanggal" name="cal_x_tanggal" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_tanggal", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_tanggal" // ID of the button
});
</script>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Room</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_room" id="z_room" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_room" name="x_room"<?php echo $trx_restaurant_bill->room->EditAttributes() ?>>
<?php
if (is_array($trx_restaurant_bill->room->EditValue)) {
	$arwrk = $trx_restaurant_bill->room->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($trx_restaurant_bill->room->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Paid</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_paid" id="z_paid" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_paid" name="x_paid"<?php echo $trx_restaurant_bill->paid->EditAttributes() ?>>
<?php
if (is_array($trx_restaurant_bill->paid->EditValue)) {
	$arwrk = $trx_restaurant_bill->paid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($trx_restaurant_bill->paid->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span></td>
			</tr></table>
		</td>
	</tr>
</table>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<!-- <input type="Button" name="Reset" id="Reset" value="   Reset   " onclick="ew_ClearForm(this.form);if (this.form.<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>) this.form.<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>[0].checked = true;">&nbsp; -->
			<!--a href="<?php echo $trx_restaurant_bill_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $trx_restaurant_bill_list->PageUrl() ?>cmd=reset';">
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $trx_restaurant_bill_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($trx_restaurant_bill->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($trx_restaurant_bill->CurrentAction <> "gridadd" && $trx_restaurant_bill->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($trx_restaurant_bill_list->Pager)) $trx_restaurant_bill_list->Pager = new cPrevNextPager($trx_restaurant_bill_list->lStartRec, $trx_restaurant_bill_list->lDisplayRecs, $trx_restaurant_bill_list->lTotalRecs) ?>
<?php if ($trx_restaurant_bill_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($trx_restaurant_bill_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $trx_restaurant_bill_list->PageUrl() ?>start=<?php echo $trx_restaurant_bill_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($trx_restaurant_bill_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $trx_restaurant_bill_list->PageUrl() ?>start=<?php echo $trx_restaurant_bill_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $trx_restaurant_bill_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($trx_restaurant_bill_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $trx_restaurant_bill_list->PageUrl() ?>start=<?php echo $trx_restaurant_bill_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($trx_restaurant_bill_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $trx_restaurant_bill_list->PageUrl() ?>start=<?php echo $trx_restaurant_bill_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $trx_restaurant_bill_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $trx_restaurant_bill_list->Pager->FromIndex ?> to <?php echo $trx_restaurant_bill_list->Pager->ToIndex ?> of <?php echo $trx_restaurant_bill_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($trx_restaurant_bill_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($trx_restaurant_bill_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="trx_restaurant_bill">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($trx_restaurant_bill_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($trx_restaurant_bill_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($trx_restaurant_bill_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($trx_restaurant_bill_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($trx_restaurant_bill_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($trx_restaurant_bill_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $trx_restaurant_bill->AddUrl() ?>"> <img src="images/expand.gif" title="Add" width="16" height="16" border="0"> </a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="ftrx_restaurant_billlist" id="ftrx_restaurant_billlist" class="ewForm" action="" method="post">
<?php if ($trx_restaurant_bill_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$trx_restaurant_bill_list->lOptionCnt = 0;
	$trx_restaurant_bill_list->lOptionCnt++; // view
	$trx_restaurant_bill_list->lOptionCnt += count($trx_restaurant_bill_list->ListOptions->Items); // Custom list options
?>
<?php echo $trx_restaurant_bill->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($trx_restaurant_bill->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($trx_restaurant_bill_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($trx_restaurant_bill->kode->Visible) { // kode ?>
	<?php if ($trx_restaurant_bill->SortUrl($trx_restaurant_bill->kode) == "") { ?>
		<td style="white-space: nowrap;">Kode</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_restaurant_bill->SortUrl($trx_restaurant_bill->kode) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode</td><td style="width: 10px;"><?php if ($trx_restaurant_bill->kode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_restaurant_bill->kode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_restaurant_bill->nama->Visible) { // nama ?>
	<?php if ($trx_restaurant_bill->SortUrl($trx_restaurant_bill->nama) == "") { ?>
		<td style="white-space: nowrap;">Nama</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_restaurant_bill->SortUrl($trx_restaurant_bill->nama) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Nama</td><td style="width: 10px;"><?php if ($trx_restaurant_bill->nama->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_restaurant_bill->nama->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_restaurant_bill->tanggal->Visible) { // tanggal ?>
	<?php if ($trx_restaurant_bill->SortUrl($trx_restaurant_bill->tanggal) == "") { ?>
		<td style="white-space: nowrap;">Tanggal</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_restaurant_bill->SortUrl($trx_restaurant_bill->tanggal) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tanggal</td><td style="width: 10px;"><?php if ($trx_restaurant_bill->tanggal->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_restaurant_bill->tanggal->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_restaurant_bill->room->Visible) { // room ?>
	<?php if ($trx_restaurant_bill->SortUrl($trx_restaurant_bill->room) == "") { ?>
		<td style="white-space: nowrap;">Room</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_restaurant_bill->SortUrl($trx_restaurant_bill->room) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Room</td><td style="width: 10px;"><?php if ($trx_restaurant_bill->room->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_restaurant_bill->room->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_restaurant_bill->grandtotal->Visible) { // grandtotal ?>
	<?php if ($trx_restaurant_bill->SortUrl($trx_restaurant_bill->grandtotal) == "") { ?>
		<td style="white-space: nowrap;">Grandtotal</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_restaurant_bill->SortUrl($trx_restaurant_bill->grandtotal) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Grandtotal</td><td style="width: 10px;"><?php if ($trx_restaurant_bill->grandtotal->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_restaurant_bill->grandtotal->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_restaurant_bill->createby->Visible) { // createby ?>
	<?php if ($trx_restaurant_bill->SortUrl($trx_restaurant_bill->createby) == "") { ?>
		<td>Createby</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_restaurant_bill->SortUrl($trx_restaurant_bill->createby) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Createby</td><td style="width: 10px;"><?php if ($trx_restaurant_bill->createby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_restaurant_bill->createby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_restaurant_bill->createdate->Visible) { // createdate ?>
	<?php if ($trx_restaurant_bill->SortUrl($trx_restaurant_bill->createdate) == "") { ?>
		<td>Createdate</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_restaurant_bill->SortUrl($trx_restaurant_bill->createdate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Createdate</td><td style="width: 10px;"><?php if ($trx_restaurant_bill->createdate->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_restaurant_bill->createdate->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_restaurant_bill->paid->Visible) { // paid ?>
	<?php if ($trx_restaurant_bill->SortUrl($trx_restaurant_bill->paid) == "") { ?>
		<td style="white-space: nowrap;">Paid</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_restaurant_bill->SortUrl($trx_restaurant_bill->paid) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Paid</td><td style="width: 10px;"><?php if ($trx_restaurant_bill->paid->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_restaurant_bill->paid->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($trx_restaurant_bill->ExportAll && $trx_restaurant_bill->Export <> "") {
	$trx_restaurant_bill_list->lStopRec = $trx_restaurant_bill_list->lTotalRecs;
} else {
	$trx_restaurant_bill_list->lStopRec = $trx_restaurant_bill_list->lStartRec + $trx_restaurant_bill_list->lDisplayRecs - 1; // Set the last record to display
}
$trx_restaurant_bill_list->lRecCount = $trx_restaurant_bill_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$trx_restaurant_bill->SelectLimit && $trx_restaurant_bill_list->lStartRec > 1)
		$rs->Move($trx_restaurant_bill_list->lStartRec - 1);
}
$trx_restaurant_bill_list->lRowCnt = 0;
while (($trx_restaurant_bill->CurrentAction == "gridadd" || !$rs->EOF) &&
	$trx_restaurant_bill_list->lRecCount < $trx_restaurant_bill_list->lStopRec) {
	$trx_restaurant_bill_list->lRecCount++;
	if (intval($trx_restaurant_bill_list->lRecCount) >= intval($trx_restaurant_bill_list->lStartRec)) {
		$trx_restaurant_bill_list->lRowCnt++;

	// Init row class and style
	$trx_restaurant_bill->CssClass = "";
	$trx_restaurant_bill->CssStyle = "";
	$trx_restaurant_bill->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($trx_restaurant_bill->CurrentAction == "gridadd") {
		$trx_restaurant_bill_list->LoadDefaultValues(); // Load default values
	} else {
		$trx_restaurant_bill_list->LoadRowValues($rs); // Load row values
	}
	$trx_restaurant_bill->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$trx_restaurant_bill_list->RenderRow();
	if($trx_restaurant_bill->paid->ListViewValue()=="Belum"){$bgcolorpaid="red";}else{$bgcolorpaid="";}
?>
	<tr<?php echo $trx_restaurant_bill->RowAttributes() ?>>
<?php if ($trx_restaurant_bill->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="trx_restaurant_billadd.php?editing=1&kode=<?php echo $trx_restaurant_bill->kode->ListViewValue(); ?>"><img src="images/edit.gif" title="View" width="16" height="16" border="0"></a> |
<a href="<?php echo $trx_restaurant_bill->ViewUrl() ?>"><img src="images/view.gif" title="Detail" width="16" height="16" border="0"></a>
</span></td>
<?php

// Custom list options
foreach ($trx_restaurant_bill_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($trx_restaurant_bill->kode->Visible) { // kode ?>
		<td<?php echo $trx_restaurant_bill->kode->CellAttributes() ?>>
<div<?php echo $trx_restaurant_bill->kode->ViewAttributes() ?>><?php echo $trx_restaurant_bill->kode->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_restaurant_bill->nama->Visible) { // nama ?>
		<td<?php echo $trx_restaurant_bill->nama->CellAttributes() ?>>
<div<?php echo $trx_restaurant_bill->nama->ViewAttributes() ?>><?php echo $trx_restaurant_bill->nama->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_restaurant_bill->tanggal->Visible) { // tanggal ?>
		<td<?php echo $trx_restaurant_bill->tanggal->CellAttributes() ?>>
<div<?php echo $trx_restaurant_bill->tanggal->ViewAttributes() ?>><?php echo $trx_restaurant_bill->tanggal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_restaurant_bill->room->Visible) { // room ?>
		<td<?php echo $trx_restaurant_bill->room->CellAttributes() ?>>
<div<?php echo $trx_restaurant_bill->room->ViewAttributes() ?>><?php echo $trx_restaurant_bill->room->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_restaurant_bill->grandtotal->Visible) { // grandtotal ?>
		<td<?php echo $trx_restaurant_bill->grandtotal->CellAttributes() ?>>
<div<?php echo $trx_restaurant_bill->grandtotal->ViewAttributes() ?>><?php echo $trx_restaurant_bill->grandtotal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_restaurant_bill->createby->Visible) { // createby ?>
		<td<?php echo $trx_restaurant_bill->createby->CellAttributes() ?>>
<div<?php echo $trx_restaurant_bill->createby->ViewAttributes() ?>><?php echo $trx_restaurant_bill->createby->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_restaurant_bill->createdate->Visible) { // createdate ?>
		<td<?php echo $trx_restaurant_bill->createdate->CellAttributes() ?>>
<div<?php echo $trx_restaurant_bill->createdate->ViewAttributes() ?>><?php echo $trx_restaurant_bill->createdate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_restaurant_bill->paid->Visible) { // paid ?>
		<td bgcolor="<?php echo $bgcolorpaid; ?>" <?php echo $trx_restaurant_bill->paid->CellAttributes() ?>>
<div<?php echo $trx_restaurant_bill->paid->ViewAttributes() ?>><?php echo $trx_restaurant_bill->paid->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($trx_restaurant_bill->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
</td></tr></table>
<?php if ($trx_restaurant_bill->Export == "" && $trx_restaurant_bill->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(trx_restaurant_bill_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($trx_restaurant_bill->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$trx_restaurant_bill_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class ctrx_restaurant_bill_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'trx_restaurant_bill';

	// Page Object Name
	var $PageObjName = 'trx_restaurant_bill_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $trx_restaurant_bill;
		if ($trx_restaurant_bill->UseTokenInUrl) $PageUrl .= "t=" . $trx_restaurant_bill->TableVar . "&"; // add page token
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
		global $objForm, $trx_restaurant_bill;
		if ($trx_restaurant_bill->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($trx_restaurant_bill->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($trx_restaurant_bill->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ctrx_restaurant_bill_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["trx_restaurant_bill"] = new ctrx_restaurant_bill();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'trx_restaurant_bill', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $trx_restaurant_bill;
	$trx_restaurant_bill->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $trx_restaurant_bill->Export; // Get export parameter, used in header
	$gsExportFile = $trx_restaurant_bill->TableVar; // Get export file, used in header
	if ($trx_restaurant_bill->Export == "print" || $trx_restaurant_bill->Export == "html") {

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
		global $objForm, $gsSearchError, $Security, $trx_restaurant_bill;
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
		if ($this->IsPageRequest()) { // Validate request

			// Set up records per page dynamically
			$this->SetUpDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Get search criteria for advanced search
			$this->LoadSearchValues(); // Get search values
			if ($this->ValidateSearch()) {
				$sSrchAdvanced = $this->AdvancedSearchWhere();
			} else {
				$this->setMessage($gsSearchError);
			}

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($trx_restaurant_bill->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $trx_restaurant_bill->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "($this->sSrchWhere) AND ($sSrchAdvanced)" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "($this->sSrchWhere) AND ($sSrchBasic)" : $sSrchBasic;

		// Call Recordset_Searching event
		$trx_restaurant_bill->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$trx_restaurant_bill->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$trx_restaurant_bill->setStartRecordNumber($this->lStartRec);
		} else {
			$this->RestoreSearchParms();
		}

		// Build filter
		$sTblDefaultFilter = "";
		$sFilter = $sTblDefaultFilter;
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in Session
		$trx_restaurant_bill->setSessionWhere($sFilter);
		$trx_restaurant_bill->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $trx_restaurant_bill;
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
			$trx_restaurant_bill->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$trx_restaurant_bill->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $trx_restaurant_bill;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->kode, FALSE); // Field kode
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->idseqno, FALSE); // Field idseqno
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->nama, FALSE); // Field nama
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->tanggal, FALSE); // Field tanggal
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->room, FALSE); // Field room
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->withppn, FALSE); // Field withppn
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->withservice, FALSE); // Field withservice
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->subtotal1, FALSE); // Field subtotal1
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->ppn, FALSE); // Field ppn
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->subtotal2, FALSE); // Field subtotal2
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->service, FALSE); // Field service
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->grandtotal, FALSE); // Field grandtotal
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->notes, FALSE); // Field notes
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->createby, FALSE); // Field createby
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->createdate, FALSE); // Field createdate
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->kodebooking, FALSE); // Field kodebooking
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->paid, FALSE); // Field paid
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->paymenttype, FALSE); // Field paymenttype
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->coabank, FALSE); // Field coabank
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->norek, FALSE); // Field norek
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->isread, FALSE); // Field isread
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->nett, FALSE); // Field nett
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->discname, FALSE); // Field discname
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->disc, FALSE); // Field disc
		$this->BuildSearchSql($sWhere, $trx_restaurant_bill->xtimestamp, FALSE); // Field xtimestamp

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($trx_restaurant_bill->kode); // Field kode
			$this->SetSearchParm($trx_restaurant_bill->idseqno); // Field idseqno
			$this->SetSearchParm($trx_restaurant_bill->nama); // Field nama
			$this->SetSearchParm($trx_restaurant_bill->tanggal); // Field tanggal
			$this->SetSearchParm($trx_restaurant_bill->room); // Field room
			$this->SetSearchParm($trx_restaurant_bill->withppn); // Field withppn
			$this->SetSearchParm($trx_restaurant_bill->withservice); // Field withservice
			$this->SetSearchParm($trx_restaurant_bill->subtotal1); // Field subtotal1
			$this->SetSearchParm($trx_restaurant_bill->ppn); // Field ppn
			$this->SetSearchParm($trx_restaurant_bill->subtotal2); // Field subtotal2
			$this->SetSearchParm($trx_restaurant_bill->service); // Field service
			$this->SetSearchParm($trx_restaurant_bill->grandtotal); // Field grandtotal
			$this->SetSearchParm($trx_restaurant_bill->notes); // Field notes
			$this->SetSearchParm($trx_restaurant_bill->createby); // Field createby
			$this->SetSearchParm($trx_restaurant_bill->createdate); // Field createdate
			$this->SetSearchParm($trx_restaurant_bill->kodebooking); // Field kodebooking
			$this->SetSearchParm($trx_restaurant_bill->paid); // Field paid
			$this->SetSearchParm($trx_restaurant_bill->paymenttype); // Field paymenttype
			$this->SetSearchParm($trx_restaurant_bill->coabank); // Field coabank
			$this->SetSearchParm($trx_restaurant_bill->norek); // Field norek
			$this->SetSearchParm($trx_restaurant_bill->isread); // Field isread
			$this->SetSearchParm($trx_restaurant_bill->nett); // Field nett
			$this->SetSearchParm($trx_restaurant_bill->discname); // Field discname
			$this->SetSearchParm($trx_restaurant_bill->disc); // Field disc
			$this->SetSearchParm($trx_restaurant_bill->xtimestamp); // Field xtimestamp
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $MultiValue) {
		$FldParm = substr($Fld->FldVar, 2);		
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1 || $FldOpr <> "LIKE" ||
			($FldOpr2 <> "LIKE" && $FldVal2 <> ""))
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldVal) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldVal2) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2);
		}
		if ($sWrk <> "") {
			if ($Where <> "") $Where .= " AND ";
			$Where .= "(" . $sWrk . ")";
		}
	}

	// Set search parameters
	function SetSearchParm(&$Fld) {
		global $trx_restaurant_bill;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$trx_restaurant_bill->setAdvancedSearch("x_$FldParm", $FldVal);
		$trx_restaurant_bill->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$trx_restaurant_bill->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$trx_restaurant_bill->setAdvancedSearch("y_$FldParm", $FldVal2);
		$trx_restaurant_bill->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search where
		global $trx_restaurant_bill;
		$this->sSrchWhere = "";
		$trx_restaurant_bill->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $trx_restaurant_bill;
		$trx_restaurant_bill->setAdvancedSearch("x_kode", "");
		$trx_restaurant_bill->setAdvancedSearch("x_idseqno", "");
		$trx_restaurant_bill->setAdvancedSearch("x_nama", "");
		$trx_restaurant_bill->setAdvancedSearch("x_tanggal", "");
		$trx_restaurant_bill->setAdvancedSearch("x_room", "");
		$trx_restaurant_bill->setAdvancedSearch("x_withppn", "");
		$trx_restaurant_bill->setAdvancedSearch("x_withservice", "");
		$trx_restaurant_bill->setAdvancedSearch("x_subtotal1", "");
		$trx_restaurant_bill->setAdvancedSearch("x_ppn", "");
		$trx_restaurant_bill->setAdvancedSearch("x_subtotal2", "");
		$trx_restaurant_bill->setAdvancedSearch("x_service", "");
		$trx_restaurant_bill->setAdvancedSearch("x_grandtotal", "");
		$trx_restaurant_bill->setAdvancedSearch("x_notes", "");
		$trx_restaurant_bill->setAdvancedSearch("x_createby", "");
		$trx_restaurant_bill->setAdvancedSearch("x_createdate", "");
		$trx_restaurant_bill->setAdvancedSearch("x_kodebooking", "");
		$trx_restaurant_bill->setAdvancedSearch("x_paid", "");
		$trx_restaurant_bill->setAdvancedSearch("x_paymenttype", "");
		$trx_restaurant_bill->setAdvancedSearch("x_coabank", "");
		$trx_restaurant_bill->setAdvancedSearch("x_norek", "");
		$trx_restaurant_bill->setAdvancedSearch("x_isread", "");
		$trx_restaurant_bill->setAdvancedSearch("x_nett", "");
		$trx_restaurant_bill->setAdvancedSearch("x_discname", "");
		$trx_restaurant_bill->setAdvancedSearch("x_disc", "");
		$trx_restaurant_bill->setAdvancedSearch("x_xtimestamp", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $trx_restaurant_bill;
		$this->sSrchWhere = $trx_restaurant_bill->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $trx_restaurant_bill;
		 $trx_restaurant_bill->kode->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_kode");
		 $trx_restaurant_bill->idseqno->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_idseqno");
		 $trx_restaurant_bill->nama->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_nama");
		 $trx_restaurant_bill->tanggal->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_tanggal");
		 $trx_restaurant_bill->room->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_room");
		 $trx_restaurant_bill->withppn->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_withppn");
		 $trx_restaurant_bill->withservice->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_withservice");
		 $trx_restaurant_bill->subtotal1->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_subtotal1");
		 $trx_restaurant_bill->ppn->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_ppn");
		 $trx_restaurant_bill->subtotal2->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_subtotal2");
		 $trx_restaurant_bill->service->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_service");
		 $trx_restaurant_bill->grandtotal->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_grandtotal");
		 $trx_restaurant_bill->notes->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_notes");
		 $trx_restaurant_bill->createby->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_createby");
		 $trx_restaurant_bill->createdate->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_createdate");
		 $trx_restaurant_bill->kodebooking->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_kodebooking");
		 $trx_restaurant_bill->paid->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_paid");
		 $trx_restaurant_bill->paymenttype->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_paymenttype");
		 $trx_restaurant_bill->coabank->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_coabank");
		 $trx_restaurant_bill->norek->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_norek");
		 $trx_restaurant_bill->isread->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_isread");
		 $trx_restaurant_bill->nett->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_nett");
		 $trx_restaurant_bill->discname->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_discname");
		 $trx_restaurant_bill->disc->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_disc");
		 $trx_restaurant_bill->xtimestamp->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_xtimestamp");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $trx_restaurant_bill;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$trx_restaurant_bill->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$trx_restaurant_bill->CurrentOrderType = @$_GET["ordertype"];
			$trx_restaurant_bill->UpdateSort($trx_restaurant_bill->kode); // Field 
			$trx_restaurant_bill->UpdateSort($trx_restaurant_bill->nama); // Field 
			$trx_restaurant_bill->UpdateSort($trx_restaurant_bill->tanggal); // Field 
			$trx_restaurant_bill->UpdateSort($trx_restaurant_bill->room); // Field 
			$trx_restaurant_bill->UpdateSort($trx_restaurant_bill->grandtotal); // Field 
			$trx_restaurant_bill->UpdateSort($trx_restaurant_bill->createby); // Field 
			$trx_restaurant_bill->UpdateSort($trx_restaurant_bill->createdate); // Field 
			$trx_restaurant_bill->UpdateSort($trx_restaurant_bill->paid); // Field 
			$trx_restaurant_bill->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $trx_restaurant_bill;
		$sOrderBy = $trx_restaurant_bill->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($trx_restaurant_bill->SqlOrderBy() <> "") {
				$sOrderBy = $trx_restaurant_bill->SqlOrderBy();
				$trx_restaurant_bill->setSessionOrderBy($sOrderBy);
				$trx_restaurant_bill->tanggal->setSort("DESC");
				$trx_restaurant_bill->kode->setSort("DESC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $trx_restaurant_bill;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$trx_restaurant_bill->setSessionOrderBy($sOrderBy);
				$trx_restaurant_bill->kode->setSort("");
				$trx_restaurant_bill->nama->setSort("");
				$trx_restaurant_bill->tanggal->setSort("");
				$trx_restaurant_bill->room->setSort("");
				$trx_restaurant_bill->grandtotal->setSort("");
				$trx_restaurant_bill->createby->setSort("");
				$trx_restaurant_bill->createdate->setSort("");
				$trx_restaurant_bill->paid->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$trx_restaurant_bill->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $trx_restaurant_bill;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$trx_restaurant_bill->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$trx_restaurant_bill->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $trx_restaurant_bill->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$trx_restaurant_bill->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$trx_restaurant_bill->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$trx_restaurant_bill->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $trx_restaurant_bill;

		// Load search values
		// kode

		$trx_restaurant_bill->kode->AdvancedSearch->SearchValue = @$_GET["x_kode"];
		$trx_restaurant_bill->kode->AdvancedSearch->SearchOperator = @$_GET["z_kode"];

		// idseqno
		$trx_restaurant_bill->idseqno->AdvancedSearch->SearchValue = @$_GET["x_idseqno"];
		$trx_restaurant_bill->idseqno->AdvancedSearch->SearchOperator = @$_GET["z_idseqno"];

		// nama
		$trx_restaurant_bill->nama->AdvancedSearch->SearchValue = @$_GET["x_nama"];
		$trx_restaurant_bill->nama->AdvancedSearch->SearchOperator = @$_GET["z_nama"];

		// tanggal
		$trx_restaurant_bill->tanggal->AdvancedSearch->SearchValue = @$_GET["x_tanggal"];
		$trx_restaurant_bill->tanggal->AdvancedSearch->SearchOperator = @$_GET["z_tanggal"];

		// room
		$trx_restaurant_bill->room->AdvancedSearch->SearchValue = @$_GET["x_room"];
		$trx_restaurant_bill->room->AdvancedSearch->SearchOperator = @$_GET["z_room"];

		// withppn
		$trx_restaurant_bill->withppn->AdvancedSearch->SearchValue = @$_GET["x_withppn"];
		$trx_restaurant_bill->withppn->AdvancedSearch->SearchOperator = @$_GET["z_withppn"];

		// withservice
		$trx_restaurant_bill->withservice->AdvancedSearch->SearchValue = @$_GET["x_withservice"];
		$trx_restaurant_bill->withservice->AdvancedSearch->SearchOperator = @$_GET["z_withservice"];

		// subtotal1
		$trx_restaurant_bill->subtotal1->AdvancedSearch->SearchValue = @$_GET["x_subtotal1"];
		$trx_restaurant_bill->subtotal1->AdvancedSearch->SearchOperator = @$_GET["z_subtotal1"];

		// ppn
		$trx_restaurant_bill->ppn->AdvancedSearch->SearchValue = @$_GET["x_ppn"];
		$trx_restaurant_bill->ppn->AdvancedSearch->SearchOperator = @$_GET["z_ppn"];

		// subtotal2
		$trx_restaurant_bill->subtotal2->AdvancedSearch->SearchValue = @$_GET["x_subtotal2"];
		$trx_restaurant_bill->subtotal2->AdvancedSearch->SearchOperator = @$_GET["z_subtotal2"];

		// service
		$trx_restaurant_bill->service->AdvancedSearch->SearchValue = @$_GET["x_service"];
		$trx_restaurant_bill->service->AdvancedSearch->SearchOperator = @$_GET["z_service"];

		// grandtotal
		$trx_restaurant_bill->grandtotal->AdvancedSearch->SearchValue = @$_GET["x_grandtotal"];
		$trx_restaurant_bill->grandtotal->AdvancedSearch->SearchOperator = @$_GET["z_grandtotal"];

		// notes
		$trx_restaurant_bill->notes->AdvancedSearch->SearchValue = @$_GET["x_notes"];
		$trx_restaurant_bill->notes->AdvancedSearch->SearchOperator = @$_GET["z_notes"];

		// createby
		$trx_restaurant_bill->createby->AdvancedSearch->SearchValue = @$_GET["x_createby"];
		$trx_restaurant_bill->createby->AdvancedSearch->SearchOperator = @$_GET["z_createby"];

		// createdate
		$trx_restaurant_bill->createdate->AdvancedSearch->SearchValue = @$_GET["x_createdate"];
		$trx_restaurant_bill->createdate->AdvancedSearch->SearchOperator = @$_GET["z_createdate"];

		// kodebooking
		$trx_restaurant_bill->kodebooking->AdvancedSearch->SearchValue = @$_GET["x_kodebooking"];
		$trx_restaurant_bill->kodebooking->AdvancedSearch->SearchOperator = @$_GET["z_kodebooking"];

		// paid
		$trx_restaurant_bill->paid->AdvancedSearch->SearchValue = @$_GET["x_paid"];
		$trx_restaurant_bill->paid->AdvancedSearch->SearchOperator = @$_GET["z_paid"];

		// paymenttype
		$trx_restaurant_bill->paymenttype->AdvancedSearch->SearchValue = @$_GET["x_paymenttype"];
		$trx_restaurant_bill->paymenttype->AdvancedSearch->SearchOperator = @$_GET["z_paymenttype"];

		// coabank
		$trx_restaurant_bill->coabank->AdvancedSearch->SearchValue = @$_GET["x_coabank"];
		$trx_restaurant_bill->coabank->AdvancedSearch->SearchOperator = @$_GET["z_coabank"];

		// norek
		$trx_restaurant_bill->norek->AdvancedSearch->SearchValue = @$_GET["x_norek"];
		$trx_restaurant_bill->norek->AdvancedSearch->SearchOperator = @$_GET["z_norek"];

		// isread
		$trx_restaurant_bill->isread->AdvancedSearch->SearchValue = @$_GET["x_isread"];
		$trx_restaurant_bill->isread->AdvancedSearch->SearchOperator = @$_GET["z_isread"];

		// nett
		$trx_restaurant_bill->nett->AdvancedSearch->SearchValue = @$_GET["x_nett"];
		$trx_restaurant_bill->nett->AdvancedSearch->SearchOperator = @$_GET["z_nett"];

		// discname
		$trx_restaurant_bill->discname->AdvancedSearch->SearchValue = @$_GET["x_discname"];
		$trx_restaurant_bill->discname->AdvancedSearch->SearchOperator = @$_GET["z_discname"];

		// disc
		$trx_restaurant_bill->disc->AdvancedSearch->SearchValue = @$_GET["x_disc"];
		$trx_restaurant_bill->disc->AdvancedSearch->SearchOperator = @$_GET["z_disc"];

		// xtimestamp
		$trx_restaurant_bill->xtimestamp->AdvancedSearch->SearchValue = @$_GET["x_xtimestamp"];
		$trx_restaurant_bill->xtimestamp->AdvancedSearch->SearchOperator = @$_GET["z_xtimestamp"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $trx_restaurant_bill;

		// Call Recordset Selecting event
		$trx_restaurant_bill->Recordset_Selecting($trx_restaurant_bill->CurrentFilter);

		// Load list page SQL
		$sSql = $trx_restaurant_bill->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$trx_restaurant_bill->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $trx_restaurant_bill;
		$sFilter = $trx_restaurant_bill->KeyFilter();

		// Call Row Selecting event
		$trx_restaurant_bill->Row_Selecting($sFilter);

		// Load sql based on filter
		$trx_restaurant_bill->CurrentFilter = $sFilter;
		$sSql = $trx_restaurant_bill->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$trx_restaurant_bill->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $trx_restaurant_bill;
		$trx_restaurant_bill->kode->setDbValue($rs->fields('kode'));
		$trx_restaurant_bill->idseqno->setDbValue($rs->fields('idseqno'));
		$trx_restaurant_bill->nama->setDbValue($rs->fields('nama'));
		$trx_restaurant_bill->tanggal->setDbValue($rs->fields('tanggal'));
		$trx_restaurant_bill->room->setDbValue($rs->fields('room'));
		$trx_restaurant_bill->withppn->setDbValue($rs->fields('withppn'));
		$trx_restaurant_bill->withservice->setDbValue($rs->fields('withservice'));
		$trx_restaurant_bill->subtotal1->setDbValue($rs->fields('subtotal1'));
		$trx_restaurant_bill->ppn->setDbValue($rs->fields('ppn'));
		$trx_restaurant_bill->subtotal2->setDbValue($rs->fields('subtotal2'));
		$trx_restaurant_bill->service->setDbValue($rs->fields('service'));
		$trx_restaurant_bill->grandtotal->setDbValue($rs->fields('grandtotal'));
		$trx_restaurant_bill->notes->setDbValue($rs->fields('notes'));
		$trx_restaurant_bill->createby->setDbValue($rs->fields('createby'));
		$trx_restaurant_bill->createdate->setDbValue($rs->fields('createdate'));
		$trx_restaurant_bill->kodebooking->setDbValue($rs->fields('kodebooking'));
		$trx_restaurant_bill->paid->setDbValue($rs->fields('paid'));
		$trx_restaurant_bill->paymenttype->setDbValue($rs->fields('paymenttype'));
		$trx_restaurant_bill->coabank->setDbValue($rs->fields('coabank'));
		$trx_restaurant_bill->norek->setDbValue($rs->fields('norek'));
		$trx_restaurant_bill->isread->setDbValue($rs->fields('isread'));
		$trx_restaurant_bill->nett->setDbValue($rs->fields('nett'));
		$trx_restaurant_bill->discname->setDbValue($rs->fields('discname'));
		$trx_restaurant_bill->disc->setDbValue($rs->fields('disc'));
		$trx_restaurant_bill->xtimestamp->setDbValue($rs->fields('xtimestamp'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $trx_restaurant_bill;

		// Call Row_Rendering event
		$trx_restaurant_bill->Row_Rendering();

		// Common render codes for all row types
		// kode

		$trx_restaurant_bill->kode->CellCssStyle = "white-space: nowrap;";
		$trx_restaurant_bill->kode->CellCssClass = "";

		// nama
		$trx_restaurant_bill->nama->CellCssStyle = "white-space: nowrap;";
		$trx_restaurant_bill->nama->CellCssClass = "";

		// tanggal
		$trx_restaurant_bill->tanggal->CellCssStyle = "white-space: nowrap;";
		$trx_restaurant_bill->tanggal->CellCssClass = "";

		// room
		$trx_restaurant_bill->room->CellCssStyle = "white-space: nowrap;";
		$trx_restaurant_bill->room->CellCssClass = "";

		// grandtotal
		$trx_restaurant_bill->grandtotal->CellCssStyle = "white-space: nowrap;";
		$trx_restaurant_bill->grandtotal->CellCssClass = "";

		// createby
		$trx_restaurant_bill->createby->CellCssStyle = "";
		$trx_restaurant_bill->createby->CellCssClass = "";

		// createdate
		$trx_restaurant_bill->createdate->CellCssStyle = "";
		$trx_restaurant_bill->createdate->CellCssClass = "";

		// paid
		$trx_restaurant_bill->paid->CellCssStyle = "white-space: nowrap;";
		$trx_restaurant_bill->paid->CellCssClass = "";
		if ($trx_restaurant_bill->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$trx_restaurant_bill->kode->ViewValue = $trx_restaurant_bill->kode->CurrentValue;
			$trx_restaurant_bill->kode->CssStyle = "";
			$trx_restaurant_bill->kode->CssClass = "";
			$trx_restaurant_bill->kode->ViewCustomAttributes = "";

			// idseqno
			$trx_restaurant_bill->idseqno->ViewValue = $trx_restaurant_bill->idseqno->CurrentValue;
			$trx_restaurant_bill->idseqno->CssStyle = "";
			$trx_restaurant_bill->idseqno->CssClass = "";
			$trx_restaurant_bill->idseqno->ViewCustomAttributes = "";

			// nama
			$trx_restaurant_bill->nama->ViewValue = $trx_restaurant_bill->nama->CurrentValue;
			$trx_restaurant_bill->nama->CssStyle = "";
			$trx_restaurant_bill->nama->CssClass = "";
			$trx_restaurant_bill->nama->ViewCustomAttributes = "";

			// tanggal
			$trx_restaurant_bill->tanggal->ViewValue = $trx_restaurant_bill->tanggal->CurrentValue;
			$trx_restaurant_bill->tanggal->ViewValue = ew_FormatDateTime($trx_restaurant_bill->tanggal->ViewValue, 7);
			$trx_restaurant_bill->tanggal->CssStyle = "";
			$trx_restaurant_bill->tanggal->CssClass = "";
			$trx_restaurant_bill->tanggal->ViewCustomAttributes = "";

			// room
			if (strval($trx_restaurant_bill->room->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `mst_room` WHERE `kode` = '" . ew_AdjustSql($trx_restaurant_bill->room->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$trx_restaurant_bill->room->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$trx_restaurant_bill->room->ViewValue = $trx_restaurant_bill->room->CurrentValue;
				}
			} else {
				$trx_restaurant_bill->room->ViewValue = NULL;
			}
			$trx_restaurant_bill->room->CssStyle = "";
			$trx_restaurant_bill->room->CssClass = "";
			$trx_restaurant_bill->room->ViewCustomAttributes = "";

			// withppn
			$trx_restaurant_bill->withppn->ViewValue = $trx_restaurant_bill->withppn->CurrentValue;
			$trx_restaurant_bill->withppn->CssStyle = "";
			$trx_restaurant_bill->withppn->CssClass = "";
			$trx_restaurant_bill->withppn->ViewCustomAttributes = "";

			// withservice
			$trx_restaurant_bill->withservice->ViewValue = $trx_restaurant_bill->withservice->CurrentValue;
			$trx_restaurant_bill->withservice->CssStyle = "";
			$trx_restaurant_bill->withservice->CssClass = "";
			$trx_restaurant_bill->withservice->ViewCustomAttributes = "";

			// subtotal1
			$trx_restaurant_bill->subtotal1->ViewValue = $trx_restaurant_bill->subtotal1->CurrentValue;
			$trx_restaurant_bill->subtotal1->CssStyle = "";
			$trx_restaurant_bill->subtotal1->CssClass = "";
			$trx_restaurant_bill->subtotal1->ViewCustomAttributes = "";

			// ppn
			$trx_restaurant_bill->ppn->ViewValue = $trx_restaurant_bill->ppn->CurrentValue;
			$trx_restaurant_bill->ppn->CssStyle = "";
			$trx_restaurant_bill->ppn->CssClass = "";
			$trx_restaurant_bill->ppn->ViewCustomAttributes = "";

			// subtotal2
			$trx_restaurant_bill->subtotal2->ViewValue = $trx_restaurant_bill->subtotal2->CurrentValue;
			$trx_restaurant_bill->subtotal2->CssStyle = "";
			$trx_restaurant_bill->subtotal2->CssClass = "";
			$trx_restaurant_bill->subtotal2->ViewCustomAttributes = "";

			// service
			$trx_restaurant_bill->service->ViewValue = $trx_restaurant_bill->service->CurrentValue;
			$trx_restaurant_bill->service->CssStyle = "";
			$trx_restaurant_bill->service->CssClass = "";
			$trx_restaurant_bill->service->ViewCustomAttributes = "";

			// grandtotal
			$trx_restaurant_bill->grandtotal->ViewValue = $trx_restaurant_bill->grandtotal->CurrentValue;
			$trx_restaurant_bill->grandtotal->ViewValue = ew_FormatNumber($trx_restaurant_bill->grandtotal->ViewValue, 0, -2, -2, -2);
			$trx_restaurant_bill->grandtotal->CssStyle = "text-align:right;";
			$trx_restaurant_bill->grandtotal->CssClass = "";
			$trx_restaurant_bill->grandtotal->ViewCustomAttributes = "";

			// notes
			$trx_restaurant_bill->notes->ViewValue = $trx_restaurant_bill->notes->CurrentValue;
			$trx_restaurant_bill->notes->CssStyle = "";
			$trx_restaurant_bill->notes->CssClass = "";
			$trx_restaurant_bill->notes->ViewCustomAttributes = "";

			// createby
			if (strval($trx_restaurant_bill->createby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($trx_restaurant_bill->createby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$trx_restaurant_bill->createby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$trx_restaurant_bill->createby->ViewValue = $trx_restaurant_bill->createby->CurrentValue;
				}
			} else {
				$trx_restaurant_bill->createby->ViewValue = NULL;
			}
			$trx_restaurant_bill->createby->CssStyle = "";
			$trx_restaurant_bill->createby->CssClass = "";
			$trx_restaurant_bill->createby->ViewCustomAttributes = "";

			// createdate
			$trx_restaurant_bill->createdate->ViewValue = $trx_restaurant_bill->createdate->CurrentValue;
			$trx_restaurant_bill->createdate->ViewValue = ew_FormatDateTime($trx_restaurant_bill->createdate->ViewValue, 7);
			$trx_restaurant_bill->createdate->CssStyle = "";
			$trx_restaurant_bill->createdate->CssClass = "";
			$trx_restaurant_bill->createdate->ViewCustomAttributes = "";

			// kodebooking
			$trx_restaurant_bill->kodebooking->ViewValue = $trx_restaurant_bill->kodebooking->CurrentValue;
			$trx_restaurant_bill->kodebooking->CssStyle = "";
			$trx_restaurant_bill->kodebooking->CssClass = "";
			$trx_restaurant_bill->kodebooking->ViewCustomAttributes = "";

			// paid
			if (strval($trx_restaurant_bill->paid->CurrentValue) <> "") {
				switch ($trx_restaurant_bill->paid->CurrentValue) {
					case "0":
						$trx_restaurant_bill->paid->ViewValue = "Belum";
						break;
					case "1":
						$trx_restaurant_bill->paid->ViewValue = "Sudah";
						break;
					case "2":
						$trx_restaurant_bill->paid->ViewValue = "With Room";
						break;
					default:
						$trx_restaurant_bill->paid->ViewValue = $trx_restaurant_bill->paid->CurrentValue;
				}
			} else {
				$trx_restaurant_bill->paid->ViewValue = NULL;
			}
			$trx_restaurant_bill->paid->CssStyle = "";
			$trx_restaurant_bill->paid->CssClass = "";
			$trx_restaurant_bill->paid->ViewCustomAttributes = "";

			// paymenttype
			$trx_restaurant_bill->paymenttype->ViewValue = $trx_restaurant_bill->paymenttype->CurrentValue;
			$trx_restaurant_bill->paymenttype->CssStyle = "";
			$trx_restaurant_bill->paymenttype->CssClass = "";
			$trx_restaurant_bill->paymenttype->ViewCustomAttributes = "";

			// coabank
			$trx_restaurant_bill->coabank->ViewValue = $trx_restaurant_bill->coabank->CurrentValue;
			$trx_restaurant_bill->coabank->CssStyle = "";
			$trx_restaurant_bill->coabank->CssClass = "";
			$trx_restaurant_bill->coabank->ViewCustomAttributes = "";

			// norek
			$trx_restaurant_bill->norek->ViewValue = $trx_restaurant_bill->norek->CurrentValue;
			$trx_restaurant_bill->norek->CssStyle = "";
			$trx_restaurant_bill->norek->CssClass = "";
			$trx_restaurant_bill->norek->ViewCustomAttributes = "";

			// isread
			$trx_restaurant_bill->isread->ViewValue = $trx_restaurant_bill->isread->CurrentValue;
			$trx_restaurant_bill->isread->CssStyle = "";
			$trx_restaurant_bill->isread->CssClass = "";
			$trx_restaurant_bill->isread->ViewCustomAttributes = "";

			// nett
			$trx_restaurant_bill->nett->ViewValue = $trx_restaurant_bill->nett->CurrentValue;
			$trx_restaurant_bill->nett->CssStyle = "";
			$trx_restaurant_bill->nett->CssClass = "";
			$trx_restaurant_bill->nett->ViewCustomAttributes = "";

			// discname
			$trx_restaurant_bill->discname->ViewValue = $trx_restaurant_bill->discname->CurrentValue;
			$trx_restaurant_bill->discname->CssStyle = "";
			$trx_restaurant_bill->discname->CssClass = "";
			$trx_restaurant_bill->discname->ViewCustomAttributes = "";

			// disc
			$trx_restaurant_bill->disc->ViewValue = $trx_restaurant_bill->disc->CurrentValue;
			$trx_restaurant_bill->disc->CssStyle = "";
			$trx_restaurant_bill->disc->CssClass = "";
			$trx_restaurant_bill->disc->ViewCustomAttributes = "";

			// xtimestamp
			$trx_restaurant_bill->xtimestamp->ViewValue = $trx_restaurant_bill->xtimestamp->CurrentValue;
			$trx_restaurant_bill->xtimestamp->ViewValue = ew_FormatDateTime($trx_restaurant_bill->xtimestamp->ViewValue, 7);
			$trx_restaurant_bill->xtimestamp->CssStyle = "";
			$trx_restaurant_bill->xtimestamp->CssClass = "";
			$trx_restaurant_bill->xtimestamp->ViewCustomAttributes = "";

			// kode
			$trx_restaurant_bill->kode->HrefValue = "";

			// nama
			$trx_restaurant_bill->nama->HrefValue = "";

			// tanggal
			$trx_restaurant_bill->tanggal->HrefValue = "";

			// room
			$trx_restaurant_bill->room->HrefValue = "";

			// grandtotal
			$trx_restaurant_bill->grandtotal->HrefValue = "";

			// createby
			$trx_restaurant_bill->createby->HrefValue = "";

			// createdate
			$trx_restaurant_bill->createdate->HrefValue = "";

			// paid
			$trx_restaurant_bill->paid->HrefValue = "";
		} elseif ($trx_restaurant_bill->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// kode
			$trx_restaurant_bill->kode->EditCustomAttributes = "";
			$trx_restaurant_bill->kode->EditValue = ew_HtmlEncode($trx_restaurant_bill->kode->AdvancedSearch->SearchValue);

			// nama
			$trx_restaurant_bill->nama->EditCustomAttributes = "";
			$trx_restaurant_bill->nama->EditValue = ew_HtmlEncode($trx_restaurant_bill->nama->AdvancedSearch->SearchValue);

			// tanggal
			$trx_restaurant_bill->tanggal->EditCustomAttributes = "";
			$trx_restaurant_bill->tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($trx_restaurant_bill->tanggal->AdvancedSearch->SearchValue, 7), 7));

			// room
			$trx_restaurant_bill->room->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_room`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$trx_restaurant_bill->room->EditValue = $arwrk;

			// grandtotal
			$trx_restaurant_bill->grandtotal->EditCustomAttributes = "";
			$trx_restaurant_bill->grandtotal->EditValue = ew_HtmlEncode($trx_restaurant_bill->grandtotal->AdvancedSearch->SearchValue);

			// createby
			$trx_restaurant_bill->createby->EditCustomAttributes = "";

			// createdate
			$trx_restaurant_bill->createdate->EditCustomAttributes = "";
			$trx_restaurant_bill->createdate->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($trx_restaurant_bill->createdate->AdvancedSearch->SearchValue, 7), 7));

			// paid
			$trx_restaurant_bill->paid->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "Belum");
			$arwrk[] = array("1", "Sudah");
			$arwrk[] = array("2", "With Room");
			array_unshift($arwrk, array("", "Please Select"));
			$trx_restaurant_bill->paid->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$trx_restaurant_bill->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $trx_restaurant_bill;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckEuroDate($trx_restaurant_bill->tanggal->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Tanggal";
		}

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sFormCustomError;
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $trx_restaurant_bill;
		$trx_restaurant_bill->kode->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_kode");
		$trx_restaurant_bill->idseqno->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_idseqno");
		$trx_restaurant_bill->nama->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_nama");
		$trx_restaurant_bill->tanggal->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_tanggal");
		$trx_restaurant_bill->room->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_room");
		$trx_restaurant_bill->withppn->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_withppn");
		$trx_restaurant_bill->withservice->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_withservice");
		$trx_restaurant_bill->subtotal1->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_subtotal1");
		$trx_restaurant_bill->ppn->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_ppn");
		$trx_restaurant_bill->subtotal2->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_subtotal2");
		$trx_restaurant_bill->service->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_service");
		$trx_restaurant_bill->grandtotal->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_grandtotal");
		$trx_restaurant_bill->notes->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_notes");
		$trx_restaurant_bill->createby->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_createby");
		$trx_restaurant_bill->createdate->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_createdate");
		$trx_restaurant_bill->kodebooking->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_kodebooking");
		$trx_restaurant_bill->paid->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_paid");
		$trx_restaurant_bill->paymenttype->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_paymenttype");
		$trx_restaurant_bill->coabank->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_coabank");
		$trx_restaurant_bill->norek->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_norek");
		$trx_restaurant_bill->isread->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_isread");
		$trx_restaurant_bill->nett->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_nett");
		$trx_restaurant_bill->discname->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_discname");
		$trx_restaurant_bill->disc->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_disc");
		$trx_restaurant_bill->xtimestamp->AdvancedSearch->SearchValue = $trx_restaurant_bill->getAdvancedSearch("x_xtimestamp");
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'trx_restaurant_bill';

		// Write Audit Trail
		$filePfx = "log";
		$curDate = date("Y/m/d");
		$curTime = date("H:i:s");
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		$action = $typ;
		ew_WriteAuditTrail($filePfx, $curDate, $curTime, $id, $curUser, $action, $table, "", "", "", "");
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
