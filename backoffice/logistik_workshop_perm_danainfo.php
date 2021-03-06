<?php

// PHPMaker 6 configuration for Table logistik_workshop_perm_dana
$logistik_workshop_perm_dana = NULL; // Initialize table object

// Define table class
class clogistik_workshop_perm_dana {

	// Define table level constants
	var $TableVar;
	var $TableName;
	var $SelectLimit = FALSE;
	var $actionlink;
	var $kodepermohonan;
	var $idseqno;
	var $kode_pekerjaan;
	var $partunit;
	var $kodeworkshop;
	var $qrno;
	var $pono;
	var $tanggal;
	var $posting;
	var $lavelansir;
	var $createby;
	var $createdate;
	var $admlogistik;
	var $admlogistikdate;
	var $kalogistik;
	var $kalogistikdate;
	var $kadivumum;
	var $kadivumumdate;
	var $dirut;
	var $dirutdate;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var	$ExportAll = EW_EXPORT_ALL;
	var $SendEmail; // Send Email
	var $TableCustomInnerHtml; // Custom Inner Html

	function clogistik_workshop_perm_dana() {
		$this->TableVar = "logistik_workshop_perm_dana";
		$this->TableName = "logistik_workshop_perm_dana";
		$this->SelectLimit = TRUE;
		$this->actionlink = new cField('logistik_workshop_perm_dana', 'x_actionlink', 'actionlink', "`actionlink`", 201, -1, FALSE);
		$this->fields['actionlink'] =& $this->actionlink;
		$this->kodepermohonan = new cField('logistik_workshop_perm_dana', 'x_kodepermohonan', 'kodepermohonan', "`kodepermohonan`", 200, -1, FALSE);
		$this->fields['kodepermohonan'] =& $this->kodepermohonan;
		$this->idseqno = new cField('logistik_workshop_perm_dana', 'x_idseqno', 'idseqno', "`idseqno`", 3, -1, FALSE);
		$this->fields['idseqno'] =& $this->idseqno;
		$this->kode_pekerjaan = new cField('logistik_workshop_perm_dana', 'x_kode_pekerjaan', 'kode_pekerjaan', "`kode_pekerjaan`", 200, -1, FALSE);
		$this->fields['kode_pekerjaan'] =& $this->kode_pekerjaan;
		$this->partunit = new cField('logistik_workshop_perm_dana', 'x_partunit', 'partunit', "`partunit`", 202, -1, FALSE);
		$this->fields['partunit'] =& $this->partunit;
		$this->kodeworkshop = new cField('logistik_workshop_perm_dana', 'x_kodeworkshop', 'kodeworkshop', "`kodeworkshop`", 200, -1, FALSE);
		$this->fields['kodeworkshop'] =& $this->kodeworkshop;
		$this->qrno = new cField('logistik_workshop_perm_dana', 'x_qrno', 'qrno', "`qrno`", 200, -1, FALSE);
		$this->fields['qrno'] =& $this->qrno;
		$this->pono = new cField('logistik_workshop_perm_dana', 'x_pono', 'pono', "`pono`", 200, -1, FALSE);
		$this->fields['pono'] =& $this->pono;
		$this->tanggal = new cField('logistik_workshop_perm_dana', 'x_tanggal', 'tanggal', "`tanggal`", 133, 7, FALSE);
		$this->fields['tanggal'] =& $this->tanggal;
		$this->posting = new cField('logistik_workshop_perm_dana', 'x_posting', 'posting', "`posting`", 200, -1, FALSE);
		$this->fields['posting'] =& $this->posting;
		$this->lavelansir = new cField('logistik_workshop_perm_dana', 'x_lavelansir', 'lavelansir', "`lavelansir`", 200, -1, FALSE);
		$this->fields['lavelansir'] =& $this->lavelansir;
		$this->createby = new cField('logistik_workshop_perm_dana', 'x_createby', 'createby', "`createby`", 200, -1, FALSE);
		$this->fields['createby'] =& $this->createby;
		$this->createdate = new cField('logistik_workshop_perm_dana', 'x_createdate', 'createdate', "`createdate`", 135, 7, FALSE);
		$this->fields['createdate'] =& $this->createdate;
		$this->admlogistik = new cField('logistik_workshop_perm_dana', 'x_admlogistik', 'admlogistik', "`admlogistik`", 200, -1, FALSE);
		$this->fields['admlogistik'] =& $this->admlogistik;
		$this->admlogistikdate = new cField('logistik_workshop_perm_dana', 'x_admlogistikdate', 'admlogistikdate', "`admlogistikdate`", 135, 7, FALSE);
		$this->fields['admlogistikdate'] =& $this->admlogistikdate;
		$this->kalogistik = new cField('logistik_workshop_perm_dana', 'x_kalogistik', 'kalogistik', "`kalogistik`", 200, -1, FALSE);
		$this->fields['kalogistik'] =& $this->kalogistik;
		$this->kalogistikdate = new cField('logistik_workshop_perm_dana', 'x_kalogistikdate', 'kalogistikdate', "`kalogistikdate`", 135, 7, FALSE);
		$this->fields['kalogistikdate'] =& $this->kalogistikdate;
		$this->kadivumum = new cField('logistik_workshop_perm_dana', 'x_kadivumum', 'kadivumum', "`kadivumum`", 200, -1, FALSE);
		$this->fields['kadivumum'] =& $this->kadivumum;
		$this->kadivumumdate = new cField('logistik_workshop_perm_dana', 'x_kadivumumdate', 'kadivumumdate', "`kadivumumdate`", 135, 7, FALSE);
		$this->fields['kadivumumdate'] =& $this->kadivumumdate;
		$this->dirut = new cField('logistik_workshop_perm_dana', 'x_dirut', 'dirut', "`dirut`", 200, -1, FALSE);
		$this->fields['dirut'] =& $this->dirut;
		$this->dirutdate = new cField('logistik_workshop_perm_dana', 'x_dirutdate', 'dirutdate', "`dirutdate`", 135, 7, FALSE);
		$this->fields['dirutdate'] =& $this->dirutdate;
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
		return "logistik_workshop_perm_dana_Highlight";
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
		return "SELECT * FROM `logistik_workshop_perm_dana`";
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
		return "`kodepermohonan` DESC";
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
		return "INSERT INTO `logistik_workshop_perm_dana` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		$SQL = "UPDATE `logistik_workshop_perm_dana` SET ";
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
		$SQL = "DELETE FROM `logistik_workshop_perm_dana` WHERE ";
		$SQL .= EW_DB_QUOTE_START . 'kodepermohonan' . EW_DB_QUOTE_END . '=' .	ew_QuotedValue($rs['kodepermohonan'], $this->kodepermohonan->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter for table
	function SqlKeyFilter() {
		return "`kodepermohonan` = '@kodepermohonan@'";
	}

	// Return Key filter for table
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		$sKeyFilter = str_replace("@kodepermohonan@", ew_AdjustSql($this->kodepermohonan->CurrentValue), $sKeyFilter); // Replace key value
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
			return "logistik_workshop_perm_danalist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// View url
	function ViewUrl() {
		return $this->KeyUrl("logistik_workshop_perm_danaview.php", $this->UrlParm());
	}

	// Add url
	function AddUrl() {
		$AddUrl = "logistik_workshop_perm_danaadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit url
	function EditUrl() {
		return $this->KeyUrl("logistik_workshop_perm_danaedit.php", $this->UrlParm());
	}

	// Inline edit url
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy url
	function CopyUrl() {
		return $this->KeyUrl("logistik_workshop_perm_danaadd.php", $this->UrlParm());
	}

	// Inline copy url
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete url
	function DeleteUrl() {
		return $this->KeyUrl("logistik_workshop_perm_danadelete.php", $this->UrlParm());
	}

	// Key url
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->kodepermohonan->CurrentValue)) {
			$sUrl .= "kodepermohonan=" . urlencode($this->kodepermohonan->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=logistik_workshop_perm_dana" : "";
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
		$this->kodepermohonan->setDbValue($rs->fields('kodepermohonan'));
		$this->idseqno->setDbValue($rs->fields('idseqno'));
		$this->kode_pekerjaan->setDbValue($rs->fields('kode_pekerjaan'));
		$this->partunit->setDbValue($rs->fields('partunit'));
		$this->kodeworkshop->setDbValue($rs->fields('kodeworkshop'));
		$this->qrno->setDbValue($rs->fields('qrno'));
		$this->pono->setDbValue($rs->fields('pono'));
		$this->tanggal->setDbValue($rs->fields('tanggal'));
		$this->posting->setDbValue($rs->fields('posting'));
		$this->lavelansir->setDbValue($rs->fields('lavelansir'));
		$this->createby->setDbValue($rs->fields('createby'));
		$this->createdate->setDbValue($rs->fields('createdate'));
		$this->admlogistik->setDbValue($rs->fields('admlogistik'));
		$this->admlogistikdate->setDbValue($rs->fields('admlogistikdate'));
		$this->kalogistik->setDbValue($rs->fields('kalogistik'));
		$this->kalogistikdate->setDbValue($rs->fields('kalogistikdate'));
		$this->kadivumum->setDbValue($rs->fields('kadivumum'));
		$this->kadivumumdate->setDbValue($rs->fields('kadivumumdate'));
		$this->dirut->setDbValue($rs->fields('dirut'));
		$this->dirutdate->setDbValue($rs->fields('dirutdate'));
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

		// kodepermohonan
		$this->kodepermohonan->ViewValue = $this->kodepermohonan->CurrentValue;
		$this->kodepermohonan->CssStyle = "";
		$this->kodepermohonan->CssClass = "";
		$this->kodepermohonan->ViewCustomAttributes = "";

		// kode_pekerjaan
		$this->kode_pekerjaan->ViewValue = $this->kode_pekerjaan->CurrentValue;
		$this->kode_pekerjaan->CssStyle = "";
		$this->kode_pekerjaan->CssClass = "";
		$this->kode_pekerjaan->ViewCustomAttributes = "";

		// partunit
		if (strval($this->partunit->CurrentValue) <> "") {
			switch ($this->partunit->CurrentValue) {
				case "part":
					$this->partunit->ViewValue = "Part";
					break;
				case "unit":
					$this->partunit->ViewValue = "Unit";
					break;
				default:
					$this->partunit->ViewValue = $this->partunit->CurrentValue;
			}
		} else {
			$this->partunit->ViewValue = NULL;
		}
		$this->partunit->CssStyle = "";
		$this->partunit->CssClass = "";
		$this->partunit->ViewCustomAttributes = "";

		// qrno
		$this->qrno->ViewValue = $this->qrno->CurrentValue;
		$this->qrno->CssStyle = "";
		$this->qrno->CssClass = "";
		$this->qrno->ViewCustomAttributes = "";

		// tanggal
		$this->tanggal->ViewValue = $this->tanggal->CurrentValue;
		$this->tanggal->ViewValue = ew_FormatDateTime($this->tanggal->ViewValue, 7);
		$this->tanggal->CssStyle = "";
		$this->tanggal->CssClass = "";
		$this->tanggal->ViewCustomAttributes = "";

		// posting
		$this->posting->ViewValue = $this->posting->CurrentValue;
		$this->posting->CssStyle = "";
		$this->posting->CssClass = "";
		$this->posting->ViewCustomAttributes = "";

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

		// admlogistik
		if (strval($this->admlogistik->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($this->admlogistik->CurrentValue) . "'";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->admlogistik->ViewValue = $rswrk->fields('nama');
				$rswrk->Close();
			} else {
				$this->admlogistik->ViewValue = $this->admlogistik->CurrentValue;
			}
		} else {
			$this->admlogistik->ViewValue = NULL;
		}
		$this->admlogistik->CssStyle = "";
		$this->admlogistik->CssClass = "";
		$this->admlogistik->ViewCustomAttributes = "";

		// kalogistik
		if (strval($this->kalogistik->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($this->kalogistik->CurrentValue) . "'";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->kalogistik->ViewValue = $rswrk->fields('nama');
				$rswrk->Close();
			} else {
				$this->kalogistik->ViewValue = $this->kalogistik->CurrentValue;
			}
		} else {
			$this->kalogistik->ViewValue = NULL;
		}
		$this->kalogistik->CssStyle = "";
		$this->kalogistik->CssClass = "";
		$this->kalogistik->ViewCustomAttributes = "";

		// kadivumum
		if (strval($this->kadivumum->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($this->kadivumum->CurrentValue) . "'";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->kadivumum->ViewValue = $rswrk->fields('nama');
				$rswrk->Close();
			} else {
				$this->kadivumum->ViewValue = $this->kadivumum->CurrentValue;
			}
		} else {
			$this->kadivumum->ViewValue = NULL;
		}
		$this->kadivumum->CssStyle = "";
		$this->kadivumum->CssClass = "";
		$this->kadivumum->ViewCustomAttributes = "";

		// dirut
		if (strval($this->dirut->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($this->dirut->CurrentValue) . "'";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->dirut->ViewValue = $rswrk->fields('nama');
				$rswrk->Close();
			} else {
				$this->dirut->ViewValue = $this->dirut->CurrentValue;
			}
		} else {
			$this->dirut->ViewValue = NULL;
		}
		$this->dirut->CssStyle = "";
		$this->dirut->CssClass = "";
		$this->dirut->ViewCustomAttributes = "";

		// actionlink
		$this->actionlink->HrefValue = "";

		// kodepermohonan
		$this->kodepermohonan->HrefValue = "";

		// kode_pekerjaan
		$this->kode_pekerjaan->HrefValue = "";

		// partunit
		$this->partunit->HrefValue = "";

		// qrno
		$this->qrno->HrefValue = "";

		// tanggal
		$this->tanggal->HrefValue = "";

		// posting
		$this->posting->HrefValue = "";

		// createby
		$this->createby->HrefValue = "";

		// admlogistik
		$this->admlogistik->HrefValue = "";

		// kalogistik
		$this->kalogistik->HrefValue = "";

		// kadivumum
		$this->kadivumum->HrefValue = "";

		// dirut
		$this->dirut->HrefValue = "";

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
