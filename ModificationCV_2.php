<html>
      <?php
	    include 'mise_en_page.html';
      ?>
       <body>
	
        <hr/>
        <a href="page1_projet.php"> Retourner à l'acceuil ! </a>  <br>
  
        <?php  
		
             $email=$_POST["email"];
	     $titre=$_POST["titre"];
             $infos=$_POST["infos"];

             if (empty($email)){
                 die("Donner votre e-mail,s'il vous plait !");
             }
             include "connect_projet.php";
	     $vConn = fConnect();          
	     if (!($vConn)){
		 die('You Done Goofed');
	     }

             
              $vSql="SELECT * FROM Individus"; 
	      $vQuery=pg_query($vConn, $vSql);
	      $idIndividu=0 ; 
	      while ($vResult = pg_fetch_array($vQuery)) {
		  if ($vResult[mail] == $email){
			$idIndividu = $vResult[id_individu];				
		  }
	      }
              
              $vSql="SELECT * FROM CV"; 
	      $vQuery=pg_query($vConn, $vSql);
	      $idCV=0 ;
	      while ($vResult = pg_fetch_array($vQuery)) {
		  if ($vResult[candidat] == $idIndividu){
			$idCV = $vResult[id_cv];				
		  }
	      }


             if(!empty($titre)){
		  $query_str = " update CV_Traduit set titre='$titre' where id_CV=$idCV ";
	          $query = pg_query($query_str);     
		  if(!($query)){
			die ("La modification: non valable");
		 }
             }  
             
              if(!empty($infos)){
		  $query_str = " update CV_Traduit set infos_complementaires ='$infos' where id_CV=$idCV ";
	          $query = pg_query($query_str);     
		  if(!($query)){
			die ("La modification: non valable");
		 }
             }  
    
             echo ("Vous avez fait la modification: !!!");
             
          ?> 

   </body> 
</html>

