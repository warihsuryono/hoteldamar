<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "asset_detailinfo.php" ?>
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
$asset_detail_delete = new casset_detail_delete();
$Page =& $asset_detail_delete;

// Page init processing
$asset_detail_delete->Page_Init();

// Page main processing
$asset_detail_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var asset_detail_delete = new ew_Page("asset_detail_delete");

// page properties
asset_detail_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = asset_detail_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
asset_detail_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
asset_detail_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
asset_detail_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $asset_detail_delete->LoadRecordset();
$asset_detail_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($asset_detail_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$asset_detail_delete->Page_Terminate("asset_detaillist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From <h3><b>Asset Detail</b></h3><br><br>
<a href="<?php echo $asset_detail->getReturnUrl() ?>">Go Back</a></span></p>
<?php $asset_detail_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="asset_detail">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($asset_detail_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $asset_detail->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Kode</td>
		<td valign="top">Category</td>
		<td valign="top">Kode Barang</td>
		<td valign="top">Nama Barang</td>
		<td valign="top">Jml</td>
		<td valign="top">Tgl Pembelian</td>
		<td valign="top">Nilai Pembelian</td>
	</tr>
	</thead>
	<tbody>
<?php
$asset_detail_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$asset_detail_delete->lRecCnt++;

	// Set row properties
	$asset_detail->CssClass = "";
	$asset_detail->CssStyle = "";
	$asset_detail->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$asset_detail_delete->LoadRowValues($rs);

	// Render row
	$asset_detail_delete->RenderRow();
?>
	<tr<?php echo $asset_detail->RowAttributes() ?>>
		<td<?php echo $asset_detail->kode->CellAttributes() ?>>
<div<?php echo $asset_detail->kode->ViewAttributes() ?>><?php echo $asset_detail->kode->ListViewValue() ?></div></td>
		<td<?php echo $asset_detail->category->CellAttributes() ?>>
<div<?php echo $asset_detail->category->ViewAttributes() ?>><?php echo $asset_detail->category->ListViewValue() ?></div></td>
		<td<?php echo $asset_detail->kode_barang->CellAttributes() ?>>
<div<?php echo $asset_detail->kode_barang->ViewAttributes() ?>><?php echo $asset_detail->kode_barang->ListViewValue() ?></div></td>
		<td<?php echo $asset_detail->nama_barang->CellAttributes() ?>>
<div<?php echo $asset_detail->nama_barang->ViewAttributes() ?>><?php echo $asset_detail->nama_barang->ListViewValue() ?></div></td>
		<td<?php echo $asset_detail->jml->CellAttributes() ?>>
<div<?php echo $asset_detail->jml->ViewAttributes() ?>><?php echo $asset_detail->jml->ListViewValue() ?></div></td>
		<td<?php echo $asset_detail->tgl_pembelian->CellAttributes() ?>>
<div<?php echo $asset_detail->tgl_pembelian->ViewAttributes() ?>><?php echo $asset_detail->tgl_pembelian->ListViewValue() ?></div></td>
		<td<?php echo $asset_detail->nilai_pembelian->CellAttributes() ?>>
<div<?php echo $asset_detail->nilai_pembelian->ViewAttributes() ?>><?php echo $asset_detail->nilai_pembelian->ListViewValue() ?></div></td>
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
$asset_detail_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class casset_detail_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'asset_detail';

	// Page Object Name
	var $PageObjName = 'asset_detail_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $asset_detail;
		if ($asset_detail->UseTokenInUrl) $PageUrl .= "t=" . $asset_detail->TableVar . "&"; // add page token
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
		global $objForm, $asset_detail;
		if ($asset_detail->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($asset_detail->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($asset_detail->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function casset_detail_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["asset_detail"] = new casset_detail();

		// Initialize other table object
		$GLOBALS['asset_category'] = new casset_category();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'asset_detail', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $asset_detail;

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
		global $asset_detail;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["kode"] <> "") {
			$asset_detail->kode->setQueryStringValue($_GET["kode"]);
			if (!is_numeric($asset_detail->kode->QueryStringValue))
				$this->Page_Terminate("asset_detaillist.php"); // Prevent SQL injection, exit
			$sKey .= $asset_detail->kode->QueryStringValue;
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
			$this->Page_Terminate("asset_detaillist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("asset_detaillist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`kode`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in asset_detail class, asset_detailinfo.php

		$asset_detail->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$asset_detail->CurrentAction = $_POST["a_delete"];
		} else {
			$asset_detail->CurrentAction = "I"; // Display record
		}
		switch ($asset_detail->CurrentAction) {
			case "D": // Delete
				$asset_detail->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($asset_detail->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $asset_detail;
		$DeleteRows = TRUE;
		$sWrkFilter = $asset_detail->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in asset_detail class, asset_detailinfo.php

		$asset_detail->CurrentFilter = $sWrkFilter;
		$sSql = $asset_detail->SQL();
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
				$DeleteRows = $asset_detail->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($asset_detail->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($asset_detail->CancelMessage <> "") {
				$this->setMessage($asset_detail->CancelMessage);
				$asset_detail->CancelMessage = "";
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
				$asset_detail->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $asset_detail;

		// Call Recordset Selecting event
		$asset_detail->Recordset_Selecting($asset_detail->CurrentFilter);

		// Load list page SQL
		$sSql = $asset_detail->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$asset_detail->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $asset_detail;
		$sFilter = $asset_detail->KeyFilter();

		// Call Row Selecting event
		$asset_detail->Row_Selecting($sFilter);

		// Load sql based on filter
		$asset_detail->CurrentFilter = $sFilter;
		$sSql = $asset_detail->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$asset_detail->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $asset_detail;
		$asset_detail->kode->setDbValue($rs->fields('kode'));
		$asset_detail->category->setDbValue($rs->fields('category'));
		$asset_detail->kode_barang->setDbValue($rs->fields('kode_barang'));
		$asset_detail->nama_barang->setDbValue($rs->fields('nama_barang'));
		$asset_detail->jml->setDbValue($rs->fields('jml'));
		$asset_detail->tgl_pembelian->setDbValue($rs->fields('tgl_pembelian'));
		$asset_detail->nilai_pembelian->setDbValue($rs->fields('nilai_pembelian'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $asset_detail;

		// Call Row_Rendering event
		$asset_detail->Row_Rendering();

		// Common render codes for all row types
		// kode

		$asset_detail->kode->CellCssStyle = "white-space: nowrap;";
		$asset_detail->kode->CellCssClass = "";

		// category
		$asset_detail->category->CellCssStyle = "white-space: nowrap;";
		$asset_detail->category->CellCssClass = "";

		// kode_barang
		$asset_detail->kode_barang->CellCssStyle = "white-space: nowrap;";
		$asset_detail->kode_barang->CellCssClass = "";

		// nama_barang
		$asset_detail->nama_barang->CellCssStyle = "white-space: nowrap;";
		$asset_detail->nama_barang->CellCssClass = "";

		// jml
		$asset_detail->jml->CellCssStyle = "white-space: nowrap;";
		$asset_detail->jml->CellCssClass = "";

		// tgl_pembelian
		$asset_detail->tgl_pembelian->CellCssStyle = "white-space: nowrap;";
		$asset_detail->tgl_pembelian->CellCssClass = "";

		// nilai_pembelian
		$asset_detail->nilai_pembelian->CellCssStyle = "white-space: nowrap;";
		$asset_detail->nilai_pembelian->CellCssClass = "";
		if ($asset_detail->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$asset_detail->kode->ViewValue = $asset_detail->kode->CurrentValue;
			$asset_detail->kode->CssStyle = "";
			$asset_detail->kode->CssClass = "";
			$asset_detail->kode->ViewCustomAttributes = "";

			// category
			if (strval($asset_detail->category->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `category` FROM `asset_category` WHERE `kode` = " . ew_AdjustSql($asset_detail->category->CurrentValue) . "";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$asset_detail->category->ViewValue = $rswrk->fields('category');
					$rswrk->Close();
				} else {
					$asset_detail->category->ViewValue = $asset_detail->category->CurrentValue;
				}
			} else {
				$asset_detail->category->ViewValue = NULL;
			}
			$asset_detail->category->CssStyle = "";
			$asset_detail->category->CssClass = "";
			$asset_detail->category->ViewCustomAttributes = "nowrap";

			// kode_barang
			$asset_detail->kode_barang->ViewValue = $asset_detail->kode_barang->CurrentValue;
			$asset_detail->kode_barang->CssStyle = "";
			$asset_detail->kode_barang->CssClass = "";
			$asset_detail->kode_barang->ViewCustomAttributes = "";

			// nama_barang
			$asset_detail->nama_barang->ViewValue = $asset_detail->nama_barang->CurrentValue;
			$asset_detail->nama_barang->CssStyle = "";
			$asset_detail->nama_barang->CssClass = "";
			$asset_detail->nama_barang->ViewCustomAttributes = "";

			// jml
			$asset_detail->jml->ViewValue = $asset_detail->jml->CurrentValue;
			$asset_detail->jml->CssStyle = "text-align:right;";
			$asset_detail->jml->CssClass = "";
			$asset_detail->jml->ViewCustomAttributes = "";

			// tgl_pembelian
			$asset_detail->tgl_pembelian->ViewValue = $asset_detail->tgl_pembelian->CurrentValue;
			$asset_detail->tgl_pembelian->ViewValue = ew_FormatDateTime($asset_detail->tgl_pembelian->ViewValue, 7);
			$asset_detail->tgl_pembelian->CssStyle = "";
			$asset_detail->tgl_pembelian->CssClass = "";
			$asset_detail->tgl_pembelian->ViewCustomAttributes = "";

			// nilai_pembelian
			$asset_detail->nilai_pembelian->ViewValue = $asset_detail->nilai_pembelian->CurrentValue;
			$asset_detail->nilai_pembelian->ViewValue = ew_FormatNumber($asset_detail->nilai_pembelian->ViewValue, 0, -2, -2, -2);
			$asset_detail->nilai_pembelian->CssStyle = "text-align:right;";
			$asset_detail->nilai_pembelian->CssClass = "";
			$asset_detail->nilai_pembelian->ViewCustomAttributes = "";

			// kode
			$asset_detail->kode->HrefValue = "";

			// category
			$asset_detail->category->HrefValue = "";

			// kode_barang
			$asset_detail->kode_barang->HrefValue = "";

			// nama_barang
			$asset_detail->nama_barang->HrefValue = "";

			// jml
			$asset_detail->jml->HrefValue = "";

			// tgl_pembelian
			$asset_detail->tgl_pembelian->HrefValue = "";

			// nilai_pembelian
			$asset_detail->nilai_pembelian->HrefValue = "";
		}

		// Call Row Rendered event
		$asset_detail->Row_Rendered();
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
