<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.html"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

$connexion = new mysqli("localhost", "root", "", "rest_api");

if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}

$title = $_POST['title'];
$description = $_POST['description'];
$assigned_to = $_POST['assigned_to'];
$created_by = $_SESSION['user_id']; // L'utilisateur connecté est l'auteur de la tâche

$sql = "INSERT INTO tasks (title, description, status, assigned_to, created_by, created_at, updated_at) VALUES ('$title', '$description', 'pending', '$assigned_to', '$created_by', NOW(), NOW())";

if ($connexion->query($sql) === TRUE) {
    echo "Tâche créée avec succès";
} else {
    echo "Erreur lors de la création de la tâche : " . $connexion->error;
}

$connexion->close();
?>