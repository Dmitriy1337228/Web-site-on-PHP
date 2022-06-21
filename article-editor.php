<?php
session_start ();
require_once('db.php');
$name = $_SESSION['user'] ?? null;
if (isset($_GET['red_id'])) 
{
	$red_id = $_GET['red_id'];
	$sql = "SELECT * FROM articles WHERE id = '$red_id'";
	$result = mysqli_fetch_array(mysqli_query($db_connect ,$sql));
}
?>

<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <link href="./gird.css" rel="stylesheet">
	<link href="./editor-styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="./ckeditor5/build/ckeditor.js"></script>
	
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
        <div class="main-cont"><br>
            <div class="row">
                <div class="col-12">
                    <?php if (empty($_SESSION['auth'])): ?>
                    <h3>Для доступа к редактору необходимо зарегистрироваться.</h3>
                    <?php else: ?>
                    <h3>Редактор статей</h3>
                    <?php endif; ?>
                </div>
                <?php if (empty($_SESSION['auth'])): ?>
                <div class="col-12">
                    <img src="denied.jpg">
                </div>
                <?php else: ?>
				<div class="col-12f">
						<form id="myform" action="check_editor.php" method="post" enctype="multipart/form-data">
							<input type="hidden" name="is_red" value="<?= isset($_GET['red_id']) ? $_GET['red_id'] : '';?>"></input>
							<p>Название статьи</p>
							<textarea maxlength="100" class="textarea-desc" name="title" ><?= isset($_GET['red_id']) ? $result['title'] : '';?></textarea>
							<p>Описание статьи</p>
							<textarea maxlength="100" class="textarea-desc" name="des"><?= isset($_GET['red_id']) ? $result['des'] : '';?></textarea>
							<p>Изображение</p><br>
							<input type="file" class="upload" name="userfile"></input>
							<textarea maxlength="10000" class="textarea-text" id="editor" name="editor"><?= isset($_GET['red_id']) ? $result['content'] : '';?></textarea>
								<script>
									CKEDITOR.replace( 'editor' );
								</script>
						</form>
						<input type="submit" form="myform"></input>			
				</div>
                <?php endif; ?>
            </div>
        </div>
    <!--  -->
    <footer>
        <p>А-08-19 Рогов Дмитрий НИУ МЭИ</p>
    </footer>
	<script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
	
</body>


</html>