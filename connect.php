<?
function fConnect() {
	$dbhost = 'tuxa.sme.utc';
	$dbuser = 'nf17p018';
	$dbpass = 'PrYdt7Ab';
	$dbname = 'dbnf17p018';
	$vPort="5432";

	$vConn = pg_connect("host=$dbhost port=$vPort dbname=$dbname user=$dbuser password=$dbpass");
	return $vConn;
}

?>
