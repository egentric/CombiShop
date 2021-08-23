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

$req2 = $pdo->prepare("SELECT * FROM categories");
$req2->execute();
$categorie = $req2->fetchAll(PDO::FETCH_ASSOC);

$req3 = $pdo->prepare("SELECT * FROM users WHERE id_user = $id");
$req3->execute();
$users = $req3->fetchAll(PDO::FETCH_ASSOC);

$req1 = $pdo->prepare("SELECT * FROM produits");
$req1->execute();
$produits = $req1->fetch();


if ($_POST) {
    $pseudo = htmlspecialchars ($_POST['pseudo']);
    $email = htmlspecialchars ($_POST['email']);
    $nom = htmlspecialchars ($_POST['nom']);
    $prenom = htmlspecialchars ($_POST['prenom']);
    $adresse = htmlspecialchars ($_POST['adresse']);
    $codePostal = htmlspecialchars ($_POST['codePostal']);
    $ville = htmlspecialchars ($_POST['ville']);


    $req3 = $pdo->prepare("UPDATE `users` 
                        SET `pseudo`= :pseudo,`email`= :email,`nom`= :nom,`prenom`= :prenom,`adresse`= :adresse, `codePostal`= :codePostal, `ville`= :ville
                        WHERE id_user = $id");

$req3->execute(array(
    ':pseudo' => $pseudo,
    ':email' => $email,
    ':nom' => $nom,
    ':prenom' => $prenom,
    ':adresse' => $adresse,
    ':codePostal' => $codePostal,
    ':ville' => $ville,
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

            <form class="" action="updateUsers.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">

                <h4>Modifications d'informations</h4>
<?php
foreach ($users as $key => $value) {?>

                <input class="input" type="text" name="pseudo" value="<?php echo $value['pseudo'] ?>" placeholder="Pseudo">
                <input class="input" type="text" name="email" value="<?php echo $value['email'] ?>" placeholder="Email">
                <input class="input" type="text" name="nom" value="<?php echo $value['nom'] ?>" placeholder="Nom">
                <input class="input" type="text" name="prenom" value="<?php echo $value['prenom'] ?>" placeholder="Prénom">
                <input class="input" type="text" name="adresse" value="<?php echo $value['adresse'] ?>" placeholder="Adresse">
                <input class="input" type="text" name="codePostal" value="<?php echo $value['codePostal'] ?>" placeholder="Code postal">
                <input class="input" type="text" name="ville" value="<?php echo $value['ville'] ?>" placeholder="Ville">
                <input class="btn" type="submit" value="Modifier">
<?php
}
?>

            </form>
        </div>


    </section>

    <?php
    include 'footer.php';
    ?>



</body>
</html>