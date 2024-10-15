<?php
session_start();

// 데이터베이스 연결
$con = mysqli_connect("localhost", "root", "ah02204703!", "book") or die ("Can't access DB");

// 사용자가 제출한 아이디와 비밀번호
$username = $_POST['id'];
$userpass = $_POST['pw'];

// 데이터베이스에서 해당 사용자를 찾는 쿼리
$query = "SELECT * FROM signup WHERE user = '$username' AND password = '$userpass'";
$result = mysqli_query($con, $query);

// 결과가 있을 경우 로그인 성공
if (mysqli_num_rows($result) > 0) {
    // 사용자 정보를 세션에 저장
    $_SESSION['user_id'] = $username;
    
    // 로그인 성공 메시지 출력
    echo "<script>alert('로그인에 성공했습니다.');</script>";
    
    // 로그인 성공 후 이동할 페이지로 리디렉션
    echo "<script>window.location.href = 'main.php';</script>";
} else {
    // 로그인 실패 메시지 출력
    echo "<script>alert('아이디 또는 비밀번호가 잘못되었습니다.');</script>";
    
    // 로그인 페이지로 리디렉션
    echo "<script>window.location.href = 'login.php';</script>";
}

// 데이터베이스 연결 종료
mysqli_close($con);
?>
