<?php

  if ($_POST['username'] && $_POST['password']) {
    
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $persistant = $_POST['persistant'];

    require_once '../includes/connectbd.php';

    $req = $mysqli->prepare("SELECT username, password FROM users WHERE username=?");
    $req->bind_param('s', $username);
    $req->execute();

    if ($req->num_rows == 0) {
        $errors = "Cet utilisateur n'existe pas"
    } else {
        
    }

  }

    require "../includes/header.php";

?>

<div class="container-fluid a-containerbackground">

  <div class="a-loginbox col-md-4 offset-md-4">

    <img src="../img/logo.svg" alt="Logo Think Analog" class="col-xs-10 offset-xs-1 a-logomgbottom">
    <h4 class="text-xs-center">Connectez-vous</h3>
    <div class="alert alert-danger" role="alert"><?= $errors ?></div>

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