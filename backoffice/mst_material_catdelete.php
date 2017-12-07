<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_material_catinfo.php" ?>
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
$mst_material_cat_delete = new cmst_material_cat_delete();
$Page =& $mst_material_cat_delete;

// Page init processing
$mst_material_cat_delete->Page_Init();

// Page main processing
$mst_material_cat_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mst_material_cat_delete = new ew_Page("mst_material_cat_delete");

// page properties
mst_material_cat_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = mst_material_cat_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
mst_material_cat_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_material_cat_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_material_cat_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $mst_material_cat_delete->LoadRecordset();
$mst_material_cat_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($mst_material_cat_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$mst_material_cat_delete->Page_Terminate("mst_material_catlist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From <h3><b>Category</b></h3><br><br>
<a href="<?php echo $mst_material_cat->getReturnUrl() ?>">Go Back</a></span></p>
<?php $mst_material_cat_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="mst_material_cat">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($mst_material_cat_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $mst_material_cat->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id</td>
		<td valign="top">Category</td>
	</tr>
	</thead>
	<tbody>
<?php
$mst_material_cat_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$mst_material_cat_delete->lRecCnt++;

	// Set row properties
	$mst_material_cat->CssClass = "";
	$mst_material_cat->CssStyle = "";
	$mst_material_cat->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$mst_material_cat_delete->LoadRowValues($rs);

	// Render row
	$mst_material_cat_delete->RenderRow();
?>
	<tr<?php echo $mst_material_cat->RowAttributes() ?>>
		<td<?php echo $mst_material_cat->id->CellAttributes() ?>>
<div<?php echo $mst_material_cat->id->ViewAttributes() ?>><?php echo $mst_material_cat->id->ListViewValue() ?></div></td>
		<td<?php echo $mst_material_cat->description->CellAttributes() ?>>
<div<?php echo $mst_material_cat->description->ViewAttributes() ?>><?php echo $mst_material_cat->description->ListViewValue() ?></div></td>
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
$mst_material_cat_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_material_cat_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'mst_material_cat';

	// Page Object Name
	var $PageObjName = 'mst_material_cat_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_material_cat;
		if ($mst_material_cat->UseTokenInUrl) $PageUrl .= "t=" . $mst_material_cat->TableVar . "&"; // add page token
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
		global $objForm, $mst_material_cat;
		if ($mst_material_cat->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_material_cat->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_material_cat->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_material_cat_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_material_cat"] = new cmst_material_cat();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_material_cat', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_material_cat;

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
		global $mst_material_cat;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$mst_material_cat->id->setQueryStringValue($_GET["id"]);
			$sKey .= $mst_material_cat->id->QueryStringValue;
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
			$this->Page_Terminate("mst_material_catlist.php"); // No key specified, return to list

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
		// SQL constructor in SQL constructor in mst_material_cat class, mst_material_catinfo.php

		$mst_material_cat->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$mst_material_cat->CurrentAction = $_POST["a_delete"];
		} else {
			$mst_material_cat->CurrentAction = "I"; // Display record
		}
		switch ($mst_material_cat->CurrentAction) {
			case "D": // Delete
				$mst_material_cat->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($mst_material_cat->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $mst_material_cat;
		$DeleteRows = TRUE;
		$sWrkFilter = $mst_material_cat->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in mst_material_cat class, mst_material_catinfo.php

		$mst_material_cat->CurrentFilter = $sWrkFilter;
		$sSql = $mst_material_cat->SQL();
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
				$DeleteRows = $mst_material_cat->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($mst_material_cat->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($mst_material_cat->CancelMessage <> "") {
				$this->setMessage($mst_material_cat->CancelMessage);
				$mst_material_cat->CancelMessage = "";
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
				$mst_material_cat->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mst_material_cat;

		// Call Recordset Selecting event
		$mst_material_cat->Recordset_Selecting($mst_material_cat->CurrentFilter);

		// Load list page SQL
		$sSql = $mst_material_cat->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$mst_material_cat->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_material_cat;
		$sFilter = $mst_material_cat->KeyFilter();

		// Call Row Selecting event
		$mst_material_cat->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_material_cat->CurrentFilter = $sFilter;
		$sSql = $mst_material_cat->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_material_cat->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_material_cat;
		$mst_material_cat->id->setDbValue($rs->fields('id'));
		$mst_material_cat->description->setDbValue($rs->fields('description'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_material_cat;

		// Call Row_Rendering event
		$mst_material_cat->Row_Rendering();

		// Common render codes for all row types
		// id

		$mst_material_cat->id->CellCssStyle = "white-space: nowrap;";
		$mst_material_cat->id->CellCssClass = "";

		// description
		$mst_material_cat->description->CellCssStyle = "white-space: nowrap;";
		$mst_material_cat->description->CellCssClass = "";
		if ($mst_material_cat->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$mst_material_cat->id->ViewValue = $mst_material_cat->id->CurrentValue;
			$mst_material_cat->id->CssStyle = "";
			$mst_material_cat->id->CssClass = "";
			$mst_material_cat->id->ViewCustomAttributes = "";

			// description
			$mst_material_cat->description->ViewValue = $mst_material_cat->description->CurrentValue;
			$mst_material_cat->description->CssStyle = "";
			$mst_material_cat->description->CssClass = "";
			$mst_material_cat->description->ViewCustomAttributes = "";

			// id
			$mst_material_cat->id->HrefValue = "";

			// description
			$mst_material_cat->description->HrefValue = "";
		}

		// Call Row Rendered event
		$mst_material_cat->Row_Rendered();
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
