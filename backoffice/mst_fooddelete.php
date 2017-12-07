<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_foodinfo.php" ?>
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
$mst_food_delete = new cmst_food_delete();
$Page =& $mst_food_delete;

// Page init processing
$mst_food_delete->Page_Init();

// Page main processing
$mst_food_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mst_food_delete = new ew_Page("mst_food_delete");

// page properties
mst_food_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = mst_food_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
mst_food_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_food_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_food_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $mst_food_delete->LoadRecordset();
$mst_food_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($mst_food_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$mst_food_delete->Page_Terminate("mst_foodlist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From <h3><b>Master Food</b></h3><br><br>
<a href="<?php echo $mst_food->getReturnUrl() ?>">Go Back</a></span></p>
<?php $mst_food_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="mst_food">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($mst_food_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $mst_food->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Kode</td>
		<td valign="top">Description</td>
		<td valign="top">Price</td>
	</tr>
	</thead>
	<tbody>
<?php
$mst_food_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$mst_food_delete->lRecCnt++;

	// Set row properties
	$mst_food->CssClass = "";
	$mst_food->CssStyle = "";
	$mst_food->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$mst_food_delete->LoadRowValues($rs);

	// Render row
	$mst_food_delete->RenderRow();
?>
	<tr<?php echo $mst_food->RowAttributes() ?>>
		<td<?php echo $mst_food->kode->CellAttributes() ?>>
<div<?php echo $mst_food->kode->ViewAttributes() ?>><?php echo $mst_food->kode->ListViewValue() ?></div></td>
		<td<?php echo $mst_food->description->CellAttributes() ?>>
<div<?php echo $mst_food->description->ViewAttributes() ?>><?php echo $mst_food->description->ListViewValue() ?></div></td>
		<td<?php echo $mst_food->price->CellAttributes() ?>>
<div<?php echo $mst_food->price->ViewAttributes() ?>><?php echo $mst_food->price->ListViewValue() ?></div></td>
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
$mst_food_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_food_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'mst_food';

	// Page Object Name
	var $PageObjName = 'mst_food_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_food;
		if ($mst_food->UseTokenInUrl) $PageUrl .= "t=" . $mst_food->TableVar . "&"; // add page token
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
		global $objForm, $mst_food;
		if ($mst_food->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_food->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_food->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_food_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_food"] = new cmst_food();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_food', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_food;

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
		global $mst_food;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["kode"] <> "") {
			$mst_food->kode->setQueryStringValue($_GET["kode"]);
			$sKey .= $mst_food->kode->QueryStringValue;
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
			$this->Page_Terminate("mst_foodlist.php"); // No key specified, return to list

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
		// SQL constructor in SQL constructor in mst_food class, mst_foodinfo.php

		$mst_food->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$mst_food->CurrentAction = $_POST["a_delete"];
		} else {
			$mst_food->CurrentAction = "I"; // Display record
		}
		switch ($mst_food->CurrentAction) {
			case "D": // Delete
				$mst_food->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($mst_food->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $mst_food;
		$DeleteRows = TRUE;
		$sWrkFilter = $mst_food->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in mst_food class, mst_foodinfo.php

		$mst_food->CurrentFilter = $sWrkFilter;
		$sSql = $mst_food->SQL();
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
		$this->WriteAuditTrailDummy("*** Batch delete begin ***"); // Batch delete begin

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs) $rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $mst_food->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($mst_food->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($mst_food->CancelMessage <> "") {
				$this->setMessage($mst_food->CancelMessage);
				$mst_food->CancelMessage = "";
			} else {
				$this->setMessage("Delete cancelled");
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
			if ($DeleteRows) {
				foreach ($rsold as $row)
					$this->WriteAuditTrailOnDelete($row);
			}
			$this->WriteAuditTrailDummy("*** Batch delete successful ***"); // Batch delete success
		} else {
			$conn->RollbackTrans(); // Rollback changes
			$this->WriteAuditTrailDummy("*** Batch delete rollback ***"); // Batch delete rollback
		}

		// Call recordset deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$mst_food->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mst_food;

		// Call Recordset Selecting event
		$mst_food->Recordset_Selecting($mst_food->CurrentFilter);

		// Load list page SQL
		$sSql = $mst_food->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$mst_food->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_food;
		$sFilter = $mst_food->KeyFilter();

		// Call Row Selecting event
		$mst_food->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_food->CurrentFilter = $sFilter;
		$sSql = $mst_food->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_food->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_food;
		$mst_food->kode->setDbValue($rs->fields('kode'));
		$mst_food->description->setDbValue($rs->fields('description'));
		$mst_food->price->setDbValue($rs->fields('price'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_food;

		// Call Row_Rendering event
		$mst_food->Row_Rendering();

		// Common render codes for all row types
		// kode

		$mst_food->kode->CellCssStyle = "white-space: nowrap;";
		$mst_food->kode->CellCssClass = "";

		// description
		$mst_food->description->CellCssStyle = "white-space: nowrap;";
		$mst_food->description->CellCssClass = "";

		// price
		$mst_food->price->CellCssStyle = "white-space: nowrap;";
		$mst_food->price->CellCssClass = "";
		if ($mst_food->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$mst_food->kode->ViewValue = $mst_food->kode->CurrentValue;
			$mst_food->kode->CssStyle = "";
			$mst_food->kode->CssClass = "";
			$mst_food->kode->ViewCustomAttributes = "";

			// description
			$mst_food->description->ViewValue = $mst_food->description->CurrentValue;
			$mst_food->description->CssStyle = "";
			$mst_food->description->CssClass = "";
			$mst_food->description->ViewCustomAttributes = "";

			// price
			$mst_food->price->ViewValue = $mst_food->price->CurrentValue;
			$mst_food->price->ViewValue = ew_FormatNumber($mst_food->price->ViewValue, 0, -2, -2, -2);
			$mst_food->price->CssStyle = "text-align:right;";
			$mst_food->price->CssClass = "";
			$mst_food->price->ViewCustomAttributes = "";

			// kode
			$mst_food->kode->HrefValue = "";

			// description
			$mst_food->description->HrefValue = "";

			// price
			$mst_food->price->HrefValue = "";
		}

		// Call Row Rendered event
		$mst_food->Row_Rendered();
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'mst_food';

		// Write Audit Trail
		$filePfx = "log";
		$curDate = date("Y/m/d");
		$curTime = date("H:i:s");
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		$action = $typ;
		ew_WriteAuditTrail($filePfx, $curDate, $curTime, $id, $curUser, $action, $table, "", "", "", "");
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $mst_food;
		$table = 'mst_food';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['kode'];

		// Write Audit Trail
		$filePfx = "log";
		$curDate = date("Y/m/d");
		$curTime = date("H:i:s");
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		$action = "D";
		$newvalue = "";
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $mst_food->fields) && $mst_food->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore Blob Field
				$oldvalue = ($mst_food->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) ? "<MEMO>" : $rs[$fldname]; // Memo Field
				ew_WriteAuditTrail($filePfx, $curDate, $curTime, $id, $curUser, $action, $table, $fldname, $key, $oldvalue, $newvalue);
			}
		}
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
