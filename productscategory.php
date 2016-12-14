<?php

  // script php pour renvoyer uniquement les produits de la categorie selectionée

  // je recupere la categorie que l'utilisateur a selectionner
  $category = $_POST["category"];

  // connexion a la bd
  require_once "includes/connectbd.php";

  // requete pour recuperer tous les produits
  // Preparation de la requète
  if (!$req = $dbconn->prepare("
                                SELECT products.name, products.header, images.title, images.src, categorys.category
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

?>

<?php foreach ($row as $key): ?>

  <div class="thumbnail">
    <div class="row">
      <div class="col-sm-4">
        <img src="<?= $key[3] ?>" title="<?= $key[2] ?>" width="100%">
      </div>
      <div class="col-sm-8">
        <h4><?= $key[0] ?></h4>
        <h4><small><?= $key[4] ?></small></h4>
        <p><?= $key[1] ?></p>
      </div>
    </div>
  </div>

<?php endforeach; ?>