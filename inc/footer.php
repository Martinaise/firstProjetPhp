<?php
// recuperation du nombre des membres inscrits par mois

$resultat = $pdo->query('SELECT COUNT(*) AS nb_membres , MONTH(date_enregistrement) AS mois FROM membre WHERE MONTH(date_enregistrement) GROUP BY  MONTH(date_enregistrement) ');

$nombre_membre_par_mois = $resultat->fetchAll(PDO::FETCH_ASSOC);


function filterMonth(){
    global $nombre_membre_par_mois;
    $mois = array();
    foreach ($nombre_membre_par_mois as $key => $value) {
        switch($value['mois']){
            case 1:
                $mois[] = 'Janvier';
                break;
            case 2:
                $mois[] = 'Février';
                break;
            case 3:
                $mois[] = 'Mars';
                break;
            case 4:
                $mois[] = 'Avril';
                break;
            case 5:
                $mois[] = 'Mai';
                break;
            case 6:
                $mois[] = 'Juin';
                break;
            case 7:
                $mois[] = 'Juillet';
                break;
            case 8:
                $mois[] = 'Août';
                break;
            case 9:
                $mois[] = 'Septembre';
                break;
            case 10:
                $mois[] = 'Octobre';
                break;
            case 11:
                $mois[] = 'Novembre';
                break;
            case 12:
                $mois[] = 'Décembre';
                break;
        }
    
    }
        return $mois;
}



?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        // chaine 
        labels: <?php echo json_encode(filterMonth()); ?>,
        datasets: [{
            label: 'Inscription mensuelle',
            data: [<?php
            foreach($nombre_membre_par_mois as $value){
                echo $value['nb_membres'] . ',';
            }
        
        ?>],
            backgroundColor:  'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 0.2)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
 
</body>
</html>