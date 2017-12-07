<?php

// PHPMaker 6 configuration for Table logistik_receive_material
$logistik_receive_material = NULL; // Initialize table object

// Define table class
class clogistik_receive_material {

	// Define table level constants
	var $TableVar;
	var $TableName;
	var $SelectLimit = FALSE;
	var $actionlink;
	var $recvkode;
	var $idseqno;
	var $tanggal;
	var $kode_pekerjaan;
	var $vendorid;
	var $gudang;
	var $pono;
	var $notes;
	var $recvby;
	var $recvdate;
	var $periksaby;
	var $periksadate;
	var $tahuby;
	var $tahudate;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var	$ExportAll = EW_EXPORT_ALL;
	var $SendEmail; // Send Email
	var $TableCustomInnerHtml; // Custom Inner Html

	function clogistik_receive_material() {
		$this->TableVar = "logistik_receive_material";
		$this->TableName = "logistik_receive_material";
		$this->SelectLimit = TRUE;
		$this->actionlink = new cField('logistik_receive_material', 'x_actionlink', 'actionlink', "`actionlink`", 201, -1, FALSE);
		$this->fields['actionlink'] =& $this->actionlink;
		$this->recvkode = new cField('logistik_receive_material', 'x_recvkode', 'recvkode', "`recvkode`", 200, -1, FALSE);
		$this->fields['recvkode'] =& $this->recvkode;
		$this->idseqno = new cField('logistik_receive_material', 'x_idseqno', 'idseqno', "`idseqno`", 3, -1, FALSE);
		$this->fields['idseqno'] =& $this->idseqno;
		$this->tanggal = new cField('logistik_receive_material', 'x_tanggal', 'tanggal', "`tanggal`", 133, 7, FALSE);
		$this->fields['tanggal'] =& $this->tanggal;
		$this->kode_pekerjaan = new cField('logistik_receive_material', 'x_kode_pekerjaan', 'kode_pekerjaan', "`kode_pekerjaan`", 200, -1, FALSE);
		$this->fields['kode_pekerjaan'] =& $this->kode_pekerjaan;
		$this->vendorid = new cField('logistik_receive_material', 'x_vendorid', 'vendorid', "`vendorid`", 200, -1, FALSE);
		$this->fields['vendorid'] =& $this->vendorid;
		$this->gudang = new cField('logistik_receive_material', 'x_gudang', 'gudang', "`gudang`", 200, -1, FALSE);
		$this->fields['gudang'] =& $this->gudang;
		$this->pono = new cField('logistik_receive_material', 'x_pono', 'pono', "`pono`", 200, -1, FALSE);
		$this->fields['pono'] =& $this->pono;
		$this->notes = new cField('logistik_receive_material', 'x_notes', 'notes', "`notes`", 200, -1, FALSE);
		$this->fields['notes'] =& $this->notes;
		$this->recvby = new cField('logistik_receive_material', 'x_recvby', 'recvby', "`recvby`", 200, -1, FALSE);
		$this->fields['recvby'] =& $this->recvby;
		$this->recvdate = new cField('logistik_receive_material', 'x_recvdate', 'recvdate', "`recvdate`", 135, 7, FALSE);
		$this->fields['recvdate'] =& $this->recvdate;
		$this->periksaby = new cField('logistik_receive_material', 'x_periksaby', 'periksaby', "`periksaby`", 200, -1, FALSE);
		$this->fields['periksaby'] =& $this->periksaby;
		$this->periksadate = new cField('logistik_receive_material', 'x_periksadate', 'periksadate', "`periksadate`", 135, 7, FALSE);
		$this->fields['periksadate'] =& $this->periksadate;
		$this->tahuby = new cField('logistik_receive_material', 'x_tahuby', 'tahuby', "`tahuby`", 200, -1, FALSE);
		$this->fields['tahuby'] =& $this->tahuby;
		$this->tahudate = new cField('logistik_receive_material', 'x_tahudate', 'tahudate', "`tahudate`", 135, 7, FALSE);
		$this->fields['tahudate'] =& $this->tahudate;
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
		return "logistik_receive_material_Highlight";
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
		return "SELECT * FROM `logistik_receive_material`";
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
		return "`recvkode` DESC";
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
		return "INSERT INTO `logistik_receive_material` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		$SQL = "UPDATE `logistik_receive_material` SET ";
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
		$SQL = "DELETE FROM `logistik_receive_material` WHERE ";
		$SQL .= EW_DB_QUOTE_START . 'recvkode' . EW_DB_QUOTE_END . '=' .	ew_QuotedValue($rs['recvkode'], $this->recvkode->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter for table
	function SqlKeyFilter() {
		return "`recvkode` = '@recvkode@'";
	}

	// Return Key filter for table
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		$sKeyFilter = str_replace("@recvkode@", ew_AdjustSql($this->recvkode->CurrentValue), $sKeyFilter); // Replace key value
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
			return "logistik_receive_materiallist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// View url
	function ViewUrl() {
		return $this->KeyUrl("logistik_receive_materialview.php", $this->UrlParm());
	}

	// Add url
	function AddUrl() {
		$AddUrl = "logistik_receive_materialadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit url
	function EditUrl() {
		return $this->KeyUrl("logistik_receive_materialedit.php", $this->UrlParm());
	}

	// Inline edit url
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy url
	function CopyUrl() {
		return $this->KeyUrl("logistik_receive_materialadd.php", $this->UrlParm());
	}

	// Inline copy url
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete url
	function DeleteUrl() {
		return $this->KeyUrl("logistik_receive_materialdelete.php", $this->UrlParm());
	}

	// Key url
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->recvkode->CurrentValue)) {
			$sUrl .= "recvkode=" . urlencode($this->recvkode->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=logistik_receive_material" : "";
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
		$this->recvkode->setDbValue($rs->fields('recvkode'));
		$this->idseqno->setDbValue($rs->fields('idseqno'));
		$this->tanggal->setDbValue($rs->fields('tanggal'));
		$this->kode_pekerjaan->setDbValue($rs->fields('kode_pekerjaan'));
		$this->vendorid->setDbValue($rs->fields('vendorid'));
		$this->gudang->setDbValue($rs->fields('gudang'));
		$this->pono->setDbValue($rs->fields('pono'));
		$this->notes->setDbValue($rs->fields('notes'));
		$this->recvby->setDbValue($rs->fields('recvby'));
		$this->recvdate->setDbValue($rs->fields('recvdate'));
		$this->periksaby->setDbValue($rs->fields('periksaby'));
		$this->periksadate->setDbValue($rs->fields('periksadate'));
		$this->tahuby->setDbValue($rs->fields('tahuby'));
		$this->tahudate->setDbValue($rs->fields('tahudate'));
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

		// recvkode
		$this->recvkode->ViewValue = $this->recvkode->CurrentValue;
		$this->recvkode->CssStyle = "";
		$this->recvkode->CssClass = "";
		$this->recvkode->ViewCustomAttributes = "";

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

		// vendorid
		if (strval($this->vendorid->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nama` FROM `mst_vendor` WHERE `kode` = '" . ew_AdjustSql($this->vendorid->CurrentValue) . "'";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->vendorid->ViewValue = $rswrk->fields('nama');
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

		// pono
		$this->pono->ViewValue = $this->pono->CurrentValue;
		$this->pono->CssStyle = "";
		$this->pono->CssClass = "";
		$this->pono->ViewCustomAttributes = "";

		// recvby
		if (strval($this->recvby->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($this->recvby->CurrentValue) . "'";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->recvby->ViewValue = $rswrk->fields('nama');
				$rswrk->Close();
			} else {
				$this->recvby->ViewValue = $this->recvby->CurrentValue;
			}
		} else {
			$this->recvby->ViewValue = NULL;
		}
		$this->recvby->CssStyle = "";
		$this->recvby->CssClass = "";
		$this->recvby->ViewCustomAttributes = "";

		// periksaby
		if (strval($this->periksaby->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `nama` FROM `user_account` WHERE `username` = '" . ew_AdjustSql($this->periksaby->CurrentValue) . "'";
			$sSqlWrk .= " ORDER BY `nama` ";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->periksaby->ViewValue = $rswrk->fields('nama');
				$rswrk->Close();
			} else {
				$this->periksaby->ViewValue = $this->periksaby->CurrentValue;
			}
		} else {
			$this->periksaby->ViewValue = NULL;
		}
		$this->periksaby->CssStyle = "";
		$this->periksaby->CssClass = "";
		$this->periksaby->ViewCustomAttributes = "";

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

		// actionlink
		$this->actionlink->HrefValue = "";

		// recvkode
		$this->recvkode->HrefValue = "";

		// tanggal
		$this->tanggal->HrefValue = "";

		// kode_pekerjaan
		$this->kode_pekerjaan->HrefValue = "";

		// vendorid
		$this->vendorid->HrefValue = "";

		// gudang
		$this->gudang->HrefValue = "";

		// pono
		$this->pono->HrefValue = "";

		// recvby
		$this->recvby->HrefValue = "";

		// periksaby
		$this->periksaby->HrefValue = "";

		// tahuby
		$this->tahuby->HrefValue = "";

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
