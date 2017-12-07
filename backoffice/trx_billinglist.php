<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "trx_billinginfo.php" ?>
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
$trx_billing_list = new ctrx_billing_list();
$Page =& $trx_billing_list;

// Page init processing
$trx_billing_list->Page_Init();

// Page main processing
$trx_billing_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($trx_billing->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var trx_billing_list = new ew_Page("trx_billing_list");

// page properties
trx_billing_list.PageID = "list"; // page ID
var EW_PAGE_ID = trx_billing_list.PageID; // for backward compatibility

// extend page with validate function for search
trx_billing_list.ValidateSearch = function(fobj) {
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
trx_billing_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
trx_billing_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
trx_billing_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($trx_billing->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($trx_billing->Export == "" && $trx_billing->SelectLimit);
	if (!$bSelectLimit)
		$rs = $trx_billing_list->LoadRecordset();
	$trx_billing_list->lTotalRecs = ($bSelectLimit) ? $trx_billing->SelectRecordCount() : $rs->RecordCount();
	$trx_billing_list->lStartRec = 1;
	if ($trx_billing_list->lDisplayRecs <= 0) // Display all records
		$trx_billing_list->lDisplayRecs = $trx_billing_list->lTotalRecs;
	if (!($trx_billing->ExportAll && $trx_billing->Export <> ""))
		$trx_billing_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $trx_billing_list->LoadRecordset($trx_billing_list->lStartRec-1, $trx_billing_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Billing</b></h3>
<?php if ($trx_billing->Export == "" && $trx_billing->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $trx_billing_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $trx_billing_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php if ($trx_billing->Export == "" && $trx_billing->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(trx_billing_list);" style="text-decoration: none;"><img id="trx_billing_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="trx_billing_list_SearchPanel">
<form name="ftrx_billinglistsrch" id="ftrx_billinglistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return trx_billing_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="trx_billing">
<?php
if ($gsSearchError == "")
	$trx_billing_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$trx_billing->RowType = EW_ROWTYPE_SEARCH;

// Render row
$trx_billing_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Kode</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kode" id="z_kode" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kode" id="x_kode" size="20" maxlength="20" value="<?php echo $trx_billing->kode->EditValue ?>"<?php echo $trx_billing->kode->EditAttributes() ?>>
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
<input type="text" name="x_tanggal" id="x_tanggal" value="<?php echo $trx_billing->tanggal->EditValue ?>"<?php echo $trx_billing->tanggal->EditAttributes() ?>>
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
<select id="x_room" name="x_room"<?php echo $trx_billing->room->EditAttributes() ?>>
<?php
if (is_array($trx_billing->room->EditValue)) {
	$arwrk = $trx_billing->room->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($trx_billing->room->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Payment Type</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_paymenttype" id="z_paymenttype" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_paymenttype" name="x_paymenttype"<?php echo $trx_billing->paymenttype->EditAttributes() ?>>
<?php
if (is_array($trx_billing->paymenttype->EditValue)) {
	$arwrk = $trx_billing->paymenttype->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($trx_billing->paymenttype->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<select id="x_paid" name="x_paid"<?php echo $trx_billing->paid->EditAttributes() ?>>
<?php
if (is_array($trx_billing->paid->EditValue)) {
	$arwrk = $trx_billing->paid->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($trx_billing->paid->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<!--a href="<?php echo $trx_billing_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $trx_billing_list->PageUrl() ?>cmd=reset';">
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $trx_billing_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($trx_billing->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($trx_billing->CurrentAction <> "gridadd" && $trx_billing->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($trx_billing_list->Pager)) $trx_billing_list->Pager = new cPrevNextPager($trx_billing_list->lStartRec, $trx_billing_list->lDisplayRecs, $trx_billing_list->lTotalRecs) ?>
<?php if ($trx_billing_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($trx_billing_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $trx_billing_list->PageUrl() ?>start=<?php echo $trx_billing_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($trx_billing_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $trx_billing_list->PageUrl() ?>start=<?php echo $trx_billing_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $trx_billing_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($trx_billing_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $trx_billing_list->PageUrl() ?>start=<?php echo $trx_billing_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($trx_billing_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $trx_billing_list->PageUrl() ?>start=<?php echo $trx_billing_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $trx_billing_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $trx_billing_list->Pager->FromIndex ?> to <?php echo $trx_billing_list->Pager->ToIndex ?> of <?php echo $trx_billing_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($trx_billing_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($trx_billing_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="trx_billing">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($trx_billing_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($trx_billing_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($trx_billing_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($trx_billing_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($trx_billing_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($trx_billing_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<!--a href="<?php echo $trx_billing->AddUrl() ?>"> <img src="images/expand.gif" title="Add" width="16" height="16" border="0"> </a>&nbsp;&nbsp;-->
<input type="button" name="AddBook" value="Billing Room" onclick="window.location='trx_billingadd.php';">
<input type="button" name="AddGroup" value="Billing Group" onclick="window.location='trx_billingaddgroup.php';">
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="ftrx_billinglist" id="ftrx_billinglist" class="ewForm" action="" method="post">
<?php if ($trx_billing_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$trx_billing_list->lOptionCnt = 0;
	$trx_billing_list->lOptionCnt++; // view
	$trx_billing_list->lOptionCnt += count($trx_billing_list->ListOptions->Items); // Custom list options
?>
<?php echo $trx_billing->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($trx_billing->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($trx_billing_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($trx_billing->kode->Visible) { // kode ?>
	<?php if ($trx_billing->SortUrl($trx_billing->kode) == "") { ?>
		<td style="white-space: nowrap;">Kode</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_billing->SortUrl($trx_billing->kode) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode</td><td style="width: 10px;"><?php if ($trx_billing->kode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_billing->kode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_billing->grup->Visible) { // grup ?>
	<?php if ($trx_billing->SortUrl($trx_billing->grup) == "") { ?>
		<td style="white-space: nowrap;">Grup</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_billing->SortUrl($trx_billing->grup) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Grup</td><td style="width: 10px;"><?php if ($trx_billing->grup->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_billing->grup->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_billing->tanggal->Visible) { // tanggal ?>
	<?php if ($trx_billing->SortUrl($trx_billing->tanggal) == "") { ?>
		<td style="white-space: nowrap;">Nama</td>
		<td style="white-space: nowrap;">Tanggal</td>
	<?php } else { ?>
		<td style="white-space: nowrap;">Nama</td>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_billing->SortUrl($trx_billing->tanggal) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tanggal</td><td style="width: 10px;"><?php if ($trx_billing->tanggal->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_billing->tanggal->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_billing->room->Visible) { // room ?>
	<?php if ($trx_billing->SortUrl($trx_billing->room) == "") { ?>
		<td style="white-space: nowrap;">Room</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_billing->SortUrl($trx_billing->room) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Room</td><td style="width: 10px;"><?php if ($trx_billing->room->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_billing->room->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_billing->rate->Visible) { // rate ?>
	<?php if ($trx_billing->SortUrl($trx_billing->rate) == "") { ?>
		<td style="white-space: nowrap;">Rate</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_billing->SortUrl($trx_billing->rate) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Rate</td><td style="width: 10px;"><?php if ($trx_billing->rate->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_billing->rate->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_billing->rate2->Visible) { // rate2 ?>
	<?php if ($trx_billing->SortUrl($trx_billing->rate2) == "") { ?>
		<td style="white-space: nowrap;">Rate 2</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_billing->SortUrl($trx_billing->rate2) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Rate 2</td><td style="width: 10px;"><?php if ($trx_billing->rate2->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_billing->rate2->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_billing->chargeextraperson->Visible) { // chargeextraperson ?>
	<?php if ($trx_billing->SortUrl($trx_billing->chargeextraperson) == "") { ?>
		<td style="white-space: nowrap;">Chargeextraperson</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_billing->SortUrl($trx_billing->chargeextraperson) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Chargeextraperson</td><td style="width: 10px;"><?php if ($trx_billing->chargeextraperson->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_billing->chargeextraperson->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_billing->restaurant->Visible) { // restaurant ?>
	<?php if ($trx_billing->SortUrl($trx_billing->restaurant) == "") { ?>
		<td style="white-space: nowrap;">Restaurant</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_billing->SortUrl($trx_billing->restaurant) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Restaurant</td><td style="width: 10px;"><?php if ($trx_billing->restaurant->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_billing->restaurant->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_billing->additional->Visible) { // additional ?>
	<?php if ($trx_billing->SortUrl($trx_billing->additional) == "") { ?>
		<td style="white-space: nowrap;">Additional</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_billing->SortUrl($trx_billing->additional) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Additional</td><td style="width: 10px;"><?php if ($trx_billing->additional->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_billing->additional->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_billing->disc->Visible) { // disc ?>
	<?php if ($trx_billing->SortUrl($trx_billing->disc) == "") { ?>
		<td style="white-space: nowrap;">Disc (%)</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_billing->SortUrl($trx_billing->disc) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Disc (%)</td><td style="width: 10px;"><?php if ($trx_billing->disc->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_billing->disc->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_billing->discname->Visible) { // discname ?>
	<?php if ($trx_billing->SortUrl($trx_billing->discname) == "") { ?>
		<td style="white-space: nowrap;">Discname</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_billing->SortUrl($trx_billing->discname) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Discname</td><td style="width: 10px;"><?php if ($trx_billing->discname->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_billing->discname->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_billing->dp->Visible) { // dp ?>
	<?php if ($trx_billing->SortUrl($trx_billing->dp) == "") { ?>
		<td style="white-space: nowrap;">Dp</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_billing->SortUrl($trx_billing->dp) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Dp</td><td style="width: 10px;"><?php if ($trx_billing->dp->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_billing->dp->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_billing->grandtotal->Visible) { // grandtotal ?>
	<?php if ($trx_billing->SortUrl($trx_billing->grandtotal) == "") { ?>
		<td style="white-space: nowrap;">Grandtotal</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_billing->SortUrl($trx_billing->grandtotal) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Grandtotal</td><td style="width: 10px;"><?php if ($trx_billing->grandtotal->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_billing->grandtotal->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_billing->paymenttype->Visible) { // paymenttype ?>
	<?php if ($trx_billing->SortUrl($trx_billing->paymenttype) == "") { ?>
		<td style="white-space: nowrap;">Payment Type</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_billing->SortUrl($trx_billing->paymenttype) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Payment Type</td><td style="width: 10px;"><?php if ($trx_billing->paymenttype->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_billing->paymenttype->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_billing->paid->Visible) { // paid ?>
	<?php if ($trx_billing->SortUrl($trx_billing->paid) == "") { ?>
		<td style="white-space: nowrap;">Paid</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_billing->SortUrl($trx_billing->paid) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Paid</td><td style="width: 10px;"><?php if ($trx_billing->paid->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_billing->paid->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($trx_billing->ExportAll && $trx_billing->Export <> "") {
	$trx_billing_list->lStopRec = $trx_billing_list->lTotalRecs;
} else {
	$trx_billing_list->lStopRec = $trx_billing_list->lStartRec + $trx_billing_list->lDisplayRecs - 1; // Set the last record to display
}
$trx_billing_list->lRecCount = $trx_billing_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$trx_billing->SelectLimit && $trx_billing_list->lStartRec > 1)
		$rs->Move($trx_billing_list->lStartRec - 1);
}
$trx_billing_list->lRowCnt = 0;
while (($trx_billing->CurrentAction == "gridadd" || !$rs->EOF) &&
	$trx_billing_list->lRecCount < $trx_billing_list->lStopRec) {
	$trx_billing_list->lRecCount++;
	if (intval($trx_billing_list->lRecCount) >= intval($trx_billing_list->lStartRec)) {
		$trx_billing_list->lRowCnt++;

	// Init row class and style
	$trx_billing->CssClass = "";
	$trx_billing->CssStyle = "";
	$trx_billing->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($trx_billing->CurrentAction == "gridadd") {
		$trx_billing_list->LoadDefaultValues(); // Load default values
	} else {
		$trx_billing_list->LoadRowValues($rs); // Load row values
	}
	$trx_billing->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$trx_billing_list->RenderRow();
	$sql="SELECT booking FROM trx_billing WHERE kode='".$trx_billing->kode->ListViewValue()."'";
	$hsltemp=mysql_query($sql,$db);
	list($booking)=mysql_fetch_array($hsltemp);
	$sql="SELECT title,nama FROM trx_booking WHERE kode='$booking'";
	$hsltemp=mysql_query($sql,$db);
	list($title,$nama)=mysql_fetch_array($hsltemp);
	$namacust=$title." ".$nama;
?>
	<tr<?php echo $trx_billing->RowAttributes() ?>>
<?php if ($trx_billing->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<?php if($trx_billing->grup->ListViewValue()!="0") { ?>
<a href="trx_billingviewgroup.php?kode=<?php echo $trx_billing->kode->ListViewValue(); ?>"><img src="images/view.gif" title="Detail" width="16" height="16" border="0"></a>
<?php } else { ?>
<a href="<?php echo $trx_billing->ViewUrl() ?>"><img src="images/view.gif" title="Detail" width="16" height="16" border="0"></a>
<?php } ?>
</span></td>
<?php

// Custom list options
foreach ($trx_billing_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($trx_billing->kode->Visible) { // kode ?>
		<td<?php echo $trx_billing->kode->CellAttributes() ?>>
<div<?php echo $trx_billing->kode->ViewAttributes() ?>><?php echo $trx_billing->kode->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_billing->grup->Visible) { // grup ?>
		<td<?php echo $trx_billing->grup->CellAttributes() ?>>
<div<?php echo $trx_billing->grup->ViewAttributes() ?>><?php echo $trx_billing->grup->ListViewValue() ?></div>
</td>
		<td<?php echo $trx_billing->grup->CellAttributes() ?>>
		<?php echo $namacust; ?>
		</td>
	<?php } ?>
	<?php if ($trx_billing->tanggal->Visible) { // tanggal ?>
		<td<?php echo $trx_billing->tanggal->CellAttributes() ?>>
<div<?php echo $trx_billing->tanggal->ViewAttributes() ?>><?php echo $trx_billing->tanggal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_billing->room->Visible) { // room ?>
		<td<?php echo $trx_billing->room->CellAttributes() ?>>
<div<?php echo $trx_billing->room->ViewAttributes() ?>><?php echo $trx_billing->room->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_billing->rate->Visible) { // rate ?>
		<td<?php echo $trx_billing->rate->CellAttributes() ?>>
<div<?php echo $trx_billing->rate->ViewAttributes() ?>><?php echo $trx_billing->rate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_billing->rate2->Visible) { // rate2 ?>
		<td<?php echo $trx_billing->rate2->CellAttributes() ?>>
<div<?php echo $trx_billing->rate2->ViewAttributes() ?>><?php echo $trx_billing->rate2->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_billing->chargeextraperson->Visible) { // chargeextraperson ?>
		<td<?php echo $trx_billing->chargeextraperson->CellAttributes() ?>>
<div<?php echo $trx_billing->chargeextraperson->ViewAttributes() ?>><?php echo $trx_billing->chargeextraperson->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_billing->restaurant->Visible) { // restaurant ?>
		<td<?php echo $trx_billing->restaurant->CellAttributes() ?>>
<div<?php echo $trx_billing->restaurant->ViewAttributes() ?>><?php echo $trx_billing->restaurant->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_billing->additional->Visible) { // additional ?>
		<td<?php echo $trx_billing->additional->CellAttributes() ?>>
<div<?php echo $trx_billing->additional->ViewAttributes() ?>><?php echo $trx_billing->additional->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_billing->disc->Visible) { // disc ?>
		<td<?php echo $trx_billing->disc->CellAttributes() ?>>
<div<?php echo $trx_billing->disc->ViewAttributes() ?>><?php echo $trx_billing->disc->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_billing->discname->Visible) { // discname ?>
		<td<?php echo $trx_billing->discname->CellAttributes() ?>>
<div<?php echo $trx_billing->discname->ViewAttributes() ?>><?php echo $trx_billing->discname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_billing->dp->Visible) { // dp ?>
		<td<?php echo $trx_billing->dp->CellAttributes() ?>>
<div<?php echo $trx_billing->dp->ViewAttributes() ?>><?php echo $trx_billing->dp->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_billing->grandtotal->Visible) { // grandtotal ?>
		<td<?php echo $trx_billing->grandtotal->CellAttributes() ?>>
<div<?php echo $trx_billing->grandtotal->ViewAttributes() ?>><?php echo $trx_billing->grandtotal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_billing->paymenttype->Visible) { // paymenttype ?>
		<td<?php echo $trx_billing->paymenttype->CellAttributes() ?>>
<div<?php echo $trx_billing->paymenttype->ViewAttributes() ?>><?php echo $trx_billing->paymenttype->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_billing->paid->Visible) { // paid ?>
		<td<?php echo $trx_billing->paid->CellAttributes() ?>>
<div<?php echo $trx_billing->paid->ViewAttributes() ?>><?php echo $trx_billing->paid->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($trx_billing->CurrentAction <> "gridadd")
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
<?php if ($trx_billing->Export == "" && $trx_billing->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(trx_billing_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($trx_billing->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$trx_billing_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class ctrx_billing_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'trx_billing';

	// Page Object Name
	var $PageObjName = 'trx_billing_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $trx_billing;
		if ($trx_billing->UseTokenInUrl) $PageUrl .= "t=" . $trx_billing->TableVar . "&"; // add page token
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
		global $objForm, $trx_billing;
		if ($trx_billing->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($trx_billing->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($trx_billing->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ctrx_billing_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["trx_billing"] = new ctrx_billing();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'trx_billing', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $trx_billing;
	$trx_billing->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $trx_billing->Export; // Get export parameter, used in header
	$gsExportFile = $trx_billing->TableVar; // Get export file, used in header
	if ($trx_billing->Export == "print" || $trx_billing->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($trx_billing->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
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
		global $objForm, $gsSearchError, $Security, $trx_billing;
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
		if ($trx_billing->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $trx_billing->getRecordsPerPage(); // Restore from Session
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
		$trx_billing->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$trx_billing->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$trx_billing->setStartRecordNumber($this->lStartRec);
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
		$trx_billing->setSessionWhere($sFilter);
		$trx_billing->CurrentFilter = "";

		// Export data only
		if (in_array($trx_billing->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $trx_billing;
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
			$trx_billing->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$trx_billing->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $trx_billing;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $trx_billing->kode, FALSE); // Field kode
		$this->BuildSearchSql($sWhere, $trx_billing->grup, FALSE); // Field grup
		$this->BuildSearchSql($sWhere, $trx_billing->idseqno, FALSE); // Field idseqno
		$this->BuildSearchSql($sWhere, $trx_billing->tanggal, FALSE); // Field tanggal
		$this->BuildSearchSql($sWhere, $trx_billing->booking, FALSE); // Field booking
		$this->BuildSearchSql($sWhere, $trx_billing->room, FALSE); // Field room
		$this->BuildSearchSql($sWhere, $trx_billing->withppn, FALSE); // Field withppn
		$this->BuildSearchSql($sWhere, $trx_billing->withservice, FALSE); // Field withservice
		$this->BuildSearchSql($sWhere, $trx_billing->rate, FALSE); // Field rate
		$this->BuildSearchSql($sWhere, $trx_billing->rate2, FALSE); // Field rate2
		$this->BuildSearchSql($sWhere, $trx_billing->chargeextraperson, FALSE); // Field chargeextraperson
		$this->BuildSearchSql($sWhere, $trx_billing->restaurant, FALSE); // Field restaurant
		$this->BuildSearchSql($sWhere, $trx_billing->additional, FALSE); // Field additional
		$this->BuildSearchSql($sWhere, $trx_billing->ppn, FALSE); // Field ppn
		$this->BuildSearchSql($sWhere, $trx_billing->subtotal2, FALSE); // Field subtotal2
		$this->BuildSearchSql($sWhere, $trx_billing->service, FALSE); // Field service
		$this->BuildSearchSql($sWhere, $trx_billing->disc, FALSE); // Field disc
		$this->BuildSearchSql($sWhere, $trx_billing->discname, FALSE); // Field discname
		$this->BuildSearchSql($sWhere, $trx_billing->dp, FALSE); // Field dp
		$this->BuildSearchSql($sWhere, $trx_billing->grandtotal, FALSE); // Field grandtotal
		$this->BuildSearchSql($sWhere, $trx_billing->paymenttype, FALSE); // Field paymenttype
		$this->BuildSearchSql($sWhere, $trx_billing->createby, FALSE); // Field createby
		$this->BuildSearchSql($sWhere, $trx_billing->createdate, FALSE); // Field createdate
		$this->BuildSearchSql($sWhere, $trx_billing->subtotal1, FALSE); // Field subtotal1
		$this->BuildSearchSql($sWhere, $trx_billing->coabank, FALSE); // Field coabank
		$this->BuildSearchSql($sWhere, $trx_billing->norek, FALSE); // Field norek
		$this->BuildSearchSql($sWhere, $trx_billing->paid, FALSE); // Field paid

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($trx_billing->kode); // Field kode
			$this->SetSearchParm($trx_billing->grup); // Field grup
			$this->SetSearchParm($trx_billing->idseqno); // Field idseqno
			$this->SetSearchParm($trx_billing->tanggal); // Field tanggal
			$this->SetSearchParm($trx_billing->booking); // Field booking
			$this->SetSearchParm($trx_billing->room); // Field room
			$this->SetSearchParm($trx_billing->withppn); // Field withppn
			$this->SetSearchParm($trx_billing->withservice); // Field withservice
			$this->SetSearchParm($trx_billing->rate); // Field rate
			$this->SetSearchParm($trx_billing->rate2); // Field rate2
			$this->SetSearchParm($trx_billing->chargeextraperson); // Field chargeextraperson
			$this->SetSearchParm($trx_billing->restaurant); // Field restaurant
			$this->SetSearchParm($trx_billing->additional); // Field additional
			$this->SetSearchParm($trx_billing->ppn); // Field ppn
			$this->SetSearchParm($trx_billing->subtotal2); // Field subtotal2
			$this->SetSearchParm($trx_billing->service); // Field service
			$this->SetSearchParm($trx_billing->disc); // Field disc
			$this->SetSearchParm($trx_billing->discname); // Field discname
			$this->SetSearchParm($trx_billing->dp); // Field dp
			$this->SetSearchParm($trx_billing->grandtotal); // Field grandtotal
			$this->SetSearchParm($trx_billing->paymenttype); // Field paymenttype
			$this->SetSearchParm($trx_billing->createby); // Field createby
			$this->SetSearchParm($trx_billing->createdate); // Field createdate
			$this->SetSearchParm($trx_billing->subtotal1); // Field subtotal1
			$this->SetSearchParm($trx_billing->coabank); // Field coabank
			$this->SetSearchParm($trx_billing->norek); // Field norek
			$this->SetSearchParm($trx_billing->paid); // Field paid
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
		global $trx_billing;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$trx_billing->setAdvancedSearch("x_$FldParm", $FldVal);
		$trx_billing->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$trx_billing->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$trx_billing->setAdvancedSearch("y_$FldParm", $FldVal2);
		$trx_billing->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $trx_billing;
		$this->sSrchWhere = "";
		$trx_billing->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $trx_billing;
		$trx_billing->setAdvancedSearch("x_kode", "");
		$trx_billing->setAdvancedSearch("x_grup", "");
		$trx_billing->setAdvancedSearch("x_idseqno", "");
		$trx_billing->setAdvancedSearch("x_tanggal", "");
		$trx_billing->setAdvancedSearch("x_booking", "");
		$trx_billing->setAdvancedSearch("x_room", "");
		$trx_billing->setAdvancedSearch("x_withppn", "");
		$trx_billing->setAdvancedSearch("x_withservice", "");
		$trx_billing->setAdvancedSearch("x_rate", "");
		$trx_billing->setAdvancedSearch("x_rate2", "");
		$trx_billing->setAdvancedSearch("x_chargeextraperson", "");
		$trx_billing->setAdvancedSearch("x_restaurant", "");
		$trx_billing->setAdvancedSearch("x_additional", "");
		$trx_billing->setAdvancedSearch("x_ppn", "");
		$trx_billing->setAdvancedSearch("x_subtotal2", "");
		$trx_billing->setAdvancedSearch("x_service", "");
		$trx_billing->setAdvancedSearch("x_disc", "");
		$trx_billing->setAdvancedSearch("x_discname", "");
		$trx_billing->setAdvancedSearch("x_dp", "");
		$trx_billing->setAdvancedSearch("x_grandtotal", "");
		$trx_billing->setAdvancedSearch("x_paymenttype", "");
		$trx_billing->setAdvancedSearch("x_createby", "");
		$trx_billing->setAdvancedSearch("x_createdate", "");
		$trx_billing->setAdvancedSearch("x_subtotal1", "");
		$trx_billing->setAdvancedSearch("x_coabank", "");
		$trx_billing->setAdvancedSearch("x_norek", "");
		$trx_billing->setAdvancedSearch("x_paid", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $trx_billing;
		$this->sSrchWhere = $trx_billing->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $trx_billing;
		 $trx_billing->kode->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_kode");
		 $trx_billing->grup->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_grup");
		 $trx_billing->idseqno->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_idseqno");
		 $trx_billing->tanggal->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_tanggal");
		 $trx_billing->booking->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_booking");
		 $trx_billing->room->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_room");
		 $trx_billing->withppn->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_withppn");
		 $trx_billing->withservice->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_withservice");
		 $trx_billing->rate->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_rate");
		 $trx_billing->rate2->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_rate2");
		 $trx_billing->chargeextraperson->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_chargeextraperson");
		 $trx_billing->restaurant->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_restaurant");
		 $trx_billing->additional->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_additional");
		 $trx_billing->ppn->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_ppn");
		 $trx_billing->subtotal2->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_subtotal2");
		 $trx_billing->service->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_service");
		 $trx_billing->disc->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_disc");
		 $trx_billing->discname->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_discname");
		 $trx_billing->dp->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_dp");
		 $trx_billing->grandtotal->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_grandtotal");
		 $trx_billing->paymenttype->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_paymenttype");
		 $trx_billing->createby->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_createby");
		 $trx_billing->createdate->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_createdate");
		 $trx_billing->subtotal1->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_subtotal1");
		 $trx_billing->coabank->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_coabank");
		 $trx_billing->norek->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_norek");
		 $trx_billing->paid->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_paid");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $trx_billing;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$trx_billing->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$trx_billing->CurrentOrderType = @$_GET["ordertype"];
			$trx_billing->UpdateSort($trx_billing->kode); // Field 
			$trx_billing->UpdateSort($trx_billing->grup); // Field 
			$trx_billing->UpdateSort($trx_billing->tanggal); // Field 
			$trx_billing->UpdateSort($trx_billing->room); // Field 
			$trx_billing->UpdateSort($trx_billing->rate); // Field 
			$trx_billing->UpdateSort($trx_billing->rate2); // Field 
			$trx_billing->UpdateSort($trx_billing->chargeextraperson); // Field 
			$trx_billing->UpdateSort($trx_billing->restaurant); // Field 
			$trx_billing->UpdateSort($trx_billing->additional); // Field 
			$trx_billing->UpdateSort($trx_billing->disc); // Field 
			$trx_billing->UpdateSort($trx_billing->discname); // Field 
			$trx_billing->UpdateSort($trx_billing->dp); // Field 
			$trx_billing->UpdateSort($trx_billing->grandtotal); // Field 
			$trx_billing->UpdateSort($trx_billing->paymenttype); // Field 
			$trx_billing->UpdateSort($trx_billing->paid); // Field 
			$trx_billing->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $trx_billing;
		$sOrderBy = $trx_billing->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($trx_billing->SqlOrderBy() <> "") {
				$sOrderBy = $trx_billing->SqlOrderBy();
				$trx_billing->setSessionOrderBy($sOrderBy);
				$trx_billing->tanggal->setSort("DESC");
				$trx_billing->kode->setSort("DESC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $trx_billing;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$trx_billing->setSessionOrderBy($sOrderBy);
				$trx_billing->kode->setSort("");
				$trx_billing->grup->setSort("");
				$trx_billing->tanggal->setSort("");
				$trx_billing->room->setSort("");
				$trx_billing->rate->setSort("");
				$trx_billing->rate2->setSort("");
				$trx_billing->chargeextraperson->setSort("");
				$trx_billing->restaurant->setSort("");
				$trx_billing->additional->setSort("");
				$trx_billing->disc->setSort("");
				$trx_billing->discname->setSort("");
				$trx_billing->dp->setSort("");
				$trx_billing->grandtotal->setSort("");
				$trx_billing->paymenttype->setSort("");
				$trx_billing->paid->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$trx_billing->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $trx_billing;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$trx_billing->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$trx_billing->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $trx_billing->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$trx_billing->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$trx_billing->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$trx_billing->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $trx_billing;

		// Load search values
		// kode

		$trx_billing->kode->AdvancedSearch->SearchValue = @$_GET["x_kode"];
		$trx_billing->kode->AdvancedSearch->SearchOperator = @$_GET["z_kode"];

		// grup
		$trx_billing->grup->AdvancedSearch->SearchValue = @$_GET["x_grup"];
		$trx_billing->grup->AdvancedSearch->SearchOperator = @$_GET["z_grup"];

		// idseqno
		$trx_billing->idseqno->AdvancedSearch->SearchValue = @$_GET["x_idseqno"];
		$trx_billing->idseqno->AdvancedSearch->SearchOperator = @$_GET["z_idseqno"];

		// tanggal
		$trx_billing->tanggal->AdvancedSearch->SearchValue = @$_GET["x_tanggal"];
		$trx_billing->tanggal->AdvancedSearch->SearchOperator = @$_GET["z_tanggal"];

		// booking
		$trx_billing->booking->AdvancedSearch->SearchValue = @$_GET["x_booking"];
		$trx_billing->booking->AdvancedSearch->SearchOperator = @$_GET["z_booking"];

		// room
		$trx_billing->room->AdvancedSearch->SearchValue = @$_GET["x_room"];
		$trx_billing->room->AdvancedSearch->SearchOperator = @$_GET["z_room"];

		// withppn
		$trx_billing->withppn->AdvancedSearch->SearchValue = @$_GET["x_withppn"];
		$trx_billing->withppn->AdvancedSearch->SearchOperator = @$_GET["z_withppn"];

		// withservice
		$trx_billing->withservice->AdvancedSearch->SearchValue = @$_GET["x_withservice"];
		$trx_billing->withservice->AdvancedSearch->SearchOperator = @$_GET["z_withservice"];

		// rate
		$trx_billing->rate->AdvancedSearch->SearchValue = @$_GET["x_rate"];
		$trx_billing->rate->AdvancedSearch->SearchOperator = @$_GET["z_rate"];

		// rate2
		$trx_billing->rate2->AdvancedSearch->SearchValue = @$_GET["x_rate2"];
		$trx_billing->rate2->AdvancedSearch->SearchOperator = @$_GET["z_rate2"];

		// chargeextraperson
		$trx_billing->chargeextraperson->AdvancedSearch->SearchValue = @$_GET["x_chargeextraperson"];
		$trx_billing->chargeextraperson->AdvancedSearch->SearchOperator = @$_GET["z_chargeextraperson"];

		// restaurant
		$trx_billing->restaurant->AdvancedSearch->SearchValue = @$_GET["x_restaurant"];
		$trx_billing->restaurant->AdvancedSearch->SearchOperator = @$_GET["z_restaurant"];

		// additional
		$trx_billing->additional->AdvancedSearch->SearchValue = @$_GET["x_additional"];
		$trx_billing->additional->AdvancedSearch->SearchOperator = @$_GET["z_additional"];

		// ppn
		$trx_billing->ppn->AdvancedSearch->SearchValue = @$_GET["x_ppn"];
		$trx_billing->ppn->AdvancedSearch->SearchOperator = @$_GET["z_ppn"];

		// subtotal2
		$trx_billing->subtotal2->AdvancedSearch->SearchValue = @$_GET["x_subtotal2"];
		$trx_billing->subtotal2->AdvancedSearch->SearchOperator = @$_GET["z_subtotal2"];

		// service
		$trx_billing->service->AdvancedSearch->SearchValue = @$_GET["x_service"];
		$trx_billing->service->AdvancedSearch->SearchOperator = @$_GET["z_service"];

		// disc
		$trx_billing->disc->AdvancedSearch->SearchValue = @$_GET["x_disc"];
		$trx_billing->disc->AdvancedSearch->SearchOperator = @$_GET["z_disc"];

		// discname
		$trx_billing->discname->AdvancedSearch->SearchValue = @$_GET["x_discname"];
		$trx_billing->discname->AdvancedSearch->SearchOperator = @$_GET["z_discname"];

		// dp
		$trx_billing->dp->AdvancedSearch->SearchValue = @$_GET["x_dp"];
		$trx_billing->dp->AdvancedSearch->SearchOperator = @$_GET["z_dp"];

		// grandtotal
		$trx_billing->grandtotal->AdvancedSearch->SearchValue = @$_GET["x_grandtotal"];
		$trx_billing->grandtotal->AdvancedSearch->SearchOperator = @$_GET["z_grandtotal"];

		// paymenttype
		$trx_billing->paymenttype->AdvancedSearch->SearchValue = @$_GET["x_paymenttype"];
		$trx_billing->paymenttype->AdvancedSearch->SearchOperator = @$_GET["z_paymenttype"];

		// createby
		$trx_billing->createby->AdvancedSearch->SearchValue = @$_GET["x_createby"];
		$trx_billing->createby->AdvancedSearch->SearchOperator = @$_GET["z_createby"];

		// createdate
		$trx_billing->createdate->AdvancedSearch->SearchValue = @$_GET["x_createdate"];
		$trx_billing->createdate->AdvancedSearch->SearchOperator = @$_GET["z_createdate"];

		// subtotal1
		$trx_billing->subtotal1->AdvancedSearch->SearchValue = @$_GET["x_subtotal1"];
		$trx_billing->subtotal1->AdvancedSearch->SearchOperator = @$_GET["z_subtotal1"];

		// coabank
		$trx_billing->coabank->AdvancedSearch->SearchValue = @$_GET["x_coabank"];
		$trx_billing->coabank->AdvancedSearch->SearchOperator = @$_GET["z_coabank"];

		// norek
		$trx_billing->norek->AdvancedSearch->SearchValue = @$_GET["x_norek"];
		$trx_billing->norek->AdvancedSearch->SearchOperator = @$_GET["z_norek"];

		// paid
		$trx_billing->paid->AdvancedSearch->SearchValue = @$_GET["x_paid"];
		$trx_billing->paid->AdvancedSearch->SearchOperator = @$_GET["z_paid"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $trx_billing;

		// Call Recordset Selecting event
		$trx_billing->Recordset_Selecting($trx_billing->CurrentFilter);

		// Load list page SQL
		$sSql = $trx_billing->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$trx_billing->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $trx_billing;
		$sFilter = $trx_billing->KeyFilter();

		// Call Row Selecting event
		$trx_billing->Row_Selecting($sFilter);

		// Load sql based on filter
		$trx_billing->CurrentFilter = $sFilter;
		$sSql = $trx_billing->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$trx_billing->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $trx_billing;
		$trx_billing->kode->setDbValue($rs->fields('kode'));
		$trx_billing->grup->setDbValue($rs->fields('grup'));
		$trx_billing->idseqno->setDbValue($rs->fields('idseqno'));
		$trx_billing->tanggal->setDbValue($rs->fields('tanggal'));
		$trx_billing->booking->setDbValue($rs->fields('booking'));
		$trx_billing->room->setDbValue($rs->fields('room'));
		$trx_billing->withppn->setDbValue($rs->fields('withppn'));
		$trx_billing->withservice->setDbValue($rs->fields('withservice'));
		$trx_billing->rate->setDbValue($rs->fields('rate'));
		$trx_billing->rate2->setDbValue($rs->fields('rate2'));
		$trx_billing->chargeextraperson->setDbValue($rs->fields('chargeextraperson'));
		$trx_billing->restaurant->setDbValue($rs->fields('restaurant'));
		$trx_billing->additional->setDbValue($rs->fields('additional'));
		$trx_billing->ppn->setDbValue($rs->fields('ppn'));
		$trx_billing->subtotal2->setDbValue($rs->fields('subtotal2'));
		$trx_billing->service->setDbValue($rs->fields('service'));
		$trx_billing->disc->setDbValue($rs->fields('disc'));
		$trx_billing->discname->setDbValue($rs->fields('discname'));
		$trx_billing->dp->setDbValue($rs->fields('dp'));
		$trx_billing->grandtotal->setDbValue($rs->fields('grandtotal'));
		$trx_billing->paymenttype->setDbValue($rs->fields('paymenttype'));
		$trx_billing->createby->setDbValue($rs->fields('createby'));
		$trx_billing->createdate->setDbValue($rs->fields('createdate'));
		$trx_billing->subtotal1->setDbValue($rs->fields('subtotal1'));
		$trx_billing->coabank->setDbValue($rs->fields('coabank'));
		$trx_billing->norek->setDbValue($rs->fields('norek'));
		$trx_billing->paid->setDbValue($rs->fields('paid'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $trx_billing;

		// Call Row_Rendering event
		$trx_billing->Row_Rendering();

		// Common render codes for all row types
		// kode

		$trx_billing->kode->CellCssStyle = "white-space: nowrap;";
		$trx_billing->kode->CellCssClass = "";

		// grup
		$trx_billing->grup->CellCssStyle = "white-space: nowrap;";
		$trx_billing->grup->CellCssClass = "";

		// tanggal
		$trx_billing->tanggal->CellCssStyle = "white-space: nowrap;";
		$trx_billing->tanggal->CellCssClass = "";

		// room
		$trx_billing->room->CellCssStyle = "white-space: nowrap;";
		$trx_billing->room->CellCssClass = "";

		// rate
		$trx_billing->rate->CellCssStyle = "white-space: nowrap;";
		$trx_billing->rate->CellCssClass = "";

		// rate2
		$trx_billing->rate2->CellCssStyle = "white-space: nowrap;";
		$trx_billing->rate2->CellCssClass = "";

		// chargeextraperson
		$trx_billing->chargeextraperson->CellCssStyle = "white-space: nowrap;";
		$trx_billing->chargeextraperson->CellCssClass = "";

		// restaurant
		$trx_billing->restaurant->CellCssStyle = "white-space: nowrap;";
		$trx_billing->restaurant->CellCssClass = "";

		// additional
		$trx_billing->additional->CellCssStyle = "white-space: nowrap;";
		$trx_billing->additional->CellCssClass = "";

		// disc
		$trx_billing->disc->CellCssStyle = "white-space: nowrap;";
		$trx_billing->disc->CellCssClass = "";

		// discname
		$trx_billing->discname->CellCssStyle = "white-space: nowrap;";
		$trx_billing->discname->CellCssClass = "";

		// dp
		$trx_billing->dp->CellCssStyle = "white-space: nowrap;";
		$trx_billing->dp->CellCssClass = "";

		// grandtotal
		$trx_billing->grandtotal->CellCssStyle = "white-space: nowrap;";
		$trx_billing->grandtotal->CellCssClass = "";

		// paymenttype
		$trx_billing->paymenttype->CellCssStyle = "white-space: nowrap;";
		$trx_billing->paymenttype->CellCssClass = "";

		// paid
		$trx_billing->paid->CellCssStyle = "white-space: nowrap;";
		$trx_billing->paid->CellCssClass = "";
		if ($trx_billing->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$trx_billing->kode->ViewValue = $trx_billing->kode->CurrentValue;
			$trx_billing->kode->CssStyle = "";
			$trx_billing->kode->CssClass = "";
			$trx_billing->kode->ViewCustomAttributes = "";

			// grup
			$trx_billing->grup->ViewValue = $trx_billing->grup->CurrentValue;
			$trx_billing->grup->CssStyle = "";
			$trx_billing->grup->CssClass = "";
			$trx_billing->grup->ViewCustomAttributes = "";

			// idseqno
			$trx_billing->idseqno->ViewValue = $trx_billing->idseqno->CurrentValue;
			$trx_billing->idseqno->CssStyle = "";
			$trx_billing->idseqno->CssClass = "";
			$trx_billing->idseqno->ViewCustomAttributes = "";

			// tanggal
			$trx_billing->tanggal->ViewValue = $trx_billing->tanggal->CurrentValue;
			$trx_billing->tanggal->ViewValue = ew_FormatDateTime($trx_billing->tanggal->ViewValue, 7);
			$trx_billing->tanggal->CssStyle = "";
			$trx_billing->tanggal->CssClass = "";
			$trx_billing->tanggal->ViewCustomAttributes = "";

			// booking
			$trx_billing->booking->ViewValue = $trx_billing->booking->CurrentValue;
			$trx_billing->booking->CssStyle = "";
			$trx_billing->booking->CssClass = "";
			$trx_billing->booking->ViewCustomAttributes = "";

			// room
			if (strval($trx_billing->room->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `mst_room` WHERE `kode` = '" . ew_AdjustSql($trx_billing->room->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$trx_billing->room->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$trx_billing->room->ViewValue = $trx_billing->room->CurrentValue;
				}
			} else {
				$trx_billing->room->ViewValue = NULL;
			}
			$trx_billing->room->CssStyle = "";
			$trx_billing->room->CssClass = "";
			$trx_billing->room->ViewCustomAttributes = "";

			// withppn
			$trx_billing->withppn->ViewValue = $trx_billing->withppn->CurrentValue;
			$trx_billing->withppn->CssStyle = "";
			$trx_billing->withppn->CssClass = "";
			$trx_billing->withppn->ViewCustomAttributes = "";

			// withservice
			$trx_billing->withservice->ViewValue = $trx_billing->withservice->CurrentValue;
			$trx_billing->withservice->CssStyle = "";
			$trx_billing->withservice->CssClass = "";
			$trx_billing->withservice->ViewCustomAttributes = "";

			// rate
			$trx_billing->rate->ViewValue = $trx_billing->rate->CurrentValue;
			$trx_billing->rate->ViewValue = ew_FormatNumber($trx_billing->rate->ViewValue, 0, -2, -2, -2);
			$trx_billing->rate->CssStyle = "text-align:right;";
			$trx_billing->rate->CssClass = "";
			$trx_billing->rate->ViewCustomAttributes = "";

			// rate2
			$trx_billing->rate2->ViewValue = $trx_billing->rate2->CurrentValue;
			$trx_billing->rate2->CssStyle = "";
			$trx_billing->rate2->CssClass = "";
			$trx_billing->rate2->ViewCustomAttributes = "";

			// chargeextraperson
			$trx_billing->chargeextraperson->ViewValue = $trx_billing->chargeextraperson->CurrentValue;
			$trx_billing->chargeextraperson->ViewValue = ew_FormatNumber($trx_billing->chargeextraperson->ViewValue, 0, -2, -2, -2);
			$trx_billing->chargeextraperson->CssStyle = "text-align:right;";
			$trx_billing->chargeextraperson->CssClass = "";
			$trx_billing->chargeextraperson->ViewCustomAttributes = "";

			// restaurant
			$trx_billing->restaurant->ViewValue = $trx_billing->restaurant->CurrentValue;
			$trx_billing->restaurant->ViewValue = ew_FormatNumber($trx_billing->restaurant->ViewValue, 0, -2, -2, -2);
			$trx_billing->restaurant->CssStyle = "text-align:right;";
			$trx_billing->restaurant->CssClass = "";
			$trx_billing->restaurant->ViewCustomAttributes = "";

			// additional
			$trx_billing->additional->ViewValue = $trx_billing->additional->CurrentValue;
			$trx_billing->additional->ViewValue = ew_FormatNumber($trx_billing->additional->ViewValue, 0, -2, -2, -2);
			$trx_billing->additional->CssStyle = "text-align:right;";
			$trx_billing->additional->CssClass = "";
			$trx_billing->additional->ViewCustomAttributes = "";

			// disc
			$trx_billing->disc->ViewValue = $trx_billing->disc->CurrentValue;
			$trx_billing->disc->CssStyle = "text-align:right;";
			$trx_billing->disc->CssClass = "";
			$trx_billing->disc->ViewCustomAttributes = "";

			// discname
			$trx_billing->discname->ViewValue = $trx_billing->discname->CurrentValue;
			$trx_billing->discname->CssStyle = "";
			$trx_billing->discname->CssClass = "";
			$trx_billing->discname->ViewCustomAttributes = "";

			// dp
			$trx_billing->dp->ViewValue = $trx_billing->dp->CurrentValue;
			$trx_billing->dp->CssStyle = "text-align:right;";
			$trx_billing->dp->CssClass = "";
			$trx_billing->dp->ViewCustomAttributes = "";

			// grandtotal
			$trx_billing->grandtotal->ViewValue = $trx_billing->grandtotal->CurrentValue;
			$trx_billing->grandtotal->ViewValue = ew_FormatNumber($trx_billing->grandtotal->ViewValue, 0, -2, -2, -2);
			$trx_billing->grandtotal->CssStyle = "text-align:right;";
			$trx_billing->grandtotal->CssClass = "";
			$trx_billing->grandtotal->ViewCustomAttributes = "";

			// paymenttype
			if (strval($trx_billing->paymenttype->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `description` FROM `mst_pay_type` WHERE `kode` = '" . ew_AdjustSql($trx_billing->paymenttype->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$trx_billing->paymenttype->ViewValue = $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$trx_billing->paymenttype->ViewValue = $trx_billing->paymenttype->CurrentValue;
				}
			} else {
				$trx_billing->paymenttype->ViewValue = NULL;
			}
			$trx_billing->paymenttype->CssStyle = "";
			$trx_billing->paymenttype->CssClass = "";
			$trx_billing->paymenttype->ViewCustomAttributes = "";

			// paid
			if (strval($trx_billing->paid->CurrentValue) <> "") {
				switch ($trx_billing->paid->CurrentValue) {
					case "0":
						$trx_billing->paid->ViewValue = "No";
						break;
					case "1":
						$trx_billing->paid->ViewValue = "Yes";
						break;
					default:
						$trx_billing->paid->ViewValue = $trx_billing->paid->CurrentValue;
				}
			} else {
				$trx_billing->paid->ViewValue = NULL;
			}
			$trx_billing->paid->CssStyle = "";
			$trx_billing->paid->CssClass = "";
			$trx_billing->paid->ViewCustomAttributes = "";

			// kode
			$trx_billing->kode->HrefValue = "";

			// grup
			$trx_billing->grup->HrefValue = "";

			// tanggal
			$trx_billing->tanggal->HrefValue = "";

			// room
			$trx_billing->room->HrefValue = "";

			// rate
			$trx_billing->rate->HrefValue = "";

			// rate2
			$trx_billing->rate2->HrefValue = "";

			// chargeextraperson
			$trx_billing->chargeextraperson->HrefValue = "";

			// restaurant
			$trx_billing->restaurant->HrefValue = "";

			// additional
			$trx_billing->additional->HrefValue = "";

			// disc
			$trx_billing->disc->HrefValue = "";

			// discname
			$trx_billing->discname->HrefValue = "";

			// dp
			$trx_billing->dp->HrefValue = "";

			// grandtotal
			$trx_billing->grandtotal->HrefValue = "";

			// paymenttype
			$trx_billing->paymenttype->HrefValue = "";

			// paid
			$trx_billing->paid->HrefValue = "";
		} elseif ($trx_billing->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// kode
			$trx_billing->kode->EditCustomAttributes = "";
			$trx_billing->kode->EditValue = ew_HtmlEncode($trx_billing->kode->AdvancedSearch->SearchValue);

			// grup
			$trx_billing->grup->EditCustomAttributes = "";
			$trx_billing->grup->EditValue = ew_HtmlEncode($trx_billing->grup->AdvancedSearch->SearchValue);

			// tanggal
			$trx_billing->tanggal->EditCustomAttributes = "";
			$trx_billing->tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($trx_billing->tanggal->AdvancedSearch->SearchValue, 7), 7));

			// room
			$trx_billing->room->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_room`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$trx_billing->room->EditValue = $arwrk;

			// rate
			$trx_billing->rate->EditCustomAttributes = "";
			$trx_billing->rate->EditValue = ew_HtmlEncode($trx_billing->rate->AdvancedSearch->SearchValue);

			// rate2
			$trx_billing->rate2->EditCustomAttributes = "";
			$trx_billing->rate2->EditValue = ew_HtmlEncode($trx_billing->rate2->AdvancedSearch->SearchValue);

			// chargeextraperson
			$trx_billing->chargeextraperson->EditCustomAttributes = "";
			$trx_billing->chargeextraperson->EditValue = ew_HtmlEncode($trx_billing->chargeextraperson->AdvancedSearch->SearchValue);

			// restaurant
			$trx_billing->restaurant->EditCustomAttributes = "";
			$trx_billing->restaurant->EditValue = ew_HtmlEncode($trx_billing->restaurant->AdvancedSearch->SearchValue);

			// additional
			$trx_billing->additional->EditCustomAttributes = "";
			$trx_billing->additional->EditValue = ew_HtmlEncode($trx_billing->additional->AdvancedSearch->SearchValue);

			// disc
			$trx_billing->disc->EditCustomAttributes = "";
			$trx_billing->disc->EditValue = ew_HtmlEncode($trx_billing->disc->AdvancedSearch->SearchValue);

			// discname
			$trx_billing->discname->EditCustomAttributes = "";
			$trx_billing->discname->EditValue = ew_HtmlEncode($trx_billing->discname->AdvancedSearch->SearchValue);

			// dp
			$trx_billing->dp->EditCustomAttributes = "";
			$trx_billing->dp->EditValue = ew_HtmlEncode($trx_billing->dp->AdvancedSearch->SearchValue);

			// grandtotal
			$trx_billing->grandtotal->EditCustomAttributes = "";
			$trx_billing->grandtotal->EditValue = ew_HtmlEncode($trx_billing->grandtotal->AdvancedSearch->SearchValue);

			// paymenttype
			$trx_billing->paymenttype->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `description`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_pay_type`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$trx_billing->paymenttype->EditValue = $arwrk;

			// paid
			$trx_billing->paid->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			array_unshift($arwrk, array("", "Please Select"));
			$trx_billing->paid->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$trx_billing->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $trx_billing;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckEuroDate($trx_billing->tanggal->AdvancedSearch->SearchValue)) {
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
		global $trx_billing;
		$trx_billing->kode->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_kode");
		$trx_billing->grup->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_grup");
		$trx_billing->idseqno->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_idseqno");
		$trx_billing->tanggal->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_tanggal");
		$trx_billing->booking->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_booking");
		$trx_billing->room->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_room");
		$trx_billing->withppn->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_withppn");
		$trx_billing->withservice->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_withservice");
		$trx_billing->rate->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_rate");
		$trx_billing->rate2->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_rate2");
		$trx_billing->chargeextraperson->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_chargeextraperson");
		$trx_billing->restaurant->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_restaurant");
		$trx_billing->additional->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_additional");
		$trx_billing->ppn->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_ppn");
		$trx_billing->subtotal2->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_subtotal2");
		$trx_billing->service->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_service");
		$trx_billing->disc->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_disc");
		$trx_billing->discname->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_discname");
		$trx_billing->dp->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_dp");
		$trx_billing->grandtotal->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_grandtotal");
		$trx_billing->paymenttype->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_paymenttype");
		$trx_billing->createby->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_createby");
		$trx_billing->createdate->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_createdate");
		$trx_billing->subtotal1->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_subtotal1");
		$trx_billing->coabank->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_coabank");
		$trx_billing->norek->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_norek");
		$trx_billing->paid->AdvancedSearch->SearchValue = $trx_billing->getAdvancedSearch("x_paid");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $trx_billing;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($trx_billing->ExportAll) {
			$this->lStopRec = $this->lTotalRecs;
		} else { // Export 1 page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->lDisplayRecs < 0) {
				$this->lStopRec = $this->lTotalRecs;
			} else {
				$this->lStopRec = $this->lStartRec + $this->lDisplayRecs - 1;
			}
		}
		if ($trx_billing->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($trx_billing->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $trx_billing->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'kode', $trx_billing->Export);
				ew_ExportAddValue($sExportStr, 'grup', $trx_billing->Export);
				ew_ExportAddValue($sExportStr, 'idseqno', $trx_billing->Export);
				ew_ExportAddValue($sExportStr, 'tanggal', $trx_billing->Export);
				ew_ExportAddValue($sExportStr, 'booking', $trx_billing->Export);
				ew_ExportAddValue($sExportStr, 'room', $trx_billing->Export);
				ew_ExportAddValue($sExportStr, 'withppn', $trx_billing->Export);
				ew_ExportAddValue($sExportStr, 'withservice', $trx_billing->Export);
				ew_ExportAddValue($sExportStr, 'rate', $trx_billing->Export);
				ew_ExportAddValue($sExportStr, 'rate2', $trx_billing->Export);
				ew_ExportAddValue($sExportStr, 'chargeextraperson', $trx_billing->Export);
				ew_ExportAddValue($sExportStr, 'restaurant', $trx_billing->Export);
				ew_ExportAddValue($sExportStr, 'additional', $trx_billing->Export);
				ew_ExportAddValue($sExportStr, 'disc', $trx_billing->Export);
				ew_ExportAddValue($sExportStr, 'discname', $trx_billing->Export);
				ew_ExportAddValue($sExportStr, 'dp', $trx_billing->Export);
				ew_ExportAddValue($sExportStr, 'grandtotal', $trx_billing->Export);
				ew_ExportAddValue($sExportStr, 'paymenttype', $trx_billing->Export);
				ew_ExportAddValue($sExportStr, 'paid', $trx_billing->Export);
				echo ew_ExportLine($sExportStr, $trx_billing->Export);
			}
		}

		// Move to first record
		$this->lRecCnt = $this->lStartRec - 1;
		if (!$rs->EOF) {
			$rs->MoveFirst();
			$rs->Move($this->lStartRec - 1);
		}
		while (!$rs->EOF && $this->lRecCnt < $this->lStopRec) {
			$this->lRecCnt++;
			if (intval($this->lRecCnt) >= intval($this->lStartRec)) {
				$this->LoadRowValues($rs);

				// Render row for display
				$trx_billing->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($trx_billing->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('kode', $trx_billing->kode->CurrentValue);
					$XmlDoc->AddField('grup', $trx_billing->grup->CurrentValue);
					$XmlDoc->AddField('idseqno', $trx_billing->idseqno->CurrentValue);
					$XmlDoc->AddField('tanggal', $trx_billing->tanggal->CurrentValue);
					$XmlDoc->AddField('booking', $trx_billing->booking->CurrentValue);
					$XmlDoc->AddField('room', $trx_billing->room->CurrentValue);
					$XmlDoc->AddField('withppn', $trx_billing->withppn->CurrentValue);
					$XmlDoc->AddField('withservice', $trx_billing->withservice->CurrentValue);
					$XmlDoc->AddField('rate', $trx_billing->rate->CurrentValue);
					$XmlDoc->AddField('rate2', $trx_billing->rate2->CurrentValue);
					$XmlDoc->AddField('chargeextraperson', $trx_billing->chargeextraperson->CurrentValue);
					$XmlDoc->AddField('restaurant', $trx_billing->restaurant->CurrentValue);
					$XmlDoc->AddField('additional', $trx_billing->additional->CurrentValue);
					$XmlDoc->AddField('disc', $trx_billing->disc->CurrentValue);
					$XmlDoc->AddField('discname', $trx_billing->discname->CurrentValue);
					$XmlDoc->AddField('dp', $trx_billing->dp->CurrentValue);
					$XmlDoc->AddField('grandtotal', $trx_billing->grandtotal->CurrentValue);
					$XmlDoc->AddField('paymenttype', $trx_billing->paymenttype->CurrentValue);
					$XmlDoc->AddField('paid', $trx_billing->paid->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $trx_billing->Export <> "csv") { // Vertical format
						echo ew_ExportField('kode', $trx_billing->kode->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						echo ew_ExportField('grup', $trx_billing->grup->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						echo ew_ExportField('idseqno', $trx_billing->idseqno->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						echo ew_ExportField('tanggal', $trx_billing->tanggal->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						echo ew_ExportField('booking', $trx_billing->booking->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						echo ew_ExportField('room', $trx_billing->room->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						echo ew_ExportField('withppn', $trx_billing->withppn->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						echo ew_ExportField('withservice', $trx_billing->withservice->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						echo ew_ExportField('rate', $trx_billing->rate->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						echo ew_ExportField('rate2', $trx_billing->rate2->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						echo ew_ExportField('chargeextraperson', $trx_billing->chargeextraperson->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						echo ew_ExportField('restaurant', $trx_billing->restaurant->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						echo ew_ExportField('additional', $trx_billing->additional->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						echo ew_ExportField('disc', $trx_billing->disc->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						echo ew_ExportField('discname', $trx_billing->discname->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						echo ew_ExportField('dp', $trx_billing->dp->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						echo ew_ExportField('grandtotal', $trx_billing->grandtotal->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						echo ew_ExportField('paymenttype', $trx_billing->paymenttype->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						echo ew_ExportField('paid', $trx_billing->paid->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $trx_billing->kode->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						ew_ExportAddValue($sExportStr, $trx_billing->grup->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						ew_ExportAddValue($sExportStr, $trx_billing->idseqno->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						ew_ExportAddValue($sExportStr, $trx_billing->tanggal->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						ew_ExportAddValue($sExportStr, $trx_billing->booking->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						ew_ExportAddValue($sExportStr, $trx_billing->room->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						ew_ExportAddValue($sExportStr, $trx_billing->withppn->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						ew_ExportAddValue($sExportStr, $trx_billing->withservice->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						ew_ExportAddValue($sExportStr, $trx_billing->rate->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						ew_ExportAddValue($sExportStr, $trx_billing->rate2->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						ew_ExportAddValue($sExportStr, $trx_billing->chargeextraperson->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						ew_ExportAddValue($sExportStr, $trx_billing->restaurant->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						ew_ExportAddValue($sExportStr, $trx_billing->additional->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						ew_ExportAddValue($sExportStr, $trx_billing->disc->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						ew_ExportAddValue($sExportStr, $trx_billing->discname->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						ew_ExportAddValue($sExportStr, $trx_billing->dp->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						ew_ExportAddValue($sExportStr, $trx_billing->grandtotal->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						ew_ExportAddValue($sExportStr, $trx_billing->paymenttype->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						ew_ExportAddValue($sExportStr, $trx_billing->paid->ExportValue($trx_billing->Export, $trx_billing->ExportOriginalValue), $trx_billing->Export);
						echo ew_ExportLine($sExportStr, $trx_billing->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($trx_billing->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($trx_billing->Export);
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'trx_billing';

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
