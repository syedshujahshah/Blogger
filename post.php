<?php require 'db.php';
$id = $_GET['id'] ?? exit('No post ID');
$stmt = $pdo->prepare("SELECT p.*,u.display_name FROM posts p JOIN users u ON p.user_id=u.id WHERE p.id=?");
$stmt->execute([$id]); $post = $stmt->fetch() ?: exit('Post not found');
$coms = $pdo->prepare("SELECT * FROM comments WHERE post_id=? ORDER BY created_at"); $coms->execute([$id]);
?>
<!DOCTYPE html><html><head><style>
body{font:16px Arial;padding:20px;max-width:800px;margin:auto;}
.comment{border-top:1px solid #ddd;padding:10px 0;}
textarea{width:100%;height:80px;padding:8px;border:1px solid #ccc;border-radius:4px;}
.button{background:#28a745;color:#fff;padding:6px 12px;border:none;border-radius:4px;cursor:pointer;}
</style></head><body>
<h1><?= htmlspecialchars($post['title']) ?></h1>
<p><em><?= $post['category'] ?></em> by <?= htmlspecialchars($post['display_name']) ?> on <?= $post['created_at'] ?></p>
<div><?= nl2br(htmlspecialchars($post['content'])) ?></div>
<p><a href="create.php?id=<?= $id ?>" class="button">Edit Post</a> <a href="index.php" class="button" style="background:#6c757d">Back</a></p>
<h2>Comments</h2>
<?php foreach($coms as $c): ?>
  <div class="comment"><strong><?= htmlspecialchars($c['author']) ?></strong> (<?= $c['created_at'] ?>)
    <p><?= nl2br(htmlspecialchars($c['content'])) ?></p>
  </div>
<?php endforeach; ?>
<form method="post" action="comment.php">
  <input type="hidden" name="post_id" value="<?= $id ?>">
  Name:<input name="author" required placeholder="Your name"><br>
  <textarea name="content" required placeholder="Your comment"></textarea><br>
  <button class="button">Submit Comment</button>
</form>
</body></html>
