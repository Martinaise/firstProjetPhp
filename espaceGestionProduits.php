<?php
require_once('inc/header.php');
// recherche par titre
$r = $pdo->query("SELECT DISTINCT(categorie) FROM produit");
if (isset($_GET['recherche'])) {
    $resultat =  $pdo->query("SELECT * FROM produit WHERE titre LIKE  '%$_GET[recherche]%'");
} else if (isset($_GET['categorie'])) {
    $resultat =  $pdo->query("SELECT * FROM produit WHERE categorie =  '$_GET[categorie]'");
} else if (isset($_GET['prix'])) {
    $resultat =  $pdo->query("SELECT * FROM produit WHERE prix <=  '$_GET[prix]'");
} else {
    $resultat = $pdo->query("SELECT * FROM produit");
}
?>




<h1 class="text-center">Administration</h1>
<br>
<h2>Gestion des produits</h2>
<br>
<a class="m-2" href="espaceGestionMembres.php">Gestions des membres</a>
<br>
<a class="m-2" href="ajoutProduit.php">Ajout produit</a>
<hr>
<section class="container-fluid">

    <section class="row">
        <!-- par titre de produit -->
        <div class="col-md-4">
            <div class="col-md-8">
                <form class="d-flex" method="get">
                    <input class="form-control me-2" type="search" placeholder="Rechercher un produit" name="recherche" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Rechercher</button>
                </form>
            </div>
        </div>
        <!-- par categorie -->
        <div class="col-md-4">
            <div class="col-md-8">
                <form class="d-flex" method="get">
                    <select class="form-control me-2" name="categorie">
                        <option>Choisir une categorie</option>
                        <?php
                        while ($categorie = $r->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='$categorie[categorie]'>$categorie[categorie]</option>";
                        }
                        ?>
                    </select>
                    <button class="btn btn-outline-success" type="submit">Rechercher</button>
                </form>
            </div>
        </div>
        <!-- par prix -->
        <div class="col-md-4">
            <div class="col-md-8">
                <form class="d-flex" method="get">
                    <p class="affichePrix"></p>
                    <input type="range" placeholder="Rechercher par prix max" name="prix" value="<?= isset($_GET['prix']) ? $_GET['prix'] : '' ?>" min="0" max="100">
                    <button class="btn btn-outline-success" type="submit">Rechercher</button>
                </form>
            </div>
        </div>
    </section>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>prix</th>
                    <th>Photo</th>
                    <th>Categorie</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($produit = $resultat->fetch(PDO::FETCH_ASSOC)) {
                    echo ('<tr>');
                    echo ('<td>' . $produit['titre'] . '</td>');
                    echo ('<td>' . $produit['description'] . '</td>');
                    echo ('<td><span class="badge text-success">' . $produit['prix'] . '€</span></td>');
                    echo ("<td><div style='width:50px;height:50px;border-radius:50%;background-image:url($produit[photo]);background-size: cover;background-repeat:no-repeat;background-position:center'></div></td>");
                    echo ('<td>' . $produit['categorie'] . '</td>');
                    echo ('</tr>');
                }
                ?>
            </tbody>
        </table>
    </div>
</section>



<script>
    // afficher la veleur du prix de la bar range
    document.querySelector('.affichePrix').innerHTML = document.querySelector('input[type=range]').value + '€';
    document.querySelector('input[type=range]').addEventListener('input', function() {
        document.querySelector('.affichePrix').innerHTML = this.value + '€';
    });
</script>



<?php
require_once('inc/footer.php');
?>