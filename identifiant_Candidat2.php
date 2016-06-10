<html>
    <?php
	    include 'mise_en_page.html';
    ?>
       <body> 
	    <hr/>
           <a href="page1_projet.php"> Retourner a l'acceuil ! </a>  <br>
  
          <?php
		include "connect_projet.php";
		$vConn = fConnect();
		$email=$_POST['email'];

		$vSql="SELECT * FROM Individus"; 
		$vQuery=pg_query($vConn, $vSql);
		$vverif = 0; 
                $idIndividu=0;
		while ($vResult = pg_fetch_array($vQuery) and $vverif==0 ) {
			if ($vResult[mail] == $email){
				$vverif = 1;
                                $idIndividu = $vResult[id_individu];				
			}
		}

                if($vverif == 1){
                      echo "Vous avez déjà crée un CV dans notre base de donnée, vous pouvez donc faire la modification !";      
                      echo "<br>";
                      echo "<h3> Les informations  du candidat </h3> "; 
                     
                      $vSql="SELECT * FROM Individus where mail='$email'"; 
		      $vQuery=pg_query($vConn, $vSql);		     
		      while ($vResult = pg_fetch_array($vQuery)) {
                           //echo "<p> Id_individu: $vResult[id_individu] </p> ";
                           echo "<p> Nom: $vResult[nom],Prenom: $vResult[prenom]  </p> ";             
                      }
                      
                      $vSql="SELECT * FROM Candidats where id_candidat='$idIndividu'"; 
		      $vQuery=pg_query($vConn, $vSql);		     
		      while ($vResult = pg_fetch_array($vQuery)) {
                           echo "<p> Identifiant: $vResult[identifiant],   Mot_de_passe : $vResult[mot_de_passe] </p> ";                  
                           echo "<p> Telephone: $vResult[telephone],  Telephone_type: $vResult[telephone_type] </p> ";               
			   echo "<p> URL_web: $vResult[url_web],  Type_web : $vResult[type_web] </p> ";          
                      }
 
                     echo "<h3> Les informations  dans votre CV </h3> ";   
                     $vSql="SELECT * FROM CV where candidat='$idIndividu'"; 
		     $vQuery=pg_query($vConn, $vSql);
                     $idcv=0;	     
		     while ($vResult = pg_fetch_array($vQuery)) {
                           //echo "<p> Id_CV: $vResult[id_cv] </p> ";
                           $idcv=$vResult[id_cv];
                           echo "<p> Statut: $vResult[statut],  Date_creation: $vResult[date_creation] </p> ";                                
                      }
 
                     $vSql="SELECT * FROM CV_Traduit where id_CV='$idcv'"; 
		     $vQuery=pg_query($vConn, $vSql);   
		     while ($vResult = pg_fetch_array($vQuery)) {
                           echo "<p> Langue: $vResult[langue],   Titre: $vResult[titre] </p> ";                      
                           echo "<p> Infos_complementaires : $vResult[infos_complementaires] </p> ";                     
                      }
 
                     echo "<h3> Participer les associations  </h3> ";   
                     $vSql="SELECT * FROM Participer_Association where id_candidat='$idIndividu'"; 
		     $vQuery=pg_query($vConn, $vSql);
                     $idasso=0;	     
		     while ($vResult = pg_fetch_array($vQuery)) {
                           //echo "<p> Id_asso: $vResult[id_asso]</p> ";
                           $idasso=$vResult[id_asso];                       
                     }

                     $vSql="SELECT * FROM Postes_Associations where id_asso='$idasso'"; 
		     $vQuery=pg_query($vConn, $vSql);
		     while ($vResult = pg_fetch_array($vQuery)) {
                           echo "<p> Nom_asso: $vResult[nom_asso],  Date_debut: $vResult[date_debut],  date_fin: $vResult[date_fin] </p> ";   
                     }

                     $vSql="SELECT * FROM Postes_Associations_Traduits where id_asso='$idasso'"; 
		     $vQuery=pg_query($vConn, $vSql);   
		     while ($vResult = pg_fetch_array($vQuery)) {
                           echo "<p> Langue : $vResult[langue] </p> ";   
                           echo "<p> Description: $vResult[description] </p> ";          
                     }

                     echo "<h3> Les formations  </h3> ";   
                     $vSql="SELECT * FROM Suivre_Formation where id_candidat='$idIndividu'"; 
		     $vQuery=pg_query($vConn, $vSql);
                     $idformation=0;	     
		     while ($vResult = pg_fetch_array($vQuery)) {
                           //echo "<p> Id_formation: $vResult[id_formation]</p> ";
                           $idformation=$vResult[id_formation];                       
                     }

                     $vSql="SELECT * FROM Formations where id_formation='$idformation'"; 
		     $vQuery=pg_query($vConn, $vSql);
		     while ($vResult = pg_fetch_array($vQuery)) {
                     echo "<p> Etablissement: $vResult[etablissement],Date_debut: $vResult[date_debut],Date_fin:$vResult[date_fin]</p> ";   
                       echo "<p> Pays:$vResult[pays],   Ville: $vResult[ville]  </p> ";
                     }

                     $vSql="SELECT * FROM Formations_Traduites where id_formation='$idformation'"; 
		     $vQuery=pg_query($vConn, $vSql);   
		     while ($vResult = pg_fetch_array($vQuery)) {
                           echo "<p> Titre: $vResult[titre],  Type: $vResult[type],  Langue: $vResult[langue]</p> ";   
                     }


                     echo "<h3> Les experiences  </h3> ";   
                     $vSql="SELECT * FROM Avoir_Experience where id_candidat='$idIndividu'"; 
		     $vQuery=pg_query($vConn, $vSql);
                     $idexpre=0;	     
		     while ($vResult = pg_fetch_array($vQuery)) {
                           //echo "<p> Id_exp_pro: $vResult[id_exp_pro]</p> ";
                           $idexpre = $vResult[id_exp_pro];                       
                     }

                     $vSql="SELECT * FROM Experiences_Pro where id_exp_pro='$idexpre'"; 
		     $vQuery=pg_query($vConn, $vSql);
		     while ($vResult = pg_fetch_array($vQuery)) {
                  echo "<p> Nom_entreprise: $vResult[nom_entreprise],  Date_debut:$vResult[date_debut],  Date_fin: $vResult[date_fin] </p> ";   
                     }

                     $vSql="SELECT * FROM Experiences_Pro_Traduites where id_exp_pro='$idexpre'";
		     $vQuery=pg_query($vConn, $vSql);   
		     while ($vResult = pg_fetch_array($vQuery)) {
                           echo "<p> Fonction: $vResult[fonction],  Langue : $vResult[langue] </p> ";                            
                     }

                }else{
                      echo "Vous n'avez pas crée un CV dans notre base de donnée, vous ne pouvez pas faire la modification !";
                }

         ?>
          <br>
          <a href="Modification.php"> Faire la modification </a> <br>

   </body> 
</html>

