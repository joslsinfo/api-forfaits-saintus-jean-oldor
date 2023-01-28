<?php

require_once './modeles/clients.php';

class ControlleurClient
{

    /***
     * Fonction permettant de récupérer l'ensemble des clients et de les afficher au format JSON
     */
    function afficherJSON()
    {
        $resultat = modele_client::ObtenirTous();
        echo json_encode($resultat);
    }

    /***
     * Fonction permettant de récupérer un client à partir de l'identifiant (id) 
     * inscrit dans l'URL, et l'affiche au format JSON
     */
    function afficherFicheJSON()
    {
        // $resultat = modele_client::ObtenirUn($id);
        // echo json_encode($resultat);
        
        if (isset($_GET["id"])) {
            $client = modele_client::ObtenirUn($_GET["id"]);
            echo json_encode($client);
           
        } 
    }


   


    
       
}

?>