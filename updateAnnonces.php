<?php
session_start();

$id = $_GET['id'];

$pdo = new PDO(
    'mysql:host=localhost;dbname=combishop;port=3306',
    'root',
    '',
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// $req1 = $pdo->prepare("SELECT * FROM produits INNER JOIN categories ON produits.id_categorie = categories.id_categorie");
// $req1->execute();
// $produits = $req1->fetchAll(PDO::FETCH_ASSOC);


$req2 = $pdo->prepare("SELECT * FROM categories");
$req2->execute();
$categorie = $req2->fetchAll(PDO::FETCH_ASSOC);

$req3 = $pdo->prepare("SELECT * FROM users");
$req3->execute();
$users = $req3->fetchAll(PDO::FETCH_ASSOC);

$req4 = $pdo->prepare("SELECT * FROM produits WHERE id_produit = $id");
$req4->execute();
$produits = $req4->fetch();


if ($_POST) {
    $title = htmlspecialchars($_POST['title']);
    $year = htmlspecialchars($_POST['year']);
    $km = htmlspecialchars($_POST['km']);
    $price = htmlspecialchars($_POST['price']);
    $description = htmlspecialchars($_POST['description']);
    $ville = htmlspecialchars($_POST['ville']);
    $dept = htmlspecialchars($_POST['dept']);
    $id_categorie = htmlspecialchars($_POST['categories']);


    $req4 = $pdo->prepare("UPDATE `produits` 
                        SET `title`= :title,`year`= :year,`km`= :km,`price`= :price,`description`= :description, `ville`= :ville, `dept`= :dept, `id_categorie`= :id_categorie
                        WHERE id_produit = $id");

    $req4->execute(array(
        ':title' => $title,
        ':year' => $year,
        ':km' => $km,
        ':price' => $price,
        ':description' => $description,
        ':ville' => $ville,
        ':dept' => $dept,
        ':id_categorie' => $id_categorie,
    ));
    header('location:tabord.php');
}
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
            <h1>Tableau de bord</h1>
        </div>

        <div class="d-flex justify-content-center align-items-center box">

            <form class="" action="updateAnnonces.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">

                <h4>Modifications d'annonces</h4>

                <input class="input" type="text" name="title" value="<?php echo $produits['title'] ?>" placeholder="Titre">
                <input class="input" type="text" name="year" value="<?php echo $produits['year'] ?>" placeholder="Année">
                <input class="input" type="text" name="km" value="<?php echo $produits['km'] ?>" placeholder="Kilomètre">
                <input class="input" type="text" name="price" value="<?php echo $produits['price'] ?>" placeholder="Prix">
                <input class="input" type="text" name="ville" value="<?php echo $produits['ville'] ?>" placeholder="Ville">
                <input class="input" type="text" name="dept" value="<?php echo $produits['dept'] ?>" placeholder="Département">

                <label for="categories"> Catégories :</label>
                <select class="" name="categories">
                    <?php
                    foreach ($categorie as $key => $value) { ?>
                        <option value="<?php echo $value['id_categorie'] ?>"><?php echo $value['nomCategorie'] ?></option>
                    <?php }
                    ?>
                </select>

                <textarea class="" name="description" cols="80" rows="8" placeholder="Description"><?php echo $produits['description'] ?></textarea>
                <input class="btn" type="submit" value="Modifier">


            </form>
        </div>


    </section>

    <?php
    include 'footer.php';
    ?>

</body>

</html>