<?php
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    http_response_code(200); // Répondez avec un statut OK pour OPTIONS
    exit();
}

// Inclure le fichier de connexion
require "../config/connexion_db.php";

try {
    // Récupération des données PUT
    $data = json_decode(file_get_contents("php://input"), true);

    // Validation des données
    if (!isset($data['id_personne'], $data['nom'], $data['prenom'], $data['login'], $data['mdp'], $data['adresse_rue'], $data['adresse_cp'], $data['adresse_ville'], $data['mail'], $data['telephone'], $data['date_naissance'], $data['NEPH'])) {
        http_response_code(400);
        echo json_encode(["message" => "Données incomplètes pour la mise à jour"]);
        exit();
    }

    if (empty($data['id_personne'])) {
        http_response_code(400);
        echo json_encode(["message" => "ID manquant"]);
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

    // Mise à jour de la table `candidat`
    $adresse_rue = $data['adresse_rue'];
    $adresse_cp = $data['adresse_cp'];
    $adresse_ville = $data['adresse_ville'];
    $mail = $data['mail'];
    $telephone = $data['telephone'];
    $date_naissance = $data['date_naissance'];
    $neph = $data['NEPH'];

    $sqlCandidat = "UPDATE candidat SET adresse_rue = :adresse_rue, adresse_cp = :adresse_cp, adresse_ville = :adresse_ville, mail = :mail, telephone = :telephone, date_naissance = :date_naissance, NEPH = :neph WHERE id_personne = :id_personne";
    $stmt = $conn->prepare($sqlCandidat);
    $stmt->execute([
        ':adresse_rue' => $adresse_rue,
        ':adresse_cp' => $adresse_cp,
        ':adresse_ville' => $adresse_ville,
        ':mail' => $mail,
        ':telephone' => $telephone,
        ':date_naissance' => $date_naissance,
        ':neph' => $neph,
        ':id_personne' => $id_personne,
    ]);

    http_response_code(200);
    echo json_encode(["message" => "Informations mises à jour avec succès"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["message" => "Erreur : " . $e->getMessage()]);
}
?>
// Inclure le fichier de connexion
require "../config/connexion_db.php";

try {
    // Récupération des données PUT
    $data = json_decode(file_get_contents("php://input"), true);

    // Validation des données
    if (!isset($data['id_personne'], $data['nom'], $data['prenom'], $data['login'], $data['mdp'], $data['adresse_rue'], $data['adresse_cp'], $data['adresse_ville'], $data['mail'], $data['telephone'], $data['date_naissance'], $data['NEPH'])) {
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

    // Mise à jour de la table `candidat`
    $adresse_rue = $data['adresse_rue'];
    $adresse_cp = $data['adresse_cp'];
    $adresse_ville = $data['adresse_ville'];
    $mail = $data['mail'];
    $telephone = $data['telephone'];
    $date_naissance = $data['date_naissance'];
    $neph = $data['NEPH'];

    $sqlCandidat = "UPDATE candidat SET adresse_rue = :adresse_rue, adresse_cp = :adresse_cp, adresse_ville = :adresse_ville, mail = :mail, telephone = :telephone, date_naissance = :date_naissance, NEPH = :neph WHERE id_personne = :id_personne";
    $stmt = $conn->prepare($sqlCandidat);
    $stmt->execute([
        ':adresse_rue' => $adresse_rue,
        ':adresse_cp' => $adresse_cp,
        ':adresse_ville' => $adresse_ville,
        ':mail' => $mail,
        ':telephone' => $telephone,
        ':date_naissance' => $date_naissance,
        ':neph' => $neph,
        ':id_personne' => $id_personne,
    ]);

    http_response_code(200);
    echo json_encode(["message" => "Informations mises à jour avec succès"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["message" => "Erreur : " . $e->getMessage()]);
}
?>