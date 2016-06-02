<html>
   <head>
        <title> Bienvenue ici:les informations CV </title>
	<meta charset = "UTF-8">
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
        <p>Espace Entreprise</p>
        </br>
        <li><a href="select.html">Consulter les CV</a></li>
        <br>
        <p>Espace Référents</p>
        </br>
        <li><a href="consult_referent.html">Consulter vos candidats</a></li>
    </ul>
</nav>
	
        <h3> La table CV :</h3>
  	<table border="1"> 
    	<tr>
    	  <td width="100pt"><b> Candidat </b></td> 
      	  <td width="100pt"><b> statut </b></td> 
      	  <td width="100pt"><b> date_creation </b></td> 
          <td width="100pt"><b> date_maj </b></td> 
	</tr> 

	       <?php  

		   include "connect_projet.php";
		   $email=$_POST["email"];
	           $vConn = fConnect();
		   if($vConn){
		        echo('Successfully Connected: ');
			var_dump($vConn);
		   } else {
			echo('You Done Goofed');
		   }
                   $query_str= "SELECT * FROM Individus,Candidats,CV where mail='{$email}' ";
		   $query = pg_query($query_str);
		   if($query){
			echo ("Well Done, you fixed it");
			var_dump($query);
		   }else{
			echo ("You Done Goofed");
		   }                  
		   while($result=pg_fetch_array($query,null,PGSQL_ASSOC)){
		       echo "<tr>";
		       echo "<td>$result[candidat]</td>";
		       echo "<td>$result[statut]</td>";
		       echo "<td>$result[date_creation]</td>";
		       echo "<td>$result[date_maj]</td>";
                       echo "</tr>";
		   }  
		  ?> 
        </table>
      <hr/>
      <p> Vous voulez modifier ? Si oui, cliquer le link </p>
      <a href="ModificationCV.php"> Modification les CV </a>


   </body> 
</html>
