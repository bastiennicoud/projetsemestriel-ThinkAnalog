<?php

  // bastien nicoud - projet semestriel - think analog v1
  // Connexion a la base de données

  // données de connexion
  $server   = "localhost:8889";
  $username = "root";
  $pass     = "root";
  $dbname   = "thinkanalog";

  // nouvel objet mysqli
  $dbconn = new mysqli($server, $username, $pass, $dbname);

  // definition du charset de communication avec la bd
  $dbconn->set_charset('utf8');

  // erreur de connexion a la bd
  if ($dbconn->connect_errno) {
    echo "Echec lors de la connexion à MySQL : (" . $dbconn->connect_errno . ") " . $dbconn->connect_error;
  }

?>