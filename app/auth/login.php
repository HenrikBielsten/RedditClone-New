<?php

/*
 * This file is part of Yrgo.
 * (c) Yrgo, högre yrkesutbildning.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['username'], $_POST['password'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = $_POST['password'];

    $statement = $pdo->prepare('SELECT * FROM users WHERE username= :username');
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        redirect('/../../pages/loginForm.php');
    }

    if (password_verify($password, $user["password"])) {
        unset($user['password']);
        $_SESSION['user'] = $user;
        redirect('../../pages/profile.php');
    } else {
        redirect('../../pages/loginForm.php');
    }
}
