<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$con = mysqli_connect("localhost", "root", "ah02204703!", "book") or die ("Can't access DB");

if(isset($_POST['id'])) {
    $post_id = $_POST['id'];
} else {
    header("Location: main.php");
    exit();
}


$query = "DELETE FROM review WHERE id = $post_id";
$result = mysqli_query($con, $query);

if($result) {
    echo "<script>alert('게시물이 삭제되었습니다.');</script>";
    echo "<script>window.location.href = 'main.php';</script>";
    exit();
} else {
    echo "게시물 삭제에 실패했습니다.";
}

mysqli_close($con);
?>
