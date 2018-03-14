<?php

/*
 * This file is part of Yrgo.
 * (c) Yrgo, högre yrkesutbildning.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// If user votes up we fetch data to be used in later checks
if (isset($_POST['like_dir'])) {
    $user_id = $_SESSION['user']['id'];
    $other_user = (int)$_POST['other_user'];
    $like_dir = (int)$_POST['like_dir'];

    $hasLikedQuery = 'SELECT user_id, like_dir, other_user FROM likes WHERE user_id = :user_id AND other_user = :other_user';

    $hasLikedStatement = $pdo->prepare($hasLikedQuery);

    $hasLikedStatement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $hasLikedStatement->bindParam(':other_user', $other_user, PDO::PARAM_INT);
    $hasLikedStatement->execute();

    $liked = $hasLikedStatement->fetch(PDO::FETCH_ASSOC);

    // If user has not liked previously: insert like
    if (!$liked) {
        $query = 'INSERT INTO likes (user_id, other_user, like_dir) VALUES (:user_id, :other_user, :like_dir)';

        $statement = $pdo->prepare($query);

        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindParam(':other_user', $other_user, PDO::PARAM_INT);
        $statement->bindParam(':like_dir', $like_dir, PDO::PARAM_INT);
        $statement->execute();

        header("content-type: application/json");
        echo json_encode($other_user);
    }

    // If user has liked previously: unlike
    elseif (isset($liked['like_dir']) && (int)$liked['like_dir'] !== $like_dir) {
        $query = 'UPDATE likes SET like_dir = :like_dir WHERE user_id = :user_id AND other_user = :other_user';

        $statement = $pdo->prepare($query);

        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindParam(':like_dir', $like_dir, PDO::PARAM_INT);
        $statement->bindParam(':other_user', $other_user, PDO::PARAM_INT);
        $statement->execute();

        header("content-type: application/json");
        echo json_encode($other_user);
    }

    // If user has voted same direction as now clicked: do nothing
    elseif ((int)$liked['like_dir'] === $like_dir) {
        header("content-type: application/json");
        echo json_encode("nothing");
    }
}
