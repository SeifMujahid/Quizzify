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
    if (!isset($_SESSION['id']) && !($_SESSION['role'])=="Doctor") {
      header("Location: ../../login-register.php"); 
      exit(); 
  }
  else{
    $id= $_SESSION['id'];
    $role= "Doctor";
  }
  if(isset($_POST['submit'])){
    $errors=array();
        $quiz_name = !empty($_POST['quiz-name']) ? $_POST['quiz-name'] : array_push($errors,"Quiz Name is required.");
        $no_ques = !empty($_POST['no-questions']) ? $_POST['no-questions'] : array_push($errors,"Number of Questions is required.");
        $quiz_time = !empty($_POST['quiz-time']) ? $_POST['quiz-time'] : array_push($errors,"Quiz Time is required.");
        $quiz_subject = !empty($_POST['quiz-subject']) ? $_POST['quiz-subject'] : array_push($errors,"Quiz Subject is required.");
        if(empty($errors)){
          $database_status=array();
          $stmt = $conn->prepare("INSERT INTO exam (Subject,name,Grade,Doctor_Id) VALUES (?,?,?,?)");
          $stmt->bind_param("ssss", $quiz_subject,$quiz_name,$no_ques,$id);
          
          if($stmt->execute()) {
              $stmt->close();
              $stmt = $conn->prepare("SELECT Id FROM exam ORDER BY Id DESC LIMIT 1;");  
              $stmt->execute();
              $result = $stmt->get_result();
              $userData = $result->fetch_assoc();
              $_SESSION['time']=$quiz_time;
              $_SESSION['numques']=$no_ques;
              $_SESSION['exam_id']=$userData["Id"];
              $stmt = $conn->prepare("UPDATE doctor set No_Exams=No_Exams+1  WHERE Id=$id;");
              $stmt->execute();
              header("Location: ../handel_questions/index.php"); 
              exit();
            }
          else{
            array_push($errors,"an error occurred");
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
            <a href="../Home/Home.php"><i class="fa-solid fa-house me-4"></i><span>Home</span></a>
          </li>
          <li class="w-100 mb-4">
            <a href="../UserProfile/UserProfile.php"><i class="fa-solid fa-user me-4"></i><span>User Profile</span></a>
          </li>
          <li class="w-100 mb-4">
            <a href="../quiz_page/quizs_list.php"><i class="fa-solid fa-user-graduate me-4"></i><span>Students</span></a>
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
      <?php
        if (!empty($errors)){
          // Display errors if there are any
          foreach ($errors as $error) {
              echo "<div class=\"my-4 alert alert-danger rounded-4 p-3\">$error</div>";
          }
        }
      ?>
        <form action="" method="post" class="row h-100">
          <div class="left-content h-100 col-9 p-3">
            <div class="create w-100 p-3">
              <h2 class="fs-5 mb-3">
                Quiz Name <i class="fa-solid fa-pencil mx-2 fs-4"></i>
              </h2>
              <div class="in-name w-100 shadow-lg">
                <textarea
                  name="quiz-name"
                  id=""
                  placeholder="Write Quiz Name"
                  maxlength="200"
                ></textarea>
              </div>
            </div>
            <div class="sibjects w-100 p-3">
              <h2 class="fs-5 mb-3">Choose Quiz Subject</h2>
              <div class="subject-content w-100 row p-3 g-2">
                <div class="choose col-3">
                  <input
                    class="visually-hidden"
                    type="radio"
                    name="quiz-subject"
                    id="math"
                    value="math"
                    required
                  />
                  <label for="math" class="subject-label">
                    <img src="./imgs/course-01.jpg" alt="" class="w-100" />
                    <p>Math</p>
                  </label>
                </div>

                <div class="choose col-3">
                  <input
                    class="visually-hidden"
                    type="radio"
                    name="quiz-subject"
                    id="arabic"
                    value="arabic"
                    required
                  />
                  <label for="arabic" class="subject-label">
                    <img src="./imgs/course-02.jpg" alt="" class="w-100" />
                    <p>Arabic</p>
                  </label>
                </div>

                <div class="choose col-3">
                  <input
                    class="visually-hidden"
                    type="radio"
                    name="quiz-subject"
                    id="physics"
                    value="physics"
                    required
                  />
                  <label for="physics" class="subject-label">
                    <img src="./imgs/course-03.jpg" alt="" class="w-100" />
                    <p>Physics</p>
                  </label>
                </div>
                
                <div class="choose col-3">
                  <input
                    class="visually-hidden"
                    type="radio"
                    name="quiz-subject"
                    id="french"
                    value="french"
                    required
                  />
                  <label for="french" class="subject-label">
                    <img src="./imgs/course-04.jpg" alt="" class="w-100" />
                    <p>French</p>
                  </label>
                </div>

                <div class="choose col-3">
                  <input
                    class="visually-hidden"
                    type="radio"
                    name="quiz-subject"
                    id="english"
                    value="english"
                    required
                  />
                  <label for="english" class="subject-label">
                    <img src="./imgs/course-05.jpg" alt="" class="w-100" />
                    <p>English</p>
                  </label>
                </div>

                <div class="choose col-3">
                  <input
                    class="visually-hidden"
                    type="radio"
                    name="quiz-subject"
                    id="programming"
                    value="programming"
                    required
                  />
                  <label for="programming" class="subject-label">
                    <img src="./imgs/course-04.jpg" alt="" class="w-100" />
                    <p>Programming</p>
                  </label>
                </div>

                <div class="choose col-3">
                  <input
                    class="visually-hidden"
                    type="radio"
                    name="quiz-subject"
                    id="electronics"
                    value="electronics"
                    required
                  />
                  <label for="electronics" class="subject-label">
                    <img src="./imgs/course-02.jpg" alt="" class="w-100" />
                    <p>Electronics</p>
                  </label>
                </div>

                <div class="choose col-3">
                  <input
                    class="visually-hidden"
                    type="radio"
                    name="quiz-subject"
                    id="chemistry"
                    value="chemistry"
                    required
                  />
                  <label for="chemistry" class="subject-label">
                    <img src="./imgs/course-01.jpg" alt="" class="w-100" />
                    <p>Chemistry</p>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="right-content h-100 col-3 p-3">
            <div
              class="first-box h-45  box w-100 d-flex flex-column align-items-center justify-content-center p-3"
            >
              <i class="fa-solid fa-hourglass-half"></i>
              <p>Select Time Of The Quiz</p>
              <fieldset class="d-flex justify-content-center">
                <input type="number" name="quiz-time" value="30" id="time" />
                <label for="time" class="ms-2 mt-1">MIN</label>
              </fieldset>
            </div>
            <div
              class="second-box box w-100 d-flex flex-column h-45 justify-content-center align-items-center p-3"
            >
              <i class="fa-solid fa-question"></i>
              <p>Add Numbers Of Questions</p>
              <fieldset class="d-flex justify-content-center">
                <input type="number" name="no-questions" value="30" id="time" />
                <label for="time" class="ms-2 mt-1">Questions</label>
              </fieldset>
            </div>
            <div class="sub w-100 d-flex justify-content-center mt-3">
              <button name="submit" type="submit" class="btn rounded-pill">
                Create Quiz
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
