<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "logistik_mrinfo.php" ?>
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
$logistik_mr_search = new clogistik_mr_search();
$Page =& $logistik_mr_search;

// Page init processing
$logistik_mr_search->Page_Init();

// Page main processing
$logistik_mr_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var logistik_mr_search = new ew_Page("logistik_mr_search");

// page properties
logistik_mr_search.PageID = "search"; // page ID
var EW_PAGE_ID = logistik_mr_search.PageID; // for backward compatibility

// extend page with validate function for search
logistik_mr_search.ValidateSearch = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	var infix = "";
	elm = fobj.elements["x" + infix + "_tanggal"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Tanggal");
	elm = fobj.elements["x" + infix + "_periode"];
	if (elm && !ew_CheckEuroDate(elm.value))
		return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Periode");

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
logistik_mr_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
logistik_mr_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
logistik_mr_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
logistik_mr_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
logistik_mr_search.ShowHighlightText = "Show highlight"; 
logistik_mr_search.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Search <h3><b>Permintaan Barang</b></h3><br><br>
<!--a href="<?php echo $logistik_mr->getReturnUrl() ?>">Back to List</a-->
<input type="button" value="Kembali" onclick="window.location='<?php echo $logistik_mr->getReturnUrl() ?>';">
</span></p>
<?php $logistik_mr_search->ShowMessage() ?>
<form name="flogistik_mrsearch" id="flogistik_mrsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return logistik_mr_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="logistik_mr">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $logistik_mr->actionlink->RowAttributes ?>>
		<td class="ewTableHeader"></td>
		<td<?php echo $logistik_mr->actionlink->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_actionlink" id="z_actionlink" value="LIKE"></span></td>
		<td<?php echo $logistik_mr->actionlink->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<textarea name="x_actionlink" id="x_actionlink" cols="35" rows="4"<?php echo $logistik_mr->actionlink->EditAttributes() ?>><?php echo $logistik_mr->actionlink->EditValue ?></textarea>
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
$logistik_mr_search->Page_Terminate();
?>
<?php

//
// Page Class
//
class clogistik_mr_search {

	// Page ID
	var $PageID = 'search';

	// Table Name
	var $TableName = 'logistik_mr';

	// Page Object Name
	var $PageObjName = 'logistik_mr_search';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $logistik_mr;
		if ($logistik_mr->UseTokenInUrl) $PageUrl .= "t=" . $logistik_mr->TableVar . "&"; // add page token
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
		global $objForm, $logistik_mr;
		if ($logistik_mr->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($logistik_mr->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($logistik_mr->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function clogistik_mr_search() {
		global $conn;

		// Initialize table object
		$GLOBALS["logistik_mr"] = new clogistik_mr();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'logistik_mr', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $logistik_mr;

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
		global $objForm, $gsSearchError, $logistik_mr;
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$logistik_mr->CurrentAction = $objForm->GetValue("a_search");
			switch ($logistik_mr->CurrentAction) {
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
						$sSrchStr = $logistik_mr->UrlParm($sSrchStr);
						$this->Page_Terminate("logistik_mrlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$logistik_mr->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $logistik_mr;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $logistik_mr->actionlink); // actionlink
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
		global $objForm, $logistik_mr;

		// Load search values
		// actionlink

		$logistik_mr->actionlink->AdvancedSearch->SearchValue = $objForm->GetValue("x_actionlink");
		$logistik_mr->actionlink->AdvancedSearch->SearchOperator = $objForm->GetValue("z_actionlink");

		// mrno
		$logistik_mr->mrno->AdvancedSearch->SearchValue = $objForm->GetValue("x_mrno");
		$logistik_mr->mrno->AdvancedSearch->SearchOperator = $objForm->GetValue("z_mrno");

		// kode_pekerjaan
		$logistik_mr->kode_pekerjaan->AdvancedSearch->SearchValue = $objForm->GetValue("x_kode_pekerjaan");
		$logistik_mr->kode_pekerjaan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_kode_pekerjaan");

		// tanggal
		$logistik_mr->tanggal->AdvancedSearch->SearchValue = $objForm->GetValue("x_tanggal");
		$logistik_mr->tanggal->AdvancedSearch->SearchOperator = $objForm->GetValue("z_tanggal");

		// periode
		$logistik_mr->periode->AdvancedSearch->SearchValue = $objForm->GetValue("x_periode");
		$logistik_mr->periode->AdvancedSearch->SearchOperator = $objForm->GetValue("z_periode");

		// gudang
		$logistik_mr->gudang->AdvancedSearch->SearchValue = $objForm->GetValue("x_gudang");
		$logistik_mr->gudang->AdvancedSearch->SearchOperator = $objForm->GetValue("z_gudang");

		// createby
		$logistik_mr->createby->AdvancedSearch->SearchValue = $objForm->GetValue("x_createby");
		$logistik_mr->createby->AdvancedSearch->SearchOperator = $objForm->GetValue("z_createby");

		// kadivkonstruksi
		$logistik_mr->kadivkonstruksi->AdvancedSearch->SearchValue = $objForm->GetValue("x_kadivkonstruksi");
		$logistik_mr->kadivkonstruksi->AdvancedSearch->SearchOperator = $objForm->GetValue("z_kadivkonstruksi");

		// qqc
		$logistik_mr->qqc->AdvancedSearch->SearchValue = $objForm->GetValue("x_qqc");
		$logistik_mr->qqc->AdvancedSearch->SearchOperator = $objForm->GetValue("z_qqc");

		// kalogistik
		$logistik_mr->kalogistik->AdvancedSearch->SearchValue = $objForm->GetValue("x_kalogistik");
		$logistik_mr->kalogistik->AdvancedSearch->SearchOperator = $objForm->GetValue("z_kalogistik");

		// sitemgr
		$logistik_mr->sitemgr->AdvancedSearch->SearchValue = $objForm->GetValue("x_sitemgr");
		$logistik_mr->sitemgr->AdvancedSearch->SearchOperator = $objForm->GetValue("z_sitemgr");

		// sitelogistik
		$logistik_mr->sitelogistik->AdvancedSearch->SearchValue = $objForm->GetValue("x_sitelogistik");
		$logistik_mr->sitelogistik->AdvancedSearch->SearchOperator = $objForm->GetValue("z_sitelogistik");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $logistik_mr;

		// Call Row_Rendering event
		$logistik_mr->Row_Rendering();

		// Common render codes for all row types
		// actionlink

		$logistik_mr->actionlink->CellCssStyle = "";
		$logistik_mr->actionlink->CellCssClass = "";
		if ($logistik_mr->RowType == EW_ROWTYPE_VIEW) { // View row

			// actionlink
			$logistik_mr->actionlink->ViewValue = $logistik_mr->actionlink->CurrentValue;
			$logistik_mr->actionlink->CssStyle = "";
			$logistik_mr->actionlink->CssClass = "";
			$logistik_mr->actionlink->ViewCustomAttributes = "";

			// mrno
			$logistik_mr->mrno->ViewValue = $logistik_mr->mrno->CurrentValue;
			$logistik_mr->mrno->CssStyle = "";
			$logistik_mr->mrno->CssClass = "";
			$logistik_mr->mrno->ViewCustomAttributes = "";

			// kode_pekerjaan
			$logistik_mr->kode_pekerjaan->ViewValue = $logistik_mr->kode_pekerjaan->CurrentValue;
			$logistik_mr->kode_pekerjaan->CssStyle = "";
			$logistik_mr->kode_pekerjaan->CssClass = "";
			$logistik_mr->kode_pekerjaan->ViewCustomAttributes = "";

			// tanggal
			$logistik_mr->tanggal->ViewValue = $logistik_mr->tanggal->CurrentValue;
			$logistik_mr->tanggal->ViewValue = ew_FormatDateTime($logistik_mr->tanggal->ViewValue, 7);
			$logistik_mr->tanggal->CssStyle = "";
			$logistik_mr->tanggal->CssClass = "";
			$logistik_mr->tanggal->ViewCustomAttributes = "";

			// periode
			$logistik_mr->periode->ViewValue = $logistik_mr->periode->CurrentValue;
			$logistik_mr->periode->ViewValue = ew_FormatDateTime($logistik_mr->periode->ViewValue, 7);
			$logistik_mr->periode->CssStyle = "";
			$logistik_mr->periode->CssClass = "";
			$logistik_mr->periode->ViewCustomAttributes = "";

			// gudang
			if (strval($logistik_mr->gudang->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama`, `alamat` FROM `mst_gudang` WHERE `kode` = '" . ew_AdjustSql($logistik_mr->gudang->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_mr->gudang->ViewValue = $rswrk->fields('nama');
					$logistik_mr->gudang->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('alamat');
					$rswrk->Close();
				} else {
					$logistik_mr->gudang->ViewValue = $logistik_mr->gudang->CurrentValue;
				}
			} else {
				$logistik_mr->gudang->ViewValue = NULL;
			}
			$logistik_mr->gudang->CssStyle = "";
			$logistik_mr->gudang->CssClass = "";
			$logistik_mr->gudang->ViewCustomAttributes = "";

			// createby
			if (strval($logistik_mr->createby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_mr->createby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_mr->createby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_mr->createby->ViewValue = $logistik_mr->createby->CurrentValue;
				}
			} else {
				$logistik_mr->createby->ViewValue = NULL;
			}
			$logistik_mr->createby->CssStyle = "";
			$logistik_mr->createby->CssClass = "";
			$logistik_mr->createby->ViewCustomAttributes = "";

			// kadivkonstruksi
			if (strval($logistik_mr->kadivkonstruksi->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_mr->kadivkonstruksi->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_mr->kadivkonstruksi->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_mr->kadivkonstruksi->ViewValue = $logistik_mr->kadivkonstruksi->CurrentValue;
				}
			} else {
				$logistik_mr->kadivkonstruksi->ViewValue = NULL;
			}
			$logistik_mr->kadivkonstruksi->CssStyle = "";
			$logistik_mr->kadivkonstruksi->CssClass = "";
			$logistik_mr->kadivkonstruksi->ViewCustomAttributes = "";

			// qqc
			if (strval($logistik_mr->qqc->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_mr->qqc->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_mr->qqc->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_mr->qqc->ViewValue = $logistik_mr->qqc->CurrentValue;
				}
			} else {
				$logistik_mr->qqc->ViewValue = NULL;
			}
			$logistik_mr->qqc->CssStyle = "";
			$logistik_mr->qqc->CssClass = "";
			$logistik_mr->qqc->ViewCustomAttributes = "";

			// kalogistik
			if (strval($logistik_mr->kalogistik->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_mr->kalogistik->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_mr->kalogistik->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_mr->kalogistik->ViewValue = $logistik_mr->kalogistik->CurrentValue;
				}
			} else {
				$logistik_mr->kalogistik->ViewValue = NULL;
			}
			$logistik_mr->kalogistik->CssStyle = "";
			$logistik_mr->kalogistik->CssClass = "";
			$logistik_mr->kalogistik->ViewCustomAttributes = "";

			// sitemgr
			if (strval($logistik_mr->sitemgr->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_mr->sitemgr->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_mr->sitemgr->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_mr->sitemgr->ViewValue = $logistik_mr->sitemgr->CurrentValue;
				}
			} else {
				$logistik_mr->sitemgr->ViewValue = NULL;
			}
			$logistik_mr->sitemgr->CssStyle = "";
			$logistik_mr->sitemgr->CssClass = "";
			$logistik_mr->sitemgr->ViewCustomAttributes = "";

			// sitelogistik
			if (strval($logistik_mr->sitelogistik->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_mr->sitelogistik->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_mr->sitelogistik->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_mr->sitelogistik->ViewValue = $logistik_mr->sitelogistik->CurrentValue;
				}
			} else {
				$logistik_mr->sitelogistik->ViewValue = NULL;
			}
			$logistik_mr->sitelogistik->CssStyle = "";
			$logistik_mr->sitelogistik->CssClass = "";
			$logistik_mr->sitelogistik->ViewCustomAttributes = "";

			// actionlink
			$logistik_mr->actionlink->HrefValue = "";
		} elseif ($logistik_mr->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// actionlink
			$logistik_mr->actionlink->EditCustomAttributes = "";
			$logistik_mr->actionlink->EditValue = ew_HtmlEncode($logistik_mr->actionlink->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		$logistik_mr->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $logistik_mr;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckEuroDate($logistik_mr->tanggal->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Tanggal";
		}
		if (!ew_CheckEuroDate($logistik_mr->periode->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= "Incorrect date, format = dd/mm/yyyy - Periode";
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
		global $logistik_mr;
		$logistik_mr->actionlink->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_actionlink");
		$logistik_mr->mrno->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_mrno");
		$logistik_mr->kode_pekerjaan->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_kode_pekerjaan");
		$logistik_mr->tanggal->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_tanggal");
		$logistik_mr->periode->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_periode");
		$logistik_mr->gudang->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_gudang");
		$logistik_mr->createby->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_createby");
		$logistik_mr->kadivkonstruksi->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_kadivkonstruksi");
		$logistik_mr->qqc->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_qqc");
		$logistik_mr->kalogistik->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_kalogistik");
		$logistik_mr->sitemgr->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_sitemgr");
		$logistik_mr->sitelogistik->AdvancedSearch->SearchValue = $logistik_mr->getAdvancedSearch("x_sitelogistik");
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
