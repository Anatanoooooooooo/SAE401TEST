<?php
//Va savoir pourquoi, mais ça fonctionne comme ça 
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    http_response_code(200); // Réponse OK
    exit();
}
// Inclure le fichier de connexion
require "../config/connexion_db.php"; // Charge la variable $conn

try {
    // Récupération des données POST
    $data = json_decode(file_get_contents("php://input"), true);

    // Vérifier si les données sont valides
    if (!$data || !isset($data['nom'], $data['prenom'], $data['login'], $data['mdp'])) {
        http_response_code(400);
        echo json_encode(["message" => "Données incomplètes"]);
        exit();
    }

    // Étape 1 : Insertion dans la table `personne`
    $nom = $data['nom'];
    $prenom = $data['prenom'];
    $login = $data['login'];
    $mdp = password_hash($data['mdp'], PASSWORD_DEFAULT); // Hachage du mot de passe

    $sqlPersonne = "INSERT INTO personne (nom, prenom, login, mdp) VALUES (:nom, :prenom, :login, :mdp)";
    $stmt = $conn->prepare($sqlPersonne);
    $stmt->execute([
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':login' => $login,
        ':mdp' => $mdp,
    ]);

    // Récupérer l'ID de la personne
    $id_personne = $conn->lastInsertId();

    // Étape 2 : Insertion dans la table `candidat`
    
    if (!isset($data['nom_ae'], $data['adresse_rue'], $data['adresse_cp'], $data['adresse_ville'], $data['mail'], $data['telephone'])) {
        http_response_code(400);
        echo json_encode(["message" => "Données incomplètes pour la table autoecole"]);
        exit();
    }

    $nom_ae = $data['nom_ae'];
    $adresse_rue = $data['adresse_rue'];
    $adresse_cp = $data['adresse_cp'];
    $adresse_ville = $data['adresse_ville'];
    $mail = $data['mail'];
    $telephone = $data['telephone'];

    $sqlAutoecole = "INSERT INTO autoecole (id_personne, nom_ae, adresse_rue, adresse_cp, adresse_ville, mail, telephone) 
                    VALUES (:id_personne, :nom_ae, :adresse_rue, :adresse_cp, :adresse_ville, :mail, :telephone)";
    $stmt = $conn->prepare($sqlAutoecole);
    $stmt->execute([
        ':id_personne' => $id_personne,
        ':nom_ae' => $nom_ae,
        ':adresse_rue' => $adresse_rue,
        ':adresse_cp' => $adresse_cp,
        ':adresse_ville' => $adresse_ville,
        ':mail' => $mail,
        ':telephone' => $telephone,
    ]);

    http_response_code(201);
    echo json_encode(["message" => "Personne et autoecole ajoutés avec succès"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["message" => "Erreur : " . $e->getMessage()]);
    exit();
}