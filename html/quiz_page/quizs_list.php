<!DOCTYPE html>
<html lang="en">
  <?php
  session_start();
  $IsAllowed = 1;
  $servername = "localhost";
  $username = "root"; 
  $password = "root"; 
  $dbname = "quizzify";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
      die("Connection Failed". $conn->connect_error);
      echo conn->connect_error;
  }
  if (!isset($_SESSION['id']) || !isset($_SESSION['role'])) {
    header("Location: ../../login-register.php"); 
    exit(); 
}
else{
  $main_id= $_SESSION['id'];
  $role= $_SESSION['role'];
}
$search='';
if(isset($_POST['search_button']))$search=$_POST['search_input'];
  $sql="SELECT d.Id,e.Id,d.FullName,e.name,e.Grade,e.Subject from exam e join doctor d on e.Doctor_Id=d.Id where e.name LIKE '%$search%' or d.Fullname LIKE'%$search%'  order by 1 desc ,2 desc;";
  $stmt=$conn->prepare($sql);
    $stmt->execute();
    $result=$stmt->get_result();
    $rows=[];
    while ($row = $result->fetch_assoc()) {
      $rows[] = $row;  
    }
    $stmt->close();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      foreach ($rows as $i => $row) {
          if (isset($_POST["submit$i"])) {
              $ExamId = $_POST["id$i"];
              $sql = "SELECT count(*) as 'count' FROM student_exam WHERE Exam_Id = $ExamId AND Student_Id = $main_id;";
              $stmt = $conn->prepare($sql);
              $stmt->execute();
              $result = $stmt->get_result();
              $userData = $result->fetch_assoc();
              if ($userData['count'] > 0) {
                $IsAllowed=0; 
              } else {
                  // Enroll the student and redirect
                  $_SESSION['exam_id'] = $ExamId;
                  header("Location: ../exam/exam.php");
                  exit();
              }
          }
      }
    }
  ?>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- stylesheets -->
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/list.css" />
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
    <div class="container-fluid w-100 vh-100 d-flex p-3">
      <div
        class="left-nav h-100 d-flex flex-column p-3 position-fixed start-0 top-0"
      >
        <h1>Quizzify</h1>
    <ul class="d-flex flex-column mt-4 fs-4 fw-light">
      <li class="w-100 mb-4">
        <a href="../Home/Home.php"><i class="fa-solid fa-house me-4"></i><span>Home</span></a>
      </li>
      <li class="w-100 mb-4">
        <a href="../UserProfile/UserProfile.php"><i class="fa-solid fa-user me-4"></i><span>User Profile</span></a>
      </li>
      <li class="w-100 mb-4">
            <a href="../quiz_page/quizs_list.php"><i class="fa-solid fa-user-graduate me-4"></i><span>Quizes</span></a>
      </li>
      <li class="w-100 mb-4">
        <a href="../AboutUs/AboutUs.html"><i class="fa-solid fa-circle-info me-4"></i><span>About US</span></a>
      </li>
      <li class="w-100 mb-4">
        <a href="../ContactUs/ContactUs.html"><i class="fa-solid fa-phone me-4"></i><span>Contact US</span></a>
      </li>
      <li class="w-100 mb-4">
        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"
          ><i class="fa-solid fa-right-from-bracket me-4"></i><span>Log Out</span></a
        >
      </li>
    </ul>
      </div>
      <div class="quizs h-100 w-100 p-3">
        <form action="" method="post">
        <div class="search-container mb-5">
          <input type="text" name="search_input" class="search-bar" placeholder="Search here..." />
          <button type="submit" name="search_button" class="search-button btn rounded-pill">Search</button>
        </div>
        </form>
        <div class="list w-100 d-flex flex-column gap-2 p-3">
          <?php
          if($IsAllowed==0){
            echo '<div class="w-100 text-center">';
                  echo '<p class="p-3 alert alert-danger">You Already Enrolled In This Exam!</p>';
                  echo '</div>';
          }
          ?>
          <?php
            $i=1;
            foreach ($rows as $row){

            $fullName = $row['FullName'];
            $examName = $row['name'];
            $grade= $row['Grade'];
            $subject= $row['Subject'];
            $id= $row['Id'];
            $pic='';

            switch($subject){
              case"math":$pic='course-01.jpg';break;
              case"arabic":$pic='course-02.jpg';break;
              case"physics":$pic='course-03.jpg';break;
              case"french":$pic='course-04.jpg';break;
              case"english":$pic='course-05.jpg';break;
              case"programming":$pic='course-06.png';break;
              case"electronics":$pic='course-07.png';break;
              case"chemistry":$pic='course-08.png';break;
              default:$pic='course-04.jpg';break;
            }

            echo'<div class="quiz d-flex align-items-center justify-content-between">';
            echo'<div class="left-info d-flex align-items-center">';
            echo'<div class="sub-img me-3">';
            echo"<img class='w-100' src='./imgs/".htmlspecialchars($pic)."' alt='' /></div>";
            echo'<div class="info">';
            echo'<h3 class="fs-4">Dr : '.htmlspecialchars($fullName).'</h3>';
            echo'<p class="fs-5">Title : '.htmlspecialchars($examName).'</p>';
            echo'</div></div>';
            echo'<div class="vists text-center">';
            echo'<p class="fs-4 p-0 m-0">Grades</p>';
            echo'<p class="fs-5 p-0 m-0">'.htmlspecialchars($grade).'</p>';
            echo '</div>';
            echo '  <form action="" method="POST">';
            echo "    <input type='hidden' readonly  name='id$i' value='" . htmlspecialchars($id) . "'>";
            echo "    <button name='submit$i' type='submit' class='btn p-2 rounded-pill'data-bs-toggle='modal' data-bs-target='#exampleModal-2' >Enroll Now</button>";
            echo '  </form>';
            echo '</div>';
          }
            ?>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body text-light text-center m-5 fs-5">
            Are You Sure you want to logout?
          </div>
          <div class="modal-footer border-0 d-flex justify-content-evenly m-2">
            <button type="button" class="btn btn-danger p-2 px-4">
              <a href="../../login-register.php">Logout</a>
            </button>
            <button
              type="button"
              class="btn btn-secondary p-2 px-4"
              data-bs-dismiss="modal"
            >
              Cancel
            </button>
          </div>
        </div>
      </div>
    </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
