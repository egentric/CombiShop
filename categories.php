<?php
session_start();
$pdo = new PDO(
    'mysql:host=localhost;dbname=combishop;port=3306',
    'root',
    '',
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
);
// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$req1 = $pdo->prepare("SELECT * FROM categories");
$req1->execute();
$categorie = $req1->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="row">
    <div class="col-md-12 form">

        <form action="createCategories.php" method="post">
            <input class="" type="text" name="nomCategorie" placeholder="Catégorie">
            <input class="envoie" type="submit" value="Ajouter">

        </form>
    </div>
</div>
