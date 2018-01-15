<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

$post_id = $_GET['id'];

$query = "SELECT * FROM posts WHERE post_id = :post_id";

$statement = $pdo->prepare($query);
$statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
$statement->execute();

$post = $statement->fetch(PDO::FETCH_ASSOC);

if (isset($_SESSION['user']) && $post['user_id'] === $_SESSION['user']['id']) {
  redirect("/../../pages/editPostForm.php?id=$post_id");
} else {
  redirect("../../index.php");
}
?>
