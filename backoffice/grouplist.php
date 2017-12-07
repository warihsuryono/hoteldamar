<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "groupinfo.php" ?>
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
$group_list = new cgroup_list();
$Page =& $group_list;

// Page init processing
$group_list->Page_Init();

// Page main processing
$group_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($group->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var group_list = new ew_Page("group_list");

// page properties
group_list.PageID = "list"; // page ID
var EW_PAGE_ID = group_list.PageID; // for backward compatibility

// extend page with ValidateForm function
group_list.ValidateForm = function(fobj) {
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
group_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
group_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
group_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

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
<?php if ($group->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($group->Export == "" && $group->SelectLimit);
	if (!$bSelectLimit)
		$rs = $group_list->LoadRecordset();
	$group_list->lTotalRecs = ($bSelectLimit) ? $group->SelectRecordCount() : $rs->RecordCount();
	$group_list->lStartRec = 1;
	if ($group_list->lDisplayRecs <= 0) // Display all records
		$group_list->lDisplayRecs = $group_list->lTotalRecs;
	if (!($group->ExportAll && $group->Export <> ""))
		$group_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $group_list->LoadRecordset($group_list->lStartRec-1, $group_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;">
</span></p>
<?php $group_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<form name="fgrouplist" id="fgrouplist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="group">
<?php if ($group_list->lTotalRecs > 0 || $group->CurrentAction == "add" || $group->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$group_list->lOptionCnt = 0;
	$group_list->lOptionCnt++; // edit
	$group_list->lOptionCnt++; // Delete
	$group_list->lOptionCnt += count($group_list->ListOptions->Items); // Custom list options
?>
<?php echo $group->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($group->id_group->Visible) { // id_group ?>
	<?php if ($group->SortUrl($group->id_group) == "") { ?>
		<td style="white-space: nowrap;">Id Group</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $group->SortUrl($group->id_group) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id Group</td><td style="width: 10px;"><?php if ($group->id_group->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($group->id_group->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($group->group->Visible) { // group ?>
	<?php if ($group->SortUrl($group->group) == "") { ?>
		<td style="white-space: nowrap;">Group</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $group->SortUrl($group->group) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Group</td><td style="width: 10px;"><?php if ($group->group->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($group->group->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($group->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php if ($group_list->lOptionCnt == 0 && $group->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($group_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
	</tr>
</thead>
<?php
	if ($group->CurrentAction == "add" || $group->CurrentAction == "copy") {
		$group_list->lRowIndex = 1;
		if ($group->CurrentAction == "add")
			$group_list->LoadDefaultValues();
		if ($group->EventCancelled) // Insert failed
			$group_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$group->CssClass = "ewTableEditRow";
		$group->CssStyle = "";
		$group->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
		$group->RowType = EW_ROWTYPE_ADD;

		// Render row
		$group_list->RenderRow();
?>
	<tr<?php echo $group->RowAttributes() ?>>
	<?php if ($group->id_group->Visible) { // id_group ?>
		<td style="white-space: nowrap;">&nbsp;</td>
	<?php } ?>
	<?php if ($group->group->Visible) { // group ?>
		<td style="white-space: nowrap;">
<input type="text" name="x<?php echo $group_list->lRowIndex ?>_group" id="x<?php echo $group_list->lRowIndex ?>_group" size="20" maxlength="20" value="<?php echo $group->group->EditValue ?>"<?php echo $group->group->EditAttributes() ?>>
</td>
	<?php } ?>
<td colspan="<?php echo $group_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (group_list.ValidateForm(document.fgrouplist)) document.fgrouplist.submit();return false;">Insert</a>&nbsp;<a href="<?php echo $group_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="insert">
</span></td>
	</tr>
<?php
}
?>
<?php
if ($group->ExportAll && $group->Export <> "") {
	$group_list->lStopRec = $group_list->lTotalRecs;
} else {
	$group_list->lStopRec = $group_list->lStartRec + $group_list->lDisplayRecs - 1; // Set the last record to display
}
$group_list->lRecCount = $group_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$group->SelectLimit && $group_list->lStartRec > 1)
		$rs->Move($group_list->lStartRec - 1);
}
$group_list->lRowCnt = 0;
$group_list->lEditRowCnt = 0;
if ($group->CurrentAction == "edit")
	$group_list->lRowIndex = 1;
while (($group->CurrentAction == "gridadd" || !$rs->EOF) &&
	$group_list->lRecCount < $group_list->lStopRec) {
	$group_list->lRecCount++;
	if (intval($group_list->lRecCount) >= intval($group_list->lStartRec)) {
		$group_list->lRowCnt++;

	// Init row class and style
	$group->CssClass = "";
	$group->CssStyle = "";
	$group->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($group->CurrentAction == "gridadd") {
		$group_list->LoadDefaultValues(); // Load default values
	} else {
		$group_list->LoadRowValues($rs); // Load row values
	}
	$group->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($group->CurrentAction == "edit") {
		if ($group_list->CheckInlineEditKey() && $group_list->lEditRowCnt == 0) // Inline edit
			$group->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($group->RowType == EW_ROWTYPE_EDIT && $group->EventCancelled) { // Update failed
		if ($group->CurrentAction == "edit")
			$group_list->RestoreFormValues(); // Restore form values
	}
	if ($group->RowType == EW_ROWTYPE_EDIT) { // Edit row
		$group_list->lEditRowCnt++;
		$group->RowClientEvents = "onmouseover='this.edit=true;ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	}
	if ($group->RowType == EW_ROWTYPE_ADD || $group->RowType == EW_ROWTYPE_EDIT) // Add / Edit row
			$group->CssClass = "ewTableEditRow";

	// Render row
	$group_list->RenderRow();
?>
	<tr<?php echo $group->RowAttributes() ?>>
	<?php if ($group->id_group->Visible) { // id_group ?>
		<td<?php echo $group->id_group->CellAttributes() ?>>
<?php if ($group->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $group->id_group->ViewAttributes() ?>><?php echo $group->id_group->EditValue ?></div><input type="hidden" name="x<?php echo $group_list->lRowIndex ?>_id_group" id="x<?php echo $group_list->lRowIndex ?>_id_group" value="<?php echo ew_HtmlEncode($group->id_group->CurrentValue) ?>">
<?php } ?>
<?php if ($group->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $group->id_group->ViewAttributes() ?>><?php echo $group->id_group->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($group->group->Visible) { // group ?>
		<td<?php echo $group->group->CellAttributes() ?>>
<?php if ($group->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $group_list->lRowIndex ?>_group" id="x<?php echo $group_list->lRowIndex ?>_group" size="20" maxlength="20" value="<?php echo $group->group->EditValue ?>"<?php echo $group->group->EditAttributes() ?>>
<?php } ?>
<?php if ($group->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $group->group->ViewAttributes() ?>><?php echo $group->group->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php if ($group->RowType == EW_ROWTYPE_ADD || $group->RowType == EW_ROWTYPE_EDIT) { ?>
<?php if ($group->CurrentAction == "edit") { ?>
<td colspan="<?php echo $group_list->lOptionCnt ?>"><span class="phpmaker">
<a href="" onclick="if (group_list.ValidateForm(document.fgrouplist)) document.fgrouplist.submit();return false;">Update</a>&nbsp;<a href="<?php echo $group_list->PageUrl() ?>a=cancel">Cancel</a>
<input type="hidden" name="a_list" id="a_list" value="update">
</span></td>
<?php } ?>
<?php } else { ?>
<?php if ($group->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $group->InlineEditUrl() ?>">Edit</a>
</span></td>
<?php if ($group_list->lOptionCnt == 0 && $group->CurrentAction == "add") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php } ?>

<td nowrap><span class="phpmaker">
<a href="menu_privilege_editor.php?id_group=<?php echo $group->id_group->ViewValue ?>">Menu Privilege</a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $group->DeleteUrl() ?>">Delete</a>
</span></td>
<?php

// Custom list options
foreach ($group_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
<?php } ?>
	</tr>
<?php if ($group->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($group->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($group->CurrentAction == "add" || $group->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $group_list->lRowIndex ?>">
<?php } ?>
<?php if ($group->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $group_list->lRowIndex ?>">
<?php } ?>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</div>
<?php if ($group->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($group->CurrentAction <> "gridadd" && $group->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($group_list->Pager)) $group_list->Pager = new cPrevNextPager($group_list->lStartRec, $group_list->lDisplayRecs, $group_list->lTotalRecs) ?>
<?php if ($group_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($group_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $group_list->PageUrl() ?>start=<?php echo $group_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($group_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $group_list->PageUrl() ?>start=<?php echo $group_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $group_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($group_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $group_list->PageUrl() ?>start=<?php echo $group_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($group_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $group_list->PageUrl() ?>start=<?php echo $group_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $group_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $group_list->Pager->FromIndex ?> to <?php echo $group_list->Pager->ToIndex ?> of <?php echo $group_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($group_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($group_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<a href="<?php echo $group_list->PageUrl() ?>a=add">Add</a>&nbsp;&nbsp;
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($group->Export == "" && $group->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(group_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($group->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$group_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cgroup_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'group';

	// Page Object Name
	var $PageObjName = 'group_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $group;
		if ($group->UseTokenInUrl) $PageUrl .= "t=" . $group->TableVar . "&"; // add page token
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
		global $objForm, $group;
		if ($group->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($group->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($group->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cgroup_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["group"] = new cgroup();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'group', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $group;
	$group->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $group->Export; // Get export parameter, used in header
	$gsExportFile = $group->TableVar; // Get export file, used in header

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
		global $objForm, $gsSearchError, $Security, $group;
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

			// Handle reset command
			$this->ResetCmd();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$group->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($group->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline edit mode
				if ($group->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($group->CurrentAction == "add" || $group->CurrentAction == "copy")
					$this->InlineAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$group->CurrentAction = $_POST["a_list"]; // Get action

					// Inline Update
					if ($group->CurrentAction == "update" && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($group->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();
				}
			}

			// Set Up Sorting Order
			$this->SetUpSortOrder();
		} // End Validate Request

		// Restore display records
		if ($group->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $group->getRecordsPerPage(); // Restore from Session
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
		$group->setSessionWhere($sFilter);
		$group->CurrentFilter = "";
	}

	//  Exit out of inline mode
	function ClearInlineMode() {
		global $group;
		$group->setKey("id_group", ""); // Clear inline edit key
		$group->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Edit Mode
	function InlineEditMode() {
		global $Security, $group;
		$bInlineEdit = TRUE;
		if (@$_GET["id_group"] <> "") {
			$group->id_group->setQueryStringValue($_GET["id_group"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$group->setKey("id_group", $group->id_group->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to inline edit record
	function InlineUpdate() {
		global $objForm, $gsFormError, $group;
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
				$group->SendEmail = TRUE; // Send email on update success
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
			$group->EventCancelled = TRUE; // Cancel event
			$group->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check inline edit key
	function CheckInlineEditKey() {
		global $group;

		//CheckInlineEditKey = True
		if (strval($group->getKey("id_group")) <> strval($group->id_group->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add Mode
	function InlineAddMode() {
		global $Security, $group;
		$group->CurrentAction = "add";
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to inline add/copy record
	function InlineInsert() {
		global $objForm, $gsFormError, $group;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate Form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$group->EventCancelled = TRUE; // Set event cancelled
			$group->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$group->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage("Add succeeded"); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$group->EventCancelled = TRUE; // Set event cancelled
			$group->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $group;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$group->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$group->CurrentOrderType = @$_GET["ordertype"];
			$group->UpdateSort($group->id_group); // Field 
			$group->UpdateSort($group->group); // Field 
			$group->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $group;
		$sOrderBy = $group->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($group->SqlOrderBy() <> "") {
				$sOrderBy = $group->SqlOrderBy();
				$group->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $group;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$group->setSessionOrderBy($sOrderBy);
				$group->id_group->setSort("");
				$group->group->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$group->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $group;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$group->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$group->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $group->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$group->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$group->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$group->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $group;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $group;
		$group->id_group->setFormValue($objForm->GetValue("x_id_group"));
		$group->group->setFormValue($objForm->GetValue("x_group"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $group;
		$group->id_group->CurrentValue = $group->id_group->FormValue;
		$group->group->CurrentValue = $group->group->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $group;

		// Call Recordset Selecting event
		$group->Recordset_Selecting($group->CurrentFilter);

		// Load list page SQL
		$sSql = $group->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$group->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $group;
		$sFilter = $group->KeyFilter();

		// Call Row Selecting event
		$group->Row_Selecting($sFilter);

		// Load sql based on filter
		$group->CurrentFilter = $sFilter;
		$sSql = $group->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$group->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $group;
		$group->id_group->setDbValue($rs->fields('id_group'));
		$group->group->setDbValue($rs->fields('group'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $group;

		// Call Row_Rendering event
		$group->Row_Rendering();

		// Common render codes for all row types
		// id_group

		$group->id_group->CellCssStyle = "white-space: nowrap;";
		$group->id_group->CellCssClass = "";

		// group
		$group->group->CellCssStyle = "white-space: nowrap;";
		$group->group->CellCssClass = "";
		if ($group->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_group
			$group->id_group->ViewValue = $group->id_group->CurrentValue;
			$group->id_group->CssStyle = "";
			$group->id_group->CssClass = "";
			$group->id_group->ViewCustomAttributes = "";

			// group
			$group->group->ViewValue = $group->group->CurrentValue;
			$group->group->CssStyle = "";
			$group->group->CssClass = "";
			$group->group->ViewCustomAttributes = "";

			// id_group
			$group->id_group->HrefValue = "";

			// group
			$group->group->HrefValue = "";
		} elseif ($group->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_group
			// group

			$group->group->EditCustomAttributes = "";
			$group->group->EditValue = ew_HtmlEncode($group->group->CurrentValue);
		} elseif ($group->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_group
			$group->id_group->EditCustomAttributes = "";
			$group->id_group->EditValue = $group->id_group->CurrentValue;
			$group->id_group->CssStyle = "";
			$group->id_group->CssClass = "";
			$group->id_group->ViewCustomAttributes = "";

			// group
			$group->group->EditCustomAttributes = "";
			$group->group->EditValue = ew_HtmlEncode($group->group->CurrentValue);

			// Edit refer script
			// id_group

			$group->id_group->HrefValue = "";

			// group
			$group->group->HrefValue = "";
		}

		// Call Row Rendered event
		$group->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $group;

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
		global $conn, $Security, $group;
		$sFilter = $group->KeyFilter();
		$group->CurrentFilter = $sFilter;
		$sSql = $group->SQL();
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

			// Field id_group
			// Field group

			$group->group->SetDbValueDef($group->group->CurrentValue, NULL);
			$rsnew['group'] =& $group->group->DbValue;

			// Call Row Updating event
			$bUpdateRow = $group->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($group->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($group->CancelMessage <> "") {
					$this->setMessage($group->CancelMessage);
					$group->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$group->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Security, $group;
		$rsnew = array();

		// Field id_group
		// Field group

		$group->group->SetDbValueDef($group->group->CurrentValue, NULL);
		$rsnew['group'] =& $group->group->DbValue;

		// Call Row Inserting event
		$bInsertRow = $group->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($group->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($group->CancelMessage <> "") {
				$this->setMessage($group->CancelMessage);
				$group->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$group->id_group->setDbValue($conn->Insert_ID());
			$rsnew['id_group'] =& $group->id_group->DbValue;

			// Call Row Inserted event
			$group->Row_Inserted($rsnew);
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
