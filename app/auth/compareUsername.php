<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';

$name = $_GET['username'];

$searchUser = "SELECT username FROM users
               WHERE username= :username";

$statement = $pdo->prepare($searchUser);

$statement->bindParam(':username', $name, PDO::PARAM_STR);

$statement->execute();

$resultsearchUser = $statement->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($resultsearchUser);
