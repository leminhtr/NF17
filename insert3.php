<html>
<?php
include 'mise_en_page.php';
?>
  <h1>Etape 1 de la création de votre CV : informations personnels</h1>
  <h3>Veuillez remplir les champs personnels ci-dessous, et veuillez retenir votre mot de passe</h3></br></br>
  <form method= "post" action="insert4.php">
	<label>Nom</label> : <input type="text" name="nom" required/>
	</br></br>
	<label>Prenom</label> : <input type="text" name="prenom" required/>
	</br></br>
	<label>Email</label> : <input type="email" name="email" required/></code>
	</br></br>
	<label>Votre mot de passe</label> : <input type="text" name="motdepass" required/>
	</br></br>
	<label>Numero de telephone</label> : <input type="tel" name="tel" required/>
	</br></br>
	<label>Type du numero</label> : 
	<select name="typ_num" id="typ_num">
		<option value="perso">Personnel</option>
		<option value="pro">Profesionnel portable</option>
		<option value="fixe">Professionnel fixe</option>
	</select>
	</br></br>
	<label>Votre site web</label> : <input type="url" name="url" /></code>
	</br></br>
	<label>Type du web</label> : 
	<select name="typ_web" id="typ_web">
		<option value="perso">Personnel</option>
		<option value="pro">Profesionnel</option>
	</select>
	</br></br>
	<label>Etat de votre CV</label> : 
	<select name="statut" id="statut">
		<option value="desactive">Desactivé (seulement vous, le voyez)</option>
		<option value="active">Activé (tout le monde peut le voir)</option>
		<option value="confidentiel">Confidentiel (seul votre referent peut le voir)</option>
	</select>
	</br></br>
	<h3> Ici veuillez remplir les intitulés que vous souhaitez faire apparaître sur votre CV </h3></br></br>
	<select name="langue1" id="langue1">
		<option value="FR" selected>Français </option>
		<option value="EN">Anglais</option> 
	</select>
	</br></br>
	<label>Le titre que vous souhaitez donner à votre CV</label> : <input type="text" name="titre1" required/>
	</br></br>
	<label>Informations complémentaires</br></label> : <textarea name="infos_complementaires1" id="infos_complementaires" rows="10" 	cols="50"> </textarea>
	</br></br>
	<select name="langue2" id="langue1">
		<option value="FR" >Français </option>
		<option value="EN" >Anglais</option> 
	</select>
	</br></br>
	<label>Le titre que vous souhaitez donner à votre CV</label> : <input type="text" name="titre2" />
	</br></br>
	<label>Informations complémentaires</br></label> : <textarea name="infos_complementaires2" id="infos_complementaires" rows="10" 	cols="50"> </textarea>
       	<input type="submit" value="valider" />
    	</p>
  </form>







