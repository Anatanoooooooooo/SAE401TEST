
<?php 
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Content-Type: application/json");

require "../config/connexion_db.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"));
    //var_dump($data);
    $login = $data->login;
    $mdp = $data->mdp;
    //var_dump($login); // Vérifie que le login est correct
    //var_dump($mdp);   // Vérifie que le mot de passe est correct

    $query = $conn->prepare("SELECT * FROM personne WHERE login = ?");
    $query->execute([$login]);
    $user = $query->fetch(PDO::FETCH_ASSOC);
    
    
    if ($user && password_verify($mdp, $user ['mdp'])){
        $_SESSION['user'] = $user['id'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['prenom'] = $user['prenom'];
        
        


        header('Content-Type: application/json; chartset=UTF-8');
        echo json_encode(["message" => "Connexion réussie"]);
    } else {
        http_response_code(401);
        header('Content-Type: application/json; chartset=UTF-8');
        echo json_encode(["message" => "Identifiants incorrects"]);
    }
    //var_dump($user);
    //var_dump(password_verify($mdp, $user['mdp'])); // Doit retourner true si le mot de passe est correct
}
?>