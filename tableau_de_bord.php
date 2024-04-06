<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
</head>
<body>
    <h2>Tableau de bord</h2>
    <h3>Tâches en cours :</h3>
    <ul>
        <?php
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: connexion.html"); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
            exit();
        }
        
        $user_id = $_SESSION['user_id'];
        
        // Connexion à la base de données
        $connexion = new mysqli("localhost", "root", "", "rest_api");
        if ($connexion->connect_error) {
            die("La connexion a échoué : " . $connexion->connect_error);
        }
        
        // Récupérer les tâches de l'utilisateur connecté
        $sql = "SELECT * FROM tasks WHERE assigned_to = '$user_id'";
        $result = $connexion->query($sql);
        
        // Afficher les tâches
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<li>" . $row['title'] . " - Statut : " . $row['status'] . "</li>";
            }
        } else {
            echo "Aucune tâche en cours";
        }
        
        // Fermer la connexion à la base de données
        $connexion->close();
        ?>
    </ul>
</body>
</html>
