<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Content-Type: application/json");

require "../config/connexion_db.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        $query = $conn->prepare("SELECT * FROM candidat");
        $query->execute();
        $candidats = $query->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($candidats);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["message" => "Erreur : " . $e->getMessage()]);
    }
}
?>