<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=combishop;port=3306', 'root', '',
array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_POST){

$nomCategorie = htmlspecialchars($_POST['nomCategorie']);

    $sth = $pdo->prepare("
        INSERT INTO categories(nomCategorie)
        VALUES (:nomCategorie)
    ");

    $sth->execute(array(':nomCategorie' => $nomCategorie));


                        header('location:tabordG.php');
}
?>