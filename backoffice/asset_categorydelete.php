<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "asset_categoryinfo.php" ?>
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
$asset_category_delete = new casset_category_delete();
$Page =& $asset_category_delete;

// Page init processing
$asset_category_delete->Page_Init();

// Page main processing
$asset_category_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var asset_category_delete = new ew_Page("asset_category_delete");

// page properties
asset_category_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = asset_category_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
asset_category_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
asset_category_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
asset_category_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $asset_category_delete->LoadRecordset();
$asset_category_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($asset_category_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$asset_category_delete->Page_Terminate("asset_categorylist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From <h3><b>Asset Category</b></h3><br><br>
<a href="<?php echo $asset_category->getReturnUrl() ?>">Go Back</a></span></p>
<?php $asset_category_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="asset_category">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($asset_category_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $asset_category->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Kode</td>
		<td valign="top">Coa</td>
		<td valign="top">Category</td>
		<td valign="top">Penyusutan (%)</td>
		<td valign="top">COA Biaya Penyusutan</td>
		<td valign="top">COA Akum.Penyusutan</td>
	</tr>
	</thead>
	<tbody>
<?php
$asset_category_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$asset_category_delete->lRecCnt++;

	// Set row properties
	$asset_category->CssClass = "";
	$asset_category->CssStyle = "";
	$asset_category->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$asset_category_delete->LoadRowValues($rs);

	// Render row
	$asset_category_delete->RenderRow();
?>
	<tr<?php echo $asset_category->RowAttributes() ?>>
		<td<?php echo $asset_category->kode->CellAttributes() ?>>
<div<?php echo $asset_category->kode->ViewAttributes() ?>><?php echo $asset_category->kode->ListViewValue() ?></div></td>
		<td<?php echo $asset_category->coa->CellAttributes() ?>>
<div<?php echo $asset_category->coa->ViewAttributes() ?>><?php echo $asset_category->coa->ListViewValue() ?></div></td>
		<td<?php echo $asset_category->category->CellAttributes() ?>>
<div<?php echo $asset_category->category->ViewAttributes() ?>><?php echo $asset_category->category->ListViewValue() ?></div></td>
		<td<?php echo $asset_category->penyusutan->CellAttributes() ?>>
<div<?php echo $asset_category->penyusutan->ViewAttributes() ?>><?php echo $asset_category->penyusutan->ListViewValue() ?></div></td>
		<td<?php echo $asset_category->coabiaya->CellAttributes() ?>>
<div<?php echo $asset_category->coabiaya->ViewAttributes() ?>><?php echo $asset_category->coabiaya->ListViewValue() ?></div></td>
		<td<?php echo $asset_category->coaakum->CellAttributes() ?>>
<div<?php echo $asset_category->coaakum->ViewAttributes() ?>><?php echo $asset_category->coaakum->ListViewValue() ?></div></td>
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
$asset_category_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class casset_category_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'asset_category';

	// Page Object Name
	var $PageObjName = 'asset_category_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $asset_category;
		if ($asset_category->UseTokenInUrl) $PageUrl .= "t=" . $asset_category->TableVar . "&"; // add page token
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
		global $objForm, $asset_category;
		if ($asset_category->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($asset_category->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($asset_category->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function casset_category_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["asset_category"] = new casset_category();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'asset_category', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $asset_category;

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
		global $asset_category;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["kode"] <> "") {
			$asset_category->kode->setQueryStringValue($_GET["kode"]);
			if (!is_numeric($asset_category->kode->QueryStringValue))
				$this->Page_Terminate("asset_categorylist.php"); // Prevent SQL injection, exit
			$sKey .= $asset_category->kode->QueryStringValue;
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
			$this->Page_Terminate("asset_categorylist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("asset_categorylist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`kode`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in asset_category class, asset_categoryinfo.php

		$asset_category->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$asset_category->CurrentAction = $_POST["a_delete"];
		} else {
			$asset_category->CurrentAction = "I"; // Display record
		}
		switch ($asset_category->CurrentAction) {
			case "D": // Delete
				$asset_category->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($asset_category->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $asset_category;
		$DeleteRows = TRUE;
		$sWrkFilter = $asset_category->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in asset_category class, asset_categoryinfo.php

		$asset_category->CurrentFilter = $sWrkFilter;
		$sSql = $asset_category->SQL();
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
				$DeleteRows = $asset_category->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($asset_category->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($asset_category->CancelMessage <> "") {
				$this->setMessage($asset_category->CancelMessage);
				$asset_category->CancelMessage = "";
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
				$asset_category->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $asset_category;

		// Call Recordset Selecting event
		$asset_category->Recordset_Selecting($asset_category->CurrentFilter);

		// Load list page SQL
		$sSql = $asset_category->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$asset_category->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $asset_category;
		$sFilter = $asset_category->KeyFilter();

		// Call Row Selecting event
		$asset_category->Row_Selecting($sFilter);

		// Load sql based on filter
		$asset_category->CurrentFilter = $sFilter;
		$sSql = $asset_category->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$asset_category->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $asset_category;
		$asset_category->kode->setDbValue($rs->fields('kode'));
		$asset_category->coa->setDbValue($rs->fields('coa'));
		$asset_category->category->setDbValue($rs->fields('category'));
		$asset_category->penyusutan->setDbValue($rs->fields('penyusutan'));
		$asset_category->coabiaya->setDbValue($rs->fields('coabiaya'));
		$asset_category->coaakum->setDbValue($rs->fields('coaakum'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $asset_category;

		// Call Row_Rendering event
		$asset_category->Row_Rendering();

		// Common render codes for all row types
		// kode

		$asset_category->kode->CellCssStyle = "white-space: nowrap;";
		$asset_category->kode->CellCssClass = "";

		// coa
		$asset_category->coa->CellCssStyle = "white-space: nowrap;";
		$asset_category->coa->CellCssClass = "";

		// category
		$asset_category->category->CellCssStyle = "white-space: nowrap;";
		$asset_category->category->CellCssClass = "";

		// penyusutan
		$asset_category->penyusutan->CellCssStyle = "white-space: nowrap;";
		$asset_category->penyusutan->CellCssClass = "";

		// coabiaya
		$asset_category->coabiaya->CellCssStyle = "white-space: nowrap;";
		$asset_category->coabiaya->CellCssClass = "";

		// coaakum
		$asset_category->coaakum->CellCssStyle = "white-space: nowrap;";
		$asset_category->coaakum->CellCssClass = "";
		if ($asset_category->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$asset_category->kode->ViewValue = $asset_category->kode->CurrentValue;
			$asset_category->kode->CssStyle = "";
			$asset_category->kode->CssClass = "";
			$asset_category->kode->ViewCustomAttributes = "";

			// coa
			if (strval($asset_category->coa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `coa`, `description` FROM `acc_mst_coa` WHERE `coa` = '" . ew_AdjustSql($asset_category->coa->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$asset_category->coa->ViewValue = $rswrk->fields('coa');
					$asset_category->coa->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$asset_category->coa->ViewValue = $asset_category->coa->CurrentValue;
				}
			} else {
				$asset_category->coa->ViewValue = NULL;
			}
			$asset_category->coa->CssStyle = "";
			$asset_category->coa->CssClass = "";
			$asset_category->coa->ViewCustomAttributes = "";

			// category
			$asset_category->category->ViewValue = $asset_category->category->CurrentValue;
			$asset_category->category->CssStyle = "";
			$asset_category->category->CssClass = "";
			$asset_category->category->ViewCustomAttributes = "nowrap";

			// penyusutan
			$asset_category->penyusutan->ViewValue = $asset_category->penyusutan->CurrentValue;
			$asset_category->penyusutan->CssStyle = "text-align:right;";
			$asset_category->penyusutan->CssClass = "";
			$asset_category->penyusutan->ViewCustomAttributes = "";

			// coabiaya
			if (strval($asset_category->coabiaya->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `coa`, `description` FROM `acc_mst_coa` WHERE `coa` = '" . ew_AdjustSql($asset_category->coabiaya->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$asset_category->coabiaya->ViewValue = $rswrk->fields('coa');
					$asset_category->coabiaya->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$asset_category->coabiaya->ViewValue = $asset_category->coabiaya->CurrentValue;
				}
			} else {
				$asset_category->coabiaya->ViewValue = NULL;
			}
			$asset_category->coabiaya->CssStyle = "";
			$asset_category->coabiaya->CssClass = "";
			$asset_category->coabiaya->ViewCustomAttributes = "";

			// coaakum
			if (strval($asset_category->coaakum->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `coa`, `description` FROM `acc_mst_coa` WHERE `coa` = '" . ew_AdjustSql($asset_category->coaakum->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$asset_category->coaakum->ViewValue = $rswrk->fields('coa');
					$asset_category->coaakum->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$asset_category->coaakum->ViewValue = $asset_category->coaakum->CurrentValue;
				}
			} else {
				$asset_category->coaakum->ViewValue = NULL;
			}
			$asset_category->coaakum->CssStyle = "";
			$asset_category->coaakum->CssClass = "";
			$asset_category->coaakum->ViewCustomAttributes = "";

			// kode
			$asset_category->kode->HrefValue = "";

			// coa
			$asset_category->coa->HrefValue = "";

			// category
			$asset_category->category->HrefValue = "";

			// penyusutan
			$asset_category->penyusutan->HrefValue = "";

			// coabiaya
			$asset_category->coabiaya->HrefValue = "";

			// coaakum
			$asset_category->coaakum->HrefValue = "";
		}

		// Call Row Rendered event
		$asset_category->Row_Rendered();
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
