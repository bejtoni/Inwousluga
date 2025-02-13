<?php
$indexPath = "../";
$logoPath = "../assets/inwousluga-logo.svg";
$addServicePath = "./add-provider-service.php";
$likedServicePath = "./liked-service.php";
$collaborationsPath = "./collaborations.php";
$profilePath = "./profile.php";
$loginPath = "./login.php";
$logoutPath = "../php/logout.php";

session_start();
include "../php/check-loggged.php";
include "../php/db.php";

// View is used here - ServiceDetails
$allServices = mysqli_query($db, "SELECT * FROM ServiceDetails");

$serviceName = "";
$location = "";
$phoneNumber = "";
$description = "";
$website = "";
$email = "";
$DOB = "";
$serviceID = "";
$CID = "";
$userID = $_SESSION["user_id"];
$allCategories = mysqli_query($db, "SELECT * FROM category");

if (isset($_GET['psid'])) {
    $psid = $_GET['psid'];
    // Fetch provider service details
    $result = mysqli_query($db, "SELECT * FROM provider_service WHERE PSID = '$psid'");
    if ($result && mysqli_num_rows($result) > 0) {
        $service = mysqli_fetch_assoc($result);
        $serviceName = $service['Name_Of_Service'];
        $location = $service['Location'];
        $phoneNumber = $service['Telephone_Number'];
        $description = $service['Description'];
        $website = $service['Website'];
        $email = $service['Email'];
        // $DOB = $service['Date_Of_Birth'];
        $serviceID = $service['Service_ID'];

        // Fetch category ID for the service
        $categoryResult = mysqli_query($db, "SELECT Category_ID FROM service WHERE SID = '$serviceID'");
        if ($categoryResult && mysqli_num_rows($categoryResult) > 0) {
            $category = mysqli_fetch_assoc($categoryResult);
            $CID = $category['Category_ID'];
        }
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $serviceName = isset($_POST['serviceName']) ? mysqli_real_escape_string($db, $_POST['serviceName']) : '';
    $location = isset($_POST['location']) ? mysqli_real_escape_string($db, $_POST['location']) : '';
    $phoneNumber = isset($_POST['phone']) ? mysqli_real_escape_string($db, $_POST['phone']) : '';
    $description = isset($_POST['description']) ? mysqli_real_escape_string($db, $_POST['description']) : '';
    $website = isset($_POST['web']) ? mysqli_real_escape_string($db, $_POST['web']) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, $_POST['email']) : '';
    // $DOB = isset($_POST['dateOfBirth']) ? mysqli_real_escape_string($db, $_POST['dateOfBirth']) : '';
    $serviceID = isset($_POST['service']) ? mysqli_real_escape_string($db, $_POST['service']) : '';
    $CID = isset($_POST['category']) ? mysqli_real_escape_string($db, $_POST['category']) : '';

    $psid = isset($_GET['psid']) ? mysqli_real_escape_string($db, $_GET['psid']) : NULL;

    // Use Procedure AddOrUpdateProviderService
    $stmt = $db->prepare("CALL AddOrUpdateProviderService(?, NULL, ?, ?, ?, ?, ?, ?, ?, ?, NULL)");
    $stmt->bind_param("isssssssi", $psid, $serviceName, $location, $phoneNumber, $description, $website, $email, $userID, $serviceID);
    $stmt->execute();

    // Redirect based on psid
    if ($psid) {
        header("Location: ../public/admin.php?q=provider_service");
    } else {
        header("Location: $profilePath");
    }
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
    <title><?php echo isset($_GET['psid']) ? "Edit Service Provider" : "Add Service Provider"; ?> - Start Your Business
    </title>

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
                <span class="subheading">Provider Service</span>
                <h2><?php echo isset($_GET['psid']) ? "Edit Service Provider" : "Add Service Provider"; ?></h2>
            </div>

            <div class="big-container">
                <form method="POST" class="form add-service-form">
                    <?php if (!isset($_GET['psid'])): ?>
                        <div class="form-row">
                            <label for="select-category" class="form-paragraph">Select Category of Your Service</label>
                            <select id="select-category" name="category" class="input-text" required>
                                <option disabled selected>Category</option>
                                <?php while ($row = mysqli_fetch_assoc($allCategories)): ?>
                                    <option value="<?= $row['CID'] ?>" <?= ($row['CID'] == $CID) ? 'selected' : '' ?>>
                                        <?= $row['Category_Type'] ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="form-row">
                            <label for="select-service" class="form-paragraph">Select Service under Category</label>
                            <select id="select-service" name="service" class="input-text" required>
                                <?php if (!isset($_GET['psid'])): ?>
                                    <option value="" disabled selected>Select a category first</option>
                                <?php else: ?>
                                    <?php
                                    $services = mysqli_query($db, "SELECT * FROM service WHERE Category_ID = '$CID'");
                                    while ($row = mysqli_fetch_assoc($services)): ?>
                                        <option value="<?= $row['SID'] ?>" <?= ($row['SID'] == $serviceID) ? 'selected' : '' ?>>
                                            <?= $row['Service_Name'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                    <?php endif; ?>

                    <div class="form-row">
                        <label for="service-name" class="form-paragraph">Name of the Service</label>
                        <input type="text" id="service-name" name="serviceName" class="input-text"
                            value="<?= htmlspecialchars($serviceName) ?>" placeholder="Name of the Service" required />
                    </div>

                    <div class="form-row">
                        <label for="location" class="form-paragraph">Location</label>
                        <input type="text" id="location" name="location" class="input-text"
                            value="<?= htmlspecialchars($location) ?>" placeholder="Location" required />
                    </div>

                    <div class="form-row">
                        <label for="phone" class="form-paragraph">Telephone Number</label>
                        <input type="text" id="phone" name="phone" class="input-text"
                            value="<?= htmlspecialchars($phoneNumber) ?>" placeholder="Telephone Number" required />
                    </div>

                    <div class="form-row">
                        <label for="description" class="form-paragraph">Description</label>
                        <textarea id="description" name="description" class="input-text"
                            placeholder="Describe Your Service"
                            required><?= htmlspecialchars($description) ?></textarea>
                    </div>

                    <div class="form-row">
                        <label for="web" class="form-paragraph">Website</label>
                        <input type="text" id="web" name="web" class="input-text"
                            value="<?= htmlspecialchars($website) ?>" placeholder="Website" required />
                    </div>

                    <div class="form-row">
                        <label for="email" class="form-paragraph">Email</label>
                        <input type="email" id="email" name="email" class="input-text"
                            value="<?= htmlspecialchars($email) ?>" placeholder="Email" required />
                    </div>

                    <!-- <div class="form-row">
                    <label for="dateOfBirth" class="form-paragraph">Date of Birth</label>
                    <input type="date" id="dateOfBirth" name="dateOfBirth" class="input-text" value="<?= htmlspecialchars($DOB) ?>" required />
                </div> -->

                    <button type="submit"
                        class="button"><?php echo isset($_GET['psid']) ? "Update Service Provider" : "Add Service Provider"; ?></button>
                </form>
            </div>
        </section>
    </main>

    <?php include "../php/footer/footer.php" ?>

    <script src="../js/script.js"></script>
</body>

</html>