<?php require 'db.php';
$id = $_POST['id'] ?? null;
$title = $_POST['title'];
$category = $_POST['category'];
$content = $_POST['content'];
$user_id = 1;
if($id){
  $stmt = $pdo->prepare("UPDATE posts SET title=?,category=?,content=? WHERE id=?");
  $stmt->execute([$title,$category,$content,$id]);
} else {
  $stmt = $pdo->prepare("INSERT INTO posts(user_id,title,category,content) VALUES(?,?,?,?)");
  $stmt->execute([$user_id,$title,$category,$content]);
  $id = $pdo->lastInsertId();
}
echo "<script>window.location='post.php?id=$id'</script>";
