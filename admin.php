<?php
session_start ();
$name = $_SESSION['user'] ?? null;
require_once('db.php');
$sql = "SELECT * FROM users";
$result = mysqli_query($db_connect ,$sql);

if (isset($_GET['del_id'])) 
{
	$del_id=$_GET['del_id'];
	$sql="SELECT * FROM users WHERE id = '$del_id'";
	$user=mysqli_fetch_assoc(mysqli_query($db_connect ,$sql));
	if (($user['status'])=='admin')
	{
		echo "<script>alert(\"Нельзя удалить администратора!\");</script>"; 
	}
	else 
	{
		$del_id=$_GET['del_id'];
		$sql = "DELETE FROM users WHERE id = '$del_id'";
		mysqli_query($db_connect ,$sql);
		header("Location: http://192.168.0.115/admin.php");
	}
}

?>
<!DOCTYPE HTML>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <link href="./gird.css" rel="stylesheet">
	<link href="./table-styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- Панель навигации -->
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul>
                        <li><a class="active" href="index.php">Главная</a></li>
                        <li><a href="about.php">О сайте</a></li>
                        <li><a href="article-editor.php">Редактор статей</a></li>
						<li><a href="articles.php">Список всех статей</a></li>
						<?php if (empty($_SESSION['auth'])): ?>
						<li class="li-r2">
                            <a href="enterpage.html" class="reg-but">Вход</a>
                        </li>
                        <li class="li-r2">
                            <a href="registrationpage.html" class="reg-but">Регистрация</a>
                        </li>
						<?php else: ?>
						<li class="li-r2">
                            <a href="logoutpage.php" class="reg-but">Выход</a>
                        </li>
						<li class="li-r2">
                            Hello there , <?php echo"$name" ?>
                        </li>
						<?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Основной Контент -->
    <div class="main-cont">
        <div class="container"><br>
            <div class="row">
			<?php if (!empty($_SESSION['auth']) AND ($_SESSION['status'] == 'admin')): ?>
				<div class="col-12">
				<div class="flex-cont">
					<table>
						<tr>
							<th>Id</th><th>Login</th><th>Status</th><th>Удалить</th>
						</tr>
						<?php while($row=mysqli_fetch_assoc($result)): ?>
						<tr>
							<td><?=$row['id']?></td><td><?=$row['login']?></td><td><?=$row['status']?></td><td><a href="admin.php?del_id=<?=$row['id']?>">Удалить пользователя <?=$row['login']?></a></td>
						</tr>
						<?php endwhile;?>	
					</table>
				</div>
				</div>
			<?php else: ?>
				<div class="col-12">
                    <img src="denied.jpg">
                </div>			
			<?php endif; ?>	
            </div>			
        </div>
    </div>
    <!--  -->
    <footer>
        <p>А-08-19 Рогов Дмитрий НИУ МЭИ</p>
    </footer>
</body>

</html>