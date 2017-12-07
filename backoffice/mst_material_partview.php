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
$mst_material_part_view = new cmst_material_part_view();
$Page =& $mst_material_part_view;

// Page init processing
$mst_material_part_view->Page_Init();

// Page main processing
$mst_material_part_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($mst_material_part->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var mst_material_part_view = new ew_Page("mst_material_part_view");

// page properties
mst_material_part_view.PageID = "view"; // page ID
var EW_PAGE_ID = mst_material_part_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
mst_material_part_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_material_part_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_material_part_view.ValidateRequired = false; // no JavaScript validation
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
<?php } ?>
<p><span class="phpmaker">View <h3><b>Master Barang</b></h3>
<br><br>
<?php if ($mst_material_part->Export == "") { ?>
<!--a href="mst_material_partlist.php">Back to List</a-->&nbsp;
<input type="button" value="Kembali" onclick="window.location='mst_material_partlist.php';">
<a href="<?php echo $mst_material_part->AddUrl() ?>">Add</a>&nbsp;
<a href="<?php echo $mst_material_part->EditUrl() ?>">Edit</a>&nbsp;
<a href="<?php echo $mst_material_part->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
</span></p>
<?php $mst_material_part_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($mst_material_part->kode->Visible) { // kode ?>
	<tr<?php echo $mst_material_part->kode->RowAttributes ?>>
		<td class="ewTableHeader">Kode</td>
		<td<?php echo $mst_material_part->kode->CellAttributes() ?>>
<div<?php echo $mst_material_part->kode->ViewAttributes() ?>><?php echo $mst_material_part->kode->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_material_part->modepart->Visible) { // modepart ?>
	<tr<?php echo $mst_material_part->modepart->RowAttributes ?>>
		<td class="ewTableHeader">Modepart</td>
		<td<?php echo $mst_material_part->modepart->CellAttributes() ?>>
<div<?php echo $mst_material_part->modepart->ViewAttributes() ?>><?php echo $mst_material_part->modepart->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_material_part->pn->Visible) { // pn ?>
	<tr<?php echo $mst_material_part->pn->RowAttributes ?>>
		<td class="ewTableHeader">Serial Number</td>
		<td<?php echo $mst_material_part->pn->CellAttributes() ?>>
<div<?php echo $mst_material_part->pn->ViewAttributes() ?>><?php echo $mst_material_part->pn->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_material_part->category->Visible) { // category ?>
	<tr<?php echo $mst_material_part->category->RowAttributes ?>>
		<td class="ewTableHeader">Category</td>
		<td<?php echo $mst_material_part->category->CellAttributes() ?>>
<div<?php echo $mst_material_part->category->ViewAttributes() ?>><?php echo $mst_material_part->category->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_material_part->modelunit->Visible) { // modelunit ?>
	<tr<?php echo $mst_material_part->modelunit->RowAttributes ?>>
		<td class="ewTableHeader">Tipe Barang</td>
		<td<?php echo $mst_material_part->modelunit->CellAttributes() ?>>
<div<?php echo $mst_material_part->modelunit->ViewAttributes() ?>><?php echo $mst_material_part->modelunit->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_material_part->nama->Visible) { // nama ?>
	<tr<?php echo $mst_material_part->nama->RowAttributes ?>>
		<td class="ewTableHeader">Nama</td>
		<td<?php echo $mst_material_part->nama->CellAttributes() ?>>
<div<?php echo $mst_material_part->nama->ViewAttributes() ?>><?php echo $mst_material_part->nama->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_material_part->satuan->Visible) { // satuan ?>
	<tr<?php echo $mst_material_part->satuan->RowAttributes ?>>
		<td class="ewTableHeader">Satuan</td>
		<td<?php echo $mst_material_part->satuan->CellAttributes() ?>>
<div<?php echo $mst_material_part->satuan->ViewAttributes() ?>><?php echo $mst_material_part->satuan->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_material_part->keterangan->Visible) { // keterangan ?>
	<tr<?php echo $mst_material_part->keterangan->RowAttributes ?>>
		<td class="ewTableHeader">Keterangan</td>
		<td<?php echo $mst_material_part->keterangan->CellAttributes() ?>>
<div<?php echo $mst_material_part->keterangan->ViewAttributes() ?>><?php echo $mst_material_part->keterangan->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_material_part->coa->Visible) { // coa ?>
	<tr<?php echo $mst_material_part->coa->RowAttributes ?>>
		<td class="ewTableHeader">COA</td>
		<td<?php echo $mst_material_part->coa->CellAttributes() ?>>
<div<?php echo $mst_material_part->coa->ViewAttributes() ?>><?php echo $mst_material_part->coa->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($mst_material_part->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$mst_material_part_view->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_material_part_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'mst_material_part';

	// Page Object Name
	var $PageObjName = 'mst_material_part_view';

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
	function cmst_material_part_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_material_part"] = new cmst_material_part();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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
	var $lDisplayRecs; // Number of display records
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs;
	var $lRecRange;
	var $lRecCnt;

	//
	// Page main processing
	//
	function Page_Main() {
		global $mst_material_part;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["kode"] <> "") {
				$mst_material_part->kode->setQueryStringValue($_GET["kode"]);
			} else {
				$sReturnUrl = "mst_material_partlist.php"; // Return to list
			}

			// Get action
			$mst_material_part->CurrentAction = "I"; // Display form
			switch ($mst_material_part->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "mst_material_partlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "mst_material_partlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$mst_material_part->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $mst_material_part;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$mst_material_part->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$mst_material_part->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $mst_material_part->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$mst_material_part->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$mst_material_part->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$mst_material_part->setStartRecordNumber($this->lStartRec);
		}
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

		$mst_material_part->kode->CellCssStyle = "";
		$mst_material_part->kode->CellCssClass = "";

		// modepart
		$mst_material_part->modepart->CellCssStyle = "";
		$mst_material_part->modepart->CellCssClass = "";

		// pn
		$mst_material_part->pn->CellCssStyle = "";
		$mst_material_part->pn->CellCssClass = "";

		// category
		$mst_material_part->category->CellCssStyle = "";
		$mst_material_part->category->CellCssClass = "";

		// modelunit
		$mst_material_part->modelunit->CellCssStyle = "";
		$mst_material_part->modelunit->CellCssClass = "";

		// nama
		$mst_material_part->nama->CellCssStyle = "";
		$mst_material_part->nama->CellCssClass = "";

		// satuan
		$mst_material_part->satuan->CellCssStyle = "";
		$mst_material_part->satuan->CellCssClass = "";

		// keterangan
		$mst_material_part->keterangan->CellCssStyle = "";
		$mst_material_part->keterangan->CellCssClass = "";

		// coa
		$mst_material_part->coa->CellCssStyle = "";
		$mst_material_part->coa->CellCssClass = "";
		if ($mst_material_part->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$mst_material_part->kode->ViewValue = $mst_material_part->kode->CurrentValue;
			$mst_material_part->kode->CssStyle = "";
			$mst_material_part->kode->CssClass = "";
			$mst_material_part->kode->ViewCustomAttributes = "";

			// modepart
			$mst_material_part->modepart->ViewValue = $mst_material_part->modepart->CurrentValue;
			$mst_material_part->modepart->CssStyle = "";
			$mst_material_part->modepart->CssClass = "";
			$mst_material_part->modepart->ViewCustomAttributes = "";

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

			// modepart
			$mst_material_part->modepart->HrefValue = "";

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
