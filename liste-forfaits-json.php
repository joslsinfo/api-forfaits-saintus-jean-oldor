<?php
    header('Content-Type: application/json');


    require_once 'controlleurs/forfaits.php';
    $controllerForfaits = new ControlleurForfait;
    $controllerForfaits->afficherJSON();
?>

