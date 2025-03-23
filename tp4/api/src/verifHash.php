<?php
require "../config/connexion_db.php";

$mdpFromDB = '$2y$10$K44veM/pkzaP6bdhNGzyFuomtUMgep0ekQJ4SGhl/FJrLx71cqgPK';
$mdpFromUser = 'test1234';

if (password_verify($mdpFromUser, $mdpFromDB)) {
    echo 'Le mot de passe est correct !';
} else {
    echo 'Le mot de passe est incorrect.';
}
?>