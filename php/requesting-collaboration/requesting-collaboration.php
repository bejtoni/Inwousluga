<?php

$reviewSQL = "SELECT Review FROM collaboration WHERE CID = " . $serviceFrom["CID"];
$result = mysqli_query($db, $reviewSQL);
$currentRating = mysqli_fetch_assoc($result)['Review'];

if (isset($_GET['rating'])) {
  $rating = (int) $_GET['rating'];
  $collabId = $_GET['q'];

  $updateSql = "UPDATE collaboration SET Review = $rating WHERE CID = $collabId";
  $result = mysqli_query($db, $updateSql);

  $reviewSQL = "SELECT Review FROM collaboration WHERE CID = " . $serviceFrom["CID"];
  $result = mysqli_query($db, $reviewSQL);
  $currentRating = mysqli_fetch_assoc($result)['Review'];

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['finish-collaboration'])) {
  $collabId = $_POST['finish-collaboration'];

  $updateSql = "UPDATE collaboration SET Status = 'f' WHERE CID = $collabId";
  $result = mysqli_query($db, $updateSql);

}

?>

<div class="current-collaboration">

  <div class="service-icon">
    <i class="fa-regular fa-user"></i>
  </div>

  <p class="heading-service margin-bottom-xxsm">
    <a href="../public/provider-profile.php?q=<?= $serviceFrom["incUID"] ?>">
      <?= $serviceFrom["Name_Of_Service"] . " to " ?>
    </a>
    <span>Me</span>
  </p>

  <div class="current-collaboration-left">

    <div class="service-text">

      <div class="current-collaboraion-info-row">
        <p>Status</p>
        <p><?= $serviceFrom["Status"] == 'a' ? "active" : ($serviceFrom["Status"] == "p" ? "pending" : "finished") ?>
        </p>
      </div>
      <div class="current-collaboraion-info-row">
        <p>Date Started</p>
        <p><?= $serviceFrom["Collaboration_Started"] ?></p>
      </div>
      <div class="current-collaboraion-info-row">
        <p>Date Ended</p>
        <p>
          <?= $serviceFrom["Status"] == 'a' ? "active" : ($serviceFrom["Status"] == "p" ? "pending" : $serviceFrom["Collaboration_Finished"]) ?>
        </p>
      </div>
    </div>

  </div>

  <div class="current-collaboration-right">
    <div>
      <div class="service-property">
        <i class="fa-solid fa-location-dot"></i>
        <span><?= $serviceFrom["Location"] ?></span>
      </div>
      <div class="service-property">
        <i class="fa-solid fa-tags"></i>
        <span><?= $serviceFrom["Service_Name"] ?></span>
      </div>
    </div>
  </div>
  <!-- <?php if ($serviceFrom["Status"] != 'f'): ?>
    <div class="total-rating-container">
      <form method="POST" style="margin-left: auto">
        <input name="finish-collaboration" class="none" value="<?= $serviceFrom["CID"] ?>" />
        <button class="button">Finish Collaboration</button>
      </form>
    </div>
  <?php endif; ?> -->

  <?php if ($serviceFrom["Status"] == 'f'): ?>
    <div class="total-rating-container">
      <span>Total rating:</span>

      <div class="star-rating">

        <div class="star-rating">
          <?php for ($i = 1; $i <= 5; $i++): ?>
            <i class="<?= $i <= $currentRating ? 'fa-solid' : 'fa-regular' ?> fa-star" data-value="<?= $i ?>"
              data-collab-id="<?= $serviceFrom["CID"] ?>"></i>
          <?php endfor; ?>
        </div>
      </div>

    </div>

    <div class="comment-container">

      <?php if (!isset($serviceFrom["Comment"]) || $serviceFrom["Comment"] == null || $serviceFrom["Comment"] == ""): ?>
        <h3>Please leave a comment</h3>
        <form method="POST">
          <textarea class="input-text margin-bottom-xsm" name="comment" placeholder="Comment"></textarea>
          <button type="submit" class="button">Comment</button>
          <input name="collab" value="<?= $serviceFrom["CID"] ?>" class="none" />
        </form>
      <?php endif; ?>

      <?php if (isset($serviceFrom["Comment"]) && $serviceFrom["Comment"] != null && $serviceFrom["Comment"] != ""): ?>
        <h3>Comment</h3>
        <form method="POST">
          <input class="input-text margin-bottom-xsm commented" name="comment" placeholder="Comment"
            value='<?= $serviceFrom["Comment"] ?>'>
          </input>
          <button type="submit" class="button">Edit</button>
          <input name="collab" value="<?= $serviceFrom["CID"] ?>" class="none" />
        </form>
      <?php endif; ?>

    </div>
  <?php endif; ?>

</div>