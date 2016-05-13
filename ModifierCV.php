<html>
   <head>
        <title>Bienvenu ici les informations CV </title>
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
		<p>Espace Référents</p>
		</br>
		<li><a href="select.php">Consulter les CV</a></li>
	    </ul>
	</nav>

	    
        <?php  
		
                   $email=$_POST["email"];
	           $Statut=$_POST["Statut"];
	           $creation=$_POST["creation"];
	           $date_maj=$_POST["date_maj"];

                   if (empty($email)){
                       die("Donner votre e-mail,s'il vous plait !");
                   }

                   include "connect_projet.php";
	           $vConn = fConnect();          
		   if ($vConn){
		        echo('Successfully Connected: ');
		    } else {
			echo('You Done Goofed');
		    }

                   if(!empty($Statut)){
		      $query_str = "update CV set statut='{$Statut}'";   
	              $query = pg_query($query_str);
		      if($query){
			    echo ("Well Done, you fixed it");
				var_dump($query);
		      }else{
			    echo ("You Done Goofed");
		      } 
                   }  
                   if(!empty($creation)){
		      $query_str = "update CV set date_creation='{$creation}'";   
	              $query = pg_query($query_str);
		      if($query){
			echo ("Well Done, you fixed it");
				var_dump($query);
		      }else{
			    echo ("You Done Goofed");
		      } 
                   }  
                   if(!empty($date_maj)){
		      $query_str = "update CV set date_maj='{$$date_maj}'";   
	              $query = pg_query($query_str);
		      if($query){
			echo ("Well Done, you fixed it");
				var_dump($query);
		      }else{
			    echo ("You Done Goofed");
		      } 
                   }  
                   
                echo (" Parfait, vous avzz deja faire la modification !!!");

             ?> 

        </table>
      <hr/>
       <a href="menuCV.php"> Apres la modification, regarder la table! </a>
       <a href="page1_projet.php"> Retourner a l'acceuil ! </a>
   </body> 
</html>

