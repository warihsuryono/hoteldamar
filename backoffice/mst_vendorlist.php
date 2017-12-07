<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_vendorinfo.php" ?>
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
$mst_vendor_list = new cmst_vendor_list();
$Page =& $mst_vendor_list;

// Page init processing
$mst_vendor_list->Page_Init();

// Page main processing
$mst_vendor_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($mst_vendor->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var mst_vendor_list = new ew_Page("mst_vendor_list");

// page properties
mst_vendor_list.PageID = "list"; // page ID
var EW_PAGE_ID = mst_vendor_list.PageID; // for backward compatibility

// extend page with validate function for search
mst_vendor_list.ValidateSearch = function(fobj) {
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
mst_vendor_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
mst_vendor_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_vendor_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_vendor_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
mst_vendor_list.ShowHighlightText = "Show highlight"; 
mst_vendor_list.HideHighlightText = "Hide highlight";

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
<?php if ($mst_vendor->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($mst_vendor->Export == "" && $mst_vendor->SelectLimit);
	if (!$bSelectLimit)
		$rs = $mst_vendor_list->LoadRecordset();
	$mst_vendor_list->lTotalRecs = ($bSelectLimit) ? $mst_vendor->SelectRecordCount() : $rs->RecordCount();
	$mst_vendor_list->lStartRec = 1;
	if ($mst_vendor_list->lDisplayRecs <= 0) // Display all records
		$mst_vendor_list->lDisplayRecs = $mst_vendor_list->lTotalRecs;
	if (!($mst_vendor->ExportAll && $mst_vendor->Export <> ""))
		$mst_vendor_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $mst_vendor_list->LoadRecordset($mst_vendor_list->lStartRec-1, $mst_vendor_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Master Supplier</b></h3>
<?php if ($mst_vendor->Export == "" && $mst_vendor->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $mst_vendor_list->PageUrl() ?>export=print"><img src="images/print.gif" title="Printer Friendly" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $mst_vendor_list->PageUrl() ?>export=html"><img src="images/exporthtml.gif" title="Export to HTML" width="16" height="16" border="0"></a-->
&nbsp;&nbsp;<a href="<?php echo $mst_vendor_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<!--&nbsp;&nbsp;<a href="<?php echo $mst_vendor_list->PageUrl() ?>export=word"><img src="images/exportdoc.gif" title="Export to Word" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $mst_vendor_list->PageUrl() ?>export=xml"><img src="images/exportxml.gif" title="Export to XML" width="16" height="16" border="0"></a>
&nbsp;&nbsp;<a href="<?php echo $mst_vendor_list->PageUrl() ?>export=csv"><img src="images/exportcsv.gif" title="Export to CSV" width="16" height="16" border="0"></a-->
<?php } ?>
</span></p>
<?php if ($mst_vendor->Export == "" && $mst_vendor->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(mst_vendor_list);" style="text-decoration: none;"><img id="mst_vendor_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="mst_vendor_list_SearchPanel">
<form name="fmst_vendorlistsrch" id="fmst_vendorlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return mst_vendor_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="mst_vendor">
<?php
if ($gsSearchError == "")
	$mst_vendor_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$mst_vendor->RowType = EW_ROWTYPE_SEARCH;

// Render row
$mst_vendor_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Kode</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kode" id="z_kode" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kode" id="x_kode" size="10" maxlength="10" value="<?php echo $mst_vendor->kode->EditValue ?>"<?php echo $mst_vendor->kode->EditAttributes() ?>>
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
<input type="text" name="x_nama" id="x_nama" size="30" maxlength="100" value="<?php echo $mst_vendor->nama->EditValue ?>"<?php echo $mst_vendor->nama->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">NPWP</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_npwp" id="z_npwp" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_npwp" id="x_npwp" size="30" maxlength="100" value="<?php echo $mst_vendor->npwp->EditValue ?>"<?php echo $mst_vendor->npwp->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">PIC</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_pic" id="z_pic" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_pic" id="x_pic" size="30" maxlength="100" value="<?php echo $mst_vendor->pic->EditValue ?>"<?php echo $mst_vendor->pic->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Phone</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_phone" id="z_phone" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_phone" id="x_phone" size="30" maxlength="30" value="<?php echo $mst_vendor->phone->EditValue ?>"<?php echo $mst_vendor->phone->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Fax</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_fax" id="z_fax" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_fax" id="x_fax" size="30" maxlength="30" value="<?php echo $mst_vendor->fax->EditValue ?>"<?php echo $mst_vendor->fax->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">E Mail</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_zemail" id="z_zemail" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_zemail" id="x_zemail" size="30" maxlength="255" value="<?php echo $mst_vendor->zemail->EditValue ?>"<?php echo $mst_vendor->zemail->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<!--tr>
		<td><span class="phpmaker">Peruntukan</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_peruntukan" id="z_peruntukan" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_peruntukan" name="x_peruntukan"<?php echo $mst_vendor->peruntukan->EditAttributes() ?>>
<?php
if (is_array($mst_vendor->peruntukan->EditValue)) {
	$arwrk = $mst_vendor->peruntukan->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_vendor->peruntukan->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</table>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="Submit" name="Submit" id="Submit" value="Search (*)">&nbsp;
			<!-- <input type="Button" name="Reset" id="Reset" value="   Reset   " onclick="ew_ClearForm(this.form);if (this.form.<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>) this.form.<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>[0].checked = true;">&nbsp; -->
			<!--a href="<?php echo $mst_vendor_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $mst_vendor_list->PageUrl() ?>cmd=reset';">
			<?php if ($mst_vendor_list->sSrchWhere <> "" && $mst_vendor_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(mst_vendor_list, this, '<?php echo $mst_vendor->HighlightName() ?>');">Hide highlight</a>
			<?php } ?>
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $mst_vendor_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($mst_vendor->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($mst_vendor->CurrentAction <> "gridadd" && $mst_vendor->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($mst_vendor_list->Pager)) $mst_vendor_list->Pager = new cPrevNextPager($mst_vendor_list->lStartRec, $mst_vendor_list->lDisplayRecs, $mst_vendor_list->lTotalRecs) ?>
<?php if ($mst_vendor_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($mst_vendor_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $mst_vendor_list->PageUrl() ?>start=<?php echo $mst_vendor_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($mst_vendor_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $mst_vendor_list->PageUrl() ?>start=<?php echo $mst_vendor_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $mst_vendor_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($mst_vendor_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $mst_vendor_list->PageUrl() ?>start=<?php echo $mst_vendor_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($mst_vendor_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $mst_vendor_list->PageUrl() ?>start=<?php echo $mst_vendor_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $mst_vendor_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $mst_vendor_list->Pager->FromIndex ?> to <?php echo $mst_vendor_list->Pager->ToIndex ?> of <?php echo $mst_vendor_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($mst_vendor_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($mst_vendor_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="mst_vendor">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($mst_vendor_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($mst_vendor_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($mst_vendor_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="50"<?php if ($mst_vendor_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($mst_vendor_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($mst_vendor_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $mst_vendor->AddUrl() ?>"><img src="images/expand.gif" title="Add" width="16" height="16" border="0"></a>&nbsp;&nbsp;
<?php if ($mst_vendor_list->lTotalRecs > 0) { ?>
<a href="" onclick="if (!ew_KeySelected(document.fmst_vendorlist)) alert('No records selected'); else if (ew_Confirm('<?php echo $mst_vendor_list->sDeleteConfirmMsg ?>')) {document.fmst_vendorlist.action='mst_vendordelete.php';document.fmst_vendorlist.encoding='application/x-www-form-urlencoded';document.fmst_vendorlist.submit();};return false;"><img src="images/b_deltbl.png" title="Delete Selected Records" width="16" height="16" border="0"></a>&nbsp;&nbsp;
<?php } ?>
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fmst_vendorlist" id="fmst_vendorlist" class="ewForm" action="" method="post">
<?php if ($mst_vendor_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$mst_vendor_list->lOptionCnt = 0;
	$mst_vendor_list->lOptionCnt++; // edit
	$mst_vendor_list->lOptionCnt++; // Multi-select
	$mst_vendor_list->lOptionCnt += count($mst_vendor_list->ListOptions->Items); // Custom list options
?>
<?php echo $mst_vendor->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($mst_vendor->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;"><input type="checkbox" name="key" id="key" class="phpmaker" onclick="mst_vendor_list.SelectAllKey(this);"></td>
<?php

// Custom list options
foreach ($mst_vendor_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($mst_vendor->kode->Visible) { // kode ?>
	<?php if ($mst_vendor->SortUrl($mst_vendor->kode) == "") { ?>
		<td style="white-space: nowrap;">Kode</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_vendor->SortUrl($mst_vendor->kode) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode</td><td style="width: 10px;"><?php if ($mst_vendor->kode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_vendor->kode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_vendor->nama->Visible) { // nama ?>
	<?php if ($mst_vendor->SortUrl($mst_vendor->nama) == "") { ?>
		<td style="white-space: nowrap;">Nama</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_vendor->SortUrl($mst_vendor->nama) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Nama</td><td style="width: 10px;"><?php if ($mst_vendor->nama->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_vendor->nama->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_vendor->npwp->Visible) { // npwp ?>
	<?php if ($mst_vendor->SortUrl($mst_vendor->npwp) == "") { ?>
		<td style="white-space: nowrap;">NPWP</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_vendor->SortUrl($mst_vendor->npwp) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>NPWP</td><td style="width: 10px;"><?php if ($mst_vendor->npwp->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_vendor->npwp->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_vendor->pic->Visible) { // pic ?>
	<?php if ($mst_vendor->SortUrl($mst_vendor->pic) == "") { ?>
		<td style="white-space: nowrap;">PIC</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_vendor->SortUrl($mst_vendor->pic) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>PIC</td><td style="width: 10px;"><?php if ($mst_vendor->pic->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_vendor->pic->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_vendor->phone->Visible) { // phone ?>
	<?php if ($mst_vendor->SortUrl($mst_vendor->phone) == "") { ?>
		<td style="white-space: nowrap;">Phone</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_vendor->SortUrl($mst_vendor->phone) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Phone</td><td style="width: 10px;"><?php if ($mst_vendor->phone->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_vendor->phone->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_vendor->fax->Visible) { // fax ?>
	<?php if ($mst_vendor->SortUrl($mst_vendor->fax) == "") { ?>
		<td style="white-space: nowrap;">Fax</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_vendor->SortUrl($mst_vendor->fax) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Fax</td><td style="width: 10px;"><?php if ($mst_vendor->fax->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_vendor->fax->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_vendor->zemail->Visible) { // email ?>
	<?php if ($mst_vendor->SortUrl($mst_vendor->zemail) == "") { ?>
		<td style="white-space: nowrap;">E Mail</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_vendor->SortUrl($mst_vendor->zemail) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>E Mail</td><td style="width: 10px;"><?php if ($mst_vendor->zemail->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_vendor->zemail->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>
<!--		
<?php if ($mst_vendor->peruntukan->Visible) { // peruntukan ?>
	<?php if ($mst_vendor->SortUrl($mst_vendor->peruntukan) == "") { ?>
		<td style="white-space: nowrap;">Peruntukan</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_vendor->SortUrl($mst_vendor->peruntukan) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Peruntukan</td><td style="width: 10px;"><?php if ($mst_vendor->peruntukan->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_vendor->peruntukan->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
-->
	</tr>
</thead>
<?php
if ($mst_vendor->ExportAll && $mst_vendor->Export <> "") {
	$mst_vendor_list->lStopRec = $mst_vendor_list->lTotalRecs;
} else {
	$mst_vendor_list->lStopRec = $mst_vendor_list->lStartRec + $mst_vendor_list->lDisplayRecs - 1; // Set the last record to display
}
$mst_vendor_list->lRecCount = $mst_vendor_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$mst_vendor->SelectLimit && $mst_vendor_list->lStartRec > 1)
		$rs->Move($mst_vendor_list->lStartRec - 1);
}
$mst_vendor_list->lRowCnt = 0;
while (($mst_vendor->CurrentAction == "gridadd" || !$rs->EOF) &&
	$mst_vendor_list->lRecCount < $mst_vendor_list->lStopRec) {
	$mst_vendor_list->lRecCount++;
	if (intval($mst_vendor_list->lRecCount) >= intval($mst_vendor_list->lStartRec)) {
		$mst_vendor_list->lRowCnt++;

	// Init row class and style
	$mst_vendor->CssClass = "";
	$mst_vendor->CssStyle = "";
	$mst_vendor->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($mst_vendor->CurrentAction == "gridadd") {
		$mst_vendor_list->LoadDefaultValues(); // Load default values
	} else {
		$mst_vendor_list->LoadRowValues($rs); // Load row values
	}
	$mst_vendor->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$mst_vendor_list->RenderRow();
?>
	<tr<?php echo $mst_vendor->RowAttributes() ?>>
<?php if ($mst_vendor->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_vendor->EditUrl() ?>"><img src="images/edit.gif" title="Edit" width="16" height="16" border="0"></a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<input type="checkbox" name="key_m[]" id="key_m[]"  value="<?php echo ew_HtmlEncode($mst_vendor->kode->CurrentValue) ?>" class="phpmaker" onclick='ew_ClickMultiCheckbox(this);'>
</span></td>
<?php

// Custom list options
foreach ($mst_vendor_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($mst_vendor->kode->Visible) { // kode ?>
		<td<?php echo $mst_vendor->kode->CellAttributes() ?>>
<div<?php echo $mst_vendor->kode->ViewAttributes() ?>><?php echo $mst_vendor->kode->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_vendor->nama->Visible) { // nama ?>
		<td<?php echo $mst_vendor->nama->CellAttributes() ?>>
<div<?php echo $mst_vendor->nama->ViewAttributes() ?>><?php echo $mst_vendor->nama->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_vendor->npwp->Visible) { // npwp ?>
		<td<?php echo $mst_vendor->npwp->CellAttributes() ?>>
<div<?php echo $mst_vendor->npwp->ViewAttributes() ?>><?php echo $mst_vendor->npwp->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_vendor->pic->Visible) { // pic ?>
		<td<?php echo $mst_vendor->pic->CellAttributes() ?>>
<div<?php echo $mst_vendor->pic->ViewAttributes() ?>><?php echo $mst_vendor->pic->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_vendor->phone->Visible) { // phone ?>
		<td<?php echo $mst_vendor->phone->CellAttributes() ?>>
<div<?php echo $mst_vendor->phone->ViewAttributes() ?>><?php echo $mst_vendor->phone->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_vendor->fax->Visible) { // fax ?>
		<td<?php echo $mst_vendor->fax->CellAttributes() ?>>
<div<?php echo $mst_vendor->fax->ViewAttributes() ?>><?php echo $mst_vendor->fax->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_vendor->zemail->Visible) { // email ?>
		<td<?php echo $mst_vendor->zemail->CellAttributes() ?>>
<div<?php echo $mst_vendor->zemail->ViewAttributes() ?>><?php echo $mst_vendor->zemail->ListViewValue() ?></div>
</td>
	<?php } ?>
<!--
	<?php if ($mst_vendor->peruntukan->Visible) { // peruntukan ?>
		<td<?php echo $mst_vendor->peruntukan->CellAttributes() ?>>
<div<?php echo $mst_vendor->peruntukan->ViewAttributes() ?>><?php echo $mst_vendor->peruntukan->ListViewValue() ?></div>
</td>
	<?php } ?>
-->
	</tr>
<?php
	}
	if ($mst_vendor->CurrentAction <> "gridadd")
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
<?php if ($mst_vendor->Export == "" && $mst_vendor->CurrentAction == "") { ?>
<script type="text/javascript">
<!--
//ew_ToggleSearchPanel(mst_vendor_list); // uncomment to init search panel as collapsed

//-->
</script>
<?php } ?>
<?php if ($mst_vendor->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$mst_vendor_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_vendor_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'mst_vendor';

	// Page Object Name
	var $PageObjName = 'mst_vendor_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_vendor;
		if ($mst_vendor->UseTokenInUrl) $PageUrl .= "t=" . $mst_vendor->TableVar . "&"; // add page token
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
		global $objForm, $mst_vendor;
		if ($mst_vendor->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_vendor->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_vendor->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_vendor_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_vendor"] = new cmst_vendor();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_vendor', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_vendor;
	$mst_vendor->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $mst_vendor->Export; // Get export parameter, used in header
	$gsExportFile = $mst_vendor->TableVar; // Get export file, used in header
	if ($mst_vendor->Export == "print" || $mst_vendor->Export == "html") {

		// Printer friendly or Export to HTML, no action required
	}
	if ($mst_vendor->Export == "excel") {
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
	}
	if ($mst_vendor->Export == "word") {
		header('Content-Type: application/vnd.ms-word');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
	}
	if ($mst_vendor->Export == "xml") {
		header('Content-Type: text/xml');
		header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xml');
	}
	if ($mst_vendor->Export == "csv") {
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
		global $objForm, $gsSearchError, $Security, $mst_vendor;
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
		if ($mst_vendor->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $mst_vendor->getRecordsPerPage(); // Restore from Session
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
		$mst_vendor->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$mst_vendor->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$mst_vendor->setStartRecordNumber($this->lStartRec);
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
		$mst_vendor->setSessionWhere($sFilter);
		$mst_vendor->CurrentFilter = "";

		// Export data only
		if (in_array($mst_vendor->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $mst_vendor;
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
			$mst_vendor->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$mst_vendor->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $mst_vendor;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $mst_vendor->kode, FALSE); // Field kode
		$this->BuildSearchSql($sWhere, $mst_vendor->nama, FALSE); // Field nama
		$this->BuildSearchSql($sWhere, $mst_vendor->npwp, FALSE); // Field npwp
		$this->BuildSearchSql($sWhere, $mst_vendor->pic, FALSE); // Field pic
		$this->BuildSearchSql($sWhere, $mst_vendor->phone, FALSE); // Field phone
		$this->BuildSearchSql($sWhere, $mst_vendor->fax, FALSE); // Field fax
		$this->BuildSearchSql($sWhere, $mst_vendor->zemail, FALSE); // Field email
		$this->BuildSearchSql($sWhere, $mst_vendor->peruntukan, FALSE); // Field peruntukan

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($mst_vendor->kode); // Field kode
			$this->SetSearchParm($mst_vendor->nama); // Field nama
			$this->SetSearchParm($mst_vendor->npwp); // Field npwp
			$this->SetSearchParm($mst_vendor->pic); // Field pic
			$this->SetSearchParm($mst_vendor->phone); // Field phone
			$this->SetSearchParm($mst_vendor->fax); // Field fax
			$this->SetSearchParm($mst_vendor->zemail); // Field email
			$this->SetSearchParm($mst_vendor->peruntukan); // Field peruntukan
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
		global $mst_vendor;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$mst_vendor->setAdvancedSearch("x_$FldParm", $FldVal);
		$mst_vendor->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$mst_vendor->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$mst_vendor->setAdvancedSearch("y_$FldParm", $FldVal2);
		$mst_vendor->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $mst_vendor;
		$this->sSrchWhere = "";
		$mst_vendor->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $mst_vendor;
		$mst_vendor->setAdvancedSearch("x_kode", "");
		$mst_vendor->setAdvancedSearch("x_nama", "");
		$mst_vendor->setAdvancedSearch("x_npwp", "");
		$mst_vendor->setAdvancedSearch("x_pic", "");
		$mst_vendor->setAdvancedSearch("x_phone", "");
		$mst_vendor->setAdvancedSearch("x_fax", "");
		$mst_vendor->setAdvancedSearch("x_zemail", "");
		$mst_vendor->setAdvancedSearch("x_peruntukan", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $mst_vendor;
		$this->sSrchWhere = $mst_vendor->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $mst_vendor;
		 $mst_vendor->kode->AdvancedSearch->SearchValue = $mst_vendor->getAdvancedSearch("x_kode");
		 $mst_vendor->nama->AdvancedSearch->SearchValue = $mst_vendor->getAdvancedSearch("x_nama");
		 $mst_vendor->npwp->AdvancedSearch->SearchValue = $mst_vendor->getAdvancedSearch("x_npwp");
		 $mst_vendor->pic->AdvancedSearch->SearchValue = $mst_vendor->getAdvancedSearch("x_pic");
		 $mst_vendor->phone->AdvancedSearch->SearchValue = $mst_vendor->getAdvancedSearch("x_phone");
		 $mst_vendor->fax->AdvancedSearch->SearchValue = $mst_vendor->getAdvancedSearch("x_fax");
		 $mst_vendor->zemail->AdvancedSearch->SearchValue = $mst_vendor->getAdvancedSearch("x_zemail");
		 $mst_vendor->peruntukan->AdvancedSearch->SearchValue = $mst_vendor->getAdvancedSearch("x_peruntukan");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $mst_vendor;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$mst_vendor->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$mst_vendor->CurrentOrderType = @$_GET["ordertype"];
			$mst_vendor->UpdateSort($mst_vendor->kode); // Field 
			$mst_vendor->UpdateSort($mst_vendor->nama); // Field 
			$mst_vendor->UpdateSort($mst_vendor->npwp); // Field 
			$mst_vendor->UpdateSort($mst_vendor->pic); // Field 
			$mst_vendor->UpdateSort($mst_vendor->phone); // Field 
			$mst_vendor->UpdateSort($mst_vendor->fax); // Field 
			$mst_vendor->UpdateSort($mst_vendor->zemail); // Field 
			$mst_vendor->UpdateSort($mst_vendor->peruntukan); // Field 
			$mst_vendor->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $mst_vendor;
		$sOrderBy = $mst_vendor->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($mst_vendor->SqlOrderBy() <> "") {
				$sOrderBy = $mst_vendor->SqlOrderBy();
				$mst_vendor->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $mst_vendor;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$mst_vendor->setSessionOrderBy($sOrderBy);
				$mst_vendor->kode->setSort("");
				$mst_vendor->nama->setSort("");
				$mst_vendor->npwp->setSort("");
				$mst_vendor->pic->setSort("");
				$mst_vendor->phone->setSort("");
				$mst_vendor->fax->setSort("");
				$mst_vendor->zemail->setSort("");
				$mst_vendor->peruntukan->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$mst_vendor->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $mst_vendor;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$mst_vendor->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$mst_vendor->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $mst_vendor->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$mst_vendor->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$mst_vendor->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$mst_vendor->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $mst_vendor;

		// Load search values
		// kode

		$mst_vendor->kode->AdvancedSearch->SearchValue = @$_GET["x_kode"];
		$mst_vendor->kode->AdvancedSearch->SearchOperator = @$_GET["z_kode"];

		// nama
		$mst_vendor->nama->AdvancedSearch->SearchValue = @$_GET["x_nama"];
		$mst_vendor->nama->AdvancedSearch->SearchOperator = @$_GET["z_nama"];

		// npwp
		$mst_vendor->npwp->AdvancedSearch->SearchValue = @$_GET["x_npwp"];
		$mst_vendor->npwp->AdvancedSearch->SearchOperator = @$_GET["z_npwp"];

		// pic
		$mst_vendor->pic->AdvancedSearch->SearchValue = @$_GET["x_pic"];
		$mst_vendor->pic->AdvancedSearch->SearchOperator = @$_GET["z_pic"];

		// phone
		$mst_vendor->phone->AdvancedSearch->SearchValue = @$_GET["x_phone"];
		$mst_vendor->phone->AdvancedSearch->SearchOperator = @$_GET["z_phone"];

		// fax
		$mst_vendor->fax->AdvancedSearch->SearchValue = @$_GET["x_fax"];
		$mst_vendor->fax->AdvancedSearch->SearchOperator = @$_GET["z_fax"];

		// email
		$mst_vendor->zemail->AdvancedSearch->SearchValue = @$_GET["x_zemail"];
		$mst_vendor->zemail->AdvancedSearch->SearchOperator = @$_GET["z_zemail"];

		// peruntukan
		$mst_vendor->peruntukan->AdvancedSearch->SearchValue = @$_GET["x_peruntukan"];
		$mst_vendor->peruntukan->AdvancedSearch->SearchOperator = @$_GET["z_peruntukan"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mst_vendor;

		// Call Recordset Selecting event
		$mst_vendor->Recordset_Selecting($mst_vendor->CurrentFilter);

		// Load list page SQL
		$sSql = $mst_vendor->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$mst_vendor->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_vendor;
		$sFilter = $mst_vendor->KeyFilter();

		// Call Row Selecting event
		$mst_vendor->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_vendor->CurrentFilter = $sFilter;
		$sSql = $mst_vendor->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_vendor->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_vendor;
		$mst_vendor->kode->setDbValue($rs->fields('kode'));
		$mst_vendor->nama->setDbValue($rs->fields('nama'));
		$mst_vendor->alamat->setDbValue($rs->fields('alamat'));
		$mst_vendor->alamatpajak->setDbValue($rs->fields('alamatpajak'));
		$mst_vendor->npwp->setDbValue($rs->fields('npwp'));
		$mst_vendor->pic->setDbValue($rs->fields('pic'));
		$mst_vendor->phone->setDbValue($rs->fields('phone'));
		$mst_vendor->fax->setDbValue($rs->fields('fax'));
		$mst_vendor->zemail->setDbValue($rs->fields('email'));
		$mst_vendor->peruntukan->setDbValue($rs->fields('peruntukan'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_vendor;

		// Call Row_Rendering event
		$mst_vendor->Row_Rendering();

		// Common render codes for all row types
		// kode

		$mst_vendor->kode->CellCssStyle = "white-space: nowrap;";
		$mst_vendor->kode->CellCssClass = "";

		// nama
		$mst_vendor->nama->CellCssStyle = "white-space: nowrap;";
		$mst_vendor->nama->CellCssClass = "";

		// npwp
		$mst_vendor->npwp->CellCssStyle = "white-space: nowrap;";
		$mst_vendor->npwp->CellCssClass = "";

		// pic
		$mst_vendor->pic->CellCssStyle = "white-space: nowrap;";
		$mst_vendor->pic->CellCssClass = "";

		// phone
		$mst_vendor->phone->CellCssStyle = "white-space: nowrap;";
		$mst_vendor->phone->CellCssClass = "";

		// fax
		$mst_vendor->fax->CellCssStyle = "white-space: nowrap;";
		$mst_vendor->fax->CellCssClass = "";

		// email
		$mst_vendor->zemail->CellCssStyle = "white-space: nowrap;";
		$mst_vendor->zemail->CellCssClass = "";

		// peruntukan
		$mst_vendor->peruntukan->CellCssStyle = "white-space: nowrap;";
		$mst_vendor->peruntukan->CellCssClass = "";
		if ($mst_vendor->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$mst_vendor->kode->ViewValue = $mst_vendor->kode->CurrentValue;
			$mst_vendor->kode->CssStyle = "";
			$mst_vendor->kode->CssClass = "";
			$mst_vendor->kode->ViewCustomAttributes = "";

			// nama
			$mst_vendor->nama->ViewValue = $mst_vendor->nama->CurrentValue;
			$mst_vendor->nama->CssStyle = "";
			$mst_vendor->nama->CssClass = "";
			$mst_vendor->nama->ViewCustomAttributes = "";

			// npwp
			$mst_vendor->npwp->ViewValue = $mst_vendor->npwp->CurrentValue;
			$mst_vendor->npwp->CssStyle = "";
			$mst_vendor->npwp->CssClass = "";
			$mst_vendor->npwp->ViewCustomAttributes = "";

			// pic
			$mst_vendor->pic->ViewValue = $mst_vendor->pic->CurrentValue;
			$mst_vendor->pic->CssStyle = "";
			$mst_vendor->pic->CssClass = "";
			$mst_vendor->pic->ViewCustomAttributes = "";

			// phone
			$mst_vendor->phone->ViewValue = $mst_vendor->phone->CurrentValue;
			$mst_vendor->phone->CssStyle = "";
			$mst_vendor->phone->CssClass = "";
			$mst_vendor->phone->ViewCustomAttributes = "";

			// fax
			$mst_vendor->fax->ViewValue = $mst_vendor->fax->CurrentValue;
			$mst_vendor->fax->CssStyle = "";
			$mst_vendor->fax->CssClass = "";
			$mst_vendor->fax->ViewCustomAttributes = "";

			// email
			$mst_vendor->zemail->ViewValue = $mst_vendor->zemail->CurrentValue;
			$mst_vendor->zemail->CssStyle = "";
			$mst_vendor->zemail->CssClass = "";
			$mst_vendor->zemail->ViewCustomAttributes = "";

			// peruntukan
			if (strval($mst_vendor->peruntukan->CurrentValue) <> "") {
				switch ($mst_vendor->peruntukan->CurrentValue) {
					case "unit":
						$mst_vendor->peruntukan->ViewValue = "Unit";
						break;
					case "part":
						$mst_vendor->peruntukan->ViewValue = "Part";
						break;
					case "material":
						$mst_vendor->peruntukan->ViewValue = "Material";
						break;
					default:
						$mst_vendor->peruntukan->ViewValue = $mst_vendor->peruntukan->CurrentValue;
				}
			} else {
				$mst_vendor->peruntukan->ViewValue = NULL;
			}
			$mst_vendor->peruntukan->CssStyle = "";
			$mst_vendor->peruntukan->CssClass = "";
			$mst_vendor->peruntukan->ViewCustomAttributes = "";

			// kode
			$mst_vendor->kode->HrefValue = "";

			// nama
			$mst_vendor->nama->HrefValue = "";

			// npwp
			$mst_vendor->npwp->HrefValue = "";

			// pic
			$mst_vendor->pic->HrefValue = "";

			// phone
			$mst_vendor->phone->HrefValue = "";

			// fax
			$mst_vendor->fax->HrefValue = "";

			// email
			$mst_vendor->zemail->HrefValue = "";

			// peruntukan
			$mst_vendor->peruntukan->HrefValue = "";
		} elseif ($mst_vendor->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// kode
			$mst_vendor->kode->EditCustomAttributes = "";
			$mst_vendor->kode->EditValue = ew_HtmlEncode($mst_vendor->kode->AdvancedSearch->SearchValue);

			// nama
			$mst_vendor->nama->EditCustomAttributes = "";
			$mst_vendor->nama->EditValue = ew_HtmlEncode($mst_vendor->nama->AdvancedSearch->SearchValue);

			// npwp
			$mst_vendor->npwp->EditCustomAttributes = "";
			$mst_vendor->npwp->EditValue = ew_HtmlEncode($mst_vendor->npwp->AdvancedSearch->SearchValue);

			// pic
			$mst_vendor->pic->EditCustomAttributes = "";
			$mst_vendor->pic->EditValue = ew_HtmlEncode($mst_vendor->pic->AdvancedSearch->SearchValue);

			// phone
			$mst_vendor->phone->EditCustomAttributes = "";
			$mst_vendor->phone->EditValue = ew_HtmlEncode($mst_vendor->phone->AdvancedSearch->SearchValue);

			// fax
			$mst_vendor->fax->EditCustomAttributes = "";
			$mst_vendor->fax->EditValue = ew_HtmlEncode($mst_vendor->fax->AdvancedSearch->SearchValue);

			// email
			$mst_vendor->zemail->EditCustomAttributes = "";
			$mst_vendor->zemail->EditValue = ew_HtmlEncode($mst_vendor->zemail->AdvancedSearch->SearchValue);

			// peruntukan
			$mst_vendor->peruntukan->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("unit", "Unit");
			$arwrk[] = array("part", "Part");
			$arwrk[] = array("material", "Material");
			array_unshift($arwrk, array("", "Please Select"));
			$mst_vendor->peruntukan->EditValue = $arwrk;
		}

		// Call Row Rendered event
		$mst_vendor->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $mst_vendor;

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
		global $mst_vendor;
		$mst_vendor->kode->AdvancedSearch->SearchValue = $mst_vendor->getAdvancedSearch("x_kode");
		$mst_vendor->nama->AdvancedSearch->SearchValue = $mst_vendor->getAdvancedSearch("x_nama");
		$mst_vendor->npwp->AdvancedSearch->SearchValue = $mst_vendor->getAdvancedSearch("x_npwp");
		$mst_vendor->pic->AdvancedSearch->SearchValue = $mst_vendor->getAdvancedSearch("x_pic");
		$mst_vendor->phone->AdvancedSearch->SearchValue = $mst_vendor->getAdvancedSearch("x_phone");
		$mst_vendor->fax->AdvancedSearch->SearchValue = $mst_vendor->getAdvancedSearch("x_fax");
		$mst_vendor->zemail->AdvancedSearch->SearchValue = $mst_vendor->getAdvancedSearch("x_zemail");
		$mst_vendor->peruntukan->AdvancedSearch->SearchValue = $mst_vendor->getAdvancedSearch("x_peruntukan");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $mst_vendor;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($mst_vendor->ExportAll) {
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
		if ($mst_vendor->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($mst_vendor->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $mst_vendor->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'kode', $mst_vendor->Export);
				ew_ExportAddValue($sExportStr, 'nama', $mst_vendor->Export);
				ew_ExportAddValue($sExportStr, 'npwp', $mst_vendor->Export);
				ew_ExportAddValue($sExportStr, 'pic', $mst_vendor->Export);
				ew_ExportAddValue($sExportStr, 'phone', $mst_vendor->Export);
				ew_ExportAddValue($sExportStr, 'fax', $mst_vendor->Export);
				ew_ExportAddValue($sExportStr, 'email', $mst_vendor->Export);
				ew_ExportAddValue($sExportStr, 'peruntukan', $mst_vendor->Export);
				echo ew_ExportLine($sExportStr, $mst_vendor->Export);
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
				$mst_vendor->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($mst_vendor->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('kode', $mst_vendor->kode->CurrentValue);
					$XmlDoc->AddField('nama', $mst_vendor->nama->CurrentValue);
					$XmlDoc->AddField('npwp', $mst_vendor->npwp->CurrentValue);
					$XmlDoc->AddField('pic', $mst_vendor->pic->CurrentValue);
					$XmlDoc->AddField('phone', $mst_vendor->phone->CurrentValue);
					$XmlDoc->AddField('fax', $mst_vendor->fax->CurrentValue);
					$XmlDoc->AddField('zemail', $mst_vendor->zemail->CurrentValue);
					$XmlDoc->AddField('peruntukan', $mst_vendor->peruntukan->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $mst_vendor->Export <> "csv") { // Vertical format
						echo ew_ExportField('kode', $mst_vendor->kode->ExportValue($mst_vendor->Export, $mst_vendor->ExportOriginalValue), $mst_vendor->Export);
						echo ew_ExportField('nama', $mst_vendor->nama->ExportValue($mst_vendor->Export, $mst_vendor->ExportOriginalValue), $mst_vendor->Export);
						echo ew_ExportField('npwp', $mst_vendor->npwp->ExportValue($mst_vendor->Export, $mst_vendor->ExportOriginalValue), $mst_vendor->Export);
						echo ew_ExportField('pic', $mst_vendor->pic->ExportValue($mst_vendor->Export, $mst_vendor->ExportOriginalValue), $mst_vendor->Export);
						echo ew_ExportField('phone', $mst_vendor->phone->ExportValue($mst_vendor->Export, $mst_vendor->ExportOriginalValue), $mst_vendor->Export);
						echo ew_ExportField('fax', $mst_vendor->fax->ExportValue($mst_vendor->Export, $mst_vendor->ExportOriginalValue), $mst_vendor->Export);
						echo ew_ExportField('email', $mst_vendor->zemail->ExportValue($mst_vendor->Export, $mst_vendor->ExportOriginalValue), $mst_vendor->Export);
						echo ew_ExportField('peruntukan', $mst_vendor->peruntukan->ExportValue($mst_vendor->Export, $mst_vendor->ExportOriginalValue), $mst_vendor->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $mst_vendor->kode->ExportValue($mst_vendor->Export, $mst_vendor->ExportOriginalValue), $mst_vendor->Export);
						ew_ExportAddValue($sExportStr, $mst_vendor->nama->ExportValue($mst_vendor->Export, $mst_vendor->ExportOriginalValue), $mst_vendor->Export);
						ew_ExportAddValue($sExportStr, $mst_vendor->npwp->ExportValue($mst_vendor->Export, $mst_vendor->ExportOriginalValue), $mst_vendor->Export);
						ew_ExportAddValue($sExportStr, $mst_vendor->pic->ExportValue($mst_vendor->Export, $mst_vendor->ExportOriginalValue), $mst_vendor->Export);
						ew_ExportAddValue($sExportStr, $mst_vendor->phone->ExportValue($mst_vendor->Export, $mst_vendor->ExportOriginalValue), $mst_vendor->Export);
						ew_ExportAddValue($sExportStr, $mst_vendor->fax->ExportValue($mst_vendor->Export, $mst_vendor->ExportOriginalValue), $mst_vendor->Export);
						ew_ExportAddValue($sExportStr, $mst_vendor->zemail->ExportValue($mst_vendor->Export, $mst_vendor->ExportOriginalValue), $mst_vendor->Export);
						ew_ExportAddValue($sExportStr, $mst_vendor->peruntukan->ExportValue($mst_vendor->Export, $mst_vendor->ExportOriginalValue), $mst_vendor->Export);
						echo ew_ExportLine($sExportStr, $mst_vendor->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($mst_vendor->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($mst_vendor->Export);
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'mst_vendor';

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
