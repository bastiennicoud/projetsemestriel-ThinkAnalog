<?php

  // *******************************************************************************
  // Script pour la deconnexion d'un utilisateur
  // *******************************************************************************

  // destruction de la session
  session_start();
  session_unset();
  session_destroy();

  // destruction du cookie
  setcookie('TAuserremember', NULL, -1);
  
  // redirection vers la page de connexion
  header('Location: login.php');
  
?>