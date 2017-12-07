<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "inqueueinfo.php" ?>
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
$inqueue_list = new cinqueue_list();
$Page =& $inqueue_list;

// Page init processing
$inqueue_list->Page_Init();

// Page main processing
$inqueue_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($inqueue->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var inqueue_list = new ew_Page("inqueue_list");

// page properties
inqueue_list.PageID = "list"; // page ID
var EW_PAGE_ID = inqueue_list.PageID; // for backward compatibility

// extend page with ValidateForm function
inqueue_list.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_modem_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "Incorrect integer - Modem Id");
		elm = fobj.elements["x" + infix + "_qtime"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Qtime");
		elm = fobj.elements["x" + infix + "_exectime"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Exectime");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with validate function for search
inqueue_list.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_modem_id"];
	if (elm && !ew_CheckInteger(elm.value))
		return ew_OnError(this, elm, "Incorrect integer - Modem Id");
	elm = fobj.elements["x" + infix + "_qtime"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Qtime");
	elm = fobj.elements["x" + infix + "_exectime"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Exectime");

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
inqueue_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
inqueue_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
inqueue_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($inqueue->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($inqueue->Export == "" && $inqueue->SelectLimit);
	if (!$bSelectLimit)
		$rs = $inqueue_list->LoadRecordset();
	$inqueue_list->lTotalRecs = ($bSelectLimit) ? $inqueue->SelectRecordCount() : $rs->RecordCount();
	$inqueue_list->lStartRec = 1;
	if ($inqueue_list->lDisplayRecs <= 0) // Display all records
		$inqueue_list->lDisplayRecs = $inqueue_list->lTotalRecs;
	if (!($inqueue->ExportAll && $inqueue->Export <> ""))
		$inqueue_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $inqueue_list->LoadRecordset($inqueue_list->lStartRec-1, $inqueue_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Antrian SMS Masuk</b></h3>
<?php if ($inqueue->Export == "" && $inqueue->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $inqueue_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php if ($inqueue->Export == "" && $inqueue->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(inqueue_list);" style="text-decoration: none;"><img id="inqueue_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="inqueue_list_SearchPanel">
<form name="finqueuelistsrch" id="finqueuelistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return inqueue_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="inqueue">
<?php
if ($gsSearchError == "")
	$inqueue_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$inqueue->RowType = EW_ROWTYPE_SEARCH;

// Render row
$inqueue_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Modem Id</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_modem_id" id="z_modem_id" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_modem_id" id="x_modem_id" size="3" value="<?php echo $inqueue->modem_id->EditValue ?>"<?php echo $inqueue->modem_id->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Destination</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_destmsisdn" id="z_destmsisdn" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_destmsisdn" id="x_destmsisdn" size="20" maxlength="20" value="<?php echo $inqueue->destmsisdn->EditValue ?>"<?php echo $inqueue->destmsisdn->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Msisdn</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_msisdn" id="z_msisdn" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_msisdn" id="x_msisdn" size="20" maxlength="20" value="<?php echo $inqueue->msisdn->EditValue ?>"<?php echo $inqueue->msisdn->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Qtime</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_qtime" id="z_qtime" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_qtime" id="x_qtime" value="<?php echo $inqueue->qtime->EditValue ?>"<?php echo $inqueue->qtime->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_qtime" name="cal_x_qtime" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_qtime", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_qtime" // ID of the button
});
</script>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Exectime</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_exectime" id="z_exectime" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_exectime" id="x_exectime" value="<?php echo $inqueue->exectime->EditValue ?>"<?php echo $inqueue->exectime->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_exectime" name="cal_x_exectime" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_exectime", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_exectime" // ID of the button
});
</script>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Message</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_message" id="z_message" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_message" id="x_message" size="160" maxlength="160" value="<?php echo $inqueue->message->EditValue ?>"<?php echo $inqueue->message->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Status</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_status" id="z_status" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_status" name="x_status"<?php echo $inqueue->status->EditAttributes() ?>>
<?php
if (is_array($inqueue->status->EditValue)) {
	$arwrk = $inqueue->status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($inqueue->status->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<!--a href="<?php echo $inqueue_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $inqueue_list->PageUrl() ?>cmd=reset';">
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $inqueue_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($inqueue->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($inqueue->CurrentAction <> "gridadd" && $inqueue->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($inqueue_list->Pager)) $inqueue_list->Pager = new cPrevNextPager($inqueue_list->lStartRec, $inqueue_list->lDisplayRecs, $inqueue_list->lTotalRecs) ?>
<?php if ($inqueue_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($inqueue_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $inqueue_list->PageUrl() ?>start=<?php echo $inqueue_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($inqueue_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $inqueue_list->PageUrl() ?>start=<?php echo $inqueue_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $inqueue_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($inqueue_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $inqueue_list->PageUrl() ?>start=<?php echo $inqueue_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($inqueue_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $inqueue_list->PageUrl() ?>start=<?php echo $inqueue_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $inqueue_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $inqueue_list->Pager->FromIndex ?> to <?php echo $inqueue_list->Pager->ToIndex ?> of <?php echo $inqueue_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($inqueue_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($inqueue_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="inqueue">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($inqueue_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($inqueue_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($inqueue_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($inqueue_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($inqueue_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($inqueue_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $inqueue_list->PageUrl() ?>a=add"><img src="images/expand.gif" title="Add" width="16" height="16" border="0"></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="finqueuelist" id="finqueuelist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="inqueue">
<?php if ($inqueue_list->lTotalRecs > 0 || $inqueue->CurrentAction == "add" || $inqueue->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$inqueue_list->lOptionCnt = 0;
	$inqueue_list->lOptionCnt++; // edit
	$inqueue_list->lOptionCnt++; // Delete
	$inqueue_list->lOptionCnt += count($inqueue_list->ListOptions->Items); // Custom list options
?>
<?php echo $inqueue->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($inqueue->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php if ($inqueue_list->lOptionCnt == 0 && $inqueue->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($inqueue_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($inqueue->id->Visible) { // id ?>
	<?php if ($inqueue->SortUrl($inqueue->id) == "") { ?>
		<td style="white-space: nowrap;">Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $inqueue->SortUrl($inqueue->id) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id</td><td style="width: 10px;"><?php if ($inqueue->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($inqueue->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($inqueue->modem_id->Visible) { // modem_id ?>
	<?php if ($inqueue->SortUrl($inqueue->modem_id) == "") { ?>
		<td style="white-space: nowrap;">Modem Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $inqueue->SortUrl($inqueue->modem_id) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Modem Id</td><td style="width: 10px;"><?php if ($inqueue->modem_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($inqueue->modem_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($inqueue->destmsisdn->Visible) { // destmsisdn ?>
	<?php if ($inqueue->SortUrl($inqueue->destmsisdn) == "") { ?>
		<td style="white-space: nowrap;">Destination</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $inqueue->SortUrl($inqueue->destmsisdn) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Destination</td><td style="width: 10px;"><?php if ($inqueue->destmsisdn->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($inqueue->destmsisdn->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($inqueue->msisdn->Visible) { // msisdn ?>
	<?php if ($inqueue->SortUrl($inqueue->msisdn) == "") { ?>
		<td style="white-space: nowrap;">Msisdn</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $inqueue->SortUrl($inqueue->msisdn) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Msisdn</td><td style="width: 10px;"><?php if ($inqueue->msisdn->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($inqueue->msisdn->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($inqueue->qtime->Visible) { // qtime ?>
	<?php if ($inqueue->SortUrl($inqueue->qtime) == "") { ?>
		<td style="white-space: nowrap;">Qtime</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $inqueue->SortUrl($inqueue->qtime) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Qtime</td><td style="width: 10px;"><?php if ($inqueue->qtime->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($inqueue->qtime->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($inqueue->exectime->Visible) { // exectime ?>
	<?php if ($inqueue->SortUrl($inqueue->exectime) == "") { ?>
		<td style="white-space: nowrap;">Exectime</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $inqueue->SortUrl($inqueue->exectime) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Exectime</td><td style="width: 10px;"><?php if ($inqueue->exectime->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($inqueue->exectime->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($inqueue->message->Visible) { // message ?>
	<?php if ($inqueue->SortUrl($inqueue->message) == "") { ?>
		<td>Message</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $inqueue->SortUrl($inqueue->message) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Message</td><td style="width: 10px;"><?php if ($inqueue->message->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($inqueue->message->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($inqueue->status->Visible) { // status ?>
	<?php if ($inqueue->SortUrl($inqueue->status) == "") { ?>
		<td style="white-space: nowrap;">Status</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $inqueue->SortUrl($inqueue->status) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Status</td><td style="width: 10px;"><?php if ($inqueue->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($inqueue->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
	if ($inqueue->CurrentAction == "add" || $inqueue->CurrentAction == "copy") {
		$inqueue_list->lRowIndex = 1;
		if ($inqueue->CurrentAction == "add")
			$inqueue_list->LoadDefaultValues();
		if ($inqueue->EventCancelled) // Insert failed
			$inqueue_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$inqueue->CssClass = "ewTableEditRow";
		$inqueue->CssStyle = "";
		$inqueue->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
		$inqueue->RowType = EW_ROWTYPE_ADD;

		// Render row
		$inqueue_list->RenderRow();
?>
	<tr<?php echo $inqueue->RowAttributes() ?>>
<td colspan="<?php echo $inqueue_list->lOptionCnt ?>" align="right"><span class="phpmaker">
<a href="" onclick="if (inqueue_list.ValidateForm(document.finqueuelist)) document.finqueuelist.submit();return false;"><img src="images/save.gif" title="Insert" width="16" height="16" border="0"></a>&nbsp;<a href="<?php echo $inqueue_list->PageUrl() ?>a=cancel"><img src="images/b_drop.png" title="Cancel" width="16" height="16" border="0"></a>
<input type="hidden" name="a_list" id="a_list" value="insert">
</span></td>
	<?php if ($inqueue->id->Visible) { // id ?>
		<td style="white-space: nowrap;">&nbsp;</td>
	<?php } ?>
	<?php if ($inqueue->modem_id->Visible) { // modem_id ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $inqueue_list->lRowIndex ?>_modem_id" id="x<?php echo $inqueue_list->lRowIndex ?>_modem_id" size="3" value="<?php echo $inqueue->modem_id->EditValue ?>"<?php echo $inqueue->modem_id->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($inqueue->destmsisdn->Visible) { // destmsisdn ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $inqueue_list->lRowIndex ?>_destmsisdn" id="x<?php echo $inqueue_list->lRowIndex ?>_destmsisdn" size="20" maxlength="20" value="<?php echo $inqueue->destmsisdn->EditValue ?>"<?php echo $inqueue->destmsisdn->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($inqueue->msisdn->Visible) { // msisdn ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $inqueue_list->lRowIndex ?>_msisdn" id="x<?php echo $inqueue_list->lRowIndex ?>_msisdn" size="20" maxlength="20" value="<?php echo $inqueue->msisdn->EditValue ?>"<?php echo $inqueue->msisdn->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($inqueue->qtime->Visible) { // qtime ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $inqueue_list->lRowIndex ?>_qtime" id="x<?php echo $inqueue_list->lRowIndex ?>_qtime" value="<?php echo $inqueue->qtime->EditValue ?>"<?php echo $inqueue->qtime->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x<?php echo $inqueue_list->lRowIndex ?>_qtime" name="cal_x<?php echo $inqueue_list->lRowIndex ?>_qtime" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x<?php echo $inqueue_list->lRowIndex ?>_qtime", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x<?php echo $inqueue_list->lRowIndex ?>_qtime" // ID of the button
});
</script>
</td>
	<?php } ?>
	<?php if ($inqueue->exectime->Visible) { // exectime ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $inqueue_list->lRowIndex ?>_exectime" id="x<?php echo $inqueue_list->lRowIndex ?>_exectime" value="<?php echo $inqueue->exectime->EditValue ?>"<?php echo $inqueue->exectime->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x<?php echo $inqueue_list->lRowIndex ?>_exectime" name="cal_x<?php echo $inqueue_list->lRowIndex ?>_exectime" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x<?php echo $inqueue_list->lRowIndex ?>_exectime", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x<?php echo $inqueue_list->lRowIndex ?>_exectime" // ID of the button
});
</script>
</td>
	<?php } ?>
	<?php if ($inqueue->message->Visible) { // message ?>
		<td>
<input type="text" name="x<?php echo $inqueue_list->lRowIndex ?>_message" id="x<?php echo $inqueue_list->lRowIndex ?>_message" size="160" maxlength="160" value="<?php echo $inqueue->message->EditValue ?>"<?php echo $inqueue->message->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($inqueue->status->Visible) { // status ?>
		<td style="white-space: nowrap;">
<select id="x<?php echo $inqueue_list->lRowIndex ?>_status" name="x<?php echo $inqueue_list->lRowIndex ?>_status"<?php echo $inqueue->status->EditAttributes() ?>>
<?php
if (is_array($inqueue->status->EditValue)) {
	$arwrk = $inqueue->status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($inqueue->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</td>
	<?php } ?>
	</tr>
<?php
}
?>
<?php
if ($inqueue->ExportAll && $inqueue->Export <> "") {
	$inqueue_list->lStopRec = $inqueue_list->lTotalRecs;
} else {
	$inqueue_list->lStopRec = $inqueue_list->lStartRec + $inqueue_list->lDisplayRecs - 1; // Set the last record to display
}
$inqueue_list->lRecCount = $inqueue_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$inqueue->SelectLimit && $inqueue_list->lStartRec > 1)
		$rs->Move($inqueue_list->lStartRec - 1);
}
$inqueue_list->lRowCnt = 0;
$inqueue_list->lEditRowCnt = 0;
if ($inqueue->CurrentAction == "edit")
	$inqueue_list->lRowIndex = 1;
while (($inqueue->CurrentAction == "gridadd" || !$rs->EOF) &&
	$inqueue_list->lRecCount < $inqueue_list->lStopRec) {
	$inqueue_list->lRecCount++;
	if (intval($inqueue_list->lRecCount) >= intval($inqueue_list->lStartRec)) {
		$inqueue_list->lRowCnt++;

	// Init row class and style
	$inqueue->CssClass = "";
	$inqueue->CssStyle = "";
	$inqueue->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($inqueue->CurrentAction == "gridadd") {
		$inqueue_list->LoadDefaultValues(); // Load default values
	} else {
		$inqueue_list->LoadRowValues($rs); // Load row values
	}
	$inqueue->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($inqueue->CurrentAction == "edit") {
		if ($inqueue_list->CheckInlineEditKey() && $inqueue_list->lEditRowCnt == 0) // Inline edit
			$inqueue->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($inqueue->RowType == EW_ROWTYPE_EDIT && $inqueue->EventCancelled) { // Update failed
		if ($inqueue->CurrentAction == "edit")
			$inqueue_list->RestoreFormValues(); // Restore form values
	}
	if ($inqueue->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$inqueue_list->lEditRowCnt++;
		$inqueue->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($inqueue->RowType == EW_ROWTYPE_ADD || $inqueue->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$inqueue->CssClass = "ewTableEditRow";

	// Render row
	$inqueue_list->RenderRow();
?>
	<tr<?php echo $inqueue->RowAttributes() ?>>
<?php if ($inqueue->RowType == EW_ROWTYPE_ADD || $inqueue->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($inqueue->CurrentAction == "edit") { ?>
<td colspan="<?php echo $inqueue_list->lOptionCnt ?>" align="right"><span class="phpmaker">
<a href="" onclick="if (inqueue_list.ValidateForm(document.finqueuelist)) document.finqueuelist.submit();return false;"><img src="images/save.gif" title="Update" width="16" height="16" border="0"></a>&nbsp;<a href="<?php echo $inqueue_list->PageUrl() ?>a=cancel"><img src="images/b_drop.png" title="Cancel" width="16" height="16" border="0"></a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php } else { ?>
<?php if ($inqueue->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $inqueue->InlineEditUrl() ?>"><img src="images/inlineedit.gif" title="Inline Edit" width="16" height="16" border="0"></a>
</span></td>
<?php if ($inqueue_list->lOptionCnt == 0 && $inqueue->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $inqueue->DeleteUrl() ?>"><img src="images/b_drop.png" title="Delete" width="16" height="16" border="0"></a>
</span></td>
<?php

// Custom list options
foreach ($inqueue_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	<?php if ($inqueue->id->Visible) { // id ?>
		<td<?php echo $inqueue->id->CellAttributes() ?>>
<?php if ($inqueue->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $inqueue->id->ViewAttributes() ?>><?php echo $inqueue->id->EditValue ?></div><input type="hidden" name="x<?php echo $inqueue_list->lRowIndex ?>_id" id="x<?php echo $inqueue_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($inqueue->id->CurrentValue) ?>">
<?php } ?>
<?php if ($inqueue->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $inqueue->id->ViewAttributes() ?>><?php echo $inqueue->id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($inqueue->modem_id->Visible) { // modem_id ?>
		<td<?php echo $inqueue->modem_id->CellAttributes() ?>>
<?php if ($inqueue->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $inqueue_list->lRowIndex ?>_modem_id" id="x<?php echo $inqueue_list->lRowIndex ?>_modem_id" size="3" value="<?php echo $inqueue->modem_id->EditValue ?>"<?php echo $inqueue->modem_id->EditAttributes() ?>>
<?php } ?>
<?php if ($inqueue->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $inqueue->modem_id->ViewAttributes() ?>><?php echo $inqueue->modem_id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($inqueue->destmsisdn->Visible) { // destmsisdn ?>
		<td<?php echo $inqueue->destmsisdn->CellAttributes() ?>>
<?php if ($inqueue->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $inqueue_list->lRowIndex ?>_destmsisdn" id="x<?php echo $inqueue_list->lRowIndex ?>_destmsisdn" size="20" maxlength="20" value="<?php echo $inqueue->destmsisdn->EditValue ?>"<?php echo $inqueue->destmsisdn->EditAttributes() ?>>
<?php } ?>
<?php if ($inqueue->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $inqueue->destmsisdn->ViewAttributes() ?>><?php echo $inqueue->destmsisdn->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($inqueue->msisdn->Visible) { // msisdn ?>
		<td<?php echo $inqueue->msisdn->CellAttributes() ?>>
<?php if ($inqueue->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $inqueue_list->lRowIndex ?>_msisdn" id="x<?php echo $inqueue_list->lRowIndex ?>_msisdn" size="20" maxlength="20" value="<?php echo $inqueue->msisdn->EditValue ?>"<?php echo $inqueue->msisdn->EditAttributes() ?>>
<?php } ?>
<?php if ($inqueue->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $inqueue->msisdn->ViewAttributes() ?>><?php echo $inqueue->msisdn->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($inqueue->qtime->Visible) { // qtime ?>
		<td<?php echo $inqueue->qtime->CellAttributes() ?>>
<?php if ($inqueue->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $inqueue_list->lRowIndex ?>_qtime" id="x<?php echo $inqueue_list->lRowIndex ?>_qtime" value="<?php echo $inqueue->qtime->EditValue ?>"<?php echo $inqueue->qtime->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x<?php echo $inqueue_list->lRowIndex ?>_qtime" name="cal_x<?php echo $inqueue_list->lRowIndex ?>_qtime" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x<?php echo $inqueue_list->lRowIndex ?>_qtime", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x<?php echo $inqueue_list->lRowIndex ?>_qtime" // ID of the button
});
</script>
<?php } ?>
<?php if ($inqueue->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $inqueue->qtime->ViewAttributes() ?>><?php echo $inqueue->qtime->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($inqueue->exectime->Visible) { // exectime ?>
		<td<?php echo $inqueue->exectime->CellAttributes() ?>>
<?php if ($inqueue->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $inqueue_list->lRowIndex ?>_exectime" id="x<?php echo $inqueue_list->lRowIndex ?>_exectime" value="<?php echo $inqueue->exectime->EditValue ?>"<?php echo $inqueue->exectime->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x<?php echo $inqueue_list->lRowIndex ?>_exectime" name="cal_x<?php echo $inqueue_list->lRowIndex ?>_exectime" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x<?php echo $inqueue_list->lRowIndex ?>_exectime", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x<?php echo $inqueue_list->lRowIndex ?>_exectime" // ID of the button
});
</script>
<?php } ?>
<?php if ($inqueue->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $inqueue->exectime->ViewAttributes() ?>><?php echo $inqueue->exectime->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($inqueue->message->Visible) { // message ?>
		<td<?php echo $inqueue->message->CellAttributes() ?>>
<?php if ($inqueue->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $inqueue_list->lRowIndex ?>_message" id="x<?php echo $inqueue_list->lRowIndex ?>_message" size="160" maxlength="160" value="<?php echo $inqueue->message->EditValue ?>"<?php echo $inqueue->message->EditAttributes() ?>>
<?php } ?>
<?php if ($inqueue->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $inqueue->message->ViewAttributes() ?>><?php echo $inqueue->message->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($inqueue->status->Visible) { // status ?>
		<td<?php echo $inqueue->status->CellAttributes() ?>>
<?php if ($inqueue->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $inqueue_list->lRowIndex ?>_status" name="x<?php echo $inqueue_list->lRowIndex ?>_status"<?php echo $inqueue->status->EditAttributes() ?>>
<?php
if (is_array($inqueue->status->EditValue)) {
	$arwrk = $inqueue->status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($inqueue->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php if ($inqueue->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $inqueue->status->ViewAttributes() ?>><?php echo $inqueue->status->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	</tr>
<?php if ($inqueue->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($inqueue->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($inqueue->CurrentAction == "add" || $inqueue->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $inqueue_list->lRowIndex ?>">
<?php } ?>
<?php if ($inqueue->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $inqueue_list->lRowIndex ?>">
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
</td></tr></table>
<?php if ($inqueue->Export == "" && $inqueue->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(inqueue_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($inqueue->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$inqueue_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cinqueue_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'inqueue';

	// Page Object Name
	var $PageObjName = 'inqueue_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $inqueue;
		if ($inqueue->UseTokenInUrl) $PageUrl .= "t=" . $inqueue->TableVar . "&"; // add page token
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
		global $objForm, $inqueue;
		if ($inqueue->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($inqueue->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($inqueue->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cinqueue_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["inqueue"] = new cinqueue();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'inqueue', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $inqueue;
	$inqueue->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $inqueue->Export; // Get export parameter, used in header
	$gsExportFile = $inqueue->TableVar; // Get export file, used in header
	if ($inqueue->Export == "print" || $inqueue->Export == "html") {

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
		global $objForm, $gsSearchError, $Security, $inqueue;
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

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$inqueue->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($inqueue->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline edit mode
				if ($inqueue->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($inqueue->CurrentAction == "add" || $inqueue->CurrentAction == "copy")
					$this->InlineAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$inqueue->CurrentAction = $_POST["a_list"]; // Get action

					// Inline Update
					if ($inqueue->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($inqueue->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();
				}
			}

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
		if ($inqueue->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $inqueue->getRecordsPerPage(); // Restore from Session
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
		$inqueue->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$inqueue->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$inqueue->setStartRecordNumber($this->lStartRec);
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
		$inqueue->setSessionWhere($sFilter);
		$inqueue->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $inqueue;
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
			$inqueue->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$inqueue->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $inqueue;
		$inqueue->setKey("id", ""); // Clear inline edit key
		$inqueue->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Edit Mode
	function InlineEditMode() {
		global $Security, $inqueue;
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$inqueue->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$inqueue->setKey("id", $inqueue->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $inqueue;
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
				$inqueue->SendEmail = TRUE; // Send email on update success
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
			$inqueue->EventCancelled = TRUE; // Cancel event
			$inqueue->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $inqueue;

		//CheckInlineEditKey = True
		if (strval($inqueue->getKey("id")) <> strval($inqueue->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add Mode
	function InlineAddMode() {
		global $Security, $inqueue;
		$inqueue->CurrentAction = "add";
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to inline add/copy record
	function InlineInsert() {
		global $objForm, $gsFormError, $inqueue;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate Form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$inqueue->EventCancelled = TRUE; // Set event cancelled
			$inqueue->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$inqueue->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage("Add succeeded"); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$inqueue->EventCancelled = TRUE; // Set event cancelled
			$inqueue->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $inqueue;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $inqueue->id, FALSE); // Field id
		$this->BuildSearchSql($sWhere, $inqueue->modem_id, FALSE); // Field modem_id
		$this->BuildSearchSql($sWhere, $inqueue->destmsisdn, FALSE); // Field destmsisdn
		$this->BuildSearchSql($sWhere, $inqueue->msisdn, FALSE); // Field msisdn
		$this->BuildSearchSql($sWhere, $inqueue->qtime, FALSE); // Field qtime
		$this->BuildSearchSql($sWhere, $inqueue->exectime, FALSE); // Field exectime
		$this->BuildSearchSql($sWhere, $inqueue->message, FALSE); // Field message
		$this->BuildSearchSql($sWhere, $inqueue->status, FALSE); // Field status

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($inqueue->id); // Field id
			$this->SetSearchParm($inqueue->modem_id); // Field modem_id
			$this->SetSearchParm($inqueue->destmsisdn); // Field destmsisdn
			$this->SetSearchParm($inqueue->msisdn); // Field msisdn
			$this->SetSearchParm($inqueue->qtime); // Field qtime
			$this->SetSearchParm($inqueue->exectime); // Field exectime
			$this->SetSearchParm($inqueue->message); // Field message
			$this->SetSearchParm($inqueue->status); // Field status
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
		global $inqueue;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$inqueue->setAdvancedSearch("x_$FldParm", $FldVal);
		$inqueue->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$inqueue->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$inqueue->setAdvancedSearch("y_$FldParm", $FldVal2);
		$inqueue->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $inqueue;
		$this->sSrchWhere = "";
		$inqueue->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $inqueue;
		$inqueue->setAdvancedSearch("x_id", "");
		$inqueue->setAdvancedSearch("x_modem_id", "");
		$inqueue->setAdvancedSearch("x_destmsisdn", "");
		$inqueue->setAdvancedSearch("x_msisdn", "");
		$inqueue->setAdvancedSearch("x_qtime", "");
		$inqueue->setAdvancedSearch("x_exectime", "");
		$inqueue->setAdvancedSearch("x_message", "");
		$inqueue->setAdvancedSearch("x_status", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $inqueue;
		$this->sSrchWhere = $inqueue->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $inqueue;
		 $inqueue->id->AdvancedSearch->SearchValue = $inqueue->getAdvancedSearch("x_id");
		 $inqueue->modem_id->AdvancedSearch->SearchValue = $inqueue->getAdvancedSearch("x_modem_id");
		 $inqueue->destmsisdn->AdvancedSearch->SearchValue = $inqueue->getAdvancedSearch("x_destmsisdn");
		 $inqueue->msisdn->AdvancedSearch->SearchValue = $inqueue->getAdvancedSearch("x_msisdn");
		 $inqueue->qtime->AdvancedSearch->SearchValue = $inqueue->getAdvancedSearch("x_qtime");
		 $inqueue->exectime->AdvancedSearch->SearchValue = $inqueue->getAdvancedSearch("x_exectime");
		 $inqueue->message->AdvancedSearch->SearchValue = $inqueue->getAdvancedSearch("x_message");
		 $inqueue->status->AdvancedSearch->SearchValue = $inqueue->getAdvancedSearch("x_status");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $inqueue;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$inqueue->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$inqueue->CurrentOrderType = @$_GET["ordertype"];
			$inqueue->UpdateSort($inqueue->id); // Field 
			$inqueue->UpdateSort($inqueue->modem_id); // Field 
			$inqueue->UpdateSort($inqueue->destmsisdn); // Field 
			$inqueue->UpdateSort($inqueue->msisdn); // Field 
			$inqueue->UpdateSort($inqueue->qtime); // Field 
			$inqueue->UpdateSort($inqueue->exectime); // Field 
			$inqueue->UpdateSort($inqueue->message); // Field 
			$inqueue->UpdateSort($inqueue->status); // Field 
			$inqueue->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $inqueue;
		$sOrderBy = $inqueue->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($inqueue->SqlOrderBy() <> "") {
				$sOrderBy = $inqueue->SqlOrderBy();
				$inqueue->setSessionOrderBy($sOrderBy);
				$inqueue->qtime->setSort("DESC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $inqueue;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$inqueue->setSessionOrderBy($sOrderBy);
				$inqueue->id->setSort("");
				$inqueue->modem_id->setSort("");
				$inqueue->destmsisdn->setSort("");
				$inqueue->msisdn->setSort("");
				$inqueue->qtime->setSort("");
				$inqueue->exectime->setSort("");
				$inqueue->message->setSort("");
				$inqueue->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$inqueue->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $inqueue;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$inqueue->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$inqueue->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $inqueue->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$inqueue->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$inqueue->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$inqueue->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $inqueue;
		$inqueue->status->CurrentValue = 0;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $inqueue;

		// Load search values
		// id

		$inqueue->id->AdvancedSearch->SearchValue = @$_GET["x_id"];
		$inqueue->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// modem_id
		$inqueue->modem_id->AdvancedSearch->SearchValue = @$_GET["x_modem_id"];
		$inqueue->modem_id->AdvancedSearch->SearchOperator = @$_GET["z_modem_id"];

		// destmsisdn
		$inqueue->destmsisdn->AdvancedSearch->SearchValue = @$_GET["x_destmsisdn"];
		$inqueue->destmsisdn->AdvancedSearch->SearchOperator = @$_GET["z_destmsisdn"];

		// msisdn
		$inqueue->msisdn->AdvancedSearch->SearchValue = @$_GET["x_msisdn"];
		$inqueue->msisdn->AdvancedSearch->SearchOperator = @$_GET["z_msisdn"];

		// qtime
		$inqueue->qtime->AdvancedSearch->SearchValue = @$_GET["x_qtime"];
		$inqueue->qtime->AdvancedSearch->SearchOperator = @$_GET["z_qtime"];

		// exectime
		$inqueue->exectime->AdvancedSearch->SearchValue = @$_GET["x_exectime"];
		$inqueue->exectime->AdvancedSearch->SearchOperator = @$_GET["z_exectime"];

		// message
		$inqueue->message->AdvancedSearch->SearchValue = @$_GET["x_message"];
		$inqueue->message->AdvancedSearch->SearchOperator = @$_GET["z_message"];

		// status
		$inqueue->status->AdvancedSearch->SearchValue = @$_GET["x_status"];
		$inqueue->status->AdvancedSearch->SearchOperator = @$_GET["z_status"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $inqueue;
		$inqueue->id->setFormValue($objForm->GetValue("x_id"));
		$inqueue->modem_id->setFormValue($objForm->GetValue("x_modem_id"));
		$inqueue->destmsisdn->setFormValue($objForm->GetValue("x_destmsisdn"));
		$inqueue->msisdn->setFormValue($objForm->GetValue("x_msisdn"));
		$inqueue->qtime->setFormValue($objForm->GetValue("x_qtime"));
		$inqueue->qtime->CurrentValue = ew_UnFormatDateTime($inqueue->qtime->CurrentValue, 7);
		$inqueue->exectime->setFormValue($objForm->GetValue("x_exectime"));
		$inqueue->exectime->CurrentValue = ew_UnFormatDateTime($inqueue->exectime->CurrentValue, 7);
		$inqueue->message->setFormValue($objForm->GetValue("x_message"));
		$inqueue->status->setFormValue($objForm->GetValue("x_status"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $inqueue;
		$inqueue->id->CurrentValue = $inqueue->id->FormValue;
		$inqueue->modem_id->CurrentValue = $inqueue->modem_id->FormValue;
		$inqueue->destmsisdn->CurrentValue = $inqueue->destmsisdn->FormValue;
		$inqueue->msisdn->CurrentValue = $inqueue->msisdn->FormValue;
		$inqueue->qtime->CurrentValue = $inqueue->qtime->FormValue;
		$inqueue->qtime->CurrentValue = ew_UnFormatDateTime($inqueue->qtime->CurrentValue, 7);
		$inqueue->exectime->CurrentValue = $inqueue->exectime->FormValue;
		$inqueue->exectime->CurrentValue = ew_UnFormatDateTime($inqueue->exectime->CurrentValue, 7);
		$inqueue->message->CurrentValue = $inqueue->message->FormValue;
		$inqueue->status->CurrentValue = $inqueue->status->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $inqueue;

		// Call Recordset Selecting event
		$inqueue->Recordset_Selecting($inqueue->CurrentFilter);

		// Load list page SQL
		$sSql = $inqueue->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$inqueue->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $inqueue;
		$sFilter = $inqueue->KeyFilter();

		// Call Row Selecting event
		$inqueue->Row_Selecting($sFilter);

		// Load sql based on filter
		$inqueue->CurrentFilter = $sFilter;
		$sSql = $inqueue->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$inqueue->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $inqueue;
		$inqueue->id->setDbValue($rs->fields('id'));
		$inqueue->modem_id->setDbValue($rs->fields('modem_id'));
		$inqueue->destmsisdn->setDbValue($rs->fields('destmsisdn'));
		$inqueue->msisdn->setDbValue($rs->fields('msisdn'));
		$inqueue->qtime->setDbValue($rs->fields('qtime'));
		$inqueue->exectime->setDbValue($rs->fields('exectime'));
		$inqueue->message->setDbValue($rs->fields('message'));
		$inqueue->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $inqueue;

		// Call Row_Rendering event
		$inqueue->Row_Rendering();

		// Common render codes for all row types
		// id

		$inqueue->id->CellCssStyle = "white-space: nowrap;";
		$inqueue->id->CellCssClass = "";

		// modem_id
		$inqueue->modem_id->CellCssStyle = "white-space: nowrap;";
		$inqueue->modem_id->CellCssClass = "";

		// destmsisdn
		$inqueue->destmsisdn->CellCssStyle = "white-space: nowrap;";
		$inqueue->destmsisdn->CellCssClass = "";

		// msisdn
		$inqueue->msisdn->CellCssStyle = "white-space: nowrap;";
		$inqueue->msisdn->CellCssClass = "";

		// qtime
		$inqueue->qtime->CellCssStyle = "white-space: nowrap;";
		$inqueue->qtime->CellCssClass = "";

		// exectime
		$inqueue->exectime->CellCssStyle = "white-space: nowrap;";
		$inqueue->exectime->CellCssClass = "";

		// message
		$inqueue->message->CellCssStyle = "";
		$inqueue->message->CellCssClass = "";

		// status
		$inqueue->status->CellCssStyle = "white-space: nowrap;";
		$inqueue->status->CellCssClass = "";
		if ($inqueue->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$inqueue->id->ViewValue = $inqueue->id->CurrentValue;
			$inqueue->id->CssStyle = "";
			$inqueue->id->CssClass = "";
			$inqueue->id->ViewCustomAttributes = "";

			// modem_id
			$inqueue->modem_id->ViewValue = $inqueue->modem_id->CurrentValue;
			$inqueue->modem_id->CssStyle = "";
			$inqueue->modem_id->CssClass = "";
			$inqueue->modem_id->ViewCustomAttributes = "";

			// destmsisdn
			$inqueue->destmsisdn->ViewValue = $inqueue->destmsisdn->CurrentValue;
			$inqueue->destmsisdn->CssStyle = "";
			$inqueue->destmsisdn->CssClass = "";
			$inqueue->destmsisdn->ViewCustomAttributes = "";

			// msisdn
			$inqueue->msisdn->ViewValue = $inqueue->msisdn->CurrentValue;
			$inqueue->msisdn->CssStyle = "";
			$inqueue->msisdn->CssClass = "";
			$inqueue->msisdn->ViewCustomAttributes = "";

			// qtime
			$inqueue->qtime->ViewValue = $inqueue->qtime->CurrentValue;
			$inqueue->qtime->ViewValue = ew_FormatDateTime($inqueue->qtime->ViewValue, 7);
			$inqueue->qtime->CssStyle = "";
			$inqueue->qtime->CssClass = "";
			$inqueue->qtime->ViewCustomAttributes = "";

			// exectime
			$inqueue->exectime->ViewValue = $inqueue->exectime->CurrentValue;
			$inqueue->exectime->ViewValue = ew_FormatDateTime($inqueue->exectime->ViewValue, 7);
			$inqueue->exectime->CssStyle = "";
			$inqueue->exectime->CssClass = "";
			$inqueue->exectime->ViewCustomAttributes = "";

			// message
			$inqueue->message->ViewValue = $inqueue->message->CurrentValue;
			$inqueue->message->CssStyle = "";
			$inqueue->message->CssClass = "";
			$inqueue->message->ViewCustomAttributes = "";

			// status
			if (strval($inqueue->status->CurrentValue) <> "") {
				switch ($inqueue->status->CurrentValue) {
					case "0":
						$inqueue->status->ViewValue = "Belum";
						break;
					case "1":
						$inqueue->status->ViewValue = "Sukses";
						break;
					case "2":
						$inqueue->status->ViewValue = "Gagal";
						break;
					default:
						$inqueue->status->ViewValue = $inqueue->status->CurrentValue;
				}
			} else {
				$inqueue->status->ViewValue = NULL;
			}
			$inqueue->status->CssStyle = "";
			$inqueue->status->CssClass = "";
			$inqueue->status->ViewCustomAttributes = "";

			// id
			$inqueue->id->HrefValue = "";

			// modem_id
			$inqueue->modem_id->HrefValue = "";

			// destmsisdn
			$inqueue->destmsisdn->HrefValue = "";

			// msisdn
			$inqueue->msisdn->HrefValue = "";

			// qtime
			$inqueue->qtime->HrefValue = "";

			// exectime
			$inqueue->exectime->HrefValue = "";

			// message
			$inqueue->message->HrefValue = "";

			// status
			$inqueue->status->HrefValue = "";
		} elseif ($inqueue->RowType == EW_ROWTYPE_ADD) { // Add row

			// id
			// modem_id

			$inqueue->modem_id->EditCustomAttributes = "";
			$inqueue->modem_id->EditValue = ew_HtmlEncode($inqueue->modem_id->CurrentValue);

			// destmsisdn
			$inqueue->destmsisdn->EditCustomAttributes = "";
			$inqueue->destmsisdn->EditValue = ew_HtmlEncode($inqueue->destmsisdn->CurrentValue);

			// msisdn
			$inqueue->msisdn->EditCustomAttributes = "";
			$inqueue->msisdn->EditValue = ew_HtmlEncode($inqueue->msisdn->CurrentValue);

			// qtime
			$inqueue->qtime->EditCustomAttributes = "";
			$inqueue->qtime->EditValue = ew_HtmlEncode(ew_FormatDateTime($inqueue->qtime->CurrentValue, 7));

			// exectime
			$inqueue->exectime->EditCustomAttributes = "";
			$inqueue->exectime->EditValue = ew_HtmlEncode(ew_FormatDateTime($inqueue->exectime->CurrentValue, 7));

			// message
			$inqueue->message->EditCustomAttributes = "";
			$inqueue->message->EditValue = ew_HtmlEncode($inqueue->message->CurrentValue);

			// status
			$inqueue->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "Belum");
			$arwrk[] = array("1", "Sukses");
			$arwrk[] = array("2", "Gagal");
			array_unshift($arwrk, array("", "Please Select"));
			$inqueue->status->EditValue = $arwrk;
		} elseif ($inqueue->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$inqueue->id->EditCustomAttributes = "";
			$inqueue->id->EditValue = $inqueue->id->CurrentValue;
			$inqueue->id->CssStyle = "";
			$inqueue->id->CssClass = "";
			$inqueue->id->ViewCustomAttributes = "";

			// modem_id
			$inqueue->modem_id->EditCustomAttributes = "";
			$inqueue->modem_id->EditValue = ew_HtmlEncode($inqueue->modem_id->CurrentValue);

			// destmsisdn
			$inqueue->destmsisdn->EditCustomAttributes = "";
			$inqueue->destmsisdn->EditValue = ew_HtmlEncode($inqueue->destmsisdn->CurrentValue);

			// msisdn
			$inqueue->msisdn->EditCustomAttributes = "";
			$inqueue->msisdn->EditValue = ew_HtmlEncode($inqueue->msisdn->CurrentValue);

			// qtime
			$inqueue->qtime->EditCustomAttributes = "";
			$inqueue->qtime->EditValue = ew_HtmlEncode(ew_FormatDateTime($inqueue->qtime->CurrentValue, 7));

			// exectime
			$inqueue->exectime->EditCustomAttributes = "";
			$inqueue->exectime->EditValue = ew_HtmlEncode(ew_FormatDateTime($inqueue->exectime->CurrentValue, 7));

			// message
			$inqueue->message->EditCustomAttributes = "";
			$inqueue->message->EditValue = ew_HtmlEncode($inqueue->message->CurrentValue);

			// status
			$inqueue->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "Belum");
			$arwrk[] = array("1", "Sukses");
			$arwrk[] = array("2", "Gagal");
			array_unshift($arwrk, array("", "Please Select"));
			$inqueue->status->EditValue = $arwrk;

			// Edit refer script
			// id

			$inqueue->id->HrefValue = "";

			// modem_id
			$inqueue->modem_id->HrefValue = "";

			// destmsisdn
			$inqueue->destmsisdn->HrefValue = "";

			// msisdn
			$inqueue->msisdn->HrefValue = "";

			// qtime
			$inqueue->qtime->HrefValue = "";

			// exectime
			$inqueue->exectime->HrefValue = "";

			// message
			$inqueue->message->HrefValue = "";

			// status
			$inqueue->status->HrefValue = "";
		} elseif ($inqueue->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$inqueue->id->EditCustomAttributes = "";
			$inqueue->id->EditValue = ew_HtmlEncode($inqueue->id->AdvancedSearch->SearchValue);

			// modem_id
			$inqueue->modem_id->EditCustomAttributes = "";
			$inqueue->modem_id->EditValue = ew_HtmlEncode($inqueue->modem_id->AdvancedSearch->SearchValue);

			// destmsisdn
			$inqueue->destmsisdn->EditCustomAttributes = "";
			$inqueue->destmsisdn->EditValue = ew_HtmlEncode($inqueue->destmsisdn->AdvancedSearch->SearchValue);

			// msisdn
			$inqueue->msisdn->EditCustomAttributes = "";
			$inqueue->msisdn->EditValue = ew_HtmlEncode($inqueue->msisdn->AdvancedSearch->SearchValue);

			// qtime
			$inqueue->qtime->EditCustomAttributes = "";
			$inqueue->qtime->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($inqueue->qtime->AdvancedSearch->SearchValue, 7), 7));

			// exectime
			$inqueue->exectime->EditCustomAttributes = "";
			$inqueue->exectime->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($inqueue->exectime->AdvancedSearch->SearchValue, 7), 7));

			// message
			$inqueue->message->EditCustomAttributes = "";
			$inqueue->message->EditValue = ew_HtmlEncode($inqueue->message->AdvancedSearch->SearchValue);

			// status
			$inqueue->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "Belum");
			$arwrk[] = array("1", "Sukses");
			$arwrk[] = array("2", "Gagal");
			array_unshift($arwrk, array("", "Please Select"));
			$inqueue->status->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$inqueue->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $inqueue;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($inqueue->modem_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect integer - Modem Id";
		}
		if (!ew_CheckEuroDate($inqueue->qtime->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Qtime";
		}
		if (!ew_CheckEuroDate($inqueue->exectime->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Exectime";
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

	// Validate form
	function ValidateForm() {
		global $gsFormError, $inqueue;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($inqueue->modem_id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - Modem Id";
		}
		if (!ew_CheckEuroDate($inqueue->qtime->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect date, format = dd/mm/yyyy - Qtime";
		}
		if (!ew_CheckEuroDate($inqueue->exectime->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect date, format = dd/mm/yyyy - Exectime";
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
		global $conn, $Security, $inqueue;
		$sFilter = $inqueue->KeyFilter();
		$inqueue->CurrentFilter = $sFilter;
		$sSql = $inqueue->SQL();
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

			// Field id
			// Field modem_id

			$inqueue->modem_id->SetDbValueDef($inqueue->modem_id->CurrentValue, NULL);
			$rsnew['modem_id'] =& $inqueue->modem_id->DbValue;

			// Field destmsisdn
			$inqueue->destmsisdn->SetDbValueDef($inqueue->destmsisdn->CurrentValue, NULL);
			$rsnew['destmsisdn'] =& $inqueue->destmsisdn->DbValue;

			// Field msisdn
			$inqueue->msisdn->SetDbValueDef($inqueue->msisdn->CurrentValue, NULL);
			$rsnew['msisdn'] =& $inqueue->msisdn->DbValue;

			// Field qtime
			$inqueue->qtime->SetDbValueDef(ew_UnFormatDateTime($inqueue->qtime->CurrentValue, 7), NULL);
			$rsnew['qtime'] =& $inqueue->qtime->DbValue;

			// Field exectime
			$inqueue->exectime->SetDbValueDef(ew_UnFormatDateTime($inqueue->exectime->CurrentValue, 7), NULL);
			$rsnew['exectime'] =& $inqueue->exectime->DbValue;

			// Field message
			$inqueue->message->SetDbValueDef($inqueue->message->CurrentValue, NULL);
			$rsnew['message'] =& $inqueue->message->DbValue;

			// Field status
			$inqueue->status->SetDbValueDef($inqueue->status->CurrentValue, NULL);
			$rsnew['status'] =& $inqueue->status->DbValue;

			// Call Row Updating event
			$bUpdateRow = $inqueue->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($inqueue->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($inqueue->CancelMessage <> "") {
					$this->setMessage($inqueue->CancelMessage);
					$inqueue->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$inqueue->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $inqueue;
		$rsnew = array();

		// Field id
		// Field modem_id

		$inqueue->modem_id->SetDbValueDef($inqueue->modem_id->CurrentValue, NULL);
		$rsnew['modem_id'] =& $inqueue->modem_id->DbValue;

		// Field destmsisdn
		$inqueue->destmsisdn->SetDbValueDef($inqueue->destmsisdn->CurrentValue, NULL);
		$rsnew['destmsisdn'] =& $inqueue->destmsisdn->DbValue;

		// Field msisdn
		$inqueue->msisdn->SetDbValueDef($inqueue->msisdn->CurrentValue, NULL);
		$rsnew['msisdn'] =& $inqueue->msisdn->DbValue;

		// Field qtime
		$inqueue->qtime->SetDbValueDef(ew_UnFormatDateTime($inqueue->qtime->CurrentValue, 7), NULL);
		$rsnew['qtime'] =& $inqueue->qtime->DbValue;

		// Field exectime
		$inqueue->exectime->SetDbValueDef(ew_UnFormatDateTime($inqueue->exectime->CurrentValue, 7), NULL);
		$rsnew['exectime'] =& $inqueue->exectime->DbValue;

		// Field message
		$inqueue->message->SetDbValueDef($inqueue->message->CurrentValue, NULL);
		$rsnew['message'] =& $inqueue->message->DbValue;

		// Field status
		$inqueue->status->SetDbValueDef($inqueue->status->CurrentValue, NULL);
		$rsnew['status'] =& $inqueue->status->DbValue;

		// Call Row Inserting event
		$bInsertRow = $inqueue->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($inqueue->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($inqueue->CancelMessage <> "") {
				$this->setMessage($inqueue->CancelMessage);
				$inqueue->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$inqueue->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $inqueue->id->DbValue;

			// Call Row Inserted event
			$inqueue->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $inqueue;
		$inqueue->id->AdvancedSearch->SearchValue = $inqueue->getAdvancedSearch("x_id");
		$inqueue->modem_id->AdvancedSearch->SearchValue = $inqueue->getAdvancedSearch("x_modem_id");
		$inqueue->destmsisdn->AdvancedSearch->SearchValue = $inqueue->getAdvancedSearch("x_destmsisdn");
		$inqueue->msisdn->AdvancedSearch->SearchValue = $inqueue->getAdvancedSearch("x_msisdn");
		$inqueue->qtime->AdvancedSearch->SearchValue = $inqueue->getAdvancedSearch("x_qtime");
		$inqueue->exectime->AdvancedSearch->SearchValue = $inqueue->getAdvancedSearch("x_exectime");
		$inqueue->message->AdvancedSearch->SearchValue = $inqueue->getAdvancedSearch("x_message");
		$inqueue->status->AdvancedSearch->SearchValue = $inqueue->getAdvancedSearch("x_status");
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
