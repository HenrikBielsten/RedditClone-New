<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';

// If user votes up we fetch data to be used in later checks
if (isset($_POST['post_id'])) {
  $user_id = $_SESSION['user']['id'];
  $post_id = (int)$_POST['post_id'];
  $vote_dir = (int)$_POST['vote_dir'];

  $hasVotedQuery = 'SELECT user_id, vote_dir, post_id FROM votes WHERE user_id=:user_id AND post_id=:post_id';

  $hasVotedStatement = $pdo->prepare($hasVotedQuery);

  $hasVotedStatement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $hasVotedStatement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
  $hasVotedStatement->execute();

  $voted = $hasVotedStatement->fetch(PDO::FETCH_ASSOC);

  // If user has not voted previously: insert new vote
  if (!$voted) {

    $query = 'INSERT INTO votes (user_id, post_id, vote_dir) VALUES (:user_id, :post_id, :vote_dir)';

    $statement = $pdo->prepare($query);

    $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->bindParam(':vote_dir', $vote_dir, PDO::PARAM_INT);
    $statement->execute();

    header("content-type: application/json");
    echo json_encode($user_id);
  }

  // If user has voted previously: update vote
  elseif (isset($voted['vote_dir']) && (int)$voted['vote_dir'] !== $vote_dir) {

    $query = 'UPDATE votes SET vote_dir = :vote_dir WHERE user_id = :user_id AND post_id = :post_id';

    $statement = $pdo->prepare($query);

    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->bindParam(':vote_dir', $vote_dir, PDO::PARAM_INT);
    $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement->execute();

    header("content-type: application/json");
    echo json_encode($user_id);
  }

  // If user has voted same direction as now clicked: set vote to 0, i.e not counted
  if ((int)$voted['vote_dir'] === $vote_dir) {

    $query = 'UPDATE votes SET vote_dir = 0 WHERE user_id = :user_id AND post_id = :post_id';

    $statement = $pdo->prepare($query);

    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement->execute();

    header("content-type: application/json");
    echo json_encode($user_id);
  }
}
