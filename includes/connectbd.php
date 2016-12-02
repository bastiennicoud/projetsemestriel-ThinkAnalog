<?php
  
  // bastien nicoud - projet semestriel - think analog v1
  // Connexion a la base de données

  // données de connexion
  $server   = "localhost:8889";
  $username = "root";
  $pass     = "root";
  $dbname   = "thinkanalog";

  // nouvel objet mysqli
  $mysqli = new mysqli($server, $username, $pass, $dbname);

  // definition du charset de communication avec la bd
  $mysqli->set_charset('utf8');

  // erreur de connexion a la bd
  if ($mysqli->connect_errno) {
    echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }

?>