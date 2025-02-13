<?php
$indexPath = "../";
$logoPath = "../assets/inwousluga-logo.svg";
$addServicePath = "./add-provider-service.php";
$likedServicePath = "./liked-services.php";
$collaborationsPath = "./collaborations.php";
$profilePath = "./profile.php";
$loginPath = "../login.php";
$logoutPath = "../php/logout.php";

session_start(); //ovo ide ovbdje privremeno

include "../php/check-loggged.php";
include "../php/db.php";

// include "../php/check-admin.php";
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== "1") {
    header("Location: ../index.php");
    exit();
}


$UID = "";
$name = "";
$surname = "";
$email = "";
$dob = "";
$telephone = "";
$hashed_password = "";

if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];

    $result = mysqli_query($db, "SELECT * FROM users WHERE UID = '$uid'");
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $UID = $user['UID'];
        $name = $user['First_Name'];
        $surname = $user['Last_Name'];
        $email = $user['Email'];
        $dob = $user['DOB'];
        $telephone = $user['Phone'];
        $hashed_password = $user['Password'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $surname = mysqli_real_escape_string($db, $_POST['surname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $dob = mysqli_real_escape_string($db, $_POST['dateOfBirth']);
    $telephone = mysqli_real_escape_string($db, $_POST['telephone']);

    if (isset($_GET['uid'])) {
        $updateSql = "UPDATE users SET First_Name='$name', Last_Name='$surname', DOB='$dob', Phone='$telephone', Email='$email', Password='$hashed_password' WHERE UID='$uid'";
        mysqli_query($db, $updateSql);
    }

    header("Location: ../public/admin.php?q=users");
    exit();
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

    <title>Edit User - Start With Your Business</title>
</head>

<body>

    <main>
        <section class="section section-register">
            <div class="grid grid--2-cols">
                <div class="left">
                    <div class="form">
                        <img src="../assets/inwousluga-logo-box-purple.svg" alt="Logo" class="logo-center small-logo" />
                        <div class="form-heading">
                            <span class="subheading">Edit</span>
                            <h2 class="heading-secondary">
                                Edit User <span>Profile</span>
                            </h2>
                        </div>

                        <form class="form" id="register" method="POST" action="">
                            <div class="form-row">
                                <label for="name" class="form-paragraph">Name</label>
                                <input type="text" id="name" name="name" class="input-text"
                                    value="<?= htmlspecialchars($name) ?>" placeholder="Amer" required />
                            </div>

                            <div class="form-row">
                                <label for="surname" class="form-paragraph">Surname</label>
                                <input type="text" id="surname" name="surname" class="input-text"
                                    value="<?= htmlspecialchars($surname) ?>" placeholder="Hadžikadić" required />
                            </div>

                            <div class="form-row">
                                <label for="email" class="form-paragraph">Email</label>
                                <input type="email" id="email" name="email" class="input-text"
                                    value="<?= htmlspecialchars($email) ?>" placeholder="amer@hadzikadic.com"
                                    required />
                            </div>

                            <div class="form-row">
                                <label for="dateOfBirth" class="form-paragraph">Date of Birth</label>
                                <input type="date" id="dateOfBirth" name="dateOfBirth" class="input-text"
                                    value="<?= htmlspecialchars($dob) ?>" required />
                            </div>

                            <div class="form-row">
                                <label for="telephone" class="form-paragraph">Telephone Number</label>
                                <input type="tel" id="telephone" name="telephone" class="input-text"
                                    value="<?= htmlspecialchars($telephone) ?>" placeholder="+387 62 000 000"
                                    required />
                            </div>

                            <button type="submit" class="button">Update User</button>
                        </form>
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