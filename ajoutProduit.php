<?php require_once "inc/header.php";




if ($_POST) {


    foreach ($_POST as $indice => $valeur) {

        $_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);

        $_POST[$indice] = addslashes($valeur);
    }

 
    // TODO: GESTION DE LA PHOTO
    $photo_bdd = '';
    if(!empty($_FILES['photo']['name'])){
    // si le champs photo n'est pas vide
       $nom_photo = $_POST['categorie'] . '_' . $_FILES['photo']['name'] ;
      // $nom_photo contien la concatenation du nom et du nom de la photo
       $photo_bdd = URL . "photo/$nom_photo";
     // $photo_bdd contien l'url de la photo (le chemain de la photo)
       $photo_dossier = RACINE_SITE . "photo/$nom_photo";
    // $photo_dossier contien le chemain absolut de la photo dans notre dossier photo (vide de base)
       copy($_FILES['photo']['tmp_name'], $photo_dossier);
       // la fonction copy permet de copier la photo dans le dossier photo
      // ne pas oublier le enctype="multipart/form-data" dans le formulaire
      // pour le taitement des fichier medias

    }

    $pdo->query("INSERT INTO produit (titre,prix,photo,categorie,description) VALUES ('$_POST[titre]','$_POST[prix]','$photo_bdd','$_POST[categorie]','$_POST[description]') ");
    $content .= '<div class="alert alert-success">Produit ajouter avec success</div>';
}


?>



<h1 class="text-center text-muted">Ajout produit</h1>
<section class="col-md-6 mx-auto m-1">
    <?= $content ?>
    <form method="post" action="" enctype="multipart/form-data">
        <label for="Titre">Titre du produit</label>
        <input type="text" name="titre" id="titre" class="form-control" placeholder="Titre du produit" value="">

        <label for="description">Description du produit</label>
        <textarea name="description" id="description" class="form-control" placeholder="Description du produit"></textarea>

        <label for="categorie">Catégorie du produit</label>
        <select name="categorie" id="categorie" class="form-control">
            <option value="">Choisissez une catégorie</option>
            <option value="Pull">Pull</option>
            <option value="Pantalon">Pantalon</option>
            <option value="Chemise">Chemise</option>
            <option value="T-shirt">T-shirt</option>
            <option value="Chaussure">Chaussure</option>
        </select>

        <label for="photo">Photo</label>
        <input type="file" name="photo" id="photo" class="form-control" placeholder="Votre photo" value="">

        <label for="prix">Prix du produit</label>
        <input type="number" name="prix" id="prix" class="form-control" placeholder="Prix du produit" value="">

        <button type="submit" class=" m-2 btn btn-dark">Ajouter</button>
    </form>
</section>






<?php require_once "inc/footer.php"; ?>