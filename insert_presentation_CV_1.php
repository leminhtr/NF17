<html>
<?php
include 'mise_en_page.html';
/*Cette page permet de demander au candidat les informations principales de son CV : titre, description ainsi que sa visibilité*/
?>
  <h1>Etape 2 de la création de votre CV : informations principales de votre CV</h1>
  <h3>Veuillez remplir les champs ci-dessous en indiquant si c'est en anglais ou en français</h3></br></br>
  <form method= "post" action="insert_presentation_CV_2.php">

	

	<label>Etat de visibilité de votre CV</label> : 
	<select name="statut" id="statut">
		<option value='desactive'>Desactivé (seulement vous, le voyez)</option>
		<option value='active'>Activé (tout le monde peut le voir)</option>
		<option value='confidentiel'>Confidentiel (seul votre referent peut le voir)</option>
	</select>
	</br></br>

	<h3> Ici veuillez remplir les intitulés que vous souhaitez faire apparaître sur votre CV </h3></br></br>
	<select name="langue1" id="langue1">
		<option value='FR'>Français </option>
		<option value='EN'>Anglais</option> 
	</select>
	</br></br>

	<label>Le titre que vous souhaitez donner à votre CV</label> : <input type="text" name="titre1" required/>
	</br></br>

	<label>Informations complémentaires</br></label> : <textarea name="infos_complementaires1" id="infos_complementaires" rows="10" 	cols="50"> </textarea>
	</br></br>

	<select name="langue2" id="langue1">
		<option value='FR' >Français </option>
		<option value='EN' >Anglais</option> 
	</select>
	</br></br>

	<label>Le titre que vous souhaitez donner à votre CV</label> : <input type="text" name="titre2" />
	</br></br>

	<label>Informations complémentaires</br></label> : <textarea name="infos_complementaires2" id="infos_complementaires" rows="10" 	cols="50"> </textarea>


       	<input type="submit" value="valider" />
    	</p>

	
  </form>








