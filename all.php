


<?php
include('conection.php');

if (!isset($_SESSION['name'])) {
    header('Location: Signin.php');
    exit(); 
}else{
    try {
        $id=$_SESSION['id'];
        $sql=$conn->prepare("SELECT * FROM tasks WHERE user_id=?");
        $sql->execute([$id]);
        $res=$sql->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "faild in fetsh ".$e->getMessage();
    }
            
           
        
        
    
    
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
      integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="./style/all.css" />
    <title>todo list dashbord</title>
  </head>
  <body>
    <div class="main-container">
      <div class="container">
        <div class="saidbare">
          <ul>
            <li class="todo">
              <h1>todo list</h1>
            </li>
            <li>
              <i><i class="fa-solid fa-list-check"></i></i
              ><a href="">all taskes</a>
            </li>
            <li>
              <i><i class="fa-solid fa-bars-progress"></i></i
              ><a href="">in doing taskes</a>
            </li>
            <li>
              <i class="fa-solid fa-check"></i><a href="">complet taskes</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="taskes-container">
        <div class="header">
          <ul>
            <li><h1>welcome ahmade</h1></li>
            <li class="profile">
              <a href="">
                <img src="./images/Background Image.png" alt="" />
                <a href="">name</a>
              </a>
            </li>
          </ul>
        </div>
        <div class="table">
          <h1>your taskes</h1>
          <div class="info-task"></div>
          
        </div>
      </div>
    </div>
  </body>
</html>
