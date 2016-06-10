<html>
     <?php
	    include 'mise_en_page.html';
     ?>
       <body>
        
        <form id="myform" method="POST" action="ModificationPoste_2.php">
        	
              <h3>Identification du candidat! <br>   
              E-Mail*:<input type="email" name="email" size=20 ><br>  
                    
              <h4>Modifier les informations de la Poste Association ! <br>  
              Nom_asso:<input type="text" name="nomasso" size=20><br>
              Date_debut:<input type="text" name="datedebut" size=20><br>
              Date_fin:<input type="text" name="datefin" size=20><br>
              
              <h4>Modifier les informations des Postes Associations Traduits ! <br>  
              Langue:<input type="text" name="langue" size=15><br>
              <label>Description</br></label>
              <textarea id="infos" name="description" rows="10" cols="50"> </textarea>  <br>
   
              <input type="submit" value="valider"> 
              <input type="reset" value="refaire"> <br>
              
       </form>
            
   </body> 
</html>
