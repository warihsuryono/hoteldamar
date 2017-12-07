<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "inqueueinfo.php" ?>
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
$inqueue_delete = new cinqueue_delete();
$Page =& $inqueue_delete;

// Page init processing
$inqueue_delete->Page_Init();

// Page main processing
$inqueue_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var inqueue_delete = new ew_Page("inqueue_delete");

// page properties
inqueue_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = inqueue_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
inqueue_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
inqueue_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
inqueue_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $inqueue_delete->LoadRecordset();
$inqueue_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($inqueue_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$inqueue_delete->Page_Terminate("inqueuelist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From <h3><b>Antrian SMS Masuk</b></h3><br><br>
<a href="<?php echo $inqueue->getReturnUrl() ?>">Go Back</a></span></p>
<?php $inqueue_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="inqueue">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($inqueue_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $inqueue->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id</td>
		<td valign="top">Modem Id</td>
		<td valign="top">Destination</td>
		<td valign="top">Msisdn</td>
		<td valign="top">Qtime</td>
		<td valign="top">Exectime</td>
		<td valign="top">Message</td>
		<td valign="top">Status</td>
	</tr>
	</thead>
	<tbody>
<?php
$inqueue_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$inqueue_delete->lRecCnt++;

	// Set row properties
	$inqueue->CssClass = "";
	$inqueue->CssStyle = "";
	$inqueue->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$inqueue_delete->LoadRowValues($rs);

	// Render row
	$inqueue_delete->RenderRow();
?>
	<tr<?php echo $inqueue->RowAttributes() ?>>
		<td<?php echo $inqueue->id->CellAttributes() ?>>
<div<?php echo $inqueue->id->ViewAttributes() ?>><?php echo $inqueue->id->ListViewValue() ?></div></td>
		<td<?php echo $inqueue->modem_id->CellAttributes() ?>>
<div<?php echo $inqueue->modem_id->ViewAttributes() ?>><?php echo $inqueue->modem_id->ListViewValue() ?></div></td>
		<td<?php echo $inqueue->destmsisdn->CellAttributes() ?>>
<div<?php echo $inqueue->destmsisdn->ViewAttributes() ?>><?php echo $inqueue->destmsisdn->ListViewValue() ?></div></td>
		<td<?php echo $inqueue->msisdn->CellAttributes() ?>>
<div<?php echo $inqueue->msisdn->ViewAttributes() ?>><?php echo $inqueue->msisdn->ListViewValue() ?></div></td>
		<td<?php echo $inqueue->qtime->CellAttributes() ?>>
<div<?php echo $inqueue->qtime->ViewAttributes() ?>><?php echo $inqueue->qtime->ListViewValue() ?></div></td>
		<td<?php echo $inqueue->exectime->CellAttributes() ?>>
<div<?php echo $inqueue->exectime->ViewAttributes() ?>><?php echo $inqueue->exectime->ListViewValue() ?></div></td>
		<td<?php echo $inqueue->message->CellAttributes() ?>>
<div<?php echo $inqueue->message->ViewAttributes() ?>><?php echo $inqueue->message->ListViewValue() ?></div></td>
		<td<?php echo $inqueue->status->CellAttributes() ?>>
<div<?php echo $inqueue->status->ViewAttributes() ?>><?php echo $inqueue->status->ListViewValue() ?></div></td>
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
$inqueue_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class cinqueue_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'inqueue';

	// Page Object Name
	var $PageObjName = 'inqueue_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $inqueue;
		if ($inqueue->UseTokenInUrl) $PageUrl .= "t=" . $inqueue->TableVar . "&"; // add page token
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
		global $objForm, $inqueue;
		if ($inqueue->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($inqueue->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($inqueue->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cinqueue_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["inqueue"] = new cinqueue();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'inqueue', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $inqueue;

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
		global $inqueue;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$inqueue->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($inqueue->id->QueryStringValue))
				$this->Page_Terminate("inqueuelist.php"); // Prevent SQL injection, exit
			$sKey .= $inqueue->id->QueryStringValue;
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
			$this->Page_Terminate("inqueuelist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("inqueuelist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in inqueue class, inqueueinfo.php

		$inqueue->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$inqueue->CurrentAction = $_POST["a_delete"];
		} else {
			$inqueue->CurrentAction = "I"; // Display record
		}
		switch ($inqueue->CurrentAction) {
			case "D": // Delete
				$inqueue->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($inqueue->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $inqueue;
		$DeleteRows = TRUE;
		$sWrkFilter = $inqueue->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in inqueue class, inqueueinfo.php

		$inqueue->CurrentFilter = $sWrkFilter;
		$sSql = $inqueue->SQL();
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
				$DeleteRows = $inqueue->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($inqueue->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($inqueue->CancelMessage <> "") {
				$this->setMessage($inqueue->CancelMessage);
				$inqueue->CancelMessage = "";
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
				$inqueue->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $inqueue;

		// Call Recordset Selecting event
		$inqueue->Recordset_Selecting($inqueue->CurrentFilter);

		// Load list page SQL
		$sSql = $inqueue->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$inqueue->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $inqueue;
		$sFilter = $inqueue->KeyFilter();

		// Call Row Selecting event
		$inqueue->Row_Selecting($sFilter);

		// Load sql based on filter
		$inqueue->CurrentFilter = $sFilter;
		$sSql = $inqueue->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$inqueue->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $inqueue;
		$inqueue->id->setDbValue($rs->fields('id'));
		$inqueue->modem_id->setDbValue($rs->fields('modem_id'));
		$inqueue->destmsisdn->setDbValue($rs->fields('destmsisdn'));
		$inqueue->msisdn->setDbValue($rs->fields('msisdn'));
		$inqueue->qtime->setDbValue($rs->fields('qtime'));
		$inqueue->exectime->setDbValue($rs->fields('exectime'));
		$inqueue->message->setDbValue($rs->fields('message'));
		$inqueue->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $inqueue;

		// Call Row_Rendering event
		$inqueue->Row_Rendering();

		// Common render codes for all row types
		// id

		$inqueue->id->CellCssStyle = "white-space: nowrap;";
		$inqueue->id->CellCssClass = "";

		// modem_id
		$inqueue->modem_id->CellCssStyle = "white-space: nowrap;";
		$inqueue->modem_id->CellCssClass = "";

		// destmsisdn
		$inqueue->destmsisdn->CellCssStyle = "white-space: nowrap;";
		$inqueue->destmsisdn->CellCssClass = "";

		// msisdn
		$inqueue->msisdn->CellCssStyle = "white-space: nowrap;";
		$inqueue->msisdn->CellCssClass = "";

		// qtime
		$inqueue->qtime->CellCssStyle = "white-space: nowrap;";
		$inqueue->qtime->CellCssClass = "";

		// exectime
		$inqueue->exectime->CellCssStyle = "white-space: nowrap;";
		$inqueue->exectime->CellCssClass = "";

		// message
		$inqueue->message->CellCssStyle = "";
		$inqueue->message->CellCssClass = "";

		// status
		$inqueue->status->CellCssStyle = "white-space: nowrap;";
		$inqueue->status->CellCssClass = "";
		if ($inqueue->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$inqueue->id->ViewValue = $inqueue->id->CurrentValue;
			$inqueue->id->CssStyle = "";
			$inqueue->id->CssClass = "";
			$inqueue->id->ViewCustomAttributes = "";

			// modem_id
			$inqueue->modem_id->ViewValue = $inqueue->modem_id->CurrentValue;
			$inqueue->modem_id->CssStyle = "";
			$inqueue->modem_id->CssClass = "";
			$inqueue->modem_id->ViewCustomAttributes = "";

			// destmsisdn
			$inqueue->destmsisdn->ViewValue = $inqueue->destmsisdn->CurrentValue;
			$inqueue->destmsisdn->CssStyle = "";
			$inqueue->destmsisdn->CssClass = "";
			$inqueue->destmsisdn->ViewCustomAttributes = "";

			// msisdn
			$inqueue->msisdn->ViewValue = $inqueue->msisdn->CurrentValue;
			$inqueue->msisdn->CssStyle = "";
			$inqueue->msisdn->CssClass = "";
			$inqueue->msisdn->ViewCustomAttributes = "";

			// qtime
			$inqueue->qtime->ViewValue = $inqueue->qtime->CurrentValue;
			$inqueue->qtime->ViewValue = ew_FormatDateTime($inqueue->qtime->ViewValue, 7);
			$inqueue->qtime->CssStyle = "";
			$inqueue->qtime->CssClass = "";
			$inqueue->qtime->ViewCustomAttributes = "";

			// exectime
			$inqueue->exectime->ViewValue = $inqueue->exectime->CurrentValue;
			$inqueue->exectime->ViewValue = ew_FormatDateTime($inqueue->exectime->ViewValue, 7);
			$inqueue->exectime->CssStyle = "";
			$inqueue->exectime->CssClass = "";
			$inqueue->exectime->ViewCustomAttributes = "";

			// message
			$inqueue->message->ViewValue = $inqueue->message->CurrentValue;
			$inqueue->message->CssStyle = "";
			$inqueue->message->CssClass = "";
			$inqueue->message->ViewCustomAttributes = "";

			// status
			if (strval($inqueue->status->CurrentValue) <> "") {
				switch ($inqueue->status->CurrentValue) {
					case "0":
						$inqueue->status->ViewValue = "Belum";
						break;
					case "1":
						$inqueue->status->ViewValue = "Sukses";
						break;
					case "2":
						$inqueue->status->ViewValue = "Gagal";
						break;
					default:
						$inqueue->status->ViewValue = $inqueue->status->CurrentValue;
				}
			} else {
				$inqueue->status->ViewValue = NULL;
			}
			$inqueue->status->CssStyle = "";
			$inqueue->status->CssClass = "";
			$inqueue->status->ViewCustomAttributes = "";

			// id
			$inqueue->id->HrefValue = "";

			// modem_id
			$inqueue->modem_id->HrefValue = "";

			// destmsisdn
			$inqueue->destmsisdn->HrefValue = "";

			// msisdn
			$inqueue->msisdn->HrefValue = "";

			// qtime
			$inqueue->qtime->HrefValue = "";

			// exectime
			$inqueue->exectime->HrefValue = "";

			// message
			$inqueue->message->HrefValue = "";

			// status
			$inqueue->status->HrefValue = "";
		}

		// Call Row Rendered event
		$inqueue->Row_Rendered();
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
