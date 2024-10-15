<?php 
$name = $_POST['name'];
$user = $_POST['user'];
$password = $_POST['pw'];

$con = mysqli_connect("localhost", "root", "ah02204703!", "book") or die ("Can't access DB");

$query = "INSERT INTO signup (name, user, password) VALUES ('$name', '$user', '$password')";
$result = mysqli_query($con, $query);

if (!$result) { ?>
    <script> alert('회원가입에 실패했습니다.\n다시 시도해 주세요.'); location.main=".."; </script>
<?php } else { ?>
    <script> alert('회원가입이 완료되었습니다.'); window.location.href = 'main.php';</script> 
<?php } ?>



<?php mysqli_close($con); ?>
