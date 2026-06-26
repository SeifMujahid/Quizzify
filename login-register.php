<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Quizzify</title>
    <link rel="stylesheet" href="lib/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="lib/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="lib/bootstrab/css/bootstrap.min.css">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
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
      
    
    
    $emailpattern = "#^[a-zA-Z0-9]{4,}@[a-z0-9]{2,}\.[a-z]{2,}$#";  
    $passwordpattern="#^(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&]{6,}$#";
    if (isset($_POST["submit"])) {
        //Patterns
        // Check if each field is set and validate them
        $errors=array();
        $username = !empty($_POST['UserName']) ? $_POST['UserName'] : array_push($errors,"Username is required.");
        $fullname = !empty($_POST['FullName']) ? $_POST['FullName'] : array_push($errors,"Full Name is required.");
        $email = !empty($_POST['Email']) ? $_POST['Email'] : array_push($errors, "Email is required.");
        $education = !empty($_POST['Education']) ? $_POST['Education'] :array_push($errors,"Education is required.");
        $password = !empty($_POST['Password']) ? $_POST['Password'] : array_push($errors,"Password is required.");
        $confirmPassword = !empty($_POST['ConfirmPassword']) ? $_POST['ConfirmPassword'] :array_push($errors,"Confirm Password is required.");
        $role = isset($_POST['role']) ? $_POST['role'] :array_push($errors,"Role is required."); 
        $profilepic = isset($_POST['profilePic']) ? $_POST['profilePic'] : array_push($errors,"Profile Picture is required."); 
        // Check if vaidation match
        if (preg_match($emailpattern, $email)){
            $sql = "SELECT * FROM user WHERE Email = ? ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                array_push($errors,"This Email is already Used.");
            }
            $stmt->close();
        }
        else{
            array_push($errors, "Email should be like \"test@example.com\"");  
        }
        if (!preg_match('#\s#', $username) || strlen($username) < 4) {
            $sql = "SELECT * FROM user WHERE UserName = ? ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username );
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                array_push($errors,"This User Name is already Used.");
            }
            $stmt->close();
        }
        else{
            array_push($errors,"User Name .Must be at least 4 characters long and cannot contain spaces.");
        }
        if(strlen($fullname)<6){
            array_push($errors,"Full Name .Must be at least 6 characters.");
        }
        if (!preg_match($passwordpattern, $password)) {
            array_push($errors, "Password must be at least 6 characters, with at least one uppercase letter and one number.");
        }
        if ($password != $confirmPassword) {
            array_push($errors,"Password doens't match.");
        }
        // Insert Into Database
        if(empty($errors)){
            $database_status=array();
            $hashed_password=password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO user (username, email,password,role) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss", $username, $email,$hashed_password,$role);
            if($stmt->execute()) {
                $stmt->close();
               
                if($role == "Doctor"){
                    $stmt = $conn->prepare("INSERT INTO doctor (UserName, Email,FullName , Password,Role,Education,picture) VALUES (?,?,?,?,\"Doctor\",?,?)");
                    $stmt->bind_param("ssssss", $username, $email,$fullname,$hashed_password,$education,$profilepic);
                    if ($stmt->execute()) {
                        // array_push($database_status,"New record into Doctor table created successfully") ;
                        
                    } 
                    else {
                        array_push($errors,"Error".$stmt->error);
                    }
                    $stmt->close();
                }
                else{
                    $stmt = $conn->prepare("INSERT INTO student (UserName, Email,FullName , Password,Role,Education,picture) VALUES (?,?,?,?,\"Student\",?,?)");
                    $stmt->bind_param("ssssss", $username, $email,$fullname,$hashed_password,$education,$profilepic);
                    if ($stmt->execute()) {
                        // array_push($database_status,"New record into Student table created successfully") ;
                        
                    } 
                    else {
                        array_push($errors,"Error".$stmt->error);
                    }
                    $stmt->close();
                }
            }else{
                echo "Eroor occurud";
                $stmt->close();
            }
            
        }
        
    }
    if(isset($_POST["login_submit"])){
        $useroremail=$_POST["useroremail"];
        $password=$_POST["password"];

        $sql = "SELECT * FROM user WHERE UserName = ? or Email = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $useroremail,$useroremail);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['Password'])){
                $_SESSION['username'] = $user['UserName'];
                $_SESSION['role'] = $user['Role'];
                header("Location: html/Home/Home.php"); 
                exit();
            }
            else{
                $login_error = "Incorrect Email or password. Please try again.";
            }
        }
        $stmt->close();
    }
    $conn->close();
?>
    <div id="Login-Form" class="d-flex  justify-content-center">
        <div class="container">
            <div class="form rounded-5 mt-5">

                <ul class="tab-group">
                    <li class="tab active "><a class="SignUp" href="#signup">Sign Up</a></li>
                    <li class="tab"><a class="LogIn" href="#login">Log In</a></li>
                </ul>
                <div class="tab-content">
                    <div id="signup">
                        <h1>Sign Up for Free</h1>
                        <?php
                         if (!empty($errors)){
                            // Display errors if there are any
                            foreach ($errors as $error) {
                                echo "<div class=\"my-4 alert alert-danger rounded-4 p-3\">$error</div>";
                            }
                        }
                        ?>
                        <form action="" method="POST">
                            <div class="field-wrap ">
                                <label>
                                    Username<span class="req"></span>
                                </label>
                                <input type="text" name="UserName" required autocomplete="off" />
                            </div>

                            <div class="field-wrap ">
                                <label>
                                    Full Name<span class="req"></span>
                                </label>
                                <input type="text" name="FullName" required autocomplete="off" />
                            </div>
                            <div class="field-wrap">
                                <label>
                                    Email Address<span class="req"></span>
                                </label>
                                <input type="email" name="Email" required autocomplete="off" />
                            </div>

                            <div class="field-wrap">
                                <label>
                                    Education<span class="req"></span>
                                </label>
                                <input type="text" name="Education" required autocomplete="off" />
                            </div>
                            <div class="field-wrap">
                                <label>
                                    Set A Password<span class="req"></span>
                                </label>
                                <input type="password" name="Password" required autocomplete="off" />
                            </div>
                            <div class="field-wrap">
                                <label>
                                    Re-Password<span class="req"></span>
                                </label>
                                <input type="password" name="ConfirmPassword" required autocomplete="off" />
                            </div>
                            <div class="field-wrap">
                                <p class="fs-4">Choose Your Role</p>
                                <div class="mt-2">
                                    <input class="radio" value="Doctor" type="radio" name="role" required />
                                    <p class="d-inline-flex pe-2">Doctor</p>
                                </div>
                                <div>
                                    <input class="radio fs-2" value="Student" type="radio" name="role" required />
                                    <p class="d-inline-flex">Student</p>
                                </div>
                            </div>
                            <div class="field-wrap">
                                <p class="fs-4">Choose Your Profile Picture</p>
                                <div class="mt-2 d-flex justify-align-content-between">
                                    <!-- Image 1 -->
                                    <input class="pg"  type="radio" id="profilePic1" name="profilePic" value="Avatar2.jpg" required />
                                    <label class="position-static mx-3" for="profilePic1">
                                        <img src="img/Avatar2.jpg" class="profile-img" alt="Profile 1"/>
                                    </label>
                                
                                    <!-- Image 2 -->
                                    <input class="pg" type="radio" id="profilePic2" name="profilePic" value="Avatar3.avif" required />
                                    <label class="position-static mx-3" for="profilePic2">
                                        <img src="img/Avatar3.avif" class="profile-img" alt="Profile 2" />
                                    </label>
                             
                                    <!-- Image 3 -->
                                    <input class="pg"  type="radio" id="profilePic3" name="profilePic" value="Avatar4.avif" required />
                                    <label class="position-static mx-3" for="profilePic3">
                                        <img src="img/Avatar4.avif" class="profile-img" alt="Profile 3"/>
                                    </label>
                                </div>
                            </div>

                            <button type="submit" name="submit" class="button button-block">Get Started</button>
                        </form>

                    </div>

                    <div id="login">
            
                      
                        <h1>Log In!</h1>
                    <?php
                        if (!empty($login_error)) {
                            echo "<div class=\"my-4 alert alert-danger rounded-4 p-3\">$login_error</div>";
                        }
                    ?>

                        <form action="" method="POST">

                            <div class="field-wrap">
                                <label>
                                    Username or Email <span class="req"></span>
                                </label>
                                <input name="useroremail" type="text" required autocomplete="off" />
                            </div>

                            <div class="field-wrap">
                                <label>
                                    Password<span class="req"></span>
                                </label>
                                <input name="password" type="password" required autocomplete="off" />
                            </div>
                            <!-- 
                            <p class="forgot"><a href="#">Forgot Password?</a></p> -->

                            <button name="login_submit" class="button button-block">Log In</button>

                        </form>

                    </div>

                </div><!-- tab-content -->

            </div> <!-- /form -->
        </div>
    </div>
    </div>
    <script src="js/form.js"></script>
</body>

</html>