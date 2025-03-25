<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json");

require "../config/connexion_db.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $query = $conn->prepare("SELECT titre, texte FROM avis");
    $query->execute();
    $avis = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($avis);
}
?>