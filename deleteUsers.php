<?php

$id=$_GET['id'];

try{
$pdo = new PDO('mysql:host=localhost;dbname=combishop;port=3306', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "DELETE FROM users WHERE id_user=$id";

$sth = $pdo->prepare($sql);
$sth->execute();
}
catch(PDOException $e){
echo "Erreur : " . $e->getMessage();
}
header('location:tabordG.php');
?>