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
<form method= "post" action="insert_formation_5.php">
	</br>
	</br>
	<label>Domaine d'étude</label>
	</br>
	<label>Nom français</label> : <input type="text" name="DE_fr" required/>
	</br>
	<label>Nom anglais</label> : <input type="text" name="DE_en" required/>
	</br>
	</br>
	<label>Formation dans la langue d'origine<label>
	</br>
	<label>Titre</label> : <input type="text" name="titre1" required/>
	</br>
	<label>Type</label> : <input type="text" name="type1" required/>
	</br>
	<label>Langue</label> : <select name="langue1" id="langue1">
		<option value='FR'>Français</option>
		<option value='EN'>English</option></select>

	</br>
	</br>
	<label>Date de début</label> : <input type="text" name="date_debut" required/> <label>(YYYY-MM-DD)</label>
	</br>
	<label>Date de fin</label> : <input type="text" name="date_fin" required/> <label>(YYYY-MM-DD)</label>
	</br>
	<label>Etablissement</label> : <input type="text" name="etablissement" required/>
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
