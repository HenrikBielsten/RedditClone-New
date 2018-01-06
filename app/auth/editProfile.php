<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

$id = (int)$_SESSION['user']['id'];

// CHANGES THE NAME
if (isset($_POST['name'], $_POST['username'], $_POST['email'], $_POST['biography'])) {
  $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
  $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $biography = filter_var($_POST['biography'], FILTER_SANITIZE_STRING);

  $query = 'UPDATE users SET name = :name, username = :username, email = :email, biography = :biography WHERE id = :id';

  $statement = $pdo->prepare($query);

  $statement->bindParam(':name', $name, PDO::PARAM_STR);
  $statement->bindParam(':username', $username, PDO::PARAM_STR);
  $statement->bindParam(':email', $email, PDO::PARAM_STR);
  $statement->bindParam(':biography', $biography, PDO::PARAM_STR);
  $statement->bindParam(':id', $id, PDO::PARAM_INT);

  $statement->execute();

  redirect('../../pages/profile.php');

}

// // CHANGES THE NAME
// if (isset($_POST['name'])) {
//   $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
//
//   $nameQuery = 'UPDATE users SET name = :name WHERE id = :id';
//
//   $nameStatement = $pdo->prepare($nameQuery);
//
//   $nameStatement->bindParam(':name', $name, PDO::PARAM_STR);
//   $nameStatement->bindParam(':id', $id, PDO::PARAM_INT);
//
//   $nameStatement->execute();
//
//   redirect('../../pages/profile.php');
//
// }

// // CHANGES THE USERNAME
// if (isset($_POST['username'])) {
//   $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
//
//   $usernameQuery = 'UPDATE users SET username = :username WHERE id = :id';
//
//   $usernameStatement = $pdo->prepare($usernameQuery);
//
//   $usernameStatement->bindParam(':username', $username, PDO::PARAM_STR);
//   $usernameStatement->bindParam(':id', $id, PDO::PARAM_INT);
//
//   $usernameStatement->execute();
//
//   redirect('../../pages/profile.php');
//
// }
