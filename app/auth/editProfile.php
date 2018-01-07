<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

$id = (int)$_SESSION['user']['id'];

// CHANGES THE NAME, USERNAME, EMAIL AND BIOGRAPHY
// if (isset($_POST['name'], $_POST['username'], $_POST['email'], $_POST['biography'])) {
//   $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
//   $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
//   $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
//   $biography = filter_var($_POST['biography'], FILTER_SANITIZE_STRING);
//
//   $query = 'UPDATE users SET name = :name, username = :username, email = :email, biography = :biography WHERE id = :id';
//
//   $statement = $pdo->prepare($query);
//
//   $statement->bindParam(':name', $name, PDO::PARAM_STR);
//   $statement->bindParam(':username', $username, PDO::PARAM_STR);
//   $statement->bindParam(':email', $email, PDO::PARAM_STR);
//   $statement->bindParam(':biography', $biography, PDO::PARAM_STR);
//   $statement->bindParam(':id', $id, PDO::PARAM_INT);
//
//   $statement->execute();
//
//   redirect('../../pages/profile.php');
//
// }
//
// if (password_verify($password, $user["password"])) {
// }



// CHANGE PASSWORD
if (isset($_POST['newPassword'])) {

  $currentPassword = $_POST['currentPassword'];

  $passwordQuery = 'SELECT * FROM users WHERE id = :id';

  $statement = $pdo->prepare($passwordQuery);

  $statement->bindParam(':id', $id, PDO::PARAM_INT);
  $statement->execute();

  $user = $statement->fetch(PDO::FETCH_ASSOC);

  if (password_verify($currentPassword, $user['password'])) {

    $newPassword = filter_var($_POST['newPassword']);

    $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);

    $updateQuery = 'UPDATE users SET password = :password WHERE id = :id';

    $updateStatement = $pdo->prepare($updateQuery);

    $statement->bindParam(':password', $hashed_password, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();

    redirect('../../pages/profile.php');

  }

};

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
