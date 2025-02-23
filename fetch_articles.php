<?php
// fetch_articles.php
include 'database.php';

$query = $pdo->query("SELECT id, title, content FROM articles");
$articles = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($articles);
?>
