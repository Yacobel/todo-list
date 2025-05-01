<?php
include('conection.php');

if (!isset($_SESSION['name'])) {
    header('Location: Signin.php');
    exit(); 
}else{
    if (isset($_POST['add'])) {
        $name=$_POST['name'];
        $start=$_POST['start'];
        $end=$_POST['end'];
        $rool="In Doing";
        $id=$_SESSION['id'];
        if (!empty($name)&&!empty($start)&&!empty($end)) {
            $sql=$conn->prepare("INSERT INTO tasks(name,start,end,role,user_id) VALUES(?,?,?,?,?)");
            $sql->execute([$name,$start,$end,$rool,$id]);
            $addtaskmsg="<p class='adds'> the task added </p>";
        }else{
            $addtaskmsg="<p class='addw'> the chamo most be valide </p>";
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
    <link rel="stylesheet" href="./style/dash.css" />
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
            <li><h1>welcome <?php if (isset($_SESSION['name'])) {echo $_SESSION['name'];}?></h1></li>
            <li class="profile">
              <a href="">
                <img src="./images/Background Image.png" alt="" />
                <a href=""><?php if (isset($_SESSION['name'])) {echo $_SESSION['name'];}?></a>
              </a>
            </li>
          </ul>
        </div>
        <div class="form">
          <form action="" method="post">
            <h1>add your task</h1>
            <?php if (isset($addtaskmsg)) {
                echo $addtaskmsg;
              }?>
            <label for=""
              >enter a task :
              <input
                type="text"
                placeholder="enter a task"
                autocomplete="none"
                name="name"
                required
            /></label>
            <label for=""
              >time start :
              <input type="datetime-local" name="start" placeholder="time start"
            /></label>
            <label for=""
              >time end : <input type="datetime-local" name="end" placeholder="time end"
            /></label>

            <button type="submit" name="add">add task</button>
          </form>
        </div>
      </div>
    </div>
    
  </body>
</html>
