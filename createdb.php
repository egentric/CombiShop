<?php
//Création de la base de données
$pdo = new PDO('mysql:host=localhost;port=3306', 'root', '');
$sql = "CREATE DATABASE IF NOT EXISTS `combishop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
$pdo->exec($sql);
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=combishop;port=3306',
        'root',
        '',
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Création de la table CATEGORIES
    $req1 = "CREATE TABLE IF NOT EXISTS `combishop`.`categories`(
    `id_categorie` INT NOT NULL AUTO_INCREMENT,
    `nomCategorie` VARCHAR(100),
    PRIMARY KEY(id_categorie));";
    $pdo->exec($req1);

    //Création de la table USERS
    $req2 = "CREATE TABLE IF NOT EXISTS `combishop`.`users` (
        `id_user` INT NOT NULL AUTO_INCREMENT ,
        `pseudo` VARCHAR(255),
        `mdp` VARCHAR(255) NOT NULL ,
        `email` VARCHAR(255) NOT NULL ,
        `nom` VARCHAR(100) NOT NULL ,
        `prenom` VARCHAR(100) NOT NULL ,
        `adresse` VARCHAR(255) NOT NULL ,
        `codePostal` VARCHAR(100) NOT NULL ,
        `ville` VARCHAR(100) NOT NULL ,
        `role` VARCHAR(100) DEFAULT 'user' ,
        `dateCreate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
        PRIMARY KEY(id_user));";
        $pdo->exec($req2);

    //Création de la table PRODUITS
    $req3 = "CREATE TABLE IF NOT EXISTS `combishop`.`produits` (
            `id_produit` INT NOT NULL AUTO_INCREMENT ,
            `title` VARCHAR(255) NOT NULL ,
            `year` INT(10) NOT NULL ,
            `km` INT(10) NOT NULL ,
            `img` VARCHAR(255) NULL ,
            `price` INT(10) NOT NULL ,
            `description` TEXT NOT NULL,
            `dept`  VARCHAR(100) NOT NULL ,
            `ville` VARCHAR(100) NOT NULL ,
            `dateCreateProd` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
            `id_categorie` INT ,
            `id_user` INT ,
            PRIMARY KEY(`id_produit`), 
            FOREIGN KEY(id_categorie) REFERENCES `categories` (`id_categorie`), 
            FOREIGN KEY(id_user) REFERENCES `users` (`id_user`));";
            $pdo->exec($req3);

    echo 'Félicitations, les tables ont bien été créées !';
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}