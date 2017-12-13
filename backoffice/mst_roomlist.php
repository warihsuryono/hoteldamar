<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_roominfo.php" ?>
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
$mst_room_list = new cmst_room_list();
$Page =& $mst_room_list;

// Page init processing
$mst_room_list->Page_Init();

// Page main processing
$mst_room_list->Page_Main();
?>
<?php include "header.php" ?>
<?php
	if(isset($_POST["save_price"])){
		$sql="UPDATE mst_room SET price='".$_POST["price"]."',price2='".$_POST["price2"]."',status='".$_POST["status"]."' WHERE kode = '".$_POST["kode"]."'";
		mysql_query($sql,$db);
		echo "<font color='blue'>Data Saved!</font>";
	}
?>
<?php if ($mst_room->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var mst_room_list = new ew_Page("mst_room_list");

// page properties
mst_room_list.PageID = "list"; // page ID
var EW_PAGE_ID = mst_room_list.PageID; // for backward compatibility

// extend page with validate function for search
mst_room_list.ValidateSearch = function(fobj) {
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
mst_room_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_room_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_room_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($mst_room->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($mst_room->Export == "" && $mst_room->SelectLimit);
	if (!$bSelectLimit)
		$rs = $mst_room_list->LoadRecordset();
	$mst_room_list->lTotalRecs = ($bSelectLimit) ? $mst_room->SelectRecordCount() : $rs->RecordCount();
	$mst_room_list->lStartRec = 1;
	if ($mst_room_list->lDisplayRecs <= 0) // Display all records
		$mst_room_list->lDisplayRecs = $mst_room_list->lTotalRecs;
	if (!($mst_room->ExportAll && $mst_room->Export <> ""))
		$mst_room_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $mst_room_list->LoadRecordset($mst_room_list->lStartRec-1, $mst_room_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Master Room</b></h3>
<?php if ($mst_room->Export == "" && $mst_room->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $mst_room_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php if ($mst_room->Export == "" && $mst_room->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(mst_room_list);" style="text-decoration: none;"><img id="mst_room_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="mst_room_list_SearchPanel">
<form name="fmst_roomlistsrch" id="fmst_roomlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return mst_room_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="mst_room">
<?php
if ($gsSearchError == "")
	$mst_room_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$mst_room->RowType = EW_ROWTYPE_SEARCH;

// Render row
$mst_room_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Kode</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_kode" id="z_kode" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_kode" id="x_kode" size="3" maxlength="3" value="<?php echo $mst_room->kode->EditValue ?>"<?php echo $mst_room->kode->EditAttributes() ?>>
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
<input type="text" name="x_nama" id="x_nama" size="30" maxlength="100" value="<?php echo $mst_room->nama->EditValue ?>"<?php echo $mst_room->nama->EditAttributes() ?>>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">Tipe</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_tipe" id="z_tipe" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_tipe" name="x_tipe"<?php echo $mst_room->tipe->EditAttributes() ?>>
<?php
if (is_array($mst_room->tipe->EditValue)) {
	$arwrk = $mst_room->tipe->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_room->tipe->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Connecting To (1)</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_connecting1" id="z_connecting1" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_connecting1" name="x_connecting1"<?php echo $mst_room->connecting1->EditAttributes() ?>>
<?php
if (is_array($mst_room->connecting1->EditValue)) {
	$arwrk = $mst_room->connecting1->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_room->connecting1->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Connecting To (2)</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_connecting2" id="z_connecting2" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_connecting2" name="x_connecting2"<?php echo $mst_room->connecting2->EditAttributes() ?>>
<?php
if (is_array($mst_room->connecting2->EditValue)) {
	$arwrk = $mst_room->connecting2->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_room->connecting2->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Change By</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_changeby" id="z_changeby" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_changeby" name="x_changeby"<?php echo $mst_room->changeby->EditAttributes() ?>>
<?php
if (is_array($mst_room->changeby->EditValue)) {
	$arwrk = $mst_room->changeby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_room->changeby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<!--a href="<?php echo $mst_room_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $mst_room_list->PageUrl() ?>cmd=reset';">
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $mst_room_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($mst_room->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($mst_room->CurrentAction <> "gridadd" && $mst_room->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($mst_room_list->Pager)) $mst_room_list->Pager = new cPrevNextPager($mst_room_list->lStartRec, $mst_room_list->lDisplayRecs, $mst_room_list->lTotalRecs) ?>
<?php if ($mst_room_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($mst_room_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $mst_room_list->PageUrl() ?>start=<?php echo $mst_room_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($mst_room_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $mst_room_list->PageUrl() ?>start=<?php echo $mst_room_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $mst_room_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($mst_room_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $mst_room_list->PageUrl() ?>start=<?php echo $mst_room_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($mst_room_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $mst_room_list->PageUrl() ?>start=<?php echo $mst_room_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $mst_room_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $mst_room_list->Pager->FromIndex ?> to <?php echo $mst_room_list->Pager->ToIndex ?> of <?php echo $mst_room_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($mst_room_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($mst_room_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="mst_room">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($mst_room_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($mst_room_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($mst_room_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($mst_room_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($mst_room_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($mst_room_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $mst_room->AddUrl() ?>"> <img src="images/expand.gif" title="Add" width="16" height="16" border="0"> </a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fmst_roomlist" id="fmst_roomlist" class="ewForm" action="" method="post">
<?php if ($mst_room_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$mst_room_list->lOptionCnt = 0;
	$mst_room_list->lOptionCnt++; // edit
	$mst_room_list->lOptionCnt++; // Delete
	$mst_room_list->lOptionCnt += count($mst_room_list->ListOptions->Items); // Custom list options
?>
<?php echo $mst_room->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($mst_room->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($mst_room_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($mst_room->kode->Visible) { // kode ?>
	<?php if ($mst_room->SortUrl($mst_room->kode) == "") { ?>
		<td style="white-space: nowrap;">Kode</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_room->SortUrl($mst_room->kode) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Kode</td><td style="width: 10px;"><?php if ($mst_room->kode->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_room->kode->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_room->nama->Visible) { // nama ?>
	<?php if ($mst_room->SortUrl($mst_room->nama) == "") { ?>
		<td style="white-space: nowrap;">Nama</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_room->SortUrl($mst_room->nama) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Nama</td><td style="width: 10px;"><?php if ($mst_room->nama->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_room->nama->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>
<td style="white-space: nowrap;">Week Days</td>	
<td style="white-space: nowrap;">Week Ends</td>
<td style="white-space: nowrap;">Status</td>
<td style="white-space: nowrap;"></td>
<?php if ($mst_room->tipe->Visible) { // tipe ?>
	<?php if ($mst_room->SortUrl($mst_room->tipe) == "") { ?>
		<td style="white-space: nowrap;">Tipe</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_room->SortUrl($mst_room->tipe) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tipe</td><td style="width: 10px;"><?php if ($mst_room->tipe->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_room->tipe->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_room->connecting1->Visible) { // connecting1 ?>
	<?php if ($mst_room->SortUrl($mst_room->connecting1) == "") { ?>
		<td style="white-space: nowrap;">Connecting To (1)</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_room->SortUrl($mst_room->connecting1) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Connecting To (1)</td><td style="width: 10px;"><?php if ($mst_room->connecting1->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_room->connecting1->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_room->connecting2->Visible) { // connecting2 ?>
	<?php if ($mst_room->SortUrl($mst_room->connecting2) == "") { ?>
		<td style="white-space: nowrap;">Connecting To (2)</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_room->SortUrl($mst_room->connecting2) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Connecting To (2)</td><td style="width: 10px;"><?php if ($mst_room->connecting2->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_room->connecting2->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_room->changeby->Visible) { // changeby ?>
	<?php if ($mst_room->SortUrl($mst_room->changeby) == "") { ?>
		<td style="white-space: nowrap;">Change By</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_room->SortUrl($mst_room->changeby) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Change By</td><td style="width: 10px;"><?php if ($mst_room->changeby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_room->changeby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_room->changedate->Visible) { // changedate ?>
	<?php if ($mst_room->SortUrl($mst_room->changedate) == "") { ?>
		<td style="white-space: nowrap;">Change Date</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_room->SortUrl($mst_room->changedate) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Change Date</td><td style="width: 10px;"><?php if ($mst_room->changedate->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_room->changedate->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($mst_room->ExportAll && $mst_room->Export <> "") {
	$mst_room_list->lStopRec = $mst_room_list->lTotalRecs;
} else {
	$mst_room_list->lStopRec = $mst_room_list->lStartRec + $mst_room_list->lDisplayRecs - 1; // Set the last record to display
}
$mst_room_list->lRecCount = $mst_room_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$mst_room->SelectLimit && $mst_room_list->lStartRec > 1)
		$rs->Move($mst_room_list->lStartRec - 1);
}
$mst_room_list->lRowCnt = 0;
while (($mst_room->CurrentAction == "gridadd" || !$rs->EOF) &&
	$mst_room_list->lRecCount < $mst_room_list->lStopRec) {
	$mst_room_list->lRecCount++;
	if (intval($mst_room_list->lRecCount) >= intval($mst_room_list->lStartRec)) {
		$mst_room_list->lRowCnt++;

	// Init row class and style
	$mst_room->CssClass = "";
	$mst_room->CssStyle = "";
	$mst_room->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($mst_room->CurrentAction == "gridadd") {
		$mst_room_list->LoadDefaultValues(); // Load default values
	} else {
		$mst_room_list->LoadRowValues($rs); // Load row values
	}
	$mst_room->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$mst_room_list->RenderRow();
?>
	<tr<?php echo $mst_room->RowAttributes() ?>>
<?php if ($mst_room->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_room->EditUrl() ?>"><img src="images/inlineedit.gif" title="Edit" width="16" height="16" border="0"></a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_room->DeleteUrl() ?>"><img src="images/b_drop.png" title="Delete" width="16" height="16" border="0"></a>
</span></td>
<?php

// Custom list options
foreach ($mst_room_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($mst_room->kode->Visible) { // kode ?>
		<td<?php echo $mst_room->kode->CellAttributes() ?>>
<div<?php echo $mst_room->kode->ViewAttributes() ?>><?php echo $mst_room->kode->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_room->nama->Visible) { // nama ?>
		<td<?php echo $mst_room->nama->CellAttributes() ?>>
<div<?php echo $mst_room->nama->ViewAttributes() ?>><?php echo $mst_room->nama->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php
		$sql = "SELECT price,price2,status FROM mst_room WHERE kode = '".$mst_room->kode->ListViewValue()."'";
		$hsl = mysql_query($sql,$db);
		list($price,$price2,$status) = mysql_fetch_array($hsl);
	?>
		<form method="post">
			<input type="hidden" name="kode" value="<?=$mst_room->kode->ListViewValue();?>">
			<td><input name="price" value="<?=$price;?>" style="width:50px;"></td>
			<td><input name="price2" value="<?=$price2;?>" style="width:50px;"></td>
			<td>
				<select name="status">
					<option value="0" <?=($status == "0")?"selected":"";?>>Out of Order</option>
					<option value="1" <?=($status == "1")?"selected":"";?>>Available</option>
				</select>
			</td>
			<td><input type="submit" name="save_price" value="Save"></td>
		</form>
	<?php if ($mst_room->tipe->Visible) { // tipe ?>
		<td<?php echo $mst_room->tipe->CellAttributes() ?>>
<div<?php echo $mst_room->tipe->ViewAttributes() ?>><?php echo $mst_room->tipe->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_room->connecting1->Visible) { // connecting1 ?>
		<td<?php echo $mst_room->connecting1->CellAttributes() ?>>
<div<?php echo $mst_room->connecting1->ViewAttributes() ?>><?php echo $mst_room->connecting1->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_room->connecting2->Visible) { // connecting2 ?>
		<td<?php echo $mst_room->connecting2->CellAttributes() ?>>
<div<?php echo $mst_room->connecting2->ViewAttributes() ?>><?php echo $mst_room->connecting2->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_room->changeby->Visible) { // changeby ?>
		<td<?php echo $mst_room->changeby->CellAttributes() ?>>
<div<?php echo $mst_room->changeby->ViewAttributes() ?>><?php echo $mst_room->changeby->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_room->changedate->Visible) { // changedate ?>
		<td<?php echo $mst_room->changedate->CellAttributes() ?>>
<div<?php echo $mst_room->changedate->ViewAttributes() ?>><?php echo $mst_room->changedate->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($mst_room->CurrentAction <> "gridadd")
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
<?php if ($mst_room->Export == "" && $mst_room->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(mst_room_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($mst_room->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$mst_room_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_room_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'mst_room';

	// Page Object Name
	var $PageObjName = 'mst_room_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_room;
		if ($mst_room->UseTokenInUrl) $PageUrl .= "t=" . $mst_room->TableVar . "&"; // add page token
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
		global $objForm, $mst_room;
		if ($mst_room->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_room->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_room->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_room_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_room"] = new cmst_room();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_room', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_room;
	$mst_room->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $mst_room->Export; // Get export parameter, used in header
	$gsExportFile = $mst_room->TableVar; // Get export file, used in header
	if ($mst_room->Export == "print" || $mst_room->Export == "html") {

		// Printer friendly or Export to HTML, no action required
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
		global $objForm, $gsSearchError, $Security, $mst_room;
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
		if ($mst_room->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $mst_room->getRecordsPerPage(); // Restore from Session
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
		$mst_room->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$mst_room->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$mst_room->setStartRecordNumber($this->lStartRec);
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
		$mst_room->setSessionWhere($sFilter);
		$mst_room->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $mst_room;
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
			$mst_room->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$mst_room->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $mst_room;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $mst_room->kode, FALSE); // Field kode
		$this->BuildSearchSql($sWhere, $mst_room->nama, FALSE); // Field nama
		$this->BuildSearchSql($sWhere, $mst_room->price, FALSE); // Field price
		$this->BuildSearchSql($sWhere, $mst_room->price2, FALSE); // Field price2
		$this->BuildSearchSql($sWhere, $mst_room->tipe, FALSE); // Field tipe
		$this->BuildSearchSql($sWhere, $mst_room->connecting1, FALSE); // Field connecting1
		$this->BuildSearchSql($sWhere, $mst_room->connecting2, FALSE); // Field connecting2
		$this->BuildSearchSql($sWhere, $mst_room->available, FALSE); // Field available
		$this->BuildSearchSql($sWhere, $mst_room->booked, FALSE); // Field booked
		$this->BuildSearchSql($sWhere, $mst_room->changeby, FALSE); // Field changeby
		$this->BuildSearchSql($sWhere, $mst_room->changedate, FALSE); // Field changedate
		$this->BuildSearchSql($sWhere, $mst_room->xtimestamp, FALSE); // Field xtimestamp

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($mst_room->kode); // Field kode
			$this->SetSearchParm($mst_room->nama); // Field nama
			$this->SetSearchParm($mst_room->price); // Field price
			$this->SetSearchParm($mst_room->price2); // Field price2
			$this->SetSearchParm($mst_room->tipe); // Field tipe
			$this->SetSearchParm($mst_room->connecting1); // Field connecting1
			$this->SetSearchParm($mst_room->connecting2); // Field connecting2
			$this->SetSearchParm($mst_room->available); // Field available
			$this->SetSearchParm($mst_room->booked); // Field booked
			$this->SetSearchParm($mst_room->changeby); // Field changeby
			$this->SetSearchParm($mst_room->changedate); // Field changedate
			$this->SetSearchParm($mst_room->xtimestamp); // Field xtimestamp
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
		global $mst_room;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$mst_room->setAdvancedSearch("x_$FldParm", $FldVal);
		$mst_room->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$mst_room->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$mst_room->setAdvancedSearch("y_$FldParm", $FldVal2);
		$mst_room->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $mst_room;
		$this->sSrchWhere = "";
		$mst_room->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $mst_room;
		$mst_room->setAdvancedSearch("x_kode", "");
		$mst_room->setAdvancedSearch("x_nama", "");
		$mst_room->setAdvancedSearch("x_price", "");
		$mst_room->setAdvancedSearch("x_price2", "");
		$mst_room->setAdvancedSearch("x_tipe", "");
		$mst_room->setAdvancedSearch("x_connecting1", "");
		$mst_room->setAdvancedSearch("x_connecting2", "");
		$mst_room->setAdvancedSearch("x_available", "");
		$mst_room->setAdvancedSearch("x_booked", "");
		$mst_room->setAdvancedSearch("x_changeby", "");
		$mst_room->setAdvancedSearch("x_changedate", "");
		$mst_room->setAdvancedSearch("x_xtimestamp", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $mst_room;
		$this->sSrchWhere = $mst_room->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $mst_room;
		 $mst_room->kode->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_kode");
		 $mst_room->nama->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_nama");
		 $mst_room->price->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_price");
		 $mst_room->price2->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_price2");
		 $mst_room->tipe->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_tipe");
		 $mst_room->connecting1->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_connecting1");
		 $mst_room->connecting2->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_connecting2");
		 $mst_room->available->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_available");
		 $mst_room->booked->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_booked");
		 $mst_room->changeby->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_changeby");
		 $mst_room->changedate->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_changedate");
		 $mst_room->xtimestamp->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_xtimestamp");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $mst_room;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$mst_room->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$mst_room->CurrentOrderType = @$_GET["ordertype"];
			$mst_room->UpdateSort($mst_room->kode); // Field 
			$mst_room->UpdateSort($mst_room->nama); // Field 
			$mst_room->UpdateSort($mst_room->tipe); // Field 
			$mst_room->UpdateSort($mst_room->connecting1); // Field 
			$mst_room->UpdateSort($mst_room->connecting2); // Field 
			$mst_room->UpdateSort($mst_room->changeby); // Field 
			$mst_room->UpdateSort($mst_room->changedate); // Field 
			$mst_room->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $mst_room;
		$sOrderBy = $mst_room->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($mst_room->SqlOrderBy() <> "") {
				$sOrderBy = $mst_room->SqlOrderBy();
				$mst_room->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $mst_room;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$mst_room->setSessionOrderBy($sOrderBy);
				$mst_room->kode->setSort("");
				$mst_room->nama->setSort("");
				$mst_room->tipe->setSort("");
				$mst_room->connecting1->setSort("");
				$mst_room->connecting2->setSort("");
				$mst_room->changeby->setSort("");
				$mst_room->changedate->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$mst_room->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $mst_room;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$mst_room->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$mst_room->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $mst_room->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$mst_room->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$mst_room->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$mst_room->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $mst_room;

		// Load search values
		// kode

		$mst_room->kode->AdvancedSearch->SearchValue = @$_GET["x_kode"];
		$mst_room->kode->AdvancedSearch->SearchOperator = @$_GET["z_kode"];

		// nama
		$mst_room->nama->AdvancedSearch->SearchValue = @$_GET["x_nama"];
		$mst_room->nama->AdvancedSearch->SearchOperator = @$_GET["z_nama"];

		// price
		$mst_room->price->AdvancedSearch->SearchValue = @$_GET["x_price"];
		$mst_room->price->AdvancedSearch->SearchOperator = @$_GET["z_price"];

		// price2
		$mst_room->price2->AdvancedSearch->SearchValue = @$_GET["x_price2"];
		$mst_room->price2->AdvancedSearch->SearchOperator = @$_GET["z_price2"];

		// tipe
		$mst_room->tipe->AdvancedSearch->SearchValue = @$_GET["x_tipe"];
		$mst_room->tipe->AdvancedSearch->SearchOperator = @$_GET["z_tipe"];

		// connecting1
		$mst_room->connecting1->AdvancedSearch->SearchValue = @$_GET["x_connecting1"];
		$mst_room->connecting1->AdvancedSearch->SearchOperator = @$_GET["z_connecting1"];

		// connecting2
		$mst_room->connecting2->AdvancedSearch->SearchValue = @$_GET["x_connecting2"];
		$mst_room->connecting2->AdvancedSearch->SearchOperator = @$_GET["z_connecting2"];

		// available
		$mst_room->available->AdvancedSearch->SearchValue = @$_GET["x_available"];
		$mst_room->available->AdvancedSearch->SearchOperator = @$_GET["z_available"];

		// booked
		$mst_room->booked->AdvancedSearch->SearchValue = @$_GET["x_booked"];
		$mst_room->booked->AdvancedSearch->SearchOperator = @$_GET["z_booked"];

		// changeby
		$mst_room->changeby->AdvancedSearch->SearchValue = @$_GET["x_changeby"];
		$mst_room->changeby->AdvancedSearch->SearchOperator = @$_GET["z_changeby"];

		// changedate
		$mst_room->changedate->AdvancedSearch->SearchValue = @$_GET["x_changedate"];
		$mst_room->changedate->AdvancedSearch->SearchOperator = @$_GET["z_changedate"];

		// xtimestamp
		$mst_room->xtimestamp->AdvancedSearch->SearchValue = @$_GET["x_xtimestamp"];
		$mst_room->xtimestamp->AdvancedSearch->SearchOperator = @$_GET["z_xtimestamp"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mst_room;

		// Call Recordset Selecting event
		$mst_room->Recordset_Selecting($mst_room->CurrentFilter);

		// Load list page SQL
		$sSql = $mst_room->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$mst_room->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_room;
		$sFilter = $mst_room->KeyFilter();

		// Call Row Selecting event
		$mst_room->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_room->CurrentFilter = $sFilter;
		$sSql = $mst_room->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_room->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_room;
		$mst_room->kode->setDbValue($rs->fields('kode'));
		$mst_room->nama->setDbValue($rs->fields('nama'));
		$mst_room->price->setDbValue($rs->fields('price'));
		$mst_room->price2->setDbValue($rs->fields('price2'));
		$mst_room->tipe->setDbValue($rs->fields('tipe'));
		$mst_room->connecting1->setDbValue($rs->fields('connecting1'));
		$mst_room->connecting2->setDbValue($rs->fields('connecting2'));
		$mst_room->available->setDbValue($rs->fields('available'));
		$mst_room->booked->setDbValue($rs->fields('booked'));
		$mst_room->changeby->setDbValue($rs->fields('changeby'));
		$mst_room->changedate->setDbValue($rs->fields('changedate'));
		$mst_room->xtimestamp->setDbValue($rs->fields('xtimestamp'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_room;

		// Call Row_Rendering event
		$mst_room->Row_Rendering();

		// Common render codes for all row types
		// kode

		$mst_room->kode->CellCssStyle = "white-space: nowrap;";
		$mst_room->kode->CellCssClass = "";

		// nama
		$mst_room->nama->CellCssStyle = "white-space: nowrap;";
		$mst_room->nama->CellCssClass = "";

		// tipe
		$mst_room->tipe->CellCssStyle = "white-space: nowrap;";
		$mst_room->tipe->CellCssClass = "";

		// connecting1
		$mst_room->connecting1->CellCssStyle = "white-space: nowrap;";
		$mst_room->connecting1->CellCssClass = "";

		// connecting2
		$mst_room->connecting2->CellCssStyle = "white-space: nowrap;";
		$mst_room->connecting2->CellCssClass = "";

		// changeby
		$mst_room->changeby->CellCssStyle = "white-space: nowrap;";
		$mst_room->changeby->CellCssClass = "";

		// changedate
		$mst_room->changedate->CellCssStyle = "white-space: nowrap;";
		$mst_room->changedate->CellCssClass = "";
		if ($mst_room->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$mst_room->kode->ViewValue = $mst_room->kode->CurrentValue;
			$mst_room->kode->CssStyle = "";
			$mst_room->kode->CssClass = "";
			$mst_room->kode->ViewCustomAttributes = "";

			// nama
			$mst_room->nama->ViewValue = $mst_room->nama->CurrentValue;
			$mst_room->nama->CssStyle = "";
			$mst_room->nama->CssClass = "";
			$mst_room->nama->ViewCustomAttributes = "";

			// tipe
			if (strval($mst_room->tipe->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `description` FROM `mst_room_type` WHERE `id` = '" . ew_AdjustSql($mst_room->tipe->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_room->tipe->ViewValue = $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$mst_room->tipe->ViewValue = $mst_room->tipe->CurrentValue;
				}
			} else {
				$mst_room->tipe->ViewValue = NULL;
			}
			$mst_room->tipe->CssStyle = "";
			$mst_room->tipe->CssClass = "";
			$mst_room->tipe->ViewCustomAttributes = "";

			// connecting1
			if (strval($mst_room->connecting1->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `mst_room` WHERE `kode` = '" . ew_AdjustSql($mst_room->connecting1->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_room->connecting1->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$mst_room->connecting1->ViewValue = $mst_room->connecting1->CurrentValue;
				}
			} else {
				$mst_room->connecting1->ViewValue = NULL;
			}
			$mst_room->connecting1->CssStyle = "";
			$mst_room->connecting1->CssClass = "";
			$mst_room->connecting1->ViewCustomAttributes = "";

			// connecting2
			if (strval($mst_room->connecting2->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `mst_room` WHERE `kode` = '" . ew_AdjustSql($mst_room->connecting2->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_room->connecting2->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$mst_room->connecting2->ViewValue = $mst_room->connecting2->CurrentValue;
				}
			} else {
				$mst_room->connecting2->ViewValue = NULL;
			}
			$mst_room->connecting2->CssStyle = "";
			$mst_room->connecting2->CssClass = "";
			$mst_room->connecting2->ViewCustomAttributes = "";

			// changeby
			if (strval($mst_room->changeby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($mst_room->changeby->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_room->changeby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$mst_room->changeby->ViewValue = $mst_room->changeby->CurrentValue;
				}
			} else {
				$mst_room->changeby->ViewValue = NULL;
			}
			$mst_room->changeby->CssStyle = "";
			$mst_room->changeby->CssClass = "";
			$mst_room->changeby->ViewCustomAttributes = "";

			// changedate
			$mst_room->changedate->ViewValue = $mst_room->changedate->CurrentValue;
			$mst_room->changedate->ViewValue = ew_FormatDateTime($mst_room->changedate->ViewValue, 7);
			$mst_room->changedate->CssStyle = "";
			$mst_room->changedate->CssClass = "";
			$mst_room->changedate->ViewCustomAttributes = "";

			// kode
			$mst_room->kode->HrefValue = "";

			// nama
			$mst_room->nama->HrefValue = "";

			// tipe
			$mst_room->tipe->HrefValue = "";

			// connecting1
			$mst_room->connecting1->HrefValue = "";

			// connecting2
			$mst_room->connecting2->HrefValue = "";

			// changeby
			$mst_room->changeby->HrefValue = "";

			// changedate
			$mst_room->changedate->HrefValue = "";
		} elseif ($mst_room->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// kode
			$mst_room->kode->EditCustomAttributes = "";
			$mst_room->kode->EditValue = ew_HtmlEncode($mst_room->kode->AdvancedSearch->SearchValue);

			// nama
			$mst_room->nama->EditCustomAttributes = "";
			$mst_room->nama->EditValue = ew_HtmlEncode($mst_room->nama->AdvancedSearch->SearchValue);

			// tipe
			$mst_room->tipe->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id`, `description`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_room_type`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$mst_room->tipe->EditValue = $arwrk;

			// connecting1
			$mst_room->connecting1->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_room`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$mst_room->connecting1->EditValue = $arwrk;

			// connecting2
			$mst_room->connecting2->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_room`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$mst_room->connecting2->EditValue = $arwrk;

			// changeby
			$mst_room->changeby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$mst_room->changeby->EditValue = $arwrk;

			// changedate
			$mst_room->changedate->EditCustomAttributes = "";
			$mst_room->changedate->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($mst_room->changedate->AdvancedSearch->SearchValue, 7), 7));
		}

		// Call Row Rendered event
		$mst_room->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $mst_room;

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
		global $mst_room;
		$mst_room->kode->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_kode");
		$mst_room->nama->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_nama");
		$mst_room->price->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_price");
		$mst_room->price2->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_price2");
		$mst_room->tipe->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_tipe");
		$mst_room->connecting1->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_connecting1");
		$mst_room->connecting2->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_connecting2");
		$mst_room->available->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_available");
		$mst_room->booked->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_booked");
		$mst_room->changeby->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_changeby");
		$mst_room->changedate->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_changedate");
		$mst_room->xtimestamp->AdvancedSearch->SearchValue = $mst_room->getAdvancedSearch("x_xtimestamp");
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'mst_room';

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
