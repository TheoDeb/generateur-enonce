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

    $config = array(
        'host' => 'localhost',
        'user' => '', /*USER*/
        'password' => '', /*PASSWORD*/
        'bdd_name' => '', /*BD_NAME*/

        'link' => 'https://...', /*WEBSITE_LINK*/
    );

    $con = mysqli_connect($config['host'], $config['user'], $config['password'], $config['bdd_name']);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }

    mysqli_set_charset($con,"utf8");
