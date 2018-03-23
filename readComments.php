<!DOCTYPE html>
<html>
<head>
	<!auther:immango github:immango web http://eastsea.ac.cn>
	<title>来查看你的留言啊</title>
	<meta charset="utf-8">
</head>
<body>
<?php 

//设置数据库连接信息
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';//数据库密码
$dbname = '';//数据库名称
$tbname = '';//表名
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {//连接失败
    die("Error: 出了点问题，请联系管理员！");
} 

$sql = "SELECT author,comment,datetime FROM $tbname order by id desc";//倒序输出
$result = mysqli_query($conn,$sql);
$rowCount = mysqli_num_rows($result);
echo "欢迎文明留言，不文明可不是好孩子ヾ(๑╹◡╹)ﾉ";

if($rowCount > 0){
	while($row = mysqli_fetch_assoc($result)){
		
		if($row['author'] == null){
			echo "<pre><em><b>匿名用户</b></em>: "."   留言   <u>".$row['comment']."</u>"."    时间: ".$row['datetime']."</pre>";
		}
		else{
			echo "<pre>用户: <em><b>".$row['author']."</b></em>   留言   <u>".$row['comment']."</u>"."    时间: ".$row['datetime']."</pre>";
		}

	}

}

$conn -> close();
 ?>


</body>
</html>