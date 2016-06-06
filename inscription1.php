<html>
<head>
  <title>Inscription Soutenance NF17</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body> 
  <h1>Inscriptions à la soutenance de NF17</h1>
  <h2>Liste des créneaux horaires</h2> 
  <table border="1"> 
    <tr>
      <td width="100pt"><b>Session</b></td> 
      <td width="100pt"><b>Début</b></td> 
      <td width="100pt"><b>Fin</b></td> 
      <td width="100pt"><b>Places disponibles</b></td> 
    </tr> 
<?php
	include "connect.php";
	include "inscription_param.php";
	$vConn = fConnect();
	$vSql ="SELECT S.pknum, S.debut, S.fin, $CST_DISPO_SESSION - COUNT(G.fksession) AS disponible FROM TSessions S LEFT OUTER JOIN TGroupe G ON G.fksession = S.pknum GROUP BY S.pknum, S.debut, S.fin ORDER BY S.debut";
	$vQuery=pg_query($vConn, $vSql);
	while ($vResult = pg_fetch_array($vQuery)) {
		echo "<tr>";
		echo "<td>Session $vResult[pknum]</td>";
		echo "<td>$vResult[debut]</td>";
		echo "<td>$vResult[fin]</td>";
		echo "<td>$vResult[disponible]</td>";
		echo "</tr>";
	}
?> 
  </table>
  <hr/>
  <a href="inscription2.html">S'inscrire</a>
</body> 
</html>
