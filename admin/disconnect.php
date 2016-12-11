<?php

  // destruction de la session
  session_destroy();
  // destruction du cookie
  setcookie('TAuserremember', NULL, -1);
  // redirection vers la page de connexion
  header('Location: login.php');
  
?>