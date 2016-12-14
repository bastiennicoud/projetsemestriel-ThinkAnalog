<!-- Bastien Nicoud - Think Analog -->
<!-- Projet semestriel - novembre 2016 -->

<!-- appel du header avec la navigation -->
<?php require "includes/headernav.php"; ?>


<section id="products">

  <div class="container">
    <div class="row">

      <!-- *************************************** -->
      <!-- Partie pour la selection par categories -->
      <!-- *************************************** -->
      <div class="col-sm-4">

        <div class="thumbnail">
          <div class="caption">
            <h3>Filtres</h3>
            <p>Filtrez les produits affichés par catégorie</p>
            
            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                Compresseurs
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                Preamplificateur
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                Direct Box
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                Microphone
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                Autre
              </label>
            </div>

          </div>
        </div>

      </div>




      <!-- *************************************** -->
      <!-- Affichage des produits                  -->
      <!-- *************************************** -->
      <div class="col-sm-8">
        
      </div>

    </div>
  </div>
  
</section>



<!-- appel du footer -->
<?php require "includes/footer.php"; ?>