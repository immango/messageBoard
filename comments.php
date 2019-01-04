
<?php 

//设置数据库连接信息
$dbhost = 'localhost';
$dbuser = 'root';//数据库的用户
$dbpass = '123456';//数据库密码
$dbname = 'commentsDB';//数据库
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {//连接失败
    die("Error: 出了点问题，请联系管理员！");
} 

//获取变量值
$contenttemp = $_POST['content'];
$authortemp = $_POST['author'];
$ip = $_SERVER['REMOTE_ADDR'];

//文字加密处理
$content = htmlspecialchars($contenttemp);
$author = htmlspecialchars($authortemp);

//获取留言时间
date_default_timezone_set("Asia/Shanghai");//时间地区
$datestring = date("Y/m/d H:i:s");

//插入留言的sql
$sql = "INSERT INTO comments".
		"(author,ip,comment,time)".
		"VALUES".
		"('$author','$ip','$content','$datestring')";
		

if ($conn->query($sql) === TRUE) {
    //执行
} 

//ajax查询留言数据，用于返回给HTML展示
$sqlSearch = "SELECT author,comment,time FROM comments order by id desc";
$result = mysqli_query($conn,$sqlSearch);
$rowCount = mysqli_num_rows($result);

//将数据存储为json格式；注意，此处为string类型，需要在使用的时候转换为json对象
if($rowCount > 0){
	while($row = mysqli_fetch_assoc($result)){
			$data[] = $row;
	}
		echo json_encode($data);
		
	}

$conn->close();//关闭连接
 ?>