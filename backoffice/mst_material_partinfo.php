<?php

// PHPMaker 6 configuration for Table mst_material_part
$mst_material_part = NULL; // Initialize table object

// Define table class
class cmst_material_part {

	// Define table level constants
	var $TableVar;
	var $TableName;
	var $SelectLimit = FALSE;
	var $kode;
	var $modepart;
	var $pn;
	var $category;
	var $modelunit;
	var $nama;
	var $satuan;
	var $keterangan;
	var $coa;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var	$ExportAll = EW_EXPORT_ALL;
	var $SendEmail; // Send Email
	var $TableCustomInnerHtml; // Custom Inner Html

	function cmst_material_part() {
		$this->TableVar = "mst_material_part";
		$this->TableName = "mst_material_part";
		$this->SelectLimit = TRUE;
		$this->kode = new cField('mst_material_part', 'x_kode', 'kode', "`kode`", 200, -1, FALSE);
		$this->fields['kode'] =& $this->kode;
		$this->modepart = new cField('mst_material_part', 'x_modepart', 'modepart', "`modepart`", 200, -1, FALSE);
		$this->fields['modepart'] =& $this->modepart;
		$this->pn = new cField('mst_material_part', 'x_pn', 'pn', "`pn`", 200, -1, FALSE);
		$this->fields['pn'] =& $this->pn;
		$this->category = new cField('mst_material_part', 'x_category', 'category', "`category`", 200, -1, FALSE);
		$this->fields['category'] =& $this->category;
		$this->modelunit = new cField('mst_material_part', 'x_modelunit', 'modelunit', "`modelunit`", 200, -1, FALSE);
		$this->fields['modelunit'] =& $this->modelunit;
		$this->nama = new cField('mst_material_part', 'x_nama', 'nama', "`nama`", 200, -1, FALSE);
		$this->fields['nama'] =& $this->nama;
		$this->satuan = new cField('mst_material_part', 'x_satuan', 'satuan', "`satuan`", 200, -1, FALSE);
		$this->fields['satuan'] =& $this->satuan;
		$this->keterangan = new cField('mst_material_part', 'x_keterangan', 'keterangan', "`keterangan`", 200, -1, FALSE);
		$this->fields['keterangan'] =& $this->keterangan;
		$this->coa = new cField('mst_material_part', 'x_coa', 'coa', "`coa`", 200, -1, FALSE);
		$this->fields['coa'] =& $this->coa;
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
		return "mst_material_part_Highlight";
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
		return "SELECT * FROM `mst_material_part`";
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
		return "INSERT INTO `mst_material_part` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		$SQL = "UPDATE `mst_material_part` SET ";
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
		$SQL = "DELETE FROM `mst_material_part` WHERE ";
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
			return "mst_material_partlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// View url
	function ViewUrl() {
		return $this->KeyUrl("mst_material_partview.php", $this->UrlParm());
	}

	// Add url
	function AddUrl() {
		$AddUrl = "mst_material_partadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit url
	function EditUrl() {
		return $this->KeyUrl("mst_material_partedit.php", $this->UrlParm());
	}

	// Inline edit url
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy url
	function CopyUrl() {
		return $this->KeyUrl("mst_material_partadd.php", $this->UrlParm());
	}

	// Inline copy url
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete url
	function DeleteUrl() {
		return $this->KeyUrl("mst_material_partdelete.php", $this->UrlParm());
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=mst_material_part" : "";
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
		$this->modepart->setDbValue($rs->fields('modepart'));
		$this->pn->setDbValue($rs->fields('pn'));
		$this->category->setDbValue($rs->fields('category'));
		$this->modelunit->setDbValue($rs->fields('modelunit'));
		$this->nama->setDbValue($rs->fields('nama'));
		$this->satuan->setDbValue($rs->fields('satuan'));
		$this->keterangan->setDbValue($rs->fields('keterangan'));
		$this->coa->setDbValue($rs->fields('coa'));
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

		// pn
		$this->pn->ViewValue = $this->pn->CurrentValue;
		$this->pn->CssStyle = "";
		$this->pn->CssClass = "";
		$this->pn->ViewCustomAttributes = "";

		// category
		if (strval($this->category->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `description` FROM `mst_material_cat` WHERE `id` = '" . ew_AdjustSql($this->category->CurrentValue) . "'";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->category->ViewValue = $rswrk->fields('description');
				$rswrk->Close();
			} else {
				$this->category->ViewValue = $this->category->CurrentValue;
			}
		} else {
			$this->category->ViewValue = NULL;
		}
		$this->category->CssStyle = "";
		$this->category->CssClass = "";
		$this->category->ViewCustomAttributes = "";

		// modelunit
		if (strval($this->modelunit->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `model` FROM `mst_modelunit` WHERE `kode` = '" . ew_AdjustSql($this->modelunit->CurrentValue) . "'";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->modelunit->ViewValue = $rswrk->fields('model');
				$rswrk->Close();
			} else {
				$this->modelunit->ViewValue = $this->modelunit->CurrentValue;
			}
		} else {
			$this->modelunit->ViewValue = NULL;
		}
		$this->modelunit->CssStyle = "";
		$this->modelunit->CssClass = "";
		$this->modelunit->ViewCustomAttributes = "";

		// nama
		$this->nama->ViewValue = $this->nama->CurrentValue;
		$this->nama->CssStyle = "";
		$this->nama->CssClass = "";
		$this->nama->ViewCustomAttributes = "";

		// satuan
		if (strval($this->satuan->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `singkatan` FROM `mst_satuan` WHERE `kode` = '" . ew_AdjustSql($this->satuan->CurrentValue) . "'";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->satuan->ViewValue = $rswrk->fields('singkatan');
				$rswrk->Close();
			} else {
				$this->satuan->ViewValue = $this->satuan->CurrentValue;
			}
		} else {
			$this->satuan->ViewValue = NULL;
		}
		$this->satuan->CssStyle = "";
		$this->satuan->CssClass = "";
		$this->satuan->ViewCustomAttributes = "";

		// keterangan
		$this->keterangan->ViewValue = $this->keterangan->CurrentValue;
		$this->keterangan->CssStyle = "";
		$this->keterangan->CssClass = "";
		$this->keterangan->ViewCustomAttributes = "";

		// coa
		if (strval($this->coa->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `coa`, `description` FROM `acc_mst_coa` WHERE `coa` = '" . ew_AdjustSql($this->coa->CurrentValue) . "'";
			$sSqlWrk .= " AND (" . "`description`<>''" . ")";
			$sSqlWrk .= " ORDER BY `coa` ";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->coa->ViewValue = $rswrk->fields('coa');
				$this->coa->ViewValue .= ew_ValueSeparator(0) . $rswrk->fields('description');
				$rswrk->Close();
			} else {
				$this->coa->ViewValue = $this->coa->CurrentValue;
			}
		} else {
			$this->coa->ViewValue = NULL;
		}
		$this->coa->CssStyle = "";
		$this->coa->CssClass = "";
		$this->coa->ViewCustomAttributes = "";

		// kode
		$this->kode->HrefValue = "";

		// pn
		$this->pn->HrefValue = "";

		// category
		$this->category->HrefValue = "";

		// modelunit
		$this->modelunit->HrefValue = "";

		// nama
		$this->nama->HrefValue = "";

		// satuan
		$this->satuan->HrefValue = "";

		// keterangan
		$this->keterangan->HrefValue = "";

		// coa
		$this->coa->HrefValue = "";

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
