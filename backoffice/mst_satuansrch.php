<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_satuaninfo.php" ?>
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
$mst_satuan_search = new cmst_satuan_search();
$Page =& $mst_satuan_search;

// Page init processing
$mst_satuan_search->Page_Init();

// Page main processing
$mst_satuan_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mst_satuan_search = new ew_Page("mst_satuan_search");

// page properties
mst_satuan_search.PageID = "search"; // page ID
var EW_PAGE_ID = mst_satuan_search.PageID; // for backward compatibility

// extend page with validate function for search
mst_satuan_search.ValidateSearch = function(fobj) {
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
mst_satuan_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
mst_satuan_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_satuan_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_satuan_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
mst_satuan_search.ShowHighlightText = "Show highlight"; 
mst_satuan_search.HideHighlightText = "Hide highlight";

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">Search <h3><b>Master Satuan</b></h3><br><br>
<!--a href="<?php echo $mst_satuan->getReturnUrl() ?>">Back to List</a-->
<input type="button" value="Kembali" onclick="window.location='<?php echo $mst_satuan->getReturnUrl() ?>';">
</span></p>
<?php $mst_satuan_search->ShowMessage() ?>
<form name="fmst_satuansearch" id="fmst_satuansearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return mst_satuan_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="mst_satuan">
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
$mst_satuan_search->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_satuan_search {

	// Page ID
	var $PageID = 'search';

	// Table Name
	var $TableName = 'mst_satuan';

	// Page Object Name
	var $PageObjName = 'mst_satuan_search';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_satuan;
		if ($mst_satuan->UseTokenInUrl) $PageUrl .= "t=" . $mst_satuan->TableVar . "&"; // add page token
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
		global $objForm, $mst_satuan;
		if ($mst_satuan->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_satuan->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_satuan->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_satuan_search() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_satuan"] = new cmst_satuan();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_satuan', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_satuan;

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
		global $objForm, $gsSearchError, $mst_satuan;
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$mst_satuan->CurrentAction = $objForm->GetValue("a_search");
			switch ($mst_satuan->CurrentAction) {
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
						$sSrchStr = $mst_satuan->UrlParm($sSrchStr);
						$this->Page_Terminate("mst_satuanlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$mst_satuan->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $mst_satuan;
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
		global $objForm, $mst_satuan;

		// Load search values
		// kode

		$mst_satuan->kode->AdvancedSearch->SearchValue = $objForm->GetValue("x_kode");
		$mst_satuan->kode->AdvancedSearch->SearchOperator = $objForm->GetValue("z_kode");

		// satuan
		$mst_satuan->satuan->AdvancedSearch->SearchValue = $objForm->GetValue("x_satuan");
		$mst_satuan->satuan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_satuan");

		// singkatan
		$mst_satuan->singkatan->AdvancedSearch->SearchValue = $objForm->GetValue("x_singkatan");
		$mst_satuan->singkatan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_singkatan");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_satuan;

		// Call Row_Rendering event
		$mst_satuan->Row_Rendering();

		// Common render codes for all row types
		if ($mst_satuan->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$mst_satuan->kode->ViewValue = $mst_satuan->kode->CurrentValue;
			$mst_satuan->kode->CssStyle = "";
			$mst_satuan->kode->CssClass = "";
			$mst_satuan->kode->ViewCustomAttributes = "";

			// satuan
			$mst_satuan->satuan->ViewValue = $mst_satuan->satuan->CurrentValue;
			$mst_satuan->satuan->CssStyle = "";
			$mst_satuan->satuan->CssClass = "";
			$mst_satuan->satuan->ViewCustomAttributes = "";

			// singkatan
			$mst_satuan->singkatan->ViewValue = $mst_satuan->singkatan->CurrentValue;
			$mst_satuan->singkatan->CssStyle = "";
			$mst_satuan->singkatan->CssClass = "";
			$mst_satuan->singkatan->ViewCustomAttributes = "";
		} elseif ($mst_satuan->RowType == EW_ROWTYPE_SEARCH) { // Search row
		}

		// Call Row Rendered event
		$mst_satuan->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $mst_satuan;

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
		global $mst_satuan;
		$mst_satuan->kode->AdvancedSearch->SearchValue = $mst_satuan->getAdvancedSearch("x_kode");
		$mst_satuan->satuan->AdvancedSearch->SearchValue = $mst_satuan->getAdvancedSearch("x_satuan");
		$mst_satuan->singkatan->AdvancedSearch->SearchValue = $mst_satuan->getAdvancedSearch("x_singkatan");
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
