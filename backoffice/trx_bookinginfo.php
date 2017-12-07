<?php

// PHPMaker 6 configuration for Table trx_booking
$trx_booking = NULL; // Initialize table object

// Define table class
class ctrx_booking {

	// Define table level constants
	var $TableVar;
	var $TableName;
	var $SelectLimit = FALSE;
	var $kode;
	var $grup;
	var $idseqno;
	var $tanggal;
	var $title;
	var $nama;
	var $idtype;
	var $idno;
	var $alamat;
	var $phone;
	var $zemail;
	var $company;
	var $departement;
	var $dp;
	var $dptype;
	var $room;
	var $person;
	var $arrival;
	var $departure;
	var $rate;
	var $extraperson;
	var $chargeextraperson;
	var $discname;
	var $disc;
	var $notes;
	var $confirmasi;
	var $checkin;
	var $createby;
	var $createdate;
	var $confirmby;
	var $confirmdate;
	var $checkinby;
	var $checkindate;
	var $rate1;
	var $rate2;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var	$ExportAll = EW_EXPORT_ALL;
	var $SendEmail; // Send Email
	var $TableCustomInnerHtml; // Custom Inner Html

	function ctrx_booking() {
		$this->TableVar = "trx_booking";
		$this->TableName = "trx_booking";
		$this->SelectLimit = TRUE;
		$this->kode = new cField('trx_booking', 'x_kode', 'kode', "`kode`", 200, -1, FALSE);
		$this->fields['kode'] =& $this->kode;
		$this->grup = new cField('trx_booking', 'x_grup', 'grup', "`grup`", 200, -1, FALSE);
		$this->fields['grup'] =& $this->grup;
		$this->idseqno = new cField('trx_booking', 'x_idseqno', 'idseqno', "`idseqno`", 3, -1, FALSE);
		$this->fields['idseqno'] =& $this->idseqno;
		$this->tanggal = new cField('trx_booking', 'x_tanggal', 'tanggal', "`tanggal`", 133, 7, FALSE);
		$this->fields['tanggal'] =& $this->tanggal;
		$this->title = new cField('trx_booking', 'x_title', 'title', "`title`", 200, -1, FALSE);
		$this->fields['title'] =& $this->title;
		$this->nama = new cField('trx_booking', 'x_nama', 'nama', "`nama`", 200, -1, FALSE);
		$this->fields['nama'] =& $this->nama;
		$this->idtype = new cField('trx_booking', 'x_idtype', 'idtype', "`idtype`", 200, -1, FALSE);
		$this->fields['idtype'] =& $this->idtype;
		$this->idno = new cField('trx_booking', 'x_idno', 'idno', "`idno`", 200, -1, FALSE);
		$this->fields['idno'] =& $this->idno;
		$this->alamat = new cField('trx_booking', 'x_alamat', 'alamat', "`alamat`", 200, -1, FALSE);
		$this->fields['alamat'] =& $this->alamat;
		$this->phone = new cField('trx_booking', 'x_phone', 'phone', "`phone`", 200, -1, FALSE);
		$this->fields['phone'] =& $this->phone;
		$this->zemail = new cField('trx_booking', 'x_zemail', 'email', "`email`", 200, -1, FALSE);
		$this->fields['email'] =& $this->zemail;
		$this->company = new cField('trx_booking', 'x_company', 'company', "`company`", 200, -1, FALSE);
		$this->fields['company'] =& $this->company;
		$this->departement = new cField('trx_booking', 'x_departement', 'departement', "`departement`", 200, -1, FALSE);
		$this->fields['departement'] =& $this->departement;
		$this->dp = new cField('trx_booking', 'x_dp', 'dp', "`dp`", 5, -1, FALSE);
		$this->fields['dp'] =& $this->dp;
		$this->dptype = new cField('trx_booking', 'x_dptype', 'dptype', "`dptype`", 200, -1, FALSE);
		$this->fields['dptype'] =& $this->dptype;
		$this->room = new cField('trx_booking', 'x_room', 'room', "`room`", 200, -1, FALSE);
		$this->fields['room'] =& $this->room;
		$this->person = new cField('trx_booking', 'x_person', 'person', "`person`", 3, -1, FALSE);
		$this->fields['person'] =& $this->person;
		$this->arrival = new cField('trx_booking', 'x_arrival', 'arrival', "`arrival`", 133, 7, FALSE);
		$this->fields['arrival'] =& $this->arrival;
		$this->departure = new cField('trx_booking', 'x_departure', 'departure', "`departure`", 133, 7, FALSE);
		$this->fields['departure'] =& $this->departure;
		$this->rate = new cField('trx_booking', 'x_rate', 'rate', "`rate`", 5, -1, FALSE);
		$this->fields['rate'] =& $this->rate;
		$this->extraperson = new cField('trx_booking', 'x_extraperson', 'extraperson', "`extraperson`", 3, -1, FALSE);
		$this->fields['extraperson'] =& $this->extraperson;
		$this->chargeextraperson = new cField('trx_booking', 'x_chargeextraperson', 'chargeextraperson', "`chargeextraperson`", 5, -1, FALSE);
		$this->fields['chargeextraperson'] =& $this->chargeextraperson;
		$this->discname = new cField('trx_booking', 'x_discname', 'discname', "`discname`", 200, -1, FALSE);
		$this->fields['discname'] =& $this->discname;
		$this->disc = new cField('trx_booking', 'x_disc', 'disc', "`disc`", 5, -1, FALSE);
		$this->fields['disc'] =& $this->disc;
		$this->notes = new cField('trx_booking', 'x_notes', 'notes', "`notes`", 200, -1, FALSE);
		$this->fields['notes'] =& $this->notes;
		$this->confirmasi = new cField('trx_booking', 'x_confirmasi', 'confirmasi', "`confirmasi`", 2, -1, FALSE);
		$this->fields['confirmasi'] =& $this->confirmasi;
		$this->checkin = new cField('trx_booking', 'x_checkin', 'checkin', "`checkin`", 2, -1, FALSE);
		$this->fields['checkin'] =& $this->checkin;
		$this->createby = new cField('trx_booking', 'x_createby', 'createby', "`createby`", 200, -1, FALSE);
		$this->fields['createby'] =& $this->createby;
		$this->createdate = new cField('trx_booking', 'x_createdate', 'createdate', "`createdate`", 135, 7, FALSE);
		$this->fields['createdate'] =& $this->createdate;
		$this->confirmby = new cField('trx_booking', 'x_confirmby', 'confirmby', "`confirmby`", 200, -1, FALSE);
		$this->fields['confirmby'] =& $this->confirmby;
		$this->confirmdate = new cField('trx_booking', 'x_confirmdate', 'confirmdate', "`confirmdate`", 135, 7, FALSE);
		$this->fields['confirmdate'] =& $this->confirmdate;
		$this->checkinby = new cField('trx_booking', 'x_checkinby', 'checkinby', "`checkinby`", 200, -1, FALSE);
		$this->fields['checkinby'] =& $this->checkinby;
		$this->checkindate = new cField('trx_booking', 'x_checkindate', 'checkindate', "`checkindate`", 135, 7, FALSE);
		$this->fields['checkindate'] =& $this->checkindate;
		$this->rate1 = new cField('trx_booking', 'x_rate1', 'rate1', "`rate1`", 5, -1, FALSE);
		$this->fields['rate1'] =& $this->rate1;
		$this->rate2 = new cField('trx_booking', 'x_rate2', 'rate2', "`rate2`", 5, -1, FALSE);
		$this->fields['rate2'] =& $this->rate2;
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
		return "trx_booking_Highlight";
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
		return "SELECT * FROM `trx_booking`";
	}

	function SqlWhere() { // Where
		return "kode NOT LIKE 'WEBOOK%'";
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
		return "INSERT INTO `trx_booking` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		$SQL = "UPDATE `trx_booking` SET ";
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
		$SQL = "DELETE FROM `trx_booking` WHERE ";
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
			return "trx_bookinglist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// View url
	function ViewUrl() {
		return $this->KeyUrl("trx_bookingview.php", $this->UrlParm());
	}

	// Add url
	function AddUrl() {
		$AddUrl = "trx_bookingadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit url
	function EditUrl() {
		return $this->KeyUrl("trx_bookingedit.php", $this->UrlParm());
	}

	// Inline edit url
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy url
	function CopyUrl() {
		return $this->KeyUrl("trx_bookingadd.php", $this->UrlParm());
	}

	// Inline copy url
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete url
	function DeleteUrl() {
		return $this->KeyUrl("trx_bookingdelete.php", $this->UrlParm());
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=trx_booking" : "";
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
		$this->grup->setDbValue($rs->fields('grup'));
		$this->idseqno->setDbValue($rs->fields('idseqno'));
		$this->tanggal->setDbValue($rs->fields('tanggal'));
		$this->title->setDbValue($rs->fields('title'));
		$this->nama->setDbValue($rs->fields('nama'));
		$this->idtype->setDbValue($rs->fields('idtype'));
		$this->idno->setDbValue($rs->fields('idno'));
		$this->alamat->setDbValue($rs->fields('alamat'));
		$this->phone->setDbValue($rs->fields('phone'));
		$this->zemail->setDbValue($rs->fields('email'));
		$this->company->setDbValue($rs->fields('company'));
		$this->departement->setDbValue($rs->fields('departement'));
		$this->dp->setDbValue($rs->fields('dp'));
		$this->dptype->setDbValue($rs->fields('dptype'));
		$this->room->setDbValue($rs->fields('room'));
		$this->person->setDbValue($rs->fields('person'));
		$this->arrival->setDbValue($rs->fields('arrival'));
		$this->departure->setDbValue($rs->fields('departure'));
		$this->rate->setDbValue($rs->fields('rate'));
		$this->extraperson->setDbValue($rs->fields('extraperson'));
		$this->chargeextraperson->setDbValue($rs->fields('chargeextraperson'));
		$this->discname->setDbValue($rs->fields('discname'));
		$this->disc->setDbValue($rs->fields('disc'));
		$this->notes->setDbValue($rs->fields('notes'));
		$this->confirmasi->setDbValue($rs->fields('confirmasi'));
		$this->checkin->setDbValue($rs->fields('checkin'));
		$this->createby->setDbValue($rs->fields('createby'));
		$this->createdate->setDbValue($rs->fields('createdate'));
		$this->confirmby->setDbValue($rs->fields('confirmby'));
		$this->confirmdate->setDbValue($rs->fields('confirmdate'));
		$this->checkinby->setDbValue($rs->fields('checkinby'));
		$this->checkindate->setDbValue($rs->fields('checkindate'));
		$this->rate1->setDbValue($rs->fields('rate1'));
		$this->rate2->setDbValue($rs->fields('rate2'));
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

		// grup
		$this->grup->ViewValue = $this->grup->CurrentValue;
		$this->grup->CssStyle = "";
		$this->grup->CssClass = "";
		$this->grup->ViewCustomAttributes = "";

		// tanggal
		$this->tanggal->ViewValue = $this->tanggal->CurrentValue;
		$this->tanggal->ViewValue = ew_FormatDateTime($this->tanggal->ViewValue, 7);
		$this->tanggal->CssStyle = "";
		$this->tanggal->CssClass = "";
		$this->tanggal->ViewCustomAttributes = "";

		// title
		if (strval($this->title->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `description` FROM `mst_name_title` WHERE `kode` = '" . ew_AdjustSql($this->title->CurrentValue) . "'";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->title->ViewValue = $rswrk->fields('description');
				$rswrk->Close();
			} else {
				$this->title->ViewValue = $this->title->CurrentValue;
			}
		} else {
			$this->title->ViewValue = NULL;
		}
		$this->title->CssStyle = "";
		$this->title->CssClass = "";
		$this->title->ViewCustomAttributes = "";

		// nama
		$this->nama->ViewValue = $this->nama->CurrentValue;
		$this->nama->CssStyle = "";
		$this->nama->CssClass = "";
		$this->nama->ViewCustomAttributes = "";

		// company
		$this->company->ViewValue = $this->company->CurrentValue;
		$this->company->CssStyle = "";
		$this->company->CssClass = "";
		$this->company->ViewCustomAttributes = "";

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

		// person
		$this->person->ViewValue = $this->person->CurrentValue;
		$this->person->CssStyle = "text-align:right;";
		$this->person->CssClass = "";
		$this->person->ViewCustomAttributes = "";

		// arrival
		$this->arrival->ViewValue = $this->arrival->CurrentValue;
		$this->arrival->ViewValue = ew_FormatDateTime($this->arrival->ViewValue, 7);
		$this->arrival->CssStyle = "";
		$this->arrival->CssClass = "";
		$this->arrival->ViewCustomAttributes = "";

		// departure
		$this->departure->ViewValue = $this->departure->CurrentValue;
		$this->departure->ViewValue = ew_FormatDateTime($this->departure->ViewValue, 7);
		$this->departure->CssStyle = "";
		$this->departure->CssClass = "";
		$this->departure->ViewCustomAttributes = "";

		// discname
		if (strval($this->discname->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `name`, `disc` FROM `mst_discount` WHERE `name` = '" . ew_AdjustSql($this->discname->CurrentValue) . "'";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->discname->ViewValue = $rswrk->fields('name');
				$this->discname->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('disc');
				$rswrk->Close();
			} else {
				$this->discname->ViewValue = $this->discname->CurrentValue;
			}
		} else {
			$this->discname->ViewValue = NULL;
		}
		$this->discname->CssStyle = "";
		$this->discname->CssClass = "";
		$this->discname->ViewCustomAttributes = "";

		// disc
		$this->disc->ViewValue = $this->disc->CurrentValue;
		$this->disc->CssStyle = "";
		$this->disc->CssClass = "";
		$this->disc->ViewCustomAttributes = "";

		// confirmasi
		if (strval($this->confirmasi->CurrentValue) <> "") {
			switch ($this->confirmasi->CurrentValue) {
				case "0":
					$this->confirmasi->ViewValue = "Belum";
					break;
				case "1":
					$this->confirmasi->ViewValue = "Ya";
					break;
				case "2":
					$this->confirmasi->ViewValue = "Batal";
					break;
				default:
					$this->confirmasi->ViewValue = $this->confirmasi->CurrentValue;
			}
		} else {
			$this->confirmasi->ViewValue = NULL;
		}
		$this->confirmasi->CssStyle = "";
		$this->confirmasi->CssClass = "";
		$this->confirmasi->ViewCustomAttributes = "";

		// checkin
		if (strval($this->checkin->CurrentValue) <> "") {
			switch ($this->checkin->CurrentValue) {
				case "0":
					$this->checkin->ViewValue = "No";
					break;
				case "1":
					$this->checkin->ViewValue = "Yes";
					break;
				default:
					$this->checkin->ViewValue = $this->checkin->CurrentValue;
			}
		} else {
			$this->checkin->ViewValue = NULL;
		}
		$this->checkin->CssStyle = "";
		$this->checkin->CssClass = "";
		$this->checkin->ViewCustomAttributes = "";

		// kode
		$this->kode->HrefValue = "";

		// grup
		$this->grup->HrefValue = "";

		// tanggal
		$this->tanggal->HrefValue = "";

		// title
		$this->title->HrefValue = "";

		// nama
		$this->nama->HrefValue = "";

		// company
		$this->company->HrefValue = "";

		// room
		$this->room->HrefValue = "";

		// person
		$this->person->HrefValue = "";

		// arrival
		$this->arrival->HrefValue = "";

		// departure
		$this->departure->HrefValue = "";

		// discname
		$this->discname->HrefValue = "";

		// disc
		$this->disc->HrefValue = "";

		// confirmasi
		$this->confirmasi->HrefValue = "";

		// checkin
		$this->checkin->HrefValue = "";

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
