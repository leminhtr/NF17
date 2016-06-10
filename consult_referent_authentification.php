<html>
<head>
    <meta charset="UTF-8">
    <title>Consulter les candidats que vous gérez</title>
</head>
<body>

<div id="contenu">
    <div id="Menu">
    </div>
    <div id="Bienvenue">
    </div>
</div>

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

<h1>Espace référent : Authentification</h1>

<?php

    $mail=$_POST['mail'];
    $langue=$_POST['langue'];

    if(empty($mail))
    {
        echo"Erreur de saisie.<br><br>";
        echo "<a href='consult_referent.html'>Retour à l'espace d'authentification.</a>";
    }

else {


    /*Connexion à la BDD*/
    include "connect_projet.php";
    $vConn = fConnect();

    /*Recherche référent */
    $query_sql_mail = "SELECT DISTINCT i.nom, i.prenom, i.id_individu
           FROM individus i
           JOIN referents r ON i.id_individu=r.id_referent
           JOIN posseder_referent pr ON r.id_referent = pr.id_referent
           WHERE i.mail='$mail';";


    $query_mail = pg_query($vConn, $query_sql_mail);

    $is_referent = pg_num_rows($query_mail);

    if ($is_referent == 0) {
        echo "Erreur authentification. Vous n'êtes pas un référent.<br><br>";
        echo "<a href='consult_referent.html'>Retour à l'espace d'authentification.</a>";
    } else {
        while ($row_mail = pg_fetch_array($query_mail)) {       //Récupération détail identité référent
            echo "<h1>Bienvenue $row_mail[1] $row_mail[0]</h1>.";
            $id_referent = $row_mail[2];
        }
        echo "<br>";

        //Récupérer ID, nom, prénom, infos,... des candidats du référent
        $query_sql_referent_candidats = "SELECT i.id_individu, i.nom, i.prenom 
                                          FROM individus i
                                          JOIN candidats c ON i.id_individu=c.id_candidat
                                          JOIN posseder_referent pr ON c.id_candidat=pr.id_candidat
                                          JOIN referents r ON pr.id_referent=r.id_referent
                                          WHERE pr.id_referent='$id_referent'
                                          ORDER BY (i.nom)";

        $query_referent_candidats = pg_query($vConn, $query_sql_referent_candidats);

        $nb_candidat_found = pg_num_rows($query_referent_candidats);    //nombre d'individu trouvé

        echo "Vous gérez $nb_candidat_found candidat(s).<br><br>";

        $array_id_candidat = array();

        while ($row_individu = pg_fetch_array($query_referent_candidats))    //stockage de tous les id_candidat correspondant à nom/prénom
        {
            $array_id_candidat[] = $row_individu['id_individu'];
        }

        $row_individu = pg_result_seek($query_referent_candidats, 0);   //reset fetch query

        /*=========3 cas : I) aucun trouvé, II) + de 1 trouvé, III) 1 exactement trouvé===========*/


        //I) Cas aucun trouvé : Retour à la recherche/accueil
        if ($nb_candidat_found == 0) {
            echo "<a href='page1_projet.php'> Retour à l'acceuil</a>";
        }

        //II) Cas +d'1 trouvé : Proposition choix du candidat à afficher

        if ($nb_candidat_found > 1) {
            echo "Quel candidat souhaitez-vous consulter ?<br><br>";

            echo "<table>";

            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nom</th>";
            echo "<th>Prénom</th>";
            echo "</tr>";

            echo "<form method='post' action='consult_referent_choix.php'>";

            while ($row_individu = pg_fetch_array($query_referent_candidats)) {
                echo "<tr>";
                echo "<td>$row_individu[0]</td>";   //id
                echo "<td>$row_individu[1]</td>";   //nom
                echo "<td>$row_individu[2]</td>";   //prenom
                echo "<td><input type='radio' value='" . $row_individu[0] . "' name='id_candidat'></td>";
                echo "</tr>";

            }

            echo "</table>";

            echo "<input type='hidden' value='" . $id_referent . "' name='nom'>";
            echo "<input type='hidden' value='" . $langue . "' name='langue'>";

            echo "<br>";
            echo "<input type='submit' value='Consulter ce candidat'>";
            echo "</form>";
        }


        //III)Cas 1 candidat exactement trouvé : affichage normal
        if ($nb_candidat_found == 1) {


            $query_sql_individu = "SELECT ic.nom, ic.prenom, ic.mail, ic.telephone, ic.telephone_type, ic.url_web, ic.type_web, cv.candidat /*toutes les infos d'un individu*/
                                 FROM individus_candidats ic
                                 JOIN candidats c ON c.id_candidat=ic.id_individu
                                 JOIN CV ON c.id_candidat=CV.candidat
                                 WHERE ic.id_individu='$array_id_candidat[0]';";

            $query_individu = pg_query($vConn, $query_sql_individu);

            while ($row_individu = pg_fetch_array($query_individu)) {
                $nom = $row_individu[0];
                $prenom = $row_individu[1];
            }

            echo "<center><h2>$nom $prenom </h2></center>";

            //Rcupéraion tire et langue CV
            $query_sql_cv="SELECT cvt.langue, cvt.titre, cvt.infos_complementaires
                       FROM cv_traduit cvt
                       JOIN CV ON cvt.id_cv = cv.id_cv
                       WHERE cv.candidat='$array_id_candidat[0]'
                       AND cvt.langue='$langue';";

            $query_cv=pg_query($vConn,$query_sql_cv);

            $nb_cv_found=pg_num_rows($query_cv);    //nombre de CV trouvé

            while ($row_cv=pg_fetch_array($query_cv))
            {
                echo"<h2>$row_cv[1] ($row_cv[0])</h2>";
            }
            $row_cv=pg_result_seek($query_cv,0);    //reset fetch query
            
            echo "<h3>Profil personnel</h3>";

            $row_individu = pg_result_seek($query_individu, 0);    //reset fetch query

            while ($row_individu = pg_fetch_array($query_individu)) {

                echo "<table>";

                echo "<tr>";
                echo "<th>Mail</th>";
                echo "<th>Téléphone</th>";
                echo "<th>Site web et type de site</th>";
                echo "</tr>";

                echo "<tr>";
                echo "<td><center>$row_individu[2]</center</td>";  //Mail
                echo "<td><center>Téléphone $row_individu[4] : <b>$row_individu[3]</b></center</td>";  //Téléphone
                echo "<br>";
                if (empty($row_individu[5]))
                    echo "<td><center><i>Non renseigné</i></center></td>";          //Site web est vide
                elseif (empty($row_individu[6]))                            //Site web non vide et type vide
                {
                    echo "<td><center><a href='$row_individu[5]' target='_blank'>$row_individu[5]</a> <i>(Non renseigné)</i></center></td>";          //Site web est vide
                } else
                    echo "<td><center>Site $row_individu[6] : <a href='$row_individu[5]' target='_blank'>$row_individu[5]</a></center></td>"; //Site web et type non vide
                echo "</tr>";
                echo "</table>";

            }
            echo "<br>";    //faire affichage dans les 2 langues.

            echo "<h3>Expérience professionnelle</h3>";

            if ($langue == 'FR') {
                $query_sql_experience = "SELECT cep.fonction, cep.date_debut, cep.date_fin, cep.nom_entreprise, es.sa_fr
            FROM candidats_experiences_pro cep
            JOIN entreprises_secteurs es ON cep.nom_entreprise=es.nom_entreprise
            WHERE cep.id_candidat='$array_id_candidat[0]'
                AND cep.langue='$langue'
            ORDER BY (cep.date_debut);";

                $query_experience = pg_query($vConn, $query_sql_experience);

                $nb_experience_found = pg_num_rows($query_experience);    //nb. d'expérience du candidat
                echo "$nom $prenom a effectué $nb_experience_found expérience(s) professionnelle(s).<br><br>";

                if ($nb_experience_found > 0) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Fonction</th>";
                    echo "<th>Employeur</th>";
                    echo "</tr>";

                    while ($row_experience = pg_fetch_array($query_experience)) {
                        echo "<tr>";
                        echo "<td>$row_experience[0] de $row_experience[1] à $row_experience[2]</td>"; //Fonction de date_debut à date_fin

                        echo "<td><center>$row_experience[3] <i>($row_experience[4])</i></center><td>"; //Entreprise (secteur_fr)
                        echo "</tr>";
                    }

                    echo "</table>";
                }
                //================FORMATIONS ===================================
                echo "<h3>Formations</h3>";

                $query_sql_formation = "SELECT DISTINCT cf.titre, cf.type, cf.date_debut, cf.date_fin, cf.etablissement, cf.ville, cf.pays, cd.de_fr
                                  FROM candidats_formations cf
                                  JOIN candidats_domaines cd ON cd.domaine_etude=cf.domaine_etude
                                  WHERE cf.langue='$langue'
                                      AND cf.id_candidat='$array_id_candidat[0]';";
                $query_formation = pg_query($vConn, $query_sql_formation);
                $query_formation = pg_query($vConn, $query_sql_formation);

                $nb_formation_found = pg_num_rows($query_formation);  //nb. formation suivie par candidat

                echo "$nom $prenom a suivi $nb_formation_found formation(s).<br><br>";

                if ($nb_formation_found > 0) {
                    echo "<table>";

                    echo "<tr>";
                    echo "<th>Diplôme</th>";
                    echo "<th>Etablissement</th>";
                    echo "<th>Domaine d'étude</th>";
                    echo "</tr>";

                    while ($row_formation = pg_fetch_array($query_formation)) {
                        echo "<tr>";
                        echo "<td>$row_formation[0] <i>($row_formation[1])</i> suivi de $row_formation[2] à $row_formation[3]</td>";    //Diplôme (type diplôme) suivi de date_debut à date_fin
                        echo "<td><center>$row_formation[4] - $row_formation[5] ($row_formation[6])</center></td>"; //Etablissement - Ville(Pays)
                        echo "<td><center>$row_formation[7]</center></td>";   //Domaine étude_FR
                        echo "</tr>";

                    }

                    echo "</table>";
                }


                echo "<h3>Associations</h3>";

                $query_sql_association = "  SELECT DISTINCT ca.nom_asso, ca.description, ca.date_debut, ca.date_fin, ca.statut_fr
                                  FROM candidats_associations ca
                                  WHERE ca.langue='$langue'
                                      AND ca.id_candidat='$array_id_candidat[0]';";
                $query_association = pg_query($vConn, $query_sql_association);

                $nb_associations_found = pg_num_rows($query_association);  //nb. formation suivie par candidat

                echo "$nom $prenom a participé à $nb_associations_found association(s).<br><br>";

                if ($nb_associations_found > 0) {
                    echo "<table>";

                    echo "<tr>";
                    echo "<th>Nom de l'association</th>";
                    echo "<th>Description</th>";
                    echo "<th>Date de début</th>";
                    echo "<th>Date de fin</th>";
                    echo "<th>Statut</th>";
                    echo "</tr>";

                    while ($row_association = pg_fetch_array($query_association)) {
                        echo "<tr>";
                        echo "<td>$row_association[0]</td>";    //Nom de l'asso
                        echo "<td><center>$row_association[1])</center></td>"; //Description
                        echo "<td><center>$row_association[2])</center></td>"; //Date début
                        echo "<td><center>$row_association[3])</center></td>"; //Date fin
                        echo "<td><center>$row_association[4])</center></td>"; //Statut
                        echo "</tr>";

                    }

                    echo "</table>";
                }

                echo "<h3>Publications</h3>";

                $query_sql_publication = "  SELECT p.titre, p.contenu, dp.date, dp.isbn
                                      FROM candidats c
                                      LEFT JOIN ecrire_publication ep ON c.id_candidat = ep.id_candidat
                                      JOIN publications p ON ep.id_publication = p.id_pub
                                      JOIN datepublication dp ON p.id_date_pub = dp.id_date_pub
                                      WHERE c.id_candidat='$array_id_candidat[0]';";
                $query_publication = pg_query($vConn, $query_sql_publication);

                $nb_publication_found = pg_num_rows($query_publication);  //nb. formation suivie par candidat


                echo "$nom $prenom a écrit $nb_publication_found publication(s).<br><br>";

                if ($nb_publication_found > 0) {

                    echo "<table>";

                    echo "<tr>";
                    echo "<th>Titre</th>";
                    echo "<th>Contenu</th>";
                    echo "<th>Date de publication</th>";
                    echo "<th>ISBN</th>";
                    echo "</tr>";

                    while ($row_publication = pg_fetch_array($query_publication)) {
                        echo "<tr>";
                        echo "<td><center>$row_publication[0]</center><td>";    //Titre
                        echo "<td><center>$row_publication[1]</center><td>";    //Contenu (TEXT)
                        echo "<td><center>$row_publication[2]</center><td>";    //Date
                        echo "<td><center>$row_publication[3]</center><td>";    //ISBN
                        echo "</tr>";

                    }

                    echo "</table>";
                }

                echo "<h3>Compétences</h3>";

                $query_sql_competence = "SELECT pc.nom
                               FROM candidats c 
                               JOIN posseder_competence pc ON c.id_candidat = pc.id_candidat
                               WHERE pc.langue='$langue'
                                 AND c.id_candidat='$array_id_candidat[0]';";
                $query_competence = pg_query($vConn, $query_sql_competence);

                $nb_competence_found = pg_num_rows($query_competence);

                echo "$nom $prenom maîtrise $nb_competence_found compétence(s).<br><br>";

                if ($nb_competence_found > 0) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th><center>Nom</center></th>";
                    echo "</tr>";

                    while ($row_competence = pg_fetch_array($query_competence)) {
                        echo "<tr>";
                        echo "<td>$row_competence[0]</td>";  //Compétence
                        echo "</tr>";
                    }
                }

                $query_sql_langue = "SELECT cl.nom_fr, cl.niveau_langue
                               FROM candidats_langues cl
                               WHERE cl.id_candidat='$array_id_candidat[0]';";
                $query_langue = pg_query($vConn, $query_sql_langue);

                $nb_langue_found = pg_num_rows($query_langue);

                echo "<table>";
                echo "<tr>";
                echo "<h3>Langues</h3>";
                echo "</tr>";

                echo "<tr>";
                echo "$nom $prenom parle $nb_langue_found langue(s).<br><b";
                echo"</tr>";
                echo"<tr>";

                if ($nb_langue_found > 0) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th><center>Langue</center></th>";
                    echo "<th><center>Niveau</center></th>";
                    echo "</tr>";

                    while ($row_langue = pg_fetch_array($query_langue)) {
                        echo "<tr>";
                        echo "<td>$row_langue[0]</td>";  //Langue_fr
                        echo "<td><center>$row_langue[1]</center></td>";  //Niveau
                        echo "</tr>";
                    }

                }

                if ($nb_cv_found != 0) {
                    echo"<table>";
                    echo"<tr>";
                    echo "<h3>Informations complémentaires</h3><br>";

                    while ($row_cv = pg_fetch_array($query_cv)) {
                        echo "$row_cv[3]"; //infos complémentaires
                    }
                    echo"<tr>";
                    echo "</table>";
                }

            } else    //LANGUE EN
            {
            //================EXPERIENCES PRO===================================                
                $query_sql_experience = "SELECT cep.fonction, cep.date_debut, cep.date_fin, cep.nom_entreprise, es.sa_en
                FROM candidats_experiences_pro cep
                JOIN entreprises_secteurs es ON cep.nom_entreprise=es.nom_entreprise
                WHERE cep.id_candidat='$array_id_candidat[0]'
                    AND cep.langue='$langue'
                ORDER BY (cep.date_debut);";

                $query_experience = pg_query($vConn, $query_sql_experience);

                $nb_experience_found = pg_num_rows($query_experience);    //nb. d'expérience du candidat
                echo "$nom $prenom a effectué $nb_experience_found expérience(s) professionnelle(s).<br><br>";

                if ($nb_experience_found > 0) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Fonction</th>";
                    echo "<th>Employeur</th>";
                    echo "</tr>";

                    while ($row_experience = pg_fetch_array($query_experience)) {
                        echo "<tr>";
                        echo "<td>$row_experience[0] de $row_experience[1] à $row_experience[2]</td>"; //Fonction de date_debut à date_fin

                        echo "<td><center>$row_experience[3] <i>($row_experience[4])</i></center><td>"; //Entreprise (secteur_fr)
                        echo "</tr>";
                    }

                    echo "</table>";
                }
                
            //================FORMATIONS =================================== 
                echo "<h3>Formations</h3>";

                $query_sql_formation = "SELECT DISTINCT cf.titre, cf.type, cf.date_debut, cf.date_fin, cf.etablissement, cf.ville, cf.pays, cd.de_en
                                  FROM candidats_formations cf
                                  JOIN candidats_domaines cd ON cd.domaine_etude=cf.domaine_etude
                                  WHERE cf.langue='$langue'
                                      AND cf.id_candidat='$array_id_candidat[0]';";
                $query_formation = pg_query($vConn, $query_sql_formation);

                $nb_formation_found = pg_num_rows($query_formation);  //nb. formation suivie par candidat

                echo "$nom $prenom a suivi $nb_formation_found formation(s).<br><br>";

                if ($nb_formation_found > 0) {
                    echo "<table>";

                    echo "<tr>";
                    echo "<th>Diplôme</th>";
                    echo "<th>Etablissement</th>";
                    echo "<th>Domaine d'étude</th>";
                    echo "</tr>";

                    while ($row_formation = pg_fetch_array($query_formation)) {
                        echo "<tr>";
                        echo "<td>$row_formation[0] <i>($row_formation[1])</i> suivi de $row_formation[2] à $row_formation[3]</td>";    //Diplôme (type diplôme) suivi de date_debut à date_fin
                        echo "<td><center>$row_formation[4] - $row_formation[5] ($row_formation[6])</center></td>"; //Etablissement - Ville(Pays)
                        echo "<td><center>$row_formation[7]</center></td>";   //Domaine étude_FR
                        echo "</tr>";

                    }

                    echo "</table>";
                }

            //================ ASSOCIATIONS =================================== 
                echo "<h3>Associations</h3>";

                $query_sql_association = "  SELECT DISTINCT ca.nom_asso, ca.description, ca.date_debut, ca.date_fin, ca.statut_en
                                  FROM candidats_associations ca
                                  WHERE ca.langue='$langue'
                                      AND ca.id_candidat='$array_id_candidat[0]';";
                $query_association = pg_query($vConn, $query_sql_association);

                $nb_associations_found = pg_num_rows($query_association);  //nb. formation suivie par candidat

                echo "$nom $prenom a participé à $nb_associations_found association(s).<br><br>";

                if ($nb_associations_found > 0) {
                    echo "<table>";

                    echo "<tr>";
                    echo "<th>Nom de l'association</th>";
                    echo "<th>Description</th>";
                    echo "<th>Date de début</th>";
                    echo "<th>Date de fin</th>";
                    echo "<th>Statut</th>";
                    echo "</tr>";

                    while ($row_association = pg_fetch_array($query_association)) {
                        echo "<tr>";
                        echo "<td>$row_association[0]</td>";    //Nom de l'asso
                        echo "<td><center>$row_association[1])</center></td>"; //Description
                        echo "<td><center>$row_association[2])</center></td>"; //Date début
                        echo "<td><center>$row_association[3])</center></td>"; //Date fin
                        echo "<td><center>$row_association[4])</center></td>"; //Statut
                        echo "</tr>";

                    }

                    echo "</table>";
                }
        //================ PUBLICATIONS =================================== 
                echo "<h3>Publications</h3>";

                $query_sql_publication = "  SELECT p.titre, p.contenu, dp.date, dp.isbn
                                      FROM candidats c
                                      LEFT JOIN ecrire_publication ep ON c.id_candidat = ep.id_candidat
                                      JOIN publications p ON ep.id_publication = p.id_pub
                                      JOIN datepublication dp ON p.id_date_pub = dp.id_date_pub
                                      WHERE c.id_candidat='$array_id_candidat[0]';";
                $query_publication = pg_query($vConn, $query_sql_publication);

                $nb_publication_found = pg_num_rows($query_publication);  //nb. formation suivie par candidat


                echo "$nom $prenom a écrit $nb_publication_found publication(s).<br><br>";

                if ($nb_publication_found > 0) {

                    echo "<table>";

                    echo "<tr>";
                    echo "<th>Titre</th>";
                    echo "<th>Contenu</th>";
                    echo "<th>Date de publication</th>";
                    echo "<th>ISBN</th>";
                    echo "</tr>";

                    while ($row_publication = pg_fetch_array($query_publication)) {
                        echo "<tr>";
                        echo "<td><center>$row_publication[0]</center><td>";    //Titre
                        echo "<td><center>$row_publication[1]</center><td>";    //Contenu (TEXT)
                        echo "<td><center>$row_publication[2]</center><td>";    //Date
                        echo "<td><center>$row_publication[3]</center><td>";    //ISBN
                        echo "</tr>";

                    }

                    echo "</table>";
                }
                
            //================ COMPETENCES =================================== 
                echo "<h3>Compétences</h3>";

                $query_sql_competence = "SELECT pc.nom
                               FROM candidats c 
                               JOIN posseder_competence pc ON c.id_candidat = pc.id_candidat
                               WHERE pc.langue='$langue'
                                 AND c.id_candidat='$array_id_candidat[0]';";
                $query_competence = pg_query($vConn, $query_sql_competence);

                $nb_competence_found = pg_num_rows($query_competence);

                echo "$nom $prenom maîtrise $nb_competence_found compétence(s).<br><br>";

                if ($nb_competence_found > 0) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th><center>Nom</center></th>";
                    echo "</tr>";

                    while ($row_competence = pg_fetch_array($query_competence)) {
                        echo "<tr>";
                        echo "<td>$row_competence[0]</td>";  //Compétence
                        echo "</tr>";
                    }
                }

        //================ LANGUES===================================                 
                $query_sql_langue = "SELECT cl.nom_en, cl.niveau_langue
                               FROM candidats_langues cl
                               WHERE cl.id_candidat='$array_id_candidat[0]';";
                $query_langue = pg_query($vConn, $query_sql_langue);

                $nb_langue_found = pg_num_rows($query_langue);

                echo "<table>";
                echo "<tr>";
                echo "<h3>Langues</h3>";
                echo "</tr>";

                echo "<tr>";
                echo "$nom $prenom parle $nb_langue_found langue(s).<br><b";
                echo"</tr>";
                echo"<tr>";

                if ($nb_langue_found > 0) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th><center>Langue</center></th>";
                    echo "<th><center>Niveau</center></th>";
                    echo "</tr>";

                    while ($row_langue = pg_fetch_array($query_langue)) {
                        echo "<tr>";
                        echo "<td>$row_langue[0]</td>";  //Langue_en
                        echo "<td><center>$row_langue[1]</center></td>";  //Niveau
                        echo "</tr>";
                    }

                }

                if ($nb_cv_found != 0) {
                    echo"<table>";
                    echo"<tr>";
                    echo "<h3>Informations complémentaires</h3><br>";

                    while ($row_cv = pg_fetch_array($query_cv)) {
                        echo "$row_cv[3]"; //infos complémentaires
                    }
                    echo"<tr>";
                    echo "</table>";
                }
            }
        }

    }
}

?>



