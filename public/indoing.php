<?php
include('conection.php');

if (!isset($_SESSION['name'])) {
  header('Location: Signin.php');
  exit();
} else {
  try {
    $role = "In Doing";
    $id = $_SESSION['id'];
    $sql = $conn->prepare("SELECT * FROM tasks WHERE role = ? AND user_id=? ");
    $sql->execute([$role, $id]);
    $res = $sql->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo "faild in fetsh " . $e->getMessage();
  }
  if (isset($_POST['drop'])) {
    $id = $_POST['id'];
    $sql = $conn->prepare("DELETE FROM tasks WHERE TASK_id=?");
    $sql->execute([$id]);
    header('Location: all.php');
    exit();
  }
  if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $roole = $_POST['rool'];
    $name = $_POST['name'];
    if (!empty($name) && !empty($start) && !empty($end) && !empty($roole)) {
      $sql = $conn->prepare("UPDATE  tasks SET  start=? , end=? , name=? , role=? WHERE task_id=?");
      $sql->execute([$start, $end, $name, $roole, $id]);
      header('Location: indoing.php');
      exit();
    } else {
      $allmsg = "<p class='allmsg'>All fields must be filled</p>";
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
  <link rel="stylesheet" href="../style/all.css">
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
            <a class="text-ul" href="indoing.php">In Progress</a>
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
            <h1>Welcome <?php if (isset($_SESSION)) {
                          echo $_SESSION['name'];
                        } ?></h1>
          </li>
          <li class="profile">
            <a href="">
              <img src="../images/Background Image.png" alt="" />
              <a href=""><?php if (isset($_SESSION)) {
                            echo $_SESSION['name'];
                          } ?></a>
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
            echo "<h1>Your Tasks</h1>";

            foreach ($res as $el) {
              echo '
              <div class="form">
                    <form action="" method="post">
                    <div class="form-info">
                      <label for="">
                          <input type="text" hidden  name="id" value="' . $el['task_id'] . '">
                      

                        <h3>Task </h3> <input type="text" name="name" value="' . $el['name'] . '">
                      </label>
                      <label for="">
                        <h3>Date Start </h3> <input type="datetime-local" name="start" value="' . $el['start'] . '">
                      </label>
                      <label for="">
                        <h3>Date End </h3> <input type="datetime-local" name="end" value="' . $el['end'] . '">
                      </label>
                      <label for="">
                        <h3>Status </h3> <select name="rool" id="">
                          <option value="done">' . htmlspecialchars($el['role']) . '</option>
                          <option value="done">Done</option>
                          <option value="in doing">In Progress</option>
                          <option value="suspanded">Suspended</option>
                          </select>  
                      </label>
                    </div>
                      <div class="btns">
                        <button type="submit" name="drop">Drop</button>
                        <button type="submit" name="update">Update</button>
                      </div>
                      
                    </form>
              </div>
              ';
            }
          } else {
            echo "<h1>You don't have any tasks</h1>";
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