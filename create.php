<?php require 'db.php';
$id= $_GET['id'] ?? null; $post=['title'=>'','content'=>'','category'=>'Technology'];
if($id){
  $stmt = $pdo->prepare("SELECT * FROM posts WHERE id=?");
  $stmt->execute([$id]); $post = $stmt->fetch();
}
?>
<!DOCTYPE html><html><head><style>
body{font:16px Arial;padding:20px;max-width:600px;margin:auto;}
input, select, textarea{width:100%;padding:8px;margin:8px 0;border:1px solid #ccc;border-radius:4px;}
.button{background:#007bff;color:#fff;padding:8px 16px;text-decoration:none;border:none;border-radius:4px;cursor:pointer;}
</style><script>
function go(url){ window.location = url; }
</script><title><?= $id?'Edit':'Create' ?> Post</title></head><body>
<h1><?= $id?'Edit':'Create' ?> Post</h1>
<form method="post" action="save_post.php">
  <?php if($id): ?><input type="hidden" name="id" value="<?= $id ?>"><?php endif; ?>
  Title:<input name="title" required value="<?= htmlspecialchars($post['title']) ?>">
  Category:<select name="category">
    <?php foreach(['Technology','Lifestyle','Business','Travel'] as $c): ?>
      <option <?= $post['category']==$c?'selected':'' ?>><?= $c ?></option>
    <?php endforeach; ?>
  </select>
  Content:<textarea name="content" rows="10" required><?= htmlspecialchars($post['content']) ?></textarea>
  <button class="button"><?= $id?'Update':'Publish' ?></button>
  <button type="button" class="button" onclick="go('index.php')">Cancel</button>
</form>
</body></html>
