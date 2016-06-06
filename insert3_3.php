

<html>
<?php
include 'mise_en_page.php';

?>
  <h1>Etape 2 de la création de votre CV : informations principales de votre CV</h1>
  <h3>Veuillez remplir les champs ci-dessous en indiquant si c'est en anglais ou en français</h3></br></br>
  <form method= "post" action="insert3_4.php">

	

	<label>Etat de visibilité de votre CV</label> : 
	<select name="statut" id="statut">
		<option value='desactive'>Desactivé (seulement vous, le voyez)</option>
		<option value='active'>Activé (tout le monde peut le voir)</option>
		<option value='confidentiel'>Confidentiel (seul votre referent peut le voir)</option>
	</select>
	</br></br>

       	<input type="submit" value="valider" />
    	</p>

	
  </form>








