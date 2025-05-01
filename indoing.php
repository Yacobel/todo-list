<?php




?>






<?php
include('conection.php');

if (!isset($_SESSION['name'])) {
    header('Location: Signin.php');
    exit(); 
}else{
    try {
        $role="In Doing";
        $id=$_SESSION['id'];
        $sql=$conn->prepare("SELECT * FROM tasks WHERE role = ? AND user_id=? ");
        $sql->execute([$role,$id]);
        $res=$sql->fetchAll(PDO::FETCH_ASSOC);
         
    } catch (PDOException $e) {
        echo "faild in fetsh ".$e->getMessage();
    }
    if (isset($_POST['drop'])) {
      $id=$_POST['id'];
      $sql=$conn->prepare("DELETE FROM tasks WHERE TASK_id=?");
      $sql->execute([$id]);
      header('Location: all.php');
      exit();
    }
    if (isset($_POST['update'])) {
      $id=$_POST['id'];
      $start=$_POST['start'];
      $end=$_POST['end'];
      $roole=$_POST['rool'];
      $name=$_POST['name'];
      if(!empty($name)&&!empty($start)&&!empty($end)&&!empty($roole)){
        $sql=$conn->prepare("UPDATE  tasks SET  start=? , end=? , name=? , role=? WHERE task_id=?");
        $sql->execute([$start,$end,$name,$roole,$id]);
        header('Location: indoing.php');
        exit();

      }else{
        $allmsg="<p class='allmsg'>all the champ must be valid</p>";
      }
      
      
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
            
              <h1 class="todo"><a href="index.php">todo list</a></h1>
            
            <li>
              <i><i class="fa-solid fa-list-check"></i></i
              ><a href="all.php">all taskes</a>
            </li>
            <li>
              <i><i class="fa-solid fa-bars-progress"></i></i
              ><a href="indoing.php">in doing taskes</a>
            </li>
            <li>
              <i class="fa-solid fa-check"></i><a href="complet.php">complet taskes</a>
            </li>
            <li>
              <i class="fa-solid fa-pause"></i><a href="suspand.php">suspand taskes</a>
            </li>
          </ul>
                    <ul><li class="logout"><a href="logout.php"><i><i class="fa-solid fa-right-from-bracket"></i></i></a></li></ul>

        </div>
      </div>
      <div class="taskes-container">
        <div class="header">
          <ul>
            <li><h1>welcome <?php if (isset($_SESSION)) {
              echo $_SESSION['name'];
            }?></h1></li>
            <li class="profile">
              <a href="">
                <img src="./images/Background Image.png" alt="" />
                <a href=""><?php if (isset($_SESSION)) {
                  echo $_SESSION['name'];
                    }?></a>
              </a>
            </li>
          </ul>
        </div>
        <div class="table">
          <?php 
            if (isset($allmsg)) {
              echo $allmsg;
            }
          ?>
          <div class="info-task">
            <?php
            if ($res) {
                 echo "<h1>your taskes</h1>";
                 
              foreach($res as $el){
              echo '
              <div class="form">
                    <form action="" method="post">
                    <div class="form-info">
                      <label for="">
                          <input type="text" hidden  name="id" value="'.$el['task_id'].'">
                      

                        <h3>task </h3>: <input type="text" name="name" value="'.$el['name'].'">
                      </label>
                      <label for="">
                        <h3>date-start </h3>: <input type="datetime-local" name="start" value="'.$el['start'].'">
                      </label>
                      <label for="">
                        <h3>date-end </h3>: <input type="datetime-local" name="end" value="'.$el['end'].'">
                      </label>
                      <label for="">
                        <h3>status </h3>: <select name="rool" id="">
                                      <option value="done">'.$el['role'].'</option>
                                      <option value="done">done</option>
                                      <option value="in doing">in doing</option>
                                      <option value="suspanded">suspanded</option>
                                    </select>  
                      </label>
                    </div>
                      <div class="btns">
                        <button type="submit" name="drop">drop</button>
                        <button type="submit" name="update">update</button>
                      </div>
                      
                    </form>
              </div>
              ';
            }
              
            }else{
                echo "<h1>you dont have tasks</h1>";
            }
            ?>
            
          </div>
        </div>
      </div>
    </div>
   
    <div class="add-task">
      <a href="index.php"><i class="fa-solid fa-plus"></i></a>
    </div>
    
  </body>
</html>
