<?php
session_start();

// 데이터베이스 연결
$con = mysqli_connect("localhost", "root", "ah02204703!", "book") or die ("데이터베이스에 연결할 수 없습니다.");

// 게시물 ID 확인
if(isset($_GET['id'])) {
    $post_id = $_GET['id'];
} else {
    // ID가 없으면 메인 페이지로 리디렉션
    header("Location: main.php");
    exit();
}

// 게시물 정보 가져오기
$query = "SELECT * FROM review WHERE id = $post_id";
$result = mysqli_query($con, $query);

// 게시물 정보 확인
if(mysqli_num_rows($result) > 0) {
    $post = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title><?php echo $post['title']; ?></title>
    <style>
    </style>
</head>

<body>
    <h1><?php echo $post['title']; ?></h1>
    <p>작성자: <?php echo $post['user']; ?></p>
    <p>작성일자: <?php echo $post['day']; ?></p>
    <p>내용: <?php echo $post['content']; ?></p>
    
    <br>
    <a href="main.php">메인 페이지로 돌아가기</a>
    
    <!-- 수정 버튼 -->
    <form action="edit.php" method="GET">
        <input type="hidden" name="id" value="<?php echo $post_id; ?>">
        <button type="submit">글 수정</button>
    </form>
    
    <!-- 삭제 버튼 -->
    <form action="delete.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $post_id; ?>">
        <button type="submit">글 삭제</button>
    </form>
</body>

</html>

<?php
} else {
    // 게시물이 없으면 메인 페이지로 리디렉션
    header("Location: main.php");
    exit();
}

// 데이터베이스 연결 종료
mysqli_close($con);
?>
