<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

require "../config/connexion_db.php";

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['id_avis'])) {
        $id_avis = $data['id_avis'];

        $query = $conn->prepare("SELECT id_avis FROM avis WHERE id_avis = ?");
        $query->execute([$id_avis]);
        if ($query->rowCount() > 0) {
            $deleteQuery = $conn->prepare("DELETE FROM avis WHERE id_avis = ?");
            if ($deleteQuery->execute([$id_avis])) {
                echo json_encode(["message" => "Avis supprimé avec succès"]);
            } else {
                echo json_encode(["message" => "Erreur lors de la suppression de l'avis"]);
            }
        } else {
            echo json_encode(["message" => "L'avis avec cet ID n'existe pas"]);
        }
    } else {
        echo json_encode(["message" => "Données manquantes ou invalides"]);
    }
}
?>