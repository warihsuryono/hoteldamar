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
$mst_material_part_search = new cmst_material_part_search();
$Page =& $mst_material_part_search;

// Page init processing
$mst_material_part_search->Page_Init();

// Page main processing
$mst_material_part_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mst_material_part_search = new ew_Page("mst_material_part_search");

// page properties
mst_material_part_search.PageID = "search"; // page ID
var EW_PAGE_ID = mst_material_part_search.PageID; // for backward compatibility

// extend page with validate function for search
mst_material_part_search.ValidateSearch = function(fobj) {
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
mst_material_part_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
mst_material_part_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_material_part_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_material_part_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
mst_material_part_search.ShowHighlightText = "Show highlight"; 
mst_material_part_search.HideHighlightText = "Hide highlight";

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">Search <h3><b>Master Barang</b></h3><br><br>
<!--a href="<?php echo $mst_material_part->getReturnUrl() ?>">Back to List</a-->
<input type="button" value="Kembali" onclick="window.location='<?php echo $mst_material_part->getReturnUrl() ?>';">
</span></p>
<?php $mst_material_part_search->ShowMessage() ?>
<form name="fmst_material_partsearch" id="fmst_material_partsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return mst_material_part_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="mst_material_part">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="  Search  ">
<input type="button" name="Reset" id="Reset" value="   Reset   " onclick="ew_ClearForm(this.form);">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$mst_material_part_search->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_material_part_search {

	// Page ID
	var $PageID = 'search';

	// Table Name
	var $TableName = 'mst_material_part';

	// Page Object Name
	var $PageObjName = 'mst_material_part_search';

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
	function cmst_material_part_search() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_material_part"] = new cmst_material_part();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_material_part', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_material_part;

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

	//
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsSearchError, $mst_material_part;
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$mst_material_part->CurrentAction = $objForm->GetValue("a_search");
			switch ($mst_material_part->CurrentAction) {
				case "S": // Get Search Criteria

					// Build search string for advanced search, remove blank field
					$this->LoadSearchValues(); // Get search values
					if ($this->ValidateSearch()) {
						$sSrchStr = $this->BuildAdvancedSearch();
					} else {
						$sSrchStr = "";
						$this->setMessage($gsSearchError);
					}
					if ($sSrchStr <> "") {
						$sSrchStr = $mst_material_part->UrlParm($sSrchStr);
						$this->Page_Terminate("mst_material_partlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$mst_material_part->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $mst_material_part;
	$sSrchUrl = "";
	return $sSrchUrl;
}

// Function to build search URL
function BuildSearchUrl(&$Url, &$Fld) {
	global $objForm;
	$sWrk = "";
	$FldParm = substr($Fld->FldVar, 2);
	$FldVal = $objForm->GetValue("x_$FldParm");
	$FldOpr = $objForm->GetValue("z_$FldParm");
	$FldCond = $objForm->GetValue("v_$FldParm");
	$FldVal2 = $objForm->GetValue("y_$FldParm");
	$FldOpr2 = $objForm->GetValue("w_$FldParm");
	$FldVal = ew_StripSlashes($FldVal);
	if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
	$FldVal2 = ew_StripSlashes($FldVal2);
	if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
	$FldOpr = strtoupper(trim($FldOpr));
	if ($FldOpr == "BETWEEN") {
		$IsValidValue = ($Fld->FldDataType <> EW_DATATYPE_NUMBER) ||
			($Fld->FldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal) && is_numeric($FldVal2));
		if ($FldVal <> "" && $FldVal2 <> "" && $IsValidValue) {
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
	} elseif ($FldOpr == "IS NULL" || $FldOpr == "IS NOT NULL") {
		$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
			"&z_" . $FldParm . "=" . urlencode($FldOpr);
	} else {
		$IsValidValue = ($Fld->FldDataType <> EW_DATATYPE_NUMBER) ||
			($Fld->FldDataType = EW_DATATYPE_NUMBER && is_numeric($FldVal));
		if ($FldVal <> "" && $IsValidValue && ew_IsValidOpr($FldOpr, $Fld->FldDataType)) {

			//$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
		$IsValidValue = ($Fld->FldDataType <> EW_DATATYPE_NUMBER) ||
			($Fld->FldDataType = EW_DATATYPE_NUMBER && is_numeric($FldVal2));
		if ($FldVal2 <> "" && $IsValidValue && ew_IsValidOpr($FldOpr2, $Fld->FldDataType)) {

			//$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
			$sWrk .= "&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&w_" . $FldParm . "=" . urlencode($FldOpr2);
		}
	}
	if ($sWrk <> "") {
		if ($Url <> "") $Url .= "&";
		$Url .= $sWrk;
	}
}

	// Convert search value for date
	function ConvertSearchValue(&$Fld, $FldVal) {
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_DATE && $FldVal <> "")
			$Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		return $Value;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $mst_material_part;

		// Load search values
		// kode

		$mst_material_part->kode->AdvancedSearch->SearchValue = $objForm->GetValue("x_kode");
		$mst_material_part->kode->AdvancedSearch->SearchOperator = $objForm->GetValue("z_kode");

		// modepart
		$mst_material_part->modepart->AdvancedSearch->SearchValue = $objForm->GetValue("x_modepart");
		$mst_material_part->modepart->AdvancedSearch->SearchOperator = $objForm->GetValue("z_modepart");

		// pn
		$mst_material_part->pn->AdvancedSearch->SearchValue = $objForm->GetValue("x_pn");
		$mst_material_part->pn->AdvancedSearch->SearchOperator = $objForm->GetValue("z_pn");

		// category
		$mst_material_part->category->AdvancedSearch->SearchValue = $objForm->GetValue("x_category");
		$mst_material_part->category->AdvancedSearch->SearchOperator = $objForm->GetValue("z_category");

		// modelunit
		$mst_material_part->modelunit->AdvancedSearch->SearchValue = $objForm->GetValue("x_modelunit");
		$mst_material_part->modelunit->AdvancedSearch->SearchOperator = $objForm->GetValue("z_modelunit");

		// nama
		$mst_material_part->nama->AdvancedSearch->SearchValue = $objForm->GetValue("x_nama");
		$mst_material_part->nama->AdvancedSearch->SearchOperator = $objForm->GetValue("z_nama");

		// satuan
		$mst_material_part->satuan->AdvancedSearch->SearchValue = $objForm->GetValue("x_satuan");
		$mst_material_part->satuan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_satuan");

		// keterangan
		$mst_material_part->keterangan->AdvancedSearch->SearchValue = $objForm->GetValue("x_keterangan");
		$mst_material_part->keterangan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_keterangan");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_material_part;

		// Call Row_Rendering event
		$mst_material_part->Row_Rendering();

		// Common render codes for all row types
		if ($mst_material_part->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$mst_material_part->kode->ViewValue = $mst_material_part->kode->CurrentValue;
			$mst_material_part->kode->CssStyle = "";
			$mst_material_part->kode->CssClass = "";
			$mst_material_part->kode->ViewCustomAttributes = "";

			// modepart
			if (strval($mst_material_part->modepart->CurrentValue) <> "") {
				switch ($mst_material_part->modepart->CurrentValue) {
					case "unit":
						$mst_material_part->modepart->ViewValue = "Unit";
						break;
					case "part":
						$mst_material_part->modepart->ViewValue = "Part";
						break;
					case "material":
						$mst_material_part->modepart->ViewValue = "Material";
						break;
					default:
						$mst_material_part->modepart->ViewValue = $mst_material_part->modepart->CurrentValue;
				}
			} else {
				$mst_material_part->modepart->ViewValue = NULL;
			}
			$mst_material_part->modepart->CssStyle = "";
			$mst_material_part->modepart->CssClass = "";
			$mst_material_part->modepart->ViewCustomAttributes = "";

			// pn
			$mst_material_part->pn->ViewValue = $mst_material_part->pn->CurrentValue;
			$mst_material_part->pn->CssStyle = "";
			$mst_material_part->pn->CssClass = "";
			$mst_material_part->pn->ViewCustomAttributes = "";

			// category
			$mst_material_part->category->ViewValue = $mst_material_part->category->CurrentValue;
			$mst_material_part->category->CssStyle = "";
			$mst_material_part->category->CssClass = "";
			$mst_material_part->category->ViewCustomAttributes = "";

			// modelunit
			if (strval($mst_material_part->modelunit->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `model` FROM `mst_modelunit` WHERE `kode` = '" . ew_AdjustSql($mst_material_part->modelunit->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `model` ";
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
				$sSqlWrk .= " ORDER BY `singkatan` ";
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
		} elseif ($mst_material_part->RowType == EW_ROWTYPE_SEARCH) { // Search row
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
		$mst_material_part->modepart->AdvancedSearch->SearchValue = $mst_material_part->getAdvancedSearch("x_modepart");
		$mst_material_part->pn->AdvancedSearch->SearchValue = $mst_material_part->getAdvancedSearch("x_pn");
		$mst_material_part->category->AdvancedSearch->SearchValue = $mst_material_part->getAdvancedSearch("x_category");
		$mst_material_part->modelunit->AdvancedSearch->SearchValue = $mst_material_part->getAdvancedSearch("x_modelunit");
		$mst_material_part->nama->AdvancedSearch->SearchValue = $mst_material_part->getAdvancedSearch("x_nama");
		$mst_material_part->satuan->AdvancedSearch->SearchValue = $mst_material_part->getAdvancedSearch("x_satuan");
		$mst_material_part->keterangan->AdvancedSearch->SearchValue = $mst_material_part->getAdvancedSearch("x_keterangan");
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
