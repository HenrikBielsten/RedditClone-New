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

// Function to fetch info about the currently logged in user
function userInfo($pdo) {
  $id = (int)$_SESSION['user']['id'];
  $userQuery = "SELECT * FROM users WHERE id = :id";

  $userStatement = $pdo->prepare($userQuery);
  $userStatement->bindParam(':id', $id, PDO::PARAM_INT);
  $userStatement->execute();

  $userReturn = $userStatement->fetchAll(PDO::FETCH_ASSOC);

  return $userReturn;
}

// Fetches database info for the posts
function postInfo($pdo) {
  $postQuery = 'SELECT * FROM posts AND SELECT * FROM users ORDER BY post_id DESC';

  $postStatement = $pdo->prepare($postQuery);
  $postStatement->execute();

  $postReturn = $postStatement->fetchAll(PDO::FETCH_ASSOC);

  return $postReturn;
}
