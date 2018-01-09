<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['up'])) {
  $user_id = $_SESSION['user']['id'];
  $post_id = (int)$_POST['up'];
  $vote_dir = (int)$_POST['dir'];

  $hasVotedQuery = 'SELECT user_id, vote_dir, post_id FROM votes
                    WHERE user_id=:user_id AND post_id=:post_id';

  $hasVotedStatement = $pdo->prepare($hasVotedQuery);

  $hasVotedStatement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $hasVotedStatement->bindParam(':post_id', $post_id, PDO::PARAM_INT);

  $hasVotedStatement->execute();

  $voted = $hasVotedStatement->fetch(PDO::FETCH_ASSOC);

  // If user has not voted previously: insert new vote
  if (!$voted) {
    $query = 'INSERT INTO votes (user_id, post_id, vote_dir)
              VALUES (:user_id, :post_id, :vote_dir)';

    $statement = $pdo->prepare($query);

    $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->bindParam(':vote_dir', $vote_dir, PDO::PARAM_INT);

    $statement->execute();
  }

  // If user has voted down previously: update vote
  elseif (isset($resultQuery['vote_dir']) && (int)$resultQuery['vote_dir'] !== $vote_dir) {

    $query = 'UPDATE votes SET vote_dir = :vote_dir WHERE user_id=:user_id AND post_id=:post_id';

    $statement = $pdo->prepare($query);

    if (!$statement) {
      die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
    $statement->bindParam(':vote_dir', $vote_dir, PDO::PARAM_INT);
    $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);

    $statement->execute();


    echo json_encode($id);

  }

  // If user has voted up already: do nothing
  if ((int)$resultQuery['vote_dir'] === $vote_dir) {
  }
}

if (isset($_POST['down'])) {
  $user_id = $_SESSION['user']['id'];
  $post_id = (int)$_POST['down'];
  $vote_dir = (int)$_POST['dir'];

  $query = 'INSERT INTO votes (user_id, vote_dir, post_id) VALUES (:user_id, :vote_dir, :post_id)';

  $statement = $pdo->prepare($query);

  $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
  $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $statement->bindParam(':vote_dir', $vote_dir, PDO::PARAM_INT);

  $statement->execute();

}


// $query = 'UPDATE votes SET vote_dir = :vote_dir WHERE post_id = :post_id AND user_id = :user_id';
