<?php

  // *******************************************************************************
  // Script pour la connexion de l'utilisateur
  // *******************************************************************************


  // si les champs username et password on étés remplis on passe dans le script de connexion
  if ($_POST['username'] && $_POST['password']) {

    // demarage du système de session php
    session_start();
    
    // on recupere les differentes informations donnees par l'utilisateur
    $userName   = $_POST['username'];
    $password   = $_POST['password'];
    $persistant = $_POST['persistant'];
    // initialisation d'un tableau pour la gestion des erreurs
    $errors     = array();

    // connexion a la base de données
    require_once '../includes/connectbd.php';

    // on fais une requete pour voir si il y a un utilisateur existant qui possede le nom specifié par l'utilisateur
    // Preparationd de la requète
    if (!$req = $dbconn->prepare("SELECT * FROM users WHERE username = ?")) {
      // Gestion des erreurs
      $errors['preparation'] = "Erreur de preparation de la requete";
    }

    // Liage des parametres
    if (!$req->bind_param("s", $userName)) {
      // Gestion des erreurs
      $errors['liage'] = "Erreur de liage des parametres";
    }
    
    // execution de la requete
    if (!$req->execute()) {
      // Gestion des erreurs
      $errors['execution'] = "Erreur d'execution de la requete";
    }
    
    // recuper le resultat et conversion en tableau
    $res = $req->get_result();
    $row = $res->fetch_assoc();
    

    // si un utilisateur existe correspondant existe on procede a la verification du mdp
    if ($row['username'] && $row['password']) {

      // test du mdp en comparant les empreintes
      if (password_verify($password, $row['password'])) {
        
        // si le mdp est ok on rentre l'id et le nom dans la session pour une eventuelle utilisation
        $_SESSION['userID'] = $row['id_user'];
        $_SESSION['userName'] = $row['username'];

        // si l'utilisateur a coché la case rester connecté
        if ($persistant == "yes") {

          // on crée un token plus ou moin unique et aleatoire qu'on utilisera pour verifier l'utilisateur
          $remembertoken = sha1($row['username'] . "tralala") . $row['id_user'] . sha1($row['username']);

          // on crée un cookie pour 7 jours en utilisant le token comme valeur
          setcookie('TAuserremember', $remembertoken , time() + 60*60*24*7);
          
          // on enregistre ce token dans la bd pour pouvoir le comparer lors de la verification
          // Preparationd de la requète
          if (!$req = $dbconn->prepare("UPDATE users SET remember_token = ? WHERE id_user = ?")) {
            // Gestion des erreurs
            $errors['preparation'] = "Erreur de preparation de la requete";
          }

          // Liage des parametres
          if (!$req->bind_param("si", $remembertoken, $row['id_user'])) {
            // Gestion des erreurs
            $errors['liage'] = "Erreur de liage des parametres";
          }
      
          // execution de la requete
          if (!$req->execute()) {
            // Gestion des erreurs
            $errors['execution'] = "Erreur d'execution de la requete";
          }

        }

        // une fois l'utilisateur bien authentifié on le redirige vers la page d'administration
        header('Location: admin.php');

      } else {

        // si le mot de passe est faux erreur
        $errors['password'] = "Mot de passe erroné";

      }

    } else {

      // si l'utilisateur n'existe pas erreur
      $errors['username'] = "Cet utilisateur n'existe pas";

    }

  }

  // appel du header
  require "../includes/header.php";

?>

<!-- Page HTML -->
<div class="container-fluid a-containerbackground">

  <!-- lien pour aller a la page d'aceuil du site public -->
  <a href="../index.php" class="a-asize text-xs-right color-dark">Acceuil Think Analog</a>

  <!-- div contenant la box et le elements pour le login -->
  <div class="a-loginbox col-md-4 offset-md-4">

    <img src="../img/logo.svg" alt="Logo Think Analog" class="col-xs-10 offset-xs-1 a-logomgbottom">
    <h3 class="text-xs-center">Connectez-vous</h3>
  
    <!-- Affichage des erreurs -->
    <!-- Si errors n'est pas vide on affiche alors les erreurs -->
    <?php if(!empty($errors)): ?>

      <div class="alert alert-warning" role="alert">

        <!-- petite boucle pour afficher les erreurs ajoutées au tableau erreurs par php -->
        <?php foreach ($errors as $key) : ?>

          <p><?= $key ?></p>

        <?php endforeach; ?>
      
      </div>
      
    <?php endif; ?>

    <!-- Formulaire pour le login -->
    <form action="login.php" method="post">

      <!-- Username -->
      <div class="form-group">
        <input type="text" class="form-control" id="username" name="username" placeholder="Nom d'utilisateur" required>
      </div>

      <!-- Mot de passe -->
      <div class="form-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
      </div>

      <!-- Checkbox pour rester connecté -->
      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="persistant" value="yes">
          Rester connecté
        </label>
      </div>

      <!-- bouton de soumission -->
      <button type="submit" class="btn btn-primary a-btncenter">Se connecter</button>
    </form>

  </div>
  
</div>

<!-- Inclusion du footer -->
<?php require "../includes/footerempty.php"; ?>