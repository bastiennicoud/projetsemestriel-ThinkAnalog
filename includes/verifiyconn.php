<?php

  // script pour verifier que l'utilisateur est bien connecté ou que le cookie de rester conecter soit la

  // initialisation des session
  session_start();

  // si une session existe on recupere 2-3 valeurs
  if ($_SESSION) {
    
    $userID = $_SESSION['userID'];
    $userName = $_SESSION['userName'];

  // si pas de session on test si il existe un cookie de remember
  } elseif ($_COOKIE['TAuserremember']) {
    
    // si le cookie existe on le stoque
    $cookie = $_COOKIE['TAuserremember'];

    // connexion a la bd
    require_once 'connectbd.php';

    // pouis on fais une requete pour savoir si il existe dans la bd et qu'un stilisateur y correspond
    // Preparationd de la requète
    if (!$req = $dbconn->prepare("SELECT * FROM users WHERE remember_token = ?")) {
      // Gestion des erreurs
      echo "Erreur de preparation de la requete";
    }

    // Liage des parametres
    if (!$req->bind_param("s", $cookie)) {
      // Gestion des erreurs
      echo "Erreur de liage des parametres";
    }
      
    // execution de la requete
    if (!$req->execute()) {
      // Gestion des erreurs
      echo "Erreur d'execution de la requete";
    }

    // recuper le resultat et conversion en tableau
    $res = $req->get_result();
    $row = $res->fetch_assoc();
    

    if (isset($row['id_user'])) {
      
      // si il existe bien un utilisateur on reinjecte ses informations dans la session
      $_SESSION['userID'] = $row['id_user'];
      $_SESSION['userName'] = $row['username'];

    } else {

      // si il nexiste pas d'utilisateur au cokkie correspondant on redirige
      header('Location: login.php');

    }

  } else {

    // si il n'existe ni session ni cookie on redirige vers la connexion
    header('Location: login.php');

  }

?>