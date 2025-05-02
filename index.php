<?php
include('conection.php');

if (!isset($_SESSION['name'])) {
  header('Location: Signin.php');
  exit();
} else {
  if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $rool = "In Doing";
    $id = $_SESSION['id'];
    if (!empty($name) && !empty($start) && !empty($end)) {
      $sql = $conn->prepare("INSERT INTO tasks(name,start,end,role,user_id) VALUES(?,?,?,?,?)");
      $sql->execute([$name, $start, $end, $rool, $id]);
      $addtaskmsg = "<p class='adds'> the task added </p>";
    } else {
      $addtaskmsg = "<p class='addw'> All fields must be valid </p>";
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
    referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./style/dash.css">
  <title>To-Do List Dashboard</title>
</head>

<body>
  <div class="main-container">
    <div class="container">
      <div class="saidbare">
        <ul>
          <h1 class="todo"><a href="index.php">To-Do List</a></h1>

          <li>
            <a href="./all.php"><i class="fa-solid fa-list-check"></i></a>

            <a class="text-ul" href="./all.php">All Tasks</a>
          </li>
          <li>
            <a href="./indoing.php"><i class="fa-solid fa-bars-progress"></i></a>
            <a class="text-ul" href="indoing.php">In-Progress Tasks</a>
          </li>
          <li>
            <a href="./complet.php"><i class="fa-solid fa-check"></i></a>
            <a class="text-ul" href="complet.php">Completed Tasks</a>
          </li>
          <li>
            <a href="./suspand.php"><i class="fa-solid fa-pause"></i></a>
            <a class="text-ul" href="suspand.php">Suspended Tasks</a>
          </li>
        </ul>
        <ul>
          <li class="logout"><a href="logout.php"><i><i class="fa-solid fa-right-from-bracket"></i></i></a></li>
        </ul>

      </div>
    </div>
    <div class="taskes-container">
      <div class="header">
        <ul>
          <li>
            <h1>Welcome <?php if (isset($_SESSION['name'])) {
                          echo $_SESSION['name'];
                        } ?></h1>
          </li>

        </ul>
      </div>
      <div class="form">
        <form action="" method="post">
          <h1>Add Your Task</h1>
          <?php if (isset($addtaskmsg)) {
            echo $addtaskmsg;
          } ?>
          <label for="">Enter a task
            <input
              type="text"
              placeholder="enter a task"
              autocomplete="off"
              name="name"
              required /></label>
          <label for="">time start
            <input type="datetime-local" name="start" placeholder="Start time" /></label>
          <label for="">time end <input type="datetime-local" name="end" placeholder="End time" /></label>

          <button type="submit" name="add">add task</button>
        </form>
      </div>
    </div>
  </div>

</body>

</html>