<?php
require 'db.php';

// User ke search input ko safely handle karna
$q = trim($_GET['q'] ?? '');

$stmt = $pdo->prepare("
  SELECT p.id, p.title, LEFT(p.content,150) excerpt, u.display_name, p.created_at, p.category
  FROM posts p 
  JOIN users u ON p.user_id = u.id
  WHERE p.title LIKE ? OR p.content LIKE ?
  ORDER BY p.created_at DESC
");

$searchTerm = "%$q%";
$stmt->execute([$searchTerm, $searchTerm]);
$results = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Search Results for "<?= htmlspecialchars($q) ?>"</title>
  <style>
    body{font-family:Arial,sans-serif;max-width:800px;margin:auto;padding:20px;}
    .post{border:1px solid #ccc;padding:15px;margin:15px 0;border-radius:5px;}
    .post h2{margin:0;color:#333;}
    .button{background:#007bff;color:#fff;padding:8px 12px;text-decoration:none;border-radius:4px;}
  </style>
  <script>
    function goTo(url){ window.location = url; }
  </script>
</head>
<body>
  <h1>Search Results for "<?= htmlspecialchars($q) ?>"</h1>
  <p><a class="button" href="index.php">← Back to Home</a></p>

  <?php if (count($results) == 0): ?>
    <p>No blog posts found for "<strong><?= htmlspecialchars($q) ?></strong>".</p>
  <?php endif; ?>

  <?php foreach ($results as $p): ?>
    <div class="post">
      <h2 onclick="goTo('post.php?id=<?= $p['id'] ?>')"><?= htmlspecialchars($p['title']) ?></h2>
      <p><em><?= $p['category'] ?></em> by <?= htmlspecialchars($p['display_name']) ?> on <?= $p['created_at'] ?></p>
      <p><?= htmlspecialchars($p['excerpt']) ?>...</p>
      <a href="post.php?id=<?= $p['id'] ?>">Read More</a>
    </div>
  <?php endforeach; ?>
</body>
</html>
