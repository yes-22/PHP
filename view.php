<?php
session_start();

$con = mysqli_connect("localhost", "root", "ah02204703!", "book") or die ("Can't access DB");

if(isset($_GET['id'])) {
    $post_id = $_GET['id'];
} else {
    header("Location: main.php");
    exit();
}

$query = "SELECT * FROM review WHERE id = $post_id";
$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) > 0) {
    $post = mysqli_fetch_assoc($result);
} else {
    header("Location: main.php");
    exit();
}

// 조회수 업데이트 쿼리 실행
$hit = "UPDATE review SET hit = hit + 1 WHERE id = $post_id";
mysqli_query($con, $hit);

mysqli_close($con);
?>


<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title><?php echo $post['title']; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        nav {
            text-align: right;
            margin-top: 10px;
            padding: 10px;
        }

        nav button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 5px 10px;
            margin-left: 5px;
            cursor: pointer;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 10px;
        }

        .content-box {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .btn-group {
            margin-top: 20px;
        }

        .btn-group button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 8px 16px;
            margin-right: 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-group button:hover {
            background-color: #555;
        }

        a {
            color: #333;
            text-decoration: none;
        }

        /* 글씨 볼드체 스타일 */
        .bold-text {
            font-weight: bold;
        }

        /* 메인 페이지 버튼 스타일 */
        .main-page-btn {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1><?php echo $post['title']; ?></h1>
    <p><span class="bold-text">작성자:</span> <?php echo $post['user']; ?></p>
    <p> <span class="bold-text">작성 일자:</span> <?php echo $post['day']; ?></p>
    <p><span class="bold-text">내용</span> <br><br><?php echo $post['content']; ?></p>

    <br>

    <a href="main.php" class="main-page-btn">메인 페이지</a>
    <nav>
    <div class="btn-group">
            <form action="edit.php" method="GET" style="display: inline;">
                <input type="hidden" name="id" value="<?php echo $post_id; ?>">
                <button type="submit">글 수정</button>
            </form>
            <form action="delete.php" method="POST" style="display: inline;">
                <input type="hidden" name="id" value="<?php echo $post_id; ?>">
                <button type="submit">글 삭제</button>
            </form>
        </div>
    </nav>

</body>

</html>
