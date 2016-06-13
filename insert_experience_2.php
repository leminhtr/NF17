<?php session_start();?>
<html>
<?php
include 'mise_en_page.html';
?>
<h1>Etape 6 de la création de votre CV : Expérience proffessionnelle</h1>
  <p>Veuillez remplir les champs ci-dessous</p>
	<?php 
	echo 'Experience proffessionnelle n°';
	echo $_SESSION['k'];
	$vK = $_SESSION['k'];
	$_SESSION['k'] = $vK+1;
	?>
<form method= "post" action="insert_experience_4.php">
	</br>
	</br>
	<label>Secteur d'activité</label>
	</br>
	<label>Nom français</label> : <input type="text" name="SE_fr" required/>
	</br>
	<label>Nom anglais</label> : <input type="text" name="SE_en" required/>
	</br>
	</br>
	<label>Expérience proffessionnelle en Français<label>
	</br>
	<label>Fonction</label> : <input type="text" name="fonct1" required/>
	</br>
	</br>
	<label>Expérience proffessionnelle en Anglais<label>
	</br>
	<label>Fonction</label> : <input type="text" name="fonct2" required/>
	</br>
	</br>
	<label>Date de début</label> : <input type="text" name="date_debut" required/> <label>(YYYY-MM-DD)</label>
	</br>
	<label>Date de fin</label> : <input type="text" name="date_fin" required/> <label>(YYYY-MM-DD)</label>
	</br>
	<label>Entreprise</label> : <input type="text" name="entreprise" required/>
	</br>
	</br>
	<input type="submit" value="valider" />
</form>
<hr/>
</body>
</html>
