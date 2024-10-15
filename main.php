<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Book Review</title>
    <style>
        h1 {
            text-align: center;
            border-bottom: 2px solid gray;
        }

        table {
            width: 100%;
            border: 1px solid #444444;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #444444;
            text-align: center;
        }

        nav {
            text-align: right;
            margin-top: 10px;
        }

        nav button {
            margin-left: 5px;
        }

        a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>
<h1>Book Review</h1>
<nav>
    <?php
    // 세션 시작
    session_start();

    // 로그인 여부 확인
    if (isset($_SESSION['user_id'])) {
        echo '<button onclick="location.href=\'logout.php\'">로그아웃</button>';
    } else {
        echo '<button onclick="location.href=\'login.php\'">로그인</button>';
        echo '<button onclick="location.href=\'signup.php\'">회원가입</button>';
    }
    ?>
</nav>
<ol>
    <li>리뷰 목록</li>
    <li>이번 주 인기글</li>
</ol>
<br>
<table>
    <thead>
    <tr>
        <td width="50">번호</td>
        <td width="500">제목</td>
        <td width="100">작성자</td>
        <td width="200">날짜</td>
        <td width="50">조회수</td>
    </tr>
    </thead>
    <tbody>
    <?php
    // 데이터베이스 연결
    $con = mysqli_connect("localhost", "root", "ah02204703!", "book") or die ("Can't access DB");

    // 리뷰 정보 가져오는 쿼리
    $query = "SELECT * FROM review";
    $result = mysqli_query($con, $query);

    // 리뷰 테이블에 각각의 행으로 표시
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        // 게시물 제목에 링크 추가
        echo "<td><a href='view.php?id={$row['id']}'>{$row['title']}</a></td>";
        echo "<td>{$row['user']}</td>";
        echo "<td>{$row['day']}</td>";
        echo "<td>{$row['hit']}</td>";
        echo "</tr>";
    }

    // 데이터베이스 연결 종료
    mysqli_close($con);
    ?>
    </tbody>
</table>
<nav>
    <button onclick="location.href='write.php'">글쓰기</button>
</nav>
</body>
</html>
