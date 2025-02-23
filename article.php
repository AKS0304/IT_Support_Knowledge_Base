<?php
// article.php
include 'database.php';

if (!isset($_GET['id'])) {
    die("Article ID is missing.");
}

$id = intval($_GET['id']);
$stmt = $pdo->prepare("SELECT title, content FROM articles WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    die("Article not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['title']); ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1><?php echo htmlspecialchars($article['title']); ?></h1>
    </header>
    <main>
        <article>
            <p><?php echo nl2br(htmlspecialchars($article['content'])); ?></p>
        </article>
        <a href="index.php" class="back-link">← Back to Home</a>
    </main>
    
    <footer>
        <p>Designed by Amit, all rights reserved 2024.</p>
    </footer>
</body>
</html>
