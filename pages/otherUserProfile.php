<?php
declare(strict_types=1);
require __DIR__.'../../views/header.php';
?>

<?php $infos = otherUserInfo($pdo)?>
<?php $posts = otherUserPosts($pdo)?>
<?php $likeSum = getLikeSum($pdo)?>

<?php

if (isset($_SESSION['user']['id'])) {
  $likeDir = getLikeDirection($pdo);
}

?>

<?php usort($posts, 'sortByScore'); ?>

<div class="row d-flex profile">

  <div class="col-md-6 d-flex flex-column align-items-center">

    <?php foreach ($infos as $info): ?>

      <div class="">

        <!-- If no image exists, use default image -->
        <img class="profilePic" src="
        <?php if(isset($info['img'])): ?>
          <?php echo "../images/".$info['img']; ?>
        <?php else: echo "../images/noimage.png";?>
        <?php endif; ?>" alt="">

      </div>

      <div class="border-primary col-md-8 text-center">
        <h1 class=""><?php echo $info['name'];?></h1>
        <h5 class=""><?php echo $info['username'];?></h5>

        <!-- Displays likes and buttons to like/unlike -->
        <div class="">
          <div class="star d-flex flex-row align-items-center justify-content-center">
            <img src="/../images/star.png" alt="">
            <h5 class="likes mt-4 ml-3"><?php echo $likeSum['sum']; ?></h5>
          </div>

          <!-- If the user is logged in: create like buttons -->
          <?php if (isset($_SESSION['user']['id'])) : ?>

            <button class="like btn btn-success btn-sm" type="button" name="like" data-like_dir="1" data-other_user="<?php echo $info['id']; ?>">Like</button>

            <button class="unlike btn btn-success btn-sm" type="button" name="like" data-like_dir="0" data-other_user="<?php echo $info['id']; ?>">Unlike</button>
          <?php endif; ?>

          <!-- If user has previously liked this user profile or has not voted: show unlike button -->
          <?php if (isset($likeDir['like_dir']) && $likeDir['like_dir'] == 1): ?>
            <script type="text/javascript">
            const likeButton = document.querySelector('.like');
            const unlikeButton = document.querySelector('.unlike');

            likeButton.style.visibility = "hidden";
            unlikeButton.style.visibility = "visible";
            </script>

            <!-- If user not yet liked this user profile: show like button -->
          <?php else: ?>
            <script type="text/javascript">
            const likeButton = document.querySelector('.like');
            const unlikeButton = document.querySelector('.unlike');

            likeButton.style.visibility = "visible";
            unlikeButton.style.visibility = "hidden";
            </script>
          <?php endif; ?>

        </div>
        <br>
        <p class=""><?php echo $info['biography'];?></p>
        <i class="">Email: <?php echo $info['email'];?></i>
      </div>

    <?php endforeach; ?>

  </div>

  <div class="post-container col-md-5">

    <h1><?php echo $info['name']?> Posts</h1>

    <?php foreach ($posts as $post): ?>

      <div class="row">

        <article class="col-md-12 d-flex flex-row">

          <div class="card text-white bg-dark w-100">
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
                <small class="">Posted by: <?php echo $post['username']; ?></small>
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

            <p class="votes m-0" data-post_id_div="<?php echo $post['post_id']; ?>">Votes: <?php echo $post['sum']; ?></p> <!-- Shows sum of votes -->

            <!-- If post is not created by current user: displays down vote button -->
            <?php if (isset($_SESSION['user']) && $post['username'] !== $_SESSION['user']['username']): ?>
              <button class="downVote btn btn-danger btn-sm" type="button" name="down" data-user_id="<?php echo $_SESSION['user']['id']; ?>" data-post_id="<?php echo $post['post_id'];?>" data-vote_dir="-1">Vote Down</button>
            <?php endif; ?>
          </div> <!-- End Vote section -->

        </article> <!-- End article -->

      </div> <!-- End Row -->

    <?php endforeach; ?>

  </div>

</div>

<?php require __DIR__.'../../views/footer.php'; ?>
