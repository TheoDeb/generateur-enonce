<?php

/*
######################################################
#                                                    #
#   Theo Debefve - 1ère informatique de gestion      #
#     Projet de fin d'année programmation web        #
#                   Juin 2021                        #
#                     V 1.0                          #
#                                                    #
######################################################
*/

/* --------------- Appel du model ----------------- */
    include("php/model.php");

/* --------------  Ajout de l'énoncé -------------- */
    if(isset($_POST['titre']) && isset($_POST['content'])){
        $titre = $_POST['titre'];
        $content = htmlspecialchars($_POST['content'], ENT_QUOTES);

        $erreurT = verifTitre($titre);
        $erreurE = verifContenu($content);

        if($erreurT != 0 || $erreurE != 0){
            if($erreurE != 0){
                switch($erreurE){
                    case 1:
                        $erreurE = 'Le champ énoncé est vide !';
                        break;

                    case 2:
                        $erreurE = 'La taille de l\'énoncé ne peut pas dépasser 10 000 caractères !';
                        break;

                    default:
                        break;
                }
            }

            if($erreurT != 0){
                switch($erreurT){
                    case 3:
                        $erreurT = 'Le champ titre est vide !';
                        break;

                    case 4:
                        $erreurT = 'Le titre doit faire moins de 50 caractères !';
                        break;

                    case 5:
                        $erreurT = 'Le titre ne peut contenir que des chiffres, des lettres majuscule ou minuscule ou - / : . ; , ? ! & ( ) + * =';
                        break;

                    default:
                        break;
                }
            }
        }

        else{
            ajoutEnonce($titre, $content);
            header('Location: controleur-index-enonce.php');
            exit();            
        }
    }

/* --------------- Affichage ----------------- */
    if(isset($_GET['afficher']) && isset($_GET['id'])){
        $affiche = $_GET['afficher'];
        $id = $_GET['id'];

        if($affiche == 'generate'){
            $enonce = afficheEnonce($id);
            $enonceString = $enonce[1];
            $enonceGenere = modifieAleatoire($enonceString);
        }

        elseif($affiche == 'edit'){
            $enonce = afficheEnonce($id, 0);
        }
    }

/* --------------- Modification ----------------- */
    if(isset($_POST['content']) && isset($_GET['id'])){
        $id = $_GET['id'];
        $content = htmlspecialchars($_POST['content'], ENT_QUOTES);

        $erreur = verifContenu($content);

        if($erreur != 0){
            switch($erreur){
                case 1:
                    $erreur = 'Le champ énoncé est vide !';
                    break;

                case 2:
                    $erreur = 'La taille de l\'énoncé ne peut pas dépasser 10 000 caractères !';
                    break;

                default:
                    break;
            }
        }

        else{
            modifEnonce($id, $content);
            header('Location: controleur-index-enonce.php');
            exit();              
        }

          
    }

/* ----------- Fermeture de la bdd -------------- */
    mysqli_close($con);

/* --------------- Appel la vue ----------------- */
    include("php/vue/vue-enonce.php");
