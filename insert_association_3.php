<?php session_start();?>
<html>
<?php
include 'mise_en_page.html';
?>
<h1>Etape 7 de la création de votre CV : Associations</h1>
  <p>Veuillez remplir les champs ci-dessous</p>
	<?php 
	echo 'Association n°';
	echo $_SESSION['l'];
	$vL = $_SESSION['l'];
	$_SESSION['l'] = $vL+1;
	?>
<form method= "post" action="insert_association_5.php">
	</br>
	</br>
	<label>Statut</label>
	</br>
	<label>Nom français</label> : <input type="text" name="statut_fr" require/>
	</br>
	<label>Nom anglais</label> : <input type="text" name="statut_en" require/>
	</br>
	</br>
	<label>Association dans la langue d'origine<label>
	</br>
	<label>Titre</label> : <input type="text" name="titre1" require/>
	</br>
	<label>Langue</label> : <select name="langue1" id="langue1">
		<option value='FR'>Français</option>
		<option value='EN'>English</option></select>
	</br>
	<label>Description</br></label> : <textarea name="description1" id="description1" rows="10" cols="50"> </textarea>
	</br>
	</br>
	<label>Nom de l'association</label> : <input type="text" name="nom" require/>
	</br>
	<label>Date de début</label> : <input type="text" name="date_debut" require/>
	</br>
	<label>Date de fin</label> : <input type="text" name="date_fin" require/>
	</br>
	</br>
	<input type="submit" value="valider" />
</form>
<hr/>
</body>
</html>
