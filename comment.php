<?php require 'db.php';
$post_id = $_POST['post_id'];
$author = strip_tags($_POST['author']);
$content = strip_tags($_POST['content']);
$stmt = $pdo->prepare("INSERT INTO comments(post_id,author,content) VALUES(?,?,?)");
$stmt->execute([$post_id,$author,$content]);
echo "<script>window.location='post.php?id=$post_id'</script>";
