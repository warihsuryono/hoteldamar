<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_material_partinfo.php" ?>
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
$mst_material_part_list = new cmst_material_part_list();
$Page =& $mst_material_part_list;

// Page init processing
$mst_material_part_list->Page_Init();

// Page main processing
$mst_material_part_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($mst_material_part->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var mst_material_part_list = new ew_Page("mst_material_part_list");

// page properties
mst_material_part_list.PageID = "list"; // page ID
var EW_PAGE_ID = mst_material_part_list.PageID; // for backward compatibility

// extend page with validate function for search
mst_material_part_list.ValidateSearch = function(fobj) {
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
mst_material_part_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_material_part_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_material_part_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($mst_material_part->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($mst_material_part->Export == "" && $mst_material_part->SelectLimit);
	if (!$bSelectLimit)
		$rs = $mst_material_part_list->LoadRecordset();
	$mst_material_part_list->lTotalRecs = ($bSelectLimit) ? $mst_material_part->SelectRecordCount() : $rs->RecordCount();
	$mst_material_part_list->lStartRec = 1;
	if ($mst_material_part_list->lDisplayRecs <= 0) // Display all records
		$mst_material_part_list->lDisplayRecs = $mst_material_part_list->lTotalRecs;
	if (!($mst_material_part->ExportAll && $mst_material_part->Export <> ""))
		$mst_material_part_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $mst_material_part_list->LoadRecordset($mst_material_part_list->lStartRec-1, $mst_material_part_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Master Barang</b></h3>
<?php if ($mst_material_part->Export == "" && $mst_material_part->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $mst_material_part_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $mst_material_part_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php if ($mst_material_part->Export == "" && $mst_material_part->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(mst_material_part_list);" style="text-decoration: none;"><img id="mst_material_part_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="mst_material_part_list_SearchPanel">
<form name="fmst_material_partlistsrch" id="fmst_material_partlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return mst_material_part_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="mst_material_part">
<?php
if ($gsSearchError == "")
	$mst_material_part_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$mst_material_part->RowType = EW_ROWTYPE_SEARCH;

// Render row
$mst_material_part_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Kode</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kode" id="z_kode" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kode" id="x_kode" size="30" maxlength="20" value="<?php echo $mst_material_part->kode->EditValue ?>"<?php echo $mst_material_part->kode->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Serial Number</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_pn" id="z_pn" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_pn" id="x_pn" size="30" maxlength="50" value="<?php echo $mst_material_part->pn->EditValue ?>"<?php echo $mst_material_part->pn->EditAttributes() ?>>
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
<select id="x_category" name="x_category"<?php echo $mst_material_part->category->EditAttributes() ?>>
<?php
if (is_array($mst_material_part->category->EditValue)) {
	$arwrk = $mst_material_part->category->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_material_part->category->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Tipe Barang</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_modelunit" id="z_modelunit" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_modelunit" name="x_modelunit"<?php echo $mst_material_part->modelunit->EditAttributes() ?>>
<?php
if (is_array($mst_material_part->modelunit->EditValue)) {
	$arwrk = $mst_material_part->modelunit->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_material_part->modelunit->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<input type="text" name="x_nama" id="x_nama" size="30" maxlength="100" value="<?php echo $mst_material_part->nama->EditValue ?>"<?php echo $mst_material_part->nama->EditAttributes() ?>>
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
<select id="x_satuan" name="x_satuan"<?php echo $mst_material_part->satuan->EditAttributes() ?>>
<?php
if (is_array($mst_material_part->satuan->EditValue)) {
	$arwrk = $mst_material_part->satuan->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_material_part->satuan->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">COA</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_coa" id="z_coa" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_coa" name="x_coa"<?php echo $mst_material_part->coa->EditAttributes() ?>>
<?php
if (is_array($mst_material_part->coa->EditValue)) {
	$arwrk = $mst_material_part->coa->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_material_part->coa->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
<?php if ($arwrk[$rowcntwrk][2] <> "") { ?>
<?php echo ew_ValueSeparator($rowcntwrk) ?><?php echo $arwrk[$rowcntwrk][2] ?>
<?php } ?>
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
			<!--a href="<?php echo $mst_material_part_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $mst_material_part_list->PageUrl() ?>cmd=reset';">
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $mst_material_part_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($mst_material_part->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($mst_material_part->CurrentAction <> "gridadd" && $mst_material_part->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($mst_material_part_list->Pager)) $mst_material_part_list->Pager = new cPrevNextPager($mst_material_part_list->lStartRec, $mst_material_part_list->lDisplayRecs, $mst_material_part_list->lTotalRecs) ?>
<?php if ($mst_material_part_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($mst_material_part_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $mst_material_part_list->PageUrl() ?>start=<?php echo $mst_material_part_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($mst_material_part_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $mst_material_part_list->PageUrl() ?>start=<?php echo $mst_material_part_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $mst_material_part_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($mst_material_part_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $mst_material_part_list->PageUrl() ?>start=<?php echo $mst_material_part_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($mst_material_part_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $mst_material_part_list->PageUrl() ?>start=<?php echo $mst_material_part_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $mst_material_part_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $mst_material_part_list->Pager->FromIndex ?> to <?php echo $mst_material_part_list->Pager->ToIndex ?> of <?php echo $mst_material_part_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($mst_material_part_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($mst_material_part_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="mst_material_part">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($mst_material_part_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($mst_material_part_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($mst_material_part_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($mst_material_part_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($mst_material_part_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($mst_material_part_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $mst_material_part->AddUrl() ?>"> <img src="images/expand.gif" title="Add" width="16" height="16" border="0"> </a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fmst_material_partlist" id="fmst_material_partlist" class="ewForm" action="" method="post">
<?php if ($mst_material_part_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$mst_material_part_list->lOptionCnt = 0;
	$mst_material_part_list->lOptionCnt++; // view
	$mst_material_part_list->lOptionCnt++; // edit
	$mst_material_part_list->lOptionCnt++; // Delete
	$mst_material_part_list->lOptionCnt += count($mst_material_part_list->ListOptions->Items); // Custom list options
?>
<?php echo $mst_material_part->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($mst_material_part->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($mst_material_part_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($mst_material_part->kode->Visible) { // kode ?>
	<?php if ($mst_material_part->SortUrl($mst_material_part->kode) == "") { ?>
		<td style="white-space: nowrap;">Kode</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_material_part->SortUrl($mst_material_part->kode) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode</td><td style="width: 10px;"><?php if ($mst_material_part->kode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_material_part->kode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_material_part->pn->Visible) { // pn ?>
	<?php if ($mst_material_part->SortUrl($mst_material_part->pn) == "") { ?>
		<td style="white-space: nowrap;">Serial Number</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_material_part->SortUrl($mst_material_part->pn) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Serial Number</td><td style="width: 10px;"><?php if ($mst_material_part->pn->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_material_part->pn->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_material_part->category->Visible) { // category ?>
	<?php if ($mst_material_part->SortUrl($mst_material_part->category) == "") { ?>
		<td style="white-space: nowrap;">Category</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_material_part->SortUrl($mst_material_part->category) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Category</td><td style="width: 10px;"><?php if ($mst_material_part->category->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_material_part->category->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_material_part->modelunit->Visible) { // modelunit ?>
	<?php if ($mst_material_part->SortUrl($mst_material_part->modelunit) == "") { ?>
		<td style="white-space: nowrap;">Tipe Barang</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_material_part->SortUrl($mst_material_part->modelunit) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tipe Barang</td><td style="width: 10px;"><?php if ($mst_material_part->modelunit->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_material_part->modelunit->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_material_part->nama->Visible) { // nama ?>
	<?php if ($mst_material_part->SortUrl($mst_material_part->nama) == "") { ?>
		<td style="white-space: nowrap;">Nama</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_material_part->SortUrl($mst_material_part->nama) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Nama</td><td style="width: 10px;"><?php if ($mst_material_part->nama->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_material_part->nama->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_material_part->satuan->Visible) { // satuan ?>
	<?php if ($mst_material_part->SortUrl($mst_material_part->satuan) == "") { ?>
		<td style="white-space: nowrap;">Satuan</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_material_part->SortUrl($mst_material_part->satuan) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Satuan</td><td style="width: 10px;"><?php if ($mst_material_part->satuan->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_material_part->satuan->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_material_part->keterangan->Visible) { // keterangan ?>
	<?php if ($mst_material_part->SortUrl($mst_material_part->keterangan) == "") { ?>
		<td style="white-space: nowrap;">Keterangan</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_material_part->SortUrl($mst_material_part->keterangan) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Keterangan</td><td style="width: 10px;"><?php if ($mst_material_part->keterangan->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_material_part->keterangan->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_material_part->coa->Visible) { // coa ?>
	<?php if ($mst_material_part->SortUrl($mst_material_part->coa) == "") { ?>
		<td style="white-space: nowrap;">COA</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_material_part->SortUrl($mst_material_part->coa) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>COA</td><td style="width: 10px;"><?php if ($mst_material_part->coa->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_material_part->coa->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($mst_material_part->ExportAll && $mst_material_part->Export <> "") {
	$mst_material_part_list->lStopRec = $mst_material_part_list->lTotalRecs;
} else {
	$mst_material_part_list->lStopRec = $mst_material_part_list->lStartRec + $mst_material_part_list->lDisplayRecs - 1; // Set the last record to display
}
$mst_material_part_list->lRecCount = $mst_material_part_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$mst_material_part->SelectLimit && $mst_material_part_list->lStartRec > 1)
		$rs->Move($mst_material_part_list->lStartRec - 1);
}
$mst_material_part_list->lRowCnt = 0;
while (($mst_material_part->CurrentAction == "gridadd" || !$rs->EOF) &&
	$mst_material_part_list->lRecCount < $mst_material_part_list->lStopRec) {
	$mst_material_part_list->lRecCount++;
	if (intval($mst_material_part_list->lRecCount) >= intval($mst_material_part_list->lStartRec)) {
		$mst_material_part_list->lRowCnt++;

	// Init row class and style
	$mst_material_part->CssClass = "";
	$mst_material_part->CssStyle = "";
	$mst_material_part->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($mst_material_part->CurrentAction == "gridadd") {
		$mst_material_part_list->LoadDefaultValues(); // Load default values
	} else {
		$mst_material_part_list->LoadRowValues($rs); // Load row values
	}
	$mst_material_part->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$mst_material_part_list->RenderRow();
?>
	<tr<?php echo $mst_material_part->RowAttributes() ?>>
<?php if ($mst_material_part->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_material_part->ViewUrl() ?>"><img src="images/view.gif" title="Detail" width="16" height="16" border="0"></a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_material_part->EditUrl() ?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0"></a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_material_part->DeleteUrl() ?>"><img src="images/b_drop.png" title="Delete" width="16" height="16" border="0"></a>
</span></td>
<?php

// Custom list options
foreach ($mst_material_part_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($mst_material_part->kode->Visible) { // kode ?>
		<td<?php echo $mst_material_part->kode->CellAttributes() ?>>
<div<?php echo $mst_material_part->kode->ViewAttributes() ?>><?php echo $mst_material_part->kode->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_material_part->pn->Visible) { // pn ?>
		<td<?php echo $mst_material_part->pn->CellAttributes() ?>>
<div<?php echo $mst_material_part->pn->ViewAttributes() ?>><?php echo $mst_material_part->pn->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_material_part->category->Visible) { // category ?>
		<td<?php echo $mst_material_part->category->CellAttributes() ?>>
<div<?php echo $mst_material_part->category->ViewAttributes() ?>><?php echo $mst_material_part->category->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_material_part->modelunit->Visible) { // modelunit ?>
		<td<?php echo $mst_material_part->modelunit->CellAttributes() ?>>
<div<?php echo $mst_material_part->modelunit->ViewAttributes() ?>><?php echo $mst_material_part->modelunit->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_material_part->nama->Visible) { // nama ?>
		<td<?php echo $mst_material_part->nama->CellAttributes() ?>>
<div<?php echo $mst_material_part->nama->ViewAttributes() ?>><?php echo $mst_material_part->nama->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_material_part->satuan->Visible) { // satuan ?>
		<td<?php echo $mst_material_part->satuan->CellAttributes() ?>>
<div<?php echo $mst_material_part->satuan->ViewAttributes() ?>><?php echo $mst_material_part->satuan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_material_part->keterangan->Visible) { // keterangan ?>
		<td<?php echo $mst_material_part->keterangan->CellAttributes() ?>>
<div<?php echo $mst_material_part->keterangan->ViewAttributes() ?>><?php echo $mst_material_part->keterangan->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_material_part->coa->Visible) { // coa ?>
		<td<?php echo $mst_material_part->coa->CellAttributes() ?>>
<div<?php echo $mst_material_part->coa->ViewAttributes() ?>><?php echo $mst_material_part->coa->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($mst_material_part->CurrentAction <> "gridadd")
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
<?php if ($mst_material_part->Export == "" && $mst_material_part->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(mst_material_part_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($mst_material_part->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$mst_material_part_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_material_part_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'mst_material_part';

	// Page Object Name
	var $PageObjName = 'mst_material_part_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_material_part;
		if ($mst_material_part->UseTokenInUrl) $PageUrl .= "t=" . $mst_material_part->TableVar . "&"; // add page token
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
		global $objForm, $mst_material_part;
		if ($mst_material_part->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_material_part->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_material_part->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_material_part_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_material_part"] = new cmst_material_part();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_material_part', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_material_part;
	$mst_material_part->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $mst_material_part->Export; // Get export parameter, used in header
	$gsExportFile = $mst_material_part->TableVar; // Get export file, used in header
	if ($mst_material_part->Export == "print" || $mst_material_part->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($mst_material_part->Export == "excel") {
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
		global $objForm, $gsSearchError, $Security, $mst_material_part;
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
		if ($mst_material_part->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $mst_material_part->getRecordsPerPage(); // Restore from Session
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
		$mst_material_part->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$mst_material_part->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$mst_material_part->setStartRecordNumber($this->lStartRec);
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
		$mst_material_part->setSessionWhere($sFilter);
		$mst_material_part->CurrentFilter = "";

		// Export data only
		if (in_array($mst_material_part->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $mst_material_part;
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
			$mst_material_part->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$mst_material_part->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $mst_material_part;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $mst_material_part->kode, FALSE); // Field kode
		$this->BuildSearchSql($sWhere, $mst_material_part->pn, FALSE); // Field pn
		$this->BuildSearchSql($sWhere, $mst_material_part->category, FALSE); // Field category
		$this->BuildSearchSql($sWhere, $mst_material_part->modelunit, FALSE); // Field modelunit
		$this->BuildSearchSql($sWhere, $mst_material_part->nama, FALSE); // Field nama
		$this->BuildSearchSql($sWhere, $mst_material_part->satuan, FALSE); // Field satuan
		$this->BuildSearchSql($sWhere, $mst_material_part->keterangan, FALSE); // Field keterangan
		$this->BuildSearchSql($sWhere, $mst_material_part->coa, FALSE); // Field coa

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($mst_material_part->kode); // Field kode
			$this->SetSearchParm($mst_material_part->pn); // Field pn
			$this->SetSearchParm($mst_material_part->category); // Field category
			$this->SetSearchParm($mst_material_part->modelunit); // Field modelunit
			$this->SetSearchParm($mst_material_part->nama); // Field nama
			$this->SetSearchParm($mst_material_part->satuan); // Field satuan
			$this->SetSearchParm($mst_material_part->keterangan); // Field keterangan
			$this->SetSearchParm($mst_material_part->coa); // Field coa
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
		global $mst_material_part;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$mst_material_part->setAdvancedSearch("x_$FldParm", $FldVal);
		$mst_material_part->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$mst_material_part->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$mst_material_part->setAdvancedSearch("y_$FldParm", $FldVal2);
		$mst_material_part->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $mst_material_part;
		$this->sSrchWhere = "";
		$mst_material_part->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $mst_material_part;
		$mst_material_part->setAdvancedSearch("x_kode", "");
		$mst_material_part->setAdvancedSearch("x_pn", "");
		$mst_material_part->setAdvancedSearch("x_category", "");
		$mst_material_part->setAdvancedSearch("x_modelunit", "");
		$mst_material_part->setAdvancedSearch("x_nama", "");
		$mst_material_part->setAdvancedSearch("x_satuan", "");
		$mst_material_part->setAdvancedSearch("x_keterangan", "");
		$mst_material_part->setAdvancedSearch("x_coa", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $mst_material_part;
		$this->sSrchWhere = $mst_material_part->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $mst_material_part;
		 $mst_material_part->kode->AdvancedSearch->SearchValue = $mst_material_part->getAdvancedSearch("x_kode");
		 $mst_material_part->pn->AdvancedSearch->SearchValue = $mst_material_part->getAdvancedSearch("x_pn");
		 $mst_material_part->category->AdvancedSearch->SearchValue = $mst_material_part->getAdvancedSearch("x_category");
		 $mst_material_part->modelunit->AdvancedSearch->SearchValue = $mst_material_part->getAdvancedSearch("x_modelunit");
		 $mst_material_part->nama->AdvancedSearch->SearchValue = $mst_material_part->getAdvancedSearch("x_nama");
		 $mst_material_part->satuan->AdvancedSearch->SearchValue = $mst_material_part->getAdvancedSearch("x_satuan");
		 $mst_material_part->keterangan->AdvancedSearch->SearchValue = $mst_material_part->getAdvancedSearch("x_keterangan");
		 $mst_material_part->coa->AdvancedSearch->SearchValue = $mst_material_part->getAdvancedSearch("x_coa");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $mst_material_part;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$mst_material_part->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$mst_material_part->CurrentOrderType = @$_GET["ordertype"];
			$mst_material_part->UpdateSort($mst_material_part->kode); // Field 
			$mst_material_part->UpdateSort($mst_material_part->pn); // Field 
			$mst_material_part->UpdateSort($mst_material_part->category); // Field 
			$mst_material_part->UpdateSort($mst_material_part->modelunit); // Field 
			$mst_material_part->UpdateSort($mst_material_part->nama); // Field 
			$mst_material_part->UpdateSort($mst_material_part->satuan); // Field 
			$mst_material_part->UpdateSort($mst_material_part->keterangan); // Field 
			$mst_material_part->UpdateSort($mst_material_part->coa); // Field 
			$mst_material_part->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $mst_material_part;
		$sOrderBy = $mst_material_part->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($mst_material_part->SqlOrderBy() <> "") {
				$sOrderBy = $mst_material_part->SqlOrderBy();
				$mst_material_part->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $mst_material_part;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$mst_material_part->setSessionOrderBy($sOrderBy);
				$mst_material_part->kode->setSort("");
				$mst_material_part->pn->setSort("");
				$mst_material_part->category->setSort("");
				$mst_material_part->modelunit->setSort("");
				$mst_material_part->nama->setSort("");
				$mst_material_part->satuan->setSort("");
				$mst_material_part->keterangan->setSort("");
				$mst_material_part->coa->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$mst_material_part->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $mst_material_part;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$mst_material_part->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$mst_material_part->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $mst_material_part->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$mst_material_part->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$mst_material_part->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$mst_material_part->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $mst_material_part;

		// Load search values
		// kode

		$mst_material_part->kode->AdvancedSearch->SearchValue = @$_GET["x_kode"];
		$mst_material_part->kode->AdvancedSearch->SearchOperator = @$_GET["z_kode"];

		// pn
		$mst_material_part->pn->AdvancedSearch->SearchValue = @$_GET["x_pn"];
		$mst_material_part->pn->AdvancedSearch->SearchOperator = @$_GET["z_pn"];

		// category
		$mst_material_part->category->AdvancedSearch->SearchValue = @$_GET["x_category"];
		$mst_material_part->category->AdvancedSearch->SearchOperator = @$_GET["z_category"];

		// modelunit
		$mst_material_part->modelunit->AdvancedSearch->SearchValue = @$_GET["x_modelunit"];
		$mst_material_part->modelunit->AdvancedSearch->SearchOperator = @$_GET["z_modelunit"];

		// nama
		$mst_material_part->nama->AdvancedSearch->SearchValue = @$_GET["x_nama"];
		$mst_material_part->nama->AdvancedSearch->SearchOperator = @$_GET["z_nama"];

		// satuan
		$mst_material_part->satuan->AdvancedSearch->SearchValue = @$_GET["x_satuan"];
		$mst_material_part->satuan->AdvancedSearch->SearchOperator = @$_GET["z_satuan"];

		// keterangan
		$mst_material_part->keterangan->AdvancedSearch->SearchValue = @$_GET["x_keterangan"];
		$mst_material_part->keterangan->AdvancedSearch->SearchOperator = @$_GET["z_keterangan"];

		// coa
		$mst_material_part->coa->AdvancedSearch->SearchValue = @$_GET["x_coa"];
		$mst_material_part->coa->AdvancedSearch->SearchOperator = @$_GET["z_coa"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mst_material_part;

		// Call Recordset Selecting event
		$mst_material_part->Recordset_Selecting($mst_material_part->CurrentFilter);

		// Load list page SQL
		$sSql = $mst_material_part->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$mst_material_part->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_material_part;
		$sFilter = $mst_material_part->KeyFilter();

		// Call Row Selecting event
		$mst_material_part->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_material_part->CurrentFilter = $sFilter;
		$sSql = $mst_material_part->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_material_part->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_material_part;
		$mst_material_part->kode->setDbValue($rs->fields('kode'));
		$mst_material_part->modepart->setDbValue($rs->fields('modepart'));
		$mst_material_part->pn->setDbValue($rs->fields('pn'));
		$mst_material_part->category->setDbValue($rs->fields('category'));
		$mst_material_part->modelunit->setDbValue($rs->fields('modelunit'));
		$mst_material_part->nama->setDbValue($rs->fields('nama'));
		$mst_material_part->satuan->setDbValue($rs->fields('satuan'));
		$mst_material_part->keterangan->setDbValue($rs->fields('keterangan'));
		$mst_material_part->coa->setDbValue($rs->fields('coa'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_material_part;

		// Call Row_Rendering event
		$mst_material_part->Row_Rendering();

		// Common render codes for all row types
		// kode

		$mst_material_part->kode->CellCssStyle = "white-space: nowrap;";
		$mst_material_part->kode->CellCssClass = "";

		// pn
		$mst_material_part->pn->CellCssStyle = "white-space: nowrap;";
		$mst_material_part->pn->CellCssClass = "";

		// category
		$mst_material_part->category->CellCssStyle = "white-space: nowrap;";
		$mst_material_part->category->CellCssClass = "";

		// modelunit
		$mst_material_part->modelunit->CellCssStyle = "white-space: nowrap;";
		$mst_material_part->modelunit->CellCssClass = "";

		// nama
		$mst_material_part->nama->CellCssStyle = "white-space: nowrap;";
		$mst_material_part->nama->CellCssClass = "";

		// satuan
		$mst_material_part->satuan->CellCssStyle = "white-space: nowrap;";
		$mst_material_part->satuan->CellCssClass = "";

		// keterangan
		$mst_material_part->keterangan->CellCssStyle = "white-space: nowrap;";
		$mst_material_part->keterangan->CellCssClass = "";

		// coa
		$mst_material_part->coa->CellCssStyle = "white-space: nowrap;";
		$mst_material_part->coa->CellCssClass = "";
		if ($mst_material_part->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$mst_material_part->kode->ViewValue = $mst_material_part->kode->CurrentValue;
			$mst_material_part->kode->CssStyle = "";
			$mst_material_part->kode->CssClass = "";
			$mst_material_part->kode->ViewCustomAttributes = "";

			// pn
			$mst_material_part->pn->ViewValue = $mst_material_part->pn->CurrentValue;
			$mst_material_part->pn->CssStyle = "";
			$mst_material_part->pn->CssClass = "";
			$mst_material_part->pn->ViewCustomAttributes = "";

			// category
			if (strval($mst_material_part->category->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `description` FROM `mst_material_cat` WHERE `id` = '" . ew_AdjustSql($mst_material_part->category->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_material_part->category->ViewValue = $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$mst_material_part->category->ViewValue = $mst_material_part->category->CurrentValue;
				}
			} else {
				$mst_material_part->category->ViewValue = NULL;
			}
			$mst_material_part->category->CssStyle = "";
			$mst_material_part->category->CssClass = "";
			$mst_material_part->category->ViewCustomAttributes = "";

			// modelunit
			if (strval($mst_material_part->modelunit->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `model` FROM `mst_modelunit` WHERE `kode` = '" . ew_AdjustSql($mst_material_part->modelunit->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_material_part->modelunit->ViewValue = $rswrk->fields('model');
					$rswrk->Close();
				} else {
					$mst_material_part->modelunit->ViewValue = $mst_material_part->modelunit->CurrentValue;
				}
			} else {
				$mst_material_part->modelunit->ViewValue = NULL;
			}
			$mst_material_part->modelunit->CssStyle = "";
			$mst_material_part->modelunit->CssClass = "";
			$mst_material_part->modelunit->ViewCustomAttributes = "";

			// nama
			$mst_material_part->nama->ViewValue = $mst_material_part->nama->CurrentValue;
			$mst_material_part->nama->CssStyle = "";
			$mst_material_part->nama->CssClass = "";
			$mst_material_part->nama->ViewCustomAttributes = "";

			// satuan
			if (strval($mst_material_part->satuan->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `singkatan` FROM `mst_satuan` WHERE `kode` = '" . ew_AdjustSql($mst_material_part->satuan->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_material_part->satuan->ViewValue = $rswrk->fields('singkatan');
					$rswrk->Close();
				} else {
					$mst_material_part->satuan->ViewValue = $mst_material_part->satuan->CurrentValue;
				}
			} else {
				$mst_material_part->satuan->ViewValue = NULL;
			}
			$mst_material_part->satuan->CssStyle = "";
			$mst_material_part->satuan->CssClass = "";
			$mst_material_part->satuan->ViewCustomAttributes = "";

			// keterangan
			$mst_material_part->keterangan->ViewValue = $mst_material_part->keterangan->CurrentValue;
			$mst_material_part->keterangan->CssStyle = "";
			$mst_material_part->keterangan->CssClass = "";
			$mst_material_part->keterangan->ViewCustomAttributes = "";

			// coa
			if (strval($mst_material_part->coa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `coa`, `description` FROM `acc_mst_coa` WHERE `coa` = '" . ew_AdjustSql($mst_material_part->coa->CurrentValue) . "'";
				$sSqlWrk .= " AND (" . "`description`<>''" . ")";
				$sSqlWrk .= " ORDER BY `coa` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_material_part->coa->ViewValue = $rswrk->fields('coa');
					$mst_material_part->coa->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$mst_material_part->coa->ViewValue = $mst_material_part->coa->CurrentValue;
				}
			} else {
				$mst_material_part->coa->ViewValue = NULL;
			}
			$mst_material_part->coa->CssStyle = "";
			$mst_material_part->coa->CssClass = "";
			$mst_material_part->coa->ViewCustomAttributes = "";

			// kode
			$mst_material_part->kode->HrefValue = "";

			// pn
			$mst_material_part->pn->HrefValue = "";

			// category
			$mst_material_part->category->HrefValue = "";

			// modelunit
			$mst_material_part->modelunit->HrefValue = "";

			// nama
			$mst_material_part->nama->HrefValue = "";

			// satuan
			$mst_material_part->satuan->HrefValue = "";

			// keterangan
			$mst_material_part->keterangan->HrefValue = "";

			// coa
			$mst_material_part->coa->HrefValue = "";
		} elseif ($mst_material_part->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// kode
			$mst_material_part->kode->EditCustomAttributes = "";
			$mst_material_part->kode->EditValue = ew_HtmlEncode($mst_material_part->kode->AdvancedSearch->SearchValue);

			// pn
			$mst_material_part->pn->EditCustomAttributes = "";
			$mst_material_part->pn->EditValue = ew_HtmlEncode($mst_material_part->pn->AdvancedSearch->SearchValue);

			// category
			$mst_material_part->category->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id`, `description`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_material_cat`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$mst_material_part->category->EditValue = $arwrk;

			// modelunit
			$mst_material_part->modelunit->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `model`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_modelunit`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$mst_material_part->modelunit->EditValue = $arwrk;

			// nama
			$mst_material_part->nama->EditCustomAttributes = "";
			$mst_material_part->nama->EditValue = ew_HtmlEncode($mst_material_part->nama->AdvancedSearch->SearchValue);

			// satuan
			$mst_material_part->satuan->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `singkatan`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_satuan`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$mst_material_part->satuan->EditValue = $arwrk;

			// keterangan
			$mst_material_part->keterangan->EditCustomAttributes = "";
			$mst_material_part->keterangan->EditValue = ew_HtmlEncode($mst_material_part->keterangan->AdvancedSearch->SearchValue);

			// coa
			$mst_material_part->coa->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `coa`, `coa`, `description`, '' AS SelectFilterFld FROM `acc_mst_coa`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk = "($sWhereWrk) AND ";
			$sWhereWrk .= "(" . "`description`<>''" . ")";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$sSqlWrk .= " ORDER BY `coa` ";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select", ""));
			$mst_material_part->coa->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$mst_material_part->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $mst_material_part;

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
		global $mst_material_part;
		$mst_material_part->kode->AdvancedSearch->SearchValue = $mst_material_part->getAdvancedSearch("x_kode");
		$mst_material_part->pn->AdvancedSearch->SearchValue = $mst_material_part->getAdvancedSearch("x_pn");
		$mst_material_part->category->AdvancedSearch->SearchValue = $mst_material_part->getAdvancedSearch("x_category");
		$mst_material_part->modelunit->AdvancedSearch->SearchValue = $mst_material_part->getAdvancedSearch("x_modelunit");
		$mst_material_part->nama->AdvancedSearch->SearchValue = $mst_material_part->getAdvancedSearch("x_nama");
		$mst_material_part->satuan->AdvancedSearch->SearchValue = $mst_material_part->getAdvancedSearch("x_satuan");
		$mst_material_part->keterangan->AdvancedSearch->SearchValue = $mst_material_part->getAdvancedSearch("x_keterangan");
		$mst_material_part->coa->AdvancedSearch->SearchValue = $mst_material_part->getAdvancedSearch("x_coa");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $mst_material_part;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($mst_material_part->ExportAll) {
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
		if ($mst_material_part->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($mst_material_part->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $mst_material_part->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'kode', $mst_material_part->Export);
				ew_ExportAddValue($sExportStr, 'pn', $mst_material_part->Export);
				ew_ExportAddValue($sExportStr, 'category', $mst_material_part->Export);
				ew_ExportAddValue($sExportStr, 'modelunit', $mst_material_part->Export);
				ew_ExportAddValue($sExportStr, 'nama', $mst_material_part->Export);
				ew_ExportAddValue($sExportStr, 'satuan', $mst_material_part->Export);
				ew_ExportAddValue($sExportStr, 'keterangan', $mst_material_part->Export);
				ew_ExportAddValue($sExportStr, 'coa', $mst_material_part->Export);
				echo ew_ExportLine($sExportStr, $mst_material_part->Export);
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
				$mst_material_part->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($mst_material_part->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('kode', $mst_material_part->kode->CurrentValue);
					$XmlDoc->AddField('pn', $mst_material_part->pn->CurrentValue);
					$XmlDoc->AddField('category', $mst_material_part->category->CurrentValue);
					$XmlDoc->AddField('modelunit', $mst_material_part->modelunit->CurrentValue);
					$XmlDoc->AddField('nama', $mst_material_part->nama->CurrentValue);
					$XmlDoc->AddField('satuan', $mst_material_part->satuan->CurrentValue);
					$XmlDoc->AddField('keterangan', $mst_material_part->keterangan->CurrentValue);
					$XmlDoc->AddField('coa', $mst_material_part->coa->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $mst_material_part->Export <> "csv") { // Vertical format
						echo ew_ExportField('kode', $mst_material_part->kode->ExportValue($mst_material_part->Export, $mst_material_part->ExportOriginalValue), $mst_material_part->Export);
						echo ew_ExportField('pn', $mst_material_part->pn->ExportValue($mst_material_part->Export, $mst_material_part->ExportOriginalValue), $mst_material_part->Export);
						echo ew_ExportField('category', $mst_material_part->category->ExportValue($mst_material_part->Export, $mst_material_part->ExportOriginalValue), $mst_material_part->Export);
						echo ew_ExportField('modelunit', $mst_material_part->modelunit->ExportValue($mst_material_part->Export, $mst_material_part->ExportOriginalValue), $mst_material_part->Export);
						echo ew_ExportField('nama', $mst_material_part->nama->ExportValue($mst_material_part->Export, $mst_material_part->ExportOriginalValue), $mst_material_part->Export);
						echo ew_ExportField('satuan', $mst_material_part->satuan->ExportValue($mst_material_part->Export, $mst_material_part->ExportOriginalValue), $mst_material_part->Export);
						echo ew_ExportField('keterangan', $mst_material_part->keterangan->ExportValue($mst_material_part->Export, $mst_material_part->ExportOriginalValue), $mst_material_part->Export);
						echo ew_ExportField('coa', $mst_material_part->coa->ExportValue($mst_material_part->Export, $mst_material_part->ExportOriginalValue), $mst_material_part->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $mst_material_part->kode->ExportValue($mst_material_part->Export, $mst_material_part->ExportOriginalValue), $mst_material_part->Export);
						ew_ExportAddValue($sExportStr, $mst_material_part->pn->ExportValue($mst_material_part->Export, $mst_material_part->ExportOriginalValue), $mst_material_part->Export);
						ew_ExportAddValue($sExportStr, $mst_material_part->category->ExportValue($mst_material_part->Export, $mst_material_part->ExportOriginalValue), $mst_material_part->Export);
						ew_ExportAddValue($sExportStr, $mst_material_part->modelunit->ExportValue($mst_material_part->Export, $mst_material_part->ExportOriginalValue), $mst_material_part->Export);
						ew_ExportAddValue($sExportStr, $mst_material_part->nama->ExportValue($mst_material_part->Export, $mst_material_part->ExportOriginalValue), $mst_material_part->Export);
						ew_ExportAddValue($sExportStr, $mst_material_part->satuan->ExportValue($mst_material_part->Export, $mst_material_part->ExportOriginalValue), $mst_material_part->Export);
						ew_ExportAddValue($sExportStr, $mst_material_part->keterangan->ExportValue($mst_material_part->Export, $mst_material_part->ExportOriginalValue), $mst_material_part->Export);
						ew_ExportAddValue($sExportStr, $mst_material_part->coa->ExportValue($mst_material_part->Export, $mst_material_part->ExportOriginalValue), $mst_material_part->Export);
						echo ew_ExportLine($sExportStr, $mst_material_part->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($mst_material_part->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($mst_material_part->Export);
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
