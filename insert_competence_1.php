<?php session_start(); ?>

<html>
<?php
include 'mise_en_page.html';
?>
<h1>Etape 4 de la création de votre CV : Compétence</h1>
  <p>Veuillez remplir les champs ci-dessous</p>
  <form method= "post" action="insert_competence_2.php">
	</br>
	<?php 
	echo 'Compétence n°';
	echo $_SESSION['i'];
	$vI = $_SESSION['i'];
	$_SESSION['i'] = $vI+1;
	?>
	<p>
	</br>
	<label>Nom</label> : <input type="text" name="nom" require/>
	</br>
	<label>Langue</label> : <select name="langue" id="langue">
		<option value='FR'>Français</option>
		<option value='EN'>English</option></select>
	</br>
	</br>
	<input type="submit" value="valider" />
	</p>
  </form>
<hr/>

</body>
</html>
