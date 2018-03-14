<?php

/*
 * This file is part of Yrgo.
 * (c) Yrgo, högre yrkesutbildning.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);
require __DIR__.'/../autoload.php';

// Get sum of votes for the post connected to clicked vote button

$post_id = (int)$_POST['post_id'];

$sumQuery = "SELECT sum(vote_dir) AS sum FROM votes WHERE post_id = :post_id";

$sumStatement = $pdo->prepare($sumQuery);
$sumStatement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
$sumStatement->execute();

$sumReturn = $sumStatement->fetch(PDO::FETCH_ASSOC);

echo json_encode($sumReturn);
