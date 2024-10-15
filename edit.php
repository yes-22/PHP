<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
if(isset($_GET['id'])) {
    $post_id = $_GET['id'];
} else {
    header("Location: main.php");
    exit();
}

$con = mysqli_connect("localhost", "root", "ah02204703!", "book") or die ("Can't access DB");
$query = "SELECT * FROM review WHERE id = $post_id";
$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) > 0) {
    $post = mysqli_fetch_assoc($result);
} else {
    header("Location: main.php");
    exit();
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시물 수정</title>
</head>
<body>
    <h1>게시물 수정</h1>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
        <label for="title">제목:</label><br>
        <input type="text" id="title" name="title" value="<?php echo $post['title']; ?>"><br>
        <label for="author">작가:</label><br>
        <input type="text" id="author" name="author" value="<?php echo $post['author']; ?>"><br>
        <label for="content">내용:</label><br>
        <textarea id="content" name="content"><?php echo $post['content']; ?></textarea><br>
        <input type="submit" value="수정">
    </form>
</body>
</html>
