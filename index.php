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

    <!--ajax提交表单需要引入jquery.form.js-->
    <script type="text/javascript" src="http://malsup.github.io/jquery.form.js"></script>
<script async src="//dn-lbstatics.qbox.me/busuanzi/2.3/busuanzi.pure.mini.js">
</script>
<script type="text/javascript">
		function validate_required(field,alerttxt)
{
with (field)
  {
  if (value==null||value=="")
    {alert(alerttxt);return false}
  else {return true}
  }
}

function validate_form(thisform)
{
with (thisform)
  {
  if (validate_required(content,"留言不能为空哦")==false)
    {content.focus();return false}
  }
}

	</script>


</head>
<body>

<?php 
//设置数据库连接信息
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';//密码
$dbname = '';//数据库名
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {//连接失败
    die("Error: 啊哦，好像出了点问题！");
} 

$sql = "SELECT author,comment,datetime FROM comments order by id desc";
$result = mysqli_query($conn,$sql);
$rowCount = mysqli_num_rows($result);
?>

<div class="center-block" style="width: 60%;">

<img src="message.png">

<form role="form" id="form" action="comments.php" method="post"  onsubmit="return validate_form(this)" style="font-size: 20px;">
	<div class="form-group">
		<textarea class="form-control" style="font-size: 20px;" rows="5" name="content" id="content" placeholder="V3.0-输入留言啊-不能为空：）"></textarea>
		<input style="margin-top: 8px;margin-bottom: 8px;font-size: 20px;" type="text" name="author" class="form-control" placeholder="报上名来：）">

		<input type="submit" name="add" class="btn btn-success center-block" value="留言">
	</div>
 </form>


<ul class="list-group" style="font-size: 20px;" >
	<li class="list-group-item" style="color: green;">留言记录-留言板已开源github-<a href="https://github.com/immango/message-board" target="_blank">点此查看</a></li>
	<?php

	if($rowCount > 0){
	while($row = mysqli_fetch_assoc($result)){
	if($row['author'] == null){

	?>

	<li class="list-group-item" style="background: Snow;margin-top: 5px;"><em>用户</em>：<b>匿名用户</b>  &nbsp;&nbsp;<em>留言</em>：<u><span style="font-size: 22px;"><?php echo $row['comment']; ?></span></u>  &nbsp;&nbsp;<em>时间</em>：<?php echo $row['datetime']; ?></li>

	<?php	} else{
	?>
	<li class="list-group-item" style="background: Snow;margin-top: 5px;"><em>用户</em>：<b><?php echo $row['author']; ?></b> &nbsp;&nbsp; <em>留言</em>：<u><span style="font-size: 22px;"><?php echo $row['comment']; ?></span></u> &nbsp;&nbsp; <em>时间</em>：<?php echo $row['datetime']; ?></li>

	<?php
		}
	}

}

$conn -> close();
 ?>
</ul>

</div>
<div style="text-align: center;">
<span id="busuanzi_container_page_pv">
  页面访问量<span id="busuanzi_value_page_pv"></span>次
</span><br>©<a href="http://eastsea.ac.cn">ES</a>
</div>
</body>
</html>