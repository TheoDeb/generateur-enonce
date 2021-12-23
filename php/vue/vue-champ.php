<!--
######################################################
#                                                    #
#   Theo Debefve - 1ère informatique de gestion      #
#     Projet de fin d'année programmation web        #
#                   Juin 2021                        #
#                     V 1.0                          #
#                                                    #
######################################################
-->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Générateur d'énoncé</title>
    <link rel="icon" type="image/x-icon" href="img/bonhome.ico"/>
    <link rel="shortcut icon" type="image/x-icon" href="img/bonhome.ico"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/monstyle.css">
</head>

<?php
    $page = 'champ';
    require("php/header.php");
?>

                <div class="content-section liste">
                    <?php
                        /* ----------  Ajout et modification des champs ----------- */
                        if(isset($_GET['afficher']) && isset($_GET['type'])){
                            $affiche = $_GET['afficher'];
                            $type = $_GET['type'];

                            /* -----  Modification ------ */
                            if(isset($_GET['id']) && $affiche == 'edit'){

                                $id = $_GET['id'];

                                /* --- Texte --- */
                                if($type == 'text'){
                                    echo '
                                        <fieldset class="fieldset-champs">
                                            <h2 class="txt-champs">'.$champ[0].'</h2>
                                            <p class="txt-champs">Ajout de paramètres au champ aléatoire.</p>
                                            <form action="" method="post">
                                                <fieldset class="fieldset-champs-secondaire">
                                                    <label class="txt-champs text-name-label">Ajouter un paramètre :</label>';
                                                    if(isset($parametre)){
                                                        echo '<input type="text" id="text-name" value="'.$parametre.'" name="parametre">';
                                                    }
                                                    else{
                                                        echo '<input type="text" id="text-name" name="parametre">';                                     
                                                    }
                                                    echo '<input class="content-button bouton-enregistrer-champs" type="submit" value="Ajouter" name="ajouterV">
                                                    <a href="controleur-index-champ.php" class="content-button bouton-enregistrer-champs save">Enregistrer</a>';
                                                    
                                                    if(isset($erreur) && $erreur != ""){
                                                        echo '<div class="alert alert-danger erreur" role="alert">'.$erreur.'</div>';
                                                    }
                                                echo '</fieldset>
                                            </form>
                                            <br>
                                            ';
                                
                                            if(!empty($champ[1])){
                                                echo '<ul class="liste-champs liste-30">';
                                                foreach($champ[1] as $key => $texte){
                                                    echo '<li class="adobe-product">
                                                    <div class="products">
                                                        <img src="img/svg/champ-text.svg" class="dossier-img">
                                                    </div>
                                                    <span class="status">
                                                        '.$texte.'
                                                    </span>
                                                    <div class="button-wrapper">' ?>

                                                        <button type="button" class="content-button status-button open delete-button" data-toggle="modal" data-target="#modal<?php echo $key; ?>">
                                                            Supprimer
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="modal<?php echo $key; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">Supprimer</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Voulez-vous vraiment supprimer le paramètre " <?php echo $champ[1][$key]; ?> " <br> du champ aléatoire <?php echo $champ[0]; ?>?<br><p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="modal-bleu" data-dismiss="modal">Annuler</button>
                                                                    <?php echo '<a href="controleur-champ.php?afficher=edit&id='.$id.'&type=text&param='.$key.'" class="modal-rouge">Supprimer</a>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </li>';
                                                } 
                                                echo '</ul>';                                            
                                            }
                                        echo '
                                        </fieldset>
                                    ';
                                }
                                
                                /* --- Nombre --- */
                                elseif($type == 'number'){
                                    echo '
                                        <form action="" method="post">
                                            <fieldset class="fieldset-champs">
                                                <h2 class="txt-champs">'.$champ[0].'</h2>
                                                <p class="txt-champs text-name-label">Modification d\'un champ aléatoire de type nombre.</p>
                                                <fieldset class="fieldset-champs-secondaire">
                                                    <label class="txt-champs text-name-label">Borne inférieure :</label>';
                                                    if(isset($borneInf)){
                                                        echo '<input type="text" id="text-name" value="'.$borneInf.'" name="borneInf"><br>';
                                                    }
                                                    else{
                                                        echo '<input type="text" id="text-name" value="'.$champ[1][0].'" name="borneInf"><br>';                                     
                                                    }
                                                    echo '<label class="txt-champs text-name-label">Borne supérieure :</label>';
                                                    if(isset($borneSup)){
                                                        echo '<input type="text" id="text-name" value="'.$borneSup.'" name="borneSup"><br>';
                                                    }
                                                    else{
                                                        echo '<input type="text" id="text-name" value="'.$champ[1][1].'" name="borneSup"><br>';                                     
                                                    }
                                                    echo '<label class="txt-champs text-name-label">Valeur du pas :</label>';
                                                    if(isset($pas)){
                                                        echo '<input type="text" id="text-name" value="'.$pas.'" name="pas"><br>';
                                                    }
                                                    else{
                                                        echo '<input type="text" id="text-name" value="'.$champ[1][2].'" name="pas"><br>';                                     
                                                    }
                                                echo '</fieldset>';
                                                if(isset($erreurP) && $erreurP != ""){
                                                    echo '<br><div class="alert alert-danger erreur" role="alert">'.$erreurP.'</div>';
                                                }
                                                echo '<input class="content-button bouton-enregistrer-champs save" type="submit" value="Enregistrer">
                                            </fieldset>
                                        </form>
                                    ';
                                }
                                
                                /* --- Image --- */
                                elseif($type == 'image'){
                                    echo '
                                        <fieldset class="fieldset-champs">
                                            <a href="controleur-index-champ.php" class="content-button bouton-enregistrer-champs save">Enregistrer</a>
                                            <h2 class="txt-champs">'.$champ[0].'</h2>
                                            <p class="txt-champs">Ajout des images au champ aléatoire.</p>

                                            <form action="" method="post" enctype="multipart/form-data" id="file-upload-form" class="uploader">
                                                <div class="image-upload-wrap">
                                                    <input class="file-upload-input" name="fileToUpload" id="fileToUpload" type="file" onchange="readURL(this);" accept="image/*" />
                                                    <fieldset class="fieldset-champs fieldset-champs-secondaire">
                                                        <div class="drag-text">
                                                            <h3>Faites glisser et déposez un fichier</h3>
                                                        </div>';
                                                        if(isset($erreur) && $erreur != ""){
                                                            echo '<div class="alert alert-danger erreur" role="alert">'.$erreur.'</div>';
                                                        }
                                                    echo '</fieldset>    
                                                </div>
                                                <div class="file-upload-content">
                                                    <fieldset class="fieldset-champs fieldset-champs-secondaire">
                                                        <img class="file-upload-image" src="#" alt="your image" />
                                                        <div class="image-title-wrap">
                                                            <button type="button" onclick="removeUpload()" class="remove-image">Supprimer</button>
                                                            <input class="content-button bouton-enregistrer-champs" type="submit" name="submit" value="Ajouter">
                                                        </div>
                                                    </fieldset>
                                                </div> 
                                            </form>';
                                            
                                            echo '<fieldset class="fieldset-image">';
                                            if(!empty($champ[1])){
                                                echo '<ul class="liste-champs liste-30">';
                                                foreach($champ[1] as $key => $image){
                                                    $champname = $image;
                                                    $champname = "upload/".$champname;
                                                    echo '<li class="adobe-product">
                                                    <div class="products">
                                                        <img src="'.$champname.'" height="100px">
                                                    </div>
                                                    <span class="status">
                                                        '.$image.'
                                                    </span>'; ?>
                                                    <div class="button-wrapper">

                                                        <button type="button" class="content-button status-button open delete-button" data-toggle="modal" data-target="#modal<?php echo $key; ?>">
                                                            Supprimer
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="modal<?php echo $key; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                    <h4 class="modal-title" id="myModalLabel">Supprimer</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Voulez-vous vraiment supprimer l'image<br> " <?php echo $champ[1][$key]; ?> "<br> du champ aléatoire <?php echo $champ[0]; ?> ?<br><br>
                                                                    <?php echo '<img src="'.$champname.'" height="100px" class="img-modal">'; ?>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="modal-bleu" data-dismiss="modal">Annuler</button>
                                                                    <?php echo '<a href="controleur-champ.php?afficher=edit&id='.$id.'&type=image&param='.$key.'" class="modal-rouge">Supprimer</a>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </li>';
                                                } 
                                                echo '</ul>';                                            
                                            }
                                            else{
                                                echo '
                                                <ul class="liste-champs">
                                                    <li class="adobe-product">
                                                        <div class="products">
                                                            Aucun champ  
                                                        </div>
                                                    </li>
                                                </ul>';
                                            }
                                            echo '</fieldset>';
                                            echo '
                                        </fieldset>
                                    ';
                                }

                                /* --- Erreur Modif --- */
                                else{
                                    header('Location: 404.php');
                                }
                            }

                            /* -----  Ajout ------ */
                            elseif($affiche == 'add'){

                                /* --- Texte --- */
                                if($affiche == 'add' && $type == 'text'){
                                    echo '
                                        <fieldset class="fieldset-champs">
                                            <h2 class="txt-champs">Texte</h2>
                                            <p class="txt-champs">Création d un champ aléatoire de type texte.</p>
                                            <form action="" method="post">
                                                <label class="txt-champs text-name-label">Veuillez saisir le nom du champ :</label>';
                                                if(isset($nom)){
                                                    echo '<input type="text" id="text-name" value="'.$nom.'" name="nom">';
                                                }
                                                else{
                                                    echo '<input type="text" id="text-name" name="nom">';                                     
                                                }

                                                if(isset($erreur) && $erreur != ""){
                                                    echo '<div class="alert alert-danger erreur" role="alert">'.$erreur.'</div>';
                                                }
                                                echo '<input class="content-button bouton-enregistrer-champs" type="submit" value="Ajouter le champ">
                                            </form>
                                        </fieldset>
                                    ';
                                }
                                
                                /* --- Nombre --- */
                                elseif($affiche == 'add' && $type == 'number'){
                                    echo '
                                        <fieldset class="fieldset-champs">
                                            <h2 class="txt-champs">Nombre</h2>
                                            <p class="txt-champs">Création d un champ aléatoire de type nombre.</p>
                                            <form action="" method="post">
                                                <label class="txt-champs text-name-label">Veuillez saisir le nom du champ :</label>';
                                                if(isset($nom)){
                                                    echo '<input type="text" id="text-name" value="'.$nom.'" name="nom">';
                                                }
                                                else{
                                                    echo '<input type="text" id="text-name" name="nom">';                                     
                                                }

                                                if(isset($erreur) && $erreur != ""){
                                                    echo '<div class="alert alert-danger erreur" role="alert">'.$erreur.'</div>';
                                                }
                                                echo '<input class="content-button bouton-enregistrer-champs" type="submit" value="Ajouter le champ">
                                            </form>
                                        </fieldset>
                                    ';
                                }
                                
                                /* --- Image --- */
                                elseif($affiche == 'add' && $type == 'image'){
                                    echo '
                                        <fieldset class="fieldset-champs">
                                            <h2 class="txt-champs">Image</h2>
                                            <p class="txt-champs">Création d un champ aléatoire de type image.</p>
                                            <form action="" method="post">
                                                <label class="txt-champs text-name-label">Veuillez saisir le nom du champ :</label>';

                                                if(isset($nom)){
                                                    echo '<input type="text" id="text-name" value="'.$nom.'" name="nom">';
                                                }
                                                else{
                                                    echo '<input type="text" id="text-name" name="nom" requierd>';                                     
                                                }

                                                if(isset($erreur) && $erreur != ""){
                                                    echo '<div class="alert alert-danger erreur" role="alert">'.$erreur.'</div>';
                                                }

                                                echo '
                                                <input class="content-button bouton-enregistrer-champs" type="submit" value="Ajouter le champ">
                                            </form>
                                        </fieldset>
                                    ';
                                }
                                
                                /* --- Erreur Ajout --- */
                                else{
                                    header('Location: 404.php');
                                }
                            }

                            /* ----- Erreur Ajout/Modif -----  */
                            else{
                                header('Location: 404.php');
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script  src="js/script.js"></script>
    <script  src="js/upload.js"></script>

</body>
</html>