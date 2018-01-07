<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><?php echo $config['title']; ?></a>

  <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" href="/../index.php">Home</a>
      </li><!-- /nav-item -->

      <li class="nav-item">
          <a class="nav-link" href="/../pages/about.php">About</a>
      </li><!-- /nav-item -->

      <?php if (!isset($_SESSION['user'])): ?>

      <li class="nav-item">
          <a class="nav-link" href="/../pages/loginForm.php">Login</a>
      </li><!-- /nav-item -->

      <?php endif; ?>

      <?php if (isset($_SESSION['user'])): ?>

      <li class="nav-item">
          <a class="nav-link" href="/../app/auth/logout.php">Logout</a>
      </li><!-- /nav-item -->

      <li class="nav-item">
          <a class="nav-link" href="/../pages/profile.php">Profile</a>
      </li><!-- /nav-item -->

      <?php endif; ?>

  </ul><!-- /navbar-nav -->
</nav><!-- /navbar -->
