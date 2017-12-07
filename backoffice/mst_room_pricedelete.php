<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_room_priceinfo.php" ?>
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
$mst_room_price_delete = new cmst_room_price_delete();
$Page =& $mst_room_price_delete;

// Page init processing
$mst_room_price_delete->Page_Init();

// Page main processing
$mst_room_price_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mst_room_price_delete = new ew_Page("mst_room_price_delete");

// page properties
mst_room_price_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = mst_room_price_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
mst_room_price_delete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_room_price_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_room_price_delete.ValidateRequired = false; // no JavaScript validation
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
$rs = $mst_room_price_delete->LoadRecordset();
$mst_room_price_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($mst_room_price_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$mst_room_price_delete->Page_Terminate("mst_room_pricelist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From <h3><b>Master Room Price</b></h3><br><br>
<a href="<?php echo $mst_room_price->getReturnUrl() ?>">Go Back</a></span></p>
<?php $mst_room_price_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="mst_room_price">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($mst_room_price_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $mst_room_price->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Id</td>
		<td valign="top">Start Date</td>
		<td valign="top">End Date</td>
		<td valign="top">Room</td>
		<td valign="top">Room Type</td>
		<td valign="top">Description</td>
		<td valign="top">Base Price</td>
		<td valign="top">Tax (%)</td>
		<td valign="top">Service (%)</td>
		<td valign="top">After Tax&Service</td>
		<td valign="top">Create By</td>
		<td valign="top">Create Date</td>
	</tr>
	</thead>
	<tbody>
<?php
$mst_room_price_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$mst_room_price_delete->lRecCnt++;

	// Set row properties
	$mst_room_price->CssClass = "";
	$mst_room_price->CssStyle = "";
	$mst_room_price->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$mst_room_price_delete->LoadRowValues($rs);

	// Render row
	$mst_room_price_delete->RenderRow();
?>
	<tr<?php echo $mst_room_price->RowAttributes() ?>>
		<td<?php echo $mst_room_price->id->CellAttributes() ?>>
<div<?php echo $mst_room_price->id->ViewAttributes() ?>><?php echo $mst_room_price->id->ListViewValue() ?></div></td>
		<td<?php echo $mst_room_price->tanggal1->CellAttributes() ?>>
<div<?php echo $mst_room_price->tanggal1->ViewAttributes() ?>><?php echo $mst_room_price->tanggal1->ListViewValue() ?></div></td>
		<td<?php echo $mst_room_price->tanggal2->CellAttributes() ?>>
<div<?php echo $mst_room_price->tanggal2->ViewAttributes() ?>><?php echo $mst_room_price->tanggal2->ListViewValue() ?></div></td>
		<td<?php echo $mst_room_price->room->CellAttributes() ?>>
<div<?php echo $mst_room_price->room->ViewAttributes() ?>><?php echo $mst_room_price->room->ListViewValue() ?></div></td>
		<td<?php echo $mst_room_price->roomtype->CellAttributes() ?>>
<div<?php echo $mst_room_price->roomtype->ViewAttributes() ?>><?php echo $mst_room_price->roomtype->ListViewValue() ?></div></td>
		<td<?php echo $mst_room_price->description->CellAttributes() ?>>
<div<?php echo $mst_room_price->description->ViewAttributes() ?>><?php echo $mst_room_price->description->ListViewValue() ?></div></td>
		<td<?php echo $mst_room_price->baseprice->CellAttributes() ?>>
<div<?php echo $mst_room_price->baseprice->ViewAttributes() ?>><?php echo $mst_room_price->baseprice->ListViewValue() ?></div></td>
		<td<?php echo $mst_room_price->tax->CellAttributes() ?>>
<div<?php echo $mst_room_price->tax->ViewAttributes() ?>><?php echo $mst_room_price->tax->ListViewValue() ?></div></td>
		<td<?php echo $mst_room_price->service->CellAttributes() ?>>
<div<?php echo $mst_room_price->service->ViewAttributes() ?>><?php echo $mst_room_price->service->ListViewValue() ?></div></td>
		<td<?php echo $mst_room_price->aftertaxservice->CellAttributes() ?>>
<div<?php echo $mst_room_price->aftertaxservice->ViewAttributes() ?>><?php echo $mst_room_price->aftertaxservice->ListViewValue() ?></div></td>
		<td<?php echo $mst_room_price->createby->CellAttributes() ?>>
<div<?php echo $mst_room_price->createby->ViewAttributes() ?>><?php echo $mst_room_price->createby->ListViewValue() ?></div></td>
		<td<?php echo $mst_room_price->createdate->CellAttributes() ?>>
<div<?php echo $mst_room_price->createdate->ViewAttributes() ?>><?php echo $mst_room_price->createdate->ListViewValue() ?></div></td>
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
$mst_room_price_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_room_price_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'mst_room_price';

	// Page Object Name
	var $PageObjName = 'mst_room_price_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_room_price;
		if ($mst_room_price->UseTokenInUrl) $PageUrl .= "t=" . $mst_room_price->TableVar . "&"; // add page token
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
		global $objForm, $mst_room_price;
		if ($mst_room_price->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_room_price->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_room_price->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_room_price_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_room_price"] = new cmst_room_price();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_room_price', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_room_price;

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
		global $mst_room_price;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$mst_room_price->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($mst_room_price->id->QueryStringValue))
				$this->Page_Terminate("mst_room_pricelist.php"); // Prevent SQL injection, exit
			$sKey .= $mst_room_price->id->QueryStringValue;
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
			$this->Page_Terminate("mst_room_pricelist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("mst_room_pricelist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WhHERE clause) and get return SQL
		// SQL constructor in SQL constructor in mst_room_price class, mst_room_priceinfo.php

		$mst_room_price->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$mst_room_price->CurrentAction = $_POST["a_delete"];
		} else {
			$mst_room_price->CurrentAction = "I"; // Display record
		}
		switch ($mst_room_price->CurrentAction) {
			case "D": // Delete
				$mst_room_price->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($mst_room_price->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $mst_room_price;
		$DeleteRows = TRUE;
		$sWrkFilter = $mst_room_price->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in mst_room_price class, mst_room_priceinfo.php

		$mst_room_price->CurrentFilter = $sWrkFilter;
		$sSql = $mst_room_price->SQL();
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
				$DeleteRows = $mst_room_price->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($mst_room_price->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($mst_room_price->CancelMessage <> "") {
				$this->setMessage($mst_room_price->CancelMessage);
				$mst_room_price->CancelMessage = "";
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
				$mst_room_price->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mst_room_price;

		// Call Recordset Selecting event
		$mst_room_price->Recordset_Selecting($mst_room_price->CurrentFilter);

		// Load list page SQL
		$sSql = $mst_room_price->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$mst_room_price->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_room_price;
		$sFilter = $mst_room_price->KeyFilter();

		// Call Row Selecting event
		$mst_room_price->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_room_price->CurrentFilter = $sFilter;
		$sSql = $mst_room_price->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_room_price->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_room_price;
		$mst_room_price->id->setDbValue($rs->fields('id'));
		$mst_room_price->tanggal1->setDbValue($rs->fields('tanggal1'));
		$mst_room_price->tanggal2->setDbValue($rs->fields('tanggal2'));
		$mst_room_price->room->setDbValue($rs->fields('room'));
		$mst_room_price->roomtype->setDbValue($rs->fields('roomtype'));
		$mst_room_price->description->setDbValue($rs->fields('description'));
		$mst_room_price->baseprice->setDbValue($rs->fields('baseprice'));
		$mst_room_price->tax->setDbValue($rs->fields('tax'));
		$mst_room_price->service->setDbValue($rs->fields('service'));
		$mst_room_price->aftertaxservice->setDbValue($rs->fields('aftertaxservice'));
		$mst_room_price->createby->setDbValue($rs->fields('createby'));
		$mst_room_price->createdate->setDbValue($rs->fields('createdate'));
		$mst_room_price->xtimestamp->setDbValue($rs->fields('xtimestamp'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_room_price;

		// Call Row_Rendering event
		$mst_room_price->Row_Rendering();

		// Common render codes for all row types
		// id

		$mst_room_price->id->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->id->CellCssClass = "";

		// tanggal1
		$mst_room_price->tanggal1->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->tanggal1->CellCssClass = "";

		// tanggal2
		$mst_room_price->tanggal2->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->tanggal2->CellCssClass = "";

		// room
		$mst_room_price->room->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->room->CellCssClass = "";

		// roomtype
		$mst_room_price->roomtype->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->roomtype->CellCssClass = "";

		// description
		$mst_room_price->description->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->description->CellCssClass = "";

		// baseprice
		$mst_room_price->baseprice->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->baseprice->CellCssClass = "";

		// tax
		$mst_room_price->tax->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->tax->CellCssClass = "";

		// service
		$mst_room_price->service->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->service->CellCssClass = "";

		// aftertaxservice
		$mst_room_price->aftertaxservice->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->aftertaxservice->CellCssClass = "";

		// createby
		$mst_room_price->createby->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->createby->CellCssClass = "";

		// createdate
		$mst_room_price->createdate->CellCssStyle = "white-space: nowrap;";
		$mst_room_price->createdate->CellCssClass = "";
		if ($mst_room_price->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$mst_room_price->id->ViewValue = $mst_room_price->id->CurrentValue;
			$mst_room_price->id->CssStyle = "";
			$mst_room_price->id->CssClass = "";
			$mst_room_price->id->ViewCustomAttributes = "";

			// tanggal1
			$mst_room_price->tanggal1->ViewValue = $mst_room_price->tanggal1->CurrentValue;
			$mst_room_price->tanggal1->ViewValue = ew_FormatDateTime($mst_room_price->tanggal1->ViewValue, 7);
			$mst_room_price->tanggal1->CssStyle = "";
			$mst_room_price->tanggal1->CssClass = "";
			$mst_room_price->tanggal1->ViewCustomAttributes = "";

			// tanggal2
			$mst_room_price->tanggal2->ViewValue = $mst_room_price->tanggal2->CurrentValue;
			$mst_room_price->tanggal2->ViewValue = ew_FormatDateTime($mst_room_price->tanggal2->ViewValue, 7);
			$mst_room_price->tanggal2->CssStyle = "";
			$mst_room_price->tanggal2->CssClass = "";
			$mst_room_price->tanggal2->ViewCustomAttributes = "";

			// room
			if (strval($mst_room_price->room->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `mst_room` WHERE `kode` = '" . ew_AdjustSql($mst_room_price->room->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_room_price->room->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$mst_room_price->room->ViewValue = $mst_room_price->room->CurrentValue;
				}
			} else {
				$mst_room_price->room->ViewValue = NULL;
			}
			$mst_room_price->room->CssStyle = "";
			$mst_room_price->room->CssClass = "";
			$mst_room_price->room->ViewCustomAttributes = "";

			// roomtype
			if (strval($mst_room_price->roomtype->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `description` FROM `mst_room_type` WHERE `id` = '" . ew_AdjustSql($mst_room_price->roomtype->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_room_price->roomtype->ViewValue = $rswrk->fields('description');
					$rswrk->Close();
				} else {
					$mst_room_price->roomtype->ViewValue = $mst_room_price->roomtype->CurrentValue;
				}
			} else {
				$mst_room_price->roomtype->ViewValue = NULL;
			}
			$mst_room_price->roomtype->CssStyle = "";
			$mst_room_price->roomtype->CssClass = "";
			$mst_room_price->roomtype->ViewCustomAttributes = "";

			// description
			$mst_room_price->description->ViewValue = $mst_room_price->description->CurrentValue;
			$mst_room_price->description->CssStyle = "";
			$mst_room_price->description->CssClass = "";
			$mst_room_price->description->ViewCustomAttributes = "";

			// baseprice
			$mst_room_price->baseprice->ViewValue = $mst_room_price->baseprice->CurrentValue;
			$mst_room_price->baseprice->ViewValue = ew_FormatNumber($mst_room_price->baseprice->ViewValue, 0, -2, -2, -2);
			$mst_room_price->baseprice->CssStyle = "text-align:right;";
			$mst_room_price->baseprice->CssClass = "";
			$mst_room_price->baseprice->ViewCustomAttributes = "";

			// tax
			$mst_room_price->tax->ViewValue = $mst_room_price->tax->CurrentValue;
			$mst_room_price->tax->ViewValue = ew_FormatNumber($mst_room_price->tax->ViewValue, 0, -2, -2, -2);
			$mst_room_price->tax->CssStyle = "text-align:right;";
			$mst_room_price->tax->CssClass = "";
			$mst_room_price->tax->ViewCustomAttributes = "";

			// service
			$mst_room_price->service->ViewValue = $mst_room_price->service->CurrentValue;
			$mst_room_price->service->ViewValue = ew_FormatNumber($mst_room_price->service->ViewValue, 0, -2, -2, -2);
			$mst_room_price->service->CssStyle = "text-align:right;";
			$mst_room_price->service->CssClass = "";
			$mst_room_price->service->ViewCustomAttributes = "";

			// aftertaxservice
			$mst_room_price->aftertaxservice->ViewValue = $mst_room_price->aftertaxservice->CurrentValue;
			$mst_room_price->aftertaxservice->ViewValue = ew_FormatNumber($mst_room_price->aftertaxservice->ViewValue, 0, -2, -2, -2);
			$mst_room_price->aftertaxservice->CssStyle = "text-align:right;";
			$mst_room_price->aftertaxservice->CssClass = "";
			$mst_room_price->aftertaxservice->ViewCustomAttributes = "";

			// createby
			if (strval($mst_room_price->createby->CurrentValue) <> "") {
				$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($mst_room_price->createby->CurrentValue) . "'";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
					$mst_room_price->createby->ViewValue = $rswrk->fields('nama');
					$rswrk->Close();
				} else {
					$mst_room_price->createby->ViewValue = $mst_room_price->createby->CurrentValue;
				}
			} else {
				$mst_room_price->createby->ViewValue = NULL;
			}
			$mst_room_price->createby->CssStyle = "";
			$mst_room_price->createby->CssClass = "";
			$mst_room_price->createby->ViewCustomAttributes = "";

			// createdate
			$mst_room_price->createdate->ViewValue = $mst_room_price->createdate->CurrentValue;
			$mst_room_price->createdate->ViewValue = ew_FormatDateTime($mst_room_price->createdate->ViewValue, 7);
			$mst_room_price->createdate->CssStyle = "";
			$mst_room_price->createdate->CssClass = "";
			$mst_room_price->createdate->ViewCustomAttributes = "";

			// id
			$mst_room_price->id->HrefValue = "";

			// tanggal1
			$mst_room_price->tanggal1->HrefValue = "";

			// tanggal2
			$mst_room_price->tanggal2->HrefValue = "";

			// room
			$mst_room_price->room->HrefValue = "";

			// roomtype
			$mst_room_price->roomtype->HrefValue = "";

			// description
			$mst_room_price->description->HrefValue = "";

			// baseprice
			$mst_room_price->baseprice->HrefValue = "";

			// tax
			$mst_room_price->tax->HrefValue = "";

			// service
			$mst_room_price->service->HrefValue = "";

			// aftertaxservice
			$mst_room_price->aftertaxservice->HrefValue = "";

			// createby
			$mst_room_price->createby->HrefValue = "";

			// createdate
			$mst_room_price->createdate->HrefValue = "";
		}

		// Call Row Rendered event
		$mst_room_price->Row_Rendered();
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
