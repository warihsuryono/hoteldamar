<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_name_titleinfo.php" ?>
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
$mst_name_title_list = new cmst_name_title_list();
$Page =& $mst_name_title_list;

// Page init processing
$mst_name_title_list->Page_Init();

// Page main processing
$mst_name_title_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($mst_name_title->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var mst_name_title_list = new ew_Page("mst_name_title_list");

// page properties
mst_name_title_list.PageID = "list"; // page ID
var EW_PAGE_ID = mst_name_title_list.PageID; // for backward compatibility

// extend page with ValidateForm function
mst_name_title_list.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_kode"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Kode");
		elm = fobj.elements["x" + infix + "_description"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Description");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
mst_name_title_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_name_title_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_name_title_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($mst_name_title->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($mst_name_title->Export == "" && $mst_name_title->SelectLimit);
	if (!$bSelectLimit)
		$rs = $mst_name_title_list->LoadRecordset();
	$mst_name_title_list->lTotalRecs = ($bSelectLimit) ? $mst_name_title->SelectRecordCount() : $rs->RecordCount();
	$mst_name_title_list->lStartRec = 1;
	if ($mst_name_title_list->lDisplayRecs <= 0) // Display all records
		$mst_name_title_list->lDisplayRecs = $mst_name_title_list->lTotalRecs;
	if (!($mst_name_title->ExportAll && $mst_name_title->Export <> ""))
		$mst_name_title_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $mst_name_title_list->LoadRecordset($mst_name_title_list->lStartRec-1, $mst_name_title_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Master Name Title</b></h3>
<?php if ($mst_name_title->Export == "" && $mst_name_title->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $mst_name_title_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $mst_name_title_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php $mst_name_title_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($mst_name_title->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($mst_name_title->CurrentAction <> "gridadd" && $mst_name_title->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($mst_name_title_list->Pager)) $mst_name_title_list->Pager = new cPrevNextPager($mst_name_title_list->lStartRec, $mst_name_title_list->lDisplayRecs, $mst_name_title_list->lTotalRecs) ?>
<?php if ($mst_name_title_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($mst_name_title_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $mst_name_title_list->PageUrl() ?>start=<?php echo $mst_name_title_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($mst_name_title_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $mst_name_title_list->PageUrl() ?>start=<?php echo $mst_name_title_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $mst_name_title_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($mst_name_title_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $mst_name_title_list->PageUrl() ?>start=<?php echo $mst_name_title_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($mst_name_title_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $mst_name_title_list->PageUrl() ?>start=<?php echo $mst_name_title_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $mst_name_title_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $mst_name_title_list->Pager->FromIndex ?> to <?php echo $mst_name_title_list->Pager->ToIndex ?> of <?php echo $mst_name_title_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($mst_name_title_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($mst_name_title_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="mst_name_title">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($mst_name_title_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($mst_name_title_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($mst_name_title_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($mst_name_title_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($mst_name_title_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($mst_name_title_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $mst_name_title_list->PageUrl() ?>a=add"><img src="images/expand.gif" title="Add" width="16" height="16" border="0"></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fmst_name_titlelist" id="fmst_name_titlelist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="mst_name_title">
<?php if ($mst_name_title_list->lTotalRecs > 0 || $mst_name_title->CurrentAction == "add" || $mst_name_title->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$mst_name_title_list->lOptionCnt = 0;
	$mst_name_title_list->lOptionCnt++; // edit
	$mst_name_title_list->lOptionCnt++; // Delete
	$mst_name_title_list->lOptionCnt += count($mst_name_title_list->ListOptions->Items); // Custom list options
?>
<?php echo $mst_name_title->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($mst_name_title->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php if ($mst_name_title_list->lOptionCnt == 0 && $mst_name_title->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($mst_name_title_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($mst_name_title->kode->Visible) { // kode ?>
	<?php if ($mst_name_title->SortUrl($mst_name_title->kode) == "") { ?>
		<td style="white-space: nowrap;">Kode</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_name_title->SortUrl($mst_name_title->kode) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode</td><td style="width: 10px;"><?php if ($mst_name_title->kode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_name_title->kode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_name_title->description->Visible) { // description ?>
	<?php if ($mst_name_title->SortUrl($mst_name_title->description) == "") { ?>
		<td style="white-space: nowrap;">Description</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_name_title->SortUrl($mst_name_title->description) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Description</td><td style="width: 10px;"><?php if ($mst_name_title->description->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_name_title->description->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
	if ($mst_name_title->CurrentAction == "add" || $mst_name_title->CurrentAction == "copy") {
		$mst_name_title_list->lRowIndex = 1;
		if ($mst_name_title->CurrentAction == "add")
			$mst_name_title_list->LoadDefaultValues();
		if ($mst_name_title->EventCancelled) // Insert failed
			$mst_name_title_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$mst_name_title->CssClass = "ewTableEditRow";
		$mst_name_title->CssStyle = "";
		$mst_name_title->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
		$mst_name_title->RowType = EW_ROWTYPE_ADD;

		// Render row
		$mst_name_title_list->RenderRow();
?>
	<tr<?php echo $mst_name_title->RowAttributes() ?>>
<td colspan="<?php echo $mst_name_title_list->lOptionCnt ?>" align="right"><span class="phpmaker">
<a href="" onclick="if (mst_name_title_list.ValidateForm(document.fmst_name_titlelist)) document.fmst_name_titlelist.submit();return false;"><img src="images/save.gif" title="Insert" width="16" height="16" border="0"></a>&nbsp;<a href="<?php echo $mst_name_title_list->PageUrl() ?>a=cancel"><img src="images/b_drop.png" title="Cancel" width="16" height="16" border="0"></a>
<input type="hidden" name="a_list" id="a_list" value="insert">
</span></td>
	<?php if ($mst_name_title->kode->Visible) { // kode ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $mst_name_title_list->lRowIndex ?>_kode" id="x<?php echo $mst_name_title_list->lRowIndex ?>_kode" size="3" maxlength="3" value="<?php echo $mst_name_title->kode->EditValue ?>"<?php echo $mst_name_title->kode->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($mst_name_title->description->Visible) { // description ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $mst_name_title_list->lRowIndex ?>_description" id="x<?php echo $mst_name_title_list->lRowIndex ?>_description" size="20" maxlength="100" value="<?php echo $mst_name_title->description->EditValue ?>"<?php echo $mst_name_title->description->EditAttributes() ?>>
</td>
	<?php } ?>
	</tr>
<?php
}
?>
<?php
if ($mst_name_title->ExportAll && $mst_name_title->Export <> "") {
	$mst_name_title_list->lStopRec = $mst_name_title_list->lTotalRecs;
} else {
	$mst_name_title_list->lStopRec = $mst_name_title_list->lStartRec + $mst_name_title_list->lDisplayRecs - 1; // Set the last record to display
}
$mst_name_title_list->lRecCount = $mst_name_title_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$mst_name_title->SelectLimit && $mst_name_title_list->lStartRec > 1)
		$rs->Move($mst_name_title_list->lStartRec - 1);
}
$mst_name_title_list->lRowCnt = 0;
$mst_name_title_list->lEditRowCnt = 0;
if ($mst_name_title->CurrentAction == "edit")
	$mst_name_title_list->lRowIndex = 1;
while (($mst_name_title->CurrentAction == "gridadd" || !$rs->EOF) &&
	$mst_name_title_list->lRecCount < $mst_name_title_list->lStopRec) {
	$mst_name_title_list->lRecCount++;
	if (intval($mst_name_title_list->lRecCount) >= intval($mst_name_title_list->lStartRec)) {
		$mst_name_title_list->lRowCnt++;

	// Init row class and style
	$mst_name_title->CssClass = "";
	$mst_name_title->CssStyle = "";
	$mst_name_title->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($mst_name_title->CurrentAction == "gridadd") {
		$mst_name_title_list->LoadDefaultValues(); // Load default values
	} else {
		$mst_name_title_list->LoadRowValues($rs); // Load row values
	}
	$mst_name_title->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($mst_name_title->CurrentAction == "edit") {
		if ($mst_name_title_list->CheckInlineEditKey() && $mst_name_title_list->lEditRowCnt == 0) // Inline edit
			$mst_name_title->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($mst_name_title->RowType == EW_ROWTYPE_EDIT && $mst_name_title->EventCancelled) { // Update failed
		if ($mst_name_title->CurrentAction == "edit")
			$mst_name_title_list->RestoreFormValues(); // Restore form values
	}
	if ($mst_name_title->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$mst_name_title_list->lEditRowCnt++;
		$mst_name_title->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($mst_name_title->RowType == EW_ROWTYPE_ADD || $mst_name_title->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$mst_name_title->CssClass = "ewTableEditRow";

	// Render row
	$mst_name_title_list->RenderRow();
?>
	<tr<?php echo $mst_name_title->RowAttributes() ?>>
<?php if ($mst_name_title->RowType == EW_ROWTYPE_ADD || $mst_name_title->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($mst_name_title->CurrentAction == "edit") { ?>
<td colspan="<?php echo $mst_name_title_list->lOptionCnt ?>" align="right"><span class="phpmaker">
<a href="" onclick="if (mst_name_title_list.ValidateForm(document.fmst_name_titlelist)) document.fmst_name_titlelist.submit();return false;"><img src="images/save.gif" title="Update" width="16" height="16" border="0"></a>&nbsp;<a href="<?php echo $mst_name_title_list->PageUrl() ?>a=cancel"><img src="images/b_drop.png" title="Cancel" width="16" height="16" border="0"></a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php } else { ?>
<?php if ($mst_name_title->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_name_title->InlineEditUrl() ?>"><img src="images/inlineedit.gif" title="Inline Edit" width="16" height="16" border="0"></a>
</span></td>
<?php if ($mst_name_title_list->lOptionCnt == 0 && $mst_name_title->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_name_title->DeleteUrl() ?>"><img src="images/b_drop.png" title="Delete" width="16" height="16" border="0"></a>
</span></td>
<?php

// Custom list options
foreach ($mst_name_title_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	<?php if ($mst_name_title->kode->Visible) { // kode ?>
		<td<?php echo $mst_name_title->kode->CellAttributes() ?>>
<?php if ($mst_name_title->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $mst_name_title->kode->ViewAttributes() ?>><?php echo $mst_name_title->kode->EditValue ?></div><input type="hidden" name="x<?php echo $mst_name_title_list->lRowIndex ?>_kode" id="x<?php echo $mst_name_title_list->lRowIndex ?>_kode" value="<?php echo ew_HtmlEncode($mst_name_title->kode->CurrentValue) ?>">
<?php } ?>
<?php if ($mst_name_title->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $mst_name_title->kode->ViewAttributes() ?>><?php echo $mst_name_title->kode->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($mst_name_title->description->Visible) { // description ?>
		<td<?php echo $mst_name_title->description->CellAttributes() ?>>
<?php if ($mst_name_title->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $mst_name_title_list->lRowIndex ?>_description" id="x<?php echo $mst_name_title_list->lRowIndex ?>_description" size="20" maxlength="100" value="<?php echo $mst_name_title->description->EditValue ?>"<?php echo $mst_name_title->description->EditAttributes() ?>>
<?php } ?>
<?php if ($mst_name_title->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $mst_name_title->description->ViewAttributes() ?>><?php echo $mst_name_title->description->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	</tr>
<?php if ($mst_name_title->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($mst_name_title->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($mst_name_title->CurrentAction == "add" || $mst_name_title->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $mst_name_title_list->lRowIndex ?>">
<?php } ?>
<?php if ($mst_name_title->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $mst_name_title_list->lRowIndex ?>">
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
</td></tr></table>
<?php if ($mst_name_title->Export == "" && $mst_name_title->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(mst_name_title_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($mst_name_title->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$mst_name_title_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_name_title_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'mst_name_title';

	// Page Object Name
	var $PageObjName = 'mst_name_title_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_name_title;
		if ($mst_name_title->UseTokenInUrl) $PageUrl .= "t=" . $mst_name_title->TableVar . "&"; // add page token
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
		global $objForm, $mst_name_title;
		if ($mst_name_title->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_name_title->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_name_title->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_name_title_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_name_title"] = new cmst_name_title();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_name_title', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_name_title;
	$mst_name_title->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $mst_name_title->Export; // Get export parameter, used in header
	$gsExportFile = $mst_name_title->TableVar; // Get export file, used in header
	if ($mst_name_title->Export == "print" || $mst_name_title->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($mst_name_title->Export == "excel") {
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
		global $objForm, $gsSearchError, $Security, $mst_name_title;
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
				$mst_name_title->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($mst_name_title->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline edit mode
				if ($mst_name_title->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($mst_name_title->CurrentAction == "add" || $mst_name_title->CurrentAction == "copy")
					$this->InlineAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$mst_name_title->CurrentAction = $_POST["a_list"]; // Get action

					// Inline Update
					if ($mst_name_title->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($mst_name_title->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();
				}
			}

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($mst_name_title->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $mst_name_title->getRecordsPerPage(); // Restore from Session
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
		$mst_name_title->setSessionWhere($sFilter);
		$mst_name_title->CurrentFilter = "";

		// Export data only
		if (in_array($mst_name_title->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $mst_name_title;
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
			$mst_name_title->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$mst_name_title->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $mst_name_title;
		$mst_name_title->setKey("kode", ""); // Clear inline edit key
		$mst_name_title->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Edit Mode
	function InlineEditMode() {
		global $Security, $mst_name_title;
		$bInlineEdit = TRUE;
		if (@$_GET["kode"] <> "") {
			$mst_name_title->kode->setQueryStringValue($_GET["kode"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$mst_name_title->setKey("kode", $mst_name_title->kode->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $mst_name_title;
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
				$mst_name_title->SendEmail = TRUE; // Send email on update success
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
			$mst_name_title->EventCancelled = TRUE; // Cancel event
			$mst_name_title->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $mst_name_title;

		//CheckInlineEditKey = True
		if (strval($mst_name_title->getKey("kode")) <> strval($mst_name_title->kode->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add Mode
	function InlineAddMode() {
		global $Security, $mst_name_title;
		$mst_name_title->CurrentAction = "add";
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to inline add/copy record
	function InlineInsert() {
		global $objForm, $gsFormError, $mst_name_title;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate Form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$mst_name_title->EventCancelled = TRUE; // Set event cancelled
			$mst_name_title->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$mst_name_title->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage("Add succeeded"); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$mst_name_title->EventCancelled = TRUE; // Set event cancelled
			$mst_name_title->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $mst_name_title;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$mst_name_title->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$mst_name_title->CurrentOrderType = @$_GET["ordertype"];
			$mst_name_title->UpdateSort($mst_name_title->kode); // Field 
			$mst_name_title->UpdateSort($mst_name_title->description); // Field 
			$mst_name_title->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $mst_name_title;
		$sOrderBy = $mst_name_title->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($mst_name_title->SqlOrderBy() <> "") {
				$sOrderBy = $mst_name_title->SqlOrderBy();
				$mst_name_title->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $mst_name_title;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$mst_name_title->setSessionOrderBy($sOrderBy);
				$mst_name_title->kode->setSort("");
				$mst_name_title->description->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$mst_name_title->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $mst_name_title;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$mst_name_title->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$mst_name_title->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $mst_name_title->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$mst_name_title->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$mst_name_title->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$mst_name_title->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $mst_name_title;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $mst_name_title;
		$mst_name_title->kode->setFormValue($objForm->GetValue("x_kode"));
		$mst_name_title->description->setFormValue($objForm->GetValue("x_description"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $mst_name_title;
		$mst_name_title->kode->CurrentValue = $mst_name_title->kode->FormValue;
		$mst_name_title->description->CurrentValue = $mst_name_title->description->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mst_name_title;

		// Call Recordset Selecting event
		$mst_name_title->Recordset_Selecting($mst_name_title->CurrentFilter);

		// Load list page SQL
		$sSql = $mst_name_title->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$mst_name_title->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_name_title;
		$sFilter = $mst_name_title->KeyFilter();

		// Call Row Selecting event
		$mst_name_title->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_name_title->CurrentFilter = $sFilter;
		$sSql = $mst_name_title->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_name_title->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_name_title;
		$mst_name_title->kode->setDbValue($rs->fields('kode'));
		$mst_name_title->description->setDbValue($rs->fields('description'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_name_title;

		// Call Row_Rendering event
		$mst_name_title->Row_Rendering();

		// Common render codes for all row types
		// kode

		$mst_name_title->kode->CellCssStyle = "white-space: nowrap;";
		$mst_name_title->kode->CellCssClass = "";

		// description
		$mst_name_title->description->CellCssStyle = "white-space: nowrap;";
		$mst_name_title->description->CellCssClass = "";
		if ($mst_name_title->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$mst_name_title->kode->ViewValue = $mst_name_title->kode->CurrentValue;
			$mst_name_title->kode->CssStyle = "";
			$mst_name_title->kode->CssClass = "";
			$mst_name_title->kode->ViewCustomAttributes = "";

			// description
			$mst_name_title->description->ViewValue = $mst_name_title->description->CurrentValue;
			$mst_name_title->description->CssStyle = "";
			$mst_name_title->description->CssClass = "";
			$mst_name_title->description->ViewCustomAttributes = "";

			// kode
			$mst_name_title->kode->HrefValue = "";

			// description
			$mst_name_title->description->HrefValue = "";
		} elseif ($mst_name_title->RowType == EW_ROWTYPE_ADD) { // Add row

			// kode
			$mst_name_title->kode->EditCustomAttributes = "";
			$mst_name_title->kode->EditValue = ew_HtmlEncode($mst_name_title->kode->CurrentValue);

			// description
			$mst_name_title->description->EditCustomAttributes = "";
			$mst_name_title->description->EditValue = ew_HtmlEncode($mst_name_title->description->CurrentValue);
		} elseif ($mst_name_title->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// kode
			$mst_name_title->kode->EditCustomAttributes = "";
			$mst_name_title->kode->EditValue = $mst_name_title->kode->CurrentValue;
			$mst_name_title->kode->CssStyle = "";
			$mst_name_title->kode->CssClass = "";
			$mst_name_title->kode->ViewCustomAttributes = "";

			// description
			$mst_name_title->description->EditCustomAttributes = "";
			$mst_name_title->description->EditValue = ew_HtmlEncode($mst_name_title->description->CurrentValue);

			// Edit refer script
			// kode

			$mst_name_title->kode->HrefValue = "";

			// description
			$mst_name_title->description->HrefValue = "";
		}

		// Call Row Rendered event
		$mst_name_title->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $mst_name_title;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($mst_name_title->kode->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Kode";
		}
		if ($mst_name_title->description->FormValue == "") {
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
		global $conn, $Security, $mst_name_title;
		$sFilter = $mst_name_title->KeyFilter();
		$mst_name_title->CurrentFilter = $sFilter;
		$sSql = $mst_name_title->SQL();
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
			// Field description

			$mst_name_title->description->SetDbValueDef($mst_name_title->description->CurrentValue, "");
			$rsnew['description'] =& $mst_name_title->description->DbValue;

			// Call Row Updating event
			$bUpdateRow = $mst_name_title->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($mst_name_title->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($mst_name_title->CancelMessage <> "") {
					$this->setMessage($mst_name_title->CancelMessage);
					$mst_name_title->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$mst_name_title->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $mst_name_title;

		// Check if key value entered
		if ($mst_name_title->kode->CurrentValue == "") {
			$this->setMessage("Invalid key value");
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $mst_name_title->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $mst_name_title->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, "Duplicate primary key: '%f'");
				$this->setMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// Field kode
		$mst_name_title->kode->SetDbValueDef($mst_name_title->kode->CurrentValue, "");
		$rsnew['kode'] =& $mst_name_title->kode->DbValue;

		// Field description
		$mst_name_title->description->SetDbValueDef($mst_name_title->description->CurrentValue, "");
		$rsnew['description'] =& $mst_name_title->description->DbValue;

		// Call Row Inserting event
		$bInsertRow = $mst_name_title->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($mst_name_title->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($mst_name_title->CancelMessage <> "") {
				$this->setMessage($mst_name_title->CancelMessage);
				$mst_name_title->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$mst_name_title->Row_Inserted($rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}
		return $AddRow;
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $mst_name_title;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($mst_name_title->ExportAll) {
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
		if ($mst_name_title->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($mst_name_title->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $mst_name_title->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'kode', $mst_name_title->Export);
				ew_ExportAddValue($sExportStr, 'description', $mst_name_title->Export);
				echo ew_ExportLine($sExportStr, $mst_name_title->Export);
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
				$mst_name_title->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($mst_name_title->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('kode', $mst_name_title->kode->CurrentValue);
					$XmlDoc->AddField('description', $mst_name_title->description->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $mst_name_title->Export <> "csv") { // Vertical format
						echo ew_ExportField('kode', $mst_name_title->kode->ExportValue($mst_name_title->Export, $mst_name_title->ExportOriginalValue), $mst_name_title->Export);
						echo ew_ExportField('description', $mst_name_title->description->ExportValue($mst_name_title->Export, $mst_name_title->ExportOriginalValue), $mst_name_title->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $mst_name_title->kode->ExportValue($mst_name_title->Export, $mst_name_title->ExportOriginalValue), $mst_name_title->Export);
						ew_ExportAddValue($sExportStr, $mst_name_title->description->ExportValue($mst_name_title->Export, $mst_name_title->ExportOriginalValue), $mst_name_title->Export);
						echo ew_ExportLine($sExportStr, $mst_name_title->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($mst_name_title->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($mst_name_title->Export);
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'mst_name_title';

		// Write Audit Trail
		$filePfx = "log";
		$curDate = date("Y/m/d");
		$curTime = date("H:i:s");
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		$action = $typ;
		ew_WriteAuditTrail($filePfx, $curDate, $curTime, $id, $curUser, $action, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $mst_name_title;
		$table = 'mst_name_title';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['kode'];

		// Write Audit Trail
		$filePfx = "log";
		$curDate = date("Y/m/d");
		$curTime = date("H:i:s");
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		$action = "A";
		$oldvalue = "";
		foreach (array_keys($rs) as $fldname) {
			if ($mst_name_title->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore Blob Field
				$newvalue = ($mst_name_title->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) ? "<MEMO>" : $rs[$fldname]; // Memo Field
				ew_WriteAuditTrail($filePfx, $curDate, $curTime, $id, $curUser, $action, $table, $fldname, $key, $oldvalue, $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $mst_name_title;
		$table = 'mst_name_title';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['kode'];

		// Write Audit Trail
		$filePfx = "log";
		$curDate = date("Y/m/d");
		$curTime = date("H:i:s");
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		$action = "U";
		foreach (array_keys($rsnew) as $fldname) {
			if ($mst_name_title->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore Blob Field
				if ($mst_name_title->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime Field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($mst_name_title->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo Field
						$oldvalue = "<MEMO>";
						$newvalue = "<MEMO>";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					ew_WriteAuditTrail($filePfx, $curDate, $curTime, $id, $curUser, $action, $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
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
