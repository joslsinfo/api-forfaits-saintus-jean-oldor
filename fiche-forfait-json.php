<?php
    header('Content-Type: application/json');

    require_once 'controlleurs/forfaits.php';
?>



    <?php
    $controllerForfaits = new ControlleurForfait;
    $controllerForfaits->afficherFicheJSON();
  

    ?>