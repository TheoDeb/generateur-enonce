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

/* ---- Recherche des derniers champ et énoncé ---- */
    $lastEnonce =  lastEnonces();
    $nbrEnonce = mysqli_num_rows($lastEnonce);

    $lastChamp =  lastChamps();
    $nbrChamp = mysqli_num_rows($lastChamp);

/* ------------ Fermeture de la bdd --------------- */
    mysqli_close($con);

/* ---------------- Appel dela vue ---------------- */
    include("php/vue/vue-index.php");
