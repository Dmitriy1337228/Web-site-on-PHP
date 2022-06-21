<?php
session_start ();
require_once('db.php');

$dir = 'uploads/';
$content=$_POST['editor'];
$title=$_POST['title'];
$des=$_POST['des'];
$author=$_SESSION['user'];
$is_red=$_POST['is_red'];
if ($_FILES && $_FILES["userfile"]["error"]== UPLOAD_ERR_OK)
{
    $name = "uploads/" .$_FILES["userfile"]["name"];
    move_uploaded_file($_FILES["userfile"]["tmp_name"], $name);
	$file = scandir($dir);
	for ($i = 0; $i < count($file); $i++) { // Перебираем все файлы
    if ((str_replace("uploads/","",$dir.$file[$i]))==(stristr($name,$_FILES["userfile"]["name"]))) { // Текущий каталог и родительский пропускаем
		$path = $dir.$file[$i]; // Получаем путь к картинке
	}
}
}


if (!empty($_POST['editor']) && !empty($_POST['title']) && !empty($_POST['des']))
{
	if (!empty($is_red))
	{
		$sql="UPDATE articles SET title = '{$title}' , des = '{$des}' , content = '{$content}' WHERE id = '{$is_red}' ";
		mysqli_query($db_connect ,$sql);
		
	}
	else
		{				
			$sql="INSERT INTO articles (title,des,content,path,author) VALUES ('{$title}','{$des}','{$content}','{$path}','{$author}')";
			mysqli_query($db_connect ,$sql);
		}
}
else 
{
	echo"Заполните все поля";
}
header("Location: http://192.168.0.115/articles.php");

?>
