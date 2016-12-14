<?php

  // *******************************************************************************
  // Page pour l'ajout de produit
  // *******************************************************************************

  //recuperation de la session
  require_once '../includes/verifiyconn.php';

  // si l'utilisateur a renseigné le premier champ on passe dans le script d'ajout
  if ($_POST['productname']) {
    
    // verification que les champs sont pleins (pas besoin de verifier le premier vu qu'on passe dans condition si il est rempli)
    // recuperation des champs htmlspecialchars comme ça c'est fait
    $productname        = htmlspecialchars($_POST['productname']);
    $productsmalldesc   = htmlspecialchars($_POST['productsmalldesc']);
    $productdescription = htmlspecialchars($_POST['productdescription']);
    $productfeature     = htmlspecialchars($_POST['productfeature']);
    $productconnect     = htmlspecialchars($_POST['productconnect']);
    $productcategory    = htmlspecialchars($_POST['productcategory']);

    // initialisation tableau pour les erreurs
    $errors = array();

    // tests sur l'image a recuperer
    if ($_FILES['productimage']['error']) {
      $errors['imageupload'] = "Un erreur lors du chargement de l'image c'est produite";
    }
    if ($_FILES['productimage']['size'] > 1048576) {
      $errors['imageupload'] = "Le fichier est trop volumineux, il depasse 1 mo";
    }
    $validformat = "jpg";
    // strtolower convertit en minuscules, substr enleve le premier caractere, strrchr renvoie l'extension et son .
    $uploadedformat = strtolower(substr(strrchr($_FILES['productimage']['name'], '.'),1));
    if ($uploadedformat != $validformat) {
      $errors['imageformat'] = "Le format de fichier n'est pas valide";
    }
    $uploadeddimensions = getimagesize($_FILES['productimage']['tmp_name']);
    if ($uploadeddimensions[0] != 1920 AND $uploadeddimensions[1] != 480) {
      $errors['imagesize'] = "L'image ne respecte pas les dimensions";
    }

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
      
      // je récupere le dernier ID inseré pour faire les insert suivant avec la clef etrangére
      $lastID = $req->insert_id;
      



      // **********************************************
      // insertion des feature avec une boucle

      // je separe la chaine pour isoler chaques chaines entre les -
      $singlefeature = explode("-", $productfeature);

      foreach ($singlefeature as $key) {

        // seconde requete insertions dans la table caractéristique
        // Preparationd de la requète
        if (!$req = $dbconn->prepare("INSERT INTO features (feature, idx_product) VALUES (?, ?)")) {
          // Gestion des erreurs
          $errors['preparation'] = "Erreur de preparation de la requete";
        }

        // Liage des parametres
        if (!$req->bind_param("si", $key, $lastID)) {
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

      // je separe la chaine pour isoler chaques chaines entre les -
      $singleconnector = explode("-", $productconnect);

      foreach ($singleconnector as $key) {

        // troisième requete insertions dans la table connecteurs
        // Preparationd de la requète
        if (!$req = $dbconn->prepare("INSERT INTO connectors (connector, idx_product) VALUES (?, ?)")) {
          // Gestion des erreurs
          $errors['preparation'] = "Erreur de preparation de la requete";
        }

        // Liage des parametres
        if (!$req->bind_param("si", $key, $lastID)) {
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
      // insertion de la categorie du produit

      // Preparationd de la requète
      if (!$req = $dbconn->prepare("INSERT INTO categorys (category, idx_product) VALUES (?, ?)")) {
        // Gestion des erreurs
        $errors['preparation'] = "Erreur de preparation de la requete";
      }

      // Liage des parametres
      if (!$req->bind_param("si", $productcategory, $lastID)) {
        // Gestion des erreurs
        $errors['liage'] = "Erreur de liage des parametres";
      }
        
      // execution de la requete
      if (!$req->execute()) {
        // Gestion des erreurs
        $errors['execution'] = "Erreur d'execution de la requete";
      }





      // message dans la session pour informer que le produit a bien été ajouté
      $_SESSION['flash'] = "Le produit a bien eté créé";

      // on redirige une fois le produit bien créé
      header('Location: admin.php');

    }

  }

  // appel du header
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
        <a class="nav-link disabled color-dark" href="#">Connecté comme <?= $userName ?></a>
        <a class="nav-link active color-dark" href="admin.php">Produits</a>
        <a class="nav-link color-dark" href="disconnect.php">Deconnexion</a>
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
      <form action="newproduct.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="productname">Nom du produit <small>max 250 caracteres</small></label>
          <input type="text" class="form-control" id="productname" name="productname" aria-describedby="emailHelp" value="<?php if(isset($errors)){echo $productname;} ?>" placeholder="Entrez le nom du produit">
        </div>
        <div class="form-group">
          <label for="productsmalldesc">Le descriptif rapide du produit</label>
          <textarea class="form-control" id="productsmalldesc" name="productsmalldesc" rows="5"><?php if(isset($errors)){echo $productsmalldesc;} ?></textarea>
        </div>
        <div class="form-group">
          <label for="productdescription">Descriptif poussé et détaillé du produit</label>
          <textarea class="form-control" id="productdescription" name="productdescription" rows="10"><?php if(isset($errors)){echo $productdescription;} ?></textarea>
        </div>
        <div class="form-group">
          <label for="productfeature">Caractéristiques du produit <small>Séparez chaque caractéristiques par un -</small></label>
          <textarea class="form-control" id="productfeature" name="productfeature" rows="5"><?php if(isset($errors)){echo $productfeature;} ?></textarea>
        </div>
        <div class="form-group">
          <label for="productconnect">Connectique du produit <small>Séparez chaque connecteur par un -</small></label>
          <textarea class="form-control" id="productconnect" name="productconnect" rows="5"><?php if(isset($errors)){echo $productconnect;} ?></textarea>
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
          <label for="productimage">Images pour le produit</label>
          <input type="file" class="form-control-file" id="productimage" name="productimage" aria-describedby="fileHelp">
          <small id="fileHelp" class="form-text text-muted">Maximum 1mo, seulement des fichiers .jpg, Taille 1920 par 480</small>
        </div>

        <button type="submit" class="btn btn-primary btn-lg">Ajouter le produit</button>
      </form>

    </div>
  </div>

</div>

<?php require "../includes/footerempty.php"; ?>