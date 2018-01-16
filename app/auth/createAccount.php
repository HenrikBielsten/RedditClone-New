<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['name'], $_POST['username'], $_POST['email'], $_POST['password'])) {
  $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
  $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $password = filter_var($_POST['password']);
  $biography = filter_var($_POST['biography'], FILTER_SANITIZE_STRING);

  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  $query = 'INSERT INTO users (name, username, email, password, biography) VALUES (:name, :username, :email, :password, :biography)';

  $statement = $pdo->prepare($query);

  $statement->bindParam(':name', $name, PDO::PARAM_STR);
  $statement->bindParam(':username', $username, PDO::PARAM_STR);
  $statement->bindParam(':biography', $biography, PDO::PARAM_STR);
  $statement->bindParam(':email', $email, PDO::PARAM_STR);
  $statement->bindParam(':password', $hashed_password, PDO::PARAM_STR);

  $statement->execute();

  // This fetches the newly created users ID so that we can use it below
  $idQuery = "SELECT id FROM users WHERE username = :username";

  $idStatement = $pdo->prepare($idQuery);

  $idStatement->bindParam(':username', $username, PDO::PARAM_STR);

  $idStatement->execute();

  $result = $idStatement->fetch(PDO::FETCH_ASSOC);

  $user_id = $result['id'];

  // This inserts a new like set to 0. The like is "made by" the newly created user just to make the start value of the likes 0 and not NULL.
  $likeQuery = "INSERT INTO likes (user_id, other_user, like_dir) VALUES (:user_id, :user_id, 0)";

  $likeStatement = $pdo->prepare($likeQuery);

  $likeStatement->bindParam(':user_id', $user_id, PDO::PARAM_INT);

  $likeStatement->execute();

  redirect('../../pages/loginForm.php');

};
