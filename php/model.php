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

/* -------------- Connection a la bdd ------------- */
require("bdd.php");

/*

######################################################
#                                                    #
#                    Model index.php                 #
#                                                    #
######################################################
*/

/* ------------- Dernier champ/enonce ------------- */
    function lastEnonces(){
        global $con;

        $req = "SELECT idEnonce, titre FROM enonce ORDER BY idEnonce DESC LIMIT 2";
        $res = mysqli_query($con, $req);
        mysqli_fetch_all($res, MYSQLI_ASSOC);

        return $res;
    }

    function lastChamps(){
        global $con;

        $req = "SELECT idChamp, nom, typechamp FROM champ ORDER BY idChamp DESC LIMIT 3";
        $res = mysqli_query($con, $req);
        mysqli_fetch_all($res, MYSQLI_ASSOC);

        return $res;
    }

/*
######################################################
#                                                    #
#             Model index-enonce.php                 #
#                                                    #
######################################################
*/

/* ---------- Liste et supression enonce ---------- */
    function listeEnonces(){
        global $con;

        $req = "SELECT idEnonce, titre FROM enonce ORDER BY idEnonce DESC";
        $res = mysqli_query($con, $req);
        mysqli_fetch_all($res, MYSQLI_ASSOC);

        return $res;
    }

    function supprimeEnonce($id){
        global $con;

        $req = "DELETE FROM enonce WHERE idEnonce = ?";
        $stmt = mysqli_prepare($con, $req);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

/*
######################################################
#                                                    #
#             Model index-champ.php                  #
#                                                    #
######################################################
*/

    function listeChamps(){
        global $con;

        $req = "SELECT idChamp, nom, typechamp FROM champ ORDER BY idChamp DESC";
        $res = mysqli_query($con, $req);
        mysqli_fetch_all($res, MYSQLI_ASSOC);

        return $res;
    }

    function supprimeChamp($id){
        global $con;

        $req = "DELETE FROM champ WHERE idChamp = ?";
        $stmt = mysqli_prepare($con, $req);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

/*
######################################################
#                                                    #
#             Model enonce.php                       #
#                                                    #
######################################################
*/

    /* ----- Ajout ----- */
    function ajoutEnonce($titre, $content){
        global $con;
        
        $req = "INSERT INTO enonce (titre, contenu) VALUES ('{$titre}', '{$content}')";
        $res = mysqli_query($con, $req);
    }

    /* ----- Affichage ----- */
    function afficheEnonce($id, $decode = 1){
        global $con;

        $req = "SELECT titre, contenu FROM enonce WHERE idEnonce = ?";
        $stmt = mysqli_prepare($con, $req);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        if(mysqli_num_rows($res) == 1){
            $res = mysqli_fetch_row($res);
            if($decode == 1){
                $res[1] = htmlspecialchars_decode($res[1], ENT_NOQUOTES);
            }
        }        

        return $res;
    }

    /* ----- Modification ----- */
    function modifEnonce($id, $content){
        global $con;

        $req = "UPDATE enonce SET contenu = ('{$content}') WHERE idEnonce = $id";
        $res = mysqli_query($con, $req);
        mysqli_fetch_all($res, MYSQLI_ASSOC);

        return $res;
    }

    /* ----- Génération champ aléatoire ----- */
    function genereAleatoire($res, $type){
        global $con;
        global $config;
        $link = $config['link'];

        if($type == 'text'){
            $valeur = $res[array_rand($res)];
        }

        elseif($type == 'number'){
            $borneInf = $res[0];
            $borneSup = $res[1];
            $pas = $res[2];

            $difference = $borneSup - $borneInf;
            $valmax = intval($difference/$pas);
            $nbr = rand(0,$valmax);
            $valeur = ($nbr * $pas) + $borneInf;
        }

        elseif($type == 'image'){
            $valeur = '<img src="'. $link .'/upload/' . $res[array_rand($res)] . '" alt="image générée a partir d\'un champaléatoire." />';
        }

        return $valeur;
    }

    function recupChamp(){
        global $con;
        $req = "SELECT nom, typechamp, parametres FROM champ";
        $res = mysqli_query($con, $req);

        if(mysqli_num_rows($res) == 1){
            $res = mysqli_fetch_row($res);
            $champ[] = $res;
            $parametres = unserialize($res[2]);
            $res = $parametres;
        }

        return $res;
    }

    function modifieAleatoire($enonce){
        $champs = recupChamp();

        foreach($champs as $champ){
            $signeChamp = "##" . $champ['nom'] . "##";
            $count = substr_count($enonce, $signeChamp);
            $preg = "/" . $signeChamp . "/";

            if($count > 0){
                $parametre = unserialize($champ['parametres']);

                for($i = 0; $i < $count; $i++){
                    $enonce = preg_replace($preg, genereAleatoire($parametre, $champ['typechamp']), $enonce, 1);
                }
            }
        }

        return $enonce;
    }

/* ----------------- Gestion d'erreur ----------------- */

    /*
    Erreur:
        # Enonce #
            01 -> Enonce vide
            02 -> Enonce > 10 000 caractère

        # Titre #
            03 -> Titre vide
            04 -> Titre > 50 caractère
            05 -> Titre avec caractères spéciaux
    */

    /* --- Contenu --- */
    function verifContenu($contenu){
        $erreur = 0;

        if(strlen($contenu) == 0){ //01
            $erreur = 1;
        }
    
        elseif(strlen($contenu) > 10000){ //02
            $erreur = 2;
        }

        return $erreur;
    }

    /* --- Titre --- */
    function verifTitre($titre){
        $erreur = 0;

        if(preg_match("#^$#", $titre)){ //03
            $erreur = 3;
        }
    
        elseif(strlen($titre) > 50){ //04
            $erreur = 4;
        }
    
        elseif(!preg_match("#^[A-Za-z0-9 -/:.;,?!&()+*=]{1,}$#", $titre)){ //05
            $erreur = 5;
        }

        return $erreur;
    }

/*
######################################################
#                                                    #
#             Model champ.php                        #
#                                                    #
######################################################
*/

/* -------------------- Ajout champ -------------------- */

    /* ----- Text ----- */
    function ajoutChamp($nom, $type){
        global $con;

        $req = "INSERT INTO champ (nom, typechamp) VALUES ('{$nom}', '{$type}')";
        $res = mysqli_query($con, $req);
        $id = mysqli_insert_id($con);

        return $id;
    }

    function suppimerAllImage($id){
        $champ = afficheChamp($id);

        foreach($champ[1] as $parametre){
            $champname = $parametre;
            $champname = "upload/".$champname;

            unlink($champname);
        }

        return $champ;
    }

/* -------------------- Edit champ -------------------- */

    /* ----- Affichage des champs ----- */
    function afficheChamp($id){
        global $con;

        $req = "SELECT nom, parametres FROM champ WHERE idChamp = ?";
        $stmt = mysqli_prepare($con, $req);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        if(mysqli_num_rows($res) == 1){
            $res = mysqli_fetch_row($res);
            $parametres = unserialize($res[1]);
            $res[0] = htmlspecialchars_decode($res[0], ENT_NOQUOTES);
            $res[1] = $parametres;
        }        

        return $res;
    }

    function modifChamp($id, $parametres){
        global $con;

        $req = "UPDATE champ SET parametres = ? WHERE idChamp = ?";
        $stmt = mysqli_prepare($con, $req);
        mysqli_stmt_bind_param($stmt, "si", $parametres, $id);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        return $res;
    }

    function randomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 5; $i++) {
            $randstring = $characters[rand(0, strlen($characters))]."".$randstring;
        }
        return $randstring;
    }


/* ----------------- Gestion d'erreur ----------------- */

    /*
    Erreur:
        # Nom #
            01 -> Nom vide
            02 -> Nom > 50 caractères
            03 -> Titre avec caractères spéciaux
            04 -> Nom existe déja

        # Parametre texte #
            05 -> Parametre vide
            06 -> Parametre > 256 caractères
        
        # Parametre nombre #
            07 -> Borne inf vide ou n'est pas un nombre
            08 -> Borne sup vide ou n'est pas un nombre
            09 -> Pas vide ou n'est pas un nombre
            10 -> Borne sup est < borne inf
            11 -> Pas > différence entre borne inf et borne sup
            12 -> Pas = 0
        
        # Parametre image #
            13 -> Le fichier existe déja
            14 -> Le fichier est trop gros (> 50 000)
            15 -> Mauvaise extenssion
    */

    function verifNom($nom){

        $erreur = 0;
        $champs = listeChamps();

        if(preg_match("#^$#", $nom)){ //01
            $erreur = 1;
        }

        elseif(strlen($nom) > 50){ //02
            $erreur = 2;
        }

        elseif(!preg_match("#^[a-z0-9-]{1,}$#", $nom)){ //03
            $erreur = 3;
        }

        foreach($champs as $champ){ //04
            if($champ['nom'] == $nom){
                $erreur = 4;
            }
        }

        return $erreur;
    }

    /* --- Texte --- */
    function verifText($parametre){
        $erreur = 0;

        if(preg_match("#^$#", $parametre)){ //05
            $erreur = 5;
        }

        elseif(strlen($parametre) > 50){ //06
            $erreur = 6;
        }

        return $erreur;
    }

    /* --- Nombre --- */
    function verifNombre($borneInf, $borneSup, $pas){
        $erreur = 0;

        if(!preg_match("#^[0-9,.]{1,}$#", $borneInf)){ //07
            $erreur = 7;
        }

        elseif(!preg_match("#^[0-9,.]{1,}$#", $borneSup)){ //08
            $erreur = 8;
        }

        elseif(!preg_match("#^[0-9,.]{1,}$#", $pas)){ //09
            $erreur = 9;
        }

        elseif(($borneInf >= $borneSup)){ //10
            $erreur = 10;
        }

        elseif(($borneSup - $borneInf) < $pas){ //11
            $erreur = 11;
        }

        elseif($pas == 0){ //12
            $erreur = 12;
        }

        return $erreur;
    }

    function verifImage($targetFile, $imageSize, $imageFileType){
        $erreur = 0;

        if(file_exists($targetFile)){ //13
            $erreur = 13;
        }

        elseif($imageSize > 2097152){ //14
            $erreur = 14;
        }

        elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){ //15
            $erreur = 15;
        }

        return $erreur;
    }