<a href="<?= $path ?>" class="service-row">
  <div class="service-row-image">
    <img src=<?= "https://source.unsplash.com/1600x900/?" . $service["Service_Name"] ?> />
    <div class="gradient" aria-label="background"></div>
  </div>
  <div class="service-row-text">
    <h3><?= $service["Service_Name"] ?></h3>
    <p><?= $service["Service_Description"] ?></p>
  </div>
</a>