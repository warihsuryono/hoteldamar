<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "outqueueinfo.php" ?>
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
$outqueue_delete = new coutqueue_delete();
$Page =& $outqueue_delete;

// Page init processing
$outqueue_delete->Page_Init();

// Page main processing
$outqueue_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var outqueue_delete = new ew_Page("outqueue_delete");

// page properties
outqueue_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = outqueue_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
outqueue_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
outqueue_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
outqueue_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $outqueue_delete->LoadRecordset();
$outqueue_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($outqueue_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$outqueue_delete->Page_Terminate("outqueuelist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From <h3><b>Antrian SMS Keluar</b></h3><br><br>
<a href="<?php echo $outqueue->getReturnUrl() ?>">Go Back</a></span></p>
<?php $outqueue_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="outqueue">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($outqueue_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $outqueue->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id</td>
		<td valign="top">Modem Id</td>
		<td valign="top">Source</td>
		<td valign="top">Msisdn</td>
		<td valign="top">Qtime</td>
		<td valign="top">Exectime</td>
		<td valign="top">Message</td>
		<td valign="top">Status</td>
	</tr>
	</thead>
	<tbody>
<?php
$outqueue_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$outqueue_delete->lRecCnt++;

	// Set row properties
	$outqueue->CssClass = "";
	$outqueue->CssStyle = "";
	$outqueue->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$outqueue_delete->LoadRowValues($rs);

	// Render row
	$outqueue_delete->RenderRow();
?>
	<tr<?php echo $outqueue->RowAttributes() ?>>
		<td<?php echo $outqueue->id->CellAttributes() ?>>
<div<?php echo $outqueue->id->ViewAttributes() ?>><?php echo $outqueue->id->ListViewValue() ?></div></td>
		<td<?php echo $outqueue->modem_id->CellAttributes() ?>>
<div<?php echo $outqueue->modem_id->ViewAttributes() ?>><?php echo $outqueue->modem_id->ListViewValue() ?></div></td>
		<td<?php echo $outqueue->sourcemsisdn->CellAttributes() ?>>
<div<?php echo $outqueue->sourcemsisdn->ViewAttributes() ?>><?php echo $outqueue->sourcemsisdn->ListViewValue() ?></div></td>
		<td<?php echo $outqueue->msisdn->CellAttributes() ?>>
<div<?php echo $outqueue->msisdn->ViewAttributes() ?>><?php echo $outqueue->msisdn->ListViewValue() ?></div></td>
		<td<?php echo $outqueue->qtime->CellAttributes() ?>>
<div<?php echo $outqueue->qtime->ViewAttributes() ?>><?php echo $outqueue->qtime->ListViewValue() ?></div></td>
		<td<?php echo $outqueue->exectime->CellAttributes() ?>>
<div<?php echo $outqueue->exectime->ViewAttributes() ?>><?php echo $outqueue->exectime->ListViewValue() ?></div></td>
		<td<?php echo $outqueue->message->CellAttributes() ?>>
<div<?php echo $outqueue->message->ViewAttributes() ?>><?php echo $outqueue->message->ListViewValue() ?></div></td>
		<td<?php echo $outqueue->status->CellAttributes() ?>>
<div<?php echo $outqueue->status->ViewAttributes() ?>><?php echo $outqueue->status->ListViewValue() ?></div></td>
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
$outqueue_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class coutqueue_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'outqueue';

	// Page Object Name
	var $PageObjName = 'outqueue_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $outqueue;
		if ($outqueue->UseTokenInUrl) $PageUrl .= "t=" . $outqueue->TableVar . "&"; // add page token
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
		global $objForm, $outqueue;
		if ($outqueue->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($outqueue->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($outqueue->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function coutqueue_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["outqueue"] = new coutqueue();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'outqueue', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $outqueue;

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
		global $outqueue;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$outqueue->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($outqueue->id->QueryStringValue))
				$this->Page_Terminate("outqueuelist.php"); // Prevent SQL injection, exit
			$sKey .= $outqueue->id->QueryStringValue;
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
			$this->Page_Terminate("outqueuelist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("outqueuelist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in outqueue class, outqueueinfo.php

		$outqueue->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$outqueue->CurrentAction = $_POST["a_delete"];
		} else {
			$outqueue->CurrentAction = "I"; // Display record
		}
		switch ($outqueue->CurrentAction) {
			case "D": // Delete
				$outqueue->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($outqueue->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $outqueue;
		$DeleteRows = TRUE;
		$sWrkFilter = $outqueue->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in outqueue class, outqueueinfo.php

		$outqueue->CurrentFilter = $sWrkFilter;
		$sSql = $outqueue->SQL();
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
				$DeleteRows = $outqueue->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($outqueue->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($outqueue->CancelMessage <> "") {
				$this->setMessage($outqueue->CancelMessage);
				$outqueue->CancelMessage = "";
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
				$outqueue->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $outqueue;

		// Call Recordset Selecting event
		$outqueue->Recordset_Selecting($outqueue->CurrentFilter);

		// Load list page SQL
		$sSql = $outqueue->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$outqueue->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $outqueue;
		$sFilter = $outqueue->KeyFilter();

		// Call Row Selecting event
		$outqueue->Row_Selecting($sFilter);

		// Load sql based on filter
		$outqueue->CurrentFilter = $sFilter;
		$sSql = $outqueue->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$outqueue->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $outqueue;
		$outqueue->id->setDbValue($rs->fields('id'));
		$outqueue->modem_id->setDbValue($rs->fields('modem_id'));
		$outqueue->sourcemsisdn->setDbValue($rs->fields('sourcemsisdn'));
		$outqueue->msisdn->setDbValue($rs->fields('msisdn'));
		$outqueue->qtime->setDbValue($rs->fields('qtime'));
		$outqueue->exectime->setDbValue($rs->fields('exectime'));
		$outqueue->message->setDbValue($rs->fields('message'));
		$outqueue->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $outqueue;

		// Call Row_Rendering event
		$outqueue->Row_Rendering();

		// Common render codes for all row types
		// id

		$outqueue->id->CellCssStyle = "white-space: nowrap;";
		$outqueue->id->CellCssClass = "";

		// modem_id
		$outqueue->modem_id->CellCssStyle = "white-space: nowrap;";
		$outqueue->modem_id->CellCssClass = "";

		// sourcemsisdn
		$outqueue->sourcemsisdn->CellCssStyle = "white-space: nowrap;";
		$outqueue->sourcemsisdn->CellCssClass = "";

		// msisdn
		$outqueue->msisdn->CellCssStyle = "white-space: nowrap;";
		$outqueue->msisdn->CellCssClass = "";

		// qtime
		$outqueue->qtime->CellCssStyle = "white-space: nowrap;";
		$outqueue->qtime->CellCssClass = "";

		// exectime
		$outqueue->exectime->CellCssStyle = "white-space: nowrap;";
		$outqueue->exectime->CellCssClass = "";

		// message
		$outqueue->message->CellCssStyle = "";
		$outqueue->message->CellCssClass = "";

		// status
		$outqueue->status->CellCssStyle = "white-space: nowrap;";
		$outqueue->status->CellCssClass = "";
		if ($outqueue->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$outqueue->id->ViewValue = $outqueue->id->CurrentValue;
			$outqueue->id->CssStyle = "";
			$outqueue->id->CssClass = "";
			$outqueue->id->ViewCustomAttributes = "";

			// modem_id
			$outqueue->modem_id->ViewValue = $outqueue->modem_id->CurrentValue;
			$outqueue->modem_id->CssStyle = "";
			$outqueue->modem_id->CssClass = "";
			$outqueue->modem_id->ViewCustomAttributes = "";

			// sourcemsisdn
			$outqueue->sourcemsisdn->ViewValue = $outqueue->sourcemsisdn->CurrentValue;
			$outqueue->sourcemsisdn->CssStyle = "";
			$outqueue->sourcemsisdn->CssClass = "";
			$outqueue->sourcemsisdn->ViewCustomAttributes = "";

			// msisdn
			$outqueue->msisdn->ViewValue = $outqueue->msisdn->CurrentValue;
			$outqueue->msisdn->CssStyle = "";
			$outqueue->msisdn->CssClass = "";
			$outqueue->msisdn->ViewCustomAttributes = "";

			// qtime
			$outqueue->qtime->ViewValue = $outqueue->qtime->CurrentValue;
			$outqueue->qtime->ViewValue = ew_FormatDateTime($outqueue->qtime->ViewValue, 7);
			$outqueue->qtime->CssStyle = "";
			$outqueue->qtime->CssClass = "";
			$outqueue->qtime->ViewCustomAttributes = "";

			// exectime
			$outqueue->exectime->ViewValue = $outqueue->exectime->CurrentValue;
			$outqueue->exectime->ViewValue = ew_FormatDateTime($outqueue->exectime->ViewValue, 7);
			$outqueue->exectime->CssStyle = "";
			$outqueue->exectime->CssClass = "";
			$outqueue->exectime->ViewCustomAttributes = "";

			// message
			$outqueue->message->ViewValue = $outqueue->message->CurrentValue;
			$outqueue->message->CssStyle = "";
			$outqueue->message->CssClass = "";
			$outqueue->message->ViewCustomAttributes = "";

			// status
			if (strval($outqueue->status->CurrentValue) <> "") {
				switch ($outqueue->status->CurrentValue) {
					case "0":
						$outqueue->status->ViewValue = "Belum";
						break;
					case "1":
						$outqueue->status->ViewValue = "Sukses";
						break;
					case "2":
						$outqueue->status->ViewValue = "Gagal";
						break;
					default:
						$outqueue->status->ViewValue = $outqueue->status->CurrentValue;
				}
			} else {
				$outqueue->status->ViewValue = NULL;
			}
			$outqueue->status->CssStyle = "";
			$outqueue->status->CssClass = "";
			$outqueue->status->ViewCustomAttributes = "";

			// id
			$outqueue->id->HrefValue = "";

			// modem_id
			$outqueue->modem_id->HrefValue = "";

			// sourcemsisdn
			$outqueue->sourcemsisdn->HrefValue = "";

			// msisdn
			$outqueue->msisdn->HrefValue = "";

			// qtime
			$outqueue->qtime->HrefValue = "";

			// exectime
			$outqueue->exectime->HrefValue = "";

			// message
			$outqueue->message->HrefValue = "";

			// status
			$outqueue->status->HrefValue = "";
		}

		// Call Row Rendered event
		$outqueue->Row_Rendered();
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
