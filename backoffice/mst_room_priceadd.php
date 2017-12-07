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
$mst_room_price_add = new cmst_room_price_add();
$Page =& $mst_room_price_add;

// Page init processing
$mst_room_price_add->Page_Init();

// Page main processing
$mst_room_price_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var mst_room_price_add = new ew_Page("mst_room_price_add");

// page properties
mst_room_price_add.PageID = "add"; // page ID
var EW_PAGE_ID = mst_room_price_add.PageID; // for backward compatibility

// extend page with ValidateForm function
mst_room_price_add.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_tanggal1"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - Start Date");
		elm = fobj.elements["x" + infix + "_tanggal2"];
		if (elm && !ew_CheckEuroDate(elm.value))
			return ew_OnError(this, elm, "Incorrect date, format = dd/mm/yyyy - End Date");
		elm = fobj.elements["x" + infix + "_description"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, "Please enter required field - Description");
		elm = fobj.elements["x" + infix + "_baseprice"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Incorrect floating point number - Base Price");
		elm = fobj.elements["x" + infix + "_tax"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Incorrect floating point number - Tax (%)");
		elm = fobj.elements["x" + infix + "_service"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Incorrect floating point number - Service (%)");
		elm = fobj.elements["x" + infix + "_aftertaxservice"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "Incorrect floating point number - After Tax&Service");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
mst_room_price_add.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
mst_room_price_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
mst_room_price_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-1.css" title="win2k-1">
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><!-- Add to --><h3><b>Master Room Price</b></h3><br><br>
<!--a href="<?php echo $mst_room_price->getReturnUrl() ?>">Go Back</a-->
<input type="button" value="Kembali" onclick="window.location='<?php echo $mst_room_price->getReturnUrl() ?>';">
</span></p>
<?php $mst_room_price_add->ShowMessage() ?>
<form name="fmst_room_priceadd" id="fmst_room_priceadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return mst_room_price_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="mst_room_price">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($mst_room_price->tanggal1->Visible) { // tanggal1 ?>
	<tr<?php echo $mst_room_price->tanggal1->RowAttributes ?>>
		<td class="ewTableHeader">Start Date<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_room_price->tanggal1->CellAttributes() ?>><span id="el_tanggal1">
<input type="text" name="x_tanggal1" id="x_tanggal1" value="<?php echo $mst_room_price->tanggal1->EditValue ?>"<?php echo $mst_room_price->tanggal1->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_tanggal1" name="cal_x_tanggal1" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_tanggal1", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_tanggal1" // ID of the button
});
</script>
</span><?php echo $mst_room_price->tanggal1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_room_price->tanggal2->Visible) { // tanggal2 ?>
	<tr<?php echo $mst_room_price->tanggal2->RowAttributes ?>>
		<td class="ewTableHeader">End Date<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_room_price->tanggal2->CellAttributes() ?>><span id="el_tanggal2">
<input type="text" name="x_tanggal2" id="x_tanggal2" value="<?php echo $mst_room_price->tanggal2->EditValue ?>"<?php echo $mst_room_price->tanggal2->EditAttributes() ?>>
&nbsp;<img src="images/calendar.png" id="cal_x_tanggal2" name="cal_x_tanggal2" alt="Pick a date" style="cursor:pointer;cursor:hand;">
<script type="text/javascript">
Calendar.setup({
	inputField : "x_tanggal2", // ID of the input field
	ifFormat : "%d/%m/%Y", // the date format
	button : "cal_x_tanggal2" // ID of the button
});
</script>
</span><?php echo $mst_room_price->tanggal2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_room_price->room->Visible) { // room ?>
	<tr<?php echo $mst_room_price->room->RowAttributes ?>>
		<td class="ewTableHeader">Room<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_room_price->room->CellAttributes() ?>><span id="el_room">
<select id="x_room" name="x_room"<?php echo $mst_room_price->room->EditAttributes() ?>>
<?php
if (is_array($mst_room_price->room->EditValue)) {
	$arwrk = $mst_room_price->room->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_room_price->room->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $mst_room_price->room->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_room_price->roomtype->Visible) { // roomtype ?>
	<tr<?php echo $mst_room_price->roomtype->RowAttributes ?>>
		<td class="ewTableHeader">Room Type<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_room_price->roomtype->CellAttributes() ?>><span id="el_roomtype">
<select id="x_roomtype" name="x_roomtype"<?php echo $mst_room_price->roomtype->EditAttributes() ?>>
<?php
if (is_array($mst_room_price->roomtype->EditValue)) {
	$arwrk = $mst_room_price->roomtype->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($mst_room_price->roomtype->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $mst_room_price->roomtype->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_room_price->description->Visible) { // description ?>
	<tr<?php echo $mst_room_price->description->RowAttributes ?>>
		<td class="ewTableHeader">Description<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_room_price->description->CellAttributes() ?>><span id="el_description">
<input type="text" name="x_description" id="x_description" size="30" maxlength="50" value="<?php echo $mst_room_price->description->EditValue ?>"<?php echo $mst_room_price->description->EditAttributes() ?>>
</span><?php echo $mst_room_price->description->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_room_price->baseprice->Visible) { // baseprice ?>
	<tr<?php echo $mst_room_price->baseprice->RowAttributes ?>>
		<td class="ewTableHeader">Base Price<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_room_price->baseprice->CellAttributes() ?>><span id="el_baseprice">
<input type="text" name="x_baseprice" id="x_baseprice" size="12" value="<?php echo $mst_room_price->baseprice->EditValue ?>"<?php echo $mst_room_price->baseprice->EditAttributes() ?>>
</span><?php echo $mst_room_price->baseprice->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_room_price->tax->Visible) { // tax ?>
	<tr<?php echo $mst_room_price->tax->RowAttributes ?>>
		<td class="ewTableHeader">Tax (%)<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_room_price->tax->CellAttributes() ?>><span id="el_tax">
<input type="text" name="x_tax" id="x_tax" size="12" value="<?php echo $mst_room_price->tax->EditValue ?>"<?php echo $mst_room_price->tax->EditAttributes() ?>>
</span><?php echo $mst_room_price->tax->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_room_price->service->Visible) { // service ?>
	<tr<?php echo $mst_room_price->service->RowAttributes ?>>
		<td class="ewTableHeader">Service (%)<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_room_price->service->CellAttributes() ?>><span id="el_service">
<input type="text" name="x_service" id="x_service" size="12" value="<?php echo $mst_room_price->service->EditValue ?>"<?php echo $mst_room_price->service->EditAttributes() ?>>
</span><?php echo $mst_room_price->service->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($mst_room_price->aftertaxservice->Visible) { // aftertaxservice ?>
	<tr<?php echo $mst_room_price->aftertaxservice->RowAttributes ?>>
		<td class="ewTableHeader">After Tax&Service<span class="ewRequired">&nbsp;*</span></td>
		<td<?php echo $mst_room_price->aftertaxservice->CellAttributes() ?>><span id="el_aftertaxservice">
<input type="text" name="x_aftertaxservice" id="x_aftertaxservice" size="12" value="<?php echo $mst_room_price->aftertaxservice->EditValue ?>"<?php echo $mst_room_price->aftertaxservice->EditAttributes() ?>>
</span><?php echo $mst_room_price->aftertaxservice->CustomMsg ?></td>
	</tr>
<?php } ?>
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
$mst_room_price_add->Page_Terminate();
?>
<?php

//
// Page Class
//
class cmst_room_price_add {

	// Page ID
	var $PageID = 'add';

	// Table Name
	var $TableName = 'mst_room_price';

	// Page Object Name
	var $PageObjName = 'mst_room_price_add';

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
	function cmst_room_price_add() {
		global $conn;

		// Initialize table object
		$GLOBALS["mst_room_price"] = new cmst_room_price();

		// Intialize page id (for backward compatibility)
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $x_ewPriv = 0;

	// 
	// Page main processing
	//
	function Page_Main() {
		global $objForm, $gsFormError, $mst_room_price;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $mst_room_price->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Create form object
		$objForm = new cFormObj();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $mst_room_price->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate Form
			if (!$this->ValidateForm()) {
				$mst_room_price->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $mst_room_price->CurrentAction = "C"; // Copy Record
		  } else {
		    $mst_room_price->CurrentAction = "I"; // Display Blank Record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($mst_room_price->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage("No records found"); // No record found
		      $this->Page_Terminate("mst_room_pricelist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$mst_room_price->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage("Add succeeded"); // Set up success message
					$sReturnUrl = $mst_room_price->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$mst_room_price->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $mst_room_price;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $mst_room_price;
		$mst_room_price->createby->CurrentValue = $_SESSION["username"];
		$mst_room_price->createdate->CurrentValue = ew_CurrentDateTime();
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $mst_room_price;
		$mst_room_price->tanggal1->setFormValue($objForm->GetValue("x_tanggal1"));
		$mst_room_price->tanggal1->CurrentValue = ew_UnFormatDateTime($mst_room_price->tanggal1->CurrentValue, 7);
		$mst_room_price->tanggal2->setFormValue($objForm->GetValue("x_tanggal2"));
		$mst_room_price->tanggal2->CurrentValue = ew_UnFormatDateTime($mst_room_price->tanggal2->CurrentValue, 7);
		$mst_room_price->room->setFormValue($objForm->GetValue("x_room"));
		$mst_room_price->roomtype->setFormValue($objForm->GetValue("x_roomtype"));
		$mst_room_price->description->setFormValue($objForm->GetValue("x_description"));
		$mst_room_price->baseprice->setFormValue($objForm->GetValue("x_baseprice"));
		$mst_room_price->tax->setFormValue($objForm->GetValue("x_tax"));
		$mst_room_price->service->setFormValue($objForm->GetValue("x_service"));
		$mst_room_price->aftertaxservice->setFormValue($objForm->GetValue("x_aftertaxservice"));
		$mst_room_price->createby->setFormValue($objForm->GetValue("x_createby"));
		$mst_room_price->createdate->setFormValue($objForm->GetValue("x_createdate"));
		$mst_room_price->createdate->CurrentValue = ew_UnFormatDateTime($mst_room_price->createdate->CurrentValue, 7);
		$mst_room_price->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $mst_room_price;
		$mst_room_price->id->CurrentValue = $mst_room_price->id->FormValue;
		$mst_room_price->tanggal1->CurrentValue = $mst_room_price->tanggal1->FormValue;
		$mst_room_price->tanggal1->CurrentValue = ew_UnFormatDateTime($mst_room_price->tanggal1->CurrentValue, 7);
		$mst_room_price->tanggal2->CurrentValue = $mst_room_price->tanggal2->FormValue;
		$mst_room_price->tanggal2->CurrentValue = ew_UnFormatDateTime($mst_room_price->tanggal2->CurrentValue, 7);
		$mst_room_price->room->CurrentValue = $mst_room_price->room->FormValue;
		$mst_room_price->roomtype->CurrentValue = $mst_room_price->roomtype->FormValue;
		$mst_room_price->description->CurrentValue = $mst_room_price->description->FormValue;
		$mst_room_price->baseprice->CurrentValue = $mst_room_price->baseprice->FormValue;
		$mst_room_price->tax->CurrentValue = $mst_room_price->tax->FormValue;
		$mst_room_price->service->CurrentValue = $mst_room_price->service->FormValue;
		$mst_room_price->aftertaxservice->CurrentValue = $mst_room_price->aftertaxservice->FormValue;
		$mst_room_price->createby->CurrentValue = $mst_room_price->createby->FormValue;
		$mst_room_price->createdate->CurrentValue = $mst_room_price->createdate->FormValue;
		$mst_room_price->createdate->CurrentValue = ew_UnFormatDateTime($mst_room_price->createdate->CurrentValue, 7);
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
		// tanggal1

		$mst_room_price->tanggal1->CellCssStyle = "";
		$mst_room_price->tanggal1->CellCssClass = "";

		// tanggal2
		$mst_room_price->tanggal2->CellCssStyle = "";
		$mst_room_price->tanggal2->CellCssClass = "";

		// room
		$mst_room_price->room->CellCssStyle = "";
		$mst_room_price->room->CellCssClass = "";

		// roomtype
		$mst_room_price->roomtype->CellCssStyle = "";
		$mst_room_price->roomtype->CellCssClass = "";

		// description
		$mst_room_price->description->CellCssStyle = "";
		$mst_room_price->description->CellCssClass = "";

		// baseprice
		$mst_room_price->baseprice->CellCssStyle = "";
		$mst_room_price->baseprice->CellCssClass = "";

		// tax
		$mst_room_price->tax->CellCssStyle = "";
		$mst_room_price->tax->CellCssClass = "";

		// service
		$mst_room_price->service->CellCssStyle = "";
		$mst_room_price->service->CellCssClass = "";

		// aftertaxservice
		$mst_room_price->aftertaxservice->CellCssStyle = "";
		$mst_room_price->aftertaxservice->CellCssClass = "";

		// createby
		$mst_room_price->createby->CellCssStyle = "";
		$mst_room_price->createby->CellCssClass = "";

		// createdate
		$mst_room_price->createdate->CellCssStyle = "";
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
		} elseif ($mst_room_price->RowType == EW_ROWTYPE_ADD) { // Add row

			// tanggal1
			$mst_room_price->tanggal1->EditCustomAttributes = "";
			$mst_room_price->tanggal1->EditValue = ew_HtmlEncode(ew_FormatDateTime($mst_room_price->tanggal1->CurrentValue, 7));

			// tanggal2
			$mst_room_price->tanggal2->EditCustomAttributes = "";
			$mst_room_price->tanggal2->EditValue = ew_HtmlEncode(ew_FormatDateTime($mst_room_price->tanggal2->CurrentValue, 7));

			// room
			$mst_room_price->room->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `kode`, `nama`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_room`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$mst_room_price->room->EditValue = $arwrk;

			// roomtype
			$mst_room_price->roomtype->EditCustomAttributes = "";
			$sSqlWrk = "SELECT `id`, `description`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `mst_room_type`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE $sWhereWrk";
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", "Please Select"));
			$mst_room_price->roomtype->EditValue = $arwrk;

			// description
			$mst_room_price->description->EditCustomAttributes = "";
			$mst_room_price->description->EditValue = ew_HtmlEncode($mst_room_price->description->CurrentValue);

			// baseprice
			$mst_room_price->baseprice->EditCustomAttributes = "";
			$mst_room_price->baseprice->EditValue = ew_HtmlEncode($mst_room_price->baseprice->CurrentValue);

			// tax
			$mst_room_price->tax->EditCustomAttributes = "";
			$mst_room_price->tax->EditValue = ew_HtmlEncode($mst_room_price->tax->CurrentValue);

			// service
			$mst_room_price->service->EditCustomAttributes = "";
			$mst_room_price->service->EditValue = ew_HtmlEncode($mst_room_price->service->CurrentValue);

			// aftertaxservice
			$mst_room_price->aftertaxservice->EditCustomAttributes = "";
			$mst_room_price->aftertaxservice->EditValue = ew_HtmlEncode($mst_room_price->aftertaxservice->CurrentValue);

			// createby
			// createdate

		}

		// Call Row Rendered event
		$mst_room_price->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $gsFormError, $mst_room_price;

		// Initialize
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckEuroDate($mst_room_price->tanggal1->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect date, format = dd/mm/yyyy - Start Date";
		}
		if (!ew_CheckEuroDate($mst_room_price->tanggal2->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect date, format = dd/mm/yyyy - End Date";
		}
		if ($mst_room_price->description->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= "Please enter required field - Description";
		}
		if (!ew_CheckNumber($mst_room_price->baseprice->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect floating point number - Base Price";
		}
		if (!ew_CheckNumber($mst_room_price->tax->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect floating point number - Tax (%)";
		}
		if (!ew_CheckNumber($mst_room_price->service->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect floating point number - Service (%)";
		}
		if (!ew_CheckNumber($mst_room_price->aftertaxservice->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= "Incorrect floating point number - After Tax&Service";
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
		global $conn, $Security, $mst_room_price;
		$rsnew = array();

		// Field tanggal1
		$mst_room_price->tanggal1->SetDbValueDef(ew_UnFormatDateTime($mst_room_price->tanggal1->CurrentValue, 7), ew_CurrentDate());
		$rsnew['tanggal1'] =& $mst_room_price->tanggal1->DbValue;

		// Field tanggal2
		$mst_room_price->tanggal2->SetDbValueDef(ew_UnFormatDateTime($mst_room_price->tanggal2->CurrentValue, 7), ew_CurrentDate());
		$rsnew['tanggal2'] =& $mst_room_price->tanggal2->DbValue;

		// Field room
		$mst_room_price->room->SetDbValueDef($mst_room_price->room->CurrentValue, "");
		$rsnew['room'] =& $mst_room_price->room->DbValue;

		// Field roomtype
		$mst_room_price->roomtype->SetDbValueDef($mst_room_price->roomtype->CurrentValue, "");
		$rsnew['roomtype'] =& $mst_room_price->roomtype->DbValue;

		// Field description
		$mst_room_price->description->SetDbValueDef($mst_room_price->description->CurrentValue, "");
		$rsnew['description'] =& $mst_room_price->description->DbValue;

		// Field baseprice
		$mst_room_price->baseprice->SetDbValueDef($mst_room_price->baseprice->CurrentValue, 0);
		$rsnew['baseprice'] =& $mst_room_price->baseprice->DbValue;

		// Field tax
		$mst_room_price->tax->SetDbValueDef($mst_room_price->tax->CurrentValue, 0);
		$rsnew['tax'] =& $mst_room_price->tax->DbValue;

		// Field service
		$mst_room_price->service->SetDbValueDef($mst_room_price->service->CurrentValue, 0);
		$rsnew['service'] =& $mst_room_price->service->DbValue;

		// Field aftertaxservice
		$mst_room_price->aftertaxservice->SetDbValueDef($mst_room_price->aftertaxservice->CurrentValue, 0);
		$rsnew['aftertaxservice'] =& $mst_room_price->aftertaxservice->DbValue;

		// Field createby
		$mst_room_price->createby->SetDbValueDef($_SESSION["username"], "");
		$rsnew['createby'] =& $mst_room_price->createby->DbValue;

		// Field createdate
		$mst_room_price->createdate->SetDbValueDef(ew_CurrentDateTime(), ew_CurrentDate());
		$rsnew['createdate'] =& $mst_room_price->createdate->DbValue;

		// Call Row Inserting event
		$bInsertRow = $mst_room_price->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($mst_room_price->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($mst_room_price->CancelMessage <> "") {
				$this->setMessage($mst_room_price->CancelMessage);
				$mst_room_price->CancelMessage = "";
			} else {
				$this->setMessage("Insert cancelled");
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$mst_room_price->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] =& $mst_room_price->id->DbValue;

			// Call Row Inserted event
			$mst_room_price->Row_Inserted($rsnew);
		}
		return $AddRow;
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
