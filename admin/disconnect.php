<?php

  // *******************************************************************************
  // Script pour la deconnexion d'un utilisateur
  // *******************************************************************************

  // initialise les sessions
  session_start();


  // destruction du cookie
  setcookie('TAuserremember', NULL, -1);


  // destruction du token stoqué en bd
  // connexion a la bas de données
  require_once '../includes/connectbd.php';
  
  // Preparationd de la requète
  if (!$req = $dbconn->prepare("UPDATE users SET remember_token='' WHERE id_user=?")) {
    // Gestion des erreurs
    echo "Erreur de preparation de la requete";
  }

  // Liage des parametres
  if (!$req->bind_param("i", $_SESSION['userID'])) {
    // Gestion des erreurs
    echo "Erreur de liage des parametres";
  }
        
  // execution de la requete
  if (!$req->execute()) {
    // Gestion des erreurs
    echo "Erreur d'execution de la requete";
  }

  // destruction de la session
  session_unset();
  session_destroy();
  
  // redirection vers la page de connexion
  header('Location: login.php');
  
?>