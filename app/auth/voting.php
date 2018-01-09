<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['up'])) {
  $user_id = $_SESSION['user']['id'];
  $post_id = (int)$_POST['up'];
  $vote_dir = (int)$_POST['dir'];

  $query = 'INSERT INTO votes (user_id, vote_dir, post_id) VALUES (:user_id, :vote_dir, :post_id)';

  $statement = $pdo->prepare($query);

  $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
  $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $statement->bindParam(':vote_dir', $vote_dir, PDO::PARAM_INT);

  $statement->execute();

}


// $query = 'UPDATE votes SET vote_dir = :vote_dir WHERE post_id = :post_id AND user_id = :user_id';
