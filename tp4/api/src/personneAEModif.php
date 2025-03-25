<?php
header("Access-Control-Allow-Origin: *"); // POUR TOUS
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS"); // Méthodes autorisées
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Inclure le fichier de connexion
require "../config/connexion_db.php";

try {
    // Récupération des données PUT
    $data = json_decode(file_get_contents("php://input"), true);

    // Validation des données
    if (!isset($data['id_personne'], $data['nom'], $data['prenom'], $data['login'], $data['mdp'], $data['nom_ae'], $data['adresse_rue'], $data['adresse_cp'], $data['adresse_ville'], $data['mail'], $data['telephone'])) {
        http_response_code(400);
        echo json_encode(["message" => "Données incomplètes pour la mise à jour"]);
        exit();
    }

    // Mise à jour de la table `personne`
    $id_personne = $data['id_personne'];
    $nom = $data['nom'];
    $prenom = $data['prenom'];
    $login = $data['login'];
    $mdp = password_hash($data['mdp'], PASSWORD_DEFAULT); // Hachage du mot de passe

    $sqlPersonne = "UPDATE personne SET nom = :nom, prenom = :prenom, login = :login, mdp = :mdp WHERE id = :id_personne";
    $stmt = $conn->prepare($sqlPersonne);
    $stmt->execute([
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':login' => $login,
        ':mdp' => $mdp,
        ':id_personne' => $id_personne,
    ]);

    // Mise à jour de la table `autoecole`
    $nom_ae = $data['nom_ae'];
    $adresse_rue = $data['adresse_rue'];
    $adresse_cp = $data['adresse_cp'];
    $adresse_ville = $data['adresse_ville'];
    $mail = $data['mail'];
    $telephone = $data['telephone'];

    $sqlAutoecole = "UPDATE autoecole SET nom_ae = :nom_ae, adresse_rue = :adresse_rue, adresse_cp = :adresse_cp, adresse_ville = :adresse_ville, mail = :mail, telephone = :telephone WHERE id_personne = :id_personne";
    $stmt = $conn->prepare($sqlAutoecole);
    $stmt->execute([
        ':nom_ae' => $nom_ae,
        ':adresse_rue' => $adresse_rue,
        ':adresse_cp' => $adresse_cp,
        ':adresse_ville' => $adresse_ville,
        ':mail' => $mail,
        ':telephone' => $telephone,
        ':id_personne' => $id_personne,
    ]);

    http_response_code(200);
    echo json_encode(["message" => "Informations mises à jour avec succès"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["message" => "Erreur : " . $e->getMessage()]);
}
?>