<?php
require_once 'controlleurs/forfaits.php';
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/styles.css">
    <title>Fiche forfait</title>
</head>

<body>
    <div class="fiche">

    <h1>Fiche détaillée d'un forfait en HTML</h1>

    <?php
    $controllerForfaits = new ControlleurForfait;
    $controllerForfaits->afficherFiche();
    ?>

    <a href="liste-forfaits-html.php">Retour à la liste des forfaits</a>




</div>



    
</body>

</html>