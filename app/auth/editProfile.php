<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

$id = (int)$_SESSION['user']['id'];

if (isset($_FILES['img'])) {
  $path = pathinfo($_FILES['img']['name']);
  $extension = $path['extension'];
  $fileName = $_SESSION['user']['username'].'.'.$extension;

  $img = filter_var($fileName, FILTER_SANITIZE_STRING);

  $imgQuery = 'UPDATE users SET img = :img WHERE id = :id';

  $imgStatement = $pdo->prepare($imgQuery);

  $imgStatement->bindParam(':img', $img, PDO::PARAM_STR);
  $imgStatement->bindParam(':id', $id, PDO::PARAM_INT);
  $imgStatement->execute();

  move_uploaded_file($_FILES['img']['tmp_name'], __DIR__.'/../../images/'.$fileName);
}

// // CHANGES THE NAME, USERNAME, EMAIL AND BIOGRAPHY
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
// }
//
// // CHANGE PASSWORD
// if (isset($_POST['newPassword'])) {
//
//   $currentPassword = $_POST['currentPassword'];
//
//   $passwordQuery = 'SELECT * FROM users WHERE id = :id';
//
//   $passwordStatement = $pdo->prepare($passwordQuery);
//
//   $passwordStatement->bindParam(':id', $id, PDO::PARAM_INT);
//   $passwordStatement->execute();
//
//   $user = $passwordStatement->fetch(PDO::FETCH_ASSOC);
//
//   if (password_verify($currentPassword, $user['password'])) {
//
//     $newPassword = filter_var($_POST['newPassword']);
//
//     $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
//
//     $updateQuery = 'UPDATE users SET password = :password WHERE id = :id';
//
//     $updateStatement = $pdo->prepare($updateQuery);
//
//     $updateStatement->bindParam(':password', $hashed_password, PDO::PARAM_STR);
//     $updateStatement->bindParam(':id', $id, PDO::PARAM_INT);
//
//     $updateStatement->execute();
//   }
// }

redirect('../../pages/profile.php');
