<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "outqueueinfo.php" ?>
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
$outqueue_list = new coutqueue_list();
$Page =& $outqueue_list;

// Page init processing
$outqueue_list->Page_Init();

// Page main processing
$outqueue_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($outqueue->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var outqueue_list = new ew_Page("outqueue_list");

// page properties
outqueue_list.PageID = "list"; // page ID
var EW_PAGE_ID = outqueue_list.PageID; // for backward compatibility

// extend page with ValidateForm function
outqueue_list.ValidateForm = function(fobj) {
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
outqueue_list.ValidateSearch = function(fobj) {
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
outqueue_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
outqueue_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
outqueue_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($outqueue->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($outqueue->Export == "" && $outqueue->SelectLimit);
	if (!$bSelectLimit)
		$rs = $outqueue_list->LoadRecordset();
	$outqueue_list->lTotalRecs = ($bSelectLimit) ? $outqueue->SelectRecordCount() : $rs->RecordCount();
	$outqueue_list->lStartRec = 1;
	if ($outqueue_list->lDisplayRecs <= 0) // Display all records
		$outqueue_list->lDisplayRecs = $outqueue_list->lTotalRecs;
	if (!($outqueue->ExportAll && $outqueue->Export <> ""))
		$outqueue_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $outqueue_list->LoadRecordset($outqueue_list->lStartRec-1, $outqueue_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Antrian SMS Keluar</b></h3>
<?php if ($outqueue->Export == "" && $outqueue->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $outqueue_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php if ($outqueue->Export == "" && $outqueue->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(outqueue_list);" style="text-decoration: none;"><img id="outqueue_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="outqueue_list_SearchPanel">
<form name="foutqueuelistsrch" id="foutqueuelistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return outqueue_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="outqueue">
<?php
if ($gsSearchError == "")
	$outqueue_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$outqueue->RowType = EW_ROWTYPE_SEARCH;

// Render row
$outqueue_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Modem Id</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_modem_id" id="z_modem_id" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_modem_id" id="x_modem_id" size="3" value="<?php echo $outqueue->modem_id->EditValue ?>"<?php echo $outqueue->modem_id->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Source</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_sourcemsisdn" id="z_sourcemsisdn" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_sourcemsisdn" id="x_sourcemsisdn" size="20" maxlength="20" value="<?php echo $outqueue->sourcemsisdn->EditValue ?>"<?php echo $outqueue->sourcemsisdn->EditAttributes() ?>>
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
<input type="text" name="x_msisdn" id="x_msisdn" size="20" maxlength="20" value="<?php echo $outqueue->msisdn->EditValue ?>"<?php echo $outqueue->msisdn->EditAttributes() ?>>
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
<input type="text" name="x_qtime" id="x_qtime" value="<?php echo $outqueue->qtime->EditValue ?>"<?php echo $outqueue->qtime->EditAttributes() ?>>
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
<input type="text" name="x_exectime" id="x_exectime" value="<?php echo $outqueue->exectime->EditValue ?>"<?php echo $outqueue->exectime->EditAttributes() ?>>
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
<input type="text" name="x_message" id="x_message" size="160" maxlength="160" value="<?php echo $outqueue->message->EditValue ?>"<?php echo $outqueue->message->EditAttributes() ?>>
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
<select id="x_status" name="x_status"<?php echo $outqueue->status->EditAttributes() ?>>
<?php
if (is_array($outqueue->status->EditValue)) {
	$arwrk = $outqueue->status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($outqueue->status->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<!--a href="<?php echo $outqueue_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $outqueue_list->PageUrl() ?>cmd=reset';">
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $outqueue_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($outqueue->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($outqueue->CurrentAction <> "gridadd" && $outqueue->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($outqueue_list->Pager)) $outqueue_list->Pager = new cPrevNextPager($outqueue_list->lStartRec, $outqueue_list->lDisplayRecs, $outqueue_list->lTotalRecs) ?>
<?php if ($outqueue_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($outqueue_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $outqueue_list->PageUrl() ?>start=<?php echo $outqueue_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($outqueue_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $outqueue_list->PageUrl() ?>start=<?php echo $outqueue_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $outqueue_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($outqueue_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $outqueue_list->PageUrl() ?>start=<?php echo $outqueue_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($outqueue_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $outqueue_list->PageUrl() ?>start=<?php echo $outqueue_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $outqueue_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $outqueue_list->Pager->FromIndex ?> to <?php echo $outqueue_list->Pager->ToIndex ?> of <?php echo $outqueue_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($outqueue_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($outqueue_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="outqueue">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($outqueue_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($outqueue_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($outqueue_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($outqueue_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($outqueue_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($outqueue_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $outqueue_list->PageUrl() ?>a=add"><img src="images/expand.gif" title="Add" width="16" height="16" border="0"></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="foutqueuelist" id="foutqueuelist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="outqueue">
<?php if ($outqueue_list->lTotalRecs > 0 || $outqueue->CurrentAction == "add" || $outqueue->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$outqueue_list->lOptionCnt = 0;
	$outqueue_list->lOptionCnt++; // edit
	$outqueue_list->lOptionCnt++; // Delete
	$outqueue_list->lOptionCnt += count($outqueue_list->ListOptions->Items); // Custom list options
?>
<?php echo $outqueue->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($outqueue->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php if ($outqueue_list->lOptionCnt == 0 && $outqueue->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($outqueue_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($outqueue->id->Visible) { // id ?>
	<?php if ($outqueue->SortUrl($outqueue->id) == "") { ?>
		<td style="white-space: nowrap;">Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $outqueue->SortUrl($outqueue->id) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id</td><td style="width: 10px;"><?php if ($outqueue->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($outqueue->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($outqueue->modem_id->Visible) { // modem_id ?>
	<?php if ($outqueue->SortUrl($outqueue->modem_id) == "") { ?>
		<td style="white-space: nowrap;">Modem Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $outqueue->SortUrl($outqueue->modem_id) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Modem Id</td><td style="width: 10px;"><?php if ($outqueue->modem_id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($outqueue->modem_id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($outqueue->sourcemsisdn->Visible) { // sourcemsisdn ?>
	<?php if ($outqueue->SortUrl($outqueue->sourcemsisdn) == "") { ?>
		<td style="white-space: nowrap;">Source</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $outqueue->SortUrl($outqueue->sourcemsisdn) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Source</td><td style="width: 10px;"><?php if ($outqueue->sourcemsisdn->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($outqueue->sourcemsisdn->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($outqueue->msisdn->Visible) { // msisdn ?>
	<?php if ($outqueue->SortUrl($outqueue->msisdn) == "") { ?>
		<td style="white-space: nowrap;">Msisdn</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $outqueue->SortUrl($outqueue->msisdn) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Msisdn</td><td style="width: 10px;"><?php if ($outqueue->msisdn->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($outqueue->msisdn->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($outqueue->qtime->Visible) { // qtime ?>
	<?php if ($outqueue->SortUrl($outqueue->qtime) == "") { ?>
		<td style="white-space: nowrap;">Qtime</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $outqueue->SortUrl($outqueue->qtime) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Qtime</td><td style="width: 10px;"><?php if ($outqueue->qtime->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($outqueue->qtime->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($outqueue->exectime->Visible) { // exectime ?>
	<?php if ($outqueue->SortUrl($outqueue->exectime) == "") { ?>
		<td style="white-space: nowrap;">Exectime</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $outqueue->SortUrl($outqueue->exectime) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Exectime</td><td style="width: 10px;"><?php if ($outqueue->exectime->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($outqueue->exectime->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($outqueue->message->Visible) { // message ?>
	<?php if ($outqueue->SortUrl($outqueue->message) == "") { ?>
		<td>Message</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $outqueue->SortUrl($outqueue->message) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Message</td><td style="width: 10px;"><?php if ($outqueue->message->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($outqueue->message->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($outqueue->status->Visible) { // status ?>
	<?php if ($outqueue->SortUrl($outqueue->status) == "") { ?>
		<td style="white-space: nowrap;">Status</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $outqueue->SortUrl($outqueue->status) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Status</td><td style="width: 10px;"><?php if ($outqueue->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($outqueue->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
	if ($outqueue->CurrentAction == "add" || $outqueue->CurrentAction == "copy") {
		$outqueue_list->lRowIndex = 1;
		if ($outqueue->CurrentAction == "add")
			$outqueue_list->LoadDefaultValues();
		if ($outqueue->EventCancelled) // Insert failed
			$outqueue_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$outqueue->CssClass = "ewTableEditRow";
		$outqueue->CssStyle = "";
		$outqueue->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
		$outqueue->RowType = EW_ROWTYPE_ADD;

		// Render row
		$outqueue_list->RenderRow();
?>
	<tr<?php echo $outqueue->RowAttributes() ?>>
<td colspan="<?php echo $outqueue_list->lOptionCnt ?>" align="right"><span class="phpmaker">
<a href="" onclick="if (outqueue_list.ValidateForm(document.foutqueuelist)) document.foutqueuelist.submit();return false;"><img src="images/save.gif" title="Insert" width="16" height="16" border="0"></a>&nbsp;<a href="<?php echo $outqueue_list->PageUrl() ?>a=cancel"><img src="images/b_drop.png" title="Cancel" width="16" height="16" border="0"></a>
<input type="hidden" name="a_list" id="a_list" value="insert">
</span></td>
	<?php if ($outqueue->id->Visible) { // id ?>
		<td style="white-space: nowrap;">&nbsp;</td>
	<?php } ?>
	<?php if ($outqueue->modem_id->Visible) { // modem_id ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $outqueue_list->lRowIndex ?>_modem_id" id="x<?php echo $outqueue_list->lRowIndex ?>_modem_id" size="3" value="<?php echo $outqueue->modem_id->EditValue ?>"<?php echo $outqueue->modem_id->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($outqueue->sourcemsisdn->Visible) { // sourcemsisdn ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $outqueue_list->lRowIndex ?>_sourcemsisdn" id="x<?php echo $outqueue_list->lRowIndex ?>_sourcemsisdn" size="20" maxlength="20" value="<?php echo $outqueue->sourcemsisdn->EditValue ?>"<?php echo $outqueue->sourcemsisdn->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($outqueue->msisdn->Visible) { // msisdn ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $outqueue_list->lRowIndex ?>_msisdn" id="x<?php echo $outqueue_list->lRowIndex ?>_msisdn" size="20" maxlength="20" value="<?php echo $outqueue->msisdn->EditValue ?>"<?php echo $outqueue->msisdn->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($outqueue->qtime->Visible) { // qtime ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $outqueue_list->lRowIndex ?>_qtime" id="x<?php echo $outqueue_list->lRowIndex ?>_qtime" value="<?php echo $outqueue->qtime->EditValue ?>"<?php echo $outqueue->qtime->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x<?php echo $outqueue_list->lRowIndex ?>_qtime" name="cal_x<?php echo $outqueue_list->lRowIndex ?>_qtime" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x<?php echo $outqueue_list->lRowIndex ?>_qtime", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x<?php echo $outqueue_list->lRowIndex ?>_qtime" // ID of the button
});
</script>
</td>
	<?php } ?>
	<?php if ($outqueue->exectime->Visible) { // exectime ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $outqueue_list->lRowIndex ?>_exectime" id="x<?php echo $outqueue_list->lRowIndex ?>_exectime" value="<?php echo $outqueue->exectime->EditValue ?>"<?php echo $outqueue->exectime->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x<?php echo $outqueue_list->lRowIndex ?>_exectime" name="cal_x<?php echo $outqueue_list->lRowIndex ?>_exectime" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x<?php echo $outqueue_list->lRowIndex ?>_exectime", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x<?php echo $outqueue_list->lRowIndex ?>_exectime" // ID of the button
});
</script>
</td>
	<?php } ?>
	<?php if ($outqueue->message->Visible) { // message ?>
		<td>
<input type="text" name="x<?php echo $outqueue_list->lRowIndex ?>_message" id="x<?php echo $outqueue_list->lRowIndex ?>_message" size="160" maxlength="160" value="<?php echo $outqueue->message->EditValue ?>"<?php echo $outqueue->message->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($outqueue->status->Visible) { // status ?>
		<td style="white-space: nowrap;">
<select id="x<?php echo $outqueue_list->lRowIndex ?>_status" name="x<?php echo $outqueue_list->lRowIndex ?>_status"<?php echo $outqueue->status->EditAttributes() ?>>
<?php
if (is_array($outqueue->status->EditValue)) {
	$arwrk = $outqueue->status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($outqueue->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
if ($outqueue->ExportAll && $outqueue->Export <> "") {
	$outqueue_list->lStopRec = $outqueue_list->lTotalRecs;
} else {
	$outqueue_list->lStopRec = $outqueue_list->lStartRec + $outqueue_list->lDisplayRecs - 1; // Set the last record to display
}
$outqueue_list->lRecCount = $outqueue_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$outqueue->SelectLimit && $outqueue_list->lStartRec > 1)
		$rs->Move($outqueue_list->lStartRec - 1);
}
$outqueue_list->lRowCnt = 0;
$outqueue_list->lEditRowCnt = 0;
if ($outqueue->CurrentAction == "edit")
	$outqueue_list->lRowIndex = 1;
while (($outqueue->CurrentAction == "gridadd" || !$rs->EOF) &&
	$outqueue_list->lRecCount < $outqueue_list->lStopRec) {
	$outqueue_list->lRecCount++;
	if (intval($outqueue_list->lRecCount) >= intval($outqueue_list->lStartRec)) {
		$outqueue_list->lRowCnt++;

	// Init row class and style
	$outqueue->CssClass = "";
	$outqueue->CssStyle = "";
	$outqueue->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($outqueue->CurrentAction == "gridadd") {
		$outqueue_list->LoadDefaultValues(); // Load default values
	} else {
		$outqueue_list->LoadRowValues($rs); // Load row values
	}
	$outqueue->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($outqueue->CurrentAction == "edit") {
		if ($outqueue_list->CheckInlineEditKey() && $outqueue_list->lEditRowCnt == 0) // Inline edit
			$outqueue->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($outqueue->RowType == EW_ROWTYPE_EDIT && $outqueue->EventCancelled) { // Update failed
		if ($outqueue->CurrentAction == "edit")
			$outqueue_list->RestoreFormValues(); // Restore form values
	}
	if ($outqueue->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$outqueue_list->lEditRowCnt++;
		$outqueue->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($outqueue->RowType == EW_ROWTYPE_ADD || $outqueue->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$outqueue->CssClass = "ewTableEditRow";

	// Render row
	$outqueue_list->RenderRow();
?>
	<tr<?php echo $outqueue->RowAttributes() ?>>
<?php if ($outqueue->RowType == EW_ROWTYPE_ADD || $outqueue->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($outqueue->CurrentAction == "edit") { ?>
<td colspan="<?php echo $outqueue_list->lOptionCnt ?>" align="right"><span class="phpmaker">
<a href="" onclick="if (outqueue_list.ValidateForm(document.foutqueuelist)) document.foutqueuelist.submit();return false;"><img src="images/save.gif" title="Update" width="16" height="16" border="0"></a>&nbsp;<a href="<?php echo $outqueue_list->PageUrl() ?>a=cancel"><img src="images/b_drop.png" title="Cancel" width="16" height="16" border="0"></a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php } else { ?>
<?php if ($outqueue->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $outqueue->InlineEditUrl() ?>"><img src="images/inlineedit.gif" title="Inline Edit" width="16" height="16" border="0"></a>
</span></td>
<?php if ($outqueue_list->lOptionCnt == 0 && $outqueue->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $outqueue->DeleteUrl() ?>"><img src="images/b_drop.png" title="Delete" width="16" height="16" border="0"></a>
</span></td>
<?php

// Custom list options
foreach ($outqueue_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	<?php if ($outqueue->id->Visible) { // id ?>
		<td<?php echo $outqueue->id->CellAttributes() ?>>
<?php if ($outqueue->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $outqueue->id->ViewAttributes() ?>><?php echo $outqueue->id->EditValue ?></div><input type="hidden" name="x<?php echo $outqueue_list->lRowIndex ?>_id" id="x<?php echo $outqueue_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($outqueue->id->CurrentValue) ?>">
<?php } ?>
<?php if ($outqueue->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $outqueue->id->ViewAttributes() ?>><?php echo $outqueue->id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($outqueue->modem_id->Visible) { // modem_id ?>
		<td<?php echo $outqueue->modem_id->CellAttributes() ?>>
<?php if ($outqueue->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $outqueue_list->lRowIndex ?>_modem_id" id="x<?php echo $outqueue_list->lRowIndex ?>_modem_id" size="3" value="<?php echo $outqueue->modem_id->EditValue ?>"<?php echo $outqueue->modem_id->EditAttributes() ?>>
<?php } ?>
<?php if ($outqueue->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $outqueue->modem_id->ViewAttributes() ?>><?php echo $outqueue->modem_id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($outqueue->sourcemsisdn->Visible) { // sourcemsisdn ?>
		<td<?php echo $outqueue->sourcemsisdn->CellAttributes() ?>>
<?php if ($outqueue->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $outqueue_list->lRowIndex ?>_sourcemsisdn" id="x<?php echo $outqueue_list->lRowIndex ?>_sourcemsisdn" size="20" maxlength="20" value="<?php echo $outqueue->sourcemsisdn->EditValue ?>"<?php echo $outqueue->sourcemsisdn->EditAttributes() ?>>
<?php } ?>
<?php if ($outqueue->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $outqueue->sourcemsisdn->ViewAttributes() ?>><?php echo $outqueue->sourcemsisdn->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($outqueue->msisdn->Visible) { // msisdn ?>
		<td<?php echo $outqueue->msisdn->CellAttributes() ?>>
<?php if ($outqueue->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $outqueue_list->lRowIndex ?>_msisdn" id="x<?php echo $outqueue_list->lRowIndex ?>_msisdn" size="20" maxlength="20" value="<?php echo $outqueue->msisdn->EditValue ?>"<?php echo $outqueue->msisdn->EditAttributes() ?>>
<?php } ?>
<?php if ($outqueue->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $outqueue->msisdn->ViewAttributes() ?>><?php echo $outqueue->msisdn->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($outqueue->qtime->Visible) { // qtime ?>
		<td<?php echo $outqueue->qtime->CellAttributes() ?>>
<?php if ($outqueue->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $outqueue_list->lRowIndex ?>_qtime" id="x<?php echo $outqueue_list->lRowIndex ?>_qtime" value="<?php echo $outqueue->qtime->EditValue ?>"<?php echo $outqueue->qtime->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x<?php echo $outqueue_list->lRowIndex ?>_qtime" name="cal_x<?php echo $outqueue_list->lRowIndex ?>_qtime" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x<?php echo $outqueue_list->lRowIndex ?>_qtime", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x<?php echo $outqueue_list->lRowIndex ?>_qtime" // ID of the button
});
</script>
<?php } ?>
<?php if ($outqueue->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $outqueue->qtime->ViewAttributes() ?>><?php echo $outqueue->qtime->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($outqueue->exectime->Visible) { // exectime ?>
		<td<?php echo $outqueue->exectime->CellAttributes() ?>>
<?php if ($outqueue->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $outqueue_list->lRowIndex ?>_exectime" id="x<?php echo $outqueue_list->lRowIndex ?>_exectime" value="<?php echo $outqueue->exectime->EditValue ?>"<?php echo $outqueue->exectime->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x<?php echo $outqueue_list->lRowIndex ?>_exectime" name="cal_x<?php echo $outqueue_list->lRowIndex ?>_exectime" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x<?php echo $outqueue_list->lRowIndex ?>_exectime", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x<?php echo $outqueue_list->lRowIndex ?>_exectime" // ID of the button
});
</script>
<?php } ?>
<?php if ($outqueue->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $outqueue->exectime->ViewAttributes() ?>><?php echo $outqueue->exectime->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($outqueue->message->Visible) { // message ?>
		<td<?php echo $outqueue->message->CellAttributes() ?>>
<?php if ($outqueue->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $outqueue_list->lRowIndex ?>_message" id="x<?php echo $outqueue_list->lRowIndex ?>_message" size="160" maxlength="160" value="<?php echo $outqueue->message->EditValue ?>"<?php echo $outqueue->message->EditAttributes() ?>>
<?php } ?>
<?php if ($outqueue->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $outqueue->message->ViewAttributes() ?>><?php echo $outqueue->message->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($outqueue->status->Visible) { // status ?>
		<td<?php echo $outqueue->status->CellAttributes() ?>>
<?php if ($outqueue->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $outqueue_list->lRowIndex ?>_status" name="x<?php echo $outqueue_list->lRowIndex ?>_status"<?php echo $outqueue->status->EditAttributes() ?>>
<?php
if (is_array($outqueue->status->EditValue)) {
	$arwrk = $outqueue->status->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($outqueue->status->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php if ($outqueue->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $outqueue->status->ViewAttributes() ?>><?php echo $outqueue->status->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	</tr>
<?php if ($outqueue->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($outqueue->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($outqueue->CurrentAction == "add" || $outqueue->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $outqueue_list->lRowIndex ?>">
<?php } ?>
<?php if ($outqueue->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $outqueue_list->lRowIndex ?>">
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
</td></tr></table>
<?php if ($outqueue->Export == "" && $outqueue->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(outqueue_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($outqueue->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$outqueue_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class coutqueue_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'outqueue';

	// Page Object Name
	var $PageObjName = 'outqueue_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $outqueue;
		if ($outqueue->UseTokenInUrl) $PageUrl .= "t=" . $outqueue->TableVar . "&"; // add page token
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
		global $objForm, $outqueue;
		if ($outqueue->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($outqueue->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($outqueue->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function coutqueue_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["outqueue"] = new coutqueue();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'outqueue', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $outqueue;
	$outqueue->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $outqueue->Export; // Get export parameter, used in header
	$gsExportFile = $outqueue->TableVar; // Get export file, used in header
	if ($outqueue->Export == "print" || $outqueue->Export == "html") {

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
		global $objForm, $gsSearchError, $Security, $outqueue;
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
				$outqueue->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($outqueue->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline edit mode
				if ($outqueue->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($outqueue->CurrentAction == "add" || $outqueue->CurrentAction == "copy")
					$this->InlineAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$outqueue->CurrentAction = $_POST["a_list"]; // Get action

					// Inline Update
					if ($outqueue->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($outqueue->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
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
		if ($outqueue->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $outqueue->getRecordsPerPage(); // Restore from Session
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
		$outqueue->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$outqueue->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$outqueue->setStartRecordNumber($this->lStartRec);
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
		$outqueue->setSessionWhere($sFilter);
		$outqueue->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $outqueue;
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
			$outqueue->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$outqueue->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $outqueue;
		$outqueue->setKey("id", ""); // Clear inline edit key
		$outqueue->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Edit Mode
	function InlineEditMode() {
		global $Security, $outqueue;
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$outqueue->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$outqueue->setKey("id", $outqueue->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $outqueue;
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
				$outqueue->SendEmail = TRUE; // Send email on update success
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
			$outqueue->EventCancelled = TRUE; // Cancel event
			$outqueue->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $outqueue;

		//CheckInlineEditKey = True
		if (strval($outqueue->getKey("id")) <> strval($outqueue->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add Mode
	function InlineAddMode() {
		global $Security, $outqueue;
		$outqueue->CurrentAction = "add";
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to inline add/copy record
	function InlineInsert() {
		global $objForm, $gsFormError, $outqueue;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate Form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$outqueue->EventCancelled = TRUE; // Set event cancelled
			$outqueue->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$outqueue->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage("Add succeeded"); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$outqueue->EventCancelled = TRUE; // Set event cancelled
			$outqueue->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $outqueue;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $outqueue->id, FALSE); // Field id
		$this->BuildSearchSql($sWhere, $outqueue->modem_id, FALSE); // Field modem_id
		$this->BuildSearchSql($sWhere, $outqueue->sourcemsisdn, FALSE); // Field sourcemsisdn
		$this->BuildSearchSql($sWhere, $outqueue->msisdn, FALSE); // Field msisdn
		$this->BuildSearchSql($sWhere, $outqueue->qtime, FALSE); // Field qtime
		$this->BuildSearchSql($sWhere, $outqueue->exectime, FALSE); // Field exectime
		$this->BuildSearchSql($sWhere, $outqueue->message, FALSE); // Field message
		$this->BuildSearchSql($sWhere, $outqueue->status, FALSE); // Field status

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($outqueue->id); // Field id
			$this->SetSearchParm($outqueue->modem_id); // Field modem_id
			$this->SetSearchParm($outqueue->sourcemsisdn); // Field sourcemsisdn
			$this->SetSearchParm($outqueue->msisdn); // Field msisdn
			$this->SetSearchParm($outqueue->qtime); // Field qtime
			$this->SetSearchParm($outqueue->exectime); // Field exectime
			$this->SetSearchParm($outqueue->message); // Field message
			$this->SetSearchParm($outqueue->status); // Field status
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
		global $outqueue;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$outqueue->setAdvancedSearch("x_$FldParm", $FldVal);
		$outqueue->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$outqueue->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$outqueue->setAdvancedSearch("y_$FldParm", $FldVal2);
		$outqueue->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $outqueue;
		$this->sSrchWhere = "";
		$outqueue->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $outqueue;
		$outqueue->setAdvancedSearch("x_id", "");
		$outqueue->setAdvancedSearch("x_modem_id", "");
		$outqueue->setAdvancedSearch("x_sourcemsisdn", "");
		$outqueue->setAdvancedSearch("x_msisdn", "");
		$outqueue->setAdvancedSearch("x_qtime", "");
		$outqueue->setAdvancedSearch("x_exectime", "");
		$outqueue->setAdvancedSearch("x_message", "");
		$outqueue->setAdvancedSearch("x_status", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $outqueue;
		$this->sSrchWhere = $outqueue->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $outqueue;
		 $outqueue->id->AdvancedSearch->SearchValue = $outqueue->getAdvancedSearch("x_id");
		 $outqueue->modem_id->AdvancedSearch->SearchValue = $outqueue->getAdvancedSearch("x_modem_id");
		 $outqueue->sourcemsisdn->AdvancedSearch->SearchValue = $outqueue->getAdvancedSearch("x_sourcemsisdn");
		 $outqueue->msisdn->AdvancedSearch->SearchValue = $outqueue->getAdvancedSearch("x_msisdn");
		 $outqueue->qtime->AdvancedSearch->SearchValue = $outqueue->getAdvancedSearch("x_qtime");
		 $outqueue->exectime->AdvancedSearch->SearchValue = $outqueue->getAdvancedSearch("x_exectime");
		 $outqueue->message->AdvancedSearch->SearchValue = $outqueue->getAdvancedSearch("x_message");
		 $outqueue->status->AdvancedSearch->SearchValue = $outqueue->getAdvancedSearch("x_status");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $outqueue;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$outqueue->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$outqueue->CurrentOrderType = @$_GET["ordertype"];
			$outqueue->UpdateSort($outqueue->id); // Field 
			$outqueue->UpdateSort($outqueue->modem_id); // Field 
			$outqueue->UpdateSort($outqueue->sourcemsisdn); // Field 
			$outqueue->UpdateSort($outqueue->msisdn); // Field 
			$outqueue->UpdateSort($outqueue->qtime); // Field 
			$outqueue->UpdateSort($outqueue->exectime); // Field 
			$outqueue->UpdateSort($outqueue->message); // Field 
			$outqueue->UpdateSort($outqueue->status); // Field 
			$outqueue->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $outqueue;
		$sOrderBy = $outqueue->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($outqueue->SqlOrderBy() <> "") {
				$sOrderBy = $outqueue->SqlOrderBy();
				$outqueue->setSessionOrderBy($sOrderBy);
				$outqueue->qtime->setSort("DESC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $outqueue;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$outqueue->setSessionOrderBy($sOrderBy);
				$outqueue->id->setSort("");
				$outqueue->modem_id->setSort("");
				$outqueue->sourcemsisdn->setSort("");
				$outqueue->msisdn->setSort("");
				$outqueue->qtime->setSort("");
				$outqueue->exectime->setSort("");
				$outqueue->message->setSort("");
				$outqueue->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$outqueue->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $outqueue;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$outqueue->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$outqueue->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $outqueue->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$outqueue->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$outqueue->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$outqueue->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $outqueue;
		$outqueue->status->CurrentValue = 0;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $outqueue;

		// Load search values
		// id

		$outqueue->id->AdvancedSearch->SearchValue = @$_GET["x_id"];
		$outqueue->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// modem_id
		$outqueue->modem_id->AdvancedSearch->SearchValue = @$_GET["x_modem_id"];
		$outqueue->modem_id->AdvancedSearch->SearchOperator = @$_GET["z_modem_id"];

		// sourcemsisdn
		$outqueue->sourcemsisdn->AdvancedSearch->SearchValue = @$_GET["x_sourcemsisdn"];
		$outqueue->sourcemsisdn->AdvancedSearch->SearchOperator = @$_GET["z_sourcemsisdn"];

		// msisdn
		$outqueue->msisdn->AdvancedSearch->SearchValue = @$_GET["x_msisdn"];
		$outqueue->msisdn->AdvancedSearch->SearchOperator = @$_GET["z_msisdn"];

		// qtime
		$outqueue->qtime->AdvancedSearch->SearchValue = @$_GET["x_qtime"];
		$outqueue->qtime->AdvancedSearch->SearchOperator = @$_GET["z_qtime"];

		// exectime
		$outqueue->exectime->AdvancedSearch->SearchValue = @$_GET["x_exectime"];
		$outqueue->exectime->AdvancedSearch->SearchOperator = @$_GET["z_exectime"];

		// message
		$outqueue->message->AdvancedSearch->SearchValue = @$_GET["x_message"];
		$outqueue->message->AdvancedSearch->SearchOperator = @$_GET["z_message"];

		// status
		$outqueue->status->AdvancedSearch->SearchValue = @$_GET["x_status"];
		$outqueue->status->AdvancedSearch->SearchOperator = @$_GET["z_status"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $outqueue;
		$outqueue->id->setFormValue($objForm->GetValue("x_id"));
		$outqueue->modem_id->setFormValue($objForm->GetValue("x_modem_id"));
		$outqueue->sourcemsisdn->setFormValue($objForm->GetValue("x_sourcemsisdn"));
		$outqueue->msisdn->setFormValue($objForm->GetValue("x_msisdn"));
		$outqueue->qtime->setFormValue($objForm->GetValue("x_qtime"));
		$outqueue->qtime->CurrentValue = ew_UnFormatDateTime($outqueue->qtime->CurrentValue, 7);
		$outqueue->exectime->setFormValue($objForm->GetValue("x_exectime"));
		$outqueue->exectime->CurrentValue = ew_UnFormatDateTime($outqueue->exectime->CurrentValue, 7);
		$outqueue->message->setFormValue($objForm->GetValue("x_message"));
		$outqueue->status->setFormValue($objForm->GetValue("x_status"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $outqueue;
		$outqueue->id->CurrentValue = $outqueue->id->FormValue;
		$outqueue->modem_id->CurrentValue = $outqueue->modem_id->FormValue;
		$outqueue->sourcemsisdn->CurrentValue = $outqueue->sourcemsisdn->FormValue;
		$outqueue->msisdn->CurrentValue = $outqueue->msisdn->FormValue;
		$outqueue->qtime->CurrentValue = $outqueue->qtime->FormValue;
		$outqueue->qtime->CurrentValue = ew_UnFormatDateTime($outqueue->qtime->CurrentValue, 7);
		$outqueue->exectime->CurrentValue = $outqueue->exectime->FormValue;
		$outqueue->exectime->CurrentValue = ew_UnFormatDateTime($outqueue->exectime->CurrentValue, 7);
		$outqueue->message->CurrentValue = $outqueue->message->FormValue;
		$outqueue->status->CurrentValue = $outqueue->status->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $outqueue;

		// Call Recordset Selecting event
		$outqueue->Recordset_Selecting($outqueue->CurrentFilter);

		// Load list page SQL
		$sSql = $outqueue->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$outqueue->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $outqueue;
		$sFilter = $outqueue->KeyFilter();

		// Call Row Selecting event
		$outqueue->Row_Selecting($sFilter);

		// Load sql based on filter
		$outqueue->CurrentFilter = $sFilter;
		$sSql = $outqueue->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$outqueue->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $outqueue;
		$outqueue->id->setDbValue($rs->fields('id'));
		$outqueue->modem_id->setDbValue($rs->fields('modem_id'));
		$outqueue->sourcemsisdn->setDbValue($rs->fields('sourcemsisdn'));
		$outqueue->msisdn->setDbValue($rs->fields('msisdn'));
		$outqueue->qtime->setDbValue($rs->fields('qtime'));
		$outqueue->exectime->setDbValue($rs->fields('exectime'));
		$outqueue->message->setDbValue($rs->fields('message'));
		$outqueue->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $outqueue;

		// Call Row_Rendering event
		$outqueue->Row_Rendering();

		// Common render codes for all row types
		// id

		$outqueue->id->CellCssStyle = "white-space: nowrap;";
		$outqueue->id->CellCssClass = "";

		// modem_id
		$outqueue->modem_id->CellCssStyle = "white-space: nowrap;";
		$outqueue->modem_id->CellCssClass = "";

		// sourcemsisdn
		$outqueue->sourcemsisdn->CellCssStyle = "white-space: nowrap;";
		$outqueue->sourcemsisdn->CellCssClass = "";

		// msisdn
		$outqueue->msisdn->CellCssStyle = "white-space: nowrap;";
		$outqueue->msisdn->CellCssClass = "";

		// qtime
		$outqueue->qtime->CellCssStyle = "white-space: nowrap;";
		$outqueue->qtime->CellCssClass = "";

		// exectime
		$outqueue->exectime->CellCssStyle = "white-space: nowrap;";
		$outqueue->exectime->CellCssClass = "";

		// message
		$outqueue->message->CellCssStyle = "";
		$outqueue->message->CellCssClass = "";

		// status
		$outqueue->status->CellCssStyle = "white-space: nowrap;";
		$outqueue->status->CellCssClass = "";
		if ($outqueue->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$outqueue->id->ViewValue = $outqueue->id->CurrentValue;
			$outqueue->id->CssStyle = "";
			$outqueue->id->CssClass = "";
			$outqueue->id->ViewCustomAttributes = "";

			// modem_id
			$outqueue->modem_id->ViewValue = $outqueue->modem_id->CurrentValue;
			$outqueue->modem_id->CssStyle = "";
			$outqueue->modem_id->CssClass = "";
			$outqueue->modem_id->ViewCustomAttributes = "";

			// sourcemsisdn
			$outqueue->sourcemsisdn->ViewValue = $outqueue->sourcemsisdn->CurrentValue;
			$outqueue->sourcemsisdn->CssStyle = "";
			$outqueue->sourcemsisdn->CssClass = "";
			$outqueue->sourcemsisdn->ViewCustomAttributes = "";

			// msisdn
			$outqueue->msisdn->ViewValue = $outqueue->msisdn->CurrentValue;
			$outqueue->msisdn->CssStyle = "";
			$outqueue->msisdn->CssClass = "";
			$outqueue->msisdn->ViewCustomAttributes = "";

			// qtime
			$outqueue->qtime->ViewValue = $outqueue->qtime->CurrentValue;
			$outqueue->qtime->ViewValue = ew_FormatDateTime($outqueue->qtime->ViewValue, 7);
			$outqueue->qtime->CssStyle = "";
			$outqueue->qtime->CssClass = "";
			$outqueue->qtime->ViewCustomAttributes = "";

			// exectime
			$outqueue->exectime->ViewValue = $outqueue->exectime->CurrentValue;
			$outqueue->exectime->ViewValue = ew_FormatDateTime($outqueue->exectime->ViewValue, 7);
			$outqueue->exectime->CssStyle = "";
			$outqueue->exectime->CssClass = "";
			$outqueue->exectime->ViewCustomAttributes = "";

			// message
			$outqueue->message->ViewValue = $outqueue->message->CurrentValue;
			$outqueue->message->CssStyle = "";
			$outqueue->message->CssClass = "";
			$outqueue->message->ViewCustomAttributes = "";

			// status
			if (strval($outqueue->status->CurrentValue) <> "") {
				switch ($outqueue->status->CurrentValue) {
					case "0":
						$outqueue->status->ViewValue = "Belum";
						break;
					case "1":
						$outqueue->status->ViewValue = "Sukses";
						break;
					case "2":
						$outqueue->status->ViewValue = "Gagal";
						break;
					default:
						$outqueue->status->ViewValue = $outqueue->status->CurrentValue;
				}
			} else {
				$outqueue->status->ViewValue = NULL;
			}
			$outqueue->status->CssStyle = "";
			$outqueue->status->CssClass = "";
			$outqueue->status->ViewCustomAttributes = "";

			// id
			$outqueue->id->HrefValue = "";

			// modem_id
			$outqueue->modem_id->HrefValue = "";

			// sourcemsisdn
			$outqueue->sourcemsisdn->HrefValue = "";

			// msisdn
			$outqueue->msisdn->HrefValue = "";

			// qtime
			$outqueue->qtime->HrefValue = "";

			// exectime
			$outqueue->exectime->HrefValue = "";

			// message
			$outqueue->message->HrefValue = "";

			// status
			$outqueue->status->HrefValue = "";
		} elseif ($outqueue->RowType == EW_ROWTYPE_ADD) { // Add row

			// id
			// modem_id

			$outqueue->modem_id->EditCustomAttributes = "";
			$outqueue->modem_id->EditValue = ew_HtmlEncode($outqueue->modem_id->CurrentValue);

			// sourcemsisdn
			$outqueue->sourcemsisdn->EditCustomAttributes = "";
			$outqueue->sourcemsisdn->EditValue = ew_HtmlEncode($outqueue->sourcemsisdn->CurrentValue);

			// msisdn
			$outqueue->msisdn->EditCustomAttributes = "";
			$outqueue->msisdn->EditValue = ew_HtmlEncode($outqueue->msisdn->CurrentValue);

			// qtime
			$outqueue->qtime->EditCustomAttributes = "";
			$outqueue->qtime->EditValue = ew_HtmlEncode(ew_FormatDateTime($outqueue->qtime->CurrentValue, 7));

			// exectime
			$outqueue->exectime->EditCustomAttributes = "";
			$outqueue->exectime->EditValue = ew_HtmlEncode(ew_FormatDateTime($outqueue->exectime->CurrentValue, 7));

			// message
			$outqueue->message->EditCustomAttributes = "";
			$outqueue->message->EditValue = ew_HtmlEncode($outqueue->message->CurrentValue);

			// status
			$outqueue->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "Belum");
			$arwrk[] = array("1", "Sukses");
			$arwrk[] = array("2", "Gagal");
			array_unshift($arwrk, array("", "Please Select"));
			$outqueue->status->EditValue = $arwrk;
		} elseif ($outqueue->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$outqueue->id->EditCustomAttributes = "";
			$outqueue->id->EditValue = $outqueue->id->CurrentValue;
			$outqueue->id->CssStyle = "";
			$outqueue->id->CssClass = "";
			$outqueue->id->ViewCustomAttributes = "";

			// modem_id
			$outqueue->modem_id->EditCustomAttributes = "";
			$outqueue->modem_id->EditValue = ew_HtmlEncode($outqueue->modem_id->CurrentValue);

			// sourcemsisdn
			$outqueue->sourcemsisdn->EditCustomAttributes = "";
			$outqueue->sourcemsisdn->EditValue = ew_HtmlEncode($outqueue->sourcemsisdn->CurrentValue);

			// msisdn
			$outqueue->msisdn->EditCustomAttributes = "";
			$outqueue->msisdn->EditValue = ew_HtmlEncode($outqueue->msisdn->CurrentValue);

			// qtime
			$outqueue->qtime->EditCustomAttributes = "";
			$outqueue->qtime->EditValue = ew_HtmlEncode(ew_FormatDateTime($outqueue->qtime->CurrentValue, 7));

			// exectime
			$outqueue->exectime->EditCustomAttributes = "";
			$outqueue->exectime->EditValue = ew_HtmlEncode(ew_FormatDateTime($outqueue->exectime->CurrentValue, 7));

			// message
			$outqueue->message->EditCustomAttributes = "";
			$outqueue->message->EditValue = ew_HtmlEncode($outqueue->message->CurrentValue);

			// status
			$outqueue->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "Belum");
			$arwrk[] = array("1", "Sukses");
			$arwrk[] = array("2", "Gagal");
			array_unshift($arwrk, array("", "Please Select"));
			$outqueue->status->EditValue = $arwrk;

			// Edit refer script
			// id

			$outqueue->id->HrefValue = "";

			// modem_id
			$outqueue->modem_id->HrefValue = "";

			// sourcemsisdn
			$outqueue->sourcemsisdn->HrefValue = "";

			// msisdn
			$outqueue->msisdn->HrefValue = "";

			// qtime
			$outqueue->qtime->HrefValue = "";

			// exectime
			$outqueue->exectime->HrefValue = "";

			// message
			$outqueue->message->HrefValue = "";

			// status
			$outqueue->status->HrefValue = "";
		} elseif ($outqueue->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$outqueue->id->EditCustomAttributes = "";
			$outqueue->id->EditValue = ew_HtmlEncode($outqueue->id->AdvancedSearch->SearchValue);

			// modem_id
			$outqueue->modem_id->EditCustomAttributes = "";
			$outqueue->modem_id->EditValue = ew_HtmlEncode($outqueue->modem_id->AdvancedSearch->SearchValue);

			// sourcemsisdn
			$outqueue->sourcemsisdn->EditCustomAttributes = "";
			$outqueue->sourcemsisdn->EditValue = ew_HtmlEncode($outqueue->sourcemsisdn->AdvancedSearch->SearchValue);

			// msisdn
			$outqueue->msisdn->EditCustomAttributes = "";
			$outqueue->msisdn->EditValue = ew_HtmlEncode($outqueue->msisdn->AdvancedSearch->SearchValue);

			// qtime
			$outqueue->qtime->EditCustomAttributes = "";
			$outqueue->qtime->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($outqueue->qtime->AdvancedSearch->SearchValue, 7), 7));

			// exectime
			$outqueue->exectime->EditCustomAttributes = "";
			$outqueue->exectime->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($outqueue->exectime->AdvancedSearch->SearchValue, 7), 7));

			// message
			$outqueue->message->EditCustomAttributes = "";
			$outqueue->message->EditValue = ew_HtmlEncode($outqueue->message->AdvancedSearch->SearchValue);

			// status
			$outqueue->status->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "Belum");
			$arwrk[] = array("1", "Sukses");
			$arwrk[] = array("2", "Gagal");
			array_unshift($arwrk, array("", "Please Select"));
			$outqueue->status->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$outqueue->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $outqueue;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($outqueue->modem_id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect integer - Modem Id";
		}
		if (!ew_CheckEuroDate($outqueue->qtime->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Qtime";
		}
		if (!ew_CheckEuroDate($outqueue->exectime->AdvancedSearch->SearchValue)) {
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
		global $gsFormError, $outqueue;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($outqueue->modem_id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect integer - Modem Id";
		}
		if (!ew_CheckEuroDate($outqueue->qtime->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect date, format = dd/mm/yyyy - Qtime";
		}
		if (!ew_CheckEuroDate($outqueue->exectime->FormValue)) {
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
		global $conn, $Security, $outqueue;
		$sFilter = $outqueue->KeyFilter();
		$outqueue->CurrentFilter = $sFilter;
		$sSql = $outqueue->SQL();
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

			$outqueue->modem_id->SetDbValueDef($outqueue->modem_id->CurrentValue, NULL);
			$rsnew['modem_id'] =& $outqueue->modem_id->DbValue;

			// Field sourcemsisdn
			$outqueue->sourcemsisdn->SetDbValueDef($outqueue->sourcemsisdn->CurrentValue, NULL);
			$rsnew['sourcemsisdn'] =& $outqueue->sourcemsisdn->DbValue;

			// Field msisdn
			$outqueue->msisdn->SetDbValueDef($outqueue->msisdn->CurrentValue, NULL);
			$rsnew['msisdn'] =& $outqueue->msisdn->DbValue;

			// Field qtime
			$outqueue->qtime->SetDbValueDef(ew_UnFormatDateTime($outqueue->qtime->CurrentValue, 7), NULL);
			$rsnew['qtime'] =& $outqueue->qtime->DbValue;

			// Field exectime
			$outqueue->exectime->SetDbValueDef(ew_UnFormatDateTime($outqueue->exectime->CurrentValue, 7), NULL);
			$rsnew['exectime'] =& $outqueue->exectime->DbValue;

			// Field message
			$outqueue->message->SetDbValueDef($outqueue->message->CurrentValue, NULL);
			$rsnew['message'] =& $outqueue->message->DbValue;

			// Field status
			$outqueue->status->SetDbValueDef($outqueue->status->CurrentValue, NULL);
			$rsnew['status'] =& $outqueue->status->DbValue;

			// Call Row Updating event
			$bUpdateRow = $outqueue->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($outqueue->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($outqueue->CancelMessage <> "") {
					$this->setMessage($outqueue->CancelMessage);
					$outqueue->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$outqueue->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $outqueue;
		$rsnew = array();

		// Field id
		// Field modem_id

		$outqueue->modem_id->SetDbValueDef($outqueue->modem_id->CurrentValue, NULL);
		$rsnew['modem_id'] =& $outqueue->modem_id->DbValue;

		// Field sourcemsisdn
		$outqueue->sourcemsisdn->SetDbValueDef($outqueue->sourcemsisdn->CurrentValue, NULL);
		$rsnew['sourcemsisdn'] =& $outqueue->sourcemsisdn->DbValue;

		// Field msisdn
		$outqueue->msisdn->SetDbValueDef($outqueue->msisdn->CurrentValue, NULL);
		$rsnew['msisdn'] =& $outqueue->msisdn->DbValue;

		// Field qtime
		$outqueue->qtime->SetDbValueDef(ew_UnFormatDateTime($outqueue->qtime->CurrentValue, 7), NULL);
		$rsnew['qtime'] =& $outqueue->qtime->DbValue;

		// Field exectime
		$outqueue->exectime->SetDbValueDef(ew_UnFormatDateTime($outqueue->exectime->CurrentValue, 7), NULL);
		$rsnew['exectime'] =& $outqueue->exectime->DbValue;

		// Field message
		$outqueue->message->SetDbValueDef($outqueue->message->CurrentValue, NULL);
		$rsnew['message'] =& $outqueue->message->DbValue;

		// Field status
		$outqueue->status->SetDbValueDef($outqueue->status->CurrentValue, NULL);
		$rsnew['status'] =& $outqueue->status->DbValue;

		// Call Row Inserting event
		$bInsertRow = $outqueue->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($outqueue->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($outqueue->CancelMessage <> "") {
				$this->setMessage($outqueue->CancelMessage);
				$outqueue->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$outqueue->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $outqueue->id->DbValue;

			// Call Row Inserted event
			$outqueue->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $outqueue;
		$outqueue->id->AdvancedSearch->SearchValue = $outqueue->getAdvancedSearch("x_id");
		$outqueue->modem_id->AdvancedSearch->SearchValue = $outqueue->getAdvancedSearch("x_modem_id");
		$outqueue->sourcemsisdn->AdvancedSearch->SearchValue = $outqueue->getAdvancedSearch("x_sourcemsisdn");
		$outqueue->msisdn->AdvancedSearch->SearchValue = $outqueue->getAdvancedSearch("x_msisdn");
		$outqueue->qtime->AdvancedSearch->SearchValue = $outqueue->getAdvancedSearch("x_qtime");
		$outqueue->exectime->AdvancedSearch->SearchValue = $outqueue->getAdvancedSearch("x_exectime");
		$outqueue->message->AdvancedSearch->SearchValue = $outqueue->getAdvancedSearch("x_message");
		$outqueue->status->AdvancedSearch->SearchValue = $outqueue->getAdvancedSearch("x_status");
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
