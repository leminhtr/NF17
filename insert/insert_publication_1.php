<?php session_start(); ?>

<html>
<?php
include 'mise_en_page.html';
?>
<h1>Etape 8 de la création de votre CV : Publications</h1>
  <p>Veuillez remplir les champs ci-dessous</p>
  <form method= "post" action="insert_publication_2.php">
	</br>
	<?php 
	echo 'Publication n°';
	echo $_SESSION['m'];
	$vM = $_SESSION['m'];
	$_SESSION['m'] = $vM+1;
	?>
	<p>
	</br>
	<label>ISBN</label> : <input type="text" name="isbn" required/>
	</br>
	<label>Titre</label> : <input type="text" name="titre" required/>
	</br>
	<label>Date</label> : <input type="text" name="date" required/> <label>(YYYY/MM/DD)</label>
	</br>
	<label>Contenu</br></label> : <textarea name="cont" id="cont" rows="10" cols="50"> </textarea>
	</br>
	</br>
	<input type="submit" value="valider" />
	</p>
  </form>
<hr/>

</body>
</html>
