<?php

  // si les champs username et password on étés remplis on passe dans le if
  if ($_POST['username'] && $_POST['password']) {

    session_start();
    
    // on recupere les differentes informations dans 
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $persistant = $_POST['persistant'];
    $errors     = array();

    require_once '../includes/connectbd.php';

    $req = $mysqli->prepare("SELECT * FROM users WHERE username = 'Admin' ");
    //$req->bind_param("s", $username);
    $req->execute();
    $user = $req->fetch();
var_dump($user);

    if ($req->num_rows == 0) {

      $errors['username'] = "Cet utilisateur n'existe pas";

    } else {

      if (password_verify($password, $user->password)) {
        
        $_SESSION['userid'] = $user->id_user;
        $_SESSION['username'] = $user->username;

        if ($persistant == "yes") {
          
          $cookie = $pass->id_user . "--" . sha1($pass->username . 'afgyh');
          setcookie('ThinkAnalog', $cookie, time() + 60*60*48);
        }

      } else {

        $errors['password'] = "Le mot de passe est erroné";

      }

    }

  }

    require "../includes/header.php";

?>

<div class="container-fluid a-containerbackground">

  <a href="../index.php" class="a-asize text-xs-right">Acceuil Think Analog</a>

  <div class="a-loginbox col-md-4 offset-md-4">

    <img src="../img/logo.svg" alt="Logo Think Analog" class="col-xs-10 offset-xs-1 a-logomgbottom">
    <h4 class="text-xs-center">Connectez-vous</h3>

    <!-- Si errors n'est pas vide on affiche alors les erreurs -->
    <?php if(!empty($errors)): ?>
    <div class="alert alert-danger" role="alert">

      <!-- petite boucle pour afficher les erreurs ajoutées au tableau erreurs par php -->
      <?php foreach ($errors as $key) : ?>

        <p><?= $key ?></p>

      <?php endforeach; ?>
      
    </div>
  <?php endif; ?>

    <form action="login.php" method="post">
      <div class="form-group">
        <input type="text" class="form-control" id="username" name="username" placeholder="Nom d'utilisateur" required>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="persistant" value="yes">
          Rester connecté
        </label>
      </div>
      <button type="submit" class="btn btn-primary a-btncenter">Se connecter</button>
    </form>

  </div>
  
</div>

<?php require "../includes/footerempty.php"; ?>