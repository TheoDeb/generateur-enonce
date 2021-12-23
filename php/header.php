<body>
    <div class="app">
        <div class="header">
            <div class="menu-circle"></div>
            <div class="header-menu">
            <?php
                    echo'<a class="menu-link'.($page == "index" ? " is-active" : "").'" href="index.php">Home</a>';
                    echo'<a class="menu-link'.($page == "enonce" ? " is-active" : "").'" href="controleur-index-enonce.php">Énoncés</a>';
                    echo'<a class="menu-link'.($page == "champ" ? " is-active" : "").'" href="controleur-index-champ.php">Champs aléatoires</a>';
                    echo'<a class="menu-link'.($page == "tuto" ? " is-active" : "").'" href="tuto.php">Tuto</a>'; 
            ?>
            </div>
            <div class="header-profile">
                <p id="verssion">V1.0</p>
                <img class="profile-img" src="img/user.png" alt="user">
            </div>
        </div>

        <?php if($page != "404"){?>
            <div class="main-container">
                <div class="content-wrapper">

                    <div class="content-wrapper-header <?php if($page == "index"){echo "content-wrapper-header-index";} elseif($page == "enonce"){echo "content-wrapper-header-enonce";} elseif($page == "champ"){echo "content-wrapper-header-champ";} elseif($page == "tuto"){echo "content-wrapper-header-tuto";} else{} ?>">
                        <div class="content-wrapper-context">
                            <h3 class="img-content">
                                <?php 
                                    if($page == "index"){echo "Générateur d'énoncés";}
                                    elseif($page == "enonce"){echo "Énoncés";}
                                    elseif($page == "champ"){echo "Champs aléatoires";}
                                    elseif($page == "tuto"){echo "Tutos";}
                                    else{header('Location: ./404.php');}
                                ?>
                            </h3>
                            <div class="content-text">
                                <?php 
                                    if($page == "index"){echo "Bienvenue sur le meilleur éditeur, générateur et créateur d'énoncés actuellement. <br>Ce site est optimisé pour google chrome.";}
                                    elseif($page == "enonce"){echo "Création des énoncés.<br>Liste des énoncés.";}
                                    elseif($page == "champ"){echo "Création de champs aléatoires de types texte, nombre et image.<br>Liste de tous les champs aléatoires.";}
                                    elseif($page == "tuto"){echo "Tutos sur les énoncés <br>et sur les champs aléatoires.";}
                                    else{header('Location: ./404.php');}
                                ?>
                            </div>
                        </div>
                        <img class="content-wrapper-img" src="img/bonhome.png" alt="bonhome / icone du site">
                    </div>
                <?php }?>