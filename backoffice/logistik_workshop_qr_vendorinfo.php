<?php

// PHPMaker 6 configuration for Table logistik_workshop_qr_vendor
$logistik_workshop_qr_vendor = NULL; // Initialize table object

// Define table class
class clogistik_workshop_qr_vendor {

	// Define table level constants
	var $TableVar;
	var $TableName;
	var $SelectLimit = FALSE;
	var $actionlink;
	var $qrno;
	var $vendorid;
	var $tanggal;
	var $seqno;
	var $kodeworkshop;
	var $notes;
	var $receiveby;
	var $receivedate;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var	$ExportAll = EW_EXPORT_ALL;
	var $SendEmail; // Send Email
	var $TableCustomInnerHtml; // Custom Inner Html

	function clogistik_workshop_qr_vendor() {
		$this->TableVar = "logistik_workshop_qr_vendor";
		$this->TableName = "logistik_workshop_qr_vendor";
		$this->SelectLimit = TRUE;
		$this->actionlink = new cField('logistik_workshop_qr_vendor', 'x_actionlink', 'actionlink', "`actionlink`", 201, -1, FALSE);
		$this->fields['actionlink'] =& $this->actionlink;
		$this->qrno = new cField('logistik_workshop_qr_vendor', 'x_qrno', 'qrno', "`qrno`", 200, -1, FALSE);
		$this->fields['qrno'] =& $this->qrno;
		$this->vendorid = new cField('logistik_workshop_qr_vendor', 'x_vendorid', 'vendorid', "`vendorid`", 200, -1, FALSE);
		$this->fields['vendorid'] =& $this->vendorid;
		$this->tanggal = new cField('logistik_workshop_qr_vendor', 'x_tanggal', 'tanggal', "`tanggal`", 133, 7, FALSE);
		$this->fields['tanggal'] =& $this->tanggal;
		$this->seqno = new cField('logistik_workshop_qr_vendor', 'x_seqno', 'seqno', "`seqno`", 3, -1, FALSE);
		$this->fields['seqno'] =& $this->seqno;
		$this->kodeworkshop = new cField('logistik_workshop_qr_vendor', 'x_kodeworkshop', 'kodeworkshop', "`kodeworkshop`", 200, -1, FALSE);
		$this->fields['kodeworkshop'] =& $this->kodeworkshop;
		$this->notes = new cField('logistik_workshop_qr_vendor', 'x_notes', 'notes', "`notes`", 201, -1, FALSE);
		$this->fields['notes'] =& $this->notes;
		$this->receiveby = new cField('logistik_workshop_qr_vendor', 'x_receiveby', 'receiveby', "`receiveby`", 200, -1, FALSE);
		$this->fields['receiveby'] =& $this->receiveby;
		$this->receivedate = new cField('logistik_workshop_qr_vendor', 'x_receivedate', 'receivedate', "`receivedate`", 135, 7, FALSE);
		$this->fields['receivedate'] =& $this->receivedate;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Search Highlight Name
	function HighlightName() {
		return "logistik_workshop_qr_vendor_Highlight";
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search Keyword
	function getBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic Search Type
	function getBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search where clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE Clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session Key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Table level SQL
	function SqlSelect() { // Select
		return "SELECT * FROM `logistik_workshop_qr_vendor`";
	}

	function SqlWhere() { // Where
		return "";
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "`qrno` DESC";
	}

	// SQL variables
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Return table sql with list page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		if ($this->CurrentFilter <> "") {
			if ($sFilter <> "") $sFilter = "($sFilter) AND ";
			$sFilter .= "(" . $this->CurrentFilter . ")";
		}
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Return record count
	function SelectRecordCount() {
		global $conn;
		$cnt = -1;
		$sFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		if ($this->SelectLimit) {
			$sSelect = $this->SelectSQL();
			if (strtoupper(substr($sSelect, 0, 13)) == "SELECT * FROM") {
				$sSelect = "SELECT COUNT(*) FROM" . substr($sSelect, 13);
				if ($rs = $conn->Execute($sSelect)) {
					if (!$rs->EOF)
						$cnt = $rs->fields[0];
					$rs->Close();
				}
			}
		}
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $sFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= (is_null($value) ? "NULL" : ew_QuotedValue($value, $this->fields[$name]->FldDataType)) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `logistik_workshop_qr_vendor` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		$SQL = "UPDATE `logistik_workshop_qr_vendor` SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=" .
					(is_null($value) ? "NULL" : ew_QuotedValue($value, $this->fields[$name]->FldDataType)) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `logistik_workshop_qr_vendor` WHERE ";
		$SQL .= EW_DB_QUOTE_START . 'qrno' . EW_DB_QUOTE_END . '=' .	ew_QuotedValue($rs['qrno'], $this->qrno->FldDataType) . ' AND ';
		$SQL .= EW_DB_QUOTE_START . 'vendorid' . EW_DB_QUOTE_END . '=' .	ew_QuotedValue($rs['vendorid'], $this->vendorid->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter for table
	function SqlKeyFilter() {
		return "`qrno` = '@qrno@' AND `vendorid` = '@vendorid@'";
	}

	// Return Key filter for table
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		$sKeyFilter = str_replace("@qrno@", ew_AdjustSql($this->qrno->CurrentValue), $sKeyFilter); // Replace key value
		$sKeyFilter = str_replace("@vendorid@", ew_AdjustSql($this->vendorid->CurrentValue), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return url
	function getReturnUrl() {

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] <> "") {
			return $_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL];
		} else {
			return "logistik_workshop_qr_vendorlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// View url
	function ViewUrl() {
		return $this->KeyUrl("logistik_workshop_qr_vendorview.php", $this->UrlParm());
	}

	// Add url
	function AddUrl() {
		$AddUrl = "logistik_workshop_qr_vendoradd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit url
	function EditUrl() {
		return $this->KeyUrl("logistik_workshop_qr_vendoredit.php", $this->UrlParm());
	}

	// Inline edit url
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy url
	function CopyUrl() {
		return $this->KeyUrl("logistik_workshop_qr_vendoradd.php", $this->UrlParm());
	}

	// Inline copy url
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete url
	function DeleteUrl() {
		return $this->KeyUrl("logistik_workshop_qr_vendordelete.php", $this->UrlParm());
	}

	// Key url
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->qrno->CurrentValue)) {
			$sUrl .= "qrno=" . urlencode($this->qrno->CurrentValue);
		} else {
			return "javascript:alert('Invalid Record! Key is null');";
		}
		if (!is_null($this->vendorid->CurrentValue)) {
			$sUrl .= "&vendorid=" . urlencode($this->vendorid->CurrentValue);
		} else {
			return "javascript:alert('Invalid Record! Key is null');";
		}
		return $sUrl;
	}

	// Sort Url
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			($fld->FldType == 205)) { // Unsortable data type
			return "";
		} else {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		}
	}

	// URL parm
	function UrlParm($parm = "") {
		$UrlParm = ($this->UseTokenInUrl) ? "t=logistik_workshop_qr_vendor" : "";
		if ($parm <> "") {
			if ($UrlParm <> "")
				$UrlParm .= "&";
			$UrlParm .= $parm;
		}
		return $UrlParm;
	}

	// Function LoadRs
	// - Load rows based on filter
	function LoadRs($sFilter) {
		global $conn;

		// Set up filter (Sql Where Clause) and get Return Sql
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		return $conn->Execute($sSql);
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->actionlink->setDbValue($rs->fields('actionlink'));
		$this->qrno->setDbValue($rs->fields('qrno'));
		$this->vendorid->setDbValue($rs->fields('vendorid'));
		$this->tanggal->setDbValue($rs->fields('tanggal'));
		$this->seqno->setDbValue($rs->fields('seqno'));
		$this->kodeworkshop->setDbValue($rs->fields('kodeworkshop'));
		$this->notes->setDbValue($rs->fields('notes'));
		$this->receiveby->setDbValue($rs->fields('receiveby'));
		$this->receivedate->setDbValue($rs->fields('receivedate'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

		// actionlink
		$this->actionlink->ViewValue = $this->actionlink->CurrentValue;
		$this->actionlink->CssStyle = "";
		$this->actionlink->CssClass = "";
		$this->actionlink->ViewCustomAttributes = "";

		// qrno
		$this->qrno->ViewValue = $this->qrno->CurrentValue;
		$this->qrno->CssStyle = "";
		$this->qrno->CssClass = "";
		$this->qrno->ViewCustomAttributes = "";

		// vendorid
		if (strval($this->vendorid->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nama`, `alamat` FROM `mst_vendor` WHERE `kode` = '" . ew_AdjustSql($this->vendorid->CurrentValue) . "'";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->vendorid->ViewValue = $rswrk->fields('nama');
				$this->vendorid->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('alamat');
				$rswrk->Close();
			} else {
				$this->vendorid->ViewValue = $this->vendorid->CurrentValue;
			}
		} else {
			$this->vendorid->ViewValue = NULL;
		}
		$this->vendorid->CssStyle = "";
		$this->vendorid->CssClass = "";
		$this->vendorid->ViewCustomAttributes = "";

		// tanggal
		$this->tanggal->ViewValue = $this->tanggal->CurrentValue;
		$this->tanggal->ViewValue = ew_FormatDateTime($this->tanggal->ViewValue, 7);
		$this->tanggal->CssStyle = "";
		$this->tanggal->CssClass = "";
		$this->tanggal->ViewCustomAttributes = "";

		// kodeworkshop
		if (strval($this->kodeworkshop->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nama`, `alamat` FROM `mst_gudang` WHERE `kode` = '" . ew_AdjustSql($this->kodeworkshop->CurrentValue) . "'";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->kodeworkshop->ViewValue = $rswrk->fields('nama');
				$this->kodeworkshop->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('alamat');
				$rswrk->Close();
			} else {
				$this->kodeworkshop->ViewValue = $this->kodeworkshop->CurrentValue;
			}
		} else {
			$this->kodeworkshop->ViewValue = NULL;
		}
		$this->kodeworkshop->CssStyle = "";
		$this->kodeworkshop->CssClass = "";
		$this->kodeworkshop->ViewCustomAttributes = "";

		// receiveby
		if (strval($this->receiveby->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($this->receiveby->CurrentValue) . "'";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->receiveby->ViewValue = $rswrk->fields('nama');
				$rswrk->Close();
			} else {
				$this->receiveby->ViewValue = $this->receiveby->CurrentValue;
			}
		} else {
			$this->receiveby->ViewValue = NULL;
		}
		$this->receiveby->CssStyle = "";
		$this->receiveby->CssClass = "";
		$this->receiveby->ViewCustomAttributes = "";

		// actionlink
		$this->actionlink->HrefValue = "";

		// qrno
		$this->qrno->HrefValue = "";

		// vendorid
		$this->vendorid->HrefValue = "";

		// tanggal
		$this->tanggal->HrefValue = "";

		// kodeworkshop
		$this->kodeworkshop->HrefValue = "";

		// receiveby
		$this->receiveby->HrefValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}
	var $CurrentAction; // Current action
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message
	var $RowType; // Row Type
	var $CssClass; // Css class
	var $CssStyle; // Css style
	var $RowClientEvents; // Row client events

	// Row Attribute
	function RowAttributes() {
		$sAtt = "";
		if (trim($this->CssStyle) <> "") {
			$sAtt .= " style=\"" . trim($this->CssStyle) . "\"";
		}
		if (trim($this->CssClass) <> "") {
			$sAtt .= " class=\"" . trim($this->CssClass) . "\"";
		}
		if ($this->Export == "") {
			if (trim($this->RowClientEvents) <> "") {
				$sAtt .= " " . trim($this->RowClientEvents);
			}
		}
		return $sAtt;
	}

	// Field objects
	function fields($fldname) {
		return $this->fields[$fldname];
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// Row Inserting event
	function Row_Inserting(&$rs) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted(&$rs) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating(&$rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated(&$rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}
}
?>
