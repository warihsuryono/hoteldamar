<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_modelunitinfo.php" ?>
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
$mst_modelunit_search = new cmst_modelunit_search();
$Page =& $mst_modelunit_search;

// Page init processing
$mst_modelunit_search->Page_Init();

// Page main processing
$mst_modelunit_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mst_modelunit_search = new ew_Page("mst_modelunit_search");

// page properties
mst_modelunit_search.PageID = "search"; // page ID
var EW_PAGE_ID = mst_modelunit_search.PageID; // for backward compatibility

// extend page with validate function for search
mst_modelunit_search.ValidateSearch = function(fobj) {
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
mst_modelunit_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
mst_modelunit_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_modelunit_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_modelunit_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
mst_modelunit_search.ShowHighlightText = "Show highlight"; 
mst_modelunit_search.HideHighlightText = "Hide highlight";

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">Search <h3><b>Master Tipe Barang</b></h3><br><br>
<!--a href="<?php echo $mst_modelunit->getReturnUrl() ?>">Back to List</a-->
<input type="button" value="Kembali" onclick="window.location='<?php echo $mst_modelunit->getReturnUrl() ?>';">
</span></p>
<?php $mst_modelunit_search->ShowMessage() ?>
<form name="fmst_modelunitsearch" id="fmst_modelunitsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return mst_modelunit_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="mst_modelunit">
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
$mst_modelunit_search->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_modelunit_search {

	// Page ID
	var $PageID = 'search';

	// Table Name
	var $TableName = 'mst_modelunit';

	// Page Object Name
	var $PageObjName = 'mst_modelunit_search';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_modelunit;
		if ($mst_modelunit->UseTokenInUrl) $PageUrl .= "t=" . $mst_modelunit->TableVar . "&"; // add page token
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
		global $objForm, $mst_modelunit;
		if ($mst_modelunit->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_modelunit->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_modelunit->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_modelunit_search() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_modelunit"] = new cmst_modelunit();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_modelunit', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_modelunit;

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
		global $objForm, $gsSearchError, $mst_modelunit;
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$mst_modelunit->CurrentAction = $objForm->GetValue("a_search");
			switch ($mst_modelunit->CurrentAction) {
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
						$sSrchStr = $mst_modelunit->UrlParm($sSrchStr);
						$this->Page_Terminate("mst_modelunitlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$mst_modelunit->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $mst_modelunit;
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
		global $objForm, $mst_modelunit;

		// Load search values
		// kode

		$mst_modelunit->kode->AdvancedSearch->SearchValue = $objForm->GetValue("x_kode");
		$mst_modelunit->kode->AdvancedSearch->SearchOperator = $objForm->GetValue("z_kode");

		// model
		$mst_modelunit->model->AdvancedSearch->SearchValue = $objForm->GetValue("x_model");
		$mst_modelunit->model->AdvancedSearch->SearchOperator = $objForm->GetValue("z_model");

		// description
		$mst_modelunit->description->AdvancedSearch->SearchValue = $objForm->GetValue("x_description");
		$mst_modelunit->description->AdvancedSearch->SearchOperator = $objForm->GetValue("z_description");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_modelunit;

		// Call Row_Rendering event
		$mst_modelunit->Row_Rendering();

		// Common render codes for all row types
		if ($mst_modelunit->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$mst_modelunit->kode->ViewValue = $mst_modelunit->kode->CurrentValue;
			$mst_modelunit->kode->CssStyle = "";
			$mst_modelunit->kode->CssClass = "";
			$mst_modelunit->kode->ViewCustomAttributes = "";

			// model
			$mst_modelunit->model->ViewValue = $mst_modelunit->model->CurrentValue;
			$mst_modelunit->model->CssStyle = "";
			$mst_modelunit->model->CssClass = "";
			$mst_modelunit->model->ViewCustomAttributes = "";

			// description
			$mst_modelunit->description->ViewValue = $mst_modelunit->description->CurrentValue;
			$mst_modelunit->description->CssStyle = "";
			$mst_modelunit->description->CssClass = "";
			$mst_modelunit->description->ViewCustomAttributes = "";
		} elseif ($mst_modelunit->RowType == EW_ROWTYPE_SEARCH) { // Search row
		}

		// Call Row Rendered event
		$mst_modelunit->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $mst_modelunit;

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
		global $mst_modelunit;
		$mst_modelunit->kode->AdvancedSearch->SearchValue = $mst_modelunit->getAdvancedSearch("x_kode");
		$mst_modelunit->model->AdvancedSearch->SearchValue = $mst_modelunit->getAdvancedSearch("x_model");
		$mst_modelunit->description->AdvancedSearch->SearchValue = $mst_modelunit->getAdvancedSearch("x_description");
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
