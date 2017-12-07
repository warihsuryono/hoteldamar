<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_roominfo.php" ?>
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
$mst_room_delete = new cmst_room_delete();
$Page =& $mst_room_delete;

// Page init processing
$mst_room_delete->Page_Init();

// Page main processing
$mst_room_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mst_room_delete = new ew_Page("mst_room_delete");

// page properties
mst_room_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = mst_room_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
mst_room_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_room_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_room_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $mst_room_delete->LoadRecordset();
$mst_room_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($mst_room_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$mst_room_delete->Page_Terminate("mst_roomlist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From <h3><b>Master Room</b></h3><br><br>
<a href="<?php echo $mst_room->getReturnUrl() ?>">Go Back</a></span></p>
<?php $mst_room_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="mst_room">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($mst_room_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $mst_room->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Kode</td>
		<td valign="top">Nama</td>
		<td valign="top">Tipe</td>
		<td valign="top">Connecting To (1)</td>
		<td valign="top">Connecting To (2)</td>
		<td valign="top">Change By</td>
		<td valign="top">Change Date</td>
	</tr>
	</thead>
	<tbody>
<?php
$mst_room_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$mst_room_delete->lRecCnt++;

	// Set row properties
	$mst_room->CssClass = "";
	$mst_room->CssStyle = "";
	$mst_room->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$mst_room_delete->LoadRowValues($rs);

	// Render row
	$mst_room_delete->RenderRow();
?>
	<tr<?php echo $mst_room->RowAttributes() ?>>
		<td<?php echo $mst_room->kode->CellAttributes() ?>>
<div<?php echo $mst_room->kode->ViewAttributes() ?>><?php echo $mst_room->kode->ListViewValue() ?></div></td>
		<td<?php echo $mst_room->nama->CellAttributes() ?>>
<div<?php echo $mst_room->nama->ViewAttributes() ?>><?php echo $mst_room->nama->ListViewValue() ?></div></td>
		<td<?php echo $mst_room->tipe->CellAttributes() ?>>
<div<?php echo $mst_room->tipe->ViewAttributes() ?>><?php echo $mst_room->tipe->ListViewValue() ?></div></td>
		<td<?php echo $mst_room->connecting1->CellAttributes() ?>>
<div<?php echo $mst_room->connecting1->ViewAttributes() ?>><?php echo $mst_room->connecting1->ListViewValue() ?></div></td>
		<td<?php echo $mst_room->connecting2->CellAttributes() ?>>
<div<?php echo $mst_room->connecting2->ViewAttributes() ?>><?php echo $mst_room->connecting2->ListViewValue() ?></div></td>
		<td<?php echo $mst_room->changeby->CellAttributes() ?>>
<div<?php echo $mst_room->changeby->ViewAttributes() ?>><?php echo $mst_room->changeby->ListViewValue() ?></div></td>
		<td<?php echo $mst_room->changedate->CellAttributes() ?>>
<div<?php echo $mst_room->changedate->ViewAttributes() ?>><?php echo $mst_room->changedate->ListViewValue() ?></div></td>
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
$mst_room_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_room_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'mst_room';

	// Page Object Name
	var $PageObjName = 'mst_room_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_room;
		if ($mst_room->UseTokenInUrl) $PageUrl .= "t=" . $mst_room->TableVar . "&"; // add page token
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
		global $objForm, $mst_room;
		if ($mst_room->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_room->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_room->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_room_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_room"] = new cmst_room();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_room', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_room;

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
		global $mst_room;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["kode"] <> "") {
			$mst_room->kode->setQueryStringValue($_GET["kode"]);
			$sKey .= $mst_room->kode->QueryStringValue;
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
			$this->Page_Terminate("mst_roomlist.php"); // No key specified, return to list

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
		// SQL constructor in SQL constructor in mst_room class, mst_roominfo.php

		$mst_room->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$mst_room->CurrentAction = $_POST["a_delete"];
		} else {
			$mst_room->CurrentAction = "I"; // Display record
		}
		switch ($mst_room->CurrentAction) {
			case "D": // Delete
				$mst_room->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($mst_room->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $mst_room;
		$DeleteRows = TRUE;
		$sWrkFilter = $mst_room->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in mst_room class, mst_roominfo.php

		$mst_room->CurrentFilter = $sWrkFilter;
		$sSql = $mst_room->SQL();
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
				$DeleteRows = $mst_room->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($mst_room->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($mst_room->CancelMessage <> "") {
				$this->setMessage($mst_room->CancelMessage);
				$mst_room->CancelMessage = "";
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
				$mst_room->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mst_room;

		// Call Recordset Selecting event
		$mst_room->Recordset_Selecting($mst_room->CurrentFilter);

		// Load list page SQL
		$sSql = $mst_room->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$mst_room->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_room;
		$sFilter = $mst_room->KeyFilter();

		// Call Row Selecting event
		$mst_room->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_room->CurrentFilter = $sFilter;
		$sSql = $mst_room->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_room->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_room;
		$mst_room->kode->setDbValue($rs->fields('kode'));
		$mst_room->nama->setDbValue($rs->fields('nama'));
		$mst_room->price->setDbValue($rs->fields('price'));
		$mst_room->price2->setDbValue($rs->fields('price2'));
		$mst_room->tipe->setDbValue($rs->fields('tipe'));
		$mst_room->connecting1->setDbValue($rs->fields('connecting1'));
		$mst_room->connecting2->setDbValue($rs->fields('connecting2'));
		$mst_room->available->setDbValue($rs->fields('available'));
		$mst_room->booked->setDbValue($rs->fields('booked'));
		$mst_room->changeby->setDbValue($rs->fields('changeby'));
		$mst_room->changedate->setDbValue($rs->fields('changedate'));
		$mst_room->xtimestamp->setDbValue($rs->fields('xtimestamp'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_room;

		// Call Row_Rendering event
		$mst_room->Row_Rendering();

		// Common render codes for all row types
		// kode

		$mst_room->kode->CellCssStyle = "white-space: nowrap;";
		$mst_room->kode->CellCssClass = "";

		// nama
		$mst_room->nama->CellCssStyle = "white-space: nowrap;";
		$mst_room->nama->CellCssClass = "";

		// tipe
		$mst_room->tipe->CellCssStyle = "white-space: nowrap;";
		$mst_room->tipe->CellCssClass = "";

		// connecting1
		$mst_room->connecting1->CellCssStyle = "white-space: nowrap;";
		$mst_room->connecting1->CellCssClass = "";

		// connecting2
		$mst_room->connecting2->CellCssStyle = "white-space: nowrap;";
		$mst_room->connecting2->CellCssClass = "";

		// changeby
		$mst_room->changeby->CellCssStyle = "white-space: nowrap;";
		$mst_room->changeby->CellCssClass = "";

		// changedate
		$mst_room->changedate->CellCssStyle = "white-space: nowrap;";
		$mst_room->changedate->CellCssClass = "";
		if ($mst_room->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$mst_room->kode->ViewValue = $mst_room->kode->CurrentValue;
			$mst_room->kode->CssStyle = "";
			$mst_room->kode->CssClass = "";
			$mst_room->kode->ViewCustomAttributes = "";

			// nama
			$mst_room->nama->ViewValue = $mst_room->nama->CurrentValue;
			$mst_room->nama->CssStyle = "";
			$mst_room->nama->CssClass = "";
			$mst_room->nama->ViewCustomAttributes = "";

			// tipe
			if (strval($mst_room->tipe->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `description` FROM `mst_room_type` WHERE `id` = '" . ew_AdjustSql($mst_room->tipe->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_room->tipe->ViewValue = $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$mst_room->tipe->ViewValue = $mst_room->tipe->CurrentValue;
				}
			} else {
				$mst_room->tipe->ViewValue = NULL;
			}
			$mst_room->tipe->CssStyle = "";
			$mst_room->tipe->CssClass = "";
			$mst_room->tipe->ViewCustomAttributes = "";

			// connecting1
			if (strval($mst_room->connecting1->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `mst_room` WHERE `kode` = '" . ew_AdjustSql($mst_room->connecting1->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_room->connecting1->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$mst_room->connecting1->ViewValue = $mst_room->connecting1->CurrentValue;
				}
			} else {
				$mst_room->connecting1->ViewValue = NULL;
			}
			$mst_room->connecting1->CssStyle = "";
			$mst_room->connecting1->CssClass = "";
			$mst_room->connecting1->ViewCustomAttributes = "";

			// connecting2
			if (strval($mst_room->connecting2->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `mst_room` WHERE `kode` = '" . ew_AdjustSql($mst_room->connecting2->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_room->connecting2->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$mst_room->connecting2->ViewValue = $mst_room->connecting2->CurrentValue;
				}
			} else {
				$mst_room->connecting2->ViewValue = NULL;
			}
			$mst_room->connecting2->CssStyle = "";
			$mst_room->connecting2->CssClass = "";
			$mst_room->connecting2->ViewCustomAttributes = "";

			// changeby
			if (strval($mst_room->changeby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($mst_room->changeby->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_room->changeby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$mst_room->changeby->ViewValue = $mst_room->changeby->CurrentValue;
				}
			} else {
				$mst_room->changeby->ViewValue = NULL;
			}
			$mst_room->changeby->CssStyle = "";
			$mst_room->changeby->CssClass = "";
			$mst_room->changeby->ViewCustomAttributes = "";

			// changedate
			$mst_room->changedate->ViewValue = $mst_room->changedate->CurrentValue;
			$mst_room->changedate->ViewValue = ew_FormatDateTime($mst_room->changedate->ViewValue, 7);
			$mst_room->changedate->CssStyle = "";
			$mst_room->changedate->CssClass = "";
			$mst_room->changedate->ViewCustomAttributes = "";

			// kode
			$mst_room->kode->HrefValue = "";

			// nama
			$mst_room->nama->HrefValue = "";

			// tipe
			$mst_room->tipe->HrefValue = "";

			// connecting1
			$mst_room->connecting1->HrefValue = "";

			// connecting2
			$mst_room->connecting2->HrefValue = "";

			// changeby
			$mst_room->changeby->HrefValue = "";

			// changedate
			$mst_room->changedate->HrefValue = "";
		}

		// Call Row Rendered event
		$mst_room->Row_Rendered();
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'mst_room';

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
		global $mst_room;
		$table = 'mst_room';

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
			if (array_key_exists($fldname, $mst_room->fields) && $mst_room->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore Blob Field
				$oldvalue = ($mst_room->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) ? "<MEMO>" : $rs[$fldname]; // Memo Field
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
