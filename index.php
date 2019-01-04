<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>留言板</title>

	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!--jquery需要引入的文件-->
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.js"></script>
    <!--不蒜子计数器-->
	<script async src="//busuanzi.ibruce.info/busuanzi/2.3/busuanzi.pure.mini.js"></script>
	<!------Ajax异步发送表单，局部刷新数据-------->
	<script src="comments.js"></script>



</head>
<body>

<?php 
//设置数据库连接信息
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '123456';
$dbname = 'commentsDB';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {//连接失败
    die("Error: 啊哦，好像出了点问题！");
} 

//查询留言数据
$sql = "SELECT author,comment,time FROM comments order by id desc";
$result = mysqli_query($conn,$sql);
$rowCount = mysqli_num_rows($result);
?>

<div class="center-block" style="width: 60%;">

<img src="message.png">

<form role="form" id="form" action="" style="font-size: 18px;">
	<div class="form-group">
		<textarea class="form-control" style="font-size: 18px;" rows="5" name="content" id="content" placeholder="Version4.0 留言不能为空：）" required="required"></textarea>
		<input style="margin-top: 8px;margin-bottom: 8px;font-size: 18px;" type="text" name="author" class="form-control" placeholder="报上名来：）">

		<input type="button" onclick="loadXMLDoc()" name="add" class="btn btn-success center-block" value="留言">
	</div>
 </form>

<ul class="list-group" style="font-size: 18px;" >
	<li class="list-group-item" style="color: green;">留言记录-留言板已开源github-<a href="https://github.com/immango/message-board" target="_blank">点此查看</a> | <a href="#footer">觉得UI丑?</a></li>
</ul>

<ul id="txtHint" class="list-group" style="font-size: 18px;" >
<?php

	if($rowCount > 0){
	while($row = mysqli_fetch_assoc($result)){
	if($row['author'] == null){

	?>

	<li class="list-group-item" style="background: Snow;margin-top: 5px;"><em>用户</em>：<b>匿名用户</b>  &nbsp;&nbsp;<em>留言</em>：<u><span style="font-size: 19px;"><?php echo $row['comment']; ?></span></u>  &nbsp;&nbsp;<em>时间</em>：<?php echo $row['time']; ?></li>

	<?php	} else{
	?>
	<li class="list-group-item" style="background: Snow;margin-top: 5px;"><em>用户</em>：<b><?php echo $row['author']; ?></b> &nbsp;&nbsp; <em>留言</em>：<u><span style="font-size: 19px;"><?php echo $row['comment']; ?></span></u> &nbsp;&nbsp; <em>时间</em>：<?php echo $row['time']; ?></li>

	<?php
		}
	}

}

$conn -> close();
 ?>
</ul>

</div>


<div style="text-align: center;" id = "footer">
<span id="busuanzi_container_page_pv">
  页面访问量<span id="busuanzi_value_page_pv"></span>次
</span>
	<p style="color: red;">如果你有更好的UI设计，不妨发送至 1807659863#qq.com 欢迎交流</p>
	<p></p>
	<a href="http://eastsea.ac.cn">&copy;<?php echo date("Y"); ?>ES</a>
	<?php date_default_timezone_set("Asia/Shanghai"); echo " Asia/Nanchang ".date("H:i:sa");?>
</div>
</body>
</html>