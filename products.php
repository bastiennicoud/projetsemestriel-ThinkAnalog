<!-- Bastien Nicoud - Think Analog -->
<!-- Projet semestriel - novembre 2016 -->

<!-- Partie php pour récuperer les produits -->
<?php

  // connexion a la bd
  require_once "includes/connectbd.php";

  // requete pour recuperer tous les produits
  // Preparation de la requète
  if (!$req = $dbconn->prepare("
                                SELECT products.name, products.header, images.title, images.src, categorys.category
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
                <input type="radio" name="optionsRadios" id="optionsRadios1" value="comp">
                Compresseurs
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios2" value="preamp">
                Preamplificateur
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios2" value="di">
                Direct Box
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios2" value="mic">
                Microphone
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios2" value="other">
                Autre
              </label>
            </div>

          </div>
        </div>

      </div>




      <!-- *************************************** -->
      <!-- Affichage des produits                  -->
      <!-- *************************************** -->
      <div id="products-display" class="col-sm-9 section-last">

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
        
      </div>

    </div>
  </div>
  
</section>



<!-- appel du footer -->
<?php require "includes/footer.php"; ?>