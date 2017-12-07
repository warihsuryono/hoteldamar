<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "acc_design_report_rlinfo.php" ?>
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
$acc_design_report_rl_list = new cacc_design_report_rl_list();
$Page =& $acc_design_report_rl_list;

// Page init processing
$acc_design_report_rl_list->Page_Init();

// Page main processing
$acc_design_report_rl_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($acc_design_report_rl->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var acc_design_report_rl_list = new ew_Page("acc_design_report_rl_list");

// page properties
acc_design_report_rl_list.PageID = "list"; // page ID
var EW_PAGE_ID = acc_design_report_rl_list.PageID; // for backward compatibility

// extend page with validate function for search
acc_design_report_rl_list.ValidateSearch = function(fobj) {
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
acc_design_report_rl_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
acc_design_report_rl_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
acc_design_report_rl_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
acc_design_report_rl_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($acc_design_report_rl->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($acc_design_report_rl->Export == "" && $acc_design_report_rl->SelectLimit);
	if (!$bSelectLimit)
		$rs = $acc_design_report_rl_list->LoadRecordset();
	$acc_design_report_rl_list->lTotalRecs = ($bSelectLimit) ? $acc_design_report_rl->SelectRecordCount() : $rs->RecordCount();
	$acc_design_report_rl_list->lStartRec = 1;
	if ($acc_design_report_rl_list->lDisplayRecs <= 0) // Display all records
		$acc_design_report_rl_list->lDisplayRecs = $acc_design_report_rl_list->lTotalRecs;
	if (!($acc_design_report_rl->ExportAll && $acc_design_report_rl->Export <> ""))
		$acc_design_report_rl_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $acc_design_report_rl_list->LoadRecordset($acc_design_report_rl_list->lStartRec-1, $acc_design_report_rl_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Design Report RL</b></h3>
<?php if ($acc_design_report_rl->Export == "" && $acc_design_report_rl->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $acc_design_report_rl_list->PageUrl() ?>export=print"><img src="images/print.gif" title="Printer Friendly" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $acc_design_report_rl_list->PageUrl() ?>export=html"><img src="images/exporthtml.gif" title="Export to HTML" width="16" height="16" border="0"></a-->
&nbsp;&nbsp;<a href="<?php echo $acc_design_report_rl_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $acc_design_report_rl_list->PageUrl() ?>export=word"><img src="images/exportdoc.gif" title="Export to Word" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $acc_design_report_rl_list->PageUrl() ?>export=xml"><img src="images/exportxml.gif" title="Export to XML" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $acc_design_report_rl_list->PageUrl() ?>export=csv"><img src="images/exportcsv.gif" title="Export to CSV" width="16" height="16" border="0"></a-->
<?php } ?>
</span></p>
<?php if ($acc_design_report_rl->Export == "" && $acc_design_report_rl->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(acc_design_report_rl_list);" style="text-decoration: none;"><img id="acc_design_report_rl_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="acc_design_report_rl_list_SearchPanel">
<form name="facc_design_report_rllistsrch" id="facc_design_report_rllistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return acc_design_report_rl_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="acc_design_report_rl">
<?php
if ($gsSearchError == "")
	$acc_design_report_rl_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$acc_design_report_rl->RowType = EW_ROWTYPE_SEARCH;

// Render row
$acc_design_report_rl_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Kode Design</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kodedesign" id="z_kodedesign" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kodedesign" id="x_kodedesign" size="30" maxlength="30" value="<?php echo $acc_design_report_rl->kodedesign->EditValue ?>"<?php echo $acc_design_report_rl->kodedesign->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Nama Design</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_nama" id="z_nama" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_nama" id="x_nama" size="30" maxlength="255" value="<?php echo $acc_design_report_rl->nama->EditValue ?>"<?php echo $acc_design_report_rl->nama->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Title</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_title" id="z_title" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<textarea name="x_title" id="x_title" cols="35" rows="4"<?php echo $acc_design_report_rl->title->EditAttributes() ?>><?php echo $acc_design_report_rl->title->EditValue ?></textarea>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Dibuat Oleh</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_createby" id="z_createby" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_createby" name="x_createby"<?php echo $acc_design_report_rl->createby->EditAttributes() ?>>
<?php
if (is_array($acc_design_report_rl->createby->EditValue)) {
	$arwrk = $acc_design_report_rl->createby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($acc_design_report_rl->createby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<!--a href="<?php echo $acc_design_report_rl_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $acc_design_report_rl_list->PageUrl() ?>cmd=reset';">
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $acc_design_report_rl_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($acc_design_report_rl->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($acc_design_report_rl->CurrentAction <> "gridadd" && $acc_design_report_rl->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($acc_design_report_rl_list->Pager)) $acc_design_report_rl_list->Pager = new cPrevNextPager($acc_design_report_rl_list->lStartRec, $acc_design_report_rl_list->lDisplayRecs, $acc_design_report_rl_list->lTotalRecs) ?>
<?php if ($acc_design_report_rl_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($acc_design_report_rl_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $acc_design_report_rl_list->PageUrl() ?>start=<?php echo $acc_design_report_rl_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($acc_design_report_rl_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $acc_design_report_rl_list->PageUrl() ?>start=<?php echo $acc_design_report_rl_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $acc_design_report_rl_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($acc_design_report_rl_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $acc_design_report_rl_list->PageUrl() ?>start=<?php echo $acc_design_report_rl_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($acc_design_report_rl_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $acc_design_report_rl_list->PageUrl() ?>start=<?php echo $acc_design_report_rl_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $acc_design_report_rl_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $acc_design_report_rl_list->Pager->FromIndex ?> to <?php echo $acc_design_report_rl_list->Pager->ToIndex ?> of <?php echo $acc_design_report_rl_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($acc_design_report_rl_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($acc_design_report_rl_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="acc_design_report_rl">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($acc_design_report_rl_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($acc_design_report_rl_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($acc_design_report_rl_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="50"<?php if ($acc_design_report_rl_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($acc_design_report_rl_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($acc_design_report_rl_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $acc_design_report_rl->AddUrl() ?>"><img src="images/expand.gif" title="Add" width="16" height="16" border="0"></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="facc_design_report_rllist" id="facc_design_report_rllist" class="ewForm" action="" method="post">
<?php if ($acc_design_report_rl_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$acc_design_report_rl_list->lOptionCnt = 0;
	$acc_design_report_rl_list->lOptionCnt += count($acc_design_report_rl_list->ListOptions->Items); // Custom list options
?>
<?php echo $acc_design_report_rl->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($acc_design_report_rl->Export == "") { ?>
<?php

// Custom list options
foreach ($acc_design_report_rl_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($acc_design_report_rl->actionlink->Visible) { // actionlink ?>
	<?php if ($acc_design_report_rl->SortUrl($acc_design_report_rl->actionlink) == "") { ?>
		<td style="white-space: nowrap;"></td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_design_report_rl->SortUrl($acc_design_report_rl->actionlink) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td></td><td style="width: 10px;"><?php if ($acc_design_report_rl->actionlink->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_design_report_rl->actionlink->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($acc_design_report_rl->kodedesign->Visible) { // kodedesign ?>
	<?php if ($acc_design_report_rl->SortUrl($acc_design_report_rl->kodedesign) == "") { ?>
		<td style="white-space: nowrap;">Kode Design</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_design_report_rl->SortUrl($acc_design_report_rl->kodedesign) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode Design</td><td style="width: 10px;"><?php if ($acc_design_report_rl->kodedesign->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_design_report_rl->kodedesign->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($acc_design_report_rl->nama->Visible) { // nama ?>
	<?php if ($acc_design_report_rl->SortUrl($acc_design_report_rl->nama) == "") { ?>
		<td style="white-space: nowrap;">Nama Design</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_design_report_rl->SortUrl($acc_design_report_rl->nama) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Nama Design</td><td style="width: 10px;"><?php if ($acc_design_report_rl->nama->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_design_report_rl->nama->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($acc_design_report_rl->title->Visible) { // title ?>
	<?php if ($acc_design_report_rl->SortUrl($acc_design_report_rl->title) == "") { ?>
		<td>Title</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_design_report_rl->SortUrl($acc_design_report_rl->title) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Title</td><td style="width: 10px;"><?php if ($acc_design_report_rl->title->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_design_report_rl->title->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($acc_design_report_rl->createby->Visible) { // createby ?>
	<?php if ($acc_design_report_rl->SortUrl($acc_design_report_rl->createby) == "") { ?>
		<td style="white-space: nowrap;">Dibuat Oleh</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_design_report_rl->SortUrl($acc_design_report_rl->createby) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Dibuat Oleh</td><td style="width: 10px;"><?php if ($acc_design_report_rl->createby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_design_report_rl->createby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($acc_design_report_rl->ExportAll && $acc_design_report_rl->Export <> "") {
	$acc_design_report_rl_list->lStopRec = $acc_design_report_rl_list->lTotalRecs;
} else {
	$acc_design_report_rl_list->lStopRec = $acc_design_report_rl_list->lStartRec + $acc_design_report_rl_list->lDisplayRecs - 1; // Set the last record to display
}
$acc_design_report_rl_list->lRecCount = $acc_design_report_rl_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$acc_design_report_rl->SelectLimit && $acc_design_report_rl_list->lStartRec > 1)
		$rs->Move($acc_design_report_rl_list->lStartRec - 1);
}
$acc_design_report_rl_list->lRowCnt = 0;
while (($acc_design_report_rl->CurrentAction == "gridadd" || !$rs->EOF) &&
	$acc_design_report_rl_list->lRecCount < $acc_design_report_rl_list->lStopRec) {
	$acc_design_report_rl_list->lRecCount++;
	if (intval($acc_design_report_rl_list->lRecCount) >= intval($acc_design_report_rl_list->lStartRec)) {
		$acc_design_report_rl_list->lRowCnt++;

	// Init row class and style
	$acc_design_report_rl->CssClass = "";
	$acc_design_report_rl->CssStyle = "";
	$acc_design_report_rl->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($acc_design_report_rl->CurrentAction == "gridadd") {
		$acc_design_report_rl_list->LoadDefaultValues(); // Load default values
	} else {
		$acc_design_report_rl_list->LoadRowValues($rs); // Load row values
	}
	$acc_design_report_rl->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$acc_design_report_rl_list->RenderRow();
?>
	<tr<?php echo $acc_design_report_rl->RowAttributes() ?>>
<?php if ($acc_design_report_rl->Export == "") { ?>
<?php

// Custom list options
foreach ($acc_design_report_rl_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($acc_design_report_rl->actionlink->Visible) { // actionlink ?>
		<td<?php echo $acc_design_report_rl->actionlink->CellAttributes() ?>>
<div<?php echo $acc_design_report_rl->actionlink->ViewAttributes() ?>><?php echo $acc_design_report_rl->actionlink->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($acc_design_report_rl->kodedesign->Visible) { // kodedesign ?>
		<td<?php echo $acc_design_report_rl->kodedesign->CellAttributes() ?>>
<div<?php echo $acc_design_report_rl->kodedesign->ViewAttributes() ?>><?php echo $acc_design_report_rl->kodedesign->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($acc_design_report_rl->nama->Visible) { // nama ?>
		<td<?php echo $acc_design_report_rl->nama->CellAttributes() ?>>
<div<?php echo $acc_design_report_rl->nama->ViewAttributes() ?>><?php echo $acc_design_report_rl->nama->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($acc_design_report_rl->title->Visible) { // title ?>
		<td<?php echo $acc_design_report_rl->title->CellAttributes() ?>>
<div<?php echo $acc_design_report_rl->title->ViewAttributes() ?>><?php echo $acc_design_report_rl->title->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($acc_design_report_rl->createby->Visible) { // createby ?>
		<td<?php echo $acc_design_report_rl->createby->CellAttributes() ?>>
<div<?php echo $acc_design_report_rl->createby->ViewAttributes() ?>><?php echo $acc_design_report_rl->createby->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($acc_design_report_rl->CurrentAction <> "gridadd")
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
<?php if ($acc_design_report_rl->Export == "" && $acc_design_report_rl->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
//ew_ToggleSearchPanel(acc_design_report_rl_list); // uncomment to init search panel as collapsed

//-->
</script>
<?php } ?>
<?php if ($acc_design_report_rl->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$acc_design_report_rl_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cacc_design_report_rl_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'acc_design_report_rl';

	// Page Object Name
	var $PageObjName = 'acc_design_report_rl_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $acc_design_report_rl;
		if ($acc_design_report_rl->UseTokenInUrl) $PageUrl .= "t=" . $acc_design_report_rl->TableVar . "&"; // add page token
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
		global $objForm, $acc_design_report_rl;
		if ($acc_design_report_rl->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($acc_design_report_rl->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($acc_design_report_rl->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cacc_design_report_rl_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["acc_design_report_rl"] = new cacc_design_report_rl();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'acc_design_report_rl', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $acc_design_report_rl;
	$acc_design_report_rl->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $acc_design_report_rl->Export; // Get export parameter, used in header
	$gsExportFile = $acc_design_report_rl->TableVar; // Get export file, used in header
	if ($acc_design_report_rl->Export == "print" || $acc_design_report_rl->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($acc_design_report_rl->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($acc_design_report_rl->Export == "word") {
		header('Content-Type: application/vnd.ms-word');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($acc_design_report_rl->Export == "xml") {
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($acc_design_report_rl->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $acc_design_report_rl;
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
		if ($acc_design_report_rl->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $acc_design_report_rl->getRecordsPerPage(); // Restore from Session
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
		$acc_design_report_rl->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$acc_design_report_rl->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$acc_design_report_rl->setStartRecordNumber($this->lStartRec);
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
		$acc_design_report_rl->setSessionWhere($sFilter);
		$acc_design_report_rl->CurrentFilter = "";

		// Export data only
		if (in_array($acc_design_report_rl->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $acc_design_report_rl;
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
			$acc_design_report_rl->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$acc_design_report_rl->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $acc_design_report_rl;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $acc_design_report_rl->actionlink, FALSE); // Field actionlink
		$this->BuildSearchSql($sWhere, $acc_design_report_rl->kodedesign, FALSE); // Field kodedesign
		$this->BuildSearchSql($sWhere, $acc_design_report_rl->idseqno, FALSE); // Field idseqno
		$this->BuildSearchSql($sWhere, $acc_design_report_rl->nama, FALSE); // Field nama
		$this->BuildSearchSql($sWhere, $acc_design_report_rl->title, FALSE); // Field title
		$this->BuildSearchSql($sWhere, $acc_design_report_rl->footer, FALSE); // Field footer
		$this->BuildSearchSql($sWhere, $acc_design_report_rl->createby, FALSE); // Field createby
		$this->BuildSearchSql($sWhere, $acc_design_report_rl->createdate, FALSE); // Field createdate

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($acc_design_report_rl->actionlink); // Field actionlink
			$this->SetSearchParm($acc_design_report_rl->kodedesign); // Field kodedesign
			$this->SetSearchParm($acc_design_report_rl->idseqno); // Field idseqno
			$this->SetSearchParm($acc_design_report_rl->nama); // Field nama
			$this->SetSearchParm($acc_design_report_rl->title); // Field title
			$this->SetSearchParm($acc_design_report_rl->footer); // Field footer
			$this->SetSearchParm($acc_design_report_rl->createby); // Field createby
			$this->SetSearchParm($acc_design_report_rl->createdate); // Field createdate
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
		global $acc_design_report_rl;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$acc_design_report_rl->setAdvancedSearch("x_$FldParm", $FldVal);
		$acc_design_report_rl->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$acc_design_report_rl->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$acc_design_report_rl->setAdvancedSearch("y_$FldParm", $FldVal2);
		$acc_design_report_rl->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $acc_design_report_rl;
		$this->sSrchWhere = "";
		$acc_design_report_rl->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $acc_design_report_rl;
		$acc_design_report_rl->setAdvancedSearch("x_actionlink", "");
		$acc_design_report_rl->setAdvancedSearch("x_kodedesign", "");
		$acc_design_report_rl->setAdvancedSearch("x_idseqno", "");
		$acc_design_report_rl->setAdvancedSearch("x_nama", "");
		$acc_design_report_rl->setAdvancedSearch("x_title", "");
		$acc_design_report_rl->setAdvancedSearch("x_footer", "");
		$acc_design_report_rl->setAdvancedSearch("x_createby", "");
		$acc_design_report_rl->setAdvancedSearch("x_createdate", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $acc_design_report_rl;
		$this->sSrchWhere = $acc_design_report_rl->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $acc_design_report_rl;
		 $acc_design_report_rl->actionlink->AdvancedSearch->SearchValue = $acc_design_report_rl->getAdvancedSearch("x_actionlink");
		 $acc_design_report_rl->kodedesign->AdvancedSearch->SearchValue = $acc_design_report_rl->getAdvancedSearch("x_kodedesign");
		 $acc_design_report_rl->idseqno->AdvancedSearch->SearchValue = $acc_design_report_rl->getAdvancedSearch("x_idseqno");
		 $acc_design_report_rl->nama->AdvancedSearch->SearchValue = $acc_design_report_rl->getAdvancedSearch("x_nama");
		 $acc_design_report_rl->title->AdvancedSearch->SearchValue = $acc_design_report_rl->getAdvancedSearch("x_title");
		 $acc_design_report_rl->footer->AdvancedSearch->SearchValue = $acc_design_report_rl->getAdvancedSearch("x_footer");
		 $acc_design_report_rl->createby->AdvancedSearch->SearchValue = $acc_design_report_rl->getAdvancedSearch("x_createby");
		 $acc_design_report_rl->createdate->AdvancedSearch->SearchValue = $acc_design_report_rl->getAdvancedSearch("x_createdate");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $acc_design_report_rl;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$acc_design_report_rl->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$acc_design_report_rl->CurrentOrderType = @$_GET["ordertype"];
			$acc_design_report_rl->UpdateSort($acc_design_report_rl->actionlink); // Field 
			$acc_design_report_rl->UpdateSort($acc_design_report_rl->kodedesign); // Field 
			$acc_design_report_rl->UpdateSort($acc_design_report_rl->nama); // Field 
			$acc_design_report_rl->UpdateSort($acc_design_report_rl->title); // Field 
			$acc_design_report_rl->UpdateSort($acc_design_report_rl->createby); // Field 
			$acc_design_report_rl->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $acc_design_report_rl;
		$sOrderBy = $acc_design_report_rl->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($acc_design_report_rl->SqlOrderBy() <> "") {
				$sOrderBy = $acc_design_report_rl->SqlOrderBy();
				$acc_design_report_rl->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $acc_design_report_rl;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$acc_design_report_rl->setSessionOrderBy($sOrderBy);
				$acc_design_report_rl->actionlink->setSort("");
				$acc_design_report_rl->kodedesign->setSort("");
				$acc_design_report_rl->nama->setSort("");
				$acc_design_report_rl->title->setSort("");
				$acc_design_report_rl->createby->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$acc_design_report_rl->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $acc_design_report_rl;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$acc_design_report_rl->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$acc_design_report_rl->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $acc_design_report_rl->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$acc_design_report_rl->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$acc_design_report_rl->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$acc_design_report_rl->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $acc_design_report_rl;

		// Load search values
		// actionlink

		$acc_design_report_rl->actionlink->AdvancedSearch->SearchValue = @$_GET["x_actionlink"];
		$acc_design_report_rl->actionlink->AdvancedSearch->SearchOperator = @$_GET["z_actionlink"];

		// kodedesign
		$acc_design_report_rl->kodedesign->AdvancedSearch->SearchValue = @$_GET["x_kodedesign"];
		$acc_design_report_rl->kodedesign->AdvancedSearch->SearchOperator = @$_GET["z_kodedesign"];

		// idseqno
		$acc_design_report_rl->idseqno->AdvancedSearch->SearchValue = @$_GET["x_idseqno"];
		$acc_design_report_rl->idseqno->AdvancedSearch->SearchOperator = @$_GET["z_idseqno"];

		// nama
		$acc_design_report_rl->nama->AdvancedSearch->SearchValue = @$_GET["x_nama"];
		$acc_design_report_rl->nama->AdvancedSearch->SearchOperator = @$_GET["z_nama"];

		// title
		$acc_design_report_rl->title->AdvancedSearch->SearchValue = @$_GET["x_title"];
		$acc_design_report_rl->title->AdvancedSearch->SearchOperator = @$_GET["z_title"];

		// footer
		$acc_design_report_rl->footer->AdvancedSearch->SearchValue = @$_GET["x_footer"];
		$acc_design_report_rl->footer->AdvancedSearch->SearchOperator = @$_GET["z_footer"];

		// createby
		$acc_design_report_rl->createby->AdvancedSearch->SearchValue = @$_GET["x_createby"];
		$acc_design_report_rl->createby->AdvancedSearch->SearchOperator = @$_GET["z_createby"];

		// createdate
		$acc_design_report_rl->createdate->AdvancedSearch->SearchValue = @$_GET["x_createdate"];
		$acc_design_report_rl->createdate->AdvancedSearch->SearchOperator = @$_GET["z_createdate"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $acc_design_report_rl;

		// Call Recordset Selecting event
		$acc_design_report_rl->Recordset_Selecting($acc_design_report_rl->CurrentFilter);

		// Load list page SQL
		$sSql = $acc_design_report_rl->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$acc_design_report_rl->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $acc_design_report_rl;
		$sFilter = $acc_design_report_rl->KeyFilter();

		// Call Row Selecting event
		$acc_design_report_rl->Row_Selecting($sFilter);

		// Load sql based on filter
		$acc_design_report_rl->CurrentFilter = $sFilter;
		$sSql = $acc_design_report_rl->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$acc_design_report_rl->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $acc_design_report_rl;
		$acc_design_report_rl->actionlink->setDbValue($rs->fields('actionlink'));
		$acc_design_report_rl->kodedesign->setDbValue($rs->fields('kodedesign'));
		$acc_design_report_rl->idseqno->setDbValue($rs->fields('idseqno'));
		$acc_design_report_rl->nama->setDbValue($rs->fields('nama'));
		$acc_design_report_rl->title->setDbValue($rs->fields('title'));
		$acc_design_report_rl->footer->setDbValue($rs->fields('footer'));
		$acc_design_report_rl->createby->setDbValue($rs->fields('createby'));
		$acc_design_report_rl->createdate->setDbValue($rs->fields('createdate'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $acc_design_report_rl;

		// Call Row_Rendering event
		$acc_design_report_rl->Row_Rendering();

		// Common render codes for all row types
		// actionlink

		$acc_design_report_rl->actionlink->CellCssStyle = "white-space: nowrap;";
		$acc_design_report_rl->actionlink->CellCssClass = "";

		// kodedesign
		$acc_design_report_rl->kodedesign->CellCssStyle = "white-space: nowrap;";
		$acc_design_report_rl->kodedesign->CellCssClass = "";

		// nama
		$acc_design_report_rl->nama->CellCssStyle = "white-space: nowrap;";
		$acc_design_report_rl->nama->CellCssClass = "";

		// title
		$acc_design_report_rl->title->CellCssStyle = "";
		$acc_design_report_rl->title->CellCssClass = "";

		// createby
		$acc_design_report_rl->createby->CellCssStyle = "white-space: nowrap;";
		$acc_design_report_rl->createby->CellCssClass = "";
		if ($acc_design_report_rl->RowType == EW_ROWTYPE_VIEW) { // View row

			// actionlink
			$acc_design_report_rl->actionlink->ViewValue = $acc_design_report_rl->actionlink->CurrentValue;
			$acc_design_report_rl->actionlink->CssStyle = "";
			$acc_design_report_rl->actionlink->CssClass = "";
			$acc_design_report_rl->actionlink->ViewCustomAttributes = "";

			// kodedesign
			$acc_design_report_rl->kodedesign->ViewValue = $acc_design_report_rl->kodedesign->CurrentValue;
			$acc_design_report_rl->kodedesign->CssStyle = "";
			$acc_design_report_rl->kodedesign->CssClass = "";
			$acc_design_report_rl->kodedesign->ViewCustomAttributes = "";

			// nama
			$acc_design_report_rl->nama->ViewValue = $acc_design_report_rl->nama->CurrentValue;
			$acc_design_report_rl->nama->CssStyle = "";
			$acc_design_report_rl->nama->CssClass = "";
			$acc_design_report_rl->nama->ViewCustomAttributes = "";

			// title
			$acc_design_report_rl->title->ViewValue = $acc_design_report_rl->title->CurrentValue;
			$acc_design_report_rl->title->CssStyle = "";
			$acc_design_report_rl->title->CssClass = "";
			$acc_design_report_rl->title->ViewCustomAttributes = "";

			// createby
			if (strval($acc_design_report_rl->createby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($acc_design_report_rl->createby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$acc_design_report_rl->createby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$acc_design_report_rl->createby->ViewValue = $acc_design_report_rl->createby->CurrentValue;
				}
			} else {
				$acc_design_report_rl->createby->ViewValue = NULL;
			}
			$acc_design_report_rl->createby->CssStyle = "";
			$acc_design_report_rl->createby->CssClass = "";
			$acc_design_report_rl->createby->ViewCustomAttributes = "";

			// actionlink
			$acc_design_report_rl->actionlink->HrefValue = "";

			// kodedesign
			$acc_design_report_rl->kodedesign->HrefValue = "";

			// nama
			$acc_design_report_rl->nama->HrefValue = "";

			// title
			$acc_design_report_rl->title->HrefValue = "";

			// createby
			$acc_design_report_rl->createby->HrefValue = "";
		} elseif ($acc_design_report_rl->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// actionlink
			$acc_design_report_rl->actionlink->EditCustomAttributes = "";
			$acc_design_report_rl->actionlink->EditValue = ew_HtmlEncode($acc_design_report_rl->actionlink->AdvancedSearch->SearchValue);

			// kodedesign
			$acc_design_report_rl->kodedesign->EditCustomAttributes = "";
			$acc_design_report_rl->kodedesign->EditValue = ew_HtmlEncode($acc_design_report_rl->kodedesign->AdvancedSearch->SearchValue);

			// nama
			$acc_design_report_rl->nama->EditCustomAttributes = "";
			$acc_design_report_rl->nama->EditValue = ew_HtmlEncode($acc_design_report_rl->nama->AdvancedSearch->SearchValue);

			// title
			$acc_design_report_rl->title->EditCustomAttributes = "";
			$acc_design_report_rl->title->EditValue = ew_HtmlEncode($acc_design_report_rl->title->AdvancedSearch->SearchValue);

			// createby
			$acc_design_report_rl->createby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$acc_design_report_rl->createby->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$acc_design_report_rl->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $acc_design_report_rl;

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
		global $acc_design_report_rl;
		$acc_design_report_rl->actionlink->AdvancedSearch->SearchValue = $acc_design_report_rl->getAdvancedSearch("x_actionlink");
		$acc_design_report_rl->kodedesign->AdvancedSearch->SearchValue = $acc_design_report_rl->getAdvancedSearch("x_kodedesign");
		$acc_design_report_rl->idseqno->AdvancedSearch->SearchValue = $acc_design_report_rl->getAdvancedSearch("x_idseqno");
		$acc_design_report_rl->nama->AdvancedSearch->SearchValue = $acc_design_report_rl->getAdvancedSearch("x_nama");
		$acc_design_report_rl->title->AdvancedSearch->SearchValue = $acc_design_report_rl->getAdvancedSearch("x_title");
		$acc_design_report_rl->footer->AdvancedSearch->SearchValue = $acc_design_report_rl->getAdvancedSearch("x_footer");
		$acc_design_report_rl->createby->AdvancedSearch->SearchValue = $acc_design_report_rl->getAdvancedSearch("x_createby");
		$acc_design_report_rl->createdate->AdvancedSearch->SearchValue = $acc_design_report_rl->getAdvancedSearch("x_createdate");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $acc_design_report_rl;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($acc_design_report_rl->ExportAll) {
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
		if ($acc_design_report_rl->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($acc_design_report_rl->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $acc_design_report_rl->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'kodedesign', $acc_design_report_rl->Export);
				ew_ExportAddValue($sExportStr, 'nama', $acc_design_report_rl->Export);
				ew_ExportAddValue($sExportStr, 'title', $acc_design_report_rl->Export);
				ew_ExportAddValue($sExportStr, 'createby', $acc_design_report_rl->Export);
				echo ew_ExportLine($sExportStr, $acc_design_report_rl->Export);
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
				$acc_design_report_rl->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($acc_design_report_rl->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('kodedesign', $acc_design_report_rl->kodedesign->CurrentValue);
					$XmlDoc->AddField('nama', $acc_design_report_rl->nama->CurrentValue);
					$XmlDoc->AddField('title', $acc_design_report_rl->title->CurrentValue);
					$XmlDoc->AddField('createby', $acc_design_report_rl->createby->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $acc_design_report_rl->Export <> "csv") { // Vertical format
						echo ew_ExportField('kodedesign', $acc_design_report_rl->kodedesign->ExportValue($acc_design_report_rl->Export, $acc_design_report_rl->ExportOriginalValue), $acc_design_report_rl->Export);
						echo ew_ExportField('nama', $acc_design_report_rl->nama->ExportValue($acc_design_report_rl->Export, $acc_design_report_rl->ExportOriginalValue), $acc_design_report_rl->Export);
						echo ew_ExportField('title', $acc_design_report_rl->title->ExportValue($acc_design_report_rl->Export, $acc_design_report_rl->ExportOriginalValue), $acc_design_report_rl->Export);
						echo ew_ExportField('createby', $acc_design_report_rl->createby->ExportValue($acc_design_report_rl->Export, $acc_design_report_rl->ExportOriginalValue), $acc_design_report_rl->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $acc_design_report_rl->kodedesign->ExportValue($acc_design_report_rl->Export, $acc_design_report_rl->ExportOriginalValue), $acc_design_report_rl->Export);
						ew_ExportAddValue($sExportStr, $acc_design_report_rl->nama->ExportValue($acc_design_report_rl->Export, $acc_design_report_rl->ExportOriginalValue), $acc_design_report_rl->Export);
						ew_ExportAddValue($sExportStr, $acc_design_report_rl->title->ExportValue($acc_design_report_rl->Export, $acc_design_report_rl->ExportOriginalValue), $acc_design_report_rl->Export);
						ew_ExportAddValue($sExportStr, $acc_design_report_rl->createby->ExportValue($acc_design_report_rl->Export, $acc_design_report_rl->ExportOriginalValue), $acc_design_report_rl->Export);
						echo ew_ExportLine($sExportStr, $acc_design_report_rl->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($acc_design_report_rl->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($acc_design_report_rl->Export);
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
