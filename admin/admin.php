<?php

  //recuperation de la session
  require_once '../includes/verifiyconn.php';

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
        <a class="nav-link active" href="admin.php">Produits</a>
        <a class="nav-link active" href="newproduct.php">Nouveau produit</a>
        <a class="nav-link" href="disconnect.php">Deconnexion</a>
      </nav>
      <hr>
    </div>
  </div>

  <div class="card-columns">

    <div class="card">
      <img class="card-img-top img-fluid" src="../img/logo.svg" alt="Card image cap">
      <div class="card-block">
        <h4 class="card-title">Nom produit</h4>
        <p class="card-text">Bout de descriptif</p>
        <button type="button" class="btn btn-primary">Edit</button>
        <button type="button" class="btn btn-danger">Delete</button>
      </div>
    </div>

  </div>

</div>

<?php require "../includes/footerempty.php"; ?>