<?php
session_start ();
require_once('db.php');
$status=0;
	$login = $_POST['login'];
	
	$query = "SELECT * FROM users WHERE login='$login'"; // получаем юзера по логину
	$result = mysqli_query($db_connect, $query);
	$user = mysqli_fetch_assoc($result);
	
	if (!empty($user)) {
		$hash = $user['pass']; // соленый пароль из БД
		
		// Проверяем соответствие хеша из базы введенному паролю
		if (password_verify($_POST['password'], $hash)) {
			$_SESSION['auth'] = true;
			$_SESSION['user'] = $login;
			$_SESSION['status'] = $user['status'];
			$id = mysqli_insert_id($db_connect);
			$_SESSION['id'] = $id;
			$status=1;
		} else {
			$status=2;
		}
	} else {
		$status=3;
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./reg-style.css" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/tbs" rel="stylesheet">

    <title>Document</title>
</head>
<body> 
<?php if ($status==1): ?>
    <div class="reg-div">
        <h3>Вы успешно вошли:</h3><br>
		<form action="loader.php">
			<button type="submit" class="reg-but">Вернуться на главную</button>
		</form>
    </div>
<?php elseif($status==2): ?>
    <div class="reg-div">
        <h3>Неверный пароль!</h3><br>
		<form action="loader.php">
			<button type="submit" class="reg-but">Вернуться на главную</button>
		</form>
    </div>
<?php elseif($status==3): ?>
    <div class="reg-div">
        <h3>Неверный логин!</h3><br>
		<form action="loader.php">
			<button type="submit" class="reg-but">Вернуться на главную</button>
		</form>
    </div>
<?php endif; ?>
</body>
</html>