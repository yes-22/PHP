<?php
session_start();

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("Location: login.php");
    exit(); 
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $con = mysqli_connect("localhost", "root", "ah02204703!", "book") or die ("Can't access DB");
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];
    $day = date('Y-m-d H:i:s');
    $query = "INSERT INTO review (title, author, day, user, content) VALUES ('$title', '$author', '$day', '$user_id', '$content')";
    $result = mysqli_query($con, $query);
    mysqli_close($con);

    if($result) {
        echo "<script>alert('작성하신 리뷰가 등록되었습니다.');</script>";
        echo "<script>window.location.href = 'main.php';</script>";
    } else {
        echo "<script>alert('리뷰 등록에 실패했습니다.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>리뷰 작성</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
        }

        input,
        button {
            font-family: inherit;
            font-size: inherit;
        }
    </style>
</head>

<body>
    <div id="board_write">
        <h1>리뷰 작성</h1>
        <div id="write_area">
            <form action="" method="post">
                <div id="in_title">
                    <input type="text" name="title" id="utitle" placeholder="제목" maxlength="100" required>
                </div>
                <div class="wi_line"></div>
                <div id="in_author">
                    <input type="text" name="author" id="uauthor" placeholder="작가" maxlength="100" required>
                </div>
                <div class="wi_line"></div>
                <div id="in_content">
                    <textarea name="content" id="ucontent" placeholder="내용" required></textarea>
                </div>
                <div class="bt_se">
                    <button type="submit">글 작성</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
