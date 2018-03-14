<?php

/*
 * This file is part of Yrgo.
 * (c) Yrgo, högre yrkesutbildning.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);
require __DIR__.'/../autoload.php';

// Get sum of likes

$other_user = (int)$_POST['other_user'];

$sumQuery = "SELECT sum(like_dir) AS sum FROM likes WHERE other_user = :other_user";

$sumStatement = $pdo->prepare($sumQuery);
$sumStatement->bindParam(':other_user', $other_user, PDO::PARAM_INT);
$sumStatement->execute();

$sumReturn = $sumStatement->fetch(PDO::FETCH_ASSOC);

echo json_encode($sumReturn);
