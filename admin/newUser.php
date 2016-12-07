<?php

  if ($_POST['username'] && $_POST['password']) {

    $passhash = password_hash($_POST['password'], PASSWORD_BCRYPT);

    require_once '../includes/connectbd.php';
echo "ok";
    $req = $mysqli->prepare("INSERT INTO users ('username','password') VALUES (? , ?);");
echo "ok";
    $req->bind_param("ss", $_POST['username'], $passhash);
echo "ok";
    $req->execute();

    echo "l'utilisateur est crée";

  }
?>

    <form action="newUser.php" method="post">
      <div class="form-group">
        <input type="text" class="form-control" id="username" name="username" placeholder="Nom d'utilisateur" required>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
      </div>
      <button type="submit" class="btn btn-primary a-btncenter">Créer</button>
    </form>