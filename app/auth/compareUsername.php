<?php

/*
 * This file is part of Yrgo.
 * (c) Yrgo, högre yrkesutbildning.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
