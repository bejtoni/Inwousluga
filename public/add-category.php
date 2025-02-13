<?php
$indexPath = "../";
$logoPath = "../assets/inwousluga-logo.svg";
$addServicePath = "./add-provider-service.php";
$likedServicePath = "./liked-service.php";
$collaborationsPath = "./collaborations.php";
$profilePath = "./profile.php";
$loginPath = "./login.php";
$logoutPath = "../php/logout.php";
?>

<?php
session_start();

include "../php/check-loggged.php";
include "../php/db.php";

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== "1") {
    header("Location: ../index.php");
    exit();
}


$allCategories = mysqli_query($db, "select * from category");

$categoryName = $_POST['category'];

if (isset($_GET['cid'])) {
    $cid = $_GET['cid'];
    $result = mysqli_query($db, "SELECT * FROM category WHERE CID = '$cid'");
    if ($result && mysqli_num_rows($result) > 0) {
        $category = mysqli_fetch_assoc($result);
        $categoryName = $category['Category_Type'];
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoryName = $_POST['category'];
    if (isset($_GET['cid'])) {
        $updateSql = "UPDATE category SET Category_Type='$categoryName' WHERE CID='$cid'";
        mysqli_query($db, $updateSql);
    } else {
        $insertSql = "INSERT INTO category (Category_Type) VALUES('$categoryName')";
        mysqli_query($db, $insertSql);
    }

    // Redirect to admin.php
    header("Location: ../public/admin.php?q=category");
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
    <title>Add Your Service - Start Your Bussines</title>

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
</head>


<body>
    <?php include "../php/header/header.php" ?>

    <main>
        <section class="section section-add-service">
            <div class="big-container margin-bottom-xsm">
                <span class="subheading">Categories</span>
                <h2><?php echo isset($_GET['cid']) ? "Edit Category" : "Add Category"; ?></h2>
            </div>
            <div class="big-container">
                <form method="POST" class="form add-service-form">
                    <div class="form-row">
                        <label for="category" class="form-paragraph">Category Name</label>
                        <input type="text" id="category" name="category" class="input-text"
                            value="<?= htmlspecialchars($categoryName) ?>" placeholder="Mobile Phone Repair Services"
                            required />
                    </div>
                    <button type="submit"
                        class="button"><?php echo isset($_GET['cid']) ? "Update Category" : "Add Category"; ?></button>
                </form>
            </div>
        </section>
    </main>


    <?php include "../php/footer/footer.php" ?>

    <script src="../js/script.js"></script>
</body>



</html>