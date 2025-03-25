<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

require "../config/connexion_db.php";

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['id_avis'], $data['titre'], $data['texte'])) {
        $id_avis = $data['id_avis'];
        $titre = $data['titre'];
        $texte = $data['texte'];

        $query = $conn->prepare("UPDATE avis SET titre = ?, texte = ? WHERE id_avis = ?");
        if ($query->execute([$titre, $texte, $id_avis])) {
            echo json_encode(["message" => "Avis mis à jour avec succès"]);
        } else {
            echo json_encode(["message" => "Erreur lors de la mise à jour de l'avis"]);
        }
    } else {
        echo json_encode(["message" => "Données manquantes ou invalides"]);
    }
}
?>