<?php require_once "inc/header.php"; ?>



<?php

if ($_POST) {
    $erreur = '';

    if (strlen($_POST['pseudo']) <= 3 || strlen($_POST['pseudo']) > 20) {
        $erreur = '<div class="alert alert-danger">Le pseudo doit contenir entre 3 et 20 caractères</div>';
    }

    $r = $pdo->query("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'");
    // ont verifi si le pseudo existe deja

    if ($r->rowCount() >= 1) {
        $erreur = '<div class="alert alert-danger">Le pseudo est déjà utilisé</div>';
        // si le pseudo existe deja on affiche une erreur
    }

    //ont parcour le tableau $_POST et on verifie les champs
    foreach ($_POST as $indice => $valeur) {
        $_POST[$indice] = htmlentities($valeur, ENT_QUOTES);
        // fonction htmlentities qui permet de proteger des caracteres speciaux
        // ENT_QUOTES => retire les guillemets
        $_POST[$indice] = addslashes($valeur);
        // fonction addslashes qui permet d'ajouter des antislashes
    }


    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
    // la fonction password_hash permet de crypter le mot de passe
    $date_enregistrement = date("Y-m-d H:i:s");



    if (empty($erreur)) { // si $erreur est vide alors on peut inserer dans la bdd

    // TODO: GESTION DE LA PHOTO
    $photo_bdd = '';
    if(!empty($_FILES['photo']['name'])){
    // si le champs photo n'est pas vide
       $nom_photo = $_POST['pseudo'] . '_' . $_FILES['photo']['name'] ;
      // $nom_photo contien la concatenation du pseudo et du nom de la photo
       $photo_bdd = URL . "photo/$nom_photo";
     // $photo_bdd contien l'url de la photo (le chemain de la photo)
       $photo_dossier = RACINE_SITE . "photo/$nom_photo";
    // $photo_dossier contien le chemain absolut de la photo dans notre dossier photo (vide de base)
       copy($_FILES['photo']['tmp_name'], $photo_dossier);
       // la fonction copy permet de copier la photo dans le dossier photo
      // ne pas oublier le enctype="multipart/form-data" dans le formulaire
      // pour le taitement des fichier medias

    }



          $pdo->query("INSERT INTO membre (pseudo,mdp,nom,prenom,email,civilite,ville,code_postal,adresse,date_enregistrement,photo) VALUES ('$_POST[pseudo]','$mdp','$_POST[nom]','$_POST[prenom]','$_POST[email]','$_POST[civilite]','$_POST[ville]','$_POST[code_postal]','$_POST[adresse]', '$date_enregistrement' , '$photo_bdd') ");
          $content .= '<div class="alert alert-success">Vous êtes inscrit</div>';
    }
    $content .= $erreur ;
}




?>



<h1 class="text-center">Inscription</h1>
<section class="col-md-6 mx-auto m-1">
     <?= $content ?>
    <form method="post" action="" enctype="multipart/form-data">

        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Votre pseudo" value="">

        <label for="mdp">Mot de passe</label>
        <input type="password" name="mdp" id="mdp" class="form-control" placeholder="Votre mot de passe" value="">

        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" class="form-control" placeholder="Votre nom" value="">

        <label for="prenom">Prenom</label>
        <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Votre prenom" value="">

        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Votre email" value="">

        <br>

        <label for="civilite">Civilite</label>
        <select name="civilite" id="civilite" class="form-control">
            <option value="m">Homme</option>
            <option value="f">Femme</option>
        </select>

        <label for="ville">Ville</label>
        <input type="text" name="ville" id="ville" class="form-control" placeholder="Votre ville" value="">

        <label for="code_postal">Code postal</label>
        <input type="text" name="code_postal" id="code_postal" class="form-control" placeholder="Votre code postal" value="">

        <label for="adresse">Adresse</label>
        <textarea name="adresse" id="adresse" class="form-control" placeholder="Votre adresse" value=""></textarea>

        <label for="photo">Photo</label>
        <input type="file" name="photo" id="photo" class="form-control" placeholder="Votre photo" value="">

        <div class="mt-2">
            <button class="btn btn-dark">Inscription</button>
        </div>

    </form>






</section>















<?php require_once "inc/footer.php"; ?>