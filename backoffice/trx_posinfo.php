<?php

// PHPMaker 6 configuration for Table trx_pos
$trx_pos = NULL; // Initialize table object

// Define table class
class ctrx_pos {

	// Define table level constants
	var $TableVar;
	var $TableName;
	var $SelectLimit = FALSE;
	var $kode;
	var $tanggal;
	var $kodebooking;
	var $room;
	var $nama;
	var $total_amount;
	var $jenis_bayar;
	var $cardno;
	var $paid;
	var $returno;
	var $outlet;
	var $kodetrx;
	var $disc_member;
	var $disc_special;
	var $totaldisc;
	var $pembayaran;
	var $updateby;
	var $updatedate;
	var $idseqno;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var	$ExportAll = EW_EXPORT_ALL;
	var $SendEmail; // Send Email
	var $TableCustomInnerHtml; // Custom Inner Html

	function ctrx_pos() {
		$this->TableVar = "trx_pos";
		$this->TableName = "trx_pos";
		$this->SelectLimit = TRUE;
		$this->kode = new cField('trx_pos', 'x_kode', 'kode', "`kode`", 200, -1, FALSE);
		$this->fields['kode'] =& $this->kode;
		$this->tanggal = new cField('trx_pos', 'x_tanggal', 'tanggal', "`tanggal`", 135, 7, FALSE);
		$this->fields['tanggal'] =& $this->tanggal;
		$this->kodebooking = new cField('trx_pos', 'x_kodebooking', 'kodebooking', "`kodebooking`", 200, -1, FALSE);
		$this->fields['kodebooking'] =& $this->kodebooking;
		$this->room = new cField('trx_pos', 'x_room', 'room', "`room`", 200, -1, FALSE);
		$this->fields['room'] =& $this->room;
		$this->nama = new cField('trx_pos', 'x_nama', 'nama', "`nama`", 200, -1, FALSE);
		$this->fields['nama'] =& $this->nama;
		$this->total_amount = new cField('trx_pos', 'x_total_amount', 'total_amount', "`total_amount`", 5, -1, FALSE);
		$this->fields['total_amount'] =& $this->total_amount;
		$this->jenis_bayar = new cField('trx_pos', 'x_jenis_bayar', 'jenis_bayar', "`jenis_bayar`", 200, -1, FALSE);
		$this->fields['jenis_bayar'] =& $this->jenis_bayar;
		$this->cardno = new cField('trx_pos', 'x_cardno', 'cardno', "`cardno`", 200, -1, FALSE);
		$this->fields['cardno'] =& $this->cardno;
		$this->paid = new cField('trx_pos', 'x_paid', 'paid', "`paid`", 2, -1, FALSE);
		$this->fields['paid'] =& $this->paid;
		$this->returno = new cField('trx_pos', 'x_returno', 'returno', "`returno`", 200, -1, FALSE);
		$this->fields['returno'] =& $this->returno;
		$this->outlet = new cField('trx_pos', 'x_outlet', 'outlet', "`outlet`", 200, -1, FALSE);
		$this->fields['outlet'] =& $this->outlet;
		$this->kodetrx = new cField('trx_pos', 'x_kodetrx', 'kodetrx', "`kodetrx`", 200, -1, FALSE);
		$this->fields['kodetrx'] =& $this->kodetrx;
		$this->disc_member = new cField('trx_pos', 'x_disc_member', 'disc_member', "`disc_member`", 5, -1, FALSE);
		$this->fields['disc_member'] =& $this->disc_member;
		$this->disc_special = new cField('trx_pos', 'x_disc_special', 'disc_special', "`disc_special`", 5, -1, FALSE);
		$this->fields['disc_special'] =& $this->disc_special;
		$this->totaldisc = new cField('trx_pos', 'x_totaldisc', 'totaldisc', "`totaldisc`", 5, -1, FALSE);
		$this->fields['totaldisc'] =& $this->totaldisc;
		$this->pembayaran = new cField('trx_pos', 'x_pembayaran', 'pembayaran', "`pembayaran`", 5, -1, FALSE);
		$this->fields['pembayaran'] =& $this->pembayaran;
		$this->updateby = new cField('trx_pos', 'x_updateby', 'updateby', "`updateby`", 200, -1, FALSE);
		$this->fields['updateby'] =& $this->updateby;
		$this->updatedate = new cField('trx_pos', 'x_updatedate', 'updatedate', "`updatedate`", 135, 7, FALSE);
		$this->fields['updatedate'] =& $this->updatedate;
		$this->idseqno = new cField('trx_pos', 'x_idseqno', 'idseqno', "`idseqno`", 3, -1, FALSE);
		$this->fields['idseqno'] =& $this->idseqno;
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
		return "trx_pos_Highlight";
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
		return "SELECT * FROM `trx_pos`";
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
		return "tanggal DESC, updatedate DESC";
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
		return "INSERT INTO `trx_pos` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		$SQL = "UPDATE `trx_pos` SET ";
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
		$SQL = "DELETE FROM `trx_pos` WHERE ";
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
			return "trx_poslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// View url
	function ViewUrl() {
		return $this->KeyUrl("trx_posview.php", $this->UrlParm());
	}

	// Add url
	function AddUrl() {
		$AddUrl = "trx_posadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit url
	function EditUrl() {
		return $this->KeyUrl("trx_posedit.php", $this->UrlParm());
	}

	// Inline edit url
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy url
	function CopyUrl() {
		return $this->KeyUrl("trx_posadd.php", $this->UrlParm());
	}

	// Inline copy url
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete url
	function DeleteUrl() {
		return $this->KeyUrl("trx_posdelete.php", $this->UrlParm());
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=trx_pos" : "";
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
		$this->tanggal->setDbValue($rs->fields('tanggal'));
		$this->kodebooking->setDbValue($rs->fields('kodebooking'));
		$this->room->setDbValue($rs->fields('room'));
		$this->nama->setDbValue($rs->fields('nama'));
		$this->total_amount->setDbValue($rs->fields('total_amount'));
		$this->jenis_bayar->setDbValue($rs->fields('jenis_bayar'));
		$this->cardno->setDbValue($rs->fields('cardno'));
		$this->paid->setDbValue($rs->fields('paid'));
		$this->returno->setDbValue($rs->fields('returno'));
		$this->outlet->setDbValue($rs->fields('outlet'));
		$this->kodetrx->setDbValue($rs->fields('kodetrx'));
		$this->disc_member->setDbValue($rs->fields('disc_member'));
		$this->disc_special->setDbValue($rs->fields('disc_special'));
		$this->totaldisc->setDbValue($rs->fields('totaldisc'));
		$this->pembayaran->setDbValue($rs->fields('pembayaran'));
		$this->updateby->setDbValue($rs->fields('updateby'));
		$this->updatedate->setDbValue($rs->fields('updatedate'));
		$this->idseqno->setDbValue($rs->fields('idseqno'));
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

		// kodebooking
		$this->kodebooking->ViewValue = $this->kodebooking->CurrentValue;
		$this->kodebooking->CssStyle = "";
		$this->kodebooking->CssClass = "";
		$this->kodebooking->ViewCustomAttributes = "";

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

		// nama
		$this->nama->ViewValue = $this->nama->CurrentValue;
		$this->nama->CssStyle = "";
		$this->nama->CssClass = "";
		$this->nama->ViewCustomAttributes = "";

		// total_amount
		$this->total_amount->ViewValue = $this->total_amount->CurrentValue;
		$this->total_amount->ViewValue = ew_FormatNumber($this->total_amount->ViewValue, 0, -2, -2, -2);
		$this->total_amount->CssStyle = "text-align:right;";
		$this->total_amount->CssClass = "";
		$this->total_amount->ViewCustomAttributes = "";

		// jenis_bayar
		if (strval($this->jenis_bayar->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `description` FROM `mst_pay_type` WHERE `kode` = '" . ew_AdjustSql($this->jenis_bayar->CurrentValue) . "'";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->jenis_bayar->ViewValue = $rswrk->fields('description');
				$rswrk->Close();
			} else {
				$this->jenis_bayar->ViewValue = $this->jenis_bayar->CurrentValue;
			}
		} else {
			$this->jenis_bayar->ViewValue = NULL;
		}
		$this->jenis_bayar->CssStyle = "";
		$this->jenis_bayar->CssClass = "";
		$this->jenis_bayar->ViewCustomAttributes = "";

		// cardno
		$this->cardno->ViewValue = $this->cardno->CurrentValue;
		$this->cardno->CssStyle = "";
		$this->cardno->CssClass = "";
		$this->cardno->ViewCustomAttributes = "";

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

		// updateby
		if (strval($this->updateby->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($this->updateby->CurrentValue) . "'";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->updateby->ViewValue = $rswrk->fields('nama');
				$rswrk->Close();
			} else {
				$this->updateby->ViewValue = $this->updateby->CurrentValue;
			}
		} else {
			$this->updateby->ViewValue = NULL;
		}
		$this->updateby->CssStyle = "";
		$this->updateby->CssClass = "";
		$this->updateby->ViewCustomAttributes = "";

		// kode
		$this->kode->HrefValue = "";

		// tanggal
		$this->tanggal->HrefValue = "";

		// kodebooking
		$this->kodebooking->HrefValue = "";

		// room
		$this->room->HrefValue = "";

		// nama
		$this->nama->HrefValue = "";

		// total_amount
		$this->total_amount->HrefValue = "";

		// jenis_bayar
		$this->jenis_bayar->HrefValue = "";

		// cardno
		$this->cardno->HrefValue = "";

		// paid
		$this->paid->HrefValue = "";

		// updateby
		$this->updateby->HrefValue = "";

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
