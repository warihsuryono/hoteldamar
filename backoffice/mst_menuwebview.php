<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_menuwebinfo.php" ?>
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
$mst_menuweb_view = new cmst_menuweb_view();
$Page =& $mst_menuweb_view;

// Page init processing
$mst_menuweb_view->Page_Init();

// Page main processing
$mst_menuweb_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($mst_menuweb->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var mst_menuweb_view = new ew_Page("mst_menuweb_view");

// page properties
mst_menuweb_view.PageID = "view"; // page ID
var EW_PAGE_ID = mst_menuweb_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
mst_menuweb_view.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_menuweb_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_menuweb_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker">View <h3><b>Web Menu</b></h3>
<br><br>
<?php if ($mst_menuweb->Export == "") { ?>
<!--a href="mst_menuweblist.php">Back to List</a-->&nbsp;
<input type="button" value="Kembali" onclick="window.location='mst_menuweblist.php';">
<a href="<?php echo $mst_menuweb->AddUrl() ?>">Add</a>&nbsp;
<a href="<?php echo $mst_menuweb->EditUrl() ?>">Edit</a>&nbsp;
<a href="<?php echo $mst_menuweb->CopyUrl() ?>">Copy</a>&nbsp;
<a href="<?php echo $mst_menuweb->DeleteUrl() ?>">Delete</a>&nbsp;
<?php } ?>
</span></p>
<?php $mst_menuweb_view->ShowMessage() ?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($mst_menuweb->kode->Visible) { // kode ?>
	<tr<?php echo $mst_menuweb->kode->RowAttributes ?>>
		<td class="ewTableHeader">Kode</td>
		<td<?php echo $mst_menuweb->kode->CellAttributes() ?>>
<div<?php echo $mst_menuweb->kode->ViewAttributes() ?>><?php echo $mst_menuweb->kode->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_menuweb->seqno->Visible) { // seqno ?>
	<tr<?php echo $mst_menuweb->seqno->RowAttributes ?>>
		<td class="ewTableHeader">No Urut</td>
		<td<?php echo $mst_menuweb->seqno->CellAttributes() ?>>
<div<?php echo $mst_menuweb->seqno->ViewAttributes() ?>><?php echo $mst_menuweb->seqno->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_menuweb->lang->Visible) { // lang ?>
	<tr<?php echo $mst_menuweb->lang->RowAttributes ?>>
		<td class="ewTableHeader">Bahasa</td>
		<td<?php echo $mst_menuweb->lang->CellAttributes() ?>>
<div<?php echo $mst_menuweb->lang->ViewAttributes() ?>><?php echo $mst_menuweb->lang->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_menuweb->caption->Visible) { // caption ?>
	<tr<?php echo $mst_menuweb->caption->RowAttributes ?>>
		<td class="ewTableHeader">Caption</td>
		<td<?php echo $mst_menuweb->caption->CellAttributes() ?>>
<div<?php echo $mst_menuweb->caption->ViewAttributes() ?>><?php echo $mst_menuweb->caption->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_menuweb->url->Visible) { // url ?>
	<tr<?php echo $mst_menuweb->url->RowAttributes ?>>
		<td class="ewTableHeader">Url</td>
		<td<?php echo $mst_menuweb->url->CellAttributes() ?>>
<div<?php echo $mst_menuweb->url->ViewAttributes() ?>><?php echo $mst_menuweb->url->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_menuweb->target->Visible) { // target ?>
	<tr<?php echo $mst_menuweb->target->RowAttributes ?>>
		<td class="ewTableHeader">Target</td>
		<td<?php echo $mst_menuweb->target->CellAttributes() ?>>
<div<?php echo $mst_menuweb->target->ViewAttributes() ?>><?php echo $mst_menuweb->target->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_menuweb->content->Visible) { // content ?>
	<tr<?php echo $mst_menuweb->content->RowAttributes ?>>
		<td class="ewTableHeader">Content</td>
		<td<?php echo $mst_menuweb->content->CellAttributes() ?>>
<div<?php echo $mst_menuweb->content->ViewAttributes() ?>><?php echo $mst_menuweb->content->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_menuweb->createby->Visible) { // createby ?>
	<tr<?php echo $mst_menuweb->createby->RowAttributes ?>>
		<td class="ewTableHeader">Create By</td>
		<td<?php echo $mst_menuweb->createby->CellAttributes() ?>>
<div<?php echo $mst_menuweb->createby->ViewAttributes() ?>><?php echo $mst_menuweb->createby->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($mst_menuweb->createdate->Visible) { // createdate ?>
	<tr<?php echo $mst_menuweb->createdate->RowAttributes ?>>
		<td class="ewTableHeader">Create Date</td>
		<td<?php echo $mst_menuweb->createdate->CellAttributes() ?>>
<div<?php echo $mst_menuweb->createdate->ViewAttributes() ?>><?php echo $mst_menuweb->createdate->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($mst_menuweb->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$mst_menuweb_view->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_menuweb_view {

	// Page ID
	var $PageID = 'view';

	// Table Name
	var $TableName = 'mst_menuweb';

	// Page Object Name
	var $PageObjName = 'mst_menuweb_view';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_menuweb;
		if ($mst_menuweb->UseTokenInUrl) $PageUrl .= "t=" . $mst_menuweb->TableVar . "&"; // add page token
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
		global $objForm, $mst_menuweb;
		if ($mst_menuweb->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_menuweb->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_menuweb->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_menuweb_view() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_menuweb"] = new cmst_menuweb();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_menuweb', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_menuweb;

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
		global $mst_menuweb;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["kode"] <> "") {
				$mst_menuweb->kode->setQueryStringValue($_GET["kode"]);
			} else {
				$sReturnUrl = "mst_menuweblist.php"; // Return to list
			}

			// Get action
			$mst_menuweb->CurrentAction = "I"; // Display form
			switch ($mst_menuweb->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage("No records found"); // Set no record message
						$sReturnUrl = "mst_menuweblist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "mst_menuweblist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$mst_menuweb->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up Starting Record parameters based on Pager Navigation
	function SetUpStartRec() {
		global $mst_menuweb;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request			
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$mst_menuweb->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$mst_menuweb->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $mst_menuweb->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$mst_menuweb->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$mst_menuweb->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$mst_menuweb->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_menuweb;
		$sFilter = $mst_menuweb->KeyFilter();

		// Call Row Selecting event
		$mst_menuweb->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_menuweb->CurrentFilter = $sFilter;
		$sSql = $mst_menuweb->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_menuweb->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_menuweb;
		$mst_menuweb->kode->setDbValue($rs->fields('kode'));
		$mst_menuweb->seqno->setDbValue($rs->fields('seqno'));
		$mst_menuweb->lang->setDbValue($rs->fields('lang'));
		$mst_menuweb->caption->setDbValue($rs->fields('caption'));
		$mst_menuweb->url->setDbValue($rs->fields('url'));
		$mst_menuweb->target->setDbValue($rs->fields('target'));
		$mst_menuweb->content->setDbValue($rs->fields('content'));
		$mst_menuweb->createby->setDbValue($rs->fields('createby'));
		$mst_menuweb->createdate->setDbValue($rs->fields('createdate'));
		$mst_menuweb->xtimestamp->setDbValue($rs->fields('xtimestamp'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_menuweb;

		// Call Row_Rendering event
		$mst_menuweb->Row_Rendering();

		// Common render codes for all row types
		// kode

		$mst_menuweb->kode->CellCssStyle = "";
		$mst_menuweb->kode->CellCssClass = "";

		// seqno
		$mst_menuweb->seqno->CellCssStyle = "";
		$mst_menuweb->seqno->CellCssClass = "";

		// lang
		$mst_menuweb->lang->CellCssStyle = "";
		$mst_menuweb->lang->CellCssClass = "";

		// caption
		$mst_menuweb->caption->CellCssStyle = "";
		$mst_menuweb->caption->CellCssClass = "";

		// url
		$mst_menuweb->url->CellCssStyle = "";
		$mst_menuweb->url->CellCssClass = "";

		// target
		$mst_menuweb->target->CellCssStyle = "";
		$mst_menuweb->target->CellCssClass = "";

		// content
		$mst_menuweb->content->CellCssStyle = "";
		$mst_menuweb->content->CellCssClass = "";

		// createby
		$mst_menuweb->createby->CellCssStyle = "";
		$mst_menuweb->createby->CellCssClass = "";

		// createdate
		$mst_menuweb->createdate->CellCssStyle = "";
		$mst_menuweb->createdate->CellCssClass = "";
		if ($mst_menuweb->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$mst_menuweb->kode->ViewValue = $mst_menuweb->kode->CurrentValue;
			$mst_menuweb->kode->CssStyle = "";
			$mst_menuweb->kode->CssClass = "";
			$mst_menuweb->kode->ViewCustomAttributes = "";

			// seqno
			$mst_menuweb->seqno->ViewValue = $mst_menuweb->seqno->CurrentValue;
			$mst_menuweb->seqno->CssStyle = "";
			$mst_menuweb->seqno->CssClass = "";
			$mst_menuweb->seqno->ViewCustomAttributes = "";

			// lang
			if (strval($mst_menuweb->lang->CurrentValue) <> "") {
				switch ($mst_menuweb->lang->CurrentValue) {
					case "ind":
						$mst_menuweb->lang->ViewValue = "Indonesia";
						break;
					case "eng":
						$mst_menuweb->lang->ViewValue = "English";
						break;
					default:
						$mst_menuweb->lang->ViewValue = $mst_menuweb->lang->CurrentValue;
				}
			} else {
				$mst_menuweb->lang->ViewValue = NULL;
			}
			$mst_menuweb->lang->CssStyle = "";
			$mst_menuweb->lang->CssClass = "";
			$mst_menuweb->lang->ViewCustomAttributes = "";

			// caption
			$mst_menuweb->caption->ViewValue = $mst_menuweb->caption->CurrentValue;
			$mst_menuweb->caption->CssStyle = "";
			$mst_menuweb->caption->CssClass = "";
			$mst_menuweb->caption->ViewCustomAttributes = "";

			// url
			$mst_menuweb->url->ViewValue = $mst_menuweb->url->CurrentValue;
			$mst_menuweb->url->CssStyle = "";
			$mst_menuweb->url->CssClass = "";
			$mst_menuweb->url->ViewCustomAttributes = "";

			// target
			if (strval($mst_menuweb->target->CurrentValue) <> "") {
				switch ($mst_menuweb->target->CurrentValue) {
					case "main_frame":
						$mst_menuweb->target->ViewValue = "Same Window";
						break;
					case "_blank":
						$mst_menuweb->target->ViewValue = "New Window";
						break;
					default:
						$mst_menuweb->target->ViewValue = $mst_menuweb->target->CurrentValue;
				}
			} else {
				$mst_menuweb->target->ViewValue = NULL;
			}
			$mst_menuweb->target->CssStyle = "";
			$mst_menuweb->target->CssClass = "";
			$mst_menuweb->target->ViewCustomAttributes = "";

			// content
			$mst_menuweb->content->ViewValue = $mst_menuweb->content->CurrentValue;
			$mst_menuweb->content->CssStyle = "";
			$mst_menuweb->content->CssClass = "";
			$mst_menuweb->content->ViewCustomAttributes = "";

			// createby
			if (strval($mst_menuweb->createby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($mst_menuweb->createby->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_menuweb->createby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$mst_menuweb->createby->ViewValue = $mst_menuweb->createby->CurrentValue;
				}
			} else {
				$mst_menuweb->createby->ViewValue = NULL;
			}
			$mst_menuweb->createby->CssStyle = "";
			$mst_menuweb->createby->CssClass = "";
			$mst_menuweb->createby->ViewCustomAttributes = "";

			// createdate
			$mst_menuweb->createdate->ViewValue = $mst_menuweb->createdate->CurrentValue;
			$mst_menuweb->createdate->ViewValue = ew_FormatDateTime($mst_menuweb->createdate->ViewValue, 11);
			$mst_menuweb->createdate->CssStyle = "";
			$mst_menuweb->createdate->CssClass = "";
			$mst_menuweb->createdate->ViewCustomAttributes = "";

			// kode
			$mst_menuweb->kode->HrefValue = "";

			// seqno
			$mst_menuweb->seqno->HrefValue = "";

			// lang
			$mst_menuweb->lang->HrefValue = "";

			// caption
			$mst_menuweb->caption->HrefValue = "";

			// url
			$mst_menuweb->url->HrefValue = "";

			// target
			$mst_menuweb->target->HrefValue = "";

			// content
			$mst_menuweb->content->HrefValue = "";

			// createby
			$mst_menuweb->createby->HrefValue = "";

			// createdate
			$mst_menuweb->createdate->HrefValue = "";
		}

		// Call Row Rendered event
		$mst_menuweb->Row_Rendered();
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
