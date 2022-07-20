<?php
require_once('inc/header.php');
?>




<h1 class="text-center">Administration</h1>
<br>
<h2>Gestion des membres</h2>
<br>
<a class="m-2" href="espaceGestionProduits.php">Gestions des produits</a>
<canvas id="myChart" width="970" height="280"></canvas>
<section class="container-fluid">
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Pseudo</th>
                <th>Photo</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $resultat =  $pdo->query("SELECT * FROM membre");
                while ($membre = $resultat->fetch(PDO::FETCH_ASSOC)) {
                    echo ('<tr>');
                    echo ('<td>' . $membre['nom'] . '</td>');
                    echo ('<td>' . $membre['prenom'] . '</td>');
                    echo ('<td>' . $membre['pseudo'] . '</td>');
                    echo ("<td><div style='width:50px;height:50px;border-radius:50%;background-image:url($membre[photo]);background-size: cover;background-repeat:no-repeat;background-position:center'></div></td>");
                    echo ("<td><a class='btn btn-dark' href='membre.php?id=$membre[id_membre]'>Voir</a> | <a class='btn btn-dark' href=''>Modifier</a></td>");
                    echo ('</tr>');
                }
                ?>
            </tbody>
        </table>
    </div>
</section>





 

<?php
require_once('inc/footer.php');
?>
