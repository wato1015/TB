<?php
 $dsn = 'mysql:dbname=tt_352_99sv_coco_com;host=localhost';
 $user ='tt-352.99sv-coco';
 $password = 'Ti2AvQpe';
 $pdo = new PDO($dsn,$user,$password);
?>

<html>
<head>
<meta "charset = UTF-8">
<title>掲示板</title>
</head>
<body>
<?php
$name = $_POST['name'];
$comment = $_POST['comment'];
$pass = $_POST['pass'];
$ednum = $_POST['ednum'];

$del = $_POST['del'];
$passdel =$_POST['passdel'];

$edselect = $_POST['edselect'];
$passed =$_POST['passed'];

if (!empty($edselect) && !empty($passed)){
	$sql = 'SELECT * FROM wa';
	 $results = $pdo -> query($sql);
	foreach ($results as $row){
	 $id = $row['id'];
	 $pass=$row['password'];
		if (($id == $edselect) &&($pass == $passed)){
		$namae = $row['name'];
		$komento = $row['comment']; 
		$selnum = $id;
		break;
		}else{
		$namae = "入力が正しくありません";
		$komento = "入力が正しくありません"; 
		}
	}
}else{
$namae = "名前";
$komento ="コメント";
$selenum = "";
}
?>
<form action = "mission_4-2.php" method="post">
<input type="text" value="<?php echo $namae; ?>" name='name'><br>
<input type="text" value="<?php echo $komento ; ?>" name='comment'><br>
<input type="text" value="パスワード" name='pass'><br>
<input type="hidden" value="<?php echo $selnum; ?>" name='ednum'><br>
<input type="submit">
</form>

<form action = "mission_4-2.php" method="post">
<input type="text" value="削除対象番号" name='del'><br>
<input type="text" value="パスワード" name='passdel'><br>
<input type="submit" value = "削除">
</form>

<form action = "mission_4-2.php" method="post">
<input type="text" value="編集対象番号" name='edselect'><br>
<input type="text" value="パスワード" name='passed'><br>
<input type="submit" value = "編集選択">
</form>
<?php
//////////////////////////////////////////////////////////////////////////////////////
	$sql = 'SELECT * FROM wa';
	$results = $pdo -> query($sql);
	foreach ($results as $row){
	$id = $row['id'];
	}
if(!empty($name) and !empty($comment) and !empty($pass) and empty($ednum)){
	//echo "test入力".'<br>';
	if (empty($id)){
	$id=1;
	}else{
	$sql = 'SELECT * FROM wa order by id';
	$results = $pdo -> query($sql);
	foreach ($results as $row){
	$id = $row['id']+1;
	}}  
	$sql = $pdo -> prepare("INSERT INTO wa (id,name, comment,password) VALUES (:id,:name, :comment,:password)");
	$sql -> bindParam(':id', $id, PDO::PARAM_STR);
	$sql -> bindParam(':name', $name, PDO::PARAM_STR);
	$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
	$sql -> bindParam(':password', $pass, PDO::PARAM_STR);
	$sql -> execute();

	}else{
	
	}
//////////////////////削除///////////////////////////////////////////////////////////////////

if (!empty($_POST["del"])&&($_POST["passdel"])){
	 $sql = 'SELECT * FROM wa';
	 $results = $pdo -> query($sql);
	foreach ($results as $row){
	 $id = $row['id'];
	 $pass=$row['password'];
		if (($id ==$del) &&($pass == $passdel)){
	 	$sql = "delete from wa where id=$id";

	 	$result = $pdo->query($sql);
		break;
		}elseif (($id ==$del) && (pass !== passdel)){
		echo "入力が正しくありません".'<br>';
		break;
		}else{
		}
		}
}else{
}
///////////////////////編集//////////////////////////////////////////////////////////////////////////

if (!empty($name) and !empty($comment) and !empty($ednum)){
//echo "test編集".'<br>';
$id=$ednum;
$nm=$name;
$kome = $comment;
$sql  = "update wa set name='$nm' , comment='$kome' where id = $id";
$result = $pdo->query($sql);
}else{
}


///////////////////////////////////////////////////////////////////////////////////
	$sql = 'SELECT * FROM wa order by id';
	$results = $pdo -> query($sql);
	foreach ($results as $row){   
	echo $row['id'].',';
	echo $row['name'].',';
	echo $row['comment'].'<br>';  
	}

?>
</body>
</html>