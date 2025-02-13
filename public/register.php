<?php
$indexPath = "../";
$logoPath = "../assets/inwousluga-logo.svg";
$addServicePath = "./add-provider-service.php";
$likedServicePath = "./liked-services.php";
$collaborationsPath = "./collaborations.php";
$profilePath = "./profile.php";
$loginPath = "../login.php";
$logoutPath = "../php/logout.php";
?>

<?php
session_start(); //ovo ide ovbdje privremeno

if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"]) {
  header("Location: ../index.php");
  exit();
}


if ($_POST) {
  include "../php/db.php";

  $name = $_POST["name"];
  $surname = $_POST["surname"];
  $email = $_POST["email"];
  $dob = $_POST["dateOfBirth"];
  $telephone = $_POST["telephone"];
  $password = $_POST["password"];

  // Ensure you properly escape these variables to prevent SQL injection
  $name = mysqli_real_escape_string($db, $name);
  $surname = mysqli_real_escape_string($db, $surname);
  $email = mysqli_real_escape_string($db, $email);
  $dob = mysqli_real_escape_string($db, $dob);
  $telephone = mysqli_real_escape_string($db, $telephone);

  $password = mysqli_real_escape_string($db, $password);
  $hashed_password = hash('sha256', $password);

  // Adjusted SQL query with variables
  $query = "INSERT INTO users (First_Name, Last_Name, DOB, Phone, Email, Password, Total_Rating) 
VALUES ('$name', '$surname', '$dob', '$telephone', '$email', '$hashed_password', NULL)";

  // Execute the query
  mysqli_query($db, $query);

  $userID = mysqli_insert_id($db);

  $_SESSION["authenticated"] = true;
  $_SESSION["user_id"] = $userID;
  $_SESSION["user_name"] = $name;

  header("Location: ../index.php");
  exit;

}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="../styles/general.css" />

  <link rel="stylesheet" href="../styles/style.css" />

  <link rel="stylesheet" href="../php/service/service.css" />

  <link rel="stylesheet" href="../php/site-header/site-header.css" />

  <link rel="stylesheet" href="../php/footer/footer.css" />

  <link rel="stylesheet" href="../php/header/header.css" />

  <link rel="stylesheet" href="../styles/media.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>Register - Start With Your Business</title>
</head>

<body>

  <main>

    <section class="section section-register">

      <div class="grid grid--2-cols">

        <div class="left">

          <div class="form">
            <img src="../assets/inwousluga-logo-box-purple.svg" alt="Logo" class="logo-center small-logo" />

            <div class="form-heading">
              <span class="subheading">Register</span>

              <h2 class="heading-secondary">
                Register Your <span>Profile</span>
              </h2>

            </div>

            <form class="form" id="register" method="POST" action="">
              <div class="form-row">
                <label for="name" class="form-paragraph">Name</label>
                <input type="text" id="name" name="name" class="input-text" placeholder="Amer" required />
              </div>

              <div class="form-row">
                <label for="surname" class="form-paragraph">Surname</label>
                <input type="text" id="surname" name="surname" class="input-text" placeholder="Hadžikadić" required />
              </div>

              <div class="form-row">
                <label for="email" class="form-paragraph">Email</label>
                <input type="email" id="email" name="email" class="input-text" placeholder="amer@hadzikadic.com"
                  required />
              </div>

              <div class="form-row">
                <label for="dateOfBirth" class="form-paragraph">Date of Birth</label>
                <input type="date" id="dateOfBirth" name="dateOfBirth" class="input-text" placeholder="04/09/1976"
                  required />
              </div>

              <div class="form-row">
                <label for="dateOfBirth" class="form-paragraph">Telephone Number</label>
                <input type="tel" id="telephone" name="telephone" class="input-text" placeholder="+387 62 000 000"
                  required />
              </div>


              <div class="form-row">
                <label for="password" class="form-paragraph">Password</label>
                <input type="password" id="password" name="password" class="input-text" required placeholder="******" />
              </div>

              <div class="flex">
                <button type="submit" class="button">Register</button>
                <div class="already-container">
                  <p>Already Logged In?</p>
                  <a href="./login.php">
                    Login Now
                  </a>
                </div>
              </div>
            </form>
            <!-- Form ends here -->
          </div>
        </div>

        <div class="right-picture">
          <img class="background-img-part" src="../assets/inwousluga-background-purple.png" alt="flowers" />
          <img src="../assets/inwousluga-logo-box-white.svg" alt="Logo" class="logo-center" />
          <h1 class="heading-large white-text">
            Inwousluga
          </h1>
        </div>
      </div>
    </section>
  </main>
</body>

</html>