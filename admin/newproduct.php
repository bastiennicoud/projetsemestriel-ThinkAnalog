<?php

  //recuperation de la session
  require_once '../includes/verifiyconn.php';

  require "../includes/header.php";
?>

<div class="container">

  <!-- tout en haut de la page, petit message -->
  <div class="row a-first-row">
    <div class="col-sm-6">
      <h4>Ajouter un produit</h4>
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
        <a class="nav-link" href="disconnect.php">Deconnexion</a>
      </nav>
      <hr>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <form action="newproduct.php" method="post">
        <div class="form-group">
          <label for="productname">Nom du produit</label>
          <input type="text" class="form-control" id="productname" name="productname" aria-describedby="emailHelp" placeholder="Entrez le nom du produit">
        </div>
        <div class="form-group">
          <label for="productsmalldesc">Le descriptif rapide du produit</label>
          <textarea class="form-control" id="productsmalldesc" name="productsmalldesc" rows="5"></textarea>
        </div>
        <div class="form-group">
          <label for="productdescription">Descriptif poussé et détaillé du produit</label>
          <textarea class="form-control" id="productdescription" name="productdescription" rows="10"></textarea>
        </div>
        <div class="form-group">
          <label for="productfeature">Caractéristiques du produit <small>Séparez chaque caractéristiques par un -</small></label>
          <textarea class="form-control" id="roductfeature" name="roductfeature" rows="5"></textarea>
        </div>
        <div class="form-group">
          <label for="productconnect">Connectique du produit <small>Séparez chaque connecteur par un -</small></label>
          <textarea class="form-control" id="productconnect" name="productconnect" rows="5"></textarea>
        </div>

        <div class="form-group">
          <label for="productname">Nom du produit</label>
          <input type="text" class="form-control" id="productname" name="productname" aria-describedby="emailHelp" placeholder="Entrez le nom du produit">
        </div>
        <div class="form-group">
          <label for="productname">Nom du produit</label>
          <input type="text" class="form-control" id="productname" name="productname" aria-describedby="emailHelp" placeholder="Entrez le nom du produit">
        </div>


        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group">
          <label for="exampleSelect1">Example select</label>
          <select class="form-control" id="exampleSelect1">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleSelect2">Example multiple select</label>
          <select multiple class="form-control" id="exampleSelect2">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleTextarea">Example textarea</label>
          <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
        </div>
        <div class="form-group">
          <label for="exampleInputFile">File input</label>
          <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
          <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
        </div>
        <fieldset class="form-group">
          <legend>Radio buttons</legend>
          <div class="form-check">
            <label class="form-check-label">
              <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="option1" checked>
              Option one is this and that&mdash;be sure to include why it's great
            </label>
          </div>
          <div class="form-check">
          <label class="form-check-label">
              <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2">
              Option two can be something else and selecting it will deselect option one
            </label>
          </div>
          <div class="form-check disabled">
          <label class="form-check-label">
              <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios3" value="option3" disabled>
              Option three is disabled
            </label>
          </div>
        </fieldset>
        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input">
            Check me out
          </label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

    </div>
  </div>

</div>

<?php require "../includes/footerempty.php"; ?>