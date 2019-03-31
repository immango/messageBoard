//异步发送表单数据并且更新留言板信息
function loadXMLDoc(){

		//获取表单数据
		var content = document.forms["form"]["content"].value;
		var author = document.forms["form"]["author"].value;

        //判断留言是否为空
		if(content == ""){
			alert("留言不能为空");
			return;
		}

        //屏蔽关键字

        content = content.replace(/https:\/\//g,"*");
        content = content.replace(/http/g,"*");
        content = content.replace(/com/g,"*");
        content = content.replace(/\//g,"*");
        content = content.replace(/www/g,"*");
        content = content.replace(/html/g,"*");
        content = content.replace(/./g,"**");
        content = content.replace(/。/g,"**");
        author = author.replace(/./g,"**");
        author = author.replace(/。/g,"**");

        //形成ajax异步POST方式数据
		var data = "content=" + content + "&" + "author=" + author;

		//异步发送表单数据
		var xmlHttp;
		
		xmlHttp = new XMLHttpRequest();
		xmlHttp.open("POST","comments.php",true);
		xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  		xmlHttp.send(data);
  		
        //表单发送完成，更新留言板
  		xmlHttp.onreadystatechange=function(){
        if (xmlHttp.readyState==4 && xmlHttp.status==200){
            
            //清空原有输入框内容
            document.forms["form"]["content"].value = "";
            document.forms["form"]["author"].value = "";

            var str = "";

            //将json字符串转变成json对象
            var temp = xmlHttp.responseText;
            var user = eval('(' + temp + ')');

            //遍历json对象
            for(var i in user){
            		if(user[i].author == ""){//匿名用户
            			str += "<li class=\"list-group-item\" style=\"background: Snow;margin-top: 5px;\"><em>用户</em>：<b>匿名用户</b>  &nbsp;&nbsp;<em>留言</em>：<u><span style=\"font-size: 19px;\">" + user[i].comment + "</span></u>  &nbsp;&nbsp;<em>时间</em>：" + user[i].time + "</li>";

            		}else{//实名用户
            			str += "<li class=\"list-group-item\" style=\"background: Snow;margin-top: 5px;\"><em>用户</em>：<b>" + user[i].author + "</b>  &nbsp;&nbsp;<em>留言</em>：<u><span style=\"font-size: 19px;\">" + user[i].comment + "</span></u>  &nbsp;&nbsp;<em>时间</em>：" + user[i].time + "</li>";


            		}
            }

            //更新留言板
			document.getElementById("txtHint").innerHTML=str;
			}
        }
    }