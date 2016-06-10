<html>
      <?php
	    include 'mise_en_page.html';
      ?>
       <body>   

		    <form id="myform" method="POST" action="ModificationCV_2.php">
		    	
		              <h3>Identification du candidat! <br>   
		              E-Mail*:<input type="email" name="email" size=20 ><br>    
		                      
		              <h4>Modifier le titre: <br>  		   
		              <input type="text" name="titre" size=20 > <br> <br>

                             		   
		              <label>Informations complémentaires</br></label>
                              <textarea name="infos" id="infos" rows="10" cols="50"> </textarea>  <br>
		              
		              <input type="submit" value="valider"> 
		              <input type="reset" value="refaire"> <br>
		     </form>

   </body> 
</html>
