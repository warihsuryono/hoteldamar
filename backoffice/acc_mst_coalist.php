<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "acc_mst_coainfo.php" ?>
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
$acc_mst_coa_list = new cacc_mst_coa_list();
$Page =& $acc_mst_coa_list;

// Page init processing
$acc_mst_coa_list->Page_Init();

// Page main processing
$acc_mst_coa_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($acc_mst_coa->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var acc_mst_coa_list = new ew_Page("acc_mst_coa_list");

// page properties
acc_mst_coa_list.PageID = "list"; // page ID
var EW_PAGE_ID = acc_mst_coa_list.PageID; // for backward compatibility

// extend page with ValidateForm function
acc_mst_coa_list.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_coa"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Coa");
		elm = fobj.elements["x" + infix + "_koder"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Group");
		elm = fobj.elements["x" + infix + "_description"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Description");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with validate function for search
acc_mst_coa_list.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";

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
acc_mst_coa_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
acc_mst_coa_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
acc_mst_coa_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
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
<?php if ($acc_mst_coa->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($acc_mst_coa->Export == "" && $acc_mst_coa->SelectLimit);
	if (!$bSelectLimit)
		$rs = $acc_mst_coa_list->LoadRecordset();
	$acc_mst_coa_list->lTotalRecs = ($bSelectLimit) ? $acc_mst_coa->SelectRecordCount() : $rs->RecordCount();
	$acc_mst_coa_list->lStartRec = 1;
	if ($acc_mst_coa_list->lDisplayRecs <= 0) // Display all records
		$acc_mst_coa_list->lDisplayRecs = $acc_mst_coa_list->lTotalRecs;
	if (!($acc_mst_coa->ExportAll && $acc_mst_coa->Export <> ""))
		$acc_mst_coa_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $acc_mst_coa_list->LoadRecordset($acc_mst_coa_list->lStartRec-1, $acc_mst_coa_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Master COA</b></h3>
<?php if ($acc_mst_coa->Export == "" && $acc_mst_coa->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $acc_mst_coa_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $acc_mst_coa_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php if ($acc_mst_coa->Export == "" && $acc_mst_coa->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(acc_mst_coa_list);" style="text-decoration: none;"><img id="acc_mst_coa_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="acc_mst_coa_list_SearchPanel">
<form name="facc_mst_coalistsrch" id="facc_mst_coalistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return acc_mst_coa_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="acc_mst_coa">
<?php
if ($gsSearchError == "")
	$acc_mst_coa_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$acc_mst_coa->RowType = EW_ROWTYPE_SEARCH;

// Render row
$acc_mst_coa_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Coa</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_coa" id="z_coa" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_coa" id="x_coa" size="10" maxlength="10" value="<?php echo $acc_mst_coa->coa->EditValue ?>"<?php echo $acc_mst_coa->coa->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Group</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_koder" id="z_koder" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_koder" id="x_koder" size="30" maxlength="255" value="<?php echo $acc_mst_coa->koder->EditValue ?>"<?php echo $acc_mst_coa->koder->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Description</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_description" id="z_description" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_description" id="x_description" size="50" maxlength="255" value="<?php echo $acc_mst_coa->description->EditValue ?>"<?php echo $acc_mst_coa->description->EditAttributes() ?>>
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
			<!--a href="<?php echo $acc_mst_coa_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $acc_mst_coa_list->PageUrl() ?>cmd=reset';">
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $acc_mst_coa_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($acc_mst_coa->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($acc_mst_coa->CurrentAction <> "gridadd" && $acc_mst_coa->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($acc_mst_coa_list->Pager)) $acc_mst_coa_list->Pager = new cPrevNextPager($acc_mst_coa_list->lStartRec, $acc_mst_coa_list->lDisplayRecs, $acc_mst_coa_list->lTotalRecs) ?>
<?php if ($acc_mst_coa_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($acc_mst_coa_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $acc_mst_coa_list->PageUrl() ?>start=<?php echo $acc_mst_coa_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($acc_mst_coa_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $acc_mst_coa_list->PageUrl() ?>start=<?php echo $acc_mst_coa_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $acc_mst_coa_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($acc_mst_coa_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $acc_mst_coa_list->PageUrl() ?>start=<?php echo $acc_mst_coa_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($acc_mst_coa_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $acc_mst_coa_list->PageUrl() ?>start=<?php echo $acc_mst_coa_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $acc_mst_coa_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $acc_mst_coa_list->Pager->FromIndex ?> to <?php echo $acc_mst_coa_list->Pager->ToIndex ?> of <?php echo $acc_mst_coa_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($acc_mst_coa_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($acc_mst_coa_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="acc_mst_coa">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($acc_mst_coa_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($acc_mst_coa_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($acc_mst_coa_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($acc_mst_coa_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($acc_mst_coa_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($acc_mst_coa_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $acc_mst_coa_list->PageUrl() ?>a=add"><img src="images/expand.gif" title="Add" width="16" height="16" border="0"></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="facc_mst_coalist" id="facc_mst_coalist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="acc_mst_coa">
<?php if ($acc_mst_coa_list->lTotalRecs > 0 || $acc_mst_coa->CurrentAction == "add" || $acc_mst_coa->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$acc_mst_coa_list->lOptionCnt = 0;
	$acc_mst_coa_list->lOptionCnt++; // edit
	$acc_mst_coa_list->lOptionCnt++; // Delete
	$acc_mst_coa_list->lOptionCnt += count($acc_mst_coa_list->ListOptions->Items); // Custom list options
?>
<?php echo $acc_mst_coa->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($acc_mst_coa->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php if ($acc_mst_coa_list->lOptionCnt == 0 && $acc_mst_coa->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($acc_mst_coa_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($acc_mst_coa->coa->Visible) { // coa ?>
	<?php if ($acc_mst_coa->SortUrl($acc_mst_coa->coa) == "") { ?>
		<td style="white-space: nowrap;">Coa</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_mst_coa->SortUrl($acc_mst_coa->coa) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Coa</td><td style="width: 10px;"><?php if ($acc_mst_coa->coa->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_mst_coa->coa->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($acc_mst_coa->koder->Visible) { // koder ?>
	<?php if ($acc_mst_coa->SortUrl($acc_mst_coa->koder) == "") { ?>
		<td style="white-space: nowrap;">Group</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_mst_coa->SortUrl($acc_mst_coa->koder) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Group</td><td style="width: 10px;"><?php if ($acc_mst_coa->koder->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_mst_coa->koder->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($acc_mst_coa->description->Visible) { // description ?>
	<?php if ($acc_mst_coa->SortUrl($acc_mst_coa->description) == "") { ?>
		<td style="white-space: nowrap;">Description</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_mst_coa->SortUrl($acc_mst_coa->description) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Description</td><td style="width: 10px;"><?php if ($acc_mst_coa->description->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_mst_coa->description->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
	if ($acc_mst_coa->CurrentAction == "add" || $acc_mst_coa->CurrentAction == "copy") {
		$acc_mst_coa_list->lRowIndex = 1;
		if ($acc_mst_coa->CurrentAction == "add")
			$acc_mst_coa_list->LoadDefaultValues();
		if ($acc_mst_coa->EventCancelled) // Insert failed
			$acc_mst_coa_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$acc_mst_coa->CssClass = "ewTableEditRow";
		$acc_mst_coa->CssStyle = "";
		$acc_mst_coa->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
		$acc_mst_coa->RowType = EW_ROWTYPE_ADD;

		// Render row
		$acc_mst_coa_list->RenderRow();
?>
	<tr<?php echo $acc_mst_coa->RowAttributes() ?>>
<td colspan="<?php echo $acc_mst_coa_list->lOptionCnt ?>" align="right"><span class="phpmaker">
<a href="" onclick="if (acc_mst_coa_list.ValidateForm(document.facc_mst_coalist)) document.facc_mst_coalist.submit();return false;"><img src="images/save.gif" title="Insert" width="16" height="16" border="0"></a>&nbsp;<a href="<?php echo $acc_mst_coa_list->PageUrl() ?>a=cancel"><img src="images/b_drop.png" title="Cancel" width="16" height="16" border="0"></a>
<input type="hidden" name="a_list" id="a_list" value="insert">
</span></td>
	<?php if ($acc_mst_coa->coa->Visible) { // coa ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $acc_mst_coa_list->lRowIndex ?>_coa" id="x<?php echo $acc_mst_coa_list->lRowIndex ?>_coa" size="10" maxlength="10" value="<?php echo $acc_mst_coa->coa->EditValue ?>"<?php echo $acc_mst_coa->coa->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($acc_mst_coa->koder->Visible) { // koder ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $acc_mst_coa_list->lRowIndex ?>_koder" id="x<?php echo $acc_mst_coa_list->lRowIndex ?>_koder" size="30" maxlength="255" value="<?php echo $acc_mst_coa->koder->EditValue ?>"<?php echo $acc_mst_coa->koder->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($acc_mst_coa->description->Visible) { // description ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $acc_mst_coa_list->lRowIndex ?>_description" id="x<?php echo $acc_mst_coa_list->lRowIndex ?>_description" size="50" maxlength="255" value="<?php echo $acc_mst_coa->description->EditValue ?>"<?php echo $acc_mst_coa->description->EditAttributes() ?>>
</td>
	<?php } ?>
	</tr>
<?php
}
?>
<?php
if ($acc_mst_coa->ExportAll && $acc_mst_coa->Export <> "") {
	$acc_mst_coa_list->lStopRec = $acc_mst_coa_list->lTotalRecs;
} else {
	$acc_mst_coa_list->lStopRec = $acc_mst_coa_list->lStartRec + $acc_mst_coa_list->lDisplayRecs - 1; // Set the last record to display
}
$acc_mst_coa_list->lRecCount = $acc_mst_coa_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$acc_mst_coa->SelectLimit && $acc_mst_coa_list->lStartRec > 1)
		$rs->Move($acc_mst_coa_list->lStartRec - 1);
}
$acc_mst_coa_list->lRowCnt = 0;
$acc_mst_coa_list->lEditRowCnt = 0;
if ($acc_mst_coa->CurrentAction == "edit")
	$acc_mst_coa_list->lRowIndex = 1;
while (($acc_mst_coa->CurrentAction == "gridadd" || !$rs->EOF) &&
	$acc_mst_coa_list->lRecCount < $acc_mst_coa_list->lStopRec) {
	$acc_mst_coa_list->lRecCount++;
	if (intval($acc_mst_coa_list->lRecCount) >= intval($acc_mst_coa_list->lStartRec)) {
		$acc_mst_coa_list->lRowCnt++;

	// Init row class and style
	$acc_mst_coa->CssClass = "";
	$acc_mst_coa->CssStyle = "";
	$acc_mst_coa->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($acc_mst_coa->CurrentAction == "gridadd") {
		$acc_mst_coa_list->LoadDefaultValues(); // Load default values
	} else {
		$acc_mst_coa_list->LoadRowValues($rs); // Load row values
	}
	$acc_mst_coa->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($acc_mst_coa->CurrentAction == "edit") {
		if ($acc_mst_coa_list->CheckInlineEditKey() && $acc_mst_coa_list->lEditRowCnt == 0) // Inline edit
			$acc_mst_coa->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($acc_mst_coa->RowType == EW_ROWTYPE_EDIT && $acc_mst_coa->EventCancelled) { // Update failed
		if ($acc_mst_coa->CurrentAction == "edit")
			$acc_mst_coa_list->RestoreFormValues(); // Restore form values
	}
	if ($acc_mst_coa->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$acc_mst_coa_list->lEditRowCnt++;
		$acc_mst_coa->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($acc_mst_coa->RowType == EW_ROWTYPE_ADD || $acc_mst_coa->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$acc_mst_coa->CssClass = "ewTableEditRow";

	// Render row
	$acc_mst_coa_list->RenderRow();
?>
	<tr<?php echo $acc_mst_coa->RowAttributes() ?>>
<?php if ($acc_mst_coa->RowType == EW_ROWTYPE_ADD || $acc_mst_coa->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($acc_mst_coa->CurrentAction == "edit") { ?>
<td colspan="<?php echo $acc_mst_coa_list->lOptionCnt ?>" align="right"><span class="phpmaker">
<a href="" onclick="if (acc_mst_coa_list.ValidateForm(document.facc_mst_coalist)) document.facc_mst_coalist.submit();return false;"><img src="images/save.gif" title="Update" width="16" height="16" border="0"></a>&nbsp;<a href="<?php echo $acc_mst_coa_list->PageUrl() ?>a=cancel"><img src="images/b_drop.png" title="Cancel" width="16" height="16" border="0"></a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php } else { ?>
<?php if ($acc_mst_coa->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $acc_mst_coa->InlineEditUrl() ?>"><img src="images/inlineedit.gif" title="Inline Edit" width="16" height="16" border="0"></a>
</span></td>
<?php if ($acc_mst_coa_list->lOptionCnt == 0 && $acc_mst_coa->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $acc_mst_coa->DeleteUrl() ?>"><img src="images/b_drop.png" title="Delete" width="16" height="16" border="0"></a>
</span></td>
<?php

// Custom list options
foreach ($acc_mst_coa_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	<?php if ($acc_mst_coa->coa->Visible) { // coa ?>
		<td<?php echo $acc_mst_coa->coa->CellAttributes() ?>>
<?php if ($acc_mst_coa->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $acc_mst_coa->coa->ViewAttributes() ?>><?php echo $acc_mst_coa->coa->EditValue ?></div><input type="hidden" name="x<?php echo $acc_mst_coa_list->lRowIndex ?>_coa" id="x<?php echo $acc_mst_coa_list->lRowIndex ?>_coa" value="<?php echo ew_HtmlEncode($acc_mst_coa->coa->CurrentValue) ?>">
<?php } ?>
<?php if ($acc_mst_coa->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $acc_mst_coa->coa->ViewAttributes() ?>><?php echo $acc_mst_coa->coa->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($acc_mst_coa->koder->Visible) { // koder ?>
		<td<?php echo $acc_mst_coa->koder->CellAttributes() ?>>
<?php if ($acc_mst_coa->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $acc_mst_coa_list->lRowIndex ?>_koder" id="x<?php echo $acc_mst_coa_list->lRowIndex ?>_koder" size="30" maxlength="255" value="<?php echo $acc_mst_coa->koder->EditValue ?>"<?php echo $acc_mst_coa->koder->EditAttributes() ?>>
<?php } ?>
<?php if ($acc_mst_coa->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $acc_mst_coa->koder->ViewAttributes() ?>><?php echo $acc_mst_coa->koder->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($acc_mst_coa->description->Visible) { // description ?>
		<td<?php echo $acc_mst_coa->description->CellAttributes() ?>>
<?php if ($acc_mst_coa->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $acc_mst_coa_list->lRowIndex ?>_description" id="x<?php echo $acc_mst_coa_list->lRowIndex ?>_description" size="50" maxlength="255" value="<?php echo $acc_mst_coa->description->EditValue ?>"<?php echo $acc_mst_coa->description->EditAttributes() ?>>
<?php } ?>
<?php if ($acc_mst_coa->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $acc_mst_coa->description->ViewAttributes() ?>><?php echo $acc_mst_coa->description->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	</tr>
<?php if ($acc_mst_coa->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($acc_mst_coa->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($acc_mst_coa->CurrentAction == "add" || $acc_mst_coa->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $acc_mst_coa_list->lRowIndex ?>">
<?php } ?>
<?php if ($acc_mst_coa->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $acc_mst_coa_list->lRowIndex ?>">
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
</td></tr></table>
<?php if ($acc_mst_coa->Export == "" && $acc_mst_coa->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(acc_mst_coa_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($acc_mst_coa->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$acc_mst_coa_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cacc_mst_coa_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'acc_mst_coa';

	// Page Object Name
	var $PageObjName = 'acc_mst_coa_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $acc_mst_coa;
		if ($acc_mst_coa->UseTokenInUrl) $PageUrl .= "t=" . $acc_mst_coa->TableVar . "&"; // add page token
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
		global $objForm, $acc_mst_coa;
		if ($acc_mst_coa->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($acc_mst_coa->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($acc_mst_coa->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cacc_mst_coa_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["acc_mst_coa"] = new cacc_mst_coa();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'acc_mst_coa', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $acc_mst_coa;
	$acc_mst_coa->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $acc_mst_coa->Export; // Get export parameter, used in header
	$gsExportFile = $acc_mst_coa->TableVar; // Get export file, used in header
	if ($acc_mst_coa->Export == "print" || $acc_mst_coa->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($acc_mst_coa->Export == "excel") {
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
		global $objForm, $gsSearchError, $Security, $acc_mst_coa;
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
				$acc_mst_coa->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($acc_mst_coa->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline edit mode
				if ($acc_mst_coa->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($acc_mst_coa->CurrentAction == "add" || $acc_mst_coa->CurrentAction == "copy")
					$this->InlineAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$acc_mst_coa->CurrentAction = $_POST["a_list"]; // Get action

					// Inline Update
					if ($acc_mst_coa->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($acc_mst_coa->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
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
		if ($acc_mst_coa->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $acc_mst_coa->getRecordsPerPage(); // Restore from Session
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
		$acc_mst_coa->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$acc_mst_coa->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$acc_mst_coa->setStartRecordNumber($this->lStartRec);
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
		$acc_mst_coa->setSessionWhere($sFilter);
		$acc_mst_coa->CurrentFilter = "";

		// Export data only
		if (in_array($acc_mst_coa->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $acc_mst_coa;
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
			$acc_mst_coa->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$acc_mst_coa->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $acc_mst_coa;
		$acc_mst_coa->setKey("coa", ""); // Clear inline edit key
		$acc_mst_coa->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Edit Mode
	function InlineEditMode() {
		global $Security, $acc_mst_coa;
		$bInlineEdit = TRUE;
		if (@$_GET["coa"] <> "") {
			$acc_mst_coa->coa->setQueryStringValue($_GET["coa"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$acc_mst_coa->setKey("coa", $acc_mst_coa->coa->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $acc_mst_coa;
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
				$acc_mst_coa->SendEmail = TRUE; // Send email on update success
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
			$acc_mst_coa->EventCancelled = TRUE; // Cancel event
			$acc_mst_coa->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $acc_mst_coa;

		//CheckInlineEditKey = True
		if (strval($acc_mst_coa->getKey("coa")) <> strval($acc_mst_coa->coa->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add Mode
	function InlineAddMode() {
		global $Security, $acc_mst_coa;
		$acc_mst_coa->CurrentAction = "add";
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to inline add/copy record
	function InlineInsert() {
		global $objForm, $gsFormError, $acc_mst_coa;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate Form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$acc_mst_coa->EventCancelled = TRUE; // Set event cancelled
			$acc_mst_coa->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$acc_mst_coa->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage("Add succeeded"); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$acc_mst_coa->EventCancelled = TRUE; // Set event cancelled
			$acc_mst_coa->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $acc_mst_coa;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $acc_mst_coa->coa, FALSE); // Field coa
		$this->BuildSearchSql($sWhere, $acc_mst_coa->koder, FALSE); // Field koder
		$this->BuildSearchSql($sWhere, $acc_mst_coa->parent, FALSE); // Field parent
		$this->BuildSearchSql($sWhere, $acc_mst_coa->description, FALSE); // Field description

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($acc_mst_coa->coa); // Field coa
			$this->SetSearchParm($acc_mst_coa->koder); // Field koder
			$this->SetSearchParm($acc_mst_coa->parent); // Field parent
			$this->SetSearchParm($acc_mst_coa->description); // Field description
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
		global $acc_mst_coa;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$acc_mst_coa->setAdvancedSearch("x_$FldParm", $FldVal);
		$acc_mst_coa->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$acc_mst_coa->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$acc_mst_coa->setAdvancedSearch("y_$FldParm", $FldVal2);
		$acc_mst_coa->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $acc_mst_coa;
		$this->sSrchWhere = "";
		$acc_mst_coa->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $acc_mst_coa;
		$acc_mst_coa->setAdvancedSearch("x_coa", "");
		$acc_mst_coa->setAdvancedSearch("x_koder", "");
		$acc_mst_coa->setAdvancedSearch("x_parent", "");
		$acc_mst_coa->setAdvancedSearch("x_description", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $acc_mst_coa;
		$this->sSrchWhere = $acc_mst_coa->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $acc_mst_coa;
		 $acc_mst_coa->coa->AdvancedSearch->SearchValue = $acc_mst_coa->getAdvancedSearch("x_coa");
		 $acc_mst_coa->koder->AdvancedSearch->SearchValue = $acc_mst_coa->getAdvancedSearch("x_koder");
		 $acc_mst_coa->parent->AdvancedSearch->SearchValue = $acc_mst_coa->getAdvancedSearch("x_parent");
		 $acc_mst_coa->description->AdvancedSearch->SearchValue = $acc_mst_coa->getAdvancedSearch("x_description");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $acc_mst_coa;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$acc_mst_coa->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$acc_mst_coa->CurrentOrderType = @$_GET["ordertype"];
			$acc_mst_coa->UpdateSort($acc_mst_coa->coa); // Field 
			$acc_mst_coa->UpdateSort($acc_mst_coa->koder); // Field 
			$acc_mst_coa->UpdateSort($acc_mst_coa->description); // Field 
			$acc_mst_coa->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $acc_mst_coa;
		$sOrderBy = $acc_mst_coa->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($acc_mst_coa->SqlOrderBy() <> "") {
				$sOrderBy = $acc_mst_coa->SqlOrderBy();
				$acc_mst_coa->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $acc_mst_coa;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$acc_mst_coa->setSessionOrderBy($sOrderBy);
				$acc_mst_coa->coa->setSort("");
				$acc_mst_coa->koder->setSort("");
				$acc_mst_coa->description->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$acc_mst_coa->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $acc_mst_coa;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$acc_mst_coa->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$acc_mst_coa->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $acc_mst_coa->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$acc_mst_coa->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$acc_mst_coa->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$acc_mst_coa->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $acc_mst_coa;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $acc_mst_coa;

		// Load search values
		// coa

		$acc_mst_coa->coa->AdvancedSearch->SearchValue = @$_GET["x_coa"];
		$acc_mst_coa->coa->AdvancedSearch->SearchOperator = @$_GET["z_coa"];

		// koder
		$acc_mst_coa->koder->AdvancedSearch->SearchValue = @$_GET["x_koder"];
		$acc_mst_coa->koder->AdvancedSearch->SearchOperator = @$_GET["z_koder"];

		// parent
		$acc_mst_coa->parent->AdvancedSearch->SearchValue = @$_GET["x_parent"];
		$acc_mst_coa->parent->AdvancedSearch->SearchOperator = @$_GET["z_parent"];

		// description
		$acc_mst_coa->description->AdvancedSearch->SearchValue = @$_GET["x_description"];
		$acc_mst_coa->description->AdvancedSearch->SearchOperator = @$_GET["z_description"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $acc_mst_coa;
		$acc_mst_coa->coa->setFormValue($objForm->GetValue("x_coa"));
		$acc_mst_coa->koder->setFormValue($objForm->GetValue("x_koder"));
		$acc_mst_coa->description->setFormValue($objForm->GetValue("x_description"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $acc_mst_coa;
		$acc_mst_coa->coa->CurrentValue = $acc_mst_coa->coa->FormValue;
		$acc_mst_coa->koder->CurrentValue = $acc_mst_coa->koder->FormValue;
		$acc_mst_coa->description->CurrentValue = $acc_mst_coa->description->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $acc_mst_coa;

		// Call Recordset Selecting event
		$acc_mst_coa->Recordset_Selecting($acc_mst_coa->CurrentFilter);

		// Load list page SQL
		$sSql = $acc_mst_coa->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$acc_mst_coa->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $acc_mst_coa;
		$sFilter = $acc_mst_coa->KeyFilter();

		// Call Row Selecting event
		$acc_mst_coa->Row_Selecting($sFilter);

		// Load sql based on filter
		$acc_mst_coa->CurrentFilter = $sFilter;
		$sSql = $acc_mst_coa->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$acc_mst_coa->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $acc_mst_coa;
		$acc_mst_coa->coa->setDbValue($rs->fields('coa'));
		$acc_mst_coa->koder->setDbValue($rs->fields('koder'));
		$acc_mst_coa->parent->setDbValue($rs->fields('parent'));
		$acc_mst_coa->description->setDbValue($rs->fields('description'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $acc_mst_coa;

		// Call Row_Rendering event
		$acc_mst_coa->Row_Rendering();

		// Common render codes for all row types
		// coa

		$acc_mst_coa->coa->CellCssStyle = "white-space: nowrap;";
		$acc_mst_coa->coa->CellCssClass = "";

		// koder
		$acc_mst_coa->koder->CellCssStyle = "white-space: nowrap;";
		$acc_mst_coa->koder->CellCssClass = "";

		// description
		$acc_mst_coa->description->CellCssStyle = "white-space: nowrap;";
		$acc_mst_coa->description->CellCssClass = "";
		if ($acc_mst_coa->RowType == EW_ROWTYPE_VIEW) { // View row

			// coa
			$acc_mst_coa->coa->ViewValue = $acc_mst_coa->coa->CurrentValue;
			$acc_mst_coa->coa->CssStyle = "";
			$acc_mst_coa->coa->CssClass = "";
			$acc_mst_coa->coa->ViewCustomAttributes = "";

			// koder
			$acc_mst_coa->koder->ViewValue = $acc_mst_coa->koder->CurrentValue;
			$acc_mst_coa->koder->CssStyle = "";
			$acc_mst_coa->koder->CssClass = "";
			$acc_mst_coa->koder->ViewCustomAttributes = "";

			// description
			$acc_mst_coa->description->ViewValue = $acc_mst_coa->description->CurrentValue;
			$acc_mst_coa->description->CssStyle = "";
			$acc_mst_coa->description->CssClass = "";
			$acc_mst_coa->description->ViewCustomAttributes = "";

			// coa
			$acc_mst_coa->coa->HrefValue = "";

			// koder
			$acc_mst_coa->koder->HrefValue = "";

			// description
			$acc_mst_coa->description->HrefValue = "";
		} elseif ($acc_mst_coa->RowType == EW_ROWTYPE_ADD) { // Add row

			// coa
			$acc_mst_coa->coa->EditCustomAttributes = "";
			$acc_mst_coa->coa->EditValue = ew_HtmlEncode($acc_mst_coa->coa->CurrentValue);

			// koder
			$acc_mst_coa->koder->EditCustomAttributes = "";
			$acc_mst_coa->koder->EditValue = ew_HtmlEncode($acc_mst_coa->koder->CurrentValue);

			// description
			$acc_mst_coa->description->EditCustomAttributes = "";
			$acc_mst_coa->description->EditValue = ew_HtmlEncode($acc_mst_coa->description->CurrentValue);
		} elseif ($acc_mst_coa->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// coa
			$acc_mst_coa->coa->EditCustomAttributes = "";
			$acc_mst_coa->coa->EditValue = $acc_mst_coa->coa->CurrentValue;
			$acc_mst_coa->coa->CssStyle = "";
			$acc_mst_coa->coa->CssClass = "";
			$acc_mst_coa->coa->ViewCustomAttributes = "";

			// koder
			$acc_mst_coa->koder->EditCustomAttributes = "";
			$acc_mst_coa->koder->EditValue = ew_HtmlEncode($acc_mst_coa->koder->CurrentValue);

			// description
			$acc_mst_coa->description->EditCustomAttributes = "";
			$acc_mst_coa->description->EditValue = ew_HtmlEncode($acc_mst_coa->description->CurrentValue);

			// Edit refer script
			// coa

			$acc_mst_coa->coa->HrefValue = "";

			// koder
			$acc_mst_coa->koder->HrefValue = "";

			// description
			$acc_mst_coa->description->HrefValue = "";
		} elseif ($acc_mst_coa->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// coa
			$acc_mst_coa->coa->EditCustomAttributes = "";
			$acc_mst_coa->coa->EditValue = ew_HtmlEncode($acc_mst_coa->coa->AdvancedSearch->SearchValue);

			// koder
			$acc_mst_coa->koder->EditCustomAttributes = "";
			$acc_mst_coa->koder->EditValue = ew_HtmlEncode($acc_mst_coa->koder->AdvancedSearch->SearchValue);

			// description
			$acc_mst_coa->description->EditCustomAttributes = "";
			$acc_mst_coa->description->EditValue = ew_HtmlEncode($acc_mst_coa->description->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		$acc_mst_coa->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $acc_mst_coa;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

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
		global $gsFormError, $acc_mst_coa;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($acc_mst_coa->coa->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Coa";
		}
		if ($acc_mst_coa->koder->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Group";
		}
		if ($acc_mst_coa->description->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Description";
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
		global $conn, $Security, $acc_mst_coa;
		$sFilter = $acc_mst_coa->KeyFilter();
		$acc_mst_coa->CurrentFilter = $sFilter;
		$sSql = $acc_mst_coa->SQL();
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

			// Field coa
			// Field koder

			$acc_mst_coa->koder->SetDbValueDef($acc_mst_coa->koder->CurrentValue, "");
			$rsnew['koder'] =& $acc_mst_coa->koder->DbValue;

			// Field description
			$acc_mst_coa->description->SetDbValueDef($acc_mst_coa->description->CurrentValue, "");
			$rsnew['description'] =& $acc_mst_coa->description->DbValue;

			// Call Row Updating event
			$bUpdateRow = $acc_mst_coa->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($acc_mst_coa->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($acc_mst_coa->CancelMessage <> "") {
					$this->setMessage($acc_mst_coa->CancelMessage);
					$acc_mst_coa->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$acc_mst_coa->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $acc_mst_coa;

		// Check if key value entered
		if ($acc_mst_coa->coa->CurrentValue == "") {
			$this->setMessage("Invalid key value");
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $acc_mst_coa->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $acc_mst_coa->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, "Duplicate primary key: '%f'");
				$this->setMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// Field coa
		$acc_mst_coa->coa->SetDbValueDef($acc_mst_coa->coa->CurrentValue, "");
		$rsnew['coa'] =& $acc_mst_coa->coa->DbValue;

		// Field koder
		$acc_mst_coa->koder->SetDbValueDef($acc_mst_coa->koder->CurrentValue, "");
		$rsnew['koder'] =& $acc_mst_coa->koder->DbValue;

		// Field description
		$acc_mst_coa->description->SetDbValueDef($acc_mst_coa->description->CurrentValue, "");
		$rsnew['description'] =& $acc_mst_coa->description->DbValue;

		// Call Row Inserting event
		$bInsertRow = $acc_mst_coa->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($acc_mst_coa->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($acc_mst_coa->CancelMessage <> "") {
				$this->setMessage($acc_mst_coa->CancelMessage);
				$acc_mst_coa->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$acc_mst_coa->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $acc_mst_coa;
		$acc_mst_coa->coa->AdvancedSearch->SearchValue = $acc_mst_coa->getAdvancedSearch("x_coa");
		$acc_mst_coa->koder->AdvancedSearch->SearchValue = $acc_mst_coa->getAdvancedSearch("x_koder");
		$acc_mst_coa->parent->AdvancedSearch->SearchValue = $acc_mst_coa->getAdvancedSearch("x_parent");
		$acc_mst_coa->description->AdvancedSearch->SearchValue = $acc_mst_coa->getAdvancedSearch("x_description");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $acc_mst_coa;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($acc_mst_coa->ExportAll) {
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
		if ($acc_mst_coa->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($acc_mst_coa->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $acc_mst_coa->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'coa', $acc_mst_coa->Export);
				ew_ExportAddValue($sExportStr, 'koder', $acc_mst_coa->Export);
				ew_ExportAddValue($sExportStr, 'description', $acc_mst_coa->Export);
				echo ew_ExportLine($sExportStr, $acc_mst_coa->Export);
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
				$acc_mst_coa->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($acc_mst_coa->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('coa', $acc_mst_coa->coa->CurrentValue);
					$XmlDoc->AddField('koder', $acc_mst_coa->koder->CurrentValue);
					$XmlDoc->AddField('description', $acc_mst_coa->description->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $acc_mst_coa->Export <> "csv") { // Vertical format
						echo ew_ExportField('coa', $acc_mst_coa->coa->ExportValue($acc_mst_coa->Export, $acc_mst_coa->ExportOriginalValue), $acc_mst_coa->Export);
						echo ew_ExportField('koder', $acc_mst_coa->koder->ExportValue($acc_mst_coa->Export, $acc_mst_coa->ExportOriginalValue), $acc_mst_coa->Export);
						echo ew_ExportField('description', $acc_mst_coa->description->ExportValue($acc_mst_coa->Export, $acc_mst_coa->ExportOriginalValue), $acc_mst_coa->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $acc_mst_coa->coa->ExportValue($acc_mst_coa->Export, $acc_mst_coa->ExportOriginalValue), $acc_mst_coa->Export);
						ew_ExportAddValue($sExportStr, $acc_mst_coa->koder->ExportValue($acc_mst_coa->Export, $acc_mst_coa->ExportOriginalValue), $acc_mst_coa->Export);
						ew_ExportAddValue($sExportStr, $acc_mst_coa->description->ExportValue($acc_mst_coa->Export, $acc_mst_coa->ExportOriginalValue), $acc_mst_coa->Export);
						echo ew_ExportLine($sExportStr, $acc_mst_coa->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($acc_mst_coa->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($acc_mst_coa->Export);
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
