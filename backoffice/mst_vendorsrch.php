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
$mst_vendor_search = new cmst_vendor_search();
$Page =& $mst_vendor_search;

// Page init processing
$mst_vendor_search->Page_Init();

// Page main processing
$mst_vendor_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mst_vendor_search = new ew_Page("mst_vendor_search");

// page properties
mst_vendor_search.PageID = "search"; // page ID
var EW_PAGE_ID = mst_vendor_search.PageID; // for backward compatibility

// extend page with validate function for search
mst_vendor_search.ValidateSearch = function(fobj) {
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
mst_vendor_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
mst_vendor_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_vendor_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_vendor_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
mst_vendor_search.ShowHighlightText = "Show highlight"; 
mst_vendor_search.HideHighlightText = "Hide highlight";

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">Search <h3><b>Master Vendor</b></h3><br><br>
<!--a href="<?php echo $mst_vendor->getReturnUrl() ?>">Back to List</a-->
<input type="button" value="Kembali" onclick="window.location='<?php echo $mst_vendor->getReturnUrl() ?>';">
</span></p>
<?php $mst_vendor_search->ShowMessage() ?>
<form name="fmst_vendorsearch" id="fmst_vendorsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return mst_vendor_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="mst_vendor">
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
$mst_vendor_search->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_vendor_search {

	// Page ID
	var $PageID = 'search';

	// Table Name
	var $TableName = 'mst_vendor';

	// Page Object Name
	var $PageObjName = 'mst_vendor_search';

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
	function cmst_vendor_search() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_vendor"] = new cmst_vendor();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_vendor', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_vendor;

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
		global $objForm, $gsSearchError, $mst_vendor;
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$mst_vendor->CurrentAction = $objForm->GetValue("a_search");
			switch ($mst_vendor->CurrentAction) {
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
						$sSrchStr = $mst_vendor->UrlParm($sSrchStr);
						$this->Page_Terminate("mst_vendorlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$mst_vendor->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $mst_vendor;
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
		global $objForm, $mst_vendor;

		// Load search values
		// kode

		$mst_vendor->kode->AdvancedSearch->SearchValue = $objForm->GetValue("x_kode");
		$mst_vendor->kode->AdvancedSearch->SearchOperator = $objForm->GetValue("z_kode");

		// nama
		$mst_vendor->nama->AdvancedSearch->SearchValue = $objForm->GetValue("x_nama");
		$mst_vendor->nama->AdvancedSearch->SearchOperator = $objForm->GetValue("z_nama");

		// npwp
		$mst_vendor->npwp->AdvancedSearch->SearchValue = $objForm->GetValue("x_npwp");
		$mst_vendor->npwp->AdvancedSearch->SearchOperator = $objForm->GetValue("z_npwp");

		// pic
		$mst_vendor->pic->AdvancedSearch->SearchValue = $objForm->GetValue("x_pic");
		$mst_vendor->pic->AdvancedSearch->SearchOperator = $objForm->GetValue("z_pic");

		// phone
		$mst_vendor->phone->AdvancedSearch->SearchValue = $objForm->GetValue("x_phone");
		$mst_vendor->phone->AdvancedSearch->SearchOperator = $objForm->GetValue("z_phone");

		// fax
		$mst_vendor->fax->AdvancedSearch->SearchValue = $objForm->GetValue("x_fax");
		$mst_vendor->fax->AdvancedSearch->SearchOperator = $objForm->GetValue("z_fax");

		// email
		$mst_vendor->zemail->AdvancedSearch->SearchValue = $objForm->GetValue("x_zemail");
		$mst_vendor->zemail->AdvancedSearch->SearchOperator = $objForm->GetValue("z_zemail");

		// peruntukan
		$mst_vendor->peruntukan->AdvancedSearch->SearchValue = $objForm->GetValue("x_peruntukan");
		$mst_vendor->peruntukan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_peruntukan");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_vendor;

		// Call Row_Rendering event
		$mst_vendor->Row_Rendering();

		// Common render codes for all row types
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
		} elseif ($mst_vendor->RowType == EW_ROWTYPE_SEARCH) { // Search row
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
