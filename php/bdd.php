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
        'user' => 'theojmsu_theo',
        'password' => 'q&fKtSnLmC9k?5DG',
        'bdd_name' => 'theojmsu_gestionenonce',

        'link' => 'https://generateur-enonce.theo-debefve.be',
    );

    $con = mysqli_connect($config['host'], $config['user'], $config['password'], $config['bdd_name']);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }

    mysqli_set_charset($con,"utf8");