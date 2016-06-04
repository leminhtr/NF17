<html>
<?php
include 'mise_en_page.php';
?>
<h1>Etape 4 de la création de votre CV : Formation</h1>
  <p>Veuillez remplir les champs ci-dessous</p>
<?php
	include 'connect_projet.php';
	$vCompt = $_POST['Compt'];
	$vLang = $_POST['Langue'];
	$vCon = fConnect();

	$vSQL = "SELECT nom, langue FROM Competences WHERE nom = $vCompt AND langue = $vLang";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_query($vQuery) == NULL){
		$vSQL = "INSERT INTO Competences(nom,langue) VALUES ($vCompt,$vLang)";
		pg_query($vCon,$vSQL);
	}

	
	//-> récuperer l'id du candidat !!!

	$vID = $_SESSION['id']
	
	$vSQL = "SELECT id, nom, langue FROM Posseder_Competence WHERE nom = $vCompt AND langue = $vLang";
	$vQuery = pg_query($vCon,$vSQL);
	if(pg_fetch_query($vQuery) == NULL){
		$vSQL = "INSERT INTO Posseder_Competence(id_candidat,nom,langue) VALUES ($vID,$vCompt,$vLang)";
		pg_query($vCon,$vSQL);
	}


?>
  <form method= "post" action="insert8.php">
	<label>Domaine d'étude :<label>
	</br>
	<label>Nom français<label> : <input type="text" name="DE_FR" />
	</br>
	<label>Nom anglais<label> : <input type="text" name="DE_EN" />
	</br>
	<label>Date de début<label> : <input type="date" name="date_debut" />
	</br>
	<label>Date de fin<label> : <input type="date" name="date_fin" />
	</br>
	<label>Entablissement<label> : <input type="text" name="Etab" />
	</br>
	<label>Pays<label> : <input type="text" name="pays" />
	</br>
	<label>Ville<label> : <input type="text" name="ville" />
	</br>
	<input type="submit" value="Ajouter une autre formation" />
	<input type="submit" value="Terminer"/>
    	</p>
  </form>

<hr/>
</body>
</html>
