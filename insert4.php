<html>
<?php
include 'mise_en_page.php';
?>
  <h1>Etape 2 : donnez vos données principales ainsi que celles de votre CV</h1>




<?php
	include "connect_projet.php";
	$vConn = fConnect();
  /* Récupération des variables passées par le fomulaire */
	$vnom=$_POST['nom'];
	$vprenom=$_POST['prenom'];
	$vemail=$_POST['email'];
	$vMDP=$_POST['motdepasse'];
	$vtel=$_POST['tel'];
	$vtypnum=$_POST['typ_num'];
	$vURL=$_POST['url'];
	$vtypweb=$_POST['typ_web'];
	$sstatut=$_POST['statut'];
	$vlangue1=$_POST['langue1'];
	$vtitre1=$_POST['titre1'];
	$vinfo1=$_POST['infos_complementaires1'];
	$vlangue2=$_POST['langue2'];
	$vtitre2=$_POST['titre2'];
	$vinfo2=$_POST['infos_complementaires2'];

/*Creation des variables dérivée*/
	//$date = date("Y-m-d");
	

 /* Insertions*/
	$vSql1 = "INSERT INTO Individus (nom, prenom, mail) VALUES ('$vnom', '$vprenom', '$vemail')";
	$vQuery=pg_query($vConn, $vSql1);
	

	$vSql2 = "SELECT id_individu FROM Individus WHERE mail = $vemail";
	$vQuery2=pg_query($vConn, $vSql2);
	$vResult = pg_fetch_array($vQuery2);
	$vid_individu = $vResult[id_individu];

	$identifiant = $vnom.$vprenom.$vid_individu;/*IL FAUT : fonction vérifiant l'unicité*/
	
	$vSql3 = "INSERT INTO Candidats (id_candidat, identifiant, mot_de_passe, telephone, telephone_type, URL_web, type_web) VALUES ('$vid_individu', '$identifiant', '$vMDP', '$vtel', '$vtypnum', '$vURL', '$vtypweb')";
	$vQuery3=pg_query($vConn, $vSql3);
	
	$vSql4 = "INSERT INTO CV (candidat, statut, date_creation, date_maj) VALUES ('$vid_individu', '$sstatut', SYSDATE(), SYSDATE())";
	$vQuery4=pg_query($vConn, $vSql4);

	$vSql5 = "SELECT id_CV FROM CV WHERE candidat = $vid_individu";
	$vQuery5=pg_query($vConn, $vSql5);
	$vResult2 = pg_fetch_array($vQuery5);
	$vid_CV = $vResult2[id_CV];


	$vSql6 = "INSERT INTO CV_Traduit (id_CV, langue, titre, infos_complementaires) VALUES ($vid_CV, $vlangue1, $vtitre1, $vinfo1)";
	$vQuery6=pg_query($vConn, $vSql6);

	$vSql7 = "INSERT INTO CV_Traduit (id_CV, langue, titre, infos_complementaires) VALUES ($vid_CV, $vlangue2, $vtitre2, $vinfo2)";
	$vQuery7=pg_query($vConn, $vSql7);


/*IF FAUT VERIFIER SI IL Y A UN DEUXIEME DESCRIPTION LANGUE DE RENTREE!!!!!!!!!*/



?>

<hr/>

</body>
</html>


