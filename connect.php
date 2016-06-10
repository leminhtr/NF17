<?php
	function fConnect () {
	$vHost="tuxa.sme.utc";
	$vPort="5432";

	$vDbname="dbnf17p018";
	$vUser="nf17p018";
	$vPassword="PrYdt7Ab";

	

	$vConn = pg_connect("host=$vHost port=$vPort dbname=$vDbname user=$vUser password=$vPassword");
	return $vConn;
}
?>
