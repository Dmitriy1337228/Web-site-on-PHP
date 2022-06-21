<?php
session_start ();
$name = $_SESSION['user'] ?? null;
require_once('db.php');
$article_id=$_GET['id'];
$sql="SELECT * FROM articles WHERE Id = '$article_id'";
$result = mysqli_query($db_connect ,$sql);
?>

<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <link href="./gird.css" rel="stylesheet">
	<link href="./editor-styles.css" rel="stylesheet">
	
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
    <!--  -->
	<div class="main-cont">
        <div class="container"><br>
			<?php while($row=mysqli_fetch_assoc($result)): ?>
			<?php $picture=$row['path'];?>
            <div class="row">
				<div class="col-12">
                    <h3><?=$row['title']?></h3>
                </div>
				<div class="col-12l">
                    <p><?=$row['des']?></p>
                </div>
				<div class="col-4">
					<?php if(!isset($picture)):?>
						<?php $picture="noiamge.jpg"?>
					<?php endif;?>
					<img src="<?=$picture?>" alt="">
				</div>
				<div class="col-8">
					<p><?=$row['content']?></p><br>
					<h3 class="p-author"><?=$row['author']?></h3>
					<a href="articles.php" class="go-nex-but">Вернуться назад</a><br>
					<?php if ((!empty($_SESSION['auth'])) AND (($_SESSION['user'] == $row['author']) OR ($_SESSION['status'] == 'admin') )): ?>
					<div class="mini-cont">
					<a href="articles.php?del_id=<?=$row['Id']?>" class="update-but">Удалить статью</a>
					<a href="article-editor.php?red_id=<?=$row['Id']?>" class="update-but">Редактировать</a>
					</div>
				<?php endif; ?>	
				</div>
						
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