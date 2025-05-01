<?php
include('conection.php');
if (isset($_POST['login'])) {
    $email=$_POST['email'];
    $password=$_POST['password'];
    if (!empty($email)&& !empty($password)) {
        try {
            $sql=$conn->prepare("SELECT * FROM users WHERE email=? or name=?");
            $sql->execute([$email,$email]);
            $res=$sql->fetch(PDO::FETCH_ASSOC);
            if ($res) {
                if (password_verify($password,$res['password'])) {
                    $_SESSION['id']=$res['user_id'];
                    $_SESSION['name']=$res['name'];
                    header('Location: index.php');
                    exit();
                }else{
                    $loginmsg="<p> the password wrong </p>";
                }
            }else{
                $loginmsg="<p> the email or name wrong </p>";
            }
        } catch (PDOException $e) {
            echo "log in falid ".$e->getMessage();
        }
        
    }else{
        $loginmsg="<p> email or password wrong </p>";
    }
}





?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./style/Singin.css" />
    <title>todo list - log in</title>
  </head>
  <body>
    <div class="container">
      <div class="image">
        <img src="./images/Background Image.png" alt="" />
      </div>
      <div class="form">
        <form action="" method="post">
          <h1>log in</h1>
          <?php if (isset($loginmsg)){
          echo $loginmsg;
        }?>
          <label for="email">
            User Name or Email :
            <input id="email" type="text" name="email" required />
          </label>
          <label for="password">
            Password :
            <input id="password" type="password" name="password" required />
          </label>
          <button type="submit" name="login">log in</button>
          <p><a href="Signin.php">do you not have acount ?</a></p>
        </form>
      </div>
      <div class="info">
        <h1>log in to your</h1>
        <span>adventure!</span>
      </div>
    </div>
  </body>
</html>
