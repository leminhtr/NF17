<html>
<?php
include 'mise_en_page.html';
/*Cette page demande à l'utilisateur de donner ses niveaux de langue pour chaque langues demandées*/

?>
  <h1>Etape 3 de la création de votre CV : langues parlées</h1>
  <h3>Veuillez renseigner vos niveaux de langue</h3></br></br>
  <form method= "post" action="insert_langue_2.php">

	<label>Français / French </label> : 
	<select name="francais" id="francais">
		<option value='A0'>Vous ne parlez pas cette langue</option>
		<option value='A1'>A1</option>
		<option value='A2'>A2</option>
		<option value='B1'>B1</option>
		<option value='B2'>B2</option>
		<option value='C1'>C1</option>
		<option value='C2'>C2</option>
	</select>
	</br></br>
	<label>Anglais / English </label> : 
	<select name="anglais" id="anglais">
		<option value='A0'>Vous ne parlez pas cette langue</option>
		<option value='A1'>A1</option>
		<option value='A2'>A2</option>
		<option value='B1'>B1</option>
		<option value='B2'>B2</option>
		<option value='C1'>C1</option>
		<option value='C2'>C2</option>
	</select>
	</br></br>
	<label>Espagnol / Spanish </label> : 
	<select name="espagnol" id="espagnol">
		<option value='A0'>Vous ne parlez pas cette langue</option>
		<option value='A1'>A1</option>
		<option value='A2'>A2</option>
		<option value='B1'>B1</option>
		<option value='B2'>B2</option>
		<option value='C1'>C1</option>
		<option value='C2'>C2</option>
	</select>
	</br></br>
	<label>Allemand / German </label> : 
	<select name="allemand" id="allemand">
		<option value='A0'>Vous ne parlez pas cette langue</option>
		<option value='A1'>A1</option>
		<option value='A2'>A2</option>
		<option value='B1'>B1</option>
		<option value='B2'>B2</option>
		<option value='C1'>C1</option>
		<option value='C2'>C2</option>
	</select>
	</br></br>

       	<input type="submit" value="valider" />
    	</p>

	
  </form>


