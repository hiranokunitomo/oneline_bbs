<?php
 	// データベースに接続する送信
	$dsn = 'mysql:dbname=oneline_bbs;host=localhost';
	$user ='root';
	$password = '';
	$dbh = new PDO($dsn, $user, $password);
	$dbh->query('SET NAMES utf8');
	//POST送信されたらINSERT文を実行
	if (isset($_POST) && !empty($_POST)){
		$sql= 'INSERT INTO `posts` (`id`, `nickname`, `comment`, `created`) VALUES (NULL, ?, ?, now())';	
		

		$param[] = $_POST['nickname'];
		$param[] = $_POST['comment'] ;


		$stmt = $dbh->prepare($sql);
		$stmt ->execute($param);
		#code...
	}


		//SQL文作成(SELECT文)
		$sql = 'SELECT * FROM `posts` ORDER BY `created` DESC' ;

		$stmt = $dbh->prepare($sql);
		$stmt ->execute();

		//格納する変数の初期化
		$posts = array();

		//繰り返し文でデータの取得
		while (1) {
			$rec = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($rec == false){

				break;
			}
		 	# code...
		 	$posts[] = $rec;
		 } 
		


		# code...
		




		// データベースから切断
		$dbh = null;

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示版</title>
</head>
<body>
    <form method="post" action="">
      <p><input type="text" name="nickname" placeholder="nickname"></p>
      <p><textarea type="text" name="comment" placeholder="comment"></textarea></p>
      <p><button type="submit" >つぶやく</button></p>
   
    </form>
    <?php  //var_dump($posts); ?>
    <ul>
    	<?php
    		foreach ($posts as $posts_each) {
    			echo '<li>';


    			echo 'nickname:' .$posts_each['nickname'];
    			echo 'coment:' .$posts_each['comment'];
    			echo 'created'. $posts_each['created'];	
    			echo '</li>';
    				# code...
    			}
    		?>
    </ul>	
    <!-- ここにニックネーム、つぶやいた内容、日付を表示する -->

</body>
</html>