<?php

  // *******************************************************************************
  // Page d'affichage d'un produit specifique
  // *******************************************************************************

  if (isset($_GET['productid'])) {
    
    // si il y a un id dans GET on va chercher le produit corespontant dans la bd

    // on recupere l'id qui est dans get
    $productid = $_GET['productid'];

    // connecion a la bd
    require_once 'includes/connectbd.php';

    // requete pour recuperer le produit corespondant
    // Preparation de la requète
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
    if (!$req->bind_param("i", $productid)) {
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

    // ici je passe les caractéristiques dans le nom des clef d'un tableau pour supprimer les doublons 
    foreach ($row as $key) {
      $filtredfeature[$key[7]] = 1;
    }

    // ici je passe les connecteurs dans le nom des clef d'un tableau pour supprimer les doublons 
    foreach ($row as $key) {
      $filtredconnectors[$key[8]] = 1;
    }

  } else {

    // si il ny a pas d'id dans le GET on redirige vers la page qui affiche tous les produits
    header('Location: products.php');

  }

?>

<!-- appel du header avec la navigation -->
<?php require "includes/headernav.php"; ?>


<section id="product-img">
  <div class="product-image">
    <img src="<?= $row[0][5] ?>" alt="<?= $row[0][4] ?>" class="img-responsive">
  </div>
</section>

<section id="product">

  <div class="container">

    <div class="row section-first">
      <div class="col-sm-8">
        <h1><?php echo htmlspecialchars($row[0][1]) ?></h1>
      </div>
      <div class="col-sm-4">
        <h1><small><?php echo htmlspecialchars($row[0][6]) ?></small></h1>
      </div>
    </div>

    <div class="row section-last section-first">

      <div class="col-sm-8">
        <p class="product-header"><?php echo htmlspecialchars($row[0][2]) ?></p>
        <p><?php echo htmlspecialchars($row[0][3]) ?></p>
      </div>

      <div class="col-sm-4">

        <h4>Caractéristiques</h4>
        <ul>
          <?php foreach ($filtredfeature as $key => $values): ?>
            <li><?php echo htmlspecialchars($key) ?></li>
          <?php endforeach; ?>
        </ul>

        <h4>Connectiques</h4>
        <ul>
          <?php foreach ($filtredconnectors as $key => $values): ?>
            <li><?php echo htmlspecialchars($key) ?></li>
          <?php endforeach; ?>
        </ul>

      </div>

    </div>

  </div>
  
</section>


<!-- appel du footer -->
<?php require "includes/footer.php"; ?>