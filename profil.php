<?php

require_once "inc/header.php";



?>


<h1 class="text-center text-muted">Bienvenue <?= $_SESSION['membre']['nom'] ." ". $_SESSION['membre']['prenom'] ?></h1>
<hr>

<div class="d-flex justify-content-center">
<?php  echo ("<div style='width:100px;height:100px;border-radius:50%;background-image:url($myPicture);background-size:cover;background-position:center;background-repeat:no-repeat;'></div>")?>
</div>


Voici vos informations: <br>
Votre nom: <?= $_SESSION['membre']['nom'] ?> <br>
Votre prenom: <?= $_SESSION['membre']['prenom'] ?> <br>
Votre pseudo: <?= $_SESSION['membre']['pseudo'] ?> <br>
Votre email: <?= $_SESSION['membre']['email'] ?> <br>
<a href="edit.php?id=<?= $_SESSION['membre']['id_membre']?>">Editer mon profil</a>














<?php require_once "inc/footer.php";?>


