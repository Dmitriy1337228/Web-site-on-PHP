<?php
session_start ();
$name = $_SESSION['user'] ?? null;
?>
<!DOCTYPE HTML>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <link href="./gird.css" rel="stylesheet">
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
                <div class="col-12l">
                    <h3>Добро пожаловать на Энциклопедию по Web-программированию!</h3>
                </div>
                <div class="col-4">
                    <img src="poster.png">
                </div>
                <div class="col-8">
                    <h3>Что такое Web-программирование?</h3>
                    <p>Веб-программирование — раздел программирования, ориентированный на разработку веб-приложений (программ, обеспечивающих функционирование динамических сайтов Всемирной паутины).
						Языки веб-программирования — это языки, которые в основном предназначены для работы с веб-технологиями. Языки веб-программирования можно условно разделить на две пересекающиеся группы: <a href="http://192.168.0.115/article.php?id=1" class="text">клиентские</a> и <a href="http://192.168.0.115/article.php?id=2" class="text" >серверные</a>.
                    </p>
                </div>
            </div>
			<?php if (!empty($_SESSION['auth']) AND ($_SESSION['status'] == 'admin')): ?>
			<div>
				<br>
				<a href="admin.php">Перейти на панель управления</a>
			</div>
			<?php endif; ?>	
        </div>
    </div>
    <!--  -->
    <footer>
        <p>А-08-19 Рогов Дмитрий НИУ МЭИ</p>
    </footer>
</body>

</html>