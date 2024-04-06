<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.html"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $task_id = $_POST['task_id'];
    $new_status = $_POST['new_status'];
    
    // Connexion à la base de données
    $connexion = new mysqli("localhost", "root", "", "rest_api");
    if ($connexion->connect_error) {
        die("La connexion a échoué : " . $connexion->connect_error);
    }
    
    // Mettre à jour le statut de la tâche dans la base de données
    $sql = "UPDATE tasks SET status='$new_status' WHERE id='$task_id' AND assigned_to='$user_id'";
    if ($connexion->query($sql) === TRUE) {
        echo "Statut de la tâche mis à jour avec succès";
    } else {
        echo "Erreur lors de la mise à jour du statut de la tâche : " . $connexion->error;
    }
    
    // Fermer la connexion à la base de données
    $connexion->close();
}
?>
