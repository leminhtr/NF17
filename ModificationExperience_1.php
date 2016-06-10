<html>
     <?php
	    include 'mise_en_page.html';
     ?>
       <body> 
          
        
       <form id="myform" method="POST" action="ModificationExperience_2.php">
        	
              <h3>Identification du candidat! <br>   
              E-Mail*:<input type="email" name="email" size=20 ><br>                   
	      
              <h4>Modifier les infos d'ExpériencePro : <br>  
              Nom_entreprise:<input type="text" name="nomentreprise" size=20><br>
              Date_debut:<input type="text" name="datedebut" size=20><br>
              Date_fin:<input type="text" name="datefin" size=20><br>
              
              <h4>Modifier les infos d'ExperiencesPro Traduites : <br>  
              Fonction:<input type="text" name="fonction" size=20><br>
              Langue:<input type="text" name="langue" size=20><br>
       
              <input type="submit" value="valider"> 
              <input type="reset" value="refaire"> <br>
              
       </form>
      
   </body> 
</html>
