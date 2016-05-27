<html>
<head>
  <title>Inscription Soutenance NF17</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<nav>
    <ul>
        <li><a href="page1_projet.php">Accueil</a></li>
	</br>
	<p>Espace Candidats</p>
	</br>
        <li><a href="insert.php">Ajouter votre CV</a></li>
        <li><a href="check.php">Modifier votre CV</a></li>
	</br>
	<p>Espace Référents</p>
	</br>
	<li><a href="select.html">Consulter les CV</a></li>
    </ul>
</nav>
<style>
nav{
    float:left;
    width:25%;
    height:100%;
    border-right:1px dashed #CCC;
    /*padding:20px;
    margin-top:40px;*/
}
</style>
  <h1>Etape 1 de la création de votre CV : information personnel</h1>
  <p>Veuillez remplir les champs ci-dessous</p>
  <form method= "post" action="insert4.php">
	<label>Nom</label> : <input type="text" name="nom" />
	</br>
	<label>Prenom</label> : <input type="text" name="prenom" />
	</br>
	<label>Email</label> : <input type="email" name="email" /></code>
	</br>
	<label>Votre mot de passe</label> : <input type="text" name="motdepass" />
	</br>
	<label>Numero de telephone</label> : <input type="tel" name="tel" />
	</br>
	<label>Type du numero</label> : 
	<select name="typ_num" id="typ_num">
		<option value="perso">Personnel</option>
		<option value="pro">Profesionnel portable</option>
		<option value="fixe">Professionnel fixe</option>
	</select>
	</br>
	<label>Votre site web</label> : <input type="url" name="tel" /></code>
	</br>
	<label>Type du web</label> : 
	<select name="typ_web" id="typ_web">
		<option value="perso">Personnel</option>
		<option value="pro">Profesionnel</option>
	</select>
	</br>
	</br>
	<input type="submit" value="valider" />
    	</p>
  </form>







