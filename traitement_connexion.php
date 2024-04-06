<?php
$connexion = new mysqli("localhost", "root", "", "rest_api");

if ($connexion->connect_error) {
    die("La connexion a échoué : " . $connexion->connect_error);
}

$username_or_email = $_POST['username_or_email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username_or_email' OR email='$username_or_email'";
$result = $connexion->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Créer une session pour l'utilisateur
        session_start();
        $_SESSION['user_id'] = $row['id'];
        
        // Rediriger vers le tableau de bord après une connexion réussie
        header("Location: tableau_de_bord.php");
        exit(); // Assure que le script s'arrête après la redirection
    } else {
        echo "Mot de passe incorrect";
    }
} else {
    echo "Nom d'utilisateur ou adresse e-mail invalide";
}

$connexion->close();
?>
