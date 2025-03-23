<?php 
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Content-Type: application/json");

require "../config/connexion_db.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $query = $conn->prepare("SELECT * FROM personne");
    $query->execute();
    $users = $query->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode($users);

}
?>