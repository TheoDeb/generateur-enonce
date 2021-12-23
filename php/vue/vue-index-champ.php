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

                <div class="content-section">
                    <div class="content-section-title"></div> 
                    <div class="apps-card">
                        <div class="app-card">
                            <span>
                                <img src="img/svg/text.svg" width="100" height="100" alt="icone champ texte">
                                <h3>Texte</h3>
                            </span>
                            <div class="app-card__subtext">Création d'un champ aléatoire texte.</div>
                            <div class="app-card-buttons">
                            <?php
                                echo '<a href="controleur-champ.php?afficher=add&type=text" class="bouton-new">Nouveau</a>';
                            ?>
                            </div>
                        </div>
                        <div class="app-card">
                            <span>
                                <img src="img/svg/number.svg" width="100" height="100" alt="icone champ nombre">
                                <h3>Nombre</h3>
                            </span>
                            <div class="app-card__subtext">Création d'un champ aléatoire nombre.</div>
                            <div class="app-card-buttons">
                            <?php
                                echo '<a href="controleur-champ.php?afficher=add&type=number" class="bouton-new">Nouveau</a>';
                            ?>
                            </div>
                        </div>
                        <div class="app-card">
                            <span>
                                <img src="img/svg/image.svg" width="100" height="100" alt="icone champ image">       
                                <h3>Image</h3>
                            </span>
                            <div class="app-card__subtext">Création d'un champ aléatoire image.</div>
                            <div class="app-card-buttons">
                            <?php
                                echo '<a href="controleur-champ.php?afficher=add&type=image" class="bouton-new">Nouveau</a>';
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-section liste">
                    <div class="content-section-title">Liste des champs aléatoires :</div>
                    <ul class="liste-champs liste-30">
                        <?php
                            if($nbrChamp > 0){
                                foreach($Champs as $champ){
                                    echo '<li class="adobe-product">
                                            <div class="products">
                                                <img src="img/svg/'.$champ["typechamp"].'.svg" class="dossier-img" alt="icone du champ aléatoire">
                                                '.$champ["nom"].'
                                            </div>
                                            <span class="status">';
                                                if($champ['typechamp'] == 'text'){echo 'Texte';} elseif($champ['typechamp'] == 'number'){echo'Nombre';} elseif($champ['typechamp'] == 'image'){echo'Image';}
                                            echo '</span>
                                            <div class="button-wrapper">
                                                <a href="controleur-champ.php?afficher=edit&id='.$champ["idChamp"].'&type='.$champ["typechamp"].'" class="content-button status-button open"><img src="img/svg/edit.svg" class="editSupprime" alt="icone modifier"></a>'; ?>
                                                <button type="button" class="content-button status-button open margin-left-15 delete-button" data-toggle="modal" data-target="#modal<?php echo $champ["idChamp"]; ?>">
                                                    <img src="img/svg/delete.svg" class="editSupprime" alt="icone supprimer">
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="modal<?php echo $champ["idChamp"]; ?>" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Supprimer</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            Voulez-vous vraiment supprimer le champ aléatoire <br>
                                                            <?php echo $champ["nom"]; ?> ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="modal-bleu" data-dismiss="modal">Annuler</button>
                                                            <?php echo '<a href="controleur-index-champ.php?afficher=delete&id='.$champ["idChamp"].'&type='.$champ["typechamp"].'" class="modal-rouge">Supprimer</a>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            </div>
                                        </li>';
                                }
                            }
                            else{
                                echo '<li class="adobe-product">
                                    <div class="products">
                                        Aucun champ  
                                    </div>
                                </li>';
                            }
                        ?>

                    </ul>
                </div>
            </div>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script  src="js/script.js"></script>

</body>
</html>
