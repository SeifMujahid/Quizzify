<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
      session_start();
      $servername = "localhost";
      $username = "root"; 
      $password = "root"; 
      $dbname = "quizzify";
      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
          die("Connection Failed". $conn->connect_error);
      }
      if (!isset($_SESSION['id']) || !isset($_SESSION['role'])||!isset ($_SESSION['exam_id'])) {
        header("Location: ../quiz_page/quizs_list.php"); 
        exit(); 
    }
    else{
      $id= $_SESSION['id'];
      $role= $_SESSION['role'];
      $examId= $_SESSION['exam_id'];
    }
    $rows=[];
    $sql="SELECT q.Body, GROUP_CONCAT(a.answer ORDER BY a.Id SEPARATOR ',') AS answers FROM question q JOIN answers a ON q.Id = a.question_id JOIN exam e ON q.Exam_Id = e.Id WHERE e.Id = ? GROUP BY q.Body;";
    $stmt=$conn->prepare($sql);
    if($stmt->execute([$examId])){
    $result=$stmt->get_result();
    while ($row = $result->fetch_assoc()) {
      $rows[] = $row;  
    }
    $exam_Grade=count($rows);
    $stmt->close();
    }
    else{
      echo"an error occourd";
    }

    if(isset($_POST['submit'])){
      $ansRows=[];
      $grade=0;
      $sql="SELECT q.Answer FROM question q JOIN exam e ON q.Exam_Id = e.Id WHERE e.Id = ?;";
      $stmt=$conn->prepare($sql);
      if($stmt->execute([$examId])){
        $result=$stmt->get_result();
        while ($row = $result->fetch_assoc()) {
          $ansRows[] = $row;  
        }
        $stmt->close();
        $i=1;
        foreach($ansRows as $row){
          if($row['Answer']==$_POST["answer$i"])$grade++;
          $i++;
        }
        echo $grade;
        if($role=="Student"){
          $sql="UPDATE student set Score=Score+$grade where Id=$id";
          $stmt=$conn->prepare($sql);
          $stmt->execute();
          $stmt->close();
          $sql="INSERT INTO student_exam VALUES($id,$examId,$grade)";
          $stmt=$conn->prepare($sql);
          $stmt->execute();
          $stmt->close();
        }
        $_SESSION['grade']=$grade;
        $_SESSION['exam_grade']=$exam_Grade;
        header("Location: ../degree_page/index.php");
        exit();
      }
      else{
        echo"an error occourd";
      }
      }

    ?>
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
            data-bs-target="#carouselExample"
            data-bs-slide="prev"
          >
            <i class="fa-solid fa-circle-chevron-left fs-2 mx-2"></i>
          </button>
          <button
            class="carousel-control-next "
            type="button"
            data-bs-target="#carouselExample"
            data-bs-slide="next"
          >
            <i class="fa-solid fa-circle-chevron-right fs-2 mx-2"></i>
          </button>
        </div>
        <form class="h-100" action="" method="post">
        <div class="carousel-inner question  w-100 p-3 mt-3  ">
          <?php
            $i=1;
            foreach ($rows as $row){
              $answers = explode(',', $row["answers"]);
              $Body=$row["Body"];
              echo '<div class="carousel-item ' . ($i == 1 ? 'active' : '') . '">';
              echo'<div class="questions-num w-100 d-flex justify-content-center ">';
              echo"<div class='num'>$i</div>";
              echo'</div>';
              echo'<div class="question-head">';
              echo'<textarea name="question-head" id="" placeholder="'.htmlspecialchars($Body).'" readonly></textarea>';
              echo'</div>';
              echo'<div class="question-body h-100 w-100 mt-0 d-flex flex-column justify-content-center align-items-center">';
              echo'<div class="answers h-100 text-center d-flex flex-column gap-4 p-3 ms-5 mt-5">';
              $j=1;
              foreach($answers as $ans){
               echo" <input type='radio' name='answer$i' id='answer-$i$j' value='$j' />";
               echo"<label for='answer-$i$j' class='fs-3'><span>".htmlspecialchars(chr(ord('A') + $j-1)).": </span>$ans</label>";
               $j++;
              }
              echo'</div></div></div>';
              $i++;
            }
          ?>
        </div>
        
      </div>
      <div class="buttons d-flex justify-content-center w-100">
        <button name="submit" class="btn submit">Submit</button>
      </div>
        </form>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="./js/main.js"></script>
  </body>
</html>
