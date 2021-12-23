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
    $page = 'tuto';
    require("./php/header.php");
?>

                <div class="content-section liste">
                    <fieldset class="fieldset-champs">
                        <fieldset class="fieldset-champs-secondaire generate">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h1>Enoncés</h1>
                                        <p>
                                            Si tu ne sais pas comment créer de nouveaux énoncés ou si tu rencontres des problèmes, tu es au bon endroit. Cette petite vidéo d'une minute va t'expliquer en détail tout ce que tu dois savoir sur les énoncés. Si tu as d'autres questions, contacte-moi par mail à theo.debefve@gmail.com
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="fieldset-champs-secondaire">
                            <div class="video-outer">
                                <video controls width="700px">
                                    <source src="img/video/enonce.mp4" type="video/mp4">
                                        Désolé, ton navigateur ne supporte pas les vidéos.
                                </video>
                            </div>
                        </fieldset>
                        <br>
                    </fieldset>
                </div>

                <div class="content-section liste">
                    <fieldset class="fieldset-champs">
                        <fieldset class="fieldset-champs-secondaire generate">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h1>Champs aléatoires</h1>
                                        <p>
                                            Si tu ne sais pas comment créer de nouveaux champs aléatoires ou si tu rencontres des problèmes, tu es au bon endroit. Cette petite vidéo d'une minute va t'expliquer en détail tout ce que tu dois savoir sur les champs aléatoires. Si tu as d'autres questions, contacte-moi par mail à theo.debefve@gmail.com
                                        </p> 
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="fieldset-champs-secondaire">
                            <div class="video-outer">
                                <video controls width="700px">
                                    <source src="img/video/champ.mp4" type="video/mp4">
                                        Désolé, ton navigateur ne supporte pas les vidéos.
                                </video>
                            </div>
                        </fieldset>
                        <br>
                    </fieldset>
                </div>

                <div class="content-section liste">
                    <fieldset class="fieldset-champs">
                        <fieldset class="fieldset-champs-secondaire generate">
                            <div class="container-fluid">
                                <p id="txt-chrome">
                                    Ce site a été optimisé pour Google Chrome.
                                </p>
                                <img src="img/svg/chrome.svg" id="chrome" alt="logo Google chrome">
                            </div>
                        </fieldset>
                        <br>
                    </fieldset>
                </div>

            </div>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script  src="js/script.js"></script>

</body>
</html>