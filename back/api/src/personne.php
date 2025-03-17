<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Content-Type: application/json");
if (file_exists('C:/xampp/htdocs/back/vendor/autoload.php')) {
    require_once('C:/xampp/htdocs/back/vendor/autoload.php');
} else {
    echo 'Fichier autoload.php introuvable.';
}

use \Firebase\JWT\JWT;

function generateJWT($userId) {
    // Clé secrète pour signer le JWT (utiliser une clé plus sécurisée dans la production)
    $secretKey = "votre_clé_secrète";  // Remplacez par une clé plus complexe dans un environnement de production

    // Définir les informations à inclure dans le token
    $issuedAt = time();  // Temps d'émission du token
    $expirationTime = $issuedAt + 3600;  // Durée de vie du token (1 heure)
    $payload = [
        "iss" => "votre_serveur",  // Émetteur du token
        "iat" => $issuedAt,        // Date d'émission
        "exp" => $expirationTime,  // Date d'expiration
        "user_id" => $userId       // L'ID de l'utilisateur que vous souhaitez stocker dans le token
    ];

     // Définir les options pour l'algorithme de signature
     $jwtOptions = [
        'algorithm' => 'HS256'  // Utilisation de l'algorithme HMAC SHA-256 pour signer le JWT
    ];

    // Générer le token
    return JWT::encode($payload, $secretKey, 'HS256');
}



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

// Récupérer tous les utilisateurs
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $conn->prepare("SELECT * FROM personne");
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

// Ajouter un utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    // Vérification des données
    if (!empty($data->login) && !empty($data->mdp) && !empty($data->nom) && !empty($data->prenom)) {
        $query = "INSERT INTO personne (login, mdp, nom, prenom) VALUES (:login, :mdp, :nom, :prenom)";
        $stmt = $conn->prepare($query);

        // Correction : login est un VARCHAR donc on le traite comme une chaîne
        $stmt->bindParam(":login", $data->login, PDO::PARAM_STR);
        $stmt->bindParam(":mdp", $data->mdp, PDO::PARAM_STR);
        $stmt->bindParam(":nom", $data->nom, PDO::PARAM_STR);
        $stmt->bindParam(":prenom", $data->prenom, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Utilisateur ajouté avec succès."]);
        } else {
            echo json_encode(["message" => "Impossible d’ajouter l’utilisateur."]);
        }
    } else {
        echo json_encode(["message" => "Données incomplètes."]);
    }
}

// Vérifier si la méthode est PUT
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Récupérer l'ID à partir des paramètres d'URL (par exemple ?id=1)
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    // Vérifier si l'ID est fourni
    if ($id) {
        // Récupérer les données envoyées via PUT
        $data = json_decode(file_get_contents("php://input"));
        
        // Vérifier que l'utilisateur existe
        $stmt = $conn->prepare("SELECT * FROM personne WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Si l'utilisateur existe, préparer la mise à jour
            $fieldsToUpdate = [];
            $params = [];

            // Vérifier si chaque champ est fourni et ajouter à la requête de mise à jour
            if (!empty($data->login)) {
                $fieldsToUpdate[] = "login = :login";
                $params[':login'] = $data->login;
            }
            if (!empty($data->mdp)) {
                $fieldsToUpdate[] = "mdp = :mdp";
                $params[':mdp'] = $data->mdp;
            }
            if (!empty($data->nom)) {
                $fieldsToUpdate[] = "nom = :nom";
                $params[':nom'] = $data->nom;
            }
            if (!empty($data->prenom)) {
                $fieldsToUpdate[] = "prenom = :prenom";
                $params[':prenom'] = $data->prenom;
            }

            // Si des champs doivent être mis à jour, procéder
            if (count($fieldsToUpdate) > 0) {
                // Créer la requête de mise à jour dynamique
                $query = "UPDATE personne SET " . implode(", ", $fieldsToUpdate) . " WHERE id = :id";
                $stmt = $conn->prepare($query);
                
                // Ajouter l'ID aux paramètres
                $params[':id'] = $id;

                // Exécuter la mise à jour
                if ($stmt->execute($params)) {
                    echo json_encode(["message" => "Utilisateur mis à jour avec succès."]);
                } else {
                    echo json_encode(["message" => "Impossible de mettre à jour l'utilisateur."]);
                }
            } else {
                echo json_encode(["message" => "Aucune donnée à mettre à jour."]);
            }
        } else {
            echo json_encode(["message" => "Utilisateur non trouvé."]);
        }
    } else {
        echo json_encode(["message" => "ID manquant."]);
    }
}

// Vérifier si la méthode est DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Récupérer l'ID à partir des paramètres d'URL (par exemple ?id=2)
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    // Vérifier si l'ID est fourni
    if ($id) {
        // Vérifier si l'utilisateur existe
        $stmt = $conn->prepare("SELECT * FROM personne WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Si l'utilisateur existe, supprimer l'utilisateur
            $stmt = $conn->prepare("DELETE FROM personne WHERE id = :id");
            $stmt->bindParam(':id', $id);

            // Exécuter la suppression
            if ($stmt->execute()) {
                echo json_encode(["message" => "Utilisateur supprimé avec succès."]);
            } else {
                echo json_encode(["message" => "Impossible de supprimer l'utilisateur."]);
            }
        } else {
            echo json_encode(["message" => "Utilisateur non trouvé."]);
        }
    } else {
        echo json_encode(["message" => "ID manquant."]);
    }
}

// Inscription d'un utilisateur (register)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] == 'register') {
    $data = json_decode(file_get_contents("php://input"));

    // Vérifier que les données sont bien envoyées
    if (!empty($data->login) && !empty($data->mdp) && !empty($data->nom) && !empty($data->prenom)) {
        // Hash du mot de passe
        $hashedPassword = password_hash($data->mdp, PASSWORD_DEFAULT);

        // Insérer l'utilisateur dans la base de données
        $query = "INSERT INTO personne (login, mdp, nom, prenom) VALUES (:login, :mdp, :nom, :prenom)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':login', $data->login);
        $stmt->bindParam(':mdp', $hashedPassword);
        $stmt->bindParam(':nom', $data->nom);
        $stmt->bindParam(':prenom', $data->prenom);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Utilisateur inscrit avec succès."]);
        } else {
            echo json_encode(["message" => "Erreur lors de l'inscription."]);
        }
    } else {
        echo json_encode(["message" => "Données manquantes."]);
    }
}

// Connexion de l'utilisateur (login)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] == 'login') {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->login) && !empty($data->mdp)) {
        // Récupérer l'utilisateur avec le login
        $query = "SELECT * FROM personne WHERE login = :login";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':login', $data->login);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($data->mdp, $user['mdp'])) {
            // Générer un token JWT automatiquement
            $token = generateJWT($user['id']);  // Récupérer l'ID de l'utilisateur et générer un token

            // Retourner le token au client
            echo json_encode(["message" => "Connexion réussie.", "token" => $token]);
        } else {
            echo json_encode(["message" => "Identifiants incorrects."]);
        }
    } else {
        echo json_encode(["message" => "Données manquantes."]);
    }
}


?>
