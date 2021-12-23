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

$link = 'https://generateur-enonce.theo-debefve.be';

?>

<!DOCTYPE html>
<html lang="fr" >
<head>
    <meta charset="UTF-8">
    <title>Générateur d'énoncé</title>
    <link rel="icon" type="image/x-icon" href="img/bonhome.ico" />
    <link rel="shortcut icon" type="image/x-icon" href="img/bonhome.ico" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <?php
        echo '
        <link rel="stylesheet" href="'. $link .'/css/style.css">
        <link rel="stylesheet" href="'. $link .'/css/monstyle.css">
        <link rel="stylesheet" href="'. $link .'/css/download.css">';
    ?>
</head>
<body class="generate">

    <div class="content-section">
        <?php
            include("model.php");

            if(isset($_GET['id'])){ 
                $id = $_GET['id'];
                $enonce = afficheEnonce($id);
                $enonceComplet = modifieAleatoire($enonce[1]);

                echo '
                <fieldset class="fieldset-champs">
                    <fieldset class="fieldset-champs-secondaire">
                        <h1>'.$enonce[0].'</h1>
                    </fieldset>
                    <fieldset class="fieldset-champs-secondaire generate">
                    '.$enonceComplet.'
                    </fieldset>
                    <br><p id="copyright">© Theo Debefve - Générateur d\'énoncés - 2021</p>
                </fieldset>';
            }
        ?>
    </div>

</body>
</html>