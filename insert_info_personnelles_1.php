<html>
<?php
include 'mise_en_page.html';
$vemail=$_POST['email'];

/*Page permettant de demander toutes les informations précipales sur la personne. Le formulaire est mit dans un echo simplement pour pouvoir récuperer la variable $vemail qui serait perdue sinon*/

echo "<h1>Etape 1 de la création de votre CV : informations personnels</h1>";
echo "<h3>Veuillez remplir les champs personnels ci-dessous, et veuillez retenir votre mot de passe</h3></br></br>";
echo "<form method= 'post' action='insert_info_personnelles_2.php'>
	<input type='hidden' name='email' value='$vemail'>
	<label>Nom</label> : <input type='text' name='nom' required/>
	</br></br>
	<label>Prenom</label> : <input type='text' name='prenom' required/>
	</br></br>
	<label>Votre mot de passe</label> : <input type='text' name='motdepass' required/>
	</br></br>
	<label>Numero de telephone</label> : <input type='text' name='tel' required/>
	</br></br>
	<label>Type du numero</label> : 
	<select type='text' name='typ_num' id='typ_num'>
		<option value='portable'>Personnel</option>
		<option value='pro'>Profesionnel portable</option>
		<option value='fixe'>Professionnel fixe</option>
	</select>
	</br></br>
	<label>Votre site web</label> : <input type='url' name='url' /></code>
	</br></br>
	<label>Type du web</label> : 
	<select type='text' name='typ_web' id='typ_web'>
		<option value='perso'>Personnel</option>
		<option value='pro'>Profesionnel</option>
	</select>
	</br></br>
       	<input type='submit' value='valider' />
    	</p>
  </form>";
?>





