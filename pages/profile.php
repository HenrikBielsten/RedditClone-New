<?php
declare(strict_types=1);
require __DIR__.'../../views/header.php';
?>
      <article class="">

        <?php $infos = userInfo($pdo)?>

        <?php foreach ($infos as $info): ?>

          <!-- If no image exists, use default image -->
          <img class="profilePic" src="
          <?php if(isset($info['img'])): ?>
            <?php echo "../images/".$info['img']; ?>
          <?php else: echo "../images/noimage.png";?>
          <?php endif; ?>" alt="">

          <div class="card-body card border-primary col-md-4 text-center">
            <h1 class="card-title"><?php echo $info['name'];?></h1>
            <h5 class="card-subtitle"><?php echo $info['username'];?></h5>
            <br>
              <p class="card-text text-left card bio"><?php echo $info['biography'];?></p>
              <p class="card-text text-left p-cursive">Email: <?php echo $info['email'];?></p>
          </div>

        <?php endforeach; ?>

      </article>

      <br>

      <a href="editProfileForm.php"><button type="button" name="button" class="btn btn-outline-primary btn-sm">Edit Profile</button></a>

<?php require __DIR__.'../../views/footer.php'; ?>
