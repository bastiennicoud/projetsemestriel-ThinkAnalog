<?php

  // *******************************************************************************
  // Script de verification que l'utilisateru est connecté
  // a ajouter au début de toutes les pages d'administration du site
  // afin d'eviter que quelqun accede a celles ci
  // *******************************************************************************

  // initialisation des session
  session_start();

  // si une session existe on recupere l'id et le nom d'utilisateur pour une eventuelle utilisation
  if ($_SESSION) {
    
    $userID = $_SESSION['userID'];
    $userName = $_SESSION['userName'];

  // si pas de session on test si il existe un cookie de remember
  } elseif ($_COOKIE['TAuserremember']) {
    
    // si le cookie existe on le stoque
    $cookie = $_COOKIE['TAuserremember'];

    // connexion a la bd
    require_once 'connectbd.php';

    // pouis on fais une requete pour savoir si il existe dans la bd et qu'un utilisateur y correspond
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
    

    if (isset($row[0])) {
      
      // si il existe bien un utilisateur on reinjecte ses informations dans la session
      $_SESSION['userID'] = $row[0];
      $_SESSION['userName'] = $row[1];

    } else {

      // si il nexiste pas d'utilisateur au cokkie correspondant on redirige
      header('Location: login.php');

    }

  } else {

    // si il n'existe ni session ni cookie on redirige vers la connexion
    header('Location: login.php');

  }

?>