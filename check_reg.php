<?php
session_start ();
require_once('db.php');
$status=0;

if (!empty($_POST['login']) && !empty($_POST['password'])) 
{
	$login = $_POST['login'];
	$password = $_POST['password']; 
	if ((mb_strlen($login) < 5) OR (mb_strlen($login) > 10) OR (mb_strlen($password) < 8) OR (mb_strlen($password) > 20))
	{
		$status = 3;
	}
	else 
	{
		$regepx='/([a-zа-яА-Я]+)([0-9]+)|([0-9]+)([a-zа-яА-Я]+)$/ui';
		if ((!preg_match($regepx, $login)))
		{
			$status=4;
		}
		elseif ((!preg_match($regepx, $password)))
		{
			$status=4;
		}
		else
		{
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$user = mysqli_fetch_assoc(mysqli_query( $db_connect ,"SELECT * FROM users WHERE login = '$login'"));
			if (empty($user)) 
			{
				mysqli_query( $db_connect ,"INSERT INTO users ( status, login, pass) VALUES ('user', '{$login}', '{$password}')");
				$_SESSION['auth'] = true;
				$_SESSION['user'] = $login;
				$_SESSION['status'] = 'user';
				$id = mysqli_insert_id($db_connect);
				$_SESSION['id'] = $id;
				$status=1;
			}
			else 
			{
			$status=2;
			}
		}	
	}
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
        <h3>Вы успешно зарегистрированны:</h3><br>
		<form action="loader.php">
			<button type="submit" class="reg-but">Вернуться на главную</button>
		</form>
    </div>
<?php elseif($status==2): ?>
    <div class="reg-div">
        <h3>Такой логин уже занят!</h3><br>
		<form action="loader.php">
			<button type="submit" class="reg-but">Вернуться на главную</button>
		</form>
    </div>
<?php elseif($status==0): ?>
    <div class="reg-div">
        <h3>Логин или пароль не могут быть пустыми!</h3><br>
		<form action="loader.php">
			<button type="submit" class="reg-but">Вернуться на главную</button>
		</form>
    </div>
<?php elseif($status==3): ?>
    <div class="reg-div">
        <h3>Недопустимая длина логина или пароля!</h3><br>
		<form action="loader.php">
			<button type="submit" class="reg-but">Вернуться на главную</button>
		</form>
    </div>
<?php elseif($status==4): ?>
    <div class="reg-div">
        <h3>Логин или пароль должны содержать только цифры и буквы!</h3><br>
		<form action="loader.php">
			<button type="submit" class="reg-but">Вернуться на главную</button>
		</form>
    </div>
<?php endif; ?>


</body>
</html>