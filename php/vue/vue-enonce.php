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
    <link rel="stylesheet" href="trix/style/trix.css">
</head>

<?php
    $page = 'enonce';
    require("php/header.php");
?>

                <div class="content-section">
                    <?php
                        if(isset($_GET['afficher'])){
                            $affiche = $_GET['afficher'];
                            
                            if(isset($_GET['id'])){
                                $id = $_GET['id'];

                                if($affiche == 'generate'){
                                    echo '
                                    <fieldset class="fieldset-champs">
                                        <fieldset class="fieldset-champs-secondaire generate">
                                            <h1>'.$enonce["0"].'</h1>
                                        </fieldset>
                                        <fieldset class="fieldset-champs-secondaire liste-30 generate ennonce-affiche">
                                        '.$enonceGenere.'
                                        </fieldset>
                                    </fieldset>
                                    ';
                                } 
                                
                                elseif($affiche == 'edit'){
                                    echo '
                                        <form action="" method="post">
                                            <h1>'.$enonce["0"].'</h1>';
                                            if(isset($content)){
                                                echo '<input id="x" value="'.$content.'" type="hidden" name="content">';
                                            }
                                            else{
                                                echo '<input id="x" value="'.$enonce["1"].'" type="hidden" name="content">';                                     
                                            }
                                            echo '<trix-editor input="x" class="trix-content"></trix-editor>
                                            <p class="nb">* Pour inclure des champs aléatoires, veuillez écrire le nom du champ entre deux # --> ##température##</p>';
                                            if(isset($erreur) && $erreur != ""){
                                                echo '<div class="alert alert-danger erreur" role="alert">'.$erreur.'</div>';
                                            }
                                            echo '<input class="content-button bouton-enregistrer-champs save" type="submit" value="Enregistrer" name="envoyer">
                                        </form>
                                    ';
                                }
                            }

                            elseif($affiche = 'add'){
                                /*
                                    Erreur:
                                        1 -> Enonce vide
                                        2 -> Enonce > 10 000 caractère
                                        3 -> Titre vide
                                        4 -> Titre > 50 caractère
                                        5 -> Titre avec caractères spéciaux
                                */
                                echo '
                                <form action="" method="post">';
                                    if(isset($content)){
                                        echo '<input id="x" value="'.$content.'" type="hidden" name="content">';
                                    }
                                    else{
                                        echo '<input id="x" value="" type="hidden" name="content">';                                     
                                    }
                                    echo '<trix-editor input="x" class="trix-content"></trix-editor>
                                    <p class="nb">* Pour inclure des champs aléatoires, veuillez écrire le nom du champ entre deux # --> ##température##</p>';
                                        if(isset($erreurE) && $erreurE != ""){
                                            echo '<div class="alert alert-danger erreur" role="alert">'.$erreurE.'</div>';
                                        }
                                    echo '<br><label id="name-label">Titre de l\'énoncé :</label>';
                                    if(isset($titre)){
                                        echo '<input type="text" id="name" name="titre" value="'.$titre.'" requierd>';
                                    }
                                    else{
                                        echo '<input type="text" id="name" name="titre" value="" requierd>';                                     
                                    }
                                        if(isset($erreurT) && $erreurT != ""){
                                            echo '<div class="alert alert-danger erreur" role="alert">'.$erreurT.'</div>';
                                        }
                                    echo '<input class="content-button bouton-enregistrer-champs save" type="submit" value="Enregistrer" name="envoyer">
                                </form>';
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
    <script src="trix/js/trix.js"></script>

</body>
</html>