<html>
     <?php
	    include 'mise_en_page.html';
     ?>
      <body>   
      
        <form id="myform" method="POST" action="ModificationLangue_2.php">
        	
              <h3>Identification du candidat? <br>   
              E-Mail*:<input type="email" name="email" size=20 ><br>  
                    
              <h4>Choisir un langue: <br> 
              <select name="langue" id="langue">
		<option value="Francais" selected>Français/French </option>
		<option value="Angais">Anglais/English</option> 
                <option value="Espagnol">Espagnol/Spanish</option>
		<option value="Allemand">Allemand/German</option>
	      </select>

              <h4>Modifier le niveau du langue? <br>  
              Niveau*:<input type="text" name="niveau" size=10><br>
              
              <input type="submit" value="valider"> 
              <input type="reset" value="refaire"> <br>
        </form>
     
     <hr/>
            
   </body> 
</html>
