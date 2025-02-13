<?php
session_start();

$page = $_GET;

include "../php/db.php";

// include "../php/check-admin.php";
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== "1") {
    header("Location: ../index.php");
    exit();
}

$heading = isset($_GET["q"]) ? $_GET["q"] : null;
$id = isset($_GET["id"]) ? $_GET["id"] : null;

if ($heading == "users") {
    $selectUsers = "SELECT UID, First_Name, Last_Name, DOB, Phone, Email, Total_Rating, IsAdmin, GetFullUserName(UID) AS FullName FROM users";
    $allUsers = mysqli_query($db, $selectUsers);
} else if ($heading == "category") {
    $selectCategories = "SELECT * FROM category";
    $allCategories = mysqli_query($db, $selectCategories);
} else if ($heading == "service") {
    $selectServices = "SELECT c.CID, c.Category_Type, s.*
                       FROM service s  
                       JOIN category c ON s.category_id = c.CID";
    $allServices = mysqli_query($db, $selectServices);
} else {
    $selectProviders = "SELECT 
                          u.UID,
                          u.First_Name,
                          u.Last_Name,
                          ps.*
                        FROM 
                          provider_service ps
                        JOIN 
                          users u ON ps.User_ID = u.UID";
    $allProviders = mysqli_query($db, $selectProviders);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../styles/general.css" />
    <link rel="stylesheet" href="../styles/style.css" />
    <link rel="stylesheet" href="../styles/media.css" />
</head>

<body>
    <section class="section section-admin">

        <div class="admin-container">
            <aside class="admin-left-side">
                <img src="../assets/inwousluga-logo-box-white.svg" />
                <h1 class="heading-secondary white-text margin-bottom-xsm">Inwousluga</h1>
                <a href="?q=users" class="button white-button">Show All Users</a>
                <a href="?q=category" class="button white-button">Show All Categories</a>
                <a href="?q=service" class="button white-button">Show All Services</a>
                <a href="?q=provider_service" class="button white-button">Show All Service Providers</a>
            </aside>
            <div class="admin-right-side">
                <nav class="admin-header">
                    <a href="../php/logout.php" class="button white-button button-admin">Logout</a>
                </nav>

                <div class="admin-operations-container">
                    <div class="admin-text-insert-container">
                        <h2 class="heading-tertiary margin-bottom-xsm">
                            <?= $heading == "users" ? "User operations" : ($heading == "category" ? "Category operations" : ($heading == "service" ? "Service operations" : "")) ?>
                        </h2>
                        <?php if ($heading == "category"): ?>
                            <a href="../public/add-category.php"
                                class="button purple-button button-admin margin-bottom-xxsm">Insert Category</a>
                        <?php elseif ($heading == "service"): ?>
                            <a href="../public/add-service.php"
                                class="button purple-button button-admin margin-bottom-xxsm">Insert Service</a>
                        <?php endif; ?>

                    </div>

                    <?php if ($heading == "users" && !isset($id)): ?>
                        <div class="admin-crud-container">
                            <div class="crud-row crud-row-head grid">
                                <p>UID</p>
                                <p>Full Name</p>
                                <p>Date of Birth</p>
                                <p>Phone</p>
                                <p>Email</p>
                                <p>Rating</p>
                            </div>
                            <?php while ($row = mysqli_fetch_assoc($allUsers)): ?>
                                <div class="crud-row grid">
                                    <p><?= $row["UID"] ?></p>
                                    <p><?= $row["FullName"] ?></p>
                                    <p><?= $row["DOB"] ?></p>
                                    <p><?= $row["Phone"] ?></p>
                                    <p><?= $row["Email"] ?></p>
                                    <p><?= $row["Total_Rating"] ?></p>
                                    <div class="buttons-row">
                                        <a href=<?= "./edit-user.php?uid=" . $row["UID"]; ?> class="button">Edit</a>
                                        <?php if ($row["IsAdmin"] != 1): ?>
                                            <a href=<?= "./delete-user.php?uid=" . $row["UID"]; ?> class="button">Delete</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>

                    <?php elseif ($heading == "category" && !isset($id)): ?>
                        <div class="admin-crud-container">
                            <div class="crud-row crud-row-head grid">
                                <p>CID</p>
                                <p>Category Name</p>
                                <p>Created At</p>
                            </div>
                            <?php while ($row = mysqli_fetch_assoc($allCategories)): ?>
                                <div class="crud-row grid">
                                    <p><?= $row["CID"] ?></p>
                                    <p><?= $row["Category_Type"] ?></p>
                                    <p><?= $row["Created_At"] ?></p>
                                    <div class="buttons-row">
                                        <a href=<?= "./add-category.php?cid=" . $row["CID"]; ?> class="button">Edit</a>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>

                    <?php elseif ($heading == "service" && !isset($id)): ?>
                        <div class="admin-crud-container">
                            <div class="crud-row crud-row-head grid">
                                <p>CID</p>
                                <p>Category Name</p>
                                <p>SID</p>
                                <p>Service Name</p>
                                <p>Service Description</p>
                            </div>
                            <?php while ($row = mysqli_fetch_assoc($allServices)): ?>
                                <div class="crud-row grid">
                                    <p><?= $row["CID"] ?></p>
                                    <p><?= $row["Category_Type"] ?></p>
                                    <p><?= $row["SID"] ?></p>
                                    <p><?= $row["Service_Name"] ?></p>
                                    <p><?= $row["Service_Description"] ?></p>
                                    <div class="buttons-row">
                                        <a href=<?= "./add-service.php?sid=" . $row["SID"]; ?> class="button">Edit</a>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>

                    <?php elseif ($heading == "provider_service" && !isset($id)): ?>
                        <div class="admin-crud-container">
                            <div class="crud-row crud-row-head grid">
                                <p>UID</p>
                                <p>First Name</p>
                                <p>Last Name</p>
                                <p>PSID</p>
                                <p>Provider Service Name</p>
                                <p>Location</p>
                            </div>
                            <?php while ($row = mysqli_fetch_assoc($allProviders)): ?>
                                <div class="crud-row grid">
                                    <p><?= $row["UID"] ?></p>
                                    <p><?= $row["First_Name"] ?></p>
                                    <p><?= $row["Last_Name"] ?></p>
                                    <p><?= $row["PSID"] ?></p>
                                    <p><?= $row["Name_Of_Service"] ?></p>
                                    <p><?= $row["Location"] ?></p>
                                    <div class="buttons-row">
                                        <a href=<?= "./add-provider-service.php?psid=" . $row["PSID"]; ?> class="button">Edit</a>
                                        <a href=<?= "./delete-sp.php?psid=" . $row["PSID"]; ?> class="button">Delete</a>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</body>

</html>