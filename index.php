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

<article class="">

  <h3><?php echo $post['title']; ?></h3>
  <a href="<?php echo $post['url']; ?>" target="_blank"><?php echo $post['description']; ?></a>
  <p>Posted by: <?php echo $post['name']; ?></p>

</article>

<?php endforeach; ?>

<?php require __DIR__.'/views/footer.php'; ?>
