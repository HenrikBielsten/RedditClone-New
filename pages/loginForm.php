<?php

declare(strict_types=1);
require __DIR__.'../../views/header.php';


?>

<article>
  <h1>Login</h1>

  <form action="../app/auth/login.php" method="post">
    <div class="form-group">
      <label for="email">Username</label>
      <input class="form-control" type="text" name="username" placeholder="Awesome_Username88" required>
      <small class="form-text text-muted">What's your username?</small>
    </div><!-- /form-group -->

    <div class="form-group">
      <label for="password">Password</label>
      <input class="form-control" type="password" name="password" placeholder="********" required>
      <small class="form-text text-muted">Please provide your password</small>
    </div><!-- /form-group -->

    <button type="submit" class="btn btn-sm btn-outline-primary">Login</button>
  
  </form>

  <br>

  <a href="createForm.php"><button type="button" class="btn btn-sm btn-outline-success">Create New Account</button></a>
</article>

<?php require __DIR__.'../../views/footer.php'; ?>
