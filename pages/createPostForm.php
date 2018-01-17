<?php
declare(strict_types=1);
require __DIR__.'../../views/header.php';
?>

<?php if (isset($_SESSION['user'])): ?>

  <div class="row">
    <div class="col-md-12 d-flex justify-content-center mt-5">

<article class="">

  <h2>Create Post</h2>

  <form action="../app/auth/createPost.php" method="post">

    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" name="title" maxlength="40" required>
      <small class="form-text text-muted">Title can be a maximum of 40 characters</small>
    </div>

    <div class="form-group">
      <label for="description">Description</label>
      <textarea class="form-control noresize" name="description" rows="3" maxlength="110" required></textarea>
      <small class="form-text text-muted">Description can be a maximum of 100 characters</small>
    </div>

    <div class="form-group">
      <label for="url">Link/URL</label>
      <input type="url" class="form-control" name="url" required>
      <small class="form-text text-muted">Add a link</small>
    </div>

    <button type="submit" class="btn btn-outline-success">Submit Post</button>

  </form>
  
</article>

    </div>
  </div>



<?php endif; ?>


<?php require __DIR__.'../../views/footer.php'; ?>
