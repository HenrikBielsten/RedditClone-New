<?php

declare(strict_types=1);

require __DIR__.'../../views/header.php';

?>

<article>
    <h1>Create Account</h1>

    <form action="../app/auth/create.php" method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" placeholder="Firstname af Lastname" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="username">Username</label> <label class="alreadyExists text-danger small"></label>
            <input class="form-control usernameField" type="text" name="username" placeholder="Awesome_Username90" required>

        </div><!-- /form-group -->

        <div class="form-group">
          <label for="biography">Biography</label>
          <textarea class="form-control" type="text" maxlength="200" name="biography" placeholder="My biography" required></textarea>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" placeholder="my.email@emai.com" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control password" type="password" name="password" placeholder="********" required>
        </div><!-- /form-group -->


        <button type="submit" class="btn btn-primary">Create Account</button>
    </form>

</article>

<?php require __DIR__.'../../views/footer.php'; ?>
