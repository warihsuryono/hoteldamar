<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_room_typeinfo.php" ?>
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
$mst_room_type_list = new cmst_room_type_list();
$Page =& $mst_room_type_list;

// Page init processing
$mst_room_type_list->Page_Init();

// Page main processing
$mst_room_type_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($mst_room_type->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var mst_room_type_list = new ew_Page("mst_room_type_list");

// page properties
mst_room_type_list.PageID = "list"; // page ID
var EW_PAGE_ID = mst_room_type_list.PageID; // for backward compatibility

// extend page with ValidateForm function
mst_room_type_list.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
mst_room_type_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_room_type_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_room_type_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($mst_room_type->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($mst_room_type->Export == "" && $mst_room_type->SelectLimit);
	if (!$bSelectLimit)
		$rs = $mst_room_type_list->LoadRecordset();
	$mst_room_type_list->lTotalRecs = ($bSelectLimit) ? $mst_room_type->SelectRecordCount() : $rs->RecordCount();
	$mst_room_type_list->lStartRec = 1;
	if ($mst_room_type_list->lDisplayRecs <= 0) // Display all records
		$mst_room_type_list->lDisplayRecs = $mst_room_type_list->lTotalRecs;
	if (!($mst_room_type->ExportAll && $mst_room_type->Export <> ""))
		$mst_room_type_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $mst_room_type_list->LoadRecordset($mst_room_type_list->lStartRec-1, $mst_room_type_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Master Room Type</b></h3>
<?php if ($mst_room_type->Export == "" && $mst_room_type->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $mst_room_type_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php $mst_room_type_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($mst_room_type->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($mst_room_type->CurrentAction <> "gridadd" && $mst_room_type->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($mst_room_type_list->Pager)) $mst_room_type_list->Pager = new cPrevNextPager($mst_room_type_list->lStartRec, $mst_room_type_list->lDisplayRecs, $mst_room_type_list->lTotalRecs) ?>
<?php if ($mst_room_type_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($mst_room_type_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $mst_room_type_list->PageUrl() ?>start=<?php echo $mst_room_type_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($mst_room_type_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $mst_room_type_list->PageUrl() ?>start=<?php echo $mst_room_type_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $mst_room_type_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($mst_room_type_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $mst_room_type_list->PageUrl() ?>start=<?php echo $mst_room_type_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($mst_room_type_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $mst_room_type_list->PageUrl() ?>start=<?php echo $mst_room_type_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $mst_room_type_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $mst_room_type_list->Pager->FromIndex ?> to <?php echo $mst_room_type_list->Pager->ToIndex ?> of <?php echo $mst_room_type_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($mst_room_type_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($mst_room_type_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="mst_room_type">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($mst_room_type_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($mst_room_type_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($mst_room_type_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($mst_room_type_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($mst_room_type_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($mst_room_type_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $mst_room_type_list->PageUrl() ?>a=add"><img src="images/expand.gif" title="Add" width="16" height="16" border="0"></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fmst_room_typelist" id="fmst_room_typelist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="mst_room_type">
<?php if ($mst_room_type_list->lTotalRecs > 0 || $mst_room_type->CurrentAction == "add" || $mst_room_type->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$mst_room_type_list->lOptionCnt = 0;
	$mst_room_type_list->lOptionCnt++; // view
	$mst_room_type_list->lOptionCnt++; // edit
	$mst_room_type_list->lOptionCnt++; // Delete
	$mst_room_type_list->lOptionCnt += count($mst_room_type_list->ListOptions->Items); // Custom list options
?>
<?php echo $mst_room_type->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($mst_room_type->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<?php if ($mst_room_type_list->lOptionCnt == 0 && $mst_room_type->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($mst_room_type_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($mst_room_type->id->Visible) { // id ?>
	<?php if ($mst_room_type->SortUrl($mst_room_type->id) == "") { ?>
		<td style="white-space: nowrap;">Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_room_type->SortUrl($mst_room_type->id) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id</td><td style="width: 10px;"><?php if ($mst_room_type->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_room_type->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_room_type->description->Visible) { // description ?>
	<?php if ($mst_room_type->SortUrl($mst_room_type->description) == "") { ?>
		<td style="white-space: nowrap;">Description</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_room_type->SortUrl($mst_room_type->description) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Description</td><td style="width: 10px;"><?php if ($mst_room_type->description->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_room_type->description->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
	if ($mst_room_type->CurrentAction == "add" || $mst_room_type->CurrentAction == "copy") {
		$mst_room_type_list->lRowIndex = 1;
		if ($mst_room_type->CurrentAction == "add")
			$mst_room_type_list->LoadDefaultValues();
		if ($mst_room_type->EventCancelled) // Insert failed
			$mst_room_type_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$mst_room_type->CssClass = "ewTableEditRow";
		$mst_room_type->CssStyle = "";
		$mst_room_type->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
		$mst_room_type->RowType = EW_ROWTYPE_ADD;

		// Render row
		$mst_room_type_list->RenderRow();
?>
	<tr<?php echo $mst_room_type->RowAttributes() ?>>
<td colspan="<?php echo $mst_room_type_list->lOptionCnt ?>" align="right"><span class="phpmaker">
<a href="" onclick="if (mst_room_type_list.ValidateForm(document.fmst_room_typelist)) document.fmst_room_typelist.submit();return false;"><img src="images/save.gif" title="Insert" width="16" height="16" border="0"></a>&nbsp;<a href="<?php echo $mst_room_type_list->PageUrl() ?>a=cancel"><img src="images/b_drop.png" title="Cancel" width="16" height="16" border="0"></a>
<input type="hidden" name="a_list" id="a_list" value="insert">
</span></td>
	<?php if ($mst_room_type->id->Visible) { // id ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $mst_room_type_list->lRowIndex ?>_id" id="x<?php echo $mst_room_type_list->lRowIndex ?>_id" size="3" maxlength="3" value="<?php echo $mst_room_type->id->EditValue ?>"<?php echo $mst_room_type->id->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($mst_room_type->description->Visible) { // description ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $mst_room_type_list->lRowIndex ?>_description" id="x<?php echo $mst_room_type_list->lRowIndex ?>_description" size="50" maxlength="50" value="<?php echo $mst_room_type->description->EditValue ?>"<?php echo $mst_room_type->description->EditAttributes() ?>>
</td>
	<?php } ?>
	</tr>
<?php
}
?>
<?php
if ($mst_room_type->ExportAll && $mst_room_type->Export <> "") {
	$mst_room_type_list->lStopRec = $mst_room_type_list->lTotalRecs;
} else {
	$mst_room_type_list->lStopRec = $mst_room_type_list->lStartRec + $mst_room_type_list->lDisplayRecs - 1; // Set the last record to display
}
$mst_room_type_list->lRecCount = $mst_room_type_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$mst_room_type->SelectLimit && $mst_room_type_list->lStartRec > 1)
		$rs->Move($mst_room_type_list->lStartRec - 1);
}
$mst_room_type_list->lRowCnt = 0;
$mst_room_type_list->lEditRowCnt = 0;
if ($mst_room_type->CurrentAction == "edit")
	$mst_room_type_list->lRowIndex = 1;
while (($mst_room_type->CurrentAction == "gridadd" || !$rs->EOF) &&
	$mst_room_type_list->lRecCount < $mst_room_type_list->lStopRec) {
	$mst_room_type_list->lRecCount++;
	if (intval($mst_room_type_list->lRecCount) >= intval($mst_room_type_list->lStartRec)) {
		$mst_room_type_list->lRowCnt++;

	// Init row class and style
	$mst_room_type->CssClass = "";
	$mst_room_type->CssStyle = "";
	$mst_room_type->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($mst_room_type->CurrentAction == "gridadd") {
		$mst_room_type_list->LoadDefaultValues(); // Load default values
	} else {
		$mst_room_type_list->LoadRowValues($rs); // Load row values
	}
	$mst_room_type->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($mst_room_type->CurrentAction == "edit") {
		if ($mst_room_type_list->CheckInlineEditKey() && $mst_room_type_list->lEditRowCnt == 0) // Inline edit
			$mst_room_type->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($mst_room_type->RowType == EW_ROWTYPE_EDIT && $mst_room_type->EventCancelled) { // Update failed
		if ($mst_room_type->CurrentAction == "edit")
			$mst_room_type_list->RestoreFormValues(); // Restore form values
	}
	if ($mst_room_type->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$mst_room_type_list->lEditRowCnt++;
		$mst_room_type->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($mst_room_type->RowType == EW_ROWTYPE_ADD || $mst_room_type->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$mst_room_type->CssClass = "ewTableEditRow";

	// Render row
	$mst_room_type_list->RenderRow();
?>
	<tr<?php echo $mst_room_type->RowAttributes() ?>>
<?php if ($mst_room_type->RowType == EW_ROWTYPE_ADD || $mst_room_type->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($mst_room_type->CurrentAction == "edit") { ?>
<td colspan="<?php echo $mst_room_type_list->lOptionCnt ?>" align="right"><span class="phpmaker">
<a href="" onclick="if (mst_room_type_list.ValidateForm(document.fmst_room_typelist)) document.fmst_room_typelist.submit();return false;"><img src="images/save.gif" title="Update" width="16" height="16" border="0"></a>&nbsp;<a href="<?php echo $mst_room_type_list->PageUrl() ?>a=cancel"><img src="images/b_drop.png" title="Cancel" width="16" height="16" border="0"></a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php } else { ?>
<?php if ($mst_room_type->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_room_type->ViewUrl() ?>"><img src="images/view.gif" title="Detail" width="16" height="16" border="0"></a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_room_type->InlineEditUrl() ?>"><img src="images/inlineedit.gif" title="Inline Edit" width="16" height="16" border="0"></a>
</span></td>
<?php if ($mst_room_type_list->lOptionCnt == 0 && $mst_room_type->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_room_type->DeleteUrl() ?>"><img src="images/b_drop.png" title="Delete" width="16" height="16" border="0"></a>
</span></td>
<?php

// Custom list options
foreach ($mst_room_type_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	<?php if ($mst_room_type->id->Visible) { // id ?>
		<td<?php echo $mst_room_type->id->CellAttributes() ?>>
<?php if ($mst_room_type->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $mst_room_type->id->ViewAttributes() ?>><?php echo $mst_room_type->id->EditValue ?></div><input type="hidden" name="x<?php echo $mst_room_type_list->lRowIndex ?>_id" id="x<?php echo $mst_room_type_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($mst_room_type->id->CurrentValue) ?>">
<?php } ?>
<?php if ($mst_room_type->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $mst_room_type->id->ViewAttributes() ?>><?php echo $mst_room_type->id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($mst_room_type->description->Visible) { // description ?>
		<td<?php echo $mst_room_type->description->CellAttributes() ?>>
<?php if ($mst_room_type->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $mst_room_type_list->lRowIndex ?>_description" id="x<?php echo $mst_room_type_list->lRowIndex ?>_description" size="50" maxlength="50" value="<?php echo $mst_room_type->description->EditValue ?>"<?php echo $mst_room_type->description->EditAttributes() ?>>
<?php } ?>
<?php if ($mst_room_type->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $mst_room_type->description->ViewAttributes() ?>><?php echo $mst_room_type->description->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	</tr>
<?php if ($mst_room_type->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($mst_room_type->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($mst_room_type->CurrentAction == "add" || $mst_room_type->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $mst_room_type_list->lRowIndex ?>">
<?php } ?>
<?php if ($mst_room_type->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $mst_room_type_list->lRowIndex ?>">
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
</td></tr></table>
<?php if ($mst_room_type->Export == "" && $mst_room_type->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(mst_room_type_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($mst_room_type->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$mst_room_type_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_room_type_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'mst_room_type';

	// Page Object Name
	var $PageObjName = 'mst_room_type_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_room_type;
		if ($mst_room_type->UseTokenInUrl) $PageUrl .= "t=" . $mst_room_type->TableVar . "&"; // add page token
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
		global $objForm, $mst_room_type;
		if ($mst_room_type->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_room_type->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_room_type->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_room_type_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_room_type"] = new cmst_room_type();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_room_type', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_room_type;
	$mst_room_type->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $mst_room_type->Export; // Get export parameter, used in header
	$gsExportFile = $mst_room_type->TableVar; // Get export file, used in header
	if ($mst_room_type->Export == "print" || $mst_room_type->Export == "html") {

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
		global $objForm, $gsSearchError, $Security, $mst_room_type;
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
				$mst_room_type->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($mst_room_type->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline edit mode
				if ($mst_room_type->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($mst_room_type->CurrentAction == "add" || $mst_room_type->CurrentAction == "copy")
					$this->InlineAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$mst_room_type->CurrentAction = $_POST["a_list"]; // Get action

					// Inline Update
					if ($mst_room_type->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($mst_room_type->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();
				}
			}

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($mst_room_type->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $mst_room_type->getRecordsPerPage(); // Restore from Session
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
		$mst_room_type->setSessionWhere($sFilter);
		$mst_room_type->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $mst_room_type;
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
			$mst_room_type->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$mst_room_type->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $mst_room_type;
		$mst_room_type->setKey("id", ""); // Clear inline edit key
		$mst_room_type->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Edit Mode
	function InlineEditMode() {
		global $Security, $mst_room_type;
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$mst_room_type->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$mst_room_type->setKey("id", $mst_room_type->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $mst_room_type;
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
				$mst_room_type->SendEmail = TRUE; // Send email on update success
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
			$mst_room_type->EventCancelled = TRUE; // Cancel event
			$mst_room_type->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $mst_room_type;

		//CheckInlineEditKey = True
		if (strval($mst_room_type->getKey("id")) <> strval($mst_room_type->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add Mode
	function InlineAddMode() {
		global $Security, $mst_room_type;
		$mst_room_type->CurrentAction = "add";
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to inline add/copy record
	function InlineInsert() {
		global $objForm, $gsFormError, $mst_room_type;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate Form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$mst_room_type->EventCancelled = TRUE; // Set event cancelled
			$mst_room_type->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$mst_room_type->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage("Add succeeded"); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$mst_room_type->EventCancelled = TRUE; // Set event cancelled
			$mst_room_type->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $mst_room_type;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$mst_room_type->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$mst_room_type->CurrentOrderType = @$_GET["ordertype"];
			$mst_room_type->UpdateSort($mst_room_type->id); // Field 
			$mst_room_type->UpdateSort($mst_room_type->description); // Field 
			$mst_room_type->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $mst_room_type;
		$sOrderBy = $mst_room_type->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($mst_room_type->SqlOrderBy() <> "") {
				$sOrderBy = $mst_room_type->SqlOrderBy();
				$mst_room_type->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $mst_room_type;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$mst_room_type->setSessionOrderBy($sOrderBy);
				$mst_room_type->id->setSort("");
				$mst_room_type->description->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$mst_room_type->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $mst_room_type;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$mst_room_type->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$mst_room_type->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $mst_room_type->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$mst_room_type->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$mst_room_type->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$mst_room_type->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $mst_room_type;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $mst_room_type;
		$mst_room_type->id->setFormValue($objForm->GetValue("x_id"));
		$mst_room_type->description->setFormValue($objForm->GetValue("x_description"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $mst_room_type;
		$mst_room_type->id->CurrentValue = $mst_room_type->id->FormValue;
		$mst_room_type->description->CurrentValue = $mst_room_type->description->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mst_room_type;

		// Call Recordset Selecting event
		$mst_room_type->Recordset_Selecting($mst_room_type->CurrentFilter);

		// Load list page SQL
		$sSql = $mst_room_type->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$mst_room_type->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_room_type;
		$sFilter = $mst_room_type->KeyFilter();

		// Call Row Selecting event
		$mst_room_type->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_room_type->CurrentFilter = $sFilter;
		$sSql = $mst_room_type->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_room_type->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_room_type;
		$mst_room_type->id->setDbValue($rs->fields('id'));
		$mst_room_type->description->setDbValue($rs->fields('description'));
		$mst_room_type->xtimestamp->setDbValue($rs->fields('xtimestamp'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_room_type;

		// Call Row_Rendering event
		$mst_room_type->Row_Rendering();

		// Common render codes for all row types
		// id

		$mst_room_type->id->CellCssStyle = "white-space: nowrap;";
		$mst_room_type->id->CellCssClass = "";

		// description
		$mst_room_type->description->CellCssStyle = "white-space: nowrap;";
		$mst_room_type->description->CellCssClass = "";
		if ($mst_room_type->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$mst_room_type->id->ViewValue = $mst_room_type->id->CurrentValue;
			$mst_room_type->id->CssStyle = "";
			$mst_room_type->id->CssClass = "";
			$mst_room_type->id->ViewCustomAttributes = "";

			// description
			$mst_room_type->description->ViewValue = $mst_room_type->description->CurrentValue;
			$mst_room_type->description->CssStyle = "";
			$mst_room_type->description->CssClass = "";
			$mst_room_type->description->ViewCustomAttributes = "";

			// id
			$mst_room_type->id->HrefValue = "";

			// description
			$mst_room_type->description->HrefValue = "";
		} elseif ($mst_room_type->RowType == EW_ROWTYPE_ADD) { // Add row

			// id
			$mst_room_type->id->EditCustomAttributes = "";
			$mst_room_type->id->EditValue = ew_HtmlEncode($mst_room_type->id->CurrentValue);

			// description
			$mst_room_type->description->EditCustomAttributes = "";
			$mst_room_type->description->EditValue = ew_HtmlEncode($mst_room_type->description->CurrentValue);
		} elseif ($mst_room_type->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$mst_room_type->id->EditCustomAttributes = "";
			$mst_room_type->id->EditValue = $mst_room_type->id->CurrentValue;
			$mst_room_type->id->CssStyle = "";
			$mst_room_type->id->CssClass = "";
			$mst_room_type->id->ViewCustomAttributes = "";

			// description
			$mst_room_type->description->EditCustomAttributes = "";
			$mst_room_type->description->EditValue = ew_HtmlEncode($mst_room_type->description->CurrentValue);

			// Edit refer script
			// id

			$mst_room_type->id->HrefValue = "";

			// description
			$mst_room_type->description->HrefValue = "";
		}

		// Call Row Rendered event
		$mst_room_type->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $mst_room_type;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");

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
		global $conn, $Security, $mst_room_type;
		$sFilter = $mst_room_type->KeyFilter();
		$mst_room_type->CurrentFilter = $sFilter;
		$sSql = $mst_room_type->SQL();
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

			$mst_room_type->description->SetDbValueDef($mst_room_type->description->CurrentValue, "");
			$rsnew['description'] =& $mst_room_type->description->DbValue;

			// Call Row Updating event
			$bUpdateRow = $mst_room_type->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($mst_room_type->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($mst_room_type->CancelMessage <> "") {
					$this->setMessage($mst_room_type->CancelMessage);
					$mst_room_type->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$mst_room_type->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $mst_room_type;

		// Check if key value entered
		if ($mst_room_type->id->CurrentValue == "") {
			$this->setMessage("Invalid key value");
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $mst_room_type->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $mst_room_type->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, "Duplicate primary key: '%f'");
				$this->setMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// Field id
		$mst_room_type->id->SetDbValueDef($mst_room_type->id->CurrentValue, "");
		$rsnew['id'] =& $mst_room_type->id->DbValue;

		// Field description
		$mst_room_type->description->SetDbValueDef($mst_room_type->description->CurrentValue, "");
		$rsnew['description'] =& $mst_room_type->description->DbValue;

		// Call Row Inserting event
		$bInsertRow = $mst_room_type->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($mst_room_type->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($mst_room_type->CancelMessage <> "") {
				$this->setMessage($mst_room_type->CancelMessage);
				$mst_room_type->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$mst_room_type->Row_Inserted($rsnew);
		}
		return $AddRow;
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
