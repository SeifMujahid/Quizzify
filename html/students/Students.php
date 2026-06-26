<!DOCTYPE html>
<html lang="en">
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
            <a href="../students/Students.php"><i class="fa-solid fa-user-graduate me-4"></i><span>Students</span></a>
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
      <div class="ranking">
        <table>
          <thead>
            <tr class="py-3">
              <th class="w-10 text-center">Rank</th>
              <th class="w-70 text-start">Name</th>
              <th class="w-10 text-center">Score</th>
              <th class="w-10 text-center">View</th>
            </tr>
          </thead>
          <tbody>
            <tr class="odd">
              <td>1</td>
              <td>Ahmed Seif</td>
              <td class="up-grade">1640</td>
              <td><i class="fa-solid fa-eye not-view"></i></td>
            </tr>
            <tr>
              <td>2</td>
              <td>Ahmed Seif</td>
              <td class="down-grade">1540</td>
              <td><i class="fa-solid fa-eye not-view"></i></td>
            </tr>
            <tr class="odd">
              <td>3</td>
              <td>Ahmed Seif</td>
              <td class="up-grade">1440</td>
              <td><i class="fa-solid fa-eye"></i></td>
            </tr>
            <tr>
              <td>4</td>
              <td>Ahmed Seif</td>
              <td class="down-grade">1340</td>
              <td><i class="fa-solid fa-eye"></i></td>
            </tr>
            <tr class="odd">
              <td>5</td>
              <td>Ahmed Seif</td>
              <td class="up-grade">1240</td>
              <td><i class="fa-solid fa-eye not-view"></i></td>
            </tr>
            <tr>
              <td>6</td>
              <td>Ahmed Seif</td>
              <td class="up-grade">1140</td>
              <td><i class="fa-solid fa-eye"></i></td>
            </tr>
            <tr class="odd">
              <td>7</td>
              <td>Ahmed Seif</td>
              <td class="up-grade">1040</td>
              <td><i class="fa-solid fa-eye not-view"></i></td>
            </tr>
            <tr>
              <td>8</td>
              <td>Ahmed Seif</td>
              <td class="down-grade">940</td>
              <td><i class="fa-solid fa-eye not-view"></i></td>
            </tr>
            <tr class="odd">
              <td>9</td>
              <td>Ahmed Seif</td>
              <td class="down-grade">940</td>
              <td><i class="fa-solid fa-eye not-view"></i></td>
            </tr>
            <tr>
              <td>10</td>
              <td>Ahmed Seif</td>
              <td class="up-grade">840</td>
              <td><i class="fa-solid fa-eye"></i></td>
            </tr>
            <tr class="odd">
              <td>11</td>
              <td>Ahmed Seif</td>
              <td class="up-grade">740</td>
              <td><i class="fa-solid fa-eye"></i></td>
            </tr>
            <tr>
              <td>12</td>
              <td>Ahmed Seif</td>
              <td class="up-grade">640</td>
              <td><i class="fa-solid fa-eye"></i></td>
            </tr>
            <tr class="odd">
              <td>13</td>
              <td>Ahmed Seif</td>
              <td class="up-grade">640</td>
              <td><i class="fa-solid fa-eye"></i></td>
            </tr>
            <tr>
              <td>14</td>
              <td>Ahmed Seif</td>
              <td class="up-grade">640</td>
              <td><i class="fa-solid fa-eye"></i></td>
            </tr>
            <tr class="odd">
              <td>15</td>
              <td>Ahmed Seif</td>
              <td class="up-grade">640</td>
              <td><i class="fa-solid fa-eye"></i></td>
            </tr>
            <tr>
              <td>16</td>
              <td>Ahmed Seif</td>
              <td class="up-grade">640</td>
              <td><i class="fa-solid fa-eye"></i></td>
            </tr>
            <tr class="odd">
              <td>17</td>
              <td>Ahmed Seif</td>
              <td class="up-grade">640</td>
              <td><i class="fa-solid fa-eye"></i></td>
            </tr>
          </tbody>
        </table>
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
