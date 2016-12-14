<?php

  // *******************************************************************************
  // Affichage des differents produits
  // *******************************************************************************


  // tableau pour les erreurs
  $errors     = array();

  // connexion a la bd
  require_once "includes/connectbd.php";

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

?>


<!-- appel du header avec la navigation -->
<?php require "includes/headernav.php"; ?>


<section id="products">

  <div class="container">



    <!-- Affichage des erreurs -->
    <!-- Si errors n'est pas vide on affiche alors les erreurs -->
    <?php if(!empty($errors)): ?>

      <div class="alert alert-warning" role="alert">

        <!-- petite boucle pour afficher les erreurs ajoutées au tableau erreurs par php -->
        <?php foreach ($errors as $key) : ?>

          <p><?= $key ?></p>

        <?php endforeach; ?>
      
      </div>
      
    <?php endif; ?>




    <div class="row section-first">

      <!-- *************************************** -->
      <!-- Partie pour la selection par categories -->
      <!-- *************************************** -->
      <div class="col-sm-3">

        <div class="thumbnail">
          <div class="caption">
            <h4>Filtres</h4>
            <p>Filtrez les produits affichés par catégorie</p>

            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios1" value="all" checked>
                Tous
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios1" value="Compresseur">
                Compresseurs
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios2" value="Préamplificateur">
                Preamplificateurs
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios2" value="Direct Box">
                Direct Boxes
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios2" value="Autre">
                Autre
              </label>
            </div>

          </div>
        </div>

      </div>




      <!-- *************************************** -->
      <!-- Affichage des produits                  -->
      <!-- *************************************** -->
      <div id="products-display" class="col-sm-9 section-last-big">

        <?php foreach ($row as $key): ?>

          <div class="thumbnail">
            <div class="row">

              <div class="col-sm-4 product-img-small">
                <a href="product.php?productid=<?= $key[0] ?>">
                  <img src="<?= $key[4] ?>" title="<?= $key[3] ?>">
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
        
      </div>

    </div>
  </div>
  
</section>



<!-- appel du footer -->
<?php 
$footercollant = true;
require "includes/footer.php"; ?>