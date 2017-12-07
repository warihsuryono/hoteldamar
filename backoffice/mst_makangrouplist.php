<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_makangroupinfo.php" ?>
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
$mst_makangroup_list = new cmst_makangroup_list();
$Page =& $mst_makangroup_list;

// Page init processing
$mst_makangroup_list->Page_Init();

// Page main processing
$mst_makangroup_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($mst_makangroup->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var mst_makangroup_list = new ew_Page("mst_makangroup_list");

// page properties
mst_makangroup_list.PageID = "list"; // page ID
var EW_PAGE_ID = mst_makangroup_list.PageID; // for backward compatibility

// extend page with ValidateForm function
mst_makangroup_list.ValidateForm = function(fobj) {
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
		elm = fobj.elements["x" + infix + "_price"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Price");
		elm = fobj.elements["x" + infix + "_price"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Incorrect floating point number - Price");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
mst_makangroup_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_makangroup_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_makangroup_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($mst_makangroup->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($mst_makangroup->Export == "" && $mst_makangroup->SelectLimit);
	if (!$bSelectLimit)
		$rs = $mst_makangroup_list->LoadRecordset();
	$mst_makangroup_list->lTotalRecs = ($bSelectLimit) ? $mst_makangroup->SelectRecordCount() : $rs->RecordCount();
	$mst_makangroup_list->lStartRec = 1;
	if ($mst_makangroup_list->lDisplayRecs <= 0) // Display all records
		$mst_makangroup_list->lDisplayRecs = $mst_makangroup_list->lTotalRecs;
	if (!($mst_makangroup->ExportAll && $mst_makangroup->Export <> ""))
		$mst_makangroup_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $mst_makangroup_list->LoadRecordset($mst_makangroup_list->lStartRec-1, $mst_makangroup_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Master Foods Package/Group</b></h3>
<?php if ($mst_makangroup->Export == "" && $mst_makangroup->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $mst_makangroup_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $mst_makangroup_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php $mst_makangroup_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($mst_makangroup->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($mst_makangroup->CurrentAction <> "gridadd" && $mst_makangroup->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($mst_makangroup_list->Pager)) $mst_makangroup_list->Pager = new cPrevNextPager($mst_makangroup_list->lStartRec, $mst_makangroup_list->lDisplayRecs, $mst_makangroup_list->lTotalRecs) ?>
<?php if ($mst_makangroup_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($mst_makangroup_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $mst_makangroup_list->PageUrl() ?>start=<?php echo $mst_makangroup_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($mst_makangroup_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $mst_makangroup_list->PageUrl() ?>start=<?php echo $mst_makangroup_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $mst_makangroup_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($mst_makangroup_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $mst_makangroup_list->PageUrl() ?>start=<?php echo $mst_makangroup_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($mst_makangroup_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $mst_makangroup_list->PageUrl() ?>start=<?php echo $mst_makangroup_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $mst_makangroup_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $mst_makangroup_list->Pager->FromIndex ?> to <?php echo $mst_makangroup_list->Pager->ToIndex ?> of <?php echo $mst_makangroup_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($mst_makangroup_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($mst_makangroup_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="mst_makangroup">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($mst_makangroup_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($mst_makangroup_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($mst_makangroup_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($mst_makangroup_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($mst_makangroup_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($mst_makangroup_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fmst_makangrouplist" id="fmst_makangrouplist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="mst_makangroup">
<?php if ($mst_makangroup_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$mst_makangroup_list->lOptionCnt = 0;
	$mst_makangroup_list->lOptionCnt++; // edit
	$mst_makangroup_list->lOptionCnt += count($mst_makangroup_list->ListOptions->Items); // Custom list options
?>
<?php echo $mst_makangroup->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($mst_makangroup->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($mst_makangroup_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($mst_makangroup->id->Visible) { // id ?>
	<?php if ($mst_makangroup->SortUrl($mst_makangroup->id) == "") { ?>
		<td>Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_makangroup->SortUrl($mst_makangroup->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id</td><td style="width: 10px;"><?php if ($mst_makangroup->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_makangroup->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_makangroup->description->Visible) { // description ?>
	<?php if ($mst_makangroup->SortUrl($mst_makangroup->description) == "") { ?>
		<td>Description</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_makangroup->SortUrl($mst_makangroup->description) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Description</td><td style="width: 10px;"><?php if ($mst_makangroup->description->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_makangroup->description->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_makangroup->price->Visible) { // price ?>
	<?php if ($mst_makangroup->SortUrl($mst_makangroup->price) == "") { ?>
		<td>Price</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_makangroup->SortUrl($mst_makangroup->price) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Price</td><td style="width: 10px;"><?php if ($mst_makangroup->price->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_makangroup->price->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($mst_makangroup->ExportAll && $mst_makangroup->Export <> "") {
	$mst_makangroup_list->lStopRec = $mst_makangroup_list->lTotalRecs;
} else {
	$mst_makangroup_list->lStopRec = $mst_makangroup_list->lStartRec + $mst_makangroup_list->lDisplayRecs - 1; // Set the last record to display
}
$mst_makangroup_list->lRecCount = $mst_makangroup_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$mst_makangroup->SelectLimit && $mst_makangroup_list->lStartRec > 1)
		$rs->Move($mst_makangroup_list->lStartRec - 1);
}
$mst_makangroup_list->lRowCnt = 0;
$mst_makangroup_list->lEditRowCnt = 0;
if ($mst_makangroup->CurrentAction == "edit")
	$mst_makangroup_list->lRowIndex = 1;
while (($mst_makangroup->CurrentAction == "gridadd" || !$rs->EOF) &&
	$mst_makangroup_list->lRecCount < $mst_makangroup_list->lStopRec) {
	$mst_makangroup_list->lRecCount++;
	if (intval($mst_makangroup_list->lRecCount) >= intval($mst_makangroup_list->lStartRec)) {
		$mst_makangroup_list->lRowCnt++;

	// Init row class and style
	$mst_makangroup->CssClass = "";
	$mst_makangroup->CssStyle = "";
	$mst_makangroup->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($mst_makangroup->CurrentAction == "gridadd") {
		$mst_makangroup_list->LoadDefaultValues(); // Load default values
	} else {
		$mst_makangroup_list->LoadRowValues($rs); // Load row values
	}
	$mst_makangroup->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($mst_makangroup->CurrentAction == "edit") {
		if ($mst_makangroup_list->CheckInlineEditKey() && $mst_makangroup_list->lEditRowCnt == 0) // Inline edit
			$mst_makangroup->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($mst_makangroup->RowType == EW_ROWTYPE_EDIT && $mst_makangroup->EventCancelled) { // Update failed
		if ($mst_makangroup->CurrentAction == "edit")
			$mst_makangroup_list->RestoreFormValues(); // Restore form values
	}
	if ($mst_makangroup->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$mst_makangroup_list->lEditRowCnt++;
		$mst_makangroup->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($mst_makangroup->RowType == EW_ROWTYPE_ADD || $mst_makangroup->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$mst_makangroup->CssClass = "ewTableEditRow";

	// Render row
	$mst_makangroup_list->RenderRow();
?>
	<tr<?php echo $mst_makangroup->RowAttributes() ?>>
<?php if ($mst_makangroup->RowType == EW_ROWTYPE_ADD || $mst_makangroup->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($mst_makangroup->CurrentAction == "edit") { ?>
<td colspan="<?php echo $mst_makangroup_list->lOptionCnt ?>" align="right"><span class="phpmaker">
<a href="" onclick="if (mst_makangroup_list.ValidateForm(document.fmst_makangrouplist)) document.fmst_makangrouplist.submit();return false;"><img src="images/save.gif" title="Update" width="16" height="16" border="0"></a>&nbsp;<a href="<?php echo $mst_makangroup_list->PageUrl() ?>a=cancel"><img src="images/b_drop.png" title="Cancel" width="16" height="16" border="0"></a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php } else { ?>
<?php if ($mst_makangroup->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_makangroup->InlineEditUrl() ?>"><img src="images/inlineedit.gif" title="Inline Edit" width="16" height="16" border="0"></a>
</span></td>
<?php

// Custom list options
foreach ($mst_makangroup_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	<?php if ($mst_makangroup->id->Visible) { // id ?>
		<td<?php echo $mst_makangroup->id->CellAttributes() ?>>
<?php if ($mst_makangroup->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $mst_makangroup->id->ViewAttributes() ?>><?php echo $mst_makangroup->id->EditValue ?></div><input type="hidden" name="x<?php echo $mst_makangroup_list->lRowIndex ?>_id" id="x<?php echo $mst_makangroup_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($mst_makangroup->id->CurrentValue) ?>">
<?php } ?>
<?php if ($mst_makangroup->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $mst_makangroup->id->ViewAttributes() ?>><?php echo $mst_makangroup->id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($mst_makangroup->description->Visible) { // description ?>
		<td<?php echo $mst_makangroup->description->CellAttributes() ?>>
<?php if ($mst_makangroup->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $mst_makangroup_list->lRowIndex ?>_description" id="x<?php echo $mst_makangroup_list->lRowIndex ?>_description" size="30" maxlength="20" value="<?php echo $mst_makangroup->description->EditValue ?>"<?php echo $mst_makangroup->description->EditAttributes() ?>>
<?php } ?>
<?php if ($mst_makangroup->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $mst_makangroup->description->ViewAttributes() ?>><?php echo $mst_makangroup->description->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($mst_makangroup->price->Visible) { // price ?>
		<td<?php echo $mst_makangroup->price->CellAttributes() ?>>
<?php if ($mst_makangroup->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $mst_makangroup_list->lRowIndex ?>_price" id="x<?php echo $mst_makangroup_list->lRowIndex ?>_price" size="30" value="<?php echo $mst_makangroup->price->EditValue ?>"<?php echo $mst_makangroup->price->EditAttributes() ?>>
<?php } ?>
<?php if ($mst_makangroup->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $mst_makangroup->price->ViewAttributes() ?>><?php echo $mst_makangroup->price->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	</tr>
<?php if ($mst_makangroup->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($mst_makangroup->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($mst_makangroup->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $mst_makangroup_list->lRowIndex ?>">
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
</td></tr></table>
<?php if ($mst_makangroup->Export == "" && $mst_makangroup->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(mst_makangroup_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($mst_makangroup->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$mst_makangroup_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_makangroup_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'mst_makangroup';

	// Page Object Name
	var $PageObjName = 'mst_makangroup_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_makangroup;
		if ($mst_makangroup->UseTokenInUrl) $PageUrl .= "t=" . $mst_makangroup->TableVar . "&"; // add page token
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
		global $objForm, $mst_makangroup;
		if ($mst_makangroup->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_makangroup->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_makangroup->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_makangroup_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_makangroup"] = new cmst_makangroup();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_makangroup', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_makangroup;
	$mst_makangroup->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $mst_makangroup->Export; // Get export parameter, used in header
	$gsExportFile = $mst_makangroup->TableVar; // Get export file, used in header
	if ($mst_makangroup->Export == "print" || $mst_makangroup->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($mst_makangroup->Export == "excel") {
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
		global $objForm, $gsSearchError, $Security, $mst_makangroup;
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
				$mst_makangroup->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($mst_makangroup->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline edit mode
				if ($mst_makangroup->CurrentAction == "edit")
					$this->InlineEditMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$mst_makangroup->CurrentAction = $_POST["a_list"]; // Get action

					// Inline Update
					if ($mst_makangroup->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();
				}
			}

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($mst_makangroup->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $mst_makangroup->getRecordsPerPage(); // Restore from Session
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
		$mst_makangroup->setSessionWhere($sFilter);
		$mst_makangroup->CurrentFilter = "";

		// Export data only
		if (in_array($mst_makangroup->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $mst_makangroup;
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
			$mst_makangroup->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$mst_makangroup->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $mst_makangroup;
		$mst_makangroup->setKey("id", ""); // Clear inline edit key
		$mst_makangroup->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Edit Mode
	function InlineEditMode() {
		global $Security, $mst_makangroup;
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$mst_makangroup->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$mst_makangroup->setKey("id", $mst_makangroup->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $mst_makangroup;
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
				$mst_makangroup->SendEmail = TRUE; // Send email on update success
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
			$mst_makangroup->EventCancelled = TRUE; // Cancel event
			$mst_makangroup->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $mst_makangroup;

		//CheckInlineEditKey = True
		if (strval($mst_makangroup->getKey("id")) <> strval($mst_makangroup->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $mst_makangroup;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$mst_makangroup->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$mst_makangroup->CurrentOrderType = @$_GET["ordertype"];
			$mst_makangroup->UpdateSort($mst_makangroup->id); // Field 
			$mst_makangroup->UpdateSort($mst_makangroup->description); // Field 
			$mst_makangroup->UpdateSort($mst_makangroup->price); // Field 
			$mst_makangroup->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $mst_makangroup;
		$sOrderBy = $mst_makangroup->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($mst_makangroup->SqlOrderBy() <> "") {
				$sOrderBy = $mst_makangroup->SqlOrderBy();
				$mst_makangroup->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $mst_makangroup;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$mst_makangroup->setSessionOrderBy($sOrderBy);
				$mst_makangroup->id->setSort("");
				$mst_makangroup->description->setSort("");
				$mst_makangroup->price->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$mst_makangroup->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $mst_makangroup;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$mst_makangroup->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$mst_makangroup->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $mst_makangroup->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$mst_makangroup->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$mst_makangroup->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$mst_makangroup->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $mst_makangroup;
		$mst_makangroup->id->setFormValue($objForm->GetValue("x_id"));
		$mst_makangroup->description->setFormValue($objForm->GetValue("x_description"));
		$mst_makangroup->price->setFormValue($objForm->GetValue("x_price"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $mst_makangroup;
		$mst_makangroup->id->CurrentValue = $mst_makangroup->id->FormValue;
		$mst_makangroup->description->CurrentValue = $mst_makangroup->description->FormValue;
		$mst_makangroup->price->CurrentValue = $mst_makangroup->price->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mst_makangroup;

		// Call Recordset Selecting event
		$mst_makangroup->Recordset_Selecting($mst_makangroup->CurrentFilter);

		// Load list page SQL
		$sSql = $mst_makangroup->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$mst_makangroup->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_makangroup;
		$sFilter = $mst_makangroup->KeyFilter();

		// Call Row Selecting event
		$mst_makangroup->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_makangroup->CurrentFilter = $sFilter;
		$sSql = $mst_makangroup->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_makangroup->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_makangroup;
		$mst_makangroup->id->setDbValue($rs->fields('id'));
		$mst_makangroup->description->setDbValue($rs->fields('description'));
		$mst_makangroup->price->setDbValue($rs->fields('price'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_makangroup;

		// Call Row_Rendering event
		$mst_makangroup->Row_Rendering();

		// Common render codes for all row types
		// id

		$mst_makangroup->id->CellCssStyle = "";
		$mst_makangroup->id->CellCssClass = "";

		// description
		$mst_makangroup->description->CellCssStyle = "";
		$mst_makangroup->description->CellCssClass = "";

		// price
		$mst_makangroup->price->CellCssStyle = "";
		$mst_makangroup->price->CellCssClass = "";
		if ($mst_makangroup->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$mst_makangroup->id->ViewValue = $mst_makangroup->id->CurrentValue;
			$mst_makangroup->id->CssStyle = "";
			$mst_makangroup->id->CssClass = "";
			$mst_makangroup->id->ViewCustomAttributes = "";

			// description
			$mst_makangroup->description->ViewValue = $mst_makangroup->description->CurrentValue;
			$mst_makangroup->description->CssStyle = "";
			$mst_makangroup->description->CssClass = "";
			$mst_makangroup->description->ViewCustomAttributes = "";

			// price
			$mst_makangroup->price->ViewValue = $mst_makangroup->price->CurrentValue;
			$mst_makangroup->price->CssStyle = "";
			$mst_makangroup->price->CssClass = "";
			$mst_makangroup->price->ViewCustomAttributes = "";

			// id
			$mst_makangroup->id->HrefValue = "";

			// description
			$mst_makangroup->description->HrefValue = "";

			// price
			$mst_makangroup->price->HrefValue = "";
		} elseif ($mst_makangroup->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$mst_makangroup->id->EditCustomAttributes = "";
			$mst_makangroup->id->EditValue = $mst_makangroup->id->CurrentValue;
			$mst_makangroup->id->CssStyle = "";
			$mst_makangroup->id->CssClass = "";
			$mst_makangroup->id->ViewCustomAttributes = "";

			// description
			$mst_makangroup->description->EditCustomAttributes = "";
			$mst_makangroup->description->EditValue = ew_HtmlEncode($mst_makangroup->description->CurrentValue);

			// price
			$mst_makangroup->price->EditCustomAttributes = "";
			$mst_makangroup->price->EditValue = ew_HtmlEncode($mst_makangroup->price->CurrentValue);

			// Edit refer script
			// id

			$mst_makangroup->id->HrefValue = "";

			// description
			$mst_makangroup->description->HrefValue = "";

			// price
			$mst_makangroup->price->HrefValue = "";
		}

		// Call Row Rendered event
		$mst_makangroup->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $mst_makangroup;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($mst_makangroup->description->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Description";
		}
		if ($mst_makangroup->price->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Price";
		}
		if (!ew_CheckNumber($mst_makangroup->price->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect floating point number - Price";
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
		global $conn, $Security, $mst_makangroup;
		$sFilter = $mst_makangroup->KeyFilter();
		$mst_makangroup->CurrentFilter = $sFilter;
		$sSql = $mst_makangroup->SQL();
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

			$mst_makangroup->description->SetDbValueDef($mst_makangroup->description->CurrentValue, "");
			$rsnew['description'] =& $mst_makangroup->description->DbValue;

			// Field price
			$mst_makangroup->price->SetDbValueDef($mst_makangroup->price->CurrentValue, 0);
			$rsnew['price'] =& $mst_makangroup->price->DbValue;

			// Call Row Updating event
			$bUpdateRow = $mst_makangroup->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($mst_makangroup->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($mst_makangroup->CancelMessage <> "") {
					$this->setMessage($mst_makangroup->CancelMessage);
					$mst_makangroup->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$mst_makangroup->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $mst_makangroup;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($mst_makangroup->ExportAll) {
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
		if ($mst_makangroup->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($mst_makangroup->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $mst_makangroup->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'id', $mst_makangroup->Export);
				ew_ExportAddValue($sExportStr, 'description', $mst_makangroup->Export);
				ew_ExportAddValue($sExportStr, 'price', $mst_makangroup->Export);
				echo ew_ExportLine($sExportStr, $mst_makangroup->Export);
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
				$mst_makangroup->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($mst_makangroup->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('id', $mst_makangroup->id->CurrentValue);
					$XmlDoc->AddField('description', $mst_makangroup->description->CurrentValue);
					$XmlDoc->AddField('price', $mst_makangroup->price->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $mst_makangroup->Export <> "csv") { // Vertical format
						echo ew_ExportField('id', $mst_makangroup->id->ExportValue($mst_makangroup->Export, $mst_makangroup->ExportOriginalValue), $mst_makangroup->Export);
						echo ew_ExportField('description', $mst_makangroup->description->ExportValue($mst_makangroup->Export, $mst_makangroup->ExportOriginalValue), $mst_makangroup->Export);
						echo ew_ExportField('price', $mst_makangroup->price->ExportValue($mst_makangroup->Export, $mst_makangroup->ExportOriginalValue), $mst_makangroup->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $mst_makangroup->id->ExportValue($mst_makangroup->Export, $mst_makangroup->ExportOriginalValue), $mst_makangroup->Export);
						ew_ExportAddValue($sExportStr, $mst_makangroup->description->ExportValue($mst_makangroup->Export, $mst_makangroup->ExportOriginalValue), $mst_makangroup->Export);
						ew_ExportAddValue($sExportStr, $mst_makangroup->price->ExportValue($mst_makangroup->Export, $mst_makangroup->ExportOriginalValue), $mst_makangroup->Export);
						echo ew_ExportLine($sExportStr, $mst_makangroup->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($mst_makangroup->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($mst_makangroup->Export);
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
