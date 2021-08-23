    <header>
        <div class="container d-flex align-items-center justify-content-around">
            <?php
            if (isset($_SESSION['id_user']) and isset($_SESSION['pseudo'])) { ?>

                <p class="pseudo"> <?php echo '<a href="./tabord.php">' . $_SESSION['pseudo'];
                                    '</a>'; ?> 
                <a href="deconnexion.php"><i class="far fa-times-circle"></i></a>
            </p>
            <?php
            } ?>

            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php"><img src="./Ressources/images/logo2.png" class="logo2"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="annonces.php"><i class="fas fa-home"></i></a>
                            </li>
                            <?php
                            foreach ($categorie as $key => $value) { ?>
                                <li class="nav-item">
                                    <a class="nav-link menu" href="annonces.php?id=<?php echo $value['id_categorie'] ?>">
                                        <?php echo $value['nomCategorie'] ?>
                                    </a>
                                </li>
                            <?php }
                            ?>

                        </ul>

                    </div>
                </div>
            </nav>

            <?php
            if (!isset($_SESSION['id_user']) and !isset($_SESSION['pseudo'])) {
                echo '<div class="d-flex justify-content-end"><a href="connexion.php"><i class="fas fa-user"></i></a>
                    <a href="users.php"><i class="fas fa-user-edit"></i><a></div>';
            }
            ?>

        </div>
    </header>