<a href="<?= "./?q=" . $row["CID"] ?>" id="cat" class="category <?= isset($categoryActive) ? $categoryActive : '' ?>">
  <img src=<?= "https://source.unsplash.com/1600x900/?" . $row["Category_Type"] ?> alt=<?= $row["Category_Type"] ?> />
  <i class="fa-solid fa-gear"></i>
  <div class="gradient" aria-label="background"></div>
  <span><?= $row["Category_Type"] ?></span>
</a>