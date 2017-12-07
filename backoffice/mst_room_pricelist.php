<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_room_priceinfo.php" ?>
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
$mst_room_price_list = new cmst_room_price_list();
$Page =& $mst_room_price_list;

// Page init processing
$mst_room_price_list->Page_Init();

// Page main processing
$mst_room_price_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($mst_room_price->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var mst_room_price_list = new ew_Page("mst_room_price_list");

// page properties
mst_room_price_list.PageID = "list"; // page ID
var EW_PAGE_ID = mst_room_price_list.PageID; // for backward compatibility

// extend page with validate function for search
mst_room_price_list.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_tanggal1"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Start Date");
	elm = fobj.elements["x" + infix + "_tanggal2"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - End Date");

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
mst_room_price_list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_room_price_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_room_price_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($mst_room_price->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = ($mst_room_price->Export == "" && $mst_room_price->SelectLimit);
	if (!$bSelectLimit)
		$rs = $mst_room_price_list->LoadRecordset();
	$mst_room_price_list->lTotalRecs = ($bSelectLimit) ? $mst_room_price->SelectRecordCount() : $rs->RecordCount();
	$mst_room_price_list->lStartRec = 1;
	if ($mst_room_price_list->lDisplayRecs <= 0) // Display all records
		$mst_room_price_list->lDisplayRecs = $mst_room_price_list->lTotalRecs;
	if (!($mst_room_price->ExportAll && $mst_room_price->Export <> ""))
		$mst_room_price_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $mst_room_price_list->LoadRecordset($mst_room_price_list->lStartRec-1, $mst_room_price_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><h3><b>Master Room Price</b></h3>
<?php if ($mst_room_price->Export == "" && $mst_room_price->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $mst_room_price_list->PageUrl() ?>export=print"><img src="images/b_print.png" title="Printer Friendly" width="16" height="16" border="0"></a>
<?php } ?>
</span></p>
<?php if ($mst_room_price->Export == "" && $mst_room_price->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(mst_room_price_list);" style="text-decoration: none;"><img id="mst_room_price_list_SearchImage" src="images/collapse.gif" title="Search" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;Search</span><br>
<div id="mst_room_price_list_SearchPanel">
<form name="fmst_room_pricelistsrch" id="fmst_room_pricelistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>" onsubmit="return mst_room_price_list.ValidateSearch(this);">
<input type="hidden" id="t" name="t" value="mst_room_price">
<?php
if ($gsSearchError == "")
	$mst_room_price_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$mst_room_price->RowType = EW_ROWTYPE_SEARCH;

// Render row
$mst_room_price_list->RenderRow();
?>
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">Start Date</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_tanggal1" id="z_tanggal1" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_tanggal1" id="x_tanggal1" value="<?php echo $mst_room_price->tanggal1->EditValue ?>"<?php echo $mst_room_price->tanggal1->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_tanggal1" name="cal_x_tanggal1" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_tanggal1", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_tanggal1" // ID of the button
});
</script>
</span></td>
			</tr></table>
		</td>
	</tr>
	<tr>
		<td><span class="phpmaker">End Date</span></td>
		<td><span class="ewSearchOpr">=<input type="hidden" name="z_tanggal2" id="z_tanggal2" value="="></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<input type="text" name="x_tanggal2" id="x_tanggal2" value="<?php echo $mst_room_price->tanggal2->EditValue ?>"<?php echo $mst_room_price->tanggal2->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_tanggal2" name="cal_x_tanggal2" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_tanggal2", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_tanggal2" // ID of the button
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
<select id="x_room" name="x_room"<?php echo $mst_room_price->room->EditAttributes() ?>>
<?php
if (is_array($mst_room_price->room->EditValue)) {
	$arwrk = $mst_room_price->room->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_room_price->room->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Room Type</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_roomtype" id="z_roomtype" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_roomtype" name="x_roomtype"<?php echo $mst_room_price->roomtype->EditAttributes() ?>>
<?php
if (is_array($mst_room_price->roomtype->EditValue)) {
	$arwrk = $mst_room_price->roomtype->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_room_price->roomtype->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
		<td><span class="phpmaker">Create By</span></td>
		<td><span class="ewSearchOpr">contains<input type="hidden" name="z_createby" id="z_createby" value="LIKE"></span></td>
		<td>			
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<select id="x_createby" name="x_createby"<?php echo $mst_room_price->createby->EditAttributes() ?>>
<?php
if (is_array($mst_room_price->createby->EditValue)) {
	$arwrk = $mst_room_price->createby->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_room_price->createby->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
			<!--a href="<?php echo $mst_room_price_list->PageUrl() ?>cmd=reset">Show all</a-->&nbsp;
			<input type="button" value="Reset Search" onclick="window.location='<?php echo $mst_room_price_list->PageUrl() ?>cmd=reset';">
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php $mst_room_price_list->ShowMessage() ?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($mst_room_price->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($mst_room_price->CurrentAction <> "gridadd" && $mst_room_price->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($mst_room_price_list->Pager)) $mst_room_price_list->Pager = new cPrevNextPager($mst_room_price_list->lStartRec, $mst_room_price_list->lDisplayRecs, $mst_room_price_list->lTotalRecs) ?>
<?php if ($mst_room_price_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">Page&nbsp;</span></td>
<!--first page button-->
	<?php if ($mst_room_price_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $mst_room_price_list->PageUrl() ?>start=<?php echo $mst_room_price_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="First" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="First" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($mst_room_price_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $mst_room_price_list->PageUrl() ?>start=<?php echo $mst_room_price_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="Previous" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="Previous" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $mst_room_price_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($mst_room_price_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $mst_room_price_list->PageUrl() ?>start=<?php echo $mst_room_price_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="Next" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="Next" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($mst_room_price_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $mst_room_price_list->PageUrl() ?>start=<?php echo $mst_room_price_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="Last" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="Last" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;of <?php echo $mst_room_price_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker">Records <?php echo $mst_room_price_list->Pager->FromIndex ?> to <?php echo $mst_room_price_list->Pager->ToIndex ?> of <?php echo $mst_room_price_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($mst_room_price_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker">Please enter search criteria</span>
	<?php } else { ?>
	<span class="phpmaker">No records found</span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($mst_room_price_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td>Page Size&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="mst_room_price">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="10"<?php if ($mst_room_price_list->lDisplayRecs == 10) { ?> selected="selected"<?php } ?>>10</option>
<option value="20"<?php if ($mst_room_price_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="40"<?php if ($mst_room_price_list->lDisplayRecs == 40) { ?> selected="selected"<?php } ?>>40</option>
<option value="80"<?php if ($mst_room_price_list->lDisplayRecs == 80) { ?> selected="selected"<?php } ?>>80</option>
<option value="100"<?php if ($mst_room_price_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="200"<?php if ($mst_room_price_list->lDisplayRecs == 200) { ?> selected="selected"<?php } ?>>200</option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $mst_room_price->AddUrl() ?>"> <img src="images/expand.gif" title="Add" width="16" height="16" border="0"> </a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
<div class="ewGridMiddlePanel">
<form name="fmst_room_pricelist" id="fmst_room_pricelist" class="ewForm" action="" method="post">
<?php if ($mst_room_price_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php
	$mst_room_price_list->lOptionCnt = 0;
	$mst_room_price_list->lOptionCnt++; // view
	$mst_room_price_list->lOptionCnt++; // edit
	$mst_room_price_list->lOptionCnt++; // Delete
	$mst_room_price_list->lOptionCnt += count($mst_room_price_list->ListOptions->Items); // Custom list options
?>
<?php echo $mst_room_price->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php if ($mst_room_price->Export == "") { ?>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<td style="white-space: nowrap;">&nbsp;</td>
<?php

// Custom list options
foreach ($mst_room_price_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->HeaderCellHtml;
}
?>
<?php } ?>
<?php if ($mst_room_price->id->Visible) { // id ?>
	<?php if ($mst_room_price->SortUrl($mst_room_price->id) == "") { ?>
		<td style="white-space: nowrap;">Id</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_room_price->SortUrl($mst_room_price->id) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Id</td><td style="width: 10px;"><?php if ($mst_room_price->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_room_price->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_room_price->tanggal1->Visible) { // tanggal1 ?>
	<?php if ($mst_room_price->SortUrl($mst_room_price->tanggal1) == "") { ?>
		<td style="white-space: nowrap;">Start Date</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_room_price->SortUrl($mst_room_price->tanggal1) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Start Date</td><td style="width: 10px;"><?php if ($mst_room_price->tanggal1->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_room_price->tanggal1->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_room_price->tanggal2->Visible) { // tanggal2 ?>
	<?php if ($mst_room_price->SortUrl($mst_room_price->tanggal2) == "") { ?>
		<td style="white-space: nowrap;">End Date</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_room_price->SortUrl($mst_room_price->tanggal2) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>End Date</td><td style="width: 10px;"><?php if ($mst_room_price->tanggal2->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_room_price->tanggal2->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_room_price->room->Visible) { // room ?>
	<?php if ($mst_room_price->SortUrl($mst_room_price->room) == "") { ?>
		<td style="white-space: nowrap;">Room</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_room_price->SortUrl($mst_room_price->room) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Room</td><td style="width: 10px;"><?php if ($mst_room_price->room->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_room_price->room->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_room_price->roomtype->Visible) { // roomtype ?>
	<?php if ($mst_room_price->SortUrl($mst_room_price->roomtype) == "") { ?>
		<td style="white-space: nowrap;">Room Type</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_room_price->SortUrl($mst_room_price->roomtype) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Room Type</td><td style="width: 10px;"><?php if ($mst_room_price->roomtype->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_room_price->roomtype->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_room_price->description->Visible) { // description ?>
	<?php if ($mst_room_price->SortUrl($mst_room_price->description) == "") { ?>
		<td style="white-space: nowrap;">Description</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_room_price->SortUrl($mst_room_price->description) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Description</td><td style="width: 10px;"><?php if ($mst_room_price->description->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_room_price->description->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_room_price->baseprice->Visible) { // baseprice ?>
	<?php if ($mst_room_price->SortUrl($mst_room_price->baseprice) == "") { ?>
		<td style="white-space: nowrap;">Base Price</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_room_price->SortUrl($mst_room_price->baseprice) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Base Price</td><td style="width: 10px;"><?php if ($mst_room_price->baseprice->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_room_price->baseprice->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_room_price->tax->Visible) { // tax ?>
	<?php if ($mst_room_price->SortUrl($mst_room_price->tax) == "") { ?>
		<td style="white-space: nowrap;">Tax (%)</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_room_price->SortUrl($mst_room_price->tax) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Tax (%)</td><td style="width: 10px;"><?php if ($mst_room_price->tax->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_room_price->tax->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_room_price->service->Visible) { // service ?>
	<?php if ($mst_room_price->SortUrl($mst_room_price->service) == "") { ?>
		<td style="white-space: nowrap;">Service (%)</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_room_price->SortUrl($mst_room_price->service) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Service (%)</td><td style="width: 10px;"><?php if ($mst_room_price->service->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_room_price->service->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_room_price->aftertaxservice->Visible) { // aftertaxservice ?>
	<?php if ($mst_room_price->SortUrl($mst_room_price->aftertaxservice) == "") { ?>
		<td style="white-space: nowrap;">After Tax&Service</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_room_price->SortUrl($mst_room_price->aftertaxservice) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>After Tax&Service</td><td style="width: 10px;"><?php if ($mst_room_price->aftertaxservice->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_room_price->aftertaxservice->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_room_price->createby->Visible) { // createby ?>
	<?php if ($mst_room_price->SortUrl($mst_room_price->createby) == "") { ?>
		<td style="white-space: nowrap;">Create By</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_room_price->SortUrl($mst_room_price->createby) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Create By</td><td style="width: 10px;"><?php if ($mst_room_price->createby->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_room_price->createby->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
<?php if ($mst_room_price->createdate->Visible) { // createdate ?>
	<?php if ($mst_room_price->SortUrl($mst_room_price->createdate) == "") { ?>
		<td style="white-space: nowrap;">Create Date</td>
	<?php } else { ?>
		<td class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $mst_room_price->SortUrl($mst_room_price->createdate) ?>',1);" style="white-space: nowrap;">
			<table cellspacing="0" class="ewTableHeaderBtn"><tr><td>Create Date</td><td style="width: 10px;"><?php if ($mst_room_price->createdate->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($mst_room_price->createdate->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></table>
		</td>
	<?php } ?>
<?php } ?>		
	</tr>
</thead>
<?php
if ($mst_room_price->ExportAll && $mst_room_price->Export <> "") {
	$mst_room_price_list->lStopRec = $mst_room_price_list->lTotalRecs;
} else {
	$mst_room_price_list->lStopRec = $mst_room_price_list->lStartRec + $mst_room_price_list->lDisplayRecs - 1; // Set the last record to display
}
$mst_room_price_list->lRecCount = $mst_room_price_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$mst_room_price->SelectLimit && $mst_room_price_list->lStartRec > 1)
		$rs->Move($mst_room_price_list->lStartRec - 1);
}
$mst_room_price_list->lRowCnt = 0;
while (($mst_room_price->CurrentAction == "gridadd" || !$rs->EOF) &&
	$mst_room_price_list->lRecCount < $mst_room_price_list->lStopRec) {
	$mst_room_price_list->lRecCount++;
	if (intval($mst_room_price_list->lRecCount) >= intval($mst_room_price_list->lStartRec)) {
		$mst_room_price_list->lRowCnt++;

	// Init row class and style
	$mst_room_price->CssClass = "";
	$mst_room_price->CssStyle = "";
	$mst_room_price->RowClientEvents = "onmouseover='ew_MouseOver(event, this);' onmouseout='ew_MouseOut(event, this);' onclick='ew_Click(event, this);'";
	if ($mst_room_price->CurrentAction == "gridadd") {
		$mst_room_price_list->LoadDefaultValues(); // Load default values
	} else {
		$mst_room_price_list->LoadRowValues($rs); // Load row values
	}
	$mst_room_price->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$mst_room_price_list->RenderRow();
?>
	<tr<?php echo $mst_room_price->RowAttributes() ?>>
<?php if ($mst_room_price->Export == "") { ?>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_room_price->ViewUrl() ?>"><img src="images/view.gif" title="Detail" width="16" height="16" border="0"></a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<a href="<?php echo $mst_room_price->EditUrl() ?>"><img src="images/inlineedit.gif" title="Edit" width="16" height="16" border="0"></a>
</span></td>
<td style="white-space: nowrap;"><span class="phpmaker">
<?php if($mst_room_price->id->ListViewValue()>2){ ?><a href="<?php echo $mst_room_price->DeleteUrl() ?>"><img src="images/b_drop.png" title="Delete" width="16" height="16" border="0"></a><?php } ?>
</span></td>
<?php

// Custom list options
foreach ($mst_room_price_list->ListOptions->Items as $ListOption) {
	if ($ListOption->Visible)
		echo $ListOption->BodyCellHtml;
}
?>
<?php } ?>
	<?php if ($mst_room_price->id->Visible) { // id ?>
		<td<?php echo $mst_room_price->id->CellAttributes() ?>>
<div<?php echo $mst_room_price->id->ViewAttributes() ?>><?php echo $mst_room_price->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_room_price->tanggal1->Visible) { // tanggal1 ?>
		<td<?php echo $mst_room_price->tanggal1->CellAttributes() ?>>
<div<?php echo $mst_room_price->tanggal1->ViewAttributes() ?>><?php echo $mst_room_price->tanggal1->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_room_price->tanggal2->Visible) { // tanggal2 ?>
		<td<?php echo $mst_room_price->tanggal2->CellAttributes() ?>>
<div<?php echo $mst_room_price->tanggal2->ViewAttributes() ?>><?php echo $mst_room_price->tanggal2->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_room_price->room->Visible) { // room ?>
		<td<?php echo $mst_room_price->room->CellAttributes() ?>>
<div<?php echo $mst_room_price->room->ViewAttributes() ?>><?php echo $mst_room_price->room->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_room_price->roomtype->Visible) { // roomtype ?>
		<td<?php echo $mst_room_price->roomtype->CellAttributes() ?>>
<div<?php echo $mst_room_price->roomtype->ViewAttributes() ?>><?php echo $mst_room_price->roomtype->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_room_price->description->Visible) { // description ?>
		<td<?php echo $mst_room_price->description->CellAttributes() ?>>
<div<?php echo $mst_room_price->description->ViewAttributes() ?>><?php echo $mst_room_price->description->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_room_price->baseprice->Visible) { // baseprice ?>
		<td<?php echo $mst_room_price->baseprice->CellAttributes() ?>>
<div<?php echo $mst_room_price->baseprice->ViewAttributes() ?>><?php echo $mst_room_price->baseprice->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_room_price->tax->Visible) { // tax ?>
		<td<?php echo $mst_room_price->tax->CellAttributes() ?>>
<div<?php echo $mst_room_price->tax->ViewAttributes() ?>><?php echo $mst_room_price->tax->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_room_price->service->Visible) { // service ?>
		<td<?php echo $mst_room_price->service->CellAttributes() ?>>
<div<?php echo $mst_room_price->service->ViewAttributes() ?>><?php echo $mst_room_price->service->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_room_price->aftertaxservice->Visible) { // aftertaxservice ?>
		<td<?php echo $mst_room_price->aftertaxservice->CellAttributes() ?>>
<div<?php echo $mst_room_price->aftertaxservice->ViewAttributes() ?>><?php echo $mst_room_price->aftertaxservice->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_room_price->createby->Visible) { // createby ?>
		<td<?php echo $mst_room_price->createby->CellAttributes() ?>>
<div<?php echo $mst_room_price->createby->ViewAttributes() ?>><?php echo $mst_room_price->createby->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($mst_room_price->createdate->Visible) { // createdate ?>
		<td<?php echo $mst_room_price->createdate->CellAttributes() ?>>
<div<?php echo $mst_room_price->createdate->ViewAttributes() ?>><?php echo $mst_room_price->createdate->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($mst_room_price->CurrentAction <> "gridadd")
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
<?php if ($mst_room_price->Export == "" && $mst_room_price->CurrentAction == "") { ?>
<script type="text/javascript">
<!--

//ew_ToggleSearchPanel(mst_room_price_list); // uncomment to init search panel as collapsed
//-->

</script>
<?php } ?>
<?php if ($mst_room_price->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$mst_room_price_list->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_room_price_list {

	// Page ID
	var $PageID = 'list';

	// Table Name
	var $TableName = 'mst_room_price';

	// Page Object Name
	var $PageObjName = 'mst_room_price_list';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_room_price;
		if ($mst_room_price->UseTokenInUrl) $PageUrl .= "t=" . $mst_room_price->TableVar . "&"; // add page token
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
		global $objForm, $mst_room_price;
		if ($mst_room_price->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_room_price->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_room_price->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_room_price_list() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_room_price"] = new cmst_room_price();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_room_price', TRUE);

		// Open connection to the database
		$conn = ew_Connect();

		// Initialize list options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_room_price;
	$mst_room_price->Export = @$_GET["export"]; // Get export parameter
	$gsExport = $mst_room_price->Export; // Get export parameter, used in header
	$gsExportFile = $mst_room_price->TableVar; // Get export file, used in header
	if ($mst_room_price->Export == "print" || $mst_room_price->Export == "html") {

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
		global $objForm, $gsSearchError, $Security, $mst_room_price;
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
		if ($mst_room_price->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $mst_room_price->getRecordsPerPage(); // Restore from Session
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
		$mst_room_price->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$mst_room_price->setSearchWhere($this->sSrchWhere); // Save to Session
			$this->lStartRec = 1; // Reset start record counter
			$mst_room_price->setStartRecordNumber($this->lStartRec);
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
		$mst_room_price->setSessionWhere($sFilter);
		$mst_room_price->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $mst_room_price;
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
			$mst_room_price->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$mst_room_price->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return Advanced Search Where based on QueryString parameters
	function AdvancedSearchWhere() {
		global $Security, $mst_room_price;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $mst_room_price->id, FALSE); // Field id
		$this->BuildSearchSql($sWhere, $mst_room_price->tanggal1, FALSE); // Field tanggal1
		$this->BuildSearchSql($sWhere, $mst_room_price->tanggal2, FALSE); // Field tanggal2
		$this->BuildSearchSql($sWhere, $mst_room_price->room, FALSE); // Field room
		$this->BuildSearchSql($sWhere, $mst_room_price->roomtype, FALSE); // Field roomtype
		$this->BuildSearchSql($sWhere, $mst_room_price->description, FALSE); // Field description
		$this->BuildSearchSql($sWhere, $mst_room_price->baseprice, FALSE); // Field baseprice
		$this->BuildSearchSql($sWhere, $mst_room_price->tax, FALSE); // Field tax
		$this->BuildSearchSql($sWhere, $mst_room_price->service, FALSE); // Field service
		$this->BuildSearchSql($sWhere, $mst_room_price->aftertaxservice, FALSE); // Field aftertaxservice
		$this->BuildSearchSql($sWhere, $mst_room_price->createby, FALSE); // Field createby
		$this->BuildSearchSql($sWhere, $mst_room_price->createdate, FALSE); // Field createdate
		$this->BuildSearchSql($sWhere, $mst_room_price->xtimestamp, FALSE); // Field xtimestamp

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($mst_room_price->id); // Field id
			$this->SetSearchParm($mst_room_price->tanggal1); // Field tanggal1
			$this->SetSearchParm($mst_room_price->tanggal2); // Field tanggal2
			$this->SetSearchParm($mst_room_price->room); // Field room
			$this->SetSearchParm($mst_room_price->roomtype); // Field roomtype
			$this->SetSearchParm($mst_room_price->description); // Field description
			$this->SetSearchParm($mst_room_price->baseprice); // Field baseprice
			$this->SetSearchParm($mst_room_price->tax); // Field tax
			$this->SetSearchParm($mst_room_price->service); // Field service
			$this->SetSearchParm($mst_room_price->aftertaxservice); // Field aftertaxservice
			$this->SetSearchParm($mst_room_price->createby); // Field createby
			$this->SetSearchParm($mst_room_price->createdate); // Field createdate
			$this->SetSearchParm($mst_room_price->xtimestamp); // Field xtimestamp
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
		global $mst_room_price;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$mst_room_price->setAdvancedSearch("x_$FldParm", $FldVal);
		$mst_room_price->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$mst_room_price->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$mst_room_price->setAdvancedSearch("y_$FldParm", $FldVal2);
		$mst_room_price->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
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
		global $mst_room_price;
		$this->sSrchWhere = "";
		$mst_room_price->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {

		// Clear advanced search parameters
		global $mst_room_price;
		$mst_room_price->setAdvancedSearch("x_id", "");
		$mst_room_price->setAdvancedSearch("x_tanggal1", "");
		$mst_room_price->setAdvancedSearch("x_tanggal2", "");
		$mst_room_price->setAdvancedSearch("x_room", "");
		$mst_room_price->setAdvancedSearch("x_roomtype", "");
		$mst_room_price->setAdvancedSearch("x_description", "");
		$mst_room_price->setAdvancedSearch("x_baseprice", "");
		$mst_room_price->setAdvancedSearch("x_tax", "");
		$mst_room_price->setAdvancedSearch("x_service", "");
		$mst_room_price->setAdvancedSearch("x_aftertaxservice", "");
		$mst_room_price->setAdvancedSearch("x_createby", "");
		$mst_room_price->setAdvancedSearch("x_createdate", "");
		$mst_room_price->setAdvancedSearch("x_xtimestamp", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $gsSearchError, $mst_room_price;
		$this->sSrchWhere = $mst_room_price->getSearchWhere();

		// Restore advanced search settings
		if ($gsSearchError == "")
			$this->RestoreAdvancedSearchParms();
	}

	// Restore all advanced search parameters
	function RestoreAdvancedSearchParms() {

		// Restore advanced search parms
		global $mst_room_price;
		 $mst_room_price->id->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_id");
		 $mst_room_price->tanggal1->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_tanggal1");
		 $mst_room_price->tanggal2->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_tanggal2");
		 $mst_room_price->room->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_room");
		 $mst_room_price->roomtype->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_roomtype");
		 $mst_room_price->description->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_description");
		 $mst_room_price->baseprice->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_baseprice");
		 $mst_room_price->tax->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_tax");
		 $mst_room_price->service->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_service");
		 $mst_room_price->aftertaxservice->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_aftertaxservice");
		 $mst_room_price->createby->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_createby");
		 $mst_room_price->createdate->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_createdate");
		 $mst_room_price->xtimestamp->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_xtimestamp");
	}

	// Set up Sort parameters based on Sort Links clicked
	function SetUpSortOrder() {
		global $mst_room_price;

		// Check for an Order parameter
		if (@$_GET["order"] <> "") {
			$mst_room_price->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$mst_room_price->CurrentOrderType = @$_GET["ordertype"];
			$mst_room_price->UpdateSort($mst_room_price->id); // Field 
			$mst_room_price->UpdateSort($mst_room_price->tanggal1); // Field 
			$mst_room_price->UpdateSort($mst_room_price->tanggal2); // Field 
			$mst_room_price->UpdateSort($mst_room_price->room); // Field 
			$mst_room_price->UpdateSort($mst_room_price->roomtype); // Field 
			$mst_room_price->UpdateSort($mst_room_price->description); // Field 
			$mst_room_price->UpdateSort($mst_room_price->baseprice); // Field 
			$mst_room_price->UpdateSort($mst_room_price->tax); // Field 
			$mst_room_price->UpdateSort($mst_room_price->service); // Field 
			$mst_room_price->UpdateSort($mst_room_price->aftertaxservice); // Field 
			$mst_room_price->UpdateSort($mst_room_price->createby); // Field 
			$mst_room_price->UpdateSort($mst_room_price->createdate); // Field 
			$mst_room_price->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load Sort Order parameters
	function LoadSortOrder() {
		global $mst_room_price;
		$sOrderBy = $mst_room_price->getSessionOrderBy(); // Get order by from Session
		if ($sOrderBy == "") {
			if ($mst_room_price->SqlOrderBy() <> "") {
				$sOrderBy = $mst_room_price->SqlOrderBy();
				$mst_room_price->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command based on querystring parameter cmd=
	// - RESET: reset search parameters
	// - RESETALL: reset search & master/detail parameters
	// - RESETSORT: reset sort parameters
	function ResetCmd() {
		global $mst_room_price;

		// Get reset cmd
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sort criteria
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$mst_room_price->setSessionOrderBy($sOrderBy);
				$mst_room_price->id->setSort("");
				$mst_room_price->tanggal1->setSort("");
				$mst_room_price->tanggal2->setSort("");
				$mst_room_price->room->setSort("");
				$mst_room_price->roomtype->setSort("");
				$mst_room_price->description->setSort("");
				$mst_room_price->baseprice->setSort("");
				$mst_room_price->tax->setSort("");
				$mst_room_price->service->setSort("");
				$mst_room_price->aftertaxservice->setSort("");
				$mst_room_price->createby->setSort("");
				$mst_room_price->createdate->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$mst_room_price->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $mst_room_price;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$mst_room_price->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$mst_room_price->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $mst_room_price->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$mst_room_price->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$mst_room_price->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$mst_room_price->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $mst_room_price;

		// Load search values
		// id

		$mst_room_price->id->AdvancedSearch->SearchValue = @$_GET["x_id"];
		$mst_room_price->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// tanggal1
		$mst_room_price->tanggal1->AdvancedSearch->SearchValue = @$_GET["x_tanggal1"];
		$mst_room_price->tanggal1->AdvancedSearch->SearchOperator = @$_GET["z_tanggal1"];

		// tanggal2
		$mst_room_price->tanggal2->AdvancedSearch->SearchValue = @$_GET["x_tanggal2"];
		$mst_room_price->tanggal2->AdvancedSearch->SearchOperator = @$_GET["z_tanggal2"];

		// room
		$mst_room_price->room->AdvancedSearch->SearchValue = @$_GET["x_room"];
		$mst_room_price->room->AdvancedSearch->SearchOperator = @$_GET["z_room"];

		// roomtype
		$mst_room_price->roomtype->AdvancedSearch->SearchValue = @$_GET["x_roomtype"];
		$mst_room_price->roomtype->AdvancedSearch->SearchOperator = @$_GET["z_roomtype"];

		// description
		$mst_room_price->description->AdvancedSearch->SearchValue = @$_GET["x_description"];
		$mst_room_price->description->AdvancedSearch->SearchOperator = @$_GET["z_description"];

		// baseprice
		$mst_room_price->baseprice->AdvancedSearch->SearchValue = @$_GET["x_baseprice"];
		$mst_room_price->baseprice->AdvancedSearch->SearchOperator = @$_GET["z_baseprice"];

		// tax
		$mst_room_price->tax->AdvancedSearch->SearchValue = @$_GET["x_tax"];
		$mst_room_price->tax->AdvancedSearch->SearchOperator = @$_GET["z_tax"];

		// service
		$mst_room_price->service->AdvancedSearch->SearchValue = @$_GET["x_service"];
		$mst_room_price->service->AdvancedSearch->SearchOperator = @$_GET["z_service"];

		// aftertaxservice
		$mst_room_price->aftertaxservice->AdvancedSearch->SearchValue = @$_GET["x_aftertaxservice"];
		$mst_room_price->aftertaxservice->AdvancedSearch->SearchOperator = @$_GET["z_aftertaxservice"];

		// createby
		$mst_room_price->createby->AdvancedSearch->SearchValue = @$_GET["x_createby"];
		$mst_room_price->createby->AdvancedSearch->SearchOperator = @$_GET["z_createby"];

		// createdate
		$mst_room_price->createdate->AdvancedSearch->SearchValue = @$_GET["x_createdate"];
		$mst_room_price->createdate->AdvancedSearch->SearchOperator = @$_GET["z_createdate"];

		// xtimestamp
		$mst_room_price->xtimestamp->AdvancedSearch->SearchValue = @$_GET["x_xtimestamp"];
		$mst_room_price->xtimestamp->AdvancedSearch->SearchOperator = @$_GET["z_xtimestamp"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mst_room_price;

		// Call Recordset Selecting event
		$mst_room_price->Recordset_Selecting($mst_room_price->CurrentFilter);

		// Load list page SQL
		$sSql = $mst_room_price->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$mst_room_price->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_room_price;
		$sFilter = $mst_room_price->KeyFilter();

		// Call Row Selecting event
		$mst_room_price->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_room_price->CurrentFilter = $sFilter;
		$sSql = $mst_room_price->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_room_price->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_room_price;
		$mst_room_price->id->setDbValue($rs->fields('id'));
		$mst_room_price->tanggal1->setDbValue($rs->fields('tanggal1'));
		$mst_room_price->tanggal2->setDbValue($rs->fields('tanggal2'));
		$mst_room_price->room->setDbValue($rs->fields('room'));
		$mst_room_price->roomtype->setDbValue($rs->fields('roomtype'));
		$mst_room_price->description->setDbValue($rs->fields('description'));
		$mst_room_price->baseprice->setDbValue($rs->fields('baseprice'));
		$mst_room_price->tax->setDbValue($rs->fields('tax'));
		$mst_room_price->service->setDbValue($rs->fields('service'));
		$mst_room_price->aftertaxservice->setDbValue($rs->fields('aftertaxservice'));
		$mst_room_price->createby->setDbValue($rs->fields('createby'));
		$mst_room_price->createdate->setDbValue($rs->fields('createdate'));
		$mst_room_price->xtimestamp->setDbValue($rs->fields('xtimestamp'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_room_price;

		// Call Row_Rendering event
		$mst_room_price->Row_Rendering();

		// Common render codes for all row types
		// id

		$mst_room_price->id->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->id->CellCssClass = "";

		// tanggal1
		$mst_room_price->tanggal1->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->tanggal1->CellCssClass = "";

		// tanggal2
		$mst_room_price->tanggal2->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->tanggal2->CellCssClass = "";

		// room
		$mst_room_price->room->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->room->CellCssClass = "";

		// roomtype
		$mst_room_price->roomtype->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->roomtype->CellCssClass = "";

		// description
		$mst_room_price->description->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->description->CellCssClass = "";

		// baseprice
		$mst_room_price->baseprice->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->baseprice->CellCssClass = "";

		// tax
		$mst_room_price->tax->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->tax->CellCssClass = "";

		// service
		$mst_room_price->service->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->service->CellCssClass = "";

		// aftertaxservice
		$mst_room_price->aftertaxservice->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->aftertaxservice->CellCssClass = "";

		// createby
		$mst_room_price->createby->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->createby->CellCssClass = "";

		// createdate
		$mst_room_price->createdate->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->createdate->CellCssClass = "";
		if ($mst_room_price->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$mst_room_price->id->ViewValue = $mst_room_price->id->CurrentValue;
			$mst_room_price->id->CssStyle = "";
			$mst_room_price->id->CssClass = "";
			$mst_room_price->id->ViewCustomAttributes = "";

			// tanggal1
			$mst_room_price->tanggal1->ViewValue = $mst_room_price->tanggal1->CurrentValue;
			$mst_room_price->tanggal1->ViewValue = ew_FormatDateTime($mst_room_price->tanggal1->ViewValue, 7);
			$mst_room_price->tanggal1->CssStyle = "";
			$mst_room_price->tanggal1->CssClass = "";
			$mst_room_price->tanggal1->ViewCustomAttributes = "";

			// tanggal2
			$mst_room_price->tanggal2->ViewValue = $mst_room_price->tanggal2->CurrentValue;
			$mst_room_price->tanggal2->ViewValue = ew_FormatDateTime($mst_room_price->tanggal2->ViewValue, 7);
			$mst_room_price->tanggal2->CssStyle = "";
			$mst_room_price->tanggal2->CssClass = "";
			$mst_room_price->tanggal2->ViewCustomAttributes = "";

			// room
			if (strval($mst_room_price->room->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `mst_room` WHERE `kode` = '" . ew_AdjustSql($mst_room_price->room->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_room_price->room->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$mst_room_price->room->ViewValue = $mst_room_price->room->CurrentValue;
				}
			} else {
				$mst_room_price->room->ViewValue = NULL;
			}
			$mst_room_price->room->CssStyle = "";
			$mst_room_price->room->CssClass = "";
			$mst_room_price->room->ViewCustomAttributes = "";

			// roomtype
			if (strval($mst_room_price->roomtype->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `description` FROM `mst_room_type` WHERE `id` = '" . ew_AdjustSql($mst_room_price->roomtype->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_room_price->roomtype->ViewValue = $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$mst_room_price->roomtype->ViewValue = $mst_room_price->roomtype->CurrentValue;
				}
			} else {
				$mst_room_price->roomtype->ViewValue = NULL;
			}
			$mst_room_price->roomtype->CssStyle = "";
			$mst_room_price->roomtype->CssClass = "";
			$mst_room_price->roomtype->ViewCustomAttributes = "";

			// description
			$mst_room_price->description->ViewValue = $mst_room_price->description->CurrentValue;
			$mst_room_price->description->CssStyle = "";
			$mst_room_price->description->CssClass = "";
			$mst_room_price->description->ViewCustomAttributes = "";

			// baseprice
			$mst_room_price->baseprice->ViewValue = $mst_room_price->baseprice->CurrentValue;
			$mst_room_price->baseprice->ViewValue = ew_FormatNumber($mst_room_price->baseprice->ViewValue, 0, -2, -2, -2);
			$mst_room_price->baseprice->CssStyle = "text-align:right;";
			$mst_room_price->baseprice->CssClass = "";
			$mst_room_price->baseprice->ViewCustomAttributes = "";

			// tax
			$mst_room_price->tax->ViewValue = $mst_room_price->tax->CurrentValue;
			$mst_room_price->tax->ViewValue = ew_FormatNumber($mst_room_price->tax->ViewValue, 0, -2, -2, -2);
			$mst_room_price->tax->CssStyle = "text-align:right;";
			$mst_room_price->tax->CssClass = "";
			$mst_room_price->tax->ViewCustomAttributes = "";

			// service
			$mst_room_price->service->ViewValue = $mst_room_price->service->CurrentValue;
			$mst_room_price->service->ViewValue = ew_FormatNumber($mst_room_price->service->ViewValue, 0, -2, -2, -2);
			$mst_room_price->service->CssStyle = "text-align:right;";
			$mst_room_price->service->CssClass = "";
			$mst_room_price->service->ViewCustomAttributes = "";

			// aftertaxservice
			$mst_room_price->aftertaxservice->ViewValue = $mst_room_price->aftertaxservice->CurrentValue;
			$mst_room_price->aftertaxservice->ViewValue = ew_FormatNumber($mst_room_price->aftertaxservice->ViewValue, 0, -2, -2, -2);
			$mst_room_price->aftertaxservice->CssStyle = "text-align:right;";
			$mst_room_price->aftertaxservice->CssClass = "";
			$mst_room_price->aftertaxservice->ViewCustomAttributes = "";

			// createby
			if (strval($mst_room_price->createby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($mst_room_price->createby->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_room_price->createby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$mst_room_price->createby->ViewValue = $mst_room_price->createby->CurrentValue;
				}
			} else {
				$mst_room_price->createby->ViewValue = NULL;
			}
			$mst_room_price->createby->CssStyle = "";
			$mst_room_price->createby->CssClass = "";
			$mst_room_price->createby->ViewCustomAttributes = "";

			// createdate
			$mst_room_price->createdate->ViewValue = $mst_room_price->createdate->CurrentValue;
			$mst_room_price->createdate->ViewValue = ew_FormatDateTime($mst_room_price->createdate->ViewValue, 7);
			$mst_room_price->createdate->CssStyle = "";
			$mst_room_price->createdate->CssClass = "";
			$mst_room_price->createdate->ViewCustomAttributes = "";

			// id
			$mst_room_price->id->HrefValue = "";

			// tanggal1
			$mst_room_price->tanggal1->HrefValue = "";

			// tanggal2
			$mst_room_price->tanggal2->HrefValue = "";

			// room
			$mst_room_price->room->HrefValue = "";

			// roomtype
			$mst_room_price->roomtype->HrefValue = "";

			// description
			$mst_room_price->description->HrefValue = "";

			// baseprice
			$mst_room_price->baseprice->HrefValue = "";

			// tax
			$mst_room_price->tax->HrefValue = "";

			// service
			$mst_room_price->service->HrefValue = "";

			// aftertaxservice
			$mst_room_price->aftertaxservice->HrefValue = "";

			// createby
			$mst_room_price->createby->HrefValue = "";

			// createdate
			$mst_room_price->createdate->HrefValue = "";
		} elseif ($mst_room_price->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$mst_room_price->id->EditCustomAttributes = "";
			$mst_room_price->id->EditValue = ew_HtmlEncode($mst_room_price->id->AdvancedSearch->SearchValue);

			// tanggal1
			$mst_room_price->tanggal1->EditCustomAttributes = "";
			$mst_room_price->tanggal1->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($mst_room_price->tanggal1->AdvancedSearch->SearchValue, 7), 7));

			// tanggal2
			$mst_room_price->tanggal2->EditCustomAttributes = "";
			$mst_room_price->tanggal2->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($mst_room_price->tanggal2->AdvancedSearch->SearchValue, 7), 7));

			// room
			$mst_room_price->room->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_room`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$mst_room_price->room->EditValue = $arwrk;

			// roomtype
			$mst_room_price->roomtype->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id`, `description`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_room_type`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$mst_room_price->roomtype->EditValue = $arwrk;

			// description
			$mst_room_price->description->EditCustomAttributes = "";
			$mst_room_price->description->EditValue = ew_HtmlEncode($mst_room_price->description->AdvancedSearch->SearchValue);

			// baseprice
			$mst_room_price->baseprice->EditCustomAttributes = "";
			$mst_room_price->baseprice->EditValue = ew_HtmlEncode($mst_room_price->baseprice->AdvancedSearch->SearchValue);

			// tax
			$mst_room_price->tax->EditCustomAttributes = "";
			$mst_room_price->tax->EditValue = ew_HtmlEncode($mst_room_price->tax->AdvancedSearch->SearchValue);

			// service
			$mst_room_price->service->EditCustomAttributes = "";
			$mst_room_price->service->EditValue = ew_HtmlEncode($mst_room_price->service->AdvancedSearch->SearchValue);

			// aftertaxservice
			$mst_room_price->aftertaxservice->EditCustomAttributes = "";
			$mst_room_price->aftertaxservice->EditValue = ew_HtmlEncode($mst_room_price->aftertaxservice->AdvancedSearch->SearchValue);

			// createby
			$mst_room_price->createby->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `username`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `user_account`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$mst_room_price->createby->EditValue = $arwrk;

			// createdate
			$mst_room_price->createdate->EditCustomAttributes = "";
			$mst_room_price->createdate->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($mst_room_price->createdate->AdvancedSearch->SearchValue, 7), 7));
		}

		// Call Row Rendered event
		$mst_room_price->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $mst_room_price;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckEuroDate($mst_room_price->tanggal1->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Start Date";
		}
		if (!ew_CheckEuroDate($mst_room_price->tanggal2->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - End Date";
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
		global $mst_room_price;
		$mst_room_price->id->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_id");
		$mst_room_price->tanggal1->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_tanggal1");
		$mst_room_price->tanggal2->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_tanggal2");
		$mst_room_price->room->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_room");
		$mst_room_price->roomtype->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_roomtype");
		$mst_room_price->description->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_description");
		$mst_room_price->baseprice->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_baseprice");
		$mst_room_price->tax->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_tax");
		$mst_room_price->service->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_service");
		$mst_room_price->aftertaxservice->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_aftertaxservice");
		$mst_room_price->createby->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_createby");
		$mst_room_price->createdate->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_createdate");
		$mst_room_price->xtimestamp->AdvancedSearch->SearchValue = $mst_room_price->getAdvancedSearch("x_xtimestamp");
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
