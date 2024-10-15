<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];

    $con = mysqli_connect("localhost", "root", "ah02204703!", "book") or die ("Can't access DB");
    $query = "UPDATE review SET title='$title', author='$author', content='$content' WHERE id=$post_id";
    $result = mysqli_query($con, $query);

    mysqli_close($con);
    if($result) {
        echo "<script>alert('게시물이 수정되었습니다.');</script>";
        echo "<script>window.location.href = 'main.php';</script>";
    } else {
        echo "<script>alert('게시물 수정에 실패했습니다.');</script>";
    }
} else {
    header("Location: main.php");
    exit();
}
?>
