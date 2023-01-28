<?php

require_once "./include/config.php";



class modele_client
{
    public $id;
    public $nom_client;
    public $prenom_client;
    public $adresse_client;
    public $ville_client;
    public $code_postal_client;
    public $province_client;
    public $pays_client;
    public $telephone_client;
    public $courriel_client;
 
    

    /***
     * Fonction permettant de construire un objet de type modele_client
     */
    public function __construct($id, $nom_client, $prenom_client, $adresse_client, $ville_client, $code_postal_client, $province_client, $pays_client, $telephone_client, $courriel_client)
    {
        $this->id = $id;
        $this->nom_client = $nom_client;
        $this->prenom_client = $prenom_client;
        $this->adresse_client = $adresse_client;
        $this->ville_client = $ville_client;
        $this->code_postal_client = $code_postal_client;
        $this->province_client = $province_client;
        $this->pays_client =$pays_client;
        $this->telephone_client =$telephone_client;
        $this->courriel_client =$courriel_client;
     
      
            
    }

    /***
     * Fonction permettant de se connecter à la base de données
     */
    static function connecter()
    {

        $mysqli = new mysqli(Db::$host, Db::$username, Db::$password, Db::$database);

        // Vérifier la connexion
        if ($mysqli-> connect_errno) {
            http_response_code(500); // Envoi un code au serveur
            $erreur = new stdClass();
            $erreur->message = "DEBOGAGE : Échec de connexion à la base de données MySQL:";
            $erreur->error = $mysqli -> connect_error;
            echo json_encode($erreur);
            exit();
        }

        return $mysqli;
    }

    /***
     * Fonction permettant de récupérer l'ensemble des clients 
     */
    public static function ObtenirTous()
    {
        $liste = [];
        $mysqli = self::connecter();

        
        $resultatRequete = $mysqli->query("SELECT * FROM clients ORDER BY nom_client");

        foreach ($resultatRequete as $enregistrement) {
            $liste[] = new modele_client($enregistrement['id'], $enregistrement['nom_client'], $enregistrement['prenom_client'], $enregistrement['adresse_client'],$enregistrement['ville_client'], $enregistrement['code_postal_client'], $enregistrement['province_client'], $enregistrement['pays_client'], $enregistrement['telephone_client'], $enregistrement['courriel_client']);
        }

        return $liste;
    }

    /***
     * Fonction permettant de récupérer un client en fonction de son identifiant
     */
    public static function ObtenirUn($id)
    {
        $resultat = new stdClass();

        $mysqli = self::connecter();

        if ($requete = $mysqli->prepare("SELECT * FROM clients WHERE id=?")) {  // Création d'une requête préparée 
            $requete->bind_param("i", $id); // Envoi des paramètres à la requête

            $requete->execute(); // Exécution de la requête

            $resultat_requete = $requete->get_result(); // Récupération de résultats de la requête¸

            if ($enregistrement = $resultat_requete->fetch_assoc()) { // Récupération de l'enregistrement
                $client = new modele_client($enregistrement['id'], $enregistrement['nom_client'], $enregistrement['prenom_client'], $enregistrement['adresse_client'], $enregistrement['ville_client'], $enregistrement['code_postal_client'], $enregistrement['province_client'], $enregistrement['pays_client'], $enregistrement['telephone_client'], $enregistrement['courriel_client']);
            } else {
                http_response_code(404); // Envoi un code 404 au serveur
                $resultat->message = "Erreur: Aucun client trouvé";
                return $resultat;
            }

            $requete->close(); // Fermeture du traitement 
            return $client;
        } else {
            http_response_code(500); // Envoi un code 500 au serveur
            $resultat->message = "Une erreur a été détectée dans la requête utilisée : ";
            $resultat->erreur = $mysqli->error;
            return $resultat;
        }
        
    }

    


}

?>