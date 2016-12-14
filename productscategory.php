<?php

  // script php pour renvoyer uniquement les produits de la categorie selectionée

  // je recupere la categorie que l'utilisateur a selectionner
  $category = $_POST["category"];

  // connexion a la bd
  require_once "includes/connectbd.php";

  // je teste category, si valleur est all je réafiche tous les produits
  if ($category == "all") {
    
    // requete pour recuperer tous les produits
    // Preparation de la requète
    if (!$req = $dbconn->prepare("
                                  SELECT products.id_product, products.name, products.header, images.title, images.src, categorys.category
                                  FROM products
                                  INNER JOIN images ON products.id_product=images.idx_product
                                  INNER JOIN categorys ON products.id_product=categorys.idx_product
                                  ")) {
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

  } else {

    // requete pour recuperer les produits de la categorie
    // Preparation de la requète
    if (!$req = $dbconn->prepare("
                                  SELECT products.id_product, products.name, products.header, images.title, images.src, categorys.category
                                  FROM products
                                  INNER JOIN images ON products.id_product=images.idx_product
                                  INNER JOIN categorys ON products.id_product=categorys.idx_product
                                  WHERE categorys.category=?
                                  ")) {
      // Gestion des erreurs
      $errors['preparation'] = "Erreur de preparation de la requete";
    }

    // Liage des parametres
    if (!$req->bind_param("s", $category)) {
      // Gestion des erreurs
      $errors['liage'] = "Erreur de liage des parametres";
    }
        
    // execution de la requete
    if (!$req->execute()) {
      // Gestion des erreurs
      $errors['execution'] = "Erreur d'execution de la requete";
    }

    // recuper le resultat et conversion en tableau
    $res = $req->get_result();
    $row = $res->fetch_all();

  } // fin du else

?>

<!-- Si errors n'est pas vide on affiche alors les erreurs -->
<?php if(!empty($errors)): ?>

<div class="col-sm-12">

  <div class="alert alert-warning" role="alert">

    <!-- petite boucle pour afficher les erreurs ajoutées au tableau erreurs par php -->
    <?php foreach ($errors as $key) : ?>

      <p><?= $key ?></p>

    <?php endforeach; ?>

            
        
  </div>

</div>
        
<?php endif; ?>




<!-- Affichage des produits -->
<?php foreach ($row as $key): ?>

  <div class="thumbnail">
    <div class="row">
      <div class="col-sm-4">
        <a href="product.php?productid=<?= $key[0] ?>">
          <img src="<?= $key[4] ?>" title="<?= $key[3] ?>" width="100%">
        </a>
      </div>
      <div class="col-sm-8">
        <a href="product.php?productid=<?= $key[0] ?>">
          <h4><?= $key[1] ?></h4>
        </a>
        <h4><small><?= $key[5] ?></small></h4>
        <p><?= $key[2] ?></p>
      </div>
    </div>
  </div>

<?php endforeach; ?>