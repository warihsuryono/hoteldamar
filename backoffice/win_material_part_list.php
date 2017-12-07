<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "win_material_part_info.php" ?>
<?php include "userfn6.php" ?>
<?php $_tablename="mst_material_part"; ?>
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
$win_material_part__list = new cwin_material_part__list();
$Page =& $win_material_part__list;

// Page init processing
$win_material_part__list->Page_Init();

// Page main processing
$win_material_part__list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($win_material_part_->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var win_material_part__list = new ew_Page("win_material_part__list");

// page properties
win_material_part__list.PageID = "list"; // page ID
var EW_PAGE_ID = win_material_part__list.PageID; // for backward compatibility

// extend page with validate function for search
win_material_part__list.ValidateSearch = function(fobj) {
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
win_material_part__list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
win_material_part__list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
win_material_part__list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
win_material_part__list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
win_material_part__list.ShowHighlightText = "Show highlight"; 
win_material_part__list.HideHighlightText = "Hide highlight";

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
<?php if ($win_material_part_->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($win_material_part_->Export == "" && $win_material_part_->SelectLimit);
	if (!$bSelectLimit)
		$rs = $win_material_part__list->LoadRecordset();
	$win_material_part__list->lTotalRecs = ($bSelectLimit) ? $win_material_part_->SelectRecordCount() : $rs->RecordCount();
	$win_material_part__list->lStartRec = 1;
	if ($win_material_part__list->lDisplayRecs <= 0) // Display all records
		$win_material_part__list->lDisplayRecs = $win_material_part__list->lTotalRecs;
	if (!($win_material_part_->ExportAll && $win_material_part_->Export <> ""))
		$win_material_part__list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $win_material_part__list->LoadRecordset($win_material_part__list->lStartRec-1, $win_material_part__list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Barang</b></h3>
<?php if ($win_material_part_->Export == "" && $win_material_part_->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $win_material_part__list->PageUrl() ?>export=print"><img src="images/print.gif" title="Printer Friendly" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $win_material_part__list->PageUrl() ?>export=html"><img src="images/exporthtml.gif" title="Export to HTML" width="16" height="16" border="0"></a-->
&nbsp;&nbsp;<a href="<?php echo $win_material_part__list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $win_material_part__list->PageUrl() ?>export=word"><img src="images/exportdoc.gif" title="Export to Word" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $win_material_part__list->PageUrl() ?>export=xml"><img src="images/exportxml.gif" title="Export to XML" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $win_material_part__list->PageUrl() ?>export=csv"><img src="images/exportcsv.gif" title="Export to CSV" width="16" height="16" border="0"></a-->
<?php } ?>
</span></p>
<?php if ($win_material_part_->Export == "" && $win_material_part_->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(win_material_part__list);" style="text-decoration: none;"><img id="win_material_part__list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="win_material_part__list_SearchPanel">
<form name="fwin_material_part_listsrch" id="fwin_material_part_listsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return win_material_part__list.ValidateSearch(this);">
<?php echo $__urlgetshidden;?>
<input type="hidden" id="t" name="t" value="win_material_part_">
<?php
if ($gsSearchError == "")
	$win_material_part__list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$win_material_part_->RowType = EW_ROWTYPE_SEARCH;

// Render row
$win_material_part__list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Kode</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kode" id="z_kode" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kode" id="x_kode" size="20" maxlength="20" value="<?php echo $win_material_part_->kode->EditValue ?>"<?php echo $win_material_part_->kode->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<!--tr>
		<td><span class="phpmaker">Mode</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_modepart" id="z_modepart" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_modepart" name="x_modepart"<?php echo $win_material_part_->modepart->EditAttributes() ?>>
<?php
if (is_array($win_material_part_->modepart->EditValue)) {
	$arwrk = $win_material_part_->modepart->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($win_material_part_->modepart->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	</tr-->
	<tr>
		<td><span class="phpmaker">Serial No</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_pn" id="z_pn" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_pn" id="x_pn" size="30" maxlength="50" value="<?php echo $win_material_part_->pn->EditValue ?>"<?php echo $win_material_part_->pn->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Category</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_category" id="z_category" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_category" id="x_category" size="30" maxlength="50" value="<?php echo $win_material_part_->category->EditValue ?>"<?php echo $win_material_part_->category->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Tipe Barang</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_modelunit" id="z_modelunit" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_modelunit" name="x_modelunit"<?php echo $win_material_part_->modelunit->EditAttributes() ?>>
<?php
if (is_array($win_material_part_->modelunit->EditValue)) {
	$arwrk = $win_material_part_->modelunit->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($win_material_part_->modelunit->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Nama</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_nama" id="z_nama" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_nama" id="x_nama" size="50" maxlength="100" value="<?php echo $win_material_part_->nama->EditValue ?>"<?php echo $win_material_part_->nama->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Satuan</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_satuan" id="z_satuan" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_satuan" name="x_satuan"<?php echo $win_material_part_->satuan->EditAttributes() ?>>
<?php
if (is_array($win_material_part_->satuan->EditValue)) {
	$arwrk = $win_material_part_->satuan->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($win_material_part_->satuan->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<!--a href="<?php echo $win_material_part__list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $win_material_part__list->PageUrl() ?>cmd=reset&<?php echo $__urlgets; ?>';">
			<?php if ($win_material_part__list->sSrchWhere <> "" && $win_material_part__list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(win_material_part__list, this, '<?php echo $win_material_part_->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $win_material_part__list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($win_material_part_->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($win_material_part_->CurrentAction <> "gridadd" && $win_material_part_->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<?php echo $__urlgetshidden; ?>
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($win_material_part__list->Pager)) $win_material_part__list->Pager = new cPrevNextPager($win_material_part__list->lStartRec, $win_material_part__list->lDisplayRecs, $win_material_part__list->lTotalRecs) ?>
<?php if ($win_material_part__list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($win_material_part__list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $win_material_part__list->PageUrl() ?><?php echo $__urlgets; ?>&start=<?php echo $win_material_part__list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($win_material_part__list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $win_material_part__list->PageUrl() ?><?php echo $__urlgets; ?>&start=<?php echo $win_material_part__list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $win_material_part__list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($win_material_part__list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $win_material_part__list->PageUrl() ?><?php echo $__urlgets; ?>&start=<?php echo $win_material_part__list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($win_material_part__list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $win_material_part__list->PageUrl() ?><?php echo $__urlgets; ?>&start=<?php echo $win_material_part__list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $win_material_part__list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $win_material_part__list->Pager->FromIndex ?> to <?php echo $win_material_part__list->Pager->ToIndex ?> of <?php echo $win_material_part__list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($win_material_part__list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($win_material_part__list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="win_material_part_">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($win_material_part__list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($win_material_part__list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($win_material_part__list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="50"<?php if ($win_material_part__list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($win_material_part__list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($win_material_part__list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
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
<form name="fwin_material_part_list" id="fwin_material_part_list" class="ewForm" action="" method="post">
<?php echo $__urlgetshidden; ?>
<?php if ($win_material_part__list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$win_material_part__list->lOptionCnt = 0;
	$win_material_part__list->lOptionCnt += count($win_material_part__list->ListOptions->Items); // Custom list options
?>
<?php echo $win_material_part_->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($win_material_part_->Export == "") { ?>
<?php

// Custom list options
foreach ($win_material_part__list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php $__sorturl="textid=$_GET[textid]&mode=$_GET[mode]"; ?>
<?php if ($win_material_part_->kode->Visible) { // kode ?>
	<?php if ($win_material_part_->SortUrl($win_material_part_->kode) == "") { ?>
		<td style="white-space: nowrap;">Kode</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_material_part_->SortUrl($win_material_part_->kode) ?>&<?php echo $__sorturl; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode</td><td style="width: 10px;"><?php if ($win_material_part_->kode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_material_part_->kode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($win_material_part_->pn->Visible) { // pn ?>
	<?php if ($win_material_part_->SortUrl($win_material_part_->pn) == "") { ?>
		<td style="white-space: nowrap;">Serial No</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_material_part_->SortUrl($win_material_part_->pn) ?>&<?php echo $__sorturl; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Serial No</td><td style="width: 10px;"><?php if ($win_material_part_->pn->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_material_part_->pn->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($win_material_part_->category->Visible) { // category ?>
	<?php if ($win_material_part_->SortUrl($win_material_part_->category) == "") { ?>
		<td style="white-space: nowrap;">Category</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_material_part_->SortUrl($win_material_part_->category) ?>&<?php echo $__sorturl; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Category</td><td style="width: 10px;"><?php if ($win_material_part_->category->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_material_part_->category->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($win_material_part_->modelunit->Visible) { // modelunit ?>
	<?php if ($win_material_part_->SortUrl($win_material_part_->modelunit) == "") { ?>
		<td style="white-space: nowrap;">Tipe Barang</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_material_part_->SortUrl($win_material_part_->modelunit) ?>&<?php echo $__sorturl; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tipe Barang</td><td style="width: 10px;"><?php if ($win_material_part_->modelunit->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_material_part_->modelunit->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($win_material_part_->nama->Visible) { // nama ?>
	<?php if ($win_material_part_->SortUrl($win_material_part_->nama) == "") { ?>
		<td style="white-space: nowrap;">Nama</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_material_part_->SortUrl($win_material_part_->nama) ?>&<?php echo $__sorturl; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Nama</td><td style="width: 10px;"><?php if ($win_material_part_->nama->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_material_part_->nama->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($win_material_part_->satuan->Visible) { // satuan ?>
	<?php if ($win_material_part_->SortUrl($win_material_part_->satuan) == "") { ?>
		<td style="white-space: nowrap;">Satuan</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_material_part_->SortUrl($win_material_part_->satuan) ?>&<?php echo $__sorturl; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Satuan</td><td style="width: 10px;"><?php if ($win_material_part_->satuan->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_material_part_->satuan->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($win_material_part_->keterangan->Visible) { // keterangan ?>
	<?php if ($win_material_part_->SortUrl($win_material_part_->keterangan) == "") { ?>
		<td style="white-space: nowrap;">Keterangan</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $win_material_part_->SortUrl($win_material_part_->keterangan) ?>&<?php echo $__sorturl; ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Keterangan</td><td style="width: 10px;"><?php if ($win_material_part_->keterangan->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($win_material_part_->keterangan->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($win_material_part_->ExportAll && $win_material_part_->Export <> "") {
	$win_material_part__list->lStopRec = $win_material_part__list->lTotalRecs;
} else {
	$win_material_part__list->lStopRec = $win_material_part__list->lStartRec + $win_material_part__list->lDisplayRecs - 1; // Set the last record to display
}
$win_material_part__list->lRecCount = $win_material_part__list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$win_material_part_->SelectLimit && $win_material_part__list->lStartRec > 1)
		$rs->Move($win_material_part__list->lStartRec - 1);
}
$win_material_part__list->lRowCnt = 0;
while (($win_material_part_->CurrentAction == "gridadd" || !$rs->EOF) &&
	$win_material_part__list->lRecCount < $win_material_part__list->lStopRec) {
	$win_material_part__list->lRecCount++;
	if (intval($win_material_part__list->lRecCount) >= intval($win_material_part__list->lStartRec)) {
		$win_material_part__list->lRowCnt++;

	// Init row class and style
	$win_material_part_->CssClass = "";
	$win_material_part_->CssStyle = "";
	$win_material_part_->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($win_material_part_->CurrentAction == "gridadd") {
		$win_material_part__list->LoadDefaultValues(); // Load default values
	} else {
		$win_material_part__list->LoadRowValues($rs); // Load row values
	}
	$win_material_part_->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$win_material_part__list->RenderRow();
?>
	<tr<?php echo $win_material_part_->RowAttributes() ?> ondblclick="showparent('<?php echo sanitasi($_REQUEST["textid"]); ?>','<?php echo $win_material_part_->kode->ListViewValue(); ?>','');">
<?php if ($win_material_part_->Export == "") { ?>
<?php

// Custom list options
foreach ($win_material_part__list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($win_material_part_->kode->Visible) { // kode ?>
		<td<?php echo $win_material_part_->kode->CellAttributes() ?>>
<div<?php echo $win_material_part_->kode->ViewAttributes() ?>><?php echo $win_material_part_->kode->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($win_material_part_->pn->Visible) { // pn ?>
		<td<?php echo $win_material_part_->pn->CellAttributes() ?>>
<div<?php echo $win_material_part_->pn->ViewAttributes() ?>><?php echo $win_material_part_->pn->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($win_material_part_->category->Visible) { // category ?>
		<td<?php echo $win_material_part_->category->CellAttributes() ?>>
<div<?php echo $win_material_part_->category->ViewAttributes() ?>><?php echo $win_material_part_->category->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($win_material_part_->modelunit->Visible) { // modelunit ?>
		<td<?php echo $win_material_part_->modelunit->CellAttributes() ?>>
<div<?php echo $win_material_part_->modelunit->ViewAttributes() ?>><?php echo $win_material_part_->modelunit->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($win_material_part_->nama->Visible) { // nama ?>
		<td<?php echo $win_material_part_->nama->CellAttributes() ?>>
<div<?php echo $win_material_part_->nama->ViewAttributes() ?>><?php echo $win_material_part_->nama->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($win_material_part_->satuan->Visible) { // satuan ?>
		<td<?php echo $win_material_part_->satuan->CellAttributes() ?>>
<div<?php echo $win_material_part_->satuan->ViewAttributes() ?>><?php echo $win_material_part_->satuan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($win_material_part_->keterangan->Visible) { // keterangan ?>
		<td<?php echo $win_material_part_->keterangan->CellAttributes() ?>>
<div<?php echo $win_material_part_->keterangan->ViewAttributes() ?>><?php echo $win_material_part_->keterangan->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($win_material_part_->CurrentAction <> "gridadd")
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
<?php if ($win_material_part_->Export == "" && $win_material_part_->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
//ew_ToggleSearchPanel(win_material_part__list); // uncomment to init search panel as collapsed

//-->
</script>
<?php } ?>
<?php if ($win_material_part_->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$win_material_part__list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cwin_material_part__list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'win_material_part_';

	// Page Object Name
	var $PageObjName = 'win_material_part__list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $win_material_part_;
		if ($win_material_part_->UseTokenInUrl) $PageUrl .= "t=" . $win_material_part_->TableVar . "&"; // add page token
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
		global $objForm, $win_material_part_;
		if ($win_material_part_->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($win_material_part_->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($win_material_part_->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cwin_material_part__list() {
		global $conn;

		// Initialize table object
		$GLOBALS["win_material_part_"] = new cwin_material_part_();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'win_material_part_', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $win_material_part_;
	$win_material_part_->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $win_material_part_->Export; // Get export parameter, used in header
	$gsExportFile = $win_material_part_->TableVar; // Get export file, used in header
	if ($win_material_part_->Export == "print" || $win_material_part_->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($win_material_part_->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($win_material_part_->Export == "word") {
		header('Content-Type: application/vnd.ms-word');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($win_material_part_->Export == "xml") {
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($win_material_part_->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $win_material_part_;
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
		if ($win_material_part_->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $win_material_part_->getRecordsPerPage(); // Restore from Session
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
		$win_material_part_->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$win_material_part_->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$win_material_part_->setStartRecordNumber($this->lStartRec);
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
		$win_material_part_->setSessionWhere($sFilter);
		$win_material_part_->CurrentFilter = "";

		// Export data only
		if (in_array($win_material_part_->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $win_material_part_;
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
			$win_material_part_->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$win_material_part_->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $win_material_part_;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $win_material_part_->kode, FALSE); // Field kode
		$this->BuildSearchSql($sWhere, $win_material_part_->modepart, FALSE); // Field modepart
		$this->BuildSearchSql($sWhere, $win_material_part_->pn, FALSE); // Field pn
		$this->BuildSearchSql($sWhere, $win_material_part_->category, FALSE); // Field category
		$this->BuildSearchSql($sWhere, $win_material_part_->modelunit, FALSE); // Field modelunit
		$this->BuildSearchSql($sWhere, $win_material_part_->nama, FALSE); // Field nama
		$this->BuildSearchSql($sWhere, $win_material_part_->satuan, FALSE); // Field satuan

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($win_material_part_->kode); // Field kode
			$this->SetSearchParm($win_material_part_->modepart); // Field modepart
			$this->SetSearchParm($win_material_part_->pn); // Field pn
			$this->SetSearchParm($win_material_part_->category); // Field category
			$this->SetSearchParm($win_material_part_->modelunit); // Field modelunit
			$this->SetSearchParm($win_material_part_->nama); // Field nama
			$this->SetSearchParm($win_material_part_->satuan); // Field satuan
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
		global $win_material_part_;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$win_material_part_->setAdvancedSearch("x_$FldParm", $FldVal);
		$win_material_part_->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$win_material_part_->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$win_material_part_->setAdvancedSearch("y_$FldParm", $FldVal2);
		$win_material_part_->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $win_material_part_;
		$this->sSrchWhere = "";
		$win_material_part_->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $win_material_part_;
		$win_material_part_->setAdvancedSearch("x_kode", "");
		$win_material_part_->setAdvancedSearch("x_modepart", "");
		$win_material_part_->setAdvancedSearch("x_pn", "");
		$win_material_part_->setAdvancedSearch("x_category", "");
		$win_material_part_->setAdvancedSearch("x_modelunit", "");
		$win_material_part_->setAdvancedSearch("x_nama", "");
		$win_material_part_->setAdvancedSearch("x_satuan", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $win_material_part_;
		$this->sSrchWhere = $win_material_part_->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $win_material_part_;
		 $win_material_part_->kode->AdvancedSearch->SearchValue = $win_material_part_->getAdvancedSearch("x_kode");
		 $win_material_part_->modepart->AdvancedSearch->SearchValue = $win_material_part_->getAdvancedSearch("x_modepart");
		 $win_material_part_->pn->AdvancedSearch->SearchValue = $win_material_part_->getAdvancedSearch("x_pn");
		 $win_material_part_->category->AdvancedSearch->SearchValue = $win_material_part_->getAdvancedSearch("x_category");
		 $win_material_part_->modelunit->AdvancedSearch->SearchValue = $win_material_part_->getAdvancedSearch("x_modelunit");
		 $win_material_part_->nama->AdvancedSearch->SearchValue = $win_material_part_->getAdvancedSearch("x_nama");
		 $win_material_part_->satuan->AdvancedSearch->SearchValue = $win_material_part_->getAdvancedSearch("x_satuan");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $win_material_part_;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$win_material_part_->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$win_material_part_->CurrentOrderType = @$_GET["ordertype"];
			$win_material_part_->UpdateSort($win_material_part_->kode); // Field 
			$win_material_part_->UpdateSort($win_material_part_->modepart); // Field 
			$win_material_part_->UpdateSort($win_material_part_->pn); // Field 
			$win_material_part_->UpdateSort($win_material_part_->category); // Field 
			$win_material_part_->UpdateSort($win_material_part_->modelunit); // Field 
			$win_material_part_->UpdateSort($win_material_part_->nama); // Field 
			$win_material_part_->UpdateSort($win_material_part_->satuan); // Field 
			$win_material_part_->UpdateSort($win_material_part_->keterangan); // Field 
			$win_material_part_->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $win_material_part_;
		$sOrderBy = $win_material_part_->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($win_material_part_->SqlOrderBy() <> "") {
				$sOrderBy = $win_material_part_->SqlOrderBy();
				$win_material_part_->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $win_material_part_;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$win_material_part_->setSessionOrderBy($sOrderBy);
				$win_material_part_->kode->setSort("");
				$win_material_part_->modepart->setSort("");
				$win_material_part_->pn->setSort("");
				$win_material_part_->category->setSort("");
				$win_material_part_->modelunit->setSort("");
				$win_material_part_->nama->setSort("");
				$win_material_part_->satuan->setSort("");
				$win_material_part_->keterangan->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$win_material_part_->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $win_material_part_;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$win_material_part_->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$win_material_part_->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $win_material_part_->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$win_material_part_->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$win_material_part_->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$win_material_part_->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $win_material_part_;

		// Load search values
		// kode

		$win_material_part_->kode->AdvancedSearch->SearchValue = @$_GET["x_kode"];
		$win_material_part_->kode->AdvancedSearch->SearchOperator = @$_GET["z_kode"];

		// modepart
		$win_material_part_->modepart->AdvancedSearch->SearchValue = @$_GET["x_modepart"];
		$win_material_part_->modepart->AdvancedSearch->SearchOperator = @$_GET["z_modepart"];

		// pn
		$win_material_part_->pn->AdvancedSearch->SearchValue = @$_GET["x_pn"];
		$win_material_part_->pn->AdvancedSearch->SearchOperator = @$_GET["z_pn"];

		// category
		$win_material_part_->category->AdvancedSearch->SearchValue = @$_GET["x_category"];
		$win_material_part_->category->AdvancedSearch->SearchOperator = @$_GET["z_category"];

		// modelunit
		$win_material_part_->modelunit->AdvancedSearch->SearchValue = @$_GET["x_modelunit"];
		$win_material_part_->modelunit->AdvancedSearch->SearchOperator = @$_GET["z_modelunit"];

		// nama
		$win_material_part_->nama->AdvancedSearch->SearchValue = @$_GET["x_nama"];
		$win_material_part_->nama->AdvancedSearch->SearchOperator = @$_GET["z_nama"];

		// satuan
		$win_material_part_->satuan->AdvancedSearch->SearchValue = @$_GET["x_satuan"];
		$win_material_part_->satuan->AdvancedSearch->SearchOperator = @$_GET["z_satuan"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $win_material_part_;

		// Call Recordset Selecting event
		$win_material_part_->Recordset_Selecting($win_material_part_->CurrentFilter);

		// Load list page SQL
		$sSql = $win_material_part_->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$win_material_part_->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $win_material_part_;
		$sFilter = $win_material_part_->KeyFilter();

		// Call Row Selecting event
		$win_material_part_->Row_Selecting($sFilter);

		// Load sql based on filter
		$win_material_part_->CurrentFilter = $sFilter;
		$sSql = $win_material_part_->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$win_material_part_->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $win_material_part_;
		$win_material_part_->kode->setDbValue($rs->fields('kode'));
		$win_material_part_->modepart->setDbValue($rs->fields('modepart'));
		$win_material_part_->pn->setDbValue($rs->fields('pn'));
		$win_material_part_->category->setDbValue($rs->fields('category'));
		$win_material_part_->modelunit->setDbValue($rs->fields('modelunit'));
		$win_material_part_->nama->setDbValue($rs->fields('nama'));
		$win_material_part_->satuan->setDbValue($rs->fields('satuan'));
		$win_material_part_->keterangan->setDbValue($rs->fields('keterangan'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $win_material_part_;

		// Call Row_Rendering event
		$win_material_part_->Row_Rendering();

		// Common render codes for all row types
		// kode

		$win_material_part_->kode->CellCssStyle = "white-space: nowrap;";
		$win_material_part_->kode->CellCssClass = "";

		// modepart
		$win_material_part_->modepart->CellCssStyle = "white-space: nowrap;";
		$win_material_part_->modepart->CellCssClass = "";

		// pn
		$win_material_part_->pn->CellCssStyle = "white-space: nowrap;";
		$win_material_part_->pn->CellCssClass = "";

		// category
		$win_material_part_->category->CellCssStyle = "white-space: nowrap;";
		$win_material_part_->category->CellCssClass = "";

		// modelunit
		$win_material_part_->modelunit->CellCssStyle = "white-space: nowrap;";
		$win_material_part_->modelunit->CellCssClass = "";

		// nama
		$win_material_part_->nama->CellCssStyle = "white-space: nowrap;";
		$win_material_part_->nama->CellCssClass = "";

		// satuan
		$win_material_part_->satuan->CellCssStyle = "white-space: nowrap;";
		$win_material_part_->satuan->CellCssClass = "";

		// keterangan
		$win_material_part_->keterangan->CellCssStyle = "white-space: nowrap;";
		$win_material_part_->keterangan->CellCssClass = "";
		if ($win_material_part_->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$win_material_part_->kode->ViewValue = $win_material_part_->kode->CurrentValue;
			$win_material_part_->kode->CssStyle = "";
			$win_material_part_->kode->CssClass = "";
			$win_material_part_->kode->ViewCustomAttributes = "";

			// modepart
			if (strval($win_material_part_->modepart->CurrentValue) <> "") {
				switch ($win_material_part_->modepart->CurrentValue) {
					case "unit":
						$win_material_part_->modepart->ViewValue = "Unit";
						break;
					case "part":
						$win_material_part_->modepart->ViewValue = "Part";
						break;
					case "material":
						$win_material_part_->modepart->ViewValue = "Material";
						break;
					default:
						$win_material_part_->modepart->ViewValue = $win_material_part_->modepart->CurrentValue;
				}
			} else {
				$win_material_part_->modepart->ViewValue = NULL;
			}
			$win_material_part_->modepart->CssStyle = "";
			$win_material_part_->modepart->CssClass = "";
			$win_material_part_->modepart->ViewCustomAttributes = "";

			// pn
			$win_material_part_->pn->ViewValue = $win_material_part_->pn->CurrentValue;
			$win_material_part_->pn->CssStyle = "";
			$win_material_part_->pn->CssClass = "";
			$win_material_part_->pn->ViewCustomAttributes = "";

			// category
			$win_material_part_->category->ViewValue = $win_material_part_->category->CurrentValue;
			$win_material_part_->category->CssStyle = "";
			$win_material_part_->category->CssClass = "";
			$win_material_part_->category->ViewCustomAttributes = "";

			// modelunit
			if (strval($win_material_part_->modelunit->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `model` FROM `mst_modelunit` WHERE `kode` = '" . ew_AdjustSql($win_material_part_->modelunit->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `model` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$win_material_part_->modelunit->ViewValue = $rswrk->fields('model');
					$rswrk->Close();
				} else {
					$win_material_part_->modelunit->ViewValue = $win_material_part_->modelunit->CurrentValue;
				}
			} else {
				$win_material_part_->modelunit->ViewValue = NULL;
			}
			$win_material_part_->modelunit->CssStyle = "";
			$win_material_part_->modelunit->CssClass = "";
			$win_material_part_->modelunit->ViewCustomAttributes = "";

			// nama
			$win_material_part_->nama->ViewValue = $win_material_part_->nama->CurrentValue;
			$win_material_part_->nama->CssStyle = "";
			$win_material_part_->nama->CssClass = "";
			$win_material_part_->nama->ViewCustomAttributes = "";

			// satuan
			if (strval($win_material_part_->satuan->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `singkatan` FROM `mst_satuan` WHERE `kode` = '" . ew_AdjustSql($win_material_part_->satuan->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `singkatan` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$win_material_part_->satuan->ViewValue = $rswrk->fields('singkatan');
					$rswrk->Close();
				} else {
					$win_material_part_->satuan->ViewValue = $win_material_part_->satuan->CurrentValue;
				}
			} else {
				$win_material_part_->satuan->ViewValue = NULL;
			}
			$win_material_part_->satuan->CssStyle = "";
			$win_material_part_->satuan->CssClass = "";
			$win_material_part_->satuan->ViewCustomAttributes = "";

			// keterangan
			$win_material_part_->keterangan->ViewValue = $win_material_part_->keterangan->CurrentValue;
			$win_material_part_->keterangan->CssStyle = "";
			$win_material_part_->keterangan->CssClass = "";
			$win_material_part_->keterangan->ViewCustomAttributes = "";

			// kode
			$win_material_part_->kode->HrefValue = "";

			// modepart
			$win_material_part_->modepart->HrefValue = "";

			// pn
			$win_material_part_->pn->HrefValue = "";

			// category
			$win_material_part_->category->HrefValue = "";

			// modelunit
			$win_material_part_->modelunit->HrefValue = "";

			// nama
			$win_material_part_->nama->HrefValue = "";

			// satuan
			$win_material_part_->satuan->HrefValue = "";

			// keterangan
			$win_material_part_->keterangan->HrefValue = "";
		} elseif ($win_material_part_->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// kode
			$win_material_part_->kode->EditCustomAttributes = "";
			$win_material_part_->kode->EditValue = ew_HtmlEncode($win_material_part_->kode->AdvancedSearch->SearchValue);

			// modepart
			$win_material_part_->modepart->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("unit", "Unit");
			$arwrk[] = array("part", "Part");
			$arwrk[] = array("material", "Material");
			array_unshift($arwrk, array("", "Please Select"));
			$win_material_part_->modepart->EditValue = $arwrk;

			// pn
			$win_material_part_->pn->EditCustomAttributes = "";
			$win_material_part_->pn->EditValue = ew_HtmlEncode($win_material_part_->pn->AdvancedSearch->SearchValue);

			// category
			$win_material_part_->category->EditCustomAttributes = "";
			$win_material_part_->category->EditValue = ew_HtmlEncode($win_material_part_->category->AdvancedSearch->SearchValue);

			// modelunit
			$win_material_part_->modelunit->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `model`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_modelunit`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `model` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$win_material_part_->modelunit->EditValue = $arwrk;

			// nama
			$win_material_part_->nama->EditCustomAttributes = "";
			$win_material_part_->nama->EditValue = ew_HtmlEncode($win_material_part_->nama->AdvancedSearch->SearchValue);

			// satuan
			$win_material_part_->satuan->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `singkatan`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_satuan`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `singkatan` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$win_material_part_->satuan->EditValue = $arwrk;

			// keterangan
			$win_material_part_->keterangan->EditCustomAttributes = "";
			$win_material_part_->keterangan->EditValue = ew_HtmlEncode($win_material_part_->keterangan->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		$win_material_part_->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $win_material_part_;

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
		global $win_material_part_;
		$win_material_part_->kode->AdvancedSearch->SearchValue = $win_material_part_->getAdvancedSearch("x_kode");
		$win_material_part_->modepart->AdvancedSearch->SearchValue = $win_material_part_->getAdvancedSearch("x_modepart");
		$win_material_part_->pn->AdvancedSearch->SearchValue = $win_material_part_->getAdvancedSearch("x_pn");
		$win_material_part_->category->AdvancedSearch->SearchValue = $win_material_part_->getAdvancedSearch("x_category");
		$win_material_part_->modelunit->AdvancedSearch->SearchValue = $win_material_part_->getAdvancedSearch("x_modelunit");
		$win_material_part_->nama->AdvancedSearch->SearchValue = $win_material_part_->getAdvancedSearch("x_nama");
		$win_material_part_->satuan->AdvancedSearch->SearchValue = $win_material_part_->getAdvancedSearch("x_satuan");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $win_material_part_;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($win_material_part_->ExportAll) {
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
		if ($win_material_part_->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($win_material_part_->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $win_material_part_->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'kode', $win_material_part_->Export);
				ew_ExportAddValue($sExportStr, 'modepart', $win_material_part_->Export);
				ew_ExportAddValue($sExportStr, 'pn', $win_material_part_->Export);
				ew_ExportAddValue($sExportStr, 'category', $win_material_part_->Export);
				ew_ExportAddValue($sExportStr, 'modelunit', $win_material_part_->Export);
				ew_ExportAddValue($sExportStr, 'nama', $win_material_part_->Export);
				ew_ExportAddValue($sExportStr, 'satuan', $win_material_part_->Export);
				ew_ExportAddValue($sExportStr, 'keterangan', $win_material_part_->Export);
				echo ew_ExportLine($sExportStr, $win_material_part_->Export);
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
				$win_material_part_->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($win_material_part_->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('kode', $win_material_part_->kode->CurrentValue);
					$XmlDoc->AddField('modepart', $win_material_part_->modepart->CurrentValue);
					$XmlDoc->AddField('pn', $win_material_part_->pn->CurrentValue);
					$XmlDoc->AddField('category', $win_material_part_->category->CurrentValue);
					$XmlDoc->AddField('modelunit', $win_material_part_->modelunit->CurrentValue);
					$XmlDoc->AddField('nama', $win_material_part_->nama->CurrentValue);
					$XmlDoc->AddField('satuan', $win_material_part_->satuan->CurrentValue);
					$XmlDoc->AddField('keterangan', $win_material_part_->keterangan->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $win_material_part_->Export <> "csv") { // Vertical format
						echo ew_ExportField('kode', $win_material_part_->kode->ExportValue($win_material_part_->Export, $win_material_part_->ExportOriginalValue), $win_material_part_->Export);
						echo ew_ExportField('modepart', $win_material_part_->modepart->ExportValue($win_material_part_->Export, $win_material_part_->ExportOriginalValue), $win_material_part_->Export);
						echo ew_ExportField('pn', $win_material_part_->pn->ExportValue($win_material_part_->Export, $win_material_part_->ExportOriginalValue), $win_material_part_->Export);
						echo ew_ExportField('category', $win_material_part_->category->ExportValue($win_material_part_->Export, $win_material_part_->ExportOriginalValue), $win_material_part_->Export);
						echo ew_ExportField('modelunit', $win_material_part_->modelunit->ExportValue($win_material_part_->Export, $win_material_part_->ExportOriginalValue), $win_material_part_->Export);
						echo ew_ExportField('nama', $win_material_part_->nama->ExportValue($win_material_part_->Export, $win_material_part_->ExportOriginalValue), $win_material_part_->Export);
						echo ew_ExportField('satuan', $win_material_part_->satuan->ExportValue($win_material_part_->Export, $win_material_part_->ExportOriginalValue), $win_material_part_->Export);
						echo ew_ExportField('keterangan', $win_material_part_->keterangan->ExportValue($win_material_part_->Export, $win_material_part_->ExportOriginalValue), $win_material_part_->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $win_material_part_->kode->ExportValue($win_material_part_->Export, $win_material_part_->ExportOriginalValue), $win_material_part_->Export);
						ew_ExportAddValue($sExportStr, $win_material_part_->modepart->ExportValue($win_material_part_->Export, $win_material_part_->ExportOriginalValue), $win_material_part_->Export);
						ew_ExportAddValue($sExportStr, $win_material_part_->pn->ExportValue($win_material_part_->Export, $win_material_part_->ExportOriginalValue), $win_material_part_->Export);
						ew_ExportAddValue($sExportStr, $win_material_part_->category->ExportValue($win_material_part_->Export, $win_material_part_->ExportOriginalValue), $win_material_part_->Export);
						ew_ExportAddValue($sExportStr, $win_material_part_->modelunit->ExportValue($win_material_part_->Export, $win_material_part_->ExportOriginalValue), $win_material_part_->Export);
						ew_ExportAddValue($sExportStr, $win_material_part_->nama->ExportValue($win_material_part_->Export, $win_material_part_->ExportOriginalValue), $win_material_part_->Export);
						ew_ExportAddValue($sExportStr, $win_material_part_->satuan->ExportValue($win_material_part_->Export, $win_material_part_->ExportOriginalValue), $win_material_part_->Export);
						ew_ExportAddValue($sExportStr, $win_material_part_->keterangan->ExportValue($win_material_part_->Export, $win_material_part_->ExportOriginalValue), $win_material_part_->Export);
						echo ew_ExportLine($sExportStr, $win_material_part_->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($win_material_part_->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($win_material_part_->Export);
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'win_material_part_';

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
