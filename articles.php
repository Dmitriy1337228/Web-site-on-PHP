<?php
session_start ();
require_once('db.php');
$name = $_SESSION['user'] ?? null;

if (isset($_GET['del_id'])) 
{
	$del_id=$_GET['del_id'];
	$sql = "DELETE FROM articles WHERE id = '$del_id'";
	mysqli_query($db_connect ,$sql);
}

$sql = "SELECT * FROM articles";
$result = mysqli_query($db_connect ,$sql);

?>
<!DOCTYPE HTML>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <link href="./gird.css" rel="stylesheet">
	<link href="./editor-styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="http://fonts.cdnfonts.com/css/tr-eklektic" rel="stylesheet">
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
						<li><a href="">Список всех статей</a></li>
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
       <!--  -->
       <div class="main-cont"><br>
            <div class="row">
                <div class="col-12">
                    <h3>Все статьи:</h3>
				</div>
				<?php while($row=mysqli_fetch_assoc($result)):?>
				<?php $picture=$row['path'];?>
					<div class="col-12">
						<h3><?=$row['title']?></h3>
					</div>
					<div class="col-2">
						<?php if(!isset($picture)):?>
							<?php $picture="noimage.jpg"?>
						<?php endif;?>
						<img src="<?=$picture?>" alt="">
					</div>
					<div class="col-10l">
						<p><?=$row['des'].="..."?></p><br>
						<h3 class="p-author"><?=$row['author']?></h3>
						<a href="article.php?id=<?=$row['Id']?>" class="go-nex-but">Читать далее</a>
					</div>
				<?php endwhile;?>
            </div>
        </div>
        <!--  -->
    <footer>
        <p>А-08-19 Рогов Дмитрий НИУ МЭИ</p>
    </footer>
</body>

</html>