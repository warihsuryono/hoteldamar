<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "mst_vendorinfo.php" ?>
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
$mst_vendor_delete = new cmst_vendor_delete();
$Page =& $mst_vendor_delete;

// Page init processing
$mst_vendor_delete->Page_Init();

// Page main processing
$mst_vendor_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mst_vendor_delete = new ew_Page("mst_vendor_delete");

// page properties
mst_vendor_delete.PageID = "delete"; // page ID
var EW_PAGE_ID = mst_vendor_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
mst_vendor_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
mst_vendor_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_vendor_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_vendor_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
mst_vendor_delete.ShowHighlightText = "Show highlight"; 
mst_vendor_delete.HideHighlightText = "Hide highlight";

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
$rs = $mst_vendor_delete->LoadRecordset();
$mst_vendor_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($mst_vendor_deletelTotalRecs <= 0) { // No record found, exit
	$rs->Close();
	$mst_vendor_delete->Page_Terminate("mst_vendorlist.php"); // Return to list
}
?>
<p><span class="phpmaker">Delete From <h3><b>Master Supplier</b></h3><br><br>
<a href="<?php echo $mst_vendor->getReturnUrl() ?>">Go Back</a></span></p>
<?php $mst_vendor_delete->ShowMessage() ?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="mst_vendor">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($mst_vendor_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $mst_vendor->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top">Kode</td>
		<td valign="top">Nama</td>
		<td valign="top">NPWP</td>
		<td valign="top">PIC</td>
		<td valign="top">Phone</td>
		<td valign="top">Fax</td>
		<td valign="top">E Mail</td>
		<!--td valign="top">Peruntukan</td-->
	</tr>
	</thead>
	<tbody>
<?php
$mst_vendor_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$mst_vendor_delete->lRecCnt++;

	// Set row properties
	$mst_vendor->CssClass = "";
	$mst_vendor->CssStyle = "";
	$mst_vendor->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$mst_vendor_delete->LoadRowValues($rs);

	// Render row
	$mst_vendor_delete->RenderRow();
?>
	<tr<?php echo $mst_vendor->RowAttributes() ?>>
		<td<?php echo $mst_vendor->kode->CellAttributes() ?>>
<div<?php echo $mst_vendor->kode->ViewAttributes() ?>><?php echo $mst_vendor->kode->ListViewValue() ?></div></td>
		<td<?php echo $mst_vendor->nama->CellAttributes() ?>>
<div<?php echo $mst_vendor->nama->ViewAttributes() ?>><?php echo $mst_vendor->nama->ListViewValue() ?></div></td>
		<td<?php echo $mst_vendor->npwp->CellAttributes() ?>>
<div<?php echo $mst_vendor->npwp->ViewAttributes() ?>><?php echo $mst_vendor->npwp->ListViewValue() ?></div></td>
		<td<?php echo $mst_vendor->pic->CellAttributes() ?>>
<div<?php echo $mst_vendor->pic->ViewAttributes() ?>><?php echo $mst_vendor->pic->ListViewValue() ?></div></td>
		<td<?php echo $mst_vendor->phone->CellAttributes() ?>>
<div<?php echo $mst_vendor->phone->ViewAttributes() ?>><?php echo $mst_vendor->phone->ListViewValue() ?></div></td>
		<td<?php echo $mst_vendor->fax->CellAttributes() ?>>
<div<?php echo $mst_vendor->fax->ViewAttributes() ?>><?php echo $mst_vendor->fax->ListViewValue() ?></div></td>
		<td<?php echo $mst_vendor->zemail->CellAttributes() ?>>
<div<?php echo $mst_vendor->zemail->ViewAttributes() ?>><?php echo $mst_vendor->zemail->ListViewValue() ?></div></td>
		<!--td<?php echo $mst_vendor->peruntukan->CellAttributes() ?>>
<div<?php echo $mst_vendor->peruntukan->ViewAttributes() ?>><?php echo $mst_vendor->peruntukan->ListViewValue() ?></div></td-->
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
$mst_vendor_delete->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_vendor_delete {

	// Page ID
	var $PageID = 'delete';

	// Table Name
	var $TableName = 'mst_vendor';

	// Page Object Name
	var $PageObjName = 'mst_vendor_delete';

	// Page Name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page Url
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $mst_vendor;
		if ($mst_vendor->UseTokenInUrl) $PageUrl .= "t=" . $mst_vendor->TableVar . "&"; // add page token
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
		global $objForm, $mst_vendor;
		if ($mst_vendor->UseTokenInUrl) {

			//IsPageRequest = False
			if ($objForm)
				return ($mst_vendor->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($mst_vendor->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	//  Class initialize
	//  - init objects
	//  - open connection
	//
	function cmst_vendor_delete() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_vendor"] = new cmst_vendor();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Initialize table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'mst_vendor', TRUE);

		// Open connection to the database
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $mst_vendor;

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
		global $mst_vendor;

		// Load Key Parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["kode"] <> "") {
			$mst_vendor->kode->setQueryStringValue($_GET["kode"]);
			$sKey .= $mst_vendor->kode->QueryStringValue;
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
			$this->Page_Terminate("mst_vendorlist.php"); // No key specified, return to list

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
		// SQL constructor in SQL constructor in mst_vendor class, mst_vendorinfo.php

		$mst_vendor->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$mst_vendor->CurrentAction = $_POST["a_delete"];
		} else {
			$mst_vendor->CurrentAction = "D"; // Delete record directly
		}
		switch ($mst_vendor->CurrentAction) {
			case "D": // Delete
				$mst_vendor->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage("Delete succeeded"); // Set up success message
					$this->Page_Terminate($mst_vendor->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	//  Function DeleteRows
	//  - Delete Records based on current filter
	//
	function DeleteRows() {
		global $conn, $Security, $mst_vendor;
		$DeleteRows = TRUE;
		$sWrkFilter = $mst_vendor->CurrentFilter;

		// Set up filter (Sql Where Clause) and get Return SQL
		// SQL constructor in mst_vendor class, mst_vendorinfo.php

		$mst_vendor->CurrentFilter = $sWrkFilter;
		$sSql = $mst_vendor->SQL();
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
				$DeleteRows = $mst_vendor->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($mst_vendor->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($mst_vendor->CancelMessage <> "") {
				$this->setMessage($mst_vendor->CancelMessage);
				$mst_vendor->CancelMessage = "";
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
				$mst_vendor->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $mst_vendor;

		// Call Recordset Selecting event
		$mst_vendor->Recordset_Selecting($mst_vendor->CurrentFilter);

		// Load list page SQL
		$sSql = $mst_vendor->SelectSQL();
		if ($offset > -1 && $rowcnt > -1) $sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$conn->raiseErrorFn = 'ew_ErrorFn';	
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';

		// Call Recordset Selected event
		$mst_vendor->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $mst_vendor;
		$sFilter = $mst_vendor->KeyFilter();

		// Call Row Selecting event
		$mst_vendor->Row_Selecting($sFilter);

		// Load sql based on filter
		$mst_vendor->CurrentFilter = $sFilter;
		$sSql = $mst_vendor->SQL();
		if ($rs = $conn->Execute($sSql)) {
			if ($rs->EOF) {
				$LoadRow = FALSE;
			} else {
				$LoadRow = TRUE;
				$rs->MoveFirst();
				$this->LoadRowValues($rs); // Load row values

				// Call Row Selected event
				$mst_vendor->Row_Selected($rs);
			}
			$rs->Close();
		} else {
			$LoadRow = FALSE;
		}
		return $LoadRow;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $mst_vendor;
		$mst_vendor->kode->setDbValue($rs->fields('kode'));
		$mst_vendor->nama->setDbValue($rs->fields('nama'));
		$mst_vendor->alamat->setDbValue($rs->fields('alamat'));
		$mst_vendor->alamatpajak->setDbValue($rs->fields('alamatpajak'));
		$mst_vendor->npwp->setDbValue($rs->fields('npwp'));
		$mst_vendor->pic->setDbValue($rs->fields('pic'));
		$mst_vendor->phone->setDbValue($rs->fields('phone'));
		$mst_vendor->fax->setDbValue($rs->fields('fax'));
		$mst_vendor->zemail->setDbValue($rs->fields('email'));
		$mst_vendor->peruntukan->setDbValue($rs->fields('peruntukan'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_vendor;

		// Call Row_Rendering event
		$mst_vendor->Row_Rendering();

		// Common render codes for all row types
		// kode

		$mst_vendor->kode->CellCssStyle = "white-space: nowrap;";
		$mst_vendor->kode->CellCssClass = "";

		// nama
		$mst_vendor->nama->CellCssStyle = "white-space: nowrap;";
		$mst_vendor->nama->CellCssClass = "";

		// npwp
		$mst_vendor->npwp->CellCssStyle = "white-space: nowrap;";
		$mst_vendor->npwp->CellCssClass = "";

		// pic
		$mst_vendor->pic->CellCssStyle = "white-space: nowrap;";
		$mst_vendor->pic->CellCssClass = "";

		// phone
		$mst_vendor->phone->CellCssStyle = "white-space: nowrap;";
		$mst_vendor->phone->CellCssClass = "";

		// fax
		$mst_vendor->fax->CellCssStyle = "white-space: nowrap;";
		$mst_vendor->fax->CellCssClass = "";

		// email
		$mst_vendor->zemail->CellCssStyle = "white-space: nowrap;";
		$mst_vendor->zemail->CellCssClass = "";

		// peruntukan
		$mst_vendor->peruntukan->CellCssStyle = "white-space: nowrap;";
		$mst_vendor->peruntukan->CellCssClass = "";
		if ($mst_vendor->RowType == EW_ROWTYPE_VIEW) { // View row

			// kode
			$mst_vendor->kode->ViewValue = $mst_vendor->kode->CurrentValue;
			$mst_vendor->kode->CssStyle = "";
			$mst_vendor->kode->CssClass = "";
			$mst_vendor->kode->ViewCustomAttributes = "";

			// nama
			$mst_vendor->nama->ViewValue = $mst_vendor->nama->CurrentValue;
			$mst_vendor->nama->CssStyle = "";
			$mst_vendor->nama->CssClass = "";
			$mst_vendor->nama->ViewCustomAttributes = "";

			// npwp
			$mst_vendor->npwp->ViewValue = $mst_vendor->npwp->CurrentValue;
			$mst_vendor->npwp->CssStyle = "";
			$mst_vendor->npwp->CssClass = "";
			$mst_vendor->npwp->ViewCustomAttributes = "";

			// pic
			$mst_vendor->pic->ViewValue = $mst_vendor->pic->CurrentValue;
			$mst_vendor->pic->CssStyle = "";
			$mst_vendor->pic->CssClass = "";
			$mst_vendor->pic->ViewCustomAttributes = "";

			// phone
			$mst_vendor->phone->ViewValue = $mst_vendor->phone->CurrentValue;
			$mst_vendor->phone->CssStyle = "";
			$mst_vendor->phone->CssClass = "";
			$mst_vendor->phone->ViewCustomAttributes = "";

			// fax
			$mst_vendor->fax->ViewValue = $mst_vendor->fax->CurrentValue;
			$mst_vendor->fax->CssStyle = "";
			$mst_vendor->fax->CssClass = "";
			$mst_vendor->fax->ViewCustomAttributes = "";

			// email
			$mst_vendor->zemail->ViewValue = $mst_vendor->zemail->CurrentValue;
			$mst_vendor->zemail->CssStyle = "";
			$mst_vendor->zemail->CssClass = "";
			$mst_vendor->zemail->ViewCustomAttributes = "";

			// peruntukan
			if (strval($mst_vendor->peruntukan->CurrentValue) <> "") {
				switch ($mst_vendor->peruntukan->CurrentValue) {
					case "unit":
						$mst_vendor->peruntukan->ViewValue = "Unit";
						break;
					case "part":
						$mst_vendor->peruntukan->ViewValue = "Part";
						break;
					case "material":
						$mst_vendor->peruntukan->ViewValue = "Material";
						break;
					default:
						$mst_vendor->peruntukan->ViewValue = $mst_vendor->peruntukan->CurrentValue;
				}
			} else {
				$mst_vendor->peruntukan->ViewValue = NULL;
			}
			$mst_vendor->peruntukan->CssStyle = "";
			$mst_vendor->peruntukan->CssClass = "";
			$mst_vendor->peruntukan->ViewCustomAttributes = "";

			// kode
			$mst_vendor->kode->HrefValue = "";

			// nama
			$mst_vendor->nama->HrefValue = "";

			// npwp
			$mst_vendor->npwp->HrefValue = "";

			// pic
			$mst_vendor->pic->HrefValue = "";

			// phone
			$mst_vendor->phone->HrefValue = "";

			// fax
			$mst_vendor->fax->HrefValue = "";

			// email
			$mst_vendor->zemail->HrefValue = "";

			// peruntukan
			$mst_vendor->peruntukan->HrefValue = "";
		}

		// Call Row Rendered event
		$mst_vendor->Row_Rendered();
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'mst_vendor';

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
		global $mst_vendor;
		$table = 'mst_vendor';

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
			if (array_key_exists($fldname, $mst_vendor->fields) && $mst_vendor->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore Blob Field
				$oldvalue = ($mst_vendor->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) ? "<MEMO>" : $rs[$fldname]; // Memo Field
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
