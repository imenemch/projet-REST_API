<?php
$connexion = new mysqli("localhost", "root", "", "rest_api");

if ($connexion->connect_error) {
    die("La connexion a echoue : " . $connexion->connect_error);
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, email, password, created_at, updated_at) VALUES ('$username', '$email', '$password', NOW(), NOW())";

if ($connexion->query($sql) === TRUE) {
    echo "Inscription réussie";
} else {
    echo "Erreur lors de l'inscription : " . $connexion->error;
}

$connexion->close();
?>
