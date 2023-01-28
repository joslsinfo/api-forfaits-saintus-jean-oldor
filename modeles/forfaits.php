<?php

require_once "./include/config.php";

class modele_etablissement{
    public $nomEtablissement;
    public $coordonnees;
    

     /***
     * Fonction permettant de construire un objet de type modele_etablissement
     */
    
    public function __construct($nomEtablissement, $coordonnees) {
        $this->nomEtablissement = $nomEtablissement;
        $this->coordonnees = $coordonnees;
        
        
    }
    
}

class modele_coordonnees{
    public $adresseEtablissement;
    public $villeEtablissement;
    public $telephoneEtablissement;
    public $courrielEtablissement;
    public $siteWebEtablissement;

   

     /***
     * Fonction permettant de construire un objet de type modele_coordonnees
     */
    
    public function __construct($adresseEtablissement, $villeEtablissement, $telephoneEtablissement, $courrielEtablissement, $siteWebEtablissement  ) {
        $this->adresseEtablissement = $adresseEtablissement;
        $this->villeEtablissement = $villeEtablissement;
        $this->telephoneEtablissement = $telephoneEtablissement;
        $this->courrielEtablissement = $courrielEtablissement;
        $this->siteWebEtablissement = $siteWebEtablissement;
        
        
    }
    
}



class modele_forfait
{
    public $id;
    public $nom;
    public $description;
    public $code;
    public $etablissement;
    public $dateDebut;
    public $dateFin;
    public $prix;
    public $nouveauPrix;
    public $rabais;
    public $premium;
    public $imageUrl;
    

    /***
     * Fonction permettant de construire un objet de type modele_forfait
     */
    public function __construct($id, $nom, $description, $code, $nomEtablissement, $adresseEtablissement, $villeEtablissement, $telephoneEtablissement, $courrielEtablissement, $siteWebEtablissement, $dateDebut, $dateFin, $prix, $nouveauPrix, $rabais, $premium, $imageUrl)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->code = $code;
        $this->etablissement = $nomEtablissement;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->prix = $prix;
        $this->nouveauPrix =$nouveauPrix;
        $this->rabais =$rabais;
        $this->premium =$premium;
        $this->imageUrl =$imageUrl;


        
        $this->etablissement = new modele_etablissement($nomEtablissement, new modele_coordonnees( $adresseEtablissement, $villeEtablissement, $telephoneEtablissement,$courrielEtablissement, $siteWebEtablissement));
            
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
     * Fonction permettant de récupérer l'ensemble des forfaits 
     */
    public static function ObtenirTous()
    {
        $liste = [];
        $mysqli = self::connecter();

        
        $resultatRequete = $mysqli->query("SELECT * FROM forfaits ORDER BY code");

        foreach ($resultatRequete as $enregistrement) {
            $liste[] = new modele_forfait($enregistrement['id'], $enregistrement['nom'], $enregistrement['description'], $enregistrement['code'],$enregistrement['nomEtablissement'], $enregistrement['adresseEtablissement'], $enregistrement['villeEtablissement'], $enregistrement['telephoneEtablissement'], $enregistrement['courrielEtablissement'], $enregistrement['siteWebEtablissement'], $enregistrement['dateDebut'], $enregistrement['dateFin'], $enregistrement['prix'], $enregistrement['nouveauPrix'], $enregistrement['rabais'], $enregistrement['premium'], $enregistrement['imageUrl']);
        }

        return $liste;
    }

    /***
     * Fonction permettant de récupérer un forfait en fonction de son identifiant
     */
    public static function ObtenirUn($id)
    {
        $resultat = new stdClass();

        $mysqli = self::connecter();

        if ($requete = $mysqli->prepare("SELECT * FROM forfaits WHERE id=?")) {  // Création d'une requête préparée 
            $requete->bind_param("i", $id); // Envoi des paramètres à la requête

            $requete->execute(); // Exécution de la requête

            $resultat_requete = $requete->get_result(); // Récupération de résultats de la requête¸

            if ($enregistrement = $resultat_requete->fetch_assoc()) { // Récupération de l'enregistrement
                $forfait = new modele_forfait($enregistrement['id'], $enregistrement['nom'], $enregistrement['description'], $enregistrement['code'], $enregistrement['nomEtablissement'], $enregistrement['adresseEtablissement'], $enregistrement['villeEtablissement'], $enregistrement['telephoneEtablissement'], $enregistrement['courrielEtablissement'], $enregistrement['siteWebEtablissement'], $enregistrement['dateDebut'], $enregistrement['dateFin'], $enregistrement['prix'], $enregistrement['nouveauPrix'], $enregistrement['rabais'], $enregistrement['premium'], $enregistrement['imageUrl']);
            } else {
                http_response_code(404); // Envoi un code 404 au serveur
                $resultat->message = "Erreur: Aucun forfait trouvé";
                return $resultat;
            }

            $requete->close(); // Fermeture du traitement 
            return $forfait;
        } else {
            http_response_code(500); // Envoi un code 500 au serveur
            $resultat->message = "Une erreur a été détectée dans la requête utilisée : ";
            $resultat->erreur = $mysqli->error;
            return $resultat;
        }
        
    }

    /***
     * Fonction permettant d'ajouter un forfait
     */
    public static function ajouter($nom, $description, $code, $nomEtablissement, $adresseEtablissement, $villeEtablissement, $telephoneEtablissement, $courrielEtablissement, $siteWebEtablissement, $dateDebut, $dateFin, $prix, $nouveauPrix, $rabais, $premium, $imageUrl)
    {
        $resultat = new stdClass();
     
        $mysqli = self::connecter();

        // Création d'une requête préparée
        if ($requete = $mysqli->prepare("INSERT INTO forfaits(nom, description, code, nomEtablissement, adresseEtablissement, villeEtablissement, telephoneEtablissement, courrielEtablissement, siteWebEtablissement, dateDebut, dateFin, prix, nouveauPrix, rabais, premium, imageUrl) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
            

            $requete->bind_param("sssssssssssdddis", $nom, $description, $code, $nomEtablissement, $adresseEtablissement, $villeEtablissement, $telephoneEtablissement, $courrielEtablissement, $siteWebEtablissement,  $dateDebut,$dateFin,$prix, $nouveauPrix, $rabais, $premium, $imageUrl);

            if ($requete->execute()) { // Exécution de la requête
                $resultat->message = "Forfait ajouté";  // Message ajouté dans la page en cas d'ajout réussi
            } else {
                http_response_code(500); //Envoi un code 500 au serveur
                $resultat->message = "Une erreur est survenue lors de l'ajout:";
                $resultat->erreur = $requete->error;
            }

            $requete->close(); // Fermeture du traitement

        } else {
            http_response_code(500); //Envoi un code 500 au serveur
            $resultat->message = "Une erreur a été détectée dans la requête utilisée :"; // Message ajouté dans la page en cas d’échec
            $resultat->erreur = $mysqli->error;
                      
        }

        return $resultat;
    }

    /***
     * Fonction permettant d'éditer un forfait
     */
    public static function editer($id, $nom, $description, $code, $nomEtablissement, $adresseEtablissement, $villeEtablissement, $telephoneEtablissement, $courrielEtablissement, $siteWebEtablissement, $dateDebut, $dateFin, $prix, $nouveauPrix, $rabais, $premium, $imageUrl)
    {

        $resultat = new stdClass();

        $mysqli = self::connecter();

        // Création d'une requête préparée
        if ($requete = $mysqli->prepare("UPDATE forfaits SET nom=?, description=?, code=?, nomEtablissement=?, adresseEtablissement=?, villeEtablissement=?, telephoneEtablissement=?, courrielEtablissement=?, siteWebEtablissement=?, dateDebut=?, dateFin=?, prix=?, nouveauPrix=?, rabais=?, premium=?, imageUrl=? WHERE id=?")) {

            

            $requete->bind_param("sssssssssssdddisi", $nom, $description, $code, $nomEtablissement, $adresseEtablissement, $villeEtablissement, $telephoneEtablissement, $courrielEtablissement, $siteWebEtablissement, $dateDebut,$dateFin, $prix, $nouveauPrix, $rabais, $premium, $imageUrl, $id);

            if ($requete->execute()) {  // Exécution de la requête
                $resultat->message = "Forfait modifié";  // Message ajouté dans la page en cas d'ajout réussi
            } else {
                http_response_code(500); //Envoi un code 500 au serveur
                $resultat->message =  "Une erreur est survenue lors de l'édition: ";  // Message ajouté dans la page en cas d’échec
                $resultat->erreur = $requete->error;
            }

            $requete->close(); // Fermeture du traitement

        } else {
            http_response_code(500); //Envoi un code au serveur 
            $resultat->message = "Une erreur a été détectée dans la requête utilisée :";
            $resultat->erreur = $mysqli->error;
         
        }

        return $resultat;
    }

    /***
     * Fonction permettant de supprimer un forfait
     */
    public static function supprimer($id)
    {
        $resultat = new stdClass();
      
        $mysqli = self::connecter();

        // Création d'une requête préparée
        if ($requete = $mysqli->prepare("DELETE FROM forfaits WHERE id=?")) {
            
            $requete->bind_param("i", $id);

            if ($requete->execute()) { // Exécution de la requête
               $resultat->message = "Forfait supprimé";  // Message ajouté dans la page en cas de suppression réussie
            } else {
                http_response_code(500); //Envoi un code 500 au serveur
                $resultat->message = "Une erreur est survenue lors de la suppression: "; // Message ajouté dans la page en cas d’échec
                $resultat->erreur = $requete->error;  
            }

            $requete->close(); // Fermeture du traitement

        } else {
            http_response_code(500); //Envoi un code 500 au serveur
            $resultat->message = "Une erreur a été détectée dans la requête utilisée : ";
            $resultat->erreur = $mysqli->error;
          
        }

        return $resultat;
    }
}

?>