<?php
// 세션을 시작합니다.
session_start();

// 모든 세션 변수를 삭제합니다.
$_SESSION = array();

// 세션 쿠키를 삭제합니다. (세션 아이디만 삭제됩니다)
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// 세션을 파괴합니다.
session_destroy();

// 로그인 페이지로 리디렉션합니다.
header("Location: main.php");
exit();
?>
