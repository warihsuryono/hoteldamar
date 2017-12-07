<?php

// PHPMaker 6 configuration for Table mst_room_price
$mst_room_price = NULL; // Initialize table object

// Define table class
class cmst_room_price {

	// Define table level constants
	var $TableVar;
	var $TableName;
	var $SelectLimit = FALSE;
	var $id;
	var $tanggal1;
	var $tanggal2;
	var $room;
	var $roomtype;
	var $description;
	var $baseprice;
	var $tax;
	var $service;
	var $aftertaxservice;
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

	function cmst_room_price() {
		$this->TableVar = "mst_room_price";
		$this->TableName = "mst_room_price";
		$this->SelectLimit = TRUE;
		$this->id = new cField('mst_room_price', 'x_id', 'id', "`id`", 3, -1, FALSE);
		$this->fields['id'] =& $this->id;
		$this->tanggal1 = new cField('mst_room_price', 'x_tanggal1', 'tanggal1', "`tanggal1`", 133, 7, FALSE);
		$this->fields['tanggal1'] =& $this->tanggal1;
		$this->tanggal2 = new cField('mst_room_price', 'x_tanggal2', 'tanggal2', "`tanggal2`", 133, 7, FALSE);
		$this->fields['tanggal2'] =& $this->tanggal2;
		$this->room = new cField('mst_room_price', 'x_room', 'room', "`room`", 200, -1, FALSE);
		$this->fields['room'] =& $this->room;
		$this->roomtype = new cField('mst_room_price', 'x_roomtype', 'roomtype', "`roomtype`", 200, -1, FALSE);
		$this->fields['roomtype'] =& $this->roomtype;
		$this->description = new cField('mst_room_price', 'x_description', 'description', "`description`", 200, -1, FALSE);
		$this->fields['description'] =& $this->description;
		$this->baseprice = new cField('mst_room_price', 'x_baseprice', 'baseprice', "`baseprice`", 5, -1, FALSE);
		$this->fields['baseprice'] =& $this->baseprice;
		$this->tax = new cField('mst_room_price', 'x_tax', 'tax', "`tax`", 5, -1, FALSE);
		$this->fields['tax'] =& $this->tax;
		$this->service = new cField('mst_room_price', 'x_service', 'service', "`service`", 5, -1, FALSE);
		$this->fields['service'] =& $this->service;
		$this->aftertaxservice = new cField('mst_room_price', 'x_aftertaxservice', 'aftertaxservice', "`aftertaxservice`", 5, -1, FALSE);
		$this->fields['aftertaxservice'] =& $this->aftertaxservice;
		$this->createby = new cField('mst_room_price', 'x_createby', 'createby', "`createby`", 200, -1, FALSE);
		$this->fields['createby'] =& $this->createby;
		$this->createdate = new cField('mst_room_price', 'x_createdate', 'createdate', "`createdate`", 135, 7, FALSE);
		$this->fields['createdate'] =& $this->createdate;
		$this->xtimestamp = new cField('mst_room_price', 'x_xtimestamp', 'xtimestamp', "`xtimestamp`", 135, 7, FALSE);
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
		return "mst_room_price_Highlight";
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
		return "SELECT * FROM `mst_room_price`";
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
		return "INSERT INTO `mst_room_price` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		$SQL = "UPDATE `mst_room_price` SET ";
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
		$SQL = "DELETE FROM `mst_room_price` WHERE ";
		$SQL .= EW_DB_QUOTE_START . 'id' . EW_DB_QUOTE_END . '=' .	ew_QuotedValue($rs['id'], $this->id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter for table
	function SqlKeyFilter() {
		return "`id` = @id@";
	}

	// Return Key filter for table
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@id@", ew_AdjustSql($this->id->CurrentValue), $sKeyFilter); // Replace key value
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
			return "mst_room_pricelist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// View url
	function ViewUrl() {
		return $this->KeyUrl("mst_room_priceview.php", $this->UrlParm());
	}

	// Add url
	function AddUrl() {
		$AddUrl = "mst_room_priceadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit url
	function EditUrl() {
		return $this->KeyUrl("mst_room_priceedit.php", $this->UrlParm());
	}

	// Inline edit url
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy url
	function CopyUrl() {
		return $this->KeyUrl("mst_room_priceadd.php", $this->UrlParm());
	}

	// Inline copy url
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete url
	function DeleteUrl() {
		return $this->KeyUrl("mst_room_pricedelete.php", $this->UrlParm());
	}

	// Key url
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id->CurrentValue)) {
			$sUrl .= "id=" . urlencode($this->id->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=mst_room_price" : "";
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
		$this->id->setDbValue($rs->fields('id'));
		$this->tanggal1->setDbValue($rs->fields('tanggal1'));
		$this->tanggal2->setDbValue($rs->fields('tanggal2'));
		$this->room->setDbValue($rs->fields('room'));
		$this->roomtype->setDbValue($rs->fields('roomtype'));
		$this->description->setDbValue($rs->fields('description'));
		$this->baseprice->setDbValue($rs->fields('baseprice'));
		$this->tax->setDbValue($rs->fields('tax'));
		$this->service->setDbValue($rs->fields('service'));
		$this->aftertaxservice->setDbValue($rs->fields('aftertaxservice'));
		$this->createby->setDbValue($rs->fields('createby'));
		$this->createdate->setDbValue($rs->fields('createdate'));
		$this->xtimestamp->setDbValue($rs->fields('xtimestamp'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->CssStyle = "";
		$this->id->CssClass = "";
		$this->id->ViewCustomAttributes = "";

		// tanggal1
		$this->tanggal1->ViewValue = $this->tanggal1->CurrentValue;
		$this->tanggal1->ViewValue = ew_FormatDateTime($this->tanggal1->ViewValue, 7);
		$this->tanggal1->CssStyle = "";
		$this->tanggal1->CssClass = "";
		$this->tanggal1->ViewCustomAttributes = "";

		// tanggal2
		$this->tanggal2->ViewValue = $this->tanggal2->CurrentValue;
		$this->tanggal2->ViewValue = ew_FormatDateTime($this->tanggal2->ViewValue, 7);
		$this->tanggal2->CssStyle = "";
		$this->tanggal2->CssClass = "";
		$this->tanggal2->ViewCustomAttributes = "";

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

		// roomtype
		if (strval($this->roomtype->CurrentValue) <> "") {
			$sSqlWrk = "SELECT `description` FROM `mst_room_type` WHERE `id` = '" . ew_AdjustSql($this->roomtype->CurrentValue) . "'";
			$rswrk = $conn->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup value(s) found
				$this->roomtype->ViewValue = $rswrk->fields('description');
				$rswrk->Close();
			} else {
				$this->roomtype->ViewValue = $this->roomtype->CurrentValue;
			}
		} else {
			$this->roomtype->ViewValue = NULL;
		}
		$this->roomtype->CssStyle = "";
		$this->roomtype->CssClass = "";
		$this->roomtype->ViewCustomAttributes = "";

		// description
		$this->description->ViewValue = $this->description->CurrentValue;
		$this->description->CssStyle = "";
		$this->description->CssClass = "";
		$this->description->ViewCustomAttributes = "";

		// baseprice
		$this->baseprice->ViewValue = $this->baseprice->CurrentValue;
		$this->baseprice->ViewValue = ew_FormatNumber($this->baseprice->ViewValue, 0, -2, -2, -2);
		$this->baseprice->CssStyle = "text-align:right;";
		$this->baseprice->CssClass = "";
		$this->baseprice->ViewCustomAttributes = "";

		// tax
		$this->tax->ViewValue = $this->tax->CurrentValue;
		$this->tax->ViewValue = ew_FormatNumber($this->tax->ViewValue, 0, -2, -2, -2);
		$this->tax->CssStyle = "text-align:right;";
		$this->tax->CssClass = "";
		$this->tax->ViewCustomAttributes = "";

		// service
		$this->service->ViewValue = $this->service->CurrentValue;
		$this->service->ViewValue = ew_FormatNumber($this->service->ViewValue, 0, -2, -2, -2);
		$this->service->CssStyle = "text-align:right;";
		$this->service->CssClass = "";
		$this->service->ViewCustomAttributes = "";

		// aftertaxservice
		$this->aftertaxservice->ViewValue = $this->aftertaxservice->CurrentValue;
		$this->aftertaxservice->ViewValue = ew_FormatNumber($this->aftertaxservice->ViewValue, 0, -2, -2, -2);
		$this->aftertaxservice->CssStyle = "text-align:right;";
		$this->aftertaxservice->CssClass = "";
		$this->aftertaxservice->ViewCustomAttributes = "";

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

		// createdate
		$this->createdate->ViewValue = $this->createdate->CurrentValue;
		$this->createdate->ViewValue = ew_FormatDateTime($this->createdate->ViewValue, 7);
		$this->createdate->CssStyle = "";
		$this->createdate->CssClass = "";
		$this->createdate->ViewCustomAttributes = "";

		// id
		$this->id->HrefValue = "";

		// tanggal1
		$this->tanggal1->HrefValue = "";

		// tanggal2
		$this->tanggal2->HrefValue = "";

		// room
		$this->room->HrefValue = "";

		// roomtype
		$this->roomtype->HrefValue = "";

		// description
		$this->description->HrefValue = "";

		// baseprice
		$this->baseprice->HrefValue = "";

		// tax
		$this->tax->HrefValue = "";

		// service
		$this->service->HrefValue = "";

		// aftertaxservice
		$this->aftertaxservice->HrefValue = "";

		// createby
		$this->createby->HrefValue = "";

		// createdate
		$this->createdate->HrefValue = "";

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
