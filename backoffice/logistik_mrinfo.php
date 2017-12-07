<?php

// PHPMaker 6 configuration for Table logistik_mr
$logistik_mr = NULL; // Initialize table object

// Define table class
class clogistik_mr {

	// Define table level constants
	var $TableVar;
	var $TableName;
	var $SelectLimit = FALSE;
	var $actionlink;
	var $mrno;
	var $idseqno;
	var $kode_pekerjaan;
	var $tanggal;
	var $periode;
	var $peruntukan;
	var $gudang;
	var $notes;
	var $createby;
	var $createdate;
	var $kadivkonstruksi;
	var $kadivkonstruksidate;
	var $qqc;
	var $qqcdate;
	var $kalogistik;
	var $kalogistikdate;
	var $sitemgr;
	var $sitemgrdate;
	var $sitelogistik;
	var $sitelogistikdate;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var	$ExportAll = EW_EXPORT_ALL;
	var $SendEmail; // Send Email
	var $TableCustomInnerHtml; // Custom Inner Html

	function clogistik_mr() {
		$this->TableVar = "logistik_mr";
		$this->TableName = "logistik_mr";
		$this->SelectLimit = TRUE;
		$this->actionlink = new cField('logistik_mr', 'x_actionlink', 'actionlink', "`actionlink`", 201, -1, FALSE);
		$this->fields['actionlink'] =& $this->actionlink;
		$this->mrno = new cField('logistik_mr', 'x_mrno', 'mrno', "`mrno`", 200, -1, FALSE);
		$this->fields['mrno'] =& $this->mrno;
		$this->idseqno = new cField('logistik_mr', 'x_idseqno', 'idseqno', "`idseqno`", 3, -1, FALSE);
		$this->fields['idseqno'] =& $this->idseqno;
		$this->kode_pekerjaan = new cField('logistik_mr', 'x_kode_pekerjaan', 'kode_pekerjaan', "`kode_pekerjaan`", 200, -1, FALSE);
		$this->fields['kode_pekerjaan'] =& $this->kode_pekerjaan;
		$this->tanggal = new cField('logistik_mr', 'x_tanggal', 'tanggal', "`tanggal`", 133, 7, FALSE);
		$this->fields['tanggal'] =& $this->tanggal;
		$this->periode = new cField('logistik_mr', 'x_periode', 'periode', "`periode`", 133, 7, FALSE);
		$this->fields['periode'] =& $this->periode;
		$this->peruntukan = new cField('logistik_mr', 'x_peruntukan', 'peruntukan', "`peruntukan`", 200, -1, FALSE);
		$this->fields['peruntukan'] =& $this->peruntukan;
		$this->gudang = new cField('logistik_mr', 'x_gudang', 'gudang', "`gudang`", 200, -1, FALSE);
		$this->fields['gudang'] =& $this->gudang;
		$this->notes = new cField('logistik_mr', 'x_notes', 'notes', "`notes`", 200, -1, FALSE);
		$this->fields['notes'] =& $this->notes;
		$this->createby = new cField('logistik_mr', 'x_createby', 'createby', "`createby`", 200, -1, FALSE);
		$this->fields['createby'] =& $this->createby;
		$this->createdate = new cField('logistik_mr', 'x_createdate', 'createdate', "`createdate`", 135, 7, FALSE);
		$this->fields['createdate'] =& $this->createdate;
		$this->kadivkonstruksi = new cField('logistik_mr', 'x_kadivkonstruksi', 'kadivkonstruksi', "`kadivkonstruksi`", 200, -1, FALSE);
		$this->fields['kadivkonstruksi'] =& $this->kadivkonstruksi;
		$this->kadivkonstruksidate = new cField('logistik_mr', 'x_kadivkonstruksidate', 'kadivkonstruksidate', "`kadivkonstruksidate`", 135, 7, FALSE);
		$this->fields['kadivkonstruksidate'] =& $this->kadivkonstruksidate;
		$this->qqc = new cField('logistik_mr', 'x_qqc', 'qqc', "`qqc`", 200, -1, FALSE);
		$this->fields['qqc'] =& $this->qqc;
		$this->qqcdate = new cField('logistik_mr', 'x_qqcdate', 'qqcdate', "`qqcdate`", 135, 7, FALSE);
		$this->fields['qqcdate'] =& $this->qqcdate;
		$this->kalogistik = new cField('logistik_mr', 'x_kalogistik', 'kalogistik', "`kalogistik`", 200, -1, FALSE);
		$this->fields['kalogistik'] =& $this->kalogistik;
		$this->kalogistikdate = new cField('logistik_mr', 'x_kalogistikdate', 'kalogistikdate', "`kalogistikdate`", 135, 7, FALSE);
		$this->fields['kalogistikdate'] =& $this->kalogistikdate;
		$this->sitemgr = new cField('logistik_mr', 'x_sitemgr', 'sitemgr', "`sitemgr`", 200, -1, FALSE);
		$this->fields['sitemgr'] =& $this->sitemgr;
		$this->sitemgrdate = new cField('logistik_mr', 'x_sitemgrdate', 'sitemgrdate', "`sitemgrdate`", 135, 7, FALSE);
		$this->fields['sitemgrdate'] =& $this->sitemgrdate;
		$this->sitelogistik = new cField('logistik_mr', 'x_sitelogistik', 'sitelogistik', "`sitelogistik`", 200, -1, FALSE);
		$this->fields['sitelogistik'] =& $this->sitelogistik;
		$this->sitelogistikdate = new cField('logistik_mr', 'x_sitelogistikdate', 'sitelogistikdate', "`sitelogistikdate`", 135, 7, FALSE);
		$this->fields['sitelogistikdate'] =& $this->sitelogistikdate;
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
		return "logistik_mr_Highlight";
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
		return "SELECT * FROM `logistik_mr`";
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
		return "`mrno` DESC";
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
		return "INSERT INTO `logistik_mr` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		$SQL = "UPDATE `logistik_mr` SET ";
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
		$SQL = "DELETE FROM `logistik_mr` WHERE ";
		$SQL .= EW_DB_QUOTE_START . 'mrno' . EW_DB_QUOTE_END . '=' .	ew_QuotedValue($rs['mrno'], $this->mrno->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter for table
	function SqlKeyFilter() {
		return "`mrno` = '@mrno@'";
	}

	// Return Key filter for table
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		$sKeyFilter = str_replace("@mrno@", ew_AdjustSql($this->mrno->CurrentValue), $sKeyFilter); // Replace key value
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
			return "logistik_mrlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// View url
	function ViewUrl() {
		return $this->KeyUrl("logistik_mrview.php", $this->UrlParm());
	}

	// Add url
	function AddUrl() {
		$AddUrl = "logistik_mradd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit url
	function EditUrl() {
		return $this->KeyUrl("logistik_mredit.php", $this->UrlParm());
	}

	// Inline edit url
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy url
	function CopyUrl() {
		return $this->KeyUrl("logistik_mradd.php", $this->UrlParm());
	}

	// Inline copy url
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete url
	function DeleteUrl() {
		return $this->KeyUrl("logistik_mrdelete.php", $this->UrlParm());
	}

	// Key url
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->mrno->CurrentValue)) {
			$sUrl .= "mrno=" . urlencode($this->mrno->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=logistik_mr" : "";
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
		$this->mrno->setDbValue($rs->fields('mrno'));
		$this->idseqno->setDbValue($rs->fields('idseqno'));
		$this->kode_pekerjaan->setDbValue($rs->fields('kode_pekerjaan'));
		$this->tanggal->setDbValue($rs->fields('tanggal'));
		$this->periode->setDbValue($rs->fields('periode'));
		$this->peruntukan->setDbValue($rs->fields('peruntukan'));
		$this->gudang->setDbValue($rs->fields('gudang'));
		$this->notes->setDbValue($rs->fields('notes'));
		$this->createby->setDbValue($rs->fields('createby'));
		$this->createdate->setDbValue($rs->fields('createdate'));
		$this->kadivkonstruksi->setDbValue($rs->fields('kadivkonstruksi'));
		$this->kadivkonstruksidate->setDbValue($rs->fields('kadivkonstruksidate'));
		$this->qqc->setDbValue($rs->fields('qqc'));
		$this->qqcdate->setDbValue($rs->fields('qqcdate'));
		$this->kalogistik->setDbValue($rs->fields('kalogistik'));
		$this->kalogistikdate->setDbValue($rs->fields('kalogistikdate'));
		$this->sitemgr->setDbValue($rs->fields('sitemgr'));
		$this->sitemgrdate->setDbValue($rs->fields('sitemgrdate'));
		$this->sitelogistik->setDbValue($rs->fields('sitelogistik'));
		$this->sitelogistikdate->setDbValue($rs->fields('sitelogistikdate'));
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

		// mrno
		$this->mrno->ViewValue = $this->mrno->CurrentValue;
		$this->mrno->CssStyle = "";
		$this->mrno->CssClass = "";
		$this->mrno->ViewCustomAttributes = "";

		// kode_pekerjaan
		$this->kode_pekerjaan->ViewValue = $this->kode_pekerjaan->CurrentValue;
		$this->kode_pekerjaan->CssStyle = "";
		$this->kode_pekerjaan->CssClass = "";
		$this->kode_pekerjaan->ViewCustomAttributes = "";

		// tanggal
		$this->tanggal->ViewValue = $this->tanggal->CurrentValue;
		$this->tanggal->ViewValue = ew_FormatDateTime($this->tanggal->ViewValue, 7);
		$this->tanggal->CssStyle = "";
		$this->tanggal->CssClass = "";
		$this->tanggal->ViewCustomAttributes = "";

		// periode
		$this->periode->ViewValue = $this->periode->CurrentValue;
		$this->periode->ViewValue = ew_FormatDateTime($this->periode->ViewValue, 7);
		$this->periode->CssStyle = "";
		$this->periode->CssClass = "";
		$this->periode->ViewCustomAttributes = "";

		// gudang
		if (strval($this->gudang->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nama`, `alamat` FROM `mst_gudang` WHERE `kode` = '" . ew_AdjustSql($this->gudang->CurrentValue) . "'";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->gudang->ViewValue = $rswrk->fields('nama');
				$this->gudang->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('alamat');
				$rswrk->Close();
			} else {
				$this->gudang->ViewValue = $this->gudang->CurrentValue;
			}
		} else {
			$this->gudang->ViewValue = NULL;
		}
		$this->gudang->CssStyle = "";
		$this->gudang->CssClass = "";
		$this->gudang->ViewCustomAttributes = "";

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

		// kadivkonstruksi
		if (strval($this->kadivkonstruksi->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($this->kadivkonstruksi->CurrentValue) . "'";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->kadivkonstruksi->ViewValue = $rswrk->fields('nama');
				$rswrk->Close();
			} else {
				$this->kadivkonstruksi->ViewValue = $this->kadivkonstruksi->CurrentValue;
			}
		} else {
			$this->kadivkonstruksi->ViewValue = NULL;
		}
		$this->kadivkonstruksi->CssStyle = "";
		$this->kadivkonstruksi->CssClass = "";
		$this->kadivkonstruksi->ViewCustomAttributes = "";

		// qqc
		if (strval($this->qqc->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($this->qqc->CurrentValue) . "'";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->qqc->ViewValue = $rswrk->fields('nama');
				$rswrk->Close();
			} else {
				$this->qqc->ViewValue = $this->qqc->CurrentValue;
			}
		} else {
			$this->qqc->ViewValue = NULL;
		}
		$this->qqc->CssStyle = "";
		$this->qqc->CssClass = "";
		$this->qqc->ViewCustomAttributes = "";

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

		// sitemgr
		if (strval($this->sitemgr->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($this->sitemgr->CurrentValue) . "'";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->sitemgr->ViewValue = $rswrk->fields('nama');
				$rswrk->Close();
			} else {
				$this->sitemgr->ViewValue = $this->sitemgr->CurrentValue;
			}
		} else {
			$this->sitemgr->ViewValue = NULL;
		}
		$this->sitemgr->CssStyle = "";
		$this->sitemgr->CssClass = "";
		$this->sitemgr->ViewCustomAttributes = "";

		// sitelogistik
		if (strval($this->sitelogistik->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($this->sitelogistik->CurrentValue) . "'";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->sitelogistik->ViewValue = $rswrk->fields('nama');
				$rswrk->Close();
			} else {
				$this->sitelogistik->ViewValue = $this->sitelogistik->CurrentValue;
			}
		} else {
			$this->sitelogistik->ViewValue = NULL;
		}
		$this->sitelogistik->CssStyle = "";
		$this->sitelogistik->CssClass = "";
		$this->sitelogistik->ViewCustomAttributes = "";

		// actionlink
		$this->actionlink->HrefValue = "";

		// mrno
		$this->mrno->HrefValue = "";

		// kode_pekerjaan
		$this->kode_pekerjaan->HrefValue = "";

		// tanggal
		$this->tanggal->HrefValue = "";

		// periode
		$this->periode->HrefValue = "";

		// gudang
		$this->gudang->HrefValue = "";

		// createby
		$this->createby->HrefValue = "";

		// kadivkonstruksi
		$this->kadivkonstruksi->HrefValue = "";

		// qqc
		$this->qqc->HrefValue = "";

		// kalogistik
		$this->kalogistik->HrefValue = "";

		// sitemgr
		$this->sitemgr->HrefValue = "";

		// sitelogistik
		$this->sitelogistik->HrefValue = "";

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
