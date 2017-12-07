<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "win_acc_coainfo.php" ?>
<?php include "userfn6.php" ?>
<?php include "func_showparent_win.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Define page object
$win_acc_coa_list = new cwin_acc_coa_list();
$Page =& $win_acc_coa_list;

// Page init processing
$win_acc_coa_list->Page_Init();

// Page main processing
$win_acc_coa_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($win_acc_coa->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var win_acc_coa_list = new ew_Page("win_acc_coa_list");

// page properties
win_acc_coa_list.PageID = "list"; // page ID
var EW_PAGE_ID = win_acc_coa_list.PageID; // for backward compatibility

// extend page with validate function for search
win_acc_coa_list.ValidateSearch = function(fobj) {
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
win_acc_coa_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
win_acc_coa_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
win_acc_coa_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
win_acc_coa_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($win_acc_coa->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($win_acc_coa->Export == "" && $win_acc_coa->SelectLimit);
	if (!$bSelectLimit)
		$rs = $win_acc_coa_list->LoadRecordset();
	$win_acc_coa_list->lTotalRecs = ($bSelectLimit) ? $win_acc_coa->SelectRecordCount() : $rs->RecordCount();
	$win_acc_coa_list->lStartRec = 1;
	if ($win_acc_coa_list->lDisplayRecs <= 0) // Display all records
		$win_acc_coa_list->lDisplayRecs = $win_acc_coa_list->lTotalRecs;
	if (!($win_acc_coa->ExportAll && $win_acc_coa->Export <> ""))
		$win_acc_coa_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $win_acc_coa_list->LoadRecordset($win_acc_coa_list->lStartRec-1, $win_acc_coa_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Daftar Coa</b></h3>
<?php if ($win_acc_coa->Export == "" && $win_acc_coa->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $win_acc_coa_list->PageUrl() ?>export=print"><img src="images/print.gif" title="Printer Friendly" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $win_acc_coa_list->PageUrl() ?>export=html"><img src="images/exporthtml.gif" title="Export to HTML" width="16" height="16" border="0"></a>-->
&nbsp;&nbsp;<a href="<?php echo $win_acc_coa_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $win_acc_coa_list->PageUrl() ?>export=word"><img src="images/exportdoc.gif" title="Export to Word" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $win_acc_coa_list->PageUrl() ?>export=xml"><img src="images/exportxml.gif" title="Export to XML" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $win_acc_coa_list->PageUrl() ?>export=csv"><img src="images/exportcsv.gif" title="Export to CSV" width="16" height="16" border="0"></a-->
<?php } ?>
</span></p>
<?php if ($win_acc_coa->Export == "" && $win_acc_coa->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(win_acc_coa_list);" style="text-decoration: none;"><img id="win_acc_coa_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="win_acc_coa_list_SearchPanel">
<form name="fwin_acc_coalistsrch" id="fwin_acc_coalistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return win_acc_coa_list.ValidateSearch(this);">
<?php echo $__urlgetshidden;?>
<input type="hidden" id="t" name="t" value="win_acc_coa">
<?php
if ($gsSearchError == "")
	$win_acc_coa_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$win_acc_coa->RowType = EW_ROWTYPE_SEARCH;

// Render row
$win_acc_coa_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">COA</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_coa" id="z_coa" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_coa" id="x_coa" size="10" maxlength="10" value="<?php echo $win_acc_coa->coa->EditValue ?>"<?php echo $win_acc_coa->coa->EditAttributes() ?>>
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
<input type="text" name="x_koder" id="x_koder" size="10" maxlength="10" value="<?php echo $win_acc_coa->koder->EditValue ?>"<?php echo $win_acc_coa->koder->EditAttributes() ?>>
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
<input type="text" name="x_description" id="x_description" size="70" maxlength="255" value="<?php echo $win_acc_coa->description->EditValue ?>"<?php echo $win_acc_coa->description->EditAttributes() ?>>
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
			<!--a href="<?php echo $win_acc_coa_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $win_acc_coa_list->PageUrl() ?><?php echo $__urlgets; ?>&cmd=reset';">
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $win_acc_coa_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($win_acc_coa->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($win_acc_coa->CurrentAction <> "gridadd" && $win_acc_coa->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<?php echo $__urlgetshidden;?>
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($win_acc_coa_list->Pager)) $win_acc_coa_list->Pager = new cPrevNextPager($win_acc_coa_list->lStartRec, $win_acc_coa_list->lDisplayRecs, $win_acc_coa_list->lTotalRecs) ?>
<?php if ($win_acc_coa_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($win_acc_coa_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $win_acc_coa_list->PageUrl() ?><?php echo $__urlgets; ?>&start=<?php echo $win_acc_coa_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($win_acc_coa_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $win_acc_coa_list->PageUrl() ?><?php echo $__urlgets; ?>&start=<?php echo $win_acc_coa_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $win_acc_coa_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($win_acc_coa_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $win_acc_coa_list->PageUrl() ?><?php echo $__urlgets; ?>&start=<?php echo $win_acc_coa_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($win_acc_coa_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $win_acc_coa_list->PageUrl() ?><?php echo $__urlgets; ?>&start=<?php echo $win_acc_coa_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $win_acc_coa_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $win_acc_coa_list->Pager->FromIndex ?> to <?php echo $win_acc_coa_list->Pager->ToIndex ?> of <?php echo $win_acc_coa_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($win_acc_coa_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($win_acc_coa_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="win_acc_coa">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($win_acc_coa_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($win_acc_coa_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($win_acc_coa_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="50"<?php if ($win_acc_coa_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($win_acc_coa_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($win_acc_coa_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
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
<form name="fwin_acc_coalist" id="fwin_acc_coalist" class="ewForm" action="" method="post">
<?php if ($win_acc_coa_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$win_acc_coa_list->lOptionCnt = 0;
	$win_acc_coa_list->lOptionCnt += count($win_acc_coa_list->ListOptions->Items); // Custom list options
?>
<?php echo $win_acc_coa->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($win_acc_coa->Export == "") { ?>
<?php

// Custom list options
foreach ($win_acc_coa_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($win_acc_coa->coa->Visible) { // coa ?>
	<?php if ($win_acc_coa->SortUrl($win_acc_coa->coa) == "") { ?>
		<td style="white-space: nowrap;">COA</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_acc_coa->SortUrl($win_acc_coa->coa) ?>&<?php echo $__urlgets; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>COA</td><td style="width: 10px;"><?php if ($win_acc_coa->coa->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_acc_coa->coa->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($win_acc_coa->koder->Visible) { // koder ?>
	<?php if ($win_acc_coa->SortUrl($win_acc_coa->koder) == "") { ?>
		<td style="white-space: nowrap;">Group</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_acc_coa->SortUrl($win_acc_coa->koder) ?>&<?php echo $__urlgets; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Group</td><td style="width: 10px;"><?php if ($win_acc_coa->koder->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_acc_coa->koder->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($win_acc_coa->description->Visible) { // description ?>
	<?php if ($win_acc_coa->SortUrl($win_acc_coa->description) == "") { ?>
		<td style="white-space: nowrap;">Description</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_acc_coa->SortUrl($win_acc_coa->description) ?>&<?php echo $__urlgets; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Description</td><td style="width: 10px;"><?php if ($win_acc_coa->description->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_acc_coa->description->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($win_acc_coa->ExportAll && $win_acc_coa->Export <> "") {
	$win_acc_coa_list->lStopRec = $win_acc_coa_list->lTotalRecs;
} else {
	$win_acc_coa_list->lStopRec = $win_acc_coa_list->lStartRec + $win_acc_coa_list->lDisplayRecs - 1; // Set the last record to display
}
$win_acc_coa_list->lRecCount = $win_acc_coa_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$win_acc_coa->SelectLimit && $win_acc_coa_list->lStartRec > 1)
		$rs->Move($win_acc_coa_list->lStartRec - 1);
}
$win_acc_coa_list->lRowCnt = 0;
while (($win_acc_coa->CurrentAction == "gridadd" || !$rs->EOF) &&
	$win_acc_coa_list->lRecCount < $win_acc_coa_list->lStopRec) {
	$win_acc_coa_list->lRecCount++;
	if (intval($win_acc_coa_list->lRecCount) >= intval($win_acc_coa_list->lStartRec)) {
		$win_acc_coa_list->lRowCnt++;

	// Init row class and style
	$win_acc_coa->CssClass = "";
	$win_acc_coa->CssStyle = "";
	$win_acc_coa->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($win_acc_coa->CurrentAction == "gridadd") {
		$win_acc_coa_list->LoadDefaultValues(); // Load default values
	} else {
		$win_acc_coa_list->LoadRowValues($rs); // Load row values
	}
	$win_acc_coa->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$win_acc_coa_list->RenderRow();
?>
	<tr<?php echo $win_acc_coa->RowAttributes() ?> ondblclick="showcoaparent('<?php echo sanitasi($_REQUEST["coaid"]); ?>','<?php echo $win_acc_coa->coa->ListViewValue(); ?>','<?php echo sanitasi($_REQUEST["koderid"]); ?>','<?php echo $win_acc_coa->koder->ListViewValue(); ?>','<?php echo sanitasi($_REQUEST["descid"]); ?>','<?php echo $win_acc_coa->description->ListViewValue(); ?>','<?php echo $_GET["mode"]; ?>');">
<?php if ($win_acc_coa->Export == "") { ?>
<?php

// Custom list options
foreach ($win_acc_coa_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($win_acc_coa->coa->Visible) { // coa ?>
		<td<?php echo $win_acc_coa->coa->CellAttributes() ?>>
<div<?php echo $win_acc_coa->coa->ViewAttributes() ?>><?php echo $win_acc_coa->coa->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($win_acc_coa->koder->Visible) { // koder ?>
		<td<?php echo $win_acc_coa->koder->CellAttributes() ?>>
<div<?php echo $win_acc_coa->koder->ViewAttributes() ?>><?php echo $win_acc_coa->koder->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($win_acc_coa->description->Visible) { // description ?>
		<td<?php echo $win_acc_coa->description->CellAttributes() ?>>
<div<?php echo $win_acc_coa->description->ViewAttributes() ?>><?php echo $win_acc_coa->description->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($win_acc_coa->CurrentAction <> "gridadd")
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
<?php if ($win_acc_coa->Export == "" && $win_acc_coa->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
ew_ToggleSearchPanel(win_acc_coa_list); // uncomment to init search panel as collapsed

//-->
</script>
<?php } ?>
<?php if ($win_acc_coa->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$win_acc_coa_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cwin_acc_coa_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'win_acc_coa';

	// Page Object Name
	var $PageObjName = 'win_acc_coa_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $win_acc_coa;
		if ($win_acc_coa->UseTokenInUrl) $PageUrl .= "t=" . $win_acc_coa->TableVar . "&"; // add page token
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
		global $objForm, $win_acc_coa;
		if ($win_acc_coa->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($win_acc_coa->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($win_acc_coa->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cwin_acc_coa_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["win_acc_coa"] = new cwin_acc_coa();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'win_acc_coa', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $win_acc_coa;
	$win_acc_coa->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $win_acc_coa->Export; // Get export parameter, used in header
	$gsExportFile = $win_acc_coa->TableVar; // Get export file, used in header
	if ($win_acc_coa->Export == "print" || $win_acc_coa->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($win_acc_coa->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($win_acc_coa->Export == "word") {
		header('Content-Type: application/vnd.ms-word');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($win_acc_coa->Export == "xml") {
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($win_acc_coa->Export == "csv") {
		header('Content-Type: application/csv');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.csv');
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
		global $objForm, $gsSearchError, $Security, $win_acc_coa;
		$this->lDisplayRecs = 20;
		$this->lRecRange = 10;
		$this->lRecCnt = 0; // Record count

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		$this->sSrchWhere = ""; // Search WHERE clause
		$this->sDeleteConfirmMsg = "Do you want to delete the selected records?"; // Delete confirm message

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
		if ($win_acc_coa->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $win_acc_coa->getRecordsPerPage(); // Restore from Session
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
		$win_acc_coa->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$win_acc_coa->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$win_acc_coa->setStartRecordNumber($this->lStartRec);
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
		$win_acc_coa->setSessionWhere($sFilter);
		$win_acc_coa->CurrentFilter = "";

		// Export data only
		if (in_array($win_acc_coa->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $win_acc_coa;
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
			$win_acc_coa->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$win_acc_coa->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $win_acc_coa;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $win_acc_coa->coa, FALSE); // Field coa
		$this->BuildSearchSql($sWhere, $win_acc_coa->koder, FALSE); // Field koder
		$this->BuildSearchSql($sWhere, $win_acc_coa->description, FALSE); // Field description

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($win_acc_coa->coa); // Field coa
			$this->SetSearchParm($win_acc_coa->koder); // Field koder
			$this->SetSearchParm($win_acc_coa->description); // Field description
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
		global $win_acc_coa;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$win_acc_coa->setAdvancedSearch("x_$FldParm", $FldVal);
		$win_acc_coa->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$win_acc_coa->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$win_acc_coa->setAdvancedSearch("y_$FldParm", $FldVal2);
		$win_acc_coa->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $win_acc_coa;
		$this->sSrchWhere = "";
		$win_acc_coa->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $win_acc_coa;
		$win_acc_coa->setAdvancedSearch("x_coa", "");
		$win_acc_coa->setAdvancedSearch("x_koder", "");
		$win_acc_coa->setAdvancedSearch("x_description", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $win_acc_coa;
		$this->sSrchWhere = $win_acc_coa->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $win_acc_coa;
		 $win_acc_coa->coa->AdvancedSearch->SearchValue = $win_acc_coa->getAdvancedSearch("x_coa");
		 $win_acc_coa->koder->AdvancedSearch->SearchValue = $win_acc_coa->getAdvancedSearch("x_koder");
		 $win_acc_coa->description->AdvancedSearch->SearchValue = $win_acc_coa->getAdvancedSearch("x_description");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $win_acc_coa;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$win_acc_coa->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$win_acc_coa->CurrentOrderType = @$_GET["ordertype"];
			$win_acc_coa->UpdateSort($win_acc_coa->coa); // Field 
			$win_acc_coa->UpdateSort($win_acc_coa->koder); // Field 
			$win_acc_coa->UpdateSort($win_acc_coa->description); // Field 
			$win_acc_coa->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $win_acc_coa;
		$sOrderBy = $win_acc_coa->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($win_acc_coa->SqlOrderBy() <> "") {
				$sOrderBy = $win_acc_coa->SqlOrderBy();
				$win_acc_coa->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $win_acc_coa;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$win_acc_coa->setSessionOrderBy($sOrderBy);
				$win_acc_coa->coa->setSort("");
				$win_acc_coa->koder->setSort("");
				$win_acc_coa->description->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$win_acc_coa->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $win_acc_coa;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$win_acc_coa->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$win_acc_coa->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $win_acc_coa->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$win_acc_coa->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$win_acc_coa->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$win_acc_coa->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $win_acc_coa;

		// Load search values
		// coa

		$win_acc_coa->coa->AdvancedSearch->SearchValue = @$_GET["x_coa"];
		$win_acc_coa->coa->AdvancedSearch->SearchOperator = @$_GET["z_coa"];

		// koder
		$win_acc_coa->koder->AdvancedSearch->SearchValue = @$_GET["x_koder"];
		$win_acc_coa->koder->AdvancedSearch->SearchOperator = @$_GET["z_koder"];

		// description
		$win_acc_coa->description->AdvancedSearch->SearchValue = @$_GET["x_description"];
		$win_acc_coa->description->AdvancedSearch->SearchOperator = @$_GET["z_description"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $win_acc_coa;

		// Call Recordset Selecting event
		$win_acc_coa->Recordset_Selecting($win_acc_coa->CurrentFilter);

		// Load list page SQL
		$sSql = $win_acc_coa->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$win_acc_coa->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $win_acc_coa;
		$sFilter = $win_acc_coa->KeyFilter();

		// Call Row Selecting event
		$win_acc_coa->Row_Selecting($sFilter);

		// Load sql based on filter
		$win_acc_coa->CurrentFilter = $sFilter;
		$sSql = $win_acc_coa->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$win_acc_coa->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $win_acc_coa;
		$win_acc_coa->coa->setDbValue($rs->fields('coa'));
		$win_acc_coa->koder->setDbValue($rs->fields('koder'));
		$win_acc_coa->description->setDbValue($rs->fields('description'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $win_acc_coa;

		// Call Row_Rendering event
		$win_acc_coa->Row_Rendering();

		// Common render codes for all row types
		// coa

		$win_acc_coa->coa->CellCssStyle = "white-space: nowrap;";
		$win_acc_coa->coa->CellCssClass = "";

		// koder
		$win_acc_coa->koder->CellCssStyle = "white-space: nowrap;";
		$win_acc_coa->koder->CellCssClass = "";

		// description
		$win_acc_coa->description->CellCssStyle = "white-space: nowrap;";
		$win_acc_coa->description->CellCssClass = "";
		if ($win_acc_coa->RowType == EW_ROWTYPE_VIEW) { // View row

			// coa
			$win_acc_coa->coa->ViewValue = $win_acc_coa->coa->CurrentValue;
			$win_acc_coa->coa->CssStyle = "";
			$win_acc_coa->coa->CssClass = "";
			$win_acc_coa->coa->ViewCustomAttributes = "";

			// koder
			$win_acc_coa->koder->ViewValue = $win_acc_coa->koder->CurrentValue;
			$win_acc_coa->koder->CssStyle = "";
			$win_acc_coa->koder->CssClass = "";
			$win_acc_coa->koder->ViewCustomAttributes = "";

			// description
			$win_acc_coa->description->ViewValue = $win_acc_coa->description->CurrentValue;
			$win_acc_coa->description->CssStyle = "";
			$win_acc_coa->description->CssClass = "";
			$win_acc_coa->description->ViewCustomAttributes = "";

			// coa
			$win_acc_coa->coa->HrefValue = "";

			// koder
			$win_acc_coa->koder->HrefValue = "";

			// description
			$win_acc_coa->description->HrefValue = "";
		} elseif ($win_acc_coa->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// coa
			$win_acc_coa->coa->EditCustomAttributes = "";
			$win_acc_coa->coa->EditValue = ew_HtmlEncode($win_acc_coa->coa->AdvancedSearch->SearchValue);

			// koder
			$win_acc_coa->koder->EditCustomAttributes = "";
			$win_acc_coa->koder->EditValue = ew_HtmlEncode($win_acc_coa->koder->AdvancedSearch->SearchValue);

			// description
			$win_acc_coa->description->EditCustomAttributes = "";
			$win_acc_coa->description->EditValue = ew_HtmlEncode($win_acc_coa->description->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		$win_acc_coa->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $win_acc_coa;

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
		global $win_acc_coa;
		$win_acc_coa->coa->AdvancedSearch->SearchValue = $win_acc_coa->getAdvancedSearch("x_coa");
		$win_acc_coa->koder->AdvancedSearch->SearchValue = $win_acc_coa->getAdvancedSearch("x_koder");
		$win_acc_coa->description->AdvancedSearch->SearchValue = $win_acc_coa->getAdvancedSearch("x_description");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $win_acc_coa;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($win_acc_coa->ExportAll) {
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
		if ($win_acc_coa->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($win_acc_coa->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $win_acc_coa->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'coa', $win_acc_coa->Export);
				ew_ExportAddValue($sExportStr, 'koder', $win_acc_coa->Export);
				ew_ExportAddValue($sExportStr, 'description', $win_acc_coa->Export);
				echo ew_ExportLine($sExportStr, $win_acc_coa->Export);
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
				$win_acc_coa->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($win_acc_coa->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('coa', $win_acc_coa->coa->CurrentValue);
					$XmlDoc->AddField('koder', $win_acc_coa->koder->CurrentValue);
					$XmlDoc->AddField('description', $win_acc_coa->description->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $win_acc_coa->Export <> "csv") { // Vertical format
						echo ew_ExportField('coa', $win_acc_coa->coa->ExportValue($win_acc_coa->Export, $win_acc_coa->ExportOriginalValue), $win_acc_coa->Export);
						echo ew_ExportField('koder', $win_acc_coa->koder->ExportValue($win_acc_coa->Export, $win_acc_coa->ExportOriginalValue), $win_acc_coa->Export);
						echo ew_ExportField('description', $win_acc_coa->description->ExportValue($win_acc_coa->Export, $win_acc_coa->ExportOriginalValue), $win_acc_coa->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $win_acc_coa->coa->ExportValue($win_acc_coa->Export, $win_acc_coa->ExportOriginalValue), $win_acc_coa->Export);
						ew_ExportAddValue($sExportStr, $win_acc_coa->koder->ExportValue($win_acc_coa->Export, $win_acc_coa->ExportOriginalValue), $win_acc_coa->Export);
						ew_ExportAddValue($sExportStr, $win_acc_coa->description->ExportValue($win_acc_coa->Export, $win_acc_coa->ExportOriginalValue), $win_acc_coa->Export);
						echo ew_ExportLine($sExportStr, $win_acc_coa->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($win_acc_coa->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($win_acc_coa->Export);
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
