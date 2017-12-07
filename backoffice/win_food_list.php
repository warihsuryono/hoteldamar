<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "win_food_info.php" ?>
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
$win_food__list = new cwin_food__list();
$Page =& $win_food__list;

// Page init processing
$win_food__list->Page_Init();

// Page main processing
$win_food__list->Page_Main();
?>
<?php include "header.php" ?>
<?php include "func_showparent_win.php" ?>
<?php if ($win_food_->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var win_food__list = new ew_Page("win_food__list");

// page properties
win_food__list.PageID = "list"; // page ID
var EW_PAGE_ID = win_food__list.PageID; // for backward compatibility

// extend page with validate function for search
win_food__list.ValidateSearch = function(fobj) {
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
win_food__list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
win_food__list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
win_food__list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($win_food_->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($win_food_->Export == "" && $win_food_->SelectLimit);
	if (!$bSelectLimit)
		$rs = $win_food__list->LoadRecordset();
	$win_food__list->lTotalRecs = ($bSelectLimit) ? $win_food_->SelectRecordCount() : $rs->RecordCount();
	$win_food__list->lStartRec = 1;
	if ($win_food__list->lDisplayRecs <= 0) // Display all records
		$win_food__list->lDisplayRecs = $win_food__list->lTotalRecs;
	if (!($win_food_->ExportAll && $win_food_->Export <> ""))
		$win_food__list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $win_food__list->LoadRecordset($win_food__list->lStartRec-1, $win_food__list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Food & Drink</b></h3>
<?php if ($win_food_->Export == "" && $win_food_->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $win_food__list->PageUrl() ?>export=print">Printer Friendly</a>
&nbsp;&nbsp;<a href="<?php echo $win_food__list->PageUrl() ?>export=excel">Export to Excel</a>
<?php } ?>
</span></p>
<?php if ($win_food_->Export == "" && $win_food_->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(win_food__list);" style="text-decoration: none;"><img id="win_food__list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="win_food__list_SearchPanel">
<form name="fwin_food_listsrch" id="fwin_food_listsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return win_food__list.ValidateSearch(this);">
<?php echo $__urlgetshidden;?>
<input type="hidden" id="t" name="t" value="win_food_">
<?php
if ($gsSearchError == "")
	$win_food__list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$win_food_->RowType = EW_ROWTYPE_SEARCH;

// Render row
$win_food__list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Kode</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kode" id="z_kode" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kode" id="x_kode" size="5" maxlength="5" value="<?php echo $win_food_->kode->EditValue ?>"<?php echo $win_food_->kode->EditAttributes() ?>>
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
<input type="text" name="x_description" id="x_description" size="30" maxlength="255" value="<?php echo $win_food_->description->EditValue ?>"<?php echo $win_food_->description->EditAttributes() ?>>
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
			<a href="<?php echo $win_food__list->PageUrl() ?><?php echo $__urlgets; ?>&cmd=reset">Show all</a>&nbsp;
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $win_food__list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($win_food_->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($win_food_->CurrentAction <> "gridadd" && $win_food_->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<?php echo $__urlgetshidden;?>
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($win_food__list->Pager)) $win_food__list->Pager = new cPrevNextPager($win_food__list->lStartRec, $win_food__list->lDisplayRecs, $win_food__list->lTotalRecs) ?>
<?php if ($win_food__list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($win_food__list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $win_food__list->PageUrl() ?><?php echo $__urlgets; ?>&start=<?php echo $win_food__list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($win_food__list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $win_food__list->PageUrl() ?><?php echo $__urlgets; ?>&start=<?php echo $win_food__list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $win_food__list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($win_food__list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $win_food__list->PageUrl() ?><?php echo $__urlgets; ?>&start=<?php echo $win_food__list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($win_food__list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $win_food__list->PageUrl() ?><?php echo $__urlgets; ?>&start=<?php echo $win_food__list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $win_food__list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $win_food__list->Pager->FromIndex ?> to <?php echo $win_food__list->Pager->ToIndex ?> of <?php echo $win_food__list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($win_food__list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($win_food__list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="win_food_">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($win_food__list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($win_food__list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($win_food__list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($win_food__list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($win_food__list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($win_food__list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
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
<form name="fwin_food_list" id="fwin_food_list" class="ewForm" action="" method="post">
<?php if ($win_food__list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$win_food__list->lOptionCnt = 0;
	$win_food__list->lOptionCnt += count($win_food__list->ListOptions->Items); // Custom list options
?>
<?php echo $win_food_->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($win_food_->Export == "") { ?>
<?php

// Custom list options
foreach ($win_food__list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($win_food_->kode->Visible) { // kode ?>
	<?php if ($win_food_->SortUrl($win_food_->kode) == "") { ?>
		<td style="white-space: nowrap;">Kode</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_food_->SortUrl($win_food_->kode) ?>&<?php echo $__urlgets; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode</td><td style="width: 10px;"><?php if ($win_food_->kode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_food_->kode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($win_food_->description->Visible) { // description ?>
	<?php if ($win_food_->SortUrl($win_food_->description) == "") { ?>
		<td style="white-space: nowrap;">Description</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_food_->SortUrl($win_food_->description) ?>&<?php echo $__urlgets; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Description</td><td style="width: 10px;"><?php if ($win_food_->description->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_food_->description->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($win_food_->price->Visible) { // price ?>
	<?php if ($win_food_->SortUrl($win_food_->price) == "") { ?>
		<td style="white-space: nowrap;">Price</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_food_->SortUrl($win_food_->price) ?>&<?php echo $__urlgets; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Price</td><td style="width: 10px;"><?php if ($win_food_->price->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_food_->price->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($win_food_->ExportAll && $win_food_->Export <> "") {
	$win_food__list->lStopRec = $win_food__list->lTotalRecs;
} else {
	$win_food__list->lStopRec = $win_food__list->lStartRec + $win_food__list->lDisplayRecs - 1; // Set the last record to display
}
$win_food__list->lRecCount = $win_food__list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$win_food_->SelectLimit && $win_food__list->lStartRec > 1)
		$rs->Move($win_food__list->lStartRec - 1);
}
$win_food__list->lRowCnt = 0;
while (($win_food_->CurrentAction == "gridadd" || !$rs->EOF) &&
	$win_food__list->lRecCount < $win_food__list->lStopRec) {
	$win_food__list->lRecCount++;
	if (intval($win_food__list->lRecCount) >= intval($win_food__list->lStartRec)) {
		$win_food__list->lRowCnt++;

	// Init row class and style
	$win_food_->CssClass = "";
	$win_food_->CssStyle = "";
	$win_food_->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($win_food_->CurrentAction == "gridadd") {
		$win_food__list->LoadDefaultValues(); // Load default values
	} else {
		$win_food__list->LoadRowValues($rs); // Load row values
	}
	$win_food_->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$win_food__list->RenderRow();
?>
	<tr<?php echo $win_food_->RowAttributes() ?> ondblclick="showparent('<?php echo sanitasi($_REQUEST["textid"]); ?>','<?php echo $win_food_->kode->ListViewValue(); ?>','');">
<?php if ($win_food_->Export == "") { ?>
<?php

// Custom list options
foreach ($win_food__list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($win_food_->kode->Visible) { // kode ?>
		<td<?php echo $win_food_->kode->CellAttributes() ?> onclick="showparent('<?php echo sanitasi($_REQUEST["textid"]); ?>','<?php echo $win_food_->kode->ListViewValue(); ?>','');">
<div<?php echo $win_food_->kode->ViewAttributes() ?>><?php echo $win_food_->kode->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($win_food_->description->Visible) { // description ?>
		<td<?php echo $win_food_->description->CellAttributes() ?>>
<div<?php echo $win_food_->description->ViewAttributes() ?>><?php echo $win_food_->description->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($win_food_->price->Visible) { // price ?>
		<td<?php echo $win_food_->price->CellAttributes() ?>>
<div<?php echo $win_food_->price->ViewAttributes() ?>><?php echo $win_food_->price->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($win_food_->CurrentAction <> "gridadd")
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
<?php if ($win_food_->Export == "" && $win_food_->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(win_food__list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($win_food_->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php

//
// Page Class
//
class cwin_food__list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'win_food_';

	// Page Object Name
	var $PageObjName = 'win_food__list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $win_food_;
		if ($win_food_->UseTokenInUrl) $PageUrl .= "t=" . $win_food_->TableVar . "&"; // add page token
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
		global $objForm, $win_food_;
		if ($win_food_->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($win_food_->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($win_food_->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cwin_food__list() {
		global $conn;

		// Initialize table object
		$GLOBALS["win_food_"] = new cwin_food_();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'win_food_', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $win_food_;
	$win_food_->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $win_food_->Export; // Get export parameter, used in header
	$gsExportFile = $win_food_->TableVar; // Get export file, used in header
	if ($win_food_->Export == "print" || $win_food_->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($win_food_->Export == "excel") {
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
		global $objForm, $gsSearchError, $Security, $win_food_;
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
		if ($win_food_->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $win_food_->getRecordsPerPage(); // Restore from Session
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
		$win_food_->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$win_food_->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$win_food_->setStartRecordNumber($this->lStartRec);
		} else {
			$this->RestoreSearchParms();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "($sFilter) AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in Session
		$win_food_->setSessionWhere($sFilter);
		$win_food_->CurrentFilter = "";

		// Export data only
		if (in_array($win_food_->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $win_food_;
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
			$win_food_->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$win_food_->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $win_food_;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $win_food_->kode, FALSE); // Field kode
		$this->BuildSearchSql($sWhere, $win_food_->description, FALSE); // Field description
		$this->BuildSearchSql($sWhere, $win_food_->price, FALSE); // Field price

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($win_food_->kode); // Field kode
			$this->SetSearchParm($win_food_->description); // Field description
			$this->SetSearchParm($win_food_->price); // Field price
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
		global $win_food_;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$win_food_->setAdvancedSearch("x_$FldParm", $FldVal);
		$win_food_->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$win_food_->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$win_food_->setAdvancedSearch("y_$FldParm", $FldVal2);
		$win_food_->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $win_food_;
		$this->sSrchWhere = "";
		$win_food_->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $win_food_;
		$win_food_->setAdvancedSearch("x_kode", "");
		$win_food_->setAdvancedSearch("x_description", "");
		$win_food_->setAdvancedSearch("x_price", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $win_food_;
		$this->sSrchWhere = $win_food_->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $win_food_;
		 $win_food_->kode->AdvancedSearch->SearchValue = $win_food_->getAdvancedSearch("x_kode");
		 $win_food_->description->AdvancedSearch->SearchValue = $win_food_->getAdvancedSearch("x_description");
		 $win_food_->price->AdvancedSearch->SearchValue = $win_food_->getAdvancedSearch("x_price");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $win_food_;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$win_food_->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$win_food_->CurrentOrderType = @$_GET["ordertype"];
			$win_food_->UpdateSort($win_food_->kode); // Field 
			$win_food_->UpdateSort($win_food_->description); // Field 
			$win_food_->UpdateSort($win_food_->price); // Field 
			$win_food_->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $win_food_;
		$sOrderBy = $win_food_->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($win_food_->SqlOrderBy() <> "") {
				$sOrderBy = $win_food_->SqlOrderBy();
				$win_food_->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $win_food_;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$win_food_->setSessionOrderBy($sOrderBy);
				$win_food_->kode->setSort("");
				$win_food_->description->setSort("");
				$win_food_->price->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$win_food_->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $win_food_;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$win_food_->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$win_food_->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $win_food_->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$win_food_->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$win_food_->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$win_food_->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $win_food_;

		// Load search values
		// kode

		$win_food_->kode->AdvancedSearch->SearchValue = @$_GET["x_kode"];
		$win_food_->kode->AdvancedSearch->SearchOperator = @$_GET["z_kode"];

		// description
		$win_food_->description->AdvancedSearch->SearchValue = @$_GET["x_description"];
		$win_food_->description->AdvancedSearch->SearchOperator = @$_GET["z_description"];

		// price
		$win_food_->price->AdvancedSearch->SearchValue = @$_GET["x_price"];
		$win_food_->price->AdvancedSearch->SearchOperator = @$_GET["z_price"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $win_food_;

		// Call Recordset Selecting event
		$win_food_->Recordset_Selecting($win_food_->CurrentFilter);

		// Load list page SQL
		$sSql = $win_food_->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$win_food_->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $win_food_;
		$sFilter = $win_food_->KeyFilter();

		// Call Row Selecting event
		$win_food_->Row_Selecting($sFilter);

		// Load sql based on filter
		$win_food_->CurrentFilter = $sFilter;
		$sSql = $win_food_->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$win_food_->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $win_food_;
		$win_food_->kode->setDbValue($rs->fields('kode'));
		$win_food_->description->setDbValue($rs->fields('description'));
		$win_food_->price->setDbValue($rs->fields('price'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $win_food_;

		// Call Row_Rendering event
		$win_food_->Row_Rendering();

		// Common render codes for all row types
		// kode

		$win_food_->kode->CellCssStyle = "white-space: nowrap;";
		$win_food_->kode->CellCssClass = "";

		// description
		$win_food_->description->CellCssStyle = "white-space: nowrap;";
		$win_food_->description->CellCssClass = "";

		// price
		$win_food_->price->CellCssStyle = "white-space: nowrap;";
		$win_food_->price->CellCssClass = "";
		if ($win_food_->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$win_food_->kode->ViewValue = $win_food_->kode->CurrentValue;
			$win_food_->kode->CssStyle = "";
			$win_food_->kode->CssClass = "";
			$win_food_->kode->ViewCustomAttributes = "";

			// description
			$win_food_->description->ViewValue = $win_food_->description->CurrentValue;
			$win_food_->description->CssStyle = "";
			$win_food_->description->CssClass = "";
			$win_food_->description->ViewCustomAttributes = "";

			// price
			$win_food_->price->ViewValue = $win_food_->price->CurrentValue;
			$win_food_->price->ViewValue = ew_FormatNumber($win_food_->price->ViewValue, 0, -2, -2, -2);
			$win_food_->price->CssStyle = "text-align:right;";
			$win_food_->price->CssClass = "";
			$win_food_->price->ViewCustomAttributes = "";

			// kode
			$win_food_->kode->HrefValue = "";

			// description
			$win_food_->description->HrefValue = "";

			// price
			$win_food_->price->HrefValue = "";
		} elseif ($win_food_->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// kode
			$win_food_->kode->EditCustomAttributes = "";
			$win_food_->kode->EditValue = ew_HtmlEncode($win_food_->kode->AdvancedSearch->SearchValue);

			// description
			$win_food_->description->EditCustomAttributes = "";
			$win_food_->description->EditValue = ew_HtmlEncode($win_food_->description->AdvancedSearch->SearchValue);

			// price
			$win_food_->price->EditCustomAttributes = "";
			$win_food_->price->EditValue = ew_HtmlEncode($win_food_->price->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		$win_food_->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $win_food_;

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

	// Load advanced search
	function LoadAdvancedSearch() {
		global $win_food_;
		$win_food_->kode->AdvancedSearch->SearchValue = $win_food_->getAdvancedSearch("x_kode");
		$win_food_->description->AdvancedSearch->SearchValue = $win_food_->getAdvancedSearch("x_description");
		$win_food_->price->AdvancedSearch->SearchValue = $win_food_->getAdvancedSearch("x_price");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $win_food_;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($win_food_->ExportAll) {
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
		if ($win_food_->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($win_food_->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $win_food_->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'kode', $win_food_->Export);
				ew_ExportAddValue($sExportStr, 'description', $win_food_->Export);
				ew_ExportAddValue($sExportStr, 'price', $win_food_->Export);
				echo ew_ExportLine($sExportStr, $win_food_->Export);
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
				$win_food_->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($win_food_->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('kode', $win_food_->kode->CurrentValue);
					$XmlDoc->AddField('description', $win_food_->description->CurrentValue);
					$XmlDoc->AddField('price', $win_food_->price->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $win_food_->Export <> "csv") { // Vertical format
						echo ew_ExportField('kode', $win_food_->kode->ExportValue($win_food_->Export, $win_food_->ExportOriginalValue), $win_food_->Export);
						echo ew_ExportField('description', $win_food_->description->ExportValue($win_food_->Export, $win_food_->ExportOriginalValue), $win_food_->Export);
						echo ew_ExportField('price', $win_food_->price->ExportValue($win_food_->Export, $win_food_->ExportOriginalValue), $win_food_->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $win_food_->kode->ExportValue($win_food_->Export, $win_food_->ExportOriginalValue), $win_food_->Export);
						ew_ExportAddValue($sExportStr, $win_food_->description->ExportValue($win_food_->Export, $win_food_->ExportOriginalValue), $win_food_->Export);
						ew_ExportAddValue($sExportStr, $win_food_->price->ExportValue($win_food_->Export, $win_food_->ExportOriginalValue), $win_food_->Export);
						echo ew_ExportLine($sExportStr, $win_food_->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($win_food_->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($win_food_->Export);
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
