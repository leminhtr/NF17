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

	$req = $bdd->prepare('INSERT INTO Individus (nom, prenom, mail) VALUES (:nom, :prenom, :mail)');
	$req->execute(array( /*ERREUR A CETTE LIGNE*/
	'nom' => $vnom,
	'prenom' => $vprenom,
	'mail' => $vemail
    ));

	$vid_individu = "SELECT id_individu FROM Individus WHERE mail = $vemail";
	$identifiant = $vnom.$vprenom.$vid_individu;/*IL FAUT : fonction vérifiant l'unicité*/

	$req = $bdd->prepare('INSERT INTO Candidats (id_candidat, identifiant, mot_de_passe, telephone, telephone_type, URL_web, type_web) VALUES (:id_candidat, :identifiant, :mot_de_passe, :telephone, :telephone_type, :URL_web, :type_web)');
	$req->execute(array(
	'id_candidat' => $vid_individu,
	'identifiant' => $identifiant, 
	'mot_de_passe' => $vMDP,
	'telephone' => $vtel,
	'telephone_type' => $vtypnum,
	'URL_web' => $vURL,
	'type_web' => $vtypweb
    ));

	$req = $bdd->prepare('INSERT INTO CV (candidat, statut, date_creation, date_maj) VALUES (:candidat, :statut, :date_creation, :date_maj)');
	$req->execute(array(
	'candidat' => $vid_individu,
	'statut' => $sstatut,
	'date_creation' => CURDATE(),
	'date_maj' => $date
    ));

	$vid_CV = "SELECT id_CV FROM CV WHERE candidat = $vid_individu";

	$req = $bdd->prepare('INSERT INTO CV_Traduit (id_CV, langue, titre, infos_complementaires) VALUES (:id_CV, :langue, :titre, :infos_complementaires)');
	$req->execute(array(
	'id_CV' => $vid_CV,
	'langue' => $vlangue1,
	'titre' => $vtitre1,
	'infos_complementaires' => $vinfo1 /*IL FAUT VERIFIER QUE CA BIEN ETE RENTREE*/
    ));

/*IF FAUT VERIFIER SI IL Y A UN DEUXIEME DESCRIPTION LANGUE DE RENTREE!!!!!!!!!*/



?>

<hr/>

</body>
</html>


