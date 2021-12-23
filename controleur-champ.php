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

/* ------  Ajout et modification des champs ------- */
    if(isset($_GET['type']) && isset($_GET['afficher'])){
        $affiche = $_GET['afficher'];
        $type = $_GET['type'];

        /* ----- Ajout ----- */
        if($affiche == 'add' && isset($_POST['nom'])){
            $nom =  htmlspecialchars($_POST['nom'], ENT_QUOTES);
            $type = $_GET['type'];
            $erreur = verifNom($nom);

            if($erreur != 0){
                switch($erreur){
                    case 1:
                        $erreur = 'Le champ nom est vide !';
                        break;
                    
                    case 2:
                        $erreur = 'Le nom doit faire moins de 50 caractères !';
                        break;

                    case 3:
                        $erreur = 'Le nom ne peut contenir que des chiffres, des lettres minuscule sans accent ou des -';
                        break;

                    case 4:
                        $erreur = 'Un champ aléatoire portant ce nom existe déjà !';
                        break;

                    default:
                        break;
                }
            }

            else{
                $id = ajoutChamp($nom, $type);
                header('Location: controleur-champ.php?afficher=edit&id='.$id.'&type='.$type.'');
                exit();          
            }

        }

        /* ----- Modification ----- */
        elseif($affiche == 'edit'){
            
            /* --- Texte --- */
            if($type == 'text'){
                
                if(isset($_GET['afficher']) && isset($_GET['id']) && isset($_GET['type'])){
                    $affiche = $_GET['afficher'];
                    $id = $_GET['id'];
                    $type = $_GET['type'];
            
                    if($affiche == 'edit' && $type == 'text'){
                        $champ = afficheChamp($id);
                    }
                }

                if(isset($_GET['param']) && isset($_GET['id'])){
                    $idparam = $_GET['param'];
                    $id = $_GET['id'];

                    unset($champ[1][$idparam]);

                    $param = serialize($champ[1]);
                    modifChamp($id, $param);
                    header('Location: controleur-champ.php?afficher=edit&id='.$id.'&type=text');
                    exit(); 
                }

                if(isset($_POST['parametre']) && isset($_GET['id'])){
                    $id = $_GET['id'];
                    $parametre = $_POST['parametre'];

                    $erreur = verifText($parametre);

                    if($erreur != 0){
                        switch($erreur){
                            case 5:
                                $erreur = 'Le champ paramètre est vide !';
                                break;
                            
                            case 6:
                                $erreur = 'Le paramètre doit faire moins de 256 caractères !';
                                break;
                            
                            default:
                                break;
                        }
                    }

                    else{
                        $champ[1][] = htmlspecialchars($parametre, ENT_QUOTES);
                        $param = serialize($champ[1]);
                        modifChamp($id, $param);
                        header('Location: controleur-champ.php?afficher=edit&id='.$id.'&type=text');
                        exit();                        
                    }

                }
            }

            /* --- Nombre --- */
            elseif($type == 'number'){

                if(isset($_GET['afficher']) && isset($_GET['id']) && isset($_GET['type'])){
                    $affiche = $_GET['afficher'];
                    $id = $_GET['id'];
                    $type = $_GET['type'];
            
                    if($affiche == 'edit' && $type == 'number'){
                        $champ = afficheChamp($id);
                    }
                }
            
                if(isset($_POST['borneSup']) && isset($_POST['borneInf']) && isset($_POST['pas']) && isset($_GET['id'])){
                    $id = $_GET['id'];
                    $borneSup = $_POST['borneSup'];
                    $borneInf = $_POST['borneInf'];
                    $pas = $_POST['pas'];

                    $erreurP = verifNombre($borneInf, $borneSup, $pas);

                    if($erreurP != 0){
                        switch($erreurP){
                            case 7:
                                $erreurP = 'La borne inférieure est vide ou n\'est pas un nombre !';
                                break;
                            
                            case 8:
                                $erreurP = 'La borne supérieure est vide ou n\'est pas un nombre !';
                                break;
    
                            case 9:
                                $erreurP = 'Le pas est vide ou n\'est pas un nombre !';
                                break;
                            
                            case 10:
                                $erreurP = 'La borne inférieure est plus grande ou égale que la borne supérieure !';
                                break;

                            case 11:
                                $erreurP = 'Le pas est plus grand ou égale à la différence entre la borne inférieure et suppérieure !';
                                break;

                            case 12:
                                $erreurP = 'Le pas ne peut pas être égale à 0 !';
                            
                            default:
                                break;
                        }
                    }
                    
                    else{
                        $parametres = array($borneInf, $borneSup, $pas);
                        $param = serialize($parametres);
                        modifChamp($id, $param);
                        header('Location: controleur-index-champ.php');
                        exit();                        
                    }
                }
            }
            
            /* --- Image --- */
            elseif($type == 'image'){

                if(isset($_GET['afficher']) && isset($_GET['id']) && isset($_GET['type'])){
                    $affiche = $_GET['afficher'];
                    $id = $_GET['id'];
                    $type = $_GET['type'];
            
                    if($affiche == 'edit' && $type == 'image'){
                        $champ = afficheChamp($id);
                    }
                }

                if(isset($_GET['param']) && isset($_GET['id'])){
                    $idparam = $_GET['param'];
                    $id = $_GET['id'];
                    $champname = $champ[1][$idparam];
                    $champname = "upload/".$champname;

                    unlink($champname);
                    unset($champ[1][$idparam]);

                    $param = serialize($champ[1]);
                    modifChamp($id, $param);
                    header('Location: controleur-champ.php?afficher=edit&id='.$id.'&type=image');
                    exit();
                }

                if(isset($_POST['submit']) && isset($_GET['id'])){
                    $id = $_GET['id'];

                    /* --- Upload image --- */
                    $target_dir = "upload/";
                    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                    $fileSize = $_FILES["fileToUpload"]["size"];
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $fileName = $_FILES['fileToUpload']['name'];
                    $randomLettres = randomString();
                    $newName = $randomLettres."-".$fileName;

                    $erreur = verifImage($target_file, $fileSize, $imageFileType);

                    if($erreur != 0){
                        switch($erreur){
                            case 13:
                                $erreur = 'Le fichier existe déjà ou un fichier portant le même nom existe !';
                                break;

                            case 14:
                                $erreur = 'Le fichier est trop volumineux ! La taille maximale est de 2 mo.';
                                break;

                            case 15:
                                $erreur = 'Le fichier doit être au format jpg, png, jpeg ou gif !';
                                break;

                            default:
                                break;
                        }
                    }
                    else{
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$newName)) {
                            $champ[1][] = $newName;
                            $param = serialize($champ[1]);
                            modifChamp($id, $param);
                            header('Location: controleur-champ.php?afficher=edit&id='.$id.'&type=image');
                            exit();
                        }                         
                    }
                }
            }

            else{
                header('Location: 404.php');
            }
        }
    }

/* ----------- Fermeture de la bdd -------------- */
    mysqli_close($con);

/* --------------- Appel la vue ----------------- */
    include("php/vue/vue-champ.php");

