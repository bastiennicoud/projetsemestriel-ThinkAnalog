<?php

  //recuperation de la session
  require_once '../includes/verifiyconn.php';

  // on recupere tous les produits de think analog pour les afficher plus bas
  require_once '../includes/connectbd.php';
  // première requete on inser les données du produit
  // Preparationd de la requète
  if (!$req = $dbconn->prepare("SELECT products.id_product, products.name, products.header, images.title, images.src FROM products INNER JOIN images ON products.id_product = images.idx_product")) {
    // Gestion des erreurs
    $errors['preparation'] = "Erreur de preparation de la requete";
  }
      
  // execution de la requete
  if (!$req->execute()) {
    // Gestion des erreurs
    $errors['execution'] = "Erreur d'execution de la requete";
  }

  // recuper le resultat et conversion en tableau
  $res = $req->get_result();
  $row = $res->fetch_all();

  require "../includes/header.php";
?>

<div class="container">

  <!-- tout en haut de la page, petit message -->
  <div class="row a-first-row">
    <div class="col-sm-6">
      <h4>Acceuil</h4>
    </div>
    <div class="col-sm-6">
      <h4 class="text-xs-right">Administration Think Analog</h4>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <nav class="nav nav-inline">
        <a class="nav-link disabled" href="#">Connecté comme <?= $userName ?></a>
        <a class="nav-link active color-dark" href="admin.php">Produits</a>
        <a class="nav-link active color-dark" href="newproduct.php">Nouveau produit</a>
        <a class="nav-link color-dark" href="disconnect.php">Deconnexion</a>
        <a class="nav-link color-dark" href="../index.php">Acceuil Think Analog</a>
      </nav>
      <hr>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <!-- Si errors n'est pas vide on affiche alors les erreurs -->
      <?php if(!empty($errors)): ?>

        <div class="alert alert-warning" role="alert">

          <!-- petite boucle pour afficher les erreurs ajoutées au tableau erreurs par php -->
          <?php foreach ($errors as $key) : ?>

            <p><?= $key ?></p>

          <?php endforeach; ?>

            
        
        </div>
        
      <?php endif; ?>

      <?php if(!empty($_SESSION['flash'])): ?>

        <div class="alert alert-success" role="alert">

          <p><?= $_SESSION['flash'] ?></p>
          <?php $_SESSION['flash'] = ""; ?>

        </div>

      <?php endif; ?>

    </div>
  </div>

  <div class="card-columns">

    <?php foreach ($row as $key) : ?>

    <div class="card">
      <img class="card-img-top img-fluid" src="../<?= $key[4]; ?>" alt="<?= $key[3]; ?>">
      <div class="card-block">
        <h4 class="card-title"><?= $key[1]; ?></h4>
        <p class="card-text"><?= $key[2]; ?></p>
        <a class="btn btn-primary btn-info disabled" href="edit.php?id=<?= $key[0]; ?>" role="button" aria-disabled="true">EDIT</a>
        <a class="btn btn-primary btn-danger" href="delete.php?id=<?= $key[0]; ?>" role="button">DELETE</a>
      </div>
    </div>

    <?php endforeach; ?>

  </div>

</div>

<?php require "../includes/footerempty.php"; ?>