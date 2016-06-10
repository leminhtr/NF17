<html>
      <?php
	    include 'mise_en_page.html';
     ?>
       <body>   
        
       <form id="myform" method="POST" action="ModificationFormation_2.php">
        	
              <h3>Identification du candidat! <br>   
              E-Mail*:<input type="email" name="email" size=20 ><br>                   
	      
              <h4>Modifier les infos de la Formation : <br>  
              Date_debut:<input type="text" name="datedebut" size=20><br>
              Date_fin:<input type="text" name="datefin" size=20><br>
              Etablissement:<input type="text" name="etablissement" size=20><br>
              Pays:<input type="text" name="pays" size=20><br>
              Ville:<input type="text" name="ville" size=20><br><br>
   
              <h4>Modifier les infos de la Formation Traduite : <br>
              Titre:<input type="text" name="titre" size=20><br>
              Type :<input type="text" name="type" size=20><br>
              Langue:<input type="text" name="langue" size=20><br>

              <input type="submit" value="valider"> 
              <input type="reset" value="refaire"> <br>
              
       </form>
     
   </body> 
</html>
