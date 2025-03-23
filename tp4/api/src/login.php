
<?php 
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Content-Type: application/json");

require "../config/connexion_db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"));

    if (!isset($data->login, $data->mdp)) {
        http_response_code(400);
        echo json_encode(["message" => "Données incomplètes"]);
        exit();
    }

    $login = $data->login;
    $mdp = $data->mdp;

    // Vérifier si l'utilisateur existe
    $query = $conn->prepare("SELECT * FROM personne WHERE login = ?");
    $query->execute([$login]);
    $user = $query->fetch(PDO::FETCH_ASSOC);
    
    if ($user && password_verify($mdp, $user['mdp'])) {
        $_SESSION['user'] = $user['id'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['prenom'] = $user['prenom'];

        // Récupérer le rôle de l'utilisateur en fonction des tables avec la bonne structure de clé étrangère
        $queryRole = $conn->prepare("
            SELECT 'admin' AS role FROM Admin WHERE id_personne = ?
            UNION 
            SELECT 'autoecole' AS role FROM Autoecole WHERE id_personne = ?
            UNION 
            SELECT 'candidat' AS role FROM Candidat WHERE id_personne = ?
        ");
        $queryRole->execute([$user['id'], $user['id'], $user['id']]);
        $role = $queryRole->fetchColumn();
        
        // Si aucun rôle n'est trouvé, définir un rôle par défaut
        if (!$role) {
            $role = "utilisateur";
        }

        // Réponse JSON avec les infos utilisateur et son rôle
        echo json_encode([
            "message" => "Connexion réussie",
            "user" => [
                "id" => $user['id'],
                "nom" => $user['nom'],
                "prenom" => $user['prenom'],
                "role" => $role
            ]
        ]);
    } else {
        http_response_code(401);
        echo json_encode(["message" => "Identifiants incorrects"]);
    }
}
?>