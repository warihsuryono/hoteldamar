<?php
	$number=$_GET["number"];
	$decimal=$_GET["decimal"];
	$decpoint=$_GET["decpoint"];
	$thousandsep=$_GET["thousandsep"];
	echo number_format($number,$decimal,$decpoint,$thousandsep);
?>