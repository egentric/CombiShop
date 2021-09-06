<?php
session_start();

$pdo = new PDO(
    'mysql:host=localhost;dbname=combishop;port=3306',
    'root',
    '',
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$req1 = $pdo->prepare("SELECT * FROM produits
INNER JOIN categories ON produits.id_categorie = categories.id_categorie
INNER JOIN users ON produits.id_user = users.id_user");
$req1->execute();
$produits = $req1->fetchAll(PDO::FETCH_ASSOC);

$req2 = $pdo->prepare("SELECT * FROM categories");
$req2->execute();
$categorie = $req2->fetchAll(PDO::FETCH_ASSOC);

$req3 = $pdo->prepare("SELECT * FROM users");
$req3->execute();
$users = $req3->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CombiShop</title>

    <!-- icon-->
    <script src="https://kit.fontawesome.com/cb109f8570.js" crossorigin="anonymous"></script>

    <!-- Fonts-->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Molle:ital@1&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link rel="stylesheet" href="./Ressources/CSS/style.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>


</head>

<body>
    <?php
    include 'head.php';
    ?>


    <section class="container">

        <div class="d-flex justify-content-center align-items-center">
            <h1>Tableau de bord Admin</h1>

        </div>

        <div class="d-flex justify-content-end">
            <?php
            if ($_SESSION['role'] == 'admin') {
                echo '<p class="gestion"><a href="tabord.php">Mon tableau de bord</a></p>';
            }
            ?>
        </div>


        <!--  UTILISATEUR
================================================================= -->

        <div class="d-flex flex-column justify-content-center table-responsive-lg box">
                <h4>Utilisateurs</h4>
                <table>
                    <thead>
                        <th>Pseudo</th>
                        <th>Email</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Adresse</th>
                        <th>Code Postal</th>
                        <th>Ville</th>
                        <th>role</th>
                        <th>Date création</th>
                        <th colspan="2" class="center">Action</th>

                    </thead>
                    <tbody>
                        <?php
                        foreach ($users as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value['pseudo'] ?></td>
                                <td><?php echo $value['email'] ?></td>
                                <td><?php echo $value['nom'] ?></td>
                                <td><?php echo $value['prenom'] ?></td>
                                <td><?php echo $value['adresse'] ?></td>
                                <td><?php echo $value['codePostal'] ?></td>
                                <td><?php echo $value['ville'] ?></td>
                                <td><?php echo $value['role'] ?></td>
                                <td><?php echo $value['dateCreate'] ?></td>
                                <td class="center"><a href="updateUsers.php?id=<?php echo $value['id_user'] ?>"><i class="fas fa-pencil-alt"></i></td>
                                <td class="center"><a href="deleteUsers.php?id=<?php echo $value['id_user'] ?>"><i class="fas fa-trash-alt"></i></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
        </div>



        <!--  ANNONCES
================================================================= -->



        <div class="d-flex flex-column justify-content-center table-responsive-lg box">
                <h4>Annonces</h4>
                <table>
                    <thead>
                        <th>Pseudo</th>
                        <th>Photo</th>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Année</th>
                        <th>Km</th>
                        <th>Prix</th>
                        <th>Description</th>
                        <th>Département</th>
                        <th>Ville</th>
                        <th>Date création</th>
                        <th colspan="2" class="center">Action</th>

                    </thead>
                    <tbody>
                        <?php
                        foreach ($produits as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value['pseudo'] ?></td>
                                <td><img src="<?php echo "./uploads/$value[img]" ?>" width=100 height=75></td>
                                <td><?php echo $value['title'] ?></td>
                                <td><?php echo $value['nomCategorie'] ?></td>
                                <td><?php echo $value['year'] ?></td>
                                <td><?php echo $value['km'] ?></td>
                                <td><?php echo $value['price'] ?></td>
                                <td><?php echo $value['description'] ?></td>
                                <td><?php echo $value['dept'] ?></td>
                                <td><?php echo $value['ville'] ?></td>
                                <td><?php echo $value['dateCreateProd'] ?></td>
                                <td class="center"><a href="updateAnnonces.php?id=<?php echo $value['id_produit'] ?>"><i class="fas fa-pencil-alt"></i></td>
                                <td class="center"><a href="deleteAnnonces.php?id=<?php echo $value['id_produit'] ?>"><i class="fas fa-trash-alt"></i></td>
                            </tr>
                        <?php

                        }
                        ?>
                    </tbody>
                </table>
        </div>

        <div class="d-flex flex-column justify-content-center align-items-center table-responsive-lg box">
            
                <form action="createCategories.php" method="post">
                    <h4>Gatégories</h4>
                    <input class="" type="text" name="nomCategorie" placeholder="Catégorie">
                    <input class="envoie" type="submit" value="Ajouter">
                </form>

                <table class="tab">
                    <thead>
                        <th>Nom Catégories</th>
                        <th colspan="2" class="center">Action</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($categorie as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value['nomCategorie'] ?></td>
                                <td class="center"><a href="updateCategories.php?id=<?php echo $value['id_categorie'] ?>"><i class="fas fa-pencil-alt"></i></td>
                                <td class="center"><a href="deleteCategories.php?id=<?php echo $value['id_categorie'] ?>"><i class="fas fa-trash-alt"></i></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
        </div>

    </section>

    <?php
    include 'footer.php';
    ?>

</body>

</html>