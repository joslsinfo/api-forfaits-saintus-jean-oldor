<?php
    header('Content-Type: application/json;'); 
    header('Access-Control-Allow-Origin: *'); 
    header("Access-Control-Allow-Methods: POST, DELETE, PUT, OPTIONS"); 
    header('Access-Control-Allow-Headers: Content-Type'); 


    require_once './controlleurs/clients.php';
    
    $controllerClients=new ControlleurClient;

    switch($_SERVER['REQUEST_METHOD']) { 
        case 'GET': // GESTION DES DEMANDES DE TYPE GET 
            if(isset($_GET['id'])) { // CODE PERMETTANT DE RÉCUPÉRER L'ENREGISTREMENT CORRESPONDANT À L'IDENTIFIANT PASSÉ EN PARAMÈTRE 
                $controllerClients->afficherFicheJSON($_GET['id']);
            } else {// CODE PERMETTANT DE RÉCUPÉRER TOUT LES ENREGISTREMENTS
                $controllerClients->afficherJSON();
            } 
        
             
             break; 
            default: 
} 
?>
