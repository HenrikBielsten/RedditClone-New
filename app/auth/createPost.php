<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

$id = (int)$_SESSION['user']['id'];

if (isset($_POST['title'], $_POST['description'], $_POST['url'])) {
  $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
  $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
  $url = filter_var($_POST['url'], FILTER_SANITIZE_STRING);
  $posttime = date("d-m-Y, H:i");


  $query = 'INSERT INTO posts (user_id, title, description, url, posttime)
            VALUES (:id, :title, :description, :url, :posttime)';

  $statement = $pdo->prepare($query);

  $statement->bindParam(':title', $title, PDO::PARAM_STR);
  $statement->bindParam(':description', $description, PDO::PARAM_STR);
  $statement->bindParam(':url', $url, PDO::PARAM_STR);
  $statement->bindParam(':id', $id, PDO::PARAM_INT);
  $statement->bindParam(':posttime', $posttime, PDO::PARAM_STR);
  $statement->execute();

  redirect('/../../index.php');

};
