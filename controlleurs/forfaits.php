<?php

require_once './modeles/forfaits.php';

class ControlleurForfait
{

    /***
     * Fonction permettant de récupérer l'ensemble des forfaits et de les afficher au format JSON
     */
    function afficherJSON()
    {
        $resultat = modele_forfait::ObtenirTous();
        echo json_encode($resultat);
    }

    /***
     * Fonction permettant de récupérer un forfait à partir de l'identifiant (id) 
     * inscrit dans l'URL, et l'affiche au format JSON
     */
    function afficherFicheJSON()
    {
      
        // $resultat = modele_forfait::ObtenirUn($id);
        // echo json_encode($resultat);
        
        if (isset($_GET["id"])) {
            $forfait = modele_forfait::ObtenirUn($_GET["id"]);
            echo json_encode($forfait);
           
        } 
    }

   
    /***
 * Fonction permettant d'ajouter un forfait reçu au format JSON
 */

function ajouterJSON($data) {
    $resultat = new stdClass();

    if(isset($data['nom']) && isset($data['description']) && isset($data['code']) && isset($data['etablissement']['nomEtablissement']) && isset($data['etablissement']['coordonnees']['adresseEtablissement']) && isset($data['etablissement']['coordonnees']['villeEtablissement'])  && isset($data['etablissement']['coordonnees']['telephoneEtablissement']) && isset($data['etablissement']['coordonnees']['courrielEtablissement']) && isset($data['etablissement']['coordonnees']['siteWebEtablissement'])  && isset($data['dateDebut'])  && isset($data['dateFin']) && isset($data['prix']) && isset($data['nouveauPrix']) && isset($data['rabais']) && isset($data['premium']) && isset($data['imageUrl'])) {
        $resultat = modele_forfait::ajouter($data['nom'], $data['description'], $data['code'], $data['etablissement']['nomEtablissement'], $data['etablissement']['coordonnees']['adresseEtablissement'], $data['etablissement']['coordonnees']['villeEtablissement'], $data['etablissement']['coordonnees']['telephoneEtablissement'], $data['etablissement']['coordonnees']['courrielEtablissement'], $data['etablissement']['coordonnees']['siteWebEtablissement'], $data['dateDebut'], $data['dateFin'], $data['prix'], $data['nouveauPrix'], $data['rabais'], $data['premium'], $data['imageUrl']);
    } else {
        http_response_code(500); //Envoi un code 500 au serveur 
        $resultat->message = "Impossible d'ajouter un forfait. Des informations sont manquantes";
    }
    echo json_encode($resultat);
   }
   

   
    /***
 * Fonction permettant de modifier un forfait reçu au format JSON
 */

function modifierJSON($data) {
    $resultat = new stdClass();
        if(isset($_GET['id'])) {
            if(isset($data['nom']) && isset($data['description']) && isset($data['code']) && isset($data['etablissement']['nomEtablissement']) && isset($data['etablissement']['coordonnees']['adresseEtablissement']) && isset($data['etablissement']['coordonnees']['villeEtablissement']) && isset($data['etablissement']['coordonnees']['telephoneEtablissement']) && isset($data['etablissement']['coordonnees']['courrielEtablissement']) && isset($data['etablissement']['coordonnees']['siteWebEtablissement']) && isset($data['dateDebut']) && isset($data['dateFin']) && isset($data['prix']) && isset($data['nouveauPrix']) && isset($data['rabais']) && isset($data['premium']) && isset($data['imageUrl'])) {
                $resultat = modele_forfait::editer($_GET['id'], $data['nom'], $data['description'], $data['code'], $data['etablissement']['nomEtablissement'], $data['etablissement']['coordonnees']['adresseEtablissement'], $data['etablissement']['coordonnees']['villeEtablissement'], $data['etablissement']['coordonnees']['telephoneEtablissement'], $data['etablissement']['coordonnees']['courrielEtablissement'], $data['etablissement']['coordonnees']['siteWebEtablissement'], $data['dateDebut'], $data['dateFin'], $data['prix'], $data['nouveauPrix'], $data['rabais'], $data['premium'], $data['imageUrl']); 
            } else {
                http_response_code(500); //Envoi un code 500 au serveur
                $resultat = "Impossible de modifier le forfait. Des informations sont manquantes";
            }

        } else {
            http_response_code(500); // Envoi un code 500 au serveur
            $resultat->message = "ID manquant";
        }
         echo json_encode($resultat);
   }
   
   
   function supprimerJSON() {
    $resultat = new stdClass();
    if(isset($_GET['id'])) {
             $resultat = modele_forfait::supprimer($_GET['id']);
    } else {
            http_response_code(500); // Envoi un code 500 au serveur
            $resultat->message = "ID manquant";
    }
    echo json_encode($resultat);
}

    /***
     * Fonction permettant de récupérer l'ensemble des forfaits et de les afficher sous forme de liste
     */
    function afficherListe()
    {
        $forfaits = modele_forfait::ObtenirTous();
        require './vues/forfaits/liste.php';
    }

   

    /***
     * Fonction permettant de récupérer l'ensemble des forfaits et de les afficher sous forme de tableau avec boutons d'actions
     */
    function afficherTableauAvecBoutonsAction()
    {
        $forfaits = modele_forfait::ObtenirTous();
        require './vues/forfaits/tableau-avec-bouton-actions.php';
    }

    
    /***
     * Fonction permettant de récupérer un forfait à partir de l'identifiant (id) 
     * inscrit dans l'URL, et l'affiche sous forme de carte
     */
    function afficherFiche()
    {
        if (isset($_GET["id"])) {
            $forfait = modele_forfait::ObtenirUn($_GET["id"]);
            if ($forfait) {  // ou if($forfait != null)
                require './vues/forfaits/fiche.php';
            } else {
                $erreur = "Aucun forfait trouvé";
                require './vues/erreur.php';
            }
        } else {
            $erreur = "L'identifiant (id) du forfait à afficher est manquant dans l'url";
            require './vues/erreur.php';
        }
    }

     

    
       
}

?>