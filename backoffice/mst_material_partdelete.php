<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_material_partinfo.php" ?>
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
$mst_material_part_delete = new cmst_material_part_delete();
$Page =& $mst_material_part_delete;

// Page init processing
$mst_material_part_delete->Page_Init();

// Page main processing
$mst_material_part_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mst_material_part_delete = new ew_Page("mst_material_part_delete");

// page properties
mst_material_part_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = mst_material_part_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
mst_material_part_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_material_part_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_material_part_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $mst_material_part_delete->LoadRecordset();
$mst_material_part_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($mst_material_part_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$mst_material_part_delete->Page_Terminate("mst_material_partlist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From <h3><b>Master Barang</b></h3><br><br>
<a href="<?php echo $mst_material_part->getReturnUrl() ?>">Go Back</a></span></p>
<?php $mst_material_part_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="mst_material_part">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($mst_material_part_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $mst_material_part->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Kode</td>
		<td valign="top">Serial Number</td>
		<td valign="top">Category</td>
		<td valign="top">Tipe Barang</td>
		<td valign="top">Nama</td>
		<td valign="top">Satuan</td>
		<td valign="top">Keterangan</td>
		<td valign="top">COA</td>
	</tr>
	</thead>
	<tbody>
<?php
$mst_material_part_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$mst_material_part_delete->lRecCnt++;

	// Set row properties
	$mst_material_part->CssClass = "";
	$mst_material_part->CssStyle = "";
	$mst_material_part->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$mst_material_part_delete->LoadRowValues($rs);

	// Render row
	$mst_material_part_delete->RenderRow();
?>
	<tr<?php echo $mst_material_part->RowAttributes() ?>>
		<td<?php echo $mst_material_part->kode->CellAttributes() ?>>
<div<?php echo $mst_material_part->kode->ViewAttributes() ?>><?php echo $mst_material_part->kode->ListViewValue() ?></div></td>
		<td<?php echo $mst_material_part->pn->CellAttributes() ?>>
<div<?php echo $mst_material_part->pn->ViewAttributes() ?>><?php echo $mst_material_part->pn->ListViewValue() ?></div></td>
		<td<?php echo $mst_material_part->category->CellAttributes() ?>>
<div<?php echo $mst_material_part->category->ViewAttributes() ?>><?php echo $mst_material_part->category->ListViewValue() ?></div></td>
		<td<?php echo $mst_material_part->modelunit->CellAttributes() ?>>
<div<?php echo $mst_material_part->modelunit->ViewAttributes() ?>><?php echo $mst_material_part->modelunit->ListViewValue() ?></div></td>
		<td<?php echo $mst_material_part->nama->CellAttributes() ?>>
<div<?php echo $mst_material_part->nama->ViewAttributes() ?>><?php echo $mst_material_part->nama->ListViewValue() ?></div></td>
		<td<?php echo $mst_material_part->satuan->CellAttributes() ?>>
<div<?php echo $mst_material_part->satuan->ViewAttributes() ?>><?php echo $mst_material_part->satuan->ListViewValue() ?></div></td>
		<td<?php echo $mst_material_part->keterangan->CellAttributes() ?>>
<div<?php echo $mst_material_part->keterangan->ViewAttributes() ?>><?php echo $mst_material_part->keterangan->ListViewValue() ?></div></td>
		<td<?php echo $mst_material_part->coa->CellAttributes() ?>>
<div<?php echo $mst_material_part->coa->ViewAttributes() ?>><?php echo $mst_material_part->coa->ListViewValue() ?></div></td>
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
$mst_material_part_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_material_part_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'mst_material_part';

	// Page Object Name
	var $PageObjName = 'mst_material_part_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_material_part;
		if ($mst_material_part->UseTokenInUrl) $PageUrl .= "t=" . $mst_material_part->TableVar . "&"; // add page token
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
		global $objForm, $mst_material_part;
		if ($mst_material_part->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_material_part->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_material_part->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_material_part_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_material_part"] = new cmst_material_part();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_material_part', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_material_part;

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
		global $mst_material_part;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["kode"] <> "") {
			$mst_material_part->kode->setQueryStringValue($_GET["kode"]);
			$sKey .= $mst_material_part->kode->QueryStringValue;
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
			$this->Page_Terminate("mst_material_partlist.php"); // No key specified, return to list

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
		// SQL constructor in SQL constructor in mst_material_part class, mst_material_partinfo.php

		$mst_material_part->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$mst_material_part->CurrentAction = $_POST["a_delete"];
		} else {
			$mst_material_part->CurrentAction = "I"; // Display record
		}
		switch ($mst_material_part->CurrentAction) {
			case "D": // Delete
				$mst_material_part->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($mst_material_part->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $mst_material_part;
		$DeleteRows = TRUE;
		$sWrkFilter = $mst_material_part->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in mst_material_part class, mst_material_partinfo.php

		$mst_material_part->CurrentFilter = $sWrkFilter;
		$sSql = $mst_material_part->SQL();
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
				$DeleteRows = $mst_material_part->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($mst_material_part->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($mst_material_part->CancelMessage <> "") {
				$this->setMessage($mst_material_part->CancelMessage);
				$mst_material_part->CancelMessage = "";
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
				$mst_material_part->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mst_material_part;

		// Call Recordset Selecting event
		$mst_material_part->Recordset_Selecting($mst_material_part->CurrentFilter);

		// Load list page SQL
		$sSql = $mst_material_part->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$mst_material_part->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_material_part;
		$sFilter = $mst_material_part->KeyFilter();

		// Call Row Selecting event
		$mst_material_part->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_material_part->CurrentFilter = $sFilter;
		$sSql = $mst_material_part->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_material_part->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_material_part;
		$mst_material_part->kode->setDbValue($rs->fields('kode'));
		$mst_material_part->modepart->setDbValue($rs->fields('modepart'));
		$mst_material_part->pn->setDbValue($rs->fields('pn'));
		$mst_material_part->category->setDbValue($rs->fields('category'));
		$mst_material_part->modelunit->setDbValue($rs->fields('modelunit'));
		$mst_material_part->nama->setDbValue($rs->fields('nama'));
		$mst_material_part->satuan->setDbValue($rs->fields('satuan'));
		$mst_material_part->keterangan->setDbValue($rs->fields('keterangan'));
		$mst_material_part->coa->setDbValue($rs->fields('coa'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_material_part;

		// Call Row_Rendering event
		$mst_material_part->Row_Rendering();

		// Common render codes for all row types
		// kode

		$mst_material_part->kode->CellCssStyle = "white-space: nowrap;";
		$mst_material_part->kode->CellCssClass = "";

		// pn
		$mst_material_part->pn->CellCssStyle = "white-space: nowrap;";
		$mst_material_part->pn->CellCssClass = "";

		// category
		$mst_material_part->category->CellCssStyle = "white-space: nowrap;";
		$mst_material_part->category->CellCssClass = "";

		// modelunit
		$mst_material_part->modelunit->CellCssStyle = "white-space: nowrap;";
		$mst_material_part->modelunit->CellCssClass = "";

		// nama
		$mst_material_part->nama->CellCssStyle = "white-space: nowrap;";
		$mst_material_part->nama->CellCssClass = "";

		// satuan
		$mst_material_part->satuan->CellCssStyle = "white-space: nowrap;";
		$mst_material_part->satuan->CellCssClass = "";

		// keterangan
		$mst_material_part->keterangan->CellCssStyle = "white-space: nowrap;";
		$mst_material_part->keterangan->CellCssClass = "";

		// coa
		$mst_material_part->coa->CellCssStyle = "white-space: nowrap;";
		$mst_material_part->coa->CellCssClass = "";
		if ($mst_material_part->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$mst_material_part->kode->ViewValue = $mst_material_part->kode->CurrentValue;
			$mst_material_part->kode->CssStyle = "";
			$mst_material_part->kode->CssClass = "";
			$mst_material_part->kode->ViewCustomAttributes = "";

			// pn
			$mst_material_part->pn->ViewValue = $mst_material_part->pn->CurrentValue;
			$mst_material_part->pn->CssStyle = "";
			$mst_material_part->pn->CssClass = "";
			$mst_material_part->pn->ViewCustomAttributes = "";

			// category
			if (strval($mst_material_part->category->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `description` FROM `mst_material_cat` WHERE `id` = '" . ew_AdjustSql($mst_material_part->category->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_material_part->category->ViewValue = $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$mst_material_part->category->ViewValue = $mst_material_part->category->CurrentValue;
				}
			} else {
				$mst_material_part->category->ViewValue = NULL;
			}
			$mst_material_part->category->CssStyle = "";
			$mst_material_part->category->CssClass = "";
			$mst_material_part->category->ViewCustomAttributes = "";

			// modelunit
			if (strval($mst_material_part->modelunit->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `model` FROM `mst_modelunit` WHERE `kode` = '" . ew_AdjustSql($mst_material_part->modelunit->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_material_part->modelunit->ViewValue = $rswrk->fields('model');
					$rswrk->Close();
				} else {
					$mst_material_part->modelunit->ViewValue = $mst_material_part->modelunit->CurrentValue;
				}
			} else {
				$mst_material_part->modelunit->ViewValue = NULL;
			}
			$mst_material_part->modelunit->CssStyle = "";
			$mst_material_part->modelunit->CssClass = "";
			$mst_material_part->modelunit->ViewCustomAttributes = "";

			// nama
			$mst_material_part->nama->ViewValue = $mst_material_part->nama->CurrentValue;
			$mst_material_part->nama->CssStyle = "";
			$mst_material_part->nama->CssClass = "";
			$mst_material_part->nama->ViewCustomAttributes = "";

			// satuan
			if (strval($mst_material_part->satuan->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `singkatan` FROM `mst_satuan` WHERE `kode` = '" . ew_AdjustSql($mst_material_part->satuan->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_material_part->satuan->ViewValue = $rswrk->fields('singkatan');
					$rswrk->Close();
				} else {
					$mst_material_part->satuan->ViewValue = $mst_material_part->satuan->CurrentValue;
				}
			} else {
				$mst_material_part->satuan->ViewValue = NULL;
			}
			$mst_material_part->satuan->CssStyle = "";
			$mst_material_part->satuan->CssClass = "";
			$mst_material_part->satuan->ViewCustomAttributes = "";

			// keterangan
			$mst_material_part->keterangan->ViewValue = $mst_material_part->keterangan->CurrentValue;
			$mst_material_part->keterangan->CssStyle = "";
			$mst_material_part->keterangan->CssClass = "";
			$mst_material_part->keterangan->ViewCustomAttributes = "";

			// coa
			if (strval($mst_material_part->coa->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `coa`, `description` FROM `acc_mst_coa` WHERE `coa` = '" . ew_AdjustSql($mst_material_part->coa->CurrentValue) . "'";
				$sSqlWrk .= " AND (" . "`description`<>''" . ")";
				$sSqlWrk .= " ORDER BY `coa` ";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_material_part->coa->ViewValue = $rswrk->fields('coa');
					$mst_material_part->coa->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$mst_material_part->coa->ViewValue = $mst_material_part->coa->CurrentValue;
				}
			} else {
				$mst_material_part->coa->ViewValue = NULL;
			}
			$mst_material_part->coa->CssStyle = "";
			$mst_material_part->coa->CssClass = "";
			$mst_material_part->coa->ViewCustomAttributes = "";

			// kode
			$mst_material_part->kode->HrefValue = "";

			// pn
			$mst_material_part->pn->HrefValue = "";

			// category
			$mst_material_part->category->HrefValue = "";

			// modelunit
			$mst_material_part->modelunit->HrefValue = "";

			// nama
			$mst_material_part->nama->HrefValue = "";

			// satuan
			$mst_material_part->satuan->HrefValue = "";

			// keterangan
			$mst_material_part->keterangan->HrefValue = "";

			// coa
			$mst_material_part->coa->HrefValue = "";
		}

		// Call Row Rendered event
		$mst_material_part->Row_Rendered();
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
