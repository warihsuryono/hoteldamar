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
$mst_room_type_delete = new cmst_room_type_delete();
$Page =& $mst_room_type_delete;

// Page init processing
$mst_room_type_delete->Page_Init();

// Page main processing
$mst_room_type_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mst_room_type_delete = new ew_Page("mst_room_type_delete");

// page properties
mst_room_type_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = mst_room_type_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
mst_room_type_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_room_type_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_room_type_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $mst_room_type_delete->LoadRecordset();
$mst_room_type_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($mst_room_type_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$mst_room_type_delete->Page_Terminate("mst_room_typelist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From <h3><b>Master Room Type</b></h3><br><br>
<a href="<?php echo $mst_room_type->getReturnUrl() ?>">Go Back</a></span></p>
<?php $mst_room_type_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="mst_room_type">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($mst_room_type_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $mst_room_type->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id</td>
		<td valign="top">Description</td>
	</tr>
	</thead>
	<tbody>
<?php
$mst_room_type_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$mst_room_type_delete->lRecCnt++;

	// Set row properties
	$mst_room_type->CssClass = "";
	$mst_room_type->CssStyle = "";
	$mst_room_type->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$mst_room_type_delete->LoadRowValues($rs);

	// Render row
	$mst_room_type_delete->RenderRow();
?>
	<tr<?php echo $mst_room_type->RowAttributes() ?>>
		<td<?php echo $mst_room_type->id->CellAttributes() ?>>
<div<?php echo $mst_room_type->id->ViewAttributes() ?>><?php echo $mst_room_type->id->ListViewValue() ?></div></td>
		<td<?php echo $mst_room_type->description->CellAttributes() ?>>
<div<?php echo $mst_room_type->description->ViewAttributes() ?>><?php echo $mst_room_type->description->ListViewValue() ?></div></td>
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
$mst_room_type_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_room_type_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'mst_room_type';

	// Page Object Name
	var $PageObjName = 'mst_room_type_delete';

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
	function cmst_room_type_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_room_type"] = new cmst_room_type();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $mst_room_type;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$mst_room_type->id->setQueryStringValue($_GET["id"]);
			$sKey .= $mst_room_type->id->QueryStringValue;
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
			$this->Page_Terminate("mst_room_typelist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			$sFilter .= "`id`='" . ew_AdjustSql($sKeyFld) . "' AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in mst_room_type class, mst_room_typeinfo.php

		$mst_room_type->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$mst_room_type->CurrentAction = $_POST["a_delete"];
		} else {
			$mst_room_type->CurrentAction = "I"; // Display record
		}
		switch ($mst_room_type->CurrentAction) {
			case "D": // Delete
				$mst_room_type->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($mst_room_type->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $mst_room_type;
		$DeleteRows = TRUE;
		$sWrkFilter = $mst_room_type->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in mst_room_type class, mst_room_typeinfo.php

		$mst_room_type->CurrentFilter = $sWrkFilter;
		$sSql = $mst_room_type->SQL();
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
				$DeleteRows = $mst_room_type->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($mst_room_type->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($mst_room_type->CancelMessage <> "") {
				$this->setMessage($mst_room_type->CancelMessage);
				$mst_room_type->CancelMessage = "";
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
				$mst_room_type->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mst_room_type;

		// Call Recordset Selecting event
		$mst_room_type->Recordset_Selecting($mst_room_type->CurrentFilter);

		// Load list page SQL
		$sSql = $mst_room_type->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$mst_room_type->Recordset_Selected($rs);
		return $rs;
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

		$mst_room_type->id->CellCssStyle = "white-space: nowrap;";
		$mst_room_type->id->CellCssClass = "";

		// description
		$mst_room_type->description->CellCssStyle = "white-space: nowrap;";
		$mst_room_type->description->CellCssClass = "";
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

			// id
			$mst_room_type->id->HrefValue = "";

			// description
			$mst_room_type->description->HrefValue = "";
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
