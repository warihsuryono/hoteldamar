<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_room_priceinfo.php" ?>
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
$mst_room_price_view = new cmst_room_price_view();
$Page =& $mst_room_price_view;

// Page init processing
$mst_room_price_view->Page_Init();

// Page main processing
$mst_room_price_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($mst_room_price->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var mst_room_price_view = new ew_Page("mst_room_price_view");

// page properties
mst_room_price_view.PageID = "view"; // page ID
var EW_PAGE_ID = mst_room_price_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
mst_room_price_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_room_price_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_room_price_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">View <h3><b>Master Room Price</b></h3>
<br><br>
<?php if ($mst_room_price->Export == "") { ?>
<!--a href="mst_room_pricelist.php">Back to List</a-->&nbsp;
<input type="button" value="Kembali" onclick="window.location='mst_room_pricelist.php';">
<a href="<?php echo $mst_room_price->AddUrl() ?>">Add</a>&nbsp;
<a href="<?php echo $mst_room_price->EditUrl() ?>">Edit</a>&nbsp;
<a href="<?php echo $mst_room_price->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
</span></p>
<?php $mst_room_price_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($mst_room_price->id->Visible) { // id ?>
	<tr<?php echo $mst_room_price->id->RowAttributes ?>>
		<td class="ewTableHeader">Id</td>
		<td<?php echo $mst_room_price->id->CellAttributes() ?>>
<div<?php echo $mst_room_price->id->ViewAttributes() ?>><?php echo $mst_room_price->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_room_price->tanggal1->Visible) { // tanggal1 ?>
	<tr<?php echo $mst_room_price->tanggal1->RowAttributes ?>>
		<td class="ewTableHeader">Start Date</td>
		<td<?php echo $mst_room_price->tanggal1->CellAttributes() ?>>
<div<?php echo $mst_room_price->tanggal1->ViewAttributes() ?>><?php echo $mst_room_price->tanggal1->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_room_price->tanggal2->Visible) { // tanggal2 ?>
	<tr<?php echo $mst_room_price->tanggal2->RowAttributes ?>>
		<td class="ewTableHeader">End Date</td>
		<td<?php echo $mst_room_price->tanggal2->CellAttributes() ?>>
<div<?php echo $mst_room_price->tanggal2->ViewAttributes() ?>><?php echo $mst_room_price->tanggal2->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_room_price->room->Visible) { // room ?>
	<tr<?php echo $mst_room_price->room->RowAttributes ?>>
		<td class="ewTableHeader">Room</td>
		<td<?php echo $mst_room_price->room->CellAttributes() ?>>
<div<?php echo $mst_room_price->room->ViewAttributes() ?>><?php echo $mst_room_price->room->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_room_price->roomtype->Visible) { // roomtype ?>
	<tr<?php echo $mst_room_price->roomtype->RowAttributes ?>>
		<td class="ewTableHeader">Room Type</td>
		<td<?php echo $mst_room_price->roomtype->CellAttributes() ?>>
<div<?php echo $mst_room_price->roomtype->ViewAttributes() ?>><?php echo $mst_room_price->roomtype->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_room_price->description->Visible) { // description ?>
	<tr<?php echo $mst_room_price->description->RowAttributes ?>>
		<td class="ewTableHeader">Description</td>
		<td<?php echo $mst_room_price->description->CellAttributes() ?>>
<div<?php echo $mst_room_price->description->ViewAttributes() ?>><?php echo $mst_room_price->description->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_room_price->baseprice->Visible) { // baseprice ?>
	<tr<?php echo $mst_room_price->baseprice->RowAttributes ?>>
		<td class="ewTableHeader">Base Price</td>
		<td<?php echo $mst_room_price->baseprice->CellAttributes() ?>>
<div<?php echo $mst_room_price->baseprice->ViewAttributes() ?>><?php echo $mst_room_price->baseprice->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_room_price->tax->Visible) { // tax ?>
	<tr<?php echo $mst_room_price->tax->RowAttributes ?>>
		<td class="ewTableHeader">Tax (%)</td>
		<td<?php echo $mst_room_price->tax->CellAttributes() ?>>
<div<?php echo $mst_room_price->tax->ViewAttributes() ?>><?php echo $mst_room_price->tax->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_room_price->service->Visible) { // service ?>
	<tr<?php echo $mst_room_price->service->RowAttributes ?>>
		<td class="ewTableHeader">Service (%)</td>
		<td<?php echo $mst_room_price->service->CellAttributes() ?>>
<div<?php echo $mst_room_price->service->ViewAttributes() ?>><?php echo $mst_room_price->service->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_room_price->aftertaxservice->Visible) { // aftertaxservice ?>
	<tr<?php echo $mst_room_price->aftertaxservice->RowAttributes ?>>
		<td class="ewTableHeader">After Tax&Service</td>
		<td<?php echo $mst_room_price->aftertaxservice->CellAttributes() ?>>
<div<?php echo $mst_room_price->aftertaxservice->ViewAttributes() ?>><?php echo $mst_room_price->aftertaxservice->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_room_price->createby->Visible) { // createby ?>
	<tr<?php echo $mst_room_price->createby->RowAttributes ?>>
		<td class="ewTableHeader">Create By</td>
		<td<?php echo $mst_room_price->createby->CellAttributes() ?>>
<div<?php echo $mst_room_price->createby->ViewAttributes() ?>><?php echo $mst_room_price->createby->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_room_price->createdate->Visible) { // createdate ?>
	<tr<?php echo $mst_room_price->createdate->RowAttributes ?>>
		<td class="ewTableHeader">Create Date</td>
		<td<?php echo $mst_room_price->createdate->CellAttributes() ?>>
<div<?php echo $mst_room_price->createdate->ViewAttributes() ?>><?php echo $mst_room_price->createdate->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($mst_room_price->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$mst_room_price_view->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_room_price_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'mst_room_price';

	// Page Object Name
	var $PageObjName = 'mst_room_price_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_room_price;
		if ($mst_room_price->UseTokenInUrl) $PageUrl .= "t=" . $mst_room_price->TableVar . "&"; // add page token
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
		global $objForm, $mst_room_price;
		if ($mst_room_price->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_room_price->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_room_price->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_room_price_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_room_price"] = new cmst_room_price();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_room_price', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_room_price;

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
		global $mst_room_price;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$mst_room_price->id->setQueryStringValue($_GET["id"]);
			} else {
				$sReturnUrl = "mst_room_pricelist.php"; // Return to list
			}

			// Get action
			$mst_room_price->CurrentAction = "I"; // Display form
			switch ($mst_room_price->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "mst_room_pricelist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "mst_room_pricelist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$mst_room_price->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $mst_room_price;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$mst_room_price->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$mst_room_price->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $mst_room_price->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$mst_room_price->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$mst_room_price->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$mst_room_price->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_room_price;
		$sFilter = $mst_room_price->KeyFilter();

		// Call Row Selecting event
		$mst_room_price->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_room_price->CurrentFilter = $sFilter;
		$sSql = $mst_room_price->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_room_price->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_room_price;
		$mst_room_price->id->setDbValue($rs->fields('id'));
		$mst_room_price->tanggal1->setDbValue($rs->fields('tanggal1'));
		$mst_room_price->tanggal2->setDbValue($rs->fields('tanggal2'));
		$mst_room_price->room->setDbValue($rs->fields('room'));
		$mst_room_price->roomtype->setDbValue($rs->fields('roomtype'));
		$mst_room_price->description->setDbValue($rs->fields('description'));
		$mst_room_price->baseprice->setDbValue($rs->fields('baseprice'));
		$mst_room_price->tax->setDbValue($rs->fields('tax'));
		$mst_room_price->service->setDbValue($rs->fields('service'));
		$mst_room_price->aftertaxservice->setDbValue($rs->fields('aftertaxservice'));
		$mst_room_price->createby->setDbValue($rs->fields('createby'));
		$mst_room_price->createdate->setDbValue($rs->fields('createdate'));
		$mst_room_price->xtimestamp->setDbValue($rs->fields('xtimestamp'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_room_price;

		// Call Row_Rendering event
		$mst_room_price->Row_Rendering();

		// Common render codes for all row types
		// id

		$mst_room_price->id->CellCssStyle = "";
		$mst_room_price->id->CellCssClass = "";

		// tanggal1
		$mst_room_price->tanggal1->CellCssStyle = "";
		$mst_room_price->tanggal1->CellCssClass = "";

		// tanggal2
		$mst_room_price->tanggal2->CellCssStyle = "";
		$mst_room_price->tanggal2->CellCssClass = "";

		// room
		$mst_room_price->room->CellCssStyle = "";
		$mst_room_price->room->CellCssClass = "";

		// roomtype
		$mst_room_price->roomtype->CellCssStyle = "";
		$mst_room_price->roomtype->CellCssClass = "";

		// description
		$mst_room_price->description->CellCssStyle = "";
		$mst_room_price->description->CellCssClass = "";

		// baseprice
		$mst_room_price->baseprice->CellCssStyle = "";
		$mst_room_price->baseprice->CellCssClass = "";

		// tax
		$mst_room_price->tax->CellCssStyle = "";
		$mst_room_price->tax->CellCssClass = "";

		// service
		$mst_room_price->service->CellCssStyle = "";
		$mst_room_price->service->CellCssClass = "";

		// aftertaxservice
		$mst_room_price->aftertaxservice->CellCssStyle = "";
		$mst_room_price->aftertaxservice->CellCssClass = "";

		// createby
		$mst_room_price->createby->CellCssStyle = "";
		$mst_room_price->createby->CellCssClass = "";

		// createdate
		$mst_room_price->createdate->CellCssStyle = "";
		$mst_room_price->createdate->CellCssClass = "";
		if ($mst_room_price->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$mst_room_price->id->ViewValue = $mst_room_price->id->CurrentValue;
			$mst_room_price->id->CssStyle = "";
			$mst_room_price->id->CssClass = "";
			$mst_room_price->id->ViewCustomAttributes = "";

			// tanggal1
			$mst_room_price->tanggal1->ViewValue = $mst_room_price->tanggal1->CurrentValue;
			$mst_room_price->tanggal1->ViewValue = ew_FormatDateTime($mst_room_price->tanggal1->ViewValue, 7);
			$mst_room_price->tanggal1->CssStyle = "";
			$mst_room_price->tanggal1->CssClass = "";
			$mst_room_price->tanggal1->ViewCustomAttributes = "";

			// tanggal2
			$mst_room_price->tanggal2->ViewValue = $mst_room_price->tanggal2->CurrentValue;
			$mst_room_price->tanggal2->ViewValue = ew_FormatDateTime($mst_room_price->tanggal2->ViewValue, 7);
			$mst_room_price->tanggal2->CssStyle = "";
			$mst_room_price->tanggal2->CssClass = "";
			$mst_room_price->tanggal2->ViewCustomAttributes = "";

			// room
			if (strval($mst_room_price->room->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `mst_room` WHERE `kode` = '" . ew_AdjustSql($mst_room_price->room->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_room_price->room->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$mst_room_price->room->ViewValue = $mst_room_price->room->CurrentValue;
				}
			} else {
				$mst_room_price->room->ViewValue = NULL;
			}
			$mst_room_price->room->CssStyle = "";
			$mst_room_price->room->CssClass = "";
			$mst_room_price->room->ViewCustomAttributes = "";

			// roomtype
			if (strval($mst_room_price->roomtype->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `description` FROM `mst_room_type` WHERE `id` = '" . ew_AdjustSql($mst_room_price->roomtype->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_room_price->roomtype->ViewValue = $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$mst_room_price->roomtype->ViewValue = $mst_room_price->roomtype->CurrentValue;
				}
			} else {
				$mst_room_price->roomtype->ViewValue = NULL;
			}
			$mst_room_price->roomtype->CssStyle = "";
			$mst_room_price->roomtype->CssClass = "";
			$mst_room_price->roomtype->ViewCustomAttributes = "";

			// description
			$mst_room_price->description->ViewValue = $mst_room_price->description->CurrentValue;
			$mst_room_price->description->CssStyle = "";
			$mst_room_price->description->CssClass = "";
			$mst_room_price->description->ViewCustomAttributes = "";

			// baseprice
			$mst_room_price->baseprice->ViewValue = $mst_room_price->baseprice->CurrentValue;
			$mst_room_price->baseprice->ViewValue = ew_FormatNumber($mst_room_price->baseprice->ViewValue, 0, -2, -2, -2);
			$mst_room_price->baseprice->CssStyle = "text-align:right;";
			$mst_room_price->baseprice->CssClass = "";
			$mst_room_price->baseprice->ViewCustomAttributes = "";

			// tax
			$mst_room_price->tax->ViewValue = $mst_room_price->tax->CurrentValue;
			$mst_room_price->tax->ViewValue = ew_FormatNumber($mst_room_price->tax->ViewValue, 0, -2, -2, -2);
			$mst_room_price->tax->CssStyle = "text-align:right;";
			$mst_room_price->tax->CssClass = "";
			$mst_room_price->tax->ViewCustomAttributes = "";

			// service
			$mst_room_price->service->ViewValue = $mst_room_price->service->CurrentValue;
			$mst_room_price->service->ViewValue = ew_FormatNumber($mst_room_price->service->ViewValue, 0, -2, -2, -2);
			$mst_room_price->service->CssStyle = "text-align:right;";
			$mst_room_price->service->CssClass = "";
			$mst_room_price->service->ViewCustomAttributes = "";

			// aftertaxservice
			$mst_room_price->aftertaxservice->ViewValue = $mst_room_price->aftertaxservice->CurrentValue;
			$mst_room_price->aftertaxservice->ViewValue = ew_FormatNumber($mst_room_price->aftertaxservice->ViewValue, 0, -2, -2, -2);
			$mst_room_price->aftertaxservice->CssStyle = "text-align:right;";
			$mst_room_price->aftertaxservice->CssClass = "";
			$mst_room_price->aftertaxservice->ViewCustomAttributes = "";

			// createby
			if (strval($mst_room_price->createby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($mst_room_price->createby->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_room_price->createby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$mst_room_price->createby->ViewValue = $mst_room_price->createby->CurrentValue;
				}
			} else {
				$mst_room_price->createby->ViewValue = NULL;
			}
			$mst_room_price->createby->CssStyle = "";
			$mst_room_price->createby->CssClass = "";
			$mst_room_price->createby->ViewCustomAttributes = "";

			// createdate
			$mst_room_price->createdate->ViewValue = $mst_room_price->createdate->CurrentValue;
			$mst_room_price->createdate->ViewValue = ew_FormatDateTime($mst_room_price->createdate->ViewValue, 7);
			$mst_room_price->createdate->CssStyle = "";
			$mst_room_price->createdate->CssClass = "";
			$mst_room_price->createdate->ViewCustomAttributes = "";

			// id
			$mst_room_price->id->HrefValue = "";

			// tanggal1
			$mst_room_price->tanggal1->HrefValue = "";

			// tanggal2
			$mst_room_price->tanggal2->HrefValue = "";

			// room
			$mst_room_price->room->HrefValue = "";

			// roomtype
			$mst_room_price->roomtype->HrefValue = "";

			// description
			$mst_room_price->description->HrefValue = "";

			// baseprice
			$mst_room_price->baseprice->HrefValue = "";

			// tax
			$mst_room_price->tax->HrefValue = "";

			// service
			$mst_room_price->service->HrefValue = "";

			// aftertaxservice
			$mst_room_price->aftertaxservice->HrefValue = "";

			// createby
			$mst_room_price->createby->HrefValue = "";

			// createdate
			$mst_room_price->createdate->HrefValue = "";
		}

		// Call Row Rendered event
		$mst_room_price->Row_Rendered();
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
