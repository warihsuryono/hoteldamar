<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "acc_design_report_glinfo.php" ?>
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
$acc_design_report_gl_list = new cacc_design_report_gl_list();
$Page =& $acc_design_report_gl_list;

// Page init processing
$acc_design_report_gl_list->Page_Init();

// Page main processing
$acc_design_report_gl_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($acc_design_report_gl->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var acc_design_report_gl_list = new ew_Page("acc_design_report_gl_list");

// page properties
acc_design_report_gl_list.PageID = "list"; // page ID
var EW_PAGE_ID = acc_design_report_gl_list.PageID; // for backward compatibility

// extend page with validate function for search
acc_design_report_gl_list.ValidateSearch = function(fobj) {
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
acc_design_report_gl_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
acc_design_report_gl_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
acc_design_report_gl_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
acc_design_report_gl_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($acc_design_report_gl->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($acc_design_report_gl->Export == "" && $acc_design_report_gl->SelectLimit);
	if (!$bSelectLimit)
		$rs = $acc_design_report_gl_list->LoadRecordset();
	$acc_design_report_gl_list->lTotalRecs = ($bSelectLimit) ? $acc_design_report_gl->SelectRecordCount() : $rs->RecordCount();
	$acc_design_report_gl_list->lStartRec = 1;
	if ($acc_design_report_gl_list->lDisplayRecs <= 0) // Display all records
		$acc_design_report_gl_list->lDisplayRecs = $acc_design_report_gl_list->lTotalRecs;
	if (!($acc_design_report_gl->ExportAll && $acc_design_report_gl->Export <> ""))
		$acc_design_report_gl_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $acc_design_report_gl_list->LoadRecordset($acc_design_report_gl_list->lStartRec-1, $acc_design_report_gl_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Design Report GL</b></h3>
<?php if ($acc_design_report_gl->Export == "" && $acc_design_report_gl->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $acc_design_report_gl_list->PageUrl() ?>export=print"><img src="images/print.gif" title="Printer Friendly" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $acc_design_report_gl_list->PageUrl() ?>export=html"><img src="images/exporthtml.gif" title="Export to HTML" width="16" height="16" border="0"></a-->
&nbsp;&nbsp;<a href="<?php echo $acc_design_report_gl_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $acc_design_report_gl_list->PageUrl() ?>export=word"><img src="images/exportdoc.gif" title="Export to Word" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $acc_design_report_gl_list->PageUrl() ?>export=xml"><img src="images/exportxml.gif" title="Export to XML" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $acc_design_report_gl_list->PageUrl() ?>export=csv"><img src="images/exportcsv.gif" title="Export to CSV" width="16" height="16" border="0"></a-->
<?php } ?>
</span></p>
<?php if ($acc_design_report_gl->Export == "" && $acc_design_report_gl->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(acc_design_report_gl_list);" style="text-decoration: none;"><img id="acc_design_report_gl_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="acc_design_report_gl_list_SearchPanel">
<form name="facc_design_report_gllistsrch" id="facc_design_report_gllistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return acc_design_report_gl_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="acc_design_report_gl">
<?php
if ($gsSearchError == "")
	$acc_design_report_gl_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$acc_design_report_gl->RowType = EW_ROWTYPE_SEARCH;

// Render row
$acc_design_report_gl_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Kode Design</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kodedesign" id="z_kodedesign" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kodedesign" id="x_kodedesign" size="30" maxlength="30" value="<?php echo $acc_design_report_gl->kodedesign->EditValue ?>"<?php echo $acc_design_report_gl->kodedesign->EditAttributes() ?>>
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
<input type="text" name="x_nama" id="x_nama" size="30" maxlength="255" value="<?php echo $acc_design_report_gl->nama->EditValue ?>"<?php echo $acc_design_report_gl->nama->EditAttributes() ?>>
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
<input type="text" name="x_title" id="x_title" size="30" maxlength="255" value="<?php echo $acc_design_report_gl->title->EditValue ?>"<?php echo $acc_design_report_gl->title->EditAttributes() ?>>
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
<select id="x_createby" name="x_createby"<?php echo $acc_design_report_gl->createby->EditAttributes() ?>>
<?php
if (is_array($acc_design_report_gl->createby->EditValue)) {
	$arwrk = $acc_design_report_gl->createby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($acc_design_report_gl->createby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<!--a href="<?php echo $acc_design_report_gl_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $acc_design_report_gl_list->PageUrl() ?>cmd=reset';">
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $acc_design_report_gl_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($acc_design_report_gl->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($acc_design_report_gl->CurrentAction <> "gridadd" && $acc_design_report_gl->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($acc_design_report_gl_list->Pager)) $acc_design_report_gl_list->Pager = new cPrevNextPager($acc_design_report_gl_list->lStartRec, $acc_design_report_gl_list->lDisplayRecs, $acc_design_report_gl_list->lTotalRecs) ?>
<?php if ($acc_design_report_gl_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($acc_design_report_gl_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $acc_design_report_gl_list->PageUrl() ?>start=<?php echo $acc_design_report_gl_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($acc_design_report_gl_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $acc_design_report_gl_list->PageUrl() ?>start=<?php echo $acc_design_report_gl_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $acc_design_report_gl_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($acc_design_report_gl_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $acc_design_report_gl_list->PageUrl() ?>start=<?php echo $acc_design_report_gl_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($acc_design_report_gl_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $acc_design_report_gl_list->PageUrl() ?>start=<?php echo $acc_design_report_gl_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $acc_design_report_gl_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $acc_design_report_gl_list->Pager->FromIndex ?> to <?php echo $acc_design_report_gl_list->Pager->ToIndex ?> of <?php echo $acc_design_report_gl_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($acc_design_report_gl_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($acc_design_report_gl_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="acc_design_report_gl">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($acc_design_report_gl_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($acc_design_report_gl_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($acc_design_report_gl_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="50"<?php if ($acc_design_report_gl_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($acc_design_report_gl_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($acc_design_report_gl_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $acc_design_report_gl->AddUrl() ?>"><img src="images/expand.gif" title="Add" width="16" height="16" border="0"></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="facc_design_report_gllist" id="facc_design_report_gllist" class="ewForm" action="" method="post">
<?php if ($acc_design_report_gl_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$acc_design_report_gl_list->lOptionCnt = 0;
	$acc_design_report_gl_list->lOptionCnt += count($acc_design_report_gl_list->ListOptions->Items); // Custom list options
?>
<?php echo $acc_design_report_gl->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($acc_design_report_gl->Export == "") { ?>
<?php

// Custom list options
foreach ($acc_design_report_gl_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($acc_design_report_gl->actionlink->Visible) { // actionlink ?>
	<?php if ($acc_design_report_gl->SortUrl($acc_design_report_gl->actionlink) == "") { ?>
		<td style="white-space: nowrap;"></td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_design_report_gl->SortUrl($acc_design_report_gl->actionlink) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td></td><td style="width: 10px;"><?php if ($acc_design_report_gl->actionlink->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_design_report_gl->actionlink->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($acc_design_report_gl->kodedesign->Visible) { // kodedesign ?>
	<?php if ($acc_design_report_gl->SortUrl($acc_design_report_gl->kodedesign) == "") { ?>
		<td style="white-space: nowrap;">Kode Design</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_design_report_gl->SortUrl($acc_design_report_gl->kodedesign) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode Design</td><td style="width: 10px;"><?php if ($acc_design_report_gl->kodedesign->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_design_report_gl->kodedesign->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($acc_design_report_gl->nama->Visible) { // nama ?>
	<?php if ($acc_design_report_gl->SortUrl($acc_design_report_gl->nama) == "") { ?>
		<td style="white-space: nowrap;">Nama Design</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_design_report_gl->SortUrl($acc_design_report_gl->nama) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Nama Design</td><td style="width: 10px;"><?php if ($acc_design_report_gl->nama->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_design_report_gl->nama->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($acc_design_report_gl->title->Visible) { // title ?>
	<?php if ($acc_design_report_gl->SortUrl($acc_design_report_gl->title) == "") { ?>
		<td>Title</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_design_report_gl->SortUrl($acc_design_report_gl->title) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Title</td><td style="width: 10px;"><?php if ($acc_design_report_gl->title->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_design_report_gl->title->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($acc_design_report_gl->createby->Visible) { // createby ?>
	<?php if ($acc_design_report_gl->SortUrl($acc_design_report_gl->createby) == "") { ?>
		<td style="white-space: nowrap;">Dibuat Oleh</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $acc_design_report_gl->SortUrl($acc_design_report_gl->createby) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Dibuat Oleh</td><td style="width: 10px;"><?php if ($acc_design_report_gl->createby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($acc_design_report_gl->createby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($acc_design_report_gl->ExportAll && $acc_design_report_gl->Export <> "") {
	$acc_design_report_gl_list->lStopRec = $acc_design_report_gl_list->lTotalRecs;
} else {
	$acc_design_report_gl_list->lStopRec = $acc_design_report_gl_list->lStartRec + $acc_design_report_gl_list->lDisplayRecs - 1; // Set the last record to display
}
$acc_design_report_gl_list->lRecCount = $acc_design_report_gl_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$acc_design_report_gl->SelectLimit && $acc_design_report_gl_list->lStartRec > 1)
		$rs->Move($acc_design_report_gl_list->lStartRec - 1);
}
$acc_design_report_gl_list->lRowCnt = 0;
while (($acc_design_report_gl->CurrentAction == "gridadd" || !$rs->EOF) &&
	$acc_design_report_gl_list->lRecCount < $acc_design_report_gl_list->lStopRec) {
	$acc_design_report_gl_list->lRecCount++;
	if (intval($acc_design_report_gl_list->lRecCount) >= intval($acc_design_report_gl_list->lStartRec)) {
		$acc_design_report_gl_list->lRowCnt++;

	// Init row class and style
	$acc_design_report_gl->CssClass = "";
	$acc_design_report_gl->CssStyle = "";
	$acc_design_report_gl->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($acc_design_report_gl->CurrentAction == "gridadd") {
		$acc_design_report_gl_list->LoadDefaultValues(); // Load default values
	} else {
		$acc_design_report_gl_list->LoadRowValues($rs); // Load row values
	}
	$acc_design_report_gl->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$acc_design_report_gl_list->RenderRow();
?>
	<tr<?php echo $acc_design_report_gl->RowAttributes() ?>>
<?php if ($acc_design_report_gl->Export == "") { ?>
<?php

// Custom list options
foreach ($acc_design_report_gl_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($acc_design_report_gl->actionlink->Visible) { // actionlink ?>
		<td<?php echo $acc_design_report_gl->actionlink->CellAttributes() ?>>
<div<?php echo $acc_design_report_gl->actionlink->ViewAttributes() ?>><?php echo $acc_design_report_gl->actionlink->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($acc_design_report_gl->kodedesign->Visible) { // kodedesign ?>
		<td<?php echo $acc_design_report_gl->kodedesign->CellAttributes() ?>>
<div<?php echo $acc_design_report_gl->kodedesign->ViewAttributes() ?>><?php echo $acc_design_report_gl->kodedesign->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($acc_design_report_gl->nama->Visible) { // nama ?>
		<td<?php echo $acc_design_report_gl->nama->CellAttributes() ?>>
<div<?php echo $acc_design_report_gl->nama->ViewAttributes() ?>><?php echo $acc_design_report_gl->nama->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($acc_design_report_gl->title->Visible) { // title ?>
		<td<?php echo $acc_design_report_gl->title->CellAttributes() ?>>
<div<?php echo $acc_design_report_gl->title->ViewAttributes() ?>><?php echo $acc_design_report_gl->title->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($acc_design_report_gl->createby->Visible) { // createby ?>
		<td<?php echo $acc_design_report_gl->createby->CellAttributes() ?>>
<div<?php echo $acc_design_report_gl->createby->ViewAttributes() ?>><?php echo $acc_design_report_gl->createby->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($acc_design_report_gl->CurrentAction <> "gridadd")
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
<?php if ($acc_design_report_gl->Export == "" && $acc_design_report_gl->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
//ew_ToggleSearchPanel(acc_design_report_gl_list); // uncomment to init search panel as collapsed

//-->
</script>
<?php } ?>
<?php if ($acc_design_report_gl->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$acc_design_report_gl_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cacc_design_report_gl_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'acc_design_report_gl';

	// Page Object Name
	var $PageObjName = 'acc_design_report_gl_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $acc_design_report_gl;
		if ($acc_design_report_gl->UseTokenInUrl) $PageUrl .= "t=" . $acc_design_report_gl->TableVar . "&"; // add page token
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
		global $objForm, $acc_design_report_gl;
		if ($acc_design_report_gl->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($acc_design_report_gl->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($acc_design_report_gl->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cacc_design_report_gl_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["acc_design_report_gl"] = new cacc_design_report_gl();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'acc_design_report_gl', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $acc_design_report_gl;
	$acc_design_report_gl->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $acc_design_report_gl->Export; // Get export parameter, used in header
	$gsExportFile = $acc_design_report_gl->TableVar; // Get export file, used in header
	if ($acc_design_report_gl->Export == "print" || $acc_design_report_gl->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($acc_design_report_gl->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($acc_design_report_gl->Export == "word") {
		header('Content-Type: application/vnd.ms-word');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($acc_design_report_gl->Export == "xml") {
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($acc_design_report_gl->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $acc_design_report_gl;
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
		if ($acc_design_report_gl->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $acc_design_report_gl->getRecordsPerPage(); // Restore from Session
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
		$acc_design_report_gl->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$acc_design_report_gl->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$acc_design_report_gl->setStartRecordNumber($this->lStartRec);
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
		$acc_design_report_gl->setSessionWhere($sFilter);
		$acc_design_report_gl->CurrentFilter = "";

		// Export data only
		if (in_array($acc_design_report_gl->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $acc_design_report_gl;
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
			$acc_design_report_gl->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$acc_design_report_gl->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $acc_design_report_gl;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $acc_design_report_gl->actionlink, FALSE); // Field actionlink
		$this->BuildSearchSql($sWhere, $acc_design_report_gl->kodedesign, FALSE); // Field kodedesign
		$this->BuildSearchSql($sWhere, $acc_design_report_gl->idseqno, FALSE); // Field idseqno
		$this->BuildSearchSql($sWhere, $acc_design_report_gl->nama, FALSE); // Field nama
		$this->BuildSearchSql($sWhere, $acc_design_report_gl->title, FALSE); // Field title
		$this->BuildSearchSql($sWhere, $acc_design_report_gl->createby, FALSE); // Field createby
		$this->BuildSearchSql($sWhere, $acc_design_report_gl->createdate, FALSE); // Field createdate

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($acc_design_report_gl->actionlink); // Field actionlink
			$this->SetSearchParm($acc_design_report_gl->kodedesign); // Field kodedesign
			$this->SetSearchParm($acc_design_report_gl->idseqno); // Field idseqno
			$this->SetSearchParm($acc_design_report_gl->nama); // Field nama
			$this->SetSearchParm($acc_design_report_gl->title); // Field title
			$this->SetSearchParm($acc_design_report_gl->createby); // Field createby
			$this->SetSearchParm($acc_design_report_gl->createdate); // Field createdate
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
		global $acc_design_report_gl;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$acc_design_report_gl->setAdvancedSearch("x_$FldParm", $FldVal);
		$acc_design_report_gl->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$acc_design_report_gl->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$acc_design_report_gl->setAdvancedSearch("y_$FldParm", $FldVal2);
		$acc_design_report_gl->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $acc_design_report_gl;
		$this->sSrchWhere = "";
		$acc_design_report_gl->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $acc_design_report_gl;
		$acc_design_report_gl->setAdvancedSearch("x_actionlink", "");
		$acc_design_report_gl->setAdvancedSearch("x_kodedesign", "");
		$acc_design_report_gl->setAdvancedSearch("x_idseqno", "");
		$acc_design_report_gl->setAdvancedSearch("x_nama", "");
		$acc_design_report_gl->setAdvancedSearch("x_title", "");
		$acc_design_report_gl->setAdvancedSearch("x_createby", "");
		$acc_design_report_gl->setAdvancedSearch("x_createdate", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $acc_design_report_gl;
		$this->sSrchWhere = $acc_design_report_gl->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $acc_design_report_gl;
		 $acc_design_report_gl->actionlink->AdvancedSearch->SearchValue = $acc_design_report_gl->getAdvancedSearch("x_actionlink");
		 $acc_design_report_gl->kodedesign->AdvancedSearch->SearchValue = $acc_design_report_gl->getAdvancedSearch("x_kodedesign");
		 $acc_design_report_gl->idseqno->AdvancedSearch->SearchValue = $acc_design_report_gl->getAdvancedSearch("x_idseqno");
		 $acc_design_report_gl->nama->AdvancedSearch->SearchValue = $acc_design_report_gl->getAdvancedSearch("x_nama");
		 $acc_design_report_gl->title->AdvancedSearch->SearchValue = $acc_design_report_gl->getAdvancedSearch("x_title");
		 $acc_design_report_gl->createby->AdvancedSearch->SearchValue = $acc_design_report_gl->getAdvancedSearch("x_createby");
		 $acc_design_report_gl->createdate->AdvancedSearch->SearchValue = $acc_design_report_gl->getAdvancedSearch("x_createdate");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $acc_design_report_gl;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$acc_design_report_gl->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$acc_design_report_gl->CurrentOrderType = @$_GET["ordertype"];
			$acc_design_report_gl->UpdateSort($acc_design_report_gl->actionlink); // Field 
			$acc_design_report_gl->UpdateSort($acc_design_report_gl->kodedesign); // Field 
			$acc_design_report_gl->UpdateSort($acc_design_report_gl->nama); // Field 
			$acc_design_report_gl->UpdateSort($acc_design_report_gl->title); // Field 
			$acc_design_report_gl->UpdateSort($acc_design_report_gl->createby); // Field 
			$acc_design_report_gl->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $acc_design_report_gl;
		$sOrderBy = $acc_design_report_gl->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($acc_design_report_gl->SqlOrderBy() <> "") {
				$sOrderBy = $acc_design_report_gl->SqlOrderBy();
				$acc_design_report_gl->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $acc_design_report_gl;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$acc_design_report_gl->setSessionOrderBy($sOrderBy);
				$acc_design_report_gl->actionlink->setSort("");
				$acc_design_report_gl->kodedesign->setSort("");
				$acc_design_report_gl->nama->setSort("");
				$acc_design_report_gl->title->setSort("");
				$acc_design_report_gl->createby->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$acc_design_report_gl->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $acc_design_report_gl;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$acc_design_report_gl->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$acc_design_report_gl->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $acc_design_report_gl->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$acc_design_report_gl->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$acc_design_report_gl->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$acc_design_report_gl->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $acc_design_report_gl;

		// Load search values
		// actionlink

		$acc_design_report_gl->actionlink->AdvancedSearch->SearchValue = @$_GET["x_actionlink"];
		$acc_design_report_gl->actionlink->AdvancedSearch->SearchOperator = @$_GET["z_actionlink"];

		// kodedesign
		$acc_design_report_gl->kodedesign->AdvancedSearch->SearchValue = @$_GET["x_kodedesign"];
		$acc_design_report_gl->kodedesign->AdvancedSearch->SearchOperator = @$_GET["z_kodedesign"];

		// idseqno
		$acc_design_report_gl->idseqno->AdvancedSearch->SearchValue = @$_GET["x_idseqno"];
		$acc_design_report_gl->idseqno->AdvancedSearch->SearchOperator = @$_GET["z_idseqno"];

		// nama
		$acc_design_report_gl->nama->AdvancedSearch->SearchValue = @$_GET["x_nama"];
		$acc_design_report_gl->nama->AdvancedSearch->SearchOperator = @$_GET["z_nama"];

		// title
		$acc_design_report_gl->title->AdvancedSearch->SearchValue = @$_GET["x_title"];
		$acc_design_report_gl->title->AdvancedSearch->SearchOperator = @$_GET["z_title"];

		// createby
		$acc_design_report_gl->createby->AdvancedSearch->SearchValue = @$_GET["x_createby"];
		$acc_design_report_gl->createby->AdvancedSearch->SearchOperator = @$_GET["z_createby"];

		// createdate
		$acc_design_report_gl->createdate->AdvancedSearch->SearchValue = @$_GET["x_createdate"];
		$acc_design_report_gl->createdate->AdvancedSearch->SearchOperator = @$_GET["z_createdate"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $acc_design_report_gl;

		// Call Recordset Selecting event
		$acc_design_report_gl->Recordset_Selecting($acc_design_report_gl->CurrentFilter);

		// Load list page SQL
		$sSql = $acc_design_report_gl->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$acc_design_report_gl->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $acc_design_report_gl;
		$sFilter = $acc_design_report_gl->KeyFilter();

		// Call Row Selecting event
		$acc_design_report_gl->Row_Selecting($sFilter);

		// Load sql based on filter
		$acc_design_report_gl->CurrentFilter = $sFilter;
		$sSql = $acc_design_report_gl->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$acc_design_report_gl->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $acc_design_report_gl;
		$acc_design_report_gl->actionlink->setDbValue($rs->fields('actionlink'));
		$acc_design_report_gl->kodedesign->setDbValue($rs->fields('kodedesign'));
		$acc_design_report_gl->idseqno->setDbValue($rs->fields('idseqno'));
		$acc_design_report_gl->nama->setDbValue($rs->fields('nama'));
		$acc_design_report_gl->title->setDbValue($rs->fields('title'));
		$acc_design_report_gl->createby->setDbValue($rs->fields('createby'));
		$acc_design_report_gl->createdate->setDbValue($rs->fields('createdate'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $acc_design_report_gl;

		// Call Row_Rendering event
		$acc_design_report_gl->Row_Rendering();

		// Common render codes for all row types
		// actionlink

		$acc_design_report_gl->actionlink->CellCssStyle = "white-space: nowrap;";
		$acc_design_report_gl->actionlink->CellCssClass = "";

		// kodedesign
		$acc_design_report_gl->kodedesign->CellCssStyle = "white-space: nowrap;";
		$acc_design_report_gl->kodedesign->CellCssClass = "";

		// nama
		$acc_design_report_gl->nama->CellCssStyle = "white-space: nowrap;";
		$acc_design_report_gl->nama->CellCssClass = "";

		// title
		$acc_design_report_gl->title->CellCssStyle = "";
		$acc_design_report_gl->title->CellCssClass = "";

		// createby
		$acc_design_report_gl->createby->CellCssStyle = "white-space: nowrap;";
		$acc_design_report_gl->createby->CellCssClass = "";
		if ($acc_design_report_gl->RowType == EW_ROWTYPE_VIEW) { // View row

			// actionlink
			$acc_design_report_gl->actionlink->ViewValue = $acc_design_report_gl->actionlink->CurrentValue;
			$acc_design_report_gl->actionlink->CssStyle = "";
			$acc_design_report_gl->actionlink->CssClass = "";
			$acc_design_report_gl->actionlink->ViewCustomAttributes = "";

			// kodedesign
			$acc_design_report_gl->kodedesign->ViewValue = $acc_design_report_gl->kodedesign->CurrentValue;
			$acc_design_report_gl->kodedesign->CssStyle = "";
			$acc_design_report_gl->kodedesign->CssClass = "";
			$acc_design_report_gl->kodedesign->ViewCustomAttributes = "";

			// nama
			$acc_design_report_gl->nama->ViewValue = $acc_design_report_gl->nama->CurrentValue;
			$acc_design_report_gl->nama->CssStyle = "";
			$acc_design_report_gl->nama->CssClass = "";
			$acc_design_report_gl->nama->ViewCustomAttributes = "";

			// title
			$acc_design_report_gl->title->ViewValue = $acc_design_report_gl->title->CurrentValue;
			$acc_design_report_gl->title->CssStyle = "";
			$acc_design_report_gl->title->CssClass = "";
			$acc_design_report_gl->title->ViewCustomAttributes = "";

			// createby
			if (strval($acc_design_report_gl->createby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($acc_design_report_gl->createby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$acc_design_report_gl->createby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$acc_design_report_gl->createby->ViewValue = $acc_design_report_gl->createby->CurrentValue;
				}
			} else {
				$acc_design_report_gl->createby->ViewValue = NULL;
			}
			$acc_design_report_gl->createby->CssStyle = "";
			$acc_design_report_gl->createby->CssClass = "";
			$acc_design_report_gl->createby->ViewCustomAttributes = "";

			// actionlink
			$acc_design_report_gl->actionlink->HrefValue = "";

			// kodedesign
			$acc_design_report_gl->kodedesign->HrefValue = "";

			// nama
			$acc_design_report_gl->nama->HrefValue = "";

			// title
			$acc_design_report_gl->title->HrefValue = "";

			// createby
			$acc_design_report_gl->createby->HrefValue = "";
		} elseif ($acc_design_report_gl->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// actionlink
			$acc_design_report_gl->actionlink->EditCustomAttributes = "";
			$acc_design_report_gl->actionlink->EditValue = ew_HtmlEncode($acc_design_report_gl->actionlink->AdvancedSearch->SearchValue);

			// kodedesign
			$acc_design_report_gl->kodedesign->EditCustomAttributes = "";
			$acc_design_report_gl->kodedesign->EditValue = ew_HtmlEncode($acc_design_report_gl->kodedesign->AdvancedSearch->SearchValue);

			// nama
			$acc_design_report_gl->nama->EditCustomAttributes = "";
			$acc_design_report_gl->nama->EditValue = ew_HtmlEncode($acc_design_report_gl->nama->AdvancedSearch->SearchValue);

			// title
			$acc_design_report_gl->title->EditCustomAttributes = "";
			$acc_design_report_gl->title->EditValue = ew_HtmlEncode($acc_design_report_gl->title->AdvancedSearch->SearchValue);

			// createby
			$acc_design_report_gl->createby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$acc_design_report_gl->createby->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$acc_design_report_gl->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $acc_design_report_gl;

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
		global $acc_design_report_gl;
		$acc_design_report_gl->actionlink->AdvancedSearch->SearchValue = $acc_design_report_gl->getAdvancedSearch("x_actionlink");
		$acc_design_report_gl->kodedesign->AdvancedSearch->SearchValue = $acc_design_report_gl->getAdvancedSearch("x_kodedesign");
		$acc_design_report_gl->idseqno->AdvancedSearch->SearchValue = $acc_design_report_gl->getAdvancedSearch("x_idseqno");
		$acc_design_report_gl->nama->AdvancedSearch->SearchValue = $acc_design_report_gl->getAdvancedSearch("x_nama");
		$acc_design_report_gl->title->AdvancedSearch->SearchValue = $acc_design_report_gl->getAdvancedSearch("x_title");
		$acc_design_report_gl->createby->AdvancedSearch->SearchValue = $acc_design_report_gl->getAdvancedSearch("x_createby");
		$acc_design_report_gl->createdate->AdvancedSearch->SearchValue = $acc_design_report_gl->getAdvancedSearch("x_createdate");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $acc_design_report_gl;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($acc_design_report_gl->ExportAll) {
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
		if ($acc_design_report_gl->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($acc_design_report_gl->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $acc_design_report_gl->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'kodedesign', $acc_design_report_gl->Export);
				ew_ExportAddValue($sExportStr, 'nama', $acc_design_report_gl->Export);
				ew_ExportAddValue($sExportStr, 'title', $acc_design_report_gl->Export);
				ew_ExportAddValue($sExportStr, 'createby', $acc_design_report_gl->Export);
				echo ew_ExportLine($sExportStr, $acc_design_report_gl->Export);
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
				$acc_design_report_gl->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($acc_design_report_gl->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('kodedesign', $acc_design_report_gl->kodedesign->CurrentValue);
					$XmlDoc->AddField('nama', $acc_design_report_gl->nama->CurrentValue);
					$XmlDoc->AddField('title', $acc_design_report_gl->title->CurrentValue);
					$XmlDoc->AddField('createby', $acc_design_report_gl->createby->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $acc_design_report_gl->Export <> "csv") { // Vertical format
						echo ew_ExportField('kodedesign', $acc_design_report_gl->kodedesign->ExportValue($acc_design_report_gl->Export, $acc_design_report_gl->ExportOriginalValue), $acc_design_report_gl->Export);
						echo ew_ExportField('nama', $acc_design_report_gl->nama->ExportValue($acc_design_report_gl->Export, $acc_design_report_gl->ExportOriginalValue), $acc_design_report_gl->Export);
						echo ew_ExportField('title', $acc_design_report_gl->title->ExportValue($acc_design_report_gl->Export, $acc_design_report_gl->ExportOriginalValue), $acc_design_report_gl->Export);
						echo ew_ExportField('createby', $acc_design_report_gl->createby->ExportValue($acc_design_report_gl->Export, $acc_design_report_gl->ExportOriginalValue), $acc_design_report_gl->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $acc_design_report_gl->kodedesign->ExportValue($acc_design_report_gl->Export, $acc_design_report_gl->ExportOriginalValue), $acc_design_report_gl->Export);
						ew_ExportAddValue($sExportStr, $acc_design_report_gl->nama->ExportValue($acc_design_report_gl->Export, $acc_design_report_gl->ExportOriginalValue), $acc_design_report_gl->Export);
						ew_ExportAddValue($sExportStr, $acc_design_report_gl->title->ExportValue($acc_design_report_gl->Export, $acc_design_report_gl->ExportOriginalValue), $acc_design_report_gl->Export);
						ew_ExportAddValue($sExportStr, $acc_design_report_gl->createby->ExportValue($acc_design_report_gl->Export, $acc_design_report_gl->ExportOriginalValue), $acc_design_report_gl->Export);
						echo ew_ExportLine($sExportStr, $acc_design_report_gl->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($acc_design_report_gl->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($acc_design_report_gl->Export);
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
