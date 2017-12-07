<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_room_typeinfo.php" ?>
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
$mst_room_type_view = new cmst_room_type_view();
$Page =& $mst_room_type_view;

// Page init processing
$mst_room_type_view->Page_Init();

// Page main processing
$mst_room_type_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($mst_room_type->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var mst_room_type_view = new ew_Page("mst_room_type_view");

// page properties
mst_room_type_view.PageID = "view"; // page ID
var EW_PAGE_ID = mst_room_type_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
mst_room_type_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_room_type_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_room_type_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">View <h3><b>Master Room Type</b></h3>
<br><br>
<?php if ($mst_room_type->Export == "") { ?>
<!--a href="mst_room_typelist.php">Back to List</a-->&nbsp;
<input type="button" value="Kembali" onclick="window.location='mst_room_typelist.php';">
<a href="<?php echo $mst_room_type->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
</span></p>
<?php $mst_room_type_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($mst_room_type->id->Visible) { // id ?>
	<tr<?php echo $mst_room_type->id->RowAttributes ?>>
		<td class="ewTableHeader">Id</td>
		<td<?php echo $mst_room_type->id->CellAttributes() ?>>
<div<?php echo $mst_room_type->id->ViewAttributes() ?>><?php echo $mst_room_type->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_room_type->description->Visible) { // description ?>
	<tr<?php echo $mst_room_type->description->RowAttributes ?>>
		<td class="ewTableHeader">Description</td>
		<td<?php echo $mst_room_type->description->CellAttributes() ?>>
<div<?php echo $mst_room_type->description->ViewAttributes() ?>><?php echo $mst_room_type->description->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_room_type->xtimestamp->Visible) { // xtimestamp ?>
	<tr<?php echo $mst_room_type->xtimestamp->RowAttributes ?>>
		<td class="ewTableHeader">Xtimestamp</td>
		<td<?php echo $mst_room_type->xtimestamp->CellAttributes() ?>>
<div<?php echo $mst_room_type->xtimestamp->ViewAttributes() ?>><?php echo $mst_room_type->xtimestamp->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($mst_room_type->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$mst_room_type_view->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_room_type_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'mst_room_type';

	// Page Object Name
	var $PageObjName = 'mst_room_type_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_room_type;
		if ($mst_room_type->UseTokenInUrl) $PageUrl .= "t=" . $mst_room_type->TableVar . "&"; // add page token
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
		global $objForm, $mst_room_type;
		if ($mst_room_type->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_room_type->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_room_type->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_room_type_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_room_type"] = new cmst_room_type();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_room_type', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_room_type;

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
		global $mst_room_type;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$mst_room_type->id->setQueryStringValue($_GET["id"]);
			} else {
				$sReturnUrl = "mst_room_typelist.php"; // Return to list
			}

			// Get action
			$mst_room_type->CurrentAction = "I"; // Display form
			switch ($mst_room_type->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "mst_room_typelist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "mst_room_typelist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$mst_room_type->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $mst_room_type;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$mst_room_type->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$mst_room_type->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $mst_room_type->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$mst_room_type->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$mst_room_type->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$mst_room_type->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_room_type;
		$sFilter = $mst_room_type->KeyFilter();

		// Call Row Selecting event
		$mst_room_type->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_room_type->CurrentFilter = $sFilter;
		$sSql = $mst_room_type->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_room_type->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_room_type;
		$mst_room_type->id->setDbValue($rs->fields('id'));
		$mst_room_type->description->setDbValue($rs->fields('description'));
		$mst_room_type->xtimestamp->setDbValue($rs->fields('xtimestamp'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_room_type;

		// Call Row_Rendering event
		$mst_room_type->Row_Rendering();

		// Common render codes for all row types
		// id

		$mst_room_type->id->CellCssStyle = "";
		$mst_room_type->id->CellCssClass = "";

		// description
		$mst_room_type->description->CellCssStyle = "";
		$mst_room_type->description->CellCssClass = "";

		// xtimestamp
		$mst_room_type->xtimestamp->CellCssStyle = "";
		$mst_room_type->xtimestamp->CellCssClass = "";
		if ($mst_room_type->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$mst_room_type->id->ViewValue = $mst_room_type->id->CurrentValue;
			$mst_room_type->id->CssStyle = "";
			$mst_room_type->id->CssClass = "";
			$mst_room_type->id->ViewCustomAttributes = "";

			// description
			$mst_room_type->description->ViewValue = $mst_room_type->description->CurrentValue;
			$mst_room_type->description->CssStyle = "";
			$mst_room_type->description->CssClass = "";
			$mst_room_type->description->ViewCustomAttributes = "";

			// xtimestamp
			$mst_room_type->xtimestamp->ViewValue = $mst_room_type->xtimestamp->CurrentValue;
			$mst_room_type->xtimestamp->ViewValue = ew_FormatDateTime($mst_room_type->xtimestamp->ViewValue, 7);
			$mst_room_type->xtimestamp->CssStyle = "";
			$mst_room_type->xtimestamp->CssClass = "";
			$mst_room_type->xtimestamp->ViewCustomAttributes = "";

			// id
			$mst_room_type->id->HrefValue = "";

			// description
			$mst_room_type->description->HrefValue = "";

			// xtimestamp
			$mst_room_type->xtimestamp->HrefValue = "";
		}

		// Call Row Rendered event
		$mst_room_type->Row_Rendered();
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
