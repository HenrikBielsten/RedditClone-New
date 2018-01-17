<?php
declare(strict_types=1);
require __DIR__.'../../views/header.php';
?>

<div class="row">
  <div class="col-md-12 d-flex justify-content-center mt-5">

<article>

<h1>Edit Profile</h1>

  <?php $infos = userInfo($pdo)?>

  <?php foreach ($infos as $info): ?>

    <img class="profilePic" src="
    <?php if(isset($info['img'])): ?>
      <?php echo "../images/".$info['img']; ?>
    <?php else: echo "../images/noimage.png";?>
    <?php endif; ?>" alt="">

    <form action="/../app/auth/editProfile.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <input class="form-control" type="file" accept=".png, .jpg, .jpeg" name="img">
        <small class="form-text text-muted">Choose your new profile picture</small>
      </div><!-- /form-group -->


      <div class="form-group">
        <label for="name">Name</label>
        <input class="form-control" type="text" name="name" value="<?= $info['name']; ?>" required>
        <small class="form-text text-muted">Enter your new name</small>
      </div><!-- /form-group -->


      <div class="form-group">
        <label for="username">Username</label>
        <input class="form-control" type="text" name="username" value="<?= $info['username']; ?>" required>
        <small class="form-text text-muted">Enter your new username</small>
      </div><!-- /form-group -->


      <div class="form-group">
        <label for="email">Email</label>
        <input class="form-control" type="text" name="email" value="<?= $info['email']; ?>" required>
        <small class="form-text text-muted">Enter your new email</small>
      </div><!-- /form-group -->


      <div class="form-group">
        <label for="biography">Biography</label>
        <textarea class="form-control" name="biography" rows="5" cols="80"><?= $info['biography']; ?></textarea>
        <small class="form-text text-muted">Edit your biography</small>
      </div><!-- /form-group -->

      <h4>Change Password</h4>


      <div class="form-group">
        <label for="currentPassword">Current Password</label>
        <input class="form-control" type="password" name="currentPassword" placeholder="Current password">
        <small class="form-text text-muted">Enter your current password</small>
      </div><!-- /form-group -->


      <div class="form-group">
        <label for="newPassword">Current Password</label>
        <input class="form-control" type="password" name="newPassword" placeholder="New password">
        <small class="form-text text-muted">Choose a new password</small>
      </div><!-- /form-group -->

      <button type="submit" class="btn btn-outline-success btn-sm">Save Changes</button>

    </form>

  <?php endforeach; ?>

  <br>

  <a href="profile.php"><button type="button" class="btn btn-outline-danger btn-sm mb-5">Cancel</button></a>

</form>

</article>

</div>

</div>

<?php require __DIR__.'../../views/footer.php'; ?>
