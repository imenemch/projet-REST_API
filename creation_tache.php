<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de tâche</title>
</head>
<body>
    <h2>Création de tâche</h2>
    <form action="traitement_creation_tache.php" method="post">
        <label for="title">Titre de la tâche:</label><br>
        <input type="text" id="title" name="title" required><br>
        <label for="description">Description de la tâche:</label><br>
        <textarea id="description" name="description" rows="4" cols="50"></textarea><br>
        <label for="assigned_to">Utilisateur attribué:</label><br>
        <select id="assigned_to" name="assigned_to" required>
            <option value="">Sélectionner un utilisateur</option>
            <?php
            // Connexion à la base de données
            $connexion = new mysqli("localhost", "root", "", "rest_api");
            if ($connexion->connect_error) {
                die("La connexion a échoué : " . $connexion->connect_error);
            }
            
            // Récupérer les utilisateurs depuis la base de données
            $sql = "SELECT id, username FROM users";
            $result = $connexion->query($sql);
            
            // Afficher chaque utilisateur dans la liste déroulante
            while($row = $result->fetch_assoc()) {
                echo "<option value='".$row['id']."'>".$row['username']."</option>";
            }
            
            // Fermer la connexion à la base de données
            $connexion->close();
            ?>
        </select><br><br>
        <input type="submit" value="Créer la tâche">
    </form>
</body>
</html>
