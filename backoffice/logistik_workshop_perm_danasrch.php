<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "logistik_workshop_perm_danainfo.php" ?>
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
$logistik_workshop_perm_dana_search = new clogistik_workshop_perm_dana_search();
$Page =& $logistik_workshop_perm_dana_search;

// Page init processing
$logistik_workshop_perm_dana_search->Page_Init();

// Page main processing
$logistik_workshop_perm_dana_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var logistik_workshop_perm_dana_search = new ew_Page("logistik_workshop_perm_dana_search");

// page properties
logistik_workshop_perm_dana_search.PageID = "search"; // page ID
var EW_PAGE_ID = logistik_workshop_perm_dana_search.PageID; // for backward compatibility

// extend page with validate function for search
logistik_workshop_perm_dana_search.ValidateSearch = function(fobj) {
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
logistik_workshop_perm_dana_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
logistik_workshop_perm_dana_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
logistik_workshop_perm_dana_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
logistik_workshop_perm_dana_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
logistik_workshop_perm_dana_search.ShowHighlightText = "Show highlight"; 
logistik_workshop_perm_dana_search.HideHighlightText = "Hide highlight";

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
<p><span class="phpmaker">Search <h3><b>Permohonan Dana (Workshop)</b></h3><br><br>
<!--a href="<?php echo $logistik_workshop_perm_dana->getReturnUrl() ?>">Back to List</a-->
<input type="button" value="Kembali" onclick="window.location='<?php echo $logistik_workshop_perm_dana->getReturnUrl() ?>';">
</span></p>
<?php $logistik_workshop_perm_dana_search->ShowMessage() ?>
<form name="flogistik_workshop_perm_danasearch" id="flogistik_workshop_perm_danasearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return logistik_workshop_perm_dana_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="logistik_workshop_perm_dana">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $logistik_workshop_perm_dana->actionlink->RowAttributes ?>>
		<td class="ewTableHeader"></td>
		<td<?php echo $logistik_workshop_perm_dana->actionlink->CellAttributes() ?>><span class="ewSearchOpr">contains<input type="hidden" name="z_actionlink" id="z_actionlink" value="LIKE"></span></td>
		<td<?php echo $logistik_workshop_perm_dana->actionlink->CellAttributes() ?>>
			<table cellspacing="0" class="ewItemTable"><tr>
				<td><span class="phpmaker">
<textarea name="x_actionlink" id="x_actionlink" cols="35" rows="4"<?php echo $logistik_workshop_perm_dana->actionlink->EditAttributes() ?>><?php echo $logistik_workshop_perm_dana->actionlink->EditValue ?></textarea>
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
$logistik_workshop_perm_dana_search->Page_Terminate();
?>
<?php

//
// Page Class
//
class clogistik_workshop_perm_dana_search {

	// Page ID
	var $PageID = 'search';

	// Table Name
	var $TableName = 'logistik_workshop_perm_dana';

	// Page Object Name
	var $PageObjName = 'logistik_workshop_perm_dana_search';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $logistik_workshop_perm_dana;
		if ($logistik_workshop_perm_dana->UseTokenInUrl) $PageUrl .= "t=" . $logistik_workshop_perm_dana->TableVar . "&"; // add page token
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
		global $objForm, $logistik_workshop_perm_dana;
		if ($logistik_workshop_perm_dana->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($logistik_workshop_perm_dana->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($logistik_workshop_perm_dana->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function clogistik_workshop_perm_dana_search() {
		global $conn;

		// Initialize table object
		$GLOBALS["logistik_workshop_perm_dana"] = new clogistik_workshop_perm_dana();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'logistik_workshop_perm_dana', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $logistik_workshop_perm_dana;

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
		global $objForm, $gsSearchError, $logistik_workshop_perm_dana;
		$objForm = new cFormObj();
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$logistik_workshop_perm_dana->CurrentAction = $objForm->GetValue("a_search");
			switch ($logistik_workshop_perm_dana->CurrentAction) {
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
						$sSrchStr = $logistik_workshop_perm_dana->UrlParm($sSrchStr);
						$this->Page_Terminate("logistik_workshop_perm_danalist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$logistik_workshop_perm_dana->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $logistik_workshop_perm_dana;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $logistik_workshop_perm_dana->actionlink); // actionlink
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
		global $objForm, $logistik_workshop_perm_dana;

		// Load search values
		// actionlink

		$logistik_workshop_perm_dana->actionlink->AdvancedSearch->SearchValue = $objForm->GetValue("x_actionlink");
		$logistik_workshop_perm_dana->actionlink->AdvancedSearch->SearchOperator = $objForm->GetValue("z_actionlink");

		// kodepermohonan
		$logistik_workshop_perm_dana->kodepermohonan->AdvancedSearch->SearchValue = $objForm->GetValue("x_kodepermohonan");
		$logistik_workshop_perm_dana->kodepermohonan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_kodepermohonan");

		// kode_pekerjaan
		$logistik_workshop_perm_dana->kode_pekerjaan->AdvancedSearch->SearchValue = $objForm->GetValue("x_kode_pekerjaan");
		$logistik_workshop_perm_dana->kode_pekerjaan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_kode_pekerjaan");

		// partunit
		$logistik_workshop_perm_dana->partunit->AdvancedSearch->SearchValue = $objForm->GetValue("x_partunit");
		$logistik_workshop_perm_dana->partunit->AdvancedSearch->SearchOperator = $objForm->GetValue("z_partunit");

		// qrno
		$logistik_workshop_perm_dana->qrno->AdvancedSearch->SearchValue = $objForm->GetValue("x_qrno");
		$logistik_workshop_perm_dana->qrno->AdvancedSearch->SearchOperator = $objForm->GetValue("z_qrno");

		// pono
		$logistik_workshop_perm_dana->pono->AdvancedSearch->SearchValue = $objForm->GetValue("x_pono");
		$logistik_workshop_perm_dana->pono->AdvancedSearch->SearchOperator = $objForm->GetValue("z_pono");

		// tanggal
		$logistik_workshop_perm_dana->tanggal->AdvancedSearch->SearchValue = $objForm->GetValue("x_tanggal");
		$logistik_workshop_perm_dana->tanggal->AdvancedSearch->SearchOperator = $objForm->GetValue("z_tanggal");

		// posting
		$logistik_workshop_perm_dana->posting->AdvancedSearch->SearchValue = $objForm->GetValue("x_posting");
		$logistik_workshop_perm_dana->posting->AdvancedSearch->SearchOperator = $objForm->GetValue("z_posting");

		// createby
		$logistik_workshop_perm_dana->createby->AdvancedSearch->SearchValue = $objForm->GetValue("x_createby");
		$logistik_workshop_perm_dana->createby->AdvancedSearch->SearchOperator = $objForm->GetValue("z_createby");

		// admlogistik
		$logistik_workshop_perm_dana->admlogistik->AdvancedSearch->SearchValue = $objForm->GetValue("x_admlogistik");
		$logistik_workshop_perm_dana->admlogistik->AdvancedSearch->SearchOperator = $objForm->GetValue("z_admlogistik");

		// kalogistik
		$logistik_workshop_perm_dana->kalogistik->AdvancedSearch->SearchValue = $objForm->GetValue("x_kalogistik");
		$logistik_workshop_perm_dana->kalogistik->AdvancedSearch->SearchOperator = $objForm->GetValue("z_kalogistik");

		// kadivumum
		$logistik_workshop_perm_dana->kadivumum->AdvancedSearch->SearchValue = $objForm->GetValue("x_kadivumum");
		$logistik_workshop_perm_dana->kadivumum->AdvancedSearch->SearchOperator = $objForm->GetValue("z_kadivumum");

		// dirut
		$logistik_workshop_perm_dana->dirut->AdvancedSearch->SearchValue = $objForm->GetValue("x_dirut");
		$logistik_workshop_perm_dana->dirut->AdvancedSearch->SearchOperator = $objForm->GetValue("z_dirut");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $logistik_workshop_perm_dana;

		// Call Row_Rendering event
		$logistik_workshop_perm_dana->Row_Rendering();

		// Common render codes for all row types
		// actionlink

		$logistik_workshop_perm_dana->actionlink->CellCssStyle = "";
		$logistik_workshop_perm_dana->actionlink->CellCssClass = "";
		if ($logistik_workshop_perm_dana->RowType == EW_ROWTYPE_VIEW) { // View row

			// actionlink
			$logistik_workshop_perm_dana->actionlink->ViewValue = $logistik_workshop_perm_dana->actionlink->CurrentValue;
			$logistik_workshop_perm_dana->actionlink->CssStyle = "";
			$logistik_workshop_perm_dana->actionlink->CssClass = "";
			$logistik_workshop_perm_dana->actionlink->ViewCustomAttributes = "";

			// kodepermohonan
			$logistik_workshop_perm_dana->kodepermohonan->ViewValue = $logistik_workshop_perm_dana->kodepermohonan->CurrentValue;
			$logistik_workshop_perm_dana->kodepermohonan->CssStyle = "";
			$logistik_workshop_perm_dana->kodepermohonan->CssClass = "";
			$logistik_workshop_perm_dana->kodepermohonan->ViewCustomAttributes = "";

			// kode_pekerjaan
			$logistik_workshop_perm_dana->kode_pekerjaan->ViewValue = $logistik_workshop_perm_dana->kode_pekerjaan->CurrentValue;
			$logistik_workshop_perm_dana->kode_pekerjaan->CssStyle = "";
			$logistik_workshop_perm_dana->kode_pekerjaan->CssClass = "";
			$logistik_workshop_perm_dana->kode_pekerjaan->ViewCustomAttributes = "";

			// partunit
			if (strval($logistik_workshop_perm_dana->partunit->CurrentValue) <> "") {
				switch ($logistik_workshop_perm_dana->partunit->CurrentValue) {
					case "part":
						$logistik_workshop_perm_dana->partunit->ViewValue = "Part";
						break;
					case "unit":
						$logistik_workshop_perm_dana->partunit->ViewValue = "Unit";
						break;
					default:
						$logistik_workshop_perm_dana->partunit->ViewValue = $logistik_workshop_perm_dana->partunit->CurrentValue;
				}
			} else {
				$logistik_workshop_perm_dana->partunit->ViewValue = NULL;
			}
			$logistik_workshop_perm_dana->partunit->CssStyle = "";
			$logistik_workshop_perm_dana->partunit->CssClass = "";
			$logistik_workshop_perm_dana->partunit->ViewCustomAttributes = "";

			// qrno
			$logistik_workshop_perm_dana->qrno->ViewValue = $logistik_workshop_perm_dana->qrno->CurrentValue;
			$logistik_workshop_perm_dana->qrno->CssStyle = "";
			$logistik_workshop_perm_dana->qrno->CssClass = "";
			$logistik_workshop_perm_dana->qrno->ViewCustomAttributes = "";

			// pono
			$logistik_workshop_perm_dana->pono->ViewValue = $logistik_workshop_perm_dana->pono->CurrentValue;
			$logistik_workshop_perm_dana->pono->CssStyle = "";
			$logistik_workshop_perm_dana->pono->CssClass = "";
			$logistik_workshop_perm_dana->pono->ViewCustomAttributes = "";

			// tanggal
			$logistik_workshop_perm_dana->tanggal->ViewValue = $logistik_workshop_perm_dana->tanggal->CurrentValue;
			$logistik_workshop_perm_dana->tanggal->ViewValue = ew_FormatDateTime($logistik_workshop_perm_dana->tanggal->ViewValue, 7);
			$logistik_workshop_perm_dana->tanggal->CssStyle = "";
			$logistik_workshop_perm_dana->tanggal->CssClass = "";
			$logistik_workshop_perm_dana->tanggal->ViewCustomAttributes = "";

			// posting
			$logistik_workshop_perm_dana->posting->ViewValue = $logistik_workshop_perm_dana->posting->CurrentValue;
			$logistik_workshop_perm_dana->posting->CssStyle = "";
			$logistik_workshop_perm_dana->posting->CssClass = "";
			$logistik_workshop_perm_dana->posting->ViewCustomAttributes = "";

			// createby
			if (strval($logistik_workshop_perm_dana->createby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_workshop_perm_dana->createby->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_workshop_perm_dana->createby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_workshop_perm_dana->createby->ViewValue = $logistik_workshop_perm_dana->createby->CurrentValue;
				}
			} else {
				$logistik_workshop_perm_dana->createby->ViewValue = NULL;
			}
			$logistik_workshop_perm_dana->createby->CssStyle = "";
			$logistik_workshop_perm_dana->createby->CssClass = "";
			$logistik_workshop_perm_dana->createby->ViewCustomAttributes = "";

			// admlogistik
			if (strval($logistik_workshop_perm_dana->admlogistik->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_workshop_perm_dana->admlogistik->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_workshop_perm_dana->admlogistik->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_workshop_perm_dana->admlogistik->ViewValue = $logistik_workshop_perm_dana->admlogistik->CurrentValue;
				}
			} else {
				$logistik_workshop_perm_dana->admlogistik->ViewValue = NULL;
			}
			$logistik_workshop_perm_dana->admlogistik->CssStyle = "";
			$logistik_workshop_perm_dana->admlogistik->CssClass = "";
			$logistik_workshop_perm_dana->admlogistik->ViewCustomAttributes = "";

			// kalogistik
			if (strval($logistik_workshop_perm_dana->kalogistik->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_workshop_perm_dana->kalogistik->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_workshop_perm_dana->kalogistik->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_workshop_perm_dana->kalogistik->ViewValue = $logistik_workshop_perm_dana->kalogistik->CurrentValue;
				}
			} else {
				$logistik_workshop_perm_dana->kalogistik->ViewValue = NULL;
			}
			$logistik_workshop_perm_dana->kalogistik->CssStyle = "";
			$logistik_workshop_perm_dana->kalogistik->CssClass = "";
			$logistik_workshop_perm_dana->kalogistik->ViewCustomAttributes = "";

			// kadivumum
			if (strval($logistik_workshop_perm_dana->kadivumum->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_workshop_perm_dana->kadivumum->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_workshop_perm_dana->kadivumum->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_workshop_perm_dana->kadivumum->ViewValue = $logistik_workshop_perm_dana->kadivumum->CurrentValue;
				}
			} else {
				$logistik_workshop_perm_dana->kadivumum->ViewValue = NULL;
			}
			$logistik_workshop_perm_dana->kadivumum->CssStyle = "";
			$logistik_workshop_perm_dana->kadivumum->CssClass = "";
			$logistik_workshop_perm_dana->kadivumum->ViewCustomAttributes = "";

			// dirut
			if (strval($logistik_workshop_perm_dana->dirut->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($logistik_workshop_perm_dana->dirut->CurrentValue) . "'";
				$sSqlWrk .= " ORDER BY `nama` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$logistik_workshop_perm_dana->dirut->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$logistik_workshop_perm_dana->dirut->ViewValue = $logistik_workshop_perm_dana->dirut->CurrentValue;
				}
			} else {
				$logistik_workshop_perm_dana->dirut->ViewValue = NULL;
			}
			$logistik_workshop_perm_dana->dirut->CssStyle = "";
			$logistik_workshop_perm_dana->dirut->CssClass = "";
			$logistik_workshop_perm_dana->dirut->ViewCustomAttributes = "";

			// actionlink
			$logistik_workshop_perm_dana->actionlink->HrefValue = "";
		} elseif ($logistik_workshop_perm_dana->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// actionlink
			$logistik_workshop_perm_dana->actionlink->EditCustomAttributes = "";
			$logistik_workshop_perm_dana->actionlink->EditValue = ew_HtmlEncode($logistik_workshop_perm_dana->actionlink->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		$logistik_workshop_perm_dana->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $logistik_workshop_perm_dana;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckEuroDate($logistik_workshop_perm_dana->tanggal->AdvancedSearch->SearchValue)) {
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
		global $logistik_workshop_perm_dana;
		$logistik_workshop_perm_dana->actionlink->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_actionlink");
		$logistik_workshop_perm_dana->kodepermohonan->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_kodepermohonan");
		$logistik_workshop_perm_dana->kode_pekerjaan->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_kode_pekerjaan");
		$logistik_workshop_perm_dana->partunit->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_partunit");
		$logistik_workshop_perm_dana->qrno->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_qrno");
		$logistik_workshop_perm_dana->pono->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_pono");
		$logistik_workshop_perm_dana->tanggal->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_tanggal");
		$logistik_workshop_perm_dana->posting->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_posting");
		$logistik_workshop_perm_dana->createby->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_createby");
		$logistik_workshop_perm_dana->admlogistik->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_admlogistik");
		$logistik_workshop_perm_dana->kalogistik->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_kalogistik");
		$logistik_workshop_perm_dana->kadivumum->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_kadivumum");
		$logistik_workshop_perm_dana->dirut->AdvancedSearch->SearchValue = $logistik_workshop_perm_dana->getAdvancedSearch("x_dirut");
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
