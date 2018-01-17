<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "trx_mutasi_uanginfo.php" ?>
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
$trx_mutasi_uang_delete = new ctrx_mutasi_uang_delete();
$Page =& $trx_mutasi_uang_delete;

// Page init processing
$trx_mutasi_uang_delete->Page_Init();

// Page main processing
$trx_mutasi_uang_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var trx_mutasi_uang_delete = new ew_Page("trx_mutasi_uang_delete");

// page properties
trx_mutasi_uang_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = trx_mutasi_uang_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
trx_mutasi_uang_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
trx_mutasi_uang_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
trx_mutasi_uang_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php

// Load records for display
$rs = $trx_mutasi_uang_delete->LoadRecordset();
$trx_mutasi_uang_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($trx_mutasi_uang_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$trx_mutasi_uang_delete->Page_Terminate("trx_mutasi_uanglist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From <h3><b>Pembiayaan dengan Kas/Bank</b></h3><br><br>
<a href="<?php echo $trx_mutasi_uang->getReturnUrl() ?>">Go Back</a></span></p>
<?php $trx_mutasi_uang_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="trx_mutasi_uang">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($trx_mutasi_uang_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $trx_mutasi_uang->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Kode</td>
		<td valign="top">Tanggal</td>
		<td valign="top">Mode</td>
		<td valign="top">Bank</td>
		<td valign="top">Keterangan</td>
		<td valign="top">Debit</td>
		<td valign="top">Kredit</td>
		<td valign="top">Create By</td>
	</tr>
	</thead>
	<tbody>
<?php
$trx_mutasi_uang_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$trx_mutasi_uang_delete->lRecCnt++;

	// Set row properties
	$trx_mutasi_uang->CssClass = "";
	$trx_mutasi_uang->CssStyle = "";
	$trx_mutasi_uang->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$trx_mutasi_uang_delete->LoadRowValues($rs);

	// Render row
	$trx_mutasi_uang_delete->RenderRow();
?>
	<tr<?php echo $trx_mutasi_uang->RowAttributes() ?>>
		<td<?php echo $trx_mutasi_uang->kode->CellAttributes() ?>>
<div<?php echo $trx_mutasi_uang->kode->ViewAttributes() ?>><?php echo $trx_mutasi_uang->kode->ListViewValue() ?></div></td>
		<td<?php echo $trx_mutasi_uang->tanggal->CellAttributes() ?>>
<div<?php echo $trx_mutasi_uang->tanggal->ViewAttributes() ?>><?php echo $trx_mutasi_uang->tanggal->ListViewValue() ?></div></td>
		<td<?php echo $trx_mutasi_uang->mode->CellAttributes() ?>>
<div<?php echo $trx_mutasi_uang->mode->ViewAttributes() ?>><?php echo $trx_mutasi_uang->mode->ListViewValue() ?></div></td>
		<td<?php echo $trx_mutasi_uang->coabank->CellAttributes() ?>>
<div<?php echo $trx_mutasi_uang->coabank->ViewAttributes() ?>><?php echo $trx_mutasi_uang->coabank->ListViewValue() ?></div></td>
		<td<?php echo $trx_mutasi_uang->notes->CellAttributes() ?>>
<div<?php echo $trx_mutasi_uang->notes->ViewAttributes() ?>><?php echo $trx_mutasi_uang->notes->ListViewValue() ?></div></td>
		<td<?php echo $trx_mutasi_uang->debit->CellAttributes() ?>>
<div<?php echo $trx_mutasi_uang->debit->ViewAttributes() ?>><?php echo $trx_mutasi_uang->debit->ListViewValue() ?></div></td>
		<td<?php echo $trx_mutasi_uang->kredit->CellAttributes() ?>>
<div<?php echo $trx_mutasi_uang->kredit->ViewAttributes() ?>><?php echo $trx_mutasi_uang->kredit->ListViewValue() ?></div></td>
		<td<?php echo $trx_mutasi_uang->createby->CellAttributes() ?>>
<div<?php echo $trx_mutasi_uang->createby->ViewAttributes() ?>><?php echo $trx_mutasi_uang->createby->ListViewValue() ?></div></td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="Confirm Delete">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$trx_mutasi_uang_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class ctrx_mutasi_uang_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'trx_mutasi_uang';

	// Page Object Name
	var $PageObjName = 'trx_mutasi_uang_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $trx_mutasi_uang;
		if ($trx_mutasi_uang->UseTokenInUrl) $PageUrl .= "t=" . $trx_mutasi_uang->TableVar . "&"; // add page token
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
		global $objForm, $trx_mutasi_uang;
		if ($trx_mutasi_uang->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($trx_mutasi_uang->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($trx_mutasi_uang->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function ctrx_mutasi_uang_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["trx_mutasi_uang"] = new ctrx_mutasi_uang();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'trx_mutasi_uang', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $trx_mutasi_uang;

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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $trx_mutasi_uang;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["kode"] <> "") {
			$trx_mutasi_uang->kode->setQueryStringValue($_GET["kode"]);
			$sKey .= $trx_mutasi_uang->kode->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if ($bSingleDelete) {
			$nKeySelected = 1; // Set up key selected count
			$this->arRecKeys[0] = $sKey;
		} else {
			if (isset($_POST["key_m"])) { // Key in form
				$nKeySelected = count($_POST["key_m"]); // Set up key selected count
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
			}
		}
		if ($nKeySelected <= 0)
			$this->Page_Terminate("trx_mutasi_uanglist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			$sFilter .= "`kode`='" . ew_AdjustSql($sKeyFld) . "' AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in trx_mutasi_uang class, trx_mutasi_uanginfo.php

		$trx_mutasi_uang->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$trx_mutasi_uang->CurrentAction = $_POST["a_delete"];
		} else {
			$trx_mutasi_uang->CurrentAction = "I"; // Display record
		}
		switch ($trx_mutasi_uang->CurrentAction) {
			case "D": // Delete
				$trx_mutasi_uang->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($trx_mutasi_uang->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $trx_mutasi_uang;
		$DeleteRows = TRUE;
		$sWrkFilter = $trx_mutasi_uang->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in trx_mutasi_uang class, trx_mutasi_uanginfo.php

		$trx_mutasi_uang->CurrentFilter = $sWrkFilter;
		$sSql = $trx_mutasi_uang->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setMessage("No records found"); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs) $rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $trx_mutasi_uang->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['kode'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($trx_mutasi_uang->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($trx_mutasi_uang->CancelMessage <> "") {
				$this->setMessage($trx_mutasi_uang->CancelMessage);
				$trx_mutasi_uang->CancelMessage = "";
			} else {
				$this->setMessage("Delete cancelled");
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call recordset deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$trx_mutasi_uang->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $trx_mutasi_uang;

		// Call Recordset Selecting event
		$trx_mutasi_uang->Recordset_Selecting($trx_mutasi_uang->CurrentFilter);

		// Load list page SQL
		$sSql = $trx_mutasi_uang->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$trx_mutasi_uang->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $trx_mutasi_uang;
		$sFilter = $trx_mutasi_uang->KeyFilter();

		// Call Row Selecting event
		$trx_mutasi_uang->Row_Selecting($sFilter);

		// Load sql based on filter
		$trx_mutasi_uang->CurrentFilter = $sFilter;
		$sSql = $trx_mutasi_uang->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$trx_mutasi_uang->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $trx_mutasi_uang;
		$trx_mutasi_uang->kode->setDbValue($rs->fields('kode'));
		$trx_mutasi_uang->idseqno->setDbValue($rs->fields('idseqno'));
		$trx_mutasi_uang->tanggal->setDbValue($rs->fields('tanggal'));
		$trx_mutasi_uang->mode->setDbValue($rs->fields('mode'));
		$trx_mutasi_uang->coabank->setDbValue($rs->fields('coabank'));
		$trx_mutasi_uang->cardno->setDbValue($rs->fields('cardno'));
		$trx_mutasi_uang->modul->setDbValue($rs->fields('modul'));
		$trx_mutasi_uang->kode_trx->setDbValue($rs->fields('kode_trx'));
		$trx_mutasi_uang->kodejurnal->setDbValue($rs->fields('kodejurnal'));
		$trx_mutasi_uang->coa->setDbValue($rs->fields('coa'));
		$trx_mutasi_uang->notes->setDbValue($rs->fields('notes'));
		$trx_mutasi_uang->debit->setDbValue($rs->fields('debit'));
		$trx_mutasi_uang->kredit->setDbValue($rs->fields('kredit'));
		$trx_mutasi_uang->createby->setDbValue($rs->fields('createby'));
		$trx_mutasi_uang->createdate->setDbValue($rs->fields('createdate'));
		$trx_mutasi_uang->xtimestamp->setDbValue($rs->fields('xtimestamp'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $trx_mutasi_uang;

		// Call Row_Rendering event
		$trx_mutasi_uang->Row_Rendering();

		// Common render codes for all row types
		// kode

		$trx_mutasi_uang->kode->CellCssStyle = "white-space: nowrap;";
		$trx_mutasi_uang->kode->CellCssClass = "";

		// tanggal
		$trx_mutasi_uang->tanggal->CellCssStyle = "white-space: nowrap;";
		$trx_mutasi_uang->tanggal->CellCssClass = "";

		// mode
		$trx_mutasi_uang->mode->CellCssStyle = "white-space: nowrap;";
		$trx_mutasi_uang->mode->CellCssClass = "";

		// coabank
		$trx_mutasi_uang->coabank->CellCssStyle = "white-space: nowrap;";
		$trx_mutasi_uang->coabank->CellCssClass = "";

		// notes
		$trx_mutasi_uang->notes->CellCssStyle = "white-space: nowrap;";
		$trx_mutasi_uang->notes->CellCssClass = "";

		// debit
		$trx_mutasi_uang->debit->CellCssStyle = "white-space: nowrap;";
		$trx_mutasi_uang->debit->CellCssClass = "";

		// kredit
		$trx_mutasi_uang->kredit->CellCssStyle = "white-space: nowrap;";
		$trx_mutasi_uang->kredit->CellCssClass = "";

		// createby
		$trx_mutasi_uang->createby->CellCssStyle = "white-space: nowrap;";
		$trx_mutasi_uang->createby->CellCssClass = "";
		if ($trx_mutasi_uang->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$trx_mutasi_uang->kode->ViewValue = $trx_mutasi_uang->kode->CurrentValue;
			$trx_mutasi_uang->kode->CssStyle = "";
			$trx_mutasi_uang->kode->CssClass = "";
			$trx_mutasi_uang->kode->ViewCustomAttributes = "";

			// tanggal
			$trx_mutasi_uang->tanggal->ViewValue = $trx_mutasi_uang->tanggal->CurrentValue;
			$trx_mutasi_uang->tanggal->ViewValue = ew_FormatDateTime($trx_mutasi_uang->tanggal->ViewValue, 7);
			$trx_mutasi_uang->tanggal->CssStyle = "";
			$trx_mutasi_uang->tanggal->CssClass = "";
			$trx_mutasi_uang->tanggal->ViewCustomAttributes = "";

			// mode
			if (strval($trx_mutasi_uang->mode->CurrentValue) <> "") {
				switch ($trx_mutasi_uang->mode->CurrentValue) {
					case "kas":
						$trx_mutasi_uang->mode->ViewValue = "Kas";
						break;
					case "edc":
						$trx_mutasi_uang->mode->ViewValue = "EDC";
						break;
					case "bank":
						$trx_mutasi_uang->mode->ViewValue = "Bank";
						break;
					default:
						$trx_mutasi_uang->mode->ViewValue = $trx_mutasi_uang->mode->CurrentValue;
				}
			} else {
				$trx_mutasi_uang->mode->ViewValue = NULL;
			}
			$trx_mutasi_uang->mode->CssStyle = "";
			$trx_mutasi_uang->mode->CssClass = "";
			$trx_mutasi_uang->mode->ViewCustomAttributes = "";

			// coabank
			if (strval($trx_mutasi_uang->coabank->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `description` FROM `acc_mst_coa` WHERE `coa` = '" . ew_AdjustSql($trx_mutasi_uang->coabank->CurrentValue) . "'";
				$sSqlWrk .= " AND (" . "`description` LIKE '%bank%'" . ")";
				$sSqlWrk .= " ORDER BY `description` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$trx_mutasi_uang->coabank->ViewValue = $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$trx_mutasi_uang->coabank->ViewValue = $trx_mutasi_uang->coabank->CurrentValue;
				}
			} else {
				$trx_mutasi_uang->coabank->ViewValue = NULL;
			}
			$trx_mutasi_uang->coabank->CssStyle = "";
			$trx_mutasi_uang->coabank->CssClass = "";
			$trx_mutasi_uang->coabank->ViewCustomAttributes = "";

			// notes
			$trx_mutasi_uang->notes->ViewValue = $trx_mutasi_uang->notes->CurrentValue;
			$trx_mutasi_uang->notes->CssStyle = "";
			$trx_mutasi_uang->notes->CssClass = "";
			$trx_mutasi_uang->notes->ViewCustomAttributes = "";

			// debit
			$trx_mutasi_uang->debit->ViewValue = $trx_mutasi_uang->debit->CurrentValue;
			$trx_mutasi_uang->debit->ViewValue = ew_FormatNumber($trx_mutasi_uang->debit->ViewValue, 0, -2, -2, -2);
			$trx_mutasi_uang->debit->CssStyle = "text-align:right;";
			$trx_mutasi_uang->debit->CssClass = "";
			$trx_mutasi_uang->debit->ViewCustomAttributes = "";

			// kredit
			$trx_mutasi_uang->kredit->ViewValue = $trx_mutasi_uang->kredit->CurrentValue;
			$trx_mutasi_uang->kredit->ViewValue = ew_FormatNumber($trx_mutasi_uang->kredit->ViewValue, 0, -2, -2, -2);
			$trx_mutasi_uang->kredit->CssStyle = "text-align:right;";
			$trx_mutasi_uang->kredit->CssClass = "";
			$trx_mutasi_uang->kredit->ViewCustomAttributes = "";

			// createby
			if (strval($trx_mutasi_uang->createby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($trx_mutasi_uang->createby->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$trx_mutasi_uang->createby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$trx_mutasi_uang->createby->ViewValue = $trx_mutasi_uang->createby->CurrentValue;
				}
			} else {
				$trx_mutasi_uang->createby->ViewValue = NULL;
			}
			$trx_mutasi_uang->createby->CssStyle = "";
			$trx_mutasi_uang->createby->CssClass = "";
			$trx_mutasi_uang->createby->ViewCustomAttributes = "";

			// kode
			$trx_mutasi_uang->kode->HrefValue = "";

			// tanggal
			$trx_mutasi_uang->tanggal->HrefValue = "";

			// mode
			$trx_mutasi_uang->mode->HrefValue = "";

			// coabank
			$trx_mutasi_uang->coabank->HrefValue = "";

			// notes
			$trx_mutasi_uang->notes->HrefValue = "";

			// debit
			$trx_mutasi_uang->debit->HrefValue = "";

			// kredit
			$trx_mutasi_uang->kredit->HrefValue = "";

			// createby
			$trx_mutasi_uang->createby->HrefValue = "";
		}

		// Call Row Rendered event
		$trx_mutasi_uang->Row_Rendered();
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}
}
?>
