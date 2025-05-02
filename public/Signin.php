<?php

include('conection.php');
if (isset($_POST['Singin'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  if (!empty($name) && !empty($email) && !empty($password)) {
    try {
      $sql = $conn->prepare("SELECT * FROM users WHERE email=? OR name=?");
      $sql->execute([$email, $name]);
      $res = $sql->fetchAll(PDO::FETCH_ASSOC);
      if ($res) {
        $signinmsg = "<p> the name or email existe </p>";
      } else {
        $sql = $conn->prepare("INSERT INTO users(name , email ,password) VALUES(?,?,?)");
        $sql->execute([$name, $email, $password]);
        $signinmsg = "<p class='suces'> sign in sussusfuly </p>";
      }
    } catch (PDOException $e) {
      echo "Signin faild " . $e->getMessage();
    }
  } else {
    $signinmsg = "<p> all the champ not valid </p> ";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../style/Singin.css" />
  <title>todo list - Signin</title>
</head>

<body>

  <div class="container">
    <div class="image">
      <img src="../images/Background Image.png" alt="" />
    </div>
    <div class="form">
      <form action="" method="post">
        <h1>Sign in</h1>
        <?php if (isset($signinmsg)) {
          echo $signinmsg;
        } ?>
        <label for="name">
          User Name : <input id="name" type="text" name="name" required />
        </label>
        <label for="email">
          User Email : <input id="email" type="text" name="email" required />
        </label>
        <label for="password">
          Password :
          <input id="password" type="password" name="password" required />
        </label>
        <button type="submit" name="Singin">Sing in</button>
        <p><a href="login.php">do you have acount ?</a></p>
      </form>
    </div>
    <div class="info">
      <h1>Sign in to your</h1>
      <span>adventure!</span>
    </div>
  </div>
</body>

</html>