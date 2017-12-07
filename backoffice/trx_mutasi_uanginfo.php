<?php

// PHPMaker 6 configuration for Table trx_mutasi_uang
$trx_mutasi_uang = NULL; // Initialize table object

// Define table class
class ctrx_mutasi_uang {

	// Define table level constants
	var $TableVar;
	var $TableName;
	var $SelectLimit = FALSE;
	var $kode;
	var $idseqno;
	var $tanggal;
	var $mode;
	var $coabank;
	var $cardno;
	var $modul;
	var $kode_trx;
	var $kodejurnal;
	var $coa;
	var $notes;
	var $debit;
	var $kredit;
	var $createby;
	var $createdate;
	var $xtimestamp;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var	$ExportAll = EW_EXPORT_ALL;
	var $SendEmail; // Send Email
	var $TableCustomInnerHtml; // Custom Inner Html

	function ctrx_mutasi_uang() {
		$this->TableVar = "trx_mutasi_uang";
		$this->TableName = "trx_mutasi_uang";
		$this->SelectLimit = TRUE;
		$this->kode = new cField('trx_mutasi_uang', 'x_kode', 'kode', "`kode`", 200, -1, FALSE);
		$this->fields['kode'] =& $this->kode;
		$this->idseqno = new cField('trx_mutasi_uang', 'x_idseqno', 'idseqno', "`idseqno`", 3, -1, FALSE);
		$this->fields['idseqno'] =& $this->idseqno;
		$this->tanggal = new cField('trx_mutasi_uang', 'x_tanggal', 'tanggal', "`tanggal`", 133, 7, FALSE);
		$this->fields['tanggal'] =& $this->tanggal;
		$this->mode = new cField('trx_mutasi_uang', 'x_mode', 'mode', "`mode`", 200, -1, FALSE);
		$this->fields['mode'] =& $this->mode;
		$this->coabank = new cField('trx_mutasi_uang', 'x_coabank', 'coabank', "`coabank`", 200, -1, FALSE);
		$this->fields['coabank'] =& $this->coabank;
		$this->cardno = new cField('trx_mutasi_uang', 'x_cardno', 'cardno', "`cardno`", 200, -1, FALSE);
		$this->fields['cardno'] =& $this->cardno;
		$this->modul = new cField('trx_mutasi_uang', 'x_modul', 'modul', "`modul`", 200, -1, FALSE);
		$this->fields['modul'] =& $this->modul;
		$this->kode_trx = new cField('trx_mutasi_uang', 'x_kode_trx', 'kode_trx', "`kode_trx`", 200, -1, FALSE);
		$this->fields['kode_trx'] =& $this->kode_trx;
		$this->kodejurnal = new cField('trx_mutasi_uang', 'x_kodejurnal', 'kodejurnal', "`kodejurnal`", 200, -1, FALSE);
		$this->fields['kodejurnal'] =& $this->kodejurnal;
		$this->coa = new cField('trx_mutasi_uang', 'x_coa', 'coa', "`coa`", 200, -1, FALSE);
		$this->fields['coa'] =& $this->coa;
		$this->notes = new cField('trx_mutasi_uang', 'x_notes', 'notes', "`notes`", 200, -1, FALSE);
		$this->fields['notes'] =& $this->notes;
		$this->debit = new cField('trx_mutasi_uang', 'x_debit', 'debit', "`debit`", 5, -1, FALSE);
		$this->fields['debit'] =& $this->debit;
		$this->kredit = new cField('trx_mutasi_uang', 'x_kredit', 'kredit', "`kredit`", 5, -1, FALSE);
		$this->fields['kredit'] =& $this->kredit;
		$this->createby = new cField('trx_mutasi_uang', 'x_createby', 'createby', "`createby`", 200, -1, FALSE);
		$this->fields['createby'] =& $this->createby;
		$this->createdate = new cField('trx_mutasi_uang', 'x_createdate', 'createdate', "`createdate`", 135, 7, FALSE);
		$this->fields['createdate'] =& $this->createdate;
		$this->xtimestamp = new cField('trx_mutasi_uang', 'x_xtimestamp', 'xtimestamp', "`xtimestamp`", 135, 7, FALSE);
		$this->fields['xtimestamp'] =& $this->xtimestamp;
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
		return "trx_mutasi_uang_Highlight";
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
		return "SELECT * FROM `trx_mutasi_uang`";
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
		return "";
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
		return "INSERT INTO `trx_mutasi_uang` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		$SQL = "UPDATE `trx_mutasi_uang` SET ";
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
		$SQL = "DELETE FROM `trx_mutasi_uang` WHERE ";
		$SQL .= EW_DB_QUOTE_START . 'kode' . EW_DB_QUOTE_END . '=' .	ew_QuotedValue($rs['kode'], $this->kode->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter for table
	function SqlKeyFilter() {
		return "`kode` = '@kode@'";
	}

	// Return Key filter for table
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		$sKeyFilter = str_replace("@kode@", ew_AdjustSql($this->kode->CurrentValue), $sKeyFilter); // Replace key value
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
			return "trx_mutasi_uanglist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// View url
	function ViewUrl() {
		return $this->KeyUrl("trx_mutasi_uangview.php", $this->UrlParm());
	}

	// Add url
	function AddUrl() {
		$AddUrl = "trx_mutasi_uangadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit url
	function EditUrl() {
		return $this->KeyUrl("trx_mutasi_uangedit.php", $this->UrlParm());
	}

	// Inline edit url
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy url
	function CopyUrl() {
		return $this->KeyUrl("trx_mutasi_uangadd.php", $this->UrlParm());
	}

	// Inline copy url
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete url
	function DeleteUrl() {
		return $this->KeyUrl("trx_mutasi_uangdelete.php", $this->UrlParm());
	}

	// Key url
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->kode->CurrentValue)) {
			$sUrl .= "kode=" . urlencode($this->kode->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=trx_mutasi_uang" : "";
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
		$this->kode->setDbValue($rs->fields('kode'));
		$this->idseqno->setDbValue($rs->fields('idseqno'));
		$this->tanggal->setDbValue($rs->fields('tanggal'));
		$this->mode->setDbValue($rs->fields('mode'));
		$this->coabank->setDbValue($rs->fields('coabank'));
		$this->cardno->setDbValue($rs->fields('cardno'));
		$this->modul->setDbValue($rs->fields('modul'));
		$this->kode_trx->setDbValue($rs->fields('kode_trx'));
		$this->kodejurnal->setDbValue($rs->fields('kodejurnal'));
		$this->coa->setDbValue($rs->fields('coa'));
		$this->notes->setDbValue($rs->fields('notes'));
		$this->debit->setDbValue($rs->fields('debit'));
		$this->kredit->setDbValue($rs->fields('kredit'));
		$this->createby->setDbValue($rs->fields('createby'));
		$this->createdate->setDbValue($rs->fields('createdate'));
		$this->xtimestamp->setDbValue($rs->fields('xtimestamp'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

		// kode
		$this->kode->ViewValue = $this->kode->CurrentValue;
		$this->kode->CssStyle = "";
		$this->kode->CssClass = "";
		$this->kode->ViewCustomAttributes = "";

		// tanggal
		$this->tanggal->ViewValue = $this->tanggal->CurrentValue;
		$this->tanggal->ViewValue = ew_FormatDateTime($this->tanggal->ViewValue, 7);
		$this->tanggal->CssStyle = "";
		$this->tanggal->CssClass = "";
		$this->tanggal->ViewCustomAttributes = "";

		// mode
		if (strval($this->mode->CurrentValue) <> "") {
			switch ($this->mode->CurrentValue) {
				case "kas":
					$this->mode->ViewValue = "Kas";
					break;
				case "edc":
					$this->mode->ViewValue = "EDC";
					break;
				case "bank":
					$this->mode->ViewValue = "Bank";
					break;
				default:
					$this->mode->ViewValue = $this->mode->CurrentValue;
			}
		} else {
			$this->mode->ViewValue = NULL;
		}
		$this->mode->CssStyle = "";
		$this->mode->CssClass = "";
		$this->mode->ViewCustomAttributes = "";

		// coabank
		if (strval($this->coabank->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `description` FROM `acc_mst_coa` WHERE `coa` = '" . ew_AdjustSql($this->coabank->CurrentValue) . "'";
			$sSqlWrk .= " AND (" . "`description` LIKE '%bank%'" . ")";
			$sSqlWrk .= " ORDER BY `description` ";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->coabank->ViewValue = $rswrk->fields('description');
				$rswrk->Close();
			} else {
				$this->coabank->ViewValue = $this->coabank->CurrentValue;
			}
		} else {
			$this->coabank->ViewValue = NULL;
		}
		$this->coabank->CssStyle = "";
		$this->coabank->CssClass = "";
		$this->coabank->ViewCustomAttributes = "";

		// notes
		$this->notes->ViewValue = $this->notes->CurrentValue;
		$this->notes->CssStyle = "";
		$this->notes->CssClass = "";
		$this->notes->ViewCustomAttributes = "";

		// debit
		$this->debit->ViewValue = $this->debit->CurrentValue;
		$this->debit->ViewValue = ew_FormatNumber($this->debit->ViewValue, 0, -2, -2, -2);
		$this->debit->CssStyle = "text-align:right;";
		$this->debit->CssClass = "";
		$this->debit->ViewCustomAttributes = "";

		// kredit
		$this->kredit->ViewValue = $this->kredit->CurrentValue;
		$this->kredit->ViewValue = ew_FormatNumber($this->kredit->ViewValue, 0, -2, -2, -2);
		$this->kredit->CssStyle = "text-align:right;";
		$this->kredit->CssClass = "";
		$this->kredit->ViewCustomAttributes = "";

		// createby
		if (strval($this->createby->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($this->createby->CurrentValue) . "'";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->createby->ViewValue = $rswrk->fields('nama');
				$rswrk->Close();
			} else {
				$this->createby->ViewValue = $this->createby->CurrentValue;
			}
		} else {
			$this->createby->ViewValue = NULL;
		}
		$this->createby->CssStyle = "";
		$this->createby->CssClass = "";
		$this->createby->ViewCustomAttributes = "";

		// kode
		$this->kode->HrefValue = "";

		// tanggal
		$this->tanggal->HrefValue = "";

		// mode
		$this->mode->HrefValue = "";

		// coabank
		$this->coabank->HrefValue = "";

		// notes
		$this->notes->HrefValue = "";

		// debit
		$this->debit->HrefValue = "";

		// kredit
		$this->kredit->HrefValue = "";

		// createby
		$this->createby->HrefValue = "";

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
