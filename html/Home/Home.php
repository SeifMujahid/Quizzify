<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
    $servername = "localhost";
    $username = "root"; 
    $password = "root"; 
    $dbname = "quizzify";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection Failed". $conn->connect_error);
        echo conn->connect_error;
    }
    if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
      header("Location: ../../login-register.php"); 
      exit(); 
  }
  else{
    $username= $_SESSION['username'];
    $role= $_SESSION['role'];
  }

    $sql="SELECT FullName, Score, picture FROM student order by 2 desc,1";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $result=$stmt->get_result();
    $rows=[];
    while ($row = $result->fetch_assoc()) {
      $rows[] = $row;  
    }
    $stmt->close();

    if ($role == "Student" || $role == "Doctor") {
      if($role == "Student")$sql = "SELECT Id, FullName,Education, Score,Role, picture FROM student WHERE UserName = ?";
      else$sql = "SELECT Id, FullName,Education, No_Exams,Role, picture FROM doctor WHERE UserName = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $username); 
      $stmt->execute();
      $result = $stmt->get_result();
      $userData = $result->fetch_assoc();
      $_SESSION['id']=$userData['Id'];
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
    rel="stylesheet" />
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
    <div class="content h-100 w-100 p-3">
      <div class="info w-100 p-3 row">
        <div class="profile-img col-3">
       <?php echo " <img class='w-100' src='./imgs/".htmlspecialchars($userData['picture']??"team-01.png")."' alt='' />";?>
        </div>
        <div class="info-details col-9">
          <h1 class="fs-4 fw-light"><?php echo htmlspecialchars($userData["FullName"]??"Your Name");?></h1>
          <div class="outer-prog">
            <div class="inner-prog" style="width: 60%"></div>
          </div>
          <div class="details d-flex justify-content-between mt-2 fw-bold">
            <div class="left-box ">
              <p class="m-0"><?php echo htmlspecialchars($userData["Role"]??"Role");?></p>
              <p class="m-0"><?php echo htmlspecialchars($userData["Education"]??"Education");?></p>
            </div>
            <div class="right-box text-center">
              <?php
              if($role=="Student"){
                echo"<p class='m-0'>Score</p>";
                echo"<p class='m-0'>".htmlspecialchars($userData["Score"]??"0")."</p>";
              }
              else{
                echo"<p class='m-0'>No.Exams</p>";
                echo"<p class='m-0'>".htmlspecialchars($userData["No_Exams"]??"0")."</p>";
              }
              ?>
            </div>
          </div>
        </div>
      </div>
        <?php
        if($role == "Student"){
         echo'<div class="special w-100 p-3">';
         echo' <h2 class="fs-5 mb-3">Quiz Of The Week</h2>';
         echo' <div class="special-content row mx-2">';
         echo' <div class="special-img col-3">';
         echo'   <img class="w-100" src="./imgs/course-04.jpg" alt="" />';
         echo" </div>";
         echo'  <div class="special-details col-9">';
         echo'   <h3 class="fs-6 mb-3">Small Physics Test</h3>';
         echo'   <p class="m-0">Mark:20</p>';
         echo'  <p class="m-0">Dr:Ahmed</p>';
         echo'   <p class="gold">Best Of The Week</p>';
         echo' </div>';
        }
        else{
         echo'<div class="create w-100 p-3">';
         echo' <h2 class="fs-5 mb-3">Create Quiz</h2>';
         echo'<div class="add w-100">';
         echo'   <a class="w-100 h-100 d-flex justify-content-center align-items-center" href="../create_quiz/create_quiz.php"><i class="fa-solid fa-plus fs-2 fw-bold text-warning"></i></a>';
        }
        ?>
        </div>
      </div>
      <div class="sibjects w-100 p-3">
          <h2 class="fs-5 mb-3">Subjects</h2>
          <div class="subjects-content row g-3">
            <div class="sub-box col-3">
              <a href="#">
                <img class="w-100" src="./imgs/course-01.jpg" alt="" />
                <p>Math</p>
              </a>
            </div>
            <div class="sub-box col-3">
              <a href="#">
                <img class="w-100" src="./imgs/course-02.jpg" alt="" />
                <p>Arabic</p>
              </a>
            </div>
            <div class="sub-box col-3">
              <a href="#">
                <img class="w-100" src="./imgs/course-03.jpg" alt="" />
                <p>English</p>
              </a>
            </div>
            <div class="sub-box col-3">
              <a href="#">
                <img class="w-100" src="./imgs/course-04.jpg" alt="" />
                <p>French</p></a
              >
            </div>
            <div class="sub-box col-3">
              <a href="#">
                <img class="w-100" src="./imgs/course-05.jpg" alt="" />
                <p>Physics</p>
              </a>
            </div>
            <div class="sub-box col-3">
              <a href="#">
                <img class="w-100" src="./imgs/course-02.jpg" alt="" />
                <p>Programming</p>
              </a>
            </div>
            <div class="sub-box col-3">
              <a href="#">
                <img class="w-100" src="./imgs/course-05.jpg" alt="" />
                <p>Algorithems</p>
              </a>
            </div>
            <div class="sub-box col-3">
              <a href="#">
                <img class="w-100" src="./imgs/course-03.jpg" alt="" />
                <p>Art</p>
              </a>
            </div>
          </div>
        </div>
    </div>
    <div class="right-nav p-3 position-fixed end-0 top-0">
      <div class="top-part">
        <div class="box-2">
          <i class="fa-solid fa-star fs-4"></i>
          <div class="box-img"> 
            <?php  echo " <img class='w-100' src='./imgs/".htmlspecialchars($rows[1]["picture"]??"team-01.png")."' alt='' />";?>
          </div>
          <p><?php echo htmlspecialchars($rows[1]["FullName"]??"");?></p>
        </div>
        <div class="box-1">
          <i class="fa-solid fa-crown fs-1"></i>
          <div class="box-img">
          <?php  echo " <img class='w-100' src='./imgs/".htmlspecialchars($rows[0]["picture"]??"team-01.png")."' alt='' />";?>
          </div>
          <p><?php echo htmlspecialchars($rows[0]["FullName"]??"Frist");?></p>
        </div>
        <div class="box-3">
          <i class="fa-solid fa-ranking-star fs-3"></i>
          <div class="box-img">
           <?php  echo " <img class='w-100' src='./imgs/".htmlspecialchars($rows[2]["picture"]??"team-01.png")."' alt='' />";?>
          </div>
          <p><?php echo htmlspecialchars($rows[2]["FullName"]??"Third");?></p>
        </div>
      </div>
      <div class="rank-table">
        <p class="title">Score.</p>
        <div class="rank">
          <?php
          foreach ($rows as $row){
            $fullName = $row['FullName'];
            $score = $row['Score'];
            $picture = $row['picture'];
            echo "<div class='rank-box'>";
            echo"<div class='rank-img'>";
            echo " <img class='w-100' src='./imgs/".htmlspecialchars($picture)."' alt='' />";
            echo"</div>";
            echo"<div class='info'>";
             echo "<p>". htmlspecialchars($fullName)."</p>";
             echo"<p class='me-4 fs-5 fw-bold'>".htmlspecialchars($score)."</p>";
            echo"</div>";
          echo"</div>";
            ;
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body text-light text-center m-5 fs-5">
          Are You Sure you want to logout?
        </div>
        <div class="modal-footer border-0 d-flex justify-content-evenly m-2">
          <button type="button" class="btn btn-danger p-2 px-4"><a href="../../login-register.php">Logout</a></button>
          <button type="button" class="btn btn-secondary p-2 px-4" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>