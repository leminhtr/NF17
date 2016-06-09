<?php session_start();?>
<html>
<?php
include 'mise_en_page.html';
?>
<h1>Etape 5 de la création de votre CV : Expérience proffessionnelle</h1>
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
	<label>Nom français</label> : <input type="text" name="SE_fr" require/>
	</br>
	<label>Nom anglais</label> : <input type="text" name="SE_en" require/>
	</br>
	</br>
	<label>Expérience proffessionnelle dans la langue d'origine<label>
	</br>
	<label>Titre du poste</label> : <input type="text" name="titre1" require/>
	</br>
	<label>Fonction</label> : <input type="text" name="fonct1" require/>
	</br>
	<label>Langue</label> : <select name="langue1" id="langue1">
		<option value='FR'>Français</option>
		<option value='EN'>English</option></select>
	</br>
	</br>
	<label>Expérience proffessionnelle dans la langue de traduction<label>
	</br>
	<label>Titre du poste</label> : <input type="text" name="titre2" require/>
	</br>
	<label>Fonction</label> : <input type="text" name="fonct2" require/>
	</br>
	<label>Langue</label> : <select name="langue2" id="langue2">
		<option value='FR'>Français</option>
		<option value='EN'>English</option></select>
	</br>
	</br>
	<label>Date de début</label> : <input type="date" name="date_debut" require/>
	</br>
	<label>Date de fin</label> : <input type="date" name="date_fin" require/>
	</br>
	<label>Entreprise</label> : <input type="text" name="entreprise" require/>
	</br>
	</br>
	<input type="submit" value="valider" />
</form>
<hr/>
</body>
</html>
