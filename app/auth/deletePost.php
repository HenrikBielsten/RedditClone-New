<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

  $post_id = $_GET['id'];

  $query = 'DELETE FROM posts WHERE post_id = :post_id';

  $statement = $pdo->prepare($query);
  $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
  $statement->execute();

  redirect("../../index.php");
