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
$mst_vendor_add = new cmst_vendor_add();
$Page =& $mst_vendor_add;

// Page init processing
$mst_vendor_add->Page_Init();

// Page main processing
$mst_vendor_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mst_vendor_add = new ew_Page("mst_vendor_add");

// page properties
mst_vendor_add.PageID = "add"; // page ID
var EW_PAGE_ID = mst_vendor_add.PageID; // for backward compatibility

// extend page with ValidateForm function
mst_vendor_add.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_kode"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Kode");
		elm = fobj.elements["x" + infix + "_nama"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Nama");
		elm = fobj.elements["x" + infix + "_alamat"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Alamat");
		elm = fobj.elements["x" + infix + "_alamatpajak"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Alamat Pajak");
		elm = fobj.elements["x" + infix + "_npwp"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - NPWP");
		elm = fobj.elements["x" + infix + "_pic"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - PIC");
		elm = fobj.elements["x" + infix + "_phone"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Phone");
		elm = fobj.elements["x" + infix + "_fax"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Fax");
		elm = fobj.elements["x" + infix + "_zemail"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - E Mail");
		// elm = fobj.elements["x" + infix + "_peruntukan"];
		// if (elm && !ew_HasValue(elm))
			// return ew_OnError(this, elm, "Please enter required field - Peruntukan");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
mst_vendor_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
mst_vendor_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_vendor_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_vendor_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
mst_vendor_add.ShowHighlightText = "Show highlight"; 
mst_vendor_add.HideHighlightText = "Hide highlight";

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><!-- Add to --><h3><b>Master Supplier</b></h3><br><br>
<!--a href="<?php echo $mst_vendor->getReturnUrl() ?>">Go Back</a-->
<input type="button" value="Kembali" onclick="window.location='<?php echo $mst_vendor->getReturnUrl() ?>';">
</span></p>
<?php $mst_vendor_add->ShowMessage() ?>
<form name="fmst_vendoradd" id="fmst_vendoradd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return mst_vendor_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="mst_vendor">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($mst_vendor->kode->Visible) { // kode ?>
	<tr<?php echo $mst_vendor->kode->RowAttributes ?>>
		<td class="ewTableHeader">Kode<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_vendor->kode->CellAttributes() ?>><span id="el_kode">
<input type="text" name="x_kode" id="x_kode" size="10" maxlength="10" value="<?php echo $mst_vendor->kode->EditValue ?>"<?php echo $mst_vendor->kode->EditAttributes() ?>>
</span><?php echo $mst_vendor->kode->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_vendor->nama->Visible) { // nama ?>
	<tr<?php echo $mst_vendor->nama->RowAttributes ?>>
		<td class="ewTableHeader">Nama<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_vendor->nama->CellAttributes() ?>><span id="el_nama">
<input type="text" name="x_nama" id="x_nama" size="30" maxlength="100" value="<?php echo $mst_vendor->nama->EditValue ?>"<?php echo $mst_vendor->nama->EditAttributes() ?>>
</span><?php echo $mst_vendor->nama->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_vendor->alamat->Visible) { // alamat ?>
	<tr<?php echo $mst_vendor->alamat->RowAttributes ?>>
		<td class="ewTableHeader">Alamat<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_vendor->alamat->CellAttributes() ?>><span id="el_alamat">
<input type="text" name="x_alamat" id="x_alamat" size="30" maxlength="255" value="<?php echo $mst_vendor->alamat->EditValue ?>"<?php echo $mst_vendor->alamat->EditAttributes() ?>>
</span><?php echo $mst_vendor->alamat->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_vendor->alamatpajak->Visible) { // alamatpajak ?>
	<tr<?php echo $mst_vendor->alamatpajak->RowAttributes ?>>
		<td class="ewTableHeader">Alamat Pajak<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_vendor->alamatpajak->CellAttributes() ?>><span id="el_alamatpajak">
<input type="text" name="x_alamatpajak" id="x_alamatpajak" size="30" maxlength="255" value="<?php echo $mst_vendor->alamatpajak->EditValue ?>"<?php echo $mst_vendor->alamatpajak->EditAttributes() ?>>
</span><?php echo $mst_vendor->alamatpajak->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_vendor->npwp->Visible) { // npwp ?>
	<tr<?php echo $mst_vendor->npwp->RowAttributes ?>>
		<td class="ewTableHeader">NPWP<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_vendor->npwp->CellAttributes() ?>><span id="el_npwp">
<input type="text" name="x_npwp" id="x_npwp" size="30" maxlength="100" value="<?php echo $mst_vendor->npwp->EditValue ?>"<?php echo $mst_vendor->npwp->EditAttributes() ?>>
</span><?php echo $mst_vendor->npwp->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_vendor->pic->Visible) { // pic ?>
	<tr<?php echo $mst_vendor->pic->RowAttributes ?>>
		<td class="ewTableHeader">PIC<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_vendor->pic->CellAttributes() ?>><span id="el_pic">
<input type="text" name="x_pic" id="x_pic" size="30" maxlength="100" value="<?php echo $mst_vendor->pic->EditValue ?>"<?php echo $mst_vendor->pic->EditAttributes() ?>>
</span><?php echo $mst_vendor->pic->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_vendor->phone->Visible) { // phone ?>
	<tr<?php echo $mst_vendor->phone->RowAttributes ?>>
		<td class="ewTableHeader">Phone<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_vendor->phone->CellAttributes() ?>><span id="el_phone">
<input type="text" name="x_phone" id="x_phone" size="30" maxlength="30" value="<?php echo $mst_vendor->phone->EditValue ?>"<?php echo $mst_vendor->phone->EditAttributes() ?>>
</span><?php echo $mst_vendor->phone->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_vendor->fax->Visible) { // fax ?>
	<tr<?php echo $mst_vendor->fax->RowAttributes ?>>
		<td class="ewTableHeader">Fax<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_vendor->fax->CellAttributes() ?>><span id="el_fax">
<input type="text" name="x_fax" id="x_fax" size="30" maxlength="30" value="<?php echo $mst_vendor->fax->EditValue ?>"<?php echo $mst_vendor->fax->EditAttributes() ?>>
</span><?php echo $mst_vendor->fax->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_vendor->zemail->Visible) { // email ?>
	<tr<?php echo $mst_vendor->zemail->RowAttributes ?>>
		<td class="ewTableHeader">E Mail<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_vendor->zemail->CellAttributes() ?>><span id="el_zemail">
<input type="text" name="x_zemail" id="x_zemail" size="30" maxlength="255" value="<?php echo $mst_vendor->zemail->EditValue ?>"<?php echo $mst_vendor->zemail->EditAttributes() ?>>
</span><?php echo $mst_vendor->zemail->CustomMsg ?></td>
	</tr>
<?php } ?>
<!--
<?php if ($mst_vendor->peruntukan->Visible) { // peruntukan ?>
	<tr<?php echo $mst_vendor->peruntukan->RowAttributes ?>>
		<td class="ewTableHeader">Peruntukan<span class="ewRequired">&nbsp;*</span></td>
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
<!--input type="submit" name="btnAction" id="btnAction" value="    Add    " /-->
<input type="submit" name="btnAction" id="btnAction" value="    Simpan    ">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$mst_vendor_add->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_vendor_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'mst_vendor';

	// Page Object Name
	var $PageObjName = 'mst_vendor_add';

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
	function cmst_vendor_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_vendor"] = new cmst_vendor();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $x_ewPriv = 0;

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $mst_vendor;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["kode"] != "") {
		  $mst_vendor->kode->setQueryStringValue($_GET["kode"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $mst_vendor->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$mst_vendor->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $mst_vendor->CurrentAction = "C"; // Copy Record
		  } else {
		    $mst_vendor->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($mst_vendor->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No records found"); // No record found
		      $this->Page_Terminate("mst_vendorlist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$mst_vendor->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Add succeeded"); // Set up success message
					$sReturnUrl = $mst_vendor->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "mst_vendorview.php")
						$sReturnUrl = $mst_vendor->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$mst_vendor->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $mst_vendor;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $mst_vendor;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $mst_vendor;
		$mst_vendor->kode->setFormValue($objForm->GetValue("x_kode"));
		$mst_vendor->nama->setFormValue($objForm->GetValue("x_nama"));
		$mst_vendor->alamat->setFormValue($objForm->GetValue("x_alamat"));
		$mst_vendor->alamatpajak->setFormValue($objForm->GetValue("x_alamatpajak"));
		$mst_vendor->npwp->setFormValue($objForm->GetValue("x_npwp"));
		$mst_vendor->pic->setFormValue($objForm->GetValue("x_pic"));
		$mst_vendor->phone->setFormValue($objForm->GetValue("x_phone"));
		$mst_vendor->fax->setFormValue($objForm->GetValue("x_fax"));
		$mst_vendor->zemail->setFormValue($objForm->GetValue("x_zemail"));
		$mst_vendor->peruntukan->setFormValue($objForm->GetValue("x_peruntukan"));
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
		} elseif ($mst_vendor->RowType == EW_ROWTYPE_ADD) { // Add row

			// kode
			$mst_vendor->kode->EditCustomAttributes = "";
			$mst_vendor->kode->EditValue = ew_HtmlEncode($mst_vendor->kode->CurrentValue);

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
		}

		// Call Row Rendered event
		$mst_vendor->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $mst_vendor;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($mst_vendor->kode->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Kode";
		}
		if ($mst_vendor->nama->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Nama";
		}
		if ($mst_vendor->alamat->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Alamat";
		}
		if ($mst_vendor->alamatpajak->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Alamat Pajak";
		}
		if ($mst_vendor->npwp->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - NPWP";
		}
		if ($mst_vendor->pic->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - PIC";
		}
		if ($mst_vendor->phone->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Phone";
		}
		if ($mst_vendor->fax->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Fax";
		}
		if ($mst_vendor->zemail->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - E Mail";
		}
		if ($mst_vendor->peruntukan->FormValue == "") {
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

	// Add record
	function AddRow() {
		global $conn, $Security, $mst_vendor;

		// Check if key value entered
		if ($mst_vendor->kode->CurrentValue == "") {
			$this->setMessage("Invalid key value");
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $mst_vendor->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $mst_vendor->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, "Duplicate primary key: '%f'");
				$this->setMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// Field kode
		$mst_vendor->kode->SetDbValueDef($mst_vendor->kode->CurrentValue, "");
		$rsnew['kode'] =& $mst_vendor->kode->DbValue;

		// Field nama
		$mst_vendor->nama->SetDbValueDef($mst_vendor->nama->CurrentValue, "");
		$rsnew['nama'] =& $mst_vendor->nama->DbValue;

		// Field alamat
		$mst_vendor->alamat->SetDbValueDef($mst_vendor->alamat->CurrentValue, "");
		$rsnew['alamat'] =& $mst_vendor->alamat->DbValue;

		// Field alamatpajak
		$mst_vendor->alamatpajak->SetDbValueDef($mst_vendor->alamatpajak->CurrentValue, "");
		$rsnew['alamatpajak'] =& $mst_vendor->alamatpajak->DbValue;

		// Field npwp
		$mst_vendor->npwp->SetDbValueDef($mst_vendor->npwp->CurrentValue, "");
		$rsnew['npwp'] =& $mst_vendor->npwp->DbValue;

		// Field pic
		$mst_vendor->pic->SetDbValueDef($mst_vendor->pic->CurrentValue, "");
		$rsnew['pic'] =& $mst_vendor->pic->DbValue;

		// Field phone
		$mst_vendor->phone->SetDbValueDef($mst_vendor->phone->CurrentValue, "");
		$rsnew['phone'] =& $mst_vendor->phone->DbValue;

		// Field fax
		$mst_vendor->fax->SetDbValueDef($mst_vendor->fax->CurrentValue, "");
		$rsnew['fax'] =& $mst_vendor->fax->DbValue;

		// Field email
		$mst_vendor->zemail->SetDbValueDef($mst_vendor->zemail->CurrentValue, "");
		$rsnew['email'] =& $mst_vendor->zemail->DbValue;

		// Field peruntukan
		$mst_vendor->peruntukan->SetDbValueDef($mst_vendor->peruntukan->CurrentValue, "");
		$rsnew['peruntukan'] =& $mst_vendor->peruntukan->DbValue;

		// Call Row Inserting event
		$bInsertRow = $mst_vendor->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($mst_vendor->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($mst_vendor->CancelMessage <> "") {
				$this->setMessage($mst_vendor->CancelMessage);
				$mst_vendor->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$mst_vendor->Row_Inserted($rsnew);
			$this->WriteAuditTrailOnAdd($rsnew);
		}
		return $AddRow;
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

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $mst_vendor;
		$table = 'mst_vendor';

		// Get key value
		$key = "";
		if ($key <> "") $key .= EW_COMPOSITE_KEY_SEPARATOR;
		$key .= $rs['kode'];

		// Write Audit Trail
		$filePfx = "log";
		$curDate = date("Y/m/d");
		$curTime = date("H:i:s");
		$id = ew_ScriptName();
	  $curUser = CurrentUserName();
		$action = "A";
		$oldvalue = "";
		foreach (array_keys($rs) as $fldname) {
			if ($mst_vendor->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore Blob Field
				$newvalue = ($mst_vendor->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) ? "<MEMO>" : $rs[$fldname]; // Memo Field
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
