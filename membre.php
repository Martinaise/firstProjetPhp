<?php
require_once "inc/header.php";

$resultat = $pdo->query("SELECT * FROM membre WHERE id_membre = $_GET[id]");
$membre = $resultat->fetch(PDO::FETCH_ASSOC);

if (isset($_GET['action']) && $_GET['action'] == 'suppression') {
    $pdo->query('DELETE FROM membre WHERE id_membre = ' .$_GET['id']);
    header('location:espaceGestionMembres.php');
}

?>
<section class="container">


    <h1 class="text-center">membre <?= $membre['pseudo'] ?></h1>


    <div class="d-flex justify-content-center">
        <?php echo ("<div style='width:200px;height:200px;border-radius:50%;background-image:url( $membre[photo]);background-size: cover;background-repeat:no-repeat;background-position:center'></div>"); ?>

    </div>

    <br>
    <div style="border:solid 1px black; border-radius:5px;">
        <strong>Prenom: <?= $membre['prenom'] ?> </strong>
        <br>
        <strong>Nom: <?= $membre['nom'] ?> </strong>
        <br>
        <strong>Email: <?= $membre['email'] ?> </strong>
        <br>
        <strong>Civilité: <?= $membre['civilite'] ?> </strong>
        <br>
        <strong>Ville: <?= $membre['ville'] ?> </strong>
        <br>
        <strong>Code Postal: <?= $membre['code_postal'] ?> </strong>
        <br>
        <strong>Adresse: <?= $membre['adresse'] ?> </strong>
        <br>
        <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Suppression</a>

    </div>

</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="exampleModalLabel">Attention cette action et irreversible !</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                etes vous sur de vouloir supprimer <?= $membre['nom'] ?> <?= $membre['prenom'] ?> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <?php echo "<a class='btn btn-danger' href='?action=suppression&id=$membre[id_membre]'>Supprimer</a>"; ?>
            </div>
        </div>
    </div>
</div>







<?php require_once "inc/footer.php"; ?>