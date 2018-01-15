<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';
?>

<article class="ml-5 mb-4">

  <article>
    <h1><?php echo $config['title']; ?></h1>
    <p>This is the home page.</p>
  </article>

<!-- Buttons to switch between displaying posts by score or by date posted -->
  <div class="col-md-4 d-flex flex-collumn justify-content-between">
    <a href="indexByDate.php"><button class="sortDate btn btn-info btn-sm" type="button" name="byDate">Sort By Post Date</button></a>
    <a href="index.php"><button class="sortScore btn btn-info btn-sm" type="button" name="byScore">Sort By Score</button></a>

  </div>

</article>

<!-- Fetches data base info on posts -->
<?php $posts = postInfo($pdo); ?>

<!-- Calls sorting function sorting posts by highest score -->
<?php usort($posts, 'sortByScore'); ?>

<?php foreach ($posts as $post): ?>

  <div class="row ml-5">

    <article class="col-md-6 d-flex flex-row">

      <div class="card text-white bg-dark w-75">
        <h3 class="card-header"><?php echo $post['title']; ?></h3>
        <div class="card-body d-flex flex-column">
          <!-- Description is the linked URL -->
          <a class="card-text" href="<?php echo $post['url']; ?>" target="_blank"><?php echo $post['description']; ?></a>

          <!-- Profile pic. If user has no profile pic: use default -->
          <img class="postPic" src="
          <?php if(isset($post['img'])): ?>
            <?php echo "../images/".$post['img']; ?>
          <?php else: echo "../images/noimage.png";?>
          <?php endif; ?>" alt="">

          <!-- Author and Time -->
          <div class="d-flex justify-content-between align-items-end">

            <small class="">Posted by: <a href="/pages/otherUserProfile.php?id=<?php echo $post['user_id'] ?>"><?php echo $post['username']; ?></a></small>
            <small class="text-muted"><?php echo $post['posttime'] ?></small>
          </div> <!-- End Author and Time -->
        </div> <!-- End card-body -->

        <div class="card-footer d-flex justify-content-between align-items-end">
          <?php if (isset($_SESSION['user']) && $post['username'] === $_SESSION['user']['username']): ?>
            <a href="/app/auth/userCheck.php?id=<?php echo $post['post_id'] ?>&page=editPostForm">Edit Post</a>
            <a href="/app/auth/userCheck.php?id=<?php echo $post['post_id'] ?>&page=deletePost">Delete Post</a>
          <?php endif; ?>
        </div> <!-- End Footer -->
      </div> <!-- End card -->

      <!-- Vote section -->
      <div class="voteSection d-flex flex-column justify-content-center pl-3 mb-3">

        <!-- If post is not created by current user: displays up vote button -->
        <?php if (isset($_SESSION['user']) && $post['username'] !== $_SESSION['user']['username']): ?>
        <button class=" upVote btn btn-success btn-sm" type="button" name="up" data-user_id="<?php echo $_SESSION['user']['id']; ?>" data-post_id="<?php echo $post['post_id']; ?>" data-vote_dir="1">Vote Up</button>
        <?php endif; ?>

        <p class="votes m-0">Votes: <?php echo $post['sum']; ?></p> <!-- Shows sum of votes -->

        <!-- If post is not created by current user: displays down vote button -->
        <?php if (isset($_SESSION['user']) && $post['username'] !== $_SESSION['user']['username']): ?>
        <button class="downVote btn btn-danger btn-sm" type="button" name="down" data-user_id="<?php echo $_SESSION['user']['id']; ?>" data-post_id="<?php echo $post['post_id'];?>" data-vote_dir="-1">Vote Down</button>
        <?php endif; ?>
      </div> <!-- End Vote section -->

    </article> <!-- End article -->

  </div> <!-- End Row -->

<?php endforeach; ?>

<?php require __DIR__.'/views/footer.php'; ?>
