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

/* ---------------- Appel le model ---------------- */
    include("php/model.php");

    $Champs =  listeChamps();
    $nbrChamp = mysqli_num_rows($Champs);

    if(isset($_GET['afficher']) && isset($_GET['id'])){
        $affiche = $_GET['afficher'];
        $id = $_GET['id'];
        $type = $_GET['type'];

        if($affiche == 'delete'){
            if($type == 'image'){
                suppimerAllImage($id);                
            }
            supprimeChamp($id);
            header('Location: controleur-index-champ.php');
            exit();
        }
    }

/* ------------- Fermeture de la bdd -------------- */
    mysqli_close($con);

/* ----------------- Appel la vue ----------------- */
    include("php/vue/vue-index-champ.php");