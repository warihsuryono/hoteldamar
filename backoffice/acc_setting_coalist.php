<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "acc_setting_coainfo.php" ?>
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
$acc_setting_coa_list = new cacc_setting_coa_list();
$Page =& $acc_setting_coa_list;

// Page init processing
$acc_setting_coa_list->Page_Init();

// Page main processing
$acc_setting_coa_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($acc_setting_coa->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var acc_setting_coa_list = new ew_Page("acc_setting_coa_list");

// page properties
acc_setting_coa_list.PageID = "list"; // page ID
var EW_PAGE_ID = acc_setting_coa_list.PageID; // for backward compatibility

// extend page with ValidateForm function
acc_setting_coa_list.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_description"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Description");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
acc_setting_coa_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
acc_setting_coa_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
acc_setting_coa_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($acc_setting_coa->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($acc_setting_coa->Export == "" && $acc_setting_coa->SelectLimit);
	if (!$bSelectLimit)
		$rs = $acc_setting_coa_list->LoadRecordset();
	$acc_setting_coa_list->lTotalRecs = ($bSelectLimit) ? $acc_setting_coa->SelectRecordCount() : $rs->RecordCount();
	$acc_setting_coa_list->lStartRec = 1;
	if ($acc_setting_coa_list->lDisplayRecs <= 0) // Display all records
		$acc_setting_coa_list->lDisplayRecs = $acc_setting_coa_list->lTotalRecs;
	if (!($acc_setting_coa->ExportAll && $acc_setting_coa->Export <> ""))
		$acc_setting_coa_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $acc_setting_coa_list->LoadRecordset($acc_setting_coa_list->lStartRec-1, $acc_setting_coa_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Setting COA</b></h3>
<?php if ($acc_setting_coa->Export == "" && $acc_setting_coa->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $acc_setting_coa_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $acc_setting_coa_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php $acc_setting_coa_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($acc_setting_coa->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($acc_setting_coa->CurrentAction <> "gridadd" && $acc_setting_coa->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($acc_setting_coa_list->Pager)) $acc_setting_coa_list->Pager = new cPrevNextPager($acc_setting_coa_list->lStartRec, $acc_setting_coa_list->lDisplayRecs, $acc_setting_coa_list->lTotalRecs) ?>
<?php if ($acc_setting_coa_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($acc_setting_coa_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $acc_setting_coa_list->PageUrl() ?>start=<?php echo $acc_setting_coa_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($acc_setting_coa_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $acc_setting_coa_list->PageUrl() ?>start=<?php echo $acc_setting_coa_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $acc_setting_coa_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($acc_setting_coa_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $acc_setting_coa_list->PageUrl() ?>start=<?php echo $acc_setting_coa_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($acc_setting_coa_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $acc_setting_coa_list->PageUrl() ?>start=<?php echo $acc_setting_coa_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $acc_setting_coa_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $acc_setting_coa_list->Pager->FromIndex ?> to <?php echo $acc_setting_coa_list->Pager->ToIndex ?> of <?php echo $acc_setting_coa_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($acc_setting_coa_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($acc_setting_coa_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="acc_setting_coa">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($acc_setting_coa_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($acc_setting_coa_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($acc_setting_coa_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($acc_setting_coa_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($acc_setting_coa_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($acc_setting_coa_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($acc_setting_coa->CurrentAction <> "gridadd" && $acc_setting_coa->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<?php if ($acc_setting_coa_list->lTotalRecs > 0) { ?>
<a href="<?php echo $acc_setting_coa_list->PageUrl() ?>a=gridedit">Grid Edit</a>&nbsp;&nbsp;
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($acc_setting_coa->CurrentAction == "gridedit") { ?>
<a href="" onclick="if (acc_setting_coa_list.ValidateForm(document.facc_setting_coalist)) document.facc_setting_coalist.submit();return false;">Save</a>&nbsp;&nbsp;
<?php } ?>
<a href="<?php echo $acc_setting_coa_list->PageUrl() ?>a=cancel">Cancel</a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="facc_setting_coalist" id="facc_setting_coalist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="acc_setting_coa">
<?php if ($acc_setting_coa_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$acc_setting_coa_list->lOptionCnt = 0;
	$acc_setting_coa_list->lOptionCnt++; // edit
	$acc_setting_coa_list->lOptionCnt += count($acc_setting_coa_list->ListOptions->Items); // Custom list options
?>
<?php echo $acc_setting_coa->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($acc_setting_coa->Export == "") { ?>
<?php if ($acc_setting_coa->CurrentAction <> "gridadd" && $acc_setting_coa->CurrentAction <> "gridedit") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($acc_setting_coa_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php } ?>
<?php if ($acc_setting_coa->id->Visible) { // id ?>
	<?php if ($acc_setting_coa->SortUrl($acc_setting_coa->id) == "") { ?>
		<td style="white-space: nowrap;">Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_setting_coa->SortUrl($acc_setting_coa->id) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id</td><td style="width: 10px;"><?php if ($acc_setting_coa->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_setting_coa->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($acc_setting_coa->description->Visible) { // description ?>
	<?php if ($acc_setting_coa->SortUrl($acc_setting_coa->description) == "") { ?>
		<td style="white-space: nowrap;">Description</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_setting_coa->SortUrl($acc_setting_coa->description) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Description</td><td style="width: 10px;"><?php if ($acc_setting_coa->description->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_setting_coa->description->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($acc_setting_coa->coa->Visible) { // coa ?>
	<?php if ($acc_setting_coa->SortUrl($acc_setting_coa->coa) == "") { ?>
		<td style="white-space: nowrap;">Coa</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_setting_coa->SortUrl($acc_setting_coa->coa) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Coa</td><td style="width: 10px;"><?php if ($acc_setting_coa->coa->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_setting_coa->coa->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($acc_setting_coa->ExportAll && $acc_setting_coa->Export <> "") {
	$acc_setting_coa_list->lStopRec = $acc_setting_coa_list->lTotalRecs;
} else {
	$acc_setting_coa_list->lStopRec = $acc_setting_coa_list->lStartRec + $acc_setting_coa_list->lDisplayRecs - 1; // Set the last record to display
}
$acc_setting_coa_list->lRecCount = $acc_setting_coa_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$acc_setting_coa->SelectLimit && $acc_setting_coa_list->lStartRec > 1)
		$rs->Move($acc_setting_coa_list->lStartRec - 1);
}
$acc_setting_coa_list->lRowCnt = 0;
$acc_setting_coa_list->lEditRowCnt = 0;
if ($acc_setting_coa->CurrentAction == "edit")
	$acc_setting_coa_list->lRowIndex = 1;
if ($acc_setting_coa->CurrentAction == "gridedit")
	$acc_setting_coa_list->lRowIndex = 0;
while (($acc_setting_coa->CurrentAction == "gridadd" || !$rs->EOF) &&
	$acc_setting_coa_list->lRecCount < $acc_setting_coa_list->lStopRec) {
	$acc_setting_coa_list->lRecCount++;
	if (intval($acc_setting_coa_list->lRecCount) >= intval($acc_setting_coa_list->lStartRec)) {
		$acc_setting_coa_list->lRowCnt++;
		if ($acc_setting_coa->CurrentAction == "gridadd" || $acc_setting_coa->CurrentAction == "gridedit")
			$acc_setting_coa_list->lRowIndex++;

	// Init row class and style
	$acc_setting_coa->CssClass = "";
	$acc_setting_coa->CssStyle = "";
	$acc_setting_coa->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($acc_setting_coa->CurrentAction == "gridadd") {
		$acc_setting_coa_list->LoadDefaultValues(); // Load default values
	} else {
		$acc_setting_coa_list->LoadRowValues($rs); // Load row values
	}
	$acc_setting_coa->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($acc_setting_coa->CurrentAction == "edit") {
		if ($acc_setting_coa_list->CheckInlineEditKey() && $acc_setting_coa_list->lEditRowCnt == 0) // Inline edit
			$acc_setting_coa->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($acc_setting_coa->CurrentAction == "gridedit") // Grid edit
		$acc_setting_coa->RowType = EW_ROWTYPE_EDIT; // Render edit
	if ($acc_setting_coa->RowType == EW_ROWTYPE_EDIT && $acc_setting_coa->EventCancelled) { // Update failed
		if ($acc_setting_coa->CurrentAction == "edit")
			$acc_setting_coa_list->RestoreFormValues(); // Restore form values
		if ($acc_setting_coa->CurrentAction == "gridedit")
			$acc_setting_coa_list->RestoreCurrentRowFormValues($acc_setting_coa_list->lRowIndex); // Restore form values
	}
	if ($acc_setting_coa->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$acc_setting_coa_list->lEditRowCnt++;
		$acc_setting_coa->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($acc_setting_coa->RowType == EW_ROWTYPE_ADD || $acc_setting_coa->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$acc_setting_coa->CssClass = "ewTableEditRow";

	// Render row
	$acc_setting_coa_list->RenderRow();
?>
	<tr<?php echo $acc_setting_coa->RowAttributes() ?>>
<?php if ($acc_setting_coa->RowType == EW_ROWTYPE_ADD || $acc_setting_coa->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($acc_setting_coa->CurrentAction == "edit") { ?>
<td colspan="<?php echo $acc_setting_coa_list->lOptionCnt ?>" align="right"><span class="phpmaker">
<a href="" onclick="if (acc_setting_coa_list.ValidateForm(document.facc_setting_coalist)) document.facc_setting_coalist.submit();return false;"><img src="images/save.gif" title="Update" width="16" height="16" border="0"></a>&nbsp;<a href="<?php echo $acc_setting_coa_list->PageUrl() ?>a=cancel"><img src="images/b_drop.png" title="Cancel" width="16" height="16" border="0"></a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php
	if ($acc_setting_coa->CurrentAction == "gridedit")
		$acc_setting_coa_list->sMultiSelectKey .= "<input type=\"hidden\" name=\"k" . $acc_setting_coa_list->lRowIndex . "_key\" id=\"k" . $acc_setting_coa_list->lRowIndex . "_key\" value=\"" . $acc_setting_coa->id->CurrentValue . "\">";
?>
<?php } else { ?>
<?php if ($acc_setting_coa->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $acc_setting_coa->InlineEditUrl() ?>"><img src="images/inlineedit.gif" title="Inline Edit" width="16" height="16" border="0"></a>
</span></td>
<?php

// Custom list options
foreach ($acc_setting_coa_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	<?php if ($acc_setting_coa->id->Visible) { // id ?>
		<td<?php echo $acc_setting_coa->id->CellAttributes() ?>>
<?php if ($acc_setting_coa->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $acc_setting_coa->id->ViewAttributes() ?>><?php echo $acc_setting_coa->id->EditValue ?></div><input type="hidden" name="x<?php echo $acc_setting_coa_list->lRowIndex ?>_id" id="x<?php echo $acc_setting_coa_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($acc_setting_coa->id->CurrentValue) ?>">
<?php } ?>
<?php if ($acc_setting_coa->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $acc_setting_coa->id->ViewAttributes() ?>><?php echo $acc_setting_coa->id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($acc_setting_coa->description->Visible) { // description ?>
		<td<?php echo $acc_setting_coa->description->CellAttributes() ?>>
<?php if ($acc_setting_coa->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $acc_setting_coa_list->lRowIndex ?>_description" id="x<?php echo $acc_setting_coa_list->lRowIndex ?>_description" size="30" maxlength="200" value="<?php echo $acc_setting_coa->description->EditValue ?>"<?php echo $acc_setting_coa->description->EditAttributes() ?>>
<?php } ?>
<?php if ($acc_setting_coa->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $acc_setting_coa->description->ViewAttributes() ?>><?php echo $acc_setting_coa->description->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($acc_setting_coa->coa->Visible) { // coa ?>
		<td<?php echo $acc_setting_coa->coa->CellAttributes() ?>>
<?php if ($acc_setting_coa->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $acc_setting_coa_list->lRowIndex ?>_coa" name="x<?php echo $acc_setting_coa_list->lRowIndex ?>_coa"<?php echo $acc_setting_coa->coa->EditAttributes() ?>>
<?php
if (is_array($acc_setting_coa->coa->EditValue)) {
	$arwrk = $acc_setting_coa->coa->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($acc_setting_coa->coa->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
</option>
<?php
	}
}
?>
</select>
<?php } ?>
<?php if ($acc_setting_coa->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $acc_setting_coa->coa->ViewAttributes() ?>><?php echo $acc_setting_coa->coa->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	</tr>
<?php if ($acc_setting_coa->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($acc_setting_coa->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($acc_setting_coa->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $acc_setting_coa_list->lRowIndex ?>">
<?php } ?>
<?php if ($acc_setting_coa->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $acc_setting_coa_list->lRowIndex ?>">
<?php echo $acc_setting_coa_list->sMultiSelectKey ?>
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
</td></tr></table>
<?php if ($acc_setting_coa->Export == "" && $acc_setting_coa->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(acc_setting_coa_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($acc_setting_coa->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$acc_setting_coa_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cacc_setting_coa_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'acc_setting_coa';

	// Page Object Name
	var $PageObjName = 'acc_setting_coa_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $acc_setting_coa;
		if ($acc_setting_coa->UseTokenInUrl) $PageUrl .= "t=" . $acc_setting_coa->TableVar . "&"; // add page token
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
		global $objForm, $acc_setting_coa;
		if ($acc_setting_coa->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($acc_setting_coa->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($acc_setting_coa->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cacc_setting_coa_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["acc_setting_coa"] = new cacc_setting_coa();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'acc_setting_coa', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $acc_setting_coa;
	$acc_setting_coa->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $acc_setting_coa->Export; // Get export parameter, used in header
	$gsExportFile = $acc_setting_coa->TableVar; // Get export file, used in header
	if ($acc_setting_coa->Export == "print" || $acc_setting_coa->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($acc_setting_coa->Export == "excel") {
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
		global $objForm, $gsSearchError, $Security, $acc_setting_coa;
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
				$acc_setting_coa->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($acc_setting_coa->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($acc_setting_coa->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to inline edit mode
				if ($acc_setting_coa->CurrentAction == "edit")
					$this->InlineEditMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$acc_setting_coa->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if ($acc_setting_coa->CurrentAction == "gridupdate" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit")
						$this->GridUpdate();

					// Inline Update
					if ($acc_setting_coa->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();
				}
			}

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($acc_setting_coa->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $acc_setting_coa->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sTblDefaultFilter = "";
		$sFilter = $sTblDefaultFilter;
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in Session
		$acc_setting_coa->setSessionWhere($sFilter);
		$acc_setting_coa->CurrentFilter = "";

		// Export data only
		if (in_array($acc_setting_coa->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $acc_setting_coa;
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
			$acc_setting_coa->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$acc_setting_coa->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $acc_setting_coa;
		$acc_setting_coa->setKey("id", ""); // Clear inline edit key
		$acc_setting_coa->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Edit Mode
	function GridEditMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridedit"; // Enable grid edit
	}

	// Switch to Inline Edit Mode
	function InlineEditMode() {
		global $Security, $acc_setting_coa;
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$acc_setting_coa->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$acc_setting_coa->setKey("id", $acc_setting_coa->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $acc_setting_coa;
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
				$acc_setting_coa->SendEmail = TRUE; // Send email on update success
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
			$acc_setting_coa->EventCancelled = TRUE; // Cancel event
			$acc_setting_coa->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $acc_setting_coa;

		//CheckInlineEditKey = True
		if (strval($acc_setting_coa->getKey("id")) <> strval($acc_setting_coa->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Perform update to grid
	function GridUpdate() {
		global $conn, $objForm, $gsFormError, $acc_setting_coa;
		$rowindex = 1;
		$bGridUpdate = TRUE;

		// Begin transaction
		$conn->BeginTrans();

		// Get old recordset
		$acc_setting_coa->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $acc_setting_coa->SQL();
		if ($rs = $conn->Execute($sSql)) {
			$rsold = $rs->GetRows();
			$rs->Close();
		}
		$sKey = "";

		// Update row index and get row key
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));

		// Update all rows based on key
		while ($sThisKey <> "") {

			// Load all values & keys
			$this->LoadFormValues(); // Get form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$bGridUpdate = FALSE; // Form error, reset action
				$this->setMessage($gsFormError);
			} else {
				if ($this->SetupKeyValues($sThisKey)) { // Set up key values
					$acc_setting_coa->SendEmail = FALSE; // Do not send email on update success
					$bGridUpdate = $this->EditRow(); // Update this row
				} else {
					$bGridUpdate = FALSE; // update failed
				}
			}
			if ($bGridUpdate) {
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			} else {
				break;
			}

			// Update row index and get row key
			$rowindex++; // next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue("k_key"));
		}
		if ($bGridUpdate) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->setMessage("Update succeeded"); // Set update success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			if ($this->getMessage() == "")
				$this->setMessage("Update failed"); // Set update failed message
			$acc_setting_coa->EventCancelled = TRUE; // Set event cancelled
			$acc_setting_coa->CurrentAction = "gridedit"; // Stay in gridedit mode
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $acc_setting_coa;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $acc_setting_coa->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue("k_key"));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		global $acc_setting_coa;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$acc_setting_coa->id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($acc_setting_coa->id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $acc_setting_coa;

		// Get row based on current index
		$objForm->Index = $idx;
		if ($acc_setting_coa->CurrentAction == "gridadd")
			$this->LoadFormValues(); // Load form values
		if ($acc_setting_coa->CurrentAction == "gridedit") {
			$sKey = strval($objForm->GetValue("k_key"));
			$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $sKey);
			if (count($arrKeyFlds) >= 1) {
				if (strval($arrKeyFlds[0]) == strval($acc_setting_coa->id->CurrentValue)) {
					$this->LoadFormValues(); // Load form values
				}
			}
		}
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $acc_setting_coa;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$acc_setting_coa->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$acc_setting_coa->CurrentOrderType = @$_GET["ordertype"];
			$acc_setting_coa->UpdateSort($acc_setting_coa->id); // Field 
			$acc_setting_coa->UpdateSort($acc_setting_coa->description); // Field 
			$acc_setting_coa->UpdateSort($acc_setting_coa->coa); // Field 
			$acc_setting_coa->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $acc_setting_coa;
		$sOrderBy = $acc_setting_coa->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($acc_setting_coa->SqlOrderBy() <> "") {
				$sOrderBy = $acc_setting_coa->SqlOrderBy();
				$acc_setting_coa->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $acc_setting_coa;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$acc_setting_coa->setSessionOrderBy($sOrderBy);
				$acc_setting_coa->id->setSort("");
				$acc_setting_coa->description->setSort("");
				$acc_setting_coa->coa->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$acc_setting_coa->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $acc_setting_coa;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$acc_setting_coa->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$acc_setting_coa->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $acc_setting_coa->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$acc_setting_coa->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$acc_setting_coa->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$acc_setting_coa->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $acc_setting_coa;
		$acc_setting_coa->id->setFormValue($objForm->GetValue("x_id"));
		$acc_setting_coa->description->setFormValue($objForm->GetValue("x_description"));
		$acc_setting_coa->coa->setFormValue($objForm->GetValue("x_coa"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $acc_setting_coa;
		$acc_setting_coa->id->CurrentValue = $acc_setting_coa->id->FormValue;
		$acc_setting_coa->description->CurrentValue = $acc_setting_coa->description->FormValue;
		$acc_setting_coa->coa->CurrentValue = $acc_setting_coa->coa->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $acc_setting_coa;

		// Call Recordset Selecting event
		$acc_setting_coa->Recordset_Selecting($acc_setting_coa->CurrentFilter);

		// Load list page SQL
		$sSql = $acc_setting_coa->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$acc_setting_coa->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $acc_setting_coa;
		$sFilter = $acc_setting_coa->KeyFilter();

		// Call Row Selecting event
		$acc_setting_coa->Row_Selecting($sFilter);

		// Load sql based on filter
		$acc_setting_coa->CurrentFilter = $sFilter;
		$sSql = $acc_setting_coa->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$acc_setting_coa->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $acc_setting_coa;
		$acc_setting_coa->id->setDbValue($rs->fields('id'));
		$acc_setting_coa->description->setDbValue($rs->fields('description'));
		$acc_setting_coa->coa->setDbValue($rs->fields('coa'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $acc_setting_coa;

		// Call Row_Rendering event
		$acc_setting_coa->Row_Rendering();

		// Common render codes for all row types
		// id

		$acc_setting_coa->id->CellCssStyle = "white-space: nowrap;";
		$acc_setting_coa->id->CellCssClass = "";

		// description
		$acc_setting_coa->description->CellCssStyle = "white-space: nowrap;";
		$acc_setting_coa->description->CellCssClass = "";

		// coa
		$acc_setting_coa->coa->CellCssStyle = "white-space: nowrap;";
		$acc_setting_coa->coa->CellCssClass = "";
		if ($acc_setting_coa->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$acc_setting_coa->id->ViewValue = $acc_setting_coa->id->CurrentValue;
			$acc_setting_coa->id->CssStyle = "";
			$acc_setting_coa->id->CssClass = "";
			$acc_setting_coa->id->ViewCustomAttributes = "";

			// description
			$acc_setting_coa->description->ViewValue = $acc_setting_coa->description->CurrentValue;
			$acc_setting_coa->description->CssStyle = "";
			$acc_setting_coa->description->CssClass = "";
			$acc_setting_coa->description->ViewCustomAttributes = "";

			// coa
			if (strval($acc_setting_coa->coa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `coa`, `description` FROM `acc_mst_coa` WHERE `coa` = '" . ew_AdjustSql($acc_setting_coa->coa->CurrentValue) . "'";
				$sSqlWrk .= " AND (" . "`description`<>''" . ")";
				$sSqlWrk .= " ORDER BY `coa` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$acc_setting_coa->coa->ViewValue = $rswrk->fields('coa');
					$acc_setting_coa->coa->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$acc_setting_coa->coa->ViewValue = $acc_setting_coa->coa->CurrentValue;
				}
			} else {
				$acc_setting_coa->coa->ViewValue = NULL;
			}
			$acc_setting_coa->coa->CssStyle = "";
			$acc_setting_coa->coa->CssClass = "";
			$acc_setting_coa->coa->ViewCustomAttributes = "";

			// id
			$acc_setting_coa->id->HrefValue = "";

			// description
			$acc_setting_coa->description->HrefValue = "";

			// coa
			$acc_setting_coa->coa->HrefValue = "";
		} elseif ($acc_setting_coa->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$acc_setting_coa->id->EditCustomAttributes = "";
			$acc_setting_coa->id->EditValue = $acc_setting_coa->id->CurrentValue;
			$acc_setting_coa->id->CssStyle = "";
			$acc_setting_coa->id->CssClass = "";
			$acc_setting_coa->id->ViewCustomAttributes = "";

			// description
			$acc_setting_coa->description->EditCustomAttributes = "readonly";
			$acc_setting_coa->description->EditValue = ew_HtmlEncode($acc_setting_coa->description->CurrentValue);

			// coa
			$acc_setting_coa->coa->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `coa`, `coa`, `description`, '' AS SelectFilterFld FROM `acc_mst_coa`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk = "($sWhereWrk) AND ";
			$sWhereWrk .= "(" . "`description`<>''" . ")";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `coa` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$acc_setting_coa->coa->EditValue = $arwrk;

			// Edit refer script
			// id

			$acc_setting_coa->id->HrefValue = "";

			// description
			$acc_setting_coa->description->HrefValue = "";

			// coa
			$acc_setting_coa->coa->HrefValue = "";
		}

		// Call Row Rendered event
		$acc_setting_coa->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $acc_setting_coa;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($acc_setting_coa->description->FormValue == "") {
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
		global $conn, $Security, $acc_setting_coa;
		$sFilter = $acc_setting_coa->KeyFilter();
		$acc_setting_coa->CurrentFilter = $sFilter;
		$sSql = $acc_setting_coa->SQL();
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
			// Field description

			$acc_setting_coa->description->SetDbValueDef($acc_setting_coa->description->CurrentValue, "");
			$rsnew['description'] =& $acc_setting_coa->description->DbValue;

			// Field coa
			$acc_setting_coa->coa->SetDbValueDef($acc_setting_coa->coa->CurrentValue, "");
			$rsnew['coa'] =& $acc_setting_coa->coa->DbValue;

			// Call Row Updating event
			$bUpdateRow = $acc_setting_coa->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($acc_setting_coa->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($acc_setting_coa->CancelMessage <> "") {
					$this->setMessage($acc_setting_coa->CancelMessage);
					$acc_setting_coa->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$acc_setting_coa->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $acc_setting_coa;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($acc_setting_coa->ExportAll) {
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
		if ($acc_setting_coa->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($acc_setting_coa->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $acc_setting_coa->Export == "csv") {
				$sExportStr = "";
				echo ew_ExportLine($sExportStr, $acc_setting_coa->Export);
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
				$acc_setting_coa->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($acc_setting_coa->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $acc_setting_coa->Export <> "csv") { // Vertical format
					}	else { // Horizontal format
						$sExportStr = "";
						echo ew_ExportLine($sExportStr, $acc_setting_coa->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($acc_setting_coa->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($acc_setting_coa->Export);
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
