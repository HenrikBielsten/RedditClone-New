<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

if (isset($_POST['name'])) {
  $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
  $id = (int)$_SESSION['user']['id'];


  $query = 'UPDATE users SET name = :name WHERE id = :id';

  $statement = $pdo->prepare($query);

  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
  }

  $statement->bindParam(':name', $name, PDO::PARAM_STR);
  $statement->bindParam(':id', $id, PDO::PARAM_INT);

  $statement->execute();

  redirect('../../pages/profile.php');

} else {

  redirect('../../pages/about.php');
}
