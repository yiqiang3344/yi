<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">  
<html>  
  <head>  
    <title>test5.html</title>  
      
    <meta http-equiv="keywords" content="keyword1,keyword2,keyword3">  
    <meta http-equiv="description" content="this is my page">  
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">  
    <script type="text/javascript">  
        function notify(){//获取当前输入内容信息，传递给父窗口  
            var val = document.getElementById("info").value;  
            window.opener.document.getElementById("myspan").innerText=val;  
        }  
    </script>  
  </head>  
    
  <body>  
    我是新窗口  
    <span id="test">test</span>  
    <input type="text" id="info"/><br/>  
    <input type="button" value="通知给父窗口" onclick="notify();"/>  
  </body>  
</html>  