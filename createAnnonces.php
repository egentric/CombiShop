<?php
session_start();

//----------------SYSTEME D'UPLOAD D'IMAGES----------------------//
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["img"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// On vérifie si le fichier image est une image réelle ou une fausse image
if(isset($_POST["submit"])) {
$check = getimagesize($_FILES["img"]["tmp_name"]);
if($check !== false) {
echo "File is an image - " . $check["mime"] . ".";
$uploadOk = 1;
} else {
echo "File is not an image.";
$uploadOk = 0; }
}
// On vérifie si le fichier existe déjà
if (file_exists($target_file)) {
echo "Désolé, ce fichier existe déjà.";
$uploadOk = 0;
}
// On vérifie la taille de l'image
if ($_FILES["img"]["size"] > 500000) {
echo "Désolé, ce fichier dépasse la limite de taille autorisée."; $uploadOk = 0;
}
// On vérifie le type de fichier
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
echo "Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
$uploadOk = 0; }
// On vérifie si $uploadOk est à 0 à cause d'une erreur
if ($uploadOk == 0) {
echo "Désolé, votre fichier n'a pas été uploader";
// Si tout est ok on essaye d'uploader le fichier
} else {
if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
echo "Le fichier ". basename( $_FILES["img"]["name"]). " a bien été uploader." ;
} else {
echo "Sorry, there was an error uploading your file.";
} }
//---------------------FIN SYSTEME D'UPLOAD D'IMAGES------------------------------/
?>

<div class="row colorTop">
            <div class="col-md-12">
                <?php
            if (isset($_SESSION['id_user']) and isset($_SESSION['pseudo'])) { ?>
   <p class=""> <?php echo 'Bonjour ' . $_SESSION['pseudo'];?></p>
<?php
}
?>
            </div>
<?php
$pdo = new PDO('mysql:host=localhost;dbname=combishop;port=3306', 'root', '',
array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_POST) {
 $title = htmlspecialchars ($_POST['title']);
 $year = htmlspecialchars ($_POST['year']);
 $km = htmlspecialchars ($_POST['km']);
 $price = htmlspecialchars ($_POST['price']);
 $description = htmlspecialchars ($_POST['description']);
 $ville = htmlspecialchars ($_POST['ville']);
 $dept = htmlspecialchars ($_POST['dept']);
 $img = htmlspecialchars ($_FILES['img']["name"]);
 $id_categorie = htmlspecialchars ($_POST['categories']);

 $id_user = $_SESSION['id_user'];

//var_dump($_POST['id_categorie']);
//var_dump($_SESSION['id_user']);

 if (($title != "") && ($year != "") && ($km != "") && ($price != "") && ($description != "") && ($ville != "") && ($dept != "") && ($img != "") ) {
    $req1 = $pdo->prepare("
 INSERT INTO produits(title,year,km,price,description, ville,dept,img,id_categorie,id_user)
 VALUES (:title,:year,:km,:price,:description,:ville,:dept,:img,:id_categorie,:id_user)
 ");
 $req1->execute(array(
 ':title' => $title,
 ':year' => $year,
 ':km' => $km,
 ':price' => $price,
 ':description' => $description,
 ':ville' => $ville,
 ':dept' => $dept,
 ':img' => $img,
 ':id_categorie' => $id_categorie,
 ':id_user' => $id_user

 ));
 }
}

header('location:tabord.php')
?>