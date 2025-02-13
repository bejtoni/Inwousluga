<a href="<?= isset($hrefNone) ? $hrefNone : "./services.php?q=" . $_GET["q"] . "&provider=" . $row["PSID"] ?>">
  <div class="service">
    <div class="service-body">
      <div class="service-icon">
        <i class="fa-regular fa-user"></i>
      </div>
      <div class="service-text">
        <p class="heading-service margin-bottom-xxsm">
          <?= $row["Name_Of_Service"] ?>
        </p>
        <div class="service-property">
          <i class="fa-solid fa-location-dot"></i>
          <span><?= $row["Location"] ?></span>
        </div>
        <div class="service-property">
          <i class="fa-solid fa-tags"></i>
          <span>Fotografija</span>
        </div>
      </div>
    </div>
    <div class="service-bottom">
      <div>DETAILS</div>
      <div class="service-buttons">
        <i class=<?= '"fa-heart icon fa-' . (isset($isLiked) && !$isLiked ? 'regular' : 'solid') . ' regular"' ?>>
        </i>
        <button><i class="fa-regular fa-handshake icon"></i></button>
      </div>
    </div>
  </div>
</a>