<?php 
$host = "localhost";
$db_name = "bd_easy";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["message" => "Erreur de connexion : " . $e->getMessage()]);
    exit();
}
?>