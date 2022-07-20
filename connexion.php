<?php require_once "inc/header.php"; ?>


<?php

if(isset($_GET['action']) && $_GET['action'] == 'deconnexion' ){

    unset($_SESSION['membre']);
    // foncrion qui permet de supprimer une variable de session a l index membre
    // session_destroy supprime la session entiere
    header('location:connexion.php');

}
if(internauteEstConnecte()){
   header('location:profil.php');
   exit();
};


if($_POST){

   $r = $pdo->query("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'");
    // ont verifi si le pseudo existe

    if($r->rowCount() >= 1){
     $membre = $r->fetch(PDO::FETCH_ASSOC);
     // la fonction fetch permet de recuperer les donnees de la requet dans un tableau
      if(password_verify($_POST['mdp'],$membre['mdp'])){
        $_SESSION['membre']['id_membre'] = $membre['id_membre'];
        $_SESSION['membre']['pseudo'] = $membre['pseudo'];
        $_SESSION['membre']['nom'] = $membre['nom'];
        $_SESSION['membre']['prenom'] = $membre['prenom'];
        $_SESSION['membre']['email'] = $membre['email'];
        $_SESSION['membre']['civilite'] = $membre['civilite'];
        $_SESSION['membre']['ville'] = $membre['ville'];
        $_SESSION['membre']['code_postal'] = $membre['code_postal'];
        $_SESSION['membre']['adresse'] = $membre['adresse'];
        $_SESSION['membre']['date_enregistrement'] = $membre['date_enregistrement'];
        $_SESSION['membre']['statut'] = $membre['statut'];
        $_SESSION['membre']['photo'] = $membre['photo'];
        if($membre['statut'] == 1){
           header('location:espaceGestionMembres.php');
        }else {
           header('location:profil.php');
        }
      
        //la fonction header() permet de rediriger vers une autre page
      }else{
        $content .= '<div class="alert alert-danger">Erreur de mot de passe</div>';
      }
      
    }else{
        $content .= '<div class="alert alert-danger">erreur de pseudo</div>';
    }
}


?>

<h1 class="text-center">Connexion</h1>
<section class="col-md-6 mx-auto">
    <?= $content ?>
    <form method="post">
        <div>
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Votre pseudo" value="">
        </div>
        <div>
            <label for="mdp">Mot de passe</label>
            <input type="password" name="mdp" id="mdp" class="form-control" placeholder="Votre mot de passe" value="">
        </div>
        <button class="btn btn-dark mt-2">Connexion</button>
    </form>
</section>














<?php require_once "inc/footer.php"; ?>