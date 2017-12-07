<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "logistik_stokinfo.php" ?>
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
$logistik_stok_search = new clogistik_stok_search();
$Page =& $logistik_stok_search;

// Page init processing
$logistik_stok_search->Page_Init();

// Page main processing
$logistik_stok_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var logistik_stok_search = new ew_Page("logistik_stok_search");

// page properties
logistik_stok_search.PageID = "search"; // page ID
var EW_PAGE_ID = logistik_stok_search.PageID; // for backward compatibility

// extend page with validate function for search
logistik_stok_search.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_seqno"];
	if (elm && !ew_CheckInteger(elm.value))
		return ew_OnError(this, elm, "Incorrect integer - Seqno");
	elm = fobj.elements["x" + infix + "_stock"];
	if (elm && !ew_CheckNumber(elm.value))
		return ew_OnError(this, elm, "Incorrect floating point number - Stok");

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
logistik_stok_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
logistik_stok_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
logistik_stok_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
logistik_stok_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
logistik_stok_search.ShowHighlightText = "Show highlight"; 
logistik_stok_search.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Search <h3><b>Stock Logistik</b></h3><br><br>
<!--a href="<?php echo $logistik_stok->getReturnUrl() ?>">Back to List</a-->
<input type="button" value="Kembali" onclick="window.location='<?php echo $logistik_stok->getReturnUrl() ?>';">
</span></p>
<?php $logistik_stok_search->ShowMessage() ?>
<form name="flogistik_stoksearch" id="flogistik_stoksearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return logistik_stok_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="logistik_stok">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $logistik_stok->actionlink->RowAttributes ?>>
		<td class="ewTableHeader">actionlink</td>
		<td<?php echo $logistik_stok->actionlink->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_actionlink" id="z_actionlink" value="LIKE"></span></td>
		<td<?php echo $logistik_stok->actionlink->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<textarea name="x_actionlink" id="x_actionlink" cols="35" rows="4"<?php echo $logistik_stok->actionlink->EditAttributes() ?>><?php echo $logistik_stok->actionlink->EditValue ?></textarea>
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
$logistik_stok_search->Page_Terminate();
?>
<?php

//
// Page Class
//
class clogistik_stok_search {

	// Page ID
	var $PageID = 'search';

	// Table Name
	var $TableName = 'logistik_stok';

	// Page Object Name
	var $PageObjName = 'logistik_stok_search';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $logistik_stok;
		if ($logistik_stok->UseTokenInUrl) $PageUrl .= "t=" . $logistik_stok->TableVar . "&"; // add page token
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
		global $objForm, $logistik_stok;
		if ($logistik_stok->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($logistik_stok->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($logistik_stok->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function clogistik_stok_search() {
		global $conn;

		// Initialize table object
		$GLOBALS["logistik_stok"] = new clogistik_stok();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'logistik_stok', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $logistik_stok;

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
		global $objForm, $gsSearchError, $logistik_stok;
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$logistik_stok->CurrentAction = $objForm->GetValue("a_search");
			switch ($logistik_stok->CurrentAction) {
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
						$sSrchStr = $logistik_stok->UrlParm($sSrchStr);
						$this->Page_Terminate("logistik_stoklist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$logistik_stok->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $logistik_stok;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $logistik_stok->actionlink); // actionlink
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
		global $objForm, $logistik_stok;

		// Load search values
		// actionlink

		$logistik_stok->actionlink->AdvancedSearch->SearchValue = $objForm->GetValue("x_actionlink");
		$logistik_stok->actionlink->AdvancedSearch->SearchOperator = $objForm->GetValue("z_actionlink");

		// seqno
		$logistik_stok->seqno->AdvancedSearch->SearchValue = $objForm->GetValue("x_seqno");
		$logistik_stok->seqno->AdvancedSearch->SearchOperator = $objForm->GetValue("z_seqno");

		// branchid
		$logistik_stok->branchid->AdvancedSearch->SearchValue = $objForm->GetValue("x_branchid");
		$logistik_stok->branchid->AdvancedSearch->SearchOperator = $objForm->GetValue("z_branchid");

		// kodebarang
		$logistik_stok->kodebarang->AdvancedSearch->SearchValue = $objForm->GetValue("x_kodebarang");
		$logistik_stok->kodebarang->AdvancedSearch->SearchOperator = $objForm->GetValue("z_kodebarang");

		// stock
		$logistik_stok->stock->AdvancedSearch->SearchValue = $objForm->GetValue("x_stock");
		$logistik_stok->stock->AdvancedSearch->SearchOperator = $objForm->GetValue("z_stock");

		// createby
		$logistik_stok->createby->AdvancedSearch->SearchValue = $objForm->GetValue("x_createby");
		$logistik_stok->createby->AdvancedSearch->SearchOperator = $objForm->GetValue("z_createby");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $logistik_stok;

		// Call Row_Rendering event
		$logistik_stok->Row_Rendering();

		// Common render codes for all row types
		// actionlink

		$logistik_stok->actionlink->CellCssStyle = "";
		$logistik_stok->actionlink->CellCssClass = "";
		if ($logistik_stok->RowType == EW_ROWTYPE_VIEW) { // View row

			// actionlink
			$logistik_stok->actionlink->ViewValue = $logistik_stok->actionlink->CurrentValue;
			$logistik_stok->actionlink->CssStyle = "";
			$logistik_stok->actionlink->CssClass = "";
			$logistik_stok->actionlink->ViewCustomAttributes = "";

			// seqno
			$logistik_stok->seqno->ViewValue = $logistik_stok->seqno->CurrentValue;
			$logistik_stok->seqno->CssStyle = "";
			$logistik_stok->seqno->CssClass = "";
			$logistik_stok->seqno->ViewCustomAttributes = "";

			// branchid
			if (strval($logistik_stok->branchid->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama`, `alamat` FROM `mst_gudang` WHERE `kode` = '" . ew_AdjustSql($logistik_stok->branchid->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_stok->branchid->ViewValue = $rswrk->fields('nama');
					$logistik_stok->branchid->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('alamat');
					$rswrk->Close();
				} else {
					$logistik_stok->branchid->ViewValue = $logistik_stok->branchid->CurrentValue;
				}
			} else {
				$logistik_stok->branchid->ViewValue = NULL;
			}
			$logistik_stok->branchid->CssStyle = "";
			$logistik_stok->branchid->CssClass = "";
			$logistik_stok->branchid->ViewCustomAttributes = "";

			// kodebarang
			$logistik_stok->kodebarang->ViewValue = $logistik_stok->kodebarang->CurrentValue;
			$logistik_stok->kodebarang->CssStyle = "";
			$logistik_stok->kodebarang->CssClass = "";
			$logistik_stok->kodebarang->ViewCustomAttributes = "";

			// stock
			$logistik_stok->stock->ViewValue = $logistik_stok->stock->CurrentValue;
			$logistik_stok->stock->CssStyle = "";
			$logistik_stok->stock->CssClass = "";
			$logistik_stok->stock->ViewCustomAttributes = "";

			// createby
			if (strval($logistik_stok->createby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_stok->createby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_stok->createby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_stok->createby->ViewValue = $logistik_stok->createby->CurrentValue;
				}
			} else {
				$logistik_stok->createby->ViewValue = NULL;
			}
			$logistik_stok->createby->CssStyle = "";
			$logistik_stok->createby->CssClass = "";
			$logistik_stok->createby->ViewCustomAttributes = "";

			// actionlink
			$logistik_stok->actionlink->HrefValue = "";
		} elseif ($logistik_stok->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// actionlink
			$logistik_stok->actionlink->EditCustomAttributes = "";
			$logistik_stok->actionlink->EditValue = ew_HtmlEncode($logistik_stok->actionlink->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		$logistik_stok->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $logistik_stok;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($logistik_stok->seqno->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect integer - Seqno";
		}
		if (!ew_CheckNumber($logistik_stok->stock->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect floating point number - Stok";
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
		global $logistik_stok;
		$logistik_stok->actionlink->AdvancedSearch->SearchValue = $logistik_stok->getAdvancedSearch("x_actionlink");
		$logistik_stok->seqno->AdvancedSearch->SearchValue = $logistik_stok->getAdvancedSearch("x_seqno");
		$logistik_stok->branchid->AdvancedSearch->SearchValue = $logistik_stok->getAdvancedSearch("x_branchid");
		$logistik_stok->kodebarang->AdvancedSearch->SearchValue = $logistik_stok->getAdvancedSearch("x_kodebarang");
		$logistik_stok->stock->AdvancedSearch->SearchValue = $logistik_stok->getAdvancedSearch("x_stock");
		$logistik_stok->createby->AdvancedSearch->SearchValue = $logistik_stok->getAdvancedSearch("x_createby");
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
