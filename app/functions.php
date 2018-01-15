<?php

declare(strict_types=1);

if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path.
     *
     * @param string $path
     *
     * @return void
     */
    function redirect($path)
    {
        header("Location: ${path}");
        exit;
    }
}

// Fetches database info for the currently logged in user
function userInfo($pdo) {
  $id = (int)$_SESSION['user']['id'];

  $userQuery = "SELECT * FROM users WHERE id = :id";

  $userStatement = $pdo->prepare($userQuery);
  $userStatement->bindParam(':id', $id, PDO::PARAM_INT);
  $userStatement->execute();

  $userReturn = $userStatement->fetchAll(PDO::FETCH_ASSOC);

  return $userReturn;
}

// Fetches database info for the posts and also sums up the votes
function postInfo($pdo) {
  $postQuery = "SELECT posts.*, users.*, (SELECT sum(vote_dir) FROM votes WHERE posts.post_id=votes.post_id) AS sum FROM posts JOIN votes ON posts.post_id=votes.post_id JOIN users ON posts.user_id=users.id GROUP BY posts.post_id ORDER BY post_id DESC";

  $postStatement = $pdo->prepare($postQuery);
  $postStatement->execute();

  $postReturn = $postStatement->fetchAll(PDO::FETCH_ASSOC);

  return $postReturn;
}

// Fetches database info on another user than currently logged in
function otherUserInfo($pdo) {
  $id = $_GET['id'];
  $query = "SELECT id, name, username, email, biography, img, stars FROM users WHERE id = :id";

  $statement = $pdo->prepare($query);
  $statement->bindParam(':id', $id, PDO::PARAM_INT);
  $statement->execute();


  $resultQuery = $statement->fetchAll(PDO::FETCH_ASSOC);

  return $resultQuery;
}

// Fetches database info on posts made by a certain user
function otherUserPosts($pdo) {
  $id = $_GET['id'];

  $query = "SELECT posts.*, users.*, (SELECT sum(vote_dir) FROM votes WHERE posts.post_id=votes.post_id) AS sum FROM posts JOIN votes ON posts.post_id=votes.post_id JOIN users ON posts.user_id=users.id WHERE id = :id GROUP BY posts.post_id ORDER BY post_id DESC";

  $statement = $pdo->prepare($query);
  $statement->bindParam(':id', $id, PDO::PARAM_INT);
  $statement->execute();

  $resultQuery = $statement->fetchAll(PDO::FETCH_ASSOC);

  return $resultQuery;
}

// Sorts posts by time they were posted
function sortByDate ($a, $b) {

    return strtotime ($a['posttime']) < strtotime ($b ['posttime']);
}

// Sorts post by their accumulated sum/score
function sortByScore ($a, $b) {

  return $a['sum'] < $b['sum'];
}
