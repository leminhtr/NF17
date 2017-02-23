<html>
<?php
	include 'mise_en_page.html';
/*Page permettant de récupérer l'email de la personne voulant créer son CV. Il faut vérifier que cette personne n'existe pas déjà dans la base.*/
?>
<h1>Créez votre CV</h1>
<h2>Etape de vérification : un seul CV n'est possible par personne</h2>
  <form method= "post" action="insert_verif.php">
     <label>Email</label> : <input type="email" name="email" />
     </br>
     <input type="submit" value="valider" />
     </p>
  </form>
</body>
</html>
