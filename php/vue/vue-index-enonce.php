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
    $page = 'enonce';
    require("php/header.php");
?>

                <!-- ++++++++++ Création d'un new énoncés ++++++++++ -->
                <div class="content-section liste">
                    <div class="content-section-title"></div> 
                    <div class="apps-card">
                        <div class="app-card non-hover">
                            <span>
                                <img src="img/bonhome.png" alt="" width="215" height="215" class="img-index-enonce" alt="bonhome / icone du site">
                            </span>
                        </div>
                        <div class="app-card">
                            <span>
                                <img src="img/svg/enonce.svg" width="100" height="100" alt="icone des énoncés">
                                <h3>Enoncés</h3>
                            </span>
                            <div class="app-card__subtext">Création d'un nouvel énoncé.</div>
                            <div class="app-card-buttons">
                            <?php
                                echo '<a href="controleur-enonce.php?afficher=add" class="bouton-new">Nouveau</a>';
                            ?>
                            </div>
                            </div>
                        <div class="app-card non-hover">
                            <span>      
                                <img src="img/bonhome.png" alt="" width="215" height="215" class="img-index-enonce" alt="bonhome / icone du site">
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- ++++++++++ Affichage des derniers énoncés ++++++++++ -->
                <div class="content-section liste">
                    <div class="content-section-title">Liste des énoncés :</div>
                    <ul class="liste-30">
                        <?php
                            if($nbrEnonce > 0){
                                foreach($Enonces as $enonce){
                                    ?>
                                        <li class="adobe-product">
                                            <div class="products">
                                                <img src="img/svg/enonce.svg" class="dossier-img" alt="icone des énoncés">
                                                <?php
                                                    echo $enonce["titre"];
                                                ?>
                                            </div>
                                            <span class="status">
                                                <?php
                                                    echo '<a href="controleur-enonce.php?afficher=generate&id='.$enonce["idEnonce"].'" class="content-button status-button open margin-left-15 ">Afficher</a>';
                                                ?>
                                            </span>
                                            <div class="button-wrapper">
                                                <?php
                                                    echo '<a href="controleur-enonce.php?afficher=edit&id='.$enonce["idEnonce"].'" class="content-button status-button open"><img src="img/svg/edit.svg" width="20px" height="20px" alt="icone modifier"></a>';
                                                    echo '<a href="php/enonce.php?id='.$enonce["idEnonce"].'" class="content-button status-button open margin-left-15" download><img src="img/svg/download.svg" width="20px" height="20px" alt="icone télécharger"></a>';
                                                ?>
                                                <button type="button" class="content-button status-button open margin-left-15 delete-button" data-toggle="modal" data-target="#modal<?php echo $enonce["idEnonce"]; ?>">
                                                    <img src="img/svg/delete.svg" width="20px" height="20px" alt="icone supprimer">
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="modal<?php echo $enonce["idEnonce"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Supprimer</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            Voulez-vous vraiment supprimer l'énoncé <br>
                                                            <?php echo $enonce["titre"]; ?> ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="modal-bleu" data-dismiss="modal">Annuler</button>
                                                            <?php echo '<a href="controleur-index-enonce.php?afficher=delete&id='.$enonce["idEnonce"].'" class="modal-rouge">Supprimer</a>'; ?>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php
                                }
                            }
                            else{
                                ?>
                                    <li class="adobe-product">
                                        <div class="products">
                                            Aucun énoncé 
                                        </div>
                                    </li> 
                                <?php
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