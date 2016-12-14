<?php

  // *******************************************************************************
  // Script pour supprimer un produit
  // *******************************************************************************

  // j'inclus le verify conn pour eviter que nimporte qui puisse acceder a ce script
  require_once '../includes/verifiyconn.php';

  // si on a l'id du produit dans le GET on peut procéder
  if($_GET['id']) {
    
    // stoque l'id dans une variable
    $productID = $_GET['id'];

    // connexion a la bd
    require_once '../includes/connectbd.php';

    // requète préparée pour supprimer le produit qui a l'id corespondant
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

    // on passe un message dans la sesion pour qu'il safiche quant la page admin est chargée
    $_SESSION['flash'] = "Le produit a bien été supprimé";

    // redirection vers admin
    header('Location: admin.php');

  } else {

    // si il ny a rien dans get on redirige vers l'acceuil
    header('Location: admin.php');
  }

?>