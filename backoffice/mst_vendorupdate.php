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
$mst_vendor_update = new cmst_vendor_update();
$Page =& $mst_vendor_update;

// Page init processing
$mst_vendor_update->Page_Init();

// Page main processing
$mst_vendor_update->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mst_vendor_update = new ew_Page("mst_vendor_update");

// page properties
mst_vendor_update.PageID = "update"; // page ID
var EW_PAGE_ID = mst_vendor_update.PageID; // for backward compatibility

// extend page with ValidateForm function
mst_vendor_update.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	if (!ew_UpdateSelected(fobj)) {
		alert('No field selected for update');
		return false;
	}
	var uelm;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_nama"];
		uelm = fobj.elements["u" + infix + "_nama"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - Nama");
		}
		elm = fobj.elements["x" + infix + "_alamat"];
		uelm = fobj.elements["u" + infix + "_alamat"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - Alamat");
		}
		elm = fobj.elements["x" + infix + "_alamatpajak"];
		uelm = fobj.elements["u" + infix + "_alamatpajak"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - Alamat Pajak");
		}
		elm = fobj.elements["x" + infix + "_npwp"];
		uelm = fobj.elements["u" + infix + "_npwp"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - NPWP");
		}
		elm = fobj.elements["x" + infix + "_pic"];
		uelm = fobj.elements["u" + infix + "_pic"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - PIC");
		}
		elm = fobj.elements["x" + infix + "_phone"];
		uelm = fobj.elements["u" + infix + "_phone"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - Phone");
		}
		elm = fobj.elements["x" + infix + "_fax"];
		uelm = fobj.elements["u" + infix + "_fax"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - Fax");
		}
		elm = fobj.elements["x" + infix + "_zemail"];
		uelm = fobj.elements["u" + infix + "_zemail"];
		if (uelm && uelm.checked) {
			if (elm && !ew_HasValue(elm))
				return ew_OnError(this, elm, "Please enter required field - E Mail");
		}
		// elm = fobj.elements["x" + infix + "_peruntukan"];
		// uelm = fobj.elements["u" + infix + "_peruntukan"];
		// if (uelm && uelm.checked) {
			// if (elm && !ew_HasValue(elm))
				// return ew_OnError(this, elm, "Please enter required field - Peruntukan");
		// }

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
mst_vendor_update.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
mst_vendor_update.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_vendor_update.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_vendor_update.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
mst_vendor_update.ShowHighlightText = "Show highlight"; 
mst_vendor_update.HideHighlightText = "Hide highlight";

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker">Update <h3><b>Master Vendor</b></h3><br><br>
<!--a href="<?php echo $mst_vendor->getReturnUrl() ?>">Back to List</a-->
<input type="button" value="Kembali" onclick="window.location='<?php echo $mst_vendor->getReturnUrl() ?>';">
</span></p>
<?php $mst_vendor_update->ShowMessage() ?>
<form name="fmst_vendorupdate" id="fmst_vendorupdate" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return mst_vendor_update.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="mst_vendor">
<input type="hidden" name="a_update" id="a_update" value="U">
<?php for ($i = 0; $i < $mst_vendor_update->nKeySelected; $i++) { ?>
<input type="hidden" name="k<?php echo $i+1 ?>_key" id="key<?php echo $i+1 ?>" value="<?php echo ew_HtmlEncode($mst_vendor_update->arRecKeys[$i]) ?>">
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr class="ewTableHeader">
		<td>Update<input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"></td>
		<td>Field Name</td>
		<td>New Value</td>
	</tr>
<?php if ($mst_vendor->nama->Visible) { // nama ?>
	<tr<?php echo $mst_vendor->nama->RowAttributes ?>>
		<td<?php echo $mst_vendor->nama->CellAttributes() ?>>
<input type="checkbox" name="u_nama" id="u_nama" value="1"<?php echo ($mst_vendor->nama->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $mst_vendor->nama->CellAttributes() ?>>Nama</td>
		<td<?php echo $mst_vendor->nama->CellAttributes() ?>><span id="el_nama">
<input type="text" name="x_nama" id="x_nama" size="30" maxlength="100" value="<?php echo $mst_vendor->nama->EditValue ?>"<?php echo $mst_vendor->nama->EditAttributes() ?>>
</span><?php echo $mst_vendor->nama->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_vendor->alamat->Visible) { // alamat ?>
	<tr<?php echo $mst_vendor->alamat->RowAttributes ?>>
		<td<?php echo $mst_vendor->alamat->CellAttributes() ?>>
<input type="checkbox" name="u_alamat" id="u_alamat" value="1"<?php echo ($mst_vendor->alamat->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $mst_vendor->alamat->CellAttributes() ?>>Alamat</td>
		<td<?php echo $mst_vendor->alamat->CellAttributes() ?>><span id="el_alamat">
<input type="text" name="x_alamat" id="x_alamat" size="30" maxlength="255" value="<?php echo $mst_vendor->alamat->EditValue ?>"<?php echo $mst_vendor->alamat->EditAttributes() ?>>
</span><?php echo $mst_vendor->alamat->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_vendor->alamatpajak->Visible) { // alamatpajak ?>
	<tr<?php echo $mst_vendor->alamatpajak->RowAttributes ?>>
		<td<?php echo $mst_vendor->alamatpajak->CellAttributes() ?>>
<input type="checkbox" name="u_alamatpajak" id="u_alamatpajak" value="1"<?php echo ($mst_vendor->alamatpajak->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $mst_vendor->alamatpajak->CellAttributes() ?>>Alamat Pajak</td>
		<td<?php echo $mst_vendor->alamatpajak->CellAttributes() ?>><span id="el_alamatpajak">
<input type="text" name="x_alamatpajak" id="x_alamatpajak" size="30" maxlength="255" value="<?php echo $mst_vendor->alamatpajak->EditValue ?>"<?php echo $mst_vendor->alamatpajak->EditAttributes() ?>>
</span><?php echo $mst_vendor->alamatpajak->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_vendor->npwp->Visible) { // npwp ?>
	<tr<?php echo $mst_vendor->npwp->RowAttributes ?>>
		<td<?php echo $mst_vendor->npwp->CellAttributes() ?>>
<input type="checkbox" name="u_npwp" id="u_npwp" value="1"<?php echo ($mst_vendor->npwp->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $mst_vendor->npwp->CellAttributes() ?>>NPWP</td>
		<td<?php echo $mst_vendor->npwp->CellAttributes() ?>><span id="el_npwp">
<input type="text" name="x_npwp" id="x_npwp" size="30" maxlength="100" value="<?php echo $mst_vendor->npwp->EditValue ?>"<?php echo $mst_vendor->npwp->EditAttributes() ?>>
</span><?php echo $mst_vendor->npwp->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_vendor->pic->Visible) { // pic ?>
	<tr<?php echo $mst_vendor->pic->RowAttributes ?>>
		<td<?php echo $mst_vendor->pic->CellAttributes() ?>>
<input type="checkbox" name="u_pic" id="u_pic" value="1"<?php echo ($mst_vendor->pic->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $mst_vendor->pic->CellAttributes() ?>>PIC</td>
		<td<?php echo $mst_vendor->pic->CellAttributes() ?>><span id="el_pic">
<input type="text" name="x_pic" id="x_pic" size="30" maxlength="100" value="<?php echo $mst_vendor->pic->EditValue ?>"<?php echo $mst_vendor->pic->EditAttributes() ?>>
</span><?php echo $mst_vendor->pic->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_vendor->phone->Visible) { // phone ?>
	<tr<?php echo $mst_vendor->phone->RowAttributes ?>>
		<td<?php echo $mst_vendor->phone->CellAttributes() ?>>
<input type="checkbox" name="u_phone" id="u_phone" value="1"<?php echo ($mst_vendor->phone->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $mst_vendor->phone->CellAttributes() ?>>Phone</td>
		<td<?php echo $mst_vendor->phone->CellAttributes() ?>><span id="el_phone">
<input type="text" name="x_phone" id="x_phone" size="30" maxlength="30" value="<?php echo $mst_vendor->phone->EditValue ?>"<?php echo $mst_vendor->phone->EditAttributes() ?>>
</span><?php echo $mst_vendor->phone->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_vendor->fax->Visible) { // fax ?>
	<tr<?php echo $mst_vendor->fax->RowAttributes ?>>
		<td<?php echo $mst_vendor->fax->CellAttributes() ?>>
<input type="checkbox" name="u_fax" id="u_fax" value="1"<?php echo ($mst_vendor->fax->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $mst_vendor->fax->CellAttributes() ?>>Fax</td>
		<td<?php echo $mst_vendor->fax->CellAttributes() ?>><span id="el_fax">
<input type="text" name="x_fax" id="x_fax" size="30" maxlength="30" value="<?php echo $mst_vendor->fax->EditValue ?>"<?php echo $mst_vendor->fax->EditAttributes() ?>>
</span><?php echo $mst_vendor->fax->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_vendor->zemail->Visible) { // email ?>
	<tr<?php echo $mst_vendor->zemail->RowAttributes ?>>
		<td<?php echo $mst_vendor->zemail->CellAttributes() ?>>
<input type="checkbox" name="u_zemail" id="u_zemail" value="1"<?php echo ($mst_vendor->zemail->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $mst_vendor->zemail->CellAttributes() ?>>E Mail</td>
		<td<?php echo $mst_vendor->zemail->CellAttributes() ?>><span id="el_zemail">
<input type="text" name="x_zemail" id="x_zemail" size="30" maxlength="255" value="<?php echo $mst_vendor->zemail->EditValue ?>"<?php echo $mst_vendor->zemail->EditAttributes() ?>>
</span><?php echo $mst_vendor->zemail->CustomMsg ?></td>
	</tr>
<?php } ?>
<!--
<?php if ($mst_vendor->peruntukan->Visible) { // peruntukan ?>
	<tr<?php echo $mst_vendor->peruntukan->RowAttributes ?>>
		<td<?php echo $mst_vendor->peruntukan->CellAttributes() ?>>
<input type="checkbox" name="u_peruntukan" id="u_peruntukan" value="1"<?php echo ($mst_vendor->peruntukan->MultiUpdate == "1") ? " checked=\"checked\"" : "" ?>>
</td>
		<td<?php echo $mst_vendor->peruntukan->CellAttributes() ?>>Peruntukan</td>
		<td<?php echo $mst_vendor->peruntukan->CellAttributes() ?>><span id="el_peruntukan">
<select id="x_peruntukan" name="x_peruntukan"<?php echo $mst_vendor->peruntukan->EditAttributes() ?>>
<?php
if (is_array($mst_vendor->peruntukan->EditValue)) {
	$arwrk = $mst_vendor->peruntukan->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_vendor->peruntukan->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
</span><?php echo $mst_vendor->peruntukan->CustomMsg ?></td>
	</tr>
<?php } ?>
-->
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="  Update  ">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$mst_vendor_update->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_vendor_update {

	// Page ID
	var $PageID = 'update';

	// Table Name
	var $TableName = 'mst_vendor';

	// Page Object Name
	var $PageObjName = 'mst_vendor_update';

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
	function cmst_vendor_update() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_vendor"] = new cmst_vendor();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

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
	var $nKeySelected;
	var $arRecKeys;
	var $sDisabled;

	//
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $mst_vendor;

		// Try to load keys from list form
		$this->nKeySelected = 0;
		if (ew_IsHttpPost()) {
			if (isset($_POST["key_m"])) { // Key count > 0
				$this->nKeySelected = count($_POST["key_m"]); // Get number of keys
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
				$this->LoadMultiUpdateValues(); // Load initial values to form
			}
		}

		// Try to load key from update form
		if ($this->nKeySelected == 0) {
			$this->arRecKeys = array();

			// Create form object
			$objForm = new cFormObj();
			if (@$_POST["a_update"] <> "") {

				// Get action
				$mst_vendor->CurrentAction = $_POST["a_update"];

				// Get record keys
				$sKey = @$_POST["k" . strval($this->nKeySelected+1) . "_key"];
				while ($sKey <> "") {
					$this->arRecKeys[$this->nKeySelected] = ew_StripSlashes($sKey);
					$this->nKeySelected++;
					$sKey = @$_POST["k" . strval($this->nKeySelected+1) . "_key"];
				}
				$this->LoadFormValues(); // Get form values

				// Validate Form
				if (!$this->ValidateForm()) {
					$mst_vendor->CurrentAction = "I"; // Form error, reset action
					$this->setMessage($gsFormError);
				}
			}
		}
		if ($this->nKeySelected <= 0)
			$this->Page_Terminate("mst_vendorlist.php"); // No records selected, return to list
		switch ($mst_vendor->CurrentAction) {
			case "U": // Update
				if ($this->UpdateRows()) { // Update Records based on key
					$this->setMessage("Update succeeded"); // Set update success message
					$this->Page_Terminate($mst_vendor->getReturnUrl()); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values
				}
		}

		// Render row
		$mst_vendor->RowType = EW_ROWTYPE_EDIT; // Render edit
		$this->RenderRow();
	}

	// Load initial values to form if field values are identical in all selected records
	function LoadMultiUpdateValues() {
		global $mst_vendor;
		$mst_vendor->CurrentFilter = $this->BuildKeyFilter();

		// Load recordset
		$rs = $this->LoadRecordset();
		$i = 1;
		while (!$rs->EOF) {
			if ($i == 1) {
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
			} else {
				if (!ew_CompareValue($mst_vendor->kode->DbValue, $rs->fields('kode')))
					$mst_vendor->kode->CurrentValue = NULL;
				if (!ew_CompareValue($mst_vendor->nama->DbValue, $rs->fields('nama')))
					$mst_vendor->nama->CurrentValue = NULL;
				if (!ew_CompareValue($mst_vendor->alamat->DbValue, $rs->fields('alamat')))
					$mst_vendor->alamat->CurrentValue = NULL;
				if (!ew_CompareValue($mst_vendor->alamatpajak->DbValue, $rs->fields('alamatpajak')))
					$mst_vendor->alamatpajak->CurrentValue = NULL;
				if (!ew_CompareValue($mst_vendor->npwp->DbValue, $rs->fields('npwp')))
					$mst_vendor->npwp->CurrentValue = NULL;
				if (!ew_CompareValue($mst_vendor->pic->DbValue, $rs->fields('pic')))
					$mst_vendor->pic->CurrentValue = NULL;
				if (!ew_CompareValue($mst_vendor->phone->DbValue, $rs->fields('phone')))
					$mst_vendor->phone->CurrentValue = NULL;
				if (!ew_CompareValue($mst_vendor->fax->DbValue, $rs->fields('fax')))
					$mst_vendor->fax->CurrentValue = NULL;
				if (!ew_CompareValue($mst_vendor->zemail->DbValue, $rs->fields('email')))
					$mst_vendor->zemail->CurrentValue = NULL;
				if (!ew_CompareValue($mst_vendor->peruntukan->DbValue, $rs->fields('peruntukan')))
					$mst_vendor->peruntukan->CurrentValue = NULL;
			}
			$i++;
			$rs->MoveNext();
		}
		$rs->Close();
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $mst_vendor;
		$sWrkFilter = "";
		foreach ($this->arRecKeys as $sKey) {
			$sKey = trim($sKey);
			if ($this->SetupKeyValues($sKey)) {
				$sFilter = $mst_vendor->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}
		}
		return $sWrkFilter;
	}

	// Set up key value
	function SetupKeyValues($key) {
		global $mst_vendor;
		$sKeyFld = $key;
		$mst_vendor->kode->CurrentValue = $sKeyFld;
		return TRUE;
	}

	// Update all selected rows
	function UpdateRows() {
		global $conn, $mst_vendor;
		$conn->BeginTrans();
		$this->WriteAuditTrailDummy("*** Batch update begin ***"); // Batch update begin

		// Get old recordset
		$mst_vendor->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $mst_vendor->SQL();
		$rsold = $conn->Execute($sSql);

		// Update all rows
		$sKey = "";
		foreach ($this->arRecKeys as $sThisKey) {
			$sThisKey = trim($sThisKey);
			if ($this->SetupKeyValues($sThisKey)) {
				$mst_vendor->SendEmail = FALSE; // Do not send email on update success
				$UpdateRows = $this->EditRow(); // Update this row
			} else {
				$UpdateRows = FALSE;
			}
			if (!$UpdateRows)
				return; // Update failed
			if ($sKey <> "") $sKey .= ", ";
			$sKey .= $sThisKey;
		}

		// Check if all rows updated
		if ($UpdateRows) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			$rsnew = $conn->Execute($sSql);
			$this->WriteAuditTrailDummy("*** Batch update successful ***"); // Batch update success
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			$this->WriteAuditTrailDummy("*** Batch update rollback ***"); // Batch update rollback
		}
		return $UpdateRows;
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $mst_vendor;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $mst_vendor;
		$mst_vendor->kode->setFormValue($objForm->GetValue("x_kode"));
		$mst_vendor->kode->MultiUpdate = $objForm->GetValue("u_kode");
		$mst_vendor->nama->setFormValue($objForm->GetValue("x_nama"));
		$mst_vendor->nama->MultiUpdate = $objForm->GetValue("u_nama");
		$mst_vendor->alamat->setFormValue($objForm->GetValue("x_alamat"));
		$mst_vendor->alamat->MultiUpdate = $objForm->GetValue("u_alamat");
		$mst_vendor->alamatpajak->setFormValue($objForm->GetValue("x_alamatpajak"));
		$mst_vendor->alamatpajak->MultiUpdate = $objForm->GetValue("u_alamatpajak");
		$mst_vendor->npwp->setFormValue($objForm->GetValue("x_npwp"));
		$mst_vendor->npwp->MultiUpdate = $objForm->GetValue("u_npwp");
		$mst_vendor->pic->setFormValue($objForm->GetValue("x_pic"));
		$mst_vendor->pic->MultiUpdate = $objForm->GetValue("u_pic");
		$mst_vendor->phone->setFormValue($objForm->GetValue("x_phone"));
		$mst_vendor->phone->MultiUpdate = $objForm->GetValue("u_phone");
		$mst_vendor->fax->setFormValue($objForm->GetValue("x_fax"));
		$mst_vendor->fax->MultiUpdate = $objForm->GetValue("u_fax");
		$mst_vendor->zemail->setFormValue($objForm->GetValue("x_zemail"));
		$mst_vendor->zemail->MultiUpdate = $objForm->GetValue("u_zemail");
		$mst_vendor->peruntukan->setFormValue($objForm->GetValue("x_peruntukan"));
		$mst_vendor->peruntukan->MultiUpdate = $objForm->GetValue("u_peruntukan");
	}

	// Restore form values
	function RestoreFormValues() {
		global $mst_vendor;
		$mst_vendor->kode->CurrentValue = $mst_vendor->kode->FormValue;
		$mst_vendor->nama->CurrentValue = $mst_vendor->nama->FormValue;
		$mst_vendor->alamat->CurrentValue = $mst_vendor->alamat->FormValue;
		$mst_vendor->alamatpajak->CurrentValue = $mst_vendor->alamatpajak->FormValue;
		$mst_vendor->npwp->CurrentValue = $mst_vendor->npwp->FormValue;
		$mst_vendor->pic->CurrentValue = $mst_vendor->pic->FormValue;
		$mst_vendor->phone->CurrentValue = $mst_vendor->phone->FormValue;
		$mst_vendor->fax->CurrentValue = $mst_vendor->fax->FormValue;
		$mst_vendor->zemail->CurrentValue = $mst_vendor->zemail->FormValue;
		$mst_vendor->peruntukan->CurrentValue = $mst_vendor->peruntukan->FormValue;
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

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $mst_vendor;

		// Call Row_Rendering event
		$mst_vendor->Row_Rendering();

		// Common render codes for all row types
		// kode

		$mst_vendor->kode->CellCssStyle = "";
		$mst_vendor->kode->CellCssClass = "";

		// nama
		$mst_vendor->nama->CellCssStyle = "";
		$mst_vendor->nama->CellCssClass = "";

		// alamat
		$mst_vendor->alamat->CellCssStyle = "";
		$mst_vendor->alamat->CellCssClass = "";

		// alamatpajak
		$mst_vendor->alamatpajak->CellCssStyle = "";
		$mst_vendor->alamatpajak->CellCssClass = "";

		// npwp
		$mst_vendor->npwp->CellCssStyle = "";
		$mst_vendor->npwp->CellCssClass = "";

		// pic
		$mst_vendor->pic->CellCssStyle = "";
		$mst_vendor->pic->CellCssClass = "";

		// phone
		$mst_vendor->phone->CellCssStyle = "";
		$mst_vendor->phone->CellCssClass = "";

		// fax
		$mst_vendor->fax->CellCssStyle = "";
		$mst_vendor->fax->CellCssClass = "";

		// email
		$mst_vendor->zemail->CellCssStyle = "";
		$mst_vendor->zemail->CellCssClass = "";

		// peruntukan
		$mst_vendor->peruntukan->CellCssStyle = "";
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

			// alamat
			$mst_vendor->alamat->ViewValue = $mst_vendor->alamat->CurrentValue;
			$mst_vendor->alamat->CssStyle = "";
			$mst_vendor->alamat->CssClass = "";
			$mst_vendor->alamat->ViewCustomAttributes = "";

			// alamatpajak
			$mst_vendor->alamatpajak->ViewValue = $mst_vendor->alamatpajak->CurrentValue;
			$mst_vendor->alamatpajak->CssStyle = "";
			$mst_vendor->alamatpajak->CssClass = "";
			$mst_vendor->alamatpajak->ViewCustomAttributes = "";

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

			// alamat
			$mst_vendor->alamat->HrefValue = "";

			// alamatpajak
			$mst_vendor->alamatpajak->HrefValue = "";

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
		} elseif ($mst_vendor->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// kode
			$mst_vendor->kode->EditCustomAttributes = "";
			$mst_vendor->kode->EditValue = $mst_vendor->kode->CurrentValue;
			$mst_vendor->kode->CssStyle = "";
			$mst_vendor->kode->CssClass = "";
			$mst_vendor->kode->ViewCustomAttributes = "";

			// nama
			$mst_vendor->nama->EditCustomAttributes = "";
			$mst_vendor->nama->EditValue = ew_HtmlEncode($mst_vendor->nama->CurrentValue);

			// alamat
			$mst_vendor->alamat->EditCustomAttributes = "";
			$mst_vendor->alamat->EditValue = ew_HtmlEncode($mst_vendor->alamat->CurrentValue);

			// alamatpajak
			$mst_vendor->alamatpajak->EditCustomAttributes = "";
			$mst_vendor->alamatpajak->EditValue = ew_HtmlEncode($mst_vendor->alamatpajak->CurrentValue);

			// npwp
			$mst_vendor->npwp->EditCustomAttributes = "";
			$mst_vendor->npwp->EditValue = ew_HtmlEncode($mst_vendor->npwp->CurrentValue);

			// pic
			$mst_vendor->pic->EditCustomAttributes = "";
			$mst_vendor->pic->EditValue = ew_HtmlEncode($mst_vendor->pic->CurrentValue);

			// phone
			$mst_vendor->phone->EditCustomAttributes = "";
			$mst_vendor->phone->EditValue = ew_HtmlEncode($mst_vendor->phone->CurrentValue);

			// fax
			$mst_vendor->fax->EditCustomAttributes = "";
			$mst_vendor->fax->EditValue = ew_HtmlEncode($mst_vendor->fax->CurrentValue);

			// email
			$mst_vendor->zemail->EditCustomAttributes = "";
			$mst_vendor->zemail->EditValue = ew_HtmlEncode($mst_vendor->zemail->CurrentValue);

			// peruntukan
			$mst_vendor->peruntukan->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("unit", "Unit");
			$arwrk[] = array("part", "Part");
			$arwrk[] = array("material", "Material");
			array_unshift($arwrk, array("", "Please Select"));
			$mst_vendor->peruntukan->EditValue = $arwrk;

			// Edit refer script
			// kode

			$mst_vendor->kode->HrefValue = "";

			// nama
			$mst_vendor->nama->HrefValue = "";

			// alamat
			$mst_vendor->alamat->HrefValue = "";

			// alamatpajak
			$mst_vendor->alamatpajak->HrefValue = "";

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

	// Validate form
	function ValidateForm() {
		global $gsFormError, $mst_vendor;

		// Initialize
		$gsFormError = "";
		$lUpdateCnt = 0;
		if ($mst_vendor->kode->MultiUpdate == "1") $lUpdateCnt++;
		if ($mst_vendor->nama->MultiUpdate == "1") $lUpdateCnt++;
		if ($mst_vendor->alamat->MultiUpdate == "1") $lUpdateCnt++;
		if ($mst_vendor->alamatpajak->MultiUpdate == "1") $lUpdateCnt++;
		if ($mst_vendor->npwp->MultiUpdate == "1") $lUpdateCnt++;
		if ($mst_vendor->pic->MultiUpdate == "1") $lUpdateCnt++;
		if ($mst_vendor->phone->MultiUpdate == "1") $lUpdateCnt++;
		if ($mst_vendor->fax->MultiUpdate == "1") $lUpdateCnt++;
		if ($mst_vendor->zemail->MultiUpdate == "1") $lUpdateCnt++;
		if ($mst_vendor->peruntukan->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = "No field selected for update";
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($mst_vendor->nama->MultiUpdate <> "" && $mst_vendor->nama->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Nama";
		}
		if ($mst_vendor->alamat->MultiUpdate <> "" && $mst_vendor->alamat->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Alamat";
		}
		if ($mst_vendor->alamatpajak->MultiUpdate <> "" && $mst_vendor->alamatpajak->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Alamat Pajak";
		}
		if ($mst_vendor->npwp->MultiUpdate <> "" && $mst_vendor->npwp->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - NPWP";
		}
		if ($mst_vendor->pic->MultiUpdate <> "" && $mst_vendor->pic->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - PIC";
		}
		if ($mst_vendor->phone->MultiUpdate <> "" && $mst_vendor->phone->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Phone";
		}
		if ($mst_vendor->fax->MultiUpdate <> "" && $mst_vendor->fax->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Fax";
		}
		if ($mst_vendor->zemail->MultiUpdate <> "" && $mst_vendor->zemail->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - E Mail";
		}
		if ($mst_vendor->peruntukan->MultiUpdate <> "" && $mst_vendor->peruntukan->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Peruntukan";
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $mst_vendor;
		$sFilter = $mst_vendor->KeyFilter();
		$mst_vendor->CurrentFilter = $sFilter;
		$sSql = $mst_vendor->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// Field kode
						if ($mst_vendor->kode->MultiUpdate == "1") {
}

			// Field nama
						if ($mst_vendor->nama->MultiUpdate == "1") {
			$mst_vendor->nama->SetDbValueDef($mst_vendor->nama->CurrentValue, "");
			$rsnew['nama'] =& $mst_vendor->nama->DbValue;
			}

			// Field alamat
						if ($mst_vendor->alamat->MultiUpdate == "1") {
			$mst_vendor->alamat->SetDbValueDef($mst_vendor->alamat->CurrentValue, "");
			$rsnew['alamat'] =& $mst_vendor->alamat->DbValue;
			}

			// Field alamatpajak
						if ($mst_vendor->alamatpajak->MultiUpdate == "1") {
			$mst_vendor->alamatpajak->SetDbValueDef($mst_vendor->alamatpajak->CurrentValue, "");
			$rsnew['alamatpajak'] =& $mst_vendor->alamatpajak->DbValue;
			}

			// Field npwp
						if ($mst_vendor->npwp->MultiUpdate == "1") {
			$mst_vendor->npwp->SetDbValueDef($mst_vendor->npwp->CurrentValue, "");
			$rsnew['npwp'] =& $mst_vendor->npwp->DbValue;
			}

			// Field pic
						if ($mst_vendor->pic->MultiUpdate == "1") {
			$mst_vendor->pic->SetDbValueDef($mst_vendor->pic->CurrentValue, "");
			$rsnew['pic'] =& $mst_vendor->pic->DbValue;
			}

			// Field phone
						if ($mst_vendor->phone->MultiUpdate == "1") {
			$mst_vendor->phone->SetDbValueDef($mst_vendor->phone->CurrentValue, "");
			$rsnew['phone'] =& $mst_vendor->phone->DbValue;
			}

			// Field fax
						if ($mst_vendor->fax->MultiUpdate == "1") {
			$mst_vendor->fax->SetDbValueDef($mst_vendor->fax->CurrentValue, "");
			$rsnew['fax'] =& $mst_vendor->fax->DbValue;
			}

			// Field email
						if ($mst_vendor->zemail->MultiUpdate == "1") {
			$mst_vendor->zemail->SetDbValueDef($mst_vendor->zemail->CurrentValue, "");
			$rsnew['email'] =& $mst_vendor->zemail->DbValue;
			}

			// Field peruntukan
						if ($mst_vendor->peruntukan->MultiUpdate == "1") {
			$mst_vendor->peruntukan->SetDbValueDef($mst_vendor->peruntukan->CurrentValue, "");
			$rsnew['peruntukan'] =& $mst_vendor->peruntukan->DbValue;
			}

			// Call Row Updating event
			$bUpdateRow = $mst_vendor->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($mst_vendor->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($mst_vendor->CancelMessage <> "") {
					$this->setMessage($mst_vendor->CancelMessage);
					$mst_vendor->CancelMessage = "";
				} else {
					$this->setMessage("Update cancelled");
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$mst_vendor->Row_Updated($rsold, $rsnew);
		if ($EditRow) {
			$this->WriteAuditTrailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
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

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $mst_vendor;
		$table = 'mst_vendor';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rsold['kode'];

		// Write Audit Trail
		$filePfx = "log";
		$curDate = date("Y/m/d");
		$curTime = date("H:i:s");
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		$action = "U";
		foreach (array_keys($rsnew) as $fldname) {
			if ($mst_vendor->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore Blob Field
				if ($mst_vendor->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime Field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($mst_vendor->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo Field
						$oldvalue = "<MEMO>";
						$newvalue = "<MEMO>";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					ew_WriteAuditTrail($filePfx, $curDate, $curTime, $id, $curUser, $action, $table, $fldname, $key, $oldvalue, $newvalue);
				}
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
