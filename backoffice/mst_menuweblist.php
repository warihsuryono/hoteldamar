<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_menuwebinfo.php" ?>
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
$mst_menuweb_list = new cmst_menuweb_list();
$Page =& $mst_menuweb_list;

// Page init processing
$mst_menuweb_list->Page_Init();

// Page main processing
$mst_menuweb_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($mst_menuweb->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var mst_menuweb_list = new ew_Page("mst_menuweb_list");

// page properties
mst_menuweb_list.PageID = "list"; // page ID
var EW_PAGE_ID = mst_menuweb_list.PageID; // for backward compatibility

// extend page with validate function for search
mst_menuweb_list.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_kode"];
	if (elm && !ew_CheckInteger(elm.value))
		return ew_OnError(this, elm, "Incorrect integer - Kode");
	elm = fobj.elements["x" + infix + "_seqno"];
	if (elm && !ew_CheckInteger(elm.value))
		return ew_OnError(this, elm, "Incorrect integer - No Urut");

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
mst_menuweb_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_menuweb_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_menuweb_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($mst_menuweb->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($mst_menuweb->Export == "" && $mst_menuweb->SelectLimit);
	if (!$bSelectLimit)
		$rs = $mst_menuweb_list->LoadRecordset();
	$mst_menuweb_list->lTotalRecs = ($bSelectLimit) ? $mst_menuweb->SelectRecordCount() : $rs->RecordCount();
	$mst_menuweb_list->lStartRec = 1;
	if ($mst_menuweb_list->lDisplayRecs <= 0) // Display all records
		$mst_menuweb_list->lDisplayRecs = $mst_menuweb_list->lTotalRecs;
	if (!($mst_menuweb->ExportAll && $mst_menuweb->Export <> ""))
		$mst_menuweb_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $mst_menuweb_list->LoadRecordset($mst_menuweb_list->lStartRec-1, $mst_menuweb_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Web Menu</b></h3>
<?php if ($mst_menuweb->Export == "" && $mst_menuweb->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $mst_menuweb_list->PageUrl() ?>export=excel"><img src="images/exportxls.gif" title="Export to Excel" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php if ($mst_menuweb->Export == "" && $mst_menuweb->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(mst_menuweb_list);" style="text-decoration: none;"><img id="mst_menuweb_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="mst_menuweb_list_SearchPanel">
<form name="fmst_menuweblistsrch" id="fmst_menuweblistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return mst_menuweb_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="mst_menuweb">
<?php
if ($gsSearchError == "")
	$mst_menuweb_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$mst_menuweb->RowType = EW_ROWTYPE_SEARCH;

// Render row
$mst_menuweb_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Kode</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_kode" id="z_kode" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kode" id="x_kode" value="<?php echo $mst_menuweb->kode->EditValue ?>"<?php echo $mst_menuweb->kode->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">No Urut</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_seqno" id="z_seqno" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_seqno" id="x_seqno" size="2" value="<?php echo $mst_menuweb->seqno->EditValue ?>"<?php echo $mst_menuweb->seqno->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Bahasa</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_lang" id="z_lang" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_lang" name="x_lang"<?php echo $mst_menuweb->lang->EditAttributes() ?>>
<?php
if (is_array($mst_menuweb->lang->EditValue)) {
	$arwrk = $mst_menuweb->lang->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_menuweb->lang->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Caption</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_caption" id="z_caption" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_caption" id="x_caption" size="30" maxlength="50" value="<?php echo $mst_menuweb->caption->EditValue ?>"<?php echo $mst_menuweb->caption->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Url</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_url" id="z_url" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_url" id="x_url" size="100" maxlength="255" value="<?php echo $mst_menuweb->url->EditValue ?>"<?php echo $mst_menuweb->url->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Create By</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_createby" id="z_createby" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_createby" name="x_createby"<?php echo $mst_menuweb->createby->EditAttributes() ?>>
<?php
if (is_array($mst_menuweb->createby->EditValue)) {
	$arwrk = $mst_menuweb->createby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_menuweb->createby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<!--a href="<?php echo $mst_menuweb_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $mst_menuweb_list->PageUrl() ?>cmd=reset';">
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $mst_menuweb_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($mst_menuweb->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($mst_menuweb->CurrentAction <> "gridadd" && $mst_menuweb->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($mst_menuweb_list->Pager)) $mst_menuweb_list->Pager = new cPrevNextPager($mst_menuweb_list->lStartRec, $mst_menuweb_list->lDisplayRecs, $mst_menuweb_list->lTotalRecs) ?>
<?php if ($mst_menuweb_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($mst_menuweb_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $mst_menuweb_list->PageUrl() ?>start=<?php echo $mst_menuweb_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($mst_menuweb_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $mst_menuweb_list->PageUrl() ?>start=<?php echo $mst_menuweb_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $mst_menuweb_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($mst_menuweb_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $mst_menuweb_list->PageUrl() ?>start=<?php echo $mst_menuweb_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($mst_menuweb_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $mst_menuweb_list->PageUrl() ?>start=<?php echo $mst_menuweb_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $mst_menuweb_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $mst_menuweb_list->Pager->FromIndex ?> to <?php echo $mst_menuweb_list->Pager->ToIndex ?> of <?php echo $mst_menuweb_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($mst_menuweb_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($mst_menuweb_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="mst_menuweb">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($mst_menuweb_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($mst_menuweb_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($mst_menuweb_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($mst_menuweb_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($mst_menuweb_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $mst_menuweb->AddUrl() ?>" target="_BLANK"> <img src="images/expand.gif" title="Add" width="16" height="16" border="0"> </a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fmst_menuweblist" id="fmst_menuweblist" class="ewForm" action="" method="post">
<?php if ($mst_menuweb_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$mst_menuweb_list->lOptionCnt = 0;
	$mst_menuweb_list->lOptionCnt++; // view
	$mst_menuweb_list->lOptionCnt++; // edit
	$mst_menuweb_list->lOptionCnt++; // copy
	$mst_menuweb_list->lOptionCnt++; // Delete
	$mst_menuweb_list->lOptionCnt += count($mst_menuweb_list->ListOptions->Items); // Custom list options
?>
<?php echo $mst_menuweb->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($mst_menuweb->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($mst_menuweb_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($mst_menuweb->kode->Visible) { // kode ?>
	<?php if ($mst_menuweb->SortUrl($mst_menuweb->kode) == "") { ?>
		<td style="white-space: nowrap;">Kode</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_menuweb->SortUrl($mst_menuweb->kode) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode</td><td style="width: 10px;"><?php if ($mst_menuweb->kode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_menuweb->kode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_menuweb->seqno->Visible) { // seqno ?>
	<?php if ($mst_menuweb->SortUrl($mst_menuweb->seqno) == "") { ?>
		<td style="white-space: nowrap;">No Urut</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_menuweb->SortUrl($mst_menuweb->seqno) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>No Urut</td><td style="width: 10px;"><?php if ($mst_menuweb->seqno->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_menuweb->seqno->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_menuweb->lang->Visible) { // lang ?>
	<?php if ($mst_menuweb->SortUrl($mst_menuweb->lang) == "") { ?>
		<td style="white-space: nowrap;">Bahasa</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_menuweb->SortUrl($mst_menuweb->lang) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Bahasa</td><td style="width: 10px;"><?php if ($mst_menuweb->lang->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_menuweb->lang->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_menuweb->caption->Visible) { // caption ?>
	<?php if ($mst_menuweb->SortUrl($mst_menuweb->caption) == "") { ?>
		<td style="white-space: nowrap;">Caption</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_menuweb->SortUrl($mst_menuweb->caption) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Caption</td><td style="width: 10px;"><?php if ($mst_menuweb->caption->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_menuweb->caption->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_menuweb->url->Visible) { // url ?>
	<?php if ($mst_menuweb->SortUrl($mst_menuweb->url) == "") { ?>
		<td style="white-space: nowrap;">Url</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_menuweb->SortUrl($mst_menuweb->url) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Url</td><td style="width: 10px;"><?php if ($mst_menuweb->url->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_menuweb->url->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_menuweb->target->Visible) { // target ?>
	<?php if ($mst_menuweb->SortUrl($mst_menuweb->target) == "") { ?>
		<td style="white-space: nowrap;">Target</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_menuweb->SortUrl($mst_menuweb->target) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Target</td><td style="width: 10px;"><?php if ($mst_menuweb->target->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_menuweb->target->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_menuweb->createby->Visible) { // createby ?>
	<?php if ($mst_menuweb->SortUrl($mst_menuweb->createby) == "") { ?>
		<td style="white-space: nowrap;">Create By</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_menuweb->SortUrl($mst_menuweb->createby) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Create By</td><td style="width: 10px;"><?php if ($mst_menuweb->createby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_menuweb->createby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_menuweb->createdate->Visible) { // createdate ?>
	<?php if ($mst_menuweb->SortUrl($mst_menuweb->createdate) == "") { ?>
		<td style="white-space: nowrap;">Create Date</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_menuweb->SortUrl($mst_menuweb->createdate) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Create Date</td><td style="width: 10px;"><?php if ($mst_menuweb->createdate->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_menuweb->createdate->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($mst_menuweb->ExportAll && $mst_menuweb->Export <> "") {
	$mst_menuweb_list->lStopRec = $mst_menuweb_list->lTotalRecs;
} else {
	$mst_menuweb_list->lStopRec = $mst_menuweb_list->lStartRec + $mst_menuweb_list->lDisplayRecs - 1; // Set the last record to display
}
$mst_menuweb_list->lRecCount = $mst_menuweb_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$mst_menuweb->SelectLimit && $mst_menuweb_list->lStartRec > 1)
		$rs->Move($mst_menuweb_list->lStartRec - 1);
}
$mst_menuweb_list->lRowCnt = 0;
while (($mst_menuweb->CurrentAction == "gridadd" || !$rs->EOF) &&
	$mst_menuweb_list->lRecCount < $mst_menuweb_list->lStopRec) {
	$mst_menuweb_list->lRecCount++;
	if (intval($mst_menuweb_list->lRecCount) >= intval($mst_menuweb_list->lStartRec)) {
		$mst_menuweb_list->lRowCnt++;

	// Init row class and style
	$mst_menuweb->CssClass = "";
	$mst_menuweb->CssStyle = "";
	$mst_menuweb->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($mst_menuweb->CurrentAction == "gridadd") {
		$mst_menuweb_list->LoadDefaultValues(); // Load default values
	} else {
		$mst_menuweb_list->LoadRowValues($rs); // Load row values
	}
	$mst_menuweb->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$mst_menuweb_list->RenderRow();
?>
	<tr<?php echo $mst_menuweb->RowAttributes() ?>>
<?php if ($mst_menuweb->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_menuweb->ViewUrl() ?>"><img src="images/view.gif" title="Detail" width="16" height="16" border="0"></a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_menuweb->EditUrl() ?>" target="_BLANK"><img src="images/inlineedit.gif" title="Edit" width="16" height="16" border="0"></a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_menuweb->CopyUrl() ?>" target="_BLANK"><img src="images/copy.gif" title="Copy" width="16" height="16" border="0"></a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_menuweb->DeleteUrl() ?>"><img src="images/b_drop.png" title="Delete" width="16" height="16" border="0"></a>
</span></td>
<?php

// Custom list options
foreach ($mst_menuweb_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($mst_menuweb->kode->Visible) { // kode ?>
		<td<?php echo $mst_menuweb->kode->CellAttributes() ?>>
<div<?php echo $mst_menuweb->kode->ViewAttributes() ?>><?php echo $mst_menuweb->kode->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_menuweb->seqno->Visible) { // seqno ?>
		<td<?php echo $mst_menuweb->seqno->CellAttributes() ?>>
<div<?php echo $mst_menuweb->seqno->ViewAttributes() ?>><?php echo $mst_menuweb->seqno->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_menuweb->lang->Visible) { // lang ?>
		<td<?php echo $mst_menuweb->lang->CellAttributes() ?>>
<div<?php echo $mst_menuweb->lang->ViewAttributes() ?>><?php echo $mst_menuweb->lang->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_menuweb->caption->Visible) { // caption ?>
		<td<?php echo $mst_menuweb->caption->CellAttributes() ?>>
<div<?php echo $mst_menuweb->caption->ViewAttributes() ?>><?php echo $mst_menuweb->caption->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_menuweb->url->Visible) { // url ?>
		<td<?php echo $mst_menuweb->url->CellAttributes() ?>>
<div<?php echo $mst_menuweb->url->ViewAttributes() ?>><?php echo $mst_menuweb->url->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_menuweb->target->Visible) { // target ?>
		<td<?php echo $mst_menuweb->target->CellAttributes() ?>>
<div<?php echo $mst_menuweb->target->ViewAttributes() ?>><?php echo $mst_menuweb->target->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_menuweb->createby->Visible) { // createby ?>
		<td<?php echo $mst_menuweb->createby->CellAttributes() ?>>
<div<?php echo $mst_menuweb->createby->ViewAttributes() ?>><?php echo $mst_menuweb->createby->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_menuweb->createdate->Visible) { // createdate ?>
		<td<?php echo $mst_menuweb->createdate->CellAttributes() ?>>
<div<?php echo $mst_menuweb->createdate->ViewAttributes() ?>><?php echo $mst_menuweb->createdate->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($mst_menuweb->CurrentAction <> "gridadd")
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
<?php if ($mst_menuweb->Export == "" && $mst_menuweb->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(mst_menuweb_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($mst_menuweb->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$mst_menuweb_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_menuweb_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'mst_menuweb';

	// Page Object Name
	var $PageObjName = 'mst_menuweb_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_menuweb;
		if ($mst_menuweb->UseTokenInUrl) $PageUrl .= "t=" . $mst_menuweb->TableVar . "&"; // add page token
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
		global $objForm, $mst_menuweb;
		if ($mst_menuweb->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_menuweb->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_menuweb->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_menuweb_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_menuweb"] = new cmst_menuweb();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_menuweb', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_menuweb;
	$mst_menuweb->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $mst_menuweb->Export; // Get export parameter, used in header
	$gsExportFile = $mst_menuweb->TableVar; // Get export file, used in header
	if ($mst_menuweb->Export == "excel") {
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
		global $objForm, $gsSearchError, $Security, $mst_menuweb;
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
		if ($mst_menuweb->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $mst_menuweb->getRecordsPerPage(); // Restore from Session
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
		$mst_menuweb->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$mst_menuweb->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$mst_menuweb->setStartRecordNumber($this->lStartRec);
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
		$mst_menuweb->setSessionWhere($sFilter);
		$mst_menuweb->CurrentFilter = "";

		// Export data only
		if (in_array($mst_menuweb->Export, array("html","word","excel","xml","csv"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $mst_menuweb;
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
			$mst_menuweb->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$mst_menuweb->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $mst_menuweb;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $mst_menuweb->kode, FALSE); // Field kode
		$this->BuildSearchSql($sWhere, $mst_menuweb->seqno, FALSE); // Field seqno
		$this->BuildSearchSql($sWhere, $mst_menuweb->lang, FALSE); // Field lang
		$this->BuildSearchSql($sWhere, $mst_menuweb->caption, FALSE); // Field caption
		$this->BuildSearchSql($sWhere, $mst_menuweb->url, FALSE); // Field url
		$this->BuildSearchSql($sWhere, $mst_menuweb->target, FALSE); // Field target
		$this->BuildSearchSql($sWhere, $mst_menuweb->content, FALSE); // Field content
		$this->BuildSearchSql($sWhere, $mst_menuweb->createby, FALSE); // Field createby
		$this->BuildSearchSql($sWhere, $mst_menuweb->createdate, FALSE); // Field createdate
		$this->BuildSearchSql($sWhere, $mst_menuweb->xtimestamp, FALSE); // Field xtimestamp

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($mst_menuweb->kode); // Field kode
			$this->SetSearchParm($mst_menuweb->seqno); // Field seqno
			$this->SetSearchParm($mst_menuweb->lang); // Field lang
			$this->SetSearchParm($mst_menuweb->caption); // Field caption
			$this->SetSearchParm($mst_menuweb->url); // Field url
			$this->SetSearchParm($mst_menuweb->target); // Field target
			$this->SetSearchParm($mst_menuweb->content); // Field content
			$this->SetSearchParm($mst_menuweb->createby); // Field createby
			$this->SetSearchParm($mst_menuweb->createdate); // Field createdate
			$this->SetSearchParm($mst_menuweb->xtimestamp); // Field xtimestamp
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
		global $mst_menuweb;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$mst_menuweb->setAdvancedSearch("x_$FldParm", $FldVal);
		$mst_menuweb->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$mst_menuweb->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$mst_menuweb->setAdvancedSearch("y_$FldParm", $FldVal2);
		$mst_menuweb->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $mst_menuweb;
		$this->sSrchWhere = "";
		$mst_menuweb->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $mst_menuweb;
		$mst_menuweb->setAdvancedSearch("x_kode", "");
		$mst_menuweb->setAdvancedSearch("x_seqno", "");
		$mst_menuweb->setAdvancedSearch("x_lang", "");
		$mst_menuweb->setAdvancedSearch("x_caption", "");
		$mst_menuweb->setAdvancedSearch("x_url", "");
		$mst_menuweb->setAdvancedSearch("x_target", "");
		$mst_menuweb->setAdvancedSearch("x_content", "");
		$mst_menuweb->setAdvancedSearch("x_createby", "");
		$mst_menuweb->setAdvancedSearch("x_createdate", "");
		$mst_menuweb->setAdvancedSearch("x_xtimestamp", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $mst_menuweb;
		$this->sSrchWhere = $mst_menuweb->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $mst_menuweb;
		 $mst_menuweb->kode->AdvancedSearch->SearchValue = $mst_menuweb->getAdvancedSearch("x_kode");
		 $mst_menuweb->seqno->AdvancedSearch->SearchValue = $mst_menuweb->getAdvancedSearch("x_seqno");
		 $mst_menuweb->lang->AdvancedSearch->SearchValue = $mst_menuweb->getAdvancedSearch("x_lang");
		 $mst_menuweb->caption->AdvancedSearch->SearchValue = $mst_menuweb->getAdvancedSearch("x_caption");
		 $mst_menuweb->url->AdvancedSearch->SearchValue = $mst_menuweb->getAdvancedSearch("x_url");
		 $mst_menuweb->target->AdvancedSearch->SearchValue = $mst_menuweb->getAdvancedSearch("x_target");
		 $mst_menuweb->content->AdvancedSearch->SearchValue = $mst_menuweb->getAdvancedSearch("x_content");
		 $mst_menuweb->createby->AdvancedSearch->SearchValue = $mst_menuweb->getAdvancedSearch("x_createby");
		 $mst_menuweb->createdate->AdvancedSearch->SearchValue = $mst_menuweb->getAdvancedSearch("x_createdate");
		 $mst_menuweb->xtimestamp->AdvancedSearch->SearchValue = $mst_menuweb->getAdvancedSearch("x_xtimestamp");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $mst_menuweb;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$mst_menuweb->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$mst_menuweb->CurrentOrderType = @$_GET["ordertype"];
			$mst_menuweb->UpdateSort($mst_menuweb->kode); // Field 
			$mst_menuweb->UpdateSort($mst_menuweb->seqno); // Field 
			$mst_menuweb->UpdateSort($mst_menuweb->lang); // Field 
			$mst_menuweb->UpdateSort($mst_menuweb->caption); // Field 
			$mst_menuweb->UpdateSort($mst_menuweb->url); // Field 
			$mst_menuweb->UpdateSort($mst_menuweb->target); // Field 
			$mst_menuweb->UpdateSort($mst_menuweb->createby); // Field 
			$mst_menuweb->UpdateSort($mst_menuweb->createdate); // Field 
			$mst_menuweb->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $mst_menuweb;
		$sOrderBy = $mst_menuweb->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($mst_menuweb->SqlOrderBy() <> "") {
				$sOrderBy = $mst_menuweb->SqlOrderBy();
				$mst_menuweb->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $mst_menuweb;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$mst_menuweb->setSessionOrderBy($sOrderBy);
				$mst_menuweb->kode->setSort("");
				$mst_menuweb->seqno->setSort("");
				$mst_menuweb->lang->setSort("");
				$mst_menuweb->caption->setSort("");
				$mst_menuweb->url->setSort("");
				$mst_menuweb->target->setSort("");
				$mst_menuweb->createby->setSort("");
				$mst_menuweb->createdate->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$mst_menuweb->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $mst_menuweb;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$mst_menuweb->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$mst_menuweb->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $mst_menuweb->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$mst_menuweb->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$mst_menuweb->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$mst_menuweb->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $mst_menuweb;

		// Load search values
		// kode

		$mst_menuweb->kode->AdvancedSearch->SearchValue = @$_GET["x_kode"];
		$mst_menuweb->kode->AdvancedSearch->SearchOperator = @$_GET["z_kode"];

		// seqno
		$mst_menuweb->seqno->AdvancedSearch->SearchValue = @$_GET["x_seqno"];
		$mst_menuweb->seqno->AdvancedSearch->SearchOperator = @$_GET["z_seqno"];

		// lang
		$mst_menuweb->lang->AdvancedSearch->SearchValue = @$_GET["x_lang"];
		$mst_menuweb->lang->AdvancedSearch->SearchOperator = @$_GET["z_lang"];

		// caption
		$mst_menuweb->caption->AdvancedSearch->SearchValue = @$_GET["x_caption"];
		$mst_menuweb->caption->AdvancedSearch->SearchOperator = @$_GET["z_caption"];

		// url
		$mst_menuweb->url->AdvancedSearch->SearchValue = @$_GET["x_url"];
		$mst_menuweb->url->AdvancedSearch->SearchOperator = @$_GET["z_url"];

		// target
		$mst_menuweb->target->AdvancedSearch->SearchValue = @$_GET["x_target"];
		$mst_menuweb->target->AdvancedSearch->SearchOperator = @$_GET["z_target"];

		// content
		$mst_menuweb->content->AdvancedSearch->SearchValue = @$_GET["x_content"];
		$mst_menuweb->content->AdvancedSearch->SearchOperator = @$_GET["z_content"];

		// createby
		$mst_menuweb->createby->AdvancedSearch->SearchValue = @$_GET["x_createby"];
		$mst_menuweb->createby->AdvancedSearch->SearchOperator = @$_GET["z_createby"];

		// createdate
		$mst_menuweb->createdate->AdvancedSearch->SearchValue = @$_GET["x_createdate"];
		$mst_menuweb->createdate->AdvancedSearch->SearchOperator = @$_GET["z_createdate"];

		// xtimestamp
		$mst_menuweb->xtimestamp->AdvancedSearch->SearchValue = @$_GET["x_xtimestamp"];
		$mst_menuweb->xtimestamp->AdvancedSearch->SearchOperator = @$_GET["z_xtimestamp"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mst_menuweb;

		// Call Recordset Selecting event
		$mst_menuweb->Recordset_Selecting($mst_menuweb->CurrentFilter);

		// Load list page SQL
		$sSql = $mst_menuweb->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$mst_menuweb->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_menuweb;
		$sFilter = $mst_menuweb->KeyFilter();

		// Call Row Selecting event
		$mst_menuweb->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_menuweb->CurrentFilter = $sFilter;
		$sSql = $mst_menuweb->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_menuweb->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_menuweb;
		$mst_menuweb->kode->setDbValue($rs->fields('kode'));
		$mst_menuweb->seqno->setDbValue($rs->fields('seqno'));
		$mst_menuweb->lang->setDbValue($rs->fields('lang'));
		$mst_menuweb->caption->setDbValue($rs->fields('caption'));
		$mst_menuweb->url->setDbValue($rs->fields('url'));
		$mst_menuweb->target->setDbValue($rs->fields('target'));
		$mst_menuweb->content->setDbValue($rs->fields('content'));
		$mst_menuweb->createby->setDbValue($rs->fields('createby'));
		$mst_menuweb->createdate->setDbValue($rs->fields('createdate'));
		$mst_menuweb->xtimestamp->setDbValue($rs->fields('xtimestamp'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_menuweb;

		// Call Row_Rendering event
		$mst_menuweb->Row_Rendering();

		// Common render codes for all row types
		// kode

		$mst_menuweb->kode->CellCssStyle = "white-space: nowrap;";
		$mst_menuweb->kode->CellCssClass = "";

		// seqno
		$mst_menuweb->seqno->CellCssStyle = "white-space: nowrap;";
		$mst_menuweb->seqno->CellCssClass = "";

		// lang
		$mst_menuweb->lang->CellCssStyle = "white-space: nowrap;";
		$mst_menuweb->lang->CellCssClass = "";

		// caption
		$mst_menuweb->caption->CellCssStyle = "white-space: nowrap;";
		$mst_menuweb->caption->CellCssClass = "";

		// url
		$mst_menuweb->url->CellCssStyle = "white-space: nowrap;";
		$mst_menuweb->url->CellCssClass = "";

		// target
		$mst_menuweb->target->CellCssStyle = "white-space: nowrap;";
		$mst_menuweb->target->CellCssClass = "";

		// createby
		$mst_menuweb->createby->CellCssStyle = "white-space: nowrap;";
		$mst_menuweb->createby->CellCssClass = "";

		// createdate
		$mst_menuweb->createdate->CellCssStyle = "white-space: nowrap;";
		$mst_menuweb->createdate->CellCssClass = "";
		if ($mst_menuweb->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$mst_menuweb->kode->ViewValue = $mst_menuweb->kode->CurrentValue;
			$mst_menuweb->kode->CssStyle = "";
			$mst_menuweb->kode->CssClass = "";
			$mst_menuweb->kode->ViewCustomAttributes = "";

			// seqno
			$mst_menuweb->seqno->ViewValue = $mst_menuweb->seqno->CurrentValue;
			$mst_menuweb->seqno->CssStyle = "";
			$mst_menuweb->seqno->CssClass = "";
			$mst_menuweb->seqno->ViewCustomAttributes = "";

			// lang
			if (strval($mst_menuweb->lang->CurrentValue) <> "") {
				switch ($mst_menuweb->lang->CurrentValue) {
					case "ind":
						$mst_menuweb->lang->ViewValue = "Indonesia";
						break;
					case "eng":
						$mst_menuweb->lang->ViewValue = "English";
						break;
					default:
						$mst_menuweb->lang->ViewValue = $mst_menuweb->lang->CurrentValue;
				}
			} else {
				$mst_menuweb->lang->ViewValue = NULL;
			}
			$mst_menuweb->lang->CssStyle = "";
			$mst_menuweb->lang->CssClass = "";
			$mst_menuweb->lang->ViewCustomAttributes = "";

			// caption
			$mst_menuweb->caption->ViewValue = $mst_menuweb->caption->CurrentValue;
			$mst_menuweb->caption->CssStyle = "";
			$mst_menuweb->caption->CssClass = "";
			$mst_menuweb->caption->ViewCustomAttributes = "";

			// url
			$mst_menuweb->url->ViewValue = $mst_menuweb->url->CurrentValue;
			$mst_menuweb->url->CssStyle = "";
			$mst_menuweb->url->CssClass = "";
			$mst_menuweb->url->ViewCustomAttributes = "";

			// target
			if (strval($mst_menuweb->target->CurrentValue) <> "") {
				switch ($mst_menuweb->target->CurrentValue) {
					case "main_frame":
						$mst_menuweb->target->ViewValue = "Same Window";
						break;
					case "_blank":
						$mst_menuweb->target->ViewValue = "New Window";
						break;
					default:
						$mst_menuweb->target->ViewValue = $mst_menuweb->target->CurrentValue;
				}
			} else {
				$mst_menuweb->target->ViewValue = NULL;
			}
			$mst_menuweb->target->CssStyle = "";
			$mst_menuweb->target->CssClass = "";
			$mst_menuweb->target->ViewCustomAttributes = "";

			// createby
			if (strval($mst_menuweb->createby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($mst_menuweb->createby->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_menuweb->createby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$mst_menuweb->createby->ViewValue = $mst_menuweb->createby->CurrentValue;
				}
			} else {
				$mst_menuweb->createby->ViewValue = NULL;
			}
			$mst_menuweb->createby->CssStyle = "";
			$mst_menuweb->createby->CssClass = "";
			$mst_menuweb->createby->ViewCustomAttributes = "";

			// createdate
			$mst_menuweb->createdate->ViewValue = $mst_menuweb->createdate->CurrentValue;
			$mst_menuweb->createdate->ViewValue = ew_FormatDateTime($mst_menuweb->createdate->ViewValue, 11);
			$mst_menuweb->createdate->CssStyle = "";
			$mst_menuweb->createdate->CssClass = "";
			$mst_menuweb->createdate->ViewCustomAttributes = "";

			// kode
			$mst_menuweb->kode->HrefValue = "";

			// seqno
			$mst_menuweb->seqno->HrefValue = "";

			// lang
			$mst_menuweb->lang->HrefValue = "";

			// caption
			$mst_menuweb->caption->HrefValue = "";

			// url
			$mst_menuweb->url->HrefValue = "";

			// target
			$mst_menuweb->target->HrefValue = "";

			// createby
			$mst_menuweb->createby->HrefValue = "";

			// createdate
			$mst_menuweb->createdate->HrefValue = "";
		} elseif ($mst_menuweb->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// kode
			$mst_menuweb->kode->EditCustomAttributes = "";
			$mst_menuweb->kode->EditValue = ew_HtmlEncode($mst_menuweb->kode->AdvancedSearch->SearchValue);

			// seqno
			$mst_menuweb->seqno->EditCustomAttributes = "";
			$mst_menuweb->seqno->EditValue = ew_HtmlEncode($mst_menuweb->seqno->AdvancedSearch->SearchValue);

			// lang
			$mst_menuweb->lang->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("ind", "Indonesia");
			$arwrk[] = array("eng", "English");
			array_unshift($arwrk, array("", "Please Select"));
			$mst_menuweb->lang->EditValue = $arwrk;

			// caption
			$mst_menuweb->caption->EditCustomAttributes = "";
			$mst_menuweb->caption->EditValue = ew_HtmlEncode($mst_menuweb->caption->AdvancedSearch->SearchValue);

			// url
			$mst_menuweb->url->EditCustomAttributes = "";
			$mst_menuweb->url->EditValue = ew_HtmlEncode($mst_menuweb->url->AdvancedSearch->SearchValue);

			// target
			$mst_menuweb->target->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("main_frame", "Same Window");
			$arwrk[] = array("_blank", "New Window");
			array_unshift($arwrk, array("", "Please Select"));
			$mst_menuweb->target->EditValue = $arwrk;

			// createby
			$mst_menuweb->createby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$mst_menuweb->createby->EditValue = $arwrk;

			// createdate
			$mst_menuweb->createdate->EditCustomAttributes = "";
			$mst_menuweb->createdate->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($mst_menuweb->createdate->AdvancedSearch->SearchValue, 11), 11));
		}

		// Call Row Rendered event
		$mst_menuweb->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $mst_menuweb;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($mst_menuweb->kode->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect integer - Kode";
		}
		if (!ew_CheckInteger($mst_menuweb->seqno->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect integer - No Urut";
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
		global $mst_menuweb;
		$mst_menuweb->kode->AdvancedSearch->SearchValue = $mst_menuweb->getAdvancedSearch("x_kode");
		$mst_menuweb->seqno->AdvancedSearch->SearchValue = $mst_menuweb->getAdvancedSearch("x_seqno");
		$mst_menuweb->lang->AdvancedSearch->SearchValue = $mst_menuweb->getAdvancedSearch("x_lang");
		$mst_menuweb->caption->AdvancedSearch->SearchValue = $mst_menuweb->getAdvancedSearch("x_caption");
		$mst_menuweb->url->AdvancedSearch->SearchValue = $mst_menuweb->getAdvancedSearch("x_url");
		$mst_menuweb->target->AdvancedSearch->SearchValue = $mst_menuweb->getAdvancedSearch("x_target");
		$mst_menuweb->content->AdvancedSearch->SearchValue = $mst_menuweb->getAdvancedSearch("x_content");
		$mst_menuweb->createby->AdvancedSearch->SearchValue = $mst_menuweb->getAdvancedSearch("x_createby");
		$mst_menuweb->createdate->AdvancedSearch->SearchValue = $mst_menuweb->getAdvancedSearch("x_createdate");
		$mst_menuweb->xtimestamp->AdvancedSearch->SearchValue = $mst_menuweb->getAdvancedSearch("x_xtimestamp");
	}

	// Export data in XML or CSV format
	function ExportData() {
		global $mst_menuweb;
		$sCsvStr = "";

		// Default export style
		$sExportStyle = "h";

		// Load recordset
		$rs = $this->LoadRecordset();
		$this->lTotalRecs = $rs->RecordCount();
		$this->lStartRec = 1;

		// Export all
		if ($mst_menuweb->ExportAll) {
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
		if ($mst_menuweb->Export == "xml") {
			$XmlDoc = new cXMLDocument();
		} else {
			echo ew_ExportHeader($mst_menuweb->Export);

			// Horizontal format, write header
			if ($sExportStyle <> "v" || $mst_menuweb->Export == "csv") {
				$sExportStr = "";
				ew_ExportAddValue($sExportStr, 'kode', $mst_menuweb->Export);
				ew_ExportAddValue($sExportStr, 'seqno', $mst_menuweb->Export);
				ew_ExportAddValue($sExportStr, 'lang', $mst_menuweb->Export);
				ew_ExportAddValue($sExportStr, 'caption', $mst_menuweb->Export);
				ew_ExportAddValue($sExportStr, 'url', $mst_menuweb->Export);
				ew_ExportAddValue($sExportStr, 'target', $mst_menuweb->Export);
				ew_ExportAddValue($sExportStr, 'createby', $mst_menuweb->Export);
				ew_ExportAddValue($sExportStr, 'createdate', $mst_menuweb->Export);
				echo ew_ExportLine($sExportStr, $mst_menuweb->Export);
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
				$mst_menuweb->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($mst_menuweb->Export == "xml") {
					$XmlDoc->BeginRow();
					$XmlDoc->AddField('kode', $mst_menuweb->kode->CurrentValue);
					$XmlDoc->AddField('seqno', $mst_menuweb->seqno->CurrentValue);
					$XmlDoc->AddField('lang', $mst_menuweb->lang->CurrentValue);
					$XmlDoc->AddField('caption', $mst_menuweb->caption->CurrentValue);
					$XmlDoc->AddField('url', $mst_menuweb->url->CurrentValue);
					$XmlDoc->AddField('target', $mst_menuweb->target->CurrentValue);
					$XmlDoc->AddField('createby', $mst_menuweb->createby->CurrentValue);
					$XmlDoc->AddField('createdate', $mst_menuweb->createdate->CurrentValue);
					$XmlDoc->EndRow();
				} else {
					if ($sExportStyle == "v" && $mst_menuweb->Export <> "csv") { // Vertical format
						echo ew_ExportField('kode', $mst_menuweb->kode->ExportValue($mst_menuweb->Export, $mst_menuweb->ExportOriginalValue), $mst_menuweb->Export);
						echo ew_ExportField('seqno', $mst_menuweb->seqno->ExportValue($mst_menuweb->Export, $mst_menuweb->ExportOriginalValue), $mst_menuweb->Export);
						echo ew_ExportField('lang', $mst_menuweb->lang->ExportValue($mst_menuweb->Export, $mst_menuweb->ExportOriginalValue), $mst_menuweb->Export);
						echo ew_ExportField('caption', $mst_menuweb->caption->ExportValue($mst_menuweb->Export, $mst_menuweb->ExportOriginalValue), $mst_menuweb->Export);
						echo ew_ExportField('url', $mst_menuweb->url->ExportValue($mst_menuweb->Export, $mst_menuweb->ExportOriginalValue), $mst_menuweb->Export);
						echo ew_ExportField('target', $mst_menuweb->target->ExportValue($mst_menuweb->Export, $mst_menuweb->ExportOriginalValue), $mst_menuweb->Export);
						echo ew_ExportField('createby', $mst_menuweb->createby->ExportValue($mst_menuweb->Export, $mst_menuweb->ExportOriginalValue), $mst_menuweb->Export);
						echo ew_ExportField('createdate', $mst_menuweb->createdate->ExportValue($mst_menuweb->Export, $mst_menuweb->ExportOriginalValue), $mst_menuweb->Export);
					}	else { // Horizontal format
						$sExportStr = "";
						ew_ExportAddValue($sExportStr, $mst_menuweb->kode->ExportValue($mst_menuweb->Export, $mst_menuweb->ExportOriginalValue), $mst_menuweb->Export);
						ew_ExportAddValue($sExportStr, $mst_menuweb->seqno->ExportValue($mst_menuweb->Export, $mst_menuweb->ExportOriginalValue), $mst_menuweb->Export);
						ew_ExportAddValue($sExportStr, $mst_menuweb->lang->ExportValue($mst_menuweb->Export, $mst_menuweb->ExportOriginalValue), $mst_menuweb->Export);
						ew_ExportAddValue($sExportStr, $mst_menuweb->caption->ExportValue($mst_menuweb->Export, $mst_menuweb->ExportOriginalValue), $mst_menuweb->Export);
						ew_ExportAddValue($sExportStr, $mst_menuweb->url->ExportValue($mst_menuweb->Export, $mst_menuweb->ExportOriginalValue), $mst_menuweb->Export);
						ew_ExportAddValue($sExportStr, $mst_menuweb->target->ExportValue($mst_menuweb->Export, $mst_menuweb->ExportOriginalValue), $mst_menuweb->Export);
						ew_ExportAddValue($sExportStr, $mst_menuweb->createby->ExportValue($mst_menuweb->Export, $mst_menuweb->ExportOriginalValue), $mst_menuweb->Export);
						ew_ExportAddValue($sExportStr, $mst_menuweb->createdate->ExportValue($mst_menuweb->Export, $mst_menuweb->ExportOriginalValue), $mst_menuweb->Export);
						echo ew_ExportLine($sExportStr, $mst_menuweb->Export);
					}
				}
			}
			$rs->MoveNext();
		}

		// Close recordset
		$rs->Close();
		if ($mst_menuweb->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} else {
			echo ew_ExportFooter($mst_menuweb->Export);
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
