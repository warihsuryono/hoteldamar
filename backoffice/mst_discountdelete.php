<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_discountinfo.php" ?>
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
$mst_discount_delete = new cmst_discount_delete();
$Page =& $mst_discount_delete;

// Page init processing
$mst_discount_delete->Page_Init();

// Page main processing
$mst_discount_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mst_discount_delete = new ew_Page("mst_discount_delete");

// page properties
mst_discount_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = mst_discount_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
mst_discount_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_discount_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_discount_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $mst_discount_delete->LoadRecordset();
$mst_discount_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($mst_discount_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$mst_discount_delete->Page_Terminate("mst_discountlist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From Mst Discount<br><br>
<a href="<?php echo $mst_discount->getReturnUrl() ?>">Go Back</a></span></p>
<?php $mst_discount_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="mst_discount">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($mst_discount_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $mst_discount->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id</td>
		<td valign="top">Name</td>
		<td valign="top">Description</td>
		<td valign="top">Disc (%)</td>
	</tr>
	</thead>
	<tbody>
<?php
$mst_discount_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$mst_discount_delete->lRecCnt++;

	// Set row properties
	$mst_discount->CssClass = "";
	$mst_discount->CssStyle = "";
	$mst_discount->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$mst_discount_delete->LoadRowValues($rs);

	// Render row
	$mst_discount_delete->RenderRow();
?>
	<tr<?php echo $mst_discount->RowAttributes() ?>>
		<td<?php echo $mst_discount->id->CellAttributes() ?>>
<div<?php echo $mst_discount->id->ViewAttributes() ?>><?php echo $mst_discount->id->ListViewValue() ?></div></td>
		<td<?php echo $mst_discount->name->CellAttributes() ?>>
<div<?php echo $mst_discount->name->ViewAttributes() ?>><?php echo $mst_discount->name->ListViewValue() ?></div></td>
		<td<?php echo $mst_discount->description->CellAttributes() ?>>
<div<?php echo $mst_discount->description->ViewAttributes() ?>><?php echo $mst_discount->description->ListViewValue() ?></div></td>
		<td<?php echo $mst_discount->disc->CellAttributes() ?>>
<div<?php echo $mst_discount->disc->ViewAttributes() ?>><?php echo $mst_discount->disc->ListViewValue() ?></div></td>
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
$mst_discount_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_discount_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'mst_discount';

	// Page Object Name
	var $PageObjName = 'mst_discount_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_discount;
		if ($mst_discount->UseTokenInUrl) $PageUrl .= "t=" . $mst_discount->TableVar . "&"; // add page token
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
		global $objForm, $mst_discount;
		if ($mst_discount->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_discount->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_discount->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_discount_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_discount"] = new cmst_discount();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_discount', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_discount;

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
		global $mst_discount;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$mst_discount->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($mst_discount->id->QueryStringValue))
				$this->Page_Terminate("mst_discountlist.php"); // Prevent SQL injection, exit
			$sKey .= $mst_discount->id->QueryStringValue;
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
			$this->Page_Terminate("mst_discountlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("mst_discountlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in mst_discount class, mst_discountinfo.php

		$mst_discount->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$mst_discount->CurrentAction = $_POST["a_delete"];
		} else {
			$mst_discount->CurrentAction = "I"; // Display record
		}
		switch ($mst_discount->CurrentAction) {
			case "D": // Delete
				$mst_discount->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($mst_discount->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $mst_discount;
		$DeleteRows = TRUE;
		$sWrkFilter = $mst_discount->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in mst_discount class, mst_discountinfo.php

		$mst_discount->CurrentFilter = $sWrkFilter;
		$sSql = $mst_discount->SQL();
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
				$DeleteRows = $mst_discount->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($mst_discount->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($mst_discount->CancelMessage <> "") {
				$this->setMessage($mst_discount->CancelMessage);
				$mst_discount->CancelMessage = "";
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
				$mst_discount->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mst_discount;

		// Call Recordset Selecting event
		$mst_discount->Recordset_Selecting($mst_discount->CurrentFilter);

		// Load list page SQL
		$sSql = $mst_discount->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$mst_discount->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_discount;
		$sFilter = $mst_discount->KeyFilter();

		// Call Row Selecting event
		$mst_discount->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_discount->CurrentFilter = $sFilter;
		$sSql = $mst_discount->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_discount->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_discount;
		$mst_discount->id->setDbValue($rs->fields('id'));
		$mst_discount->name->setDbValue($rs->fields('name'));
		$mst_discount->description->setDbValue($rs->fields('description'));
		$mst_discount->disc->setDbValue($rs->fields('disc'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_discount;

		// Call Row_Rendering event
		$mst_discount->Row_Rendering();

		// Common render codes for all row types
		// id

		$mst_discount->id->CellCssStyle = "white-space: nowrap;";
		$mst_discount->id->CellCssClass = "";

		// name
		$mst_discount->name->CellCssStyle = "white-space: nowrap;";
		$mst_discount->name->CellCssClass = "";

		// description
		$mst_discount->description->CellCssStyle = "white-space: nowrap;";
		$mst_discount->description->CellCssClass = "";

		// disc
		$mst_discount->disc->CellCssStyle = "white-space: nowrap;";
		$mst_discount->disc->CellCssClass = "";
		if ($mst_discount->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$mst_discount->id->ViewValue = $mst_discount->id->CurrentValue;
			$mst_discount->id->CssStyle = "";
			$mst_discount->id->CssClass = "";
			$mst_discount->id->ViewCustomAttributes = "";

			// name
			$mst_discount->name->ViewValue = $mst_discount->name->CurrentValue;
			$mst_discount->name->CssStyle = "";
			$mst_discount->name->CssClass = "";
			$mst_discount->name->ViewCustomAttributes = "";

			// description
			$mst_discount->description->ViewValue = $mst_discount->description->CurrentValue;
			$mst_discount->description->CssStyle = "";
			$mst_discount->description->CssClass = "";
			$mst_discount->description->ViewCustomAttributes = "";

			// disc
			$mst_discount->disc->ViewValue = $mst_discount->disc->CurrentValue;
			$mst_discount->disc->CssStyle = "";
			$mst_discount->disc->CssClass = "";
			$mst_discount->disc->ViewCustomAttributes = "";

			// id
			$mst_discount->id->HrefValue = "";

			// name
			$mst_discount->name->HrefValue = "";

			// description
			$mst_discount->description->HrefValue = "";

			// disc
			$mst_discount->disc->HrefValue = "";
		}

		// Call Row Rendered event
		$mst_discount->Row_Rendered();
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
