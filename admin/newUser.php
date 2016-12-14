<?php

  // *******************************************************************************
  // Ajout d'utilisateur
  // ATTENTION
  // Ce script ne doit etre accesible uniquement pas l'administrateur du site web
  // NE PAS METTRE CE SCRIPT EN LIGNE
  // *******************************************************************************


  // si les champ on ete renseigné pou passe a l'ajout
  if ($_POST['username'] && $_POST['password']) {

    // remplissage des variables username, hash du mdp, initialisation de la variable d'erreurs
    $passhash = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $userName = $_POST['username'];
    $errors     = array();

    // connexion a la bd
    require_once '../includes/connectbd.php';

    // Preparationd de la requète d'insertion de l'utilisateur
    if (!$req = $dbconn->prepare("INSERT INTO users (`username`, `password`) VALUES (? , ?)")) {
      // Gestion des erreurs
      $errors['preparation'] = "Erreur de preparation de la requete";
    }

    // Liage des parametres
    if (!$req->bind_param("ss", $userName, $passhash)) {
      // Gestion des erreurs
      $errors['liage'] = "Erreur de liage des parametres";
    }
    
    // execution de la requete
    if (!$req->execute()) {
      // Gestion des erreurs
      $errors['execution'] = "Erreur d'execution de la requete";
    }

    // petit message pour l'utilisateur
    if (empty($errors)) {

      echo "l'utilisateur est crée.";

    } else {

      // reaffiche les erreurs stoquées dans le tableau
      foreach ($errors as $key) {
        echo $key;
      }
      exit();

    }
    
  }

?>

<!-- Page simple avec deux champs pour l'ajout d'utilisateur -->
<HTML>
  <head>
    <meta charset="utf-8" />
    <title>Nouvel utilisateur TA</title>
  </head>


  <body>
    <h3>Nouvel utilisateur Think Analog</h3>

    <!-- Petit formulaire pour rentrer le données de nouveaux utilisateurs -->
    <form action="newUser.php" method="post">
      <div class="form-group">
        <input type="text" class="form-control" id="username" name="username" placeholder="Nom d'utilisateur" required>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
      </div>
      <button type="submit" class="btn btn-primary a-btncenter">Créer</button>
    </form>

  </body>
</HTML>