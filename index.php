<?php
session_start();

$pdo = new PDO(
    'mysql:host=localhost;dbname=combishop;port=3306',
    'root',
    '',
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$req1 = $pdo->prepare("SELECT * FROM produits");
$req1->execute();
$produits = $req1->fetchAll(PDO::FETCH_ASSOC);


$req2 = $pdo->prepare("SELECT * FROM categories");
$req2->execute();
$categorie = $req2->fetchAll(PDO::FETCH_ASSOC);


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


    <section class="d-flex justify-content-center align-items-center">

            <div class="d-flex justify-content-center align-items-center barreRG">
                <div class="align-middle"><img  class="logo"src="./Ressources/images/logo.png">
                </div>
            </div>
    </section>

    <?php
    include 'footer.php';
?>



</body>

</html>