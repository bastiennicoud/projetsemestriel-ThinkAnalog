<?php

  // *******************************************************************************
  // Script pour l'edition d'un produit
  // *******************************************************************************



  // *******************************************************************************
  // ATENTION non fonctionnel pour l'instant
  // *******************************************************************************

  //recuperation de la session
  require_once '../includes/verifiyconn.php';

  // si il ny a rien dans l'id c'est qu'on peut passer a la modification dans la bd
  if (!isset($_GET['id'])) {

    // ajout du produit dans la bd
    // on passe dans le script si l'utilisateur a remplis le formulaire
    if ($_POST['productname']) {
      
      // verification que les champs sont pleins (pas besoin de verifier le premier vu qu'on passe dans condition si il est rempli)
      // recuperation des champs htmlspecialchars comme ça c'est fait
      $productname        = htmlspecialchars($_POST['productname']);
      $productsmalldesc   = htmlspecialchars($_POST['productsmalldesc']);
      $productdescription = htmlspecialchars($_POST['productdescription']);
      $productfeature     = htmlspecialchars($_POST['productfeature']);
      $productconnect     = htmlspecialchars($_POST['productconnect']);
      // initialisation tableau pour les erreurs
      $errors = array();

      // ecriture des erreurs si un champ na pas ete renseigné ou nom trop long
      if (strlen($productname) > 250) {
        $errors['productname'] = "Le nom du produit est trop long";
      }
      if ($productsmalldesc == "") {
        $errors['productsmalldesc'] = "Vous n'avez pas rentré de description d'accroche.";
      }
      if ($productdescription == "") {
        $errors['productdescription'] = "Vous n'avez pas rentré de description pour le produit.";
      }
      if ($productfeature == "") {
        $errors['productfeature'] = "Vous n'avez pas rentré de caractéristique pour le produit.";
      }
      if ($productconnect == "") {
        $errors['productconnect'] = "Vous n'avez pas rentré de connectique pour le produit.";
      }


      // ***********************************************
      // INSERTION DANS LA BD
      // si il ny a pas d'erreurs on est bon pour ajouter notre produit a la base de données
      if (empty($errors)) {
        
        // connexion a la bas de données
        require_once '../includes/connectbd.php';
        // première requete on inser les données du produit
        // Preparationd de la requète
        if (!$req = $dbconn->prepare("INSERT INTO products (name, header, description) VALUES (?, ?, ?)")) {
          // Gestion des erreurs
          $errors['preparation'] = "Erreur de preparation de la requete";
        }

        // Liage des parametres
        if (!$req->bind_param("sss", $productname, $productsmalldesc, $productdescription)) {
          // Gestion des erreurs
          $errors['liage'] = "Erreur de liage des parametres";
        }
        
        // execution de la requete
        if (!$req->execute()) {
          // Gestion des erreurs
          $errors['execution'] = "Erreur d'execution de la requete";
        }
        
        // je récupere le dernier ID inseré pour fais les insert suivant avec la clef etrangére
        $lastID = $req->insert_id;
        


        // **********************************************
        // insertion des feature avec une boucle
        $singlefeature = explode("-", $productfeature);

        foreach ($singlefeature as $key) {

          // seconde requete insertions dans la table caractéristique
          // Preparationd de la requète
          if (!$req = $dbconn->prepare("INSERT INTO features (feature, idx_product) VALUES (?, ?)")) {
            // Gestion des erreurs
            $errors['preparation'] = "Erreur de preparation de la requete";
          }

          // Liage des parametres
          if (!$req->bind_param("ss", $key, $lastID)) {
            // Gestion des erreurs
            $errors['liage'] = "Erreur de liage des parametres";
          }
          
          // execution de la requete
          if (!$req->execute()) {
            // Gestion des erreurs
            $errors['execution'] = "Erreur d'execution de la requete";
          }

        }

        // **********************************************
        // insertion des connecteurs avec une boucle
        $singleconnector = explode("-", $productconnect);

        foreach ($singleconnector as $key) {

          // seconde requete insertions dans la table caractéristique
          // Preparationd de la requète
          if (!$req = $dbconn->prepare("INSERT INTO connectors (connector, idx_product) VALUES (?, ?)")) {
            // Gestion des erreurs
            $errors['preparation'] = "Erreur de preparation de la requete";
          }

          // Liage des parametres
          if (!$req->bind_param("ss", $key, $lastID)) {
            // Gestion des erreurs
            $errors['liage'] = "Erreur de liage des parametres";
          }
          
          // execution de la requete
          if (!$req->execute()) {
            // Gestion des erreurs
            $errors['execution'] = "Erreur d'execution de la requete";
          }

        }

        // on redirige une fois le produit bien créé
        $_SESSION['flash'] = "Le produit a bien eté créé";
        header('Location: admin.php');

      }

    }

  } else {

    // si on a passé un id par GET c'est que l'on veut obtenir les infos du produt pour modification
    $productID = $_GET['id'];

    // connexion a la bd
    require_once "../includes/connectbd.php";

    // requete preparee
    if (!$req = $dbconn->prepare("
                                  SELECT products.id_product, products.name, products.header, products.description, images.title, images.src, categorys.category, features.feature, connectors.connector
                                  FROM products
                                  INNER JOIN images ON products.id_product=images.idx_product
                                  INNER JOIN categorys ON products.id_product=categorys.idx_product
                                  INNER JOIN features ON products.id_product=features.idx_product
                                  INNER JOIN connectors ON products.id_product=connectors.idx_product
                                  WHERE products.id_product=?
                                  ")) {
      // Gestion des erreurs
      $errors['preparation'] = "Erreur de preparation de la requete";
    }

    // Liage des parametres
    if (!$req->bind_param("i", $productID)) {
      // Gestion des erreurs
      echo "Erreur de liage des parametres";
    }

    // execution de la requete
    if (!$req->execute()) {
      // Gestion des erreurs
      $errors['execution'] = "Erreur d'execution de la requete";
    }

    // recuper le resultat et conversion en tableau
    $res = $req->get_result();
    $row = $res->fetch_all();

    // ici je passe les caractéristiques dans le nom des clef d'un tableau pour supprimer les doublons 
    foreach ($row as $key) {
      $filtredfeature[$key[7]] = 1;
    }

    // ici je passe les connecteurs dans le nom des clef d'un tableau pour supprimer les doublons 
    foreach ($row as $key) {
      $filtredconnectors[$key[8]] = 1;
    }

  }


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

      <!-- Si errors n'est pas vide on affiche alors les erreurs -->
      <?php if(!empty($errors)): ?>

        <div class="alert alert-warning" role="alert">

          <!-- petite boucle pour afficher les erreurs ajoutées au tableau erreurs par php -->
          <?php foreach ($errors as $key) : ?>

            <p><?= $key ?></p>

          <?php endforeach; ?>
        
        </div>
        
      <?php endif; ?>

    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <form action="newproduct.php" method="post">
        <div class="form-group">
          <label for="productname">ID du produit</label>
          <input type="text" class="form-control" id="productname" name="productname" aria-describedby="emailHelp" value="<?= $row[0][0] ?>" disabled>
        </div>
        <div class="form-group">
          <label for="productname">Nom du produit <small>max 250 caracteres</small></label>
          <input type="text" class="form-control" id="productname" name="productname" aria-describedby="emailHelp" value="<?= $row[0][1] ?>" placeholder="Entrez le nom du produit">
        </div>
        <div class="form-group">
          <label for="productsmalldesc">Le descriptif rapide du produit</label>
          <textarea class="form-control" id="productsmalldesc" name="productsmalldesc" rows="5"><?= $row[0][2] ?></textarea>
        </div>
        <div class="form-group">
          <label for="productdescription">Descriptif poussé et détaillé du produit</label>
          <textarea class="form-control" id="productdescription" name="productdescription" rows="10"><?= $row[0][3] ?></textarea>
        </div>
        <div class="form-group">
          <label for="productfeature">Caractéristiques du produit <small>Séparez chaque caractéristiques par un -</small></label>
          <textarea class="form-control" id="productfeature" name="productfeature" rows="5">
            <?php foreach ($filtredfeature as $key => $values): ?>
              <?php echo $key . "-" ?>
            <?php endforeach; ?>
          </textarea>
          <?php foreach ($filtredfeature as $key => $values): ?>
              <?php echo $key . "-" ?>
            <?php endforeach; ?>
        </div>
        <div class="form-group">
          <label for="productconnect">Connectique du produit <small>Séparez chaque connecteur par un -</small></label>
          <textarea class="form-control" id="productconnect" name="productconnect" rows="5">
            <?php foreach ($filtredconnectors as $key => $values): ?>
              <?php echo htmlspecialchars($key) . "-" ?>
            <?php endforeach; ?>
          </textarea>
        </div>
        <div class="form-group">
          <label for="productcategory">Categorie du produit</label>
          <select class="form-control" name="productcategory" id="productcategory">
            <option value="Compresseur">Compresseur</option>
            <option value="Préamplificateur">Préamplificateur</option>
            <option value="Direct Box">Direct Box</option>
            <option value="Microphone">Microphone</option>
            <option value="Autre">Autre</option>
          </select>
        </div>



        <div class="form-group">
          <label for="exampleInputFile">Images pour le produit</label>
          <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
          <small id="fileHelp" class="form-text text-muted">ICI un drag and drop si j'y arrive</small>
        </div>

        <button type="submit" class="btn btn-primary btn-lg">Ajouter le produit</button>
      </form>

    </div>
  </div>

</div>

<?php require "../includes/footerempty.php"; ?>