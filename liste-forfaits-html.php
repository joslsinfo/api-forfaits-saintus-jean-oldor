<?php
require_once 'controlleurs/forfaits.php';
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/styles.css">
    <title>Liste des forfaits</title>
</head>

<body>
    <h1>Liste des forfaits HTML </h1>
 
    <?php
        $controllerForfaits = new ControlleurForfait;
        $controllerForfaits->afficherTableauAvecBoutonsAction();
        $controllerForfaits->afficherListe();

    ?>

</body>

</html>