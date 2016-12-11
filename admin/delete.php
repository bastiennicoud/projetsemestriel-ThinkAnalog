<?php

  // j'inclus le verify conn pour exiter que nimporte qui puisse acceder a ce script
  require_once '../includes/verifiyconn.php';

  if($_GET['id']) {
    
    $productID = $_GET['id'];

    // connexion a la bd
    require_once '../includes/connectbd.php';

    if (!$req = $dbconn->prepare("DELETE FROM products WHERE id_product=?;")) {
      // Gestion des erreurs
      $errors['preparation'] = "Erreur de preparation de la requete";
    }

    // Liage des parametres
    if (!$req->bind_param("i", $productID)) {
      // Gestion des erreurs
      $errors['liage'] = "Erreur de liage des parametres";
    }
      
    // execution de la requete
    if (!$req->execute()) {
      // Gestion des erreurs
      $errors['execution'] = "Erreur d'execution de la requete";
    }

    $_SESSION['flash'] = "Le produit a bien été supprimé";
    header('Location: admin.php');

  } else {

    // si il ny a rien dans get on redirige vers l'acceuil
    header('Location: admin.php');
  }

?>