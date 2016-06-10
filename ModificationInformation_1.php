<html>
      <?php
	    include 'mise_en_page.html';
      ?>
       <body> 
      
        <form id="myform" method="POST" action="ModificationInformation_2.php">
        	
              <h3>Identification du candidat! <br>   
              E-Mail*:<input type="email" name="email" size=20 ><br>  
                    
              <h4>Est-ce que vous voulez modifier le mot_de_passe? <br>  
              Mot_de_passe:<input type="text" name="motdepass" size=20><br>
              
               <h4>Est-ce que vous voulez modifier le telephone ? <br>  
              Telephone:<input type="text" name="telephone" size=15><br><br>
              
              <input type="submit" value="valider"> 
              <input type="reset" value="refaire"> <br>
       </form>
     
     <hr/>
            
   </body> 
</html>
