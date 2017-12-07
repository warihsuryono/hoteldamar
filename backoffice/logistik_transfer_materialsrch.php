<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "logistik_transfer_materialinfo.php" ?>
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
$logistik_transfer_material_search = new clogistik_transfer_material_search();
$Page =& $logistik_transfer_material_search;

// Page init processing
$logistik_transfer_material_search->Page_Init();

// Page main processing
$logistik_transfer_material_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var logistik_transfer_material_search = new ew_Page("logistik_transfer_material_search");

// page properties
logistik_transfer_material_search.PageID = "search"; // page ID
var EW_PAGE_ID = logistik_transfer_material_search.PageID; // for backward compatibility

// extend page with validate function for search
logistik_transfer_material_search.ValidateSearch = function(fobj) {
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
logistik_transfer_material_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
logistik_transfer_material_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
logistik_transfer_material_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
logistik_transfer_material_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
logistik_transfer_material_search.ShowHighlightText = "Show highlight"; 
logistik_transfer_material_search.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Search <h3><b>Pengeluaran Barang</b></h3><br><br>
<!--a href="<?php echo $logistik_transfer_material->getReturnUrl() ?>">Back to List</a-->
<input type="button" value="Kembali" onclick="window.location='<?php echo $logistik_transfer_material->getReturnUrl() ?>';">
</span></p>
<?php $logistik_transfer_material_search->ShowMessage() ?>
<form name="flogistik_transfer_materialsearch" id="flogistik_transfer_materialsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return logistik_transfer_material_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="logistik_transfer_material">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $logistik_transfer_material->actionlink->RowAttributes ?>>
		<td class="ewTableHeader"></td>
		<td<?php echo $logistik_transfer_material->actionlink->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_actionlink" id="z_actionlink" value="LIKE"></span></td>
		<td<?php echo $logistik_transfer_material->actionlink->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<textarea name="x_actionlink" id="x_actionlink" cols="35" rows="4"<?php echo $logistik_transfer_material->actionlink->EditAttributes() ?>><?php echo $logistik_transfer_material->actionlink->EditValue ?></textarea>
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
$logistik_transfer_material_search->Page_Terminate();
?>
<?php

//
// Page Class
//
class clogistik_transfer_material_search {

	// Page ID
	var $PageID = 'search';

	// Table Name
	var $TableName = 'logistik_transfer_material';

	// Page Object Name
	var $PageObjName = 'logistik_transfer_material_search';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $logistik_transfer_material;
		if ($logistik_transfer_material->UseTokenInUrl) $PageUrl .= "t=" . $logistik_transfer_material->TableVar . "&"; // add page token
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
		global $objForm, $logistik_transfer_material;
		if ($logistik_transfer_material->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($logistik_transfer_material->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($logistik_transfer_material->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function clogistik_transfer_material_search() {
		global $conn;

		// Initialize table object
		$GLOBALS["logistik_transfer_material"] = new clogistik_transfer_material();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'logistik_transfer_material', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $logistik_transfer_material;

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
		global $objForm, $gsSearchError, $logistik_transfer_material;
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$logistik_transfer_material->CurrentAction = $objForm->GetValue("a_search");
			switch ($logistik_transfer_material->CurrentAction) {
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
						$sSrchStr = $logistik_transfer_material->UrlParm($sSrchStr);
						$this->Page_Terminate("logistik_transfer_materiallist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$logistik_transfer_material->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $logistik_transfer_material;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $logistik_transfer_material->actionlink); // actionlink
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
		global $objForm, $logistik_transfer_material;

		// Load search values
		// actionlink

		$logistik_transfer_material->actionlink->AdvancedSearch->SearchValue = $objForm->GetValue("x_actionlink");
		$logistik_transfer_material->actionlink->AdvancedSearch->SearchOperator = $objForm->GetValue("z_actionlink");

		// transkode
		$logistik_transfer_material->transkode->AdvancedSearch->SearchValue = $objForm->GetValue("x_transkode");
		$logistik_transfer_material->transkode->AdvancedSearch->SearchOperator = $objForm->GetValue("z_transkode");

		// tanggal
		$logistik_transfer_material->tanggal->AdvancedSearch->SearchValue = $objForm->GetValue("x_tanggal");
		$logistik_transfer_material->tanggal->AdvancedSearch->SearchOperator = $objForm->GetValue("z_tanggal");

		// kode_pekerjaan
		$logistik_transfer_material->kode_pekerjaan->AdvancedSearch->SearchValue = $objForm->GetValue("x_kode_pekerjaan");
		$logistik_transfer_material->kode_pekerjaan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_kode_pekerjaan");

		// ambilby
		$logistik_transfer_material->ambilby->AdvancedSearch->SearchValue = $objForm->GetValue("x_ambilby");
		$logistik_transfer_material->ambilby->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ambilby");

		// beriby
		$logistik_transfer_material->beriby->AdvancedSearch->SearchValue = $objForm->GetValue("x_beriby");
		$logistik_transfer_material->beriby->AdvancedSearch->SearchOperator = $objForm->GetValue("z_beriby");

		// tahuby
		$logistik_transfer_material->tahuby->AdvancedSearch->SearchValue = $objForm->GetValue("x_tahuby");
		$logistik_transfer_material->tahuby->AdvancedSearch->SearchOperator = $objForm->GetValue("z_tahuby");

		// setujuby
		$logistik_transfer_material->setujuby->AdvancedSearch->SearchValue = $objForm->GetValue("x_setujuby");
		$logistik_transfer_material->setujuby->AdvancedSearch->SearchOperator = $objForm->GetValue("z_setujuby");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $logistik_transfer_material;

		// Call Row_Rendering event
		$logistik_transfer_material->Row_Rendering();

		// Common render codes for all row types
		// actionlink

		$logistik_transfer_material->actionlink->CellCssStyle = "";
		$logistik_transfer_material->actionlink->CellCssClass = "";
		if ($logistik_transfer_material->RowType == EW_ROWTYPE_VIEW) { // View row

			// actionlink
			$logistik_transfer_material->actionlink->ViewValue = $logistik_transfer_material->actionlink->CurrentValue;
			$logistik_transfer_material->actionlink->CssStyle = "";
			$logistik_transfer_material->actionlink->CssClass = "";
			$logistik_transfer_material->actionlink->ViewCustomAttributes = "";

			// transkode
			$logistik_transfer_material->transkode->ViewValue = $logistik_transfer_material->transkode->CurrentValue;
			$logistik_transfer_material->transkode->CssStyle = "";
			$logistik_transfer_material->transkode->CssClass = "";
			$logistik_transfer_material->transkode->ViewCustomAttributes = "";

			// tanggal
			$logistik_transfer_material->tanggal->ViewValue = $logistik_transfer_material->tanggal->CurrentValue;
			$logistik_transfer_material->tanggal->ViewValue = ew_FormatDateTime($logistik_transfer_material->tanggal->ViewValue, 7);
			$logistik_transfer_material->tanggal->CssStyle = "";
			$logistik_transfer_material->tanggal->CssClass = "";
			$logistik_transfer_material->tanggal->ViewCustomAttributes = "";

			// kode_pekerjaan
			$logistik_transfer_material->kode_pekerjaan->ViewValue = $logistik_transfer_material->kode_pekerjaan->CurrentValue;
			$logistik_transfer_material->kode_pekerjaan->CssStyle = "";
			$logistik_transfer_material->kode_pekerjaan->CssClass = "";
			$logistik_transfer_material->kode_pekerjaan->ViewCustomAttributes = "";

			// ambilby
			if (strval($logistik_transfer_material->ambilby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_transfer_material->ambilby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_transfer_material->ambilby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_transfer_material->ambilby->ViewValue = $logistik_transfer_material->ambilby->CurrentValue;
				}
			} else {
				$logistik_transfer_material->ambilby->ViewValue = NULL;
			}
			$logistik_transfer_material->ambilby->CssStyle = "";
			$logistik_transfer_material->ambilby->CssClass = "";
			$logistik_transfer_material->ambilby->ViewCustomAttributes = "";

			// beriby
			if (strval($logistik_transfer_material->beriby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_transfer_material->beriby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_transfer_material->beriby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_transfer_material->beriby->ViewValue = $logistik_transfer_material->beriby->CurrentValue;
				}
			} else {
				$logistik_transfer_material->beriby->ViewValue = NULL;
			}
			$logistik_transfer_material->beriby->CssStyle = "";
			$logistik_transfer_material->beriby->CssClass = "";
			$logistik_transfer_material->beriby->ViewCustomAttributes = "";

			// tahuby
			if (strval($logistik_transfer_material->tahuby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_transfer_material->tahuby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_transfer_material->tahuby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_transfer_material->tahuby->ViewValue = $logistik_transfer_material->tahuby->CurrentValue;
				}
			} else {
				$logistik_transfer_material->tahuby->ViewValue = NULL;
			}
			$logistik_transfer_material->tahuby->CssStyle = "";
			$logistik_transfer_material->tahuby->CssClass = "";
			$logistik_transfer_material->tahuby->ViewCustomAttributes = "";

			// setujuby
			if (strval($logistik_transfer_material->setujuby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_transfer_material->setujuby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_transfer_material->setujuby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_transfer_material->setujuby->ViewValue = $logistik_transfer_material->setujuby->CurrentValue;
				}
			} else {
				$logistik_transfer_material->setujuby->ViewValue = NULL;
			}
			$logistik_transfer_material->setujuby->CssStyle = "";
			$logistik_transfer_material->setujuby->CssClass = "";
			$logistik_transfer_material->setujuby->ViewCustomAttributes = "";

			// actionlink
			$logistik_transfer_material->actionlink->HrefValue = "";
		} elseif ($logistik_transfer_material->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// actionlink
			$logistik_transfer_material->actionlink->EditCustomAttributes = "";
			$logistik_transfer_material->actionlink->EditValue = ew_HtmlEncode($logistik_transfer_material->actionlink->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		$logistik_transfer_material->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $logistik_transfer_material;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckEuroDate($logistik_transfer_material->tanggal->AdvancedSearch->SearchValue)) {
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
		global $logistik_transfer_material;
		$logistik_transfer_material->actionlink->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_actionlink");
		$logistik_transfer_material->transkode->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_transkode");
		$logistik_transfer_material->tanggal->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_tanggal");
		$logistik_transfer_material->kode_pekerjaan->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_kode_pekerjaan");
		$logistik_transfer_material->ambilby->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_ambilby");
		$logistik_transfer_material->beriby->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_beriby");
		$logistik_transfer_material->tahuby->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_tahuby");
		$logistik_transfer_material->setujuby->AdvancedSearch->SearchValue = $logistik_transfer_material->getAdvancedSearch("x_setujuby");
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
