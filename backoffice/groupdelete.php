<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "groupinfo.php" ?>
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
$group_delete = new cgroup_delete();
$Page =& $group_delete;

// Page init processing
$group_delete->Page_Init();

// Page main processing
$group_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var group_delete = new ew_Page("group_delete");

// page properties
group_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = group_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
group_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
group_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
group_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $group_delete->LoadRecordset();
$group_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($group_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$group_delete->Page_Terminate("grouplist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From <br><br>
<a href="<?php echo $group->getReturnUrl() ?>">Cancel</a></span></p>
<?php $group_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="group">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($group_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $group->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id Group</td>
		<td valign="top">Group</td>
	</tr>
	</thead>
	<tbody>
<?php
$group_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$group_delete->lRecCnt++;

	// Set row properties
	$group->CssClass = "";
	$group->CssStyle = "";
	$group->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$group_delete->LoadRowValues($rs);

	// Render row
	$group_delete->RenderRow();
?>
	<tr<?php echo $group->RowAttributes() ?>>
		<td<?php echo $group->id_group->CellAttributes() ?>>
<div<?php echo $group->id_group->ViewAttributes() ?>><?php echo $group->id_group->ListViewValue() ?></div></td>
		<td<?php echo $group->group->CellAttributes() ?>>
<div<?php echo $group->group->ViewAttributes() ?>><?php echo $group->group->ListViewValue() ?></div></td>
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
$group_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class cgroup_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'group';

	// Page Object Name
	var $PageObjName = 'group_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $group;
		if ($group->UseTokenInUrl) $PageUrl .= "t=" . $group->TableVar . "&"; // add page token
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
		global $objForm, $group;
		if ($group->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($group->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($group->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cgroup_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["group"] = new cgroup();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'group', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $group;

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
		global $group;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id_group"] <> "") {
			$group->id_group->setQueryStringValue($_GET["id_group"]);
			if (!is_numeric($group->id_group->QueryStringValue))
				$this->Page_Terminate("grouplist.php"); // Prevent SQL injection, exit
			$sKey .= $group->id_group->QueryStringValue;
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
			$this->Page_Terminate("grouplist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("grouplist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id_group`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in group class, groupinfo.php

		$group->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$group->CurrentAction = $_POST["a_delete"];
		} else {
			$group->CurrentAction = "I"; // Display record
		}
		switch ($group->CurrentAction) {
			case "D": // Delete
				$group->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($group->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $group;
		$DeleteRows = TRUE;
		$sWrkFilter = $group->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in group class, groupinfo.php

		$group->CurrentFilter = $sWrkFilter;
		$sSql = $group->SQL();
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
				$DeleteRows = $group->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_group'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($group->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($group->CancelMessage <> "") {
				$this->setMessage($group->CancelMessage);
				$group->CancelMessage = "";
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
				$group->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $group;

		// Call Recordset Selecting event
		$group->Recordset_Selecting($group->CurrentFilter);

		// Load list page SQL
		$sSql = $group->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$group->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $group;
		$sFilter = $group->KeyFilter();

		// Call Row Selecting event
		$group->Row_Selecting($sFilter);

		// Load sql based on filter
		$group->CurrentFilter = $sFilter;
		$sSql = $group->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$group->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $group;
		$group->id_group->setDbValue($rs->fields('id_group'));
		$group->group->setDbValue($rs->fields('group'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $group;

		// Call Row_Rendering event
		$group->Row_Rendering();

		// Common render codes for all row types
		// id_group

		$group->id_group->CellCssStyle = "white-space: nowrap;";
		$group->id_group->CellCssClass = "";

		// group
		$group->group->CellCssStyle = "white-space: nowrap;";
		$group->group->CellCssClass = "";
		if ($group->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_group
			$group->id_group->ViewValue = $group->id_group->CurrentValue;
			$group->id_group->CssStyle = "";
			$group->id_group->CssClass = "";
			$group->id_group->ViewCustomAttributes = "";

			// group
			$group->group->ViewValue = $group->group->CurrentValue;
			$group->group->CssStyle = "";
			$group->group->CssClass = "";
			$group->group->ViewCustomAttributes = "";

			// id_group
			$group->id_group->HrefValue = "";

			// group
			$group->group->HrefValue = "";
		}

		// Call Row Rendered event
		$group->Row_Rendered();
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
