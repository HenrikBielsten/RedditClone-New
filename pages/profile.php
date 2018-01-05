<?php
declare(strict_types=1);
require __DIR__.'../../views/header.php';
?>

<div class="container">
  <div class="row">
    <div class="col-md-12">

      <article class="">

        <?php $infos = userInfo($pdo)?>

        <?php foreach ($infos as $info): ?>

          <!-- If no image exists, use default image -->
          <img class="profilePic" src="
          <?php if(isset($info['img'])): ?>
            <?php echo "../images/".$info['img']; ?>
          <?php else: echo "../images/noimage.png";?>
          <?php endif; ?>" alt="">

          <h1><?php echo $info['name'];?></h1>
          <h5><?php echo $info['username'];?></h4>
          <p><?php echo $info['biography'];?></p>
          <p class="p-cursive">Email: <?php echo $info['email'];?></p>

        <?php endforeach; ?>

      </article>
    </div>

  </div>

</div>






<?php require __DIR__.'../../views/footer.php'; ?>
