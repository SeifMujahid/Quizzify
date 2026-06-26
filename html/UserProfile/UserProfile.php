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
    }
    if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
      header("Location: ../../login-register.php"); 
      exit(); 
  }
  else{
    $username= $_SESSION['username'];
    $role= $_SESSION['role'];
  }

    $sql="SELECT UserName, FullName, Score, picture FROM student order by 3 desc,2";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $result=$stmt->get_result();
    $rows=[];
    while ($row = $result->fetch_assoc()) {
      $rows[] = $row;  
    }
    $stmt->close();

    if ($role == "Student" || $role == "Doctor") {
      if($role == "Student")$sql = "SELECT FullName,Education, Score,Role, picture FROM student WHERE UserName = ?";
      else$sql = "SELECT FullName,Education, No_Exams,Role, picture FROM doctor WHERE UserName = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $username); 
      $stmt->execute();
      $result = $stmt->get_result();
      $userData = $result->fetch_assoc();
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
    <div class="container-fluid w-100 vh-100 d-flex p-3">
      <div class="left-nav h-100 d-flex flex-column p-3 position-fixed start-0 top-0">
        <h1>Quizzify</h1>
        <ul class="d-flex flex-column mt-4 fs-4 fw-light">
          <li class="w-100 mb-4">
            <a href="../Home/Home.php"
              ><i class="fa-solid fa-house me-4"></i><span>Home</span></a
            >
          </li>
          <li class="w-100 mb-4">
            <a href="../UserProfile/UserProfile.php"
              ><i class="fa-solid fa-user me-4"></i>
              <span>User Profile</span></a
            >
          </li>
          <li class="w-100 mb-4">
            <a href="../quiz_page/quizs_list.php"><i class="fa-solid fa-user-graduate me-4"></i><span>Quizes</span></a>
          </li>
          <li class="w-100 mb-4">
            <a href="../AboutUs/AboutUs.html"
              ><i class="fa-solid fa-circle-info me-4"></i>
              <span>About US</span></a
            >
          </li>
          <li class="w-100 mb-4">
            <a href="../ContactUs/ContactUs.html"
              ><i class="fa-solid fa-phone me-4"></i> <span>Contact US</span></a
            >
          </li>
          <li class="w-100 mb-4">
            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"
              ><i class="fa-solid fa-right-from-bracket me-4"></i>
              <span>Log Out</span></a
            >
          </li>
        </ul>
      </div>
      <!-- start home  -->
      <section id="home">
        <div class="profile">
          <div class="image">
          <?php echo " <img class='w-100' src='./imgs/".htmlspecialchars($userData['picture']??"team-01.png")."' alt='' />";?>
          </div>
          <div class="info">
            <h3><?php echo htmlspecialchars($userData["FullName"]??"Your Name");?></h3>
            <div class="outer-bar">
              <div class="inner-bar" style="width: 40%"></div>
            </div>
            <div class="details">
              <div>
              <p class="m-0"><?php echo htmlspecialchars($userData["Role"]??"Role");?></p>
              <p class="m-0"><?php echo htmlspecialchars($userData["Education"]??"Education");?></p>
              </div>
              <div>
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
        <!-- ------------------- -->
        <div class="content">
          <div class="left-part">
            <div class="top">
              <h3>Rewards</h3>
              <div class="rewards">
                <div class="second">
                  <i class="fa-solid fa-medal"></i>
                  <span>24</span>
                </div>
                <div class="first">
                  <i class="fa-solid fa-trophy"></i>
                  <span>18</span>
                </div>
                <div class="third">
                  <i class="fa-solid fa-ranking-star"></i>
                  <span>33</span>
                </div>
              </div>
            </div>
            <div class="bottom">
              <h3>Progress</h3>
              <div class="left-percent">
                <span>100%</span>
                <span>80%</span>
                <span>60%</span>
                <span>40%</span>
                <span>20%</span>
              </div>
              <div class="chart">
                <div class="col" style="height: 70%"></div>
                <div class="col" style="height: 45%"></div>
                <div class="col" style="height: 30%"></div>
                <div class="col" style="height: 70%"></div>
                <div class="col" style="height: 20%"></div>
                <div class="col" style="height: 80%"></div>
                <div class="col" style="height: 75%"></div>
                <div class="col" style="height: 60%"></div>
              </div>
              <div class="bottom-percent">
                <span>1</span>
                <span>2</span>
                <span>3</span>
                <span>4</span>
                <span>5</span>
                <span>6</span>
                <span>7</span>
                <span>8</span>
              </div>
            </div>
          </div>
          <div class="right-part">
            <h3>Your Rank</h3>
            <div class="board">
              <p>Score</p>
              <?php
              $i=1;
                foreach ($rows as $row){
                  $fullName = $row['FullName'];
                  $score = $row['Score'];
                  $picture = $row['picture'];
                  $class='';
                  if ($row['UserName'] == $username) {
                    $class = "yourdiv";  // Add 'yourdiv' class if they match
                  }
                  echo "<div class='box ".$class."'>";
                  echo  "<span class='order'>$i</span>";
                  echo  "<div class='con'>";
                  echo   "<div class='image'>";
                  echo    "<img src='imgs/".htmlspecialchars($picture)."' alt='' />";
                  echo   "</div>";
                  echo  "<p>".htmlspecialchars($fullName)."</p>";
                  echo  "<span>".htmlspecialchars($score)."</span>";
                  echo  "</div>";
                  echo  "</div>";
                  $i++;
                }
              ?>
            
            </div>
          </div>
        </div>
      </section>
      <!-- End home  -->
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

    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
