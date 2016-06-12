<?php session_start();?>
<html>
<?php
include 'mise_en_page.html';
?>
<h1>Etape 5 de la création de votre CV : Formation</h1>
  <p>Veuillez remplir les champs ci-dessous</p>
	<?php 
	echo 'Formation n°';
	echo $_SESSION['j'];
	$vJ = $_SESSION['j'];
	$_SESSION['j'] = $vJ+1;
	?>
<form method= "post" action="insert_formation_4.php">
	</br>
	</br>
	<label>Domaine d'étude</label>
	</br>
	<label>Nom français</label> : <input type="text" name="DE_fr" require/>
	</br>
	<label>Nom anglais</label> : <input type="text" name="DE_en" require/>
	</br>
	</br>
	<label>Formation en Français<label>
	</br>
	<label>Titre</label> : <input type="text" name="titre1" require/>
	</br>
	<label>Type</label> : <input type="text" name="type1" require/>
	</br>
	</br>
	</br>
	<label>Formation en Anglais<label>
	</br>
	<label>Titre</label> : <input type="text" name="titre2" require/>
	</br>
	<label>Type</label> : <input type="text" name="type2" require/>
	</br>
	</br>
	<label>Date de début</label> : <input type="text" name="date_debut" require/> <label>(YYYY-MM-DD)</label>
	</br>
	<label>Date de fin</label> : <input type="text" name="date_fin" require/> <label>(YYYY-MM-DD)</label>
	</br>
	<label>Etablissement</label> : <input type="text" name="etablissement" require/>
	</br>
	<label>Pays</label> : <input type="text" name="pays" />
	</br>
	<label>Ville</label> : <input type="text" name="ville" />
	</br>
	</br>
	<input type="submit" value="valider" />
</form>
<hr/>
</body>
</html>
