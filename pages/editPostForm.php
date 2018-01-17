<?php
declare(strict_types=1);

require __DIR__.'../../views/header.php';

$post_id = $_GET['id'];

$query = "SELECT * FROM posts WHERE post_id = :post_id";

$statement = $pdo->prepare($query);
$statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
$statement->execute();

$post = $statement->fetch(PDO::FETCH_ASSOC);

?>

<?php if (isset($_SESSION['user'])): ?>

  <div class="row">
    <div class="col-md-12 d-flex justify-content-center mt-5">

<article class="">

  <h2>Edit Post</h2>

  <form action="../app/auth/editPost.php?id=<?php echo $post_id?>" method="post">

    <div class="form-group">
      <label for="title">Edit Title</label>
      <input type="text" class="form-control" name="title" maxlength="40" value="<?= $post['title']; ?>" required>
      <small class="form-text text-muted">Title can be a maximum of 40 characters</small>
    </div>

    <div class="form-group">
      <label for="description">Edit Description</label>
      <textarea class="form-control noresize" name="description"rows="3" maxlength="100" required><?= $post['description']; ?></textarea>
      <small class="form-text text-muted">Description can be a maximum of 100 characters</small>
    </div>

    <div class="form-group">
      <label for="url">Edit Link/URL</label>
      <input type="url" class="form-control" name="url" value="<?= $post['url']; ?>" required>
      <small class="form-text text-muted">Add a link</small>
    </div>

    <button type="submit" class="btn btn-outline-success">Save Changes</button>

  </form>

</article>

</div>
</div>


<?php endif; ?>


<?php require __DIR__.'../../views/footer.php'; ?>
