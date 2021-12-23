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

/* ---------------- Appel du model ---------------- */
    include("php/model.php");

/* --------------- Liste des énoncés -------------- */
    $Enonces =  listeEnonces();
    $nbrEnonce = mysqli_num_rows($Enonces);

    if(isset($_GET['afficher']) && isset($_GET['id'])){
        $affiche = $_GET['afficher'];
        $id = $_GET['id'];

        if($affiche == 'delete'){
            supprimeEnonce($id);
            header('Location: controleur-index-enonce.php');
            exit();
        }
    }

/* ----------- Fermeture de la bdd -------------- */
    mysqli_close($con);

/* ---------------- Appel dela vue ---------------- */
    include("php/vue/vue-index-enonce.php");