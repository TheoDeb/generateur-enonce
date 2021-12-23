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
    $page = 'index';
    require("php/header.php");
?>

                <div class="content-section liste">
                    <fieldset class="fieldset-champs">
                        <fieldset class="fieldset-champs-secondaire">
                            <div class="video-outer">
                                <video controls width="700px">
                                    <source src="img/video/home.mp4" type="video/mp4">
                                    Désolé, ton navigateur ne supporte pas les vidéos.
                                </video>
                            </div>
                        </fieldset>
                        <fieldset class="fieldset-champs-secondaire">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>
                                            Bienvenue sur mon générateur d'énoncés. C'est un outil très pratique qui va te permettre de créer des énoncés avec
                                            des valeurs aléatoires. Le principe est de créer des champs aléatoires de type texte, nombre et image que tu peux
                                            ensuite intégrer dans ton énoncé. Cet outil s'adresse surtout aux professeurs ou instituteurs qui veulent un énoncé
                                            unique, mais avec des valeurs différentes. Si tu as des problèmes, n'hésite pas à te rendre dans l'onglet tuto ou chaque
                                            fonctionnalité te sera expliquée.<br><br>
                                            Theo Debefve
                                        </p> 
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <br>
                    </fieldset>
                </div>

                <!-- ++++++++++ Affichage des derniers énoncés ++++++++++ -->
                <div class="content-section liste">
                    <div class="content-section-title">Les derniers énoncés :</div>
                    <ul>
                        <?php
                            if($nbrEnonce > 0){
                                foreach($lastEnonce as $enonce){
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
                                                    echo 'Id : '.$enonce["idEnonce"].'';
                                                ?>
                                            </span>
                                            <div class="button-wrapper">
                                                <?php 
                                                    echo '<a href="controleur-enonce.php?afficher=generate&id='.$enonce["idEnonce"].'" class="content-button status-button open">Afficher</a>'; 
                                                ?>
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
                
                <!-- ++++++++++ Affichage des derniers champs ++++++++++ -->
                <div class="content-section liste">
                    <div class="content-section-title">Les derniers champs aléatoires :</div>
                    <ul>
                        <?php
                            if($nbrChamp > 0){
                                foreach($lastChamp as $champ){
                                    ?>
                                        <li class="adobe-product">
                                            <div class="products">
                                                <?php
                                                    echo '<img src="img/svg/'.$champ['typechamp'].'.svg" class="dossier-img" alt="iconde des champs aléatoires">';
                                                    echo $champ['nom'];
                                                ?>    
                                            </div>
                                            <span class="status">
                                                <?php
                                                    if($champ['typechamp'] == 'text'){echo 'Texte';} elseif($champ['typechamp'] == 'number'){echo'Nombre';} elseif($champ['typechamp'] == 'image'){echo'Image';}
                                                ?>
                                            </span>
                                            <div class="button-wrapper">
                                                <?php
                                                    echo '<a href="controleur-champ.php?afficher=edit&id='.$champ['idChamp'].'&type='.$champ['typechamp'].'" class="content-button status-button open">Modifier</a>';
                                                ?>
                                            </div>
                                        </li>
                                    <?php                               
                                }
                            }
                            else{
                                ?>
                                    <li class="adobe-product">
                                        <div class="products">
                                            Aucun champ  
                                        </div>
                                    </li>
                                <?php
                            }
                        ?>
                    </ul>
                </div>

                <div class="content-section">
                    <div class="content-section-title"></div>
                    <div class="apps-card-index">
                        <div class="app-card">
                            <span>
                                <img src="img/user.png" id="user_img" alt="user image">
                                Theo Debefve
                            </span>
                            <div class="app-card__subtext">
                                Projet de fin d'année du cours de programmation web.
                            </div>
                            <div class="app-card__subtext_2 app-card-my2">
                                Etudiant en 1ère informatique de gestion
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script  src="js/script.js"></script>

</body>
</html>