<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "logistik_stock_controlinfo.php" ?>
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
$logistik_stock_control_search = new clogistik_stock_control_search();
$Page =& $logistik_stock_control_search;

// Page init processing
$logistik_stock_control_search->Page_Init();

// Page main processing
$logistik_stock_control_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var logistik_stock_control_search = new ew_Page("logistik_stock_control_search");

// page properties
logistik_stock_control_search.PageID = "search"; // page ID
var EW_PAGE_ID = logistik_stock_control_search.PageID; // for backward compatibility

// extend page with validate function for search
logistik_stock_control_search.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_tanggal"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Tanggal");

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
logistik_stock_control_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
logistik_stock_control_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
logistik_stock_control_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
logistik_stock_control_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
logistik_stock_control_search.ShowHighlightText = "Show highlight"; 
logistik_stock_control_search.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Search <h3><b>Stock Control</b></h3><br><br>
<!--a href="<?php echo $logistik_stock_control->getReturnUrl() ?>">Back to List</a-->
<input type="button" value="Kembali" onclick="window.location='<?php echo $logistik_stock_control->getReturnUrl() ?>';">
</span></p>
<?php $logistik_stock_control_search->ShowMessage() ?>
<form name="flogistik_stock_controlsearch" id="flogistik_stock_controlsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return logistik_stock_control_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="logistik_stock_control">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $logistik_stock_control->actionlink->RowAttributes ?>>
		<td class="ewTableHeader"></td>
		<td<?php echo $logistik_stock_control->actionlink->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_actionlink" id="z_actionlink" value="LIKE"></span></td>
		<td<?php echo $logistik_stock_control->actionlink->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<textarea name="x_actionlink" id="x_actionlink" cols="35" rows="4"<?php echo $logistik_stock_control->actionlink->EditAttributes() ?>><?php echo $logistik_stock_control->actionlink->EditValue ?></textarea>
</span></td>
			</tr></table>
		</td>
	</tr>
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
$logistik_stock_control_search->Page_Terminate();
?>
<?php

//
// Page Class
//
class clogistik_stock_control_search {

	// Page ID
	var $PageID = 'search';

	// Table Name
	var $TableName = 'logistik_stock_control';

	// Page Object Name
	var $PageObjName = 'logistik_stock_control_search';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $logistik_stock_control;
		if ($logistik_stock_control->UseTokenInUrl) $PageUrl .= "t=" . $logistik_stock_control->TableVar . "&"; // add page token
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
		global $objForm, $logistik_stock_control;
		if ($logistik_stock_control->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($logistik_stock_control->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($logistik_stock_control->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function clogistik_stock_control_search() {
		global $conn;

		// Initialize table object
		$GLOBALS["logistik_stock_control"] = new clogistik_stock_control();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'logistik_stock_control', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $logistik_stock_control;

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
		global $objForm, $gsSearchError, $logistik_stock_control;
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$logistik_stock_control->CurrentAction = $objForm->GetValue("a_search");
			switch ($logistik_stock_control->CurrentAction) {
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
						$sSrchStr = $logistik_stock_control->UrlParm($sSrchStr);
						$this->Page_Terminate("logistik_stock_controllist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$logistik_stock_control->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $logistik_stock_control;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $logistik_stock_control->actionlink); // actionlink
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
		global $objForm, $logistik_stock_control;

		// Load search values
		// actionlink

		$logistik_stock_control->actionlink->AdvancedSearch->SearchValue = $objForm->GetValue("x_actionlink");
		$logistik_stock_control->actionlink->AdvancedSearch->SearchOperator = $objForm->GetValue("z_actionlink");

		// kodecek
		$logistik_stock_control->kodecek->AdvancedSearch->SearchValue = $objForm->GetValue("x_kodecek");
		$logistik_stock_control->kodecek->AdvancedSearch->SearchOperator = $objForm->GetValue("z_kodecek");

		// tanggal
		$logistik_stock_control->tanggal->AdvancedSearch->SearchValue = $objForm->GetValue("x_tanggal");
		$logistik_stock_control->tanggal->AdvancedSearch->SearchOperator = $objForm->GetValue("z_tanggal");

		// cekby
		$logistik_stock_control->cekby->AdvancedSearch->SearchValue = $objForm->GetValue("x_cekby");
		$logistik_stock_control->cekby->AdvancedSearch->SearchOperator = $objForm->GetValue("z_cekby");

		// securityby
		$logistik_stock_control->securityby->AdvancedSearch->SearchValue = $objForm->GetValue("x_securityby");
		$logistik_stock_control->securityby->AdvancedSearch->SearchOperator = $objForm->GetValue("z_securityby");

		// dirutby
		$logistik_stock_control->dirutby->AdvancedSearch->SearchValue = $objForm->GetValue("x_dirutby");
		$logistik_stock_control->dirutby->AdvancedSearch->SearchOperator = $objForm->GetValue("z_dirutby");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $logistik_stock_control;

		// Call Row_Rendering event
		$logistik_stock_control->Row_Rendering();

		// Common render codes for all row types
		// actionlink

		$logistik_stock_control->actionlink->CellCssStyle = "";
		$logistik_stock_control->actionlink->CellCssClass = "";
		if ($logistik_stock_control->RowType == EW_ROWTYPE_VIEW) { // View row

			// actionlink
			$logistik_stock_control->actionlink->ViewValue = $logistik_stock_control->actionlink->CurrentValue;
			$logistik_stock_control->actionlink->CssStyle = "";
			$logistik_stock_control->actionlink->CssClass = "";
			$logistik_stock_control->actionlink->ViewCustomAttributes = "";

			// kodecek
			$logistik_stock_control->kodecek->ViewValue = $logistik_stock_control->kodecek->CurrentValue;
			$logistik_stock_control->kodecek->CssStyle = "";
			$logistik_stock_control->kodecek->CssClass = "";
			$logistik_stock_control->kodecek->ViewCustomAttributes = "";

			// tanggal
			$logistik_stock_control->tanggal->ViewValue = $logistik_stock_control->tanggal->CurrentValue;
			$logistik_stock_control->tanggal->ViewValue = ew_FormatDateTime($logistik_stock_control->tanggal->ViewValue, 7);
			$logistik_stock_control->tanggal->CssStyle = "";
			$logistik_stock_control->tanggal->CssClass = "";
			$logistik_stock_control->tanggal->ViewCustomAttributes = "";

			// cekby
			if (strval($logistik_stock_control->cekby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_stock_control->cekby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_stock_control->cekby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_stock_control->cekby->ViewValue = $logistik_stock_control->cekby->CurrentValue;
				}
			} else {
				$logistik_stock_control->cekby->ViewValue = NULL;
			}
			$logistik_stock_control->cekby->CssStyle = "";
			$logistik_stock_control->cekby->CssClass = "";
			$logistik_stock_control->cekby->ViewCustomAttributes = "";

			// securityby
			if (strval($logistik_stock_control->securityby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_stock_control->securityby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_stock_control->securityby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_stock_control->securityby->ViewValue = $logistik_stock_control->securityby->CurrentValue;
				}
			} else {
				$logistik_stock_control->securityby->ViewValue = NULL;
			}
			$logistik_stock_control->securityby->CssStyle = "";
			$logistik_stock_control->securityby->CssClass = "";
			$logistik_stock_control->securityby->ViewCustomAttributes = "";

			// dirutby
			if (strval($logistik_stock_control->dirutby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_stock_control->dirutby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_stock_control->dirutby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_stock_control->dirutby->ViewValue = $logistik_stock_control->dirutby->CurrentValue;
				}
			} else {
				$logistik_stock_control->dirutby->ViewValue = NULL;
			}
			$logistik_stock_control->dirutby->CssStyle = "";
			$logistik_stock_control->dirutby->CssClass = "";
			$logistik_stock_control->dirutby->ViewCustomAttributes = "";

			// actionlink
			$logistik_stock_control->actionlink->HrefValue = "";
		} elseif ($logistik_stock_control->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// actionlink
			$logistik_stock_control->actionlink->EditCustomAttributes = "";
			$logistik_stock_control->actionlink->EditValue = ew_HtmlEncode($logistik_stock_control->actionlink->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		$logistik_stock_control->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $logistik_stock_control;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckEuroDate($logistik_stock_control->tanggal->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Tanggal";
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
		global $logistik_stock_control;
		$logistik_stock_control->actionlink->AdvancedSearch->SearchValue = $logistik_stock_control->getAdvancedSearch("x_actionlink");
		$logistik_stock_control->kodecek->AdvancedSearch->SearchValue = $logistik_stock_control->getAdvancedSearch("x_kodecek");
		$logistik_stock_control->tanggal->AdvancedSearch->SearchValue = $logistik_stock_control->getAdvancedSearch("x_tanggal");
		$logistik_stock_control->cekby->AdvancedSearch->SearchValue = $logistik_stock_control->getAdvancedSearch("x_cekby");
		$logistik_stock_control->securityby->AdvancedSearch->SearchValue = $logistik_stock_control->getAdvancedSearch("x_securityby");
		$logistik_stock_control->dirutby->AdvancedSearch->SearchValue = $logistik_stock_control->getAdvancedSearch("x_dirutby");
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
