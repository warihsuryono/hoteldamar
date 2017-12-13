<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "trx_additionalinfo.php" ?>
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
$trx_additional_list = new ctrx_additional_list();
$Page =& $trx_additional_list;

// Page init processing
$trx_additional_list->Page_Init();

// Page main processing
$trx_additional_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($trx_additional->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var trx_additional_list = new ew_Page("trx_additional_list");

// page properties
trx_additional_list.PageID = "list"; // page ID
var EW_PAGE_ID = trx_additional_list.PageID; // for backward compatibility

// extend page with validate function for search
trx_additional_list.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_tanggal"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Tanggal");
	elm = fobj.elements["x" + infix + "_grandtotal"];
	if (elm && !ew_CheckNumber(elm.value))
		return ew_OnError(this, elm, "Incorrect floating point number - Grandtotal");

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
trx_additional_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
trx_additional_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
trx_additional_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($trx_additional->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($trx_additional->Export == "" && $trx_additional->SelectLimit);
	if (!$bSelectLimit)
		$rs = $trx_additional_list->LoadRecordset();
	$trx_additional_list->lTotalRecs = ($bSelectLimit) ? $trx_additional->SelectRecordCount() : $rs->RecordCount();
	$trx_additional_list->lStartRec = 1;
	if ($trx_additional_list->lDisplayRecs <= 0) // Display all records
		$trx_additional_list->lDisplayRecs = $trx_additional_list->lTotalRecs;
	if (!($trx_additional->ExportAll && $trx_additional->Export <> ""))
		$trx_additional_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $trx_additional_list->LoadRecordset($trx_additional_list->lStartRec-1, $trx_additional_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"> <h3><b> Miscellaneous</b></h3>
<?php if ($trx_additional->Export == "" && $trx_additional->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $trx_additional_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $trx_additional_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php if ($trx_additional->Export == "" && $trx_additional->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(trx_additional_list);" style="text-decoration: none;"><img id="trx_additional_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="trx_additional_list_SearchPanel">
<form name="ftrx_additionallistsrch" id="ftrx_additionallistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return trx_additional_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="trx_additional">
<?php
if ($gsSearchError == "")
	$trx_additional_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$trx_additional->RowType = EW_ROWTYPE_SEARCH;

// Render row
$trx_additional_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Kode</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kode" id="z_kode" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kode" id="x_kode" size="20" maxlength="20" value="<?php echo $trx_additional->kode->EditValue ?>"<?php echo $trx_additional->kode->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Tanggal</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_tanggal" id="z_tanggal" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_tanggal" id="x_tanggal" value="<?php echo $trx_additional->tanggal->EditValue ?>"<?php echo $trx_additional->tanggal->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_tanggal" name="cal_x_tanggal" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_tanggal", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_tanggal" // ID of the button
});
</script>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Room</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_room" id="z_room" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_room" name="x_room"<?php echo $trx_additional->room->EditAttributes() ?>>
<?php
if (is_array($trx_additional->room->EditValue)) {
	$arwrk = $trx_additional->room->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($trx_additional->room->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr>
		<td><span class="phpmaker">Grandtotal</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_grandtotal" id="z_grandtotal" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_grandtotal" id="x_grandtotal" size="30" value="<?php echo $trx_additional->grandtotal->EditValue ?>"<?php echo $trx_additional->grandtotal->EditAttributes() ?>>
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
			<a href="<?php echo $trx_additional_list->PageUrl() ?>cmd=reset">Show all</a>&nbsp;
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $trx_additional_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($trx_additional->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($trx_additional->CurrentAction <> "gridadd" && $trx_additional->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($trx_additional_list->Pager)) $trx_additional_list->Pager = new cPrevNextPager($trx_additional_list->lStartRec, $trx_additional_list->lDisplayRecs, $trx_additional_list->lTotalRecs) ?>
<?php if ($trx_additional_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($trx_additional_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $trx_additional_list->PageUrl() ?>start=<?php echo $trx_additional_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($trx_additional_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $trx_additional_list->PageUrl() ?>start=<?php echo $trx_additional_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $trx_additional_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($trx_additional_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $trx_additional_list->PageUrl() ?>start=<?php echo $trx_additional_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($trx_additional_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $trx_additional_list->PageUrl() ?>start=<?php echo $trx_additional_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $trx_additional_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $trx_additional_list->Pager->FromIndex ?> to <?php echo $trx_additional_list->Pager->ToIndex ?> of <?php echo $trx_additional_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($trx_additional_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($trx_additional_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="trx_additional">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($trx_additional_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($trx_additional_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($trx_additional_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($trx_additional_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($trx_additional_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($trx_additional_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $trx_additional->AddUrl() ?>"><img src="images/expand.gif" title="Add" width="16" height="16" border="0"></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="ftrx_additionallist" id="ftrx_additionallist" class="ewForm" action="" method="post">
<?php if ($trx_additional_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$trx_additional_list->lOptionCnt = 0;
	$trx_additional_list->lOptionCnt++; // view
	$trx_additional_list->lOptionCnt += count($trx_additional_list->ListOptions->Items); // Custom list options
?>
<?php echo $trx_additional->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($trx_additional->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($trx_additional_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($trx_additional->kode->Visible) { // kode ?>
	<?php if ($trx_additional->SortUrl($trx_additional->kode) == "") { ?>
		<td style="white-space: nowrap;">Kode</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_additional->SortUrl($trx_additional->kode) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode</td><td style="width: 10px;"><?php if ($trx_additional->kode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_additional->kode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_additional->tanggal->Visible) { // tanggal ?>
	<?php if ($trx_additional->SortUrl($trx_additional->tanggal) == "") { ?>
		<td style="white-space: nowrap;">Tanggal</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_additional->SortUrl($trx_additional->tanggal) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tanggal</td><td style="width: 10px;"><?php if ($trx_additional->tanggal->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_additional->tanggal->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_additional->room->Visible) { // room ?>
	<?php if ($trx_additional->SortUrl($trx_additional->room) == "") { ?>
		<td style="white-space: nowrap;">Room</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_additional->SortUrl($trx_additional->room) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Room</td><td style="width: 10px;"><?php if ($trx_additional->room->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_additional->room->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($trx_additional->grandtotal->Visible) { // grandtotal ?>
	<?php if ($trx_additional->SortUrl($trx_additional->grandtotal) == "") { ?>
		<td style="white-space: nowrap;">Grandtotal</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $trx_additional->SortUrl($trx_additional->grandtotal) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Grandtotal</td><td style="width: 10px;"><?php if ($trx_additional->grandtotal->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($trx_additional->grandtotal->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($trx_additional->ExportAll && $trx_additional->Export <> "") {
	$trx_additional_list->lStopRec = $trx_additional_list->lTotalRecs;
} else {
	$trx_additional_list->lStopRec = $trx_additional_list->lStartRec + $trx_additional_list->lDisplayRecs - 1; // Set the last record to display
}
$trx_additional_list->lRecCount = $trx_additional_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$trx_additional->SelectLimit && $trx_additional_list->lStartRec > 1)
		$rs->Move($trx_additional_list->lStartRec - 1);
}
$trx_additional_list->lRowCnt = 0;
while (($trx_additional->CurrentAction == "gridadd" || !$rs->EOF) &&
	$trx_additional_list->lRecCount < $trx_additional_list->lStopRec) {
	$trx_additional_list->lRecCount++;
	if (intval($trx_additional_list->lRecCount) >= intval($trx_additional_list->lStartRec)) {
		$trx_additional_list->lRowCnt++;

	// Init row class and style
	$trx_additional->CssClass = "";
	$trx_additional->CssStyle = "";
	$trx_additional->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($trx_additional->CurrentAction == "gridadd") {
		$trx_additional_list->LoadDefaultValues(); // Load default values
	} else {
		$trx_additional_list->LoadRowValues($rs); // Load row values
	}
	$trx_additional->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$trx_additional_list->RenderRow();
?>
	<tr<?php echo $trx_additional->RowAttributes() ?>>
<?php if ($trx_additional->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="trx_additionaladd.php?editing=1&kode=<?php echo $trx_additional->kode->ListViewValue(); ?>"><img src="images/edit.gif" title="View" width="16" height="16" border="0"></a> |
<a href="<?php echo $trx_additional->ViewUrl() ?>"><img src="images/view.gif" title="View" width="16" height="16" border="0"></a>
</span></td>
<?php

// Custom list options
foreach ($trx_additional_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($trx_additional->kode->Visible) { // kode ?>
		<td<?php echo $trx_additional->kode->CellAttributes() ?>>
<div<?php echo $trx_additional->kode->ViewAttributes() ?>><?php echo $trx_additional->kode->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_additional->tanggal->Visible) { // tanggal ?>
		<td<?php echo $trx_additional->tanggal->CellAttributes() ?>>
<div<?php echo $trx_additional->tanggal->ViewAttributes() ?>><?php echo $trx_additional->tanggal->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_additional->room->Visible) { // room ?>
		<td<?php echo $trx_additional->room->CellAttributes() ?>>
<div<?php echo $trx_additional->room->ViewAttributes() ?>><?php echo $trx_additional->room->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($trx_additional->grandtotal->Visible) { // grandtotal ?>
		<td<?php echo $trx_additional->grandtotal->CellAttributes() ?>>
<div<?php echo $trx_additional->grandtotal->ViewAttributes() ?>><?php echo $trx_additional->grandtotal->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($trx_additional->CurrentAction <> "gridadd")
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
<?php if ($trx_additional->Export == "" && $trx_additional->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(trx_additional_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($trx_additional->Export == "") { ?>
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
class ctrx_additional_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'trx_additional';

	// Page Object Name
	var $PageObjName = 'trx_additional_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $trx_additional;
		if ($trx_additional->UseTokenInUrl) $PageUrl .= "t=" . $trx_additional->TableVar . "&"; // add page token
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
		global $objForm, $trx_additional;
		if ($trx_additional->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($trx_additional->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($trx_additional->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ctrx_additional_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["trx_additional"] = new ctrx_additional();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'trx_additional', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $trx_additional;
	$trx_additional->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $trx_additional->Export; // Get export parameter, used in header
	$gsExportFile = $trx_additional->TableVar; // Get export file, used in header
	if ($trx_additional->Export == "print" || $trx_additional->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($trx_additional->Export == "excel") {
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
		global $objForm, $gsSearchError, $Security, $trx_additional;
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
		if ($trx_additional->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $trx_additional->getRecordsPerPage(); // Restore from Session
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
		$trx_additional->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$trx_additional->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$trx_additional->setStartRecordNumber($this->lStartRec);
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
		$trx_additional->setSessionWhere($sFilter);
		$trx_additional->CurrentFilter = "";

		// Export data only
		if (in_array($trx_additional->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $trx_additional;
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
			$trx_additional->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$trx_additional->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $trx_additional;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $trx_additional->kode, FALSE); // Field kode
		$this->BuildSearchSql($sWhere, $trx_additional->seqno, FALSE); // Field seqno
		$this->BuildSearchSql($sWhere, $trx_additional->tanggal, FALSE); // Field tanggal
		$this->BuildSearchSql($sWhere, $trx_additional->room, FALSE); // Field room
		$this->BuildSearchSql($sWhere, $trx_additional->withppn, FALSE); // Field withppn
		$this->BuildSearchSql($sWhere, $trx_additional->withservice, FALSE); // Field withservice
		$this->BuildSearchSql($sWhere, $trx_additional->subtotal1, FALSE); // Field subtotal1
		$this->BuildSearchSql($sWhere, $trx_additional->ppn, FALSE); // Field ppn
		$this->BuildSearchSql($sWhere, $trx_additional->subtotal2, FALSE); // Field subtotal2
		$this->BuildSearchSql($sWhere, $trx_additional->service, FALSE); // Field service
		$this->BuildSearchSql($sWhere, $trx_additional->grandtotal, FALSE); // Field grandtotal
		$this->BuildSearchSql($sWhere, $trx_additional->notes, FALSE); // Field notes
		$this->BuildSearchSql($sWhere, $trx_additional->createby, FALSE); // Field createby
		$this->BuildSearchSql($sWhere, $trx_additional->createdate, FALSE); // Field createdate

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($trx_additional->kode); // Field kode
			$this->SetSearchParm($trx_additional->seqno); // Field seqno
			$this->SetSearchParm($trx_additional->tanggal); // Field tanggal
			$this->SetSearchParm($trx_additional->room); // Field room
			$this->SetSearchParm($trx_additional->withppn); // Field withppn
			$this->SetSearchParm($trx_additional->withservice); // Field withservice
			$this->SetSearchParm($trx_additional->subtotal1); // Field subtotal1
			$this->SetSearchParm($trx_additional->ppn); // Field ppn
			$this->SetSearchParm($trx_additional->subtotal2); // Field subtotal2
			$this->SetSearchParm($trx_additional->service); // Field service
			$this->SetSearchParm($trx_additional->grandtotal); // Field grandtotal
			$this->SetSearchParm($trx_additional->notes); // Field notes
			$this->SetSearchParm($trx_additional->createby); // Field createby
			$this->SetSearchParm($trx_additional->createdate); // Field createdate
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
		global $trx_additional;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$trx_additional->setAdvancedSearch("x_$FldParm", $FldVal);
		$trx_additional->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$trx_additional->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$trx_additional->setAdvancedSearch("y_$FldParm", $FldVal2);
		$trx_additional->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $trx_additional;
		$this->sSrchWhere = "";
		$trx_additional->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $trx_additional;
		$trx_additional->setAdvancedSearch("x_kode", "");
		$trx_additional->setAdvancedSearch("x_seqno", "");
		$trx_additional->setAdvancedSearch("x_tanggal", "");
		$trx_additional->setAdvancedSearch("x_room", "");
		$trx_additional->setAdvancedSearch("x_withppn", "");
		$trx_additional->setAdvancedSearch("x_withservice", "");
		$trx_additional->setAdvancedSearch("x_subtotal1", "");
		$trx_additional->setAdvancedSearch("x_ppn", "");
		$trx_additional->setAdvancedSearch("x_subtotal2", "");
		$trx_additional->setAdvancedSearch("x_service", "");
		$trx_additional->setAdvancedSearch("x_grandtotal", "");
		$trx_additional->setAdvancedSearch("x_notes", "");
		$trx_additional->setAdvancedSearch("x_createby", "");
		$trx_additional->setAdvancedSearch("x_createdate", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $trx_additional;
		$this->sSrchWhere = $trx_additional->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $trx_additional;
		 $trx_additional->kode->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_kode");
		 $trx_additional->seqno->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_seqno");
		 $trx_additional->tanggal->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_tanggal");
		 $trx_additional->room->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_room");
		 $trx_additional->withppn->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_withppn");
		 $trx_additional->withservice->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_withservice");
		 $trx_additional->subtotal1->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_subtotal1");
		 $trx_additional->ppn->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_ppn");
		 $trx_additional->subtotal2->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_subtotal2");
		 $trx_additional->service->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_service");
		 $trx_additional->grandtotal->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_grandtotal");
		 $trx_additional->notes->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_notes");
		 $trx_additional->createby->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_createby");
		 $trx_additional->createdate->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_createdate");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $trx_additional;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$trx_additional->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$trx_additional->CurrentOrderType = @$_GET["ordertype"];
			$trx_additional->UpdateSort($trx_additional->kode); // Field 
			$trx_additional->UpdateSort($trx_additional->tanggal); // Field 
			$trx_additional->UpdateSort($trx_additional->room); // Field 
			$trx_additional->UpdateSort($trx_additional->grandtotal); // Field 
			$trx_additional->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $trx_additional;
		$sOrderBy = $trx_additional->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($trx_additional->SqlOrderBy() <> "") {
				$sOrderBy = $trx_additional->SqlOrderBy();
				$trx_additional->setSessionOrderBy($sOrderBy);
				$trx_additional->tanggal->setSort("DESC");
				$trx_additional->kode->setSort("DESC");
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $trx_additional;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$trx_additional->setSessionOrderBy($sOrderBy);
				$trx_additional->kode->setSort("");
				$trx_additional->tanggal->setSort("");
				$trx_additional->room->setSort("");
				$trx_additional->grandtotal->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$trx_additional->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $trx_additional;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$trx_additional->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$trx_additional->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $trx_additional->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$trx_additional->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$trx_additional->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$trx_additional->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $trx_additional;

		// Load search values
		// kode

		$trx_additional->kode->AdvancedSearch->SearchValue = @$_GET["x_kode"];
		$trx_additional->kode->AdvancedSearch->SearchOperator = @$_GET["z_kode"];

		// seqno
		$trx_additional->seqno->AdvancedSearch->SearchValue = @$_GET["x_seqno"];
		$trx_additional->seqno->AdvancedSearch->SearchOperator = @$_GET["z_seqno"];

		// tanggal
		$trx_additional->tanggal->AdvancedSearch->SearchValue = @$_GET["x_tanggal"];
		$trx_additional->tanggal->AdvancedSearch->SearchOperator = @$_GET["z_tanggal"];

		// room
		$trx_additional->room->AdvancedSearch->SearchValue = @$_GET["x_room"];
		$trx_additional->room->AdvancedSearch->SearchOperator = @$_GET["z_room"];

		// withppn
		$trx_additional->withppn->AdvancedSearch->SearchValue = @$_GET["x_withppn"];
		$trx_additional->withppn->AdvancedSearch->SearchOperator = @$_GET["z_withppn"];

		// withservice
		$trx_additional->withservice->AdvancedSearch->SearchValue = @$_GET["x_withservice"];
		$trx_additional->withservice->AdvancedSearch->SearchOperator = @$_GET["z_withservice"];

		// subtotal1
		$trx_additional->subtotal1->AdvancedSearch->SearchValue = @$_GET["x_subtotal1"];
		$trx_additional->subtotal1->AdvancedSearch->SearchOperator = @$_GET["z_subtotal1"];

		// ppn
		$trx_additional->ppn->AdvancedSearch->SearchValue = @$_GET["x_ppn"];
		$trx_additional->ppn->AdvancedSearch->SearchOperator = @$_GET["z_ppn"];

		// subtotal2
		$trx_additional->subtotal2->AdvancedSearch->SearchValue = @$_GET["x_subtotal2"];
		$trx_additional->subtotal2->AdvancedSearch->SearchOperator = @$_GET["z_subtotal2"];

		// service
		$trx_additional->service->AdvancedSearch->SearchValue = @$_GET["x_service"];
		$trx_additional->service->AdvancedSearch->SearchOperator = @$_GET["z_service"];

		// grandtotal
		$trx_additional->grandtotal->AdvancedSearch->SearchValue = @$_GET["x_grandtotal"];
		$trx_additional->grandtotal->AdvancedSearch->SearchOperator = @$_GET["z_grandtotal"];

		// notes
		$trx_additional->notes->AdvancedSearch->SearchValue = @$_GET["x_notes"];
		$trx_additional->notes->AdvancedSearch->SearchOperator = @$_GET["z_notes"];

		// createby
		$trx_additional->createby->AdvancedSearch->SearchValue = @$_GET["x_createby"];
		$trx_additional->createby->AdvancedSearch->SearchOperator = @$_GET["z_createby"];

		// createdate
		$trx_additional->createdate->AdvancedSearch->SearchValue = @$_GET["x_createdate"];
		$trx_additional->createdate->AdvancedSearch->SearchOperator = @$_GET["z_createdate"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $trx_additional;

		// Call Recordset Selecting event
		$trx_additional->Recordset_Selecting($trx_additional->CurrentFilter);

		// Load list page SQL
		$sSql = $trx_additional->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$trx_additional->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $trx_additional;
		$sFilter = $trx_additional->KeyFilter();

		// Call Row Selecting event
		$trx_additional->Row_Selecting($sFilter);

		// Load sql based on filter
		$trx_additional->CurrentFilter = $sFilter;
		$sSql = $trx_additional->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$trx_additional->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $trx_additional;
		$trx_additional->kode->setDbValue($rs->fields('kode'));
		$trx_additional->seqno->setDbValue($rs->fields('seqno'));
		$trx_additional->tanggal->setDbValue($rs->fields('tanggal'));
		$trx_additional->room->setDbValue($rs->fields('room'));
		$trx_additional->withppn->setDbValue($rs->fields('withppn'));
		$trx_additional->withservice->setDbValue($rs->fields('withservice'));
		$trx_additional->subtotal1->setDbValue($rs->fields('subtotal1'));
		$trx_additional->ppn->setDbValue($rs->fields('ppn'));
		$trx_additional->subtotal2->setDbValue($rs->fields('subtotal2'));
		$trx_additional->service->setDbValue($rs->fields('service'));
		$trx_additional->grandtotal->setDbValue($rs->fields('grandtotal'));
		$trx_additional->notes->setDbValue($rs->fields('notes'));
		$trx_additional->createby->setDbValue($rs->fields('createby'));
		$trx_additional->createdate->setDbValue($rs->fields('createdate'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $trx_additional;

		// Call Row_Rendering event
		$trx_additional->Row_Rendering();

		// Common render codes for all row types
		// kode

		$trx_additional->kode->CellCssStyle = "white-space: nowrap;";
		$trx_additional->kode->CellCssClass = "";

		// tanggal
		$trx_additional->tanggal->CellCssStyle = "white-space: nowrap;";
		$trx_additional->tanggal->CellCssClass = "";

		// room
		$trx_additional->room->CellCssStyle = "white-space: nowrap;";
		$trx_additional->room->CellCssClass = "";

		// grandtotal
		$trx_additional->grandtotal->CellCssStyle = "white-space: nowrap;";
		$trx_additional->grandtotal->CellCssClass = "";
		if ($trx_additional->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$trx_additional->kode->ViewValue = $trx_additional->kode->CurrentValue;
			$trx_additional->kode->CssStyle = "";
			$trx_additional->kode->CssClass = "";
			$trx_additional->kode->ViewCustomAttributes = "";

			// seqno
			$trx_additional->seqno->ViewValue = $trx_additional->seqno->CurrentValue;
			$trx_additional->seqno->CssStyle = "";
			$trx_additional->seqno->CssClass = "";
			$trx_additional->seqno->ViewCustomAttributes = "";

			// tanggal
			$trx_additional->tanggal->ViewValue = $trx_additional->tanggal->CurrentValue;
			$trx_additional->tanggal->ViewValue = ew_FormatDateTime($trx_additional->tanggal->ViewValue, 7);
			$trx_additional->tanggal->CssStyle = "";
			$trx_additional->tanggal->CssClass = "";
			$trx_additional->tanggal->ViewCustomAttributes = "";

			// room
			if (strval($trx_additional->room->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `mst_room` WHERE `kode` = '" . ew_AdjustSql($trx_additional->room->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$trx_additional->room->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$trx_additional->room->ViewValue = $trx_additional->room->CurrentValue;
				}
			} else {
				$trx_additional->room->ViewValue = NULL;
			}
			$trx_additional->room->CssStyle = "";
			$trx_additional->room->CssClass = "";
			$trx_additional->room->ViewCustomAttributes = "";

			// withppn
			$trx_additional->withppn->ViewValue = $trx_additional->withppn->CurrentValue;
			$trx_additional->withppn->CssStyle = "";
			$trx_additional->withppn->CssClass = "";
			$trx_additional->withppn->ViewCustomAttributes = "";

			// withservice
			$trx_additional->withservice->ViewValue = $trx_additional->withservice->CurrentValue;
			$trx_additional->withservice->CssStyle = "";
			$trx_additional->withservice->CssClass = "";
			$trx_additional->withservice->ViewCustomAttributes = "";

			// subtotal1
			$trx_additional->subtotal1->ViewValue = $trx_additional->subtotal1->CurrentValue;
			$trx_additional->subtotal1->CssStyle = "";
			$trx_additional->subtotal1->CssClass = "";
			$trx_additional->subtotal1->ViewCustomAttributes = "";

			// ppn
			$trx_additional->ppn->ViewValue = $trx_additional->ppn->CurrentValue;
			$trx_additional->ppn->CssStyle = "";
			$trx_additional->ppn->CssClass = "";
			$trx_additional->ppn->ViewCustomAttributes = "";

			// subtotal2
			$trx_additional->subtotal2->ViewValue = $trx_additional->subtotal2->CurrentValue;
			$trx_additional->subtotal2->CssStyle = "";
			$trx_additional->subtotal2->CssClass = "";
			$trx_additional->subtotal2->ViewCustomAttributes = "";

			// service
			$trx_additional->service->ViewValue = $trx_additional->service->CurrentValue;
			$trx_additional->service->CssStyle = "";
			$trx_additional->service->CssClass = "";
			$trx_additional->service->ViewCustomAttributes = "";

			// grandtotal
			$trx_additional->grandtotal->ViewValue = $trx_additional->grandtotal->CurrentValue;
			$trx_additional->grandtotal->ViewValue = ew_FormatNumber($trx_additional->grandtotal->ViewValue, 0, -2, -2, -2);
			$trx_additional->grandtotal->CssStyle = "text-align:right;";
			$trx_additional->grandtotal->CssClass = "";
			$trx_additional->grandtotal->ViewCustomAttributes = "";

			// notes
			$trx_additional->notes->ViewValue = $trx_additional->notes->CurrentValue;
			$trx_additional->notes->CssStyle = "";
			$trx_additional->notes->CssClass = "";
			$trx_additional->notes->ViewCustomAttributes = "";

			// createby
			$trx_additional->createby->ViewValue = $trx_additional->createby->CurrentValue;
			$trx_additional->createby->CssStyle = "";
			$trx_additional->createby->CssClass = "";
			$trx_additional->createby->ViewCustomAttributes = "";

			// createdate
			$trx_additional->createdate->ViewValue = $trx_additional->createdate->CurrentValue;
			$trx_additional->createdate->ViewValue = ew_FormatDateTime($trx_additional->createdate->ViewValue, 7);
			$trx_additional->createdate->CssStyle = "";
			$trx_additional->createdate->CssClass = "";
			$trx_additional->createdate->ViewCustomAttributes = "";

			// kode
			$trx_additional->kode->HrefValue = "";

			// tanggal
			$trx_additional->tanggal->HrefValue = "";

			// room
			$trx_additional->room->HrefValue = "";

			// grandtotal
			$trx_additional->grandtotal->HrefValue = "";
		} elseif ($trx_additional->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// kode
			$trx_additional->kode->EditCustomAttributes = "";
			$trx_additional->kode->EditValue = ew_HtmlEncode($trx_additional->kode->AdvancedSearch->SearchValue);

			// tanggal
			$trx_additional->tanggal->EditCustomAttributes = "";
			$trx_additional->tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($trx_additional->tanggal->AdvancedSearch->SearchValue, 7), 7));

			// room
			$trx_additional->room->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_room`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$trx_additional->room->EditValue = $arwrk;

			// grandtotal
			$trx_additional->grandtotal->EditCustomAttributes = "";
			$trx_additional->grandtotal->EditValue = ew_HtmlEncode($trx_additional->grandtotal->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		$trx_additional->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $trx_additional;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckEuroDate($trx_additional->tanggal->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Tanggal";
		}
		if (!ew_CheckNumber($trx_additional->grandtotal->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect floating point number - Grandtotal";
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

	// Load advanced search
	function LoadAdvancedSearch() {
		global $trx_additional;
		$trx_additional->kode->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_kode");
		$trx_additional->seqno->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_seqno");
		$trx_additional->tanggal->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_tanggal");
		$trx_additional->room->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_room");
		$trx_additional->withppn->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_withppn");
		$trx_additional->withservice->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_withservice");
		$trx_additional->subtotal1->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_subtotal1");
		$trx_additional->ppn->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_ppn");
		$trx_additional->subtotal2->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_subtotal2");
		$trx_additional->service->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_service");
		$trx_additional->grandtotal->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_grandtotal");
		$trx_additional->notes->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_notes");
		$trx_additional->createby->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_createby");
		$trx_additional->createdate->AdvancedSearch->SearchValue = $trx_additional->getAdvancedSearch("x_createdate");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $trx_additional;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($trx_additional->ExportAll) {
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
		if ($trx_additional->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($trx_additional->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $trx_additional->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'kode', $trx_additional->Export);
				ew_ExportAddValue($sExportStr, 'seqno', $trx_additional->Export);
				ew_ExportAddValue($sExportStr, 'tanggal', $trx_additional->Export);
				ew_ExportAddValue($sExportStr, 'room', $trx_additional->Export);
				ew_ExportAddValue($sExportStr, 'withppn', $trx_additional->Export);
				ew_ExportAddValue($sExportStr, 'withservice', $trx_additional->Export);
				ew_ExportAddValue($sExportStr, 'subtotal1', $trx_additional->Export);
				ew_ExportAddValue($sExportStr, 'ppn', $trx_additional->Export);
				ew_ExportAddValue($sExportStr, 'subtotal2', $trx_additional->Export);
				ew_ExportAddValue($sExportStr, 'service', $trx_additional->Export);
				ew_ExportAddValue($sExportStr, 'grandtotal', $trx_additional->Export);
				ew_ExportAddValue($sExportStr, 'notes', $trx_additional->Export);
				ew_ExportAddValue($sExportStr, 'createby', $trx_additional->Export);
				ew_ExportAddValue($sExportStr, 'createdate', $trx_additional->Export);
				echo ew_ExportLine($sExportStr, $trx_additional->Export);
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
				$trx_additional->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($trx_additional->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('kode', $trx_additional->kode->CurrentValue);
					$XmlDoc->AddField('seqno', $trx_additional->seqno->CurrentValue);
					$XmlDoc->AddField('tanggal', $trx_additional->tanggal->CurrentValue);
					$XmlDoc->AddField('room', $trx_additional->room->CurrentValue);
					$XmlDoc->AddField('withppn', $trx_additional->withppn->CurrentValue);
					$XmlDoc->AddField('withservice', $trx_additional->withservice->CurrentValue);
					$XmlDoc->AddField('subtotal1', $trx_additional->subtotal1->CurrentValue);
					$XmlDoc->AddField('ppn', $trx_additional->ppn->CurrentValue);
					$XmlDoc->AddField('subtotal2', $trx_additional->subtotal2->CurrentValue);
					$XmlDoc->AddField('service', $trx_additional->service->CurrentValue);
					$XmlDoc->AddField('grandtotal', $trx_additional->grandtotal->CurrentValue);
					$XmlDoc->AddField('notes', $trx_additional->notes->CurrentValue);
					$XmlDoc->AddField('createby', $trx_additional->createby->CurrentValue);
					$XmlDoc->AddField('createdate', $trx_additional->createdate->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $trx_additional->Export <> "csv") { // Vertical format
						echo ew_ExportField('kode', $trx_additional->kode->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						echo ew_ExportField('seqno', $trx_additional->seqno->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						echo ew_ExportField('tanggal', $trx_additional->tanggal->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						echo ew_ExportField('room', $trx_additional->room->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						echo ew_ExportField('withppn', $trx_additional->withppn->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						echo ew_ExportField('withservice', $trx_additional->withservice->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						echo ew_ExportField('subtotal1', $trx_additional->subtotal1->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						echo ew_ExportField('ppn', $trx_additional->ppn->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						echo ew_ExportField('subtotal2', $trx_additional->subtotal2->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						echo ew_ExportField('service', $trx_additional->service->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						echo ew_ExportField('grandtotal', $trx_additional->grandtotal->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						echo ew_ExportField('notes', $trx_additional->notes->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						echo ew_ExportField('createby', $trx_additional->createby->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						echo ew_ExportField('createdate', $trx_additional->createdate->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $trx_additional->kode->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						ew_ExportAddValue($sExportStr, $trx_additional->seqno->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						ew_ExportAddValue($sExportStr, $trx_additional->tanggal->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						ew_ExportAddValue($sExportStr, $trx_additional->room->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						ew_ExportAddValue($sExportStr, $trx_additional->withppn->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						ew_ExportAddValue($sExportStr, $trx_additional->withservice->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						ew_ExportAddValue($sExportStr, $trx_additional->subtotal1->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						ew_ExportAddValue($sExportStr, $trx_additional->ppn->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						ew_ExportAddValue($sExportStr, $trx_additional->subtotal2->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						ew_ExportAddValue($sExportStr, $trx_additional->service->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						ew_ExportAddValue($sExportStr, $trx_additional->grandtotal->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						ew_ExportAddValue($sExportStr, $trx_additional->notes->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						ew_ExportAddValue($sExportStr, $trx_additional->createby->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						ew_ExportAddValue($sExportStr, $trx_additional->createdate->ExportValue($trx_additional->Export, $trx_additional->ExportOriginalValue), $trx_additional->Export);
						echo ew_ExportLine($sExportStr, $trx_additional->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($trx_additional->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($trx_additional->Export);
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'trx_additional';

		// Write Audit Trail
		$filePfx = "log";
		$curDate = date("Y/m/d");
		$curTime = date("H:i:s");
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		$action = $typ;
		ew_WriteAuditTrail($filePfx, $curDate, $curTime, $id, $curUser, $action, $table, "", "", "", "");
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
