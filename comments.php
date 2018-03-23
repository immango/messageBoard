<!DOCTYPE html>
<html>
<head>
	<!auther:immango github:immango web http://eastsea.ac.cn>
	<meta charset="utf-8">
	<script language="javascript" type="text/javascript"> 
// 以下方式直接跳转
//window.location.href='test2.php';
// 以下方式定时跳转
setTimeout("javascript:location.href='./'", 3000); 
</script>
</head>
<body>
<div style="text-align: center;">
<?php 
if(isset($_POST['add'])){

//设置数据库连接信息
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';//数据库密码
$dbname = '';//数据库名称
$tbname = '';//表名
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {//连接失败
    die("Error: 出了点问题，请联系管理员！");
} 

//获取变量值
$contenttemp = $_POST['content'];
$authortemp = $_POST['author'];
$ip = $_SERVER['REMOTE_ADDR'];

$content = htmlspecialchars($contenttemp);
$author = htmlspecialchars($authortemp);

date_default_timezone_set("Asia/Shanghai");
$datestring = date("Y/m/d H:i:s");

$sql = "INSERT INTO $tbname".
		"(author,ip,comment,datetime)".
		"VALUES".
		"('$author','$ip','$content','$datestring')";
		

if ($conn->query($sql) === TRUE) {
    echo '<p>'."留言成功,即将跳转。".'</p>';
    echo "如果3秒没有反应".'<a href = "./">'."点击这里".'</a>';
} else {
    echo "Error: 出了点问题，请联系管理员！";
}

$conn->close();
}

 ?>

</div>

</body>
</html>