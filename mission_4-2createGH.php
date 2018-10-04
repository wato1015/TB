<?php
/////////////////////////////////////////////////////////
 $dsn = 'mysql:dbname="データベース名";host="ホスト名"';
 $user ='"ユーザー名"';
 $password = '"パスワード"';
 $pdo = new PDO($dsn,$user,$password);
///////////////////////////////////////////////////////////

 $sql = "CREATE TABLE wa"
."("
."id INT,"
."name char(32),"
."comment TEXT,"
."password TEXT"
.");";
$stmt = $pdo->query($sql);
//////////////////////////////////////////////////////////////
?>