<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';
?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>This is the home page.</p>
</article>

<?php $posts = postInfo($pdo); ?>

<?php usort($posts, 'sortByDate'); ?>

<?php foreach ($posts as $post): ?>

  <div class="row">

    <article class="col-md-6">

      <div class="card text-white bg-dark">
        <h3 class="card-header"><?php echo $post['title']; ?></h3>
        <div class="card-body d-flex flex-column">
          <a class="card-text" href="<?php echo $post['url']; ?>" target="_blank"><?php echo $post['description']; ?></a>

          <!-- Profile pic. If user has no profile pic: use default -->
          <img class="postPic" src="
          <?php if(isset($post['img'])): ?>
            <?php echo "../images/".$post['img']; ?>
          <?php else: echo "../images/noimage.png";?>
          <?php endif; ?>" alt="">

          <!-- Author and Time -->
          <div class="d-flex justify-content-between align-items-end">
            <small class="">Posted by: <?php echo $post['username']; ?></small>
            <small class="text-muted"><?php echo $post['posttime'] ?></small>
          </div> <!-- End Author and Time -->

        </div> <!-- End card-body -->

        <div class="card-footer d-flex justify-content-between align-items-end">
          <?php if (isset($_SESSION['user']) && $post['username'] === $_SESSION['user']['username']): ?>
            <a href="/pages/editPostForm.php?id=<?php echo $post['post_id'] ?>">Edit Post</a>
            <a href="/../app/auth/deletePost.php?id=<?php echo $post['post_id'] ?>">Delete Post</a>
          <?php endif; ?>
        </div> <!-- End Footer -->

      </div> <!-- End card -->

    </article> <!-- End article -->

  </div> <!-- End Row -->

<?php endforeach; ?>

<?php require __DIR__.'/views/footer.php'; ?>
