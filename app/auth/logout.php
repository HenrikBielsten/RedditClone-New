<?php

/*
 * This file is part of Yrgo.
 * (c) Yrgo, högre yrkesutbildning.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

require __DIR__.'/../autoload.php';


// Remove the user session variable and redirect the user back to the homepage.
unset($_SESSION['user']);
redirect('/../../index.php');
