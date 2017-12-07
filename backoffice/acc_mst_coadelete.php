<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "acc_mst_coainfo.php" ?>
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
$acc_mst_coa_delete = new cacc_mst_coa_delete();
$Page =& $acc_mst_coa_delete;

// Page init processing
$acc_mst_coa_delete->Page_Init();

// Page main processing
$acc_mst_coa_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var acc_mst_coa_delete = new ew_Page("acc_mst_coa_delete");

// page properties
acc_mst_coa_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = acc_mst_coa_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
acc_mst_coa_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
acc_mst_coa_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
acc_mst_coa_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $acc_mst_coa_delete->LoadRecordset();
$acc_mst_coa_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($acc_mst_coa_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$acc_mst_coa_delete->Page_Terminate("acc_mst_coalist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From <h3><b>Master COA</b></h3><br><br>
<a href="<?php echo $acc_mst_coa->getReturnUrl() ?>">Go Back</a></span></p>
<?php $acc_mst_coa_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="acc_mst_coa">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($acc_mst_coa_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $acc_mst_coa->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Coa</td>
		<td valign="top">Group</td>
		<td valign="top">Description</td>
	</tr>
	</thead>
	<tbody>
<?php
$acc_mst_coa_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$acc_mst_coa_delete->lRecCnt++;

	// Set row properties
	$acc_mst_coa->CssClass = "";
	$acc_mst_coa->CssStyle = "";
	$acc_mst_coa->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$acc_mst_coa_delete->LoadRowValues($rs);

	// Render row
	$acc_mst_coa_delete->RenderRow();
?>
	<tr<?php echo $acc_mst_coa->RowAttributes() ?>>
		<td<?php echo $acc_mst_coa->coa->CellAttributes() ?>>
<div<?php echo $acc_mst_coa->coa->ViewAttributes() ?>><?php echo $acc_mst_coa->coa->ListViewValue() ?></div></td>
		<td<?php echo $acc_mst_coa->koder->CellAttributes() ?>>
<div<?php echo $acc_mst_coa->koder->ViewAttributes() ?>><?php echo $acc_mst_coa->koder->ListViewValue() ?></div></td>
		<td<?php echo $acc_mst_coa->description->CellAttributes() ?>>
<div<?php echo $acc_mst_coa->description->ViewAttributes() ?>><?php echo $acc_mst_coa->description->ListViewValue() ?></div></td>
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
$acc_mst_coa_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class cacc_mst_coa_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'acc_mst_coa';

	// Page Object Name
	var $PageObjName = 'acc_mst_coa_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $acc_mst_coa;
		if ($acc_mst_coa->UseTokenInUrl) $PageUrl .= "t=" . $acc_mst_coa->TableVar . "&"; // add page token
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
		global $objForm, $acc_mst_coa;
		if ($acc_mst_coa->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($acc_mst_coa->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($acc_mst_coa->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cacc_mst_coa_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["acc_mst_coa"] = new cacc_mst_coa();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'acc_mst_coa', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $acc_mst_coa;

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
		global $acc_mst_coa;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["coa"] <> "") {
			$acc_mst_coa->coa->setQueryStringValue($_GET["coa"]);
			$sKey .= $acc_mst_coa->coa->QueryStringValue;
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
			$this->Page_Terminate("acc_mst_coalist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			$sFilter .= "`coa`='" . ew_AdjustSql($sKeyFld) . "' AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in acc_mst_coa class, acc_mst_coainfo.php

		$acc_mst_coa->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$acc_mst_coa->CurrentAction = $_POST["a_delete"];
		} else {
			$acc_mst_coa->CurrentAction = "I"; // Display record
		}
		switch ($acc_mst_coa->CurrentAction) {
			case "D": // Delete
				$acc_mst_coa->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($acc_mst_coa->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $acc_mst_coa;
		$DeleteRows = TRUE;
		$sWrkFilter = $acc_mst_coa->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in acc_mst_coa class, acc_mst_coainfo.php

		$acc_mst_coa->CurrentFilter = $sWrkFilter;
		$sSql = $acc_mst_coa->SQL();
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
				$DeleteRows = $acc_mst_coa->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['coa'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($acc_mst_coa->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($acc_mst_coa->CancelMessage <> "") {
				$this->setMessage($acc_mst_coa->CancelMessage);
				$acc_mst_coa->CancelMessage = "";
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
				$acc_mst_coa->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $acc_mst_coa;

		// Call Recordset Selecting event
		$acc_mst_coa->Recordset_Selecting($acc_mst_coa->CurrentFilter);

		// Load list page SQL
		$sSql = $acc_mst_coa->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$acc_mst_coa->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $acc_mst_coa;
		$sFilter = $acc_mst_coa->KeyFilter();

		// Call Row Selecting event
		$acc_mst_coa->Row_Selecting($sFilter);

		// Load sql based on filter
		$acc_mst_coa->CurrentFilter = $sFilter;
		$sSql = $acc_mst_coa->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$acc_mst_coa->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $acc_mst_coa;
		$acc_mst_coa->coa->setDbValue($rs->fields('coa'));
		$acc_mst_coa->koder->setDbValue($rs->fields('koder'));
		$acc_mst_coa->parent->setDbValue($rs->fields('parent'));
		$acc_mst_coa->description->setDbValue($rs->fields('description'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $acc_mst_coa;

		// Call Row_Rendering event
		$acc_mst_coa->Row_Rendering();

		// Common render codes for all row types
		// coa

		$acc_mst_coa->coa->CellCssStyle = "white-space: nowrap;";
		$acc_mst_coa->coa->CellCssClass = "";

		// koder
		$acc_mst_coa->koder->CellCssStyle = "white-space: nowrap;";
		$acc_mst_coa->koder->CellCssClass = "";

		// description
		$acc_mst_coa->description->CellCssStyle = "white-space: nowrap;";
		$acc_mst_coa->description->CellCssClass = "";
		if ($acc_mst_coa->RowType == EW_ROWTYPE_VIEW) { // View row

			// coa
			$acc_mst_coa->coa->ViewValue = $acc_mst_coa->coa->CurrentValue;
			$acc_mst_coa->coa->CssStyle = "";
			$acc_mst_coa->coa->CssClass = "";
			$acc_mst_coa->coa->ViewCustomAttributes = "";

			// koder
			$acc_mst_coa->koder->ViewValue = $acc_mst_coa->koder->CurrentValue;
			$acc_mst_coa->koder->CssStyle = "";
			$acc_mst_coa->koder->CssClass = "";
			$acc_mst_coa->koder->ViewCustomAttributes = "";

			// description
			$acc_mst_coa->description->ViewValue = $acc_mst_coa->description->CurrentValue;
			$acc_mst_coa->description->CssStyle = "";
			$acc_mst_coa->description->CssClass = "";
			$acc_mst_coa->description->ViewCustomAttributes = "";

			// coa
			$acc_mst_coa->coa->HrefValue = "";

			// koder
			$acc_mst_coa->koder->HrefValue = "";

			// description
			$acc_mst_coa->description->HrefValue = "";
		}

		// Call Row Rendered event
		$acc_mst_coa->Row_Rendered();
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
