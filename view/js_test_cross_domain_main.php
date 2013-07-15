<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">  
<html>  
<head>  
<title>test4.html</title>  
  
<meta http-equiv="keywords" content="keyword1,keyword2,keyword3">  
<meta http-equiv="description" content="this is my page">  
<meta http-equiv="content-type" content="text/html; charset=UTF-8">  
<script type="text/javascript">
	var newWin;
    function test(){//moveto是按照当前屏幕定位窗口，moveby是根据当前窗口左上角位置再次定位  
        window.moveTo(100, 100);  
    }  
      
    function test2(){//重新改变大小  
        window.resizeTo(400, 500);  
    }  
      
    function test3(){//在原来窗口大小的基础上增加一定的程度和宽度  
        window.resizeBy(100, 200);  
    }  
      
    function test4(){//_black是打开新的窗口，不替换原来的窗口  
    //newWin其实是打开的新窗口的句柄  
        newWin = window.open("test2.php", "_blank");  
//        window.focus();
    }  

    function test5(){
        newWin.document.getElementById("test").innerHTML=document.getElementById("info").value;
    }
</script>  
</head>  
    
<body>  
    This is my HTML page. <br>  
    <input type="button" onclick="test();" value="移动"/><br/>  
    <input type="button" onclick="test2();" value="改变大小"/><br/>  
    <input type="button" onclick="test3();" value="增加大小"/><br/>  
    <input type="button" onclick="test4();" value="打开新窗口"/><br/>
    <input type="input" id="info" value=""/><br/>
    <input type="button" onclick="test5();" value="给子窗口发送信息"/><br/>  
    <span id="myspan"></span>  
    <input type="button" onclick="return newWin.close();" value="关闭子窗口"/><br/>  
</body>  
</html>  