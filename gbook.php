<?php
header('Content-Type: text/html; charset=utf-8');
require_once ('validate.php');
$errors = array();
define("DB_HOST", "localhost");
define("DB_LOGIN", "root");
define("DB_PASSWORD", "");
$connect = mysql_connect(DB_HOST, DB_LOGIN, DB_PASSWORD) or die(mysql_error());
    mysql_select_db("gbook");
if ($_SERVER['REQUEST_METHOD'] == 'POST' && validate()) {
    
    $sql = "
    INSERT INTO msgs (name, email, msg)
	VALUES ('" . $name . "','" . $email .
        "','" . $msg . "')
    ";
    mysql_query($sql) or die(mysql_error());
    header("Location: http://opencart_support/www333/mod4/gbook.php");
}
else {
    if($errors) {
        echo '<pre>';
        echo print_r($errors);
        echo '</pre>';
        }
}
if(isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = $_GET['delete'] * 1;
    $delete_query = "
    DELETE FROM msgs WHERE msgs.id = ".$_GET['delete'];
    mysql_query($delete_query) or die(mysql_error());
}
?>
<!DOCTYPE html>
<head>
	<title>Гостевая книга</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
</head>
<body>
<h1>Гостевая книга</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
Ваше имя:<br />
<input type="text" name="name" /><br />
Ваш E-mail:<br />
<input type="text" name="email" /><br />
Сообщение:<br />
<textarea name="msg" cols="50" rows="5"></textarea><br />
<br />
<input type="submit" value="Добавить!" />
</form>
<?php
$result = mysql_query("SELECT * 
                            FROM msgs ORDER BY id DESC");
echo 'Записей в гостевой - '.mysql_num_rows($result).'<br /><hr />';
while ($row = mysql_fetch_assoc($result)) {
    echo "<a href=mailto:".$row["email"].">".$row["name"]."</a><br />";
    echo ' <h3> '.$row["msg"].'</h3><br />';
    echo '<p align="right"><a href='.$_SERVER['PHP_SELF'].'?delete='.$row['id'].'>Удалить запись</a></p>';
    echo '<br /><hr/><br />';
}
mysql_free_result($result);
mysql_close($connect);
?>
</body>
</html>