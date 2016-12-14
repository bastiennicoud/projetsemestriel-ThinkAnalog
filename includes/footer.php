<!-- FOOTER destiné aux pages du site public -->

    <footer class="dark-footer <?php if(isset($footercollant)){ echo "navbar-fixed-bottom";} ?>"> <!-- footer de la page -->
      <div class="container">
        <div class="row padding-20">

          <div class="col-sm-4">
            <p class="col-inverse text-center"><a href="admin/admin.php">Espace membres</a></p>
          </div>

          <div class="col-sm-4">
            <p class="col-inverse text-center"><a href="contact.php">Nous contacter</a></p>
          </div>

          <div class="col-sm-4">
            <p class="col-inverse text-center">Copiright Think Analog - 2016</p>
          </div>

        </div>
      </div>
    </footer>


    <script src="js/jquery.min.js"></script> <!-- chargement de jquery, nessaisaire pour le js de bootstrap -->
    <script src="bootstrap3/js/bootstrap.min.js"></script> <!-- chargement du js de bootstrap -->
    <script src="js/app.js"></script> <!-- chargement de js du site -->
  </body>
</html>