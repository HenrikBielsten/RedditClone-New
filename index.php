<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';
?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>This is the home page.</p>
</article>

<?php $posts = postInfo($pdo); ?>

<?php foreach ($posts as $post): ?>

<div class="row">
<article class="col-md-6">

<div class="card">
  <h3 class="card-header"><?php echo $post['title']; ?></h3>
  <div class="card-body d-flex flex-column">
    <a class="card-text" href="<?php echo $post['url']; ?>" target="_blank"><?php echo $post['description']; ?></a>

    <img class="postPic" src="
    <?php if(isset($post['img'])): ?>
      <?php echo "../images/".$post['img']; ?>
    <?php else: echo "../images/barack.jpg";?>
    <?php endif; ?>" alt="">
    <div class="d-flex justify-content-between align-items-end">
      <small class="">Posted by: <?php echo $post['username']; ?></small>


      <small class="text-muted"><?php echo $post['posttime'] ?></small>
    </div>
  </div>
</div>


</article>
</div>

<?php endforeach; ?>

<?php require __DIR__.'/views/footer.php'; ?>
