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
$mst_menuweb_delete = new cmst_menuweb_delete();
$Page =& $mst_menuweb_delete;

// Page init processing
$mst_menuweb_delete->Page_Init();

// Page main processing
$mst_menuweb_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mst_menuweb_delete = new ew_Page("mst_menuweb_delete");

// page properties
mst_menuweb_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = mst_menuweb_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
mst_menuweb_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_menuweb_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_menuweb_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $mst_menuweb_delete->LoadRecordset();
$mst_menuweb_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($mst_menuweb_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$mst_menuweb_delete->Page_Terminate("mst_menuweblist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From <h3><b>Web Menu</b></h3><br><br>
<a href="<?php echo $mst_menuweb->getReturnUrl() ?>">Go Back</a></span></p>
<?php $mst_menuweb_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="mst_menuweb">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($mst_menuweb_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $mst_menuweb->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Kode</td>
		<td valign="top">No Urut</td>
		<td valign="top">Bahasa</td>
		<td valign="top">Caption</td>
		<td valign="top">Url</td>
		<td valign="top">Target</td>
		<td valign="top">Create By</td>
		<td valign="top">Create Date</td>
	</tr>
	</thead>
	<tbody>
<?php
$mst_menuweb_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$mst_menuweb_delete->lRecCnt++;

	// Set row properties
	$mst_menuweb->CssClass = "";
	$mst_menuweb->CssStyle = "";
	$mst_menuweb->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$mst_menuweb_delete->LoadRowValues($rs);

	// Render row
	$mst_menuweb_delete->RenderRow();
?>
	<tr<?php echo $mst_menuweb->RowAttributes() ?>>
		<td<?php echo $mst_menuweb->kode->CellAttributes() ?>>
<div<?php echo $mst_menuweb->kode->ViewAttributes() ?>><?php echo $mst_menuweb->kode->ListViewValue() ?></div></td>
		<td<?php echo $mst_menuweb->seqno->CellAttributes() ?>>
<div<?php echo $mst_menuweb->seqno->ViewAttributes() ?>><?php echo $mst_menuweb->seqno->ListViewValue() ?></div></td>
		<td<?php echo $mst_menuweb->lang->CellAttributes() ?>>
<div<?php echo $mst_menuweb->lang->ViewAttributes() ?>><?php echo $mst_menuweb->lang->ListViewValue() ?></div></td>
		<td<?php echo $mst_menuweb->caption->CellAttributes() ?>>
<div<?php echo $mst_menuweb->caption->ViewAttributes() ?>><?php echo $mst_menuweb->caption->ListViewValue() ?></div></td>
		<td<?php echo $mst_menuweb->url->CellAttributes() ?>>
<div<?php echo $mst_menuweb->url->ViewAttributes() ?>><?php echo $mst_menuweb->url->ListViewValue() ?></div></td>
		<td<?php echo $mst_menuweb->target->CellAttributes() ?>>
<div<?php echo $mst_menuweb->target->ViewAttributes() ?>><?php echo $mst_menuweb->target->ListViewValue() ?></div></td>
		<td<?php echo $mst_menuweb->createby->CellAttributes() ?>>
<div<?php echo $mst_menuweb->createby->ViewAttributes() ?>><?php echo $mst_menuweb->createby->ListViewValue() ?></div></td>
		<td<?php echo $mst_menuweb->createdate->CellAttributes() ?>>
<div<?php echo $mst_menuweb->createdate->ViewAttributes() ?>><?php echo $mst_menuweb->createdate->ListViewValue() ?></div></td>
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
$mst_menuweb_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_menuweb_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'mst_menuweb';

	// Page Object Name
	var $PageObjName = 'mst_menuweb_delete';

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
	function cmst_menuweb_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_menuweb"] = new cmst_menuweb();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs;
	var $lRecCnt;
	var $arRecKeys = array();

	// Page main processing
	function Page_Main() {
		global $mst_menuweb;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["kode"] <> "") {
			$mst_menuweb->kode->setQueryStringValue($_GET["kode"]);
			if (!is_numeric($mst_menuweb->kode->QueryStringValue))
				$this->Page_Terminate("mst_menuweblist.php"); // Prevent SQL injection, exit
			$sKey .= $mst_menuweb->kode->QueryStringValue;
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
			$this->Page_Terminate("mst_menuweblist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("mst_menuweblist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`kode`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in mst_menuweb class, mst_menuwebinfo.php

		$mst_menuweb->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$mst_menuweb->CurrentAction = $_POST["a_delete"];
		} else {
			$mst_menuweb->CurrentAction = "I"; // Display record
		}
		switch ($mst_menuweb->CurrentAction) {
			case "D": // Delete
				$mst_menuweb->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($mst_menuweb->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $mst_menuweb;
		$DeleteRows = TRUE;
		$sWrkFilter = $mst_menuweb->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in mst_menuweb class, mst_menuwebinfo.php

		$mst_menuweb->CurrentFilter = $sWrkFilter;
		$sSql = $mst_menuweb->SQL();
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
				$DeleteRows = $mst_menuweb->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($mst_menuweb->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($mst_menuweb->CancelMessage <> "") {
				$this->setMessage($mst_menuweb->CancelMessage);
				$mst_menuweb->CancelMessage = "";
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
				$mst_menuweb->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mst_menuweb;

		// Call Recordset Selecting event
		$mst_menuweb->Recordset_Selecting($mst_menuweb->CurrentFilter);

		// Load list page SQL
		$sSql = $mst_menuweb->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$mst_menuweb->Recordset_Selected($rs);
		return $rs;
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

		$mst_menuweb->kode->CellCssStyle = "white-space: nowrap;";
		$mst_menuweb->kode->CellCssClass = "";

		// seqno
		$mst_menuweb->seqno->CellCssStyle = "white-space: nowrap;";
		$mst_menuweb->seqno->CellCssClass = "";

		// lang
		$mst_menuweb->lang->CellCssStyle = "white-space: nowrap;";
		$mst_menuweb->lang->CellCssClass = "";

		// caption
		$mst_menuweb->caption->CellCssStyle = "white-space: nowrap;";
		$mst_menuweb->caption->CellCssClass = "";

		// url
		$mst_menuweb->url->CellCssStyle = "white-space: nowrap;";
		$mst_menuweb->url->CellCssClass = "";

		// target
		$mst_menuweb->target->CellCssStyle = "white-space: nowrap;";
		$mst_menuweb->target->CellCssClass = "";

		// createby
		$mst_menuweb->createby->CellCssStyle = "white-space: nowrap;";
		$mst_menuweb->createby->CellCssClass = "";

		// createdate
		$mst_menuweb->createdate->CellCssStyle = "white-space: nowrap;";
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
