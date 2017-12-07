<?php

// PHPMaker 6 configuration for Table logistik_transfer_material
$logistik_transfer_material = NULL; // Initialize table object

// Define table class
class clogistik_transfer_material {

	// Define table level constants
	var $TableVar;
	var $TableName;
	var $SelectLimit = FALSE;
	var $actionlink;
	var $transkode;
	var $idseqno;
	var $tanggal;
	var $kode_pekerjaan;
	var $pono;
	var $gudang;
	var $peruntukan;
	var $notes;
	var $ambilby;
	var $ambildate;
	var $beriby;
	var $beridate;
	var $tahuby;
	var $tahudate;
	var $setujuby;
	var $setujudate;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var	$ExportAll = EW_EXPORT_ALL;
	var $SendEmail; // Send Email
	var $TableCustomInnerHtml; // Custom Inner Html

	function clogistik_transfer_material() {
		$this->TableVar = "logistik_transfer_material";
		$this->TableName = "logistik_transfer_material";
		$this->SelectLimit = TRUE;
		$this->actionlink = new cField('logistik_transfer_material', 'x_actionlink', 'actionlink', "`actionlink`", 201, -1, FALSE);
		$this->fields['actionlink'] =& $this->actionlink;
		$this->transkode = new cField('logistik_transfer_material', 'x_transkode', 'transkode', "`transkode`", 200, -1, FALSE);
		$this->fields['transkode'] =& $this->transkode;
		$this->idseqno = new cField('logistik_transfer_material', 'x_idseqno', 'idseqno', "`idseqno`", 3, -1, FALSE);
		$this->fields['idseqno'] =& $this->idseqno;
		$this->tanggal = new cField('logistik_transfer_material', 'x_tanggal', 'tanggal', "`tanggal`", 133, 7, FALSE);
		$this->fields['tanggal'] =& $this->tanggal;
		$this->kode_pekerjaan = new cField('logistik_transfer_material', 'x_kode_pekerjaan', 'kode_pekerjaan', "`kode_pekerjaan`", 200, -1, FALSE);
		$this->fields['kode_pekerjaan'] =& $this->kode_pekerjaan;
		$this->pono = new cField('logistik_transfer_material', 'x_pono', 'pono', "`pono`", 200, -1, FALSE);
		$this->fields['pono'] =& $this->pono;
		$this->gudang = new cField('logistik_transfer_material', 'x_gudang', 'gudang', "`gudang`", 200, -1, FALSE);
		$this->fields['gudang'] =& $this->gudang;
		$this->peruntukan = new cField('logistik_transfer_material', 'x_peruntukan', 'peruntukan', "`peruntukan`", 200, -1, FALSE);
		$this->fields['peruntukan'] =& $this->peruntukan;
		$this->notes = new cField('logistik_transfer_material', 'x_notes', 'notes', "`notes`", 200, -1, FALSE);
		$this->fields['notes'] =& $this->notes;
		$this->ambilby = new cField('logistik_transfer_material', 'x_ambilby', 'ambilby', "`ambilby`", 200, -1, FALSE);
		$this->fields['ambilby'] =& $this->ambilby;
		$this->ambildate = new cField('logistik_transfer_material', 'x_ambildate', 'ambildate', "`ambildate`", 135, 7, FALSE);
		$this->fields['ambildate'] =& $this->ambildate;
		$this->beriby = new cField('logistik_transfer_material', 'x_beriby', 'beriby', "`beriby`", 200, -1, FALSE);
		$this->fields['beriby'] =& $this->beriby;
		$this->beridate = new cField('logistik_transfer_material', 'x_beridate', 'beridate', "`beridate`", 135, 7, FALSE);
		$this->fields['beridate'] =& $this->beridate;
		$this->tahuby = new cField('logistik_transfer_material', 'x_tahuby', 'tahuby', "`tahuby`", 200, -1, FALSE);
		$this->fields['tahuby'] =& $this->tahuby;
		$this->tahudate = new cField('logistik_transfer_material', 'x_tahudate', 'tahudate', "`tahudate`", 135, 7, FALSE);
		$this->fields['tahudate'] =& $this->tahudate;
		$this->setujuby = new cField('logistik_transfer_material', 'x_setujuby', 'setujuby', "`setujuby`", 200, -1, FALSE);
		$this->fields['setujuby'] =& $this->setujuby;
		$this->setujudate = new cField('logistik_transfer_material', 'x_setujudate', 'setujudate', "`setujudate`", 135, 7, FALSE);
		$this->fields['setujudate'] =& $this->setujudate;
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
		return "logistik_transfer_material_Highlight";
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
		return "SELECT * FROM `logistik_transfer_material`";
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
		return "`transkode` DESC";
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
		return "INSERT INTO `logistik_transfer_material` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		$SQL = "UPDATE `logistik_transfer_material` SET ";
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
		$SQL = "DELETE FROM `logistik_transfer_material` WHERE ";
		$SQL .= EW_DB_QUOTE_START . 'transkode' . EW_DB_QUOTE_END . '=' .	ew_QuotedValue($rs['transkode'], $this->transkode->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter for table
	function SqlKeyFilter() {
		return "`transkode` = '@transkode@'";
	}

	// Return Key filter for table
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		$sKeyFilter = str_replace("@transkode@", ew_AdjustSql($this->transkode->CurrentValue), $sKeyFilter); // Replace key value
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
			return "logistik_transfer_materiallist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// View url
	function ViewUrl() {
		return $this->KeyUrl("logistik_transfer_materialview.php", $this->UrlParm());
	}

	// Add url
	function AddUrl() {
		$AddUrl = "logistik_transfer_materialadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit url
	function EditUrl() {
		return $this->KeyUrl("logistik_transfer_materialedit.php", $this->UrlParm());
	}

	// Inline edit url
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy url
	function CopyUrl() {
		return $this->KeyUrl("logistik_transfer_materialadd.php", $this->UrlParm());
	}

	// Inline copy url
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete url
	function DeleteUrl() {
		return $this->KeyUrl("logistik_transfer_materialdelete.php", $this->UrlParm());
	}

	// Key url
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->transkode->CurrentValue)) {
			$sUrl .= "transkode=" . urlencode($this->transkode->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=logistik_transfer_material" : "";
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
		$this->transkode->setDbValue($rs->fields('transkode'));
		$this->idseqno->setDbValue($rs->fields('idseqno'));
		$this->tanggal->setDbValue($rs->fields('tanggal'));
		$this->kode_pekerjaan->setDbValue($rs->fields('kode_pekerjaan'));
		$this->pono->setDbValue($rs->fields('pono'));
		$this->gudang->setDbValue($rs->fields('gudang'));
		$this->peruntukan->setDbValue($rs->fields('peruntukan'));
		$this->notes->setDbValue($rs->fields('notes'));
		$this->ambilby->setDbValue($rs->fields('ambilby'));
		$this->ambildate->setDbValue($rs->fields('ambildate'));
		$this->beriby->setDbValue($rs->fields('beriby'));
		$this->beridate->setDbValue($rs->fields('beridate'));
		$this->tahuby->setDbValue($rs->fields('tahuby'));
		$this->tahudate->setDbValue($rs->fields('tahudate'));
		$this->setujuby->setDbValue($rs->fields('setujuby'));
		$this->setujudate->setDbValue($rs->fields('setujudate'));
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

		// transkode
		$this->transkode->ViewValue = $this->transkode->CurrentValue;
		$this->transkode->CssStyle = "";
		$this->transkode->CssClass = "";
		$this->transkode->ViewCustomAttributes = "";

		// tanggal
		$this->tanggal->ViewValue = $this->tanggal->CurrentValue;
		$this->tanggal->ViewValue = ew_FormatDateTime($this->tanggal->ViewValue, 7);
		$this->tanggal->CssStyle = "";
		$this->tanggal->CssClass = "";
		$this->tanggal->ViewCustomAttributes = "";

		// kode_pekerjaan
		$this->kode_pekerjaan->ViewValue = $this->kode_pekerjaan->CurrentValue;
		$this->kode_pekerjaan->CssStyle = "";
		$this->kode_pekerjaan->CssClass = "";
		$this->kode_pekerjaan->ViewCustomAttributes = "";

		// pono
		$this->pono->ViewValue = $this->pono->CurrentValue;
		$this->pono->CssStyle = "";
		$this->pono->CssClass = "";
		$this->pono->ViewCustomAttributes = "";

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

		// peruntukan
		if (strval($this->peruntukan->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `peruntukan` FROM `mst_peruntukan` WHERE `peruntukan` = '" . ew_AdjustSql($this->peruntukan->CurrentValue) . "'";
			$sSqlWrk .= " ORDER BY `peruntukan` ";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->peruntukan->ViewValue = $rswrk->fields('peruntukan');
				$rswrk->Close();
			} else {
				$this->peruntukan->ViewValue = $this->peruntukan->CurrentValue;
			}
		} else {
			$this->peruntukan->ViewValue = NULL;
		}
		$this->peruntukan->CssStyle = "";
		$this->peruntukan->CssClass = "";
		$this->peruntukan->ViewCustomAttributes = "";

		// ambilby
		if (strval($this->ambilby->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($this->ambilby->CurrentValue) . "'";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->ambilby->ViewValue = $rswrk->fields('nama');
				$rswrk->Close();
			} else {
				$this->ambilby->ViewValue = $this->ambilby->CurrentValue;
			}
		} else {
			$this->ambilby->ViewValue = NULL;
		}
		$this->ambilby->CssStyle = "";
		$this->ambilby->CssClass = "";
		$this->ambilby->ViewCustomAttributes = "";

		// beriby
		if (strval($this->beriby->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($this->beriby->CurrentValue) . "'";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->beriby->ViewValue = $rswrk->fields('nama');
				$rswrk->Close();
			} else {
				$this->beriby->ViewValue = $this->beriby->CurrentValue;
			}
		} else {
			$this->beriby->ViewValue = NULL;
		}
		$this->beriby->CssStyle = "";
		$this->beriby->CssClass = "";
		$this->beriby->ViewCustomAttributes = "";

		// tahuby
		if (strval($this->tahuby->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($this->tahuby->CurrentValue) . "'";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->tahuby->ViewValue = $rswrk->fields('nama');
				$rswrk->Close();
			} else {
				$this->tahuby->ViewValue = $this->tahuby->CurrentValue;
			}
		} else {
			$this->tahuby->ViewValue = NULL;
		}
		$this->tahuby->CssStyle = "";
		$this->tahuby->CssClass = "";
		$this->tahuby->ViewCustomAttributes = "";

		// setujuby
		if (strval($this->setujuby->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($this->setujuby->CurrentValue) . "'";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->setujuby->ViewValue = $rswrk->fields('nama');
				$rswrk->Close();
			} else {
				$this->setujuby->ViewValue = $this->setujuby->CurrentValue;
			}
		} else {
			$this->setujuby->ViewValue = NULL;
		}
		$this->setujuby->CssStyle = "";
		$this->setujuby->CssClass = "";
		$this->setujuby->ViewCustomAttributes = "";

		// actionlink
		$this->actionlink->HrefValue = "";

		// transkode
		$this->transkode->HrefValue = "";

		// tanggal
		$this->tanggal->HrefValue = "";

		// kode_pekerjaan
		$this->kode_pekerjaan->HrefValue = "";

		// pono
		$this->pono->HrefValue = "";

		// gudang
		$this->gudang->HrefValue = "";

		// peruntukan
		$this->peruntukan->HrefValue = "";

		// ambilby
		$this->ambilby->HrefValue = "";

		// beriby
		$this->beriby->HrefValue = "";

		// tahuby
		$this->tahuby->HrefValue = "";

		// setujuby
		$this->setujuby->HrefValue = "";

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
