<!DOCTYPE html>
<html lang="en">
  <?php
   session_start();
   if (!isset($_SESSION['grade']) || !isset($_SESSION['exam_grade'])) {
    header("Location: ../quiz_page/quizs_list.php"); 
    exit(); 
    }
    else{
    $grade= $_SESSION['grade'];
    $exam_grade= $_SESSION['exam_grade'];
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
      class="result w-100 vh-100 d-flex align-items-center justify-content-center"
    >
      <div
        class="content w-75 h-75 d-flex flex-column align-items-center shadow-lg p-5"
      >
        <div class="massege text-center mb-3">
          <?php
          if($grade>=$exam_grade/2)echo'<h1 class="pass">Congratulations</h1>';
          else echo'<h1 class="faild">Hrad Luck</h1>';
          ?>
        </div>
        <div class="icons">
        <?php
          if($grade>=$exam_grade/2)echo'<i class="fa-solid fa-rocket pass"></i>';
          else echo'<i class="fa-solid fa-face-frown faild"></i>';
          ?>
        </div>
        <h3 class="degree fs-1">
          <span class="yours"><?php echo $grade;?></span> / <span class="from"><?php echo $exam_grade;?></span>
        </h3>
        <a href="../Home/Home.php" class="btn rounded-pill back fs-3 mt-5">Home</a>
      </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
