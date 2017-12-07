<?php

// PHPMaker 6 configuration for Table trx_restaurant_bill
$trx_restaurant_bill = NULL; // Initialize table object

// Define table class
class ctrx_restaurant_bill {

	// Define table level constants
	var $TableVar;
	var $TableName;
	var $SelectLimit = FALSE;
	var $kode;
	var $idseqno;
	var $nama;
	var $tanggal;
	var $room;
	var $withppn;
	var $withservice;
	var $subtotal1;
	var $ppn;
	var $subtotal2;
	var $service;
	var $grandtotal;
	var $notes;
	var $createby;
	var $createdate;
	var $kodebooking;
	var $paid;
	var $paymenttype;
	var $coabank;
	var $norek;
	var $isread;
	var $nett;
	var $discname;
	var $disc;
	var $xtimestamp;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var	$ExportAll = EW_EXPORT_ALL;
	var $SendEmail; // Send Email
	var $TableCustomInnerHtml; // Custom Inner Html

	function ctrx_restaurant_bill() {
		$this->TableVar = "trx_restaurant_bill";
		$this->TableName = "trx_restaurant_bill";
		$this->SelectLimit = TRUE;
		$this->kode = new cField('trx_restaurant_bill', 'x_kode', 'kode', "`kode`", 200, -1, FALSE);
		$this->fields['kode'] =& $this->kode;
		$this->idseqno = new cField('trx_restaurant_bill', 'x_idseqno', 'idseqno', "`idseqno`", 3, -1, FALSE);
		$this->fields['idseqno'] =& $this->idseqno;
		$this->nama = new cField('trx_restaurant_bill', 'x_nama', 'nama', "`nama`", 200, -1, FALSE);
		$this->fields['nama'] =& $this->nama;
		$this->tanggal = new cField('trx_restaurant_bill', 'x_tanggal', 'tanggal', "`tanggal`", 133, 7, FALSE);
		$this->fields['tanggal'] =& $this->tanggal;
		$this->room = new cField('trx_restaurant_bill', 'x_room', 'room', "`room`", 200, -1, FALSE);
		$this->fields['room'] =& $this->room;
		$this->withppn = new cField('trx_restaurant_bill', 'x_withppn', 'withppn', "`withppn`", 2, -1, FALSE);
		$this->fields['withppn'] =& $this->withppn;
		$this->withservice = new cField('trx_restaurant_bill', 'x_withservice', 'withservice', "`withservice`", 2, -1, FALSE);
		$this->fields['withservice'] =& $this->withservice;
		$this->subtotal1 = new cField('trx_restaurant_bill', 'x_subtotal1', 'subtotal1', "`subtotal1`", 5, -1, FALSE);
		$this->fields['subtotal1'] =& $this->subtotal1;
		$this->ppn = new cField('trx_restaurant_bill', 'x_ppn', 'ppn', "`ppn`", 5, -1, FALSE);
		$this->fields['ppn'] =& $this->ppn;
		$this->subtotal2 = new cField('trx_restaurant_bill', 'x_subtotal2', 'subtotal2', "`subtotal2`", 5, -1, FALSE);
		$this->fields['subtotal2'] =& $this->subtotal2;
		$this->service = new cField('trx_restaurant_bill', 'x_service', 'service', "`service`", 5, -1, FALSE);
		$this->fields['service'] =& $this->service;
		$this->grandtotal = new cField('trx_restaurant_bill', 'x_grandtotal', 'grandtotal', "`grandtotal`", 5, -1, FALSE);
		$this->fields['grandtotal'] =& $this->grandtotal;
		$this->notes = new cField('trx_restaurant_bill', 'x_notes', 'notes', "`notes`", 200, -1, FALSE);
		$this->fields['notes'] =& $this->notes;
		$this->createby = new cField('trx_restaurant_bill', 'x_createby', 'createby', "`createby`", 200, -1, FALSE);
		$this->fields['createby'] =& $this->createby;
		$this->createdate = new cField('trx_restaurant_bill', 'x_createdate', 'createdate', "`createdate`", 135, 7, FALSE);
		$this->fields['createdate'] =& $this->createdate;
		$this->kodebooking = new cField('trx_restaurant_bill', 'x_kodebooking', 'kodebooking', "`kodebooking`", 200, -1, FALSE);
		$this->fields['kodebooking'] =& $this->kodebooking;
		$this->paid = new cField('trx_restaurant_bill', 'x_paid', 'paid', "`paid`", 2, -1, FALSE);
		$this->fields['paid'] =& $this->paid;
		$this->paymenttype = new cField('trx_restaurant_bill', 'x_paymenttype', 'paymenttype', "`paymenttype`", 200, -1, FALSE);
		$this->fields['paymenttype'] =& $this->paymenttype;
		$this->coabank = new cField('trx_restaurant_bill', 'x_coabank', 'coabank', "`coabank`", 200, -1, FALSE);
		$this->fields['coabank'] =& $this->coabank;
		$this->norek = new cField('trx_restaurant_bill', 'x_norek', 'norek', "`norek`", 200, -1, FALSE);
		$this->fields['norek'] =& $this->norek;
		$this->isread = new cField('trx_restaurant_bill', 'x_isread', 'isread', "`isread`", 2, -1, FALSE);
		$this->fields['isread'] =& $this->isread;
		$this->nett = new cField('trx_restaurant_bill', 'x_nett', 'nett', "`nett`", 2, -1, FALSE);
		$this->fields['nett'] =& $this->nett;
		$this->discname = new cField('trx_restaurant_bill', 'x_discname', 'discname', "`discname`", 200, -1, FALSE);
		$this->fields['discname'] =& $this->discname;
		$this->disc = new cField('trx_restaurant_bill', 'x_disc', 'disc', "`disc`", 5, -1, FALSE);
		$this->fields['disc'] =& $this->disc;
		$this->xtimestamp = new cField('trx_restaurant_bill', 'x_xtimestamp', 'xtimestamp', "`xtimestamp`", 135, 7, FALSE);
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
		return "trx_restaurant_bill_Highlight";
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
		return "SELECT * FROM `trx_restaurant_bill`";
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
		return "`tanggal` DESC,`kode` DESC";
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
		return "INSERT INTO `trx_restaurant_bill` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		$SQL = "UPDATE `trx_restaurant_bill` SET ";
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
		$SQL = "DELETE FROM `trx_restaurant_bill` WHERE ";
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
			return "trx_restaurant_billlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// View url
	function ViewUrl() {
		return $this->KeyUrl("trx_restaurant_billview.php", $this->UrlParm());
	}

	// Add url
	function AddUrl() {
		$AddUrl = "trx_restaurant_billadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit url
	function EditUrl() {
		return $this->KeyUrl("trx_restaurant_billedit.php", $this->UrlParm());
	}

	// Inline edit url
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy url
	function CopyUrl() {
		return $this->KeyUrl("trx_restaurant_billadd.php", $this->UrlParm());
	}

	// Inline copy url
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete url
	function DeleteUrl() {
		return $this->KeyUrl("trx_restaurant_billdelete.php", $this->UrlParm());
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=trx_restaurant_bill" : "";
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
		$this->nama->setDbValue($rs->fields('nama'));
		$this->tanggal->setDbValue($rs->fields('tanggal'));
		$this->room->setDbValue($rs->fields('room'));
		$this->withppn->setDbValue($rs->fields('withppn'));
		$this->withservice->setDbValue($rs->fields('withservice'));
		$this->subtotal1->setDbValue($rs->fields('subtotal1'));
		$this->ppn->setDbValue($rs->fields('ppn'));
		$this->subtotal2->setDbValue($rs->fields('subtotal2'));
		$this->service->setDbValue($rs->fields('service'));
		$this->grandtotal->setDbValue($rs->fields('grandtotal'));
		$this->notes->setDbValue($rs->fields('notes'));
		$this->createby->setDbValue($rs->fields('createby'));
		$this->createdate->setDbValue($rs->fields('createdate'));
		$this->kodebooking->setDbValue($rs->fields('kodebooking'));
		$this->paid->setDbValue($rs->fields('paid'));
		$this->paymenttype->setDbValue($rs->fields('paymenttype'));
		$this->coabank->setDbValue($rs->fields('coabank'));
		$this->norek->setDbValue($rs->fields('norek'));
		$this->isread->setDbValue($rs->fields('isread'));
		$this->nett->setDbValue($rs->fields('nett'));
		$this->discname->setDbValue($rs->fields('discname'));
		$this->disc->setDbValue($rs->fields('disc'));
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

		// nama
		$this->nama->ViewValue = $this->nama->CurrentValue;
		$this->nama->CssStyle = "";
		$this->nama->CssClass = "";
		$this->nama->ViewCustomAttributes = "";

		// tanggal
		$this->tanggal->ViewValue = $this->tanggal->CurrentValue;
		$this->tanggal->ViewValue = ew_FormatDateTime($this->tanggal->ViewValue, 7);
		$this->tanggal->CssStyle = "";
		$this->tanggal->CssClass = "";
		$this->tanggal->ViewCustomAttributes = "";

		// room
		if (strval($this->room->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nama` FROM `mst_room` WHERE `kode` = '" . ew_AdjustSql($this->room->CurrentValue) . "'";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->room->ViewValue = $rswrk->fields('nama');
				$rswrk->Close();
			} else {
				$this->room->ViewValue = $this->room->CurrentValue;
			}
		} else {
			$this->room->ViewValue = NULL;
		}
		$this->room->CssStyle = "";
		$this->room->CssClass = "";
		$this->room->ViewCustomAttributes = "";

		// grandtotal
		$this->grandtotal->ViewValue = $this->grandtotal->CurrentValue;
		$this->grandtotal->ViewValue = ew_FormatNumber($this->grandtotal->ViewValue, 0, -2, -2, -2);
		$this->grandtotal->CssStyle = "text-align:right;";
		$this->grandtotal->CssClass = "";
		$this->grandtotal->ViewCustomAttributes = "";

		// createby
		if (strval($this->createby->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($this->createby->CurrentValue) . "'";
			$sSqlWrk .= " ORDER BY `nama` ";
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

		// createdate
		$this->createdate->ViewValue = $this->createdate->CurrentValue;
		$this->createdate->ViewValue = ew_FormatDateTime($this->createdate->ViewValue, 7);
		$this->createdate->CssStyle = "";
		$this->createdate->CssClass = "";
		$this->createdate->ViewCustomAttributes = "";

		// paid
		if (strval($this->paid->CurrentValue) <> "") {
			switch ($this->paid->CurrentValue) {
				case "0":
					$this->paid->ViewValue = "Belum";
					break;
				case "1":
					$this->paid->ViewValue = "Sudah";
					break;
				case "2":
					$this->paid->ViewValue = "With Room";
					break;
				default:
					$this->paid->ViewValue = $this->paid->CurrentValue;
			}
		} else {
			$this->paid->ViewValue = NULL;
		}
		$this->paid->CssStyle = "";
		$this->paid->CssClass = "";
		$this->paid->ViewCustomAttributes = "";

		// kode
		$this->kode->HrefValue = "";

		// nama
		$this->nama->HrefValue = "";

		// tanggal
		$this->tanggal->HrefValue = "";

		// room
		$this->room->HrefValue = "";

		// grandtotal
		$this->grandtotal->HrefValue = "";

		// createby
		$this->createby->HrefValue = "";

		// createdate
		$this->createdate->HrefValue = "";

		// paid
		$this->paid->HrefValue = "";

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
