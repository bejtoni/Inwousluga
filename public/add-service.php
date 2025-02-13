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


$allServices = mysqli_query($db, "select * from service");

$serviceName = "";
$serviceDescription = "";
$CID = "";
$allCategories = mysqli_query($db, "select * from category");

if (isset($_GET['sid'])) {
    $sid = $_GET['sid'];
    // Fetch category details
    $result = mysqli_query($db, "SELECT * FROM service WHERE SID = '$sid'");
    if ($result && mysqli_num_rows($result) > 0) {
        $service = mysqli_fetch_assoc($result);
        $serviceName = $service['Service_Name'];
        $serviceDescription = $service['Service_Description'];
        $CID = $service['Category_ID'];
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $serviceName = $_POST['serviceName'];
    $serviceDescription = $_POST['serviceDescription'];
    $CID = $_POST['category'];

    // Check if we're updating an existing category or inserting a new one
    if (isset($_GET['sid'])) {
        $updateSql = "UPDATE service SET Service_Name='$serviceName', Service_Description='$serviceDescription', Category_ID='$CID' WHERE SID='$sid'";
        mysqli_query($db, $updateSql);
    } else {
        $insertSql = "INSERT INTO service (Service_Name, Service_Description, Category_ID) VALUES('$serviceName', '$serviceDescription', '$CID')";
        mysqli_query($db, $insertSql);
    }

    // Redirect to admin.php
    header("Location: ../public/admin.php?q=service");
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
                <span class="subheading">Services</span>
                <h2><?php echo isset($_GET['sid']) ? "Edit Service" : "Add Service"; ?></h2>
            </div>
            <div class="big-container">
                <form method="POST" class="form add-service-form">
                    <div class="form-row">
                        <label for="category" class="form-paragraph">Service Name</label>
                        <select id="select-category" name="category" class="input-text" required>
                            <option disabled selected>Category</option>
                            <?php while ($row = mysqli_fetch_assoc($allCategories)): ?>
                                <option value="<?= $row['CID'] ?>" <?= ($row['CID'] == $CID) ? 'selected' : '' ?>>
                                    <?= $row['Category_Type'] ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                        <input type="text" id="service-name" name="serviceName" class="input-text"
                            value="<?= htmlspecialchars($serviceName) ?>" placeholder="Service Name" required />
                        <input type="text" id="service-description" name="serviceDescription" class="input-text"
                            value="<?= htmlspecialchars($serviceDescription) ?>" placeholder="Description" required />
                    </div>
                    <button type="submit"
                        class="button"><?php echo isset($_GET['sid']) ? "Update Service" : "Add Service"; ?></button>
                </form>
            </div>
        </section>
    </main>


    <?php include "../php/footer/footer.php" ?>

    <script src="../js/script.js"></script>
</body>



</html>