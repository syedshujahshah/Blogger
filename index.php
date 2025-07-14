<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<?php require 'db.php'; 
$posts = $pdo->query("
  SELECT p.id, p.title, LEFT(p.content,150) excerpt, u.display_name, p.created_at, p.category 
  FROM posts p JOIN users u ON p.user_id=u.id
  ORDER BY p.created_at DESC
")->fetchAll();
?>
<!DOCTYPE html><html><head><style>
body{font-family:Arial;padding:20px;max-width:800px;margin:auto;}
.post{border:1px solid #ccc;padding:15px;margin-bottom:20px;border-radius:5px;}
.post h2{margin-top:0;color:#333;}
.categories{margin:20px 0;}
.search-bar input{padding:8px;width:100%;border:1px solid #ccc;border-radius:4px;}
.button{background:#28a745;color:#fff;padding:6px 12px;text-decoration:none;border-radius:4px;}
</style><script>
function goPage(url){ window.location = url; }
</script><title>Blogger Clone</title></head><body>
<h1>My Blogger Clone</h1>
<div class="categories">Categories:
  <a href="index.php?cat=Technology">Technology</a> |
  <a href="index.php?cat=Lifestyle">Lifestyle</a> |
  <a href="index.php?cat=Business">Business</a> |
  <a href="index.php?cat=Travel">Travel</a>
</div>
<div class="search-bar"><input placeholder="Search..." oninput="location='?q='+encodeURIComponent(this.value)"></div>
<div style="margin:20px 0;"><a class="button" href="create.php">Create New Post</a></div>
<?php foreach($posts as $p): ?>
  <div class="post">
    <h2 onclick="goPage('post.php?id=<?= $p['id'] ?>')"><?= htmlspecialchars($p['title']) ?></h2>
    <p><em><?= htmlspecialchars($p['category']) ?></em> by <?= htmlspecialchars($p['display_name']) ?> on <?= $p['created_at'] ?></p>
    <p><?= htmlspecialchars($p['excerpt']) ?>…</p>
    <a href="post.php?id=<?= $p['id'] ?>">Read more</a>
  </div>
<?php endforeach; ?>
</body></html>
