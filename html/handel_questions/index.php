<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
  $i=0;
  if (!isset($_SESSION['numques']) || !isset($_SESSION['exam_id'])) {
    header("Location: ../create_quiz/create_quiz.php"); 
    exit(); 
  }
  else{
    $no_ques=$_SESSION['numques'];
    $exam_id=$_SESSION['exam_id'];
  }
  $servername = "localhost";
  $username = "root"; 
  $password = "root"; 
  $dbname = "quizzify";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
      die("Connection Failed". $conn->connect_error);
      echo conn->connect_error;
  }
  if (isset($_POST["submit"])){
   for($i=1;$i<=$no_ques;$i++){
    $question=$_POST["question-head$i"];
    if(!empty($_POST["correctAnswer$i"])){
      $question_answer=$_POST["correctAnswer$i"];
    }
    $question_id=0;
    $sql="INSERT INTO question (Body,Answer,Exam_Id) VALUES (?,?,?)";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("sss",$question,$question_answer,$exam_id);
    if($stmt->execute()){
      $sql="SELECT Id FROM question ORDER BY Id DESC LIMIT 1;";
      $stmt=$conn->prepare($sql);
      $stmt->execute();           
      $result = $stmt->get_result();
      $userData = $result->fetch_assoc();
      $question_id=$userData["Id"];
    }
      for($j=1;$j<=4;$j++){
        if(!empty($_POST["answer$i$j"])){
        $ans=$_POST["answer$i$j"];
        $sql="INSERT INTO answers (question_id,answer) VALUES (?,?)";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("ss",$question_id,$ans);
        if($stmt->execute()){
          $stmt->close();
        }
        else echo"an error occurred";
      }
      }
     
  }
  header("Location: ../Home/Home.php"); 
  exit(); 
}
  ?>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- stylesheets -->
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/main.css" />
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <!-- title -->
    <title>Quizzify</title>
  </head>

  <body>
    <div
      id="carouselExample"
      class="carousel slide container w-100 vh-100 d-flex p-3 d-flex flex-column align-items-center"
    >
      <div class="questions w-100 p-5 h-100">
        <div class="slider d-flex justify-content-center align-items-center">
          <button
            class="carousel-control-prev"
            type="button"
            name="btn-prev"
            data-bs-target="#carouselExample"
            data-bs-slide="prev"
          >
            <i class="fa-solid fa-circle-chevron-left fs-2 mx-2"></i>
          </button>
          <button 
            class="carousel-control-next"
            type="button"
            name="btn-next"
            data-bs-target="#carouselExample"
            data-bs-slide="next"
          >
            <i class="fa-solid fa-circle-chevron-right fs-2 mx-2"></i>
          </button>
        </div>
        <form class="h-100" action="" method="post">
        <div class="carousel-inner  question w-100 p-3 mt-3 h-100">
          <?php
          for($i=1;$i<=$no_ques;$i++){
            echo '<div class="carousel-item ' . ($i == 1 ? 'active' : '') . '">';
            echo'<div class="questions-num w-100 d-flex justify-content-center">';
            echo"<div class='num'>$i</div>";
            echo'</div>';
            echo'<div class="question-head">';
            echo"<textarea name='question-head$i' id='' required placeholder='Write Your Question'></textarea>'";
            echo'</div>';
            echo'<div  class="question-body h-100 w-100 mt-0 d-flex flex-column justify-content-center align-items-center">';
            echo"<div id='answersContainer$i' class='answersContainer w-100 d-flex flex-column justify-content-center align-items-center mt-1'></div>";
            echo'<div class="answer p-3 mt-0">';
            echo"<a  id='addAnswerButton$i' onclick='createAnswerDiv($i)' class='cp m-0'>";
            echo'<i class="fa-solid fa-plus fs-2"></i>';
            echo'</button>';
            echo'</div></div></div>';
          }
          ?>
        </div>
      </div>
      <div class="buttons d-flex justify-content-between w-100">
        <button name="submit" class="btn submit">Submit</button>
      </div>
      
    </div>
    </form>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="./js/main.js"></script>
  </body>
</html>
