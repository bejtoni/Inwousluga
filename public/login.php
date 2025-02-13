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
session_start();

var_dump($_SESSION);

$authenticated = $_SESSION["authenticated"] ?? false;
if ($authenticated) {
    header("Location: ../index.php");
    exit();
}



if ($_POST) {
    include "../php/db.php";

    $email = $_POST["email"];
    $password = $_POST["password"];

    $email = mysqli_real_escape_string($db, $email);
    $password = mysqli_real_escape_string($db, $password);
    $hashed_password = hash('sha256', $password);

    $query = mysqli_query($db, "select * from users where email='" . $email . "' and password='" . $hashed_password . "'");
    $user = mysqli_fetch_assoc($query);

    if ($user) {
        $_SESSION['authenticated'] = true;
        $_SESSION['user_id'] = $user['UID'];
        $_SESSION['user_name'] = $user['FirstName'];
        $_SESSION['is_admin'] = $user['IsAdmin'];

        include "../php/check-admin.php";
        // if ($_SESSION['is_admin'] === "1") {
        //     header("Location: ../public/admin.php?q=users");
        //     exit();
        // } else {
        //     header("Location: ../index.php");
        //     exit();
        // }
    }
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

    <title>Login</title>
</head>

<body>

    <main>

        <section class="section section-login">

            <div class="grid grid--2-cols">

                <div class="left-picture">
                    <img class="background-img-part" src="../assets/inwousluga-background.png" alt="flowers" />
                    <img src="../assets/inwousluga-logo-box-purple.svg" alt="Logo" class="logo-center" />
                    <h1 class="heading-large">
                        Inwousluga
                    </h1>
                </div>

                <div class="right">

                    <div class="form">
                        <img src="../assets/inwousluga-logo-box-purple.svg" alt="Logo" class="logo-center small-logo" />
                        <div class="form-heading">
                            <span class="subheading">Welcome Back</span>

                            <h2 class="heading-secondary">
                                Login to Your <span>Profile</span>
                            </h2>

                        </div>

                        <form class="form" id="contactForm" method="POST" action="">

                            <div class="form-row">
                                <label for="email" class="form-paragraph">Email</label>
                                <input type="email" id="email" name="email" class="input-text"
                                    placeholder="amer@hadzikadic.com" required />
                            </div>

                            <div class="form-row">
                                <label for="password" class="form-paragraph">Password</label>
                                <input type="password" id="password" name="password" class="input-text" required
                                    placeholder="******" />
                            </div>


                            <button type="submit" class="button">Log In</button>

                        </form>
                        <!-- Form ends here -->


                    </div>

                    <div class="already-container">
                        <p>Haven't registred yet?</p>
                        <a href="./register.php">
                            Register Now
                        </a>
                    </div>

                </div>

            </div>
        </section>
    </main>


</body>

</html>