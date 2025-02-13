<div class="current-collaboration">

  <div class="service-icon">
    <i class="fa-regular fa-user"></i>
  </div>

  <p class="heading-service margin-bottom-xxsm">
    <?= $serviceTo["Name_Of_Service"] . " to " ?> <a
      href="../public/provider-profile.php?q=<?= $serviceTo["incUID"] ?>"><?= $serviceTo["incFname"] ?></a>
  </p>

  <div class="current-collaboration-left">

    <div class="service-text">

      <div class="current-collaboraion-info-row">
        <p>Status</p>
        <p><?= $serviceTo["Status"] == 'a' ? "active" : ($serviceTo["Status"] == "p" ? "pending" : "finished") ?></p>
      </div>
      <div class="current-collaboraion-info-row">
        <p>Date Started</p>
        <p><?= $serviceTo["Collaboration_Started"] ?></p>
      </div>
      <div class="current-collaboraion-info-row">
        <p>Date Ended</p>
        <p>
          <?= $serviceTo["Status"] == 'a' ? "active" : ($serviceTo["Status"] == "p" ? "pending" : $serviceTo["Collaboration_Finished"]) ?>
        </p>
      </div>
    </div>



  </div>

  <div class="current-collaboration-right">
    <div>
      <div class="service-property">
        <i class="fa-solid fa-location-dot"></i>
        <span><?= $serviceTo["Location"] ?></span>
      </div>
      <div class="service-property">
        <i class="fa-solid fa-tags"></i>
        <span><?= $serviceTo["Service_Name"] ?></span>
      </div>
      <?php if ($serviceTo["Status"] != 'f'): ?>
        <a href="../php/finish-collaboration-provider.php?q=<?= $serviceTo["CID"] ?>" class="button">Finish</a>
      <?php endif; ?>
    </div>
  </div>





</div>